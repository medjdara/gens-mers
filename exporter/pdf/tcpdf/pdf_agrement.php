<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['Id_agrement'])) {
    $id = $_GET['Id_agrement'];

    $sql = "SELECT  a.Id_agrement,a.date_expiration_ar,a.date_expiration,a.date_delivrance_ar, a.date_delivrance,a.lieu_delivrance_fr , 
    a.lieu_delivrance_ar, me.nom_et_prenom as nom_marin, me.lieu_de_naissance_arabe,me.lieu_de_naissance, l.nom_limitation ,
    me.date_de_naissance,
    r.nom_regularisation ,nv.nv_responsabilite , e.nom_et_prenom as nom_employe , p.nom_port ,o.nom_organisme
    FROM Agrément a  
    INNER JOIN marin me ON a.id_marin = me.id_marin
    INNER JOIN limitation l ON a.id_limitation = l.id_limitation
    INNER JOIN regularisation r ON a.id_regularisation = r.id_regularisation
    INNER JOIN nv_responsabilites nv ON a.id_nvr = nv.id_nv_responsabilite
    INNER JOIN employe e ON a.id_employe = e.id_employe
    INNER JOIN Port p ON a.id_port = p.id_port
    INNER JOIN Organisme o ON a.id_organisme = o.id_organisme
    WHERE Id_agrement = $id";
    
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


$pdf->SetTitle("Agrement pilote");
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
$pdf->SetLineWidth(0.5); // Set line width (adjust as needed)
$pdf->Line(10, 10, 200, 10); // Top line
$pdf->Line(200, 10, 200, 285); // Right line
$pdf->Line(200, 285, 10, 285); // Bottom line
$pdf->Line(10, 285, 10, 10); // Left line
$pdf->SetLineWidth(0.2); // Reset line width to default (0.2)

$pdf->Image('C:\xampp\htdocs\sitepfe\images\logo2.png', 197, 16, 24, 20, '', '', 'R', false, 300, '', false, false, 0, false, false, false, false, array());
//freeserif
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetXY(23,15); 
$pdf->MultiCell(0, 0, "الــجمهـورية الـجـزائـريـة الـديمـوقــراطـيـة الـشـعـــبية 
", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 
$pdf->SetXY(20,18); 
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->MultiCell(0, 4, "
REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);

$pdf->SetXY(20,30);
$pdf->SetFont('freeserif', 'B', 13, '', true);
$pdf->MultiCell(0, 5, "اعتماد مرشد بحري رقم 23/2023 
صادر بمقتضى أحكام المرسوم التنفيذي رقم 06-08 المؤرخ في 9 ذو الحجة 1426 
لـ 09 جانفي 2006، يحدد تنظيم الإرشاد والمؤهلات المهنية للمرشدين
وقواعد ممارسة الإرشاد في الموانئ، المعدل والمتمم
", 0, 'C', false, 1, '', '', true, 0, false, true, 0);

$pdf->SetXY(20,57);
$pdf->MultiCell(0, 5, "AGREMENT DE PILOTE MARITIME N° 23/2023
DELIVRE CONFORMEMENT AUX DISPOSITIONS DU DECRET EXECUTIF 
N°06-08 DU 9 DHOU EL HIDJA 1426 CORRESPONDANT AU 9 JANVIER 2006
FIXANT L’ORGANISATION DU PILOTAGE, LES QUALIFICATIONS PROFESSIONNELLES DES PILOTES ET LES REGLES D’EXERCICE DU PILOTAGE DANS LES PORTS, TEL QUE MODIFIE ET COMPLETE
", 0, 'C');


$pdf->Line(70,95, 140, 95); // Horizontal line

$pdf->setRTL(true);
$pdf->SetFont('freeserif', '', 12, '', true);
$pdf->MultiCell(0, 10, "
يشهد الوزير المكلف بالبحرية التجارية والموانئ أن السيد/ة ".$row['nom_marin']."  المولود بتاريخ  ".$row['date_de_naissance']." ب".$row['lieu_de_naissance_arabe']." يستوفي الشروط المحددة في المادة ".$row['nom_regularisation']." من المرسوم التنفيذي المذكور أعلاه ومعتمد لممارسة وظيفة مرشد بحري إلى غاية ".$row['date_expiration_ar']."
", 0, '');
$pdf->setRTL(false);
$pdf->SetY(105);
$pdf->SetFont('freeserif', '', 12, '', true);
$pdf->MultiCell(0, 10, "
Le Ministre chargé de la Marine Marchande et des Ports certifie que M/me ".$row['nom_marin']." né le ".$row['date_de_naissance']."  à ".$row['lieu_de_naissance']." remplit les conditions fixées par l’article ".$row['nom_regularisation']." du décret précité, et est agréé pour l’exercice de la fonction de pilote maritime jusqu’au ".$row['date_expiration']."
", 0, '');



//-------table ---------------
$pdf->SetFont('freeserif', 'B', 10, '', true);
// Header row
$pdf->SetXY(15, 130);
$pdf->MultiCell(60, 10, "اعتماد صالح لمينائي
Agrément valable pour les ports
", 1,'C');
$pdf->SetXY(75,130);
$pdf->MultiCell(45, 10, "القيود
Limitations
", 1, 'C');
$pdf->SetXY(120,130);
$pdf->MultiCell(75, 10, "الهيئة المستخدمة
Organisme employeur
", 1, 'C');
$pdf->SetFont('freeserif', 'B', 10, '', true);
// Data rows
$pdf->SetXY(15,140);
$pdf->MultiCell(60, 30,'', 1, '');
$pdf->SetXY(15,140);
$pdf->MultiCell(60, 30,$row['nom_port'], 0, 'C');
$pdf->SetXY(75,140);
$pdf->MultiCell(45, 30,'', 1, '');
$pdf->SetXY(75,140);
$pdf->MultiCell(45, 30,$row['nom_limitation'], 0, 'C');
$pdf->SetXY(120,140);
$pdf->MultiCell(75, 30,'', 1, '');
$pdf->SetXY(120,140);
$pdf->MultiCell(75, 30, $row['nom_organisme'], 0, 'C');


//-----------------------------------
$pdf->SetFont('freeserif', '', 12, '', true);
$pdf->setRTL(true);
$pdf->SetY(172);
$pdf->MultiCell(0, 5, "صادر ب".$row['lieu_delivrance_ar']." في   
", 0, '');
$pdf->SetXY(40,167);
$pdf->MultiCell(0, 5, "
Fait à ".$row['lieu_delivrance_fr']." le ".$row['date_delivrance']." 
", 0, '');
$pdf->SetFont('freeserif', 'B', 15, '', true);

$pdf->SetXY(90,180);
$pdf->MultiCell(0, 5, "
ع/ وزيـر النـقـل
P/ Le Ministre des Transports
", 0, 'C');
$pdf->SetFont('freeserif', '', 12, '', true);

$pdf->SetXY(90,240);
$pdf->MultiCell(0, 5, "توقيع صاحب الاعتماد
Signature du titulaire de l’agrément
", 0, 'C');







$pdf->SetFont('freeserif', '',10, '', true);
$pdf->setRTL(true);
$pdf->SetY(271);
$pdf->MultiCell(0, 5, "
La copie originale de cet agrément doit être conservée par l’intéressé      يجب الاحتفاظ بأصل هذا الاعتماد من طرف المعني بالأمر
", 0, '');
// Your HTML content with font-face rule
$pdf->setRTL(false);
$html = <<<EOD
<!DOCTYPE html>
<html>
<head>
    <style>
        .bold { font-weight: bold; }
    </style>
</head>
<body>

</body>
</html>
EOD;
$pdf->writeHTML($html);





$pdf->Output('brevet.pdf', 'I');
}