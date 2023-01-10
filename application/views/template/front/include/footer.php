 <!--trans-->
    <div class="transparacy" style="display:none">
      <div class="loader" title="0">
      <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       width="100px" height="100px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
      <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
        s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
        c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
      <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
        C22.32,8.481,24.301,9.057,26.013,10.047z">
        <animateTransform attributeType="xml"
          attributeName="transform"
          type="rotate"
          from="0 20 20"
          to="360 20 20"
          dur="0.5s"
          repeatCount="indefinite"/>
        </path>
      </svg>
    </div>
  </div>
    <!--trans-->
</div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/morris/morris.min.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
 <script src="assets/plugins/raphael/raphael.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="assets/js/app.js"></script> 
 <script type="text/javascript" src="assets/js/jspdf.js"></script>
<script type="text/javascript" src="assets/js/html2canvas.js"></script>
<script src="assets/js/table2exel.js">
</script>

<script src="assets/js/main.js"></script>
 
<script>
if (/Mobi/.test(navigator.userAgent)) {
  // if mobile device, use native pickers
  $(".time input").attr("type", "time");
} else {
  // if desktop device, use DateTimePicker
  
  $(".timepicker").datetimepicker({
    format: "LT",
    icons: {
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down"
    }
  
  });
}
</script>


<script>
  $("#addbutton").click(function(){
  var html = $('#myboxes').html();
  $('#boxes').last().append(html);
}); 
</script>
<script>
  let addbutton1 = document.getElementById("addbutton1");
  addbutton1.addEventListener("click", function() {
    let boxes1 = document.getElementById("boxes1");
    let clone = boxes1.firstElementChild.cloneNode(true);
    boxes1.appendChild(clone);
  });
</script>
<script src="assets/js/canvasjs.js"></script>
<script>
window.onload = function() {
  var marr=[];
$.ajax({
        url: baseHref + 'welcome/piechart',
        type: 'post',
        
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (json) {
            //console.log(json['data'])
            json['data'].forEach(element => {
               
                marr.push({ 'y': element.y, 'label': element.label});

            });
            var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: ""
  },
  data: [{
    type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"\"",
    indexLabel: "{label} {y}",
    dataPoints: marr
  }]
});
chart.render();
        },
        error: function (hrx, ajaxOption, errorThrow) {
            alert(ajaxOption + '\n' + errorThrow);
        }
    });


}
//Create PDf from HTML...
function CreatePDFfromHTML(myclass,name) {
    var HTML_Width = $("."+myclass).width();
    var HTML_Height = $("."+myclass).height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("."+myclass)[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save(name+".pdf");
        //$(".card").hide();
    });
}
</script>
<?php if(isset($sidepage) && $sidepage == 'journalEntries' || $sidepage == 'balancesheetheadDetail' || $sidepage ==  'profitlossdetail' || $sidepage == 'headdetail'){ 
?>
<script type="text/javascript">

   $(document).ready(function() {
       //alert('f');
    $("tr[tabindex=1]").focus();  
    var Idtr= $("tr[tabindex=1]").data('trid');  
    $('#trid').val(Idtr);
    document.onkeydown = checkKey;
});

function checkKey(e) {
  var l=$('.testtable tr').length;
  //alert(l)
    var event = window.event ? window.event : e;
    if(event.keyCode == 40){ //down
      var idx = $("tr:focus").attr("tabindex");
      idx++;
      if(idx >= l){
        idx = 0;
      }
      $("tr[tabindex="+idx+"]").focus();
    var Idtr= $("tr[tabindex="+idx+"]").data('trid');
    $('#trid').val(Idtr);
    console.log(Idtr);
    }
    if(event.keyCode == 38){ //up
      var idx = $("tr:focus").attr("tabindex");
      idx--;
      if(idx <= 0){
        idx = l;
      }
      $("tr[tabindex="+idx+"]").focus(); 
       var Idtr= $("tr[tabindex="+idx+"]").data('trid');
        $('#trid').val(Idtr);
       console.log(Idtr);     
    }
  }
  function mycheckKey(id) {
    
    $('#trid').val(id);
  }
</script>
<?php
} ?>
</body>
</html>