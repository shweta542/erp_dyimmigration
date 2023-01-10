   var baseHref = document.getElementsByTagName('base')[0].href;
   function loadershow(){  
            $(".transparacy").css({'display': 'block'});
            $(".loader").css({'display': 'block'});
        }

        function loaderhide(){  
            $(".transparacy").css({'display': 'none'});
            $(".loader").css({'display': 'none'});
        }
         //add register user
        $('#register').on('submit',function(event) {
                event.preventDefault();
                if ($('input[name=PASSWORD]').val()==$('input[name=CONFIRM_PASSWORD]').val()) {
                $.ajax({
                    url: baseHref+'welcome/addUserregister_request',
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                        if (json['msg']==1) {
                            swal("Email Allready Exist!", "You clicked the button!", "warning");
                        }else{
                             swal(json['msg'], "You clicked the button!", "success");
setTimeout(myFunction, 3000);
                        }
                        if (json['status']) {
                           window.location.href = baseHref;
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        swal(ajaxOption+'\n'+errorThrow);
                    }
                });
            }else{
                 alert("Password Not Matched", "You clicked the button!", "warning");
                return false;
            }
            });
function myFunction() {
   location.reload(); 
}
       //user login
        $('#userLogin').on('submit',function(event) {
                event.preventDefault();
                loadershow()
                $.ajax({
                    url: baseHref+'login/login_verify',
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                        loaderhide()
                        if (json['msg']==1) {
                            alert("Access denied!", "You clicked the button!", "warning");
                        }else if(json['msg']==2){
                            alert("Username & Password Not Matched!", "You clicked the button!", "warning");
                        }
                        else if(json['msg']==3){
                           alert("Access Denied");
                        }
                        else{
                            //alert(json['msg'], "You clicked the button!", "success");
                             window.location.href=json['url'];
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
        //user logout
        $('#logout').on('click',function(event) {
                event.preventDefault();
                loadershow()
                $.ajax({
                    url: baseHref+'login/logout',
                    type: 'post',
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                           window.location.href = baseHref;
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        swal(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
        function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#previewHolder').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    alert('select a file to see preview');
    $('#previewHolder').attr('src', '');
  }
}

$("#filePhoto").change(function() {
  readURL(this);
});
$("#employeesalary").change(function() {
  $('#salary').val($(this).find(':selected').data('salary'))
});

         //user add setting
        $('#updateOrganization').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/updateOrganization_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        window.location.reload();
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                         window.location.reload();
                    }
                });
            
            });
        $('#state').change(function () {
 
    var state_id = $('option:selected',this).val();
 
      $.ajax({
        url: baseHref+'Welcome/getCitiesDetail',
        type: 'post',
        data: {state_id:state_id},
       
       // dataType: 'json',
        success: function(response) {
            $("#city").empty();
            $("#city").append(response);
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
           
        }
    });      
           
    });

        $('#country').change(function () {
 
    var country_id = $('option:selected',this).val();
 
      $.ajax({
        url: baseHref+'Welcome/getStateDetail',
        type: 'post',
        data: {country_id:country_id},
       
       // dataType: 'json',
        success: function(response) {
            $("#state").empty();
            $("#state").append(response);
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
           
        }
    });      
           
    });

        //user add setting
        $('#addBranch').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addBranch_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.href="brancheslist.html";
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

        function deleteCommon(table,field,id,myreturn) {
            //alert(id)
             loadershow();
            $.ajax({
                url: baseHref + 'delete/deletecommon_request',
                type: 'post',
                data: {
                    table: table,
                    field:field,
                    id:id,
                    myreturn:myreturn
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      console.log(json)
                    if (json['status']) {
                    alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    alert(ajaxOption + '\n' + errorThrow);
                      loaderhide();
                }
            });
        }
 $('#addDepartment').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addDepartment_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
 $('#addDesignation').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addDesignation_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });


     $(document).on('change', '#department', function(){
 //alert('jhdhd')
    var department_id = $('option:selected',this).val();
 
      $.ajax({
        url: baseHref+'Welcome/getDesignationDetail',
        type: 'post',
        data: {department_id:department_id},
       
       // dataType: 'json',
        success: function(response) {
            $("#designation").empty();
            $("#designation").append(response);
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
           
        }
    });      
           
    });

     $('#addUser').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                 var password = $('#password').val();
                 var confirmpassword = $('#confirmpassword').val();
                 if(password == confirmpassword){
                    $.ajax({
                        url: baseHref+'add/addUser_request',
                        type: 'post',
                         data: new FormData(this),
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success:function(json) {
                             loaderhide()
                             console.log()
                            if (json['status']) {
                                //alert(json['msg'])
                              window.location.reload();
                            }else{
                                alert(json['msg']);
                                //window.location.reload();
                            }
                        },
                        error:function(hrx, ajaxOption, errorThrow) {
                            loaderhide()
                            window.location.reload();
                           //alert('User add successfully!')
                           //window.location.reload();
                        }
                    });
                

                 }else{
                    alert('Password & Confirm-Password not matched!')

                 }
            });

     $('#editUser').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editUser_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('User update successfully!')
                           window.location.reload();
                    }
                });
            
            });

     $('#addHolidays').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addHolidays_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           alert('User update successfully!')
                    }
                });
            
            });

      $('#editHoliday').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editHoliday_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('Holiday update successfully!')
                           window.location.reload();
                    }
                });
            
            });
        $( function() {
    $( ".mydatepicker" ).datepicker({
      minDate: '0'
    });
            $(".mydatepickerjournal").datepicker({
                maxDate: '0',
                dateFormat: 'd M yy',
            });
           
           /*  $(".mydatepickerjournal").datepicker({
                maxDate: '0',
                dateFormat: 'd M yy',
            }); */
            $(".mydatepickerremark").datepicker({
               
                dateFormat: 'd M yy',
            });
             $(".mydatepickerexport").datepicker({
               
                dateFormat: 'yy-m-d',
            });
           
    $( ".mydatepickerholi" ).datepicker();
  } );


      function mydaysdifference(){
//alert(0)
    var fromDay = new Date($('#formDate').val());
    var mdate=$('#formDate').val();
    var arr = mdate.split('/');
    var toDay = new Date($('#toDate').val());
    var arr1 =$('#toDate').val().split('/');
    $('#maindate').val(arr[2]+'-'+arr[0]+'-'+arr[1])
    $('#maindateto').val(arr1[2]+'-'+arr1[0]+'-'+arr1[1])
if(fromDay != "" && toDay != ""){
  if(fromDay > toDay){
    alert('From is greater then to!');
    $('#numberdays').val(0) ;
  }else{
    var millisBetween = fromDay.getTime() - toDay.getTime();
    var days = millisBetween / (1000 * 3600 * 24);
    $('#numberdays').val(Math.round(Math.abs(days)) + 1) ;
    

  }
     

}else{
  $('#numberdays').val(0) ;
}
}

