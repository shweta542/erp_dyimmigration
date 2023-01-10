<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caller extends MY_Controller {
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
		echo 'error';
	}
	public function forgotpassword()//view PROFILE SETTING page 
	{
		$data['home'] = '';
		$data['page'] = 'forgotpassword';
		$data['sidepage'] = '';
		$this->get_user_template('forgotpassword',$data);
	}
	 public function calldetail()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'calldetail';
		$data['usertype'] = 1;
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['counselor'] =$this->db->select('u.USER_ID as USER_ID,u.USER_NAME as USER_NAME')->
            join('user_tbl u', 'u.USER_ID = p.USER_ID')->
		where('p.counselor !=',0)->
		where('u.del_status',0)->
		get('privileges_tbl p')->result();
		$data['class']=$this->db->where('del_status',0)->get('tbl_class')->result();
		$data['boardanduniversity']=$this->db->where('del_status',0)->get('tbl_boardanduniversity')->result();
		$data['stream']=$this->db->where('del_status',0)->get('tbl_stream')->result();
		//Pagination Begins
		
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            //$config["base_url"] = $url;
            if (isset($_GET['country'])) {
					$this->db->select('DISTINCT(m.call_id),c.*');
				$this->db->join('tbl_call_meta m', 'm.call_id = c.call_id', 'left');
				
				if($_GET['country'] != ""){
					$this->db->where('c.country',$_GET['country']);	
				}
				if($_GET['class'] != ""){
					$this->db->where('m.course',$_GET['class']);	
				}
				if($_GET['year'] != ""){
					$this->db->where('m.passingyear',$_GET['year']);	
				}
				if($_GET['boardanduniversity'] != ""){
					$this->db->where('m.boardanduniversity',$_GET['boardanduniversity']);	
				}
				if($_GET['stream'] != ""){
					$this->db->where('m.streamandother',$_GET['stream']);	
				}
				if($_GET['percentage'] != ""){
					$this->db->where('m.percentage',$_GET['percentage']);	
				}
				if($_GET['score'] != ""){
					$this->db->where('c.language_score',$_GET['score']);	
				}
				if($_GET['phone'] != ""){
					$this->db->where('c.phone',$_GET['phone']);	
				}
				if($_GET['name'] != ""){
					$this->db->like('c.name',$_GET['name']);	
				}
				if($_GET['status'] != ""){
					$this->db->like('c.status',$_GET['status']);	
				}
				if($this->is_logged_in() == 1){
					
				}else{
				    $this->db->where('c.user_id',$this->is_logged_in());
				}
				//$this->db->group_by('m.call_id');
				$this->db->where('c.oraganisation_id',$this->maindata->oraganisation_id);
			
				
				$this->db->where('c.del_status',0);
				$this->db->where('c.usertype',1);
				$total_row = $this->db->get('tbl_call c')->num_rows();
            }else{
                 $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
           if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('user_id',$this->is_logged_in());
			 }
           
            $this->db->where('del_status',0);
            $this->db->where('usertype',1); 
            $total_row = $this->db->get('tbl_call')->num_rows();
            }
          
             //echo $total_row;
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
            $country=(isset($_GET['country']))?$_GET['country']:'';
            $class=(isset($_GET['class']))?$_GET['class']:'';
            $year=(isset($_GET['year']))?$_GET['year']:'';
            $boardanduniversity=(isset($_GET['boardanduniversity']))?$_GET['boardanduniversity']:'';
            $stream=(isset($_GET['stream']))?$_GET['stream']:'';
            $score=(isset($_GET['score']))?$_GET['score']:'';
            $percentage=(isset($_GET['percentage']))?$_GET['percentage']:'';
            $phone=(isset($_GET['phone']))?$_GET['phone']:'';
            $name=(isset($_GET['name']))?$_GET['name']:'';
            $status=(isset($_GET['status']))?$_GET['status']:'';
         $config['base_url'] = base_url('/calldetail.html?country='.$country.'&class='.$class.'&year='.$year.'&boardanduniversity='.$boardanduniversity.'&stream='.$stream.'&score='.$score.'&percentage='.$percentage.'&phone='.$phone.'&name='.$name.'&status='.$status.'');
            //$config['base_url'] = base_url($this->uri->uri_string());
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
         if (isset($_GET['country'])) {
				$this->db->select('DISTINCT(m.call_id),c.*');
				$this->db->join('tbl_call_meta m', 'm.call_id = c.call_id', 'left');
				
				if($_GET['country'] != ""){
					$this->db->where('c.country',$_GET['country']);	
				}
				if($_GET['class'] != ""){
					$this->db->where('m.course',$_GET['class']);	
				}
				if($_GET['year'] != ""){
					$this->db->where('m.passingyear',$_GET['year']);	
				}
				if($_GET['boardanduniversity'] != ""){
					$this->db->where('m.boardanduniversity',$_GET['boardanduniversity']);	
				}
				if($_GET['stream'] != ""){
					$this->db->where('m.streamandother',$_GET['stream']);	
				}
				if($_GET['percentage'] != ""){
					$this->db->where('m.percentage',$_GET['percentage']);	
				}
				if($_GET['score'] != ""){
					$this->db->where('c.language_score',$_GET['score']);	
				}
				if($_GET['phone'] != ""){
					$this->db->where('c.phone',$_GET['phone']);	
				}
				if($_GET['name'] != ""){
					$this->db->like('c.name',$_GET['name']);	
				}
				if($_GET['status'] != ""){
					$this->db->like('c.status',$_GET['status']);	
				}
				if($this->is_logged_in() == 1){
					
				}else{
				    $this->db->where('c.user_id',$this->is_logged_in());
				}
				//$this->db->group_by('m.call_id');
				$this->db->where('c.oraganisation_id',$this->maindata->oraganisation_id);
			
				
				$this->db->where('c.del_status',0);
				$this->db->where('c.usertype',1);
					$this->db->limit($config["per_page"],$i);
				$this->db->order_by('c.call_id','DESC');
				$data['data']=$this->db->get('tbl_call c')->result();
		}else{

			$this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
			 if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('user_id',$this->is_logged_in());
			 }
			$this->db->where('del_status',0);
			$this->db->where('usertype',1);
			$this->db->limit($config["per_page"],$i);
			$this->db->order_by('call_id','DESC');
			$data['data']=$this->db->get('tbl_call')->result();
		}
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-adddetail',$data);
		}else{
			$this->index();
		}
		
	}
	 public function calldetail1()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
            $data['sidepage'] = 'calldetail1';
            $data['usertype'] = 2;
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
            $data['counselor'] =$this->db->select('u.USER_ID as USER_ID,u.USER_NAME as USER_NAME')->
            join('user_tbl u', 'u.USER_ID = p.USER_ID')->
            where('p.counselor !=',0)->
            where('u.del_status',0)->
            get('privileges_tbl p')->result();
            $data['class']=$this->db->where('del_status',0)->get('tbl_class')->result();
            $data['boardanduniversity']=$this->db->where('del_status',0)->get('tbl_boardanduniversity')->result();
            $data['stream']=$this->db->where('del_status',0)->get('tbl_stream')->result();
            
            //Pagination Begins
		
            $config = array();
       
            if (isset($_GET['country'])) {
					$this->db->select('DISTINCT(m.call_id),c.*');
				$this->db->join('tbl_call_meta m', 'm.call_id = c.call_id', 'left');
				
				if($_GET['country'] != ""){
					$this->db->where('c.country',$_GET['country']);	
				}
				if($_GET['class'] != ""){
					$this->db->where('m.course',$_GET['class']);	
				}
				if($_GET['year'] != ""){
					$this->db->where('m.passingyear',$_GET['year']);	
				}
				if($_GET['boardanduniversity'] != ""){
					$this->db->where('m.boardanduniversity',$_GET['boardanduniversity']);	
				}
				if($_GET['stream'] != ""){
					$this->db->where('m.streamandother',$_GET['stream']);	
				}
				if($_GET['percentage'] != ""){
					$this->db->where('m.percentage',$_GET['percentage']);	
				}
				if($_GET['score'] != ""){
					$this->db->where('c.language_score',$_GET['score']);	
				}
				if($_GET['phone'] != ""){
					$this->db->where('c.phone',$_GET['phone']);	
				}
				if($_GET['name'] != ""){
					$this->db->like('c.name',$_GET['name']);	
				}
				if($_GET['status'] != ""){
					$this->db->like('c.status',$_GET['status']);	
				}
				if($this->is_logged_in() == 1){
					
				}else{
				    $this->db->where('c.user_id',$this->is_logged_in());
				}
				//$this->db->group_by('m.call_id');
				$this->db->where('c.oraganisation_id',$this->maindata->oraganisation_id);
			
				
				$this->db->where('c.del_status',0);
				$this->db->where('c.usertype',2);
				$total_row = $this->db->get('tbl_call c')->num_rows();
            }else{
                 $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
           if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('user_id',$this->is_logged_in());
			 }
           
            $this->db->where('del_status',0);
            $this->db->where('usertype',2); 
            $total_row = $this->db->get('tbl_call')->num_rows();
            }
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
         
            $country=(isset($_GET['country']))?$_GET['country']:'';
            $class=(isset($_GET['class']))?$_GET['class']:'';
            $year=(isset($_GET['year']))?$_GET['year']:'';
            $boardanduniversity=(isset($_GET['boardanduniversity']))?$_GET['boardanduniversity']:'';
            $stream=(isset($_GET['stream']))?$_GET['stream']:'';
            $score=(isset($_GET['score']))?$_GET['score']:'';
            $percentage=(isset($_GET['percentage']))?$_GET['percentage']:'';
            $phone=(isset($_GET['phone']))?$_GET['phone']:'';
            $name=(isset($_GET['name']))?$_GET['name']:'';
            $status=(isset($_GET['status']))?$_GET['status']:'';
             $config['base_url'] = base_url('/calldetail.html?country='.$country.'&class='.$class.'&year='.$year.'&boardanduniversity='.$boardanduniversity.'&stream='.$stream.'&score='.$score.'&percentage='.$percentage.'&phone='.$phone.'&name='.$name.'&status='.$status.'');
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
         if (isset($_GET['country'])) {
					$this->db->select('DISTINCT(m.call_id),c.*');
				$this->db->join('tbl_call_meta m', 'm.call_id = c.call_id', 'left');
				
				if($_GET['country'] != ""){
					$this->db->where('c.country',$_GET['country']);	
				}
				if($_GET['class'] != ""){
					$this->db->where('m.course',$_GET['class']);	
				}
				if($_GET['year'] != ""){
					$this->db->where('m.passingyear',$_GET['year']);	
				}
				if($_GET['boardanduniversity'] != ""){
					$this->db->where('m.boardanduniversity',$_GET['boardanduniversity']);	
				}
				if($_GET['stream'] != ""){
					$this->db->where('m.streamandother',$_GET['stream']);	
				}
				if($_GET['percentage'] != ""){
					$this->db->where('m.percentage',$_GET['percentage']);	
				}
				if($_GET['score'] != ""){
					$this->db->where('c.language_score',$_GET['score']);	
				}
				if($_GET['phone'] != ""){
					$this->db->where('c.phone',$_GET['phone']);	
				}
				if($_GET['name'] != ""){
					$this->db->like('c.name',$_GET['name']);	
				}
				if($_GET['status'] != ""){
					$this->db->like('c.status',$_GET['status']);	
				}
					if($this->is_logged_in() == 1){
					
				}else{
				    $this->db->where('c.user_id',$this->is_logged_in());
				}
				//$this->db->group_by('m.call_id');
				
				$this->db->where('c.oraganisation_id',$this->maindata->oraganisation_id);
			
				
				$this->db->where('c.del_status',0);
				$this->db->where('c.usertype',2);
				$this->db->limit($config["per_page"],$i);
				$this->db->order_by('c.call_id','DESC');
				$data['data']=$this->db->get('tbl_call c')->result();
		}else{

			 $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
			 if($this->is_logged_in() == 1){
		
			 }else{
	     	    $this->db->where('user_id',$this->is_logged_in());
			 }
			$this->db->where('del_status',0);
			$this->db->where('usertype',2);
			$this->db->limit($config["per_page"],$i);
			$this->db->order_by('call_id','DESC');
			$data['data']=$this->db->get('tbl_call')->result();
		}
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-adddetail',$data);
		}else{
			$this->index();
		}
		
	}
	public function counselor()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'counselor';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['usertype'] = 1;
		$data['class']=$this->db->where('del_status',0)->get('tbl_class')->result();
		$data['boardanduniversity']=$this->db->where('del_status',0)->get('tbl_boardanduniversity')->result();
		$data['stream']=$this->db->where('del_status',0)->get('tbl_stream')->result();

		//Pagination Begins
            $config = array();
       if (isset($_GET['country'])) {
					$this->db->select('DISTINCT(m.call_id),c.*');
				$this->db->join('tbl_call_meta m', 'm.call_id = c.call_id', 'left');
				
				if($_GET['country'] != ""){
					$this->db->where('c.country',$_GET['country']);	
				}
				if($_GET['class'] != ""){
					$this->db->where('m.course',$_GET['class']);	
				}
				if($_GET['year'] != ""){
					$this->db->where('m.passingyear',$_GET['year']);	
				}
				if($_GET['boardanduniversity'] != ""){
					$this->db->where('m.boardanduniversity',$_GET['boardanduniversity']);	
				}
				if($_GET['stream'] != ""){
					$this->db->where('m.streamandother',$_GET['stream']);	
				}
				if($_GET['percentage'] != ""){
					$this->db->where('m.percentage',$_GET['percentage']);	
				}
				if($_GET['score'] != ""){
					$this->db->where('c.language_score',$_GET['score']);	
				}
				if($_GET['phone'] != ""){
					$this->db->where('c.phone',$_GET['phone']);	
				}
				if($_GET['name'] != ""){
					$this->db->like('c.name',$_GET['name']);	
				}
				if($_GET['status'] != ""){
					$this->db->like('c.status',$_GET['status']);	
				}
				if($this->is_logged_in() == 1){
					
				}else{
				    $this->db->where('c.counselor_id',$this->is_logged_in(),'before');
				}
				//$this->db->group_by('m.call_id');
				$this->db->where('c.oraganisation_id',$this->maindata->oraganisation_id);
			
				
				$this->db->where('c.del_status',0);
				
				$total_row = $this->db->get('tbl_call c')->num_rows();
            }else{
                 $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
            $this->db->where('del_status',0);
           	if($this->is_logged_in() == 1){
			    
			}else{
			    $this->db->like('counselor_id',$this->is_logged_in(),'before');
			}
            $total_row = $this->db->get('tbl_call')->num_rows();
            }
            //end
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            
            
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
          if (isset($_GET['country'])) {
					$this->db->select('DISTINCT(m.call_id),c.*');
				$this->db->join('tbl_call_meta m', 'm.call_id = c.call_id', 'left');
				
				if($_GET['country'] != ""){
					$this->db->where('c.country',$_GET['country']);	
				}
				if($_GET['class'] != ""){
					$this->db->where('m.course',$_GET['class']);	
				}
				if($_GET['year'] != ""){
					$this->db->where('m.passingyear',$_GET['year']);	
				}
				if($_GET['boardanduniversity'] != ""){
					$this->db->where('m.boardanduniversity',$_GET['boardanduniversity']);	
				}
				if($_GET['stream'] != ""){
					$this->db->where('m.streamandother',$_GET['stream']);	
				}
				if($_GET['percentage'] != ""){
					$this->db->where('m.percentage',$_GET['percentage']);	
				}
				if($_GET['score'] != ""){
					$this->db->where('c.language_score',$_GET['score']);	
				}
				if($_GET['phone'] != ""){
					$this->db->where('c.phone',$_GET['phone']);	
				}
				if($_GET['name'] != ""){
					$this->db->like('c.name',$_GET['name']);	
				}
				if($_GET['status'] != ""){
					$this->db->like('c.status',$_GET['status']);	
				}
					if($this->is_logged_in() == 1){
					
				}else{
				    $this->db->where('c.counselor_id',$this->is_logged_in(),'before');
				}
				//$this->db->group_by('m.call_id');
				$this->db->where('c.oraganisation_id',$this->maindata->oraganisation_id);
			
				
				$this->db->where('c.del_status',0);
			
				$this->db->limit($config["per_page"],$i);
				$this->db->order_by('c.call_id','DESC');
				$data['data']=$this->db->get('tbl_call c')->result();
		}else{

			  $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
			$this->db->where('del_status',0);
			if($this->is_logged_in() == 1){
			    
			}else{
			    $this->db->like('counselor_id',$this->is_logged_in(),'before');
			}
			
			$this->db->limit($config["per_page"],$i);
			$this->db->order_by('call_id','DESC');
			$data['data'] =$this->db->get('tbl_call')->result();
		}
			
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-counsellor',$data);
		}else{
			$this->index();
		}
		
	}
	public function fullcalldetail()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = '';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		
		$data['data']= $this->db->where('call_id',$_GET['id'])->where('del_status',0)->limit(1)->get('tbl_call')->row();
		
		$this->get_user_template('caller-fullcalldetail',$data);
		}else{
			$this->index();
		}
		
	}
	public function editcall($id)//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'counselor';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
			$data['counselor'] =$this->db->select('u.USER_ID as USER_ID,u.USER_NAME as USER_NAME')->
            join('user_tbl u', 'u.USER_ID = p.USER_ID')->
		where('p.counselor !=',0)->
		where('u.del_status',0)->
		get('privileges_tbl p')->result();
			$data['class']=$this->db->where('del_status',0)->get('tbl_class')->result();
		$data['boardanduniversity']=$this->db->where('del_status',0)->get('tbl_boardanduniversity')->result();
		$data['stream']=$this->db->where('del_status',0)->get('tbl_stream')->result();
		$data['key']= $this->db->where('call_id',$id)->where('del_status',0)->limit(1)->get('tbl_call')->row();
		
		$this->get_user_template('caller-editcall',$data);
		}else{
			$this->index();
		}
		
	}
	 public function callstatus_request()
	{
		$data = array(
				' 	status ' => $_POST['status'],
				
			 );
		$this->db->where('call_id',$_POST['call_id'])->update('tbl_call',$data);
		
		$response['status'] =  true;
		$response['msg'] =  "Status update successfully!";
	
		echo json_encode($response);
	}
	public function tages()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'tages';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		

		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('del_status',0)->get('tbl_status')->num_rows();
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
         
			$data['data']= $this->db->where('del_status',0)->limit($config["per_page"],$i)->order_by('status_id','DESC')->get('tbl_status')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-tages',$data);
		}else{
			$this->index();
		}
		
	}
	 public function importdata()
	{ 
		if(isset($_POST["submit"]))
		{

			 $filename=$_FILES["exelefile"]["tmp_name"];
			if($_FILES["exelefile"]["size"] > 0)
			{
			

				$file = fopen($filename, "r");
				//$sql_data = "SELECT * FROM prod_list_1 ";
				$this->load->library('SimpleXLSX');
				//echo FCPATH.'vote2.xls'; die; FCPATH.'vote2.xls'
				$xls = new SimpleXLSX($_FILES['exelefile']['tmp_name']);
				if ($xls->success()) {
					   // echo '<pre>';print_r( $xls->rows() );
					   	$arr = $xls->rows();
				} else {
				
				
        				$this->load->library('SimpleXLS');
        				//echo FCPATH.'vote2.xls'; die; FCPATH.'vote2.xls'
        				$xls = new SimpleXLS($_FILES['exelefile']['tmp_name']);
        				if ($xls->success()) {
        					//echo '<pre>';print_r( $xls->rows() );
        					$arr = $xls->rows();
        				} else {
        					echo 'xls error: '.$xls->error();
        				}
        				
				}
				//print_r($arr);
				unset($arr[0]);
			//	die();
				 
				for($i = 1; $i <= count($arr); ++$i) {
				    if($arr[$i][10]){
				        $getstatus = $this->db->like('status_title',$arr[$i][10])->limit(1)->get('tbl_status')->row();  
				        if(empty($getstatus)){
				            $title = 0;
				        }else{
				            $title = $getstatus->status_id;
				        }
				    }else{
				        $title = 0;
				    }
				    if($arr[$i][12] ){
				        $userId = $arr[$i][12];
				       
				        
				    }else{
				         $getuserid = $this->db->like('USER_EMAIL',$arr[$i][13])->limit(1)->get('user_tbl')->row();  
				      if(!empty($getuserid) ){
				          $userId = $getuserid->USER_ID;  
				        }else{
				            $userId = 0;
				        }
				    }
                    $data=array(
			'name'=>$arr[$i][0],
			'email'=>$arr[$i][1],
			'phone'=>$arr[$i][2],
			'father_name'=>$arr[$i][11],
			'address'=>$arr[$i][4],
	    	'counselor_id'=>$userId,
			'oraganisation_id'=>$this->maindata->oraganisation_id,
			'dob'=>$arr[$i][3],
			'reference'=>$arr[$i][8],
			'remark'=>$arr[$i][9],
			'status'=>$title,
			'gender'=>$arr[$i][5],
			'age'=>$arr[$i][6],
			'language_score'=>$arr[$i][7],
			'usertype'=>$_POST['type'],
			'user_id'=>$this->is_logged_in(),
			'reference'=>$arr[$i][14],
			'preferedCountry'=>$arr[$i][15],
			'datetime'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_call',$data);
		$insert_id = $this->db->insert_id();
		$data1=array(
			'fileno'=>date('m').date('y').$insert_id,
			);
		$this->db->where('call_id',$insert_id)->update('tbl_call',$data1);
		
                }
                if($this->db->affected_rows()){
			echo 'Data Entered';
			}else{
			echo 'Error while inserting data';
			}
		
		
			}
		}

	}

	public function class()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'class';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		

		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('del_status',0)->get('tbl_class')->num_rows();
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
         
			$data['data']= $this->db->where('del_status',0)->limit($config["per_page"],$i)->order_by('class_id','DESC')->get('tbl_class')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-class',$data);
		}else{
			$this->index();
		}
		
	}
	public function boardanduniversity()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'boardanduniversity';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		

		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('del_status',0)->get('tbl_boardanduniversity')->num_rows();
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
         
			$data['data']= $this->db->where('del_status',0)->limit($config["per_page"],$i)->order_by('	id','DESC')->get('tbl_boardanduniversity')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-boardanduniversity',$data);
		}else{
			$this->index();
		}
		
	}
	public function stream()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'stream';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		

		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('del_status',0)->get('tbl_stream')->num_rows();
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
         
			$data['data']= $this->db->where('del_status',0)->limit($config["per_page"],$i)->order_by('stream_id','DESC')->get('tbl_stream')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-stream',$data);
		}else{
			$this->index();
		}
		
	}

	public function admission()//view PROFILE SETTING page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'admission';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
           $this->db->where('del_status',0);
             if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('admission_id',$this->is_logged_in());
			 }
          
             $total_row = $this->db->get('tbl_call')->num_rows();
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
         
		 $this->db->where('del_status',0);
			$this->db->limit($config["per_page"],$i);
			$this->db->order_by('call_id','DESC');
		if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('admission_id',$this->is_logged_in());
			 }
			 
			 
			 if(isset($_GET['search']) && ($_GET['search']!="")){
			     $this->db->where('call_id',$_GET['search'])->or_where('name',$_GET['search'])->or_where('fileno',$_GET['search'])->or_where('email',$_GET['search'])->or_where('phone',$_GET['search']);
			 }
			
			 
			$data['data']=$this->db->get('tbl_call')->result();
	//	echo $this->db->last_query();
		
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
           
		$this->get_user_template('caller-admission',$data);
		}else{
			$this->index();
		}
		
	}
	public function admissionstatus_request()
	{
		
		$data = array(
				'admission_status' => $_POST['status'],
			 );

		$this->db->where('call_id',$_POST['call_id'])->update('tbl_call',$data);
		
		$response['status'] =  true;
		$response['msg'] =  "Status update successfully!";
	
		echo json_encode($response);
	}
	public function coordinatorstatus_request()
	{
		
		$data = array(
				'coordinator_status' => $_POST['status'],
			 );

		$this->db->where('call_id',$_POST['call_id'])->update('tbl_call',$data);
		
		$response['status'] =  true;
		$response['msg'] =  "Status update successfully!";
	
		echo json_encode($response);
	}
	
	public function reception_dashboard()//view Reception Dashboard page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'receptionDashboard';
		$data['data']= $this->db->where('del_status',0)->get('tbl_status')->result();
		$todaydate = date('Y-m-d');
 		$data['nooffollowups']=$this->db->where('del_status',0)->where('datetime',$todaydate)->where('status',8)->from('tbl_call')->count_all_results();
		$this->get_user_template('caller-receptionDashboard',$data);
		}else{
			$this->index();
		}
		
	}
	
	public function telecaller_dashboard()//view Telecaller Dashboard page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'telecallerDashboard';
		$data['data']= $this->db->where('del_status',0)->get('tbl_status')->result();
		$todaydate = date('Y-m-d');
 		$data['nooffollowups']=$this->db->where('del_status',0)->where('datetime',$todaydate)->where('status',8)->from('tbl_call')->count_all_results();
		$this->get_user_template('caller-telecallerDashboard',$data);
		}else{
			$this->index();
		}
		
	}
	public function counselor_dashboard()//view Counselor Dashboard page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'counselorDashboard';
		$data['status']= $this->db->where('del_status',0)->get('tbl_status')->result();
		
		$todaydate = date('Y-m-d');
 		$data['nooffollowups']=$this->db->where('del_status',0)->where('datetime',$todaydate)->where('status',8)->from('tbl_call')->count_all_results();
 	
		$this->get_user_template('caller-counselorDashboard',$data);
		}else{
			$this->index();
		}
		
	}
	public function admission_dashboard()//view Admission Dashboard page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'admissionDashboard';
		$data['status']= $this->db->where('del_status',0)->get('tbl_status')->result();
		$this->get_user_template('caller-admissionDashboard',$data);
		}else{
			$this->index();
		}
		
	}
	public function updateCounselor_request()
	{
		$getcounselor=$this->db->select('counselor_id')->where('call_id',$_POST['call_id'])->get('tbl_call')->row();

		if($getcounselor->counselor_id == null){
			$maincounselor = $_POST['counselor'];
		}else{
			$arr=explode(',',$getcounselor->counselor_id);
			if(in_array($_POST['counselor'], $arr)){
				$pos = array_search($_POST['counselor'], $arr);
				unset($arr[$pos]);
				$arr1=implode(',',$arr);
				$maincounselor = $arr1;
			}else{

				$maincounselor = $getcounselor->counselor_id .',' .$_POST['counselor'];
			}
		}
		$data = array(
				'counselor_id' => $maincounselor,
			 );

		$this->db->where('call_id',$_POST['call_id'])->update('tbl_call',$data);
		
		$response['status'] =  true;
		$response['msg'] =  "Status update successfully!";
	
		echo json_encode($response);
	}
