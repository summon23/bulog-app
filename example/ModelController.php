<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');

class Company extends ModelController {

    protected $options = array(
        'modulename' => 'Company (String - shown in page)',
        'route' => 'company (String - will be route url)',
        'tablename' => 'app_company (String - represent table name)',       
        'modelfield' => array(
            'id (String - represent field name in database)' => array(
                'type' => 'hidden (String - Field Type)',
                'fieldname' => 'ID (String - will show in form / table field)'
            )
        )
    );

    public function __construct() 
    {        
        parent::__construct($this->options);
    }    
}