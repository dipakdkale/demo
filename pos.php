<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
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
	<meta name="author" content="DIPOS-Digital Inventory Pos & Other Services">

	<link rel="shortcut icon" href="img/favicon_1.ico">
	<title>POS-billing</title>
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
		<span class="badge bg-info" style="font-size:24px !important;"><?php echo $homepage->getSoftwareDetail(TBL_MASTER_TABLE,$tbl_id,'name');?></span>
		<a href="pos_table.php"  class="btn btn-purple btn-rounded m-b-5 pull-right" style="margin-top:0;"> <i class="fa fa-arrow-left" aria-hidden="true"></i> All Tables</a>

		</div> 
			<div class="row">  
				<?php $homepage->orderList($tbl_id,$bill_id);?>
				<?php $homepage->menuItemList();?> 
				<div class="col-md-10"><h4>New KOTs Not Printed</h4></div>
				<div class="col-md-8" id="div_kot">
				<?php $homepage->newKots($tbl_id);?>
			</div> 
				<div class="col-md-8"><h4>Printed KOTs</h4></div>
				<div class="col-md-8" id="div_kot_old">
				<?php $homepage->oldKots($tbl_id);?>
			</div> 
			</div>
		</div>

		<!-- Page Content Ends -->
		<!-- ================== -->

		<!-- Footer Start -->
		<footer class="footer">
		2018 © DIPOS-Digital Inventory Pos & Other Services
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
				<div id="printDiv">
				<div class="modal-body" id="div_print">
				<?php $homepage->generateReceipt($tbl_id);?>
				</div>
				</div>
				<div class="modal-footer">
				<button class="btn btn-icon btn-purple m-b-5 btnPrint" type="button" id="btnPrint2">Print <i class="fa fa-print"></i> </button>
				
				<button class="btn btn-icon btn-pink m-b-5  pull-right" style="margin-top:-5px;  margin-left:25px;" type="button" id="delete_temp_record" data-id="20">Settle This Bill <i class="fa fa-times"></i> </button>

				</div>
			</div>
		</div>
	</div>       
 <!-- js placed at the end of the document so the pages load faster -->

	<script src="js/pace.min.js"></script>
	<script src="js/wow.min.js"></script>
	<src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
	<script src="assets/tagsinput/jquery.tagsinput.min.js"></script>
	<script src="assets/toggles/toggles.min.js"></script>
