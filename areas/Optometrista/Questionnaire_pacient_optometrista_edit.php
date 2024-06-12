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
   <link rel="stylesheet" href="css/Questionnaire_pacient_optometrista.css">

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
   </style>

   <title>Edición Consulta Optometrista</title>
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
               <h2>Registro de lentes</h2>
               <div class="imprimir col-sm-12 col-md-6 col-lg-3 col-xl-3" style="z-index: 2; position: relative;">
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
               <form action="include_questions/items_valoraciones_edit.php" method="post" class="form" name="register">
                  <div class="row">
                     <div class="princ col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <div class="input-group mb-3">
                           <span class="input-group-text">
                              <label for="" style="font-size: 10px; color: white; width: 40px; height: 38px;">N°<br>de<br>Consulta</label>
                           </span>
                           <div class="form-floating">
                              <input type="text" class="form-control" id="floatingInputGroup1" placeholder="N° de Paciente" value="<?php echo $id_registro;
                                                                                                                                    $_SESSION['id_registro'] = $id_registro; ?>">
                           </div>
                        </div>
                     </div>
                     <div class="princ col-sm-12 col-md-7 col-lg-7 col-xl-7">
                        <div class="input-group mb-3">
                           <span class="input-group-text">
                              <label for="" style="font-size: 15px; color: white; width: 90px;">Paciente</label>
                           </span>
                           <div class="form-floating">
                              <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Nombre del Paciente" value="<?php echo $NombreCom; ?>" disabled>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                  require "include_questions/conexion.php";
                  $hoy = date("Y-m-d");
                  $sql = "SELECT * FROM consultas WHERE ID_Registro='$id_registro'";
                  $result = mysqli_query($mysqli, $sql);

                  while ($mostrar = mysqli_fetch_array($result)) {
                     // Calcular la fecha de nacimiento en un objeto DateTime
                     $fechaNacimiento = new DateTime($mostrar['FechaNac']);

                     // Calcular la diferencia entre la fecha actual y la fecha de nacimiento
                     $diferencia = $fechaNacimiento->diff(new DateTime($hoy));

                     // Obtener la edad en años y meses
                     $edadEnAnios = $diferencia->y;
                     $edadEnMeses = $diferencia->m;

                     // Mostrar la edad en el campo de entrada de "Edad"
                     if ($edadEnAnios >= 1) {
                        $edadMostrada = $edadEnAnios . " años";
                     } else {
                        if ($edadEnMeses === 1) {
                           $edadMostrada = $edadEnMeses . " mes";
                        } else {
                           $edadMostrada = $edadEnMeses . " meses";
                        }
                     }
                  ?>
                     <div class="row dos">
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           <div class="input-group mb-3">
                              <span class="input-group-text" style="background-color: #3C3B3F; border-color: #3C3B3F;">
                                 <label for="" style="font-size: 11px; color: white; width: 90px; height: 40px;">Fecha<br>de<br>nacimiento</label>
                              </span>
                              <div class="form-floating">
                                 <input id="fechaNac" name="fecha" type="date" class="form-control" style="border-color: #3C3B3F;" value="<?php echo $mostrar['FechaNac']; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           <div class="input-group mb-3">
                              <span class="input-group-text" style="background-color: #3C3B3F; border-color: #3C3B3F;">
                                 <label for="" style="font-size: 15px; color: white; width: 90px;">Edad</label>
                              </span>
                              <div class="form-floating">
                                 <input name="edad" type="text" class="form-control" id="edad" style="border-color: #3C3B3F;" value="<?php echo $edadMostrada; ?>">
                              </div>
                           </div>
                           <script>
                              // Capturar el evento de cambio en el campo de entrada de fecha
                              document.getElementById("fechaNac").addEventListener("change", function() {
                                 // Obtener la fecha de nacimiento seleccionada
                                 var fechaNacimiento = new Date(this.value);
                                 // Obtener la fecha actual
                                 var fechaActual = new Date();

                                 // Calcular la diferencia de tiempo en milisegundos entre la fecha de nacimiento y la fecha actual
                                 var diferenciaTiempo = fechaActual.getTime() - fechaNacimiento.getTime();

                                 // Calcular la edad en años y meses
                                 var edadEnAnios = Math.floor(diferenciaTiempo / (1000 * 60 * 60 * 24 * 365.25));
                                 var edadEnMeses = Math.floor(diferenciaTiempo / (1000 * 60 * 60 * 24 * 30.44));

                                 // Mostrar la edad en el campo de entrada de edad
                                 if (edadEnAnios >= 1) {
                                    document.getElementById("edad").value = edadEnAnios + " años";
                                 } else {
                                    if (edadEnMeses === 1) {
                                       document.getElementById("edad").value = edadEnMeses + " mes";
                                    } else {
                                       document.getElementById("edad").value = edadEnMeses + " meses";
                                    }
                                 }
                              });
                           </script>
                        </div>
                        <div class="dos col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           <div class="input-group mb-3">
                              <span class="input-group-text" style="background-color: #3C3B3F; border-color: #3C3B3F;">
                                 <label for="" style="font-size: 15px; color: white; width: 90px;">Sexo</label>
                              </span>
                              <div class="form-floating">
                                 <input name="sexo" type="text" class="form-control" id="sexo" style="border-color: #3C3B3F;" value="<?php echo $mostrar['Genero']; ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           <div class="input-group mb-3">
                              <span class="input-group-text" style="background-color: #3C3B3F; border-color: #3C3B3F;">
                                 <label for="" style="font-size: 15px; color: white; width: 90px;">Calle y N°</label>
                              </span>
                              <div class="form-floating">
                                 <input name="calle" type="text" class="form-control" id="calle" style="border-color: #3C3B3F;" value="<?php echo $mostrar['Domicilio']; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           <div class="input-group mb-3">
                              <span class="input-group-text" style="background-color: #3C3B3F; border-color: #3C3B3F;">
                                 <label for="" style="font-size: 15px; color: white; width: 90px;">Colonia</label>
                              </span>
                              <div class="form-floating">
                                 <input name="colonia" type="text" class="form-control" id="colonia" style="border-color: #3C3B3F;" value="<?php echo $mostrar['Colonia']; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           <div class="input-group mb-3">
                              <span class="input-group-text" style="background-color: #3C3B3F; border-color: #3C3B3F;">
                                 <label for="" style="font-size: 15px; color: white; width: 90px;">Municipio</label>
                              </span>
                              <div class="form-floating">
                                 <select name="municipio" class="form-select" id="floatingSelectGrid" style="border-color: #3C3B3F;">
                                    <option selected disabled value="">...</option>
                                    <option value="1" <?php if ($mostrar['Municipio'] == 'Colima') echo 'selected'; ?>>Colima</option>
                                    <option value="2" <?php if ($mostrar['Municipio'] == 'Manzanillo') echo 'selected'; ?>>Manzanillo</option>
                                    <option value="3" <?php if ($mostrar['Municipio'] == 'Tecomán') echo 'selected'; ?>>Tecomán</option>
                                    <option value="4" <?php if ($mostrar['Municipio'] == 'Villa de Álvarez') echo 'selected'; ?>>Villa de Álvarez</option>
                                    <option value="5" <?php if ($mostrar['Municipio'] == 'Armería') echo 'selected'; ?>>Armería</option>
                                    <option value="6" <?php if ($mostrar['Municipio'] == 'Coquimatlán') echo 'selected'; ?>>Coquimatlán</option>
                                    <option value="7" <?php if ($mostrar['Municipio'] == 'Comala') echo 'selected'; ?>>Comala</option>
                                    <option value="8" <?php if ($mostrar['Municipio'] == 'Cuauhtémoc') echo 'selected'; ?>>Cuauhtémoc</option>
                                    <option value="9" <?php if ($mostrar['Municipio'] == 'Ixtlahuacán') echo 'selected'; ?>>Ixtlahuacán</option>
                                    <option value="10" <?php if ($mostrar['Municipio'] == 'Minatitlán') echo 'selected'; ?>>Minatitlán</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php
                  }
                  ?>
                  <div class="accordion <?php if ($close1 === 'disabled') {
                                             echo $close1;
                                          } else {
                                             echo '';
                                          } ?>" id="accordion" style="margin-bottom: 10px;">
                     <!--Antecedentes Heredo Familiares-->
                     <div class="accordion-item">
                        <h2 class="accordion-header">
                           <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              Valoración / Diagnóstico
                           </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <?php
                              require "include_questions/conexion.php";

                              $sql = "SELECT * FROM valoracionopto WHERE ID_Registro = '" . $id_registro . "' ";
                              $result = mysqli_query($mysqli, $sql);

                              while ($mostrar = mysqli_fetch_array($result)) {
                              ?>
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb3">
                                          <span class="input-group-text" id="toggle-icon" style="background-color: #3C3B3F; border-color: 3C3B3F;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">
                                                Valoración
                                             </label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="valoracion" type="text" class="form-control visible-input" id="valoracion" style="border-color: #3C3B3F; resize: none;"><?php echo $mostrar['Valoracion']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon = document.getElementById('toggle-icon');
                                             const input = document.getElementById('valoracion');

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
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <div class="input-group mb3">
                                          <span class="input-group-text" id="toggle-icon2" style="background-color: #3C3B3F; border-color: 3C3B3F;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">
                                                Diagnóstico
                                             </label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="diagnostico" type="text" class="form-control visible-input" id="diagnostico" style="border-color: #3C3B3F; resize: none;"><?php echo $mostrar['Diagnostico']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon2 = document.getElementById('toggle-icon2');
                                             const input2 = document.getElementById('diagnostico');

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
                                    </div>
                                 </div>
                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                       <div class="input-group mb3">
                                          <span class="input-group-text" id="toggle-icon3" style="background-color: #3C3B3F; height: 90px; border-color: #3C3B3f;">
                                             <label for="" style="font-size: 15px; color: white; width: 90px;">
                                                Notas
                                             </label>
                                          </span>
                                          <div class="form-floating">
                                             <textarea name="Nota" type="text" class="form-control visible-input" id="Nota" style="border-color: #3C3B3F; height: 90px; resize: none;"><?php echo $mostrar['Notas']; ?></textarea>
                                          </div>
                                          <script>
                                             const icon3 = document.getElementById('toggle-icon3');
                                             const input3 = document.getElementById('Nota');

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
                                    </div>
                                 </div>
                              <?php
                              }
                              ?>
                              <div class="container final" style="margin-top: 10px; align-content: center;">
                                 <input name="submit" type="submit" method class="btn solid" value="Agregar">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
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