function mydaysdifferenceEdit($id){
    var fromDay = new Date($('.formDate'+$id).val());
    var mdate=$('.formDate'+$id).val();
//alert(mdate);
    var toDay = new Date($('.toDate'+$id).val());
    var arr = mdate.split('/');
     var arr1 =$('.toDate'+$id).val().split('/');
    $('.maindate'+$id).val(arr[2]+'-'+arr[0]+'-'+arr[1])
    $('.maindateto'+$id).val(arr1[2]+'-'+arr1[0]+'-'+arr1[1])
if(fromDay != "" && toDay != ""){
  if(fromDay > toDay){
    alert('From is greater then to!');
    $('.numberdays'+$id).val(0) ;
  }else{
    var millisBetween = fromDay.getTime() - toDay.getTime();
    var days = millisBetween / (1000 * 3600 * 24);
    $('.numberdays'+$id).val(Math.round(Math.abs(days)) + 1) ;
    

  }
     

}else{
  $('#numberdays'+$id).val(0) ;
}
}

$('#addLeave').on('submit',function(event) {
                event.preventDefault();
                 var fromDay = new Date($('#formDate').val());
    var toDay = new Date($('#toDate').val());
    if(fromDay > toDay){
       alert('From is greater then to!');
    $('#numberdays').val(0) ;
            }else{
              if (fromDay != "Invalid Date" && toDay != "Invalid Date") {

                 loadershow()
                $.ajax({
                    url: baseHref+'add/addLeave_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    }
                    
                });
              }else{
                 alert('Fields cannot be null!');
              }


            }
            });

function changeleavestatus(userid,status,leave_id) {
            //alert(id)
             loadershow();
            $.ajax({
                url: baseHref + 'welcome/leavestatus_request',
                type: 'post',
                data: {
                    userid: userid,
                    status:status,
                    leave_id:leave_id
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      
                    if (json['status']) {
                   // alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    alert(ajaxOption + '\n' + errorThrow);
                      loaderhide();
                }
            });
        }

         $('#updateLeavecount').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/updateLeavecount_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('Leave update successfully!')
                           window.location.reload();
                    }
                });
            
            });
