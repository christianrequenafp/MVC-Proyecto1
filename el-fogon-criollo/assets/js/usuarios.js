// Función para cargar los usuarios desde la API
function cargarUsuarios() {
    fetch('?controller=api&action=obtenerUsuarios')  // Cambia esta ruta según tu lógica
        .then(response => response.json())
        .then(usuarios => {
            const usersBody = document.getElementById('users-body');
            usersBody.innerHTML = ''; // Limpiar la tabla antes de cargar los nuevos datos

            usuarios.forEach(usuario => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${usuario.usuario_id}</td>
                    <td>${usuario.nombre}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.rol}</td>
                    <td>
                        // <button class="btn btn-warning" onclick="editarUsuario(${usuario.usuario_id})">Editar</button>
                        <button class="btn btn-warning" onclick="openEditModal(${usuario.usuario_id})">Editar</button>
                        <button class="btn btn-danger" onclick="eliminarUsuario(${usuario.usuario_id})">Eliminar</button>
                    </td>
                `;
                usersBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los usuarios:', error));
}

// Función para abrir el modal de edición y cargar los datos del usuario
function openEditModal(usuarioId) {
    // Hacer una solicitud AJAX para obtener los datos del usuario
    fetch(`?controller=api&action=editarUsuario&usuarioId=${usuarioId}`)
        .then(response => response.json())
        .then(data => {
            // Rellenar los campos con los datos del usuario
            document.getElementById('editUserId').value = data.usuario_id;
            document.getElementById('editUserName').value = data.nombre;
            document.getElementById('editUserEmail').value = data.email;
            document.getElementById('editUserRole').value = data.rol;

            // Mostrar el formulario
            document.getElementById('editUserModal').style.display = 'block';
        })
        .catch(error => console.error('Error al cargar los datos del usuario:', error));
}

// Función para cerrar el modal de edición
function closeEditModal() {
    document.getElementById('editUserModal').style.display = 'none';
}

// Función para manejar la edición del usuario
document.getElementById('editUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const usuarioId = document.getElementById('editUserId').value;
    const nombre = document.getElementById('editUserName').value;
    const email = document.getElementById('editUserEmail').value;
    const rol = document.getElementById('editUserRole').value;

    const data = {
        usuario_id: usuarioId,
        nombre: nombre,
        email: email,
        rol: rol
    };

    // Enviar los datos modificados al servidor
    fetch('/api/editarUsuario', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            alert('Usuario actualizado correctamente');
            closeEditModal();
            // Aquí podrías hacer algo para actualizar la lista de usuarios sin recargar la página
        } else {
            alert('Error al actualizar el usuario');
        }
    })
    .catch(error => {
        console.error('Error al actualizar el usuario:', error);
        alert('Error al actualizar el usuario');
    });
});

function editarUsuario(usuarioId, nombre, email) {
    const data = {
        usuario_id: usuarioId,
        nombre: nombre,
        email: email
    };

    fetch('?controller=api&action=editarUsuario', { // Reemplaza con la ruta correcta de tu API
        method: 'PUT',  // o 'PATCH' dependiendo de tu preferencia
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status === 'success') {
            alert('Usuario actualizado correctamente');
        } else {
            alert('Error al actualizar usuario');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


// Función para eliminar un usuario
function eliminarUsuario(usuario_id) {
    if (!confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        return; // Detener si el usuario cancela la acción
    }else{
        fetch(`?controller=api&action=eliminarUsuario&usuario_id=${usuario_id}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            cargarUsuarios(); // Recargar la lista de usuarios
            // Logger::log("Usuario eliminado: ID $usuario_id");
        })
        .catch(error => console.error('Error al eliminar el usuario:', error));
    }
}


// Llamar a cargarUsuarios() cuando se cargue la página
document.addEventListener('DOMContentLoaded', () => {
    cargarUsuarios();
});

// Manejar el formulario de crear usuario
document.getElementById('form-create-user').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío predeterminado del formulario

    // Obtener los datos del formulario
    const nombre = document.getElementById('usuarioNombre').value;
    const email = document.getElementById('usuarioEmail').value;
    const contrasena = document.getElementById('usuarioContrasena').value;

    // Crear un objeto con los datos del nuevo usuario
    const nuevoUsuario = {
        nombre: nombre,
        email: email,
        contrasena: contrasena
    };

    // Enviar los datos del nuevo usuario al servidor
    fetch('?controller=api&action=crearUsuario', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(nuevoUsuario) // Convertimos el objeto a JSON
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Usuario creado exitosamente');
            // Opcional: Puedes agregar lógica aquí para actualizar la lista de usuarios sin recargar la página
        } else {
            alert('Hubo un error al crear el usuario');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al crear el usuario');
    });
});

