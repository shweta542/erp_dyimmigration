
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Branch Settings</h3>
							</div>
						</div>
					</div>

					<form id="<?= (isset($editbranch))?'editBranch':'addBranch' ?>">
						<?php if(isset($editbranch)){
							?>
							<input type="hidden" name="branch_id" value="<?= (isset($editbranch))?$editbranch->branch_id:'' ?>" >
							<?php
						}else{
							?>

						<input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">

						<input type="hidden" name="datetime" value="<?= date('dd-mm-yyyy hh:mm a') ?>">
							<?php
						} ?>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Branch Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="branch_name" placeholder="Enter Branch" required="true" value="<?= (isset($editbranch))?$editbranch->branch_name:'' ?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Branch Head</label>
									<input class="form-control" placeholder="Enter head" name="branch_head" type="text" value="<?= (isset($editbranch))?$editbranch->branch_head:'' ?>"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Address</label>
									<input name="branch_address" class="form-control" placeholder="Enter address" type="text" value="<?= (isset($editbranch))?$editbranch->branch_address:'' ?>"/>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>Country</label>
									<select class="form-control select" name="branch_country" id="country">
									<option value="">Selete Country</option>
									<?php
									foreach ($this->db->get('country')->result() as $key) {
									
									?>
									<option <?php if(isset($editbranch)){if($editbranch->branch_country == $key->id){echo 'selected';}} ?> value="<?= $key->id ?>" ><?= $key->country_name ?></option>
									<?php
									}
									?>
									</select>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>State</label>
									<select class="form-control select" name="branch_state" id="state">

									<?php 
									if (isset($editbranch)) {
									
									if($editbranch->branch_state !=""){
										foreach ($this->db->where('country_id',$editbranch->branch_country)->get('states')->result() as $key) {
											
										?>
										<option value="<?= $key->id ?>" <?php if($key->id == $editbranch->branch_state){echo "selected";}?>><?= $key->name ?></option>
										<?php
									}
									}
									}
									 ?>
									
									</select>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>City</label>
									<select class="form-control select" name="branch_city" id="city">
									<?php 
									if (isset($editbranch)) {
									
									if($editbranch->branch_city !=""){
										foreach ($this->db->where('state_id',$editbranch->branch_city)->get('cities')->result() as $key) {
										?>
										<option value="<?= $key->id ?>" <?php if($key->id == $editbranch->branch_city){echo "selected";}?>><?= $key->name ?></option>
										<?php
									}
									} 
									}
									 ?>
									
									</select>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>Pin Code</label>
									<input class="form-control" placeholder="Enter pin" type="number" name="branch_pin" value="<?= (isset($editbranch))?$editbranch->branch_pin:'' ?>"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" placeholder="xyz@example.com" type="email" name="branch_email" value="<?= (isset($editbranch))?$editbranch->branch_email:'' ?>"/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>GST Number</label>
									<input class="form-control" placeholder="Enter GST" type="text" name="branch_gst" value="<?= (isset($editbranch))?$editbranch->branch_gst:'' ?>"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile Number</label>
									<input class="form-control" placeholder="Enter phone number" type="text" name="branch_phone" value="<?= (isset($editbranch))?$editbranch->branch_phone:'' ?>" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Website Url</label>
									<input class="form-control" placeholder="https://www.example.com" type="url" name="branch_url" value="<?= (isset($editbranch))?$editbranch->branch_url:'' ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-10">
								<div class="form-group">
									<label>Branch Icon</label>
									<input type="file" class="form-control" name="branch_logo" id="filePhoto" accept="image/png, image/gif, image/jpeg">
									<span class="form-text text-muted">Recommended image size is 80px x 80px</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<div class="img-thumbnail float-right "><img id="previewHolder" src="<?php if(isset($editbranch)){if($editbranch->branch_logo){echo $editbranch->branch_logo;}else{echo 'assets/img/user.jpg';}}else{echo 'assets/img/user.jpg';} ?>" alt="" width="80" height="80"></div>
								</div>
							</div>
						</div>
						<div class="submit-section">
							<button type="submit" class="btn btn-primary submit-btn">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

		

      
 