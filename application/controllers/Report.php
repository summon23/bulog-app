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

        $totalSpk = $this->db->query('SELECT app_spk.*, m.name as merk_name FROM app_spk 
        JOIN master_merk m ON m.id = app_spk.merk_id
        WHERE DATE(app_spk.created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();     

        $totalPenerimaan = $this->db->query('SELECT app_penerimaan.*, mk.name as komoditas_name, mkm.name as kemasan_name
            FROM app_penerimaan      
            JOIN master_komoditi mk ON mk.id = app_penerimaan.komoditas_id       
            JOIN master_kemasan mkm ON mkm.id = app_penerimaan.kemasan_id
            WHERE DATE(app_penerimaan.created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();

        
        $totalPengiriman = $this->db->query('SELECT app_pengiriman.*
            FROM app_pengiriman
            WHERE DATE(app_pengiriman.created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();


        $totalPengolahan = $this->db->query('SELECT * 
            FROM app_pengolahan 
            WHERE DATE(created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();
            
        
        $countTotalPenerimaan = count($totalPenerimaan);
        $countTotalPengiriman = count($totalPengiriman);
        $countTotalPengolahan = count($totalPengolahan);
        $countTotalSpk = count($totalSpk);

        // debug($totalSpk);
        
        $contentTable = '';

        $i = 0;
        while ($i < $countTotalPenerimaan 
            && $i < $countTotalPengiriman 
            && $i < $countTotalPengolahan
            && $i < $countTotalSpk
        ) {
            $contentTable .= '<tr>';

            // spk
            if (isset($totalSpk[$i])) {
                $contentTable .= "
                    <td>".$totalSpk[$i]->no_spk."</td>
                    <td>".$totalSpk[$i]->tanggal_terima."</td>
                    <td>".$totalSpk[$i]->merk_name."</td>
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
                    <td>".$totalPenerimaan[$i]->komoditas_name."</td>
                    <td> - </td>
                    <td>".$totalPenerimaan[$i]->kemasan_name."</td>
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
                ";
            }

            // pengolahan
            if (isset($totalPengolahan[$i])) {
                $contentTable .= "
                    <td>".$totalPengolahan[$i]->tanggal_pengolahan."</td>
                    <td>".$totalPengolahan[$i]->kuantum_hasil_kemasan."</td>
                    <td>".$totalPengolahan[$i]->jumlah_kemasan_terpakai."</td>
                ";
            } else {
                $contentTable .= "
                    <td></td>
                    <td></td>
                    <td></td>
                ";
            }
            
            // pengiriman
            if (isset($totalPengiriman[$i])) {
                $contentTable .= "                    
                    <td>".$totalPengiriman[$i]->tanggal_penyerahan."</td>
                    <td>".$totalPengiriman[$i]->no_penyerahan."</td>
                    <td>".$totalPengiriman[$i]->kuantum."</td>
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
                ";
            }

            $contentTable .= '</tr>';

            $i++;
        }
        
        $html = '<html>
        <head>
        <meta charset="utf-8">
        </head>
        <table border="1">
            <tr>
                <th colspan="5">SPK</th>
                <th colspan="6">PENERIMAAN KOMODITAS</th>
                <th colspan="3">PENGOLAHAN</th>
                <th colspan="5">PENYERAHAN</th>
            </tr>
            <tr>
                <th>NO SPK</th>
                <th>TGL TERIMA SPK</th>
                <th>MERK</th>
                <th>TUJUAN</th>
                <th>JUMLAH (KG)</th>
                
                <th>NO PENERIMAAN</th>
                <th>TGL TERIMA KOMODITAS</th>
                <th>KOMODITAS</th>
                <th>KUALITAS</th>
                <th>KUANTUM</th>
                <th>PENGIRIM</th>

                <th>TGL PENGOLAHAN</th>
                <th>KUANTUM</th>
                <th>JUMLAH KEMASAN TERPAKAI</th>

                <th>TGL PENYERAHAN</th>
                <th>NO PENYERAHAN</th>
                <th>KUANTUM</th>
                <th>PENERIMA</th>
                <th>KETERANGAN</th>
            </tr>
            '.$contentTable.'
        </table></html>';
        
        // Start Generete Excel File
        header("Content-type: application/excel");
        header("Content-Disposition: attachment; filename=REPORTSYSTEM.xls");
        echo $html;

        // die;

        // $excel = $this->excel->getContext();

		// $excel->setActiveSheetIndex(0);
        // $excel->getActiveSheet()->setTitle('Report System');

        return true;
        
    }
    

    public function generateBarangBackup() {
        $startDate = $this->input->post('startdate');
        $endDate = $this->input->post('enddate');

        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));

        $totalSpk = $this->db->query('SELECT * FROM app_spk WHERE DATE(created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();         
        $totalPenerimaan = $this->db->query('SELECT app_penerimaan.*, m.name as komoditas_name, mm.name as kemasan_name
            FROM app_penerimaan 
            JOIN master_komoditi m ON m.id = app_penerimaan.komoditas_id
            JOIN master_kemasan mm ON mm.id = app_penerimaan.kemasan_id
            WHERE DATE(app_penerimaan.created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();

        
		$totalPengiriman = $this->db->query('SELECT app_pengiriman.*, m.name as kemasan_name
            FROM app_pengiriman             
            JOIN master_kemasan m ON m.id = app_pengiriman.kemasan_id
            WHERE DATE(app_pengiriman.created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();


		$totalPengolahan = $this->db->query('SELECT * 
            FROM app_pengolahan 
            WHERE DATE(created_date) BETWEEN "'.$startDate.'" AND "'.$endDate.'" ')->result();
            
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
                    <td>".$totalPenerimaan[$i]->komoditas_name."</td>
                    <td>".$totalPenerimaan[$i]->kualitas."</td>
                    <td>".$totalPenerimaan[$i]->kemasan_name."</td>
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
                    <td>".$totalPengiriman[$i]->kemasan_name."</td>
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
