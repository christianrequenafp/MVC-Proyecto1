<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Productos</title>
</head>
<body>
    <h1>Crear Productos</h1>

    <form action="?controller=producto&action=store" method="POST">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto"/>
        <select name="talla">
            <option value="XXL">XXL</option>
            <option value="XL">XL</option>
            <option value="L">L</option>
            <option value="M">M</option>
            <option value="S">S</option>
        </select>
        <input type="number" name="precio" id="precio" placeholder="Precio del producto"/>
        <button type="submit">Guardar</button>
    </form>
    
</body>
</html>