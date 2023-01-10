<?php $arr = explode('|',$privileges_settings->admission) ;
$country=$this->db->where('id',$data->country)->limit(1)->get('country')->row();
$state=$this->db->where('id',$data->state)->limit(1)->get('states')->row();
$city=$this->db->where('id',$data->city)->limit(1)->get('cities')->row();
$metadata=$this->db->where('call_id',$data->call_id)->get('tbl_call_meta')->result();
$admissiondata=$this->db->where('call_id',$data->call_id)->get('tbl_admission_meta')->result();
$status=$this->db->where('status_id',$data->status)->limit(1)->get('tbl_status')->row();

?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Call-Detail </h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Call-Detail </li>
                                </ul>
                            </div>
                            <?php if(isset($_GET['admission'])){
                                  if(in_array('1', $arr)){
                                ?>

                            <div class="col-auto float-right ml-auto">
                                <a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_addmission"><i class="fa fa-plus"></i> Add Admission</a>
                            </div>
                                <?php
                            } 
}
                            ?>
                        </div>
                    </div>
                    
 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsiveNo">
                                 <h4 align="center">File No:-<?= $data->fileno ?></h4>
                                <div class="tab-content">
                        <div id="emp_profile" class="pro-overview tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                       
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                Personal Informations  
                                            </h3>
                                            <ul class="personal-info">
                                               
                                                <li>
                                                    <div class="title">Name:</div>
                                                    <div class="text"><?= $data->name ?></div>
                                                </li>
                                                 <li>
                                                    <div class="title">Father Name:</div>
                                                    <div class="text"><?= $data->father_name ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text"><?= $data->dob ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Gender</div>
                                                    <div class="text"><?= $data->gender ?></div>
                                                </li>
                                                  <li>
                                                    <div class="title">Age</div>
                                                    <div class="text"><?= $data->age ?></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">
                                                Basic information</h3>
                                            <ul class="personal-info">
                                                 <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a href="tel:<?= $data->phone ?>"><?= $data->phone ?></a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">
                                                        <a href="mailto:<?= $data->email ?>"><?= $data->email ?></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Address</div>
                                                    <div class="text"><?= $data->address ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Country</div>
                                                    <div class="text"><?= (isset($country))?$country->country_name:'' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">State</div>
                                                    <div class="text"><?= (isset($state))?$state->name:'' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">City</div>
                                                    <div class="text"><?= (isset($city))?$city->name:'' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Extra Score</div>
                                                    <div class="text"><?= $data->extra_score ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Duolingo to elf</div>
                                                    <div class="text"><?= $data->duolingo_text ?></div>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                                
                            
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">
                                                Marks status </h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">English Test:</div>
                                                    <div class="text">
                                                       <?= $data->english_test ?>
                                                    </div>
                                                </li>
                                                 <li>
                                                    <div class="title">Score:</div>
                                                    <div class="text"><?= $data->language_score ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Reading</div>
                                                    <div class="text"><?= $data->reading ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Listening</div>
                                                    <div class="text"><?= $data->listening ?></div>
                                                </li>
                                               <li>
                                                    <div class="title">Writing</div>
                                                    <div class="text"><?= $data->writing ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Speaking</div>
                                                    <div class="text"><?= $data->speaking ?></div>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">
                                                Caller Status                                             </h3>
                                            <ul class="personal-info">
                                                 <li>
                                                    <div class="title">Previous Referral:</div>
                                                    <?php if($data->previous_referral == 1){
                                                        ?>
                                                    <div class="text"><?= $data->previous_country ?></div>

                                                        <?php
                                                    }else{
                                                         ?>
                                                        <div class="text">No Previous Referral</div> 
                                                        <?php
                                                    } ?>
                                                </li>
                                                <li>
                                                    <div class="title">Reference:</div>
                                                    <div class="text">
                                                        <a href="mailto:<?= $data->email ?>"><?= $data->reference ?></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Remark</div>
                                                    <div class="text"><?= $data->remark ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Status</div>
                                                    <div class="text"><?= (isset($status))?$status->status_title:'' ?></div>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">
                                                More status                                             
                                                </h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Percentage in english:</div>
                                                    <div class="text">
                                                       <?= $data->percentageinenglish ?>
                                                    </div>
                                                </li>
                                                 <li>
                                                    <div class="title">Previous travel history:</div>
                                                    <div class="text"><?= ($data->previoustravelhistory == "Yes")?$data->previoustravelcountryyes:'No' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Prefered Country</div>
                                                    <div class="text"><?= $data->preferedCountry ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">prefered City</div>
                                                    <div class="text"><?= $data->preferedCity ?></div>
                                                </li>
                                               
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">
                                                More status                                             </h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Package Consultancy:</div>
                                                    <div class="text">
                                                       <?= $data->packageConsultancy ?>
                                                    </div>
                                                </li>
                                                <?php if($data->packageConsultancy == "Package"){
                                                    ?>
                                                    <li>
                                                    <div class="title">Package total amount:</div>
                                                    <div class="text"><?= $data->packagetotalamount ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Package include:</div>
                                                    <div class="text"><?= $data->packageinclude ?></div>
                                                </li>
                                                 <li>
                                                    <div class="title">Package before visa:</div>
                                                    <div class="text"><?= $data->packagebeforevisa ?></div>
                                                </li>
                                                 <li>
                                                    <div class="title">Package after visa:</div>
                                                    <div class="text"><?= $data->packageaftervisa ?></div>
                                                </li>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <li>
                                                    <div class="title">Consultancy before visa:</div>
                                                    <div class="text"><?= $data->consultancybeforevisa ?></div>
                                                </li>
                                                 <li>
                                                    <div class="title">Consultancy after visa:</div>
                                                    <div class="text"><?= $data->consultancyaftervisa ?></div>
                                                </li>
                                                    <?php
                                                } ?>
                                                 
                                                
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                                      <!--<div class="row">
                                <div class="col-md-12 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">
                                                More Info                                             </h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">GIC pdf:</div>
                                                    <div class="text">
                                                         <a href="<?= $data->GIC ?>"   target="_blank">
                                                        <img src="images/pdf.png" width=50 height=50  
                                                       />
                                                          </a>
                                                    </div>
                                                </li>
                                                 <li>
                                                    <div class="title">SOP Pdf:</div>
                                                    <div class="text">  
                                                    <a href="<?= $data->SOP ?>"   target="_blank">
                                                    <img src="images/pdf.png"  width=50 height=50
                                                       />
                                                       </a>
                                                       </div>
                                                </li>
                                                <li>
                                                    <div class="title">LOR Pdf</div>
                                                    <div class="text">
                                                           <a href="<?= $data->LOR ?>"   target="_blank">
                                                    <img src="images/pdf.png"  width=50 height=50  
                                                       />
                                                       </a>
                                                       </div>
                                                </li>
                                                <li>
                                                    <div class="title">Fee Receipt Pdf</div>
                                                    <div class="text">  
                                                      <a href="<?= $data->FEERECEIPT ?>"   target="_blank" >
                                                    <img src="images/pdf.png"  width=50 height=50  
                                                       />
                                                        </a>
                                                       </div>
                                                </li>
                                               
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                             
                            </div>-->
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                Academic Details                                             </h3>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    <?php foreach ($metadata as $key => $value) {

                                                        $myclass=$this->db->where('class_id',$value->course)->limit(1)->get('tbl_class')->row();
                                                        $myboard=$this->db->where('id',$value->boardanduniversity)->limit(1)->get('tbl_boardanduniversity')->row();
                                                        $mystream=$this->db->where('stream_id',$value->streamandother)->limit(1)->get('tbl_stream')->row();
                                                       ?>

                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="javascript:void(0)" class="name"><?= (!empty($myclass))?$myclass->class_name:'' ?></a>
                                                                <div><?= (!empty($myboard))?$myboard->name:'' ?></div>
                                                                <div><?= (!empty($mystream))?$mystream->stream_name:'' ?></div>
                                                                <span class="time"><?= $value->passingyear ?> </span>
                                                                <span class="time"><?= $value->percentage ?> %</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                       <?php
                                                    } ?>
                                                        
                                                        
                                                   

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(!empty($admissiondata)){ ?>
                            <div class="row">
                                <?php foreach ($admissiondata as $key ) {
                                   ?>

                                <div class="col-md-6">
                                   <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">Admission Data</h3>
                                            <ul class="personal-info">
                                                 <li>
                                                    <div class="title">Created Date:</div>
                                                    <div class="text">
                                                        <?= $key->datetime ?></div>
                                                </li>
                                                 <li>
                                                    <div class="title">Status:</div>
                                                    <div class="text">
                                                        <?= $key->admissionstatus ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">College Name:</div>
                                                    <div class="text">
                                                        <?= $key->college_name ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">College Campus:</div>
                                                    <div class="text">
                                                        <?= $key->college_campus ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Course Name:</div>
                                                    <div class="text">
                                                        <?= $key->course_name ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Course start date:</div>
                                                    <div class="text">
                                                        <?= $key->course_start_date ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Course end date:</div>
                                                    <div class="text">
                                                        <?= $key->course_end_date ?></div>
                                                </li>
                                               <li>
                                                    <div class="title">Intakes:</div>
                                                    <div class="text">
                                                        <?= $key->intake ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Offer letter applied date:</div>
                                                    <div class="text">
                                                        <?= $key->offer_letter_applied_date ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Offer letter received date:</div>
                                                    <div class="text">
                                                        <?= $key->offer_letter_recevied_date ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Fees payment date:</div>
                                                    <div class="text">
                                                        <?= $key->fee_payment_date ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">LOA applied date:</div>
                                                    <div class="text">
                                                        <?= $key->loa_applied_date ?></div>
                                                </li>
                                                 <li>
                                                    <div class="title">LOA received date:</div>
                                                    <div class="text">
                                                        <?= $key->loa_recevied_date ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">File lodged or sent to embassy date:</div>
                                                    <div class="text">
                                                        <?= $key->file_sent_embassy_date ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Fund By:</div>
                                                    <div class="text">
                                                        <?= $key->fund_by ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Required Fund:</div>
                                                    <div class="text">
                                                        <?= $key->required_fund ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Fund Deposit:</div>
                                                    <div class="text">
                                                        <?= $key->fund_deposit ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Fund Deposit Date:</div>
                                                    <div class="text">
                                                        <?= $key->fund_deposit_date ?></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> 
                                </div>
                                 <?php
                                } ?>
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
<?php if(isset($_GET['admission'])){
    $admissionstatus = $this->db->where('call_id',$data->call_id)->get('tbl_admission_meta')->row();
 
 $tblcall=$this->db->where('call_id',$data->call_id)->get('tbl_call')->row();
 
                                ?>
<div class="modal custom-modal fade" id="add_addmission" role="dialog">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Admission</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                 <form class="addAddmission">
                                   
                             <input type="hidden" name="call_id" value="<?= $data->call_id ?>">
                             <div class="form-group">
                                        <label>Status<span class="text-danger">*</span></label>
                                        <select class="form-control" name="admissionstatus" >
                                            <option value="">Select status</option>

                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Not received application')?'selected':''; }?> value="Not received application">Not received application</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Offer Pending')?'selected':'' ;}?> value="Offer Pending">Offer Pending</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Offer Received')?'selected':'';} ?> value="Offer Received">Offer Received</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Funds Approval Interview Requested')?'selected':'';} ?> value="Funds Approval Interview Requested">Funds Approval Interview Requested</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Interview Cleared')?'selected':'';} ?> value="Interview Cleared">Interview Cleared</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Funds Approval Received')?'selected':'';} ?> value="Funds Approval Received">Funds Approval Received</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'CAS/COE/LOA pending')?'selected':'';} ?> value="CAS/COE/LOA pending">CAS/COE/LOA pending</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'CAS/COE/LOA received')?'selected':'';} ?> value="CAS/COE/LOA received">CAS/COE/LOA received</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'File at High Commission')?'selected':'';} ?> value="File at High Commission">File at High Commission</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Visa grant')?'selected':'';} ?> value="Visa grant">Visa grant</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Commission Applied')?'selected':'';} ?> value="Visa refused">Visa refused</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Commission Applied')?'selected':'';} ?> value="Commission Applied">Commission Applied</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Commission Received')?'selected':'';} ?> value="Commission Received">Commission Received</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Refund Applied')?'selected':'' ;}?> value="Refund Applied">Refund Applied</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Offer Applied')?'selected':'' ;}?> value="Offer Applied">Offer Applied</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Offer Rejected')?'selected':'' ;}?> value="Offer Rejected">Offer Rejected</option>
                                             <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Initial Deposit Pending')?'selected':'' ;}?> value="Initial Deposit Pending">Initial Deposit Pending</option>
                                             <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Initial Deposit Made')?'selected':'' ;}?> value="Initial Deposit Made">Initial Deposit Made</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Offer Deferment')?'selected':'' ;}?> value="Offer Deferment">Offer Deferment</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Fee Deposit')?'selected':'' ;}?> value="Fee Deposit">Fee Deposit</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'GIC deposit')?'selected':'' ;}?> value="GIC deposit">GIC deposit</option>
                                            <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->admissionstatus == 'Refund Pending')?'selected':'' ;}?> value="Refund Pending ">Refund Pending </option>
                                        </select>
                                    </div>
                                    
                                      <div class="form-group">
                                          <?php 
                                          if(isset($tblcall->skillcat_id) && ($tblcall->skillcat_id!="")){
                                              if($tblcall->skillcat_id=='1'){
                                              $status='Skilled';
                                              }elseif($tblcall->skillcat_id=='2'){
                                              $status='Student';    
                                              }else{
                                                  $status='';
                                              }
                                              
                                          }
                                          
                                          ?>
                                        <label> <?php echo $status;  ?> Status Field <span class="text-danger">*</span></label>
                                    
                                       <select class="form-control" name="status"  >
                                                    <option value="">Select status</option>
                                                    <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->statusfield == 'ECA')?'selected':''; }?> value="ECA">ECA(Educational credentials Assesment)</option>
                                                    <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->statusfield == 'Profile submission')?'selected':''; }?> value="Profile submission">Profile submission</option>
                                                    <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->statusfield == 'Invitation letter (ITA)')?'selected':''; }?> value="Invitation letter (ITA)">Invitation letter (ITA)</option>
                                                    <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->statusfield == 'Case filing')?'selected':''; }?> value="Case filing">Case filing</option>
                                                    <option <?php if(!empty($admissionstatus)){echo ($admissionstatus->statusfield == 'Visa')?'selected':''; }?> value="Visa">Visa</option>
                                                </select> 
                                       
                                    </div>
                                    
                                    
                                       
                                    
                                     <div class="form-group">
                                    <label for="categoryimage">Attachment Title</label>
                                    <input type="text" class="form-control" id="producttitle" name="productitle[]" placeholder="Name"  value=''>
                                    
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="categoryimage">Attachment Pdf</label>
                                    <input type="file" class="form-control" id="productimg" name="productimg[]" placeholder="image"  value=''>
                                    
                                    </div>
                                    <div id="test">
                                    </div>
                                    <button type="button" value="Submit" onclick="return AddImagesbutton();" class="btn btn-primary mr-2">Add More Attachment</button> 
                                    <button  type="button" id="removebutton" class="btn btn-primary mr-2"> remove</button><br><br>
                                 
                                <?php 
                        if(isset($data->call_id)){
                       $getdata= $this->db->where('call_id',$data->call_id)->get('tbl_attachment')->row();
                       if(!empty($getdata->attachment_doc)){
                        $result=$getdata->attachment_doc;
                        $classes=explode("|",$result);
                            $title=explode("|",$getdata->title);
                        if(!empty($classes)){
                        for($i=0;$i<count($classes);$i++){
                        $getimages= $this->db->where('IMAGE_ID',$classes[$i])->get('images_tbl')->row();
                       
                       	if(!empty($getimages->IMAGE_PATH) && file_exists($getimages->IMAGE_PATH)){ ?>
                    
                         <input type="text" class="form-control" id="producttitle"  placeholder="Name"  value=<?php echo $title[$i]; ?>>
                         <br>
                        <img  width="" height="100" src="<?php if(isset($getimages->IMAGE_PATH) && ($getimages->IMAGE_PATH!="")){echo $getimages->IMAGE_PATH;}else{ echo "";}  ?>"/>
                        <button  type="button"   onclick="return deleteProductImages('<?php echo $getdata->id;?>','<?php echo $getimages->IMAGE_ID; ?>','<?php echo $title[$i]; ?>');"> remove</button>
                        <input type="hidden" name="ids[]" value="<?php echo $getdata->id;  ?>" />
                       <?php  }else{ ?>
                           <img src="images/noimage.png" height="100px" width="150px">
                       <?php }
                        } } }}else{ echo "";}?>
                                    
                                    <div class="form-group">
										<button type="button" class="btn btn-primary" id="addappendadmission"><i class="fa fa-plus"></i></button>
									</div>
                                    <div class="appendadmission" >
                                        <?php foreach ($admissiondata as $key) {
                                            ?>

                                        <div class="calappenddiv addItemDiv">
                                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>University Name </label>
                                                    <input class="form-control" type="text" name="college_name[]"  value="<?= $key->college_name ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>University Campus </label>
                                                    <input class="form-control" type="text" name="college_campus[]"  value="<?= $key->college_campus ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Course Name</label>
                                                    <input class="form-control" type="text" name="course_name[]"  value="<?= $key->course_name ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Course start date</label>
                                                    <input class="form-control  mydate" type="text" name="course_start_date[]"  value="<?= $key->course_start_date ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Course end date</label>
                                                    <input class="form-control  mydate" type="text" name="course_end_date[]"  value="<?= $key->course_end_date ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Intake</label>
                                                    <input class="form-control  " type="text" name="intake[]"  value="<?= $key->intake ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Offer letter applied date</label>
                                                    <input class="form-control mydate" type="text" name="offer_letter_applied_date[]"  value="<?= $key->offer_letter_applied_date ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Offer letter received date</label>
                                                    <input class="form-control mydate" type="text" name="offer_letter_recevied_date[]"  value="<?= $key->offer_letter_recevied_date ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fees payment date</label>
                                                    <input class="form-control mydate" type="text" name="fee_payment_date[]"  value="<?= $key->fee_payment_date ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>LOA|CAS|COE applied date</label>
                                                    <input class="form-control mydate" type="text" name="loa_applied_date[]"  value="<?= $key->loa_applied_date ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>LOA|CAS|COE received date</label>
                                                    <input class="form-control mydate" type="text" name="loa_recevied_date[]"  value="<?= $key->loa_recevied_date ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> File lodged or sent to embassy date</label>
                                                    <input class="form-control mydate" type="text" name="file_sent_embassy_date[]"  value="<?= $key->file_sent_embassy_date ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
			    <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Account Open</label>
                                                    <select class="form-control account_open" name="account_open[]" id="">
                                                        <option value="">Select option</option>
                                                        <option  <?php if($key->account_open == 'Yes'){echo 'selected';} ?> value="Yes">Yes</option>
                                                        <option  <?php if($key->account_open == 'No'){echo 'selected';} ?> value="No">No</option>
                                                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
			</div>
			<div class="accountopenyes" style="display:<?php if($key->account_open == 'Yes'){echo 'block';}else{echo 'none';} ?>">
			   <div class="row" >
			    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account holder name</label>
                                                    	<input class="form-control " type="text" name="account_name[]" value="<?= $key->account_name ?>"/>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account number</label>
                                                    	<input class="form-control " type="number" name="account_number[]" value="<?= $key->account_number ?>"/>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account ifsc code</label>
                                                    	<input class="form-control " type="text" name="account_ifsccode[]" value="<?= $key->account_ifsccode ?>"/>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account bank name</label>
                                                    	<input class="form-control " type="text" name="account_bankname[]" value="<?= $key->account_bankname ?>"/>
                                                    
                                                </div>
                                            </div>
			</div> 
			</div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fund By </label>
                                                    <select class="form-control" name="fund_by[]">
                                                        <option value="">Select Fund By</option>
                                                        <option <?php if($key->fund_by == 'Self'){echo 'selected';} ?> value="Self">Self</option>
                                                        <option <?php if($key->fund_by == 'Vighwas'){echo 'selected';} ?> value="Vighwas">Vighwas</option>
                                                        <option <?php if($key->fund_by == 'Both'){echo 'selected';} ?> value="Both">Both</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Required Funds </label>
                                                    <input class="form-control" type="text" name="required_fund[]" required="" value="<?= $key->required_fund ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fund Deposit</label>
                                                    <select class="form-control" name="fund_deposit[]">
                                                        <option value="">Select Fund Deposit</option>
                                                        <option <?php if($key->fund_by == 'Yes'){echo 'selected';} ?> value="Yes">Yes</option>
                                                        <option <?php if($key->fund_by == 'No'){echo 'selected';} ?> value="No">No</option>
                                                       
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fund Deposit Date</label>
                                                    <input class="form-control mydate" type="text" name="fund_deposit_date[]"  value="<?= $key->required_fund ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
			    <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Package affidavit received</label>
                                                    <select class="form-control affidavite_received" name="affidavite_received[]" id="">
                                                        <option value="">Select option</option>
                                                        <option <?php if($key->affidavite_received == 'Yes'){echo 'selected';} ?> value="Yes">Yes</option>
                                                        <option <?php if($key->affidavite_received == 'No'){echo 'selected';} ?> value="No">No</option>
                                                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
			</div>
			<div class="row affidaviteyes" style="display:<?php if($key->affidavite_received == 'Yes'){echo 'block';}else{echo 'none';} ?>">
			    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Upload file</label>
                                                    	<input class="" type="file" name="affidavit_file[]" value=""/>
                                                </div>
                                            </div>
                                            <?php if($key->affidavit_file){
                                            ?>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                    	<a href="<?= $key->affidavit_file  ?>" download>Download</a>
                                                </div>
                                            </div>
                                            <?php
                                            } ?>
                                           
                                            
			</div>
			<div class="row">
		    <div class="col-md-6">
            <div class="form-group">
                <label>Total package amount</label>
            </div>
        </div>
		</div>
		
        	<div class="row">
        <div class="col-md-6">
				<div class="form-group">
					<label>Received</label>
					<input class="form-control " type="text" name="packageamount_received[]" value="<?= $key->packageamount_received ?>"/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>On date</label>
					<input class="form-control mydate" type="text" name="packageamount_on_date[]" value="<?= $key->packageamount_on_date ?>"/>
				</div>
			</div>
			</div>
				<div class="col-md-6">
				<div class="form-group">
					<label>Need application withdraw date</label>
					<input class="form-control mydate" type="text" name="need_application_withdraw_date[]" value="<?= $key->need_application_withdraw_date ?>"/>
				</div>
			</div>
			
			
			
                                        <div class="row">
                                            <div class="col-md-12">
                                               <button type="button" class="btn btn-danger removeappendadmission" ><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                     <?php
                                        } ?>
                                    </div>
                                    
                      
                                    
                                    
                                    
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                                <?php
                            } ?>
               
                
            </div>