//att punch in punch out
         function markAttendance(date,userid) {
            //alert(id)
             loadershow();
            $.ajax({
                url: baseHref + 'attendance/markattendance_request',
                type: 'post',
                data: {
                    date: date,
                    userid:userid,
                   
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      
                    if (json['status']) {
                    //alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    //alert(ajaxOption + '\n' + errorThrow);
                    window.location.reload();
                      loaderhide();
                }
            });
        }

        $('#calSalary').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/calSalary_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }else{
                           alert(json['msg'])
                          //window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('Holiday update successfully!')
                           window.location.reload();
                    }
                });
            
            });

        $('#addBank').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addBank_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

        $('#addHead').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addHead_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
$('#addsubHead').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addsubHead_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
        $('.updateAtt').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/updateAtt_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

        function printDiv() 
{
  var divToPrint=document.getElementById('DivIdToPrint');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
}

$('#addVendorCustomer').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addVendorCustomer_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
$(document).on('change', '#category', function(){
 //alert('jhdhd')
    var head_id = $('option:selected',this).val();
 var moneyInOut=$('option:selected',this).data('id');
 $('#moneyInOut').val(moneyInOut);
 //alert(moneyInOut);
      $.ajax({
        url: baseHref+'account/getSubhead_request',
        type: 'post',
        data: {head_id:head_id},
       
       // dataType: 'json',
        success: function(response) {
            $("#subHead").empty();
            $("#subHead").append(response);
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
           
        }
    });      
           
    });
$(document).on('change', '.categoryedit', function(){
 //alert('jhdhd')
    var head_id = $('option:selected',this).val();
 var moneyInOut=$('option:selected',this).data('id');
 var mainid=$('option:selected',this).data('mainid');
 var group=$('option:selected',this).data('group');
 $('#moneyInOut'+mainid).val(moneyInOut);
 $('#group'+mainid).val(group);
 //alert(moneyInOut);
      $.ajax({
        url: baseHref+'account/getSubhead_request',
        type: 'post',
        data: {head_id:head_id},
       
       // dataType: 'json',
        success: function(response) {
            $("#subHead"+mainid).empty();
            $("#subHead"+mainid).append(response);
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
           
        }
    });      
           
    });
$(document).on('change', '#subhead_category', function () {
   
    var moneyInOut = $('option:selected', this).data('id');
    var status = $('option:selected', this).data('status');
    $('#moneyInOut').val(moneyInOut);
    $('#status').val(status);
});
$(document).on('change', '.subheadedit_category', function () {
   /* alert($('option:selected', this).data('status'));*/
    var moneyInOut = $('option:selected', this).data('id');
    var status = $('option:selected', this).data('status');
    $(this).next().next().val(moneyInOut);
    $(this).next().next().next().val(status);
});
$('#addJrvendor').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addJrvendor_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            
                         $("#vendorCustomer").prepend('<option selected value="'+json['id']+'">'+json['name']+'</option>');
                            $('#add_vendor').modal('hide');
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
$('#addJrhead').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addJrhead_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                         $("#category").html(json['msg']);
                            $('#add_head').modal('hide');
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$('#addjrsubhead').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addjrsubhead_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                         $("body #category").html(json['msg']);
                         $("#subHead").html(json['sub']);
                         /*$("#category").html(json['msg']);*/
                            $('#add_sub_head').modal('hide');
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
$('#addjournal').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addjournal_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

function GetStaffNameValue(){
   
var user_id = $('#employeesalary').val();
var month=$('#month').val();
var year=$('#year').val();

 $.ajax({
        url: baseHref+'attendance/getSalaryEmployee',
        type: 'post',
        data: {user_id:user_id,month:month,year:year},
        dataType: 'json',
    success: function (response) {

            if(response['status']){
          $('#deductsalary').val(response['deductSalary']);
            $('#netsalary').val(response['netsalary']);
             
            }else{
            alert('Not data found');
            $('#deductsalary').val('0');
            $('#netsalary').val('0');
            }
            },
        error: function(hrx, ajaxOption, errorThrow) {
           alert('Not data found!');
            $('#deductsalary').val('0');
            $('#netsalary').val('0');
           
        }
    });    
 
} 