public function updateAdmission_request()
	{
		
		$data = array(
				'admission_id' => $_POST['admission'],
			 );

		$this->db->where('call_id',$_POST['call_id'])->update('tbl_call',$data);
		
		$response['status'] =  true;
		$response['msg'] =  "Status update successfully!";
	
		echo json_encode($response);
	}
	public function coordinator()//view Reception Dashboard page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'counselor';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['admission'] =$this->db->select('u.USER_ID as USER_ID,u.USER_NAME as USER_NAME')->
            join('user_tbl u', 'u.USER_ID = p.USER_ID')->
		where('p.admission !=',0)->
		where('u.del_status',0)->
		get('privileges_tbl p')->result();

		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->
            where('coordinator_status',1)->
            where('status',9)->
            where('del_status',0)->get('tbl_call')->num_rows();
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
         
			$data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('coordinator_status',1)->
			where('status',9)->
			where('del_status',0)->limit($config["per_page"],$i)->order_by('call_id','DESC')->get('tbl_call')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
		$this->get_user_template('caller-coordinator',$data);
		}else{
			$this->index();
		}
		
	}
	public function followup()//view followup page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'counselor';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['usertype'] = $_GET['type'];
		//echo date('d M Y');
        /*$getdata=$this->db->select('c.*')->
        join('tbl_call c', 'c.call_id = r.call_id')->
        where('r.followup_nextdate',date('d M Y'))->group_by('r.call_id')->get('tbl_remark r')->result();
        echo '<pre>';
        print_r($getdata);*/
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->select('c.*')->
        join('tbl_call c', 'c.call_id = r.call_id')->
        where('r.followup_nextdate',date('j M Y'))->
        where('c.usertype',$_GET['type'])->
        group_by('r.call_id')->get('tbl_remark r')->num_rows();
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
         
			$this->db->select('c.*');
        $this->db->join('tbl_call c', 'c.call_id = r.call_id');
        $this->db->where('r.followup_nextdate',date('j M Y'));
        $this->db->where('c.usertype',$_GET['type']);
         if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('c.user_id',$this->is_logged_in());
			 }
        $this->db->group_by('r.call_id');
        $this->db->limit($config["per_page"],$i);
       $data['data'] = $this->db->get('tbl_remark r')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
		    $this->get_user_template('caller-followup',$data);
		}else{
			$this->index();
		}
		
	}
	public function followupCounsler()//view followup page 
	{
	   /* echo $this->is_logged_in();
	    die();*/
		if($this->is_logged_in()){
		$data['sidepage'] = 'counselor';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		$data['usertype'] = $_GET['type'];
		//echo date('d M Y');
        /*$getdata=$this->db->select('c.*')->
        join('tbl_call c', 'c.call_id = r.call_id')->
        where('r.followup_nextdate',date('d M Y'))->group_by('r.call_id')->get('tbl_remark r')->result();
        echo '<pre>';
        print_r($getdata);*/
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
           $this->db->select('c.*');
        $this->db->join('tbl_call c', 'c.call_id = r.call_id');
        $this->db->where('r.followup_nextdate',date('j M Y'));
       
        
        if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('c.user_id',$this->is_logged_in());
			 }
        $this->db->group_by('r.call_id');
        $total_row =  $this->db->get('tbl_remark r')->num_rows();
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
         
			 $this->db->select('c.*');
        $this->db->join('tbl_call c', 'c.call_id = r.call_id');
        $this->db->where('r.followup_nextdate',date('j M Y'));
       
         if($this->is_logged_in() == 1){
		
			 }else{
			     	$this->db->where('c.user_id',$this->is_logged_in());
			 }
        $this->db->group_by('r.call_id');
        $this->db->limit($config["per_page"],$i);
       $data['data'] = $this->db->get('tbl_remark r')->result();
         
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
		    $this->get_user_template('caller-followupCounsler',$data);
		}else{
			$this->index();
		}
		
	}
	public function exportdata(){
	     $this->db->where('del_status',0);
	     $this->db->where('datetime >=', $_POST['start']);
            $this->db->where('datetime <=', $_POST['end']);
	     $data=$this->db->get('tbl_call')->result_array();
$list=array();
if(!empty($data)){
    foreach($data as $key => $value){
        $list1=array();
        $arr1=explode(',', $value['counselor_id']);
       $remark = $this->db->where('call_id',$value['call_id'])->order_by('remark_id','DESC')->get('tbl_remark')->row();
       if(!empty($remark)){
           $mremark=$remark->remark;
       }else{
            $mremark="No remark";
       }
        foreach($arr1 as $key1 => $value1){
            if($value1 != "Select Counselor" || $value1 !=""){
                  $cons=$this->db->where('USER_ID',$value1)->get('user_tbl')->row();
                 if(!empty($cons)){
                     array_push($list1,$cons->USER_NAME ." ". $cons->user_last_name );
                 }
             
            }
            
          
        }
        $arr2=implode(',', $list1);
       
    $country=$this->db->where('id',$value['country'])->limit(1)->get('country')->row();
    $metadata=$this->db->where('call_id',$value['call_id'])->limit(1)->get('tbl_call_meta')->row_array();
    
    if($metadata['boardanduniversity'] != "Select Board & university" || $metadata['boardanduniversity'] !=""){
        
         $board1=$this->db->where('id',$metadata['boardanduniversity'])->limit(1)->get('tbl_boardanduniversity')->row_array();
         $board=$board1['name'];
    }else{
        $board="";
    }
    if($metadata['streamandother'] != "Select Stream" || $metadata['streamandother'] !=""){
        
         $stream1=$this->db->where('stream_id',$metadata['streamandother'])->limit(1)->get('tbl_stream')->row_array();
         $stream=$stream1['stream_name'];
    }else{
        $stream="";
    }
     if($metadata['course'] != "Select Course" || $metadata['course'] !=""){
        
         $class1=$this->db->where('class_id',$metadata['course'])->limit(1)->get('tbl_class')->row_array();
         $class=$class1['class_name'];
    }else{
        $class="";
    }
   
    
  $temp=array($value['name'],$value['preferedCountry'],$value['email'],$value['phone'],$value['reference'],$value['gender'],$value['english_test'],$mremark,$value['age'],$value['datetime'],$arr2,$class,$board,$stream,$metadata['passingyear'],$metadata['percentage']);
 array_push($list,$temp);
}
/*echo "<pre>";
print_r($list);
die();
*/

$file = fopen("test.csv","w");

foreach ($list as $line) {
  fputcsv($file, $line);
}

fclose($file);


header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename('test.csv').'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('test.csv'));
            flush(); // Flush system output buffer
            readfile('test.csv');
            die();
}else{
    echo "No data found";
}


	}
}
