<?php
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$contrasena_conf = $_POST['contrasena_conf'];

if ($contrasena != $contrasena_conf) {
    echo "<script>alert('Las contraseñas no coinciden'); window.location.href='registro.php';</script>";
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "login");

// Verifica si el usuario ya existe
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");
if (mysqli_num_rows($verificar_usuario) > 0) {
    echo "<script>alert('El usuario ya está registrado'); window.location.href='registro.php';</script>";
    exit();
}

// Encripta la contraseña antes de guardarla
$contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

// Inserta un nuevo usuario en la base de datos
$insertar = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$contrasena_encriptada')";
if (mysqli_query($conexion, $insertar)) {
    echo "<script>alert('Registro exitoso'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Error al registrar'); window.location.href='registro.php';</script>";
}

mysqli_close($conexion);
?>
