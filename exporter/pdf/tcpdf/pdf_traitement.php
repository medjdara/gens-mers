<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['Id_demande_t'])) {
    $id = $_GET['Id_demande_t'];
    $sql ="SELECT * FROM Demande_traitement 
WHERE Id_demande_t = $id";
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


$pdf->SetTitle("traitement examen");
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
الجزائر في: ".$row['date_etablissement']."
", 0, '');
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->SetY(44);
$pdf->setRTL(false);
$pdf->MultiCell(0, 5, "
DIRECTION GENERALE DE LA MARINE MARCHANDE ET DES PORTS 
DIRECTION DE LA MARINE MARCHANDE
N°".$row['NumeroR']."DMM/DGMMP/".$row['date_etablissement']."
", 0, '');

$pdf->SetY(65);
$pdf->SetFont('freeserif', 'B', 13, '', true);
$pdf->MultiCell(0, 5, "
".$row['titre_dt']."
", 0, 'C');
$pdf->SetY(90);
$pdf->SetFont('freeserif', 'B', 12, '', true);
$pdf->MultiCell(0, 5, " 
Objet :".$row['objet_dt']." de ".$row['numero_session']." session.
", 0, '');

$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetY(110);
$pdf->MultiCell(0, 5, "
J'ai l'honneur de vous informer qu'une réunion de travail et de concertation est prévue le ".$row['date_reunion_t']." à ".$row['heure_reunion_t']." au niveau de ".$row['lieu_examen']." relatif à l'examen des brevets fixé le ".$row['date_reunion_t']."
consacrée au traitement des dossiers des candidats.
", 0, '');
$pdf->SetY(170);
$pdf->MultiCell(0, 5, "
A ce titre, je vous demande de bien vouloir prendre vos dispositions pour y participer.
", 0, '');
$pdf->SetY(180);
$pdf->MultiCell(0, 5, "
Veuillez agréer, Monsieur le Directeur, l'expression de ma parfaite considération.
", 0, '');


$pdf->writeHTML($html);





$pdf->Output('traitement examen.pdf', 'I');
}