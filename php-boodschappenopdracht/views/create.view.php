<?php require "partials/header.php"; ?>
<?php require "partials/nav.php"; ?>

<form>
    <label for="name">Product naam:</label> <input type="text" id="name" name="name"><br>
    <label for="quanity">Hoeveelheid:</label><input type="number" id="quanity" name="quanity"><br>
    <label for="price">Prijs:</label><input type="number" id="price" name="price"><br>
    <input type="submit" value="Submit">
</form> 

<?php require "partials/footer.php"; ?>