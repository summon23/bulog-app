<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    // public $dashboardController = '/home';

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $dashboardController = '/home';
        if ($this->session->userdata('authLogin')) {
            redirect($dashboardController, 'refresh');
        } else {
            return $this->view->genView('default/login', array(), true);
        }
    }
    
    public function doAuth()
    {
        $userdata = $this->input->post(NULL);
        $dashboardController = '/home';
        
        // form validation
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[2]');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('warning', 'Username not Valid');
            redirect('/auth', 'refresh');
        }
        
        // get data
        $getUserData = $this->db->where('name', $userdata['username'])
                                ->where('password', md5($userdata['password']))
                                ->get('sys_user')
                                ->result();  

        // debug($getUserData);
             
        if (empty($getUserData)) {
            $this->session->set_flashdata('warning', 'Username or Password Wrong');
            return redirect('/auth', 'refresh');
        }

        if ($getUserData[0]->status === 0) {
            $this->session->set_flashdata('warning', 'User not Active');
            return redirect('/auth', 'refresh');
        }

        $userId = $getUserData[0]->id;

        // Get Access
        $accessQuery = "SELECT sgp.id, ss.access FROM
        sys_group_priviledge sgp
        JOIN sys_submenu ss ON sgp.submenu_id = ss.id
        WHERE sgp.user_group_id = ".$getUserData[0]->user_group_id;
        $getAccess = $this->db->query($accessQuery)->result();

        // debug($getAccess);
        $listAccess = array();
        foreach ($getAccess as $key => $value) {
            $listAccess[] = $value->access;
        }

        if (count($getUserData)) {
            $groupId = $getUserData[0]->user_group_id;
            $group = $this->db->query('SELECT u.*
            from sys_user_group u            
            where u.id='.$groupId)->result_array();
            $group = array_shift($group);
            $group_name = strtolower($group['group_name']);
            $userSession = array(
                'id' => $getUserData[0]->id,
                'username' => $getUserData[0]->name,
                'group' => $groupId,
                'groupname' => $group_name,
                'authLogin' => true,
                'access' => $listAccess
            );
            $this->session->set_userdata($userSession);
            return redirect($dashboardController);
        }
    }

    public function doLogout()
    {
        $this->session->sess_destroy();
        return redirect('/auth');
    }
    
}
