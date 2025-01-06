<div class="carrito-container">
    <h1>CARRITO</h1>
    <!-- Formulario para actualizar las cantidades del carrito -->
    <form action="?controller=carrito&action=updateCart" method="POST">
        <table class="carrito-tabla">
            <thead>
                <tr>
                    <!-- Encabezados de la tabla del carrito -->
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Verifica si el carrito tiene productos -->
                <?php if (!empty($carrito)): ?>
                    <!-- Recorre los productos en el carrito -->
                    <?php foreach ($carrito as $id => $producto): ?>
                        <tr>
                            <!-- Muestra el nombre y la imagen del producto -->
                            <td class="carrito-producto">
                                <img src="<?=$producto['imagen']?>" alt="<?=$producto['nombre']?>" class="carrito-imagen">
                                <?=$producto['nombre']?>
                            </td>
                            <td><?=number_format($producto['precio'], 2)?>€</td>
                            <td>
                                <input type="number" name="cantidades[<?=$id?>]" value="<?=$producto['cantidad']?>" min="1" class="carrito-cantidad">
                            </td>
                            <td><?=number_format($producto['precio'] * $producto['cantidad'], 2)?>€</td>
                            <td>
                                <a href="?controller=carrito&action=removeFromCart&id=<?=$id?>" class="btn-eliminar">X</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Mensaje si el carrito está vacío -->
                    <tr>
                        <td colspan="5" style="text-align: center;">El carrito está vacío.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button type="submit" class="btn-actualizar">ACTUALIZAR CARRITO</button>
    </form>

    <div class="carrito-total">
        <h2>TOTAL COMPRA</h2>
        <!-- Tabla con los detalles del total de la compra -->
        <table class="total-tabla">
            <tr>
                <td>Subtotal:</td>
                <td><?=number_format($subtotal, 2)?>€</td>
            </tr>
            <tr>
                <td>Envío:</td>
                <td>Envíos gratuitos!</td>
            </tr>
            <tr>
                <td>Impuestos:</td>
                <td>21 % del total</td>
            </tr>
            <tr>
                <td></td>
            <td><?=number_format($impuestos, 2)?>€</td>
            </tr>
            <tr>
                <td><strong>Total:</strong></td>
                <td><strong><?=number_format($total, 2)?>€</strong></td>
            </tr>
        </table>
        <!-- Formulario para proceder al pago -->
        <form method="post" action="?controller=carrito&action=checkout">
            <button type="submit" class="btn btn-pago">Proceder al Pago</button>
        </form>
    </div>
</div>
