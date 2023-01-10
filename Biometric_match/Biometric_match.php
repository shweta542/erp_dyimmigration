
<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control"); 

function makeRequest($url, $callDetails = false)
{
  // Set handle
  $ch = curl_init($url);

  // Set options
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Execute curl handle add results to data return array.
  $result = curl_exec($ch);
  $returnGroup = json_decode($result,true);//['curlResult' => json_decode($result,true),];

  // If details of curl execution are asked for add them to return group.
  if ($callDetails) {
    //$returnGroup['info'] = curl_getinfo($ch);
   //$returnGroup['errno'] = curl_errno($ch);
    //$returnGroup['error'] = curl_error($ch);
  }

  // Close cURL and return response.
  curl_close($ch);
  return $returnGroup;
}

$url="https://erp.dyimmigration.com/Api/erpGetUserfingerprint_request";
$response = makeRequest($url, true);

// Check your return to make sure you are making a successful connection.
//echo '<pre>';
//print_r($response['data']);
$newArry=array();
foreach($response['data'] as $key => $value){
   // echo  $value['user_email'];
    $newArry[$key]=$value['USER_FINGERPRINT'];
}
//echo '<pre>';
//print_r($response['data']);
?>
<script>
history.pushState(null, document.title, location.href);
window.addEventListener('popstate', function (event)
{
  history.pushState(null, document.title, location.href);
});
</script>
<?php 


//echo '<br>';
//print_r($arr);
//$fp='jhjsfhsfgsdfgdgdsgdghghsjkdhgjkdhgjhdgjkdg';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>User Login</title>
<link rel="stylesheet" href="../css/register.css">
<!--<link rel="stylesheet" href="../css/bootstrap.min.css">-->
<link rel="stylesheet" href="../css/AdminLTE.min.css">

<link rel="shortcut icon" type="image/x-icon" href="https://erp.dyimmigration.com/uploads/images/2021-12-30-01/fc52923511a5dfe65a01dcaa57ae89b4.jpeg"/>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="css/font-awesome.min.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="css/select2.min.css">


<!-- Main CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- responsive -->
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/alert.css">


<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">


</head>
<body>

<section class="mainbody">
    <div class="container" id="container">
    	<div class="bio-metric-inr bioInrCol">
    	    <div class="bio-logo">
				<img src="https://erp.dyimmigration.com/uploads/images/2021-12-29-11/419bc4d18a4e398dc8d3dbf7f2cfb49e.jpeg" width="50" height="50">
			</div>
    	    <div class="row display-flex">
    	        <div class="col-md-6 height_100">
    	            <div class="punch-lft-sec">
    	                <div>
    	                <div class="bio-icn">
							 <img src="images/print.png"> 
						</div>
    	                <div class="form-group form-focus select-focus">
                        	<form> 
                              <select class="select floating" name="selectuser" id="ddlViewBy">
                                    <?php foreach($response['data'] as $key){
                                      ?>
                                          <option data-out="<?= $key['out'] ?>" data-in="<?= $key['in'] ?>" data-department="<?= $key['department_name'] ?>" data-designation="<?= $key['designation_name'] ?>" data-email="<?= $key['USER_EMAIL'] ?>" data-photo="<?= $key['user_image'] ?>" data-name="<?= $key['USER_NAME'] ?>" value="<?= $key['USER_FINGERPRINT'] ?>"><?= $key['USER_EMAIL'] ?></option>
                                      <?php
                                    } ?>
                              </select>
                              	<label class="focus-label">Employee Name</label>
                              <div class="bio-btn panel-heading font emloyeBtnCol"> 
                              <a href="https://erp.dyimmigration.com/Biometric_match/fingerprint_capture.php"  class="btn btn-primary submit-btn">Register</a>
                                 <a href="javascript:void(0)" onclick="window.location.reload();" class="btn btn-primary submit-btn">Reload</a>
                                 <button type="input" onclick="return Match()" class="btn btn-primary submit-btn" >Start Scanning</button>
                             </div>
                            </form>
                    	</div>
                    	
                    	</div>
    	            </div>
    	        </div>
    	       <div class="col-md-6 height_100">
					<div class="bio-metric-name">
						<div class="bio-pro">
							<div>
								<div class="profile-widget">
									<div class="profile-img">
										<div class="avatar"><img id="image" src="images/user.jpg"></div>
									</div>
									<div class="bio-pro-dis">
										<div class="chat-profile-info">
											<ul class="user-det-list">
												<li>
													<span class="usr-fngr-hd">Employee Name:</span>
													<span class="float-right text-muted" id="name">-</span>
												</li>
												<!--<li>
													<span class="usr-fngr-hd">Department:</span>
													<span class="float-right text-muted" id="department">-</span>
												</li>
												<li>
													<span class="usr-fngr-hd">Designation:</span>
													<span class="float-right text-muted" id="designation">-</span>
												</li>-->
												<li>
													<span class="usr-fngr-hd">Email:</span>
													<span class="float-right text-muted" id="email" >-</span>
												</li>
											<!--	<li>
													<span class="usr-fngr-hd">Punch In:</span>
													<span class="float-right text-muted" id="in">-</span>
												</li>
												<li>
													<span class="usr-fngr-hd">Punch Out:</span>
													<span class="float-right text-muted" id="out">-</span>
												</li>-->
											</ul>
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
</section>
</body>
</html>
<script src="jquery-1.8.2.js"></script>
<script src="mfs100-9.0.2.6.js"></script>

