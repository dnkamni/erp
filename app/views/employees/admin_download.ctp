<?php
App::import('Vendor','xtcpdf');  
$pdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

$pdf->AddPage();
       // set JPEG quality
$pdf->setJPEGQuality(75);

$htmltable1 = '<table cellpadding="1" cellspacing="1" border="0" style="text-align:center;margin-left:180px;">
<tr><td align="center"><h4 > Employee(s) Report </h4></td></tr>
<tr><td height="5px"></td></tr>
</table>'; 
 // set core font
$pdf->SetFont('helvetica', '', 9); 
// output the HTML content
$pdf->writeHTML($htmltable1, true, 0, true, true);


$htmltable4 = '<br><table align="left" border="1" cellspacing="0" cellpadding="4" >' ;
$htmltable4  .=	'<tr bgcolor="#4d9ffa">
<td align="center" style="color:black ; font-weight:bold;">Employee Code</td>
<td align="center" style="color:black ; font-weight:bold;">First Name</td>
<td align="center" style="color:black ; font-weight:bold;">Last Name</td>
<td align="center" style="color:black ; font-weight:bold;">Email</td>
<td align="center" style="color:black ; font-weight:bold;">Phone</td>
<td align="center" style="color:black ; font-weight:bold;">Salary</td>
</tr>' ;

$bgclr  = '';
foreach($crData as $val) {
$bgclr  = $val['User']['status']  ? '#ffffff' : '#ff6544'; //if status is deactivated then red.
$htmltable4  .=	'<tr bgcolor="'. $bgclr .'">
<td align="left" style="color:black ; font-weight:bold;">'. $val['User']['employee_code'].'</td>
<td align="left" style="color:black ; font-weight:bold;">'. $val['User']['first_name'].'</td>
<td align="left" style="color:black ; font-weight:bold;">'. $val['User']['last_name'].'</td>
<td align="left" style="color:black ; font-weight:bold;">'. $val['User']['email'].'</td>
<td align="left" style="color:black ; font-weight:bold;">'. $val['User']['phone'].'</td>
<td align="left" style="color:black ; font-weight:bold;">'. $val['User']['current_salary'].'</td>
</tr>' ;
}

$htmltable4 .='</table>';
                                                 
// set core font
$pdf->SetFont('helvetica', '', 9);
// output the HTML content
$pdf->writeHTML($htmltable4, true, 0, true, true);

// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output('UserReport.pdf', 'D');
?>