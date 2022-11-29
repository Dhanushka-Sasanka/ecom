<?php
//include_once('TCPDF-main/tcpdf.php');
require_once('TCPDF-main/examples/tcpdf_include.php');

include('inc/config.php');





$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Customer List Report" . ' 2022', "sadeeonlinestore.com\nSri-Lanka");

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('dejavusans', '', 10);
$pdf->SetLineWidth(0.4);


//// add a page
$pdf->AddPage();

$html = "<table id='example1' border='1'  cellpadding='4'>
						<thead>
							<tr>
								<th>ID</th>
								<th >Name</th>
								<th >Email</th>
								<th >City</th>
								<th >Mobile</th>
								<th>Status</th>
							</tr>
						</thead>
						<hr>
						<tbody>";

$statement = $pdo->prepare('SELECT * FROM tbl_customer t1 JOIN tbl_country t2 ON t1.cust_country = t2.country_id');
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    if ($row['cust_status'] == 1) {
        $status = "ACTIVE";
    } else {
        $status = "INACTIVE";
    }
    $html .= "<tr>
                                    <td>" . $row['cust_id'] . "</td>
                                    <td>" . $row['cust_name'] . "</td>
									<td>" . $row['cust_email'] . "</td>
									<td>" . $row['cust_city'] . "</td>
									<td>" . $row['cust_phone'] . "</td>
									<td>" . $status . "</td>
		</tr>";
}
//$pdf->writeHTML($html, true, false, true, false, '');
$html .= "</tbody>
</table>";
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Output('CustomerList2022.pdf', 'I');
