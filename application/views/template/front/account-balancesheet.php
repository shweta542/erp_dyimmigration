
<?php $arr = explode('|',$privileges_settings->designation) ;
$firstJournal = $this->db->where('status',1)->get('tbl_journal')->row();
$tDr=0;
$tCr=0;
function CheckNumber($x) {
  if ($x > 0)
    {$message = "+";}
  if ($x == 0)
    {$message = "";}
  if ($x < 0)
    {$message = "-";}
  echo $message."\n";
}
function CheckNumber1($x) {
  if ($x > 0)
    {$message = "profit";}
  if ($x == 0)
    {$message = "Zero";}
  if ($x < 0)
    {$message = "loss";}
  return $message;
}
?>
<?php 
$expenseOut=0;
foreach ($datamoneyout as $key) {
    $expenseOut+=$key->myamount;
} ?>
<?php 
    $incomeIn=0;
    foreach ($datamoneyin as $key) {
        $incomeIn+=$key->myamount;
       
      
    } ?>

  <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Balance Sheets</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Balance Sheets</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a class="btn btn-white" href="javascript:void(0)" onclick="CreatePDFfromHTML('card','BalanceSheets')">PDF</a>
                </div>
            </div>
        </div>
        <form action="balancesheet.html" method="get">
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
            <div class="card-body prft-table">  
                <div class="row">
                    <div class="col-md-6">
                        <div class="balnce-dtl">
                            <div class="card bdy-pd">
                                <div class="card-body">
                                    <div class="balance-expns">
                                        <h4 class="bal-hd">Liabilities & Equities</h4>
                                        <div class="expense-card">
                                            <h4 class="bal-ttl fst">Current Liabilities</h4>    
                                            <ul class="bal-lst">
                                    <li>Opening Balance <span class="bal-cost"><?= $firstJournal->amount ?></span></li>
                                    <li>Profit & loss <span class="bal-cost"> <?=  $incomeIn-$expenseOut?></span></li>
                                            </ul>
                                            <h4 class="expense-hd">Total Current Liabilities<span class="cost"><?= $firstJournal->amount + $incomeIn-$expenseOut ?></span></h4>

                                            <?php
                                            $tCr+=$firstJournal->amount + $incomeIn-$expenseOut;
                                            ?>
                                             </div>
                                             <hr>
                                                <div class="expense-card">
                                                    
                                            <?php
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->where('group_status',0)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey ) {
                                                ?>
                                                <h4 class="expense-hd"><?= $groupkey->group_name ?></h4>
                                            <ul class="expense-list-charge">

                                            <?php
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('status',1)->order_by('heads_id','DESC')->where('group_fk',$groupkey->group_id)->get('tbl_heads')->result() as $key ) {
                                               
                    
                  $headcr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','2')->where('del_status',0)->get('tbl_journal')->row();

                        $headcr1=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','1')->where('del_status',0)->get('tbl_journal')->row();

                       if($headcr){
                            $cerout=$headcr->amount;
                        }else{
                            $cerout=0;
                        }
                        if($headcr1){
                            $cerin=$headcr1->amount;
                        }else{
                            $cerin=0;
                        }
                         $cerinout=$cerin - $cerout;
                        
                       if(CheckNumber1($cerinout) == 'profit'){
                       $tCr+=$cerin - $cerout;
                       }else if(CheckNumber1($cerinout) == 'loss'){
                       
                       }else if(CheckNumber1($cerinout) == 'Zero'){
                       
                       }else{
                       
                       }
                       if(CheckNumber1($cerinout) == 'profit'){
                           $ctest=$cerin - $cerout;
                       ?>
                                            
                                             <li><a href="balancesheetheadDetail.html/1/<?= $key->heads_id ?>"><?= $key->heads_name ?>  <?php if(CheckNumber1($cerinout) == 'profit'){
                                            echo '<span>'. $ctest .'</span>';
                                        } ?></a>    </li>   
                                        <?php } ?>  
                                           
                                      <?php
                            } 
                        
                            ?>
                            </ul>
                            <?php
                            } 
                        
                            ?>
                        </div>
                                    <!--<div class="expense-card">       
                                            <?php
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->where('group_category',1)->where('group_status',0)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey ) {
                                                ?>
                                                <h4 class="expense-hd"><?= $groupkey->group_name ?></h4>
                                                <ul class="expense-list-charge">
                                                <?php
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('status',1)->where('heads_category',1)->order_by('heads_id','DESC')->where('group_fk',$groupkey->group_id)->get('tbl_heads')->result() as $key ) {
                                               
                    $headcr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','1')->where('del_status',0)->get('tbl_journal')->row(); 
                  
                       //$tCr+=$headcr->amount;
                                ?>
                                            
                                            
                                              <!--<li class="expense-hd"><a href="balancesheetheadDetail.html/1/<?= $key->heads_id ?>"><?= $key->heads_name ?></a> <span ><?= $headcr->amount ?></span></li> -->
                                               <!--<?php foreach ($headcr as $key1) {
                                                    $tCr+=$key1->amount;
                                                     $getsubhead=$this->db->select('heads_name')->where('heads_id',$key1->sub_head_id)->limit(1)->get('tbl_heads')->row();
                                                  ?>
                                                  
                                               <li> (<b><?= $key->heads_name ?></b>)<span ><?= $key1->amount ?></span></li>
                                                  <?php
                                                } ?>-->
                                            
                                      <!--<?php
                            } 
                            ?>
                            </ul>
                            <?php
                        }
                            ?>
                        </div>-->
