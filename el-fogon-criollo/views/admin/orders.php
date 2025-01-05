<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Pedidos</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h2>Todos los Pedidos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= $pedido['pedido_id'] ?></td>
                <td><?= $pedido['usuario_id'] ?></td>
                <td><?= $pedido['fecha'] ?></td>
                <td><?= $pedido['total'] ?></td>
                <td><?= $pedido['estado'] ?></td>
                <td>
                    <button onclick="editOrder(<?= $pedido['pedido_id'] ?>)">Editar</button>
                    <button onclick="deleteOrder(<?= $pedido['pedido_id'] ?>)">Eliminar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="assets/js/adminPanel.js"></script>
</body>
</html>