$('#editBranch').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editBranch_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
$('.editDepartment').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editDepartment_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        window.location.reload();
                        //alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$('.editDesignation').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editDesignation_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        window.location.reload();
                        //alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$('.editHoliday').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editHoliday_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        window.location.reload();
                        //alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$(document).on('change', '.statusofleave', function(){
    var head_id = $('option:selected',this).val();
    if (head_id == 1) {
      var leave=$('#fullleave').val();
    }else if(head_id == 2){
      var leave=$('#halfleave').val();
    }else{
      var leave=$('#shortleave').val();
    }
    
    $('.remaining').val(leave);
 /*var moneyInOut=$('option:selected',this).data('id');
 $('#moneyInOut').val(moneyInOut);*/
 //alert(moneyInOut);
         
           
    });
    /* var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#search" ).autocomplete({
      source: availableTags
    }); */

    $('.editBank').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editBank_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        window.location.reload();
                        //alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

    $('.editHead').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editHead_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        window.location.reload();
                        //alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

    $('.editVendorCustomer').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editVendorCustomer_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        window.location.reload();
                        //alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });
$('.editLeave').on('submit',function(event) {
                event.preventDefault();
   var id = $(this).next().val();
    var fromDay = new Date($('.formDate'+id).val());
    var toDay = new Date($('.toDate'+id).val());
   //alert(toDay);
    if(fromDay > toDay){
       alert('From is greater then to!');
    $('#numberdays').val(0) ;
            }else{
              if (fromDay != "Invalid Date" && toDay != "Invalid Date") {

                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editLeave_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      //alert('update successfully')
                        window.location.reload();
                        //alert(ajaxOption+'\n'+errorThrow);
                    }
                    
                });
              }else{
                 alert('Fields cannot be null!');
              }


            }
            });

$('#changepassword').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                   if ($('input[name=password]').val()==$('input[name=confirmpassword]').val()) {
                $.ajax({
                    url: baseHref+'edit/changepassword_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }else{
                           alert(json['msg'])
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        //window.location.reload();
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            }else{
               loaderhide()
               alert("Password Not Matched", "You clicked the button!", "warning");
                return false;
            }
            });

$('#profile_information').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/profile_information_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        //window.location.reload();
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$('#profile_information1').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/profile_information1_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        //window.location.reload();
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$('#bank_info').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/bank_info_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        //window.location.reload();
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

function exportexel(id,filename,removelastrow=0) {
 //$("#"+id).find('.action').css('');
for (let i = 1; i <= removelastrow; i++) {
  
$("#"+id +' tr').find('th:last-child, td:last-child').remove();
}
   $("#"+id).table2excel({
        
        filename: filename+".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: false,
        
    });
   window.location.reload();
    //$("#"+id).find('.action').css('display','block');
}

function employeestatus(id,status) {
  $.ajax({
        url: baseHref+'welcome/getEmployeestatus',
        type: 'post',
        data: {id:id,status:status},
        dataType: 'json',
    success: function (response) {

            if(response['status']){
              //alert(response['msg']);
              window.location.reload();
            }else{
              alert('Not data found');
            }
            },
        error: function(hrx, ajaxOption, errorThrow) {
           alert('Error');
        }
    });
}
function convertTxtToDate(dateclass) {
    $('.'+dateclass).each(function () {
        if ($(this).hasClass('hasDatepicker')) {
            $(this).removeClass('hasDatepicker');
        }
        $(this).datepicker({
            maxDate: '0',
            dateFormat: 'd M yy',
        });
    });
}
function addjournalentrie() {
    var autosno =$('#autosno').val();
    $('#autosno').val(parseInt(autosno)+parseInt(1));
    var myauto=parseInt(autosno)+parseInt(1);
    var incdate=$('.appendin tr').length;
    var incdate1 = parseInt(incdate)+parseInt(1);
    
    var gethtml=$('body .getappenddata').html();
    //console.log(gethtml);
    $('.appendin').append('<tr>'+gethtml+'</tr>');
    $('body .appendin tr').last().prepend('<td>'+myauto+'</td>');
    $('body .appendin tr').last().children().children().children().find('input').addClass('mydatepickerjournal'+incdate1);
   var dateclass='mydatepickerjournal'+incdate1;
    convertTxtToDate(dateclass)
}

