<?php
session_start();
if (!isset($_SESSION['ID'])) {
   header("location: Index.php");
}
//variable para el nombre del medico
$nombre = $_SESSION['Nombre'];
//variables para autorelleno del expedieente del paciente
$id_registro = $_SESSION['id_registro'];
$NombreCom = $_SESSION['nombre_paciente'];
//variables de bloqueo de cuestionario
$close1 = $_SESSION['close1'];
$close2 = $_SESSION['close2'];
$close3 = $_SESSION['close3'];
$close4 = $_SESSION['close4'];
$close5 = $_SESSION['close5'];
$close6 = $_SESSION['close6'];
$close7 = $_SESSION['close7'];
$close8 = $_SESSION['close8'];
$close9 = $_SESSION['close9'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--Font awesome icons-->
   <link href="../../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
   <link href="../../assets/fontawesome/css/brands.css" rel="stylesheet">
   <link href="../../assets/fontawesome/css/solid.css" rel="stylesheet">

   <!--Boostrap icons-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <!--Boostrap-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <!--Style css-->
   <link rel="stylesheet" href="css/Questionnaire_pacient_medgen.css">

   <style>
      /* Estilo para ocultar el input */
      .hidden-input {
         width: 0;
         opacity: 0;
         transition: width 0.3s, opacity 0.3s;
      }

      /* Estilo para mostrar el input */
      .visible-input {
         width: 100%;
         opacity: 1;
         transition: width 0.3s, opacity 0.3s;
      }

      .hidden-div {
         height: 0;
         opacity: 0;
         transition: height 0.1s, opacity 0.4s;
      }

      .visible-div {
         height: 100%;
         opacity: 1;
         transition: height 0.4s, opacity 0.4s;
      }
   </style>

   <title>Edición Consulta de Médico General</title>
</head>

<body>
   <!--Barra de navegación-->
   <nav class="navbar">
      <div class="container">
         <a class="title" href="dashboard_medico.php"><i class="bi bi-heart-pulse-fill"></i> Atención médica</a>
         <div class="dropdown ms-auto">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="bi bi-person-fill"></i> Médico: <?php echo "$nombre";
                                                         $_SESSION['Nombre'] = $nombre; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="../../include/logout.php">Cerrar Sesión</a></li>
            </ul>
         </div>
      </div>
   </nav>
   <!--Contenedor del formulario-->
   <div class="container my-3">
      <div class="row">
         <div class="formulario  col-sm-4 col-md-6 col-lg-12 col-xl-12 bg-white">
            <div class="total">
               <h2>Interrogatorio</h2>
               <div class="row">
                  <div class="princ col-sm-12 col-md-6 col-lg-3 col-xl-3">
                     <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                        <div class="form-floating">
                           <input type="text" class="form-control" id="floatingInputGroup1" placeholder="N° de Paciente" value="<?php echo $id_registro;
                                                                                                                                 $_SESSION['id_registro'] = $id_registro; ?>">
                           <label for="floatingInputGroup1">N° de Paciente</label>
                        </div>
                     </div>
                  </div>
                  <div class="princ col-sm-12 col-md-6 col-lg-6 col-xl-6">
                     <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                        <div class="form-floating">
                           <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Nombre del Paciente" value="<?php echo $NombreCom; ?>" disabled>
                           <label for="floatingInputGroup1">Nombre del expediente</label>
                        </div>
                     </div>
                  </div>
                  <div class="imprimir col-sm-12 col-md-6 col-lg-3 col-xl-3">
                     <form class="return" method="post" action="../../dashboard_medico.php">
                        <button class="btn solid" method="post" type="submit">
                           <a>Regresar</a>
                           <i class="fa-solid fa-rotate-left"></i>
                        </button>
                     </form>
                     <button class="btn solid icon-button" onclick="abrirPDF(<?php echo $id_registro; ?>)">
                        <span class="button-text">Imprimir</span>
                        <i class="bi bi-printer-fill button-icon"></i>
                     </button>
                     <script>
                        function abrirPDF(id2) {
                           var ventanaAncho = 800;
                           var ventanaAlto = 600;
                           var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                           var ventanaArriba = (screen.height - ventanaAlto) / 2;
                           window.open("include_questions/Reporte.php?id=" + id2, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                        }
                     </script>
                  </div>
               </div>
               <div class="accordion <?php if ($close1 === 'disabled') {
                                          echo $close1;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Signos Vitales-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           Signos Vitales
                        </button>
                     </h2>
                     <div id="collapseOne" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form class="form" method="post" action="include_questions/items_signosvit_edit.php">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM signosvitales WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <!--1er row-->
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Presión <br>Arterial</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="presionart" class="form-control visible-input" id="presionart" style="height: 65px;" value="<?php echo $mostrar['PresionArt']; ?>">
                                          </div>
                                       </div>
                                       <!-- Agrega el código JavaScript para mostrar/ocultar el input al hacer clic en el icono -->
                                       <script>
                                          const icon = document.getElementById('toggle-icon');
                                          const input = document.getElementById('presionart');

                                          let isInputVisible = false;
                                          icon.addEventListener('click', () => {
                                             if (isInputVisible) {
                                                input.classList.remove('visible-input');
                                                input.classList.add('hidden-input');
                                             } else {
                                                input.classList.remove('hidden-input');
                                                input.classList.add('visible-input');
                                                input.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible = !isInputVisible;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon2">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Saturación de<br>Oxígeno</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="satuoxig" class="form-control visible-input" id="satuoxig" style="height: 65px;" value="<?php echo $mostrar['SaturacionOx']; ?>">
                                          </div>
                                       </div>
                                       <!-- Agrega el código JavaScript para mostrar/ocultar el input al hacer clic en el icono -->
                                       <script>
                                          const icon2 = document.getElementById('toggle-icon2');
                                          const input2 = document.getElementById('satuoxig');

                                          let isInputVisible2 = false;
                                          icon2.addEventListener('click', () => {
                                             if (isInputVisible2) {
                                                input2.classList.remove('visible-input');
                                                input2.classList.add('hidden-input');
                                             } else {
                                                input2.classList.remove('hidden-input');
                                                input2.classList.add('visible-input');
                                                input2.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible2 = !isInputVisible2;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon3">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Freccuencia<br>Cardiaca</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="frecuenciacard" class="form-control visible-input" id="frecuenciacard" style="height: 65px;" value="<?php echo $mostrar['FrecuenciaCar']; ?>">
                                          </div>
                                       </div>
                                       <script>
                                          const icon3 = document.getElementById('toggle-icon3');
                                          const input3 = document.getElementById('frecuenciacard');

                                          let isInputVisible3 = false;
                                          icon3.addEventListener('click', () => {
                                             if (isInputVisible3) {
                                                input3.classList.remove('visible-input');
                                                input3.classList.add('hidden-input');
                                             } else {
                                                input3.classList.remove('hidden-input');
                                                input3.classList.add('visible-input');
                                                input3.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible3 = !isInputVisible3;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon4">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Peso<br>Actual</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="peso" class="form-control visible-input" id="peso" style="height: 65px;" value="<?php echo $mostrar['PesoActual']; ?>">
                                          </div>
                                       </div>
                                       <script>
                                          const icon4 = document.getElementById('toggle-icon4');
                                          const input4 = document.getElementById('peso');

                                          let isInputVisible4 = false;
                                          icon4.addEventListener('click', () => {
                                             if (isInputVisible4) {
                                                input4.classList.remove('visible-input');
                                                input4.classList.add('hidden-input');
                                             } else {
                                                input4.classList.remove('hidden-input');
                                                input4.classList.add('visible-input');
                                                input4.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible4 = !isInputVisible4;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <!--2do row-->
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon5">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Tempetarura</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="temperatura" class="form-control visible-input" id="temperatura" style="height: 62px;" value="<?php echo $mostrar['Temperatura']; ?>">
                                          </div>
                                       </div>
                                       <script>
                                          const icon5 = document.getElementById('toggle-icon5');
                                          const input5 = document.getElementById('temperatura');

                                          let isInputVisible5 = false;
                                          icon5.addEventListener('click', () => {
                                             if (isInputVisible5) {
                                                input5.classList.remove('visible-input');
                                                input5.classList.add('hidden-input');
                                             } else {
                                                input5.classList.remove('hidden-input');
                                                input5.classList.add('visible-input');
                                                input5.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible5 = !isInputVisible5;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon6">
                                             <label for="" style="font-size: 15px; color:white; width: 90px;">Talla</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="talla" class="form-control visible-input" id="talla" style="height: 62px;" value="<?php echo $mostrar['Talla']; ?>">
                                          </div>
                                       </div>
                                       <script>
                                          const icon6 = document.getElementById('toggle-icon6');
                                          const input6 = document.getElementById('talla');

                                          let isInputVisible6 = false;
                                          icon6.addEventListener('click', () => {
                                             if (isInputVisible6) {
                                                input6.classList.remove('visible-input');
                                                input6.classList.add('hidden-input');
                                             } else {
                                                input6.classList.remove('hidden-input');
                                                input6.classList.add('visible-input');
                                                input6.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible6 = !isInputVisible6;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon7">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Freccuencia<br>Respiratoria</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="frecresp" class="form-control visible-input" id="frecresp" style="height: 65px;" value="<?php echo $mostrar['FrecuenciaRes']; ?>">
                                          </div>
                                       </div>
                                       <script>
                                          const icon7 = document.getElementById('toggle-icon7');
                                          const input7 = document.getElementById('frecresp');

                                          let isInputVisible7 = false;
                                          icon7.addEventListener('click', () => {
                                             if (isInputVisible7) {
                                                input7.classList.remove('visible-input');
                                                input7.classList.add('hidden-input');
                                             } else {
                                                input7.classList.remove('hidden-input');
                                                input7.classList.add('visible-input');
                                                input7.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible7 = !isInputVisible7;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon8">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Indece<br>Masa Corp.</label>
                                          </span>
                                          <div class="form-floating">
                                             <input type="text" name="indmasa" class="form-control visible-input" id="indmasa" style="height: 65px;" value="<?php echo $mostrar['IndiceMasaCorp']; ?>">
                                          </div>
                                       </div>
                                       <script>
                                          const icon8 = document.getElementById('toggle-icon8');
                                          const input8 = document.getElementById('indmasa');

                                          let isInputVisible8 = false;
                                          icon8.addEventListener('click', () => {
                                             if (isInputVisible8) {
                                                input8.classList.remove('visible-input');
                                                input8.classList.add('hidden-input');
                                             } else {
                                                input8.classList.remove('hidden-input');
                                                input8.classList.add('visible-input');
                                                input8.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible8 = !isInputVisible8;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                           </form>
                        <?php
                              }
                        ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion <?php if ($close2 === 'disabled') {
                                          echo $close2;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Antecedentes Heredo Familiares-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                           Antecedentes Heredo Familiares
                        </button>
                     </h2>
                     <div id="collapseTwo" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_antecedentesfam_edit.php" class="form" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM heredofam WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon9" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Oncológico</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea type="text" name="oncologico" class="form-control visible-input" id="onco" style="height: 65px; resize: none; border-color: #3C3B3F;"><?php echo $mostrar['Oncologico']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon9 = document.getElementById('toggle-icon9');
                                          const input9 = document.getElementById('onco');

                                          let isInputVisible9 = false;
                                          icon9.addEventListener('click', () => {
                                             if (isInputVisible9) {
                                                input9.classList.remove('visible-input');
                                                input9.classList.add('hidden-input');
                                             } else {
                                                input9.classList.remove('hidden-input');
                                                input9.classList.add('visible-input');
                                                input9.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible9 = !isInputVisible9;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon10" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Alérgicos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea type="text" name="alergicos" class="form-control visible-input" id="aler" style="height: 65px; resize: none; border-color: #3C3B3F;"><?php echo $mostrar['Alergicos']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon10 = document.getElementById('toggle-icon10');
                                          const input10 = document.getElementById('aler');

                                          let isInputVisible10 = false;
                                          icon10.addEventListener('click', () => {
                                             if (isInputVisible10) {
                                                input10.classList.remove('visible-input');
                                                input10.classList.add('hidden-input');
                                             } else {
                                                input10.classList.remove('hidden-input');
                                                input10.classList.add('visible-input');
                                                input10.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible10 = !isInputVisible10;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon11" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Hipertensivos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea type="text" name="hipertensivos" class="form-control visible-input" id="hiperten" style="height: 65px; resize: none; border-color: #3C3B3F;"><?php echo $mostrar['Hipertensivos']; ?></textarea>

                                          </div>
                                       </div>
                                       <script>
                                          const icon11 = document.getElementById('toggle-icon11');
                                          const input11 = document.getElementById('hiperten');

                                          let isInputVisible11 = false;
                                          icon11.addEventListener('click', () => {
                                             if (isInputVisible11) {
                                                input11.classList.remove('visible-input');
                                                input11.classList.add('hidden-input');
                                             } else {
                                                input11.classList.remove('hidden-input');
                                                input11.classList.add('visible-input');
                                                input11.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible11 = !isInputVisible11;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon12" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Diabéticos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea type="text" name="diabeticos" class="form-control visible-input" id="diabeticos" style="height: 65px; resize: none; border-color: #3C3B3F;"><?php echo $mostrar['Diabeticos']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon12 = document.getElementById('toggle-icon12');
                                          const input12 = document.getElementById('diabeticos');

                                          let isInputVisible12 = false;
                                          icon12.addEventListener('click', () => {
                                             if (isInputVisible12) {
                                                input12.classList.remove('visible-input');
                                                input12.classList.add('hidden-input');
                                             } else {
                                                input12.classList.remove('hidden-input');
                                                input12.classList.add('visible-input');
                                                input12.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible12 = !isInputVisible12;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon13" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Cardivasculares</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea type="text" name="cardio" class="form-control visible-input" id="cardiovas" style="height: 65px; resize: none; border-color: #3C3B3F;"><?php echo $mostrar['Cardiovasculares']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon13 = document.getElementById('toggle-icon13');
                                          const input13 = document.getElementById('cardiovas');

                                          let isInputVisible13 = false;
                                          icon13.addEventListener('click', () => {
                                             if (isInputVisible13) {
                                                input13.classList.remove('visible-input');
                                                input13.classList.add('hidden-input');
                                             } else {
                                                input13.classList.remove('hidden-input');
                                                input13.classList.add('visible-input');
                                                input13.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible13 = !isInputVisible13;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon14" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Otros</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea type="text" name="otros" class="form-control visible-input" id="otros" style="height: 65px; resize: none; border-color: #3C3B3F;"><?php echo $mostrar['Otros']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon14 = document.getElementById('toggle-icon14');
                                          const input14 = document.getElementById('otros');

                                          let isInputVisible14 = false;
                                          icon14.addEventListener('click', () => {
                                             if (isInputVisible14) {
                                                input14.classList.remove('visible-input');
                                                input14.classList.add('hidden-input');
                                             } else {
                                                input14.classList.remove('hidden-input');
                                                input14.classList.add('visible-input');
                                                input14.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible14 = !isInputVisible14;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <!--Segunda fila-->
                                 <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon15" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Observaciones</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="observaciones" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="observa1"><?php echo $mostrar['Observaciones']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon15 = document.getElementById('toggle-icon15');
                                          const input15 = document.getElementById('observa1');

                                          let isInputVisible15 = false;
                                          icon15.addEventListener('click', () => {
                                             if (isInputVisible15) {
                                                input15.classList.remove('visible-input');
                                                input15.classList.add('hidden-input');
                                             } else {
                                                input15.classList.remove('hidden-input');
                                                input15.classList.add('visible-input');
                                                input15.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible15 = !isInputVisible15;
                                          });
                                       </script>
                                    </div>
                                 </div>

                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion <?php if ($close3 === 'disabled') {
                                          echo $close3;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Antecedentes Personales Patológicos-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethree" aria-expanded="true" aria-controls="collapsethree">
                           Antecedentes Personales Patológicos
                        </button>
                     </h2>
                     <div id="collapsethree" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_ante_patologicos_edit.php" class="form tres" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM personalespat WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <!--Primera Fila-->
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon16" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Tabaquismo</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="tabaquismo" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="tabaquismo"><?php echo $mostrar['Tabaquismo']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon16 = document.getElementById('toggle-icon16');
                                          const input16 = document.getElementById('tabaquismo');

                                          let isInputVisible16 = false;
                                          icon16.addEventListener('click', () => {
                                             if (isInputVisible16) {
                                                input16.classList.remove('visible-input');
                                                input16.classList.add('hidden-input');

                                             } else {
                                                input16.classList.remove('hidden-input');
                                                input16.classList.add('visible-input');
                                                input16.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible16 = !isInputVisible16;
                                          });
                                       </script>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon17" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Tabaquismo<br>Pasivo</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="tabpas" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="tabpas"><?php echo $mostrar['Tabpasivo']; ?></textarea>
                                          </div>
                                       </div>
                                       <script>
                                          const icon17 = document.getElementById('toggle-icon17');
                                          const input17 = document.getElementById('tabpas');

                                          let isInputVisible17 = false;
                                          icon17.addEventListener('click', () => {
                                             if (isInputVisible17) {
                                                input17.classList.remove('visible-input');
                                                input17.classList.add('hidden-input');
                                             } else {
                                                input17.classList.remove('hidden-input');
                                                input17.classList.add('visible-input');
                                                input17.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible17 = !isInputVisible17;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="row visible-div" id="div">
                                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Inicio</label>
                                          </span>
                                          <div class="form-floating">
                                             <input name="inicio" type="text" class="form-control" id="floatingInputGroup1" value="<?php echo $mostrar['Inicio']; ?>">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Cantidad</label>
                                          </span>
                                          <div class="form-floating">
                                             <input name="cantidad" type="text" class="form-control" id="floatingInputGroup1" value="<?php echo $mostrar['Cantidad']; ?>">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">
                                             <label for="" style="font-size: 15px; color: white; width: 90px; border-color: #3C3B3F;"> Ex-Tabaquismo</label>
                                          </span>
                                          <div class="form-floating">
                                             <input name="ext_tab" type="text" class="form-control" id="floatingInputGroup1" value="<?php echo $mostrar['ExTabaquismo']; ?>">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon21" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Hepáticos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="hepaticos" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="hepaticos"><?php echo $mostrar['Hepatico']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon21 = document.getElementById('toggle-icon21');
                                             const input21 = document.getElementById('hepaticos');

                                             let isInputVisible21 = false;
                                             icon21.addEventListener('click', () => {
                                                if (isInputVisible21) {
                                                   input21.classList.remove('visible-input');
                                                   input21.classList.add('hidden-input');
                                                } else {
                                                   input21.classList.remove('hidden-input');
                                                   input21.classList.add('visible-input');
                                                   input21.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible21 = !isInputVisible21;
                                             });
                                          </script>
                                       </div>

                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon22" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Quirúrgicos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="quirurgicos" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="quirurgicos"><?php echo $mostrar['Quirurgicos']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon22 = document.getElementById('toggle-icon22');
                                             const input22 = document.getElementById('quirurgicos');

                                             let isInputVisible22 = false;
                                             icon22.addEventListener('click', () => {
                                                if (isInputVisible22) {
                                                   input22.classList.remove('visible-input');
                                                   input22.classList.add('hidden-input');
                                                } else {
                                                   input22.classList.remove('hidden-input');
                                                   input22.classList.add('visible-input');
                                                   input22.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible22 = !isInputVisible22;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon23" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Hospitalización</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="hospitalizacion" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="hospitalizacion"><?php echo $mostrar['Hozpitalizacion']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon23 = document.getElementById('toggle-icon23');
                                             const input23 = document.getElementById('hospitalizacion');

                                             let isInputVisible23 = false;
                                             icon23.addEventListener('click', () => {
                                                if (isInputVisible23) {
                                                   input23.classList.remove('visible-input');
                                                   input23.classList.add('hidden-input');
                                                } else {
                                                   input23.classList.remove('hidden-input');
                                                   input23.classList.add('visible-input');
                                                   input23.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible23 = !isInputVisible23;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon24" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Cardiacos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="cardiacos" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="cardiacos"><?php echo $mostrar['Cardiacas']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon24 = document.getElementById('toggle-icon24');
                                             const input24 = document.getElementById('cardiacos');

                                             let isInputVisible24 = false;
                                             icon24.addEventListener('click', () => {
                                                if (isInputVisible24) {
                                                   input24.classList.remove('visible-input');
                                                   input24.classList.add('hidden-input');
                                                } else {
                                                   input24.classList.remove('hidden-input');
                                                   input24.classList.add('visible-input');
                                                   input24.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible24 = !isInputVisible24;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon25" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Renal</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="renal" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="renal"><?php echo $mostrar['Renal']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon25 = document.getElementById('toggle-icon25');
                                             const input25 = document.getElementById('renal');

                                             let isInputVisible25 = false;
                                             icon25.addEventListener('click', () => {
                                                if (isInputVisible25) {
                                                   input25.classList.remove('visible-input');
                                                   input25.classList.add('hidden-input');
                                                } else {
                                                   input25.classList.remove('hidden-input');
                                                   input25.classList.add('visible-input');
                                                   input25.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible25 = !isInputVisible25;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon26" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Hipertensivos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="hipertensivos" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="hipertensivos"><?php echo $mostrar['Hipertensivos']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon26 = document.getElementById('toggle-icon26');
                                             const input26 = document.getElementById('hipertensivos');

                                             let isInputVisible26 = false;
                                             icon26.addEventListener('click', () => {
                                                if (isInputVisible26) {
                                                   input26.classList.remove('visible-input');
                                                   input26.classList.add('hidden-input');
                                                } else {
                                                   input26.classList.remove('hidden-input');
                                                   input26.classList.add('visible-input');
                                                   input26.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible26 = !isInputVisible26;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon27" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Diabéticos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="diabeticos" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="diabe"><?php echo $mostrar['Diabeticos']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon27 = document.getElementById('toggle-icon27');
                                             const input27 = document.getElementById('diabe');

                                             let isInputVisible27 = false;
                                             icon27.addEventListener('click', () => {
                                                if (isInputVisible27) {
                                                   input27.classList.remove('visible-input');
                                                   input27.classList.add('hidden-input');
                                                } else {
                                                   input27.classList.remove('hidden-input');
                                                   input27.classList.add('visible-input');
                                                   input27.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible27 = !isInputVisible27;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon28" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Fracturas</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="fracturas" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="fractu"><?php echo $mostrar['Fracturas']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon28 = document.getElementById('toggle-icon28');
                                             const input28 = document.getElementById('fractu');

                                             let isInputVisible28 = false;
                                             icon28.addEventListener('click', () => {
                                                if (isInputVisible28) {
                                                   input28.classList.remove('visible-input');
                                                   input28.classList.add('hidden-input');
                                                } else {
                                                   input28.classList.remove('hidden-input');
                                                   input28.classList.add('visible-input');
                                                   input28.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible28 = !isInputVisible28;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon29" style="width: 120px;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">Neurológicos</label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="neurologicos" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="neurologicos"><?php echo $mostrar['Neurologicos']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon29 = document.getElementById('toggle-icon29');
                                             const input29 = document.getElementById('neurologicos');

                                             let isInputVisible29 = false;
                                             icon29.addEventListener('click', () => {
                                                if (isInputVisible29) {
                                                   input29.classList.remove('visible-input');
                                                   input29.classList.add('hidden-input');
                                                } else {
                                                   input29.classList.remove('hidden-input');
                                                   input29.classList.add('visible-input');
                                                   input29.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible29 = !isInputVisible29;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 tex col-md-12 col-lg-12 col-xl-12">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="toggle-icon30" style="width: 130px;">
                                             <label style="font-size: 15px; color: white; width: 90px;">
                                                Observaciones
                                             </label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="observa2" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="observa2"><?php echo $mostrar['Observaciones']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon30 = document.getElementById('toggle-icon30');
                                             const input30 = document.getElementById('observa2');

                                             let isInputVisible30 = false;
                                             icon30.addEventListener('click', () => {
                                                if (isInputVisible30) {
                                                   input30.classList.remove('visible-input');
                                                   input30.classList.add('hidden-input');
                                                } else {
                                                   input30.classList.remove('hidden-input');
                                                   input30.classList.add('visible-input');
                                                   input30.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                                }
                                                isInputVisible30 = !isInputVisible30;
                                             });
                                          </script>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion <?php if ($close4 === 'disabled') {
                                          echo $close4;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Antecedentes Gineco-Obstétricos-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                           Antecedentes Gineco-Obstétricos
                        </button>
                     </h2>
                     <div id="collapseFour" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_ginecologicos_edit.php" class="form" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM ginecoobs WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon31" style="width: 120px;">
                                          <label style="font-size: 15px; color: white; width: 90px;">Última<br>Mastografía</label>
                                       </span>
                                       <div class="form-floating visible-input" id="divi">
                                          <input name="fecha" type="date" class="form-control" id="floatingInputGroup1" style="height: 70px;" value="<?php echo $mostrar['FechaMasto']; ?>">
                                          <label for="floatingInputGroup1">Fecha de la ultima Mastografía</label>
                                       </div>
                                       <script>
                                          const icon31 = document.getElementById('toggle-icon31');
                                          const input31 = document.getElementById('divi');

                                          let isInputVisible31 = false;
                                          icon31.addEventListener('click', () => {
                                             if (isInputVisible31) {
                                                input31.classList.remove('visible-input');
                                                input31.classList.add('hidden-input');
                                             } else {
                                                input31.classList.remove('hidden-input');
                                                input31.classList.add('visible-input');
                                                input31.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible31 = !isInputVisible31;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon32" style="width: 120px; height: 70px;">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Resultado</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="resultado" type="text" class="form-control visible-input" id="Resultados" style="height: 70px; resize: none; border-color: #3C3B3F;"><?php echo $mostrar['Resultado']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon32 = document.getElementById('toggle-icon32');
                                          const input32 = document.getElementById('Resultados');

                                          let isInputVisible32 = false;
                                          icon32.addEventListener('click', () => {
                                             if (isInputVisible32) {
                                                input32.classList.remove('visible-input');
                                                input32.classList.add('hidden-input');
                                             } else {
                                                input32.classList.remove('hidden-input');
                                                input32.classList.add('visible-input');
                                                input32.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible32 = !isInputVisible32;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion <?php if ($close5 === 'disabled') {
                                          echo $close5;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Padecimiento Actual-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                           Padecimiento Actual
                        </button>
                     </h2>
                     <div id="collapseFive" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_padecimiento_actual_edit.php" class="form" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM padecimientoactual WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <!--Primera fila-->
                              <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon33" style="width: 120px;">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Fecha<br>De<br>Inicio</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="fecha" type="date" class="form-control visible-input" id="fechastart" style="resize: none; height: 90px; border-color: #3C3B3F;"><?php echo $mostrar['FechaInicio']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon33 = document.getElementById('toggle-icon33');
                                          const input33 = document.getElementById('fechastart');

                                          let isInputVisible33 = false;
                                          icon33.addEventListener('click', () => {
                                             if (isInputVisible33) {
                                                input33.classList.remove('visible-input');
                                                input33.classList.add('hidden-input');
                                             } else {
                                                input33.classList.remove('hidden-input');
                                                input33.classList.add('visible-input');
                                                input33.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible33 = !isInputVisible33;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon34">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Síntomas<br>de<br>Inicio</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="sinto_start" type="text" style="resize: none; height: 90px; border-color: #3C3B3F;" class="form-control visible-input" id="sinto"><?php echo $mostrar['Sintomas']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon34 = document.getElementById('toggle-icon34');
                                          const input34 = document.getElementById('sinto');

                                          let isInputVisible34 = false;
                                          icon34.addEventListener('click', () => {
                                             if (isInputVisible34) {
                                                input34.classList.remove('visible-input');
                                                input34.classList.add('hidden-input');
                                             } else {
                                                input34.classList.remove('hidden-input');
                                                input34.classList.add('visible-input');
                                                input34.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible34 = !isInputVisible34;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <!--Segunda fila-->
                              <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon35">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Describa<br>la<br>Evolución</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="descripcion" style="height: 90px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="descripcion"><?php echo $mostrar['DescripcionEvol']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon35 = document.getElementById('toggle-icon35');
                                          const input35 = document.getElementById('descripcion');

                                          let isInputVisible35 = false;
                                          icon35.addEventListener('click', () => {
                                             if (isInputVisible35) {
                                                input35.classList.remove('visible-input');
                                                input35.classList.add('hidden-input');
                                             } else {
                                                input35.classList.remove('hidden-input');
                                                input35.classList.add('visible-input');
                                                input35.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible35 = !isInputVisible35;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion <?php if ($close6 === 'disabled') {
                                          echo $close6;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Interrogatorio por Aparatos y Sistemas-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                           Interrogatorio por Aparatos y Sistemas
                        </button>
                     </h2>
                     <div id="collapseSix" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_interrogatorio_apa_edit.php" class="form" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM interrogatorioaparatos WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <!--Primera fila-->
                              <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon36">
                                          <label for="" style="font-size: 15px; color:white; width:90px;">Respiratorio</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="resp" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="resp"><?php echo $mostrar['Respiratorio']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon36 = document.getElementById('toggle-icon36');
                                          const input36 = document.getElementById('resp');

                                          let isInputVisible36 = false;
                                          icon36.addEventListener('click', () => {
                                             if (isInputVisible36) {
                                                input36.classList.remove('visible-input');
                                                input36.classList.add('hidden-input');
                                             } else {
                                                input36.classList.remove('hidden-input');
                                                input36.classList.add('visible-input');
                                                input36.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible36 = !isInputVisible36;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon37">
                                          <label for="" style="font-size: 15px; color:white; width: 90px;">Cardio<br>Circulatorio</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="cardio" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="cardio"><?php echo $mostrar['Cardio']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon37 = document.getElementById('toggle-icon37');
                                          const input37 = document.getElementById('cardio');

                                          let isInputVisible37 = false;
                                          icon37.addEventListener('click', () => {
                                             if (isInputVisible37) {
                                                input37.classList.remove('visible-input');
                                                input37.classList.add('hidden-input');
                                             } else {
                                                input37.classList.remove('hidden-input');
                                                input37.classList.add('visible-input');
                                                input37.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible37 = !isInputVisible37;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <!--Segunda fila-->
                              <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon38">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Digestivo</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="digestivo" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="digestivo"><?php echo $mostrar['Digestivo']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon38 = document.getElementById('toggle-icon38');
                                          const input38 = document.getElementById('digestivo');

                                          let isInputVisible38 = false;
                                          icon38.addEventListener('click', () => {
                                             if (isInputVisible38) {
                                                input38.classList.remove('visible-input');
                                                input38.classList.add('hidden-input');
                                             } else {
                                                input38.classList.remove('hidden-input');
                                                input38.classList.add('visible-input');
                                                input38.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible38 = !isInputVisible38;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon39">
                                          <label for="" style="font-size: 15 px; color: white; width: 90px;">Urinario</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="urinario" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="urinario"><?php echo $mostrar['Urinario']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon39 = document.getElementById('toggle-icon39');
                                          const input39 = document.getElementById('urinario');

                                          let isInputVisible39 = false;
                                          icon39.addEventListener('click', () => {
                                             if (isInputVisible39) {
                                                input39.classList.remove('visible-input');
                                                input39.classList.add('hidden-input');
                                             } else {
                                                input39.classList.remove('hidden-input');
                                                input39.classList.add('visible-input');
                                                input39.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible39 = !isInputVisible39;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <!--Tercera fila-->
                              <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon40">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Hemolinfatico</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="hemo" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="hemo"><?php echo $mostrar['Hemolinfatico']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon40 = document.getElementById('toggle-icon40');
                                          const input40 = document.getElementById('hemo');

                                          let isInputVisible40 = false;
                                          icon40.addEventListener('click', () => {
                                             if (isInputVisible40) {
                                                input40.classList.remove('visible-input');
                                                input40.classList.add('hidden-input');
                                             } else {
                                                input40.classList.remove('hidden-input');
                                                input40.classList.add('visible-input');
                                                input40.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible40 = !isInputVisible40;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon41">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Endocrino</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="endocrino" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="endocrino"><?php echo $mostrar['Endocrino']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon41 = document.getElementById('toggle-icon41');
                                          const input41 = document.getElementById('endocrino');

                                          let isInputVisible41 = false;
                                          icon41.addEventListener('click', () => {
                                             if (isInputVisible41) {
                                                input41.classList.remove('visible-input');
                                                input41.classList.add('hidden-input');
                                             } else {
                                                input41.classList.remove('hidden-input');
                                                input41.classList.add('visible-input');
                                                input41.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible41 = !isInputVisible41;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <!--Cuarta fila-->
                              <div class="row sistema">
                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon42">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Sistema<br>Nervioso</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="sis_nerv" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="sis_nerv"><?php echo $mostrar['SistemaNervioso']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon42 = document.getElementById('toggle-icon42');
                                          const input42 = document.getElementById('sis_nerv');

                                          let isInputVisible42 = false;
                                          icon42.addEventListener('click', () => {
                                             if (isInputVisible42) {
                                                input42.classList.remove('visible-input');
                                                input42.classList.add('hidden-input');
                                             } else {
                                                input42.classList.remove('hidden-input');
                                                input42.classList.add('visible-input');
                                                input42.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible42 = !isInputVisible42;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon43">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Osteomuscular</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="osteo" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="osteo"><?php echo $mostrar['OsteoMuscular']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon43 = document.getElementById('toggle-icon43');
                                          const input43 = document.getElementById('osteo');

                                          let isInputVisible43 = false;
                                          icon43.addEventListener('click', () => {
                                             if (isInputVisible43) {
                                                input43.classList.remove('visible-input');
                                                input43.classList.add('hidden-input');
                                             } else {
                                                input43.classList.remove('hidden-input');
                                                input43.classList.add('visible-input');
                                                input43.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible43 = !isInputVisible43;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon44">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Tegumentos</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="tegumentos" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="tegumentos"><?php echo $mostrar['Tegumentos']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon44 = document.getElementById('toggle-icon44');
                                          const input44 = document.getElementById('tegumentos');

                                          let isInputVisible44 = false;
                                          icon44.addEventListener('click', () => {
                                             if (isInputVisible44) {
                                                input44.classList.remove('visible-input');
                                                input44.classList.add('hidden-input');
                                             } else {
                                                input44.classList.remove('hidden-input');
                                                input44.classList.add('visible-input');
                                                input44.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible44 = !isInputVisible44;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion <?php if ($close7 === 'disabled') {
                                          echo $close7;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Exploración Física-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                           Exploración Física
                        </button>
                     </h2>
                     <div id="collapseSeven" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_exploracion_edit.php" class="form" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM exploracion WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon45">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Cabeza</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="cabeza" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="cabeza"><?php echo $mostrar['Cabeza']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon45 = document.getElementById('toggle-icon45');
                                          const input45 = document.getElementById('cabeza');

                                          let isInputVisible45 = false;
                                          icon45.addEventListener('click', () => {
                                             if (isInputVisible45) {
                                                input45.classList.remove('visible-input');
                                                input45.classList.add('hidden-input');
                                             } else {
                                                input45.classList.remove('hidden-input');
                                                input45.classList.add('visible-input');
                                                input45.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible45 = !isInputVisible45;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon46">
                                          <label for="" style="font-size: 15pz; color: white; width: 90px;">Cuello</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="cuello" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="cuello"><?php echo $mostrar['Cuello']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon46 = document.getElementById('toggle-icon46');
                                          const input46 = document.getElementById('cuello');

                                          let isInputVisible46 = false;
                                          icon46.addEventListener('click', () => {
                                             if (isInputVisible46) {
                                                input46.classList.remove('visible-input');
                                                input46.classList.add('hidden-input');
                                             } else {
                                                input46.classList.remove('hidden-input');
                                                input46.classList.add('visible-input');
                                                input46.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible46 = !isInputVisible46;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <!--Cuarto row-->
                              <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon47">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Tórax</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="torax" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="torax"><?php echo $mostrar['Torax']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon47 = document.getElementById('toggle-icon47');
                                          const input47 = document.getElementById('torax');

                                          let isInputVisible47 = false;
                                          icon47.addEventListener('click', () => {
                                             if (isInputVisible47) {
                                                input47.classList.remove('visible-input');
                                                input47.classList.add('hidden-input');
                                             } else {
                                                input47.classList.remove('hidden-input');
                                                input47.classList.add('visible-input');
                                                input47.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible47 = !isInputVisible47;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon48">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Mamas</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="mamas" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="mamas"><?php echo $mostrar['Mamas']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon48 = document.getElementById('toggle-icon48');
                                          const input48 = document.getElementById('mamas');

                                          let isInputVisible48 = false;
                                          icon48.addEventListener('click', () => {
                                             if (isInputVisible48) {
                                                input48.classList.remove('visible-input');
                                                input48.classList.add('hidden-input');
                                             } else {
                                                input48.classList.remove('hidden-input');
                                                input48.classList.add('visible-input');
                                                input48.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible48 = !isInputVisible48;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <!--Quinto row-->
                              <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon49">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Abdomen</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="abdomen" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="abdomen"><?php echo $mostrar['Abdomen']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon49 = document.getElementById('toggle-icon49');
                                          const input49 = document.getElementById('abdomen');

                                          let isInputVisible49 = false;
                                          icon49.addEventListener('click', () => {
                                             if (isInputVisible49) {
                                                input49.classList.remove('visible-input');
                                                input49.classList.add('hidden-input');
                                             } else {
                                                input49.classList.remove('hidden-input');
                                                input49.classList.add('visible-input');
                                                input49.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible49 = !isInputVisible49;
                                          });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon50">
                                          <label for="" style="font-size: 15x; color: white; width: 90px;">Extremidades </label>
                                        </span>
                                       <div class="form-floating">
                                          <textarea name="extremidades" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="extremidades"><?php echo $mostrar['Extremidades']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon50 = document.getElementById('toggle-icon50');
                                          const input50 = document.getElementById('extremidades');

                                          let isInputVisible50 = false;
                                          icon50.addEventListener('click', () => {
                                             if (isInputVisible50) {
                                                input50.classList.remove('visible-input');
                                                input50.classList.add('hidden-input');
                                             } else {
                                                input50.classList.remove('hidden-input');
                                                input50.classList.add('visible-input');
                                                input50.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible50 = !isInputVisible50;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon51">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Inspección<br>General</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="inspec" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="inspec"><?php echo $mostrar['Inspeccion']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon51 = document.getElementById('toggle-icon51');
                                          const input51 = document.getElementById('inspec');

                                          let isInputVisible51 = false;
                                          icon51.addEventListener('click', () => {
                                             if (isInputVisible51) {
                                                input51.classList.remove('visible-input');
                                                input51.classList.add('hidden-input');
                                             } else {
                                                input51.classList.remove('hidden-input');
                                                input51.classList.add('visible-input');
                                                input51.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible51 = !isInputVisible51;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="accordion <?php if ($close8 === 'disabled') {
                                          echo $close8;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Evaluaciones Especiales Necesarias-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                           Evaluaciones Especiales Necesarias
                        </button>
                     </h2>
                     <div id="collapseEight" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_evaluaciones_edit.php" id="myForm" class="form" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM evaluaciones WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon52">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Examenes<br>Necesarios</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="oftal" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="oftal"><?php echo $mostrar['Generales']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon52 = document.getElementById('toggle-icon52');
                                          const input52 = document.getElementById('oftal');

                                          let isInputVisible52 = false;
                                          icon52.addEventListener('click', () => {
                                             if (isInputVisible52) {
                                                input52.classList.remove('visible-input');
                                                input52.classList.add('hidden-input');
                                             } else {
                                                input52.classList.remove('hidden-input');
                                                input52.classList.add('visible-input');
                                                input52.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible52 = !isInputVisible52;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion <?php if ($close9 === 'disabled') {
                                          echo $close9;
                                       } else {
                                          echo '';
                                       } ?>" id="accordion">
                  <!--Nota Médica-->
                  <div class="accordion-item">
                     <h2 class="accordion-header">
                        <button class="accordion-button" style="margin-bottom: 10px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                           Notas Médicas
                        </button>
                     </h2>
                     <div id="collapseNine" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <form action="include_questions/items_notas_med_edit.php" id="myForm" class="form" method="post">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM notas WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group mb-3">
                                       <span class="input-group-text" id="toggle-icon53">
                                          <label for="" style="font-size: 15px; color: white; width: 90px;">Notas<br>Médicas</label>
                                       </span>
                                       <div class="form-floating">
                                          <textarea name="Notas" style="height: 80px; resize: none; border-color: #3C3B3F;" class="form-control visible-input" id="Notas"><?php echo $mostrar['Nota']; ?></textarea>
                                       </div>
                                       <script>
                                          const icon53 = document.getElementById('toggle-icon53');
                                          const input53 = document.getElementById('Notas');

                                          let isInputVisible53 = false;
                                          icon53.addEventListener('click', () => {
                                             if (isInputVisible53) {
                                                input53.classList.remove('visible-input');
                                                input53.classList.add('hidden-input');
                                             } else {
                                                input53.classList.remove('hidden-input');
                                                input53.classList.add('visible-input');
                                                input53.focus(); // Puedes hacer que el input obtenga el enfoque automáticamente.
                                             }
                                             isInputVisible53 = !isInputVisible53;
                                          });
                                       </script>
                                    </div>
                                 </div>
                              </div>
                                 <div class="container final">
                                    <input name="submit" type="submit" class="btn solid" value="Agregar">
                                 </div>
                              <?php
                              }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container final fin">
                  <form action="include_questions/termino_consulta.php" method="post" class="form">
                     <input name="submit" type="submit" class="btn solid" value="Finalizar consulta">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      const accordionItems = document.querySelectorAll('.accordion-item');
      // Agregar evento de clic a cada acordeón
      accordionItems.forEach(item => {
         const button = item.querySelector('.accordion-button');
         button.addEventListener('click', () => {
            // Cerrar todos los acordeones excepto el actual
            accordionItems.forEach(otherItem => {
               if (otherItem !== item) {
                  const collapse = otherItem.querySelector('.accordion-collapse');
                  const bsCollapse = new bootstrap.Collapse(collapse, {
                     toggle: false
                  });
                  bsCollapse.hide();
               }
            });
         });
      });
   </script>

   <!--Jquery-->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <!--Boostrap-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>