<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');
class Pengiriman extends ModelController {
    protected $options = array(
        'modulename' => 'Pengiriman',
        'parentmenu' => 'Modules',
        'route' => 'pengiriman',
        'access' => 'PENGIRIMAN',
        'tablename' => 'app_pengiriman',
        'show_created_by'=> true,
        'show_created_date'=> true,
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'no_penyerahan' => array(
                'type' => 'text',
                'fieldname' => 'No DO',
                'columnview' => true
            ),
            'spk_id' => array(
                'type' => 'dropdown',
                'fieldname' => 'No SPK',
                'columnview' => true,
                'reference' => array(
                    'table_name' => 'app_spk',
                    'foreign_key' => 'spk_id',
                    'alias' => 'spk_no',
                    'source_key' => 'no_spk'
                )
            ),
            'tanggal_penyerahan' => array(
                'type' => 'date',
                'fieldname' => 'Tanggal Penyerahan',
                'columnview' => true
            ),
            'kuantum' => array(
                'type' => 'text',
                'fieldname' => 'Kuantum'
            ),
            'jumlah_kemasan' => array(
                'type' => 'text',
                'fieldname' => 'Jumlah Kemasan'
            ),
            'penerima' => array(
                'type' => 'text',
                'fieldname' => 'Penerima',
                'columnview' => true
            ),
            'keterangan' => array(
                'type' => 'textarea',
                'fieldname' => 'Keterangan'
            )

        )
    );
    public function __construct() 
    {
        parent::__construct($this->options);
    }
    public function beforeSave($payload, $model)
    {
        // Check existing
        $name = strtolower($payload['name']);
        $payload['tanggal_penyerahan'] = date('Y-m-d', strtotime($payload['tanggal_penyerahan']));

        return $payload;
    }
    public function beforeUpdate($payload, $model)
    {
        // Check existing
        $name = strtolower($payload['name']);
        $payload['tanggal_penyerahan'] = date('Y-m-d', strtotime($payload['tanggal_penyerahan']));

        $id = $payload['id'];
        return $payload;
    }
}