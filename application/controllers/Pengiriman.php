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
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'no_penyerahan' => array(
                'type' => 'text',
                'fieldname' => 'No Penyerahan',
                'columnview' => true
            ),
            'tanggal_penyerahan' => array(
                'type' => 'date',
                'fieldname' => 'Tanggal Penyerahan',
                'columnview' => true
            ),
            'kemasan_id' => array(
                'type' => 'dropdown',
                'fieldname' => 'Kemasan',
                'columnview' => true,
                'reference' => array(
                    'table_name' => 'master_kemasan',
                    'foreign_key' => 'kemasan_id',
                    'alias' => 'kemasan_name'
                )
            ),
            'koli' => array(
                'type' => 'text',
                'fieldname' => 'Koli'
            ),
            'bruto' => array(
                'type' => 'text',
                'fieldname' => 'Bruto'
            ),
            'netto' => array(
                'type' => 'text',
                'fieldname' => 'Netto'
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