<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');
class Pengolahan extends ModelController {
    protected $options = array(
        'modulename' => 'Pengolahan',
        'parentmenu' => 'Modules',
        'route' => 'pengolahan',
        'access' => 'PENGOLAHAN',
        'tablename' => 'app_pengolahan',
        'show_created_by'=> true,
        'show_created_date'=> true,  
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
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
            'tanggal_pengolahan' => array(
                'type' => 'date',
                'fieldname' => 'Tanggal',
                'columnview' => true
            ),
            'jumlah_koli' => array(
                'type' => 'text',
                'fieldname' => 'Jumlah Koli',
                'columnview' => true
            ),
            'bruto' => array(
                'type' => 'text',
                'fieldname' => 'Bruto',
                'columnview' => true
            ),
            'netto' => array(
                'type' => 'text',
                'fieldname' => 'Netto',
                'columnview' => true
            ),
            'jumlah_terpakai' => array(
                'type' => 'text',
                'fieldname' => 'Jumlah Terpakai',
                'columnview' => true
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
        $payload['tanggal_pengolahan'] = date('Y-m-d', strtotime($payload['tanggal_pengolahan']));

        return $payload;
    }
    public function beforeUpdate($payload, $model)
    {
        // Check existing
        $name = strtolower($payload['name']);
        $payload['tanggal_pengolahan'] = date('Y-m-d', strtotime($payload['tanggal_pengolahan']));

        $id = $payload['id'];
        return $payload;
    }
}