<?php
class Login_m extends CI_Model
{
	
	function login_verify()
	{
   //print_r($_POST);
      $username = $this->security->xss_clean($this->input->post('USER_EMAIL'));
      $password = $this->security->xss_clean($this->input->post('PASSWORD'));

      $this->db->where('USER_EMAIL', $username);
      $this->db->where('PASSWORD',$password);
    
      $query = $this->db->get('user_tbl');
    
      if($query->num_rows() == 1)
      {
            $xyz=$query->row_array();
            $query1=$this->db->where('USER_ID',$xyz['USER_ID'])->where('USER_VERIFY',0)->get('user_tbl');
            $query2=$this->db->where('USER_ID',$xyz['USER_ID'])->where('del_status',1)->get('user_tbl');
            
        if ($query1->num_rows() == 1) 
        { 
          if($query2->num_rows() == 1){
              $response['status'] = false;
              $response['msg'] = "3";
          }else{

               $newdata = array( 
                'USER_ID' =>  $xyz['USER_ID'],
                'logged_in' => TRUE,
                'userstatus' => $xyz['STATUS'],
                );
                $this->session->set_userdata($newdata);
                $data=array('LAST_LOGIN' => date('Y-m-d H:i:s'));
                $this->db->where('USER_ID',$xyz['USER_ID'])->update('user_tbl',$data);
                if($xyz['STATUS']==1){
                  $response['url'] = 'dashboardAdmin.html';
                }else{
                  $response['url'] = 'dashboardEmployee.html';
                }
                $response['msg'] = "User Login";
                $response['status'] = true;
                 
          }
           
          }else{
             $response['status'] = false;
              $response['msg'] = "1";
          }  
      }/*if condition ends here*/
      else
      {
          $response['status'] = false;
          $response['msg'] = "2";
      }/*else condition ends here*/
      echo json_encode($response);
	}/* function loginverify ends here*/


  function profile($id)
  {
        
        $query = $this->db->where('admin_login_id',$id)->get('admin_login');
        return $query->row();
  }
  function editprofile($id,$filename="")
  {
      $username=$this->input->post('username');
      $name=$this->input->post('name');
        if($filename=="")
        {
           $data = array(
           'username' => $this->input->post('username'),
           'name' => $this->input->post('name'),
           'staffmember_post' => $this->input->post('staffmember_post'),
           'phone_no' => $this->input->post('phone_no'),
           'address' => $this->input->post('address'),
            ); 
           
           if($username!="" && $name!="")
            {
             $this->db->where('admin_login_id',$id)->update('admin_login', $data);
             return;
            }
           else
            {
             redirect('admin/login/profile');
            }
        }/* if condition ends here*/
        else
        {
            $data = array(
            'username' => $this->input->post('username'),
            'name' => $this->input->post('name'),
            'staffmember_post' => $this->input->post('staffmember_post'),
            'phone_no' => $this->input->post('phone_no'),
            'address' => $this->input->post('address'),
            'image' => $filename,
             );
            
          if($username!="" && $name!="")
            {
             $this->db->where('admin_login_id',$id)->update('admin_login', $data);
             return;
            }
            else{
             redirect('admin/login/profile');
            }
        }/*else condition ends here*/
  }/*function editprofile ends here*/

  function passreset($email)
  {
        $this->db->where('username', $email);     
        $query = $this->db->get('admin_login');

        
        if($query->num_rows() == 1)
        {
          $xyz=$query->row_array();

          $query_gen = $this->db->get('general');
          $xyz_gen=$query_gen->row();
           
          $newdata = array( 
            'tmp_password' => mt_rand('5000', '200000')            
            ); 
            $config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.gmail.com',
              'smtp_port' => 465,
              'smtp_user' => 'abhishek@afterdoor.com',
              'smtp_pass' => 'dhanwalabhishek12345',
              'mailtype'  => 'html', 
              'charset'   => 'iso-8859-1'
                );

              $this->email->initialize($config);
              $this->load->library('email', $config);
              $this->email->set_newline("\r\n");
              $this->email->from('filetomail@example.com');
              $list = array($email);
              $this->email->to($list);              
              $this->email->subject($xyz_gen->site_name.' '.'Password Reset');
              //$message=array();
              $this->email->message('Hi,Your password has been reset using your email: '.$email.'. '. 'Reset your Password by clicking: '.admin_url().'login/changepass/'.md5($newdata['tmp_password']));

              $result = $this->email->send();
            if($result)
              {
               // return $newdata['tmp_password']; 
              //echo "email sent";
              $data = array(
                       'reset_keylink' => md5($newdata['tmp_password'])                  
                        );
                
                
                $this->db->where('username', $email);
                $this->db->update('admin_login',$data);
                 $message="<p class='alert alert-success' style='margin-top:-9px;margin-bottom:15px'>Email sent to Id.</p>";
                 $this->session->set_flashdata("invalidlogin",$message);
                return 1 ;
                
              } 
            else
              {
                //show_error($this->email->print_debugger());
                $message="<p class='alert alert-danger' style='margin-top:20px;margin-bottom:-10px'>Email cannot be sent</p>";
                $this->session->set_flashdata("passwordmsg",$message);
                return 0;
              }
          
          
          //redirect('admin/dashboard');
          
        }/*if condition ends here*/
        else
        {
            //show_error($this->email->print_debugger());
          if($this->input->post('reset_pass'))
          {
            $message="<p class='alert alert-danger' style='margin-top:-9px;margin-bottom:12px'>Email doesnt exist</p>";
            $this->session->set_flashdata("passwordmsg",$message);
            return 0;  
            }
            else{
              return 0;
            }            

        }
  }

  function verifyPass($id)
  {
     $old_pass = $this->security->xss_clean($this->input->post('old_pass'));
     $new_pass = $this->security->xss_clean($this->input->post('new_pass'));
    //exit;
    if($this->input->post('update_password'))
      {
        $this->db->where('password',md5($old_pass));      
        $this->db->where('admin_login_id',$id);      
        $query = $this->db->get('admin_login');
        if($query->num_rows() == 1)
          {
             $data = array(
              'password' => md5($new_pass)            
                ); 

             $this->db->where('admin_login_id',$id)->update('admin_login', $data);
             return 1;
          }
        else
          {
            return 0;
            //redirect('admin/ErrorC');
          }
      }//new if
        
      else
      {
         redirect('admin/login/profile');
      }

  }

  function changepass($resetkey)
  {
    $query=$this->db->get('admin_login');
     $row=$query->row();
      
     if($row->reset_keylink==$resetkey)
     {

      return 1;
     }

  }
  function updatePass()
  {
     $p1 = $this->security->xss_clean($this->input->post('p1'));
     $p2 = $this->security->xss_clean($this->input->post('p2'));

     $data=array(
                  'password'=>md5($this->input->post('p2'))
              );

        if($this->input->post('forgot_pass_update'))
            {
             $this->db->update('admin_login', $data);
             return 1;
            }

  }
  
  

    

}/*class ends here*/



