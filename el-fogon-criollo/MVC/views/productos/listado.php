<h1>Listado de productos</h1>
    <a href="?controller=producto&action=create">Crear nuevo produco</a>
    <table border="1">
        <tr>
            <td>Nombre</td>
            <td>Talla</td>
            <td>Precio</td>
            <td>Action</td>
        </tr>
    <?php
        foreach($productos as $producto){
    ?>
        <tr>
            <td><?=$producto->getNombre()?></td>
            <td><?=$producto->getTalla()?></td>
            <td><?=$producto->getPrecio()?></td>
            <td><a href="?controller=producto&action=destroy&id=<?= $producto->getId(); ?>">Eliminar</a></td>
        </tr>
        <?php }?>
    </table>