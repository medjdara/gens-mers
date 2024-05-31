<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['Id_PVA'])) {
    $id = $_GET['Id_PVA'];
    $sql ="SELECT
    pva.Id_PVA, pva.titre_pva, pva.objet_pva, pva.date_pva, 
    pva.heure_pva, pva.lieu_pva, pva.nom_pj_pva, pva.date_reunion,
    pva.ref_pva, pva.deroulement, pva.conclusion, pva.heure_fin,
    pee.*, pe.nom_et_prenom AS nom_employe, f.nom_fonction
FROM pv_admis_employe pee
LEFT JOIN pv_admis pva ON pva.Id_PVA = pee.Id_PVA
JOIN employe pe ON pee.id_employe = pe.id_employe
JOIN fonction f ON pee.id_fonction = f.id_fonction
WHERE pva.Id_PVA = $id";
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
$pdf->MultiCell(0, 0, "".$row['titre_pva']."
", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 

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
".$row['objet_pva']."
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
".$row['date_pva']." à ".$row['heure_pva']."
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
".$row['lieu_pva']."
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
".$row['nom_pj_pva']."
", 0, '');

$pdf->SetY(75);
$pdf->MultiCell(0, 5, "
Réunion tenue le ".$row['date_pva'].", au niveau du ".$row['lieu_pva'].", 
Etaient présents :
", 0, '');


$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->SetY(88);
$pdf->MultiCell(0, 5, "
Madame/Monsieur :", 0, '');

// Display list of employees and their functions
$sql_employees = "SELECT pe.nom_et_prenom AS nom_employe, f.nom_fonction
                  FROM pv_admis_employe pfa
                  JOIN employe pe ON pfa.id_employe = pe.id_employe
                  JOIN fonction f ON pfa.id_fonction = f.id_fonction
                  JOIN pv_admis pf ON pf.Id_PVA = pfa.Id_PVA
                  WHERE pf.Id_PVA = $id";


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
$pdf->MultiCell(0, 5, "".$row['ref_pva']."", 0, '');
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
$pdf->MultiCell(80, 10, "PONT", 0, 'C');
$pdf->SetXY(115, 220);
$pdf->MultiCell(80, 10, "MACHINE", 0, 'C');
$pdf->SetXY(115, 220);
$pdf->MultiCell(80, 10, "", 1, 0, 'C', true);

// Data rows
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->SetXY(5, 230);
$pdf->MultiCell(30, 10, '', 1, 0, 'C', true);
$pdf->SetXY(5, 230);
$pdf->MultiCell(30, 10, 'RESULTAT', 0, 'C');
$pdf->SetXY(35, 230);  
$pdf->MultiCell(20, 10, '', 1, 0, 'C', true); // Pont column 1
$pdf->SetXY(35, 230);  
$pdf->MultiCell(20, 10, 'Admis', 0, 'C'); // Pont column 1

$pdf->SetXY(55, 230);
$pdf->MultiCell(20, 10, '', 1, 0, 'C', true); // Pont column 2
$pdf->SetXY(55, 230);
$pdf->MultiCell(20, 10, 'Rattrapage', 0, 'C'); // Pont column 2

$pdf->SetXY(75, 230);
$pdf->MultiCell(20, 10, '',  1, 0, 'C', true); // Pont column 3
$pdf->SetXY(75, 230);
$pdf->MultiCell(20, 10, 'Ajourné', 0, 'C'); // Pont column 3

$pdf->SetXY(95, 230);
$pdf->MultiCell(20, 10, '', 1, 0, 'C', true); // Pont column 4
$pdf->SetXY(95, 230);
$pdf->MultiCell(20, 10, 'Absent', 1, 'C'); // Pont column 4

$pdf->SetXY(115, 230); 
$pdf->MultiCell(20, 10, '', 1, 0, 'C', true); // Pont column 5
$pdf->SetXY(115, 230);  
$pdf->MultiCell(20, 10, 'Admis', 0, 'C'); // Pont column 5

$pdf->SetXY(135, 230);
$pdf->MultiCell(20, 10, '', 1, 0, 'C', true); // Pont column 6
$pdf->SetXY(135, 230);
$pdf->MultiCell(20, 10, 'Rattrapage', 0, 'C'); // Pont column 6

$pdf->SetXY(155, 230);
$pdf->MultiCell(20, 10, '', 1, 0, 'C', true); // Pont column 7
$pdf->SetXY(155, 230);
$pdf->MultiCell(20, 10, 'Ajourné', 0, 'C'); // Pont column 7

$pdf->SetXY(175, 230);
$pdf->MultiCell(20, 10, '', 1, 0, 'C', true); // Pont column 8
$pdf->SetXY(175, 230);
$pdf->MultiCell(20, 10, 'Absent', 1, 'C'); // Pont column 8
//  row 3
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->SetXY(5, 240);
$pdf->MultiCell(30, 10, '', 1, 0, 'C', true);
$pdf->SetXY(5, 240);
$pdf->MultiCell(30, 10, 'TOTAL', 0, 'C');
$pdf->SetXY(35, 240);  
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 1
$pdf->SetXY(35, 240);  
$pdf->MultiCell(20, 10, 'Admis', 0, 'C'); // Pont column 1

$pdf->SetXY(55, 240);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 2
$pdf->SetXY(55, 240);
$pdf->MultiCell(20, 10, 'Rattrapage', 0, 'C'); // Pont column 2

$pdf->SetXY(75, 240);
$pdf->MultiCell(20, 10, '', 1, ''); // Pont column 3
$pdf->SetXY(75, 240);
$pdf->MultiCell(20, 10, 'Ajourné', 0, 'C'); // Pont column 3

$pdf->SetXY(95, 240);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 4
$pdf->SetXY(95, 240);
$pdf->MultiCell(20, 10, 'Absent', 1, 'C'); // Pont column 4

$pdf->SetXY(115, 240); 
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 5
$pdf->SetXY(115, 240);  
$pdf->MultiCell(20, 10, 'Admis', 0, 'C'); // Pont column 5

$pdf->SetXY(135, 240);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 6
$pdf->SetXY(135, 240);
$pdf->MultiCell(20, 10, 'Rattrapage', 0, 'C'); // Pont column 6

$pdf->SetXY(155, 240);
$pdf->MultiCell(20, 10, '', 1, ''); // Pont column 7
$pdf->SetXY(155, 240);
$pdf->MultiCell(20, 10, 'Ajourné', 0, 'C'); // Pont column 7

$pdf->SetXY(175, 240);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 8
$pdf->SetXY(175, 240);
$pdf->MultiCell(20, 10, 'Absent', 1, 'C'); // Pont column 8

//  row 4
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->SetXY(5, 250);
$pdf->MultiCell(30, 10, '', 1, 0, 'C', true);
$pdf->SetXY(5, 250);
$pdf->MultiCell(30, 10, 'Pourcentage ', 0, 'C');
$pdf->SetXY(35, 250);  
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 1
$pdf->SetXY(35, 250);  
$pdf->MultiCell(20, 10, '..%', 0, 'C'); // Pont column 1

$pdf->SetXY(55, 250);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 2
$pdf->SetXY(55, 250);
$pdf->MultiCell(20, 10, '..%', 0, 'C'); // Pont column 2

$pdf->SetXY(75, 250);
$pdf->MultiCell(20, 10, '', 1, ''); // Pont column 3
$pdf->SetXY(75, 250);
$pdf->MultiCell(20, 10, '..%', 0, 'C'); // Pont column 3

$pdf->SetXY(95, 250);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 4
$pdf->SetXY(95, 250);
$pdf->MultiCell(20, 10, '..%', 1, 'C'); // Pont column 4

$pdf->SetXY(115, 250); 
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 5
$pdf->SetXY(115, 250);  
$pdf->MultiCell(20, 10, '..%', 0, 'C'); // Pont column 5

$pdf->SetXY(135, 250);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 6
$pdf->SetXY(135, 250);
$pdf->MultiCell(20, 10, '..%', 0, 'C'); // Pont column 6

$pdf->SetXY(155, 250);
$pdf->MultiCell(20, 10, '', 1, ''); // Pont column 7
$pdf->SetXY(155, 250);
$pdf->MultiCell(20, 10, '..%', 0, 'C'); // Pont column 7

$pdf->SetXY(175, 250);
$pdf->MultiCell(20, 10, '', 1, 'C'); // Pont column 8
$pdf->SetXY(175, 250);
$pdf->MultiCell(20, 10, '..%', 1, 'C'); // Pont column 8

//-----------------------------------


// Set the fill color to light gray
$pdf->SetFillColor(192, 192, 192); // RGB value for light gray

// Add a new page
$pdf->AddPage();

// Draw a filled rectangle and set line width
$pdf->SetLineWidth(0.5); // Set line width to 0.5
$pdf->Rect(10, 10, 190, 7, 'FD'); // Draw a filled rectangle (X, Y, width, height, style)
$pdf->SetLineWidth(0.2); // Reset line width to default (0.2)

// Set font for the conclusion
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetY(10);
$pdf->MultiCell(0, 5, "Conclusion: ", 0, '');

// Set font back to normal
$pdf->SetFont('freeserif', '', 13, '', true);
$pdf->MultiCell(0, 5, "".$row['conclusion']."
", 0, '');
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->MultiCell(0, 5, "La séance fut levée à ".$row['heure_fin']." ", 0, '');

//----------------------------------
$pdf->Output('delib resultat.pdf', 'I');
}