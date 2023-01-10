<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {
function __construct()
	{
		parent::__construct();
		$this->load->model(array('defaultModel'));
		if($this->is_logged_in()){

		$this->maindata=$this->db->where('USER_ID',$this->is_logged_in())->get('user_tbl')->row();
		}
date_default_timezone_set("Asia/Kolkata");
	}
	 
    public function erpGetUserfingerprint_request()
{
   $data=$this->db->select('USER_EMAIL,USER_FINGERPRINT,USER_NAME,user_image')->get('user_tbl')->result();
if (!empty($data)) {
            $response['status'] = true;
             $response['code']="1";
             $response['data']=$data;
            }else{
            $response['status'] = false;
        }
         echo json_encode($response);
}
public function erpAddFingerprint_request()
{
   

			$data=$this->db->where('USER_EMAIL',$_POST['email'])->get('user_tbl')->row();
			if (!empty($data)) {
			   
			   $data = array(
			'USER_FINGERPRINT'=>$_POST['print'],
			);
			   $this->db->where('USER_EMAIL',$_POST['email'])->update('user_tbl',$data);

			$response['status'] =  true;
			$response['msg'] =  "Successfully registered  on this mail".$_POST['email'];

			}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : AX001";
			$response['msg'] =  "Sorry ".$_POST['email'];

			}
			echo json_encode($response);
}
public function PunchCardValueGetDetail(){
     
   
    $getUserdata=$this->db->where('USER_FINGERPRINT',$_POST['print'])->get('user_tbl')->row();
    // $_POST['userid']=$getUserdata->USER_ID;
   $sdate = date('Y-m-d 00:00:00');
	 	$edate = date('Y-m-d 23:59:59');
	 	$checkAttIN=$this->db->where('user_id',$getUserdata->USER_ID)->
	 	where('punchIn >=', $sdate)->
	 	where('punchIn <=', $edate)->
	 	order_by('attendance_id','DESC')->
	 	limit(1)->
	 	get('tbl_attendance')->row();
	 	
	 		
	 	if(!empty($checkAttIN)){//punch out
	 		if($checkAttIN->punchOut != '0000-00-00 00:00:00'){
	 			/*$data1=array('timeDiff'=>'00:00:00');
		$this->db->where('punchIn >=', $sdate)->where('punchIn <=', $edate)->where('user_id',$getUserdata->USER_ID)->update('tbl_attendance',$data1);*/
		
	 			$data=array('user_id'=>$getUserdata->USER_ID,
			'punchIn'=>date('Y-m-d h:i:s'),
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_attendance',$data);
	 		}else{
$mydate = date('Y-m-d h:i:s');
	 			$query=$this->db->query("SELECT TIMEDIFF('$mydate','$checkAttIN->punchIn') as time FROM tbl_attendance")->row();
				$data=array('user_id'=>$getUserdata->USER_ID,
							'punchOut'=>date('Y-m-d h:i:s'),
							'timeDiff'=>$query->time,
				);
				$this->db->where('attendance_id',$checkAttIN->attendance_id)->update('tbl_attendance',$data);
	 		}


	 	}else{//punch in
	 		$data=array('user_id'=>$getUserdata->USER_ID,
			'punchIn'=>date('Y-m-d h:i:s'),
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_attendance',$data);
	 	}
if ($this->db->affected_rows()) {
            $response['status'] =  true;
			$response['msg'] =  "User add successfully!";
			$response['name'] =  $getUserdata->USER_NAME;
    }else{
     $response['status'] =  true;
			$response['msg'] =  "User add successfully!";
			$response['name'] =  $getUserdata->USER_NAME;
    
	 		
		}
		echo json_encode($response);
}	
}
