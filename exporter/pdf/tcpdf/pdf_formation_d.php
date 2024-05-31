<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');

if (isset($_GET['Id_demande_eb'])) {
    $Id_demande_eb = $_GET['Id_demande_eb'];
    $sql ="SELECT NumeroR, date_demande_eb, objet_demande_eb, annee_universitaire, date_besoin
    FROM demande_exprimer_besoin
    WHERE Id_demande_eb= $Id_demande_eb";
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

    $pdf->SetTitle("demande");
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
الجزائر في: " . $row['date_demande_eb'] . "
", 0, '');
    $pdf->SetFont('freeserif', '', 10, '', true);
    $pdf->SetY(44);
    $pdf->setRTL(false);
    $pdf->MultiCell(0, 5, "
DIRECTION GENERALE DE LA MARINE MARCHANDE ET DES PORTS 
DIRECTION DE LA MARINE MARCHANDE
N°" . $row['NumeroR'] . "DMM/DGMMP/" . $row['date_demande_eb'] . "
", 0, '');

    $pdf->SetFont('freeserif', 'B', 15, '', true);
    $pdf->SetY(70); 
    $pdf->SetFont('freeserif', 'B', 13, '', true);
    $pdf->MultiCell(0, 4, "
MONSIEUR LE PRESIDENT DIRECTEUR GENERAL DE
 LA COMPAGNIE HYPROC SC
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);

    $pdf->SetFillColor(0, 0, 0);
    $pdf->Circle(20, 110, 0.7, 0, 360, 'DF');
    $pdf->setRTL(false);
    $pdf->SetXY(23,100); 
    $pdf->SetFont('freeserif', 'B', 14, '', true);
    $pdf->MultiCell(0, 5, "
Objet :", 0, '');
    $pdf->SetXY(40,100);
    $pdf->SetFont('freeserif', '', 14, '', true);
    $pdf->MultiCell(0, 5, "
 A/s Besoin en formation de " . $row['objet_demande_eb'] . "
", 0, '');
    $pdf->MultiCell(0, 5, "

", 0, '');

    $pdf->SetFont('freeserif', '', 14, '', true);




$pdf->MultiCell(0, 5, "
En prévision de  lancement des sessions de formation longue durée pour l’année universitaire ".$row['annee_universitaire']." au niveau des Ecole Technique de Formation et d’Instruction Maritimes (ETFIM) de Mostaganem et Bejaia, j’ai l’honneur de vous demander de bien vouloir nous faire part de vos besoins en formation au plus tard le ".$row['date_besoin']."  .
", 0, '');
$pdf->MultiCell(0, 5, "
Veuillez agréer, Monsieur, l'expression de ma parfaite considération.
", 0, '');

$pdf->writeHTML($html);

$pdf->Output('demande.pdf', 'I');
}
?>
