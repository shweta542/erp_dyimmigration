<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends MY_Controller {
function __construct()
	{
		parent::__construct();
		$this->load->model(array('defaultModel'));
		if($this->is_logged_in()){

		$this->maindata=$this->db->where('USER_ID',$this->is_logged_in())->get('user_tbl')->row();
		}
		date_default_timezone_set("Asia/Kolkata");
	}
	 public function markattendance_request()
	 {
	 	
	 	$sdate = date('Y-m-d 00:00:00');
	 	$edate = date('Y-m-d 23:59:59');
	 	$_POST['date']=date('Y-m-d H:i:s');
	 	$checkAttIN=$this->db->where('user_id',$_POST['userid'])->
	 	where('punchIn >=', $sdate)->
	 	where('punchIn <=', $edate)->
	 	order_by('attendance_id','DESC')->
	 	limit(1)->
	 	get('tbl_attendance')->row();
	 	/*echo	date('h:i A',strtotime($_POST['date']));
	 	die();*/	
	 	if($checkAttIN->punchIn != ""){//punch out
	 		if($checkAttIN->punchOut != '0000-00-00 00:00:00'){
		/*$data1=array('timeDiff'=>'00:00:00');
		$this->db->where('punchIn >=', $sdate)->where('punchIn <=', $edate)->where('user_id',$_POST['userid'])->update('tbl_attendance',$data1);*/

	 			$data=array('user_id'=>$_POST['userid'],
			'punchIn'=>$_POST['date'],
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_attendance',$data);
	 		}else{
	 			$mydate = $_POST['date'];
	 			$query=$this->db->query("SELECT TIMEDIFF('$mydate','$checkAttIN->punchIn') as time FROM tbl_attendance")->row();
	 			
				$data=array('user_id'=>$_POST['userid'],
							'punchOut'=>$_POST['date'],
							'timeDiff'=>$query->time,

				);
				$this->db->where('attendance_id',$checkAttIN->attendance_id)->update('tbl_attendance',$data);
	 		}


	 	}else{//punch in
	 		$data=array('user_id'=>$_POST['userid'],
			'punchIn'=>$_POST['date'],
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_attendance',$data);
	 	}

	 		$response['status'] =  true;
			$response['msg'] =  "User add successfully!";
		
		echo json_encode($response);
		
	 }
    public function getSalaryEmployee()
    {
    	$getSalary=$this->db->select('employee_salary')->where('USER_ID',$_POST['user_id'])->limit(1)->get('user_tbl')->row();
 function total_sun($month,$year)
{
    $sundays=0;
    $total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
    for($i=1;$i<=$total_days;$i++)
    if(date('N',strtotime($year.'-'.$month.'-'.$i))==7)
    $sundays++;
    return $sundays;
}
    	$maxDays=cal_days_in_month(CAL_GREGORIAN,$_POST['month'],$_POST['year']);

$allholi= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->like('holidays_date',date("M", mktime(0, 0, 0, $_POST['month'], 10)))->get('tbl_holidays')->result();
            $a=array();

        foreach ($allholi as $key ) {
            $day = date('l',strtotime($key->holidays_date));
if($day != 'Sunday'){
        array_push($a,$key->holidays_date);
}
        }
        
 $totalhours=$maxDays - total_sun($_POST['month'],$_POST['year'])- count($a);
 $totalhoursPreday='8';
 //total hrs
 $totalWorkingHours= $totalhours * $totalhoursPreday .':00:00';

 $timestamp    = strtotime($_POST['year'].'-'.$_POST['month'].'-01');
 $sdate = date('Y-m-01 00:00:00', $timestamp);
 $edate  = date('Y-m-t 23:59:59', $timestamp); 

$checkAttIN=$this->db->select('SEC_TO_TIME( SUM( TIME_TO_SEC( `timeDiff` ) ) ) AS timeSum ')->
		where('user_id',$_POST['user_id'])->
	 	where('punchIn >=', $sdate)->
	 	where('punchIn <=', $edate)->
	 	where('punchOut!=', '0000-00-00 00:00:00')->
	 	order_by('attendance_id','DESC')->
	 	get('tbl_attendance')->row();
//total working hrs
$userAtttime=$checkAttIN->timeSum;

   $tarr=explode('.', $userAtttime);

$salaryDeducthr11=$this->db->query("SELECT TIMEDIFF('$totalWorkingHours','$tarr[0]') as time FROM tbl_attendance")->row();
     //user salary deduct hrs     
       $salaryDeducthr=  $salaryDeducthr11->time; 
       $salaryDeducthrarr = explode(':', $salaryDeducthr);
      //salary pre day
      $salarypreday=$getSalary->employee_salary / $maxDays;
      //salary pre hour
      $salaryprehour = $salarypreday / $totalhoursPreday;

       $finaldeductsalary1= (int)$salaryDeducthrarr[0] * (int)$salaryprehour;
       $finaldeductsalary2= (int)$salaryDeducthrarr[1] / 60 * (int)$salaryprehour;
    if(empty($salaryDeducthrarr)){
    	$response['status'] =  false;
		$response['netsalary'] = 0 ;
		$response['deductSalary'] = 0 ;
    }else{
    	$response['status'] =  true;
		$response['netsalary'] = $getSalary->employee_salary-round($finaldeductsalary1 + $finaldeductsalary2) ;
		$response['deductSalary'] = round($finaldeductsalary1 + $finaldeductsalary2) ;
    }
      
		echo json_encode($response);
	}
}
