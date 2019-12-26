<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';
class Excel {
    /**
     * @return PHPExcel Object
     */
    public function getContext()
    {
        return new PHPExcel;
    }

    /**
     * @param excel PHPExcel Object
     * @param options array
     */
    public function writeExcel($excel, $options = array())
    {
        $filename=$options['filename']; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
    }

    public function writeExcelFromHTML($excel, $htmlDocument = '')
    {
        $objPHPExcelReader = PHPExcel_IOFactory::createReader('HTML');
        $objPHPExcel = $objPHPExcelReader->load($htmlDocument);
        
        $objPHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objPHPExcelWriter->save('php://output');
    }
}
