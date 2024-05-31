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


$pdf->SetTitle("Reconaissance");
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
$pdf->Image('C:\xampp\htdocs\sitepfe\images\logo2.png', 25, 10, 24, 24, '', '', 'R', false, 300, '', false, false, 0, false, false, false, false, array());
$pdf->Image('C:\xampp\htdocs\sitepfe\images\logo2.png', 210, 10, 24, 24, '', '', 'R', false, 300, '', false, false, 0, false, false, false, false, array());

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
$pdf->Rect(10,35, 190, 20, 'DF');
$pdf->setY(30);
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
$pdf->Rect(10,55, 190, 40, 'DF');
$hexColor = 'FEFAF6'; // color white
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->setRTL(false);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->setXY(15,60);
$pdf->MultiCell(0, 4, "Date de réception", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(15,69, 50, 10, 'F');
$pdf->setXY(15,58);
$pdf->MultiCell(0, 4, "Cadre réservé à l’administration
Numéro d’enregistrement", 0, 'C', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(83,69, 50, 10, 'F');
$pdf->setXY(145,60);
$pdf->MultiCell(60, 4, "Dossier complété le", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(143,69, 50, 10, 'F');
//-----------------------------------------------
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
// Draw a rectangle------PHOTO
$pdf->setRTL(true);
$pdf->Rect(165, 85, 35, 45, 'DF', array(), array(255, 255, 255));
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetFont('dejavusans', 'B', 11);
// Draw a vertical arrow and add text
$pdf->Line(170, 85, 170, 130);
$pdf->Text(23, 90, '4.5 cm');

// Draw a horizontal arrow and add text
$pdf->Line(165, 127,200,127);
$pdf->Text(10, 120, '3.5 cm');

$pdf->SetFont('dejavusans', '', 7);
$pdf->Text(10, 132, 'Photographie d’identité obligatoire
pour toute demande');
//------------------------------------
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->Rect(10,85, 155, 50, 'DF');
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(10,85, 155, 10, 'DF');
//--------- FIRST BOX -------------------------------------
//--------------------------------------
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->setRTL(false);
$pdf->SetXY(10, 83);
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->MultiCell(0, 4, "
1. RENSEIGNEMENTS RELATIFS AU MARIN
", 0, '', false, 0, '', '', true, 0, false, true, 0);
//----------------------------------------

$pdf->Rect(42,97, 120, 4, 'D');
// Add content that should appear on top of the first rectangle
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetXY(10, 98); // Adjust the Y position to place the content correctly
$pdf->MultiCell(60, 10, 'NOM &PRENOM:', 0, '');

//-----------------------------------------
$pdf->Rect(29,104, 30, 4, 'D');
$pdf->SetXY(10, 104); // Adjust the Y position to place the content correctly
$pdf->MultiCell(60, 10, 'NE(E) LE:', 0, '');

//------------------------------------
$pdf->Rect(65,104, 50, 4, 'D');
$pdf->SetXY(60, 104);
$pdf->MultiCell(60, 10, 'à', 0, '');
//-------------------------------------
$pdf->Rect(130,104, 32, 4, 'D');
$pdf->SetXY(117,104);
$pdf->MultiCell(60, 10, 'PAYS:', 0, '');
//-------------------------------------
$pdf->Rect(37,110, 45, 4, 'D');
$pdf->SetXY(10,110);
$pdf->MultiCell(60, 10, 'NATIONALITE:', 0, '');
//-----------------------------------
$pdf->Rect(130,110, 32, 4, 'D');
$pdf->SetXY(84,110);
$pdf->MultiCell(60, 10, 'N° D\'IMMATRICULATION:', 0, '');
//-----------------------------------
$pdf->Rect(30,116, 132, 10, 'D');
$pdf->SetXY(10,116);
$pdf->MultiCell(60, 10, 'ADRESSE:', 0, '');
//-----------------------------------

//-----------------------------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Rect(45,128, 45, 4, 'D');
$pdf->SetXY(10,128);
$pdf->MultiCell(60, 10, 'TELEPHONE MOBILE:', 0, '');
//-----------------------------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Rect(105,128, 45, 4, 'D');
$pdf->SetXY(90,128);
$pdf->MultiCell(60, 10, 'E-MAIL:', 0, '');
//-----------------------------------
$pdf->Rect(10,140,190,7, 'DF');
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->setY(141);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->MultiCell(0, 4, "2. TITRE MARITIME SOUMIS A LA RECONNAISSANCE
", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->Rect(10,147,190,5, 'D');
$pdf->SetTextColor(0, 0, 0); // Set text color to black

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->setY(148);
$pdf->MultiCell(0, 4, "N° DU TITRE", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(45,148);
$pdf->MultiCell(0, 4, "LIBELLE DU TITRE-REGLES STCW ", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(105,148);
$pdf->MultiCell(100, 4, "DATE D’EXPIRATION", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(150,148);
$pdf->MultiCell(100, 4, "ETAT DE DELIVRANCE", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(10,147,190,35, 'D');
$pdf->Rect(45,147,60,35, 'D');
$pdf->Rect(140,147,60,35, 'D');
// Draw a horizontal arrow and add text
$pdf->Line(10, 152,200,152);
// Draw a horizontal arrow and add text
$pdf->Line(10, 157,200,157);
// Draw a horizontal arrow and add text
$pdf->Line(10, 162,200,162);
// Draw a horizontal arrow and add text
$pdf->Line(10, 167,200,167);
// Draw a horizontal arrow and add text
$pdf->Line(10, 167,200,167);
// Draw a horizontal arrow and add text
$pdf->Line(10, 172,200,172);
// Draw a horizontal arrow and add text
$pdf->Line(10, 177,200,177);
//-------------------------------------------------
$pdf->Rect(10,184,190,90, 'D');
$pdf->Rect(10,184,190,7, 'FD');
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->setY(185);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->MultiCell(0, 4, "3. DECLARATION L'ARMATEUR DE LA COMPAGNIE
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->setY(193);
$pdf->MultiCell(0, 4, "COMPAGNIE / ENTREPRISE", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(60,193,130,5, 'D');
$pdf->setY(200);
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(0, 4, "Je déclare avoir l’intention de procéder à l’embarquement du titulaire du titre précité pour la période allant", 0, '', false, 0, '', '', true, 0, false, true, 0);


$pdf->setXY(10,208);
$pdf->MultiCell(0, 4, "Du", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(50,208);
$pdf->MultiCell(0, 4, "au", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(90,208);
$pdf->MultiCell(0, 4, "à bord du navire", 0, '', false, 0, '', '', true, 0, false, true, 0);


$pdf->Rect(17,208,30,5, 'D');
$pdf->Rect(57,208,30,5, 'D');
$pdf->Rect(120,208,60,5, 'D');

$pdf->setXY(10,215);
$pdf->MultiCell(0, 4, "immatriculé à", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(70,215);
$pdf->MultiCell(0, 4, "jauge brute", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(120,215);
$pdf->MultiCell(0, 4, "propulsion", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(175,215);
$pdf->MultiCell(0, 4, "Kw", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->Rect(34,215,30,5, 'D');
$pdf->Rect(90,215,30,5, 'D');
$pdf->Rect(140,215,35,5, 'D');

$pdf->SetFont('dejavusans', '', 8.5);
$pdf->setXY(10,223);
$pdf->MultiCell(0, 4, "après la délivrance du (des) visa (s) de reconnaissance demandé (s) conformément aux dispositions de la règle I/10
de la convention STCW, telle qu'amndée, et de la circulaire n°04/DMMP du 14 Novembre 2018 fixant les conditions
ainsi que les procedures de reconnaissance des titres maritimes délivrés par d’autres Etats pour le service à bord
des navires battant pavillon Algérien", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->setXY(10,240);
$pdf->MultiCell(0, 4, "Je certifie que le marin employé dispose d’un niveau de connaissance de la réglementation maritime Algérienne
approprié à ses fonctions conformément aux dispositions de la circulaire sucitée .
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetFont('dejavusans', 'B', 8.5);
$pdf->setXY(10,250);
$pdf->MultiCell(0, 4, "FAIT A:", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(90,250);
$pdf->MultiCell(0, 4, "LE:", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(120,250);
$pdf->Rect(25,250,60,5, 'D');
$pdf->Rect(97,250,30,5, 'D');
$pdf->Rect(184,242,5,5, 'D');
$pdf->SetFont('dejavusans', 'B', 8.5);
$pdf->setXY(140,250);
$pdf->MultiCell(0, 4, "SIGNATURE DE L'ARMATEUR:", 0, '', false, 0, '', '', true, 0, false, true, 0);
//--------------

$pdf->SetXY(42,275);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(130, 10, '1/3', 0, 'C');






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
$pdf->Rect(10,65,190,15, 'D');
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->setY(31);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->MultiCell(0, 4, "4. PIECES A FOURNIR", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetTextColor(0, 0, 0); // Set text color to white
$pdf->SetFont('dejavusans', '',9);
$pdf->setXY(10,38);
$pdf->MultiCell(0, 4, "1. Le brevet d'aptitude et/ou certificat d'aptitude soumis à la reconnaissance", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->Rect(194,38, 3, 3, 'D');

$pdf->setXY(10,45);
$pdf->MultiCell(0, 4, "2. Copie des Certificats de securité exigés par la convention internationale STCW, telle qu'amendée", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->Rect(194,45, 3, 3, 'D');


$pdf->setXY(10,52);
$pdf->MultiCell(0, 4, "3. Extrait de naissance du titulaire du brevet d'aptitude et/ou du certificat d'aptitude, soumis à la reconnaissance", 0, '', false, 0, '', '', true, 0, false, true, 0);


$pdf->Rect(194,52, 3, 3, 'D');

$pdf->setXY(10,59);
$pdf->MultiCell(0, 4, "4. Certificat medical d'aptitude physique de l'intéréssé", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->Rect(194,59, 3, 3, 'D');

$pdf->setXY(10,66);
$pdf->MultiCell(0, 4, "5. Le casier judiciaire ou un document équivalent dument délivré par l’autorité compétente de l’Etat de
nationalité de l’intéressé , prouvant que ce dernier n’a commis aucune infraction grave durant sa carrière
professionnelle
", 0, '', false, 0, '', '', true, 0, false, true, 0);

$pdf->Rect(194,66, 3, 3, 'D');



$pdf->Rect(10,90,190,5, 'DF');
$pdf->Rect(10,95,190,20, 'D');
$pdf->Rect(10,130,190,40, 'D');
$pdf->setY(90);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->SetTextColor(255,255,255); // Set text color to white
$pdf->MultiCell(0, 4, "5. ENGAGEMENT ET SIGNATURE DE L'INTERESSE", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetTextColor(0, 0, 0); // Set text color to black

$pdf->setXY(10,97);
$pdf->SetFont('dejavusans', '', 8);
$pdf->MultiCell(0, 4, "Je certifie sur l’honneur l’exactitude des renseignements fournis et demande la délivrance d'un visa de
reconnaissance conformément aux dispositions de la règle I/10 de la convention STCW et de la circulaire
n°04/DMMP du 14 Novembre 2018 fixant les conditions ainsi que les procedures de reconnaissance des titres
maritimes délivrés par d’autres Etats pour le service à bord des navires battant pavillon Algérien.", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->Rect(185,100, 5, 5, 'D');

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->setXY(10,135);
$pdf->MultiCell(0, 4, "FAIT A............................... LE ..............................
", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->setXY(10,140);
$pdf->setRTL(true);
// Draw a horizontal arrow and add text
$pdf->Line(195,143,132,143);
$pdf->MultiCell(0, 4, "SIGNATURE DU CANDIDAT/ENTREPRISE", 0, '', false, 0, '', '', true, 0, false, true, 0);
$pdf->SetXY(42,275);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(130, 10, '2/3', 0, 'C');













//THIRD PAGE----------------------------------------------


$pdf->AddPage('L');
$pdf->setRTL(false);


//green  D4E2D4
$hexColor = 'D4E2D4'; // color green
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(15,20,270,5, 'FD');
//blue and pink F5E8DD
$hexColor = 'F5E8DD'; // color pink
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);

$pdf->Rect(15,25,60,90, 'FD');

$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(15,25,270,15, 'FD');
$pdf->Rect(15,25,60,90, 'D');
$pdf->Rect(75,25,120,90, 'D');
$pdf->Rect(195,25,45,90, 'D');


//---------------------------------------------------
//green
$hexColor = 'D4E2D4'; // color green
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(15,115,270,5, 'FD');
//blue
$hexColor = '6895D2'; // color blue
$red = hexdec(substr($hexColor, 0, 2));
$green = hexdec(substr($hexColor, 2, 2));
$blue = hexdec(substr($hexColor, 4, 2));
$pdf->SetFillColor($red, $green, $blue);
$pdf->Rect(15,120,270,10, 'FD');

$pdf->Rect(240,120,45,60, 'D');
//----------------------------------
$pdf->Rect(15,20,270,160, 'D');
$pdf->SetXY(90,20);
$pdf->SetFont('dejavusans', 'B', 13);
$pdf->MultiCell(130, 10, 'TITRES MARITIMES DE LA MARINE MARCHANDE
', 0, 'C');
//--------------------------------------
$pdf->SetXY(30,30);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell(230, 10, 'CATEGORIES', 0, '');
$pdf->SetXY(20,30);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell(230, 10, 'BREVETS D’APTITUDE', 0, 'C');
$pdf->SetXY(102,28);
$pdf->SetFont('dejavusans', 'B', 11);
$pdf->MultiCell(230, 10, 'REFERENCE DE LA
CONVENTION STCW', 0, 'C');
$pdf->SetXY(145,30);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell(230, 10, 'NIVEAU', 0, 'C');

$pdf->SetXY(20,50);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell(230, 10, 'SERVICE PONT', 0, '');

$pdf->SetXY(20,90);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell(230, 10, 'SERVICE MACHINE', 0, '');

$pdf->Rect(75,40,210,6, 'D');
$pdf->SetXY(75,41);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '1. Officier chargé du quart ≥ 500', 0, '');
$pdf->SetXY(205,41);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'Règle II/1', 0, '');
$pdf->SetXY(250,50);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'DIRECTION', 0, '');
$pdf->SetXY(243,41);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'OPERATIONNEL', 0, '');
$pdf->Rect(75,46,120,6, 'D');
$pdf->SetXY(75,47);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '2. Second Capitaine < 3000', 0, '');
$pdf->Rect(75,52,120,6, 'D');
$pdf->SetXY(75,53);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '3. Capitaine < 3000', 0, '');
$pdf->SetXY(197,50);
$pdf->SetFont('dejavusans', '', 10);
$pdf->MultiCell(230, 10, 'Règle II/2 paragraphe 2', 0, '');
$pdf->Rect(195,46,45,12, 'D');

$pdf->Rect(195,58,45,12, 'D');
$pdf->SetXY(75,59);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '4. Second Capitaine ≥ 3000', 0, '');

$pdf->Rect(75,58,120,6, 'D');
$pdf->Rect(75,64,120,6, 'D');
$pdf->SetXY(75,65);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '5. Capitaine ≥ 3000', 0, '');
$pdf->SetXY(197,60);
$pdf->SetFont('dejavusans', '', 10);
$pdf->MultiCell(230, 10, 'Règle II/2 paragraphe 4', 0, '');
//-----------------------
$pdf->Line(15, 70,285,70);
$pdf->SetXY(75,71);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '1. Officier électrotechnicien ≥ 750 KW', 0, '');
$pdf->SetXY(205,71);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'Règle III/6', 0, '');
//$pdf->Rect(75,77,210,6, 'D');
//$pdf->Rect(75,81,120,6, 'D');
$pdf->Line(75, 77,240,77);
$pdf->SetXY(75,77);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '2. Officier chargé de quart ≥ 750 KW', 0, '');
//$pdf->Rect(75,87,120,6, 'D');
$pdf->SetXY(75,83);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '3. Officier chargé de quart entre 750 et 3000 KW', 0, '');
$pdf->SetXY(245,78);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'OPERATIONNEL', 0, '');
$pdf->SetXY(205,80);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'Règle III/1', 0, '');
$pdf->Line(75, 82,195,82);
//$pdf->Rect(195,99,45,10, 'D');//
$pdf->SetXY(75,89);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '4. Second Mécanicien < 3000 KW', 0, '');
$pdf->Line(75, 89,285,89);
$pdf->SetXY(75,95);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '5. Chef Mécanicien < 3000 KW', 0, '');
$pdf->SetXY(205,90);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'Règle III/2', 0, '');
$pdf->SetXY(245,100);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'DIRECTION', 0, '');
$pdf->Line(75, 95,195,95);
$pdf->SetXY(75,101);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '6. Second Mécanicien ≥ 3000 KW', 0, '');
$pdf->Line(75, 101,240,101);
$pdf->SetXY(75,108);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, '7. Chef Mécanicien ≥ 3000KW', 0, '');
$pdf->Line(75, 108,195,108);
$pdf->SetXY(205,104);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(230, 10, 'Règle III/3', 0, '');
//$pdf->Rect(75,93,120,6, 'D');
//$pdf->Rect(75,99,120,6, 'D');

//-----------------------------------
$pdf->SetXY(30,115);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell(230, 10, 'CERTIFICATS REQUIS POUR LE SERVICE À BORD DES PÉTROLIERS ET DES NAVIRES-CITERNES', 0, 'C');

$pdf->SetXY(30,123);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell(230, 10, 'CERTIFICATS D’APTITUDE ', 0, 'C');

$pdf->SetXY(149,121);
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(230, 10, 'REFERENCE DE LA
CONVENTION STCW ', 0, 'C');

$pdf->SetXY(15,130);
$pdf->SetFont('dejavusans', '', 11);
$pdf->MultiCell(300, 10, '1. Certificat de formation de base aux opérations liées à la cargaison des pétroliers et des navires citernes pour
produits chimiques ;', 0, '');

$pdf->Line(15, 143,240,143);
$pdf->SetXY(15,143);
$pdf->SetFont('dejavusans', '', 11);
$pdf->MultiCell(300, 10, '3. Certificat de formation avancée aux opérations liées à la cargaison des pétroliers ;', 0, '');

$pdf->Line(15, 150,240,150);
$pdf->SetXY(15,150);
$pdf->SetFont('dejavusans', '', 11);
$pdf->MultiCell(300, 10, '4. Certificat de formation avancée aux opérations liées à la cargaison des navires citernes pour produits chimiques;', 0, '');

$pdf->Line(15, 157,240,157);
$pdf->SetXY(15,157);
$pdf->SetFont('dejavusans', '', 11);
$pdf->MultiCell(300, 10, '2. Certificat de formation de base aux opérations liées à la cargaison des navires citernes pour gaz liquéfiés ;', 0, '');

$pdf->Line(15, 164,285,164);
$pdf->SetXY(15,164);
$pdf->SetFont('dejavusans', '', 11);
$pdf->MultiCell(300, 10, '5. Certificat de formation avancée aux opérations liées à la cargaison des navires citernes pour gaz liquéfiés', 0, '');
$pdf->SetXY(245,143);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(300, 10, 'Règle V/1-1', 0, '');
$pdf->SetXY(245,168);
$pdf->SetFont('dejavusans', '', 12);
$pdf->MultiCell(300, 10, 'Règle V/1-2', 0, '');


$pdf->setRTL(false);
$pdf->SetXY(90,186);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(130, 10, '3/3', 0, 'C');



$pdf->Output('Reconaissance.pdf', 'I');
