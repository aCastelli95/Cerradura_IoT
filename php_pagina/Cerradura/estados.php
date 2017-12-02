<?php

  session_start();
  require_once($_SERVER['DOCUMENT_ROOT']."/Cerradura/conexion.php");

  $equipo=$_SESSION['id_equipo'];
  $sql="SELECT * FROM Estado WHERE id_equipo='$equipo'";
  $consulta=mysqli_query($con,$sql);
  $array=mysqli_fetch_array($consulta,MYSQLI_ASSOC);
  if($array['estado']=='Abierta'){
    $estado="Cerrar";
    $ultimoestado="Abierta";
  }else{
    $estado="Abrir";
    $ultimoestado="Cerrada";
  }


  // CODIGO DE GUARDADO DE NUEVO USUARIO

  if(isset($_POST['submit'])){
    $nombre=$_POST['usuario'];
    $contra=$_POST['contra'];
    $tipo=$_POST['tipo'];
    $sql2="INSERT INTO Usuarios (Usuario,password,id_equipo,admin)
    VALUES ('$nombre','$contra','$equipo','$tipo')";
    $consulta2=mysqli_query($con,$sql2);

  }

  $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
  socket_connect($socket, '192.168.4.1',3000);
  socket_send ($socket ,"ab",3,0);
  socket_recv($socket, $buffer, 11,0);
  socket_close($socket);
  var_dump($buffer);
  

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title href="img/cerradura.png">Cerradura IOT</title>
    <link rel="shortcut icon" href="img/cerradura.png"/>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/devicons/css/devicons.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resume.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/profile2.jpg" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <?php if($_SESSION['admin'] == 's'){ ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#nuevousuario" data-toggle="modal" data-target="#myModal" > Nuevo usuario  <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></a>
            </li>
            <?php }?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/Cerradura/inicio.php"> Salir  <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a>
            </li>
        </ul>
      </div>
    </nav>

    <div class="container p-0">

      <div class="row">

        <?php  if(isset($consulta2)){?>
            <script>alert("Usuario guardado correctamente")</script>
          <?php }?>
      <section class="resume-section p-3 p-lg-5 d-flex d-column">
        <div class="my-auto col-sm-6 ">

            <!-- PANEL DATOS 1 -->
            <h1 class="mb-0">Estado
              <span class="text-primary">Actual</span>
            </h1>

                  <table class="table">
                      <thead>
                        <tr>
                          <th>ESTADO</th>
                          <th>ACCIÓN</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="font-size:20px;"><?php echo $array['estado'] ?>
                            <td><button type="submit"  onclick="location.href='actualizar.php?a=1'" class="btn btn-irenic boton" style="width:150px;height:40px;"
                              name="button"><?php echo $estado?></button></td>

                        </tr>

                      </tbody>
                    </table>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <div class="my-auto col-sm-6 ">
          <h1 class="mb-0">Ultimos
            <span class="text-primary">Estados</span>
          </h1>
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ESTADO</th>
                      <th>FECHA</th>
                      <th>USUARIO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td style="font-size:20px;"><?php echo $ultimoestado?></td>

                      <td style="font-size:20px;"><?php echo $array['TIEMPO']?> </td>
                      <td style="font-size:20px;"><?php echo $array['UltimoUsuario']?></td>
                    </tr>

                  </tbody>
                </table>

      </section>
      </div>
    </div>
    <div class="container">
  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Nuevo Usuario</h4>
        </div>
        <div class="modal-body">
          <form  id="postulante" method="post" action="estados.php">

              <div style="margin-bottom: 25px; opacity:1;" class="input-group">
                <span class=" input-group-addon" id="basic-addon1"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                <input data-toggle="tooltip" title="Usuario" class="form-control" type="text"  name="usuario" value="" placeholder="Usuario" required="required" autofocus="autofocus" />
               </div>

              <div style="margin-bottom: 25px" class="input-group">
                <span class=" input-group-addon" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                <input data-toggle="tooltip" title="Contraseña" class="form-control"class="alert alert-success"  type="password"
                name="contra" required="required" autofocus="autofocus" />
              </div>
              <div style="margin-bottom: 25px" class="input-group">
                <span class=" input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></i></span>
                <select class="input-group-addon" name="tipo">
                  <option value="" selected disabled hidden>Tipo de usuario</option>
                  <option value="s">Administrador</option>
                  <option value="n">Usuario</option>

                </select>
              </div>
              <input type="submit" name="submit" value="Guardar" class="btn btn-warning pull-right boton" >
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>

  </body>
  <style media="screen">
    .boton{
      width:150px;
      background: linear-gradient(to bottom, #bd5d38, #ffffff);
    }
    .boton:hover{
      background:#bd5d38;

    }
  </style>
</html>
