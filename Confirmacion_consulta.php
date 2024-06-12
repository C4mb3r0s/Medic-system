<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("location: Index.php");
}
$nombre = $_SESSION['Nombre'];

if (isset($_GET['id'])) {
    $ID = $_GET['id'];
} else {
    echo 'ERROR';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Consulta</title>
    <!--Font awesome icons-->
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
    <!--Boostrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Style css-->
    <link rel="stylesheet" href="css/Confirma_consulta.css">
</head>
<body>
    <div class="container">
        <div class="bienvenida col-sm-12 col-mg-12 col-lg-12 col-xl-12 bg-white">
            <h1>Validación de datos para consulta</h1>
            <form class="form" action="include/Alta_consul.php" method="post">
                <div class="row">
                    <?php
                    require "include/conexion.php";

                    $sql = "SELECT * FROM pacientes WHERE ID_Paciente = '" . $ID . "' ";
                    $result = mysqli_query($mysqli, $sql);
                    while ($mostrar = mysqli_fetch_array($result)) {

                        $elaborado = $nombre;
                        $_SESSION['Elaborado'] = $elaborado;
                        $_SESSION['ID_Paciente'] = $mostrar['ID_Paciente'];
                        $_SESSION['Genero'] = $mostrar['Genero'];
                        $_SESSION['LugarNac'] = $mostrar['LugarNac'];
                        $_SESSION['Ocupacion'] = $mostrar['Ocupacion'];
                        $_SESSION['Escolaridad'] = $mostrar['Escolaridad'];
                        $_SESSION['EstadoCiv'] = $mostrar['EstadoCiv'];
                        $_SESSION['Nacionalidad'] = $mostrar['Nacionalidad'];
                        $_SESSION['Religion'] = $mostrar['Religion'];
                        $_SESSION['GrupoEt'] = $mostrar['GrupoEt'];
                        $_SESSION['GrupoRh'] = $mostrar['GrupoRh'];
                    ?>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                <div class="form-floating">
                                    <input name="fullname" type="text" class="form-control" id="floatingInputGroup1" value="<?php echo $mostrar['NombreCom'];
                                                                                                                            ?>" required>
                                    <label for="floatingInputGroup1">Nombre completo</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-calendar-range-fill"></i></span>
                                <div class="form-floating">
                                    <label class="titlee" for="floatingInputGroup2">Fecha de nacimiento</label>
                                    <input name="fecha" type="date" class="form-control" id="fechaNacimiento" value="<?php echo $mostrar['FechaNac'];
                                                                                                                        ?>" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-hash"></i></span>
                            <div class="form-floating">
                                <input name="edad" type="text" class="form-control" id="edad" value="<?php echo $mostrar['Edad'];
                                                                                                        ?>" required>
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
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                            <div class="form-floating">
                                <input type="text" name="tel" class="form-control" id="telefono" value="<?php echo $mostrar['Telefono'];
                                                                                                        ?>" inputmode="numeric" pattern="[0-9]*">
                                <label for="telefono">Teléfono</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="dos col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-signpost-fill"></i></span>
                            <div class="form-floating">
                                <input name="domicilio" type="text" class="form-control" id="floatingInputGroup1" value="<?php echo $mostrar['Domicilio']; ?>" required>
                                <label for="floatingInputGroup1">Domicilio (Calle y número)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-houses-fill"></i></span>
                            <div class="form-floating">
                                <input name="colonia" type="text" class="form-control" id="floatingInputGroup1" value="<?php echo $mostrar['Colonia']; ?>" required>
                                <label for="floatingInputGroup1">Colonia</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-pin-map-fill"></i></span>
                            <div class="form-floating">
                                <select name="municipio" class="form-select" id="floatingSelectGrid" required>
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
                                <label for="floatingSelectGrid">Municipio</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
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
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                            <div class="form-floating">
                                <input type="text" name="primera" class="form-control" id="floatingInputGroup1" value="Subsecuente" required>

                                <label for="floatingSelectGrid">Visita</label>
                            </div>
                        </div>
                    </div>
                    <div class="checks col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="form-check uno">
                            <input name="canalizado" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                ¿Llegó canalizado?
                            </label>
                        </div>
                    </div>
                    <div class="checks col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="form-check">
                            <input name="directo" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Directo
                            </label>
                        </div>
                    </div>
                </div>
                <div class="container-final">
                    <input name="submit" type="submit" class="btn solid" value="Validado">
                </div>
            <?php
                    }
            ?>
            </form>
        </div>
    </div>
</body>
</html>