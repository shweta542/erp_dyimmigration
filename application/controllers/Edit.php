<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends MY_Controller {
function __construct()
	{
		parent::__construct();
		$this->load->model(array('defaultModel'));
		if($this->is_logged_in()){

		$this->maindata=$this->db->where('USER_ID',$this->is_logged_in())->get('user_tbl')->row();
		}
		date_default_timezone_set("Asia/Kolkata");
	}
	public function image_upload($index,$multiple=false,$getpath=false)
    {
        $insertedids = array();
        $foldername= date("Y-m-d-h");
        if (!is_dir("uploads")) {
            mkdir("uploads");
        }
        if (!is_dir("uploads/images")) {
            mkdir("uploads/images");
        }
        if (!is_dir("uploads/images/".$foldername)) {
            mkdir("uploads/images/".$foldername);
        }

        $config = array(
            'upload_path' => "./uploads/images/".$foldername,
            'allowed_types' => 'jpg|jpeg|png|pdf',
            'overwrite' => TRUE,
            'file_name' => time().rand(0,999),
            'encrypt_name' => TRUE,
            'overwrite' => TRUE,
            'remove_spaces' => TRUE
        );

        $this->upload->initialize($config);

    if ($multiple) {
    $filesCount = count($_FILES[$index]['name']);
       for($i = 0; $i < ($filesCount); $i++)
       {
           $_FILES['userFile']['name'] = $_FILES[$index]['name'][$i];
           $_FILES['userFile']['type'] = $_FILES[$index]['type'][$i];
           $_FILES['userFile']['tmp_name'] = $_FILES[$index]['tmp_name'][$i];
           $_FILES['userFile']['error'] = $_FILES[$index]['error'][$i];
           $_FILES['userFile']['size'] = $_FILES[$index]['size'][$i];

           if($this->upload->do_upload('userFile'))
           {
               $upload_data =$this->upload->data();
                    $full_path = substr($config['upload_path'],2).'/'.$upload_data['file_name'];
               $this->db->insert('images_tbl',array('IMAGE_PATH'=>$full_path,'IMAGE_TIMESTAMP'=>date('Y-m-d H:i:s')));
               $insertedids[] = $this->db->insert_id();
           }
           else
           {
               $error = array('error' => $this->upload->display_errors());
               //print_r($error);
           }
       }
    }else{
    if($this->upload->do_upload($index))
            {
                $upload_data =$this->upload->data();
                $full_path = substr($config['upload_path'],2).'/'.$upload_data['file_name'];
                if($getpath){
                    $configer =  array(
              'image_library'   => 'gd2',
              'source_image'    =>  $_SERVER['DOCUMENT_ROOT'] .'/erp/'.$full_path,
            
              'maintain_ratio'  =>  TRUE,
              'width'           =>  180,
              'height'          =>  180,
            );
            
            $this->image_lib->initialize($configer);
            $this->image_lib->resize();
                    return $full_path;
                }else{
                    $this->db->insert('images_tbl',array('IMAGE_PATH'=>$full_path,'IMAGE_TIMESTAMP'=>date('Y-m-d H:i:s')));
                    $insertedids[] = $this->db->insert_id();
                }
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
                //print_r($error);
            }
    }

        return $ids = implode('|', $insertedids);

    }
    	public function updateOrganization_request()//add profile setting 
	{
		get_update('tbl_organisation',$_POST,'oraganisation_id',$_POST['oraganisation_id'],'Add setting','oraganisation_logo');
		get_update('tbl_organisation',$_POST,'oraganisation_id',$_POST['oraganisation_id'],'Add setting','oraganisation_favicon');
		
			$response['status'] =  true;
			$response['msg'] =  "User update successfully!";
		
		echo json_encode($response);
	}
	public function editUser_request()//edit profile  
	{
			$data=array('branch_id'=>implode('|',$_POST['branch_id']),
			'USER_EMAIL'=>$_POST['USER_EMAIL'],
			'USER_NAME'=>$_POST['USER_NAME'],
			'user_last_name'=>$_POST['user_last_name'],
			'username'=>$_POST['username'],
			'PASSWORD'=>$_POST['password'],
			'USER_PHONE'=>$_POST['USER_PHONE'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'Joining_date'=>$_POST['Joining_date'],
			'department_id'=>$_POST['department_id'],
			'designation_id'=>$_POST['designation_id'],
			'employee_salary'=>$_POST['employee_salary'],
		);
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('user_tbl',$data);
		//print_r($_POST['employees']);
		if($_POST['organizationSetting']){ 
			$arr=implode('|',$_POST['organizationSetting']);
		}else{ 
			$arr='0';
		}
		if($_POST['branch']){ 
			$arr1=implode('|',$_POST['branch']);
		}else{ 
			$arr1='0';
		}
		if($_POST['department']){ 
			$arr2=implode('|',$_POST['department']);
		}else{ 
			$arr2='0';
		}
		if($_POST['designation']){ 
			$arr3=implode('|',$_POST['designation']);
		}else{ 
			$arr3='0';
		}
		if($_POST['employees']){ 
			$arr4=implode('|',$_POST['employees']);
		}else{ 
			$arr4='0';
		}
		if($_POST['leave']){ 
			$arr5=implode('|',$_POST['leave']);
		}else{ 
			$arr5='0';
		}
		if($_POST['attendence']){ 
			$arr6=implode('|',$_POST['attendence']);
		}else{ 
			$arr6='0';
		}
		if($_POST['salary']){ 
			$arr7=implode('|',$_POST['salary']);
		}else{ 
			$arr7='0';
		}
		if($_POST['holiday']){ 
			$arr8=implode('|',$_POST['holiday']);
		}else{ 
			$arr8='0';
		}
		if($_POST['banking']){ 
			$arrA8=implode('|',$_POST['banking']);
		}else{ 
			$arrA8='0';
		}
		if($_POST['heads']){ 
			$arr9=implode('|',$_POST['heads']);
		}else{ 
			$arr9='0';
		}
		if($_POST['subHeads']){ 
			$arr10=implode('|',$_POST['subHeads']);
		}else{ 
			$arr10='0';
		}
		if($_POST['vendorCustomer']){ 
			$arr11=implode('|',$_POST['vendorCustomer']);
		}else{ 
			$arr11='0';
		}
		if($_POST['journal']){ 
			$arr12=implode('|',$_POST['journal']);
		}else{ 
			$arr12='0';
		}
		if($_POST['ledger']){ 
			$arr13=implode('|',$_POST['ledger']);
		}else{ 
			$arr13='0';
		}
		if($_POST['balanceSheet']){ 
			$arr14=implode('|',$_POST['balanceSheet']);
		}else{ 
			$arr14='0';
		}
		if($_POST['trialBalance']){ 
			$arr15=implode('|',$_POST['trialBalance']);
		}else{ 
			$arr15='0';
		}
		if($_POST['ProfitLoss']){ 
			$arr16=implode('|',$_POST['ProfitLoss']);
		}else{ 
			$arr16='0';
		}
		if($_POST['reception']){ 
			$arr18=implode('|',$_POST['reception']);
		}else{ 
			$arr18='0';
		}
		if($_POST['telecaller']){ 
			$arr19=implode('|',$_POST['telecaller']);
		}else{ 
			$arr19='0';
		}
		if($_POST['counselor']){ 
			$arr20=implode('|',$_POST['counselor']);
		}else{ 
			$arr20='0';
		}
		if($_POST['admission']){ 
			$arr21=implode('|',$_POST['admission']);
		}else{ 
			$arr21='0';
		}
		if($_POST['coordinator']){ 
			$arr22=implode('|',$_POST['coordinator']);
		}else{ 
			$arr22='0';
		}
			$privilege = array('organizationSetting' => $arr,
				'branch' => $arr1,
				'department' => $arr2,
				'designation' => $arr3,
				'employees' => $arr4,
				'leaves' => $arr5,
				'attendence' => $arr6,
				'salary' => $arr7,
				'holiday' => $arr8,
				'banking' => $arrA8,
				'heads' => $arr9,
				'subHeads' => $arr10,
				'vendorCustomer' => $arr11,
				'journal' => $arr12,
				'ledger' => $arr13,
				'balanceSheet' => $arr14,
				'trialBalance' => $arr15,
				'ProfitLoss' => $arr16,
				'reception' => $arr18,
				'telecaller' => $arr19,
				'counselor' => $arr20,
				'admission' => $arr21,
				'coordinator' => $arr22,
			 );
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('privileges_tbl',$privilege);
		
			$response['status'] =  true;
			$response['msg'] =  "User update successfully!";
		
		echo json_encode($response);
		
		
	}
	 public function editHoliday_request()//add profile setting 
	{
		get_update('tbl_holidays',$_POST,'holidays_id',$_POST['holidays_id'],'Holiday update successfully!');
	}
	public function updateLeavecount_request()//add profile setting 
	{
		get_update('tbl_organisation',$_POST,'oraganisation_id',$_POST['oraganisation_id'],'Add setting');
	}
	public function updateAtt_request()//add profile setting 
	{
 		 $mydate = date('Y-m-d H:i:s',strtotime($_POST['date'] . ' ' .$_POST['punchIn']));
 		 $mydate1 = date('Y-m-d H:i:s',strtotime($_POST['date'] .' '. $_POST['punchOut']));
		$this->db->where('user_id',$_POST['user_id'])->
	 	where('punchIn >=', $mydate)->
	 	where('punchIn <=', $mydate)->
	 	delete('tbl_attendance');
		$query=$this->db->query("SELECT TIMEDIFF('$mydate1','$mydate') as time FROM tbl_attendance")->row();
/*$time = new DateTime($_POST['date'] . ' ' .$_POST['punchIn']);
$time1 = new DateTime($_POST['date'] . ' ' .$_POST['punchOut']);
$interval = date_diff($time,$time1);*/
		$data=array('user_id'=>$_POST['user_id'],
							'punchIn'=>$mydate,
							'punchOut'=>$mydate1,
							'timeDiff'=>$query->time,
							'DATETIME'=>date('Y-m-d H:i:s')

				);
				$this->db->insert('tbl_attendance',$data);
				if($this->db->affected_rows() ){

			$response['status'] =  true;
			$response['msg'] =  "Attendance update successfully!";
				}
		
		echo json_encode($response);
	}
	public function editBranch_request()//add profile setting 
	{
		get_update('tbl_branch',$_POST,'branch_id',$_POST['branch_id'],'Update branch','branch_logo');
	}
	public function editDepartment_request()//add profile setting 
	{
		get_update('tbl_department',$_POST,'department_id',$_POST['department_id'],'Update department');
	}
	public function editDesignation_request()//add profile setting 
	{
		get_update('tbl_designation',$_POST,'designation_id',$_POST['designation_id'],'Update Designation');
	}
	public function editBank_request()//add profile setting 
	{
		get_update('tbl_bank',$_POST,'bank_id',$_POST['bank_id'],'Update bank');
	}
	public function editGroup_request()//add profile setting 
	{
		$data1=array('heads_category'=>$_POST['group_category'],
			'status'=>$_POST['status'],
			);
			$this->db->where('group_fk',$_POST['group_id'])->update('tbl_heads',$data1);
		get_update('tbl_group',$_POST,'group_id',$_POST['group_id'],'Update group');
	}
	public function editHead_request()//add profile setting 
	{
		get_update('tbl_heads',$_POST,'heads_id',$_POST['heads_id'],'Update head','uploads');
	}
	public function editVendorCustomer_request()//add profile setting 
	{
		/*get_update('tbl_vendorcustomer',$_POST,'vendorcustomer_id',$_POST['vendorcustomer_id'],'Update vendorcustomer','vendorcustomer_uploads');*/
		if($_FILES['uploads']['name']){
		$data=array(
			'heads_name'=>$_POST['vendorcustomer_name'],
			'heads_category'=>$_POST['moneyInout'],
			'address'=>$_POST['vendorcustomer_address'],
			'phone'=>$_POST['vendorcustomer_phone'],
			'uploads'=>$this->image_upload('uploads',false,true),
			'custom_vender_status' => $_POST['status'],
			
		);

		}else{
			$data=array(
			'heads_name'=>$_POST['vendorcustomer_name'],
			'heads_category'=>$_POST['moneyInout'],
			'address'=>$_POST['vendorcustomer_address'],
			'phone'=>$_POST['vendorcustomer_phone'],
			'custom_vender_status' => $_POST['status'],
			
		);
		}
		$this->db->where('heads_id',$_POST['heads_id'])->update('tbl_heads',$data);
		
		if($this->db->affected_rows()){
			$response['status'] =  true;
			$response['msg'] =  "Heads added successfully!";
		}
		echo json_encode($response);
	}
	public function editLeave_request()//add profile setting 
	{
		get_update('tbl_leave',$_POST,'leave_id',$_POST['leave_id'],'Update leave');
	}
	public function changepassword_request()
	{
		$data=$this->db->where('USER_ID',$_POST['USER_ID'])->where('PASSWORD',$_POST['oldpassword'])->get('user_tbl')->row();
		if (empty($data)) {
			$response['status'] =  false;
			$response['msg'] =  "Old-password not matched!";
		}else{

			$data1=array('PASSWORD'=>$_POST['password'],
			'CONFIRM_PASSWORD'=>$_POST['confirmpassword'],
				
			);
			$this->db->where('USER_ID',$_POST['USER_ID'])->update('user_tbl',$data1);
			$response['status'] =  true;
			$response['msg'] =  "Password change successfully!";
		}
		
		echo json_encode($response);
	}
	public function profile_information_request()
	{
		$data=$this->db->where('user_id',$_POST['USER_ID'])->get('tbl_user_meta')->row();
		if (empty($data)) {
			$data1=array('gender'=>$_POST['gender'],
			'address'=>$_POST['address'],
			'country'=>$_POST['country'],
			'state'=>$_POST['state'],
			'user_id'=>$_POST['USER_ID'],
			);
			$this->db->insert('tbl_user_meta',$data1);
				if($_FILES['user_image']['name']){
					$data2=array('user_image'=>$this->image_upload('user_image',false,true),
					'USER_NAME'=>$_POST['USER_NAME'],
					'branch_id'=>implode('|', $_POST['branch_id']),
					'department_id'=>$_POST['department_id'],
					'designation_id'=>$_POST['designation_id'],
					);
					$this->db->where('user_id',$_POST['USER_ID'])->update('user_tbl',$data2);

				}else{
					$data3=array(
					'USER_NAME'=>$_POST['USER_NAME'],
					'branch_id'=>implode('|', $_POST['branch_id']),
					'department_id'=>$_POST['department_id'],
					'designation_id'=>$_POST['designation_id'],
					);
					$this->db->where('user_id',$_POST['USER_ID'])->update('user_tbl',$data3);
				}

			$response['status'] =  true;
			$response['msg'] =  "Update successfully!";
		}else{
			$data1=array('gender'=>$_POST['gender'],
			'address'=>$_POST['address'],
			'country'=>$_POST['country'],
			'state'=>$_POST['state'],
			);
			$this->db->where('user_id',$_POST['USER_ID'])->update('tbl_user_meta',$data1);

			if($_FILES['user_image']['name'] != ""){
					$data2=array('user_image'=>$this->image_upload('user_image',false,true),
					'USER_NAME'=>$_POST['USER_NAME'],
					'branch_id'=>implode('|', $_POST['branch_id']),
					'department_id'=>$_POST['department_id'],
					'designation_id'=>$_POST['designation_id'],
					);
					$this->db->where('user_id',$_POST['USER_ID'])->update('user_tbl',$data2);

				}else{
					$data3=array(
					'USER_NAME'=>$_POST['USER_NAME'],
					'branch_id'=>implode('|', $_POST['branch_id']),
					'department_id'=>$_POST['department_id'],
					'designation_id'=>$_POST['designation_id'],
					);
					$this->db->where('user_id',$_POST['USER_ID'])->update('user_tbl',$data3);
				}
			
			$response['status'] =  true;
			$response['msg'] =  "Update successfully!";
		}
		
		echo json_encode($response);
	}
	public function profile_information1_request()
	{
		$data=$this->db->where('user_id',$_POST['USER_ID'])->get('tbl_user_meta')->row();
		if (empty($data)) {
			$data1=array('dob'=>$_POST['dob'],
			'marital_status'=>$_POST['marital_status'],
			'user_id'=>$_POST['USER_ID'],
			);
			$this->db->insert('tbl_user_meta',$data1);
				
			$data3=array(
			'USER_PHONE'=>$_POST['USER_PHONE'],
			'employee_salary'=>$_POST['employee_salary'],
			'USER_EMAIL'=>$_POST['USER_EMAIL'],
			
			);
			$this->db->where('user_id',$_POST['USER_ID'])->update('user_tbl',$data3);
			$response['status'] =  true;
			$response['msg'] =  "Update successfully!";
		}else{
			$data1=array('dob'=>$_POST['dob'],
			'marital_status'=>$_POST['marital_status'],
			'user_id'=>$_POST['USER_ID'],
			);
			$this->db->where('user_id',$_POST['USER_ID'])->update('tbl_user_meta',$data1);

			$data3=array(
			'USER_PHONE'=>$_POST['USER_PHONE'],
			'employee_salary'=>$_POST['employee_salary'],
			'USER_EMAIL'=>$_POST['USER_EMAIL'],
			
			);
			$this->db->where('user_id',$_POST['USER_ID'])->update('user_tbl',$data3);
				
			
			$response['status'] =  true;
			$response['msg'] =  "Update successfully!";
		}
		
		echo json_encode($response);
	}
	public function bank_info_request()
	{
		$data=$this->db->where('user_id',$_POST['USER_ID'])->get('tbl_user_meta')->row();
		if (empty($data)) {
			$data1=array('bank_name'=>$_POST['bank_name'],
			'bank_account'=>$_POST['bank_account'],
			'ifsc_code'=>$_POST['ifsc_code'],
			'pan'=>$_POST['pan'],
			);
			$this->db->insert('tbl_user_meta',$data1);
				
			
			$response['status'] =  true;
			$response['msg'] =  "Update successfully!";
		}else{
			$data1=array('bank_name'=>$_POST['bank_name'],
			'bank_account'=>$_POST['bank_account'],
			'ifsc_code'=>$_POST['ifsc_code'],
			'pan'=>$_POST['pan'],
			);
			$this->db->where('user_id',$_POST['USER_ID'])->update('tbl_user_meta',$data1);

			$response['status'] =  true;
			$response['msg'] =  "Update successfully!";
		}
		
		echo json_encode($response);
	}

	public function editjournal_request(){
			$data=array(
				'date'=>date('Y-m-d',strtotime($_POST['date'])),
				'head_id'=>$_POST['head_id'],
				'moneyInOut'=>$_POST['moneyInOut'],
				/*'sub_head_id'=>$_POST['sub_head_id'],*/
				'method'=>$_POST['method'],
				/*'vendorCustomer'=>$_POST['vendorCustomer'],*/
				'amount'=>$_POST['amount'],
				'description'=>$_POST['description'],
				'branch_id'=>$_POST['branch'],
				'group_fk'=>$_POST['group_fk'],
				
			);
			$this->db->where('journal_id',$_POST['journal_id'])->update('tbl_journal',$data);
			
		

           if($this->db->affected_rows()){
				$response['status'] =  true;
				$response['msg'] =  "Entrie update successfully!";
			}else{
				$response['status'] =  false;
				$response['msg'] =  "Entrie update successfully!";
			}
		
		echo json_encode($response);
    
    }

    public function updateCapital_request(){
    	
			$data=array(
				'amount'=>$_POST['amount'] + $_POST['capital'],
			);
			$this->db->where('journal_id',$_POST['journal_id'])->update('tbl_journal',$data);
    		$data1=array(
				'date'=>date('Y-m-d'),
				'moneyInOut'=>1,
				'method'=>$_POST['method'],
				'oraganisation_id' => $_POST['oraganisation_id'],
				'amount'=>$_POST['amount'],

				'description'=>'opening balance',
				'status'=>3,
				
			);
			$this->db->insert('tbl_journal',$data1);

           if($this->db->affected_rows()){
				$response['status'] =  true;
				$response['msg'] =  "Capital update successfully!";
			}else{
				$response['status'] =  false;
				$response['msg'] =  "Capital update successfully!";
			}
		
		echo json_encode($response);
    
    }
    public function payrolledit_request()//add profile setting 
	{
		$checksalery = $this->db->where('user_id',$_POST['user_id'])->where('month',$_POST['month'])->where('year',$_POST['year'])->where('del_status',0)->from("tbl_payroll")->count_all_results();
		
			$data=array(
			'user_id'=>$_POST['user_id'],
			'month'=>$_POST['month'],
			'year'=>$_POST['year'],
			'salary'=>$_POST['salary'],
			'deduct_salary'=>$_POST['deductsalary'],
			'net_salary'=>$_POST['netsalary'],
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->where('payroll_id',$_POST['payroll_id'])->update('tbl_payroll',$data);
		$insert_id = $_POST['payroll_id'];
		$this->db->where('payroll_id',$insert_id)->delete('tbl_payroll_meta');
		foreach ($_POST['bonucs'] as $key => $value) {
			$data=array(
			'bonucs'=>$value,
			'bonucsremark'=>$_POST['bonucsremark'][$key],
			'deduction'=>$_POST['deduction'][$key],
			'deductionremark'=>$_POST['deductionremark'][$key],
			'payroll_id'=>$insert_id,
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_payroll_meta',$data);
		}
		$response['status'] =  true;
		$response['msg'] =  "Update successfully!";
		
			
		
		echo json_encode($response);
	}
	public function addopeningBank_request()//add profile setting 
	{
		$banksum=$this->db->where('bank_id',$_POST['bank_id'])->limit(1)->get('tbl_bank')->row();
		$data=array(
				'opening_balance'=>$_POST['opening_balance'] + $banksum->opening_balance,
			);
			$this->db->where('bank_id',$_POST['bank_id'])->update('tbl_bank',$data);
			$sum=$this->db->where('status',1)->limit(1)->get('tbl_journal')->row();
			$data1=array(
				'amount'=>$_POST['opening_balance'] + $sum->amount,
			);
			$this->db->where('journal_id',$sum->journal_id)->update('tbl_journal',$data1);
			$data1=array(
				'date'=>date('Y-m-d'),
				'moneyInOut'=>1,
				'method'=>$_POST['bank_id'],
				'oraganisation_id' => $_POST['oraganisation_id'],
				'amount'=>$_POST['opening_balance'],
				'description'=>'opening balance',
				'status'=>2,
				
				
			);
			$this->db->insert('tbl_journal',$data1);
           redirect('accountBank.html', 'refresh');
	}
    public function addheadopeningBank_request()//add profile setting 
	{
		$banksum=$this->db->where('heads_id',$_POST['heads_id'])->limit(1)->get('tbl_heads')->row();
		
		$data=array(
				'opening_balance'=>$_POST['opening_balance'] + $banksum->opening_balance,
			);
			$this->db->where('heads_id',$_POST['heads_id'])->update('tbl_heads',$data);
			$sum=$this->db->where('status',1)->limit(1)->get('tbl_journal')->row();
			if($_POST['heads_category'] == '1'){
			    	$data1=array(
				'amount'=>  $sum->amount - $_POST['opening_balance'],
			);
			}else{
			    $data1=array(
				'amount'=>  $sum->amount + $_POST['opening_balance'],
			);
			}
		
			$this->db->where('journal_id',$sum->journal_id)->update('tbl_journal',$data1);
			$data1=array(
				'date'=>date('Y-m-d'),
				'moneyInOut'=>$_POST['heads_category'],
				'head_id'=>$_POST['heads_id'],
				'oraganisation_id' => $_POST['oraganisation_id'],
				'amount'=>$_POST['opening_balance'],
				'description'=>'opening balance',
				'status'=>2,
				
				
			);
			$this->db->insert('tbl_journal',$data1);
           redirect('accountHead.html', 'refresh');
	}
	public function editcallerdata_request(){
	    
          $getserviceimage=$this->db->where('call_id',$_POST['call_id'])->get('tbl_call')->row_array();    
            
           
            
            if ($_FILES['gic']['error']==0){
            $gic= $this->image_upload('gic',false,true);
            }else{
            $gic=$getserviceimage['GIC'];
            } 
            
            if ($_FILES['sop']['error']==0){
            $sop= $this->image_upload('sop',false,true);
            }else{
            $sop=$getserviceimage['SOP'];
            } 
            
              if ($_FILES['lor']['error']==0){
            $lor= $this->image_upload('lor',false,true,"jpg|jpeg|png");
            }else{
            $lor=$getserviceimage['LOR'];
            } 
            
              if ($_FILES['fee_receipt']['error']==0){
            $FEERECEIPT= $this->image_upload('fee_receipt',false,true,"jpg|jpeg|png");
            }else{
            $FEERECEIPT=$getserviceimage['FEERECEIPT'];
            } 
            
            
	    
	    
	    
		
		$data=array(
		    'leadsource'=>$_POST['leadsource'],
		   //   'skillcat_id'=>$_POST['skillcat_id'],
			'name'=>$_POST['name'],
			'email'=>$_POST['email'],
			'phone'=>$_POST['phone'],
			'father_name'=>$_POST['fathername'],
			'address'=>$_POST['address'],
			'country'=>$_POST['country'],
			'state'=>$_POST['state'],
			'city'=>$_POST['city'],
			'dob'=>$_POST['dob'],
			'reference'=>$_POST['reference'],
			//'remark'=>$_POST['remark'],
			'status'=>$_POST['status'],
			'gender'=>$_POST['gender'],
			'age'=>$_POST['age'],
			'counselor_id'=>$_POST['counselor'],
			'language_score'=>$_POST['score'],
			'english_test'=>$_POST['english_test'],
			'reading'=>$_POST['reading'],
			'listening'=>$_POST['listening'],
			'writing'=>$_POST['writing'],
			'speaking'=>$_POST['speaking'],
			'previous_referral'=>$_POST['previous_referral'],
			'previous_country'=>$_POST['previous_country'],
			'percentageinenglish'=>$_POST['percentageinenglish'],
			'previoustravelhistory'=>$_POST['previoustravelhistory'],
			'previoustravelcountryyes'=>$_POST['previoustravelcountryyes'],
			'preferedCountry'=>$_POST['preferedCountry'],
			'preferedCity'=>$_POST['preferedCity'],
			'packageConsultancy'=>$_POST['packageConsultancy'],
			'packagetotalamount'=>$_POST['packagetotalamount'],
			'packagebeforevisa'=>$_POST['packagebeforevisa'],
			'packageinclude'=>$_POST['packageinclude'],
			'packageaftervisa'=>$_POST['packageaftervisa'],
			'consultancybeforevisa'=>$_POST['consultancybeforevisa'],
			'consultancyaftervisa'=>$_POST['consultancyaftervisa'],
			'extra_score'=>$_POST['extra_score'],
			'duolingo_text'=>$_POST['duolingo_text'],
			'passport'=>$_POST['passport'],
            'GIC'=>$gic,
            'SOP'=>$sop,
            'LOR'=>$lor,
            'FEERECEIPT'=>$FEERECEIPT,
			
		);
		$this->db->where('call_id',$_POST['call_id'])->update('tbl_call',$data);
		$this->db->where('call_id',$_POST['call_id'])->delete('tbl_remark');
		foreach ($_POST['remark'] as $key => $value) {
		$remarkData=array(
					'remark'=>$value,
					'call_id'=>$_POST['call_id'],
					'datetime'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_remark',$remarkData);
		}
		if(!empty($_POST['course'])){
		$this->db->where('call_id',$_POST['call_id'])->delete('tbl_call_meta');
			foreach ($_POST['course'] as $key => $value) {
				$data=array(
					'course'=>$value,
					'boardanduniversity'=>$_POST['boardanduniversity'][$key],
					'percentage'=>$_POST['percentage'][$key],
					'passingyear'=>$_POST['passingyear'][$key],
					'streamandother'=>$_POST['streamandother'][$key],
					'call_id'=>$_POST['call_id'],
					'datetime'=>date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_call_meta',$data);
				
			}

		}

           if($this->db->affected_rows()){
				$response['status'] =  true;
				$response['msg'] =  "Entrie added successfully!";
			}else{
				$response['status'] =  false;
				$response['msg'] =  "Entrie added successfully!";
			}
		echo json_encode($response);
    }
    public function edittages_request()//add profile setting 
	{
		get_update('tbl_status',$_POST,'status_id',$_POST['status_id'],'Update tag');
	}
	public function editboarduniversity_request()//add profile setting 
	{
		get_update('tbl_boardanduniversity',$_POST,'id',$_POST['id'],'Update board/university');
	}
	public function editstream_request()//add profile setting 
	{
		get_update('tbl_stream',$_POST,'stream_id',$_POST['stream_id'],'Update stream');
	}
	public function editclass_request()//add profile setting 
	{
		get_update('tbl_class',$_POST,'class_id',$_POST['class_id'],'Update class');
	}
		public function forgetchangepassword_request(){
			$data=array(
				'forgot_status'=>0,
					'PASSWORD'=>$_POST['password'],
			
				
			);
			$this->db->where('USER_ID',$_POST['USER_ID'])->update('user_tbl',$data);
			
		

           if($this->db->affected_rows()){
				$response['status'] =  true;
				$response['msg'] =  "Password update successfully!";
			}else{
				$response['status'] =  false;
				$response['msg'] =  "Entrie update successfully!";
			}
		
		echo json_encode($response);
    
    }
}
