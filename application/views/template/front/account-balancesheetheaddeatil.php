<?php $arrpro = explode('|',$privileges_settings->balanceSheet) ?>
<?php 
if (isset($_GET['branch'])) {
    $fdate =date('Y-m-d',strtotime($_GET['from']));
    $tdate =date('Y-m-d',strtotime($_GET['to']));
    $subheaddata1=$this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,j.*')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
             ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->where('j.head_id',$headid)
            ->where('j.moneyInOut',$moneyinout)
            ->get('tbl_journal j')
            ->result();
}else{
 $subheaddata1=$this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,j.*')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->where('j.head_id',$headid)
            ->where('j.moneyInOut',$moneyinout)
            ->get('tbl_journal j')
            ->result();   
}

            
?>
<style type="text/css">
    .journal-able tr:focus {
  background-color: #CCC !important;
}
</style>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Head Summary</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Head Summary</li>
					</ul>
				</div>
				
			</div>
		</div>
		 <form action="balancesheetheadDetail.html/<?= $moneyinout ?>/<?= $headid ?>" method="get">
         <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="select" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                <option <?php if(isset($_GET['branch'])){if($_GET['branch'] == $key->branch_id){echo 'Selected';}} ?> value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    }else{
                                        $branchArr=explode('|', $logged_in_user->branch_id)
                                        ?>
                                    <select class="select" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {

                                            ?>
                                <option <?php if(in_array($key->branch_id, $branchArr,true)){echo 'selected';}else{echo 'disabled';} ?> value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    } ?>
                    <label class="focus-label">Choose Branch</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                         <input class="form-control floating datetimepicker" type="text" name="from" required="" value="<?= (isset($_GET['from']))?$_GET['from']:'' ?>" />
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                       <input class="form-control floating datetimepicker" type="text" name="to" required="" value="<?= (isset($_GET['to']))?$_GET['to']:'' ?>"/>
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
        </form>
         <div class="review-header balan-hd">
                <div class="row">
                    <div class="col-md-12">
                        <div class="excel-hd-main">
                            <img width="190" src="<?= ($organisation_settings->oraganisation_logo)?$organisation_settings->oraganisation_logo:'assets/img/logo2.png' ?>" width="50" height="50">                    
                            <h3 class="review-title"><?= $organisation_settings->oraganisation_name ?></h3>
                            <h4><?= $subheaddata->heads_name ?></h4>
                            <p><?= $organisation_settings->oraganisation_address ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="excel-header-lft">
                             <?php if(isset($branchData)){
                    ?>
                            <p><b>Branch:</b> <?= $branchData->branch_name ?></p>
                             <?php
                }  ?>
                            <p><b>GSTIN:</b> <?= $organisation_settings->oraganisation_gst ?></p>
                            <p><b>Contact:</b>  <?= $organisation_settings->oraganisation_phone ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="excel-header-lft header-rt">
                            <p><b>Email:</b> <?= $organisation_settings->oraganisation_email ?></p>
                            <p><b>Website:</b> <?= $organisation_settings->oraganisation_url ?></p>
                            <?php  if(isset($_GET['from']) && isset($_GET['to'])){
                    ?>
                            <p><b>Balance Sheet:</b> <span><?= $_GET['from'] ?></span> To <span><?= $_GET['to'] ?></span></p>
                             <?php
                }
                ?>
                        </div>
                    </div>
                </div>
            </div>
        <!-- <div class="review-header balan-hd text-center">
                <h3 class="review-title">Vishvas Groups</h3>
                <h4><?= $subheaddata->heads_name ?></h4>
                <?php if(isset($branchData)){
                    ?>
                <p class="text-muted">Branch: <?= $branchData->branch_name ?></p>
                    <?php
                }  
                if(isset($_GET['from']) && isset($_GET['to'])){
                    ?>

                <p class="text-muted">Transaction Summary From<span> <?= $_GET['from'] ?></span> To <span><?= $_GET['to'] ?></span></p>
                    <?php
                }
                ?>
            </div> -->
            <input type="hidden" id="autosno" value="1">
                    <input type="hidden" id="trid" value="">
		 <div class="row">
			<div class="col-md-12">
				<div class="table-responsive journal-able">
					<table class="table table-striped custom-table testtable">
						<thead>
							<tr>
								 <th style="width: 30px;">#</th>
								<th>Date</th>
								<th>Description</th>
								<th>Payment Method</th>
								<!-- <th>Vendor/Customer</th> -->
								<th>Amount Debit</th>
								<th>Amount Credit</th>
								<th>Balance</th>
								<th class="text-right no-sort">Action</th>
							</tr>
						</thead>
						<tbody>
                            <?php 
                            $i=1;
                             $w =1;
                             $arr = array();
                            foreach ($subheaddata1 as $key => $value) {
                                $bank1=$this->db->where('bank_id',$value->method)->get('tbl_bank')->row();
                                $vendorCustomer1=$this->db->where('vendorcustomer_id',$value->vendorCustomer)->get('tbl_vendorcustomer')->row();
                                if($key == '0'){
                                    if($value->moneyInOut == '1'){
                                        $bal = $value->amount + 0;
                                        array_push($arr,$bal);
                                    }else{
                                        $bal = -$value->amount ;
                                        array_push($arr,$bal);
                                    }
                                
                            }else{
                                
                                if($value->moneyInOut == '1'){
                                        $bal = $value->amount + $arr[$key-1];
                                        array_push($arr,$bal);
                                    }else{
                                        $bal =   $arr[$key-1] - $value->amount;
                                        array_push($arr,$bal);
                                    }
                            }
                                ?>
    							<tr tabindex='<?= $w++ ?>' data-trid="<?= $value->journal_id ?>">
    							   <td><?= $i++ ?></td>
    							   <td><?= date('d M Y ',strtotime($value->date)) ?></td>
    							  <td>
                                        <p class="jrnl-dis"><?= $value->description ?></p>
                                        <span class="badge bg-inverse-warning"><?= ($value->heads_name)?$value->heads_name:'' ?> </span>
                                       
                                  </td>
    							  <td><?= ($bank1)?$bank1->bank_name:'' ?></td>
    							  <!-- <td><?= ($vendorCustomer1)?$vendorCustomer1->vendorcustomer_name:'' ?>
                                      <span class="badge bg-inverse-warning"><?php if($vendorCustomer1){if($vendorCustomer1->status==1){echo 'Suppliers';}else{echo 'Buyer';}} ?></span>
                                  </td>  -->
    							  <td><?= ($value->moneyInOut == '2')?'<span class="badge bg-inverse-danger">'.$value->amount.'</span>':'--' ?></td>
                                  <td><?= ($value->moneyInOut == '1')?'<span class="badge bg-inverse-success">'.$value->amount.'</span>':'--' ?></td>
    							  <td><?= $bal ?></td>
                                   <?php  if(in_array('3', $arrpro) ||  in_array('4', $arrpro)){
    ?>
    								<td class="text-right">

    									<div class="dropdown dropdown-action">
    										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
    										<div class="dropdown-menu dropdown-menu-right">
                                                 <?php if (in_array('3', $arrpro,true)) {
                                                            ?>
    											<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_entries<?= $value->journal_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <?php } ?>
                                                <?php if (in_array('4', $arrpro,true)) {
                                                            ?>
    											<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_entry<?= $value->journal_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                 <?php } ?>
    										</div>
    									</div>
    								</td>
                                    <?php } ?>
                                    <?php
                                  
                                  $subHeaddatatest=$this->db->where('heads_fk',$value->head_id)->where('subheads_fk',0)->get('tbl_heads')->result();
                                  $subHeaddata=$this->db->where('heads_fk',$value->head_id)->where('subheads_fk',0)->get('tbl_heads')->result();
                                  ?>
                                    <div id="edit_entries<?= $value->journal_id ?>" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Journal Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="editjournalentry">
                        <input type="hidden" name="moneyInOut" id="moneyInOut<?= $value->journal_id ?>" value="<?= $value->moneyInOut ?>">

                        <input type="hidden" name="group_fk" id="group<?= $value->journal_id ?>" value="<?= $value->group_fk ?>">
                        
                        <input type="hidden" name="journal_id" value="<?= $value->journal_id ?>">
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control mydatepickerjournal" type="text" value="<?= date('d M Y',strtotime( $value->date )) ?>" name="date" required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Category <span class="text-danger">*</span></label>
                            <select class="form-control mymoneyInOutedit" name="moneyInOut" >
                                                   <option value="">Select In/Out </option>
                                                   <option <?php if($value->moneyInOut){if($value->moneyInOut == 1){echo 'selected';}} ?> value="1">MoneyIn </option>
                                                   <option <?php if($value->moneyInOut){if($value->moneyInOut == 2){echo 'selected';}} ?> value="2">MoneyOut </option>
                                               </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Category <span class="text-danger">*</span></label>          
                                <select class="form-control select2 categoryedit" name="head_id" required="" >
                                    <option value="">Select Category</option>
                                    <?php foreach ($this->db->where('heads_fk',0)->where('group_status',0)->get('tbl_heads')->result() as $key) {
                                              ?>
                                               <option data-groupstatus="<?= $key->group_status ?>" data-group="<?= $key->group_fk ?>" data-mainid="<?= $value->journal_id ?>" data-id="1" <?php if($value->head_id){if($value->head_id == $key->heads_id){echo 'selected';}} ?> value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                    <?php
                                            } ?>

                                            <?php foreach ($this->db->where('heads_fk',0)->where('group_status',1)->get('tbl_heads')->result() as $key) {
                                              ?>
                                               <option data-groupstatus="<?= $key->group_status ?>" data-group="<?= $key->group_fk ?>" data-mainid="<?= $value->journal_id ?>" data-id="1" <?php if($value->head_id){if($value->head_id == $key->heads_id){echo 'selected';}} ?> value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                    <?php
                                            } ?>
                                        <!-- <optgroup label="Money In">
                                            <?php foreach ($moneyIn as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-mainid="<?= $value->journal_id ?>" data-id="1" <?php if($value->head_id){if($value->head_id == $key->heads_id){echo 'selected';}} ?> value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Money Out">
                                           <?php foreach ($moneyOut as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-mainid="<?= $value->journal_id ?>" data-id="2" <?php if($value->head_id){if($value->head_id == $key->heads_id){echo 'selected';}} ?> value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Debtor">
                                           <?php foreach ($debtor as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-mainid="<?= $value->journal_id ?>" data-id="1" <?php if($value->head_id){if($value->head_id == $key->heads_id){echo 'selected';}} ?> value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Creditor">
                                           <?php foreach ($creditor as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-mainid="<?= $value->journal_id ?>" data-id="2" <?php if($value->head_id){if($value->head_id == $key->heads_id){echo 'selected';}} ?> value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup> -->
                                    </select>
                                    <!-- <a class="addbutton" href="#add_head" data-toggle="modal"><i class="fa fa-plus-circle"></i></a> -->
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Sub Head <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" name="sub_head_id" id="subHead<?= $value->journal_id ?>" required="">
                                      <option value="">Select Sub head</option>  
                                        <?php foreach ($subHeaddata as $key) {
                                          ?>
                                           <option <?php if($value->sub_head_id){if($value->sub_head_id == $key->heads_id){echo 'selected';}} ?> value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>  
                                          <?php 
                                        } ?>
                                    </select>
                                   <!--  <a class="addbutton" href="#" data-toggle="modal" data-target="#add_sub_head"><i class="fa fa-plus-circle"></i></a> -->
                                </div>
                            </div>
                        </div>
                         <!--<div class="row">
                           
                            <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Vendor/Customer </label>
                                    <select class="form-control select2" name="vendorCustomer" id="vendorCustomer">

                                        <option value="">Select Vendor/Customer</option>
                                        <optgroup label="Vendor">
                                        <?php foreach ($vendorCustomerin as $key ) {
                                            ?>
                                            <option <?php if($value->vendorCustomer){if($value->vendorCustomer == $key->vendorcustomer_id){echo 'selected';}} ?> value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                        </optgroup>
                                        <optgroup label="Customer">
                                            <?php foreach ($vendorCustomerout as $key ) {
                                            ?>
                                            <option <?php if($value->vendorCustomer){if($value->vendorCustomer == $key->vendorcustomer_id){echo 'selected';}} ?> value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                         </optgroup>
                                    </select>
                                    
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Method <span class="text-danger">*</span></label>
                                    <select class="select" name="method" required="">
                                         <option value="">Select Method</option>
                                        
                                        <?php foreach ($bank as $key ) {
                                            ?>
                                <option <?php if($value->method){if($value->method == $key->bank_id){echo 'selected';}} ?> value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>
                                            <?php
                                        } ?>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount <span class="text-danger">*</span></label>
                                    <input placeholder="" value="<?= $value->amount ?>" name="amount" class="form-control" type="number" required="" />
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                    <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="select" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                <option <?php if($value->branch_id){if($value->branch_id == $key->branch_id){echo 'selected';}} ?> value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    }else{
                                        $branchArr=explode('|', $logged_in_user->branch_id)
                                        ?>
                                    <select class="select" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {

                                            ?>
                                <option <?php if(in_array($key->branch_id, $branchArr,true)){echo 'selected';}else{echo 'disabled';} ?> value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description </label>
                                    <textarea rows="4" class="form-control"  name="description" ><?= $value->description ?></textarea>
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
    <div class="modal custom-modal fade" id="delete_entry<?= $value->journal_id ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Entry</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" onclick='deleteCommon("tbl_journal","journal_id",<?= $value->journal_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    							</tr>

                                <?php
                            }  ?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
    	
</div>


</div>