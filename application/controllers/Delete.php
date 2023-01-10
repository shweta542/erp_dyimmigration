<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends MY_Controller {
function __construct()
	{
		parent::__construct();
		$this->load->model(array('defaultModel'));
		if($this->is_logged_in()){

		$this->maindata=$this->db->where('USER_ID',$this->is_logged_in())->get('user_tbl')->row();
		}

	}
	 
     public function deletecommon_request()//add profile setting 
	{
		get_delete($_POST['table'],$_POST['field'],$_POST['id'],$_POST['myreturn']);
	}
	 
	
	
}
