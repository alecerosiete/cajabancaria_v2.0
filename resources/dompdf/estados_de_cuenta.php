<?php

require_once("dompdf_config.inc.php");


$dompdf = new DOMPDF();
$dompdf->load_html_file('http://localhost/estados-de-cuenta.php');
$dompdf->render();
$dompdf->stream("sample.pdf");

?>
