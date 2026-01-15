<?php require "partials/header.php"; ?>
<?php require "partials/nav.php"; ?>

<table id="grocery-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Prijs</th>
            <th>Hoeveelheid</th>
            <th>Subtotaal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['name']?></td>
            <td class="price"><?= $product['price']?></td>
            <td><?= $product['quantity']?></td>
            <td class="price"><?= $product['price'] * $product['quantity']?></td>
        </tr>
        <?php endforeach;?>
        <tr>
            <td colspan="3"><strong>Totaal</strong></td>
            <td class="price"><?= $totalPrice;?></td>
        </tr>
    </tbody>
</table>

<?php require "partials/footer.php"; ?>