$(document).on('change', '.category', function(event){
  event.preventDefault();
  
  var head_id = $('option:selected',this).val();
  var moneyInOut=$('option:selected',this).data('id');
  var  checkvendor=$('option:selected',this).data('groupstatus');
  $(this).parent().parent().next().children().children().removeClass();
  //$(this).parent().parent().next().next().children().removeClass();
    $(this).parent().parent().next().children().children().addClass('head' + head_id);
    //$(this).parent().parent().next().next().children().addClass('vendor' + head_id);
    //$(this).parent().parent().next().next().children().addClass('form-control');
    $(this).parent().parent().next().children().children().addClass('form-control');
  
 $('#moneyInOut').val(moneyInOut);

      $.ajax({
        url: baseHref+'account/getSubhead_request',
        type: 'post',
        data: {head_id:head_id},
        success: function(response) {
            //console.log(response);
            //$('.head'+head_id).empty();
            //$('.head'+head_id).append(response);
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
        }
    });   

   /* $.ajax({
        url: baseHref + 'account/getvendorcustomer_request',
        type: 'post',
        data: { moneyInOut: moneyInOut },
        success: function (response) {
            console.log(response);
            $('.vendor' + head_id).empty();
            $('.vendor' + head_id).append(response);
        },
        error: function (hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
        }
    });*/

    });

$(document).on('click', '.removeappenddata', function(event){
  event.preventDefault();
 var autosno =$('#autosno').val();
  $('#autosno').val(parseInt(autosno)-parseInt(1));
  $(this).parent().parent().remove()
 
 });
$('#addcontra').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addcontra_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$('.editjournalentry').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editjournal_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

$('#updateCapital').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/updateCapital_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });


 $(document).on('keydown', function ( e ) {
    // You may replace `c` with whatever key you want
   // alert(String.fromCharCode(e.which).toLowerCase());
    if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === 'l') ) {
        window.location.href='ledgerdetail.html'
    }else if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'a') ) {

       //$('.editjournalentry').trigger( "click" );
       $('#journalenter').trigger( "click" );
    }else if ((e.metaKey || e.altKey) && ( e.keyCode === 113) ) {
       $('.datetimepicker').focus();
    }else if (e.keyCode === 113)  {
      var edittr =  $('#trid').val();
      $('#edit_entries'+edittr).modal('show');
    }else if(e.keyCode === 115){
      window.location.href='contra.html'; 
    }else if(e.keyCode === 116){
      $('#add_entries1').modal('show');
    }else if(e.keyCode === 117){
      $('#add_entries1').modal('show');
    }else if(e.keyCode === 118){
      window.location.href='journalEntries.html'
    }else if(e.keyCode === 119){
      $('#add_entries1').modal('show');
    }else if(e.keyCode === 120){
      $('#add_entries1').modal('show');
    }
});

   $('#payrolledit').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/payrolledit_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }else{
                           alert(json['msg'])
                          //window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('Holiday update successfully!')
                           window.location.reload();
                    }
                });
            
            });

   $(document).on('click', '.addeducation', function(event){
    event.preventDefault();
    var gethtml=$('#geteducation').html();
    $('.form-scroll').append(gethtml);
 });
   $(document).on('click', '.removeeducation', function(event){
    event.preventDefault();
   $(this).parent().parent().remove();
 });

   $(document).on('click', '.addExperience', function(event){
    event.preventDefault();
    var gethtml=$('#getExperience').html();
    $('.appendExperience').append(gethtml);
 });
   $(document).on('click', '.removeExperience', function(event){
    event.preventDefault();
   $(this).parent().parent().remove();
 });

   $('#educationInformation').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/educationInformation_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }else{
                           alert(json['msg'])
                          //window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('Holiday update successfully!')
                           window.location.reload();
                    }
                });
            
            });
   $('#experienceInformation').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/experienceInformation_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }else{
                           alert(json['msg'])
                          //window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('Holiday update successfully!')
                           window.location.reload();
                    }
                });
            
            });

   $('#forgotpassword_requset').on('submit',function(event) {
                event.preventDefault();
                //alert('hh');
                 loadershow()
                $.ajax({
                    url: baseHref+'welcome/forgotpassword_requset',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            alert(json['msg'])
                          window.location.reload();
                        }else{
                           alert(json['msg'])
                          //window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        loaderhide()
                           //alert('Holiday update successfully!')
                           window.location.reload();
                    }
                });
            
            });

   //add opening balance
        $('.addopeningBank').on('submit',function(event){
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/addopeningBank_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.href="brancheslist.html";
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

        //add group
        $('#addGroup').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addGroup_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
            });

        //edit group
        $('.editGroup').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editGroup_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });

        $(document).on('change', '.getgroupdata', function(event){
  event.preventDefault();

  var moneyInOut=$('option:selected',this).data('inout');
  var status=$('option:selected',this).data('status');
  var drcr=$('option:selected',this).data('drcr');

   $('#moneyInOut').val(moneyInOut);
   $('#status').val(status);
    if(drcr != 0){
         $('.mydrcr').css('display','block');
        $('#group_status').val(drcr);
    }else{
      $('.mydrcr').css('display','none');
      $('#group_status').val(0);
    }
    });

        $(document).on('change', '.getgroupdataedit', function(event){
  event.preventDefault();
  
 
  var moneyInOut=$('option:selected',this).data('inout');
  var status=$('option:selected',this).data('status');
  var drcr=$('option:selected',this).data('drcr');
 
 
 $(this).next().val(status);
 $(this).next().next().val(moneyInOut);
 //alert(moneyInOut)
      if(drcr != 0){

         $(this).parent().next().css('display','block');
        $(this).next().next().next().val(drcr);
    }else{
      $(this).parent().next().css('display','none');
      $(this).next().next().next().val(0);
    }     
    });


        $('.mymoneyInOut').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'account/getmoneyInOut_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });

        $(document).on('change', '.mymoneyInOut', function(){
 //alert('jhdhd')
    var moneyInOut = $('option:selected',this).val();
    var elm = $(this).parent().parent().next().children().children();
          console.log($(this).parent().parent().next().children().children().html());
 //alert(moneyInOut);
      $.ajax({
        url: baseHref+'account/getmoneyInOut_request',
        type: 'post',
        data: {moneyInOut:moneyInOut},
       
       // dataType: 'json',
        success: function(response) {
          elm.empty();
          elm.append(response);
            /*$(this).parent().parent().next().children().children().empty();
            $(this).parent().parent().next().children().children().append(response);*/
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
        }
    });      
           
    });
        $(document).on('change', '.mymoneyInOutedit', function(){
 //alert('jhdhd')
    var moneyInOut = $('option:selected',this).val();
    var elm = $(this).parent().parent().next().children().children().next();
          console.log($(this).parent().parent().parent().next().children().children().html());
 //alert(moneyInOut);
      $.ajax({
        url: baseHref+'account/getmoneyInOut_request',
        type: 'post',
        data: {moneyInOut:moneyInOut},
       
       // dataType: 'json',
        success: function(response) {
          elm.empty();
          elm.append(response);
            /*$(this).parent().parent().next().children().children().empty();
            $(this).parent().parent().next().children().children().append(response);*/
        },
        error: function(hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
        }
    });      
           
    });

        $(document).on('click', '.addAcademic', function(event){
    event.preventDefault();
   // alert('dhdghd');
    var gethtml=$('.getAcademicDetails').html();
    console.log(gethtml);
    $('.appendAcademic').last().append(gethtml);
 });

