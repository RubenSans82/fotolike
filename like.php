<?php
include("conexiondb.php");
session_start();
if (!isset($_SESSION["idusuario"])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT fotos.*, COUNT(likes.id) as num_likes FROM fotos LEFT JOIN likes ON fotos.id = likes.idfoto GROUP BY fotos.id";
$fotos=$conexion->query($sql);

include("partials/header.php");
?>

<main>
    <section id="seccionFotos">
        <?php while($foto = $fotos->fetch()): ?>
        <article>
            <div class="contenedorImg">
                <img src="<?php echo $foto['foto']; ?>" alt="<?php echo $foto['titulo']; ?>">
            </div>
            <div class="textoLike">
                <h3><?php echo $foto['titulo']; ?></h3>
                <div>
                    <i class="fa-solid fa-heart" data-idfoto="<?php echo $foto['id']; ?>" data-liked="<?php echo userHasLiked($foto['id'], $_SESSION['idusuario']) ? 'true' : 'false'; ?>"></i>
                    <span><?php echo $foto['num_likes']; ?></span>
                </div>
            </div>
        </article>
        <?php endwhile; ?>
    </section>
</main>
<script src="js/index.js"></script>
</body>
</html>

<?php
function userHasLiked($idfoto, $idusuario) {
    global $conexion;
    $sql = "SELECT * FROM likes WHERE idfoto = ? AND idusuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idfoto, $idusuario]);
    return $stmt->rowCount() > 0;
}
?>