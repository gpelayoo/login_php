<?php
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
session_start();
$_SESSION['usuario'] = $usuario;

$conexion = mysqli_connect("localhost", "root", "", "login");

$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    $usuario_data = mysqli_fetch_assoc($resultado);
    
    // Verifica la contraseña encriptada
    if (password_verify($contrasena, $usuario_data['contrasena'])) {
        header("Location: home.php");
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.location.href='index.php';</script>";
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
