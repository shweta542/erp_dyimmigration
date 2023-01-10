$(document).ready(function() {
    var nietos = [];
    $.ajax({
        url: baseHref + 'welcome/barchart',
        type: 'post',
        
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (json) {
            //console.log(json['data'])
            json['data'].forEach(element => {
               
                nietos.push({ 'y': element.month, 'a': element.moneyin, 'b': element.moneyout});

            });
         //   console.log(nietos);
            Morris.Bar({
                element: 'bar-charts',
                data: nietos,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Money In', 'Money Out'],
                lineColors: ['#ff9b44', '#fc6075'],
                lineWidth: '3px',
                barColors: ['#ff9b44', '#fc6075'],
                resize: true,
                redraw: true
            });
        },
        error: function (hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
        }
    });
    Morris.Line({
        element: 'line-charts',
        data: [{
            y: '2006',
            a: 500,
            b: 900
        }, {
            y: '2007',
            a: 750,
            b: 650
        }, {
            y: '2008',
            a: 500,
            b: 400
        }, {
            y: '2009',
            a: 750,
            b: 650
        }, {
            y: '2010',
            a: 500,
            b: 400
        }, {
            y: '2011',
            a: 750,
            b: 650
        }, {
            y: '2012',
            a: 1000,
            b: 500
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Profit', 'loss'],
        lineColors: ['#ff9b44', '#fc6075'],
        lineWidth: '3px',
        resize: true,
        redraw: true
    });
});


  $(document).ready(function () {
            showstudentGraph();
        });


         function showstudentGraph(){
        $.ajax({
                url: baseHref+'Welcome/studentbarchart',
                type: 'post',
             //   data:{prid:prid},
                dataType: "json",
                async: false,
                success:function(jsonData){
                   // console.log(jsonData);
                    var month = [];
                    var Totalcount = [];
                  
                  // for(var i in jsonData) {
                        jsonData['data'].forEach(element => {
                     
                      
                      // console.log('ddd',element.month);
                        //alert(jsonData[i].employeename+jsonData[i].totalleave);
                       month.push(element.month);
                        Totalcount.push(element.Totalcount);
                       
                  //}
                        })
                    
               
               
                   
                    var chartdata = {
                        labels: month,
                        datasets: [
                            {
                                label: 'Student Enrolment graph',
                                backgroundColor: '#3366cc',
                                borderColor: '#3366cc',
                                hoverBackgroundColor: '#3366cc',
                                hoverBorderColor: '#3366cc',
                                data: Totalcount
                            }
                        ]
                    };

                    var graphTarget = $("#graphleaveCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                },
                error:function(jsonData) {
                    console.log(jsonData);
                }

        });
    
        }