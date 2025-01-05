<!-- Vista de Productos -->
<h2>Todos los Productos</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?= $producto->getProducto_id() ?></td>
            <td><?= $producto->getNombre() ?></td>
            <td><?= $producto->getDescripcion() ?></td>
            <td><?= $producto->getPrecio() ?></td>
            <td>
                <button onclick="editProduct(<?= $producto->getProducto_id() ?>)">Editar</button>
                <button onclick="deleteProduct(<?= $producto->getProducto_id() ?>)">Eliminar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
