<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');
class Penerimaan extends ModelController {
    protected $options = array(
        'modulename' => 'Penerimaan',
        'parentmenu' => 'Modules',
        'route' => 'penerimaan',
        'access' => 'PENERIMAAN',
        'tablename' => 'app_penerimaan',
        'show_created_by'=> true,
        'show_created_date'=> true,
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'no_penerimaan' => array(
                'type' => 'text',
                'fieldname' => 'No Penerimaan',
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
            'tanggal_terima' => array(
                'type' => 'date',
                'fieldname' => 'Tanggal Terima',
                'columnview' => true
            ),
            'tanggal_terima_spk' => array(
                'type' => 'date',
                'fieldname' => 'Tanggal Terima SPK'
            ),
            'komoditas_id' => array(
                'type' => 'dropdown',
                'fieldname' => 'Komoditas',
                'columnview' => true,
                'reference' => array(
                    'table_name' => 'master_komoditi',
                    'foreign_key' => 'komoditas_id',
                    'alias' => 'komoditi_name'
                )
            ),           
            'jumlah' => array(
                'type' => 'text',
                'fieldname' => 'Jumlah'
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
            'gudang_asal' => array(
                'type' => 'text',
                'fieldname' => 'Gudang Asal'
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
        $payload['tanggal_terima'] = date('Y-m-d', strtotime($payload['tanggal_terima']));
        $payload['tanggal_terima_spk'] = date('Y-m-d', strtotime($payload['tanggal_terima_spk']));

        return $payload;
    }
    public function beforeUpdate($payload, $model)
    {
        // Check existing
        $name = strtolower($payload['name']);
        $payload['tanggal_terima'] = date('Y-m-d', strtotime($payload['tanggal_terima']));
        $payload['tanggal_terima_spk'] = date('Y-m-d', strtotime($payload['tanggal_terima_spk']));

        $id = $payload['id'];
        return $payload;
    }
}