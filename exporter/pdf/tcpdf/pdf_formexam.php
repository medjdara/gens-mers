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


$pdf->SetTitle("Examen");
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
$pdf->SetFont('dejavusans', 'B', 14, '', true);
$pdf->SetY(3); 
$pdf->MultiCell(0, 0, "REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE", 0, 'C', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetFont('dejavusans', 'B', 12, '', true);
$pdf->SetY(10);  
$pdf->MultiCell(0, 0, "MINISTERE DES TRANSPOTRS ", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 
$pdf->SetY(17); 
$pdf->SetFont('dejavusans', '', 9.5, '', true);
$pdf->MultiCell(0, 4, "
COMMISSION D’EXAMEN POUR LA DELIVRANCE
DES BREVETS DE LA MARINE MARCHAND
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);

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
$pdf->Rect(10,35, 190, 20, 'DF');
$pdf->setY(30);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->SetFont('dejavusans', 'B', 15.5);
$pdf->MultiCell(0, 4, "
DEMANDE DE CANDIDATURE A L'EXAMEN DES BREVETS
ET CERTIFICATS D'APTITUDE DE LA MARINE MARCHANDE
", 0, 'C', false, 0, '', '', true, 0, false, true, 0);
//--------------------------------------------------
// Draw a rectangle
$pdf->Rect(165, 55, 35, 45, 'DF', array(), array(255, 255, 255));
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetFont('dejavusans', 'B', 11);
// Draw a vertical arrow and add text
$pdf->Line(170, 55, 170, 100);
$pdf->Text(23, 60, '4.5 cm');

// Draw a horizontal arrow and add text
$pdf->Line(165, 95,200,95);
$pdf->Text(10, 90, '3.5 cm');

$pdf->SetFont('dejavusans', '', 7);
$pdf->Text(10, 102, 'Photographie d’identité');
//------------------------------------
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->Rect(10,55, 155, 50, 'DF');
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,55, 155, 10, 'DF');
//--------- FIRST BOX -------------------------------------
//--------------------------------------
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->setRTL(false);
$pdf->SetXY(60, 53);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->MultiCell(0, 4, "
RENSEIGNEMENTS CANDIDAT
", 0, '', false, 0, '', '', true, 0, false, true, 0);
//----------------------------------------

$pdf->Rect(42,67, 120, 4, 'D');
// Add content that should appear on top of the first rectangle
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetXY(10, 68); // Adjust the Y position to place the content correctly
$pdf->MultiCell(60, 10, 'NOM &PRENOM:', 0, '');

//-----------------------------------------
$pdf->Rect(29,74, 30, 4, 'D');
$pdf->SetXY(10, 74); // Adjust the Y position to place the content correctly
$pdf->MultiCell(60, 10, 'NE(E) LE:', 0, '');

//------------------------------------
$pdf->Rect(65,74, 50, 4, 'D');
$pdf->SetXY(60, 74);
$pdf->MultiCell(60, 10, 'à', 0, '');
//-------------------------------------
$pdf->Rect(130,74, 32, 4, 'D');
$pdf->SetXY(117,74);
$pdf->MultiCell(60, 10, 'PAYS:', 0, '');
//-------------------------------------
$pdf->Rect(37,80, 45, 4, 'D');
$pdf->SetXY(10,80);
$pdf->MultiCell(60, 10, 'NATIONALITE:', 0, '');
//-----------------------------------
$pdf->Rect(130,80, 32, 4, 'D');
$pdf->SetXY(84,80);
$pdf->MultiCell(60, 10, 'N° D\'IMMATRICULATION:', 0, '');
//-----------------------------------
$pdf->Rect(30,86, 132, 4, 'D');
$pdf->SetXY(10,86);
$pdf->MultiCell(60, 10, 'ADRESSE:', 0, '');
//-----------------------------------
$pdf->SetFont('dejavusans', '', 8);
$pdf->Rect(55,92, 20, 4, 'D');
$pdf->SetXY(32,92);
$pdf->MultiCell(60, 10, 'CODE POSTAL:', 0, '');
//-----------------------------------
$pdf->Rect(92,92, 30, 4, 'D');
$pdf->SetXY(76,92);
$pdf->MultiCell(60, 10, 'LOCALITE:', 0, '');
//-----------------------------------
$pdf->Rect(132,92, 30, 4, 'D');
$pdf->SetXY(122,92);
$pdf->MultiCell(60, 10, 'Pays:', 0, '');
//-----------------------------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Rect(45,98, 45, 4, 'D');
$pdf->SetXY(10,98);
$pdf->MultiCell(60, 10, 'TELEPHONE MOBILE:', 0, '');
//-----------------------------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Rect(105,98, 45, 4, 'D');
$pdf->SetXY(90,98);
$pdf->MultiCell(60, 10, 'E-MAIL:', 0, '');
//-----------------------------------
//--------- END FIRST BOX ---------------------------------
//---------- SECOND TOW BOXES ------------------------------
$pdf->Rect(10,107,94, 40, 'D');
$pdf->Rect(107,107,94, 40, 'D');
//------
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);

$pdf->Rect(10,107,94, 5, 'FD');
$pdf->Rect(107,107,94, 5, 'FD');
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->SetXY(50,108);
$pdf->MultiCell(60, 10, 'DIPLOME', 0, '');
$pdf->SetXY(135,108);
$pdf->MultiCell(60, 10, 'TITRE MARITIME DETENU', 0, '');
$pdf->SetTextColor(0, 0, 0); // Set text color to BLACK
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->SetXY(15,113);
$pdf->MultiCell(60, 10, 'DERNIER DIPLOME OBTENU :', 0, '');
$pdf->Rect(15,117,85,12, 'D');

$pdf->Rect(17,133, 20, 4, 'D');
$pdf->SetXY(10,133);
$pdf->MultiCell(60, 10, 'N°:', 0, '');

$pdf->Rect(77,133, 23, 4, 'D');
$pdf->SetXY(38,133);
$pdf->MultiCell(60, 10, 'DATE D’OBTENTION:', 0, '');

$pdf->Rect(21,140, 79, 4, 'D');
$pdf->SetXY(10,140);
$pdf->MultiCell(60, 10, 'LIEU:', 0, '');
//-----
$pdf->SetXY(110,113);
$pdf->MultiCell(60, 10, 'TYPE DU TITRE :', 0, '');
$pdf->Rect(111,117,85,12, 'D');
//---
$pdf->Rect(115,133, 20, 4, 'D');
$pdf->SetXY(107,133);
$pdf->MultiCell(60, 10, 'N°:', 0, '');

$pdf->Rect(173,133, 23, 4, 'D');
$pdf->SetXY(135,133);
$pdf->MultiCell(60, 10, 'DATE D’OBTENTION:', 0, '');

$pdf->Rect(173,140, 23, 4, 'D');
$pdf->SetXY(135,140);
$pdf->MultiCell(60, 10, 'DATE D’EXPIRATION:', 0, '');

//-------------------------
$pdf->Rect(10,150, 190, 40, 'D');
$pdf->Rect(10,150,190,5, 'DF');

$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->SetXY(10,150);
$pdf->MultiCell(130, 10, 'ACTIVITE PROFESSIONNELLE : Etes-vous actuellement embarqué ?', 0, '');

// tow mini boxses ------------------
$pdf->Rect(10,155, 95, 35, 'D');

$pdf->Line(10, 162,200,162);
$pdf->Rect(30,156, 5, 5, 'D');
$pdf->SetTextColor(0, 0, 0); // Set text color to BLACK
$pdf->SetXY(40,156);
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(130, 10, 'OUI', 0, '');

$pdf->Rect(120,156, 5, 5, 'D');
$pdf->SetTextColor(0, 0, 0); // Set text color to BLACK
$pdf->SetXY(130,156);
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(130, 10, 'NON', 0, '');
$pdf->SetFont('dejavusans', '', 10);
$pdf->SetXY(139,156);
$pdf->MultiCell(130, 10, ', j’ai débarqué depuis', 0, '');
$pdf->SetFont('dejavusans', 'B', 9);
//-----------
$pdf->Rect(36,163,67, 5, 'D');
$pdf->SetXY(10,163);
$pdf->MultiCell(130, 10, 'Sur le navire:', 0, '');

$pdf->Rect(43,170,60, 5, 'D');
$pdf->SetXY(10,170);
$pdf->MultiCell(130, 10, 'De la compagnie:', 0, '');

$pdf->Rect(36,177,67, 5, 'D');
$pdf->SetXY(10,178);
$pdf->MultiCell(130, 10, 'En qualité de:', 0, '');

$pdf->Rect(25,184,78, 5, 'D');
$pdf->SetXY(10,185);
$pdf->MultiCell(130, 10, 'Depuis:', 0, '');

//-------------
$pdf->Rect(151,163,47, 5, 'D');
$pdf->SetXY(105,163);
$pdf->MultiCell(130, 10, 'Mon dernier navire était:', 0, '');

$pdf->Rect(138,170,60,5, 'D');
$pdf->SetXY(105,170);
$pdf->MultiCell(130, 10, 'De la compagnie:', 0, '');

$pdf->Rect(151,177,47, 5, 'D');
$pdf->SetXY(105,178);
$pdf->MultiCell(130, 10, 'J’ai exercé en qualité de:', 0, '');

$pdf->Rect(120,184,78, 5, 'D');
$pdf->SetXY(105,185);
$pdf->MultiCell(130, 10, 'Depuis:', 0, '');
//--------------------------------------------------
$pdf->Rect(10,192,190,75, 'D');
$pdf->Rect(10,192,190,5, 'DF');
$pdf->SetXY(10,193);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->MultiCell(130, 10, 'TYPE DE BREVET SOLLICITE', 0, '');
$pdf->Rect(10,197,100,5, 'DF');
$pdf->Rect(120,197,80,5, 'DF');

$pdf->SetTextColor(0, 0, 0); // Set text color to black
//first box
$pdf->Rect(10,202,100,65, 'D');
$pdf->SetXY(45,198);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->MultiCell(130, 10, 'SERVICE PONT', 0, '');
$pdf->Rect(10,202,100,25, 'D');
$pdf->Rect(10,202,35,25, 'DF');
$pdf->SetX(10);
$pdf->SetFont('dejavusans', 'B',8);
$pdf->MultiCell(130, 10, 'NAVIGATION
RESTREINTE /SANS
RESTRICTION', 0, '');

$pdf->Rect(45,202,65,25, 'D');
$pdf->Rect(67,202,20,25, 'D');
$pdf->SetXY(45,203);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->MultiCell(130, 10, 'CAPITAINE', 0, '');

$pdf->SetXY(66,203);
$pdf->MultiCell(130, 10, 'S.CAPITAINE', 0, '');
$pdf->Rect(50,210, 3, 3, 'D');//mini box 
$pdf->SetXY(53,210);
$pdf->MultiCell(130, 10, '≥3000', 0, '');

$pdf->Rect(70,210, 3, 3, 'D');//mini box 
$pdf->SetXY(73,210);
$pdf->MultiCell(130, 10, '≥3000', 0, '');

$pdf->Rect(50,220, 3, 3, 'D');//mini box 
$pdf->SetXY(53,220);
$pdf->MultiCell(130, 10, '<3000', 0, '');

$pdf->Rect(70,220, 3, 3, 'D');//mini box 
$pdf->SetXY(73,220);
$pdf->MultiCell(130, 10, '<3000', 0, '');


$pdf->SetXY(90,203);
$pdf->MultiCell(130, 10, 'OFFICIER', 0, '');
$pdf->Rect(90,215, 3, 3, 'D');//mini box 
$pdf->SetXY(95,215);
$pdf->MultiCell(130, 10, '≥ 500', 0, '');
//----

$pdf->Rect(10,245,100,22, 'D');
$pdf->Rect(10,228,35,39, 'DF');
$pdf->SetXY(10,240);
$pdf->SetFont('dejavusans', 'B',8);
$pdf->MultiCell(130, 10, 'NAVIGATION A
PROXIMITE DU
LITTORAL', 0, '');

$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetXY(45,250);
$pdf->MultiCell(130, 10, '
CAPACITAIRE A LA NAVIGATION
COTIERE < 50', 0, '');
$pdf->Rect(90,259, 3, 3, 'D');//mini box 

$pdf->SetFillColor(192, 192, 192); // Set fill color to light gray
$pdf->Rect(67,228,20,17, 'FD');

$pdf->Rect(50,230, 3, 3, 'D');//mini box 
$pdf->SetXY(53,230);
$pdf->MultiCell(130, 10, '<3000', 0, '');

$pdf->Rect(90,230, 3, 3, 'D');//mini box 
$pdf->SetXY(93,230);
$pdf->MultiCell(130, 10, '<3000', 0, '');

$pdf->Rect(50,240, 3, 3, 'D');//mini box 
$pdf->SetXY(53,240);
$pdf->MultiCell(130, 10, '<500', 0, '');

$pdf->Rect(90,240, 3, 3, 'D');//mini box 
$pdf->SetXY(93,240);
$pdf->MultiCell(130, 10, '<500', 0, '');


//--------------------second box---------------------
$pdf->Rect(120,202,42,65, 'D');
$pdf->SetXY(140,198);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->MultiCell(130, 10, 'SERVICE MACHINE', 0, '');
$pdf->Rect(120,202,80,15, 'D');
$pdf->SetXY(123,206);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->MultiCell(130, 10, 'CHEF MECANICIEN', 0, '');
$pdf->Rect(120,217,80,15, 'D');
$pdf->SetXY(123,222);
$pdf->MultiCell(130, 10, 'S. MECANICIEN', 0, '');

$pdf->SetXY(123,235);
$pdf->MultiCell(130, 10, '
OFFICIER
MECANICIEN', 0, '');
$pdf->Rect(120,258,80,9, 'D');
$pdf->SetXY(123,259);
$pdf->MultiCell(130, 10, 'OFFICIER
ELECTROTECHNICIEN', 0, '');


$pdf->Rect(165,205, 3, 3, 'D');//mini box 
$pdf->SetXY(170,205);
$pdf->MultiCell(130, 10, '≥ 3000 kw', 0, '');

$pdf->Rect(165,210, 3, 3, 'D');//mini box 
$pdf->SetXY(170,210);
$pdf->MultiCell(130, 10, '< 3000 kw', 0, '');

$pdf->Rect(165,220, 3, 3, 'D');//mini box 
$pdf->SetXY(170,220);
$pdf->MultiCell(130, 10, '≥ 3000 kw', 0, '');

$pdf->Rect(165,225, 3, 3, 'D');//mini box 
$pdf->SetXY(170,225);
$pdf->MultiCell(130, 10, '< 3000 kw', 0, '');

$pdf->Rect(165,235, 3, 3, 'D');//mini box 
$pdf->SetXY(170,235);
$pdf->MultiCell(130, 10, '≥:750 kw', 0, '');

$pdf->Rect(165,240, 3, 3, 'D');//mini box 
$pdf->SetXY(170,240);
$pdf->MultiCell(130, 10, 'Entre 750
et 3000kw', 0, '');

$pdf->Rect(165,260, 3, 3, 'D');//mini box 
$pdf->SetXY(170,260);
$pdf->MultiCell(130, 10, '≥ 750 kw', 0, '');
$pdf->SetXY(42,275);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(130, 10, '1/2', 0, 'C');

//SECOND PAGE----------------------------------------------

$pdf->AddPage();
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,30,190,7, 'DF');
$pdf->Rect(10,37,190,7, 'D');
$pdf->Rect(10,44,190,7, 'D');
$pdf->Rect(10,51,190,7, 'D');
$pdf->Rect(10,58,190,7, 'D');
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->setY(31);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->MultiCell(0, 4, "6. PIECES A FOURNIR", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetTextColor(0, 0, 0); // Set text color to white
$pdf->SetFont('dejavusans', 'B',7);
$pdf->setXY(10,38);
$pdf->MultiCell(0, 4, "1. Copie du fascicule de navigation, en cours de validité", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,38);
$pdf->MultiCell(0, 4, "5. Copie du brevet ou du certificat d'aptitude, s'il y a lieu", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,38, 3, 3, 'D');
$pdf->Rect(194,38, 3, 3, 'D');

$pdf->setXY(10,45);
$pdf->MultiCell(0, 4, "2. Copies des certificats de sécurité STCW, en cours validité", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,45);
$pdf->MultiCell(0, 4, "6. Copie du certificat d’actualisation des connaissances maritimes
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,45, 3, 3, 'D');
$pdf->Rect(194,45, 3, 3, 'D');


$pdf->setXY(10,52);
$pdf->MultiCell(0, 4, "3. Copie du certificat médical, en cours de validité", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,52);
$pdf->MultiCell(0, 4, "7. Relevé de navigation délivré par l'administration maritime locale
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,52, 3, 3, 'D');
$pdf->Rect(194,52, 3, 3, 'D');

$pdf->setXY(10,59);
$pdf->MultiCell(0, 4, "4. Copie du diplôme maritime requis ", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(110,59);
$pdf->MultiCell(0, 4, "8. Deux (02) photos et Timbre de deux cent (200) D
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(95,59, 3, 3, 'D');
$pdf->Rect(194,59, 3, 3, 'D');



$pdf->Rect(10,70,190,5, 'DF');
$pdf->Rect(10,75,190,20, 'D');
$pdf->Rect(10,95,190,10, 'D');
$pdf->setY(70);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->SetTextColor(255,255,255); // Set text color to white
$pdf->MultiCell(0, 4, "7. MISE A DISPOSITION", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->setXY(10,79);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(0, 4, "Dossier deposé directement par le candidat au service concerné de la Direction de la Marine
Marchande et des Ports.
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(180,79, 3, 3, 'D');
$pdf->setXY(10,97);
$pdf->MultiCell(0, 4, "Dossier deposé par le service concerné de l'Entreprise du candidat
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(180,97, 3, 3, 'D');

$pdf->setXY(10,110);
$pdf->MultiCell(0, 4, "FAIT A............................... LE ..............................
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(10,120);
$pdf->setRTL(true);
// Draw a horizontal arrow and add text
$pdf->Line(195,123,132,123);
$pdf->MultiCell(0, 4, "SIGNATURE DU CANDIDAT/ENTREPRISE", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetXY(42,275);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(130, 10, '2/2', 0, 'C');

$pdf->Output('examen.pdf', 'I');
