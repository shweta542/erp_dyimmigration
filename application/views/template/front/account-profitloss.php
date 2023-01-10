
<?php $arr = explode('|',$privileges_settings->designation) ;
function CheckNumber($x) {
  if ($x > 0)
    {$message = "profit";}
  if ($x == 0)
    {$message = "Zero";}
  if ($x < 0)
    {$message = "loss";}
  echo $message."\n";
}
if(isset($_GET['branch'])){
    $branchData=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('branch_id',$_GET['branch'])->get('tbl_branch')->row();
}
?>

  <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Profit/Loss Account</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profit/Loss Account</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
    
                </div>
            </div>
        </div>
        <form action="profitloss.html" method="get">
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
            <div class="review-header balan-hd text-center">
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
            </div>
            <div class="card-body prft-table">  
                <div class="row">
                    <div class="col-md-6">
                        <div class="balnce-dtl">
                            <div class="card bdy-pd">
                                <div class="card-body">
                                    <div class="balance-expns">
                                        <h4 class="bal-hd">Expense</h4>
                                        <div class="prft-left-sec">
                                            <ul class="bal-lst">
                                                <?php 
                                                $expenseOut=0;
                                                foreach ($datamoneyout as $key) {
                                                    $expenseOut+=$key->myamount;
                                                     $subhead=$this->db->where('heads_id',$key->sub_head_id)->get('tbl_heads')->row();
                                                   ?>
                                                <li><?= $key->description ?> <span class="bal-cost"><?= $key->myamount ?></span><br><span class="badge bg-inverse-warning"><?= $key->heads_name ?> </span><span class="badge bg-inverse-warning"><?= $subhead->heads_name ?> </span></li>

                                                   <?php
                                                } ?>
                                            </ul>
                                            
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
                                        <h4 class="bal-hd">Income</h4>
                                             
                                        <ul class="bal-lst">
                                            <?php 
                                            $incomeIn=0;
                                            foreach ($datamoneyin as $key) {
                                                $incomeIn+=$key->myamount;
                                                $subhead=$this->db->where('heads_id',$key->sub_head_id)->get('tbl_heads')->row();
                                               ?>

                                            <li><?= $key->description ?> <span class="bal-cost"><?= $key->myamount ?></span><br><span class="badge bg-inverse-warning"><?= $key->heads_name ?> </span><span class="badge bg-inverse-warning"><?= $subhead->heads_name ?> </span></li>

                                               <?php
                                            } ?>
                                            
                    
                                        </ul>
                                        
                                        <h4 class="bal-ttl">Total Operating Income in <?= CheckNumber($incomeIn-$expenseOut) ?>:<?=  $incomeIn-$expenseOut?></h4>
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

