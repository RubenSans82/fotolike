<?php
if (isset($_POST["nombre"])) {
    include("conexiondb.php");
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(":nombre", $_POST["nombre"]);
    $stm->bindParam(":email", $_POST["email"]);
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stm->bindParam(":password", $hashed_password);
    $stm->execute();
    echo "Registro insertado exitosamente";
    header("Location: login.php"); // Redirigir a la página de login


}
include("partials/header.php");
?>

<main>
    
    <form action="" id="registro" method="post">
        <label for="nombre">Nombre:</label>
        <input required placeholder="Nombre" type="text" name="nombre" id="nombre" required>
        <label for="email">Email:</label>
        <input required placeholder="Email" type="email" name="email" id="email" required>
        <label for="password">Contraseña:</label>
        <input required placeholder="contraseña" type="password" name="password" id="password" required>
        <input type="submit" value="Registrarse">
    </form>
    
</main>
</body>
<?php
include("partials/footer.php");
?>
</html>