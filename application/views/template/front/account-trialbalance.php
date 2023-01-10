
<?php $arr = explode('|',$privileges_settings->designation) ;
$firstJournal = $this->db->where('status',1)->get('tbl_journal')->row();
$tDr=0;
$tCr=0;
if(isset($_GET['branch'])){
    $branchData=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('branch_id',$_GET['branch'])->get('tbl_branch')->row();
}
?>

 <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Trial Balance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trial Balance</li>
                    </ul>
                </div>
               <div class="col-auto float-right ml-auto">
                    <a class="btn btn-white" href="javascript:void(0)" onclick="CreatePDFfromHTML('card','trialbalance')">PDF</a>
                    <a class="btn btn-white" href="javascript:void(0)" onclick="exportexel('exeltrail', 'trail')"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
 Export</a>
                    
                </div>
            </div>
        </div>
        <form action="trialbalance.html" method="get">
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
        
        <div class="card">
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
                            <?php  if(isset($_GET['from']) && isset($_GET['to'])){
                    ?>
                            <p><b>Trial Balance:</b> <span><?= $_GET['from'] ?></span> To <span><?= $_GET['to'] ?></span></p>
                             <?php
                }
                ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="review-header balan-hd text-center">
                <h3 class="review-title">Vishvas Groups</h3>
                <?php if(isset($branchData)){
                    ?>
                <p class="text-muted">Branch: <?= $branchData->branch_name ?></p>
                    <?php
                }  
                if(isset($_GET['from']) && isset($_GET['to'])){
                    ?>

                <p class="text-muted">Trial Balance From<span> <?= $_GET['from'] ?></span> To <span><?= $_GET['to'] ?></span></p>
                    <?php
                }
                ?>

            </div> -->
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered trialTable" id="exeltrail">
                                <thead>
                                    <tr>
                                        <th>Name of Accounts</th>
                                        <th style="width: 50px;">L.F.</th>
                                        <th style="width: 200px;">Debit Balance</th>
                                        <th style="width: 200px;">Credit Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                               <td>Start Capital</td>
                                               <td></td>
                                               <td><?= $firstJournal->amount ?></td>
                                               <td></td>
                                            </tr>
                                            <?php 
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result() as $key ) {
                                                if (isset($_GET['branch'])) {
                                                  $fdate =date('Y-m-d',strtotime($_GET['from']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));
                                $where = '(branch_id="'.$_GET['branch'].'" and date >= "'. $fdate.'" and date <= "'.$tdate.'")';   
                        $headcr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','1')->where($where)->where('del_status',0)->get('tbl_journal')->row(); 
                        $headdr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','2')->where('branch_id',$_GET['branch'])->where($where)->where('del_status',0)->get('tbl_journal')->row();
                       $tDr+=$headcr->amount;
                       $tCr+=$headdr->amount;
                                                }else{
                        $headcr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','1')->where('del_status',0)->get('tbl_journal')->row(); 
                        $headdr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','2')->where('del_status',0)->get('tbl_journal')->row();
                       $tDr+=$headcr->amount;
                       $tCr+=$headdr->amount;
                                                }
                                ?>
                                            <tr>
                                               <td><a href="headdetail.html/<?= $key->heads_id ?>"><?= $key->heads_name ?></a></td>
                                               <td></td>
                                               <td><?= ($headcr->amount)?$headcr->amount:'--'?></td>
                                               <td><?= ($headdr->amount)?$headdr->amount:'--'?></td>
                                            </tr>
                                      <?php
                            } 
                           foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result() as $key ) {
                            if (isset($_GET['branch'])) {
                                 $fdate =date('Y-m-d',strtotime($_GET['from']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));
                                $where = '(branch_id="'.$_GET['branch'].'" and date >= "'. $fdate.'" and date <= "'.$tdate.'")';

                           $headcr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','1')->where($where)->where('del_status',0)->get('tbl_journal')->row(); 

                        $headdr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','2')->where('branch_id',$_GET['branch'])->where('del_status',0)->where($where)->get('tbl_journal')->row();

                        
                        if($key->status == '1'){
                            if($headcr->amount){
                            $amount=$headcr->amount + $firstJournal->amount;
                           
                        }else{
                            $amount=0;
                        }
                        }else{
                            if($headcr->amount){
                            $amount=$headcr->amount ;
                            
                        }else{
                            $amount=0;
                        }
                        }
                        if($headdr->amount == $amount){
                                $debitamount= 0;
                                $amount = 0;
                            }else if($headdr->amount > $amount){
                                $debitamount= $headdr->amount - $amount;
                                $amount = 0;
                            }else if($headdr->amount < $amount){
                                 $amount= $amount - $headdr->amount ;
                                $debitamount = 0;
                            }else{
                                $debitamount= $headdr->amount;

                            }
                            $tDr+=$debitamount;
                        $tCr+=$amount;
                                                }else{
                        $headcr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','1')->where('del_status',0)->get('tbl_journal')->row(); 

                        $headdr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','2')->where('del_status',0)->get('tbl_journal')->row();

                        if($key->status == '1'){
                            if($headcr->amount){
                            //$amount=$headcr->amount + $firstJournal->amount;
                             $amount=$headcr->amount ;
                        }else{
                            $amount=0;
                        }
                        }else{
                            if($headcr->amount){
                            $amount=$headcr->amount ;
                            
                        }else{
                            $amount=0;
                        }
                        }
                        
                            if($headdr->amount == $amount){
                                $debitamount= 0;
                                $amount = 0;
                            }else if($headdr->amount > $amount){
                                $debitamount= $headdr->amount - $amount;
                                $amount = 0;
                            }else if($headdr->amount < $amount){
                                $amount= $amount - $headdr->amount ;
                                $debitamount = 0;
                            }else{
                                $debitamount= $headdr->amount;

                            }
                        
                        $tDr+=$debitamount;
                        $tCr+=$amount;
                                                }
                        
                                ?> 
                                    <tr>
                                               <td><?= $key->bank_name ?></td>
                                               <td></td>
                                               <td><?= ($debitamount != '0')?$debitamount:'--' ?></td>
                                               <td><?= ($amount != '0')?$amount:'--' ?></td>
                                            </tr>
                                      <?php
                            } 
                            ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th class="lfTblFtr"></th>
                                        <th><?= $tDr + $firstJournal->amount ?></th>
                                        <th><?= $tCr  ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>  
</div>

        
  
    
    
</div>


</div>

