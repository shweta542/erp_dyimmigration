<?php 
 function image_upload($index,$multiple=false,$getpath=false)
    {
         $ci=& get_instance();
        $ci->load->database();
        
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

        $ci->upload->initialize($config);

        if ($multiple) {
            $filesCount = count($_FILES[$index]['name']);
            for($i = 0; $i < ($filesCount); $i++)
            {
                $_FILES['userFile']['name'] = $_FILES[$index]['name'][$i];
                $_FILES['userFile']['type'] = $_FILES[$index]['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES[$index]['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES[$index]['error'][$i];
                $_FILES['userFile']['size'] = $_FILES[$index]['size'][$i];

                if($ci->upload->do_upload('userFile'))
                {
                    $upload_data =$ci->upload->data();
                    $full_path = substr($config['upload_path'],2).'/'.$upload_data['file_name'];
                    $ci->db->insert('images_tbl',array('IMAGE_PATH'=>$full_path,'IMAGE_TIMESTAMP'=>date('Y-m-d H:i:s')));
                    $insertedids[] = $ci->db->insert_id();
                }
                else
                {
                    $error = array('error' => $ci->upload->display_errors());
                    //print_r($multiple);
                }
            }
        }else{
            if($ci->upload->do_upload($index))
            {
                $upload_data =$ci->upload->data();
                $full_path = substr($config['upload_path'],2).'/'.$upload_data['file_name'];
                if($getpath){
                    return $full_path; 
                }else{
                    $ci->db->insert('images_tbl',array('IMAGE_PATH'=>$full_path,'IMAGE_TIMESTAMP'=>date('Y-m-d H:i:s')));
                    $insertedids[] = $ci->db->insert_id();
                }
            }
            else
            {
                $error = array('error' => $ci->upload->display_errors());
                //print_r($error);
            }
        }

        return $ids = implode('|', $insertedids);

    }

function get_date($date){
    $data=date('Y-m-d 00:00:00',strtotime($date));
    return $data;
}
function get_datetime($date){
    $data=date('D, d M Y h:i A ',strtotime($date));
    return $data;
}
function get_datetime1($date){
    $data=date('D, d M Y ',strtotime($date));
    return $data;
}
function get_datetimepdf ($date){
    $data=date('D, d M Y',strtotime($date));
    return $data;
}
function get_time($time){
    $data=date('h:i A ',strtotime($time));
    return $data;
}
function get_row($table){
    $ci=& get_instance();
    $ci->load->database();
    $data=$ci->db->query("select * from $table ");
    return $data->row();
}
function get_result($table){
    $ci=& get_instance();
    $ci->load->database();
    $data=$ci->db->query("select * from $table ");
    return $data->result();
}
function get_where($table,$get,$condition){
   $ci=& get_instance();
    $ci->load->database();
   $data=$ci->db->query("select * from $table where `$get`='$condition'");
    return $data->result();
}
function get_where_row($table,$get,$condition){
   $ci=& get_instance();
    $ci->load->database();
   $data=$ci->db->query("select * from $table where `$get`='$condition'");
    return $data->row();
}
function limit_words($string,$word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}
function get_insert($table,$data,$return,$imagename="",$imgmulti=""){
    $ci=& get_instance();
    $ci->load->database();
    if (!empty($_FILES[''.$imagename.'']))
        {
            $image=array("".$imagename."" => image_upload(''.$imagename.'',$imgmulti,true,"jpg|jpeg|png"));
            $newarr=array_merge($data,$image);
             $ci->db->insert($table,$newarr);
        }
        else
        {
            $ci->db->insert($table,$data);
        }
        if ($ci->db->affected_rows()) {
            $response['msg'] =  "$return";
            $response['status'] =  true;
        }else{
            $response['status'] =  false;
            $response['code'] =  "Error Code : AX001";
            $response['msg'] =  "No Change Occur";
        }
         echo json_encode($response);
}

function get_update($table,$data,$tablefiled,$wheredata,$return,$imagename="",$imgmulti=""){
    $ci=& get_instance();
    $ci->load->database();
    if ($_FILES[''.$imagename.'']['name'] != "")
        {
            $image=array("".$imagename."" => image_upload(''.$imagename.'',$imgmulti,true,"jpg|jpeg|png"));
            $newarr=array_merge($data,$image);
             //$ci->db->insert($table,$newarr);
            $ci->db->where($tablefiled,$wheredata)->update($table,$newarr);
        }else{
            /* echo "<pre>";
            print_r($data);
            die(); */

            $ci->db->where($tablefiled,$wheredata)->update($table,$data);
        }
    
        if ($ci->db->affected_rows()) {
            $response['msg'] =  "$return";
            $response['status'] =  true;
        }else{
            $response['status'] =  false;
            $response['code'] =  "Error Code : AX001";
            $response['msg'] =  "No Change Occur";
        }
         echo json_encode($response);
}

function get_delete($table,$tablefiled,$id,$return){
    $ci=& get_instance();
    $ci->load->database();
    $data = array(
           'del_status' => 1,
            );
    $ci->db->where($tablefiled,$id)->update($table,$data);
   
        if ($ci->db->affected_rows()) {
            $response['msg'] =  "$return";
            $response['status'] =  true;
        }else{
            $response['status'] =  false;
            $response['code'] =  "Error Code : AX001";
            $response['msg'] =  "No Change Occur";
        }
         echo json_encode($response);
}
function send_email($to, $from, $subject, $template,$data){
    /*$ci =& get_instance();
    $smtp=$ci->db->get('SMTP_TBL')->row();
    $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $smtp->SMTP_HOST,
            'smtp_port' => $smtp->SMTP_PORT,
            'smtp_user' => $smtp->SMTP_EMAIL,
            'smtp_pass' => $smtp->SMTP_PASSWORD,
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1',
            'wordwrap'   => TRUE
        );
    
    $ci->load->library('email');
    $message=$ci->load->view('shareemail/'.$template,$data,TRUE);
    $email = $ci->email;
    $ci->email->set_newline("\r\n");
    $email->initialize($config);
    $email->from($from,'manish');
    $email->to($to);
    $email->subject($subject);
    $email->message($message);
    $email->send();*/
    
    $ci =& get_instance();
    $ci->load->library('email');
    $message=$ci->load->view('shareemail/'.$template,$data,TRUE);
    $email = $ci->email;
    $config['mailtype'] = 'html';
    $config['wordwrap'] = TRUE;
    $email->initialize($config);
    $email->from($from,'DY Immigration');
    $email->to($to);
    $email->subject($subject);
    $email->message($message);
    
     $email->send();
}
function get_monthname($month){
   switch ($month) {
       case '01':
           return 'Jan';
           break;
           case '02':
           return 'Feb';
           break;
           case '03':
           return 'Mar';
           break;
            case '04':
           return 'Apr';
           break;
            case '05':
           return 'May';
           break;
            case '06':
           return 'Jun';
           break;
            case '07':
           return 'Jul';
           break;
            case '08':
           return 'Aug';
           break;
            case '09':
           return 'Sep';
           break;
            case '10':
           return 'Oct';
           break;
            case '11':
           return 'Nov';
           break;
            case '12':
           return 'Dec';
           break;

       default:
          
           break;
   }
}
