<?php
require 'pdfcrowd.php';

try
{   
    // create an API client instance
    $client = new Pdfcrowd("alecerosiete", "418b420fb84616b8a5bfbf4256703c42");

    // convert a web page and store the generated PDF into a $pdf variable
    $pdf = $client->convertURI('http://localhost/portal2/estados-de-cuenta.php');

    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"estado-de-cuenta.pdf\"");

    // send the generated PDF 
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>