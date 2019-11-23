<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');

class User extends ModelController {

    protected $options = array(
        'modulename' => 'User',
        'parentmenu' => 'Setting',
        'route' => 'user',
        'access' => 'USER',
        'tablename' => 'sys_user',
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'name' => array(
                'type' => 'text',
                'columnview' => true,
                'fieldname' => 'User'
            ),
            'password' => array(
                'type' => 'password',
                'fieldname' => 'Password'
            ),
            'email' => array(
                'type' => 'email',
                'columnview' => true,
                'fieldname' => 'Email Address'
            ),
            'user_group_id' => array(
                'type' => 'dropdown',
                'fieldname' => 'User Group',
                'reference' => array(
                    'table_name' => 'sys_user_group',
                    'foreign_key' => 'user_group_id',
                    'source_key' => 'group_name',
                    'alias' => 'group_name'
                ),
                'columnview' => true
            ),
        )
    );

    public function __construct() 
    {        
        parent::__construct($this->options);
    }

    public function beforeSave($payload, $model)
    {
        // Validation for email and name duplicate
        $payload['password'] = md5($payload['password']);
        return $payload;
    }

    public function beforeUpdate($payload, $model)
    {
        // Validation for email and name duplicate
        if ($payload['password'] == '') {
            unset($payload['password']);
        } else {        
            $payload['password'] = md5($payload['password']);
        }
        return $payload;
    }

}