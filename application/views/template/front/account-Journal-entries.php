
    <?php $arr = explode('|',$privileges_settings->journal) ;
    $startCapital = $this->db->where('status',1)->limit(1)->get('tbl_journal')->row();
   $testout=array();
             $object = new stdClass();
            $object->journal_id = $startCapital->journal_id;
            $object->date = $startCapital->date;
            $object->head_id = $startCapital->head_id;
            $object->moneyInOut = $startCapital->moneyInOut;
            $object->sub_head_id = $startCapital->sub_head_id;
            $object->vendorCustomer = $startCapital->vendorCustomer;
            $object->method = $startCapital->method;
            $object->amount = $startCapital->amount;
            $object->description = $startCapital->description;
            $object->oraganisation_id = $startCapital->oraganisation_id;
            $object->branch_id = $startCapital->branch_id;
            $object->group_fk = $startCapital->group_fk;
            $object->refrence_id = $startCapital->refrence_id;
            $object->datetime = $startCapital->datetime;
            $object->del_status = $startCapital->del_status;
            $object->lastmodify = $startCapital->lastmodify;
            $object->status = $startCapital->status;
             array_push($testout,$object);
//print_r($testout);
    
    /*$arrmt = $data;

$lastvalue = end($arrmt);
$lastkey = key($arrmt);

$arrmt1 = array($lastkey=>$lastvalue);

array_pop($arrmt);
//print_r($arrmt1);*/

