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
  <link rel="stylesheet" href="css/new_pac_med.css">
  <title>Dashboard recepción (Paciente nuevo)</title>
</head>
<body>
  <!--Barra de navegación-->
  <nav class="navbar">
    <div class="container">
      <a class="title" href="dashboard_medico.php"><i class="bi bi-heart-pulse-fill"></i> Atencion médica</a>
      <div class="dropdown ms-auto">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-fill"></i> Médico: <?php echo "$nombre";
                                                    $_SESSION['Elaborado'] = $nombre; ?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="include/logout.php">Cerrar Sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--Contenedor del formulario-->
  <div class="container my-3">
    <div class="row">
      <div class="formulario col-sm-12 col-mg-12 col-lg-12 col-xl-12 bg-white">
        <h2>Pacientes agregados del dia</h2>
        <form class="return d-flex justify-content-end" method="post" action="dashboard_medico.php">
          <button class="btn solid" method="post" type="btn">
            <a>Regresar</a>
            <i class="fa-solid fa-rotate-left"></i>
          </button>
        </form>
        <form class="form" method="post" action="include/Nuevo_pac_med.php">
          <!--Fila principal-->
          <div class="row principal">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                <div class="form-floating">
                  <input name="fullname" type="text" class="form-control" id="floatingInputGroup1" placeholder="Nombre completo" required>
                  <label for="floatingInputGroup1">Nombre completo</label>
                </div>
              </div>
            </div>
            <div class="fecha col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-calendar-range-fill"></i></span>
                <div class="form-floating">
                  <label for="floatingInputGroup2">Fecha de nacimiento</label>
                  <input name="fecha" type="date" class="form-control" id="fechaNacimiento" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-hash"></i></span>
                <div class="form-floating">
                  <input name="edad" type="text" class="form-control" id="edad" placeholder="Edad" required>
                  <label for="floatingInputGroup1">Edad</label>
                </div>
              </div>
            </div>
            <script>
              // Capturar el evento de cambio en el campo de entrada de fecha
              document.getElementById("fechaNacimiento").addEventListener("change", function() {
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
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-venus-mars"></i></span>
                <div class="form-floating">
                  <select name="genero" class="form-select" id="floatingSelectGrid" required>
                    <option selected disabled value="">...</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                  </select>
                  <label for="floatingSelectGrid">Genero</label>
                </div>
              </div>
            </div>
          </div>
          <!--Segunda fila-->
          <div class="row dos">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                <div class="form-floating">
                  <input name="lug_name" type="text" class="form-control" id="floatingInputGroup1" placeholder="Lugar de nacimiento" required>
                  <label for="floatingInputGroup1">Lugar de nacimiento</label>
                </div>
              </div>
            </div>
            <div class="dos col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-signpost-fill"></i></span>
                <div class="form-floating">
                  <input name="domicilio" type="text" class="form-control" id="floatingInputGroup1" placeholder="Domicilio (Calle y número)" required>
                  <label for="floatingInputGroup1">Domicilio (Calle y número)</label>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-houses-fill"></i></span>
                <div class="form-floating">
                  <input name="colonia" type="text" class="form-control" id="floatingInputGroup1" placeholder="Colonia" required>
                  <label for="floatingInputGroup1">Colonia</label>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-pin-map-fill"></i></span>
                <div class="form-floating">
                  <select name="municipio" class="form-select" id="floatingSelectGrid" required>
                    <option selected disabled value="">...</option>
                    <option value="1">Colima</option>
                    <option value="2">Manzanillo</option>
                    <option value="3">Tecomán</option>
                    <option value="4">Villa de Álvarez</option>
                    <option value="5">Armería</option>
                    <option value="6">Coquimatlán</option>
                    <option value="7">Comala</option>
                    <option value="8">Cuauhtémoc</option>
                    <option value="9">Ixtlahuacán</option>
                    <option value="10">Minatitlán</option>
                  </select>
                  <label for="floatingSelectGrid">Municipio</label>
                </div>
              </div>
            </div>
          </div>
          <!--Trecer fila-->
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <div class="form-floating">
                  <input type="text" name="tel" class="form-control" id="telefono" placeholder="Teléfono" inputmode="numeric" pattern="[0-9]*">
                  <label for="telefono">Teléfono</label>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-wrench-adjustable"></i></span>
                <div class="form-floating">
                  <input name="ocupacion" type="text" class="form-control" id="floatingInputGroup1" placeholder="Ocupación" required>
                  <label for="floatingInputGroup1">Ocupación</label>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-graduation-cap"></i></span>
                <div class="form-floating">
                  <select name="escolaridad" class="form-select" id="floatingSelectGrid" required>
                    <option selected disabled value="">...</option>
                    <option value="1">Ninguna</option>
                    <option value="2">Jardin de niños</option>
                    <option value="3">Primaria</option>
                    <option value="4">Secundaria</option>
                    <option value="5">Preparatoria</option>
                    <option value="6">Licenciatura</option>
                    <option value="7">Maestria</option>
                    <option value="8">Doctorado</option>
                  </select>
                  <label for="floatingSelectGrid">Escolaridad</label>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                <div class="form-floating">
                  <select name="estado_civ" class="form-select" id="floatingSelectGrid" required>
                    <option selected disabled value="">...</option>
                    <option value="1">Soltero</option>
                    <option value="2">Casado</option>
                    <option value="3">Unión Libre</option>
                    <option value="4">Divorcioad@</option>
                    <option value="5">Viud@</option>
                  </select>
                  <label for="floatingSelectGrid">Estado civil</label>
                </div>
              </div>
            </div>
          </div>
          <!--Cuarta fila-->
          <div class="row cuatro">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-church"></i></span>
                <div class="form-floating">
                  <input type="text" name="religion" class="form-control" id="floatingInputGroup1" placeholder="Religión" required>
                  <label for="floatingInputGroup1">Religión</label>
                </div>
              </div>
            </div>
            <div class="seleccionador col-sm-12 col-md-6 col-lg-4 col-xl-4">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-earth-americas"></i></span>
                <div class="form-floating">
                  <select name="nacionalidad" class="form-select" id="floatingSelectGrid" required>
                    <option selected disabled value="">...</option>
                    <option class="select-item" value="1">Mexicana</option>
                    <option class="select-item" value="2">Estado Unidense</option>
                    <option class="select-item" value="3">Guatemalteca</option>
                    <option class="select-item" value="4">Salvadoreña</option>
                    <option class="select-item" value="5">Hondureña</option>
                    <option class="select-item" value="6">Colombiana</option>
                    <option class="select-item" value="7">Española</option>
                    <option class="select-item" value="8">Cubana</option>
                    <option class="select-item" value="9">Argentina</option>
                    <option class="select-item" value="10">Venezolana</option>
                    <option class="select-item" value="11">Peruana</option>
                    <option class="select-item" value="12">Brasileña</option>
                    <option class="select-item" value="13">Alemana</option>
                    <option class="select-item" value="14">Francesa</option>
                    <option class="select-item" value="15">Italiana</option>
                    <option class="select-item" value="16">Canadiense</option>
                    <option class="select-item" value="17">Británica</option>
                    <option class="select-item" value="18">China</option>
                    <option class="select-item" value="19">Coreana</option>
                    <option class="select-item" value="20">Japonesa</option>
                  </select>
                  <label for="floatingSelectGrid">Nacionalidad</label>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-people-group"></i></span>
                <div class="form-floating">
                  <input type="text" name="grupo_et" class="form-control" id="floatingInputGroup1" placeholder="Grupo Étnico" required>
                  <label for="floatingInputGroup1">Grupo Étnico</label>
                </div>
              </div>
            </div>
            <div class="rh col-sm-12 col-md-6 col-lg-2 col-xl-2">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-droplet-fill"></i></span>
                <div class="form-floating">
                  <input type="text" name="sangre" class="form-control" id="floatingInputGroup1" placeholder="Grupo y RH" required>
                  <label for="floatingInputGroup1">Grupo y RH</label>
                </div>
              </div>
            </div>
          </div>
          <!--Quinta fila-->
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                <div class="form-floating">
                  <select name="tipo_serv" class="form-select" id="floatingSelectGrid" required>
                    <option selected disabled value="">...</option>
                    <option value="1">Optometrista</option>
                    <option value="2">Dental</option>
                    <option value="3">Pediatría</option>
                    <option value="4">Médico General</option>
                    <option value="5">Homeopatía</option>
                    <option value="6">Nutrición</option>
                  </select>
                  <label for="floatingSelectGrid">Tipo de Servicio</label>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                <div class="form-floating">
                  <input name="primera" class="form-control" id="floatingInputGroup1" value="Primera Vez">
                  <label for="floatingSelectGrid">Visita</label>
                </div>
              </div>
            </div>
            <div class="checks col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="form-check uno">
                <input name="canalizado" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  ¿Llegó canalizado?
                </label>
              </div>
            </div>
            <div class="checks col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="form-check">
                <input name="directo" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Directo
                </label>
              </div>
            </div>
          </div>
          <div class="container final">
            <button class="btn solid" type="submit" method="post">
              <a>
                Agregar
              </a>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--Boostrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>