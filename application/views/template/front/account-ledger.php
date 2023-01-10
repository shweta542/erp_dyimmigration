
<?php $arr = explode('|',$privileges_settings->designation) ;

$firstJournal = $this->db->where('status',1)->get('tbl_journal')->row();
?>

 <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Daybook</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daybook</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a class="btn btn-white" href="javascript:void(0)" onclick="CreatePDFfromHTML('example1','ledger')">PDF</a>
                    <button class="btn btn-white" onclick="exportexel('exelledger', 'ledger')"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
 Export</button> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-group m-b-30">
                    <?php 
                    $currentmonth =date('m');
                    foreach($this->db->where('del_status',0)->get('tbl_bank')->result() as $key){
                        $this->db->select_sum('amount');
                                        $this->db->from('tbl_journal');
                                        $this->db->where('del_status',0);
                                        $this->db->where('method',$key->bank_id);
                                        $this->db->where('status',2);
                                        $sumthismonth = $this->db->get();
                                        
                                        $this->db->select_sum('amount');
                                        $this->db->from('tbl_journal');
                                        $this->db->where('del_status',0);
                                        $this->db->where('method',$key->bank_id);
                                        $this->db->where('MONTH(date)',$currentmonth);
                                        $this->db->where('status',2);
                                        $sumcurrentmonth = $this->db->get();
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block"> <?= $key->bank_name ?> <br><small>opening Balance</small></span>
                                </div>
                                <div>
                                    <span class="text-danger"></span>
                                </div>
                                <!--<div>
                                    <span class="text-success">+7500</span>
                                </div>-->
                            </div>
                            <h3 class="mb-3"><?= ($sumthismonth->row()->amount)?$sumthismonth->row()->amount:'0' ?></h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Current Month: <span class="text-muted"><?= ($sumcurrentmonth->row()->amount)?$sumcurrentmonth->row()->amount:'0' ?></span></p>
                        </div>
                    </div>
                    <?php
                    } ?>
                    
                    
                    
                </div>
            </div>
        </div>
        <form action="ledger.html" method="get">
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
                    <label class="focus-label">Method Name</label>
                </div>
            </div>
            <!-- <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select" name="vendorCustomer" id="vendorCustomer" >
                                        <option value="">Select Buyer/Suppliers</option>
                                        <?php foreach ($vendorCustomer as $key ) {
                                            ?>
                                            <option <?php if(isset($_GET['vendorCustomer'])){if($_GET['vendorCustomer'] == $key->vendorcustomer_id){echo 'Selected';}} ?> value="<?= $key->vendorcustomer_id ?>"><?= $key->vendorcustomer_name ?></option>
                                            <?php
                                        } ?>
                                    </select>
                    <label class="focus-label">Buyer/Suppliers</label>
                </div>
            </div> -->
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
                    <select class="form-control select2" name="head_id" id="" >
                                    <option value="">Select Category</option>
                                      
                                            <?php foreach ($moneyIn as $key) {
                                              ?>
                                               <option <?php if(isset($_GET['head_id'])){if($_GET['head_id'] == $key->heads_id){echo 'Selected';}} ?> data-id="1" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                       
                                           <?php foreach ($moneyOut as $key) {
                                              ?>
                                               <option data-id="2" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        
                                    </select>
                    <label class="focus-label">Head Name</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" name="form" value="<?= (isset($_GET['form']))?$_GET['form']:'' ?>"/>
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" name="to" value="<?= (isset($_GET['to']))?$_GET['to']:'' ?>"/>
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
        </form>
        
        <div class="example1">
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
                    <table class="table table-striped custom-table" id="exelledger">
                        <thead>
                            <tr>
                                 <th style="width: 30px;">#</th>
                                <th>Date</th>
                                <th>Description</th>
                                 <th>Method</th> 
                                <th>Amount Debit</th>
                                <th>Amount Credit</th>
                                <th>Amount </th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php if(isset($_GET['method']) && $_GET['method'] == 'manish'){
                                ?>
                                <tr>
                                       <td>1</td>
                                       <td><?= date('d M Y ',strtotime($firstJournal->date)) ?></td>
                                       <td>
                                            <p class="jrnl-dis"><?= $firstJournal->description ?></p>
                                            <span class="badge bg-inverse-warning"></span>
                                      </td>
                                      <td></td>   
                                      <td><?= ($firstJournal->moneyInOut == '2')?'<span class="badge bg-inverse-danger">'.$firstJournal->amount.'</span>':'--' ?></td>
                                  <td><?= ($firstJournal->moneyInOut == '1')?'<span class="badge bg-inverse-success">'.$firstJournal->amount.'</span>':'--' ?></td>
                                  <td></td>
                                    </tr>
                                <?php
                            }
                                ?> 
                            
                            <?php 
                            $i=1;
                            $totalDr=0;
                            $totalCr=0;
                             $arr = array();
                            foreach ($data as $key => $value) {
                                $bank1=$this->db->where('bank_id',$value->method)->get('tbl_bank')->row();
                            if($value->moneyInOut == '2'){
                                $totalDr+= $value->amount;
                            }
                             if($value->moneyInOut == '1'){
                                $totalCr+= $value->amount;
                            }
                                $head=$this->db->where('heads_id',$value->head_id)->get('tbl_heads')->row();
                                $subHead=$this->db->where('heads_id',$value->sub_head_id)->get('tbl_heads')->row();
                                $vendorCustomer1=$this->db->where('vendorcustomer_id',$value->vendorCustomer)->get('tbl_vendorcustomer')->row();
                                if($key == '0'){
                                    if($value->moneyInOut == '1'){
                                        $bal = $value->amount + 0;
                                        array_push($arr,$bal);
                                    }else{
                                        $bal = -$value->amount;
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
                                    <tr>
                                       <td><?= $i++ ?></td>
                                       <td><?= date('d M Y ',strtotime($value->date)) ?></td>
                                       <td>
                                            <p class="jrnl-dis"><?= $value->description ?></p>
                                            <span class="badge bg-inverse-warning"><?= ($head)?$head->heads_name:'' ?></span><span class="badge bg-inverse-warning"><?= ($subHead)?$subHead->heads_name:'' ?></span>
                                      </td>
                                     <td><p class="jrnl-dis"><?= ($bank1)?$bank1->bank_name:'' ?> </p>
                                    </td> 
                                      <td><?= ($value->moneyInOut == '2')?'<span class="badge bg-inverse-danger">'.$value->amount.'</span>':'--' ?></td>
                                  <td><?= ($value->moneyInOut == '1')?'<span class="badge bg-inverse-success">'.$value->amount.'</span>':'--' ?></td>
                                  <td><?= $bal ?></td>
                                    </tr>
                                <?php
                            } ?>
                           <tr >
                            <td colspan="5"></td>
                               <td >
Total Money Debit:
                               <!-- <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Total Money Debit:</th>
                                    <td class="text-right"><?= $totalDr ?></td>
                                </tr>
                                <tr>
                                    <th>Total Money Credit:</th>
                                    <?php if(isset($_GET['method']) && $_GET['method'] == '1'){
                                        ?>
                                <td class="text-right"><?= $totalCr + $firstJournal->amount ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td class="text-right"><?= $totalCr ?></td>
                                        <?php
                                    } ?>
                                </tr>
                            </tbody>
                        </table> --></td>
                         <td class="text-right"><?= $totalDr ?></td>
                           </tr>
                           <tr>
                            <td colspan="5"></td>
                             <td >Total Money Credit:</td>
                             <?php if(isset($_GET['method']) && $_GET['method'] == '1'){
                                        ?>
                                <td class="text-right"><?= $totalCr + $firstJournal->amount ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td class="text-right"><?= $totalCr ?></td>
                                        <?php
                                    } ?>
                           </tr>
                           <tr>
                            <td colspan="5"></td>
                            <td>Balance</td>
                            <?php if(isset($_GET['method']) && $_GET['method'] == '1'){
                                        ?>
                            <td class="text-right"><?= $totalCr + $firstJournal->amount - $totalDr?> </td>
                            <?php
                                    }else{
                                        ?>
                                        <td class="text-right"><?= $totalCr  - $totalDr?> </td> 
                                        <?php
                                    } ?>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       <!--  <div class="row invoice-payment">
            <div class="col-sm-7"></div>
            <div class="col-sm-5">
                <div class="m-b-20">
                    <div class="table table-striped custom-table">
                        
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    </div>
    
            
    
    

    
</div>


</div>

