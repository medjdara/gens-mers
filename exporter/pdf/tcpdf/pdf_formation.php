<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');



if (isset($_GET['Id_PVF'])) {
    $Id_PVF = $_GET['Id_PVF'];
    $sql = "SELECT
        pf.Id_PVF, pf.date_pvf, pf.heure_pvf, pf.lieu_pvf, pf.nom_pj_pvf,
        pf.date_reunion, pf.ref_pvf, pf.titre_pvf, pf.objet_pvf,
        pf.deroulement, pf.conclusion, pf.heure_fin,
        pfe.*, pe.nom_et_prenom AS nom_employe, f.nom_fonction
    FROM pv_formation_employe pfe
    LEFT JOIN pv_formation pf ON pf.Id_PVF = pfe.Id_PVF
    JOIN employe pe ON pfe.id_employe = pe.id_employe
    JOIN fonction f ON pfe.id_fonction = f.id_fonction
    WHERE pf.Id_PVF = $Id_PVF";

    //use for MySQLi OOP
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();


$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$pdf->setLanguageArray($lg);
$pdf->setRTL(true);

// Set a Unicode font that supports Arabic, French, and English characters


$pdf->SetTitle("demande participe resultat");
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '11', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 11);

$pdf->AddPage();
$content = '';
$pdf->SetLineWidth(0.5); // Set line width to 0.5
$pdf->SetFillColor(192, 192, 192); // Set fill color to light gray
$pdf->Rect(10, 10, 190, 20, 'FD'); // Draw a filled rectangle (X, Y, width, height, style)
$pdf->SetLineWidth(0.2); // Reset line width to default (0.2)

