<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');






$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$pdf->setLanguageArray($lg);
$pdf->setRTL(true);

// Set a Unicode font that supports Arabic, French, and English characters


$pdf->SetTitle("Revalidation");
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
$pdf->Image('C:\xampp\htdocs\sitepfe\images\logo2.png', 120, 20, 24, 24, '', '', 'R', false, 300, '', false, false, 0, false, false, false, false, array());

//freeserif
$pdf->SetFont('dejavusans', 'B', 14, '', true);
$pdf->SetY(3); 
$pdf->MultiCell(0, 0, "REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE", 0, 'C', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetFont('dejavusans', 'B', 11, '', true);
$pdf->SetY(10);  
$pdf->MultiCell(0, 0, "MINISTERE DES TRANSPOTRS ", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 
$pdf->SetY(11); 
$pdf->MultiCell(0, 4, "
DIRECTION GENERALE DE LA MARINE MARCHANDE ET DES PORTS
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);
$pdf->SetFont('dejavusans', '', 9.5, '', true);

//$pdf->Rect($x, $y, $width, $height, $style);
//To draw a filled rectangle with no border:
//$pdf->Rect(10, 10, 50, 30, 'F');
//And to draw a rectangle with both border and fill:
//$pdf->SetFillColor($red, $green, $blue);
//$pdf->Rect($x, $y, $width, $height, 'F');
//$pdf->Rect(10, 10, 50, 30, 'DF');
//$pdf->SetFillColor(255, 0, 0); // Red color
//$pdf->Rect(10, 10, 50, 30, 'DF');


//--------------------------------------
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,45, 190, 20, 'DF');
$pdf->setY(40);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->SetFont('dejavusans', 'B', 15.5);
$pdf->MultiCell(0, 4, "
DEMANDE DE REVALIDATION DES BREVETS ET
CERTIFICATS D'APTITUDE DES GENS DE MER
", 0, 'C', false, 0, '', '', true, 0, false, true, 0);
//--------------------------------------------------
$hexColor = 'C0D6E8'; // color BABY blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,65, 190, 40, 'DF');
$hexColor = 'FEFAF6'; // color white
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->setRTL(false);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->setXY(15,70);
$pdf->MultiCell(0, 4, "Date de réception", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(15,79, 50, 10, 'F');
$pdf->setXY(15,68);
$pdf->MultiCell(0, 4, "Cadre réservé à l’administration
Numéro d’enregistrement", 0, 'C', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(83,79, 50, 10, 'F');
$pdf->setXY(145,70);
$pdf->MultiCell(60, 4, "Dossier complété le", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(143,79, 50, 10, 'F');
//-----------------------------------------------
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
// Draw a rectangle------PHOTO
$pdf->setRTL(true);
$pdf->Rect(165, 95, 35, 45, 'DF', array(), array(255, 255, 255));
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetFont('dejavusans', 'B', 11);
// Draw a vertical arrow and add text
$pdf->Line(170, 95, 170, 140);
$pdf->Text(23, 100, '4.5 cm');

// Draw a horizontal arrow and add text
$pdf->Line(165, 137,200,137);
$pdf->Text(10, 130, '3.5 cm');

$pdf->SetFont('dejavusans', '', 7);
$pdf->MultiCell(10, 142, 'Photographie d\'identité obligatoire 
pour toute demande');
//------------------------------------
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->Rect(10,95, 155, 50, 'DF');
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,95, 155, 10, 'DF');
//--------- FIRST BOX -------------------------------------
//--------------------------------------
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->setRTL(false);
$pdf->SetXY(10, 93);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->MultiCell(0, 4, "
1. IDENTIFICATION CANDIDAT
", 0, '', false, 0, '', '', true, 0, false, true, 0);
//----------------------------------------

$pdf->Rect(42,107, 120, 4, 'D');
// Add content that should appear on top of the first rectangle
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetXY(10, 108); // Adjust the Y position to place the content correctly
$pdf->MultiCell(60, 10, 'NOM &PRENOM:', 0, '');

//-----------------------------------------
$pdf->Rect(29,114, 30, 4, 'D');
$pdf->SetXY(10, 114); // Adjust the Y position to place the content correctly
$pdf->MultiCell(60, 10, 'NE(E) LE:', 0, '');

//------------------------------------
$pdf->Rect(65,114, 50, 4, 'D');
$pdf->SetXY(60, 114);
$pdf->MultiCell(60, 10, 'à', 0, '');
//-------------------------------------
$pdf->Rect(130,114, 32, 4, 'D');
$pdf->SetXY(117,114);
$pdf->MultiCell(60, 10, 'PAYS:', 0, '');
//-------------------------------------
$pdf->Rect(37,120, 45, 4, 'D');
$pdf->SetXY(10,120);
$pdf->MultiCell(60, 10, 'NATIONALITE:', 0, '');
//-----------------------------------
$pdf->Rect(130,120, 32, 4, 'D');
$pdf->SetXY(84,120);
$pdf->MultiCell(60, 10, 'N° D\'IMMATRICULATION:', 0, '');
//-----------------------------------
$pdf->Rect(30,126, 132, 4, 'D');
$pdf->SetXY(10,126);
$pdf->MultiCell(60, 10, 'ADRESSE:', 0, '');
//-----------------------------------
$pdf->SetFont('dejavusans', '', 8);
$pdf->Rect(55,132, 20, 4, 'D');
$pdf->SetXY(32,132);
$pdf->MultiCell(60, 10, 'CODE POSTAL:', 0, '');
//-----------------------------------
$pdf->Rect(92,132, 30, 4, 'D');
$pdf->SetXY(76,132);
$pdf->MultiCell(60, 10, 'LOCALITE:', 0, '');
//-----------------------------------
$pdf->Rect(132,132, 30, 4, 'D');
$pdf->SetXY(122,132);
$pdf->MultiCell(60, 10, 'Pays:', 0, '');
//-----------------------------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Rect(45,138, 45, 4, 'D');
$pdf->SetXY(10,138);
$pdf->MultiCell(60, 10, 'TELEPHONE MOBILE:', 0, '');
//-----------------------------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Rect(105,138, 45, 4, 'D');
$pdf->SetXY(90,138);
$pdf->MultiCell(60, 10, 'E-MAIL:', 0, '');
//-----------------------------------
$pdf->Rect(10,150,190,7, 'DF');
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->setY(151);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->MultiCell(0, 4, "2. TITRES MARITIMES A REVALIDER (BREVETS ET CERTIFICATS D'APTITUDE)", 0, '', false, 0, '', '', true, 0, false, true, 0);
$hexColor = 'C0D6E8'; // color BABY blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,157,190,6, 'DF');
$pdf->SetTextColor(0, 0, 0); // Set text color to black

$pdf->SetFont('dejavusans', 'B', 11);
$pdf->setY(157);
$pdf->MultiCell(0, 4, "N° DU TITRE", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(80,157);
$pdf->MultiCell(0, 4, "LIBELLE DU TITRE ", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->setXY(150,157);
$pdf->MultiCell(100, 4, "DATE D’EXPIRATION", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(10,163,190,13, 'D');
$pdf->Rect(58,163,90,13, 'D');

$pdf->Rect(15,167,40,5, 'D');

$pdf->Rect(150,167,40,5, 'D');
//SECOND ---------------------------------------------

$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,176,190,7, 'DF');
$pdf->Rect(10,183,190,7, 'D');
$pdf->Rect(10,190,190,7, 'D');
$pdf->Rect(10,197,190,7, 'D');
$pdf->Rect(10,204,190,7, 'D');
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->setY(177);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->MultiCell(0, 4, "3. PIECES A FOURNIR", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetTextColor(0, 0, 0); // Set text color to white
$pdf->SetFont('dejavusans', 'B',7);
$pdf->setXY(10,184);
$pdf->MultiCell(0, 4, "1. Copie du fascicule de navigation, en cours de validité", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,184);
$pdf->MultiCell(0, 4, "5. Copie du brevet ou du certificat d'aptitude, s'il y a lieu", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,184, 3, 3, 'D');
$pdf->Rect(194,184, 3, 3, 'D');

$pdf->setXY(10,191);
$pdf->MultiCell(0, 4, "2. Copies des certificats de sécurité STCW, en cours validité", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,191);
$pdf->MultiCell(0, 4, "6. Copie du certificat d’actualisation des connaissances maritimes
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,191, 3, 3, 'D');
$pdf->Rect(194,191, 3, 3, 'D');


$pdf->setXY(10,198);
$pdf->MultiCell(0, 4, "3. Copie du certificat médical, en cours de validité", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,198);
$pdf->MultiCell(0, 4, "7. Relevé de navigation délivré par l'administration maritime locale
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,198, 3, 3, 'D');
$pdf->Rect(194,198, 3, 3, 'D');

$pdf->setXY(10,205);
$pdf->MultiCell(0, 4, "4. Copie du diplôme maritime requis ", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,205);
$pdf->MultiCell(0, 4, "8. Deux (02) photos et Timbre de deux cent (200) D
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,205, 3, 3, 'D');
$pdf->Rect(194,205, 3, 3, 'D');



$pdf->Rect(10,210,190,5, 'DF');
$pdf->Rect(10,205,190,20, 'D');
$pdf->Rect(10,225,190,10, 'D');
$pdf->setY(210);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->SetTextColor(255,255,255); // Set text color to white
$pdf->MultiCell(0, 4, "4. MISE A DISPOSITION", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->setXY(10,215);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(0, 4, "Remis directement au demandeur par le service concerné de la Direction de la Marine Marchande
et des Ports
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(180,216, 3, 3, 'D');
$pdf->setXY(10,227);
$pdf->MultiCell(0, 4, "Remis au demandeur par le service concerné de l'Entreprise mentionnée ci-dessus
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(180,227, 3, 3, 'D');

$pdf->Rect(10,235,190,5, 'FD');
$pdf->setY(235);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->SetTextColor(255,255,255); // Set text color to white
$pdf->MultiCell(0, 4, "5. ENGAGEMENT ET SIGNATURE", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->Rect(10,240,190,30, 'D');
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->SetTextColor(0,0,0); // Set text color to black
$pdf->setXY(10,245);
$pdf->MultiCell(0, 4, "FAIT A............................... LE ..............................
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(10,259);
$pdf->setRTL(true);
// Draw a horizontal arrow and add text

$pdf->MultiCell(0, 4, "SIGNATURE DU CANDIDAT/ENTREPRISE", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->SetXY(42,275);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(130, 10, '1/1', 0, 'C');
$pdf->Output('Revalidation.pdf', 'I');
