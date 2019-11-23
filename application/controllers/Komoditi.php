<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');
class Komoditi extends ModelController {
    protected $options = array(
        'modulename' => 'Komoditi',
        'parentmenu' => 'Parameters',
        'route' => 'komoditi',
        'access' => 'KOMODITI',
        'tablename' => 'master_komoditi',       
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'name' => array(
                'type' => 'text',
                'fieldname' => 'Nama Komoditi',
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
        $ex = $this->db->query('SELECT id from '.$model['tablename'].' where lower(name) ="'.$name.'"')->result();
        if ($ex) {
            throw new Exception('Duplicate '.$model['modulename'].' Name');
        }
        return $payload;
    }
    public function beforeUpdate($payload, $model)
    {
        // Check existing
        $name = strtolower($payload['name']);
        $id = $payload['id'];
        $ex = $this->db->query('SELECT id from '.$model['tablename'].' where id != '.$id.' and lower(name) ="'.$name.'"')->result();
        if ($ex) {
            throw new Exception('Duplicate '.$model['modulename'].' Name');
        }
        return $payload;
    }
}