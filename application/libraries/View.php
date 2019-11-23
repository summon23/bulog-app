<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View {
	public function genView($view = '', $params = array(), $singlePage = false)
	{
		$CI =& get_instance();
		if ($singlePage) {
			return $CI->load->view('themes/'.THEME.'/'.$view, $params);
		} else {
			$menu = self::getMenu();
			// debug($params);
			$data['activemenu'] = array_key_exists('activemenu', $params) ? $params['activemenu'] : 'Dashboard';
			$data['viewname'] = $view;
			$data['params'] = $params;
			$data['menu'] = $menu;
			$data['accesssubmenu'] = self::getSubmenuAccess();
			$data['accessmenu'] = self::getMenuAccess();
			return $CI->load->view('themes/'.THEME.'/index2', $data);
		}				
	}

	public static function getMenu()
	{
		$CI =& get_instance();
		$menu = array();
		$getMenu = $CI->db->query('SELECT * from sys_menu ORDER BY sort_position ASC')->result(); //put is active
		foreach ($getMenu as $key => $value) {
			
			$getSubmenu = $CI->db->query('SELECT * from sys_submenu where id_menu='.$value->id.' ORDER BY sort_position ASC')->result();
			$submenu = array();
			foreach ($getSubmenu as $k => $v) {
				array_push($submenu, $v);
			}
			$value->submenu = $submenu;
			array_push($menu, $value);
		}

		return $menu;
    }
    
    public function notAuthorized()
    {
        $CI =& get_instance();
        $data['title'] = 'Not Authorized';
        return $CI->load->view('themes/'.THEME.'/error/notauthorized', $data);
    }

	public static function getSubmenuAccess()
	{
		$CI =& get_instance();
		$groupId = $CI->session->userdata('group');
		$access = $CI->db->query('SELECT * from sys_group_priviledge where user_group_id='.$groupId.' group by submenu_id')->result();

		$groupAccess = array();
		foreach ($access as $key => $value) {
			$v = $value->submenu_id;
			array_push($groupAccess, $v);
		}
		return $groupAccess;
	}

	public static function getMenuAccess()
	{
		$CI =& get_instance();
		$groupId = $CI->session->userdata('group');
		$access = $CI->db->query(' SELECT spp.*, ss.id_menu FROM sys_group_priviledge spp JOIN sys_submenu ss ON spp.submenu_id = ss.id where spp.user_group_id = '.$groupId.' GROUP BY id_menu')->result();

		$groupAccess = array();
		foreach ($access as $key => $value) {
			$v = $value->id_menu;
			array_push($groupAccess, $v);
		}
		return $groupAccess;
	}
        
    public function throwError()
    {
		return $this->genView('default/error');
	}

    public function throwForbidden()
    {
		return $this->genView('default/error');
	}

	public function returnJSON($response)
	{
		$CI =& get_instance();
		$CI->load->library('output');
		$json = json_encode($response);
		return $CI->output->set_content_type('application/json')->set_output($json);
	}
}