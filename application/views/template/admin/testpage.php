<!DOCTYPE html>
<style type="text/css">
    
</style>
<html>
 <head>
  <title>Webslesson Tutorial | Auto Load More Data on Page Scroll with Jquery & PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 
   <script src="http://localhost/newdemo/css/css3-animate-it.js"></script>
   <link href="http://localhost/newdemo/css/animations.css" rel="stylesheet">
 </head>
 <body>
  
   <h2 align="center">Auto Load More Data on Page Scroll with Jquery & PHP</a></h2>
   <br />
   <table id="load_data" style="width: 80%;
margin-left: 20%;" class="table table-striped"></table>
   <div id="load_data_message" align="center" >
       <img src='https://i.gifer.com/9wcA.gif' style="display: none;">
   </div>
   <br />
   <br />
   <br />
   <br />
   <br />
   <br />
 
 </body>
</html>
<script>

$(document).ready(function(){
 
 var limit = 7;
 var start = 0;
 var action = 'inactive';
 function load_country_data(limit, start)
 {
  $.ajax({
   url:"http://localhost/newdemo/admin/main/fetch",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    
     $('#load_data').append(data);
     
    
    if(data == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
     action = 'active';
    }
    else
    {
     //$('img').css("display","block");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
    $('img').css("display","block");
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;

   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
   
  }
 });
 
});
</script>
