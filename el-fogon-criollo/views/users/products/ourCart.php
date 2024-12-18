<div class="carta-container">
    <div class="carta-header">
        <div class="hero-section">
        <h1 class="text-center">NUESTRA<br>CARTA</h1>
            <div class="hero-image-container">
                <img src="./assets/images/nuestra-carta-circular.webp" class="hero-image" alt="Carne cortando">
            </div>
        </div>
        <div class="filter-container">
            <label for="filtro-categoria">Filtrar por:</label>
            <select id="filtro-categoria" name="categoria">
                <option value="">Nombre</option>
                <option value="">Tipo</option>
                <option value="">Precio</option>
            </select>
        </div>
    </div>

    <div id="ourCart" class="container my-5">
        <div class="row g-4">
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 text-center">
                            <a href="?controller=producto&action=productDetails&id=<?=$producto->getProducto_id()?>">
                                <img src="./assets/images/products/<?=$producto->getImagen()?>" class="card-img-top img-fluid" alt="<?=$producto->getNombre()?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?=$producto->getNombre()?></h5>
                                <p class="card-text text-muted"><?=number_format($producto->getPrecio(), 2)?>€</p>
                            </div>
                            <button class="btn btn-primary">
                                <a href="?controller=carrito&action=addToCart&id=<?=$producto->getProducto_id()?>" style="color: white; text-decoration: none;">Añadir al carrito</a>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No hay productos disponibles en este momento.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
