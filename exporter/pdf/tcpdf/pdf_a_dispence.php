<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['Id_annuldispense'])) {
    $id = $_GET['Id_annuldispense'];
    $sql ="SELECT a.Id_annuldispense,
    a.date_dispense,
    a.nom_navire,
    a.décideur,
    a.cause,
    a.ref,
    a.objet,
    a.Titre_annulation,
    a.NumeroR,
    t.nom_brevet,
    f.nom_fonction,
    m.nom_et_prenom as nom_marin
FROM Annulation_dispense a
LEFT JOIN marin m ON a.id_marin = m.id_marin
LEFT JOIN type_brevet t ON a.id_tbrevet = t.id_tbrevet
LEFT JOIN fonction f ON a.id_fonction = f.id_fonction
WHERE Id_annuldispense = $id";
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


$pdf->SetTitle("annulation dispence");
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
//-------------------------------------------------------------

$pdf->SetY(65);
$pdf->SetFont('freeserif', 'B', 12, '', true);
$pdf->MultiCell(0, 5,$row['Titre_annulation'], 0, 'C');


$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->SetY(90);
$pdf->MultiCell(0, 5, "
Objet :
", 0, '');
$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetXY(35,90);
$pdf->MultiCell(0, 5, "
".$row['objet']."
", 0, '');
$pdf->SetFont('freeserif', 'B', 14, '', true);
$pdf->SetY(100);
$pdf->MultiCell(0, 5, "
Ref :
", 0, '');
$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetXY(35,100);
$pdf->MultiCell(0, 5, "
".$row['ref']."
", 0, '');
$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetY(130);
$pdf->MultiCell(0, 5, "

Additivement à mon envoi sus-référence et suite à l’email du commandant  du navire ".$row['nom_navire']." qui informe du refus de Monsieur ".$row['nom_marin']."  à exercer la fonction du ".$row['nom_fonction']." pour cause de ".$row['cause'].", j’ai l’honneur de vous informer que la dispense du susnommé est annulée. 
", 0, '');


$pdf->MultiCell(0, 5, "
Veuillez agréer, Monsieur le Directeur, l'expression de ma parfaite considération.
", 0, '');
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->SetY(275);
$pdf->MultiCell(0, 5, "
Copie : Monsieur le Chef de Département des Affaires Maritimes (SNGC)
", 0, '');

$pdf->writeHTML($html);





$pdf->Output('annulation dispence.pdf', 'I');
}