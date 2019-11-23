<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productstock extends CI_Model {

    /**
     * @param stocktype String enum warehouse, store
     * @param payload Array(product_id, qty, type)
     * @param payload Array(store_id, product_id, qty, type)
     * @return true
     */
    function updateStock($stocktype, $payload) {
        $productid = $payload['product_id'];
        $newstock = $payload['qty'];
        $type = $payload['type'] == 'in' ? 1 : 0;
        
        switch ($stocktype) {
            case 'warehouse':
                $existing = $this->db->query('SELECT id,stock from ref_warehouse_productstock where product_id='.$productid)->result_array();
                if (count($existing) > 0) {
                    if ($type == 1) {
                        $newstock = $existing[0]['stock'] + $newstock;
                    } else {
                        $newstock = $existing[0]['stock'] - $newstock;
                    }            
                    $this->db->query("UPDATE ref_warehouse_productstock set stock = $newstock where product_id=$productid");
                } else {
                    $this->db->query("INSERT into ref_warehouse_productstock (product_id, stock) values ($productid, $newstock)");
                }

                return true;
                break;
            case 'store':
                $storeid = $payload['store_id'];
                $existing = $this->db->query('SELECT id,stock from ref_store_productstock where product_id='.$productid.' and store_id='.$storeid)->result_array();
                if (count($existing) > 0) {
                    if ($type == 1) {
                        $newstock = $existing[0]['stock'] + $newstock;
                    } else {
                        $newstock = $existing[0]['stock'] - $newstock;
                    }
                    $refId = $existing[0]['id'];
                    // echo "UPDATE ref_store_productstock set stock = $newstock where id=$refId";
                    $this->db->query("UPDATE ref_store_productstock set stock = $newstock where id=$refId");
                } else {
                    // echo "1";
                    $this->db->query("INSERT into ref_store_productstock (store_id, product_id, stock) values ($storeid, $productid, $newstock)");
                }
                return true;
                break;            
            default:
                echo 'Wrong Type';die;
                break;
        }                
    }

    /**
     * @param payload Array(product_id, warehouse_id, qty, type)
     * @return true
     */
    function updateStockSec($payload) {
        $productid = $payload['product_id'];
        $newstock = $payload['qty'];
        $warehouseId = $payload['warehouse_id'];
        $type = $payload['type'] == 'in' ? 1 : 0;

        $existing = $this->db->query('SELECT id,stock from ref_warehouse_sec_productstock where product_id='.$productid.' AND warehouse_id='.$warehouseId)->result_array();
        if (count($existing) > 0) {
            if ($type == 1) {
                $newstock = $existing[0]['stock'] + $newstock;
            } else {
                $newstock = $existing[0]['stock'] - $newstock;
            }            
            $this->db->query("UPDATE ref_warehouse_sec_productstock set stock = $newstock 
            where product_id=$productid AND warehouse_id=$warehouseId");
        } else {
            $this->db->query("INSERT into ref_warehouse_sec_productstock (product_id,warehouse_id, stock) values ($productid, $warehouseId, $newstock)");
        }

        return true;
    }

    function countLastStock($stocktype, $storeid, $type, $qty, $productid) {
        if ($stocktype == 'store') {
            $laststock = $this->db->query('SELECT * from ref_store_productstock WHERE store_id="'.$storeid.'" AND product_id="'.$productid.'"')->row();
            if (empty($laststock)) return $qty;

            if ($type == 'in') return $laststock->stock + $qty;
            if ($type == 'out') return $laststock->stock - $qty;
        }
    }
}
