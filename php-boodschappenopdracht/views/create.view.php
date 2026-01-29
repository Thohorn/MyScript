<?php require "partials/header.php"; ?>
<?php require "partials/nav.php"; ?>

<form method='POST' action="/create">
    <label for="name">Product naam:</label> <input type="text" id="name" name="name" value=<?= $_POST['name'] ?? '' ?>><br>
    <?php if (isset($errors['name'])) : ?>
        <p class='error'><?= $errors['name'] ?></p>
    <?php endif; ?>
    <label for="quanity">Hoeveelheid:</label><input type="number" id="quantity" name="quantity" value=<?= $_POST['quantity'] ?? '' ?>><br>
    <?php if (isset($errors['quantity'])) : ?>
        <p class='error'><?= $errors['quantity'] ?></p>
    <?php endif; ?>
    <label for="price">Prijs:</label><input type="number" step='0.01' id="price" name="price" value=<?= $_POST['price'] ?? '' ?>><br>
    <?php if (isset($errors['price'])) : ?>
        <p class='error'><?= $errors['price'] ?></p>
    <?php endif; ?>
    <input type="submit" value="Submit">
</form>

<?php require "partials/footer.php"; ?>