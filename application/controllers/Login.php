<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
function __construct()
	{
		parent::__construct();
		$this->load->model(array('login_m'));
	}
	public function index()
	{	
		if($this->is_logged_in()!==false)
		{        
			redirect('welcome');
		}
		else{
			$data['test'] = '';
		$this->get_user_template('home',$data);
		}	
	}
	function login_verify()
	{
		
		$this->login_m->login_verify();
	}
	function logout()
	{
		$array_items = array('USER_ID');
		$this->session->unset_userdata($array_items);
		$response['msg'] = "Logout";
		$response['status'] = true;
		echo json_encode($response);
	}
	

}
