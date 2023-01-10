
    

	$( document ).ready(function() {

        function loadershow(){  
            $(".transparacy").css({'display': 'block'});
            $(".loader").css({'display': 'block'});
        }

        function loaderhide(){  
            $(".transparacy").css({'display': 'none'});
            $(".loader").css({'display': 'none'});
        }
        
    	 var baseHref = document.getElementsByTagName('base')[0].href;
      	 $("form").on('submit',function(event) {
            event.preventDefault();
    		var url=$(this).data('url');
    		var myalert=$(this).data('alert');
            var location=$(this).data('location');
            var loader=$(this).data('loader');
            if (url) {
                if (loader) {
                    loadershow();
                }
                    $.ajax({
                    url: baseHref+url,
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {

                        if (myalert) {
                            alert(myalert);
                            loaderhide();
                        }else if(json['msg']){
                            alert(json['msg']);
                            loaderhide();
                        }else{

                        }
                        if (json['status']) {
                            if (location) {
                                
                                window.location.href = location;
                            }else{
                                  window.location.reload(); 
                            }
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            }
    	
            });
});//ready close



   


