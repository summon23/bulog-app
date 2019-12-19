<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');
class Spk extends ModelController {
    protected $options = array(
        'modulename' => 'Spk',
        'parentmenu' => 'Modules',
        'route' => 'spk',
        'access' => 'SPK',
        'tablename' => 'app_spk',
        'show_created_by'=> true,
        'show_created_date'=> true,
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'no_spk' => array(
                'type' => 'text',
                'fieldname' => 'No Spk',
                'columnview' => true
            ),
            'tanggal_terima' => array(
                'type' => 'date',
                'fieldname' => 'Tanggal Terima',
                'columnview' => true
            ),
            'merk_id' => array(
                'type' => 'dropdown',
                'fieldname' => 'Merk',
                'columnview' => true,
                'reference' => array(
                    'table_name' => 'master_merk',
                    'foreign_key' => 'merk_id',
                    'alias' => 'merk_name'
                )
            ),
            'tujuan' => array(
                'type' => 'text',
                'fieldname' => 'Tujuan',
                'columnview' => true
            ),
            'jumlah' => array(
                'type' => 'text',
                'fieldname' => 'Kuantum',
                'columnview' => true
            ),
            'note' => array(
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
        $payload['tanggal_terima'] = date('Y-m-d', strtotime($payload['tanggal_terima']));

        return $payload;
    }
    public function beforeUpdate($payload, $model)
    {
        // Check existing
        $name = strtolower($payload['name']);
        $payload['tanggal_terima'] = date('Y-m-d', strtotime($payload['tanggal_terima']));

        $id = $payload['id'];
        return $payload;
    }
}