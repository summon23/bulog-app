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
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
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