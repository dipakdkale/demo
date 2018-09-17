<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.take_away.php");
$take_away_obj=new TakeAway();
$homepage = new HomePage();
extract($_REQUEST);
$notify = new Notification();
extract($_POST);
$homepage->auth->CheckAdminlogin();
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="WRIGLECS">

        <link rel="shortcut icon" href="img/favicon_1.ico">

        <title>Admin Dashboard</title>

        <!-- Google-Fonts -->
        
        <!-- Bootstrap core CSS -->
         <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>


        <!-- Bootstrap core CSS -->
       <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />

        <!-- Plugins css -->
        <link href="assets/modal-effect/css/component.css" rel="stylesheet">
		<link href="assets/notifications/notification.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
         <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </head>


    <body>
		<?php $notify->Notify();?>
        <!-- Aside Start-->
        <?php $homepage->leftSidebar('home');?>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <?php $homepage->pageHeader();?>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title"> 
                     <strong>Customer Name:</strong> <?php echo $homepage->getSoftwareDetail(TBL_CUSTOMER,$cus_id,'customer_name');?><br />
					<strong>Email:</strong> <?php echo $homepage->getSoftwareDetail(TBL_CUSTOMER,$cus_id,'email');?><br />
					<strong>Phone:</strong> <?php echo $homepage->getSoftwareDetail(TBL_CUSTOMER,$cus_id,'phone');?><br />
                </div>
                 <a href="all-customer.php?type=take_away" class="btn btn-purple btn-rounded m-b-5 pull-right" style="margin-top:-60px;"> <i class="fa fa-arrow-left" aria-hidden="true"></i> All Customer</a>
			<div class="row"> 
            <?php $take_away_obj->orderList('take_away',$bill_id,$cus_id);?>
                    <?php $take_away_obj->menuItemList();?> 
                     <div class="col-md-12"><h4>New KOTs</h4></div>
                    <div class="col-md-12" id="div_kot">
                    <?php $take_away_obj->newKots($cus_id);?>
                    </div> 
                    <div class="col-md-12"><h4>Old KOTs</h4></div>
                    <div class="col-md-12" id="div_kot_old">
                    <?php $take_away_obj->oldKots($cus_id);?>
                    </div> 
                     
                </div>
            </div>
            
            <!-- Page Content Ends -->
            <!-- ================== -->
    
            <!-- Footer Start -->
            <footer class="footer">
                2018 © Wriglecs.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
 <div id="receiptModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receipt</h4>
        
      </div>
      <div class="modal-body" id="div_print">
    	<?php $take_away_obj->generateReceipt($cus_id);?>
      </div>
      <div class="modal-footer">
      <button class="btn btn-icon btn-purple m-b-5 btnPrint" type="button" id="btnPrint">Print <i class="fa fa-print"></i> </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>       


    <!-- js placed at the end of the document so the pages load faster -->
   
    <script src="js/pace.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    
    <!-- Modal-Effect -->
    <script src="assets/modal-effect/js/classie.js"></script>
    <script src="assets/modal-effect/js/modalEffects.js"></script>
    <script src="assets/notifications/notify.min.js"></script>
    <script src="assets/notifications/notify-metro.js"></script>
    <script src="assets/notifications/notifications.js"></script>
    
    <script src="js/jquery.app.js"></script>    
<?php  $homepage->deletePage(TBL_TAKE_AWAY_ITEM_TEMP);?>
<script>
$(document).on('click','.btn_category',function() {
$('#div_sub_cat').show();												
var cat_id=$(this).val();
var info ='cat_id='+cat_id;
$.ajax({
	   type:"post",
	   url:"getdata.php?index=get_sub_category_for_pos",
	   data:info,
	   success:function(response){
		   $('#panel_subcategory').html(response);
	   }
	   });
});

$(document).on('click','.btn_sub_cat',function() {
$('#div_sub_cat').show();												
var sub_id=$(this).val();
var info ='sub_id='+sub_id;
$.ajax({
	   type:"post",
	   url:"getdata.php?index=get_product_grid",
	   data:info,
	   success:function(response){
		   $('#product_grid').html(response);
	   }
	   });
});
</script>

