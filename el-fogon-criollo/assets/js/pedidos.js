// Función para cargar los pedidos desde la API
function cargarPedidos() {
    fetch('?controller=api&action=obtenerPedidos')
        .then(response => response.json())
        .then(pedidos => {
            const ordersBody = document.getElementById('orders-body');
            ordersBody.innerHTML = ''; // Limpiar la tabla antes de cargar los nuevos datos

            pedidos.forEach(pedido => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${pedido.pedido_id}</td>
                    <td>${pedido.usuario}</td>
                    <td>${pedido.fecha}</td>
                    <td>${pedido.total}€</td>
                    <td>
                        <button class="btn btn-danger" onclick="eliminarPedido(${pedido.pedido_id})">Eliminar</button>
                    </td>
                `;
                ordersBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los pedidos:', error));
}

// Función para eliminar un pedido
function eliminarPedido(pedido_id) {
    fetch(`?controller=api&action=eliminarPedido&pedido_id=${pedido_id}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            cargarPedidos(); // Recargar la lista de pedidos
        })
        .catch(error => console.error('Error al eliminar el pedido:', error));
}

// Llamar a cargarPedidos() cuando se cargue la página
document.addEventListener('DOMContentLoaded', () => {
    cargarPedidos();
});
