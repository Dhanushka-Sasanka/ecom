<?php
//include_once('TCPDF-main/tcpdf.php');
require_once('TCPDF-main/examples/tcpdf_include.php');

include('inc/config.php');


if (isset($_POST['yearSalesBtn']) && $_POST['year_sales_start_date'] && $_POST['year_sales_end_date']) {
    $startDate = $_POST['year_sales_start_date'];
    $endDate = $_POST['year_sales_end_date'];
//    printf($startDate );
//    printf($endDate );
//    $startDate = explode('/', $startDate);
//    $endDate = explode('/', $endDate);
////    $month = $startDate[0];
////    $day   = $startDate[1];
////    $year  = $startDate[2];
//
////    $month = $startDate[0];
////    $day   = $startDate[1];
////    $year  = $startDate[2];
//
//    $startDate = $startDate[2] .'-'.$startDate[0].'-'.$startDate[1];
//    $endDate = $endDate[2] .'-'.$endDate[0].'-'.$endDate[1];
//
//    printf($startDate );
//    printf($endDate );


    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
    $pdf->SetCreator(PDF_CREATOR);

//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Yearly Sales Report" . ' 2022', "sadeeonlinestore.com\nSri-Lanka");

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
								<th>YEAR</th>
								<th >MONTH</th>
								<th >PRODUCT COUNT</th>
								<th >SALES COUNT</th>
							</tr>
						</thead>
						<hr>
						<tbody>";
//printf("select YEAR(t.date) AS 'YEAR',month(t.date) AS 'MONTH',COUNT(t.quantity) AS 'COUNT' , SUM(t.id) AS 'TURNS' from tbl_order t WHERE t.date between '" . $startDate . "' AND '" . $endDate . "' group by year(t.date),month(t.date) order by year(t.date),month(t.date) ");
    $statement = $pdo->prepare("select YEAR(t.date) AS 'YEAR',month(t.date) AS 'MONTH',COUNT(t.quantity) AS 'COUNT' , SUM(t.id) AS 'TURNS' from tbl_order t WHERE t.date between '" . $startDate . "' AND '" . $endDate . "' group by year(t.date),month(t.date) order by year(t.date),month(t.date) ");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {

        $html .= "<tr>
                                    <td>" . $row['YEAR'] . "</td>
                                    <td>" . $row['MONTH'] . "</td>
									<td>" . $row['COUNT'] . "</td>
									<td>" . $row['TURNS'] . "</td>
									
		</tr>";
    }
//$pdf->writeHTML($html, true, false, true, false, '');
    $html .= "</tbody>
</table>";
    $pdf->writeHTML($html, true, false, true, false, '');


    $pdf->Output('YearlySales2022.pdf', 'I');

} else {
    header('location: report.php');
}
