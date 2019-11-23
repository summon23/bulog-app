<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RawQuery extends CI_Model {

    public function insertOne($table, $data) {
        $CI =& get_instance();
        try {
            $CI->db->insert($table, $data);
            $insertedId = $CI->db->insert_id();
            $data['id'] = $insertedId;
            return $data;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getData($fields="",$tableName="",$where="",$order="",$group="",$limit=""){
		$CI =& get_instance();
		if ($where!="") {
			$where = " WHERE ".$where;
		}
		if ($order!="") {
			$order = " ORDER BY ".$order;
		}
		if ($group!="") {
			$group = " GROUP BY ".$group;
		}
		if ($limit!="") {
			$limit = " LIMIT ".$limit;
		}
		
		$sql = "SELECT $fields FROM $tableName $where $group $order $limit";
		return $CI->db->query($sql)->result();
	}
}