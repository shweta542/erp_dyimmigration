<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
function __construct()
	{
		parent::__construct();
		$this->load->model(array('defaultModel'));
		$this->load->library('pagination');
		if($this->is_logged_in()){

		$this->maindata=$this->db->where('USER_ID',$this->is_logged_in())->get('user_tbl')->row();
		}
			date_default_timezone_set("Asia/Kolkata");
	}
	 var $data='1';
	public function index()//branch login
	{
		echo 'Error';
	}
	
	
	public function accountBank()//view account bank page 
	{
		if($this->is_logged_in()){
		$data['sidepage'] = 'accountBank';
		$data['oraganisation_id'] = $this->maindata->oraganisation_id;
		//Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',0)->get('tbl_bank')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
		$data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->limit($config["per_page"],$i)->order_by('bank_id','DESC')->get('tbl_bank')->result();
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links);
		$this->get_user_template('account-bank',$data);
		}else{
			$this->index();
		}
	}
    public function accountGroup()//view account bank page 
    {
        if($this->is_logged_in()){
        $data['sidepage'] = 'accountGroup';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        //Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_group')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
        $data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->limit($config["per_page"],$i)->order_by('group_name','ASC')->get('tbl_group')->result();
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links);
        $this->get_user_template('account-group',$data);
        }else{
            $this->index();
        }
    }
	public function accountHead()//view account bank page 
    {
        if($this->is_logged_in()){
        $data['sidepage'] = 'accountHead';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        //Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('heads_fk',0)->where('del_status',0)->get('tbl_heads')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
        $data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->order_by('heads_name','ASC')->limit($config["per_page"],$i)->order_by('heads_id','DESC')->get('tbl_heads')->result();
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links);
        $this->get_user_template('account-head',$data);
        }else{
            $this->index();
        }
    }
    public function accountSubhead()//view account bank page 
    {
        if($this->is_logged_in()){
        $data['sidepage'] = 'accountSubhead';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        //Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk !=','0')->get('tbl_heads')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
        $data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk !=','0')->order_by('heads_name','ASC')->limit($config["per_page"],$i)->order_by('heads_id','DESC')->get('tbl_heads')->result();
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links);
        $this->get_user_template('account-sub-head',$data);
        }else{
            $this->index();
        }
    }
    public function vendorCustomer()//view account bank page 
    {
        if($this->is_logged_in()){
        $data['sidepage'] = 'vendorCustomer';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        //Pagination Begins
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('group_status',1)->where('del_status',0)->get('tbl_heads')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
            
        $data['data']= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('group_status',1)->limit($config["per_page"],$i)->order_by('heads_id','DESC')->get('tbl_heads')->result();
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links);
        $this->get_user_template('account-vendorCustomer',$data);
        }else{
            $this->index();
        }
    }
     public function journalEntries()
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'journalEntries';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('group_status',0)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('group_status',0)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();

        $data['debtor'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('group_status',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['creditor'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('group_status',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();

        $data['vendorCustomerin'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
        $data['vendorCustomerout'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',2)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
         if (isset($_GET['method'])) {
            
             $firstdata =$this->db->where('status',1)->limit(1)->get('tbl_journal')->row();
             //print_r($firstdata);
             $testout=array();
             $object = new stdClass();
            $object->journal_id = $firstdata->journal_id;
            $object->date = $firstdata->date;
            $object->head_id = $firstdata->head_id;
            $object->moneyInOut = $firstdata->moneyInOut;
            $object->sub_head_id = $firstdata->sub_head_id;
            $object->vendorCustomer = $firstdata->vendorCustomer;
            $object->method = $firstdata->method;
            $object->amount = $firstdata->amount;
            $object->description = $firstdata->description;
            $object->oraganisation_id = $firstdata->oraganisation_id;
            $object->branch_id = $firstdata->branch_id;
            $object->group_fk = $firstdata->group_fk;
            $object->refrence_id = $firstdata->refrence_id;
            $object->datetime = $firstdata->datetime;
            $object->del_status = $firstdata->del_status;
            $object->lastmodify = $firstdata->lastmodify;
            $object->status = $firstdata->status;
             array_push($testout,$object);
            // print_r($testout);
            $fdate =date('Y-m-d',strtotime($_GET['from']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));
              $data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
              $this->db->where('del_status',0);
              $this->db->where('status!=',2);
            $this->db->where('status!=',1);
              if($_GET['moneyInOut'] != ""){
                  if ($_GET['moneyInOut'] == '3' ){
                  $this->db->where('moneyInOut',1);
                  $this->db->where('moneyInOut',2);
              }else{
                 $this->db->where('moneyInOut',$_GET['moneyInOut']); 
              } 
              }
              /* if($_GET['vendorCustomer'] != "" && $_GET['vendorCustomer'] != "0"){
                     $this->db->where('vendorCustomer',$_GET['vendorCustomer']);
                }*/
                if($_GET['branch'] != "" && $_GET['branch'] != "0"){
                     $this->db->where('branch_id',$_GET['branch']);
                }
             if($_GET['method'] != ""){
             $this->db->where('method',$_GET['method']);
            }
            echo date("Y-m-d", strtotime($_GET['from']));
            if($_GET['from'] !="" && $_GET['to'] !=""){
               $this->db->where('date >= ',date("Y-m-d", strtotime($_GET['from'])));
               $this->db->where('date <= ',date("Y-m-d", strtotime($_GET['to'])));
            }
              $testout1 =$this->db->order_by('journal_id','DESC')->get('tbl_journal')->result();
              //print_r($testout1);
              foreach($testout1 as $testkey => $testvalue){
                  array_push($testout,$testvalue);
              }
               
              
               $data['data'] = $testout;
            $data['counts']=0;
            $data["links"] =[];
         }else{
            $config = array();
       
            $url = base_url($this->uri->uri_string());
           
            $config["base_url"] = $url;
            $total_row = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status!=',2)->order_by('journal_id','DESC')->get('tbl_journal')->num_rows();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 50;
            $config['use_page_numbers'] = TRUE;
            //$config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
         
            $config['base_url'] = base_url($this->uri->uri_string());
            $this->pagination->initialize($config);
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            if ($page>1) {
            $x = $page*$config["per_page"];
            $i= $x-$config["per_page"];
            }else{
            $i=0;
            }
            $data["page"] = $page;
            $data['counts']=$i;
         
          $data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status!=',2)->where('status!=',1)->order_by('journal_id','DESC')->limit($config["per_page"],$i)->get('tbl_journal')->result();
            
        
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links);

         }
          $data['countjournal'] =$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->from('tbl_journal')->count_all_results();
            $this->get_user_template('account-Journal-entries',$data);
        }else{
            $this->index();
        }
    }
    public function getSubhead_request(){

        $res="";  
        $query=$this->db->where('heads_fk',$_POST['head_id'])->where('subheads_fk',0)->get('tbl_heads')->result();
        foreach($query as $row){
            $res.= '<option value="'.$row->heads_id.'" >'.$row->heads_name.'</option>';
        }
    echo $res;
    }
    public function getvendorcustomer_request(){

        $res="";  
        $query=$this->db->where('moneyInout',$_POST['moneyInOut'])->where('del_status',0)->get('tbl_vendorcustomer')->result();
        foreach($query as $row){
            $res.= '<option value="'.$row->vendorcustomer_id.'" >'.$row->vendorcustomer_name.'</option>';
        }
    echo $res;
    }
     public function ledger()
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'ledger';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['vendorCustomer'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
         if (isset($_GET['method'])) {
            $fdate =date('Y-m-d',strtotime($_GET['form']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));
            /*if ($_GET['moneyInOut'] == '3' ) {
                $where = '(moneyInOut="1" or moneyInOut = "2" )';
            }else{
            }*/

           /* $where = '(vendorCustomer="'.$_GET['vendorCustomer'].'" or method = "'.$_GET['method'].'" or head_id = "'.$_GET['head_id'].'" or date >= "'. $fdate.'" and date <= "'.$tdate.'")';

             $data['data'] = $this->db->
             where('oraganisation_id',$this->maindata->oraganisation_id)->
             where($where)->
             where('head_id!=',"")->

             where('del_status',0)->
             where('status',0)->
             get('tbl_journal')->result();*/
              $fdate =date('Y-m-d',strtotime($_GET['form']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));
              $data['data'] = $this->db->where('del_status',0);
              $this->db->where('status',0);
           
              
               /*if($_GET['vendorCustomer'] != "" && $_GET['vendorCustomer'] != "0"){
                     $this->db->where('vendorCustomer',$_GET['vendorCustomer']);
                }*/
             if($_GET['method'] != ""){
             $this->db->where('method',$_GET['method']);
            }
            if($_GET['head_id'] != ""){
             $this->db->where('head_id',$_GET['head_id']);
            }
            if($_GET['form'] !="" && $_GET['to'] !=""){
               $this->db->where('date >= ',date("Y-m-d", strtotime($_GET['form'])));
               $this->db->where('date <= ',date("Y-m-d", strtotime($_GET['to'])));
            }
               if($_GET['branch'] != "" && $_GET['branch'] != "0"){
                     $this->db->where('branch_id',$_GET['branch']);
                } 
               $data['data'] = $this->db->get('tbl_journal')->result();
         }else{

          $data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',0)->get('tbl_journal')->result();
         }

            $this->get_user_template('account-ledger',$data);
        }else{
            $this->index();
        }
    }
     public function balancesheet()
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'balancesheet';
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
             $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
             if (isset($_GET['from'])) {
                $fdate =date('Y-m-d',strtotime($_GET['from']));
                $tdate =date('Y-m-d',strtotime($_GET['to']));
                /* $where = '(j.branch_id = "'.$_GET['branch'].'" and j.date >= "'. $fdate.'" and j.date <= "'.$tdate.'")';*/
                $data['datamoneyout'] = $this->db->select('DISTINCT(h.heads_id),h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->group_by('h.heads_id')
            ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
            $data['datamoneyin'] = $this->db->select('DISTINCT(h.heads_id),h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->group_by('h.heads_id')
            ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
             }else{
                $data['datamoneyout'] = $this->db->select('DISTINCT(h.heads_id),h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->order_by('h.heads_id','DESC')
            ->group_by('h.heads_id')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
            $data['datamoneyin'] = $this->db->select('DISTINCT(h.heads_id),h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->group_by('h.heads_id')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
             }
            $this->get_user_template('account-balancesheet',$data);
        }else{
            $this->index();
        }
    }
    public function trialbalance()
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'trialbalance';
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
            $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();

            $this->get_user_template('account-trialbalance',$data);
        }else{
            $this->index();
        }
    }
    public function profitloss()
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'profitloss';
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
             $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
             if (isset($_GET['from'])) {
                $fdate =date('Y-m-d',strtotime($_GET['from']));
                $tdate =date('Y-m-d',strtotime($_GET['to']));
                /* $where = '(j.branch_id = "'.$_GET['branch'].'" and j.date >= "'. $fdate.'" and j.date <= "'.$tdate.'")';*/
                $data['datamoneyout'] = $this->db->select('j.*,h.status as headstatus,h.heads_name as heads_name,amount as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->order_by('h.heads_id','DESC')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
            $data['datamoneyin'] = $this->db->select('j.*,h.status as headstatus,h.heads_name as heads_name,amount as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->order_by('h.heads_id','DESC')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
             }else{
                $data['datamoneyout'] = $this->db->select('j.*,h.status as headstatus,h.heads_name as heads_name,amount as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->order_by('h.heads_id','DESC')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
            $data['datamoneyin'] = $this->db->select('j.*,h.status as headstatus,h.heads_name as heads_name,amount as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->order_by('h.heads_id','DESC')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
             }
            
            $this->get_user_template('account-profitloss',$data);
        }else{
            $this->index();
        }
    }
    public function profitloss1()
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'profitloss';
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
             $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
             if (isset($_GET['from'])) {
                $fdate =date('Y-m-d',strtotime($_GET['from']));
                $tdate =date('Y-m-d',strtotime($_GET['to']));
                /* $where = '(j.branch_id = "'.$_GET['branch'].'" and j.date >= "'. $fdate.'" and j.date <= "'.$tdate.'")';*/
                $data['datamoneyout'] = $this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->group_by('j.head_id')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
            $data['datamoneyin'] = $this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->group_by('j.head_id')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
             }else{
                $data['datamoneyout'] = $this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->group_by('j.head_id')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
            $data['datamoneyin'] = $this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as myamount')->
            join('tbl_heads h', 'h.heads_id = j.head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->group_by('j.head_id')
             ->where('j.del_status',0)
            ->where('h.del_status',0)
            ->get('tbl_journal j')
            ->result();
             }
            
            $this->get_user_template('account-profitloss1',$data);
        }else{
            $this->index();
        }
    }
    public function profitlossdetail($id,$inout)
    {
        if($this->is_logged_in()){

            $data['subId'] = $id;
            $data['inout'] = $inout;
            $data['sidepage'] = 'profitloss';
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
            $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['vendorCustomerin'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
        $data['vendorCustomerout'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',2)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         

            $data['subheaddata'] = $this->db->where('heads_id',$id)->get('tbl_heads')->row();
             $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
            
            $this->get_user_template('account-profitlossdetail',$data);
        }else{
            $this->index();
        }
    }
     public function ledgerdetail()
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'ledgerdetail';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['vendorCustomer'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
         $data['bank1'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         if (isset($_GET['method'])) {
            /*$fdate =date('Y-m-d',strtotime($_GET['form']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));*/
            /*if ($_GET['moneyInOut'] == '3' ) {
                $where = '(moneyInOut="1" or moneyInOut = "2" )';
            }else{
            }*/
            /*$where = '(vendorCustomer="'.$_GET['vendorCustomer'].'" or method = "'.$_GET['method'].'" or head_id = "'.$_GET['head_id'].'" or date >= "'. $fdate.'" and date <= "'.$tdate.'")';
             $data['data'] = $this->db->
             where('oraganisation_id',$this->maindata->oraganisation_id)->
            
             where($where)->
             where('del_status',0)->
             where('status',0)->
             get('tbl_journal')->result();*/
             /*$data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
              $this->db->where('del_status',0);
              $this->db->where('status',0);
           
              
               
             if($_GET['method'] != ""){
             $this->db->where('method',$_GET['method']);
            }
            if($_GET['head_id'] != ""){
             $this->db->where('head_id',$_GET['head_id']);
            }
            if($_GET['form'] !="" && $_GET['to'] !=""){
               $this->db->where('date >= ',$_GET['form']);
               $this->db->where('date <= ',$_GET['to']);
            }
            if($_GET['branch'] != "" && $_GET['branch'] != "0"){
                     $this->db->where('branch_id',$_GET['branch']);
                } 
               $data['data'] = $this->db->get('tbl_journal')->result();*/
               if($_GET['head_id'] != ""){

               $data['head'] = $this->db->where('heads_id',$_GET['head_id'])->get('tbl_heads')->result();
               }else{
                $data['head'] =array();

               }
               if($_GET['method'] != ''){
               echo "dgsfdsdfsdfsdfsdsd";
                    $data['bank']=$this->db->where('bank_id',$_GET['method'])->get('tbl_bank')->result();
               }else{
                $data['bank']=array();
               }
         }else{
          $data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',0)->get('tbl_journal')->result();
         $data['head'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->get('tbl_heads')->result();
         $data['bank']=$this->db->where('del_status',0)->get('tbl_bank')->result();
         }
         $data['vendorCustomer'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_vendorcustomer')->result();
            $this->get_user_template('account-ledger-detail',$data);
        }else{
            $this->index();
        }
    }
    public function cash()
    {
       if($this->is_logged_in()){
            $data['sidepage'] = 'cash';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
        $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['vendorCustomerin'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
        $data['vendorCustomerout'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',2)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
         if (isset($_GET['moneyInOut'])) {
           /* $fdate =date('Y-m-d',strtotime($_GET['form']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));
            if ($_GET['moneyInOut'] == '3'){
                $where = '(moneyInOut="1" or moneyInOut = "2")';
            }else{
                $where = '(moneyInOut="'.$_GET['moneyInOut'].'")';
            }*/
              $this->db->where('oraganisation_id',$this->maindata->oraganisation_id);
             if($_GET['form'] !="" && $_GET['to'] !=""){

               $this->db->where('date >= ',date('Y-m-d',strtotime($_GET['form'])));
               $this->db->where('date <= ',date('Y-m-d',strtotime($_GET['to'])));
            }
            if($_GET['moneyInOut'] != ""){
              if ($_GET['moneyInOut'] == '3'){
                $where = '(moneyInOut="1" or moneyInOut = "2")';
                $this->db->where($where);
               
              }else{
                 $this->db->where('moneyInOut',$_GET['moneyInOut']);
              } 
            }
            
            $this->db->where('method','1');
            $this->db->where('del_status',0);
           $data['data'] =  $this->db->get('tbl_journal')->result();
         }else{

          $data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('method','1')->get('tbl_journal')->result();
         }

            $this->get_user_template('account-cash',$data);
        }else{
            $this->index();
        }
    }
    public function contra()
    {
       if($this->is_logged_in()){
        $data['sidepage'] = 'contra';
        $data['oraganisation_id'] = $this->maindata->oraganisation_id;
      
         $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
         $data['countjournal'] =$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->from('tbl_journal')->count_all_results();
           $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         if (isset($_GET['moneyInOut'])) {
            $fdate =date('Y-m-d',strtotime($_GET['form']));
            $tdate =date('Y-m-d',strtotime($_GET['to']));
            if ($_GET['moneyInOut'] == '3'){
                $where = '(moneyInOut="1" or moneyInOut = "2")';
            }else{
                $where = '(moneyInOut="'.$_GET['moneyInOut'].'")';
            }
             $data['data'] = $this->db->
            where('oraganisation_id',$this->maindata->oraganisation_id)->
            where('date >=', $fdate)->
            where('date <=', $tdate)->
            where($where)->
            where('refrence_id !=','')->
            where('del_status',0)->
            get('tbl_journal')->result();
         }else{

          $data['data'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('refrence_id !=','')->get('tbl_journal')->result();
         }

            $this->get_user_template('account-contra',$data);
        }else{
            $this->index();
        }
    }
    public function headdetail($headid)
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'headdetail';
            $data['headid'] = $headid;
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
             $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['vendorCustomerin'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
        $data['vendorCustomerout'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',2)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();

            $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
 $data['subheaddata'] = $this->db->where('heads_id',$headid)->get('tbl_heads')->row();
            $this->get_user_template('account-trailheaddetail',$data);
        }else{
            $this->index();
        }
    }
    public function balancesheetheadDetail($moneyInOut,$headid)
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'balancesheetheadDetail';
            $data['headid'] = $headid;
            $data['moneyinout'] = $moneyInOut;
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
             $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['vendorCustomerin'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
        $data['vendorCustomerout'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',2)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         
            $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
 $data['subheaddata'] = $this->db->where('heads_id',$headid)->get('tbl_heads')->row();
            $this->get_user_template('account-balancesheetheaddeatil',$data);
        }else{
            $this->index();
        }
    }

    public function getmoneyInOut_request(){

        $res="";  
        $query=$this->db->where('heads_category',$_POST['moneyInOut'])->where('heads_fk',0)->where('group_status',0)->get('tbl_heads')->result();
        $query1=$this->db->where('heads_fk',0)->where('group_status',1)->get('tbl_heads')->result();
        foreach($query as $row){
            $res.= '<option data-groupstatus="'.$row->group_status.'" data-group="'.$row->group_fk.'" data-id="'.$row->heads_category.'" value="'.$row->heads_id.'" >'.$row->heads_name.'</option>';
        }
        foreach($query1 as $row){
            $res.= '<option data-groupstatus="'.$row->group_status.'" data-group="'.$row->group_fk.'" data-id="'.$row->heads_category.'" value="'.$row->heads_id.'" >'.$row->heads_name.'</option>';
        }
    echo $res;
    }
    public function newleadgerdetail($headid)
    {
        if($this->is_logged_in()){
            $data['sidepage'] = 'balancesheetheadDetail';
            $data['headid'] = $headid;
            
            $data['oraganisation_id'] = $this->maindata->oraganisation_id;
             $data['moneyIn'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['moneyOut'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result();
        $data['vendorCustomerin'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',1)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
        $data['vendorCustomerout'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('status',2)->order_by('vendorcustomer_id','DESC')->get('tbl_vendorcustomer')->result();
         $data['bank'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->get('tbl_bank')->result();
         
            $data['branch'] = $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->order_by('branch_id','DESC')->get('tbl_branch')->result();
 $data['subheaddata'] = $this->db->where('heads_id',$headid)->get('tbl_heads')->row();
            $this->get_user_template('account-newledgerdetail',$data);
        }else{
            $this->index();
        }
    }
}