$mainarr = array_merge($testout,$data);
//print_r($mainarr);
?>
<style type="text/css">
    tr:focus {
  background-color: #CCC;
}
</style>
  <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Vouchar Entries</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Vouchar Entries</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <input type="hidden" id="autosno" value="1">
                    <input type="hidden" id="trid" value="">
                    <!-- <a href="#" class="btn add-btn " data-toggle="modal" data-target="#add_sub_head"><i class="fa fa-plus"></i> Add Sub Heads</a>
                    <a href="#add_head" class="btn add-btn m-r-5" data-toggle="modal"><i class="fa fa-plus"></i> Add Heads</a> -->
                    <a class="btn btn-white" href="javascript:void(0)" onclick="CreatePDFfromHTML('exelcash1','Vouchar')">PDF</a>
                    <button class="btn btn-white m-r-10" onclick="exportexel('exeljournal', 'journal',1)"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export </button>
                    <?php if (in_array('1', $arr,true)) {
                               ?>
                        <a href="#" class="btn add-btn " data-toggle="modal" data-target="#update_capital"><i class="fa fa-plus"></i>Update Capital</a>
                        
                    <a href="#" class="btn add-btn m-r-5" data-toggle="modal" data-target="#add_contra"><i class="fa fa-plus"></i> Add Contra</a>

                   <a href="javascript:void(0)" data-target="#add_entries1" class="btn add-btn m-r-5" data-toggle="modal"><i class="fa fa-plus"></i> Add Entries</a>

                      <?php
                    } ?>

                </div>
            </div>
        </div>
        <form action="journalEntries.html" method="GET">
         <div class="row filter-row">
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="method" >
                        <option value="">Select Method</option>
                        <?php foreach ($bank as $key) {
                            ?>
                            <option <?php if(isset($_GET['method'])){if($_GET['method'] == $key->bank_id){echo 'Selected';}} ?> value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>
                            <?php
                        } ?>
                    </select>
                    <label class="focus-label">Payment Method</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                   <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="select" name="branch" >
                                         <option value="0">Select Branch</option>
                                        
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
                                         <option value="0">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {

                                            ?>
                                <option <?php if(in_array($key->branch_id, $branchArr,true)){echo 'selected';}else{echo 'disabled';} ?> value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    } ?>
                    <label class="focus-label">Branch</label>
                </div>
            </div>
            
            
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="moneyInOut" >
                        <option value="">Select Category</option>
                        <option <?php if(isset($_GET['moneyInOut'])){if($_GET['moneyInOut'] == '1'){echo 'Selected';}} ?> value="1">Money In</option>
                        <option <?php if(isset($_GET['moneyInOut'])){if($_GET['moneyInOut'] == '2'){echo 'Selected';}} ?> value="2">Money Out</option>
                        <!--<option <?php if(isset($_GET['moneyInOut'])){if($_GET['moneyInOut'] == '3'){echo 'Selected';}} ?> value="3">Both</option>-->
                    </select>
                    <label class="focus-label">Choose Category</label>
                </div>
            </div>
           <!--  <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="form-control select2" name="vendorCustomer" id="vendorCustomer">

                                        <option value="0">Select Buyer/Suppliers</option>
                                        <optgroup label="Suppliers">
                                        <?php foreach ($vendorCustomerin as $key ) {
                                            ?>
                                            <option <?php if(isset($_GET['vendorCustomer'])){if($_GET['vendorCustomer'] == $key->vendorcustomer_id){echo 'Selected';}} ?> value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                        </optgroup>
                                        <optgroup label="Buyer">
                                            <?php foreach ($vendorCustomerout as $key ) {
                                            ?>
                                            <option <?php if(isset($_GET['vendorCustomer'])){if($_GET['vendorCustomer'] == $key->vendorcustomer_id){echo 'Selected';}} ?> value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                         </optgroup>
                                    </select>
                    <label class="focus-label">Buyer/Suppliers</label>
                </div>
            </div> -->
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" name="from"  value="<?php if(isset($_GET['from'])){echo $_GET['from'];} ?>"/>
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" name="to"  value="<?php if(isset($_GET['to'])){echo $_GET['to'];} ?>"/>
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
            <div class="col-md-1"></div>
        </div>
        </form>
        <div class="exelcash1">
            <div class="review-header balan-hd">
                <div class="row">
                    <div class="col-md-12">
                        <div class="excel-hd-main">
                            <img width="190" src="<?= ($organisation_settings->oraganisation_logo)?$organisation_settings->oraganisation_logo:'assets/img/logo2.png' ?>" >                    
                            <h3 class="review-title"><?= $organisation_settings->oraganisation_name ?></h3>
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
                            <?php  if(isset($_GET['branch']) && $_GET['branch'] != '0'){
                            $getbranch=$this->db->where('branch_id',$_GET['branch'])->get('tbl_branch')->row();
                    ?>
                            <p><b>Branch:</b> <span><?= $getbranch->branch_name ?></span></p>
                             <?php
                }
                ?>
                        </div>
                    </div>
                </div>
            </div>
         <div class="row">
            <div class="col-md-12">
                <div class="table-responsive journal-able">
                    <table class="table custom-table testtable" id="exeljournal">
                        <thead>
                            <tr>
                                 <th style="width: 30px;">#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <!--<th>Sub Head Name</th>-->
                                <th>Payment Method</th>
                                <!-- <th>Buyers/Suppliers</th> -->
                                <th>Amount Debit</th>
                                <th>Amount Credit</th>
                                <th>Balance</th>
                                <th class="text-right no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i =$counts;
                            $w =0;
                            $t =1;
                             $arr = array();
                            foreach ($mainarr as $key => $value) {
                                $head=$this->db->where('heads_id',$value->head_id)->get('tbl_heads')->row();
                                /*$subHead=$this->db->where('heads_id',$value->sub_head_id)->get('tbl_heads')->row();*/
                                 $bank1=$this->db->where('bank_id',$value->method)->get('tbl_bank')->row();
                                 $vendorCustomer1=$this->db->where('vendorcustomer_id',$value->vendorCustomer)->get('tbl_vendorcustomer')->row();
                                 /*if($value->status == 3){

                                 }*/
                                if($key == '0'){
                                    if($value->moneyInOut == '1'){
                                        $bal = ($value->status == 3)?0:$value->amount + 0;
                                        array_push($arr,$bal);
                                    }else{
                                        $bal = ($value->status == 3)?0:$value->amount - 0;
                                        array_push($arr,$bal);
                                    }
                                
                                }else{
                                    
                                    if($value->moneyInOut == '1'){
                                            $bal = ($value->status == 3)?$arr[$key-1]:$value->amount + $arr[$key-1];
                                            array_push($arr,$bal);
                                        }else{
                                            $bal =   ($value->status == 3)?$arr[$key-1]:$arr[$key-1] - $value->amount;
                                            array_push($arr,$bal);
                                        }
                                }

                                ?>

                                <tr tabindex='<?= $w++ ?>' style="display:<?= ($t++ == 1)?'none':'' ?>" data-trid="<?= $value->journal_id ?>" onclick="mycheckKey(<?= $value->journal_id ?>)">
                                   <td><?= $i++ ?></td>
                                   <td><?= date('d M Y ',strtotime($value->date)) ?></td>
                                   <td>
                                        <p class="jrnl-dis"><?= $value->description ?></p>
                                        <span class="badge bg-inverse-warning"><?= ($head)?$head->heads_name:'' ?> </span>
                                       <!-- <span class="badge bg-inverse-warning"><?= ($subHead)?$subHead->heads_name:'' ?></span>-->
                                  </td>
                                  <!--<td><?= ($subHead)?$subHead->heads_name:'' ?> </td>  -->
                                  <td><p class="jrnl-dis"><?= ($bank1)?$bank1->bank_name:'' ?> </p>
                                  <?= ($value->refrence_id)?'<span class="badge bg-inverse-warning">Contra-'.$value->refrence_id.'</span>':'' ?>

                              </td>
                                  <!-- <td><?= ($vendorCustomer1)?$vendorCustomer1->vendorcustomer_name:'' ?>
                                      <span class="badge bg-inverse-warning"><?php if($vendorCustomer1){if($vendorCustomer1->status==1){echo 'Suppliers';}else{echo 'Buyer';}} ?></span>
                                  </td>  -->  
                                  <td><?= ($value->moneyInOut == '2')?'<span class="badge bg-inverse-danger">'.$value->amount.'</span>':'--' ?></td>
                                  <td><?= ($value->moneyInOut == '1')?'<span class="badge bg-inverse-success">'.$value->amount.'</span>':'--' ?></td>
                                  <td><?= $bal ?></td>
                                  <?php if($value->status == 0){
                                    ?>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_entries<?= $value->journal_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>

                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_entry<?= $value->journal_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>

                                            </div>
                                        </div>
                                    </td>
                                    <?php
                                  } 
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
                                    <label>Choose payment <span class="text-danger">*</span></label>
                            <select class="form-control mymoneyInOutedit" name="moneyInOut" >
                                                   <option value="">Select payment </option>
                                                   <option <?php if($value->moneyInOut){if($value->moneyInOut == 1){echo 'selected';}} ?> value="1">Payment-In </option>
                                                   <option <?php if($value->moneyInOut){if($value->moneyInOut == 2){echo 'selected';}} ?> value="2">Payment-Out </option>
                                               </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Ledger <span class="text-danger">*</span></label>          
                                <select class="form-control select2 categoryedit" name="head_id" required="" >
                                    <option value="">Select Ledger</option>
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
                             <!--<div class="col-md-6">
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
                                   
                                </div>
                            </div>-->
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
        <div class="ftr-pagination-sec mr-tp20">
                        <div class="row">
                        <div class="col-md-6">
                        
                        </div>
                        <div class="col-md-6">
                            <div class="ftr-pagination">
                                <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                     <?php foreach ($links as $link) { ?>
                              <?=$link?>
                              <?php } ?>
                                    
                                  </ul>
                                </nav>
                            </div>
                        </div>
                        </div>
                    </div>
    </div>
    
     <div id="add_entries" class="modal custom-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Journal Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body journl-add">
                    <form >
                        <!-- <input type="hidden" name="moneyInOut" id="moneyInOut" value="">
                        <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>"> -->
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control mydatepickerjournal" type="text" value="<?= date('d M Y') ?>" name="date" required=""/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Category <span class="text-danger">*</span></label>          
                                <select class="form-control select2" name="head_id" id="category" required="">
                                    <option value="">Select Category</option>
                                        <optgroup label="Money In">
                                            <?php foreach ($moneyIn as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="1" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Money Out">
                                           <?php foreach ($moneyOut as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="2" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                    </select>
                                    <a class="addbutton" href="#add_head" data-toggle="modal"><i class="fa fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Sub Head <span class="text-danger">*</span></label>
                                    <select class="select" name="sub_head_id" id="subHead" required="">
                                        
                                        
                                    </select>
                                    <a class="addbutton" href="#" data-toggle="modal" data-target="#add_sub_head"><i class="fa fa-plus-circle"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group journl-add">
                                    <label>Choose Vendor/Customer </label>
                                    <select class="form-control select2" name="vendorCustomer" id="vendorCustomer">

                                        <option value="">Select Vendor/Customer</option>
                                        <optgroup label="Vendor">
                                        <?php foreach ($vendorCustomerin as $key ) {
                                            ?>
                                            <option value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                        </optgroup>
                                        <optgroup label="Customer">
                                            <?php foreach ($vendorCustomerout as $key ) {
                                            ?>
                                            <option value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                         </optgroup>
                                    </select>
                                    <a class="addbutton" href="#" data-toggle="modal" data-target="#add_vendor"><i class="fa fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Method <span class="text-danger">*</span></label>
                                    <select class="select" name="method" required="">
                                         <option value="">Select Method</option>
                                        
                                        <?php foreach ($bank as $key ) {
                                            ?>
                                <option value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount <span class="text-danger">*</span></label>
                                    <input placeholder="" name="amount" class="form-control" type="number" required="" />
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                    <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="select" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                <option value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

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
                                    <textarea rows="4" class="form-control" name="description" ></textarea>
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
             
        
            
     <div id="add_sub_head" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub Head</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addjrsubhead">
                        <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <div class="form-group">
                            <label>Sub Head Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="sub_head_name" required="" />
                        </div>
                        <!-- <div class="form-group">
                            <label>Sub Sub Head Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="sub_sub_head_name" />
                        </div> -->
                         <div class="form-group">
                            <label>Choose Head Name <span class="text-danger">*</span></label>
                            <select class="select" name="heads_fk" required="">
                                            <option value="">Select Head</option>
                                            <?php foreach ($this->db->where('heads_fk','0')->where('del_status',0)->get('tbl_heads')->result() as $key ) {
                                               ?>
                                                <option value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                               <?php
                                            } ?>
                                        </select>
                        </div>
                        <div class="form-group">
                            <label>Choose Category <span class="text-danger">*</span></label>
                            <select class="select" name="heads_category" required="">
                                            <option value="1">Money In</option>
                                            <option value="2">Money Out</option>
                                        </select>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="add_vendor" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vendor/Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addJrvendor">
                        <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <div class="form-group">
                            <label>Vendor/Customer Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text"  name="vendorcustomer_name" required="" />
                        </div>
                        <div class="form-group">
                            <label>Choose Vendor/Customer<span class="text-danger">*</span></label>
                            <select class="select" name="status" required="">
                                <option value="1">Vendor</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <div id="add_head" class="modal custom-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Head</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addJrhead">
                        <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <div class="form-group">
                            <label>Head Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="head_name" required="" />
                        </div>
                        <div class="form-group">
                            <label>Choose Category <span class="text-danger">*</span></label>
                            <select class="select" name="head_category" required="">
                                  <option value="1">Money In</option>
                                            <option value="2">Money Out</option>
                            </select>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div id="add_entries1" class="modal add-modal custom-modal">
        <div class="modal-dialog modal-dialog-centered modal-lgg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Journal Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body journl-add-entry">
                    <form id="addjournal">

                        <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <div class="table-responsive1 journal-add-sec">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="min-width:150px">Date</th>
                                        <th>Payment In/Out</th>
                                        <th>Ledger</th>
                                        <!--<th>Sub Head</th>-->
                                        <!-- <th>Buyers/Suppliers</th> -->
                                        <th>Payment Method</th>
                                        <th>Amount</th>
                                        <th>Branch</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody class="appendin">
                                    
                                    
                                    
                                    <tr>

                                       <td>1</td>
                                       <td>
                                            <div class="form-group">
                                                <div class="cal-icon"> <input class="form-control mydatepickerjournal" type="text" value="<?= date('d M Y') ?>" name="date[]" required=""/></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group"> <!--mymoneyInOut-->
                                               <select class="form-control " name="moneyInOut[]" >
                                                   <option value="">Select payment </option>
                                                   <option value="1">Payment-In </option>
                                                   <option value="2">Payment-Out </option>
                                               </select>
                                            </div>
                                        </td>
                                       <td>
                                        <div class="form-group journl-add">     
                                            <select class="form-control category" name="head_id[]" id="" required="">
                                    <option value="">Select Ledger</option>
                                         <optgroup label="Credit">
                                            <?php foreach ($moneyIn as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="1" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Debit">
                                           <?php foreach ($moneyOut as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="2" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <!--<optgroup label="Debtor">
                                           <?php foreach ($debtor as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="1" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Creditor">
                                           <?php foreach ($creditor as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="2" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup> -->
                                    </select>
                                        </div>
                                      </td>
                                     <!-- <td>
                                        <div class="form-group journl-add">
                                            <select class="form-control subHead" name="sub_head_id[]" id="" required="">
                                    </select>
                                        </div>
                                      </td>--> 
                                      <!-- <td>
                                        <select class="form-control " name="vendorCustomer[]" id="vendorCustomer" required="">

                                        <option value="">Select Buyers/Suppliers</option>
                                        <optgroup label="Suppliers">
                                        <?php foreach ($vendorCustomerin as $key ) {
                                            ?>
                                            <option value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                        </optgroup>
                                        <optgroup label="Buyers">
                                            <?php foreach ($vendorCustomerout as $key ) {
                                            ?>
                                            <option value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                         </optgroup>
                                    </select>
                                      </td> -->
                                      <td>
                                        <div class="form-group">
                                            <select class="form-control" name="method[]" required="">
                                         <option value="">Select Method</option>
                                        
                                        <?php foreach ($bank as $key ) {
                                            ?>
                                <option value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                        </div>
                                      </td> 
                                      <td>
                                        <div class="form-group">
                                           <input placeholder="" name="amount[]" class="form-control" type="number" required="" />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group journl-add">
                                            <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="form-control" name="branch[]" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                <option value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    }else{
                                        $branchArr=explode('|', $logged_in_user->branch_id)
                                        ?>
                                    <select class="form-control" name="branch[]" required="">
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
                                      </td> 
                                      <td>
                                        <div class="form-group">
                                            <input placeholder="Description" class="form-control" name="description[]" type="text" />
                                        </div>
                                      </td>
                                      <td><button onclick="addjournalentrie()" type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></td>
                                      
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="submit-section">
                            <button type="submit" id="journalenter" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>                 
                </div>
            </div>
        </div>
    </div>
     <div id="update_capital" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Catital</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateCapital">
<input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <input type="hidden" name="journal_id" value="<?= $startCapital->journal_id ?>">
                        <input type="hidden" name="capital" value="<?= $startCapital->amount ?>">
                        <div class="form-group">
                            <label>Method <span class="text-danger">*</span></label>
                           <select class="select" name="method" required="">
                                         <option value="">Select Method</option>
                                        
                                        <?php foreach ($bank as $key ) {
                                            ?>
                                <option  value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>
                                            <?php
                                        } ?>
                                      
                                    </select>
                        </div>
                        <div class="form-group">
                            <label>Capital <span class="text-danger">*</span></label>
                            <input class="form-control" value="" type="number" name="amount" required="" />
                        </div>
                        
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <div id="add_contra" class="modal custom-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Contra Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body journl-add">
                    <form id="addcontra">
                        <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Refrence Id</label>
                                    <input placeholder="<?= $countjournal + 1 ?>" class="form-control" type="text" readonly="" name="refId" value="<?= $countjournal + 1 ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" value="<?= date('d M Y') ?>" name="date"/></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>From</label>
                                     <select class="form-control " name="frommethod" required="">
                                         <option value="">Select Method</option>
                                        
                                        <?php foreach ($bank as $key ) {
                                            ?>
                                <option value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>To</label>
                                     <select class="form-control " name="tomethod" required="">
                                         <option value="">Select Method</option>
                                        
                                        <?php foreach ($bank as $key ) {
                                            ?>
                                <option value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input placeholder="0" class="form-control" name="amount" type="text" required="true" />
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Branch</label>
                                <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="form-control" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                <option value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    }else{
                                        $branchArr=explode('|', $logged_in_user->branch_id)
                                        ?>
                                    <select class="form-control" name="branch" required="">
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
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea rows="4" class="form-control" name="description"></textarea>
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
</div>
</div>

<div  style='display: none'>
    <table class="getappenddata">
    
                                       <td>
                                            <div class="form-group">
                                                <div class="cal-icon"> <input class="form-control mydatepickerjournal1" type="text" value="<?= date('d M Y') ?>" name="date[]" required=""/></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group"><!--mymoneyInOut-->
                                               <select class="form-control " name="moneyInOut[]" >
                                                   <option value="">Select payment </option>
                                                   <option value="1">Payment-In </option>
                                                   <option value="2">Payment-Out </option>
                                               </select>
                                            </div>
                                        </td>
                                       <td>
                                        <div class="form-group journl-add">     
                                            <select class="form-control category" name="head_id[]" id="" required="">
                                    <option value="">Select Ledger</option>
                                         <optgroup label="Credit">
                                            <?php foreach ($moneyIn as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="1" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Debit">
                                           <?php foreach ($moneyOut as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="2" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <!--<optgroup label="Debtor">
                                           <?php foreach ($debtor as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="1" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Creditor">
                                           <?php foreach ($creditor as $key) {
                                              ?>
                                               <option data-group="<?= $key->group_fk ?>" data-id="2" value="<?= $key->heads_id ?>"><?= $key->heads_name ?>
                                               </option>
                                              <?php
                                            } ?>
                                        </optgroup> -->
                                    </select>
                                        </div>
                                      </td>
                                      <!--<td>
                                        <div class="form-group journl-add">
                                            <select class="form-control" name="sub_head_id[]" id="" required="">
                                    </select>
                                        </div>
                                      </td> -->
                                      <!-- <td>
                                        <select class="form-control select2" name="vendorCustomer[]" >

                                        <option value="">Select Buyers/Suppliers</option>
                                        <optgroup label="Suppliers">
                                        <?php foreach ($vendorCustomerin as $key ) {
                                            ?>
                                            <option value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                        </optgroup>
                                        <optgroup label="Buyers">
                                            <?php foreach ($vendorCustomerout as $key ) {
                                            ?>
                                            <option value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                         </optgroup>
                                    </select>
                                      </td> -->
                                      <td>
                                        <div class="form-group">
                                            <select class="form-control select2" name="method[]" required="">
                                         <option value="">Select Method</option>
                                        
                                        <?php foreach ($bank as $key ) {
                                            ?>
                                <option value="<?= $key->bank_id ?>"><?= $key->bank_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                        </div>
                                      </td> 
                                      <td>
                                        <div class="form-group">
                                           <input placeholder="" name="amount[]" class="form-control" type="number" required="" />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group journl-add">
                                            <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="form-control select2" name="branch[]" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                <option value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    }else{
                                        $branchArr=explode('|', $logged_in_user->branch_id)
                                        ?>
                                    <select class="form-control select2" name="branch[]" required="">
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
                                      </td> 
                                      <td>
                                        <div class="form-group">
                                            <input placeholder="Description" class="form-control" name="description[]" type="text" />
                                        </div>
                                      </td>
                                      <td><button  type="button" class="removeappenddata btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>
                                      
                                    </tr>
                                    </table>
</div>
