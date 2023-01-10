<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	private $rememberMe; 
	private $isLogin; 
	private $adminData; 
	private $adminID; 
	protected $data = array(); 

	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('topic_admin')=="") {
			//$rememberMe = get_cookie($this->rememberMe);
			
				$this->isLogin = false;
			
		}else{
			$this->isLogin = true;
		}

		if (!$this->isLogin) {
			redirect(base_url('admin'));
		}else{
			$this->adminID = $this->session->userdata('topic_admin');
			$this->adminData = $this->db->where('ADMIN_ID',$this->adminID)->get('ADMIN_TBL')->row_array();
		}
		$this->data['adminData'] = $this->adminData;
		$this->load->model(array('admin/adminModel'));
	}
	public function index()
	{	
		$this->get_admin_template('admin_dashboard_view',$this->data);
	}
	
	public function logout()
	{
		$this->session->unset_userdata('topic_admin');
		redirect(base_url('admin'));
	}
	public function profile()//view profile
	{
		$this->get_admin_template('admin_profile_view',$this->data);
	}
	public function editprofile_request()//edit profile
	{
		$this->adminModel->editprofile_request();
	}
	public function changepassword()//view change password
	{
		$this->get_admin_template('admin_changepassword_view',$this->data);
	}
	public function changepassword_request()// change password
	{
		$this->adminModel->changepassword_request();
	}
	public function general()//General update
	{
		$this->data['gemeralData'] = $this->db->get('GENERAL')->row();
		$this->get_admin_template('admin_general_view',$this->data);
	}
	public function editGeneral_request()
	{
		return $this->adminModel->editGeneral_request();
	}
	public function banner($id=0)//Banner add ,update,delete
	{
		if ($id!=0) {
			$this->data['currentBannerData'] = $this->db->where('BANNER_ID',$id)->get('BANNER_TBL')->row_array();
		}
		$this->data['bannerData'] = $this->db->get('BANNER_TBL')->result();
		$this->get_admin_template('admin_banner_view',$this->data);
	}
	public function addBanner_request()
	{
		return $this->adminModel->addBanner_request();
	}
	public function editBanner_request()
	{
		return $this->adminModel->editBanner_request();
	}
	public function deleteBanner_request()
	{
		return $this->adminModel->deleteBanner_request();
	}

	public function sendemail()//send email
	{
		$this->get_admin_template('admin_email_view',$this->data);
	}
	public function email()//email send to any one
	{
		send_email($_POST['toemail'],'dupleitsolution@gmail.com',$_POST['subject'],'test',$_POST);
		redirect('admin/main/sendemail');
	}
	public function smtp()//smtp view add edit 
	{
		$data['smtpData'] = $this->db->get('SMTP_TBL')->row();
		$this->get_admin_template('admin_smtp_view',$data);
	}
	public function editsmtp_request()
	{
		$this->adminModel->editsmtp_request();
	}
	public function testpage()//test scrol
	{
		$data['smtpData'] = $this->db->get('SMTP_TBL')->row();
		$this->get_admin_template('testpage',$data);
	}
	public function fetch()//test scrol fetch
	{
		if(isset($_POST["limit"], $_POST["start"]))
{
	$connect = mysqli_connect("localhost", "root", "", "db_newdemo");
	$data = "SELECT * FROM country ORDER BY id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 //$data=$this->db->get('country')->result();
	$result = mysqli_query($connect, $data);
 foreach ($result as $key) 
 {
  echo '
  <tr class="animated fadeInDown">
  <td  align="center"><h3>'.$key['id'].'</h3></td>
 <td align="center"> <p>'.$key['country_code'].'</p></td>
 <td> <p class="" align="center">By - '.$key['country_name'].'</p></td>
  </tr>
  ';
 }
}
	}
	
	public function test()
	{
		$this->get_admin_template('test',$this->data);
	}

	public function testinsert()
	{
		get_insert('test',$_POST,'Test Done','IMAGE',TRUE);
	}
	public function newinsert()
	{
		get_insert('test',$_POST,'Test new Done','IMAGE',TRUE);
	}
	
}
