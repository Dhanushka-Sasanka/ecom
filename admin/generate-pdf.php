<?php
//require __DIR__ . "../vendor/autoload.php";
require_once('../vendor/autoload.php');
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Set the Dompdf options
 */
$options = new Options;
$options->setIsRemoteEnabled(true);
$options->setChroot(__DIR__ );
//$options->setChroot(__DIR__ ."/assets/css/" );
$dompdf = new Dompdf($options);

/**
 * Set the paper size and orientation
 */
$dompdf->setPaper("A4", "landscape");

/**
 * Load the HTML and replace placeholders with values from the form
 */
//$html = file_get_contents("report-customer-info.php");
$html = file_get_contents("report-customer-info.php");



//$html = str_replace(["{{ name }}", "{{ quantity }}"], [$name, $quantity], $html);



$dompdf->loadHtml($html);


/**
 * Create the PDF and set attributes
 */
$dompdf->render();

$dompdf->addInfo("Title", "An Example PDF"); // "add_info" in earlier versions of Dompdf

/**
 * Send the PDF to the browser
 */
$dompdf->stream("invoice.pdf", ["Attachment" => 0]);
