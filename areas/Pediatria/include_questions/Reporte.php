<?php

    session_start();
    require "conexion.php";
    require "Plantilla.php";

    if(isset($_GET['id'])){
        $ID = $_GET['id'];
    }elseif(isset($_GET['id2'])){
        $ID = $_GET['id2'];
    }    

    $pdf = new PDF("P","mm","Letter");
    $pdf->AliasNbPages();
    $pdf->SetMargins(8,8,8);
    $pdf->AddPage();
    
    $sql = "SELECT NombreCom, FechaNac, Edad, Genero, LugarNac, Domicilio, Colonia, Municipio, Telefono, Ocupacion, 
                    Escolaridad, EstadoCiv, Religion, Nacionalidad, GrupoEt, GrupoRh, TipoServ, ElaboradoPor, Citade,
                    Canalizado, Directo FROM consultas WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);
        while($row = $resultado->fetch_assoc()){
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, utf8_decode("FICHA DE IDENTIFICACIÓN"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10);  
            $pdf->Cell(110, 5, utf8_decode("NOMBRE COMPLETO: ".$row['NombreCom']), 0, 0, "c");
            $pdf->Cell(65, 5, "FECHA DE NACIMIENTO: ".$row['FechaNac'], 0, 0, "c");
            $pdf->Cell(20, 5, utf8_decode("EDAD: ".$row['Edad']), 0, 1, "c");
            $pdf->Ln(1);
            $pdf->Cell(70, 5, utf8_decode("GÉNERO: ".$row['Genero']).'.', 0, 0, "c");
            $pdf->Cell(70, 5, utf8_decode("LUGAR DE NACIMIENTO: ".$row['LugarNac']).'.', 0, 0, "c");
            $pdf->Cell(52, 5, utf8_decode("DOMICILIO: ".$row['Domicilio']), 0, 1, "c");
            $pdf->Ln(1);
            $pdf->Cell(70, 5, utf8_decode("COLONIA: ".$row['Colonia']), 0, 0, "c");
            $pdf->Cell(70, 5, utf8_decode("MUNICIPIO: ".$row['Municipio']), 0, 0, "c");
            $pdf->Cell(40, 5, utf8_decode("TELÉFONO: ".$row['Telefono']), 0, 1, "c");
            $pdf->Ln(1);
            $pdf->Cell(70, 5, utf8_decode("OCUPACIÓN: ".$row['Ocupacion']), 0, 0, "c");
            $pdf->Cell(70, 5, utf8_decode("ESCOLARIDAD: ".$row['Escolaridad']), 0, 0, "c");
            $pdf->Cell(100, 5, utf8_decode("ESTADO CIVIL: ".$row['EstadoCiv']), 0, 1, "c");
            $pdf->Ln(1);
            $pdf->Cell(70, 5, utf8_decode("RELIGIÓN: ".$row['Religion']), 0, 0, "c");
            $pdf->Cell(70, 5, utf8_decode("NACIONALIDAD: ".$row['Nacionalidad']), 0, 0, "c");
            $pdf->Cell(100, 5, utf8_decode("GRUPO ÉTNICO: ".$row['GrupoEt']), 0, 1, "c");
            $pdf->Ln(1);
            $pdf->Cell(70, 5, utf8_decode("GRUPO Y RH: ".$row['GrupoRh']), 0, 0, "c");
            $pdf->Cell(70, 5, utf8_decode("TIPO DE SERVICIO: ".$row['TipoServ']), 0, 0, "c");
            $pdf->Cell(70, 5, utf8_decode("VISITA: ".$row['Citade']), 0, 1, "c");
            $pdf->Ln(1);
            
            $pdf->Cell(70, 5, utf8_decode("¿LLEGÓ CANALIZADO?: ".$row['Canalizado']), 0, 0, "c");
            $pdf->Cell(100, 5, utf8_decode("¿DIRECTO?: ".$row['Directo']), 0, 1, "c");
        }
    //signos vitales
    $sql = "SELECT PresionArt, SaturacionOx, FrecuenciaCar, PesoActual, Temperatura, Talla, FrecuenciaRes, IndiceMasaCorp
            FROM  signosvitales WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

   
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, "SIGNOS VITALES", 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->Cell(75, 5, utf8_decode("PRESIÓN ARTERIAL: ".$row['PresionArt']), 0, 0, "c");
            $pdf->Cell(75, 5, utf8_decode("SATURACIÓN DE OXÍGENO: ".$row['SaturacionOx']), 0, 0, "c");
            $pdf->Cell(75, 5, utf8_decode("FRECUENCIA CARDÍACA: ".$row['FrecuenciaCar']), 0, 1, "c");
            $pdf->Ln(1);
            $pdf->Cell(75, 5, utf8_decode("PESO ACTUAL: ".$row['PesoActual']), 0, 0, "c");
            $pdf->Cell(75, 5, utf8_decode("TEMPERATURA: ".$row['Temperatura']), 0, 0, "c");
            $pdf->Cell(75, 5, utf8_decode("TALLA: ".$row['Talla']), 0, 1, "c");
            $pdf->Ln(1);
            $pdf->Cell(100, 5, utf8_decode("FRERCUENCIA RESPIRATORIA ".$row['FrecuenciaRes']), 0, 0, "c");
            $pdf->Cell(100, 5, utf8_decode("ÍNDICE DE MASA CORPORAL: ".$row['IndiceMasaCorp']), 0, 1, "c");   
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }


    //heredo familiares
    $sql = "SELECT Oncologico, Alergicos, Hipertensivos, Diabeticos, Cardiovasculares, Otros, Observaciones FROM heredofam
            WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

   
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, "ANTECEDENTES HEREDO FAMILIARES", 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->MultiCell(201, 5, utf8_decode("ONCOLÓGICOS: ".$row['Oncologico']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("ALÉRGICOS: ".$row['Alergicos']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("HIPERTENSIVOS: ".$row['Hipertensivos']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("DIABÉTICOS: ".$row['Diabeticos']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("CARDIOVASCULARES: ".$row['Cardiovasculares']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("OTROS: ".$row['Otros']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("OBSERVACIONES: ".$row['Observaciones']), 0,"c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }


    //personales patologicos
        $sql = "SELECT Tabaquismo, Tabpasivo, Inicio, Cantidad, ExTabaquismo, Hepatico, Cardiacas, Diabeticos, Quirurgicos, Renal, Fracturas,
                Hospitalizacion, Hipertensivos, Neurologicos, Observaciones FROM personalespat WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

    
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, utf8_decode("ANTECEDENTES PERSONALES PATOLÓGICOS"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10);
            $pdf->Multicell(201, 5, utf8_decode("TABAQUISMO: ".$row['Tabaquismo']), 0, "r");
            $pdf->Multicell(201, 5, utf8_decode("TABAQUISMO PASIVO: ".$row['Tabpasivo']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("INICIO: ".$row['Inicio']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("CANTIDAD: ".$row['Cantidad']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("EX-TABAQUISMO: ".$row['ExTabaquismo']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("HEPÁTICOS: ".$row['Hepatico']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("CARDIACOS: ".$row['Cardiacas']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("DIABÉTICOS: ".$row['Diabeticos']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("QUIRÚRGICOS: ".$row['Quirurgicos']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("RENAL: ".$row['Renal']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("FRACTURAS: ".$row['Fracturas']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("HOSPITALIZACIÓN: ".$row['Hospitalizacion']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("HIPERTENSIVOS: ".$row['Hipertensivos']), 0, "c");
            $pdf->Multicell(201, 5, utf8_decode("NEUROLÓGICOS: ".$row['Neurologicos']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("OBSERVACIONES: ".$row['Observaciones']), 0, "c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }

    //Ginecologicos
    $sql = "SELECT FechaMasto, Resultado, Menorca, Observaciones FROM ginecoobs WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, utf8_decode("ANTECEDENTES GINECO - OBSTÉTRICOS"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->Cell(100, 5, utf8_decode("FECHA DE LA ULTIMA MASTOGRAFÍA: ".$row['FechaMasto']), 0, 0, "r");
            $pdf->Ln(5);
            $pdf->MultiCell(201, 5, utf8_decode("RESULTADO: ".$row['Resultado']), 0, "c");
            $pdf->Cell(100, 5, utf8_decode("MENORCA: ".$row['Menorca']), 0, 0, "r");
            $pdf->Ln(5);
            $pdf->MultiCell(201, 5, utf8_decode("OBSERVACIONES: ".$row['Observaciones']), 0, "c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }

    //Pedecimiento actual
    $sql = "SELECT FechaInicio, Sintomas, DescripcionEvol FROM padecimientoactual WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

 
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, "PADECIMIENTO ACTUAL", 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->Multicell(201, 5, "FECHA DE INICIO: ".$row['FechaInicio'], 0, "r");
            $pdf->Multicell(201, 5, utf8_decode("SÍNTOMAS DE INICIO: ".$row['Sintomas']), 0, "c");
           
            $pdf->Multicell(201, 5, utf8_decode("DESCRIBA LA EVOLUCIÓN DE CUADRO CLÍNICO Y LOS TRATAMIENTOS PREVIOS DE TIPO CONVENCIONAL ALTERNARTIVOS Y TRADICIONALES: ".$row['DescripcionEvol']), 0, "c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }

    //Interrogatorio por aparatos y sistemas
    $sql = "SELECT Respiratorio, Cardio, Digestivo, Urinario, Hemolinfatico, Endocrino, SistemaNervioso, OsteoMuscular, Tegumentos
            FROM interrogatorioaparatos WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

 
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, "INTERROGATORIO POR APARATOS Y SISTEMAS", 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->MultiCell(201, 5, utf8_decode("RESPIRATORIO: ".$row['Respiratorio']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("CARDIO CIRCULATORIO: ".$row['Cardio']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("DIGESTIVO: ".$row['Digestivo']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("URINARIO: ".$row['Urinario']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("HEMOLINFATICO: ".$row['Hemolinfatico']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("ENDOCRINO: ".$row['Endocrino']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("SISTEMA NERVIOSO: ".$row['SistemaNervioso']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("OSTEOMUSCULAR: ".$row['OsteoMuscular']), 0,"c");
            $pdf->Ln(1);
            $pdf->MultiCell(201, 5, utf8_decode("TEGUMENTOS: ".$row['Tegumentos']), 0,"c");

        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }


    //Exploracion-fisica
    $sql = "SELECT Inspeccion, Cabeza, Cuello, Torax, Mamas, Abdomen, Extremidades 
            FROM exploracion WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, utf8_decode("EXPLORACIÓN FÍSICA"), 0, 1, "C");
            $pdf->Ln(1);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->Multicell(201, 5, utf8_decode("CABEZA: ".$row['Cabeza']), 0, "c");
            $pdf->Ln(1);
            $pdf->Multicell(201, 5, utf8_decode("CUELLO: ".$row['Cuello']), 0, "c");
            $pdf->Ln(1);
            $pdf->Multicell(201, 5, utf8_decode("TÓRAX: ".$row['Torax']), 0, "c");
            $pdf->Ln(1);
            $pdf->Multicell(201, 5, utf8_decode("MAMAS: ".$row['Mamas']), 0, "c");
            $pdf->Ln(1);
            $pdf->Multicell(201, 5, utf8_decode("ABDOMEN: ".$row['Abdomen']), 0, "c");
            $pdf->Ln(1);
            $pdf->Multicell(201, 5, utf8_decode("EXTREMIDADES: ".$row['Extremidades']), 0, "c");
            $pdf->SetFont("Arial", "", 10); 
            $pdf->Multicell(201, 5, utf8_decode("INSPECCIÓN GENERAL: ".$row['Inspeccion']), 0, "c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }


    //Exploracion-fisica
    $sql = "SELECT Generales FROM evaluaciones WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);


    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, "EVALUACIONES ESPECIALES NECESARIAS", 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->Multicell(201, 5, utf8_decode("ESTUDIOS: ".$row['Generales']), 0, "c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }
    //Exploracion-fisica
    $sql = "SELECT Nota FROM notas WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

    
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, utf8_decode("NOTAS MÉDICAS"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->Multicell(201, 5, utf8_decode("NOTA: ".$row['Nota']), 0, "c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }
    $pdf->Output();


?>