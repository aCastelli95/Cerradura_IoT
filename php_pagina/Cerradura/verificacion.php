<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Cerradura/conexion.php");
if(isset($_GET['submit'])){
$usuario=$_GET['usuario'];
$pass=$_GET['contra'];
$equipo=$_GET['equipo'];
$sql="SELECT * FROM Usuarios WHERE Usuario='$usuario' AND password='$pass' AND id_equipo='$equipo'";
$consulta=mysqli_query($con,$sql);
$array=mysqli_fetch_array($consulta,MYSQLI_ASSOC);
if(mysqli_num_rows($consulta) == 1){
  
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $usuario;
    $_SESSION['id_equipo'] = $equipo;
    $_SESSION['admin'] = $array['admin'];

  header("location: ./estados.php");
}else {
  header("location: ./inicio.php?e=1");

}
}
?>
