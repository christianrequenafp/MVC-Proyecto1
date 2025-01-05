<!-- Vista de Usuarios -->
<h2>Todos los Usuarios</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario['usuario_id'] ?></td>
            <td><?= $usuario['nombre'] ?></td>
            <td><?= $usuario['email'] ?></td>
            <td><?= $usuario['rol'] ?></td>
            <td>
                <button onclick="editUser(<?= $usuario['usuario_id'] ?>)">Editar</button>
                <button onclick="deleteUser(<?= $usuario['usuario_id'] ?>)">Eliminar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
