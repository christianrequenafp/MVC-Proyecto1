// Editar un pedido
function editOrder(orderId) {
    fetch(`?controller=admin&action=editOrder&id=${orderId}`)
        .then(response => response.json())
        .then(data => {
            alert(`Editando pedido: ${data.id}`);
            // Aquí actualizarías la vista con un formulario o similar
        })
        .catch(error => console.error('Error al editar el pedido:', error));
}

// Eliminar un pedido
function deleteOrder(orderId) {
    if (confirm("¿Estás seguro de que deseas eliminar este pedido?")) {
        fetch(`?controller=admin&action=deleteOrder&id=${orderId}`, {
            method: 'DELETE',
        })
            .then(response => response.json())
            .then(data => {
                alert('Pedido eliminado correctamente');
                // Aquí podrías eliminar la fila correspondiente del DOM
            })
            .catch(error => console.error('Error al eliminar el pedido:', error));
    }
}