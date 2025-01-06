// Función para cargar los productos desde la API
function cargarProductos() {
    fetch('?controller=api&action=obtenerProductos')  // Cambia esta ruta según tu lógica
        .then(response => response.json())
        .then(productos => {
            const productsBody = document.getElementById('products-body');
            productsBody.innerHTML = ''; // Limpiar la tabla antes de cargar los nuevos datos

            productos.forEach(producto => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${producto.producto_id}</td>
                    <td>${producto.nombre}</td>
                    <td>${producto.descripcion}</td>
                    <td>${producto.tipo}</td>
                    <td>${producto.precio}€</td>
                    <td>
                        <button class="btn btn-warning" onclick="editarProducto(${producto.producto_id})">Editar</button>
                        <button class="btn btn-danger" onclick="eliminarProducto(${producto.producto_id})">Eliminar</button>
                    </td>
                `;
                productsBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los productos:', error));
}

// Función para eliminar un producto
function eliminarProducto(producto_id) {
    fetch(`?controller=api&action=eliminarProducto&producto_id=${producto_id}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            cargarProductos(); // Recargar la lista de productos
        })
        .catch(error => console.error('Error al eliminar el producto:', error));
}

// Llamar a cargarProductos() cuando se cargue la página
document.addEventListener('DOMContentLoaded', () => {
    cargarProductos();
});
