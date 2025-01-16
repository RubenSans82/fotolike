<?php
include("conexiondb.php");
session_start();

if (!isset($_SESSION["idusuario"])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$idfoto = $data['idfoto'];
$idusuario = $_SESSION['idusuario'];

if (!userHasLiked($idfoto, $idusuario)) {
    $sql = "INSERT INTO likes (idfoto, idusuario) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idfoto, $idusuario]);

    $sql = "SELECT COUNT(*) as num_likes FROM likes WHERE idfoto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idfoto]);
    $num_likes = $stmt->fetchColumn();

    echo json_encode(['success' => true, 'num_likes' => $num_likes]);
} else {
    echo json_encode(['success' => false, 'message' => 'User already liked this photo']);
}

function userHasLiked($idfoto, $idusuario) {
    global $conexion;
    $sql = "SELECT * FROM likes WHERE idfoto = ? AND idusuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idfoto, $idusuario]);
    return $stmt->rowCount() > 0;
}
?>
