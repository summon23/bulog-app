<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appgenerator {

    public function getPropormaNumber() {
		$CI =& get_instance();
        $prefix = 'PROP';        
		$seqNumber = $CI->db->query('SELECT id from seq_proporma')->result();
		$CI->db->query('UPDATE seq_proporma set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getPaymentNumber() {
		$CI =& get_instance();
        $prefix = 'PAY';
		$seqNumber = $CI->db->query('SELECT id from seq_payment')->result();
		$CI->db->query('UPDATE seq_payment set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getInvoiceNumber() {
		$CI =& get_instance();
        $prefix = 'INV';        
		$seqNumber = $CI->db->query('SELECT id from seq_invoice')->result();
		$CI->db->query('UPDATE seq_invoice set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getReturnNumber() {
		$CI =& get_instance();
        $prefix = 'RTN';        
		$seqNumber = $CI->db->query('SELECT id from seq_return')->result();
		$CI->db->query('UPDATE seq_return set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getDONumber() {
        $CI =& get_instance();
        $prefix = 'DO';        
		$seqNumber = $CI->db->query('SELECT id from seq_do')->result();
		$CI->db->query('UPDATE seq_do set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getPONumber() {
        $CI =& get_instance();
        $prefix = 'PO';        
		$seqNumber = $CI->db->query('SELECT id from seq_po')->result();
		$CI->db->query('UPDATE seq_po set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getGRNumber() {
        $CI =& get_instance();
        $prefix = 'GR';        
		$seqNumber = $CI->db->query('SELECT id from seq_gr')->result();
		$CI->db->query('UPDATE seq_gr set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getOrderNumber() {
        $CI =& get_instance();
        $prefix = 'TR';        
		$seqNumber = $CI->db->query('SELECT id from seq_order')->result();
		$CI->db->query('UPDATE seq_order set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getDOGroupNumber() {
        $CI =& get_instance();
        $prefix = 'DG';        
		$seqNumber = $CI->db->query('SELECT id from seq_do_group')->result();
		$CI->db->query('UPDATE seq_do_group set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }

    public function getJobNumber() {
        $CI =& get_instance();
        $prefix = 'OJB';        
		$seqNumber = $CI->db->query('SELECT id from seq_job')->result();
		$CI->db->query('UPDATE seq_job set id = id + 1');
        
        return $prefix."-".sprintf('%05d', $seqNumber[0]->id);
    }
}
