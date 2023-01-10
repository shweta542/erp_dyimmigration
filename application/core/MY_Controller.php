<?php
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
class MY_Controller extends CI_Controller
{
    
    public function __construct()
    {
        
        parent::__construct();
       ini_set('memory_limit', '128M');
        ini_set('set_time_imit',30000);
        $this->load->driver('session');
        $this->load->helper('file');
        //$this->load->model('defaultModel');
    }

    public function get_user_template($template,$data=""){
        $user_id=$this->is_logged_in();
        $query=$this->db->query("select * from user_tbl where USER_ID='$user_id'");
        $data["logged_in_user"]=$query->row();
        $privil=$this->db->query("select * from privileges_tbl where USER_ID='$user_id'");
        $org=$this->db->query("select * from tbl_organisation");
        $data["privileges_settings"]=$privil->row();
        $data["organisation_settings"]=$org->row();
        $data['template']=TEMPLATE_NAME.'/'.$template;
        $this->load->view('template',$data);
    }
    public function is_logged_in()
    {
        $user = $this->session->userdata('USER_ID');
        $this->config->set_item('USER_ID',$user);
        if(isset($user))
            return $user;
        else
            return false;
    }
     public function checkuser()
    {
        $user_id=$this->is_logged_in();
        $query=$this->db->where('USER_ID',$user_id)->get('user_tbl')->row();
        if($query->USER_NAME=="")
            return false;
        else
            return true;
    }
    public function get_admin_template($template,$data=""){
        $data['template']=TEMPLATE_ADMIN_NAME.'/'.$template;
        $this->load->view('template-admin',$data);
    }
}