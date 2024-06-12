<?php
session_start();
if (!isset($_SESSION['ID'])) {
   header("location: Index.php");
}
$nombre = $_SESSION['Nombre'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--Font awesome icons-->
   <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
   <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
   <link href="assets/fontawesome/css/solid.css" rel="stylesheet">

   <!--Boostrap icons-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <!--Boostrap-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <!--Style css-->
   <link rel="stylesheet" href="css/recepcion.css">
   <!--DataTable-->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

   <title>Dashboard recepción</title>
</head>

<body>
   <nav class="navbar">
      <div class="container">
         <a class="title" href="dashboard_recep.php"><i class="fa-solid fa-receipt"></i> Recepción</a>

         <div class="dropdown ms-auto">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="bi bi-person-fill"></i> Recepcionista: <?php echo "$nombre"; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="include/logout.php">Cerrar Sesión</a></li>
            </ul>
         </div>
      </div>
   </nav>


   <div class="container my-3">
      <div class="row">
         <div class="bienvenida col-sm-12 col-mg-3 col-lg-3 col-xl-3 bg-white">
            <h1>¡Bienvenid@!</h1>
            <div class="row">
               <div class="col-sm-6 col-mg-6 col-lg-6 col-xl-6">
                  <em style="font-size: .9rem; font-weight: 700;">Si el paciente es nuevo da click aquí </em><br>
                  <i class="bi bi-arrow-down-circle"></i>
               </div>
               <div class="col-sm-6 col-mg-6 col-lg-6 col-xl-6">
                  <em style="font-size: .9rem; font-weight: 700;">Si el paciente ya habia venido da click aquí</em><br>
                  <i class="bi bi-arrow-down-circle"></i>
               </div>
            </div>

            <div class="row">
               <form class="form col-sm-6 col-mg-6 col-lg-6 col-xl-6" method="post" action="Nuevo_paciente.php">
                  <button class="btn solid" method="post" type="btn">
                     <i class="bi bi-person-fill-add"></i>
                     <a>Nuevo paciente</a>
                  </button>
               </form>
               <form class="form col-sm-6 col-mg-6 col-lg-6 col-xl-6" method="post" action="Pacientes_subsecuentes.php">
                  <button class="btn solid" method="post" type="btn">
                     <i class="bi bi-person-fill-add"></i>
                     <a>Paciente subsecuente</a>
                  </button>
               </form>
            </div>
         </div>

         <div class="tabla col-sm-12 col-mg-9 col-lg-9 col-xl-9 bg-white">
            <h2>Consultas del dia</h2>

            <table class="table table-striped table-dark" id="dataTable_pacientes">
               <thead>
                  <tr>
                     <th class="text-center align-middle">Nombre del paciente</th>
                     <th class="text-center align-middle">Servicio</th>
                     <th class="text-center align-middle">Visita</th>
                     <th class="text-center align-middle">Estatus</th>
                     <th class="text-center align-middle"></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  require "include/conexion.php";
                  date_default_timezone_set('America/Mexico_City');
                  $hoy = date("Y-m-d");
                  $sql = "SELECT * FROM consultas WHERE DATE(HoraFech) = '$hoy'";
                  $result = mysqli_query($mysqli, $sql);

                  while ($mostrar = mysqli_fetch_array($result)) {
                  ?>
                     <tr>
                        <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['NombreCom']; ?></td>
                        <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['TipoServ']; ?></td>
                        <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['Citade']; ?></td>
                        <td class="text-center align-middle">
                           <?php
                           $mostrar['Estatus'];

                           $valor_base_datos = $mostrar['Estatus']; // Obtener el valor de la base de datos

                           if ($valor_base_datos == 'Pendiente') {
                              echo '<span style="background-color: blue; border-radius:45px; padding:6px; font-size: .7rem;">' . $valor_base_datos . '</span>';
                           } elseif ($valor_base_datos == 'En Consulta') {
                              echo '<span style="background-color: green; border-radius:45px; padding:6px; font-size: .7rem;">' . $valor_base_datos . '</span>';
                           } elseif ($valor_base_datos == 'Atendido') {
                              echo '<span style="background-color: red; border-radius:45px; padding:6px; font-size: .7rem;">' . $valor_base_datos . '</span>';
                           } elseif ($valor_base_datos == 'URGENTE') {
                              echo '<span style="background-color: yellow; color: black; border-radius:45px; padding:6px; font-size: .7rem;">' . $valor_base_datos . '</span>';
                           }
                           ?>
                        </td>
                        <td class="text-center align-middle" style="font-size: .75rem;">
                           <form class="form" action="include/mostrar_reg.php" method="post">
                              <input type="hidden" name="id_registro" value="<?php echo $mostrar['ID_Registro']; ?>">
                              <input type="submit" class="btn solid" name="submit" value="Consultar" style="background-color: #9400d3; border-radius: 49px; ">
                           </form>
                        </td>
                     </tr>
                  <?php

                  }

                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>



   <!--Boostrap-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
   <!--JQuery-->
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <!--DataTable-->
   <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

   <script src="main.js"></script>
</body>

</html>