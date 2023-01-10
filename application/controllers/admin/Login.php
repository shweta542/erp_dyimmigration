<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	//private $rememberMe; 
	private $isLogin; 

	function __construct()
	{
		parent::__construct();

		//$this->rememberMe = "topicadminlogin";

		if ($this->session->userdata('topic_admin')=="") {
			//$rememberMe = get_cookie($this->rememberMe);
			
				$this->isLogin = false;
			
		}else{
			$this->isLogin = true;
		}

		if ($this->isLogin) {
			redirect(base_url('admin/main'));
		}

	}

	public function index()
	{
		$data['home']=" ";
		$this->get_admin_template('admin_login_view',$data);
	}

	public function login_request()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if ($this->db->where('ADMIN_EMAIL',$username)->count_all_results('ADMIN_TBL')) {
			$data = $this->db->where('ADMIN_EMAIL',$username)->get('ADMIN_TBL')->row_array();
			if ($data['ADMIN_PASSWORD'] == $password) {
				if (isset($_POST['remember'])) {
					$name = $this->rememberMe;
					$value = $data['ADMIN_ID'];
					$expire = (time()+86400);
					set_cookie($name, $value, $expire);
				}
				$this->session->set_userdata('topic_admin',$data['ADMIN_ID']);

				$response['status'] = true;
				$response['code'] = 'login_003';
				$response['msg'] = 'LOGIN SUCCESSFULLY...';

			}else{
				$response['status'] = false;
				$response['code'] = 'login_002';
				$response['msg'] = 'INVALID USERNAME PASSWORD...';
			}
		}else{
			$response['status'] = false;
			$response['code'] = 'login_001';
			$response['msg'] = 'INVALID USERNAME PASSWORD...';
		}

		echo json_encode($response);
	}

}
