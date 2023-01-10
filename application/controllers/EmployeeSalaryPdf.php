<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeSalaryPdf extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('pdf');
        $this->load->library('pagination');
        $this->load->model(array('defaultModel'));
        if($this->is_logged_in()){

        $this->maindata=$this->db->where('USER_ID',$this->is_logged_in())->get('user_tbl')->row();
        }
            date_default_timezone_set("Asia/Kolkata");
     
    }
    
     public function cleanUrl($string) {
       $string = str_replace('/', '-', $string); // Replaces all spaces with hyphens.
       return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
    }
    
    
 public function download_pdf_certificate_request($id)
    {  
         $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        $data['payroll_id'] = $id;
        $data['alluserData'] = $this->db->select('user_tbl.*,tbl_payroll.*')->
        join('user_tbl', 'user_tbl.USER_ID = tbl_payroll.user_id')->
        order_by('tbl_payroll.payroll_id','DESC')->
        where('tbl_payroll.payroll_id',$id)->
        where('tbl_payroll.del_status',0)->
        get('tbl_payroll')->row();
        $data['user_id'] = $data['alluserData']->user_id;
        $allholi= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_holidays')->result();
            $a=array();
        foreach ($allholi as $key ) {
        array_push($a,$key->holidays_date);
        }
        
        $data['holiday']=$a;
        $this->createpdfcertificate($data);
       
    }
    
    public function createpdfcertificate($data)
    {
$userId=$data['user_id'];
$orgData=$this->db->where('oraganisation_id',1)->get('tbl_organisation')->row();
        $department=$this->db->where('department_id',$data['alluserData']->department_id)->get('tbl_department')->row();
 $designation=$this->db->where('designation_id',$data['alluserData']->designation_id)->get('tbl_designation')->row();
$bonus=$this->db->select('SUM(bonucs) as bonucstotal')->where('payroll_id',$data['alluserData']->payroll_id)->get('tbl_payroll_meta')->row();
$deduction=$this->db->select('SUM(deduction) as deductiontotal')->where('payroll_id',$data['alluserData']->payroll_id)->get('tbl_payroll_meta')->row();
//echo $md=$alluserData->month;
$leaveData=$this->db->
where('MONTH(maindate)',$data['alluserData']->month)->
where('USER_ID',$data['alluserData']->USER_ID)->
where('del_status',0)->
get('tbl_leave')->result();
 $month = $data['alluserData']->month;
 $year = $data['alluserData']->year;
 $maxDays=cal_days_in_month(CAL_GREGORIAN,$data['alluserData']->month,$data['alluserData']->year);
 
        $foldername= date("Y-m-d-h-i-sa");
       if (!is_dir("images/uploads")){
            mkdir("images/uploads");
           
        }
        if (!is_dir("images/uploads/pdf")){
            mkdir("images/uploads/pdf");
        }
        
        
        if (!is_dir("images/uploads/pdf/".$foldername)){
            mkdir("images/uploads/pdf/".$foldername);
        }
        
        
         
            $filename = $_SERVER['DOCUMENT_ROOT']."/images/uploads/pdf/".$foldername."/test.pdf";
         
            tcpdf();
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $obj_pdf->SetCreator(PDF_CREATOR);
            $obj_pdf->SetTitle('helo');


            // set document information
            $obj_pdf->SetAuthor('manish');;
            // remove default header/footer
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            // set default monospaced font
            $obj_pdf->SetDefaultMonospacedFont('helvetica');

            // set image scale factor
            $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
            $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $obj_pdf->SetFont('helvetica', '', 8);
            $obj_pdf->setFontSubsetting(false);
            $obj_pdf->AddPage();
            ob_start();
            $data1['leaveinfo']="";
            $data1['attInfo']="";
             $data1['employeeName']= $data['alluserData']->USER_NAME .' '. $data['alluserData']->user_last_name ;
            
             $data1['year']=$data['alluserData']->year;
         $data1['employeeId']=$data['alluserData']->employee_id;
   $data1['employeeDesignation']= $designation->designation_name;
   $data1['employeeDepartment']=$department->department_name;
   $data1['employeeBranch']="Ambala";
   $data1['employeeEmail']=$data['alluserData']->USER_EMAIL;
    $data1['payslip']=$data['alluserData']->payroll_id;
    $data1['month']=get_monthname($data['alluserData']->month);
    $data1['generateddatetime']=get_datetimepdf($data['alluserData']->lastmodify_payroll);
     $data1['salary']=$data['alluserData']->salary;
      $data1['bonucstotal']=$bonus->bonucstotal;
       $data1['totalEran']=$data['alluserData']->net_salary + $bonus->bonucstotal;
        $data1['deduction']=$deduction->deductiontotal;         
        $data1['totalDeduction']=$deduction->deductiontotal;  
        $data1['logo']=($orgData->oraganisation_logo)?$orgData->oraganisation_logo:'assets/img/logo2.png';    
        $data1['name']=$orgData->oraganisation_name;  
           $data1['totalSalary']=$data['alluserData']->net_salary + $bonus->bonucstotal - $deduction->deductiontotal    ;         
            //leave display
            function getDatesFromRange($start, $end, $format = 'Y-m-d') {
 $maxDays=date('t');
      
    // Declare an empty array
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    // Use loop to store date into array
    foreach($period as $date) {                 
        $array[] = $date->format($format); 
    }
  
    // Return the array elements
    return $array;
}
        $leave=array();
    foreach ($leaveData as $key1 ) {
    $arrdate=getDatesFromRange($key1->leave_form,$key1->leave_to);
    foreach ($arrdate as $key2 ) {
    array_push($leave,$key2);
                           }
    }
                                                 $i = 0;
                                                foreach ($leaveData as $key ) {
                                                    $i  = + $key->leave_day;
                                                 if($key->leave_type == '1'){$leavetype= 'Full Day';}else if($key->leave_type == '2'){$leavetype= 'Half Day';}else{$leavetype= 'Short Leave';}
                                                 
                                        if($key->status == '1'){$leaveStatu= 'Pending';}else if($key->status == '2'){
                                                        $leaveStatu ='Approve';
                                                    }else if($key->status == '3'){
                                                        $leaveStatu = 'Decline';
                                                    }else{
                                                        $leaveStatu = 'Cancel';
                                                    } 
                                                $data1['leaveinfo'].='<tr>';
                                                    $data1['leaveinfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">'. $leavetype .'';
                                                      
                                        $data1['leaveinfo'].='</td>';
                                                    $data1['leaveinfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">'.date("d-M-Y", strtotime($key->leave_form)).'';
                                                     
                                        $data1['leaveinfo'].='</td>';
                                        $data1['leaveinfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">'.date("d-M-Y", strtotime($key->leave_to)).'';
                                        $data1['leaveinfo'].='</td>';
                                        $data1['leaveinfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">'.$key->leave_reason.'';
                                                      
                                        $data1['leaveinfo'].='</td>';
                                        $data1['leaveinfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">'.$key->leave_day.'';
                                                         
                                        $data1['leaveinfo'].='</td>';
                                        $data1['leaveinfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4;text-align: center; font-size: 12px;">'.$leaveStatu.'';
                                                     
                                        $data1['leaveinfo'].='</td>';
                                        $data1['leaveinfo'].='</tr>';
                                                 
                                                } 
            $data1['leaveCount']=$i;
            //date loop
            for ($i=1; $i <= $maxDays ; $i++) { 
                                    $time=mktime(12, 0, 0, $month, $i, $year);          
                                    if (date('m', $time)==$month) 
                                    $attData=$this->db->select('punchIn,punchOut')->where('user_id',$userId)->
                                where('punchIn >=', date('Y-m-d 00:00:00', $time))->
                                where('punchIn <=', date('Y-m-d 12:00:00', $time))->
                                get('tbl_attendance')->result();
                                $puncharr=[];
                                $puncharr1=[];
                                foreach ($attData as $key ) {
                                     $times = date("g:i a", strtotime($key->punchIn));
                                   array_push($puncharr,$times);
                                   if($key->punchOut != '0000-00-00 00:00:00'){

                                       $times1 = date("g:i a", strtotime($key->punchOut));
                                       array_push($puncharr1,$times1);
                                   }
                                }
                                $mainpunchin=implode('|', $puncharr);
                                $mainpunchin1=implode('|', $puncharr1);
                                $mtime=$this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC(timeDiff))) as time")->
        where('user_id',$userId)->
       where('punchIn >=', date('Y-m-d 00:00:00', $time))->
                                where('punchIn <=', date('Y-m-d 12:00:00', $time))->
        get('tbl_attendance')->row();
        $times = explode('.',$mtime->time);
                                   if(date('l', strtotime(date('d M Y', $time))) == 'Sunday'){
                                            $mydays= 'Sunday';
                                        }else if(in_array(date('Y-m-d', $time), $leave,true)){
                                              $mydays= 'Leave';
                                        $mydays1= $mainpunchin;
                                             $mydays2= $mainpunchin1;
                                        }else{
                                             $mydays= $mainpunchin;
                                             $mydays1= $mainpunchin1;
                                        }  
                                        if($times[0]){$myTime=$times[0];}else{
                                           $myTime='00:00 hrs'; 
                                        } 
                                        $data1['attInfo'].='<tr bgcolo="#F4F4F4">';
                                        $data1['attInfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">'.date('d M Y', $time) .''; 
                                        $data1['attInfo'].='</td>';
                                        if($mydays == 'Leave'){
                                            $data1['attInfo'].='<td  align="center" style="background-color:#ffb643;border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">(Punch In '.$mydays1.')(Punch Out '.$mydays2.')';
                                                         
                                          $data1['attInfo'].='</td>';
                                        }else if($mydays == 'Sunday'){
                                           $data1['attInfo'].='<td  align="center" style="background-color:#17a5b4;border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">Sunday';
                                                         
                                          $data1['attInfo'].='</td>'; 
                                        }else{
                                             $data1['attInfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">(Punch In '.$mydays.')(Punch Out '.$mydays1.')';
                                                         
                                          $data1['attInfo'].='</td>'; 
                                        }
                                        
                                          
                                        $data1['attInfo'].='<td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 12px;">'.$myTime.'';  
                                        $data1['attInfo'].='</td>';
                                        $data1['attInfo'].='</tr>';
                                                 } 
            
        //  $template = file_get_contents('email_template/SalaryViewPdf.html');
                $template = file_get_contents('pdf/salarypdf.html');
                foreach ($data1 as $key => $value) {
                    $template = str_replace('{{'.$key.'}}', $value, $template) ;
                }
            
                echo $template ;
                //die();
                
                $content = ob_get_contents();
                //ob_clean();
               // flush();
                //  ob_end_clean();
                $obj_pdf->writeHTML($content, true, false, true, false, '');
               ob_clean();
                ob_flush();
              /*  $obj_pdf->Output($filename, 'F'); // Create File
               ob_end_flush();
                ob_end_clean();
                
                $obj_pdf->Output('My-File-Name.pdf');*/
                
                    $obj_pdf->Output($filename, 'F'); // Create File

             //$obj_pdf->Output('My-File-Name.pdf','I');
          //  $pdf->Output('example_007.pdf', 'I');
            //exit;
            ob_clean();
            ob_flush();
            $obj_pdf->Output($filename,'I');
            ob_end_flush();
            ob_end_clean();
            
               $file =  $filename; 
                //$fp = fopen($file, "r") ;
                
                header("Cache-Control: maxage=1");
                header("Pragma: public");
                header("Content-type: application/pdf");
                header("Content-Disposition: inline; filename=" . str_replace(' ','-', $foldername.$data['name'].'.pdf'));
                header("Content-Description: PHP Generated Data");
                header("Content-Transfer-Encoding: binary");
                 header("Content-Type: application/download"); 
                header('Content-Length:' . filesize($file));
                ob_clean();
                flush();
                /*while (!feof($fp)) {
                $buff = fread($fp, 1024);
                print $buff;*/
                //}
               exit;
    }
     public function createTrialbalancepdf()
    {
        $foldername= date("Y-m-d-h-i-sa");
       if (!is_dir("images/uploads")){
            mkdir("images/uploads");
           
        }
        if (!is_dir("images/uploads/pdf")){
            mkdir("images/uploads/pdf");
        }
        
        
        if (!is_dir("images/uploads/pdf/".$foldername)){
            mkdir("images/uploads/pdf/".$foldername);
        }
        
        
         
            $filename = $_SERVER['DOCUMENT_ROOT']."/images/uploads/pdf/".$foldername."/test.pdf";
         
            tcpdf();
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $obj_pdf->SetCreator(PDF_CREATOR);
            $obj_pdf->SetTitle('helo');


            // set document information
            $obj_pdf->SetAuthor('manish');;
            // remove default header/footer
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            // set default monospaced font
            $obj_pdf->SetDefaultMonospacedFont('helvetica');

            // set image scale factor
            $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
            $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $obj_pdf->SetFont('helvetica', '', 8);
            $obj_pdf->setFontSubsetting(false);
            $obj_pdf->AddPage();
            ob_start();
            $data1['leaveinfo']="";
            $data1['attInfo']="";

        $template = file_get_contents('pdf/trialbalancepdf.html');
                foreach ($data1 as $key => $value) {
                    $template = str_replace('{{'.$key.'}}', $value, $template) ;
                }
            
                echo $template ;
                //die();
                
                $content = ob_get_contents();
                //ob_clean();
               // flush();
                //  ob_end_clean();
                $obj_pdf->writeHTML($content, true, false, true, false, '');
               ob_clean();
                ob_flush();
              /*  $obj_pdf->Output($filename, 'F'); // Create File
               ob_end_flush();
                ob_end_clean();
                
                $obj_pdf->Output('My-File-Name.pdf');*/
                
                    $obj_pdf->Output($filename, 'F'); // Create File

             //$obj_pdf->Output('My-File-Name.pdf','I');
          //  $pdf->Output('example_007.pdf', 'I');
            //exit;
            ob_clean();
            ob_flush();
            $obj_pdf->Output($filename,'I');
            ob_end_flush();
            ob_end_clean();
            
               $file =  $filename; 
                //$fp = fopen($file, "r") ;
                
                header("Cache-Control: maxage=1");
                header("Pragma: public");
                header("Content-type: application/pdf");
                header("Content-Disposition: inline; filename=" . str_replace(' ','-', $foldername.$data['name'].'.pdf'));
                header("Content-Description: PHP Generated Data");
                header("Content-Transfer-Encoding: binary");
                 header("Content-Type: application/download"); 
                header('Content-Length:' . filesize($file));
                ob_clean();
                flush();
                /*while (!feof($fp)) {
                $buff = fread($fp, 1024);
                print $buff;*/
                //}
               exit;
    }
    public function createleadgerpdf()
    {
        $foldername= date("Y-m-d-h-i-sa");
       if (!is_dir("images/uploads")){
            mkdir("images/uploads");
           
        }
        if (!is_dir("images/uploads/pdf")){
            mkdir("images/uploads/pdf");
        }
        
        
        if (!is_dir("images/uploads/pdf/".$foldername)){
            mkdir("images/uploads/pdf/".$foldername);
        }
        
        
         
            $filename = $_SERVER['DOCUMENT_ROOT']."/images/uploads/pdf/".$foldername."/test.pdf";
         
            tcpdf();
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $obj_pdf->SetCreator(PDF_CREATOR);
            $obj_pdf->SetTitle('helo');


            // set document information
            $obj_pdf->SetAuthor('manish');;
            // remove default header/footer
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            // set default monospaced font
            $obj_pdf->SetDefaultMonospacedFont('helvetica');

            // set image scale factor
            $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
            $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $obj_pdf->SetFont('helvetica', '', 8);
            $obj_pdf->setFontSubsetting(false);
            $obj_pdf->AddPage();
            ob_start();
            $data1['leaveinfo']="";
            $data1['attInfo']="";

        $template = file_get_contents('pdf/ledgerpdf.html');
                foreach ($data1 as $key => $value) {
                    $template = str_replace('{{'.$key.'}}', $value, $template) ;
                }
            
                echo $template ;
                //die();
                
                $content = ob_get_contents();
                //ob_clean();
               // flush();
                //  ob_end_clean();
                $obj_pdf->writeHTML($content, true, false, true, false, '');
               ob_clean();
                ob_flush();
              /*  $obj_pdf->Output($filename, 'F'); // Create File
               ob_end_flush();
                ob_end_clean();
                
                $obj_pdf->Output('My-File-Name.pdf');*/
                
                    $obj_pdf->Output($filename, 'F'); // Create File

             //$obj_pdf->Output('My-File-Name.pdf','I');
          //  $pdf->Output('example_007.pdf', 'I');
            //exit;
            ob_clean();
            ob_flush();
            $obj_pdf->Output($filename,'I');
            ob_end_flush();
            ob_end_clean();
            
               $file =  $filename; 
                //$fp = fopen($file, "r") ;
                
                header("Cache-Control: maxage=1");
                header("Pragma: public");
                header("Content-type: application/pdf");
                header("Content-Disposition: inline; filename=" . str_replace(' ','-', $foldername.$data['name'].'.pdf'));
                header("Content-Description: PHP Generated Data");
                header("Content-Transfer-Encoding: binary");
                 header("Content-Type: application/download"); 
                header('Content-Length:' . filesize($file));
                ob_clean();
                flush();
                /*while (!feof($fp)) {
                $buff = fread($fp, 1024);
                print $buff;*/
                //}
               exit;
    }
}