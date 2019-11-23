<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Session
        $CI =& get_instance();
        if (!$CI->session->userdata('authLogin')) {
            redirect('auth', 'refresh');
        }
	}

	/**
	 * function to search all content in website by key name
	 * @param request array
	 */
	public function webSearch($request)
	{

	}


	/**
	 * @param type String contains widget type
	 * @return json encode
	 */
	public function widget($type = '')
	{
		$request = $this->input->get();
		extract($request);
		switch ($type) {
			case 'getTotalCompany':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}


	public function index()
	{
		$params = array();

		$page = 'default/dashboard';
		return $this->view->genView($page, $params);
	}

	public function dashboard()
	{
		return $this->view->genView('default/dashboard');
	}

	public function emptypage()
	{
		return $this->view->genView('empty');
	}

	public function sendMail()
	{			
		$body = '';
		try {
			$config = array(
				'to' => 'andreymahdison@gmail.com',
				'name' => 'Andry Mahdison',
				'subject' => 'This is dummy email',
				'body' => $body
			);
			$s = $this->emailservice->sendMail($config);
			return true;
		} catch (Exception $e) {
			return $e->getMessage();
		}	
	}
}
