<?php  

   if(isset($home)){ 

        //$this->load->view(TEMPLATE_ADMIN_NAME.'/include/header');
        $this->load->view($template);
      // $this->load->view(TEMPLATE_ADMIN_NAME.'/include/footer'); 

    }
    else{
      
    	$this->load->view(TEMPLATE_ADMIN_NAME.'/include/header');
    	$this->load->view(TEMPLATE_ADMIN_NAME.'/include/sidebar');
        $this->load->view($template);
        $this->load->view(TEMPLATE_ADMIN_NAME.'/include/footer');    
    }
    
?>
