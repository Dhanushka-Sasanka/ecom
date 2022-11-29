<?php
//include_once('TCPDF-main/tcpdf.php');
require_once('TCPDF-main/examples/tcpdf_include.php');

include('inc/config.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Payment Details Report" . ' 2022', "sadeeonlinestore.com\nSri-Lanka");

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
								<th>#ID</th>
								<th >NAME</th>
								<th >PAYMENT DATE</th>
								<th >PAYMENT</th>
								<th >PAYMENT METHOD</th>
								<th >STATUS</th>
							</tr>
						</thead>
						<hr>
						<tbody>";

$statement = $pdo->prepare("SELECT id, customer_name, payment_date, paid_amount, payment_method, payment_status FROM tbl_payment");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {

    if ($row['payment_status'] == 1) {
        $status = "COMPLETE";
    } else {
        $status = "INCOMPLETE";
    }

    $html .= "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['customer_name'] . "</td>
									<td>" . $row['payment_date'] . "</td>
									<td>" . $row['paid_amount'] . "</td>
									<td>" . $row['payment_method'] . "</td>
									<td>" . $status . "</td>
									
									
		</tr>";
}

$html .= "</tbody>
</table>";
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Output('SupplierList2022.pdf', 'I');