<div class="expense-card"> 
                               <?php
                               foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result() as $key ) {
                                 $bankcr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','1')->where('del_status',0)->get('tbl_journal')->row();
                                  $bankdr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','2')->where('del_status',0)->get('tbl_journal')->row();
                               ?> 
                              
                                                <?php 
                        if($key->status == '1'){
                            if($bankcr->amount){
                            $amount=$bankcr->amount + $firstJournal->amount;
                            
                        }else{
                            $amount=0;
                        }
                        }else{
                            if($bankcr->amount){
                            $amount=$bankcr->amount ;
                            
                        }else{
                            $amount=0;
                        }
                        }
                        if($bankdr->amount == $amount){
                                $debitamount= 0;
                                $amount = 0;
                        }else if($bankdr->amount > $amount){
                            $debitamount= $bankdr->amount - $amount;
                            $amount = 0;
                        }else if($bankdr->amount < $amount){
                             $amount= $amount - $bankdr->amount ;
                            $debitamount = 0;
                        }else{
                            $debitamount= $bankdr->amount;

                        }
                        
                        if($key->status == '1'){
                            if($bankcr->amount){
                            //$amount=$bankcr->amount + $firstJournal->amount;
                            $amount1=$bankcr->amount;
                            
                        }else{
                            $amount1=0;
                        }
                        }else{
                            if($bankcr->amount){
                            $amount1=$bankcr->amount ;
                            
                        }else{
                            $amount1=0;
                        }
                        }
                        if($bankdr->amount == $amount1){
                                $debitamount1= 0;
                                $amount1 = 0;
                        }else if($bankdr->amount > $amount1){
                            $debitamount1= $bankdr->amount - $amount1;
                            $amount1 = 0;
                        }else if($bankdr->amount < $amount){
                             $amount1= $amount - $bankdr->amount ;
                            $debitamount1 = 0;
                        }else{
                            $debitamount1= $bankdr->amount;

                        }
                                                $tCr+=$debitamount1;
                                                    $tCr+=$debitamount;
                                                  ?>
                                        <ul class="expense-list-charge">
                                                <li style="<?= ($debitamount != '0')?'':'display: none' ?>"><?= $key->bank_name ?><span class=""><?= ($debitamount != '0')?$debitamount:'--' ?></span></li>
                                                  <?php if($debitamount != '0'){
                                                      ?>
                                                       <li style=""><?= $key->bank_name ?><span class=""><?= $debitamount ?></span></li>
                                                       <?php
                                                  }else if($debitamount1 != '0'){
                                                      ?>
                                                      <li style=""><?= $key->bank_name ?><span class=""><?= $debitamount1 ?></span></li>
                                                      <?php
                                                  }else{
                                                  } ?>
                                                 
                                            </ul>
                               <?php } ?>  
                               </div>
                               <div class="expense-card-ftr">
                                           
                               <h4 class="bal-ttl">Total Equities: <?= $tCr ?></h4>
                                        </div>          
                                       
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="balnce-dtl">
                            <div class="card bdy-pd">
                                <div class="card-body">
                                    <div class="balance-expns">
                                        <h4 class="bal-hd">Assets</h4>

                                        <div class="expense-card">
                                         <?php
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->where('group_status',0)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey ) {
                                                ?>
                                                <h4 class="expense-hd"><?= $groupkey->group_name ?></h4>
                                         <ul class="expense-list-charge">
                                                                                  <?php
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('status',1)->order_by('heads_id','DESC')->where('group_fk',$groupkey->group_id)->get('tbl_heads')->result() as $key ) { 

                        $headdr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','2')->where('del_status',0)->get('tbl_journal')->row();
                        $headdr1=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','1')->where('del_status',0)->get('tbl_journal')->row();
                        if($headdr){
                            $detout=$headdr->amount;
                        }else{
                            $detout=0;
                        }
                        if($headdr1){
                            $detin=$headdr1->amount;
                        }else{
                            $detin=0;
                        }
                        $detinout=$detin - $detout;
                       if(CheckNumber1($detinout) == 'profit'){
                       
                       }else if(CheckNumber1($detinout) == 'loss'){
                        $tDr+=abs($detin - $detout);
                       }else if(CheckNumber1($detinout) == 'Zero'){
                        
                       }else{
                        $tDr+=0;
                       }
                       if(CheckNumber1($detinout) == 'loss'){


                                                ?>
                                        <li><a href="balancesheetheadDetail.html/2/<?= $key->heads_id ?>"><?= $key->heads_name ?> - <?php if(CheckNumber1($detinout) == 'loss'){
                                            $dtest=$detin - $detout; 
                                            echo '<span >'.abs($dtest).'</span>'; 
                                        } ?></a></li>   
                                    <?php } ?>
                                        

                                    <?php }
                                            
                                     ?>
                                 </ul>
                                 <?php }
                                            
                                     ?>
                                 </div>
                                 <!--<div class="expense-card">
                                        <?php
                                         foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->where('group_category',2)->where('group_status',0)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey ) { 
                                            ?>
                                            <h4 class="expense-hd"><?= $groupkey->group_name ?></h4>   
                                             <ul class="expense-list-charge">
                                        <?php
                                            foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('status',1)->where('heads_category',2)->order_by('heads_id','DESC')->where('group_fk',$groupkey->group_id)->get('tbl_heads')->result() as $key ) {  
$headdr=$this->db->select_sum('amount')->where('head_id',$key->heads_id)->where('moneyInOut','2')->where('del_status',0)->get('tbl_journal')->row();
                            //$tDr+=$headdr->amount;                    
                                               
                                                ?>
                                       <!--<li class="expense-hd"><a href="balancesheetheadDetail.html/2/<?= $key->heads_id ?>"><?= $key->heads_name ?></a> <span class=""><?= $headdr->amount ?></span></li>-->
                                              
                                          <!--<?php foreach ($headdr as $key1) {
                                                    $tDr+=$key1->amount;
                                                    $getsubhead1=$this->db->select('heads_name')->where('heads_id',$key1->sub_head_id)->limit(1)->get('tbl_heads')->row();
                                                  ?>
                                                  <li class="expense-hd"><a href="balancesheetheadDetail.html/2/<?= $key->heads_id ?>"><?= $key->heads_name ?></a> <span class=""><?= $key1->amount ?></span></li> 
                                                <li><?= $key1->description ?> (<b><?= $getsubhead1->heads_name ?></b>)<span class=""><?= $headdr->amount ?></span></li>
                                                  <?php
                                                } ?>-->        
                                        
                                   <!-- <?php }
                                    ?>
                                    </ul>
                                    <?php
                                            }
                                     ?>
                                 </div>-->
                                 <div class="expense-card">
                                    <?php
                               foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result() as $key ) {
                                 $bankcr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','1')->where('del_status',0)->get('tbl_journal')->row();
                                  $bankdr=$this->db->select_sum('amount')->where('method',$key->bank_id)->where('moneyInOut','2')->where('del_status',0)->get('tbl_journal')->row();
                               ?> 
                              
                                                <?php 
                        if($key->status == '1'){
                            if($bankcr->amount){
                            //$amount=$bankcr->amount + $firstJournal->amount;
                            $amount=$bankcr->amount;
                            
                        }else{
                            $amount=0;
                        }
                        }else{
                            if($bankcr->amount){
                            $amount=$bankcr->amount ;
                            
                        }else{
                            $amount=0;
                        }
                        }
                        if($bankdr->amount == $amount){
                                $debitamount= 0;
                                $amount = 0;
                        }else if($bankdr->amount > $amount){
                            $debitamount= $bankdr->amount - $amount;
                            $amount = 0;
                        }else if($bankdr->amount < $amount){
                             $amount= $amount - $bankdr->amount ;
                            $debitamount = 0;
                        }else{
                            $debitamount= $bankdr->amount;

                        }
                                                    $tDr+=$amount ;
                                                    //$tCr+=$debitamount;
                                                  ?>
<ul class="expense-list-charge">
                                                <li style="<?= ($amount != '0')?'':'display: none' ?>"><?= $key->bank_name ?><span class=""><?= ($amount != '0')?$amount:'--' ?></span></li>
                                                  <!--<li style=""><?= $key->bank_name ?><span class=""><?= $debitamount ?></span></li>-->
                                            </ul>
                               <?php } ?> 
                           </div>
                                        <!-- <h4 class="bal-ttl">Total Operating Income: 5000</h4> -->
                                        <!-- <h4 class="bal-ttl fst">Bank</h4>   
                                        <ul class="bal-lst">
                                            <li>Bank Acc. <span class="bal-cost">6000</span></li>
                                        </ul>
                                        <h4 class="bal-ttl">Total: 5000</h4>
                                        <h4 class="bal-ttl fst">Other Current Assets</h4>                                       
                                        <ul class="bal-lst">
                                            <li>Employee Advance <span class="bal-cost">6000</span></li>
                                            <li>Input Tax Payable <span class="bal-cost">6000</span></li>
                                            <li>Inventory Assets <span class="bal-cost">6000</span></li>
                                        </ul> -->
                                        <div class="expense-card-ftr">
                                        <h4 class="bal-ttl">Total Operating Income: <?= $tDr ?></h4>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

        
  
    
    
</div>


</div>

