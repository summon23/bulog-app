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
            setAlert('warning', 'Anda tidak memiliki Akses');
            redirect('home');
        }
    }

    public function barang() {
        $params['breadcrumb'] = array(
            'Report' => base_url('report')
        );
        $this->view->genView('report/barang', $params);
    }

    public function generateBarang() {
        $startDate = $this->input->post('startdate');
        $endDate = $this->input->post('enddate');

        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));

        $totalSpk = $this->db->query('SELECT * FROM app_spk WHERE DATE(created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();
        $totalPenerimaan = $this->db->query('SELECT * FROM app_penerimaan WHERE DATE(created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();
		$totalPengiriman = $this->db->query('SELECT * FROM app_pengiriman WHERE DATE(created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();
		$totalPengolahan = $this->db->query('SELECT * FROM app_pengolahan WHERE DATE(created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();
            
        // Start Generete Excel File
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=REPORTSYSTEM.xls");

        $countTotalPenerimaan = count($totalPenerimaan);
        $countTotalPengiriman = count($totalPengiriman);
        $countTotalPengolahan = count($totalPengolahan);
        $countTotalSpk = count($totalSpk);
        
        $contentTable = '';

        $i = 0;
        while ($i <= $countTotalPenerimaan 
            && $i <= $countTotalPengiriman 
            && $i <= $countTotalPengolahan
            && $i <= $countTotalSpk
        ) {
            $contentTable .= '<tr>';

            // spk
            if (isset($totalSpk[$i])) {
                $contentTable .= "
                    <td>".$totalSpk[$i]->no_spk."</td>
                    <td>".$totalSpk[$i]->tanggal_terima."</td>
                    <td>".$totalSpk[$i]->merk."</td>
                    <td>".$totalSpk[$i]->tujuan."</td>
                    <td>".$totalSpk[$i]->jumlah."</td>
                ";
            } else {
                $contentTable .= "
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            ";
            }

            // penerimaan
            if (isset($totalPenerimaan[$i])) {
                $contentTable .= "
                    <td>".$totalPenerimaan[$i]->no_penerimaan."</td>
                    <td>".$totalPenerimaan[$i]->tanggal_terima."</td>
                    <td>".$totalPenerimaan[$i]->komoditas_id."</td>
                    <td>".$totalPenerimaan[$i]->kualitas."</td>
                    <td>".$totalPenerimaan[$i]->kemasan_id."</td>
                    <td>".$totalPenerimaan[$i]->koli."</td>
                    <td>".$totalPenerimaan[$i]->bruto."</td>
                    <td>".$totalPenerimaan[$i]->netto."</td>
                    <td>".$totalPenerimaan[$i]->pengirim."</td>
                ";
            } else {
                $contentTable .= "
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                ";
            }

            // pengolahan
            if (isset($totalPengolahan[$i])) {
                $contentTable .= "
                    <td>".$totalPengolahan[$i]->tanggal_pengolahan."</td>
                    <td>".$totalPengolahan[$i]->jumlah_koli."</td>
                    <td>".$totalPengolahan[$i]->bruto."</td>
                    <td>".$totalPengolahan[$i]->netto."</td>
                    <td>".$totalPengolahan[$i]->jumlah_terpakai."</td>
                ";
            } else {
                $contentTable .= "
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                ";
            }
            
            // pengiriman
            if (isset($totalPengiriman[$i])) {
                $contentTable .= "
                    <td>".$totalPengiriman[$i]->no_penyerahan."</td>
                    <td>".$totalPengiriman[$i]->tanggal_penyerahan."</td>
                    <td>".$totalPengiriman[$i]->kemasan_id."</td>
                    <td>".$totalPengiriman[$i]->koli."</td>
                    <td>".$totalPengiriman[$i]->bruto."</td>
                    <td>".$totalPengiriman[$i]->netto."</td>
                    <td>".$totalPengiriman[$i]->penerima."</td>
                    <td>".$totalPengiriman[$i]->keterangan."</td>
                ";
            } else {
                $contentTable .= "
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                ";
            }

            $contentTable .= '</tr>';

            $i++;
        }
        
        echo '
        <html>
        <body>        
            <table border="1">
                <thead>
                    <tr>
                        <th colspan="5">SPK</th>
                        <th colspan="9">PENERIMAAN KOMODITAS</th>
                        <th colspan="5">PENGOLAHAN</th>
                        <th colspan="8">PENYERAHAN</th>
                    </tr>

                    <tr>
                        <th rowspan="2">NO SPK</th>
                        <th rowspan="2">TGL TERIMA SPK</th>
                        <th rowspan="2">MERK</th>
                        <th rowspan="2">TUJUAN</th>
                        <th rowspan="2">JUMLAH (KG)</th>
                        <th rowspan="2">NO PENERIMAAN</th>
                        <th rowspan="2">TGL TERIMA KOMODITAS</th>
                        <th rowspan="2">KOMODITAS</th>
                        <th rowspan="2">KUALITAS</th>
                        <th colspan="4">KUANTUM</th>
                        <th rowspan="2">PENGIRIM</th>
                        <th rowspan="2">TGL PENGOLAHAN</th>
                        <th colspan="3">KUANTUM</th>
                        <th rowspan="2">JUMLAH KEMASAN TERPAKAI</th>
                        <th rowspan="2">TGL PENYERAHAN</th>
                        <th rowspan="2">NO PENYERAHAN</th>
                        <th colspan="4">KUANTUM</th>
                        <th rowspan="2">PENERIMA</th>
                        <th rowspan="2">KETERANGAN</th>
                    </tr>

                    <tr>
                        <th>KEMASAN</th>
                        <th>KOLI</th>
                        <th>BRUTO</th>
                        <th>NETTO</th>
                        <th>JML KOLI</th>
                        <th>BRUTO</th>
                        <th>NETTO</th>
                        <th>KEMASAN</th>
                        <th>KOLI</th>
                        <th>BRUTO</th>
                        <th>NETTO</th>
                    </tr>
                </thead>
                <tbody>
                '.$contentTable.'
                </tbody>                    
            </table>
        </body>
        </html>';
        
        return true;
    }
}