<div id="getadmissiondata" style="display: none">
    <div class="calappenddiv addItemDiv">
        
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>University Name </label>
					<input class="form-control" type="text" name="college_name[]"  value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>University Campus </label>
					<input class="form-control" type="text" name="college_campus[]"  value=""/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Course Name</label>
					<input class="form-control" type="text" name="course_name[]"  value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Course start date</label>
					<input class="form-control  mydate" type="text" name="course_start_date[]"  value=""/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Course end date</label>
					<input class="form-control  mydate" type="text" name="course_end_date[]"  value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Intake</label>
					<input class="form-control  " type="text" name="intake[]"  value=""/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Offer letter applied date</label>
					<input class="form-control mydate" type="text" name="offer_letter_applied_date[]"  value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Offer letter received date</label>
					<input class="form-control mydate" type="text" name="offer_letter_recevied_date[]"  value=""/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Fees payment date</label>
					<input class="form-control mydate" type="text" name="fee_payment_date[]"  value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>LOA|CAS|COE applied date</label>
					<input class="form-control mydate" type="text" name="loa_applied_date[]"  value=""/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>LOA|CAS|COE received date</label>
					<input class="form-control mydate" type="text" name="loa_recevied_date[]"  value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>File lodged or sent to embassy date</label>
					<input class="form-control mydate" type="text" name="file_sent_embassy_date[]" value=""/>
				</div>
			</div>
		</div>
		
			<div class="row">
			    <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Account Open</label>
                                                    <select class="form-control account_open" name="account_open[]" id="">
                                                        <option value="">Select option</option>
                                                        <option  value="Yes">Yes</option>
                                                        <option  value="No">No</option>
                                                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
			</div>
			<div class="accountopenyes" style="display:none">
			   <div class="row" >
			    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bank account holder name</label>
                                                    	<input class="form-control " type="text" name="account_name[]" value=""/>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bank account number</label>
                                                    	<input class="form-control " type="number" name="account_number[]" value=""/>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bank ifsc code</label>
                                                    	<input class="form-control " type="text" name="account_ifsccode[]" value=""/>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bank name</label>
                                                    	<input class="form-control " type="text" name="account_bankname[]" value=""/>
                                                    
                                                </div>
                                            </div>
			</div> 
			</div>
			
			<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fund By </label>
                                                    <select class="form-control" name="fund_by[]">
                                                        <option value="">Select Fund By</option>
                                                        <option  value="Self">Self</option>
                                                        <option  value="Vishvas">Vishvas</option>
                                                        <option  value="Both">Both</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Required Funds </label>
                                                    <input class="form-control" type="text" name="required_fund[]"  value=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fund Deposit</label>
                                                    <select class="form-control" name="fund_deposit[]">
                                                        <option value="">Select Fund Deposit</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                       
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fund Deposit Date</label>
                                                    <input class="form-control mydate" type="text" name="fund_deposit_date[]"  value=""/>
                                                </div>
                                            </div>
                                        </div>
			<div class="row">
			    <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Package affidavit received</label>
                                                    <select class="form-control affidavite_received" name="affidavite_received[]" id="">
                                                        <option value="">Select option</option>
                                                        <option  value="Yes">Yes</option>
                                                        <option  value="No">No</option>
                                                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
			</div>
			<div class="row affidaviteyes" style="display:none">
			    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Upload file</label>
                                                    	<input class="" type="file" name="affidavit_file[]" value=""/>
                                                </div>
                                            </div>
                                            
			</div>
			<div class="row">
		    <div class="col-md-6">
            <div class="form-group">
                <label>Total package amount</label>
            </div>
        </div>
		</div>
		
        	<div class="row">
        <div class="col-md-6">
				<div class="form-group">
					<label>Received</label>
					<input class="form-control " type="text" name="packageamount_received[]" value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>On date</label>
					<input class="form-control mydate" type="text" name="packageamount_on_date[]" value=""/>
				</div>
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Need application withdraw date</label>
					<input class="form-control mydate" type="text" name="need_application_withdraw_date[]" value=""/>
				</div>
			</div>
			
			
			
        
		
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-danger removeappendadmission" ><i class="fa fa-trash"></i></button>
			</div>
		</div>
    </div>
    
    
    <!--Add Images-->
          <div id="getimageinfo" style="display:none;">
            <div class="form-group">
                <label for="categoryimage" id="productimglabel"></label>
                <div class="row">
                    
                <div class="col-md-12">
                <label for="categoryimage">Attachment Title</label>
                <input type="text" class="form-control" id="producttitle" name="productitle[]" placeholder="Name"  value=''>
                
                </div>
                
                <div class="col-md-12">
                      <label for="categoryimage">Attachment Image</label>
                    <input type="file" class="form-control" id="productimg" name="productimg[]" placeholder="image"  >
                </div>
                <!--<div class="col-md-4">
                    <button  type="button" id="removebutton" class="btn btn-primary mr-2"> remove</button>
                </div>-->
                </div>
            </div>  
        </div>
</div>