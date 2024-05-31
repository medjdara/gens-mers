<?php

include_once('../../../include/config.php');
require_once('tcpdf.php');


if (isset($_GET['id_certificatc'])) {
    $id = $_GET['id_certificatc'];

$sql = "SELECT c.id_certificatc,c.numero_certificat ,c.type_certificat ,c.sous_type_certificat ,c.etat_certificat
,c.date_delivrance ,c.date_revalidation ,c.id_marin ,m.nom_et_prenom as nom_marin ,
m.date_de_naissance,m.lieu_de_naissance,m.nom_et_prenom_arabe AS nom_marin_arabe,
m.lieu_de_naissance_arabe
FROM `certificat_navire_citerne` c
INNER JOIN marin m ON c.id_marin = m.id_marin
WHERE 
c.id_certificatc = $id;
";
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
$pdf->SetLineWidth(0.5); // Set line width to 1.5 (adjust as needed)
$pdf->Line(10, 10, 200, 10); // Top line
$pdf->Line(200, 10, 200, 285); // Right line
$pdf->Line(200, 285, 10, 285); // Bottom line
$pdf->Line(10, 285, 10, 10); // Left line
$pdf->SetLineWidth(0.2); // Reset line width to default (0.2)

$pdf->Image('C:\xampp\htdocs\sitepfe\images\logo2.png', 45, 30, 24, 24, '', '', 'R', false, 300, '', false, false, 0, false, false, false, false, array());
$pdf->Image('C:\xampp\htdocs\sitepfe\images\logo2.png', 187, 30, 24, 24, '', '', 'L', false, 300, '', false, false, 0, false, false, false, false, array());

//freeserif
$pdf->SetFont('freeserif', 'B', 11, '', true);
$pdf->SetY(15); 
$pdf->MultiCell(0, 0, "الــجمهـورية الـجـزائـريـة الـديمـوقــراطـيـة الـشـعـــبية 
", 0, 'C', false, 0, '', '', true, 0, false, true, 0); 
$pdf->SetY(16); 
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->MultiCell(0, 4, "
REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE
", 0, 'C', false, 0.2, '', '', true, 0, false, true, 0);


$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->SetY(30); 
$pdf->MultiCell(0, 5, "وزارة النقل
", 0, 'C', false, 1, '', '', true, 0, false, true, 0);
$pdf->SetFont('freeserif', '', 10, '', true);
$pdf->SetY(34);
$pdf->MultiCell(0, 5, "MINISTRY OF TRANSPORTS
", 0, 'C');
$pdf->SetY(42); 
$pdf->setRTL(true);
$pdf->SetFont('freeserif', 'B', 12, '', true);
$pdf->MultiCell(0, 10, "مديرية البحرية التجارية
", 0, 'C');
$pdf->setRTL(false);
$pdf->SetY(43);
$pdf->SetFont('freeserif', '', 12, '', true);
$pdf->MultiCell(0, 10, "
MERCHANT MARINE DIRECTORATE
", 0, 'C');
$pdf->SetY(56); 
$pdf->setRTL(true);
$pdf->SetFont('dejavusans', 'B', 25, '', true);
$pdf->MultiCell(0, 10, "شهادة الأهلية
", 0, 'C');
$pdf->SetY(62); 
$pdf->setRTL(false);
$pdf->SetFont('dejavusans', 'B', 13, '', true);
$pdf->MultiCell(0, 10, "
CERTIFICATE OF PROFICIENCY
", 0, 'C');
$pdf->SetY(76);
$pdf->SetFont('freeserif', 'B', 10, '', true);
$pdf->MultiCell(0, 5, "Certificate N°: ".$row['numero_certificat']." رقم الشهادة 
", 0, 'C');
$pdf->SetY(80);
$pdf->setRTL(true);
$pdf->SetFont('freeserif', '', 12, '', true);
$pdf->MultiCell(0, 5, "
إن مدير البحرية التجارية يشهد بأن :".$row['']."\n
السيد:".$row['nom_marin_arabe']."\n
المولود بتاريخ: ".$row['date_de_naissance']."  ب:".$row['lieu_de_naissance_arabe']."\n 
تم تجديد شهادته ل :".$row['date_revalidation']."\n
", 0, '');
$pdf->SetY(80);
$pdf->setRTL(false);
$pdf->MultiCell(0, 5, "
The Director of the Merchant Marine certifies that:\n
    Mr:".$row['nom_marin']."\n
    Born on:".$row['lieu_de_naissance']."\n
    Has revalidated his certificate of: ".$row['date_revalidation']."\n
", 0, '');
$pdf->SetFont('freeserif', 'B', 15, '', true);
$pdf->SetY(126);
$pdf->MultiCell(0, 5, "
تكوين متقدم على العمليات المتعلقة بناقلات الغاز المميع
", 0, 'C');
$pdf->SetY(134);
$pdf->SetFont('freeserif', '', 12, '', true);
$pdf->MultiCell(0, 5, "
ADVANCED TRAINING FOR LIQUEFIED GAS TANKER CARGO OPERATIONS
", 0, 'C');
$pdf->setRTL(true);
$pdf->MultiCell(0, 5, "
وفقاً لأحكام الفقرة رقم 3 من اللائحة 1/11 للاتفاقية الدولية لمعايير التدريب و منح الشهادات وأعمال النوبة للعاملين بالبحر لعام 1978 في صيغتها المعدلة.
", 0, '');
$pdf->setRTL(false);
$pdf->SetY(155);
$pdf->MultiCell(0, 5, "
In accordance with the provision of regulation I/11 paragraph 3 of the International Convention on Standards of Training, Certification and Watchkeeping for Seafarers 1978, as amended.
", 0, '');

$pdf->setRTL(true);
$pdf->SetXY(110,175);
$pdf->MultiCell(0, 5, "
تاريخ الإصدار:
  :صالحة إلى غاية 

", 0, '');
$pdf->setRTL(false);
$pdf->SetXY(20,175);
$pdf->MultiCell(0, 5, "
Issued on:  ".$row['date_delivrance']."
Valid until:
", 0, '');
$pdf->SetFont('freeserif', 'B', 11, '', true);
$pdf->SetXY(140,220);
$pdf->MultiCell(0, 5, "
المدير
Director BOUKHAROUBA A
", 0, 'C');

$pdf->SetFont('freeserif', 'B', 11, '', true);
$pdf->SetXY(30,198);
$pdf->MultiCell(0, 5, "
توقيع صاحب الشهادة
", 0, '');
$pdf->SetFont('freeserif', '', 11, '', true);
$pdf->SetXY(20,205);
$pdf->MultiCell(0, 5, "
Signature of the holder of the certificate
", 0, '');
$pdf->SetFont('freeserif', '', 8.5, '', true);
$pdf->setRTL(true);
$pdf->SetY(250);
$pdf->MultiCell(0, 5, "
يجب أن تظل النسخة الأصلية من هذه الشهادة متاحة وفقًا للائحة 1/2، الفقرة 11 من الاتفاقية الدولية STCW أثناء الخدمة على متن السفينة.
", 0, '');
$pdf->setRTL(false);
$pdf->SetY(255);
$pdf->MultiCell(0, 5, "
the original of this Certificate must be kept available in accordance with regulation 1/2, Paragraph 11 of the International Convention STCW while serving on a ship.
", 0, '');
$pdf->setRTL(true);
$pdf->SetY(262);
$pdf->MultiCell(0, 5, "
في حال تجاوز مدة نهاية صلاحية هذه الشهادة بستة (06) اشهر على حاملها أن يعيد التكوين المتعلق بهاء طبقا لأحكام الفقرة (4) الباب الثالث من التنظيم رقم 14
المؤرخ في 09 ديسمير 2014, الذي يحدد كيفية وشروط الالتحاق بالتكوينات القصيرة المدى المفروضة من قبل الاتفاقية الدولية STCW في صيغتها المعدلة.
", 0, '');
$pdf->setRTL(false);
$pdf->SetY(270);
$pdf->MultiCell(0, 5, "
Beyond six(06) months of the due date, the, holder of the expired certificate has ability to refresh the training, according to the provisions of paragraph (Part 111 of the Cirular N°14/3602/SG dated in December 09th 2014, which determines the conditions of admission to the short cours required national Convention STCW 1978 as amended.
", 0, '');
// Your HTML content with font-face rule

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