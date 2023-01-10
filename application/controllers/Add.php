<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends MY_Controller {
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
    public function callerPaymentdata_request()//add profile setting 
	{
		get_insert('tbl_caller_payment',$_POST,'Payment add successfully!');
	}
    public function addBranch_request()//add profile setting 
	{
		get_insert('tbl_branch',$_POST,'Branch add successfully!','branch_logo');
	}
	public function addDepartment_request()//add profile setting 
	{
		get_insert('tbl_department',$_POST,'Department add successfully!');
	}
	public function addDesignation_request()//add profile setting 
	{
		get_insert('tbl_designation',$_POST,'Designation add successfully!');
	}
	public function addUser_request()//add profile setting 
	{
		$data=$this->db->where('USER_EMAIL',$_POST['USER_EMAIL'])->get('user_tbl')->row();
		if($data){
			$response['status'] =  false;
            $response['msg'] =  "Email already exist!";
		echo json_encode($response);
		}else{
			$data=array('branch_id'=>implode('|',$_POST['branch_id']),
			'USER_EMAIL'=>$_POST['USER_EMAIL'],
			'USER_NAME'=>$_POST['USER_NAME'],
			'user_last_name'=>$_POST['user_last_name'],
			
			'username'=>$_POST['username'],
			
			'PASSWORD'=>$_POST['PASSWORD'],
			'CONFIRM_PASSWORD'=>$_POST['CONFIRM_PASSWORD'],
			'USER_PHONE'=>$_POST['USER_PHONE'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'Joining_date'=>$_POST['Joining_date'],
			'department_id'=>$_POST['department_id'],
			'designation_id'=>$_POST['designation_id'],
			'employee_salary'=>$_POST['employee_salary'],
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('user_tbl',$data);
		$insert_id = $this->db->insert_id();
		$data1=array('user_id'=>$insert_id);
		$this->db->insert('tbl_user_meta',$data1);
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
		if($_POST['banking']){ 
			$arr17=implode('|',$_POST['banking']);
		}else{ 
			$arr17='0';
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
				'heads' => $arr9,
				'subHeads' => $arr10,
				'vendorCustomer' => $arr11,
				'journal' => $arr12,
				'ledger' => $arr13,
				'balanceSheet' => $arr14,
				'trialBalance' => $arr15,
				'ProfitLoss' => $arr16,
				'banking' => $arr17,
				'reception' => $arr18,
				'telecaller' => $arr19,
				'counselor' => $arr20,
				'admission' => $arr21,
				'coordinator' => $arr22,
				'USER_ID' => $insert_id,
				'PRIVILEGES_DATETIME'=>date('Y-m-d H:i:s'),
			 );
		$this->db->insert('privileges_tbl',$privilege);
		
			$response['status'] =  true;
			$response['msg'] =  "User add successfully!";
		
		echo json_encode($response);
		/*
		$replacements=array('branch_id' => implode('|',$_POST['branch_id']));
			$_POST = array_replace($_POST, $replacements);
*/
		//get_insert('user_tbl',$_POST,'User add successfully!');
		}
	}
	 
	public function addHolidays_request()//add profile setting 
	{
		get_insert('tbl_holidays',$_POST,'holidays added successfully!');
	}
	public function addLeave_request()//add profile setting 
	{
		get_insert('tbl_leave',$_POST,'Leave add successfully!');
	}
	public function calSalary_request()//add profile setting 
	{
		$checksalery = $this->db->where('user_id',$_POST['user_id'])->where('month',$_POST['month'])->where('year',$_POST['year'])->where('del_status',0)->from("tbl_payroll")->count_all_results();
		if($checksalery == 0){
			$data=array(
			'user_id'=>$_POST['user_id'],
			'month'=>$_POST['month'],
			'year'=>$_POST['year'],
			'salary'=>$_POST['salary'],
			'deduct_salary'=>$_POST['deductsalary'],
			'net_salary'=>$_POST['netsalary'],
			
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_payroll',$data);
		$insert_id = $this->db->insert_id();
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
		$response['msg'] =  "User add successfully!";
		}else{
			$response['status'] =  false;
		$response['msg'] =  "Already exist!";
		}
			
		
		echo json_encode($response);
	}
	public function addBank_request()//add profile setting 
	{
		get_insert('tbl_bank',$_POST,'Bank add successfully!');
	}
	public function addGroup_request()//add profile setting 
	{
		get_insert('tbl_group',$_POST,'Group add successfully!');
	}
	public function addHead_request()//add profile setting 
	{
		
		get_insert('tbl_heads',$_POST,'heads add successfully!','uploads');

	}
	public function addVendorCustomer_request()//add profile setting 
	{
		/*get_insert('tbl_vendorcustomer',$_POST,'Vendor & Customer add successfully!','vendorcustomer_uploads');*/
		if($_FILES['uploads']['name']){
		$data=array(
			'heads_name'=>$_POST['vendorcustomer_name'],
			'heads_category'=>$_POST['moneyInout'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'address'=>$_POST['vendorcustomer_address'],
			'phone'=>$_POST['vendorcustomer_phone'],
			'uploads'=>$this->image_upload('uploads',false,true),
			'group_status'=>1,
			'status'=>1,
			'custom_vender_status' => $_POST['status'],
			'DATETIME'=>date('Y-m-d H:i:s')
		);
	}else{
	$data=array(
			'heads_name'=>$_POST['vendorcustomer_name'],
			'heads_category'=>$_POST['moneyInout'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'address'=>$_POST['vendorcustomer_address'],
			'phone'=>$_POST['vendorcustomer_phone'],
			
			'group_status'=>1,
			'status'=>1,
			'custom_vender_status' => $_POST['status'],
			'DATETIME'=>date('Y-m-d H:i:s')
		);	
	}
		$this->db->insert('tbl_heads',$data);
		
		if($this->db->affected_rows()){
			$response['status'] =  true;
			$response['msg'] =  "Heads added successfully!";
		}
		echo json_encode($response);
	}
	public function addsubHead_request()//add profile setting 
	{
		
		$data=array(
			'heads_name'=>$_POST['sub_head_name'],
			'heads_category'=>$_POST['heads_category'],
			'heads_fk'=>$_POST['heads_fk'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'status'=>$_POST['status'],
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_heads',$data);
		
		if($this->db->affected_rows()){

			$response['status'] =  true;
			$response['msg'] =  "Heads added successfully!";
				}
		
		echo json_encode($response);
	}
	public function addJrvendor_request(){

$data=array(
			'vendorcustomer_name'=>$_POST['vendorcustomer_name'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'status'=>$_POST['status'],
			
			'datetime'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_vendorcustomer',$data);
		$insert_id = $this->db->insert_id();

           if($this->db->affected_rows()){

			$response['status'] =  true;
			$response['msg'] =  "Heads added successfully!";
			$response['id'] =  $insert_id;
			$response['name'] =  $_POST['vendorcustomer_name'];

				}else{
					$response['status'] =  false;
			$response['msg'] =  "Heads added successfully!";
				}
		
		echo json_encode($response);
    
    }
    public function addJrhead_request(){
		$data=array(
					'heads_name'=>$_POST['head_name'],
					'heads_category'=>$_POST['head_category'],
					'oraganisation_id'=>$_POST['oraganisation_id'],
					'DATETIME'=>date('Y-m-d H:i:s')
				);
		$this->db->insert('tbl_heads',$data);
		$res="";  
        $query=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $query2=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
            $res.= '<optgroup label="Money In">';
        foreach($query as $row){
                $res.= '<option value="'.$row->heads_id.'">'.$row->heads_name.'</option>';
        }
            $res.= '</optgroup>';
            $res.= '<optgroup label="Money Out">';
        foreach($query2 as $row){
                $res.= '<option value="'.$row->heads_id.'">'.$row->heads_name.'</option>';
        }
            $res.= '</optgroup>';
				
				
           $response['msg'] = $res;
		
		echo json_encode($response); 
    }
    public function addjrsubhead_request()//add profile setting 
	{

		$data=array(
			'heads_name'=>$_POST['sub_head_name'],
			'heads_category'=>$_POST['heads_category'],
			'heads_fk'=>$_POST['heads_fk'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_heads',$data);
		

		$res="";  
		
        $query=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $query2=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
            $res.= '<optgroup label="Money In">';
        foreach($query as $row){
        	if((int)$row->heads_id == (int)$_POST['heads_fk']){$sel= 'selected';}{$sel=$_POST['heads_fk'];}
        	
                $res.= '<option '.$sel.' value="'.$row->heads_id.'">'.$row->heads_name.'</option>';
        }
            $res.= '</optgroup>';
            $res.= '<optgroup label="Money Out">';
        foreach($query2 as $row){
        	if((int)$row->heads_id == (int)$_POST['heads_fk']){$sel= 'selected';}{$sel= $row->heads_id;}
        	
                $res.= '<option '.$sel.' value="'.$row->heads_id.'">'.$row->heads_name.'</option>';
        }
            $res.= '</optgroup>';
        $res1="";  
        $query3=$this->db->where('heads_fk',$_POST['heads_fk'])->where('subheads_fk',0)->get('tbl_heads')->result();
        foreach($query3 as $row){
            $query4=$this->db->where('subheads_fk',$row->heads_id)->get('tbl_heads')->result();
            $res1.= '<option value="'.$row->heads_id.'" >'.$row1->heads_name.'</option>';
             
            
        }
			$response['status'] =  true;
			$response['msg'] = $res;
			$response['sub'] = $res1;
				
		
		echo json_encode($response);
	}
	public function addjournal_request(){
		/*echo '<pre>';
		print_r($_POST);
		die();*/
		foreach ($_POST['date'] as $key => $value) {
$checkmoney = $this->db->where('heads_id',$_POST['head_id'][$key])->get('tbl_heads')->row();
			$data=array(
				'date'=>date('Y-m-d',strtotime($value)),
				'head_id'=>$_POST['head_id'][$key],
				'moneyInOut'=>$_POST['moneyInOut'][$key],
				/*'sub_head_id'=>$_POST['sub_head_id'][$key],*/
				'method'=>$_POST['method'][$key],
				'vendorCustomer'=>$checkmoney->group_status,
				'amount'=>$_POST['amount'][$key],
				'description'=>$_POST['description'][$key],
				'oraganisation_id'=>$_POST['oraganisation_id'],
				'branch_id'=>$_POST['branch'][$key],
				'group_fk'=>$checkmoney->group_fk,
				'datetime'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_journal',$data);
			
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

    public function addcontra_request(){
		/*echo '<pre>';
		print_r($_POST);
		die();*/
		
			$data=array(
				'date'=>date('Y-m-d',strtotime($_POST['date'])),
				'moneyInOut'=>'2',
				'method'=>$_POST['frommethod'],
				'amount'=>$_POST['amount'],
				'description'=>$_POST['description'],
				'oraganisation_id'=>$_POST['oraganisation_id'],
				'branch_id'=>$_POST['branch'],
				'refrence_id'=>$_POST['refId'],
				'datetime'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_journal',$data);
			$data1=array(
				'date'=>date('Y-m-d',strtotime($_POST['date'])),
				'moneyInOut'=>'1',
				'method'=>$_POST['tomethod'],
				'amount'=>$_POST['amount'],
				'description'=>$_POST['description'],
				'oraganisation_id'=>$_POST['oraganisation_id'],
				'branch_id'=>$_POST['branch'],
				'refrence_id'=>$_POST['refId'],
				'datetime'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_journal',$data1);

           if($this->db->affected_rows()){
				$response['status'] =  true;
				$response['msg'] =  "Entrie added successfully!";
			}else{
				$response['status'] =  false;
				$response['msg'] =  "Entrie added successfully!";
			}
		
		echo json_encode($response);
    
    }
    public function educationInformation_request(){
		$this->db->where('user_id',$_POST['user_id'])->delete('tbl_education');
		foreach ($_POST['institution'] as $key => $value) {

			$data=array(
				'institution'=>$value,
				'subject'=>$_POST['subject'][$key],
				'startdate'=>$_POST['startdate'][$key],
				'enddate'=>$_POST['enddate'][$key],
				'degree'=>$_POST['degree'][$key],
				'grade'=>$_POST['grade'][$key],
				'user_id'=>$_POST['user_id'],
				'datetime'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_education',$data);
			
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
	public function experienceInformation_request(){
		/*print_r($_POST);
		die();*/
		$this->db->where('user_id',$_POST['user_id'])->delete('tbl_experience');
		foreach ($_POST['name'] as $key => $value) {

			$data=array(
				'name'=>$value,
				'location'=>$_POST['location'][$key],
				'position'=>$_POST['position'][$key],
				'datefrom'=>$_POST['from'][$key],
				'dateto'=>$_POST['to'][$key],
				
				'user_id'=>$_POST['user_id'],
				'datetime'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_experience',$data);
			
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

    public function addcalldata_request(){
     
		$data=array(
		    'leadsource'=>$_POST['leadsource'],
            'skillcat_id'=>$_POST['skillcat_id'],
			'name'=>$_POST['name'],
			'email'=>$_POST['email'],
			'phone'=>$_POST['phone'],
			'father_name'=>$_POST['fathername'],
			'address'=>$_POST['address'],
			'country'=>$_POST['country'],
			'state'=>$_POST['state'],
			'city'=>$_POST['city'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'dob'=>$_POST['dob'],
			'reference'=>$_POST['reference'],
			//'remark'=>$_POST['remark'],
			'status'=>$_POST['status'],
			'gender'=>$_POST['gender'],
			'age'=>$_POST['age'],
			'user_id'=>$_POST['user_id'],
			//'counselor_id'=>$_POST['counselor'],
			'marital_status'=>$_POST['marital_status'],
			'language_score'=>isset($_POST['score']) ? $_POST['score'] : '',
			'english_test'=>$_POST['english_test'],
			'reading'=>$_POST['reading'],
			'listening'=>$_POST['listening'],
			'writing'=>$_POST['writing'],
			'speaking'=>$_POST['speaking'],
			'usertype'=>$_POST['type'],
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
			  /* 'GIC'=>$this->image_upload('gic',false,true),
            'SOP'=>$this->image_upload('sop',false,true),
            'LOR'=>$this->image_upload('lor',false,true),
            'FEERECEIPT'=>$this->image_upload('fee_receipt',false,true),*/
			'datetime'=>date('Y-m-d')
		);
		
	
		$this->db->insert('tbl_call',$data);
		$insert_id = $this->db->insert_id();
		$data1=array(
			'fileno'=>date('m').date('y').$insert_id,
			);
		$this->db->where('call_id',$insert_id)->update('tbl_call',$data1);
		$remarkData=array(
					'remark'=>$_POST['remark'],
					'call_id'=>$insert_id,
					'datetime'=>date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_remark',$remarkData);
		if(!empty($_POST['course'])){
			foreach ($_POST['course'] as $key => $value) {
				$data=array(
					'course'=>$value,
					'boardanduniversity'=>$_POST['boardanduniversity'][$key],
					'percentage'=>$_POST['percentage'][$key],
					'passingyear'=>$_POST['passingyear'][$key],
					'streamandother'=>$_POST['streamandother'][$key],
					'call_id'=>$insert_id,
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
     public function addcalldatacouns_request(){
           
    	
		$data=array(
			'name'=>$_POST['name'],
			'email'=>$_POST['email'],
			'phone'=>$_POST['phone'],
			'father_name'=>$_POST['fathername'],
			'address'=>$_POST['address'],
			'country'=>$_POST['country'],
			'state'=>$_POST['state'],
			'city'=>$_POST['city'],
			'oraganisation_id'=>$_POST['oraganisation_id'],
			'dob'=>$_POST['dob'],
			'reference'=>$_POST['reference'],
			//'remark'=>$_POST['remark'],
			'status'=>$_POST['status'],
			'gender'=>$_POST['gender'],
			'age'=>$_POST['age'],
			'user_id'=>$_POST['user_id'],
			'counselor_id'=>$_POST['counselor'],
			'marital_status'=>$_POST['marital_status'],
			'language_score'=>$_POST['score'],
			'english_test'=>$_POST['english_test'],
			'reading'=>$_POST['reading'],
			'listening'=>$_POST['listening'],
			'writing'=>$_POST['writing'],
			'speaking'=>$_POST['speaking'],
			'usertype'=>$_POST['type'],
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
			'passport'=>$_POST['passport'],
         
			
			'datetime'=>date('Y-m-d')
		);
		$this->db->insert('tbl_call',$data);
		$insert_id = $this->db->insert_id();
		$data1=array(
			'fileno'=>date('m').date('y').$insert_id,
			);
		$this->db->where('call_id',$insert_id)->update('tbl_call',$data1);
		$remarkData=array(
					'remark'=>$_POST['remark'],
					'call_id'=>$insert_id,
					'datetime'=>date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_remark',$remarkData);
		if(!empty($_POST['course'])){
			foreach ($_POST['course'] as $key => $value) {
				$data=array(
					'course'=>$value,
					'boardanduniversity'=>$_POST['boardanduniversity'][$key],
					'percentage'=>$_POST['percentage'][$key],
					'passingyear'=>$_POST['passingyear'][$key],
					'streamandother'=>$_POST['streamandother'][$key],
					'call_id'=>$insert_id,
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
    public function addtages_request()//add profile setting 
	{
		get_insert('tbl_status',$_POST,'Tag add successfully!');
	}
	public function addclass_request()//add profile setting 
	{
		get_insert('tbl_class',$_POST,'Class add successfully!');
	}
	public function addStream_request()//add profile setting 
	{
		get_insert('tbl_stream',$_POST,'Stream add successfully!');
	}
	public function addboarduniversity_request()//add profile setting 
	{
		get_insert('tbl_boardanduniversity',$_POST,'Board/University add successfully!');
	}
	public function addAddmission_request(){
	  
	$this->db->where('call_id',$_POST['call_id'])->delete('tbl_admission_meta');
        $getdata=$this->db->where('call_id',$_POST['call_id'])->get('tbl_admission_meta')->row();
        
        
       $getdataattachment= $this->db->where('call_id',$_POST['call_id'])->get('tbl_attachment')->row();
    
        if(!empty($getdataattachment->call_id)){
     if($_FILES['productimg']['error'][0]==0){
        $picture1=$this->image_upload('productimg',true,true,"jpg|jpeg|png");
        $title1=implode("|", $_POST['productitle']); 
            if($getdataattachment->attachment_doc!=""){
                $picture= $getdataattachment->attachment_doc.'|'.$picture1;
                  $title= $getdataattachment->title.'|'.$title1;
            }else{
                $picture= $picture1;
                $title= $title1;
            }
        }else{
            $picture=$getdataattachment->attachment_doc;
            $title= $getdataattachment->title;
        }
        
        }else{
             $picture=$this->image_upload('productimg',true,true,"jpg|jpeg|png");
             $title= implode("|", $_POST['productitle']);
            
        }
		    
		$data11=array(
            'call_id'=>$_POST['call_id'],
            'title'=>$title,
            'attachment_doc'=>$picture,
		    );
		    
            $this->db->select('*');
            $this->db->from('tbl_attachment');
            $this->db->where('call_id', $_POST['call_id']);
            $total = $this->db->count_all_results();   
		if($total<=0){
		  $this->db->insert('tbl_attachment',$data11);
		  
		}else{
		   $this->db->where('call_id',$_POST['call_id'])->update('tbl_attachment',$data11);
		 
		}
		
		
	
		
		if(!empty($_POST['college_name'])){
		    if(!empty($_POST['admissionstatus'])){
		        $getimages=$this->image_upload('affidavit_file',true,true);
		        $imgarr=explode('|',$getimages);
		    }
			foreach ($_POST['college_name'] as $key => $value) {
			    if(!empty($imgarr)){
			        if(isset($imgarr[$key]) && $imgarr[$key]){
			            $getimg=$this->db->where('IMAGE_ID',$imgarr[$key])->get('images_tbl')->row();
			             $myimg=$getimg->IMAGE_PATH;
			        }else{
			            $myimg="";
			        }
			       
			    }else{
			        $myimg="";
			    }
			    
	        
			    
				$data=array(
			'call_id'=>$_POST['call_id'],
			'admissionstatus'=>$_POST['admissionstatus'],
			'statusfield'=>$_POST['status'],
			'college_name'=>$value,
			'college_campus'=>$_POST['college_campus'][$key],
			'course_name'=>$_POST['course_name'][$key],
			'course_start_date'=>$_POST['course_start_date'][$key],
			'course_end_date'=>$_POST['course_end_date'][$key],
			'intake'=>$_POST['intake'][$key],
			'offer_letter_applied_date'=>$_POST['offer_letter_applied_date'][$key],
			'offer_letter_recevied_date'=>$_POST['offer_letter_recevied_date'][$key],
			'fee_payment_date'=>$_POST['fee_payment_date'][$key],
			'loa_applied_date'=>$_POST['loa_applied_date'][$key],
			'loa_recevied_date'=>$_POST['loa_recevied_date'][$key],
			'file_sent_embassy_date'=>$_POST['file_sent_embassy_date'][$key],
			
			'fund_by'=>$_POST['fund_by'][$key],
			'required_fund'=>$_POST['required_fund'][$key],
			'fund_deposit'=>$_POST['fund_deposit'][$key],
			'fund_deposit_date'=>$_POST['fund_deposit_date'][$key],
			
			'packageamount_received'=>$_POST['packageamount_received'][$key],
			'packageamount_on_date'=>$_POST['packageamount_on_date'][$key],
			'affidavite_received'=>$_POST['affidavite_received'][$key],
			'account_open'=>$_POST['account_open'][$key],
			'account_name'=>$_POST['account_name'][$key],
			'account_number'=>$_POST['account_number'][$key],
			'account_ifsccode'=>$_POST['account_ifsccode'][$key],
			'account_bankname'=>$_POST['account_bankname'][$key],
			'need_application_withdraw_date'=>$_POST['need_application_withdraw_date'][$key],
			'affidavit_file'=>$myimg,
		//	'attachment_title'=>$title,
		//	'attachment_doc'=>$picture,
			'datetime'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_admission_meta',$data);
				
			}
    $response['status'] =  true;
			$response['msg'] =  "Insert done!";
		}else{
			$response['status'] =  false;
			$response['msg'] =  "Data is empty!";
		}
		
	
		echo json_encode($response);
    }
    public function addRemark_request()//add profile setting 
	{
		get_insert('tbl_remark',$_POST,'Remark add successfully!');
	}
	
	  public function addskiiledformrequest()//add profile setting 
	{
	   // echo "ddgfgf";
	get_insert('skilledcategory',$_POST,'skilled add successfully!');
//	print_r($_POST);
/*		$data=array(
			'call_id'=>$_POST['status'],
			'admissionstatus'=>$_POST['admissionstatus'],
			'college_name'=>$value,
			);
			$this->db->insert('tbl_admission_meta',$data);
            if($this->db->affected_rows()>0){
            $response['status'] =  true;
            $response['msg'] =  "Insert done!";
            }else{
            $response['status'] =  false;
            $response['msg'] =  "Data is empty!";
            }*/
	
	}
	
	
	public function deleteProductImagesRequest()
        {
            $blog = $this->db->where('id',$_POST['prodid'])->get('tbl_attachment')->row_array();
            $img = explode("|",$blog['attachment_doc']);
            if (($key = array_search($_POST['ImgId'], $img)) !== false) {
               unset($img[$key]);
            }
             $title = explode("|",$blog['title']);
            if (($key = array_search($_POST['title'], $title)) !== false) {
               unset($title[$key]);
            }
            $this->db->where('id',$_POST['prodid'])->update("tbl_attachment",array('attachment_doc'=>implode("|",$img)));
             $this->db->where('id',$_POST['prodid'])->update("tbl_attachment",array('title'=>implode("|",$title)));
            $imageData=$this->db->where('IMAGE_ID',$_POST['ImgId'])->get('images_tbl')->row_array();
            unlink($imageData['IMAGE_PATH']);
            $this->db->where('IMAGE_ID',$_POST['ImgId'])->delete('images_tbl');
            if ($this->db->affected_rows()){
            $response['status'] = true;
            $response['msg'] = "Attachment Deleted";
            }else{
            $response['status'] = false;
            $response['code'] = "Error Code : CX001";
            $response['msg'] = "Unable to process your Request";
            }
            
            echo json_encode($response);
        
      
        }
}
