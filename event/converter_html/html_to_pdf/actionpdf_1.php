
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../../account/stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
  
    </head>
    <body>
    <?php 
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->Image('logo.png',18,13,33);
$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('AMIT KUMAR');

$pdf->SetFont('Arial','',5); 

 $htmlTable="<table cellspacing='0' cellpadding='0' style='width:100%; height:100%;'>".$_POST['convert_file']."</table>";   

$pdf->WriteHTML2("<br><br><br>$htmlTable");
$pdf->SetFont('Arial','',6);
ob_end_clean();
$pdf->Output(); 

?>
    </body>
</html>
