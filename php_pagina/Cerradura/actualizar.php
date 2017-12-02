<?php if(session_start()){


  require_once($_SERVER['DOCUMENT_ROOT']."/Cerradura/conexion.php");
  $equipo=$_SESSION['id_equipo'];
  $usuario=$_SESSION['username'];
  $sql="SELECT estado FROM Estado WHERE id_equipo='$equipo'";
  $consulta=mysqli_query($con,$sql);

  if(mysqli_num_rows($consulta)== 1){
    $array=mysqli_fetch_array($consulta,MYSQLI_ASSOC);
    if($array['estado']=='Abierta'){
      $nuevoestado="Cerrada";
    }else {
      $nuevoestado="Abierta";
    }
    $fecha=date("Y-m-d H:i:s");
    $sql1="UPDATE Estado SET estado='$nuevoestado',TIEMPO='$fecha',UltimoUsuario='$usuario' WHERE id_equipo='$equipo'";
    $consulta2=mysqli_query($con,$sql1);
    if($consulta2){
    header("location: ./estados.php");
    }
  }
  }

?>
