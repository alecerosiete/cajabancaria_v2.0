<?php  
    require('html2fpdf.php');
    $pdf=new HTML2FPDF();
    $pdf->AddPage();
    $fp = fopen("test.html","r");
    $strContent = fread($fp, filesize("test.html"));
    fclose($fp);
    $pdf->WriteHTML($strContent);
    //$pdf->Output("sample.pdf");
    //echo "PDF file is generated successfully!";
    $pdf->Output();
?>  