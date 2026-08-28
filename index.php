<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mercado Libre</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js" defer></script>
</head>
<body>

<?php

require("buscar.php");

?>
  <header class="header">
    <div class="header-top">
      <div class="header-top__container">
        <a href="index.php" class="logo">
          Mercado<span>Libre</span>
        </a>

        <form action= "index.php" method= "GET" class="search-bar" id="searchForm">
          <input
            type="text"
            class="search-bar__input"
            placeholder="Buscar productos, marcas y más..."
            id="searchInput"
            name= "searchProduct"
          >
          <button type="submit" class="search-bar__button" aria-label="Buscar">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
              <path fill="currentColor" d="M21.71 20.29l-5.4-5.39A7.92 7.92 0 0018 10a8 8 0 10-8 8 7.92 7.92 0 004.9-1.69l5.39 5.4zM4 10a6 6 0 116 6 6 6 0 01-6-6z"/>
            </svg>
          </button>
        </form>

        <nav class="header-actions">
          <a href="#" class="header-actions__item">
            <span>Mis compras</span>
          </a>
          <a href="#" class="header-actions__item">
            <span>Ingresá</span>
          </a>
          <a href="#" class="header-actions__item header-actions__item--strong">
            <span>Creá tu cuenta</span>
          </a>
          <a href="#" class="header-actions__item header-actions__item--cart" aria-label="Carrito">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
              <path fill="currentColor" d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L20.9 4H4.21l-.94-2H1zM17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
            </svg>
          </a>
        </nav>
      </div>
    </div>

    <div class="header-bottom">
      <nav class="header-bottom__container">
        
        <div class="dropdown">
  <a href="index.php" class="dropdown-btn">Categorías</a>
  <div class="dropdown-menu">
    <a href="index.php?categoria=Tecnología">Tecnología</a>
    <a href="index.php?categoria=Moda">Moda</a>
    <a href="index.php?categoria=Hogar">Hogar</a>
    <a href="index.php?categoria=Belleza">Belleza</a>
    <a href="index.php?categoria=Deportes">Deportes</a>
  </div>
</div>

        <a href="index.php?masvendido=1">Mas vendido</a>
        <a href="#">Historial</a>
        <a href="#">Supermercado</a>
        <a href="#">Moda</a>
        <a href="#">Vender</a>
        <a href="#">Ayuda</a>
      </nav>
    </div>
  </header>


  <main class="main">
    <h3><?php echo $titulo ?></h3>
    <section class="products-grid" id="productsGrid">

      <?php foreach ($productos as $producto): ?>
        <article class="product-card">

          <div class="product-card__image-wrap">
            <img
              src="<?= $producto['imagen_url'] ?>"
              alt="<?= $producto['nombre'] ?>"
              class="product-card__image"
            >
          </div>

          <div class="product-card__body">

            <?php if ($producto['envio_gratis']): ?>
              <span class="product-card__shipping">Envío gratis</span>
            <?php endif; ?>

            <h3 class="product-card__title">
              <?= $producto['nombre'] ?>
            </h3>

            <p class="product-card__price">
              $<?=$producto['precio'] ?>
            </p>

            <div class="product-card__rating">
              <span class="product-card__rating-number"><?= $producto['calificacion'] ?></span>
              <span class="product-card__stars">★★★★★</span>
              <span class="product-card__sold"><?= $producto['cantidad_vendida'] ?> vendidos</span>
            </div>

            <p class="product-card__seller">
              Por <?= $producto['vendedor'] ?>
            </p>

          </div>

        </article>
      <?php endforeach ?>

    </section>
  </main>


</body>
</html>