<script>
$(document).on('click','.span_product',
function() {
var rowCount = $('#tbl_body_pro_list tr').length+1;
var id=$(this).attr('id');

var cus_id=<?php echo $cus_id;?>

var info = 'pro_id=' + id;
	$.ajax({
	type: "POST",
	url: "getdata.php?index=get_product_data2",
	data: {'pro_id':id,'tr_count':rowCount,'cus_id':cus_id},
	success: function(response){
		if(response=='error'){
			alert("Item is already in order..!");
		}
		else
		{
		$('#tbl_body_pro_list').append(response);
		location.reload();
	var total_amt=0;	
	var total_qty=0;
	var i;
	for(i=1;i<= rowCount;i++)
	{
		var tmp=$('#td_amt'+i).val();
		total_amt +=parseInt(tmp);
		var tmpqty=$('#td_qty'+i).val();
		total_qty+=parseInt(tmpqty);
	}
	$('#span_total_amt').html(total_amt);
	$('#total_amount').val(total_amt);
	$("#span_total_quantity").html(total_qty);
	$("#total_quantity").val(total_qty);
		}
	}
	});	

});
$(document).on('click','#btn_select_mode',function() {
$('#div_payment_mode').show();
});
$(document).on('change','#mode_of_payment',function() {
var mode=$(this).val();							 
if(mode=='cash'){
$('#div_for_cash').show();	
}
else
{
	$('#div_for_cash').hide();
}
if(mode=='card'){
$('#div_for_card').show();	
}
else
{
	$('#div_for_card').hide();
}
if(mode=='wallet'){
$('#div_for_wallet').show();	
}
else
{
	$('#div_for_wallet').hide();
}
$(document).on('focusout','#input_cash',function() {
$('#div_return').show();												 
var given_amt=$(this).val();
var amt=$('#span_total_amt').html();

var return_amt=given_amt-amt;
$('#return_to_customer').html(return_amt);
$('#hidden_cash_return').val(return_amt);
});
});

$(document).on('click','#modal_open',function() {
											 
$('#mode_of_payment').focus();
});
</script>

<?php
if($bill_id!='')
$homepage->modalForReceipt($bill_id);
?>
<script type="text/javascript">
$(document).on('click','.btnPrint',function() {

        var contents = $("#div_print").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Receipt</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
    //frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    
});
</script>
<script>
$(document).on('click','#generate_kot',function() {
var cus_id=<?php echo $cus_id;?>;
var info ='cus_id='+cus_id;
											
	$.ajax({
	type:"post",
	url:"getdata.php?index=get_product_kot_for_take_away",
	data:info,
	success:function(response){
	  location.reload();
	}
	});
});
</script>
<script>
$(document).on('click','.btn_change_print_status',function() {
var id=$(this).attr('data-id');

var cus_id=<?php echo $cus_id;?>;
			
	$.ajax({
	type:"post",
	url:"getdata.php?index=change_kot_status",
	data:{'cus_id':cus_id,'id':id},
	success:function(response){
	  location.reload();
	}
	});

});

<?php
if($bill_id!='')
$homepage->modalForReceipt($bill_id);
?>
<script type="text/javascript">
$(document).on('click','.btnPrint',function() {


var printer = null;
var ePosDev = null;

function InitMyPrinter() {
    console.log("Init Printer");

    var printerPort = 8008;
    var printerAddress = "192.168.198.168";
    if (isSSL) {
        printerPort = 8043;
    }
    ePosDev = new epson.ePOSDevice();
    ePosDev.connect(printerAddress, printerPort, cbConnect);
}

//Printing
function cbConnect(data) {
    if (data == 'OK' || data == 'SSL_CONNECT_OK') {
        ePosDev.createDevice('local_printer', ePosDev.DEVICE_TYPE_PRINTER,
            {'crypto': false, 'buffer': false}, cbCreateDevice_printer);
    } else {
        console.log(data);
    }
}

function cbCreateDevice_printer(devobj, retcode) {
    if (retcode == 'OK') {
        printer = devobj;
        printer.timeout = 60000;
        printer.onreceive = function (res) { //alert(res.success);
            console.log("Printer Object Created");

        };
        printer.oncoveropen = function () { //alert('coveropen');
            console.log("Printer Cover Open");

        };
    } else {
        console.log(retcode);
        isRegPrintConnected = false;
    }
}

function print(salePrintObj) {
    debugger;
    if (isRegPrintConnected == false
        || printer == null) {
        return;
    }
    console.log("Printing Started");


    printer.addLayout(printer.LAYOUT_RECEIPT, 800, 0, 0, 0, 35, 0);
    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addTextSmooth(true);
    printer.addText('\n');
    printer.addText('\n');

    printer.addTextDouble(true, true);
    printer.addText(CompanyName + '\n');

    printer.addTextDouble(false, false);
    printer.addText(CompanyHeader + '\n');
    printer.addText('\n');

    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText('DATE: ' + currentDate + '\t\t');

    printer.addTextAlign(printer.ALIGN_RIGHT);
    printer.addText('TIME: ' + currentTime + '\n');

    printer.addTextAlign(printer.ALIGN_LEFT);

    printer.addTextAlign(printer.ALIGN_RIGHT);
    printer.addText('REGISTER: ' + RegisterName + '\n');
    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText('SALE # ' + SaleNumber + '\n');

    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addTextStyle(false, false, true, printer.COLOR_1);
    printer.addTextStyle(false, false, false, printer.COLOR_1);
    printer.addTextDouble(false, true);
    printer.addText('* SALE RECEIPT *\n');
    printer.addTextDouble(false, false);
....
....
....

}

</script>
</body>
</html>