`	<script src="assets/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="assets/timepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/colorpicker/bootstrap-colorpicker.js"></script>
	<script type="text/javascript" src="assets/jquery-multi-select/jquery.multi-select.js"></script>
	<script type="text/javascript" src="assets/jquery-multi-select/jquery.quicksearch.js"></script>
	<script src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="assets/spinner/spinner.min.js"></script>
	<script src="assets/select2/select2.min.js" type="text/javascript"></script>
	<script src="assets/notifications/notify.min.js"></script>
	<script src="assets/notifications/notify-metro.js"></script>
	<script src="assets/notifications/notifications.js"></script>
	<script src="js/jquery.app.js"></script> 
	<script>

		jQuery('.datepicker').datepicker();
		jQuery('#datepicker-inline').datepicker();
		jQuery('#datepicker-multiple').datepicker({
			numberOfMonths: 3,
			showButtonPanel: true
		});
		jQuery('#timepicker').timepicker({defaultTIme: false});
		jQuery('#timepicker2').timepicker({showMeridian: false});
		jQuery('#timepicker3').timepicker({minuteStep: 15});
	</script>
	<?php  $homepage->deletePage(TBL_POS_ITEM_TEMP);?>
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

		$(document).on('click','#increase_date',function() {
			var branch_id=<?php echo $_SESSION['branch_id'];?>;		
			var newDate=<?php echo $homepage->getSoftwareDate();?>;
// alert(newDate);
if(confirm("Do You want to close the day and change the date  ?"))
{
	$.ajax({
		type: "POST",
		url: "getdata.php?index=increase_date",
		data: {'branch_id':branch_id},
		success: function(response){
			location.reload();
		}
	});
}
});
		$(document).on('click','#change_date',function() {
			var branch_id=<?php echo $_SESSION['branch_id'];?>;	
			var cng_date=$('#input_change_date').val();
			var branch_tax1=$('#branch_tax1').val();
			var branch_tax2=$('#branch_tax2').val();

			if(confirm("Do You want to close the day and change the date to "+cng_date +" ?"))
			{
				$.ajax({
					type: "POST",
					url: "getdata.php?index=increase_date_by_admin",
					data: {'branch_id':branch_id,'cng_date':cng_date,'branch_tax1':branch_tax1,'branch_tax2':branch_tax2},
					success: function(response){
						location.reload();
					}
				});
			}

		});
	</script>

	<script>
		$(document).on('click','.span_product',
			function() {
				var rowCount = $('#tbl_body_pro_list tr').length+1;
				var id=$(this).attr('id');
				var cat_id=$(this).attr('data-id');


				var tbl_id=<?php echo $tbl_id;?>;
				var info = 'pro_id=' + id;
				$.ajax({
					type: "POST",
					url: "getdata.php?index=get_product_data",
					data: {'pro_id':id,'tr_count':rowCount,'tbl_id':tbl_id,'cat_id':cat_id},
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
				var amt=$('#grand_total').val();

				var return_amt=given_amt-amt;
				$('#return_to_customer').html(return_amt.toFixed(2));
				$('#hidden_cash_return').val(return_amt.toFixed(2));
			});
		});

		$(document).on('click','#modal_open',function() {

			$('#mode_of_payment').focus();
		});
	</script>

	<?php
	if($bill_id='')
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
        	window.location="pos_table.php?index=order_done&tbl_id=<?php echo $tbl_id;?>";
        }, 500);

    }); 
</script>-->
<script type="text/javascript">
		$(document).on('click','.btnPrint2',function() {
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
        	window.location="pos_table.php?index=order_done&tbl_id=<?php echo $tbl_id;?>";
			frame1.remove();
       }, 500);

    });
</script>

<script>
	$(document).on('click','#generate_kot','#btnprint4', function() {
		var tbl_id=<?php echo $tbl_id;?>;
		var info ='table_id='+tbl_id;

		$.ajax({
			type:"post",
			url:"getdata.php?index=get_product_kot_for_pos",
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

		var tbl_id=<?php echo $tbl_id;?>;

		$.ajax({
			type:"post",
			url:"getdata.php?index=change_kot_status",
			data:{'table_id':tbl_id,'id':id},
			success:function(response){
				location.reload();
			}
		});

	});
	$(document).on('change','.select_tax',function() {
		grandTotal();

	});
	function grandTotal()
	{
		if($('#tax_type1').val()==0)
		{
			var percentage1=0;
		}
		else{
			var percentage1=$('#tax_type1').find(':selected').attr('data-id');
			var per1=percentage1/100;
			$('#tax1').val(parseFloat(per1));
		}

		if($('#tax_type2').val()==0)
		{
			var percentage2=0;
		}
		else{
			var percentage2=$('#tax_type2').find(':selected').attr('data-id');

		}


		if(!$.isNumeric(total_tax))
		{
			total_tax=0;
		}
		var total_amt=$('#total_amount').val();
		var per1=total_amt*percentage1/100;
		$('#tax1').val(parseFloat(per1));
		var per2=total_amt*percentage2/100;
		$('#tax2').val(parseFloat(per2));
		var total_tax=parseFloat(per1)-parseFloat(per2);
		$('#grand_total').val(parseFloat(total_tax)+parseFloat(total_amt));	

	}
	$(document).on('click','#btn_cancel_order',function() {
		var tbl_id=<?php echo $tbl_id;?>;
		$.ajax({
			type:"post",
			url:"getdata.php?index=cancel_order",
			data:{'table_id':tbl_id},
			success:function(response){
				window.location="pos_table.php";
			}
		});
	});

	$(document).on('change','.td_perior',function() {
		var id=$(this).attr('data-id');									 
		var perior=$(this).val();
		$.ajax({
			type:"post",
			url:"getdata.php?index=set_periority",
			data:{'id':id,'perior':perior},
			success:function(response){

			}
		});
	});
	$(document).on('change','.comment',function() {
		var id=$(this).attr('data-id');									 
		var perior=$(this).val();
		$.ajax({
			type:"post",
			url:"getdata.php?index=comment",
			data:{'id':id,'perior':comment},
			success:function(response){

			}
		});
	});
	$(document).on('click','.btn_plus',function() {
		var present_quantity =  $(this).closest('tr').find('.td_qty').val();
		var unit_price =  $(this).closest('tr').find('.tb_amt').val();
		var tax_slab =  $(this).closest('tr').find('.tax_slab').val();
		var quantity=parseInt(present_quantity)+parseInt(1);
		var price=unit_price*quantity;
		var total_tax_slab_amt=quantity*tax_slab;
		//alert(total_tax_slab_amt);
		var id=$(this).attr('data-id');
		//alert(id);
		$.ajax({
		type:"post",
		url:"getdata.php?index=update_quantity",
		data:{'id':id,'quantity':quantity,'price':price,'total_tax_slab_amt':total_tax_slab_amt},
		success:function(response){
		location.reload();
	}
});

});
	$(document).on('click','.btn_minus',function() {
		var present_quantity =  $(this).closest('tr').find('.td_qty').val();
		var unit_price =  $(this).closest('tr').find('.tb_amt').val();
		var quantity=parseInt(present_quantity)-parseInt(1);
		var price=unit_price*quantity;
		var id=$(this).attr('data-id');
//alert(id);
		$.ajax({
		type:"post",
		url:"getdata.php?index=update_quantity",
		data:{'id':id,'quantity':quantity,'price':price},
		success:function(response){
			location.reload();
		}
});

});
	$(document).on('click','#confirm_payment',function() {
		var table_id=<?php echo $tbl_id;?>;

		$.ajax({
			type:"post",
			url:"getdata.php?index=delete_kot_record",
			data:{'table_id':table_id},
			success:function(response){
			window.location="pos_table.php";
			}
		});

	});
	$(document).on('click','#delete_temp_record',function() {
		var table_id=$(this).attr('data-id');

		$.ajax({
			type:"post",
			url:"getdata.php?index=delete_temp_record",
			data:{'table_id':table_id},
			success:function(response){
			window.location="pos_table.php";
			}
		});
	});
</script>
<script>
	$(document).on('change','#tax_type1',function() {
		var tax_id=$(this).val();
		$.ajax({
			type:"post",
			url:"getdata.php?index=change_tax_percentage1",
			data:{'tax_id':tax_id},
			success:function(response){
				location.reload();
			}
		});
	});
	$(document).on('change','#tax_type2',function() {
		var tax_id=$(this).val();
		$.ajax({
			type:"post",
			url:"getdata.php?index=change_tax_percentage2",
			data:{'tax_id':tax_id},
			success:function(response){
				location.reload();
			}
		});
	});

 $(function()
 { 
 	$("#btnPrint").click(function()
 	 {
 		var printContents = document.getElementById("div_print").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print(); 
		document.body.innerHTML = originalContents;
		location.reload(true);
 	});
 	$("#btnPrint2").click(function()
 	 {
 		var printContents = document.getElementById("div_print").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print(); 
		document.body.innerHTML = originalContents;
		location.reload(true);
		//$('#receiptModel').modal('hide')
		//$('#receiptModel').modal('hide');
 	});
 	$("#btnPrint3").click(function()
 	 {
 		var printContents = document.getElementById("div_print").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print(); 
		document.body.innerHTML = originalContents;
		location.reload(true);
 	});
 	$("#btnPrint4").click(function()
 	 {
 		var printContents = document.getElementById("div_print").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print(); 
		document.body.innerHTML = originalContents;
		location.reload(true);
		$('#kotModel').modal('hide');
 	});
 	 	$("#btnPrint5").click(function()
 	 {
 		var printContents = document.getElementById("div_print").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print(); 
		document.body.innerHTML = originalContents;
		location.reload(true);
		//$('#kotModel').modal('hide')
		//$('#kotModel').modal('hide');
 	});
 	$("#btnPrint6").click(function()
 	 {
 		var printContents = document.getElementById("div_print").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print(); 
		document.body.innerHTML = originalContents;
		location.reload(true);
 	});

 	
 });
 <?php
	if($tbl_id!='')
		$homepage->modalForKOT($tbl_id);
	?>
	<script type="text/javascript">
		$(document).on('click','.btnPrint4',function() {

		var contents = $("#div_print").html();
		var frame1 = $('<iframe />');
		frame1[0].name = "frame1";
		frame1.css({ "position": "absolute", "top": "-1000000px" });
		$("body").append(frame1);
		var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
		frameDoc.document.open();
	        //Create a new HTML document.
	        frameDoc.document.write('<html><head><title>KOT</title>');
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
        }, 500);

    });
</script>-->
<script type="text/javascript">
		$(document).on('click','.btnPrint6',function() {
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
        	/*frame1.remove();*/
        }, 500);

    });
</script>

</script>
 <script>
	function printDiv(divName) 
	{
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

}
</body>
</html>
