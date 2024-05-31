<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['Id_autorisation'])) {
    $id = $_GET['Id_autorisation'];
    $sql ="SELECT
    a.Id_autorisation,
    a.numero_decision,
    a.date_decision,
    a.duree_dembarquement,
    a.date_delivrance,
    a.lieu_delivrance,
    a.numero_demande,
    a.date_demande,
    a.nom_emetteur,
    a.prenom_emetteur,
    a.fonction_emetteur,
    n.nom_navire,
    n.nom_compagne,
    n.numero_navire,
    n.lieu_enregistrement_navire,
    n.propriétaire_navire,
    n.fonction_propriétaire_navire,
    i.nom_interesse,
    i.nationnalite_interesse,
    i.date_de_naissance_interesse,
    i.lieu_de_naissance_interesse,
    i.qualite_interesse,
    i.id_interesse
FROM Autorisation a
LEFT JOIN navire n ON a.id_navire = n.id_navire
LEFT JOIN Interesse_Autorisation ia ON a.Id_autorisation = ia.Id_autorisation
LEFT JOIN Interesse i ON a.id_interesse = i.id_interesse
WHERE a.Id_autorisation = $id";
//LEFT JOIN (SELECT id_pays, nom_pays,nom_arabe_paysFROM pays) p ON m.id_pays = p.id_pays

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


$pdf->SetTitle("Autorisation");
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



//freeserif
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetY(10); 
$pdf->MultiCell(0, 0, "الــجمهـورية الـجـزائـريـة الـديمـوقــراطـيـة الـشـعـــبية 
", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 
$pdf->SetY(11); 
$pdf->SetFont('freeserif', 'B', 13, '', true);
$pdf->MultiCell(0, 4, "
REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);


$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetY(18); 
$pdf->MultiCell(0, 5, "
وزارة النقل", 0, 'C', false, 1, '', '', true, 0, false, true, 0);
$pdf->SetFont('freeserif', '', 13, '', true);
$pdf->SetY(33);
$pdf->MultiCell(0, 5, "MINISTERE DES TRANSPORTS", 0, 'C');


$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetY(40);
$pdf->setRTL(true);
$pdf->MultiCell(0, 5, "
المديرية العامة للبحرية التجارية
والموانئ مديرية البحرية التجارية
الجزائر في: ".$row['date_decision']."
", 0, '');
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->SetY(44);
$pdf->setRTL(false);
$pdf->MultiCell(0, 5, "
DIRECTION GENERALE DE LA MARINE MARCHANDE ET DES PORTS 
DIRECTION DE LA MARINE MARCHANDE
N° -------DMM/DGMMP/--------
", 0, '');
//-----------------------------------------




//freeserif

$pdf->SetY(70); 
$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->MultiCell(0, 4, "
D  E  C  I  D  E
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);



$pdf->SetFillColor(0, 0, 0); // Set fill color to black
$pdf->Circle(20, 100, 0.7, 0, 360, 'DF'); // Draw a filled circle (X, Y, radius, angle start, angle end, style)
$pdf->setRTL(false);
$pdf->SetXY(23,90); 
$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->MultiCell(0, 5, "
Objet :", 0, '');
$pdf->SetXY(40,90);
$pdf->SetFont('freeserif', '', 14, '', true);

$pdf->MultiCell(0, 5, "
Autorisation d’embarquement
", 0, '');

$pdf->SetFillColor(0, 0, 0); // Set fill color to black
//$pdf->Circle(20, 90, 0.7, 0, 360, 'DF'); // Draw a filled circle (X, Y, radius, angle start, angle end, style)
//$pdf->setRTL(false);
//$pdf->SetXY(23,80); 
//$pdf->SetFont('freeserif', 'B', 13, '', true);
//$pdf->MultiCell(0, 5, "
//Ref :", 0, '');
//$pdf->SetXY(40,80);
//$pdf->SetFont('freeserif', '', 13, '', true);

//$pdf->MultiCell(0, 5, "
//".$row['ref']." 
//", 0, '');

$pdf->SetFillColor(0, 0, 0); // Set fill color to black
//$pdf->Circle(20, 120, 0.7, 0, 360, 'DF'); // Draw a filled circle (X, Y, radius, angle start, angle end, style)
$pdf->setRTL(false);
$pdf->SetXY(15,110); 
$pdf->SetFont('freeserif', 'B', 12, '', true);
$pdf->MultiCell(0, 5, "
ARTICLE 1er :", 0, '');
$pdf->SetFont('freeserif', '', 15, '', true);
$pdf->SetXY(15,120);
$pdf->MultiCell(0, 5, "
Monsieur ".$row['nom_interesse'].", né le ".$row['date_de_naissance_interesse'].", à ".$row['lieu_de_naissance_interesse'].", de nationalité ".$row['nationnalite_interesse'].", en qualité de ".$row['qualite_interesse'].", est autorisés à embarquer à bord des navires appartenant à ".$row['nom_compagne'].", et ce, pour une durée de ".$row['duree_dembarquement']." à compter de la signature de la présente décision. 
", 0, '');
//-----------------------------------------

$pdf->SetFont('freeserif', 'B', 12, '', true);
$pdf->SetY(160);
$pdf->MultiCell(0, 5, "
ARTICLE 2 :
", 0, '');
$pdf->SetY(170);
$pdf->SetFont('freeserif', '', 15, '', true);
$pdf->MultiCell(0, 5, "
L’armateur est tenu d’informer l’Administration Maritime de tout changement pouvant affecter la mise en œuvre de cette décision.
", 0, '');
$pdf->SetY(200);
$pdf->SetFont('freeserif', 'B', 12, '', true);
$pdf->MultiCell(0, 5, "
ARTICLE 3 : 
", 0, '');
$pdf->SetFont('freeserif', '', 15, '', true);
$pdf->SetY(210);
$pdf->MultiCell(0, 5, "
Monsieur le Chef du Département des Affaires Maritimes (Service National des Garde-Côtes) est chargé, de l’application de la présente décision.
", 0, '');

$pdf->setRTL(true);
$pdf->SetXY(50,230);
$pdf->SetFont('freeserif', 'B', 12, '', true);
$pdf->MultiCell(0, 5, "
Fait à Alger le ".$row['date_decision']."
", 0, '');

$pdf->setRTL(false);
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->SetY(275);
$pdf->MultiCell(0, 5, "
Copie:Mr le DG de l’Hyproc Shipping Company spa.
", 0, '');
$pdf->writeHTML($html);

$pdf->Output('autorisation.pdf', 'I');
}