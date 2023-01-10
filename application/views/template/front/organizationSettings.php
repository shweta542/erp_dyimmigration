<?php $arr = explode('|',$privileges_settings->organizationSetting) ?>
<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Organization Settings</h3>
							</div>
						</div>
					</div>

					<form id="updateOrganization">
						<input type="hidden" name="oraganisation_id" value="<?= $data->oraganisation_id ?>">
						<div class="row"> 
							<div class="col-sm-6">
								<div class="form-group">
									<label>Organization Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="oraganisation_name" value="<?= $data->oraganisation_name ?>" required="true"/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Owner Name</label>
									<input class="form-control" name="oraganisation_person" value="<?= $data->oraganisation_person ?>" type="text" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Address</label>
									<input class="form-control" name="oraganisation_address" value="<?= $data->oraganisation_address ?>" type="text" />
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>Country</label>
									<select class="form-control select" name="oraganisation_country" id="country">
									<option value="">Selete Country</option>
									<?php
									foreach ($this->db->get('country')->result() as $key) {
									
									?>
									<option value="<?= $key->id ?>" <?php if($key->id == $data->oraganisation_country){echo "selected";}?>><?= $key->country_name ?></option>
									<?php
									}
									?>
									</select>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>State</label>
									<select class="form-control select" name="oraganisation_state" id="state">
									<option value="">Selete State</option>
									<?php if($data->oraganisation_state !=""){
										foreach ($this->db->where('country_id',$data->oraganisation_country)->get('states')->result() as $key) {
											
										?>
										<option value="<?= $key->id ?>" <?php if($key->id == $data->oraganisation_state){echo "selected";}?>><?= $key->name ?></option>
										<?php
									}
									} ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>City</label>
									<select class="form-control select" name="oraganisation_city" id="city">
									<option value="">Selete City</option>
									<?php if($data->oraganisation_city !=""){
										foreach ($this->db->where('state_id',$data->oraganisation_state)->get('cities')->result() as $key) {
										?>
										<option value="<?= $key->id ?>" <?php if($key->id == $data->oraganisation_city){echo "selected";}?>><?= $key->name ?></option>
										<?php
									}
									} ?>
									</select>
								</div>
							</div>
							
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="form-group">
									<label>Pin Code</label>
									<input class="form-control" name="oraganisation_pin" value="<?= $data->oraganisation_pin ?>" type="number" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" name="oraganisation_email" value="<?= $data->oraganisation_email ?>" type="email" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>GST Number</label>
									<input class="form-control" name="oraganisation_gst" value="<?= $data->oraganisation_gst ?>" type="number" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile Number <span class="text-danger">*</span></label>
									<input class="form-control" name="oraganisation_phone" value="<?= $data->oraganisation_phone ?>" type="text" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Website Url</label>
									<input class="form-control" name="oraganisation_url" value="<?= $data->oraganisation_url ?>" type="text" />
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-10">
								<div class="form-group">
									<label>Company Logo</label>
									<input type="file" class="form-control" name="oraganisation_logo" id="filePhoto" accept="image/png, image/gif, image/jpeg">
									<span class="form-text text-muted">Recommended image size is 80px x 80px</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<?php if($data->oraganisation_logo){
									?>
									<div class="img-thumbnail float-right "><img id="previewHolder" src="<?= $data->oraganisation_logo?>" alt="" width="80" height="80"></div>
									<?php
									}else{
										?>
									
									<div class="img-thumbnail float-right "><img id="previewHolder" src="assets/img/logo2.png" alt="" width="80" height="80"></div>
									<?php
									} ?>
								</div>
							</div>
						</div>
							<div class="row">
							<div class="col-sm-10">
								<div class="form-group">
									<label>Company Fav Icon</label>
									<input type="file" class="form-control" name="oraganisation_favicon" id="filePhoto" accept="image/png, image/gif, image/jpeg">
									<span class="form-text text-muted">Recommended image size is 80px x 80px</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<?php if($data->oraganisation_favicon){
									?>
									<div class="img-thumbnail float-right "><img id="previewHolder" src="<?= $data->oraganisation_favicon?>" alt="" width="80" height="80"></div>
									<?php
									}else{
										?>
									
									<div class="img-thumbnail float-right "><img id="previewHolder" src="assets/img/logo2.png" alt="" width="80" height="80"></div>
									<?php
									} ?>
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