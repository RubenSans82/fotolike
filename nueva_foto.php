<?php
include("partials/header.php");
session_start();
if (!isset($_SESSION["idusuario"])) {
    header("Location: login.php");
}
if (isset($_POST["titulo"])) {

    include("conexiondb.php");
    $sql = "INSERT INTO fotos (titulo, foto, idusuario) VALUES (:titulo, :foto, :idusuario)";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(":titulo", $_POST["titulo"]);
    $stm->bindParam(":idusuario", $_SESSION["idusuario"]);
    $nombreFoto = $_FILES["foto"]["name"];
    $ruta = "fotos/" . $nombreFoto;
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta)) {
        $stm->bindParam(":foto", $ruta);
        $stm->execute();
        echo "Foto subida exitosamente";
        header("Location: like.php");
    }
    else {
        echo "Error al subir la foto";
    }
}
?>



<main>
    <form id="nuevaFoto" action="" method="post" enctype="multipart/form-data">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" id="titulo" required>
        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto" required>
        <input type="submit" value="Subir foto">

    </form>
</main>