//freeserif
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetY(11); 
$pdf->MultiCell(0, 0, "".$row['titre_pvf']."", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 

$pdf->SetFillColor(0, 0, 0); // Set fill color to black
$pdf->Circle(20, 40, 0.7, 0, 360, 'DF'); // Draw a filled circle (X, Y, radius, angle start, angle end, style)
$pdf->setRTL(false);
$pdf->SetXY(23,30); 
$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->MultiCell(0, 5, "
Objet : ", 0, '');
$pdf->SetXY(40,30);
$pdf->SetFont('freeserif', '', 14, '', true);

$pdf->MultiCell(0, 5, "
".$row['objet_pvf']."
", 0, '');

$pdf->SetFillColor(0, 0, 0); // Set fill color to black
$pdf->Circle(20, 50, 0.7, 0, 360, 'DF'); // Draw a filled circle (X, Y, radius, angle start, angle end, style)
$pdf->setRTL(false);
$pdf->SetXY(23,40); 
$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->MultiCell(0, 5, "
Date :", 0, '');
$pdf->SetXY(40,40);
$pdf->SetFont('freeserif', '', 14, '', true);

$pdf->MultiCell(0, 5, "
".$row['date_pvf']." à ".$row['heure_pvf']."
", 0, '');



$pdf->SetFillColor(0, 0, 0); // Set fill color to black
$pdf->Circle(20, 60, 0.7, 0, 360, 'DF'); // Draw a filled circle (X, Y, radius, angle start, angle end, style)
$pdf->setRTL(false);
$pdf->SetXY(23,50); 
$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->MultiCell(0, 5, "
Lieu :", 0, '');
$pdf->SetXY(40,50);
$pdf->SetFont('freeserif', '', 14, '', true);

$pdf->MultiCell(0, 5, "
".$row['lieu_pvf']."
", 0, '');

$pdf->SetFillColor(0, 0, 0); // Set fill color to black
$pdf->Circle(20, 70, 0.7, 0, 360, 'DF'); // Draw a filled circle (X, Y, radius, angle start, angle end, style)
$pdf->setRTL(false);
$pdf->SetXY(23,60); 
$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->MultiCell(0, 5, "
P.J :", 0, '');
$pdf->SetXY(40,60);
$pdf->SetFont('freeserif', '', 14, '', true);

$pdf->MultiCell(0, 5, "
".$row['nom_pj_pvf']."
", 0, '');

$pdf->SetY(75);
$pdf->MultiCell(0, 5, "
Réunion tenue le ".$row['date_pvf'].", au niveau du ".$row['lieu_pvf'].", 
Etaient présents :
", 0, '');


$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->SetY(88);
$pdf->MultiCell(0, 5, "
Madame/Monsieur :", 0, '');

// Display list of employees and their functions
$sql_employees = "SELECT pe.nom_et_prenom AS nom_employe, f.nom_fonction
                  FROM pv_formation_employe pfe
                  JOIN employe pe ON pfe.id_employe = pe.id_employe
                  JOIN fonction f ON pfe.id_fonction = f.id_fonction
                  JOIN pv_formation pf ON pf.Id_PVF = pfe.Id_PVF
                  WHERE pf.Id_PVF = $Id_PVF";


$result = $conn->query($sql_employees);
$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetY(105);
if ($result->num_rows > 0) {
    while ($employee = $result->fetch_assoc()) {
        $employeeString = "  <b>- " . $employee['nom_employe'] . "</b>, " . $employee['nom_fonction'] . ".";
        $pdf->writeHTML($employeeString, true, false, false, false, '');
    }
} else {
    $pdf->MultiCell(0, 5, "No employees found", 0, '');
}







$pdf->SetLineWidth(0.5); // Set line width to 0.5
$pdf->SetFillColor(192, 192, 192); // Set fill color to light gray
$pdf->Rect(10, 170, 190, 7, 'FD'); // Draw a filled rectangle (X, Y, width, height, style)
$pdf->SetLineWidth(0.2); // Reset line width to default (0.2)
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetY(171);
$pdf->MultiCell(0, 5, "Référence : ", 0, '');
$pdf->SetFont('freeserif', '', 13, '', true);
$pdf->SetY(178);
$pdf->MultiCell(0, 5, "".$row['ref_pvf']."", 0, '');
$pdf->writeHTML($html);
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetLineWidth(0.5); // Set line width to 0.5
$pdf->SetFillColor(192, 192, 192); // Set fill color to light gray
$pdf->Rect(10, 195, 190, 7, 'FD'); // Draw a filled rectangle (X, Y, width, height, style)
$pdf->SetLineWidth(0.2); // Reset line width to default (0.2)
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetY(195);
$pdf->MultiCell(0, 5, "Déroulement de la réunion : ", 0, '');
$pdf->SetY(205);
$pdf->SetFont('freeserif', '', 13, '', true);
$pdf->MultiCell(0, 5, "".$row['deroulement']."", 0, '');

    //---------table ---------------
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->SetFillColor(211, 211, 211); // RGB value for light gray
// Header row
$pdf->SetXY(5, 220);
$pdf->MultiCell(30, 10, "CATEGORIE",  0, 'C');
$pdf->SetXY(5, 220);
$pdf->MultiCell(30, 10, "", 1, 0, 'C', true);
$pdf->SetXY(35, 220);
$pdf->MultiCell(80, 10, "", 1, 0, 'C', true);
$pdf->SetXY(35, 220);
$pdf->MultiCell(80, 10, "PNC", 0, 'C');
$pdf->SetXY(115, 220);
$pdf->MultiCell(80, 10, "CNC", 0, 'C');
$pdf->SetXY(115, 220);
$pdf->MultiCell(80, 10, "", 1, 0, 'C', true);

// Data rows

//  row 4
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->SetXY(5, 230);
$pdf->MultiCell(30, 10, '', 1, 0, 'C', true);
$pdf->SetXY(5, 230);
$pdf->MultiCell(30, 10, 'NUM ', 0, 'C');
$pdf->SetXY(35, 230);  
$pdf->MultiCell(80, 10, '', 1, 'C'); // Pont column 4
$pdf->SetXY(35, 230); 
$pdf->MultiCell(80, 10, '..', 1, 'C'); // Pont column 4

$pdf->SetXY(115, 230); 
$pdf->MultiCell(80, 10, '', 1, 'C'); // Pont column 8
$pdf->SetXY(115, 230); 
$pdf->MultiCell(80, 10, '..', 1, 'C'); // Pont column 8



//-----------------------------------
$pdf->SetY(280);
$pdf->MultiCell(0, 5, "La séance fut levée à ".$row['heure_fin']." ", 0, '');
$pdf->Output('formation.pdf', 'I');
}