$(document).on('click', '.removeAcademic', function(event){
  event.preventDefault();
  $(this).parent().parent().parent().parent().parent().remove();
 });

$('#addcallerdata').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addcalldata_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        
                        window.location.reload();
                    }
                });
            
            });
$('#addcallerdata1').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addcalldatacouns_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });
$(document).on('click', '.addAcademicedit', function(event){
    event.preventDefault();
    var gethtml=$('.getAcademicDetails').html();
    $(this).parent().parent().last().append(gethtml);
 });

$('.editcallerdata').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editcallerdata_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          //window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        //window.location.reload();
                    }
                });
            
            });

function changecallstatus(callid,status) {
            //alert(id)
             loadershow();
            $.ajax({
                url: baseHref + 'caller/callstatus_request',
                type: 'post',
                data: {
                    call_id: callid,
                    status:status,
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      
                    if (json['status']) {
                   // alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    alert(ajaxOption + '\n' + errorThrow);
                      loaderhide();
                }
            });
        }

        $('#addtages').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addtages_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });
        $('.edittages').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/edittages_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });

        $('#addclass').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addclass_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });

        $('#addStream').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addStream_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });
        $('#addboarduniversity').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addboarduniversity_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            
            });

        $('.editboarduniversity').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editboarduniversity_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            });

        $('.editstream').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editstream_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            });
        $('.editclass').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'edit/editclass_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            });

        function markAdmission(callid,status) {
             loadershow();
            $.ajax({
                url: baseHref + 'caller/admissionstatus_request',
                type: 'post',
                data: {
                    call_id: callid,
                    status:status,
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      
                    if (json['status']) {
                   // alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    alert(ajaxOption + '\n' + errorThrow);
                      loaderhide();
                }
            });
        }
        function markCoordinator(callid,status) {
             loadershow();
            $.ajax({
                url: baseHref + 'caller/coordinatorstatus_request',
                type: 'post',
                data: {
                    call_id: callid,
                    status:status,
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      
                    if (json['status']) {
                   // alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    alert(ajaxOption + '\n' + errorThrow);
                      loaderhide();
                }
            });
        }
$(document).on('click', '#addappendadmission', function(event){
    event.preventDefault();

    var gethtml=$('#getadmissiondata').html();
    $('.appendadmission').append(gethtml);
    var incdate=$('.calappenddiv').length;
    var incdate1 = parseInt(incdate)+parseInt(1);
    //alert(incdate1);
    $('.appendadmission').last().find('.mydate').addClass('mydatepickerjournal'+incdate1);
   var dateclass='mydatepickerjournal'+incdate1;
    convertTxtToDate(dateclass)
 });
$(document).on('click', '.removeappendadmission', function(event){
  event.preventDefault();
 
  $(this).parent().parent().parent().remove()
 
 });

$('.addAddmission').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addAddmission_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            alert('Successfully Submitted!')
                          window.location.reload();
                        }else{
                          alert(json['msg'])
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        //window.location.reload();
                    }
                });
            });


