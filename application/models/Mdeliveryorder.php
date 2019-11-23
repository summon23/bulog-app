<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdeliveryorder extends CI_Model {

    /**
     * table app_do
     * type:
     * 1: Warehouse to Store
     * 2: Store to Store
     * 3: Warehouse to Warehouse
     * 4: Supplier to Warehouse
     * 5: Logistic to Store (Order Custom)
     * 6: Supplier to Logistic (Order Custom)
     * 7: Store to Warehouse
    */

    // Example
    // array(
    //     'donumber' => '',
    //     'type' => '',
    //     'notes' => '',
    //     'supplier_id' => '',
    //     'from_store_id' => '',
    //     'to_store_id' => '',
    //     'from_warehouse_id' => '',
    //     'to_warehouse_id' => '',
    //     'status' => '',
    //     'items' => ''
    // );

    /**
     * @param payload donumber String
     * @param payload type Int
     * @param payload notes String
     * @param payload supplier_id Int
     * @param payload from_store_id Int
     * @param payload to_store_id Int
     * @param payload from_warehouse_id Int
     * @param payload to_warehouse_id Int
     * @param payload return_store_id Int
     * @param payload status Int
     * @param payload items Array
     * @param payload returnnumber String
     * @return true
     */
    function createDO($payload) {
        if (!isset($payload['donumber'])) {
            $payload['donumber'] = $doNumber = $this->appgenerator->getDONumber();
        } else {
            $doNumber = $payload['donumber'];
        }
        extract($payload);
        $totalItems = 0;
        foreach ($items as $key => $value) { 
            $totalItems = $totalItems + $value['qty'];
        }
        
        $recDO = array(
            'do_number' => $doNumber,
            'return_number' => isset($returnnumber) ? $returnnumber : null,
            'qty' => $totalItems,
            'notes' => isset($notes) ? $notes : null,
            'type' => $type,
            'supplier_id' => isset($supplier_id) ? $supplier_id : null,
            'from_store_id' => isset($from_store_id) ? $from_store_id : null,
            'to_store_id' => isset($to_store_id) ? $to_store_id : null,
            'from_warehouse_id' => isset($from_warehouse_id) ? $from_warehouse_id : null,
            'to_warehouse_id' => isset($to_warehouse_id) ? $to_warehouse_id : null,
            'return_store_id' => isset($return_store_id) ? $return_store_id : null,
            'status' => $status,
            'created_by' => getUserId()
        );
        $this->db->insert('app_do', $recDO);

        $doItems = [];
        foreach ($items as $key => $value) {
            array_push($doItems, array(
                'do_number' => $doNumber,
                'product_id' => $value['productid'],
                'job_order_number' => isset($value['job_order_number']) ? $value['job_order_number'] : null,
                'qty' => $value['qty'],
                'qty_received' => isset($value['qty_received']) ? $value['qty_received'] : 0
            ));
        }

        $this->db->insert_batch('app_do_detail', $doItems);
        return $doNumber;
    }

}