<?PHP
require "conexion.php";

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $full_name = $_POST['fullname'];
    $fecha = $_POST['fecha'];
    $edad = $_POST['edad'];
    $genero = $_POST['genero']; 

    if ($genero == "1"){
        $genero = "Masculino";
    }elseif ($genero == "2"){
        $genero = "Femenino";
    }else{
        $genero ="Valor Inválido";
    }

    $lug_name = $_POST['lug_name'];
    $domicilio = $_POST['domicilio'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];

    $municipio = $_POST['municipio'];

    if($municipio == 1){
        $municipio = "Colima";
    }elseif($municipio == 2){
        $municipio = "Manzanillo";
    }elseif($municipio == 3){
        $municipio = "Tecomán";
    }elseif($municipio == 4){
        $municipio = "Villa de Álvarez";
    }elseif($municipio == 5){
        $municipio = "Armería";
    }elseif($municipio == 6){
        $municipio = "Coquimatlán";
    }elseif($municipio == 7){
        $municipio = "Comala";
    }elseif($municipio == 8){
        $municipio = "Cuauhtémoc";
    }elseif($municipio == 9){
        $municipio = "Ixtlahuacán";
    }elseif($municipio == 10){
        $municipio = "Minatitlán";
    }

    $phone = $_POST['tel'];
    $ocupacion = $_POST['ocupacion'];
    $escolaridad = $_POST['escolaridad'];

    if ($escolaridad == "1") {
        $escolaridad = "Ninguna";
    } elseif ($escolaridad == "2") {
        $escolaridad = "Jardin de Niños";
    } elseif ($escolaridad == "3") {
        $escolaridad = "Primaria";
    } elseif ($escolaridad == "4") {
        $escolaridad = "Secundaria";
    } elseif ($escolaridad == "5") {
        $escolaridad = "Preparatoria";
    } elseif ($escolaridad == "6") {
        $escolaridad = "Licenciatura";
    } elseif ($estado_civ == "7") {
        $escolaridad = "Maestria";
    } elseif ($escolaridad == "8") {
        $escolaridad = "Doctorado";    
    } else {
        $escolaridad = "Valor inválido";
    }

    $estado_civ = $_POST['estado_civ'];

    if ($estado_civ == "1") {
        $estado_civ = "Soltero";
    } elseif ($estado_civ == "2") {
        $estado_civ = "Casado";
    } elseif ($estado_civ == "3") {
        $estado_civ = "Unión Libre";
    } elseif ($estado_civ == "4") {
        $estado_civ = "Divorciad@";
    } elseif ($estado_civ == "5") {
        $estado_civ = "Viud@";
    } else {
        $estado_civ = "Valor inválido";
    }


    $religion = $_POST['religion'];
    $nacionalidad = $_POST['nacionalidad'];

    if($nacionalidad == 1){
        $nacionalidad = 'Mexicana';
    }elseif($nacionalidad == 2){
        $nacionalidad = 'Estado unidense';
    }elseif($nacionalidad == 3){
        $nacionalidad = 'Guatemalteca';
    }elseif($nacionalidad == 4){
        $nacionalidad = 'Salvadoreña';
    }elseif($nacionalidad == 5){
        $nacionalidad = 'Hondureña';
    }elseif($nacionalidad == 6){
        $nacionalidad = 'Colombiana';
    }elseif($nacionalidad == 7){
        $nacionalidad = 'Española';
    }elseif($nacionalidad == 8){
        $nacionalidad = 'Cubana';
    }elseif($nacionalidad == 9){
        $nacionalidad = 'Argentina';
    }elseif($nacionalidad == 10){
        $nacionalidad = 'Venezolana';
    }elseif($nacionalidad == 11){
        $nacionalidad = 'Peruana';
    }elseif($nacionalidad == 12){
        $nacionalidad = 'Brasileña';
    }elseif($nacionalidad == 13){
        $nacionalidad = 'Alemana';
    }elseif($nacionalidad == 14){
        $nacionalidad = 'Francesa';
    }elseif($nacionalidad == 15){
        $nacionalidad = 'Italiana';
    }elseif($nacionalidad == 16){
        $nacionalidad = 'Canadiense';
    }elseif($nacionalidad == 17){
        $nacionalidad = 'Británica';
    }elseif($nacionalidad == 18){
        $nacionalidad = 'China';
    }elseif($nacionalidad == 19){
        $nacionalidad = 'Coreana';
    }elseif($nacionalidad == 20){
        $nacionalidad = 'Japonesa';
    }

    $grupo_et = $_POST['grupo_et'];
    $sangre = $_POST['sangre'];
    $tipo_serv = $_POST['tipo_serv'];

    if($tipo_serv == 1){
        $tipo_serv = 'Optometrista';
    }elseif($tipo_serv == 2){
        $tipo_serv = 'Dental';
    }elseif($tipo_serv == 3){
        $tipo_serv = 'Pediatria';
    }elseif($tipo_serv == 4){
        $tipo_serv = 'Medico General';
    }elseif($tipo_serv == 5){
        $tipo_serv = 'Homeopatia';
    }elseif($tipo_serv == 6){
        $tipo_serv = 'Nutricion';
    }

    session_start();
    $elaborado = $_SESSION['Elaborado'];
    $primera = $_POST['primera'];

    if (isset($_POST['canalizado'])) { // Verificar si el checkbox ha sido marcado
        $canalizado = "Si"; // Asignar "Si" a la variable de respuesta si el checkbox está marcado
    } else {
        $canalizado = "No"; // Asignar "No" a la variable de respuesta si el checkbox no está marcado
    }


    if (isset($_POST['directo'])) { 
        $directo = "Si";
        $Estatus = "URGENTE";
    } else {
        $directo = "No"; 
        $Estatus = "Pendiente";
    }

      // Verificar si el nombre ya existe en la base de datos
        $consulta_existencia = "SELECT NombreCom FROM pacientes WHERE NombreCom = '$full_name'";
        $resultado_existencia = $mysqli->query($consulta_existencia);

    if ($resultado_existencia->num_rows > 0) {
        // El paciente ya existe, mostrar mensaje de error
        echo '<script language="javascript"> alert("El paciente ya existe"); window.history.back();  </script>';
    } else {
        // El paciente no existe, realizar la inserción
        $consulta = "INSERT INTO pacientes (NombreCom, FechaNac, Edad, Genero, LugarNac, Domicilio, Colonia, Municipio, Telefono, Ocupacion, Escolaridad, EstadoCiv, Religion, Nacionalidad, GrupoEt, GrupoRh, TipoServ, ElaboradoPor, Citade, Canalizado, Directo, HoraFech, Estatus)
                     VALUES ('$full_name','$fecha','$edad','$genero','$lug_name','$domicilio','$colonia','$municipio','$phone','$ocupacion','$escolaridad','$estado_civ','$religion','$nacionalidad','$grupo_et','$sangre','$tipo_serv','$elaborado','$primera','$canalizado','$directo', NOW(), '$Estatus')";

        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            $sql = "SELECT * FROM pacientes";
                  $result = mysqli_query($mysqli,$sql);

                  while ($mostrar = mysqli_fetch_array($result)){
                    $id_paciente = $mostrar['ID_Paciente'];
                    $otraConsulta = "INSERT INTO consultas (ID_Paciente,NombreCom, FechaNac, Edad, Genero, LugarNac, Domicilio, Colonia, Municipio, Telefono, Ocupacion, Escolaridad, EstadoCiv, Religion, Nacionalidad, GrupoEt, GrupoRh, TipoServ, ElaboradoPor, Citade, Canalizado, Directo, HoraFech, Estatus)
                         VALUES ('$id_paciente','$full_name','$fecha','$edad','$genero','$lug_name','$domicilio','$colonia','$municipio','$phone','$ocupacion','$escolaridad','$estado_civ','$religion','$nacionalidad','$grupo_et','$sangre','$tipo_serv','$elaborado','$primera','$canalizado','$directo', NOW(), '$Estatus')";
                  }
            if ($mysqli->query($otraConsulta) === TRUE) {

                echo '<script language="javascript"> alert("Paciente agregado correctamente"); window.location.href="../dashboard_recep.php" </script>';

            } else {
                // Mostrar mensaje de error
                echo "Error al agregar el paciente: " . $mysqli->error;
            }
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al agregar el paciente: " . $mysqli->error;
        }
    }


    
}
 
// Cerrar la conexión
$mysqli->close();
