<?php
include("partials/header.php");
?>

<main>
    <div id="login">
    <form action="" method="post">
        <label for="email">Email:</label>
        <input required placeholder="Email" type="email" name="email" id="email" required>
        <label for="password">Contraseña:</label>
        <input required placeholder="contraseña" type="password" name="password" id="password" required>
        <input type="submit" value="Acceder">
    </form>
    </div>
</main>
</body>
<?php
include("partials/footer.php");
?>
</html>