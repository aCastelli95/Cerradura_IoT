<?php
/* para conexion local */
if($_SERVER['HTTP_HOST'] == 'localhost'){
$localhost = "localhost";
$user = "root";
$pass = "";
$bd = "CerraduraIOT";
$root='http://localhost/Cerradura/';
$con = mysqli_connect($localhost,$user,$pass,$bd) or die();

}else {

$root='http://www2.ing.unlp.edu.ar/bienestar';
$con=mysqli_connect("localhost","bienestar","kxrbnWzq1ds9Sa","bienestar") or die("No se pudo conectar con el servidor");

}
?>
