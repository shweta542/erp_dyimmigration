
<?php $arr = explode('|',$privileges_settings->designation);

 $firstYear = (int)date('Y') - 50;
$lastYear = $firstYear + 50;

?>

<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Edit Call-detail</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Edit Call-detail</li>
					</ul>
				</div>
				<div class="col-auto float-right ml-auto">
					<a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_head"><i class="fa fa-plus"></i> Edit Call-detail</a>
				</div>
			</div>
		</div>
		<!--<div class="row filter-row">
			<div class="col-md-10">
			
			</div>
			<div class="col-sm-6 col-md-2">
				<div class="form-group form-focus">
					<input type="text" class="form-control floating" />
					<label class="focus-label">Search..</label>
				</div>
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-12">
			   <form class="editcallerdata">
					<input type="hidden" name="call_id" value="<?= $key->call_id ?>">
							<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Select Lead Course <span class="text-danger">*</span></label>
									<select class="form-control" name="leadsource" >
						        	<option value=""></option>
									<option <?= ($key->leadsource == 'Walkin')? 'selected' :'' ?> value="Walkin">Walkin</option>
									<option <?= ($key->leadsource == 'Social Media')? 'selected' :'' ?> value="Social Media">Social Media</option>
									<option <?= ($key->leadsource == 'Telecalling')? 'selected' :'' ?> value="Telecalling">Telecalling</option>
									<option <?= ($key->leadsource == 'Refernce')? 'selected' :'' ?> value="Refernce">Refernce</option>
                                            
							</div>
						</div>
				
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Student Name <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="name" value="<?= $key->name ?>" required="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Father Name</label>
								<input class="form-control" type="text" name="fathername" value="<?= $key->father_name ?>"  />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email<span class="text-danger">*</span></label>
								<input class="form-control" value="<?= $key->email ?>" type="email" name="email" required="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone<span class="text-danger">*</span></label>
								<input class="form-control" type="number" value="<?= $key->phone ?>" name="phone" required="" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>DOB</label>
								<input class="form-control mydatepickerholi" value="<?= $key->dob ?>" type="text" name="dob"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Age</label>
								<input class="form-control" value="<?= $key->age ?>" type="text" name="age"  />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Gender</label>
								<select class="form-control" name="gender" >
									<option>Select Gender</option>
									<option <?= ($key->gender == 'Male')? 'selected' :'' ?> value="Male">Male</option>
									<option <?= ($key->gender == 'Female')? 'selected' :'' ?> value="Female">Female</option>
									<option <?= ($key->gender == 'Other')? 'selected' :'' ?> value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Address</label>
								<textarea class="form-control"  name="address" ><?= $key->address ?></textarea> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Counselor</label>
								<select class="form-control" name="counselor" >
									<option>Select Counselor</option>
									<?php foreach ($counselor as $key1 => $value) {
										?>
										<option <?= ($key->counselor_id ==  $value->USER_ID)? 'selected' :'' ?> value="<?= $value->USER_ID ?>"><?= $value->USER_NAME ?></option>
										<?php
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Country</label>
								<select class="form-control select" name="country" id="country">
									<option value="">Selete Country</option>
									<?php
									foreach ($this->db->get('country')->result() as $key1) {
									
									?>
									<option <?= ($key1->id == $key->country)?'selected':'' ?> value="<?= $key1->id ?>" ><?= $key1->country_name ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>State</label>
								<select class="form-control select" name="state" id="state">
								<?php 
								
								if($key->state !=""){
									foreach ($this->db->where('country_id',$key->country)->get('states')->result() as $key1) {
										
									?>
									<option value="<?= $key1->id ?>" <?php if($key1->id == $key->state){echo "selected";}?>><?= $key1->name ?></option>
									<?php
								}
								}
							   
								 ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<select class="form-control select" name="city" id="city">
								<?php 
								
								if($key->city !=""){
									foreach ($this->db->where('state_id',$key->state)->get('cities')->result() as $key1) {
									?>
									<option value="<?= $key1->id ?>" <?php if($key1->id == $key->city){echo "selected";}?>><?= $key1->name ?></option>
									<?php
								}
								} 
								
								 ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> English Test</label>
                                                <select class="form-control" name="english_test" onchange="selectenglishtest(this.value)">
                                                    <option value="">Select English Test</option>
                                                    <option <?= ($key->english_test == "IELTS")?'selected':'' ?>  value="IELTS">IELTS</option>
                                                    <option <?= ($key->english_test == "PTE")?'selected':'' ?>  value="PTE">PTE</option>
                                                    <option <?= ($key->english_test == "Duolingo")?'selected':'' ?>  value="Duolingo">Duolingo</option>
                                                    <option <?= ($key->english_test == "Toefl")?'selected':'' ?>  value="Toefl">Toefl</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Score Overall</label>
                                               <div id="scoreOverall">
                                                   <?php if($key->english_test == "IELTS"){
                                                   	?>
                                                   	<select class="form-control" name="score" >
                                                   		<option value="">Select Score</option>
                                                   		<option <?= ($key->language_score == '5')? 'selected':'' ?> value="5" >5</option>
                                                   		<option <?= ($key->language_score == '5.5')? 'selected':'' ?> value="5.5" >5.5</option>
                                                   		<option <?= ($key->language_score == '6')? 'selected':'' ?> value="6" >6</option>
                                                   		<option <?= ($key->language_score == '6.5')? 'selected':'' ?> value="6.5" >6.5</option>
                                                   		<option <?= ($key->language_score == '7')? 'selected':'' ?> value="7" >7</option>
                                                   		<option <?= ($key->language_score == '7.5')? 'selected':'' ?> value="7.5" >7.5</option>
                                                   		<option <?= ($key->language_score == '8')? 'selected':'' ?> value="8" >8</option>
                                                   		<option <?= ($key->language_score == '8.5')? 'selected':'' ?> value="8.5" >8.5</option>
                                                   		<option <?= ($key->language_score == '9')? 'selected':'' ?> value="9" >9</option>
                                                   	</select>
                                                   	<?php
                                                   }else if($key->english_test == "PTE"){
													?>
													<select  class="form-control" name="score" >
														<option value="">Select Score</option>
														<option <?= ($key->language_score == '43-50')? 'selected':'' ?> value="43-50" >43-50</option>
														<option <?= ($key->language_score == '50-58')? 'selected':'' ?> value="50-58" >50-58</option>
														<option <?= ($key->language_score == '58-65')? 'selected':'' ?> value="58-65" >58-65</option>
														<option <?= ($key->language_score == '65-73')? 'selected':'' ?> value="65-73" >65-73</option>
														<option <?= ($key->language_score == '73-79')? 'selected':'' ?> value="73-79" >73-79</option>
														<option <?= ($key->language_score == '79-83')? 'selected':'' ?> value="79-83" >79-83</option>
													</select>
													<?php
                                                   }else if($key->english_test == "Duolingo"){
													?>
													<select  class="form-control" name="score" >
														<option value="">Select Score</option>
														<option <?= ($key->language_score == '90')? 'selected':'' ?> value="90" >90</option>
														<option <?= ($key->language_score == '95')? 'selected':'' ?> value="95" >95</option>
														<option <?= ($key->language_score == '100')? 'selected':'' ?> value="100" >100</option>
														<option <?= ($key->language_score == '110')? 'selected':'' ?> value="110" >110</option>
														<option <?= ($key->language_score == '115')? 'selected':'' ?> value="115" >115</option>
														<option <?= ($key->language_score == '120')? 'selected':'' ?> value="120" >120</option>
														<option <?= ($key->language_score == '125')? 'selected':'' ?> value="125" >125</option>
														<option <?= ($key->language_score == '130')? 'selected':'' ?> value="130" >130</option>
														<option <?= ($key->language_score == '135')? 'selected':'' ?> value="135" >135</option>
														<option <?= ($key->language_score == '140')? 'selected':'' ?> value="140" >140</option>
													</select>
													<?php
                                                   }else{
                                                   ?>
                                                   <input  type="text" class="form-control" name="score" value="<?= $key->language_score ?>"/>
                                                   <?php
                                                   } ?> 
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-sm-6 hidethispte" >
                                            <div class="form-group">
                                                <label>Extra Score</label>
                                                <input class="form-control " type="text" name="extra_score"  value="<?= $key->extra_score ?>"/>
                                            </div>
                                        </div>
                                          <div class="col-sm-6 hidethisduolingo" >
                                            <div class="form-group ">
                                                <label>Duolingo</label>
                                                <input class="form-control " type="text" name="duolingo_text"  value="<?= $key->duolingo_text ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
							<div class="form-group">
								<label>Passport</label>
								<input class="form-control" type="text" value="<?= $key->passport ?>" name="passport"  />
							</div>
						</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Reference</label>
								<input class="form-control" type="text" value="<?= $key->reference ?>" name="reference" />
							</div>
						</div>
						<div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Reading</label>
                                                <input class="form-control" type="text" name="reading"  value="<?= $key->reading ?>"/>
                                            </div>
                                        </div>
					</div>
					<div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Listening</label>
                                                <input class="form-control" placeholder="" type="text" name="listening"  value="<?= $key->listening ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Writing</label>
                                                <input class="form-control" placeholder="" type="text" name="writing"  value="<?= $key->writing ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Speaking</label>
                                                <input class="form-control" placeholder="" type="text" name="speaking"  value="<?= $key->speaking ?>" />
                                            </div>
                                        </div>
                                    </div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Remark <a href="javascript:void(0)" class="btn btn-primary addremark"><i class="fa fa-plus"></i></a></label>
								<?php foreach ($this->db->where('call_id',$key->call_id)->get('tbl_remark')->result() as $keyremark => $valueremark) {
									?>
									
										
								<input class="form-control" value="<?= $valueremark->remark ?>" type="text" name="remark[]"  /><br>
									

									<?php
								} ?>
								<div class='appendRemark'>
									</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="status" >
									<option>Select status</option>
									<?php foreach ($this->db->where('del_status',0)->order_by('status_id','DESC')->get('tbl_status')->result() as $key1 => $value) {
										?>
										<option <?php if($value->status_id == $key->status){echo "selected";}?> value="<?= $value->status_id ?>"><?= $value->status_title ?></option>
										<?php
									} ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Previous referral</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                Yes <input class="form-control checkreferral" type="radio" name="previous_referral" value="1"  <?= ($key->previous_referral == '1')?'checked':'' ?> />
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                         No <input class="form-control checkreferral" type="radio" name="previous_referral" value="2"  <?= ($key->previous_referral == '2')?'checked':'' ?> />
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6 previouscountry" style="display:<?= ($key->previous_referral == '1')?'block':'none' ?>" >
                                            <div class="form-group" >
                                                <label>Previous country<span class="text-danger">*</span></label>
                                               <input class="form-control" type="text" name="previous_country" value="<?= $key->previous_country ?>"  />
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Percentage in 12th English</label>
                                                <input class="form-control" type="number" name="percentageinenglish" value="<?= $key->percentageinenglish ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Previous travel history</label>
                                                <select class="form-control checktravelhistory" name="previoustravelhistory">
                                                    <option value="">Select option</option>
                                                    <option <?= ($key->previoustravelhistory == 'Yes')?'selected':'' ?> value="Yes">Yes</option>
                                                    <option <?= ($key->previoustravelhistory == 'no')?'selected':'' ?> value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="col-sm-6 travelhistory" style="display:<?= ($key->previoustravelhistory == 'Yes')?'block':'none' ?>">
                                            <div class="form-group">
                                                <label>Previous travel country</label>
                                                <input type="text" class="form-control" name="previoustravelcountryyes" value="<?= $key->previoustravelcountryyes ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Prefered Country</label>
                                                <select class="form-control " name="preferedCountry" >
                                                    <option value="">Select Country</option>
                                                    <option <?= ($key->preferedCountry == "Canada")?'selected':'' ?> value="Canada">Canada</option>
                                                    <option <?= ($key->preferedCountry == "USA")?'selected':'' ?> value="USA">USA</option> 
                                                    <option <?= ($key->preferedCountry == "UK")?'selected':'' ?> value="UK">UK</option>
                                                    <option <?= ($key->preferedCountry == "Greece")?'selected':'' ?> value="Greece">Greece</option>
                                                    <option <?= ($key->preferedCountry == "poland")?'selected':'' ?> value="poland">poland</option>
                                                    <option <?= ($key->preferedCountry == "Germany")?'selected':'' ?> value="Germany">Germany</option> 
                                                    <option <?= ($key->preferedCountry == "Singapore")?'selected':'' ?> value="Singapore">Singapore</option>
                                                    <option <?= ($key->preferedCountry == "Ukraine")?'selected':'' ?> value="Ukraine">Ukraine</option>
                                                    <option <?= ($key->preferedCountry == "Russian")?'selected':'' ?> value="Russian">Russian</option>
                                                    <option <?= ($key->preferedCountry == "New zealand")?'selected':'' ?> value="New zealand">New zealand</option>
                                                    <option <?= ($key->preferedCountry == "Multa")?'selected':'' ?> value="Multa">Multa</option> 
                                                    <option <?= ($key->preferedCountry == "Sweden")?'selected':'' ?> value="Sweden">Sweden</option>cyprus
                                                    <option <?= ($key->preferedCountry == "Australia")?'selected':'' ?> value="Australia">Australia</option>
                                                    <option <?= ($key->preferedCountry == "Cyprus")?'selected':'' ?> value="Cyprus">Cyprus</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 travelhistory" >
                                            <div class="form-group">
                                                <label>Prefered City</label>
                                                <input type="text" class="form-control" name="preferedCity" value="<?= $key->preferedCity ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <div class="form-group">
                                                <label>Package/Consultancy</label>
                                               <select class="form-control packageConsultancy" name="packageConsultancy" >
                                                   <option value="">Select</option>
                                                   <option <?= ($key->packageConsultancy == 'Package')?'selected':''?> value="Package">Package</option>
                                                   <option <?= ($key->packageConsultancy == 'Consultancy')?'selected':'' ?> value="Consultancy">Consultancy</option>
                                               </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 packagehide" style="display:<?= ($key->packageConsultancy == 'Package')?'block':'none' ?>">
                                            <div class="form-group">
                                                <label>Total Amount</label>
                                                <input type="text" class="form-control" name="packagetotalamount" value="<?= $key->packagetotalamount ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 packagehide" style="display:<?= ($key->packageConsultancy == 'Package')?'block':'none' ?>">
                                            <div class="form-group">
                                                <label>Before Visa</label>
                                                <input type="text" class="form-control" name="packagebeforevisa" value="<?= $key->packagebeforevisa ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 packagehide" style="display:<?= ($key->packageConsultancy == 'Package')?'block':'none' ?>">
                                            <div class="form-group">
                                                <label>Package Include</label>
                                                <input type="text" class="form-control" name="packageinclude" value="<?= $key->packageinclude ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 packagehide" style="display:<?= ($key->packageConsultancy == 'Package')?'block':'none' ?>">
                                            <div class="form-group">
                                                <label>After Visa</label>
                                                <input type="text" class="form-control" name="packageaftervisa" value="<?= $key->packageaftervisa ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 consultancyhide" style="display:<?= ($key->packageConsultancy == 'Consultancy')?'block':'none' ?>">
                                            <div class="form-group">
                                                <label>Before Visa</label>
                                                <input type="text" class="form-control" name="consultancybeforevisa" value="<?= $key->consultancybeforevisa ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 consultancyhide" style="display:<?= ($key->packageConsultancy == 'Consultancy')?'block':'none' ?>">
                                            <div class="form-group">
                                                <label>After Visa</label>
                                                <input type="text" class="form-control" name="consultancyaftervisa" value="<?= $key->consultancyaftervisa ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                       <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label>GIC</label>
                                                <input type="file" class="form-control" name="gic" id="filePhoto" accept=".pdf">
                                                <span class="form-text text-muted">Only pdf File allowed</span>
                                            </div>
                                        </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <div class="img-thumbnail float-right ">
                                                      <a href="<?= $key->GIC ?>"   target="_blank">
                                                        <img src="images/pdf.png" width=80 height=80  
                                                       />
                                                          </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                 
                                    
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label>SOP</label>
                                                <input type="file" class="form-control" name="sop" id="filePhoto" accept=".pdf">
                                                <span class="form-text text-muted">Only pdf File allowed</span>
                                            </div>
                                        </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <div class="img-thumbnail float-right ">
                                                      <a href="<?= $key->SOP ?>"   target="_blank">
                                                        <img src="images/pdf.png" width=80 height=80  
                                                       />
                                                          </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label>LOR</label>
                                                <input type="file" class="form-control" name="lor" id="filePhoto" accept=".pdf">
                                                <span class="form-text text-muted">Only pdf File allowed</span>
                                            </div>
                                        </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <div class="img-thumbnail float-right ">
                                                      <a href="<?= $key->LOR ?>"   target="_blank">
                                                        <img src="images/pdf.png" width=80 height=80  
                                                       />
                                                          </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                       
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label>Fee Receipt</label>
                                                <input type="file" class="form-control" name="fee_receipt" id="filePhoto" accept=".pdf">
                                                <span class="form-text text-muted">Only pdf File allowed</span>
                                            </div>
                                        </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <div class="img-thumbnail float-right ">
                                                      <a href="<?= $key->FEERECEIPT ?>"   target="_blank">
                                                        <img src="images/pdf.png" width=80 height=80  
                                                       />
                                                          </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
					<?php $metadata=$this->db->where('call_id',$key->call_id)->get('tbl_call_meta')->result();?>
					<div class="form-group appendAcademicedit">
						<label>Academic Details <a href="javascript:void(0);" class="btn btn-primary addAcademicedit" ><i class="fa fa fa-plus"></i></a></label>
						<?php foreach ($metadata as $key1 => $value) {
							?>
					    <div class="addItemDiv">
						    <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Course<span class="text-danger">*</span></label>
											<?php foreach ($class as $key ) {
										?>
										<option <?= ($key->class_id == $value->course)?'Selected':'' ?> value="<?= $key->class_id ?>"><?= $key->class_name ?></option>
										<?php
									} ?>
										<!--<input class="form-control" type="text" name="course[]" required="" value="<?= $value->course ?>"/>-->
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Board/University<span class="text-danger">*</span></label>
										<select class="form-control" name="boardanduniversity[]" >
									<option>Select Board & university</option>
									<?php foreach ($boardanduniversity as $key ) {
										?>
										<option <?= ($key->id == $value->boardanduniversity)?'Selected':'' ?> value="<?= $key->id ?>"><?= $key->name ?></option>
										<?php
									} ?>
								</select>
										<!--<input class="form-control" type="text" name="boardanduniversity[]" required="" value="<?= $value->boardanduniversity ?>"/>-->
									</div>
								</div>
								 <div class="col-md-6">
									<div class="form-group">
										<label>Percentage<span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="percentage[]"  value="<?= $value->percentage ?>"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Passing Year<span class="text-danger">*</span></label>
											<select class="form-control" name="passingyear[]" >
									<option value="">Select Year</option>
									<?php 
									for($i=$firstYear;$i<=$lastYear;$i++){
										?>
										<option <?= ($i == $value->passingyear)?'Selected':'' ?> value="<?= $i ?>"><?= $i ?></option>
										<?php
									} ?>
								</select>
										<!--<input class="form-control" type="text" name="passingyear[]" required="" value="<?= $value->passingyear ?>"/>-->
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Stream/Other<span class="text-danger">*</span></label>
										 <select class="form-control" name="streamandother[]" >
									<option>Select Stream</option>
									<?php foreach ($stream as $key ) {
										?>
										<option <?= ($key->stream_id == $value->streamandother)?'Selected':'' ?> value="<?= $key->stream_id ?>"><?= $key->stream_name ?></option>
										<?php
									} ?>
								</select>
										<!--<input class="form-control" type="text" name="streamandother[]" required="" value="<?= $value->streamandother ?>"/>-->
									</div>
								</div>
								
								
								
								
								
								<div class="col-md-6">
                    				<div class="form-group">
                    					<label>&nbsp;</label>
                    					<div>
                    						<a class="btn btn-danger removeAcademic"><i class="fa fa fa-trash"></i></a>
                    					</div>
                    				</div>
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

<div style="display: none" class="getAcademicDetails">
	<div class="addItemDiv">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Course<span class="text-danger">*</span></label>
					<select class="form-control" name="course[]">
									<option>Select Course</option>
									<?php foreach ($class as $key ) {
										?>
										<option value="<?= $key->class_id ?>"><?= $key->class_name ?></option>
										<?php
									} ?>
								</select>
					<!--<input class="form-control" type="text" name="course[]" required="" />-->
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Board/University<span class="text-danger">*</span></label>
					<select class="form-control" name="boardanduniversity[]" >
									<option>Select Board & university</option>
									<?php foreach ($boardanduniversity as $key ) {
										?>
										<option value="<?= $key->id ?>"><?= $key->name ?></option>
										<?php
									} ?>
								</select>
					<!--<input class="form-control" type="text" name="boardanduniversity[]" required="" />-->
				</div>
			</div>
			 <div class="col-md-6">
				<div class="form-group">
					<label>Percentage<span class="text-danger">*</span></label>
					<input class="form-control" type="text" name="percentage[]"  />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Passing Year<span class="text-danger">*</span></label>
					<select class="form-control" name="passingyear[]">
									<option value="">Select Year</option>
									<?php 
									for($i=$firstYear;$i<=$lastYear;$i++){
										?>
										<option  value="<?= $i ?>"><?= $i ?></option>
										<?php
									} ?>
								</select>
					<!--<input class="form-control" type="text" name="passingyear[]" required="" />-->
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Stream/Other<span class="text-danger">*</span></label>
					 <select class="form-control" name="streamandother[]" >
									<option>Select Stream</option>
									<?php foreach ($stream as $key ) {
										?>
										<option value="<?= $key->stream_id ?>"><?= $key->stream_name ?></option>
										<?php
									} ?>
								</select>
					<!--<input class="form-control" type="text" name="streamandother[]" required="" />-->
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>&nbsp;</label>
					<div>
						<a href="javascript:void(0);" class="btn btn-danger removeAcademic"><i class="fa fa fa-trash"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
