<div class="carta-container">
    <div class="carta-header">
        <h1>NUESTRA CARTA</h1>
        <div>
            <label for="filtro-categoria">Filtrar por:</label>
            <select id="filtro-categoria" name="categoria">
                <option value="">Categoría</option>
            </select>
        </div>
    </div>

    <br>

    <div class="container my-5">
        <div class="row g-4">
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 text-center">
                            <img src="./assets/images/products/<?=$producto->getImagen()?>" class="card-img-top img-fluid" alt="<?=$producto->getNombre()?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=$producto->getNombre()?></h5>
                                <p class="card-text text-muted"><?=number_format($producto->getPrecio(), 2)?>€</p>
                            </div>
                            <button class="btn btn-primary">Añadir al carrito</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No hay productos disponibles en este momento.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
