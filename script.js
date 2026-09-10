const precioMin = document.getElementById("precioMin");
const precioMax = document.getElementById("precioMax");
const precioMinValue = document.getElementById("precioMinValue");
const precioMaxValue = document.getElementById("precioMaxValue");
const filtros = document.getElementById("filtersForm");
const form_busqueda = document.getElementById("searchForm");
const barra_busqueda = document.getElementById("searchInput");
const categoriasHTML = document.getElementsByClassName("categoria");
const calificacion = document.getElementById("filter-option__stars");
const cant_vendida = document.getElementById("cant_vendida");
let productos = [];
let categorias = [...categoriasHTML];

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

const obtenerProductos = async () => {
  const res = await fetch("datos.php");
  return await res.json();
};

const busqueda = (palabra) => {
  const producto_buscado = productos.filter((p) =>
    p.nombre.toLowerCase().includes(palabra.toLowerCase()),
  );
  return producto_buscado;
};

const filtrado = (resultado) => {
  const categorias_check = categorias.filter((p) => p.checked);
  console.log(categorias_check.map(p => p.value.toLowerCase()))
  const producto_filtrado = resultado.filter((p) =>
    (categorias_check.map(p => p.value.toLowerCase())).includes(p.categoria.toLowerCase()),
  )
  return producto_filtrado
}

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
  productos = await obtenerProductos()
  renderProductos(productos)
  form_busqueda.addEventListener("submit", (e) => {
    e.preventDefault()
    productos = busqueda(barra_busqueda.value)
    renderProductos(productos)
  })
  filtros.addEventListener("submit", (e) => {
    e.preventDefault()
    productos = filtrado(productos)
    renderProductos(productos)
  })
  
};

init();
