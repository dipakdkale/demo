<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.manage_receiving.php");
$manage_receiving_obj=new ManageReceiving();
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

        <title>Purchase and Receiving </title>

        <!-- Google-Fonts -->
        

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />


        <!-- Plugins css-->
        <link href="assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
        <link href="assets/toggles/toggles.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="assets/colorpicker/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/multi-select.css" />
        <link rel="stylesheet" type="text/css" href="assets/select2/select2.css" />
		 <link href="assets/notifications/notification.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
			
			<?php
			$select_measurement="<select name='unit_of_measurement[]'><option value=''>Select Unit</option>";
			$sql="select * from ".TBL_MEASUREMENT." where 1 order by name asc" ;
			$result= $homepage->db->query($sql,__FILE__,__LINE__);
			while($row = $homepage->db->fetch_array($result))
			{
				
				$select_measurement.="<option value='".$row['id']."'>".$row['name']."</option>";
			
			}
			$select_measurement.="</select>";
			?>
			<?php
			$select_tax="<select name='tax_structure[]'><option value=''>Select Unit</option>";
			$sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
			$result= $homepage->db->query($sql,__FILE__,__LINE__);
			while($row = $homepage->db->fetch_array($result))
			{
				
				$select_tax.="<option value='".$row['id']."'>".$row['name']."</option>";
			
			}
			$select_tax.="</select>";
			?>
	//		var select_unit='<?php echo $select_measurement;?>';
			var coun =$('.input_quantity').length;
            var name = $("#ingradient").val();
            var email = $("#email").val();
			var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='text' style='width:80px;' name='item_name[]' value='" + name + "' readonly></td><td><input name='hsn_no[]' type='text' style='width:80px;'></td><td><?php echo $select_measurement;?></td><td><input type='text' name='in_hand_stock[]' style='width:80px;'></td><td><?php echo $select_tax;?></td><td><input name='quantity[]' id='input_quantity"+coun+"' value='0' class='input_quantity' type='text' style='width:80px;'></td><td><input name='rate[]'  type='text' style='width:80px;'></td><td><input name='pre_tax_amt[]' id='pre_tax_amt"+coun+"' value='0' class='pre_tax_amt' type='text' style='width:80px;'></td><td><input name='tax_amt[]' id='tax_amt"+coun+"' value='0' class='tax_amt' type='text' style='width:80px;'></td><td><input name='with_tax_amt[]' id='with_tax_amt"+coun+"' value='0' class='with_tax_amt' type='text' style='width:80px;'></td></tr>";
			$("#tbl_body1").append(markup);
     });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
			$('.input_quantity').val('');
			$('.pre_tax_amt').val('');
			$('.tax_amt').val('');
			$('.with_tax_amt').val('');
			$('#input_discount').val('');
			$('#gross_amt').val('');
			$('#quantity_total').val('');
			$('#pre_tax_amt_total').val('');
			$('#tax_amt_total').val('');
			$('#total_amt').val('');
			$('#transportation_charge').val('');
			$('#amt_after_transportation').val('');
			$('#handling_charge').val('');
			$('#total_value').val('');
			
            $("#tbl_body").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>
    </head>


    <body>
		<?php echo $notify->Notify();?>
        <!-- Aside Start-->
        <?php $homepage->leftSidebar('manage_receiving');?>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <?php $homepage->pageHeader();?>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                
			<?php 
			switch($index)
			{
				case 'addpage':
				if($submit=="Submit" || $save=="Save")
				$manage_receiving_obj->addpage('server');	
				else
				$manage_receiving_obj->addpage('local');				
				break;
				case 'editpage':
				if($submit=="Submit")
				$manage_receiving_obj->editpage('server',$id);
				else
				$manage_receiving_obj->editpage('local',$id);	
				break;
				default:
				$manage_receiving_obj->allpage();
			}
			?>
            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <footer class="footer">
                2018 © DIPOS.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


        <!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/pace.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/tagsinput/jquery.tagsinput.min.js"></script>
