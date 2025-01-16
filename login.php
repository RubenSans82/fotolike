<?php
include("partials/header.php");
if (isset($_POST["email"])) {
    include("conexiondb.php");
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(":email", $_POST["email"]);
    $stm->execute();
    $usuario = $stm->fetch(PDO::FETCH_ASSOC);
    if ($usuario) {
        if (password_verify($_POST["password"], $usuario["password"])) {
            session_start();
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["idusuario"] = $usuario["id"];
            header("Location: nueva_foto.php");

        } else {
            $errorPass = "Contraseña incorrecta";
        }
    } else {
        $errorUser = "Usuario no encontrado";
    }
}
?>

<main>
    
    <form action="" id="login" method="post">
        <label for="email">Email:</label>
        <input required placeholder="Email" type="email" name="email" id="email" required>
        <label for="password">Contraseña:</label>
        <input required placeholder="contraseña" type="password" name="password" id="password" required>
        <input type="submit" value="Acceder">
        <?php
    if (isset ($errorPass)) {
        echo "". $errorPass ."";
    }
    if (isset ($errorUser)) {
        echo "". $errorUser ."";
    }
    ?>
    </form>

    
</main>
</body>
<?php
include("partials/footer.php");
?>
</html>