function changeCounselor(id,callid) {

   loadershow();
            $.ajax({
                url: baseHref + 'caller/updateCounselor_request',
                type: 'post',
                data: {
                    call_id: callid,
                    counselor:id,
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      
                    if (json['status']) {
                        //alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    alert(ajaxOption + '\n' + errorThrow);
                      loaderhide();
                }
            });
}
function changeAdmission(id,callid) {

   loadershow();
            $.ajax({
                url: baseHref + 'caller/updateAdmission_request',
                type: 'post',
                data: {
                    call_id: callid,
                    admission:id,
                },
                
                dataType: 'json',
                success: function(json) {
                      loaderhide();
                      
                    if (json['status']) {
                        //alert(json['msg']);
                        window.location.reload();
                    }
                },
                error: function(hrx, ajaxOption, errorThrow) {
                    alert(ajaxOption + '\n' + errorThrow);
                      loaderhide();
                }
            });
}
function selectenglishtest(test) {
   
  $('#scoreOverall').children().remove();
  $('.hidethis').css('display','block')
  $('.hidethispte').css('display','none')
   $('.hidethisduolingo').css('display','none')
  if(test == 'IELTS'){
    //alert('dhdh');
$('#scoreOverall').prepend('<select required="true" class="form-control" name="score" ><option value="">Select Score</option><option value="5" >5</option><option value="5.5" >5.5</option><option value="6" >6</option><option value="6.5" >6.5</option><option value="7" >7</option><option value="7.5" >7.5</option><option value="8" >8</option><option value="8.5" >8.5</option><option value="9" >9</option></select>')
  }else if(test == 'PTE'){
$('#scoreOverall').prepend('<select required="true" class="form-control" name="score" ><option value="">Select Score</option><option value="43-50" >43-50</option><option value="50-58" >50-58</option><option value="58-65" >58-65</option><option value="65-73" >65-73</option><option value="73-79" >73-79</option><option value="79-83" >79-83</option></select>')
   $('.hidethispte').css('display','block');
      
  }else if(test == 'Duolingo'){
      $('.hidethisduolingo').css('display','block')
$('#scoreOverall').prepend('<select required="true" class="form-control" name="score" ><option value="">Select Score</option><option value="90" >90</option><option value="95" >95</option><option value="100" >100</option><option value="110" >110</option><option value="115" >115</option><option value="120" >120</option><option value="125" >125</option><option value="130" >130</option><option value="135" >135</option><option value="140" >140</option></select>')
  }else if(test == 'Toefl'){
    $('#scoreOverall').prepend('<input required="true" type="text" class="form-control" name="score" />')
  }else if(test == 'No'){
      $('.hidethis').css('display','none');
  }else if(test == 'Pursuing'){
      $('.hidethis').css('display','none');
  }
  
     
}


$(document).on('click', '.checkreferral', function(event){
  //event.preventDefault();

 if ($(this).val() == '1') {
  //alert('hi');
$('.previouscountry').css('display','block')
 }else{
  //alert('helo');
$('.previouscountry').css('display','none')
 }
  
 
 });

$(document).on('click', '.addremark', function(event){
  //event.preventDefault();
  $('body .appendRemark').prepend('<input class="form-control" placeholder="Add Remark" type="text" name="remark[]" required="" /><br>')

 });

$(document).on('click', '.checktravelhistory', function(event){
  //event.preventDefault();

 if ($(this).val() == 'Yes') {
  //alert('hi');
$('.travelhistory').css('display','block')
 }else{
  //alert('helo');
$('.travelhistory').css('display','none')
 }
  
 
 });

$('.addRemark').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addRemark_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                          window.location.reload();
                        }else{
                          alert(json['msg'])
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        window.location.reload();
                    }
                });
            });

