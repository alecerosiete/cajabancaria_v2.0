<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */



function conect()
{
    try {
        $db = new PDO("mysql:host=localhost;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
        return($db);
    } catch (PDOException $e) {
        print "<p>Error: No puede conectarse con la base de datos.</p>\n";
        die();
    }
}


    // get the HTML
    ob_start();
    include(dirname(__FILE__).'/res/session.php');
    
    assertUser();
    $user = getUser();
    
    
    
    include(dirname(__FILE__).'/res/sql-functions.php');
    
    
    
    include(dirname(__FILE__).'/res/aportes_page_pdf.php');
    
    $content = ob_get_clean();

    
    
    
    
    // convert to PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
//      $html2pdf->pdf->SetProtection(array('print'), 'spipu');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('aportes.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