<script src="assets/toggles/toggles.min.js"></script>
<script src="assets/timepicker/bootstrap-timepicker.min.js"></script>
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
<?php $homepage->deletePage(TBL_RECEIVING_ORDER);?>
<script>
$(document).on('change','#supplier_id',function() {
var supplier_id=$(this).val();
var info = 'supplier_id=' + supplier_id;

 $.ajax({
   type: "POST",
   url: "getdata.php?index=get_purchase_invoice",
   data: info,
   success: function(response){
	   $('#purchase_invoice_no').html(response);
		
 }
});

});
$(document).on('change','#purchase_invoice_no',function() {
var id=$(this).val();
var info = 'id=' + id;
 $.ajax({
   type: "POST",
   url: "getdata.php?index=get_purchase_items",
   data: info,
   success: function(response){
	   $('#tbl_body').html(response);
 }
});
 $.ajax({
   type: "POST",
   url: "getdata.php?index=get_purchase_order_detail",
   data: info,
   success: function(response){
	   var json_obj = $.parseJSON(response);
	   $('#user_name').val(json_obj.user_name);
	   $('#current_date').val(json_obj.current_date);
	   $('#manufacturing_date').val(json_obj.manufacturing_date);
	   $('#purchase_time').val(json_obj.purchase_time);
	   $('#quantity_total').val(json_obj.quantity_total);
	   $('#pre_tax_amt_total').val(json_obj.pre_tax_amt_total);
	   $('#tax_amt_total').val(json_obj.tax_amt_total);
	   $('#total_amt').val(json_obj.total_amt);
		
		$('#input_discount').val(json_obj.discount);
		$('#gross_amt').val(json_obj.bill_after_discount);
		$('#transportation_charge').val(json_obj.transportation_charge);
		$('#handling_charge').val(json_obj.handling_charge);
		$('#total_value').val(json_obj.grand_total_amt);
 }
});
});
</script>
<script>

jQuery('#datepicker').datepicker();
jQuery('#datepicker-inline').datepicker();
jQuery('#datepicker-multiple').datepicker({
	numberOfMonths: 3,
	showButtonPanel: true
});
jQuery('#timepicker').timepicker({defaultTIme: false});
jQuery('#timepicker2').timepicker({showMeridian: false});
jQuery('#timepicker3').timepicker({minuteStep: 15});
</script>
<script>
$(document).on('keyup','#ingradient', function() {
var name=$(this).val();

var info = 'name=' + name;

 $.ajax({
   type: "POST",
   url: "getdata.php?index=get_items",
   data: info,
   success: function(response){
	   $('#ingradient_list').fadeIn();
		
	   $('#ingradient_list').html(response);
 }
});
$(document).on('click','#list_item li',
	function()
	{
	$('#ingradient').val($(this).text());
		var data_id=$(this).attr('data-id');
		var info = 'id=' + data_id;
		$('#ingradient_id').val(data_id);
		$('#ingradient_list').fadeOut();
		
	$.ajax({
	type: "POST",
	url: "getdata.php?index=get_measurement",
	data: info,
	success: function(response){
	   $('#div_measurement_unit').show();
	   $('#measurement_unit').val(response);
	}
	});	
		
	});

});
</script>
<script>


$(document).on('change','.input_quantity',function() {
var total_amt=0;
var coun =$('.input_quantity').length;
var i=0;
for(i;i<coun;i++){
	var tmp=$('#input_quantity'+i).val();
	total_amt=total_amt+parseInt(tmp);
}
$('#quantity_total').val(total_amt);
});
$(document).on('change','.transfer_quantity',function() {
var total_amt=0;
var coun =$('.transfer_quantity').length;
var i=1;
for(i;i<=coun;i++){
	var tmp=$('#transfer_quantity'+i).val();
	total_amt=total_amt+parseInt(tmp);
}
$('#transfer_quantity_total').val(total_amt);
});

$(document).on('change','.received_quantity',function() {
var total_amt=0;
var coun =$('.received_quantity').length;
var i=1;
for(i;i<=coun;i++){
	var tmp=$('#received_quantity'+i).val();
	total_amt=total_amt+parseInt(tmp);
}
$('#received_quantity_total').val(total_amt);
});

