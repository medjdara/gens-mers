<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['id_brevet'])) {
    $id = $_GET['id_brevet'];
    $sql = "SELECT 
    b.id_brevet, b.num_brevet, b.date_delivrance, b.date_expiration,
    m.nom_et_prenom AS nom_marin, m.date_de_naissance, m.lieu_de_naissance,
    m.nom_et_prenom_arabe AS nom_marin_arabe, m.lieu_de_naissance_arabe,
    f.nom_fonction AS fonction_employe, l.nom_limitation, n.nv_responsabilite,
    r.nom_regularisation, e.nom_et_prenom AS nom_employe,
    et.netat_brevet, c.capacite,
    bb.fonction_a, bb.limitation_a, bb.niveau_a
FROM 
    Brevet b
    JOIN marin m ON b.id_marin = m.id_marin
    LEFT JOIN limitation l ON b.id_limitation = l.id_limitation
    LEFT JOIN nv_responsabilites n ON b.id_nvr = n.id_nv_responsabilite
    LEFT JOIN regularisation r ON b.id_regularisation = r.id_regularisation
    LEFT JOIN employe e ON b.id_employe = e.id_employe
    LEFT JOIN fonction f ON e.id_fonction = f.id_fonction
    LEFT JOIN etat_brevet et ON b.id_etat = et.id_etat
    LEFT JOIN competence c ON b.id_marin = c.id_marin
    LEFT JOIN (
        SELECT
            id_brevet,
            ff.nom_fonction AS fonction_a,  -- Use the correct alias here
            ll.nom_limitation AS limitation_a,
            nn.nv_responsabilite AS niveau_a
        FROM archiver_brevet
        JOIN marin mm ON archiver_brevet.id_marin = mm.id_marin
        LEFT JOIN limitation ll ON archiver_brevet.id_limitation = ll.id_limitation
        LEFT JOIN nv_responsabilites nn ON archiver_brevet.id_nvr = nn.id_nv_responsabilite
        LEFT JOIN regularisation rr ON archiver_brevet.id_regularisation = rr.id_regularisation
        LEFT JOIN employe ee ON archiver_brevet.id_employe = ee.id_employe
        LEFT JOIN fonction ff ON ee.id_fonction = ff.id_fonction
        LEFT JOIN etat_brevet ett ON archiver_brevet.id_etat = ett.id_etat
    ) bb ON b.id_brevet = bb.id_brevet
WHERE 
    b.id_brevet = $id";

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


$pdf->SetTitle("Brevet reconnaissance");
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
$pdf->SetLineWidth(0.5); // Set line width to 1.5 (adjust as needed)
$pdf->Line(10, 10, 200, 10); // Top line
$pdf->Line(200, 10, 200, 285); // Right line
$pdf->Line(200, 285, 10, 285); // Bottom line
$pdf->Line(10, 285, 10, 10); // Left line
$pdf->SetLineWidth(0.2); // Reset line width to default (0.2)

$pdf->Image('C:\xampp\htdocs\sitepfe\images\logo2.png', 197, 16, 24, 20, '', '', 'R', false, 300, '', false, false, 0, false, false, false, false, array());
//freeserif
$pdf->SetFont('dejavusans', 'B', 11, '', true);
$pdf->SetXY(23,15); 
$pdf->MultiCell(0, 0, "الــجمهـورية الـجـزائـريـة الـديمـوقــراطـيـة الـشـعـــبية 
", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 
$pdf->SetXY(20,16); 
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->MultiCell(0, 4, "
REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);


$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->SetXY(30,25); 
$pdf->MultiCell(0, 5, "
شهادة كفاءة صادرة بمقتضى أحكام الإتفاقية الدولية لمعايير التدريب و منح\n الشهادات وأعمال النوبة للعاملين بالبحر لعام 1978 في صيغتها المعدلة
", 0, 'C', false, 1, '', '', true, 0, false, true, 0);
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->SetXY(23,35);
$pdf->MultiCell(0, 5, "
CERTIFICATE OF COMPETENCY ISSUED UNDER THE PROVISIONS OF THE\n INTERNATIONAL CONVENTION ON STANDARDS OF TRAINING,\n CERTIFICATION AND WATCHKEEPING FOR SEAFARERS 1978 AS AMENDED
", 0, 'C');
$pdf->SetXY(13,52);
$pdf->setRTL(true);
$pdf->SetFont('freeserif', '', 10.5, '', true);
$pdf->MultiCell(0, 10, "
تشهد الحكومة الجزائرية الديمقراطية و الشعبية أن الشهادة رقم ".$row['num_brevet']."أصدرت في ".$row['date_delivrance']." إلى السيد ".$row['nom_marin']." المولود في (".$row['nom_arabe_pays'].")".$row['lieu_de_naissance']." بتاريخ ".$row['date_de_naissance']." مـن قبل او بالنيابة عن الحكومة ......معترف بها حسب الاقتضاء طبقا لأحكام االقاعدة ".$row['nom_regularisation']." من الإتفاقية المذكورة أعلاه ، في صيغتها المعدلة و يسمح لصاحب هذه المصادقة الشرعي بآداء الوظائف التالية في المستويات المحددة ، طبقا لأية قيود مشار إليها حتى ".$row['date_expiration']."
", 0, '');
$pdf->setRTL(false);
$pdf->SetXY(13,69);
$pdf->SetFont('freeserif', '', 10.5, '', true);
$pdf->MultiCell(0, 10, "
The Government of People's Democratic Republic of Algeria certifies that Certificate of competency N° ".$row['num_brevet']."  issued in ".$row['date_delivrance']." to Mr ".$row['nom_marin'].", born  on ".$row['date_de_naissance']." at ".$row['lieu_de_naissance']."(".$row['nom_pays'].") by or on behalf on the Government of ...... is duly recognised in accordance with the provisions of regulation ".$row['nom_regularisation']." of the above Convention, as amended, and the lawful holder is authorised to preform the folowing functions, at the levels apecified, subject to any limitations indicated until ".$row['date_expiration'].".
", 0, '');
//-------table 1 ---------------

$pdf->SetFont('freeserif', 'B', 10, '', true);

// Header row
$pdf->SetXY(15, 100);
$pdf->MultiCell(60, 10, "الوظيفة\nFUNCTION", 1,'C');
$pdf->SetXY(75,100);
$pdf->MultiCell(40, 10, "المستوى\nLEVEL", 1, 'C');
$pdf->SetXY(115,100);
$pdf->MultiCell(80, 10, "القيود المفروضة (إن وجدت)\nLIMITATIONS APPLYING (IF ANY)", 1, 'C');
$pdf->SetFont('freeserif', '', 10, '', true);
// Data rows
$pdf->SetXY(15,110);
$pdf->MultiCell(60, 10,'', 1, '');
$pdf->SetXY(15,110);
$pdf->MultiCell(60, 10, $row['fonction_employe'], 0, 'C');
$pdf->SetXY(75,110);
$pdf->MultiCell(40, 10,'', 1, '');
$pdf->SetXY(75,110);
$pdf->MultiCell(40, 10, $row['nv_responsabilite'], 0, 'C');
$pdf->SetXY(115,110);
$pdf->MultiCell(80, 10,'', 1, '');
$pdf->SetXY(115,110);
$pdf->MultiCell(80, 10, $row['nom_limitation'], 0, 'C');

$pdf->SetXY(15,121);
$pdf->MultiCell(60, 10, ' ', 1, 'C');
$pdf->SetXY(15,121);
$pdf->MultiCell(60, 10, $row['fonction_a'], 0, 'C');
$pdf->SetXY(75,121);
$pdf->MultiCell(40, 10, ' ', 1, 'C');
$pdf->SetXY(75,121);
$pdf->MultiCell(40, 10, $row['niveau_a'], 0, 'C');
$pdf->SetXY(115,121);
$pdf->MultiCell(80, 10, ' ', 1, 'C');
$pdf->SetXY(115,121);
$pdf->MultiCell(80, 10, $row['limitation_a'], 0, 'C');

$pdf->SetXY(15,132);
$pdf->MultiCell(60, 10, ' ', 1, 'C');
$pdf->SetXY(75,132);
$pdf->MultiCell(40, 10, ' ', 1, 'C');
$pdf->SetXY(115,132);
$pdf->MultiCell(80, 10, ' ', 1, 'C');

//-----------------------

$pdf->setRTL(true);
$pdf->SetY(137);
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->MultiCell(0, 5, "
يمكن لحامل هذه الشهادة الشرعي أن يعمل بالصفة أو الصفات التالية المحددة في متطلبات التطقيم الأمن المنفذة و التي تشترطها الإدارة.
", 0, '');
$pdf->SetY(142);
$pdf->setRTL(false);
$pdf->MultiCell(0, 5, "
The lawful holder of this certificate may serve in the following capacity or capacities specified in the applicable safe manning requirements of the Administration.
", 0, '');

//-------table 2 ---------------

$pdf->SetFont('freeserif', 'B', 10, '', true);
// Header row
$pdf->SetXY(15, 156);
$pdf->MultiCell(75, 10, "الصفة\nCAPACITY", 1,'C');
$pdf->SetXY(90,156);
$pdf->MultiCell(105, 10, "القيود المفروضة (إن وجدت)\nLIMITATIONS APPLYING (IF ANY)", 1, 'C');
$pdf->SetFont('freeserif', '', 10, '', true);
// Data rows
$pdf->SetXY(15,167);
$pdf->MultiCell(75, 10,'', 1, '');
$pdf->SetXY(15,167);
$pdf->MultiCell(75, 10, $row['capacite'], 0, 'C');
$pdf->SetXY(90,167);
$pdf->MultiCell(105, 10,'', 1, '');
$pdf->SetXY(90,167);
$pdf->MultiCell(105, 10, $row['nom_limitation'], 0, 'C');

//-----------------------------------
$pdf->SetFont('freeserif', '', 11, '', true);
$pdf->setRTL(true);
$pdf->SetY(173);
$pdf->MultiCell(0, 5, "
رقم الشهادة ".$row['num_brevet']." الصادرة في ".$row['date_delivrance']."
", 0, '');
$pdf->SetY(178);
$pdf->MultiCell(0, 5, "
Certificate N° ".$row['num_brevet']." issued on ".$row['date_delivrance']."
", 0, '');

$pdf->setRTL(false);
$pdf->SetXY(20,179);
$pdf->MultiCell(0, 5, "
توقیع و إسم الموظف المفوض حسب الاقتضاء
", 0, '');
$pdf->SetY(183);
$pdf->MultiCell(0, 5, "
Signature and Name of duly authorized official
", 0, '');
$pdf->SetFont('freeserif', 'B', 11, '', true);
$pdf->SetXY(40,193);
$pdf->MultiCell(0, 5, "
بوخروبة عبد الحق
", 0, '');
$pdf->SetFont('freeserif', '', 11, '', true);
$pdf->SetXY(30,197);
$pdf->MultiCell(0, 5, "
BOUKHAROUBA Abdelhak
", 0, '');
$pdf->SetFont('freeserif', 'B', 11, '', true);
$pdf->SetXY(40,235);
$pdf->MultiCell(0, 5, "
توقيع صاحب الشهادة
", 0, '');
$pdf->SetFont('freeserif', '', 11, '', true);
$pdf->SetXY(25,239);
$pdf->MultiCell(0, 5, "
Signature of the holder of the certificate
", 0, '');
$pdf->SetFont('freeserif', '', 8.5, '', true);
$pdf->setRTL(true);
$pdf->SetY(270);
$pdf->MultiCell(0, 5, "
يجب الاحتفاظ بأصل هذه الشهادة لتقديمها في أي وقت أثناء الخدمة على متن السفينة طبقا للفقرة رقم 11 من القاعدة رقم 2/1
", 0, '');
$pdf->SetY(274);
$pdf->MultiCell(0, 5, "
The Original of this Certificate must be kept available in accordance with regulation 1/2, Paragraph 11 of the Convention while serving on a ship.
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