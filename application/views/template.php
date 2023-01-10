<?php  
	//var_dump($home);
	if(isset($home)){ 

        $this->load->view(TEMPLATE_NAME.'/include/header1');
        $this->load->view($template);
        $this->load->view(TEMPLATE_NAME.'/include/footer'); 

    }
    else{
      
        $this->load->view(TEMPLATE_NAME.'/include/header');
    	$this->load->view(TEMPLATE_NAME.'/include/sidebar');
        $this->load->view($template);
        $this->load->view(TEMPLATE_NAME.'/include/footer');    
    }
    

    //$this->load->view(TEMPLATE_NAME.'/search');
   
?>