$(document).on('click', '.packageConsultancy', function(event){
  //event.preventDefault();
$('.consultancyhide').css('display','none');
$('.packagehide').css('display','none');
 if ($(this).val() == 'Package') {
  
$('.packagehide').css('display','block');
 }else if($(this).val() == 'Consultancy'){
  
$('.consultancyhide').css('display','block');
 }
  
 
 });
 $(document).on('change', '.account_open', function(event){
  //event.preventDefault();
 //console.log($(this).prev().parent().parent().parent().next().html()); 
$(this).prev().parent().parent().parent().next().css('display','none');

 if ($(this).val() == 'Yes') {
  
$(this).prev().parent().parent().parent().next().css('display','block');
 }else if($(this).val() == 'No'){
  
$(this).prev().parent().parent().parent().next().css('display','none');
 }
  
 
 });
  $(document).on('change', '.affidavite_received', function(event){
  //event.preventDefault();
  
$(this).prev().parent().parent().parent().next().css('display','none');

 if ($(this).val() == 'Yes') {
  
$(this).prev().parent().parent().parent().next().css('display','block');
 }else if($(this).val() == 'No'){
  
$(this).prev().parent().parent().parent().next().css('display','none');
 }
  
 
 });
 
 $('#forgetchangepassword').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                   if ($('input[name=password]').val()==$('input[name=confirmpassword]').val()) {
                $.ajax({
                    url: baseHref+'edit/forgetchangepassword_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            alert(json['msg'])
                          window.location.href=baseHref;
                        }else{
                           alert(json['msg'])
                        }
                        
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                      loaderhide()
                      
                        //window.location.reload();
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            }else{
               loaderhide()
               alert("Password Not Matched", "You clicked the button!", "warning");
                return false;
            }
            });
 $("#changetype").change(function() {
     
 var id=$(this).val();
  location.href='/followup.html?type='+id;
});
function showpassword() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} 
 $("#gotodetailledger").click(function() {
     
 var id=$('#getledgerid').val();
 //alert(id);
  location.href='/newleadgerdetail.html/'+id;;
});


$('.callerPayment').on('submit',function(event) {
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/callerPaymentdata_request',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          //window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        //window.location.reload();
                    }
                });
            
            });
            
  $('#addskiiledform').on('submit',function(event) {
  
                event.preventDefault();
                 loadershow()
                $.ajax({
                    url: baseHref+'add/addskiiledformrequest',
                    type: 'post',
                     data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(json) {
                         loaderhide()
                        if (json['status']) {
                            //alert(json['msg'])
                          window.location.reload();
                        }
                    },
                    error:function(hrx, ajaxOption, errorThrow) {
                        alert(ajaxOption+'\n'+errorThrow);
                    }
                });
            
});   



/*$(".skillcat").on('click', function(event){
  //  alert('22');
   //$('#addtags').modal('hide'); 
   
  // $('#addtags').('hide');
   $('#addtags').hide();
    $(".modal-backdrop").remove();
});*/



/*$(".skillcat").on('click', function(event){

 /*   $("#skillcat_id").val('1')'; */
  /*  $('#add_head').modal('show'); 
    
   // $('#addtags').hide();
    $(".modal-backdrop").remove();
});
     */
     
     
     
     function divFunction(status){
         
       //  alert('122');
          $("#skillcat_id").val(status);
         $('#add_head').modal('show');
         // $('#addtags').hide();
        //   $(".modal-backdrop").remove();
         
     }
     
    function AddImagesbutton(){
    var imagesinfo=$('#getimageinfo').html();
    
    $("#test").append(imagesinfo);
    }
    
    $(document).on('click', '#removebutton', function(){ 
    //$("#productimglabel").remove();
    //$("#productimg").remove();
    //$("#test div:last").remove();
    $('#test > .form-group').slice(-1).remove();
    
    //$(this).remove()
    });
    
    
    function deleteProductImages(prodid,ImgId,title) {

	if (confirm('Are you sure ?')) {
		$.ajax({
		 url: baseHref+'add/deleteProductImagesRequest',
			type: 'post',
			data: {prodid:prodid,ImgId:ImgId,title:title},
			  dataType: 'json',
            success: function(json) {
              if (json['status']) {
              alert(json['msg'], "You clicked the button!", "success");
                location.reload();
              } else {
                alert(json['msg']);
              }
            },
            error: function(hrx, ajaxOption, errorThrow) {
                alert(ajaxOption + '\n' + errorThrow);
            }

		});
	}
}
     
     
     
     
     
            