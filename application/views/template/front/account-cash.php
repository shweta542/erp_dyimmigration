 <?php $bothtotal=$this->db->select('SUM(amount) as amount')->where('method','1')->where('del_status',0)->get('tbl_journal')->row();
 $intotal=$this->db->select('SUM(amount) as amount')->where('method','1')->where('moneyInOut',1)->where('del_status',0)->get('tbl_journal')->row();
 $outtotal=$this->db->select('SUM(amount) as amount')->where('method','1')->where('moneyInOut',2)->where('del_status',0)->get('tbl_journal')->row();
 $premonth=$this->db->select('SUM(amount) as amount')->where('MONTH(date)', date('m',strtotime("-1 month")))->where('method','1')->where('del_status',0)->get('tbl_journal')->row();
 $preinmonth=$this->db->select('SUM(amount) as amount')->where('MONTH(date)', date('m',strtotime("-1 month")))->where('method','1')->where('moneyInOut',1)->where('del_status',0)->get('tbl_journal')->row();
 $preoutmonth=$this->db->select('SUM(amount) as amount')->where('MONTH(date)', date('m',strtotime("-1 month")))->where('method','2')->where('moneyInOut',2)->where('del_status',0)->get('tbl_journal')->row();
 
  ?>

 <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Cash</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cash</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                     <a class="btn btn-white" href="javascript:void(0)" onclick="CreatePDFfromHTML('exelcash1','cash')">PDF</a>
                    <button class="btn btn-white m-r-10" onclick="exportexel('exelcash', 'journal')"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export </button>
                </div>
            </div>
        </div>
        <form action="cash.html" method="get">
        <div class="row filter-row">
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="moneyInOut" required="">
                        <option <?php if(isset($_GET['moneyInOut'])){if($_GET['moneyInOut'] == '1'){echo 'Selected';}} ?> value="1">Money In</option>
                        <option <?php if(isset($_GET['moneyInOut'])){if($_GET['moneyInOut'] == '2'){echo 'Selected';}} ?> value="2">Money Out</option>
                        <option <?php if(isset($_GET['moneyInOut'])){if($_GET['moneyInOut'] == '3'){echo 'Selected';}} ?> value="3">Both</option>
                    </select>
                    <label class="focus-label">Choose Category</label>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card-group m-b-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Total Cash Balance</span>
                                </div>
                                <div>
                                    <span class="text-danger"></span>
                                </div>
                                <!--<div>
                                    <span class="text-success">+7500</span>
                                </div>-->
                            </div>
                            <h3 class="mb-3"><?= $bothtotal->amount ?></h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month: <span class="text-muted"><?= ($premonth->amount)?$premonth->amount:'0' ?></span></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Money In</span>
                                </div>
                                <!--<div>
                                    <span class="text-success">+12.5%</span>
                                </div>-->
                            </div>
                            <h3 class="mb-3"><?= $intotal->amount ?></h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month: <span class="text-muted"><?= ($preinmonth->amount)?$preinmonth->amount:'0' ?></span></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Money Out</span>
                                </div>
                                <!--<div>
                                    <span class="text-danger">-2.8%</span>
                                </div>-->
                            </div>
                            <h3 class="mb-3"><?= $outtotal->amount ?></h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month: <span class="text-muted"><?= ($preoutmonth->amount)?$preoutmonth->amount:'0' ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <table class="table table-striped custom-table" id="exelcash">
                        <thead>
                           <tr>
                                 <th style="width: 30px;">#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Sub Head Name</th>
                                <th>Payment Method</th>
                                <th>Buyers/Suppliers</th>
                                <th>Amount Debit</th>
                                <th>Amount Credit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                       <tbody>
                            <?php 
                            $i =1;
                             $arr = array();
                            foreach ($data as $key => $value) {
                                $head=$this->db->where('heads_id',$value->head_id)->get('tbl_heads')->row();
                                $subHead=$this->db->where('heads_id',$value->sub_head_id)->get('tbl_heads')->row();
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

                                <tr>
                                   <td><?= $i++ ?></td>
                                   <td><?= date('d M Y ',strtotime($value->date)) ?></td>
                                   <td>
                                        <p class="jrnl-dis"><?= $value->description ?></p>
                                        <span class="badge bg-inverse-warning"><?= ($head)?$head->heads_name:'' ?> </span>
                                        <span class="badge bg-inverse-warning"><?= ($subHead)?$subHead->heads_name:'' ?></span>
                                  </td>
                                  <td><?= ($subHead)?$subHead->heads_name:'' ?> </td>  
                                  <td><?= ($bank1)?$bank1->bank_name:'' ?></td>
                                  <td><?= ($vendorCustomer1)?$vendorCustomer1->vendorcustomer_name:'' ?>
                                      <span class="badge bg-inverse-warning"><?php if($vendorCustomer1){if($vendorCustomer1->status==1){echo 'Suppliers';}else{echo 'Buyer';}} ?></span>
                                  </td>   
                                  <td><?= ($value->moneyInOut == '2')?'<span class="badge bg-inverse-danger">'.$value->amount.'</span>':'--' ?></td>
                                  <td><?= ($value->moneyInOut == '1')?'<span class="badge bg-inverse-success">'.$value->amount.'</span>':'--' ?></td>
                                  <td><?= $bal ?></td>
                                  

                                </tr>
                                <?php
                            }  ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- <div class="row invoice-payment">
            <div class="col-sm-7"></div>
            <div class="col-sm-5">
                <div class="m-b-20">
                    <div class="table table-striped custom-table">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Total Money In:</th>
                                    <td class="text-right">7,000</td>
                                </tr>
                                <tr>
                                    <th>Total Money Out:</th>
                                    <td class="text-right">1,750</td>
                                </tr>
                                <tr>
                                    <th>Balance:</th>
                                    <td class="text-right text-primary">8,750</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <div id="add_expense" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Cash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Transaction Date</label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" /></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account</label>
                                    <select class="select">
                                        <option>Cash</option>
                                        <option>Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select">
                                        <option>Income</option>
                                        <option>Fees</option>
                                        <option>Salary</option>
                                        <option>Expense</option>
                                    </select>
                                </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <!--<div class="col-md-6">
                                <div class="form-group">
                                    <label>Paid To</label>
                                    <select class="select">
                                        <option>Cash</option>
                                        <option>Cheque</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input placeholder="5000" class="form-control" type="text" />
                                </div>
                            </div>
                        </div>
                        
                        <!--<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Attachments</label>
                                    <input class="form-control" type="file" />
                                </div>
                            </div>
                        </div>
                        <div class="attach-files">
                            <ul>
                                <li>
                                    <img src="assets/img/placeholder.jpg" alt="" />
                                    <a href="#" class="fa fa-close file-remove"></a>
                                </li>
                                <li>
                                    <img src="assets/img/placeholder.jpg" alt="" />
                                    <a href="#" class="fa fa-close file-remove"></a>
                                </li>
                            </ul>
                        </div>-->
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="edit_expense" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Cash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <!--<div class="row">
                            <div class="col-md-12">
                                <div class="trans-radio">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="radio" value="moneyin"> Money In
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="radio" value="moneyout"> Money Out
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Transaction Date</label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" /></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account</label>
                                    <select class="select">
                                        <option>Cash</option>
                                        <option>Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select">
                                        <option>Income</option>
                                        <option>Fees</option>
                                        <option>Salary</option>
                                        <option>Expense</option>
                                    </select>
                                </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <!--<div class="col-md-6">
                                <div class="form-group">
                                    <label>Paid To</label>
                                    <select class="select">
                                        <option>Cash</option>
                                        <option>Cheque</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input placeholder="5000" class="form-control" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div id="create_head" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transaction Head</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label>Transaction Type</label>
                            <select class="select">
                                <option>Money In</option>
                                <option>Money Out</option>
                            </select>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal custom-modal fade" id="delete_expense" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Transaction</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
</div>