<!---------- Add js for design -------->

<script src="js/bootstrap.min.js"></script>

<script src="js/jquery-3.2.1.min.js"></script>

<script src="js/popper.min.js"></script>

<script src="js/select2.min.js"></script>
<script src="js/alert.js"></script>
<!--------- &&&& -------------->

<script language="javascript" type="text/javascript">
//setInterval(function(){ match() }, 6000);
        var quality = 60; //(1 to 100) (recommanded minimum 55)
        var timeout = 10; 
        var flag = 0;
// Function used to match fingerprint using jason object 
function myalert(title,message){
    $.confirm({
    title: title,
   
    content: message,
    type: 'blue',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Ok',
            btnClass: 'btn-blue',
            action: function(){
                //$("form").find("input[type=text],input[type=password],input[type=email], textarea").val('');
           
            }
        },
       
    }
});
}
function Matchtest() {

            try {
              //fingerprint stored as isotemplate
            
                var isotemplate = <?php echo json_encode($newArry); ?>;
                console.log(isotemplate);
                var i;
                var text = "";
                //console.log(isotemplate.length)
                var flagyes = 0;
                for (i = 0; i < isotemplate.length; i++) {
                  
                var print=isotemplate[i];

                var res = MatchFinger(quality, timeout,print );
                if (res.httpStaus) {
                    if (res.data.Status) {
                        // alert("Finger matched");
                        
                        //variable flag used for authentication 
                        flagyes = 1;
                        flag=1;
                        break;
                    }
                    else {
                        if (res.data.ErrorCode != "0") {
                            alert(res.data.ErrorDescription);
                        }
                        else {
                             alert("Finger not matched");
                        }
                    }
                }
                else {
                    alert(res.err);
                    
                }
            }
            if (flagyes == 0){
              alert('Error',"Finger not matched");
              //Match()
            }else{

              alert('Please Wait',"Finger matched");

              $.ajax({
              url: "https://erp.dyimmigration.com/Api/PunchCardValueGetDetail",
              type: "post",
              data: {print:print},
              cache: false,
              
              dataType: "json",
              success: function(data) {
                alert('Submit Successfully',data['name']);
                
              },
              async:false,
              error: function(e, t, a) {
                  alert(t + "\n" + a)
              }
          });
              
              //Match()
            }
          }
            catch (e) {
                alert(e);
            }
            
          
            // return false;

        }
function Match() {
          try {
            //fingerprint stored as isotemplate
            var e = document.getElementById("ddlViewBy");
          var strUser = e.value;
          //alert(strUser);
              var isotemplate = strUser;
              var res = MatchFinger(quality, timeout, isotemplate);

              if (res.httpStaus) {
                  if (res.data.Status) {
                       alert("Finger matched");
                        
                      //(strUser);
                      $.ajax({
              url: "https://erp.dyimmigration.com/Api/PunchCardValueGetDetail",
              type: "post",
              data: {print:strUser},
              cache: false,
              
              dataType: "json",
              success: function(data) {
                alert('Submit Successfully',data['name']);
                
              },
              async:false,
              error: function(e, t, a) {
                  alert(t + "\n" + a)
              }
          });
                      //variable flag used for authentication 
                      
                      flag=1;
                  }
                  else {
                      if (res.data.ErrorCode != "0") {
                  //alert('jfjf');
                          alert(res.data.ErrorDescription);
                      }
                      else {
                          myalert('Error',"Finger not matched");
                      }
                  }
              }
              else {
                  alert(res.err);
              }
          }
          catch (e) {
              alert(e);
          }
          return false;

}
//function to redirect to next page upon fingerprint matching

function redirect(){

    
    if(flag){ 
    window.location.assign("url"); 
    }
    else{
      alert("Scan Your Finger");
    }

  return false;
}
$('#ddlViewBy').on('change', function() {
    //alert($(this).find(':selected').attr('data-name'))
 var email= $(this).find(':selected').attr('data-email');
 var name= $(this).find(':selected').attr('data-name');
  var image= $(this).find(':selected').attr('data-photo');
  var department= $(this).find(':selected').attr('data-department');
 var designation= $(this).find(':selected').attr('data-designation');
  var myin= $(this).find(':selected').attr('data-in');
 var myout= $(this).find(':selected').attr('data-out');
  $('#name').text(name);
  $('#email').text(email);
   $('#department').text(department);
    $('#designation').text(designation);
    $('#in').text(myin);
    $('#out').text(myout);
    //alert(myout);
  if(image){
       $('#image').attr('src','../'+image);
  }else{
       $('#image').attr('src','images/user.jpg');
  }
 //alert(name);
});
</script>

<script>
var email= $('#ddlViewBy option:first').attr('data-email');
 var name= $('#ddlViewBy option:first').attr('data-name');
 var department= $('#ddlViewBy option:first').attr('data-department');
 var designation= $('#ddlViewBy option:first').attr('data-designation');
 var myin= $('#ddlViewBy option:first').attr('data-in');
 var myout= $('#ddlViewBy option:first').attr('data-out');
  var image= $('#ddlViewBy option:first').attr('data-photo');
  $('#name').text(name);
  $('#email').text(email);
   $('#department').text(department);
    $('#designation').text(designation);
    $('#in').text(myin);
    $('#out').text(myout);
  if(image){
       $('#image').attr('src','../'+image);
  }else{
       $('#image').attr('src','images/avatar-02.jpg');
  }
	if($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: 1,
			width: '100%'
		});
	}
</script>

