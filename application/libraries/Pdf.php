<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';
use Dompdf\Dompdf;
class Pdf {
    /**
     * @return DOMPdf Object
     */
    public function getContext()
    {
        return new Dompdf();
    }
}