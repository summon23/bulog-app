<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');

class Group extends ModelController {

    protected $options = array(
        'modulename' => 'Group',
        'parentmenu' => 'Setting',
        'route' => 'group',
        'access' => 'GROUP',
        'tablename' => 'sys_user_group',
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'fieldname' => 'ID'
            ),
            'group_name' => array(
                'type' => 'text',
                'fieldname' => 'User',
                'columnview' => 'true'
            )
        ),
        'view' => array(
            'view' => 'group/view'
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
         $ex = $this->db->query('SELECT id from '.$model['tablename'].' where lower(group_name) ="'.$name.'"')->result();
         if ($ex) {
             throw new Exception('Duplicate '.$model['modulename'].' Name');
         }
         return $payload;
    }

    public function beforeUpdate($payload, $model)
    {
        // Check existing
        $name = strtolower($payload['name']);
        $ex = $this->db->query('SELECT id from '.$model['tablename'].' where lower(group_name) ="'.$name.'"')->result();
        if ($ex) {
            throw new Exception('Duplicate '.$model['modulename'].' Name');
        }
        return $payload;
    }

    public function assign($id)
    {
        $dataGroup = $this->db->query('SELECT * from sys_user_group where id='.$id)->result_array();
        $dataGroup = array_shift($dataGroup);

        $access = $this->db->query('SELECT s.*, m.menu_name from sys_submenu s join sys_menu m on m.id = s.id_menu order by s.id_menu,s.submenu_name ASC')->result();
        $accessGrand = $this->db->query('SELECT * from sys_group_priviledge where user_group_id='.$id)->result();
        $params['modeloptions'] = $this->modelOptions;
        $params['data'] = $dataGroup;

        // debug($access);
        $params['accessrole'] = $access;
        $params['accessgrand'] = $accessGrand;
        $params['groupid'] = $id;
        $params['activemenu'] = 'Group';
        $params['parentmenu'] = 'Setting';
        $params['breadcrumb'] = array(
            'Group' => base_url().'group',
            'Assign Role' => ''
        );
        $this->view->genView('group/assign', $params);
    }

    public function assignsave()
    {
        $p = $this->input->post();
        $groupId = $p['groupid'];
        $privi = $p['pv'];

        // Delete all privi
        $this->db->query('DELETE from sys_group_priviledge where user_group_id='.$groupId);

        // Loop and Insert
        foreach ($privi as $key => $value) {
            $submenuId = $key;
            foreach ($value as $k => $v) {
                switch ($k) {
                    case 'read':
                        $accessId = 1;
                        break;
                    case 'write':
                        $accessId = 2;
                        break;
                    case 'delete':
                        $accessId = 4;
                        break;
                }
                $record = array(
                    'user_group_id' => $groupId,
                    'menu_id' => null,
                    'submenu_id' => $key,
                    'access_grant' => $accessId,
                    'created_by' => getUserId()
                );
                $this->db->insert('sys_group_priviledge', $record);
            }
        }

        setAlert('success', 'Group Role Updated');
        redirect('group/view');
    }
}