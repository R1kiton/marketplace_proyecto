const precioMin = document.getElementById("precioMin");
const precioMax = document.getElementById("precioMax");
const precioMinValue = document.getElementById("precioMinValue");
const precioMaxValue = document.getElementById("precioMaxValue");
const filtros = document.getElementById("filtersForm");
const form_busqueda = document.getElementById("searchForm");
const barra_busqueda = document.getElementById("searchInput");
const categoriasHTML = document.getElementsByClassName("categoria");

  const envioGratis = document.getElementById("envioGratis");
let productos = [];
let categorias = [...categoriasHTML];

let busquedaActual = "";

const formatearPrecio = (valor) => {
  return "$" + Number(valor).toLocaleString("es-AR");
};

const actualizarRangoPrecio = () => {
  let min = parseInt(precioMin.value);
  let max = parseInt(precioMax.value);

  if (min > max) {
    [min, max] = [max, min];
  }

  precioMinValue.textContent = formatearPrecio(min);
  precioMaxValue.textContent = formatearPrecio(max);
};

if (precioMin && precioMax) {
  precioMin.addEventListener("input", actualizarRangoPrecio);
  precioMax.addEventListener("input", actualizarRangoPrecio);
  actualizarRangoPrecio();
}

const armarParametros = () => {
  const calif = document.querySelector('input[name="calificacion"]:checked')
  const vendidos = document.querySelector('input[name="vendidos"]:checked')
  const params = new URLSearchParams();

  if (busquedaActual) {
    params.set("busqueda", busquedaActual);
  }

  categorias
    .filter((c) => c.checked)
    .forEach((c) => params.append("categoria[]", c.value));

  if (precioMin && precioMax) {
    let min = parseInt(precioMin.value);
    let max = parseInt(precioMax.value);
    if (min > max) {
      [min, max] = [max, min];
    }
    params.set("precio_min", min);
    params.set("precio_max", max);
  }

  if (calif) {

    params.set("calificacion", calif.value);
  }

  if (vendidos) {
    params.set("vendidos", vendidos.value);
  }


  if (envioGratis && envioGratis.checked) {
    params.set("envio_gratis", "1");
  }

  return params;
};

const obtenerProductos = async (params) => {
  const query = params && params.toString() ? `?${params.toString()}` : "";
  const res = await fetch(`datos.php${query}`);
  return await res.json();
};

const productsGrid = document.getElementById("productsGrid");

const crearProductCard = (producto) => {
  const card = document.createElement("article");
  card.classList.add("product-card");

  card.innerHTML = `
    <div class="product-card__image-wrap">
      <img
        src="${producto.imagen_url}"
        alt="${producto.nombre}"
        class="product-card__image"
      >
    </div>

    <div class="product-card__body">

      ${producto.envio_gratis ? '<span class="product-card__shipping">Envío gratis</span>' : ""}

      <h3 class="product-card__title">
        ${producto.nombre}
      </h3>

      <p class="product-card__price">
        $${producto.precio}
      </p>

      <div class="product-card__rating">
        <span class="product-card__rating-number">${producto.calificacion}</span>
        <span class="product-card__stars">★★★★★</span>
        <span class="product-card__sold">${producto.cantidad_vendida} vendidos</span>
      </div>

      <p class="product-card__seller">
        Por ${producto.vendedor}
      </p>

    </div>
  `;

  return card;
};

const renderProductos = (lista) => {
  productsGrid.innerHTML = "";
  lista.forEach((producto) => {
    productsGrid.appendChild(crearProductCard(producto));
  });
};

const init = async () => {
  productos = await obtenerProductos();
  renderProductos(productos);

  form_busqueda.addEventListener("submit", async (e) => {
    e.preventDefault();
    busquedaActual = barra_busqueda.value.trim();
    const params = armarParametros();
    productos = await obtenerProductos(params);
    renderProductos(productos);
  });

  filtros.addEventListener("submit", async (e) => {
    e.preventDefault();
    const params = armarParametros();
    productos = await obtenerProductos(params);
    renderProductos(productos);
  });
};

init();
