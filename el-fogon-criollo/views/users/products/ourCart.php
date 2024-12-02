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

    <div class="productos-grid">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <img src="./assets/images/products/<?=$producto->getImagen()?>" alt="<?=$producto->getNombre()?>">
                    <h3><?=$producto->getNombre()?></h3>
                    <p><?=$producto->getTipo()?></p>
                    <p><strong>$<?= number_format($producto->getPrecio(), 2) ?></strong></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</div>
