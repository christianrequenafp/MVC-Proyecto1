

<div class="carrito-container">
    <h1>CARRITO</h1>
    <form action="?controller=carrito&action=updateCart" method="POST">
        <table class="carrito-tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($carrito)): ?>
                    <?php foreach ($carrito as $id => $producto): ?>
                        <tr>
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
        <table class="total-tabla">
            <tr>
                <td>Subtotal:</td>
                <td><?=number_format($subtotal, 2)?>€</td>
            </tr>
            <tr>
                <td>Envío:</td>
                <td><?=number_format($envio, 2)?>€</td>
            </tr>
            <tr>
                <td>Impuestos:</td>
                <td><?=number_format($impuestos, 2)?>€</td>
            </tr>
            <tr>
                <td><strong>Total:</strong></td>
                <td><strong><?=number_format($total, 2)?>€</strong></td>
            </tr>
        </table>
        <a href="pago.php" class="btn-pago">PROCEDER AL PAGO</a>
    </div>
</div>
