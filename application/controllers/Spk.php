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
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'tanggal_terima' => array(
                'type' => 'date',
                'fieldname' => 'Tanggal Terima',
                'columnview' => true
            ),
            'merk' => array(
                'type' => 'text',
                'fieldname' => 'Merk',
                'columnview' => true
            ),
            'tujuan' => array(
                'type' => 'text',
                'fieldname' => 'Tujuan',
                'columnview' => true
            ),
            'jumlah' => array(
                'type' => 'text',
                'fieldname' => 'Jumlah',
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