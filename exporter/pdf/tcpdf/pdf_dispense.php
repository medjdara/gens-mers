<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['Id_dispense'])) {
    $id = $_GET['Id_dispense'];
    $sql ="SELECT
    d.Id_dispense,
    d.NumeroR,
    d.date_dispense,
    d.periode,
    d.date_debut,
    d.date_fin,
    d.nom_navire,
    m.nom_et_prenom AS nom_marin,
    f.nom_fonction,
    t.nom_brevet 
FROM Dispense d
LEFT JOIN marin m ON d.id_marin = m.id_marin
LEFT JOIN type_brevet t ON d.id_tbrevet = t.id_tbrevet
LEFT JOIN fonction f ON d.id_fonction = f.id_fonction
WHERE Id_dispense = $id";
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


$pdf->SetTitle("Brevet");
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
الجزائر في: .........
", 0, '');
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->SetY(44);
$pdf->setRTL(false);
$pdf->MultiCell(0, 5, "
DIRECTION GENERALE DE LA MARINE MARCHANDE ET DES PORTS 
DIRECTION DE LA MARINE MARCHANDE
N°.....................DMM/DGMMP/2024
", 0, '');
//-----------------------------------------
$pdf->SetY(75);
$pdf->SetFont('freeserif', 'B', 13, '', true);
$pdf->MultiCell(0, 5, "DISPENSE", 0, 'C');


$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetY(100);
$pdf->MultiCell(0, 5, "
Conformément aux dispositions du décret exécutif n° ".$row['NumeroR']." du ".$row['date_dispense'].", fixant les conditions de qualifications professionnelles et d'obtention des titres maritimes correspondants, notamment son article 83, il est délivré au profit de Monsieur ".$row['nom_marin'].", titulaire de brevet de ".$row['nom_brevet']." chargé de quart à la passerelle à bord de navire d'une jauge brute supérieure à cinq cent (500), une dispense pour l'exercice de la fonction de ".$row['nom_fonction'].". 
Cette dispense est valable pour une période de ".$row['periode']." à compter du ".$row['date_debut'].", à bord du navire ".$row['nom_navire'].". 

", 0, '');

$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->SetY(275);
$pdf->MultiCell(0, 5, "
Copie : Monsieur le Chef de Département des Affaires Maritimes (SNGC)
", 0, '');


$pdf->writeHTML($html);

$pdf->Output('brevet.pdf', 'I');
}