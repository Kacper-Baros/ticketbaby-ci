<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pdf_create($html, $filename, $stream = TRUE){
    $CI =& get_instance();
	require_once(APPPATH . 'helpers/mpdf/mpdf.php');
    $mpdf = new mPDF();
    $mpdf->SetAutoFont();
	//$stylesheet = file_get_contents('style.css');
	//$mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($html);
    if ($stream){
        $mpdf->Output($filename . '.pdf', 'D');
    }
    else{
        $mpdf->Output(APPPATH . './eticketuploads/' . $filename . '.pdf', 'F');
        
        return APPPATH . './eticketuploads/' . $filename . '.pdf';
    }
}

function barCode($code){
	require_once(APPPATH . 'helpers/picqer/BarcodeGenerator.php');
	require_once(APPPATH . 'helpers/picqer/BarcodeGeneratorPNG.php');
	require_once(APPPATH . 'helpers/picqer/BarcodeGeneratorSVG.php');
	require_once(APPPATH . 'helpers/picqer/BarcodeGeneratorJPG.php');
	require_once(APPPATH . 'helpers/picqer/BarcodeGeneratorHTML.php');

	$generatorHTML = new Picqer\Barcode\BarcodeGeneratorPNG();
	return '<img src="data:image/png;base64,'. base64_encode($generatorHTML->getBarcode($code, $generatorHTML::TYPE_CODE_128)). '">';
}
?>