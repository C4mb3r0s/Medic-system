<?php

require '../../../fpdf/fpdf.php';


$medico = $_SESSION['Nombre'];

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    global $medico;
    global $ID;
    // Logo
    $this->Image('',10,2,60);
    // Arial bold 15
    $this->SetFont("Arial", "B", 9);
    $this->Cell(200, 5, "", 0, 1, "R");
    $this->Cell(200, 5, utf8_decode("DIRECCIÓN DE SERVICIOS MÉDICOS ASISTENCIALES"), 0, 1, "R");
    $this->Cell(200, 5, utf8_decode("UNIDAD DE CIRUGÍA AMBULATORIA"), 0, 1, "R");
    $this->Cell(200, 5, utf8_decode("MEDICO: " . $medico), 0, 1, "R");
    $this->Cell(200, 5, utf8_decode("N° DE EXPEDIENTE: " . $ID), 0, 1, "R");
    // Salto de línea
    $this->Ln(2);
    $this->SetDrawColor(0, 0, 0); // Establecer el color de la línea (en este caso, negro)
    $this->SetLineWidth(0.5); // Establecer el grosor de la línea
    $this->Line(10, $this->GetY(), 209, $this->GetY());
    $this->Ln(5);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-20);
    // Arial italic 8
    $this->SetFont('Arial','B',10);
    // Número de página
    $this->Cell(0, 10, 'Pagina '. $this->PageNo() . '/{nb}' ,0 ,0 , 'R');
}
}



?>
