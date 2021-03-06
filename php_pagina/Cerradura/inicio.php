<?php
session_start();
if(isset($_GET['exit'])){
  session_destroy();
}
if(isset($_GET['e'])){
  $error[3]="Datos incorrectos";

}

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


        </ul>
      </div>
    </nav>

    <div class="container p-0">
      <div class="row">


      <section class="resume-section p-3 p-lg-5 d-flex d-column">
        <div class="my-auto">
          <h1 class="mb-0">Cerradura
            <span class="text-primary">Iot</span>
          </h1>
          <div class="subheading mb-5">Facultad de Ingenieria-Informatica ·<br>
             La Plata · CerraduraIOt@gmail.com
          </div>
          <p class="mb-5"></p>
        </div>
      </section>
      <section class="resume-section p-3 p-lg-5 d-flex d-column">
        <div class="my-auto">
          <h2 class="mb-5">Iniciar Sesión</h2>
          <?php if(isset($error[3])){?>
              <div class="alert alert-danger">
                <p><?php echo"$error[3]" ?></p>
              </div><?php }?>
                      <form  id="postulante" method="get" action="verificacion.php">

                          <div style="margin-bottom: 25px; opacity:1;" class="input-group">
                            <span class=" input-group-addon" id="basic-addon1"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                            <input data-toggle="tooltip" title="Usuario/DNI" class="form-control" type="text"  name="usuario" value="" placeholder="Usuario/Dni" required="required" autofocus="autofocus" />
                           </div>

                          <div style="margin-bottom: 25px" class="input-group">
                            <span class=" input-group-addon" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input data-toggle="tooltip" title="Contraseña" class="form-control"class="alert alert-success"  type="password"
                            name="contra" required="required" autofocus="autofocus" />
                          </div>

                          <div style="margin-bottom: 25px" class="input-group">
                            <span class=" input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></i></span>
                            <input data-toggle="tooltip" title="N° de equipo" class="form-control"class="alert alert-success"
                            type="text"  name="equipo"   required="required" autofocus="autofocus" placeholder="N° de equipo" />
                          </div>
                          <input type="submit" name="submit" value="Ingresar" class="btn btn-warning pull-right boton" >
                          </form>



              </div>
      </section>
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
