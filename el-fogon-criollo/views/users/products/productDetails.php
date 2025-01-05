<div id="product" class="container my-5">
    <div class="row">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            <img src="./assets/images/products/<?=$producto->getImagen()?>" alt="<?=$producto->getNombre()?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h3><?=$producto->getNombre()?></h3>
            <p><?=$producto->getDescripcion()?></p>
            <p>Precio: <?=number_format($producto->getPrecio(), 2)?>€</p>
            <a href="?controller=producto&action=ourCart" class="btn btn-secondary">Volver a la carta</a>
            <button class="btn btn-primary">Añadir al carrito</button>
        </div>
    </div>
</div>
