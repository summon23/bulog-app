<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Session
        $CI =& get_instance();
        if (!$CI->session->userdata('authLogin')) {
            redirect('auth', 'refresh');
        }

        // Check Access
        $listAccess = $CI->session->userdata('access');
        if (!in_array(strtoupper('REPORTBARANG'), $listAccess)) {
            // echo 'NO_ACCESS';die;
            setAlert('warning', 'Anda tidak memiliki Akses');
            redirect('home');
        }
    }

    public function barang() {
        
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Pegawai.xls");

        echo '
        <html>
        <body>        
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No.Telp</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sulaiman</td>
                    <td>Jakarta</td>
                    <td>0829121223</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Diki Alfarabi Hadi</td>
                    <td>Jakarta</td>
                    <td>08291212211</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Zakaria</td>
                    <td>Medan</td>
                    <td>0829121223</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Alvinur</td>
                    <td>Jakarta</td>
                    <td>02133324344</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Muhammad Rizani</td>
                    <td>Jakarta</td>
                    <td>08231111223</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Rizaldi Waloni</td>
                    <td>Jakarta</td>
                    <td>027373733</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Ferdian</td>
                    <td>Jakarta</td>
                    <td>0829121223</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Fatimah</td>
                    <td>Jakarta</td>
                    <td>23432423423</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Aminah</td>
                    <td>Jakarta</td>
                    <td>0829234233</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Jafarudin</td>
                    <td>Jakarta</td>
                    <td>0829239323</td>
                </tr>
            </table>
        </body>
        </html>';
    }
}
