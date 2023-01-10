<?php 
$department=$this->db->where('department_id',$profiledata->department_id)->get('tbl_department')->row();
$designation=$this->db->where('designation_id',$profiledata->designation_id)->get('tbl_designation')->row();
$arr=explode('|', $profiledata->branch_id);
$education=$this->db->where('user_id',$profiledata->USER_ID)->get('tbl_education')->result();
$experience=$this->db->where('user_id',$profiledata->USER_ID)->get('tbl_experience')->result();
 ?>
<div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Profile</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-view">
                                        <div class="profile-img-wrap">
                                            <div class="profile-img">
                                                <a href="javascript:void(0)"><img alt="" src="<?= ($profiledata->user_image)?:'assets/img/user.jpg' ?>" /></a>
                                            </div>
                                        </div>
                                        <div class="profile-basic">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="profile-info-left">
                                                        <h3 class="user-name m-t-0 mb-0"><?= $profiledata->USER_NAME ?> <?= $profiledata->user_last_name ?></h3>
                                                        <h6 class="text-muted"><?= (!empty($designation))?$designation->designation_name:'' ?></h6>
                                                        <div class="small doj text-muted">Date of Join : <?= $profiledata->Joining_date ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <ul class="personal-info">
                                                        <li>
                                                            <div class="title">Department:</div>
                                                            <div class="text"><?= ($department)?$department->department_name:'-' ?></div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Branch:</div>
                                                            <div class="text">
                                                            <?php foreach ($arr as $key => $value) {
                                                                $branchdata=$this->db->where('branch_id',$value)->get('tbl_branch')->row();
                                                                ?>

                                                            <?= (!empty($branchdata))?$branchdata->branch_name:'-' ?>
                                                                <?php
                                                            } ?>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Address:</div>
                                                            <div class="text"><?= (!empty($profilemetadata->address))?$profilemetadata->address:'-' ?></div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Gender:</div>
                                                            <div class="text"><?= (!empty($profilemetadata->gender))?$profilemetadata->gender:'-' ?></div>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($id == $logged_in_user->USER_ID){ ?>
                                        <div class="pro-edit">
                                            <a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="emp_profile" class="pro-overview tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                Personal Informations  <?php if($id == $logged_in_user->USER_ID){ ?><a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a>
                                                <?php } ?>
                                            </h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a href="tel:9876543210"><?= $profiledata->USER_PHONE ?></a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">
                                                        <a href="mailto:<?= $profiledata->USER_EMAIL ?>"><?= $profiledata->USER_EMAIL ?></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text"><?= (!empty($profilemetadata->dob))?$profilemetadata->dob:'-' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Marital status</div>
                                                    <div class="text"><?= (!empty($profilemetadata->marital_status))?$profilemetadata->marital_status:'-' ?></div>
                                                </li>
                                                  <li>
                                                    <div class="title">Salary</div>
                                                    <div class="text"><?= $profiledata->employee_salary ?></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                             <h3 class="card-title">
                                                Bank information <?php if($id == $logged_in_user->USER_ID){ ?><a href="#" class="edit-icon" data-toggle="modal" data-target="#bank_info_modal"><i class="fa fa-pencil"></i></a><?php } ?>
                                            </h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Bank Name</div>
                                                    <div class="text"><?= (!empty($profilemetadata->bank_name))?$profilemetadata->bank_name:'-' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Bank Account No.</div>
                                                    <div class="text"><?= (!empty($profilemetadata->bank_account))?$profilemetadata->bank_account:'-' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">IFSC Code</div>
                                                    <div class="text"><?= (!empty($profilemetadata->ifsc_code))?$profilemetadata->ifsc_code:'-' ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">PAN No</div>
                                                    <div class="text"><?= (!empty($profilemetadata->pan))?$profilemetadata->pan:'-' ?></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row" >
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                Education Informations <?php if($id == $logged_in_user->USER_ID){ ?><a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a><?php } ?>
                                            </h3>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    <?php if(!empty($education)){
                                                        foreach ($education as $educationkey ) {
                                                           ?>
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="#/" class="name"><?= $educationkey->institution ?></a>
                                                                <div><?= $educationkey->subject ?></div>
                                                                <span class="time"><?= $educationkey->startdate ?> - <?= $educationkey->enddate ?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                        <?php
                                                    } 
                                                    }
                                                    ?>

                                                   

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                Experience <?php if($id == $logged_in_user->USER_ID){ ?><a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a><?php } ?>
                                            </h3>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    <?php if (!empty($experience)) {
                                                       foreach ($experience as $experiencekey ) {
                                                           ?>

                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="#/" class="name"><?= $experiencekey->name ?></a>
                                                                <span class="time"><?= $experiencekey->datefrom ?> - <?= $experiencekey->dateto ?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    }
                                                    } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="profile_info" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Profile Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="profile_information">
                                    <input type="hidden" name="USER_ID" value="<?= $profiledata->USER_ID ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="profile-img-wrap edit-img">
                                                <img class="inline-block" id="blah" src="<?= ($profiledata->user_image)?$profiledata->user_image:'assets/img/user.jpg' ?>" alt="user" />
                                                <div class="fileupload btn">
                                                    <span class="btn-text">edit</span>
                                                    <input class="upload" type="file" name="user_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" value="<?= $profiledata->USER_NAME ?>" name="USER_NAME"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select class="select form-control" name="gender">
                                                            <option value="">Select gender</option>
                                                            <option <?php if(isset($profilemetadata)){if($profilemetadata->gender=='Male'){echo 'selected';}} ?> value="Male">Male</option>
                                                            <option <?php if(isset($profilemetadata)){if($profilemetadata->gender=='Female'){echo 'selected';}} ?> value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" value="<?= ($profilemetadata)?$profilemetadata->address:'' ?>" name="address"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control select" name="country" id="country">
                                    <option value="">Selete Country</option>
                                    <?php
                                    foreach ($this->db->get('country')->result() as $key) {
                                    
                                    ?>
                                    <option value="<?= $key->id ?>" <?php if(!empty($profilemetadata)){if($key->id == $profilemetadata->country){echo "selected";}}?>><?= $key->country_name ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control select" name="state" id="state">
                                    <option value="">Selete State</option>
                                    <?php if($profilemetadata->state !=""){
                                        foreach ($this->db->where('country_id',$profilemetadata->country)->get('states')->result() as $key) {
                                            
                                        ?>
                                        <option value="<?= $key->id ?>" <?php if($key->id == $profilemetadata->state){echo "selected";}?>><?= $key->name ?></option>
                                        <?php
                                    }
                                    } ?>
                                    </select>
                                            </div>
                                        </div>
                                       
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Branch<span class="text-danger">*</span></label>
                                                <select class="select" name="branch_id[]" required="true" multiple>
                                        <option value="" disabled="">Select Branch</option>
                                        <?php 
                                        $arr=explode('|',$profiledata->branch_id);
                                        foreach ($branch as $key ) {
                                            ?>
                                            <option value="<?= $key->branch_id ?>" <?php if(in_array($key->branch_id, $arr,true)){echo  'selected';} ?> ><?= $key->branch_name ?></option>
                                                <?php
                                        } ?>
                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Department <span class="text-danger">*</span></label>
                                               <select class="select" name="department_id" required="true" id="department">
                                        <option value="" disabled="">Select Department</option>
                                        <?php 

                                        foreach ($department1 as $key ) {
                                            ?>
                                            <option value="<?= $key->department_id ?>" <?php if($key->department_id== $profiledata->department_id){echo 'selected';} ?>><?= $key->department_name ?></option>
                                                <?php
                                        } ?>
                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation <span class="text-danger">*</span></label>
                                                <select class="select" name="designation_id" required="true" id="designation">
                                        <option value="" disabled="">Select Designation</option>
                                       <?php if($profiledata->department_id !=""){
                                        foreach ($this->db->where('department_id',$profiledata->department_id)->get('tbl_designation')->result() as $key) {
                                        ?>
                                        <option value="<?= $key->designation_id ?>" <?php if($key->designation_id == $profiledata->designation_id){echo "selected";}?>><?= $key->designation_name ?></option>
                                        <?php
                                    }
                                    } ?>
                                    </select>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="submit-section ssa">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                  <div id="bank_info_modal" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Bank Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="bank_info">
                                    <input type="hidden" name="USER_ID" value="<?= $profiledata->USER_ID ?>">
                                    <div class="row">
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bank Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" value="<?= (!empty($profilemetadata->bank_name))?$profilemetadata->bank_name:'' ?>" name="bank_name"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bank Account No. <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" value="<?= (!empty($profilemetadata->bank_account))?$profilemetadata->bank_account:'' ?>" maxlength="16" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" name="bank_account"/>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>IFSC Code <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" value="<?= (!empty($profilemetadata->ifsc_code))?$profilemetadata->ifsc_code:'' ?>" name="ifsc_code"/>
                                            </div>
                                        </div>
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>PAN No <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" value="<?= (!empty($profilemetadata->pan))?$profilemetadata->pan:'' ?>" name="pan"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-section gggg">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Personal Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="profile_information1">
                                    <input type="hidden" name="USER_ID" value="<?= $profiledata->USER_ID ?>">
                                    <div class="row">
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" name="USER_PHONE" class="form-control" value="<?= $profiledata->USER_PHONE ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Salary <span class="text-danger">*</span></label>
                                                <input class="form-control" name="employee_salary" type="text" value="<?= $profiledata->employee_salary ?>" />
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input class="form-control" name="USER_EMAIL" type="text" value="<?= $profiledata->USER_EMAIL ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Marital status <span class="text-danger">*</span></label>
                                                <select class="select form-control" name="marital_status">
                                                    <option value="">-</option>
                                                    <option <?php if(!empty($profilemetadata)){if($profilemetadata->marital_status == 'Single'){echo 'selected';}} ?> value="Single">Single</option>
                                                    <option <?php if(!empty($profilemetadata)){if($profilemetadata->marital_status == 'Married'){echo 'selected';}} ?> value="Married">Married</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control datetimepicker" type="text" value="<?= date('d/m/Y') ?>" name="dob"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

             

                <div id="education_info" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Education Informations</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="educationInformation">

                                    <input type="hidden" name="user_id" value="<?= $profiledata->USER_ID ?>">
                                    <div class="form-scroll">
                                        <?php if(!empty($education)){
                                            $i=1;
                                                        foreach ($education as $educationkey ) {
                                                           ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    Education Informations 
<?php if ($i++ != 1) {
   ?>

                                                    <a href="javascript:void(0);" class="delete-icon removeeducation"><i class="fa fa-trash-o"></i></a>
<?php 
} ?>
                                                </h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="institution[]" required="" value="<?= $educationkey->institution ?>"/>
                                                            <label class="focus-label">Institution</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="subject[]" required="" value="<?= $educationkey->subject ?>"/>
                                                            <label class="focus-label">Subject</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text"  class="form-control floating datetimepicker" name="startdate[]" required="" value="<?= $educationkey->startdate ?>"/>
                                                            </div>
                                                            <label class="focus-label">Starting Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text"  class="form-control floating datetimepicker" name="enddate[]" required="" value="<?= $educationkey->enddate ?>"/>
                                                            </div>
                                                            <label class="focus-label">Complete Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="degree[]" required="" value="<?= $educationkey->degree ?>"/>
                                                            <label class="focus-label">Degree</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="grade[]" required="" value="<?= $educationkey->grade ?>"/>
                                                            <label class="focus-label">Grade</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="addeducation"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                            </div>
                                        </div>
                                       <?php }
                                   }else{
                                    ?>
                                    <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    Education Informations 


                                                    

                                                </h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="institution[]" required="" value=""/>
                                                            <label class="focus-label">Institution</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="subject[]" required="" value=""/>
                                                            <label class="focus-label">Subject</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text"  class="form-control floating datetimepicker" name="startdate[]" required="" value=""/>
                                                            </div>
                                                            <label class="focus-label">Starting Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text"  class="form-control floating datetimepicker" name="enddate[]" required="" value=""/>
                                                            </div>
                                                            <label class="focus-label">Complete Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="degree[]" required="" value=""/>
                                                            <label class="focus-label">Degree</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="grade[]" required="" value=""/>
                                                            <label class="focus-label">Grade</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="addeducation"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                   } 
                                   ?>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="experience_info" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Experience Informations</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="experienceInformation">
                                    <input type="hidden" name="user_id" value="<?= $profiledata->USER_ID ?>">
                                    <div class="form-scroll appendExperience">
                                        <?php if (!empty($experience)) {
                                            $i=1;
                                                       foreach ($experience as $experiencekey ) {
                                                           ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    Experience Informations 
                                                    <?php if ($i++ != 1) {
   ?>
                                                    <a href="javascript:void(0);" class="delete-icon removeExperience" ><i class="fa fa-trash-o"></i></a>
                                                <?php } ?>
                                                </h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="<?= $experiencekey->name ?>" name="name[]"/>
                                                            <label class="focus-label">Company Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="<?= $experiencekey->location ?>" name="location[]"/>
                                                            <label class="focus-label">Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="<?= $experiencekey->position ?>" name="position[]"/>
                                                            <label class="focus-label">Job Position</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control floating datetimepicker" value="<?= $experiencekey->datefrom ?>" name="from[]"/>
                                                            </div>
                                                            <label class="focus-label">Period From</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control floating datetimepicker" value="<?= $experiencekey->dateto ?>"  name="to[]"/>
                                                            </div>
                                                            <label class="focus-label">Period To</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="addExperience"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } 
                                } else{
                                    ?>
                                    <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    Experience Informations 
                                                    
                                                </h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="" name="name[]"/>
                                                            <label class="focus-label">Company Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="" name="location[]"/>
                                                            <label class="focus-label">Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="" name="position[]"/>
                                                            <label class="focus-label">Job Position</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control floating datetimepicker" value="" name="from[]"/>
                                                            </div>
                                                            <label class="focus-label">Period From</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control floating datetimepicker" value=""  name="to[]"/>
                                                            </div>
                                                            <label class="focus-label">Period To</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="addExperience"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                ?>
                                    </div>
                                    <div class="submit-section dddd">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="geteducation" style="display: none">
                 <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    Education Informations <a href="javascript:void(0);" class="delete-icon removeeducation"><i class="fa fa-trash-o"></i></a>
                                                </h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="institution[]" required="" />
                                                            <label class="focus-label">Institution</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="subject[]" required=""/>
                                                            <label class="focus-label">Subject</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text"  class="form-control floating datetimepicker" name="startdate[]" required=""/>
                                                            </div>
                                                            <label class="focus-label">Starting Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text"  class="form-control floating datetimepicker" name="enddate[]" required=""/>
                                                            </div>
                                                            <label class="focus-label">Complete Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="degree[]" required=""/>
                                                            <label class="focus-label">Degree</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text"  class="form-control floating" name="grade[]" required=""/>
                                                            <label class="focus-label">Grade</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="add-more">
                                                    <a href="javascript:void(0);" class="addeducation"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                            </div>
                                        </div>
            </div>
           <div id="getExperience" style="display: none">
                <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    Experience Informations <a href="javascript:void(0);" class="delete-icon removeExperience"><i class="fa fa-trash-o"></i></a>
                                                </h3>
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="" name="name[]"/>
                                                            <label class="focus-label">Company Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="" name="location[]"/>
                                                            <label class="focus-label">Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <input type="text" class="form-control floating" value="" name="position[]"/>
                                                            <label class="focus-label">Job Position</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control floating datetimepicker" value=""  name="from[]"/>
                                                            </div>
                                                            <label class="focus-label">Period From</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control floating datetimepicker" value=""  name="to[]"/>
                                                            </div>
                                                            <label class="focus-label">Period To</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="addExperience"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                            </div>
                                        </div>
            </div>