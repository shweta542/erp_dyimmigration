<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	private $adminID; 
	private $adminData;

	function __construct()
	{
		parent::__construct();
		$this->adminID = $this->session->userdata('topic_admin');
		$this->adminData = $this->db->where('ADMIN_ID',$this->adminID)->get('ADMIN_TBL')->row_array();
	}
	public function cleanUrl($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
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
            'allowed_types' => 'jpg|jpeg|png',
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
	                $this->db->insert('IMAGES_TBL',array('IMAGE_PATH'=>$full_path,'IMAGE_TIMESTAMP'=>date('Y-m-d H:i:s')));
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
                    return $full_path; 
                }else{
                    $this->db->insert('IMAGES_TBL',array('IMAGE_PATH'=>$full_path,'IMAGE_TIMESTAMP'=>date('Y-m-d H:i:s')));
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
	public function editprofile_request()
	{
		$data = array(
				'ADMIN_NAME'=>$_POST['ADMIN_NAME'],
				'ADMIN_EMAIL'=>$_POST['ADMIN_EMAIL'],
				'ADMIN_PHONE'=>$_POST['ADMIN_PHONE']
			);

		$this->db->where('ADMIN_ID',$this->adminID)->update('ADMIN_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Profile Updated";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : AX001";
			$response['msg'] =  "No Change Occur";
		}

		echo json_encode($response);
	}

	public function changepassword_request()
	{

		if ($this->adminData['ADMIN_PASSWORD']==$_POST['ADMIN_PASSWORD_CURRENT']) {

			$this->db->where('ADMIN_ID',$this->adminID)->update('ADMIN_TBL',array('ADMIN_PASSWORD'=>$_POST['ADMIN_PASSWORD']));

			if ($this->db->affected_rows()) {
				$response['status'] = true;
				$response['msg'] =  "Password Updated";
			}else{
				$response['status'] = false;
				$response['code'] =  "Error Code : BX002";
				$response['msg'] =  "No Change Occur";
			}
		}else{
			$response['status'] = false;
			$response['code'] =  "Error Code : BX001";
			$response['msg'] =  "Current Password not matched";
		}

		echo json_encode($response);
	}
	public function editsmtp_request()
	{
		$data=array('SMTP_HOST'=>$_POST['SMTP_HOST'],
			'SMTP_PORT'=>$_POST['SMTP_PORT'],
			'SMTP_EMAIL'=>$_POST['SMTP_EMAIL'],
			'SMTP_PASSWORD'=>$_POST['SMTP_PASSWORD']
			);
		
		$this->db->where('SMTP_ID',1)->update('SMTP_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "SMTP Updated";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : DX001";
			$response['msg'] =  "No change occur";
		}

		echo json_encode($response);
	}
	public function addcategory_request()
	{
		$data=array('CATEGORY_NAME'=>$_POST['CATEGORY_NAME'],
			'CATEGORY_DESCRIPTION'=>$_POST['CATEGORY_DESCRIPTION'],
			'CATEGORY_ICON'=>$_POST['CATEGORY_ICON'],
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'CATEGORY_SLUG'=>$this->cleanUrl($_POST['CATEGORY_NAME']),
			'DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('CATEGORY_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Category Added";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function editCategory_request()
	{
		$data=array('CATEGORY_NAME'=>$_POST['CATEGORY_NAME'],
			'CATEGORY_DESCRIPTION'=>$_POST['CATEGORY_DESCRIPTION'],
			'CATEGORY_ICON'=>$_POST['CATEGORY_ICON'],
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'CATEGORY_SLUG'=>$this->cleanUrl($_POST['CATEGORY_NAME']),
			
		);
		$this->db->where('CATEGORY_ID',$_POST['CATEGORY_ID'])->update('CATEGORY_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Category Updated";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : DX001";
			$response['msg'] =  "No change occur";
		}

		echo json_encode($response);
	}
	public function deleteCategory_request()
	{
		$this->db->where('CATEGORY_ID',$_POST['CATEGORY_ID'])->delete('CATEGORY_TBL');

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Category Deleted";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function addsubcategory_request()
	{
		$data=array('CATEGORY_ID'=>$_POST['CATEGORY_ID'],
			'SUB_CATEGORY_NAME'=>$_POST['SUB_CATEGORY_NAME'],
			'SUB_CATEGORY_DESCRIPTION'=>$_POST['SUB_CATEGORY_DESCRIPTION'],
			'SUB_CATEGORY_TITLE'=>$_POST['SUB_CATEGORY_TITLE'],
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'SLUG'=>$this->cleanUrl($_POST['SUB_CATEGORY_NAME']),
			'IMAGE'=>$this->adminModel->image_upload('UPLOAD_IMAGE',false,true,"jpg|jpeg|png"),
			'SUB_CATEGORY_DATETIME'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('SUB_CATEGORY_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Sub-Category Added";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function editsubcategory_request()
	{
		//var_dump($_FILES);
		if ($_FILES['UPLOAD_IMAGE']['name']=="") {
		$data=array('CATEGORY_ID'=>$_POST['CATEGORY_ID'],
			'SUB_CATEGORY_NAME'=>$_POST['SUB_CATEGORY_NAME'],
			'SUB_CATEGORY_DESCRIPTION'=>$_POST['SUB_CATEGORY_DESCRIPTION'],
			'SUB_CATEGORY_TITLE'=>$_POST['SUB_CATEGORY_TITLE'],
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			
			'SLUG'=>$this->cleanUrl($_POST['SUB_CATEGORY_NAME'])
		);
	}else{
		$data=array('CATEGORY_ID'=>$_POST['CATEGORY_ID'],
			'SUB_CATEGORY_NAME'=>$_POST['SUB_CATEGORY_NAME'],
			'SUB_CATEGORY_DESCRIPTION'=>$_POST['SUB_CATEGORY_DESCRIPTION'],
			'SUB_CATEGORY_TITLE'=>$_POST['SUB_CATEGORY_TITLE'],
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'IMAGE'=>$this->adminModel->image_upload('UPLOAD_IMAGE',false,true,"jpg|jpeg|png"),
			'SLUG'=>$this->cleanUrl($_POST['SUB_CATEGORY_NAME'])
		);
	}
		$this->db->where('SUB_CATEGORY_ID',$_POST['SUB_CATEGORY_ID'])->update('SUB_CATEGORY_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Sub-Category Update";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function deletesubcategory_request()
	{
		$this->db->where('SUB_CATEGORY_ID',$_POST['SUB_CATEGORY_ID'])->delete('SUB_CATEGORY_TBL');

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Sub-Category Deleted";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function updateabout_request()
	{
		$data = array(
					'MESSAGE'=>$_POST['ABOUT_MESSAGE'],
				);
		$this->db->where('PAGES_ID',1)->update('PAGES_ADMIN_TBL',$data);
		
		if ($this->db->affected_rows()) {
			$response['status'] = true;
			$response['msg'] = "Pages is Updated successfully";
		}else{
			$response['status'] = false;
			$response['code'] = "Error Code : T4cX001";
			$response['msg'] = "Pages is Updated successfully";
		}

		echo json_encode($response);
	}
	public function addBanner_request()
	{
		
		$data=array('TITTLE'=>$_POST['TITLE'],
			
			'DESCRIPTION'=>$_POST['DESCRIPTION'],
			'READ_MORE'=>$_POST['READ_MORE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'SEO_TITTLE'=>$_POST['SEO_TITTLE'],
			'BANNER_IMAGE'=>$this->adminModel->image_upload('BANNER_IMAGE',false,true,"jpg|jpeg|png"),
			
		);

		$this->db->insert('BANNER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Banner Added";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function editBanner_request()
	{
		if ($_FILES['BANNER_IMAGE']['error']==0) {
		$data=array('TITTLE'=>$_POST['TITLE'],
		
			'DESCRIPTION'=>$_POST['DESCRIPTION'],
			'READ_MORE'=>$_POST['READ_MORE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'SEO_TITTLE'=>$_POST['SEO_TITLE'],
			'BANNER_IMAGE'=>$this->adminModel->image_upload('BANNER_IMAGE',false,true,"jpg|jpeg|png")
		);
		}else{
			$data=array('TITTLE'=>$_POST['TITLE'],
			
			'DESCRIPTION'=>$_POST['DESCRIPTION'],
			'READ_MORE'=>$_POST['READ_MORE'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'SEO_TITTLE'=>$_POST['SEO_TITLE']
		);
		}

		$this->db->where('BANNER_ID',$_POST['BANNER_ID'])->update('BANNER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Banner Updated";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "No Change Occur";
		}

		echo json_encode($response);
	}
	public function deleteBanner_request()
	{
		$this->db->where('BANNER_ID',$_POST['BANNER_ID'])->delete('BANNER_TBL');

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Banner Deleted";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "No Change Occur";
		}

		echo json_encode($response);
	}
	public function editGeneral_request()
	{
		if ($_FILES['LOGO']['error']==0) {
		$data=array('EMAIL'=>$_POST['EMAIl'],
			'PHONE'=>$_POST['PHONE'],
			'ADDRESS'=>$_POST['ADDRESS'],
			'FACEBOOK_LINK'=>$_POST['FACEBOOK_LINK'],
			'TWITTER_LINK'=>$_POST['TWITTER_LINK'],
			'GOOGLE_PLUS_LINK'=>$_POST['GOOGLE_PLUS_LINK'],
			'PINTEREST_LINK'=>$_POST['PINTEREST_LINK'],
			'INSTAGRAM_LINK'=>$_POST['INSTAGRAM_LINK'],
			'YOUTUBE_LINK'=>$_POST['YOUTUBE_LINK'],
			'LOGO'=>$this->adminModel->image_upload('LOGO',false,true,"jpg|jpeg|png"),
			'FOOTER_ABOUT'=>$_POST['FOOTER_ABOUT'],
			'SECTION_FIRST'=>$_POST['SECTION_FIRST'],
			'SECTION_SECOND'=>$_POST['SECTION_SECOND'],
			'NEWS_LETTER'=>$_POST['NEWS_LETTER'],
			'SECTION_THIRD'=>$_POST['SECTION_THIRD']
			
		);
		}else{
			$data=array('EMAIL'=>$_POST['EMAIl'],
			'PHONE'=>$_POST['PHONE'],
			'ADDRESS'=>$_POST['ADDRESS'],
			'FACEBOOK_LINK'=>$_POST['FACEBOOK_LINK'],
			'TWITTER_LINK'=>$_POST['TWITTER_LINK'],
			'GOOGLE_PLUS_LINK'=>$_POST['GOOGLE_PLUS_LINK'],
			'PINTEREST_LINK'=>$_POST['PINTEREST_LINK'],
			'INSTAGRAM_LINK'=>$_POST['INSTAGRAM_LINK'],
			'YOUTUBE_LINK'=>$_POST['YOUTUBE_LINK'],
			//'LOGO'=>$this->adminModel->image_upload('LOGO',false,true,"jpg|jpeg|png"),
			'FOOTER_ABOUT'=>$_POST['FOOTER_ABOUT'],
			'SECTION_FIRST'=>$_POST['SECTION_FIRST'],
			'SECTION_SECOND'=>$_POST['SECTION_SECOND'],
			'NEWS_LETTER'=>$_POST['NEWS_LETTER'],
			'SECTION_THIRD'=>$_POST['SECTION_THIRD']
		);
		}

		$this->db->where('GENERAL_ID',$_POST['GENERAL_ID'])->update('GENERAL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Home Setting Updated";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "No Change Occur";
		}

		echo json_encode($response);
	}
	public function deleteNewsletter_request()
	{
		$this->db->where('NEWS_LETTER_ID',$_POST['NEWS_LETTER_ID'])->delete('NEWS_LETTER_TBL');

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "News Letter Deleted";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function unblock_request()
	{
		$data = array('STATUS' =>$_POST['STATUS'] );
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('USER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "User Unblock";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function block_request()
	{
		$data = array('STATUS' => $_POST['STATUS'] );
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('USER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "User block";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function unverify_request()
	{
		$data = array('USER_VERIFY' => $_POST['STATUS'] );
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('USER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "User unverify";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function verify_request()
	{
		$data = array('USER_VERIFY' => $_POST['STATUS'] );
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('USER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "User unverify";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function deleteuser_request()
	{
		$data = array('USER_DELETE' => $_POST['STATUS'] );
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('USER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "User Un-Block";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function deleteuserback_request()
	{
		$data = array('USER_DELETE' => $_POST['STATUS'] );
		$this->db->where('USER_ID',$_POST['USER_ID'])->update('USER_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "User Blocked";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function addproduct_request()
	{
		
		$data=array('PRODUCT_NAME'=>$_POST['PRODUCT_NAME'],
			'SUB_CATEGORY_ID'=>$_POST['SUB_CATEGORY_ID'],
			'CATEGORY_ID'=>$_POST['CATEGORY_ID'],
			'PRODUCT_TITLE'=>$_POST['PRODUCT_TITLE'],
			'PRODUCT_ICON'=>$_POST['PRODUCT_ICON'],
			'PRODUCT_DESCRIPTION'=>$_POST['PRODUCT_DESCRIPTION'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			'PRODUCT_SLUG'=>$this->cleanUrl($_POST['PRODUCT_NAME']),
			'PRODUCT_IMAGE'=>$this->adminModel->image_upload('PRODUCT_IMAGE',false,true,"jpg|jpeg|png"),
			
		);

		$this->db->insert('PRODUCT_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Product Added";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function editproduct_request()
	{
		if ($_FILES['PRODUCT_IMAGE']['name']=="") {

		$data=array('PRODUCT_NAME'=>$_POST['PRODUCT_NAME'],
			'SUB_CATEGORY_ID'=>$_POST['SUB_CATEGORY_ID'],
			'CATEGORY_ID'=>$_POST['CATEGORY_ID'],
			'PRODUCT_TITLE'=>$_POST['PRODUCT_TITLE'],
			'PRODUCT_ICON'=>$_POST['PRODUCT_ICON'],
			'PRODUCT_DESCRIPTION'=>$_POST['PRODUCT_DESCRIPTION'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'PRODUCT_SLUG'=>$this->cleanUrl($_POST['PRODUCT_NAME']),
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			
			
		);
		}else{
			$data=array('PRODUCT_NAME'=>$_POST['PRODUCT_NAME'],
			'SUB_CATEGORY_ID'=>$_POST['SUB_CATEGORY_ID'],
			'CATEGORY_ID'=>$_POST['CATEGORY_ID'],
			'PRODUCT_TITLE'=>$_POST['PRODUCT_TITLE'],
			'PRODUCT_ICON'=>$_POST['PRODUCT_ICON'],
			'PRODUCT_DESCRIPTION'=>$_POST['PRODUCT_DESCRIPTION'],
			'SEO_KEYWORD'=>$_POST['SEO_KEYWORD'],
			'SEO_DESCRIPTION'=>$_POST['SEO_DESCRIPTION'],
			'SEO_TITLE'=>$_POST['SEO_TITLE'],
			'PRODUCT_SLUG'=>$this->cleanUrl($_POST['PRODUCT_NAME']),
			'PRODUCT_IMAGE'=>$this->adminModel->image_upload('PRODUCT_IMAGE',false,true,"jpg|jpeg|png"),
			
		);
		}
		

		$this->db->where('PRODUCT_ID',$_POST['PRODUCT_ID'])->update('PRODUCT_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Product Updated";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function deleteproduct_request()
	{
		
		$this->db->where('PRODUCT_ID',$_POST['PRODUCT_ID'])->delete('PRODUCT_TBL');

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Product Deleted";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function addconsultant_request()
	{
		
		$data=array('NAME'=>$_POST['NAME'],
			'QUALIFICATION'=>$_POST['QUALIFICATION'],
			'FACEBOOK'=>$_POST['FACEBOOK'],
			'TWITTER'=>$_POST['TWITTER'],
			'SKYPE'=>$_POST['SKYPE'],
			'INSTAGRAM'=>$_POST['INSTAGRAM'],
			
			'IMAGE'=>$this->adminModel->image_upload('IMAGE',false,true,"jpg|jpeg|png"),
			
		);

		$this->db->insert('CONSULTANT_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Consultant Added";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function editconsultant_request()
	{
		if ($_FILES['IMAGE']['name']=="") {

		$data=array('NAME'=>$_POST['NAME'],
			'QUALIFICATION'=>$_POST['QUALIFICATION'],
			'FACEBOOK'=>$_POST['FACEBOOK'],
			'TWITTER'=>$_POST['TWITTER'],
			'SKYPE'=>$_POST['SKYPE'],
			'INSTAGRAM'=>$_POST['INSTAGRAM'],
		);
		}else{
			$data=array('NAME'=>$_POST['NAME'],
			'QUALIFICATION'=>$_POST['QUALIFICATION'],
			'FACEBOOK'=>$_POST['FACEBOOK'],
			'TWITTER'=>$_POST['TWITTER'],
			'SKYPE'=>$_POST['SKYPE'],
			'INSTAGRAM'=>$_POST['INSTAGRAM'],
			'IMAGE'=>$this->adminModel->image_upload('IMAGE',false,true,"jpg|jpeg|png"),
			
		);
		}
		$this->db->where('CONSULTANT_ID',$_POST['CONSULTANT_ID'])->update('CONSULTANT_TBL',$data);

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Consultant Updated";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : CX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function deleteconsultant_request()
	{
		
		$this->db->where('CONSULTANT_ID',$_POST['CONSULTANT_ID'])->delete('CONSULTANT_TBL');

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Consultant Deleted";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	public function deleteContact_request()
	{
		
		$this->db->where('CONTACT_ID',$_POST['CONTACT_ID'])->delete('CONTACT_TBL');

		if ($this->db->affected_rows()) {
			$response['status'] =  true;
			$response['msg'] =  "Contact Deleted";
		}else{
			$response['status'] =  false;
			$response['code'] =  "Error Code : EX001";
			$response['msg'] =  "Unable to process your Request";
		}

		echo json_encode($response);
	}
	
}