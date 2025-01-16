<?php
include("partials/_header.php");
?>

    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input required placeholder="Nombre" type="text" name="nombre" id="nombre" required>
        <label for="email">Email:</label>
        <input required placeholder="Email" type="email" name="email" id="email" required>
        <label for="password">Contraseña:</label>
        <input required placeholder="contraseña" type="password" name="password" id="password" required>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>