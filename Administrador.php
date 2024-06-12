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
   <link rel="stylesheet" href="css/Administrador.css">
   <!--DataTable-->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

   <title>Dashboard recepción</title>
</head>

<body>
   <nav class="navbar">
      <div class="container">
         <a class="title" href="Administrador.php"><i class="bi bi-journal-minus"></i> Administrador</a>

         <div class="dropdown ms-auto">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="bi bi-person-fill"></i> Administrador: <?php echo "$nombre";
                                                                  $_SESSION['Nombre'] = $nombre; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="include/logout.php">Cerrar Sesión</a></li>
            </ul>
         </div>
      </div>
   </nav>


   <div class="container my-3">
      <div class="row">
         <div class="bienvenida col-sm-12 col-mg-4 col-lg-4 col-xl-4 bg-white">
            <h1 class="">Asignación:</h1>
            <form class="form row" method="post" action="include/Registro_med_recep.php">
               <div class="row">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="bi bi-postcard-fill"></i></span>
                     <div class="form-floating">
                        <input type="text" name="Nombre_Com" class="form-control" id="floatingInputGroup1" placeholder="Nombre Completo" required>
                        <label for="floatingInputGroup1">Nombre completo</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                     <div class="form-floating">
                        <select name="Puesto" class="form-select" id="puestoSelect" required onchange="toggleEspecialidadSelect()">
                           <option selected disabled value="">...</option>
                           <option value="1">Medico</option>
                           <option value="2">Recepcionista</option>
                        </select>
                        <label for="floatingSelectGrid">Puesto</label>
                     </div>
                     <script>
                        function toggleEspecialidadSelect() {
                           var puestoSelect = document.getElementById("puestoSelect");
                           var especialidadSelect = document.getElementById("especialidadSelect");

                           if (puestoSelect.value === "2") {
                              especialidadSelect.disabled = true;
                           } else {
                              especialidadSelect.disabled = false;
                           }
                        }
                     </script>
                  </div>
               </div>
               <div class="row">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                     <div class="form-floating">
                        <select name="Especialidad" class="form-select" id="especialidadSelect" required onchange="toggleEspecialidadSelect()">
                           <option selected disabled value="">...</option>
                           <option value="1">Optometrista</option>
                           <option value="2">Dental</option>
                           <option value="3">Pediatría</option>
                           <option value="4">Médico General</option>
                           <option value="5">Unidad de Cirugías</option>
                           <option value="6">Homeopatía</option>
                           <option value="7">Nutrición</option>
                        </select>
                        <label for="floatingSelectGrid"> Especialidad</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                     <div class="form-floating">
                        <input type="email" name="Mail" class="form-control" id="floatingInputGroup1" placeholder="Correo">
                        <label for="floatingInputGroup1">Correo</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                     <div class="form-floating">
                        <input type="text" name="User" class="form-control" id="floatingInputGroup1" placeholder="Usuario" required>
                        <label for="floatingInputGroup1">Usuario</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                     <div class="form-floating">
                        <input type="password" name="Password" class="form-control" id="floatingInputGroup1" placeholder="Contraseña" required>
                        <label for="floatingInputGroup1">Contraseña</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <button class="btn solid" method="submit" type="btn">
                     <i class="bi bi-person-fill-add"></i>
                     <a>Agregar</a>
               </div>
         </div>
         </form>

         <div class="tabla col-sm-12 col-mg-8 col-lg-8 col-xl-8 bg-white">
            <h2>Administrador de personal Médico</h2>

            <table class="table table-striped table-dark" id="dataTable_pacientes">
               <thead>
                  <tr>
                     <th class="text-center align-middle">Nombre</th>
                     <th class="text-center align-middle">Puesto</th>
                     <th class="text-center align-middle">Especialidad</th>
                     <th class="text-center align-middle">Usuario</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  require "include/conexion.php";

                  $sql = "SELECT * FROM sr_med";
                  $result = mysqli_query($mysqli, $sql);

                  while ($mostrar = mysqli_fetch_array($result)) {
                  ?>
                     <tr>
                        <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['Nombre']; ?></td>
                        <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['Puesto']; ?></td>
                        <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['Especialidad']; ?></td>
                        <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['Usuario']; ?></td>
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