$(document).on('change','.pre_tax_amt',function() {
var total_amt=0;
var coun =$('.pre_tax_amt').length;
var i=0;
for(i;i<coun;i++){
	var tmp=$('#pre_tax_amt'+i).val();
	total_amt=total_amt+parseInt(tmp);
	var row_toal=parseInt(tmp)+parseInt($('#tax_amt'+i).val());
	$('#with_tax_amt'+i).val(row_toal);
}
$('#pre_tax_amt_total').val(total_amt);
var amt_total=total_amt+parseInt($('#tax_amt_total').val());
$('#total_amt').val(amt_total);

});

$(document).on('change','.tax_amt',function() {
var total_amt=0;
var coun =$('.tax_amt').length;
var i=0;
for(i;i<coun;i++){
	var tmp=$('#tax_amt'+i).val();
	total_amt=total_amt+parseInt(tmp);
	var row_toal=parseInt(tmp)+parseInt($('#pre_tax_amt'+i).val());
	$('#with_tax_amt'+i).val(row_toal);
}
$('#tax_amt_total').val(total_amt);
var amt_total=total_amt+parseInt($('#pre_tax_amt_total').val());
$('#total_amt').val(amt_total);
});
$(document).on('keyup','#input_discount',function() {
var discount=$(this).val();										 
var total_amt=$('#total_amt').val();
var gross_amt=total_amt-discount;			
$('#gross_amt').val(gross_amt);
$('#total_value').val(gross_amt);
});

$(document).on('keyup','#transportation_charge',function() {
var gross=$('#gross_amt').val();
var trans_charge=$(this).val();
var gt=parseInt(gross)+parseInt(trans_charge);
$('#total_value').val(gt);
$('#amt_after_transportation').val(gt);
});

$(document).on('keyup','#handling_charge',function() {
var amt_after_transportation=$('#amt_after_transportation').val();
var handling_charge=$(this).val();
var gt=parseInt(amt_after_transportation)+parseInt(handling_charge);
$('#total_value').val(gt);
});

</script>
<script>
function calculate () {
var  total=0;
var pre_tax_total=0;
var tax_amt_total=0;
var coun=$('#tbl_body tr').length;
var i=1;
for(i;i<=coun;i++){
var tax1=$('#tax1_per'+i).attr('data-id');
//alert(tax1);
var tax2=$('#tax2_per'+i).attr('data-id');
//alert(tax2);
var tax3=$('#tax3_per'+i).attr('data-id');
//alert(tax3);
var tax=parseInt(tax1)+parseInt(tax2)+parseInt(tax3);
var quantity=$('#received_quantity'+i).val();
rate=$("#rate"+i).val();
var pre_tax_amt=quantity*rate;
$('#pre_tax_amt'+i).val(pre_tax_amt);
pre_tax_total=pre_tax_total+parseInt($('#pre_tax_amt'+i).val());
$('#pre_tax_amt_total').val(pre_tax_total);
var tax_amt=(tax*pre_tax_amt)/100;
$('#tax_amt'+i).val(tax_amt.toFixed(2));
tax_amt_total=tax_amt_total+parseFloat($('#tax_amt'+i).val());
$('#tax_amt_total').val(tax_amt_total.toFixed(2));
$('#with_tax_amt'+i).val((parseFloat($('#pre_tax_amt'+i).val())+parseFloat($('#tax_amt'+i).val())).toFixed(2));
$('#total_amt').val(parseFloat($('#pre_tax_amt_total').val())+parseFloat($('#tax_amt_total').val()));
$('#gross_amt').val(parseFloat($('#total_amt').val())-parseFloat($('#input_discount').val()));
$('#total_value').val(parseFloat($('#gross_amt').val())+parseFloat($('#transportation_charge').val()) +parseFloat($('#handling_charge').val()));

}

}

  $(document).ready(function(){
    //Load City by State
    $(document).on('change', '.rate', function() {
       calculate ();
    }); 
	 $(document).on('change', '.received_quantity', function() {
       calculate ();
    }); 
    $(document).on('change', '.tax_structure', function() {
      
       calculate();
    });   
  });
</script>
<script>
$(document).on('change','#supplier_type',function() {
var supplier_type=$(this).val();
var info= 'supplier_type='+supplier_type;
$.ajax({
	type: "POST",
	url: "getdata.php?index=get_supplier",
	data: info,
	success: function(response){
	   
	   $('#supplier_id').html(response);
	}
	});	

});
</script>
</body>

</html>
