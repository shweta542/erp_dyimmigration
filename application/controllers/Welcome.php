<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
function __construct()
	{
		parent::__construct();
		$this->load->model(array('defaultModel'));
		$this->load->library('pagination');
		if($this->is_logged_in()){

		$this->maindata=$this->db->where('USER_ID',$this->is_logged_in())->get('user_tbl')->row();
		}
			date_default_timezone_set("Asia/Kolkata");
	}
	 var $data='1';
	public function index()//branch login
	{
		$data['home'] = '';
		$data['page'] = 'login';
		$data['sidepage'] = '';
		$this->get_user_template('login',$data);
	}
	public function forgotpassword()//view PROFILE SETTING page 
	{
		$data['home'] = '';
		$data['page'] = 'forgotpassword';
		$data['sidepage'] = '';
		$this->get_user_template('forgotpassword',$data);
	}
	 public function pagenation($tablename)
    {
    	  //Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('del_status',0)->get($tablename)->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            //$data['getdepartment'] = $this->db->select('*')->limit($config["per_page"],$i)->from('tbl_department')->get()->result();
           $data['data']=$this->db->where('del_status',0)->limit($config["per_page"],$i)->get($tablename)->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
                //Pagination Ends
    }
	public function dashboardAdmin()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'dashboard';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['totalemployee']=$this->db->where('del_status',0)->where('status',0)->from('user_tbl')->count_all_results();
		$data['totalbranch']=$this->db->where('del_status',0)->from('tbl_branch')->count_all_results();
		$sdate = date('Y-m-d 00:00:00');
	 	$edate = date('Y-m-d 23:59:59');
		$data['todaypresent']=$this->db->select('DISTINCT(user_id)')->
	 	where('punchIn >=', $sdate)->
	 	where('punchIn <=', $edate)->
	 	group_by('user_id')->
	 	from('tbl_attendance')->count_all_results();
 		$todaydate = date('Y-m-d');
 		$data['nooffollowups']=$this->db->where('del_status',0)->where('status',8)->from('tbl_call')->count_all_results();
 	
 		$data['totalenquiry']=$this->db->where('del_status',0)->from('tbl_call')->count_all_results();
 		$data['totalcounsellor']=$this->db->where('del_status',0)->from('tbl_call')->count_all_results();
 	//	$currentmonth=date('m');
 		
     /*   $this->db->from('tbl_call sl');
        $this->db->where('DATE(sl.datetime) >=','2022-'.$currentmonth.'-01');
        $this->db->where('DATE(sl.datetime) <=','2022-'.$currentmonth.'-31');
        $this->db->where('del_status',0);
        $this->db->where_in('counselor_id', ['43','1']);
        $data['totalcounsellor']= $this->db->count_all_results();*/
        
     /*  $data['counttelecaller']=$this->db->where_in('counselor_id',['43','1'])->
        where('del_status',0)->
        where('usertype',2)->
        where('datetime >= ', '2022-'.$currentmonth.'-01')->
        where('datetime <= ','2022-'.$currentmonth.'-31')->
        from("tbl_call")->count_all_results();
       
        
       $data['countCounselor']=$this->db->where_in('counselor_id',['43','1'])->
        where('del_status',0)->
        where('datetime >= ', '2022-'.$currentmonth.'-01')->
        where('datetime <= ','2022-'.$currentmonth.'-31')->
        from("tbl_call")->
        count_all_results();
*/
        
     /*   $this->db->from('tbl_call sl');
        $this->db->where('DATE(sl.datetime) >=','2022-'.$currentmonth.'-01');
        $this->db->where('DATE(sl.datetime) <=','2022-'.$currentmonth.'-31');
        $this->db->where('del_status',0);
        $this->db->where_in('counselor_id', ['43','1']);
        $data['totalcounsellor']= $this->db->count_all_results();*/
     	$sdate = date('Y-m-d'); 
       // $currentyear=date('Y');
        $this->db->from('tbl_call sl');
      //  $this->db->where('DATE(sl.datetime) >=',$currentyear.'-'.$currentmonth.'-01');
       // $this->db->where('DATE(sl.datetime) <=',$currentyear.'-'.$currentmonth.'-31');
      //   $this->db->where('DATE(sl.datetime)',$sdate);
       	
        $this->db->where('del_status',0);
        $data['totalwalkin']= $this->db->count_all_results();
        
        
        
          $this->db->from('tbl_call sl');
     /*   $this->db->where('DATE(sl.datetime) >=',$currentyear.'-'.$currentmonth.'-01');
        $this->db->where('DATE(sl.datetime) <=',$currentyear.'-'.$currentmonth.'-31');*/
      //    $this->db->where('DATE(sl.datetime)',$sdate);
        $this->db->where('admission_status',1);
        $this->db->where('del_status',0);
        $data['totalenrollmnt']= $this->db->count_all_results();
        	$data['status']= $this->db->where('del_status',0)->get('tbl_status')->result();
        
           
		$this->get_user_template('dashboard-admin',$data);
		}else{
			$this->index();
		}
	}
	public function dashboardEmployee()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'dashboard';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		 $data['fullday'] = $this->db->select('sum(leave_day) as fullcount')->where('USER_ID',$this->is_logged_in())->where('leave_type','1')->like('datetime',date('y'))->get('tbl_leave')->row();
		 $data['haflday'] =$this->db->select('sum(leave_day) as halfcount')->where('USER_ID',$this->is_logged_in())->where('leave_type','2')->like('datetime',date('y'))->get('tbl_leave')->row();
		 $data['shortday'] = $this->db->select('sum(leave_day) as shortcount')->where('USER_ID',$this->is_logged_in())->where('leave_type','3')->like('datetime',date('y'))->get('tbl_leave')->row();
		 $orgData=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->get('tbl_organisation')->row();
		 $data['organisationleave'] = $orgData;
 	        $data['previllage']= $this->db->where('USER_ID',$this->is_logged_in())->get('privileges_tbl')->row();
 	      //  print_r($data['previllage']);
 	      
        $todaydate = date('Y-m-d');
        $data['nooffollowups']=$this->db->where('del_status',0)->where('USER_ID',$this->is_logged_in())->where('datetime',$todaydate)->where('status',8)->from('tbl_call')->count_all_results();
        
        $data['totalenquiry']=$this->db->where('del_status',0)->where('USER_ID',$this->is_logged_in())->where('datetime',$todaydate)->from('tbl_call')->count_all_results();
        $data['totalcounsellor']=$this->db->where('del_status',0)->where('USER_ID',$this->is_logged_in())->where('datetime',$todaydate)->from('tbl_call')->count_all_results();
        
        	$sdate = date('Y-m-d'); 
       // $currentyear=date('Y');
        $this->db->from('tbl_call sl');
         $this->db->where('DATE(sl.datetime)',$sdate);
       	$this->db->where('USER_ID',$this->is_logged_in());
        $this->db->where('del_status',0);
        $data['totalwalkin']= $this->db->count_all_results();
        	$data['totalbranch']=$this->db->where('del_status',0)->from('tbl_branch')->count_all_results();
        
        
          $this->db->from('tbl_call sl');
          $this->db->where('DATE(sl.datetime)',$sdate);
        $this->db->where('admission_status',1);
        $this->db->where('del_status',0);
         $this->db->where('USER_ID',$this->is_logged_in());
        $data['totalenrollmnt']= $this->db->count_all_results();
	    $data['totalemployee']=$this->db->where('del_status',0)->where('status',0)->from('user_tbl')->count_all_results();
		$sdate = date('Y-m-d 00:00:00');
	 	$edate = date('Y-m-d 23:59:59');
	 	
		$data['todaypresent']=$this->db->select('DISTINCT(user_id)')->
	 	where('punchIn >=', $sdate)->
	 	where('punchIn <=', $edate)->
	 	group_by('user_id')->
	 	from('tbl_attendance')->count_all_results();
	 		$data['status']= $this->db->where('del_status',0)->get('tbl_status')->result();
        
		$this->get_user_template('dashboard-employee',$data);

		}else{
			$this->index();
		}
	}
	public function profile($id)//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'profile';
		$data['id'] = $id;

		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['profiledata']=$this->db->where('USER_ID',$id)->get('user_tbl')->row();
		$data['profilemetadata']=$this->db->where('USER_ID',$id)->get('tbl_user_meta')->row();
		$data['department1'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('department_id','DESC')->get('tbl_department')->result();
        $data['branch'] =$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
		$this->get_user_template('user-profile',$data);

		}else{
			$this->index();
		}
	}
	public function changepassword()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'changepassword';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$this->get_user_template('change-password',$data);

		}else{
			$this->index();
		}
	}
	public function department()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'department';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_department')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
		$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->limit($config["per_page"],$i)->order_by('department_id','DESC')->get('tbl_department')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );

		
		$this->get_user_template('department',$data);
		}else{
			$this->index();
		}
	}
	public function designation()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'designation';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->select('tbl_department.department_name,tbl_designation.*')->
		where('tbl_designation.oraganisation_id',$this->maindata->oraganisation_id)->
		join('tbl_department', 'tbl_department.department_id = tbl_designation.department_id')->
		where('tbl_designation.del_status',0)->
         get('tbl_designation')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            $data['data']= $this->db->select('tbl_department.department_name,tbl_designation.*')->
		where('tbl_designation.oraganisation_id',$this->maindata->oraganisation_id)->
		join('tbl_department', 'tbl_department.department_id = tbl_designation.department_id')->
		where('tbl_designation.del_status',0)->
		limit($config["per_page"],$i)->
		order_by('tbl_designation.designation_id','DESC')->
		get('tbl_designation')->result();

		
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
		
		$this->get_user_template('designation',$data);
	}else{
			$this->index();
		}
	}
	public function addbranch()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'brancheslist';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		if (isset($_GET['id'])) {
			$data['editbranch']=$this->db->where('branch_id',$_GET['id'])->get('tbl_branch')->row();
		}
		$this->get_user_template('add-branch',$data);
		}else{
			$this->index();
		}
		
	}
	public function brancheslist()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'brancheslist';
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_branch')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
			$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->limit($config["per_page"],$i)->order_by('branch_id','DESC')->get('tbl_branch')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('branchlist',$data);
		}else{
			$this->index();
		}
		
	}
	public function organizationSettings()//view PROFILE SETTING page 
	{
		
		if($this->is_logged_in()){
		$data['sidepage'] = 'organizationSettings';
		$data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->get('tbl_organisation')->row();

		$this->get_user_template('organizationSettings',$data);

		}else{
			$this->index();
		}
		
	}

	public function getDesignationDetail(){
        $res="";  
        $query=$this->db->where('department_id',$_POST['department_id'])->get('tbl_designation')->result();
        foreach($query as $row){
        $res.= "<option value=".$row->designation_id.">".$row->designation_name."</option>";
       
        }
    echo $res;
    }

	public function getStateDetail(){

        $res="";  
        $query=$this->db->where('country_id',$_POST['country_id'])->get('states')->result();
        foreach($query as $row){
        $res.= "<option value=".$row->id.">".$row->name."</option>";
       
        }
    echo $res;
    }
	public function getCitiesDetail(){
       
        $res="";  
        $query=$this->db->where('state_id',$_POST['state_id'])->get('cities')->result();
        foreach($query as $row){
        $res.= "<option value=".$row->id.">".$row->name."</option>";
       
        }
    echo $res;
    }
    
	public function employeelist()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'employeelist';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        $data['department'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('department_id','DESC')->get('tbl_department')->result();
        $data['branch'] =$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());

            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('STATUS',0)->get('user_tbl')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
            
            if(isset($_GET['phone']) && ($_GET['phone']!="")){
              
              $this->db->where('USER_PHONE',$_GET['phone']);  
                
            }
            
            if(isset($_GET['name']) && ($_GET['name']!="")){
            
            $this->db->where('USER_NAME',$_GET['name']);  
            
            }
            
             if(isset($_GET['email']) && ($_GET['email']!="")){
            
            $this->db->where('USER_EMAIL',$_GET['email']);  
            
            }
         
            
		$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('STATUS',0)->limit($config["per_page"],$i)->order_by('USER_ID','DESC')->get('user_tbl')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('employeelist',$data);
		}else{
			$this->index();
		}
		
	}
	public function employeedit($id)//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'employeelist';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['department'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('department_id','DESC')->get('tbl_department')->result();
        $data['branch'] =$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
		$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('STATUS',0)->where('USER_ID',$id)->get('user_tbl')->row();
		$data['previllage']= $this->db->where('USER_ID',$id)->get('privileges_tbl')->row();
		$this->get_user_template('employee-edit',$data);
		}else{
			$this->index();
		}
	}
	public function holidays()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'holidays';
		 $data['oraganisation_id'] = $this->maindata->oraganisation_id;
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_holidays')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
		$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->limit($config["per_page"],$i)->order_by('holidays_date','ASC')->get('tbl_holidays')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('holidays',$data);
		}else{
			$this->index();
		}
		
	}
	public function addleave()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'addleave';
		 $data['oraganisation_id'] = $this->maindata->oraganisation_id;
		 $data['fullday'] = $this->db->select('sum(leave_day) as fullcount')->where('USER_ID',$this->is_logged_in())->where('leave_type','1')->like('datetime',date('y'))->get('tbl_leave')->row();
		 $data['haflday'] =$this->db->select('sum(leave_day) as halfcount')->where('USER_ID',$this->is_logged_in())->where('leave_type','2')->like('datetime',date('y'))->get('tbl_leave')->row();
		 $data['shortday'] = $this->db->select('sum(leave_day) as shortcount')->where('USER_ID',$this->is_logged_in())->where('leave_type','3')->like('datetime',date('y'))->get('tbl_leave')->row();
		 $data['annualleave'] = $this->db->select('sum(leave_day) as annualcount')->where('USER_ID',$this->is_logged_in())->like('datetime',date('y'))->get('tbl_leave')->row();
		 $orgData=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->get('tbl_organisation')->row();
		 $data['organisationleave'] = $orgData;
		 $data['annualgiven'] = $orgData->total_halfday + $orgData->total_shortleave + $orgData->total_fullday ;
		 /*print_r($data);
		 die();*/
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_leave')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
		$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('USER_ID',$this->is_logged_in())->where('del_status',0)->limit($config["per_page"],$i)->order_by('leave_id','DESC')->get('tbl_leave')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('addleave',$data);
		}else{
			$this->index();
		}
		
	}

	 public function leavestatus_request()
	{
		$data = array('status_markedby' => $_POST['userid'],
				' 	status ' => $_POST['status'],
				
			 );
		$this->db->where('leave_id',$_POST['leave_id'])->update('tbl_leave',$data);
		
		$response['status'] =  true;
		$response['msg'] =  "Status update successfully!";
	
		echo json_encode($response);
	}
	public function adminleave()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'adminleave';
		 $data['oraganisation_id'] = $this->maindata->oraganisation_id;
		 $data['totalReq']=$this->db->like('datetime',date('y'))->from('tbl_leave')->count_all_results();
		 $data['totalapprove']=$this->db->where('status',2)->like('datetime',date('y'))->from('tbl_leave')->count_all_results();
		 $data['totalnotapprove']=$this->db->where('status!=',2)->like('datetime',date('y'))->from('tbl_leave')->count_all_results();
		 $data['totalpending']=$this->db->where('status',1)->like('datetime',date('y'))->from('tbl_leave')->count_all_results();
		
		
		 $orgData=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->get('tbl_organisation')->row();
		 $data['orgData']=$orgData;
		 $data['annualgiven'] = $orgData->total_halfday + $orgData->total_shortleave + $orgData->total_fullday ;
		 /*print_r($data);
		 die();*/
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_leave')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
		$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->limit($config["per_page"],$i)->order_by('leave_id','DESC')->get('tbl_leave')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('adminleave',$data);
		}else{
			$this->index();
		}
		
	}
	public function attendanceEmployee()//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'attendanceEmployee';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$sdate = date('Y-m-d 00:00:00');
        $edate = date('Y-m-d 23:59:59');

        $data['checkAttIN'] =$this->db->where('user_id',$this->is_logged_in())->
        where('punchIn >=', $sdate)->
        where('punchIn <=', $edate)->
        order_by('attendance_id','DESC')->
        limit(1)->
        get('tbl_attendance')->row();

        $data['todayActivity'] =$this->db->where('user_id',$this->is_logged_in())->
        where('punchIn >=', $sdate)->
        where('punchIn <=', $edate)->
        order_by('attendance_id','ASC')->
        get('tbl_attendance')->result();

        $data['todaySum'] =$this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC(timeDiff))) as time")->
        where('user_id',$this->is_logged_in())->
        where('punchIn >=', $sdate)->
        where('punchIn <=', $edate)->
        get('tbl_attendance')->row();
		$this->get_user_template('attendance-employee',$data);
		}else{
			$this->index();
		}
	}
	public function attendanceAdmin()//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'attendanceAdmin';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());

            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('STATUS',0)->get('user_tbl')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            if(isset($_GET['name']) && $_GET['name']!=''){
            	$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)
		->where('del_status',0)
		->where('STATUS',0)
		->where('USER_ID',$_GET['name'])
		->limit($config["per_page"],$i)
		->order_by('USER_ID','DESC')
		->get('user_tbl')
		->result();
            }else{
            	$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)
		->where('del_status',0)
		->where('STATUS',0)
		->limit($config["per_page"],$i)
		->order_by('USER_ID','DESC')
		->get('user_tbl')
		->result();
            }
		

		$allholi= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_holidays')->result();
			$a=array();
		foreach ($allholi as $key ) {
		array_push($a,$key->holidays_date);
		}
		$data['search']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)
		->where('del_status',0)
		->where('STATUS',0)
		
		->order_by('USER_ID','DESC')
		->get('user_tbl')
		->result();
		$data['holiday']=$a;
		$str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
		$this->get_user_template('attendance-admin',$data);
		}else{
			$this->index();
		}
	}
	public function employeePayroll()//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'employeePayroll';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['userData'] = $this->db->where('STATUS',0)->where('del_status',0)->get('user_tbl')->result();
		$data['search']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)
		->where('del_status',0)
		->where('STATUS',0)
		
		->order_by('USER_ID','DESC')
		->get('user_tbl')
		->result();
		if (isset($_GET['month'])) {
			
		$data['alluserData'] = $this->db->select('user_tbl.*,tbl_payroll.*')->
		join('user_tbl', 'user_tbl.USER_ID = tbl_payroll.user_id')->
		order_by('tbl_payroll.payroll_id','DESC')->
		where('tbl_payroll.del_status',0)->
		where('tbl_payroll.month',$_GET['month'])->
		where('tbl_payroll.year',$_GET['year'])->
		where('tbl_payroll.user_id',$_GET['name'])->
		get('tbl_payroll')->result();
		}else{
			$data['alluserData'] = $this->db->select('user_tbl.*,tbl_payroll.*')->
		join('user_tbl', 'user_tbl.USER_ID = tbl_payroll.user_id')->
		order_by('tbl_payroll.payroll_id','DESC')->
		where('tbl_payroll.del_status',0)->
		
		get('tbl_payroll')->result();
		}

		$this->get_user_template('employee-payroll-list',$data);
		}else{
			$this->index();
		}
	}
	public function employeePayrolledit($id)//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'employeePayrolledit';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['id'] = $id;
		$data['userData'] = $this->db->where('STATUS',0)->where('del_status',0)->get('user_tbl')->result();
		$data['search']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)
		->where('del_status',0)
		->where('STATUS',0)
		
		->order_by('USER_ID','DESC')
		->get('user_tbl')
		->result();

		$data['data']= $this->db->where('payroll_id',$id)
		->get('tbl_payroll')
		->row();

		$this->get_user_template('employee-payroll-edit',$data);
		}else{
			$this->index();
		}
	}
	public function salarySlip($id)//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'employeePayroll';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['payroll_id'] = $id;
		$data['alluserData'] = $this->db->select('user_tbl.*,tbl_payroll.*')->
		join('user_tbl', 'user_tbl.USER_ID = tbl_payroll.user_id')->
		order_by('tbl_payroll.payroll_id','DESC')->
		where('tbl_payroll.payroll_id',$id)->
		where('tbl_payroll.del_status',0)->
		get('tbl_payroll')->row();
		$allholi= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_holidays')->result();
			$a=array();
		foreach ($allholi as $key ) {
		array_push($a,$key->holidays_date);
		}
		
		$data['holiday']=$a;
		$this->get_user_template('salarySlip',$data);
		}else{
			$this->index();
		}
	}
	public function currentmonthsalarySlip($userid)//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'currentmonthsalarySlip';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$user=$this->db->where('USER_ID',$userid)->get('user_tbl')->row();
		$getPayroll=$this->db->where('user_id',$userid)->
		where('month',date('m'))->
		where('year',date('Y'))->get('tbl_payroll')->row();
		if(!empty($getPayroll)){
		$id = $getPayroll->payroll_id;

			$data['payroll_id'] = $id;
			$data['alluserData'] = $this->db->select('user_tbl.*,tbl_payroll.*')->
			join('user_tbl', 'user_tbl.USER_ID = tbl_payroll.user_id')->
			order_by('tbl_payroll.payroll_id','DESC')->
			where('tbl_payroll.payroll_id',$id)->
			where('tbl_payroll.del_status',0)->
			get('tbl_payroll')->row();
			$allholi= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_holidays')->result();
				$a=array();
			foreach ($allholi as $key ) {
			array_push($a,$key->holidays_date);
			}
			
			$data['holiday']=$a;
			$this->get_user_template('salarySlip',$data);
		}else{
			echo 'This month pay slip is not ready!';
		}
		}else{
			$this->index();
		}
	}
	public function getEmployeestatus()
	{
		$data = array('USER_VERIFY' => $_POST['status']);
		$this->db->where('USER_ID',$_POST['id'])->update('user_tbl',$data);
		
		$response['status'] =  true;
		$response['msg'] =  "Status update successfully!";
	
		echo json_encode($response);
	}
	public function barchart()
	{
		$arr = array('Jan'=>'01','Feb'=>'02','Mar'=>'03','Apr'=>'04','May'=>'05','Jun'=>'06','Jul'=>'07','Aug'=>'08','Sep'=>'09','Oct'=>'10','Nov'=>'11','Dec'=>'12');
		$myarr=array();
		foreach ($arr as $key => $value) {
			 $moneyindata=$this->db->select('SUM(amount) as tamount')->where('MONTH(date)',$value)->where('moneyInOut','1')->where('del_status',0)->where('status',0)->get('tbl_journal')->row();
		
			$moneyoutdata=$this->db->select('SUM(amount) as tamount')->where('MONTH(date)',$value)->where('moneyInOut','2')->where('del_status',0)->where('status',0)->get('tbl_journal')->row();
			$myarr[] = (object) ['month' => $key,'moneyin' => ($moneyindata->tamount)?$moneyindata->tamount:0,'moneyout'=> ($moneyoutdata->tamount)?$moneyoutdata->tamount:0];
		}
		
		$response['data'] = $myarr;
		echo json_encode($response);
	}
	
	
	public function piechart()
	{
		$arr = $this->db->select('heads_id,heads_name')->where('heads_fk',0)->where('del_status',0)->where('heads_category',2)->get('tbl_heads')->result();
		$myarr=array();
		foreach ($arr as $key => $value) {
			$moneyindata=$this->db->select('SUM(amount) as tamount')->where('head_id',$value->heads_id)->where('status',0)->get('tbl_journal')->row();
			
			$myarr[] = (object) ['label' => $value->heads_name,'y' => ($moneyindata->tamount)?$moneyindata->tamount:0];
		}
		$response['data'] = $myarr ;
		echo json_encode($response);
	}
	public function employeePayrolluser()//add profile setting 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'employeePayrolluser';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['userData'] = $this->db->where('STATUS',0)->where('del_status',0)->get('user_tbl')->result();
		$data['search']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)
		->where('del_status',0)
		->where('STATUS',0)
		
		->order_by('USER_ID','DESC')
		->get('user_tbl')
		->result();
		if (isset($_GET['month'])) {
			
		$data['alluserData'] = $this->db->select('user_tbl.*,tbl_payroll.*')->
		join('user_tbl', 'user_tbl.USER_ID = tbl_payroll.user_id')->
		order_by('tbl_payroll.payroll_id','DESC')->
		where('tbl_payroll.del_status',0)->
		where('tbl_payroll.month',$_GET['month'])->
		where('tbl_payroll.year',$_GET['year'])->
		where('tbl_payroll.user_id',$this->is_logged_in())->
		get('tbl_payroll')->result();
		}else{
			$data['alluserData'] = $this->db->select('user_tbl.*,tbl_payroll.*')->
		join('user_tbl', 'user_tbl.USER_ID = tbl_payroll.user_id')->
		order_by('tbl_payroll.payroll_id','DESC')->
		where('tbl_payroll.del_status',0)->
		where('tbl_payroll.user_id',$this->is_logged_in())->
		get('tbl_payroll')->result();
		}

		$this->get_user_template('employee-payroll-user',$data);
		}else{
			$this->index();
		}
	}
	public function error()//add profile setting 
	{
	echo "Wrong url!";
	}
	
	public function forgotpassword_requset()
	{
		
		$emailCheck=$this->db->where('USER_EMAIL',$_POST['email'])->get('user_tbl')->row();
		if(!empty($emailCheck)){
		    	$data1 = array('forgot_status' => 1);
		$this->db->where('USER_EMAIL',$_POST['email'])->update('user_tbl',$data1);
		    $data['url']=base_url().'welcome/forgetchangepassword?id='.$emailCheck->USER_ID;
		    send_email($_POST['email'],'dyimmigration@dm.omnestech.co.in','Forgot Password','forgotpassword',$data);
		    /*$response['status'] =  true;
		$response['msg'] =  "Url send to your email !";*/
		}else{
		    	$response['status'] =  false;
		$response['msg'] =  "Email not matched!";
		}
	
	
		echo json_encode($response);
	}
	public function forgetchangepassword()
	{
		$user=$this->db->where('USER_ID',$_GET['id'])->where('forgot_status',1)->get('user_tbl')->row();
		
		if(!empty($user)){
		    $data['home'] = '';
		$data['page'] = 'forgotpassword';
		$data['sidepage'] = '';
			$this->get_user_template('forgetchange-password',$data);
		}else{
			echo 'Url expired!';
		}
	
	}
	
		public function studentbarchart()
	{
		$arr = array('Jan'=>'01','Feb'=>'02','Mar'=>'03','Apr'=>'04','May'=>'05','Jun'=>'06','Jul'=>'07','Aug'=>'08','Sep'=>'09','Oct'=>'10','Nov'=>'11','Dec'=>'12');
		$myarr=array();
		foreach ($arr as $key => $value) {
		   // print_r($value);
			 $moneyindata=$this->db->select('SUM(amount) as tamount')->where('MONTH(date)',$value)->where('moneyInOut','1')->where('del_status',0)->where('status',0)->get('tbl_journal')->row();
		
		//	$moneyoutdata=$this->db->select('SUM(amount) as tamount')->where('MONTH(date)',$value)->where('moneyInOut','2')->where('del_status',0)->where('status',0)->get('tbl_journal')->row();
		//	$myarr[] = (object) ['month' => $key,'moneyin' => ($moneyindata->tamount)?$moneyindata->tamount:0];
		//$myarr[]='month' => $key,'moneyin' => ($moneyindata->tamount)?$moneyindata->tamount:0;
        $this->db->from('tbl_call sl');
        $this->db->where('DATE(sl.datetime) >=','2022-'.$value.'-01');
        $this->db->where('DATE(sl.datetime) <=','2022-'.$value.'-31');
        $this->db->where('del_status',0);
        $totaldata= $this->db->count_all_results();
     
		$myarr[]= ['month' => $key,'Totalcount' => ($totaldata)?$totaldata:0];
		}
		
	/*	echo "<pre>";
		print_r($myarr);
		*/
		$response['data'] = $myarr;
		
		echo json_encode($response);
	}
	
}
