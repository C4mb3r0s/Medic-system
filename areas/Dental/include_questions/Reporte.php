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
    $sql = "SELECT Consulta, Curacion, Extraccion, Pulpotomia, Limpieza, Radiografia, Resina, Notas
            FROM  tratamientosdental WHERE ID_Registro='$ID'";

    $resultado = $mysqli->query($sql);

   
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            $pdf->Ln(5);
            $pdf->SetFont("Arial", "B", 12);
            $pdf->Cell(190, 5, "TRATAMIENTOS", 0, 1, "C");
            $pdf->Ln(2);
            $pdf->SetFont("Arial", "", 10); 
            $pdf->MultiCell(201, 5, utf8_decode("CONSULTA: ".$row['Consulta']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("CURACIÓN: ".$row['Curacion']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("EXTRACCIÓN: ".$row['Extraccion']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("PULPOTOMIA: ".$row['Pulpotomia']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("LIMPIEZA: ".$row['Limpieza']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("RADIOGRAFIA: ".$row['Radiografia']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("RESINA: ".$row['Resina']), 0, "c");
            $pdf->MultiCell(201, 5, utf8_decode("NOTAS: ".$row['Notas']), 0, "c");
        }
    } else {
        $pdf->SetFont("Arial", "", 10);
    }
    $pdf->Output();


?>