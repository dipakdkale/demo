<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.purchase_invoice.php");
$pur_invoice_obj=new PurchaseInvoice();
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
			var coun =$('.input_quantity').length;
			 var name = $("#ingradient").val();
			
            var email = $("#email").val();
			<?php
			$select_measurement="";
		$sql="select * from ".TBL_MEASUREMENT." where 1  order by name asc" ;
			$result= $homepage->db->query($sql,__FILE__,__LINE__);
			while($row = $homepage->db->fetch_array($result))
			{
				
				$select_measurement.="<option value='".$row['id']."'>".$row['name']."</option>";
			
			}
			
			?>
			<?php
			$select_tax="";
			$sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
			$result= $homepage->db->query($sql,__FILE__,__LINE__);
			while($row = $homepage->db->fetch_array($result))
			{
				
				$select_tax.="<option value='".$row['id']."' data-id='".$row['percentage']."'>".$row['name']."</option>";
			
			}
			
			?>
	
			
			
            var name = $("#ingradient").val();
            var email = $("#email").val();
			var info = 'name=' + name;
			var projected_per=$('#projected_sales').val();
			$.ajax({
			type: "POST",
			url: "getdata.php?index=get_stock",
			data: {'name':name,'projected_per':projected_per},
			success: function(response){ 
				var json_obj = $.parseJSON(response);
				var info2='unit='+json_obj.measure_unit;
				$('#hsn_no'+coun).val(json_obj.hsn_no);
				$('#unit_of_measurement'+coun).val(json_obj.measurement);
				$('#in_hand_stock'+coun).val(json_obj.quantity);
				$('#badge_unit'+coun).html(json_obj.measure_unit);
				$('#hidden_unit'+coun).val(json_obj.measurement_unit);
				$('#pre_tax_amt'+coun).val(json_obj.total_pre_tax_amt);
				$('#tax_amt'+coun).val(json_obj.tax_amount);
				$('#with_tax_amt'+coun).val(json_obj.with_tax_amount);
				$('#input_quantity'+coun).val(json_obj.avg_quantity);
				$('#rate'+coun).val(json_obj.avg_rate);
				$('#tax1'+coun).val(json_obj.tax1_name);
				$('#tax2'+coun).val(json_obj.tax2_name);
				$('#tax3'+coun).val(json_obj.tax3_name);
				$('#tax1_per'+coun).val(json_obj.tax1_percentage);
				$('#tax2_per'+coun).val(json_obj.tax2_percentage);
				$('#tax3_per'+coun).val(json_obj.tax3_percentage);
				$('#tax1_id'+coun).val(json_obj.tax1_id);
				$('#tax2_id'+coun).val(json_obj.tax2_id);
				$('#tax3_id'+coun).val(json_obj.tax3_id);
				var projected_per=('#projected_sales').val();
				var projected_quantity=((projected_per*json_obj.avg_quantity)/100);
				$('#projected_quantity'-coun).val(json_obj.projected_quantity);
			$.ajax({
			type: "POST",
			url: "getdata.php?index=get_realive_units",
			data: info2,Current In Hand stock
			success: function(response){ 
			$('#unit_of_measurement'+coun).html(response);
			}
			});	
			}
			});	
			
			var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='text' style='width:80px;' name='item_name[]' value='" + name + "' readonly></td><td><input type='text' name='unit_of_measurement[]' id='unit_of_measurement"+coun+"' style='width:80px;' readonly></td><td><input type='text' name='in_hand_stock[]' id='in_hand_stock"+coun+"' value='0' readonly  style='width:80px;'><span class='badge bg-inverse' id='badge_unit"+coun+"'></span><input type='hidden' name='measure_unit[]' id='hidden_unit"+coun+"'  /></td><td><input type='text' name='tax1[]' id='tax1"+coun+"' style='width:80px;' readonly><input type='hidden' value='0' name='tax1_per[]' id='tax1_per"+coun+"'><input type='hidden' value='0' name='tax1_id[]' id='tax1_id"+coun+"'></td><td><input type='text' name='tax2[]' id='tax2"+coun+"' style='width:80px;' readonly><input type='hidden' value='0' name='tax2_per[]' id='tax2_per"+coun+"'><input type='hidden' value='0' name='tax2_id[]' id='tax2_id"+coun+"'></td><td><input type='text' name='tax3[]' id='tax3"+coun+"' style='width:80px;' readonly><input type='hidden' value='0' name='tax3_per[]' id='tax3_per"+coun+"'><input type='hidden' value='0' name='tax3_id[]' id='tax3_id"+coun+"'></td><td><input name='quantity[]' id='input_quantity"+coun+"' value='0' class='input_quantity' type='text' style='width:80px;'></td><td><input name='projected_quantity[]' id='projected_quantity"+coun+"' value='0' class='projected_quantity' type='text' style='width:80px;'></td><td><input name='rate[]' value='0' class='rate' id='rate"+coun+"'  type='text' style='width:80px;'></td><td><input name='pre_tax_amt[]' readonly id='pre_tax_amt"+coun+"' value='0' class='pre_tax_amt' type='text' style='width:80px;'></td><td><input name='tax_amt[]' readonly id='tax_amt"+coun+"' value='0' class='tax_amt' type='text' style='width:80px;'></td><td><input name='with_tax_amt[]' id='with_tax_amt"+coun+"' value='0' readonly class='with_tax_amt' type='text' style='width:80px;'></td></tr>";
			$("#tbl_body").append(markup);
$('#ingradient').val('');
$('#ingradient').focus();
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
        <?php $homepage->leftSidebar('purchase_invoice');?>
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
				case 'add':
				if($submit=="Submit" || $save=="Save")
				$pur_invoice_obj->addpage('server');	
				else
				$pur_invoice_obj->addpage('local');				
				break;
				case 'edit':
				if($submit=="Submit")
				$pur_invoice_obj->editpage('server',$id);
				else
				$pur_invoice_obj->editpage('local',$id);	
				break;
				default:
				$pur_invoice_obj->allpage();
			}
			?>
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
<?php $homepage->deletePage(TBL_PURCHASE_ORDER);?>
<script>
jQuery('.datepicker').datepicker();
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


$(document).on('change','.projected_quantity',function() {
var total_amt=0;
calculate();
var coun =$('.projected_quantity').length;
var i=0;
for(i;i<coun;i++){
	var tmp=$('#projected_quantity'+i).val();
	total_amt=total_amt+parseInt(tmp);
}
$('#quantity_total').val(total_amt);
});

$(document).on('change','.pre_tax_amt',function() {
var total_amt=0;
var coun =$('.pre_tax_amt').length;
var i=0;
for(i;i<coun;i++){
	var tmp=$('#pre_tax_amt'+i).val();
	total_amt=total_amt+parseFloat(tmp);
	var row_toal=parseFloat(tmp)+parseFloat($('#tax_amt'+i).val());
	$('#with_tax_amt'+i).val(row_toal.toFixed(2));
}
$('#pre_tax_amt_total').val(total_amt);
var amt_total=total_amt+parseFloat($('#tax_amt_total').val());
$('#total_amt').val(amt_total.toFixed(2));

});

$(document).on('change','.tax_amt',function() {
var total_amt=0;
var coun =$('.tax_amt').length;
var i=0;
for(i;i<coun;i++){
	var tmp=$('#tax_amt'+i).val();
	total_amt=total_amt+parseFloat(tmp);
	var row_toal=parseFloat(tmp)+parseFloat($('#pre_tax_amt'+i).val());
	$('#with_tax_amt'+i).val(row_toal.toFixed(2));
}
$('#tax_amt_total').val(total_amt);
var amt_total=total_amt+parseFloat($('#pre_tax_amt_total').val());
$('#total_amt').val(amt_total.toFixed(2));
});
$(document).on('keyup','#input_discount',function() {
var discount=$(this).val();										 
var total_amt=$('#total_amt').val();
var gross_amt=total_amt-discount;			
$('#gross_amt').val(gross_amt);
$('#total_value').val(gross_amt);
});

$(document).on('keyup','#transportation_charge',function() {
if($('#supplier_type').val()=='Internal'){
	var gross=$('#total_amt').val();
}
else
{
var gross=$('#gross_amt').val();
}
var trans_charge=$(this).val();
var gt=parseFloat(gross)+parseFloat(trans_charge);
$('#total_value').val(gt.toFixed(2));
$('#amt_after_transportation').val(gt);
});

$(document).on('keyup','#handling_charge',function() {
var amt_after_transportation=$('#amt_after_transportation').val();
var handling_charge=$(this).val();
var gt=parseFloat(amt_after_transportation)+parseFloat(handling_charge);
$('#total_value').val(gt.toFixed(2));
});

</script>
<script>
function calculate () {
var  total=0;
var pre_tax_total=0;
var tax_amt_total=0;
var coun=$('#tbl_body tr').length;
var i=0;
for(i;i<coun;i++){
var tax1=$('#tax1_per'+i).val();
//alert(tax1);
var tax2=$('#tax2_per'+i).val();
//alert(tax2);
var tax3=$('#tax3_per'+i).val();
//alert(tax3);
var all_tax=parseInt(tax1)+parseInt(tax2)+parseInt(tax3);
//alert(all_tax);
var quantity=$('#projected_quantity'+i).val();
rate=$("#rate"+i).val();
var pre_tax_amt=quantity*rate;
$('#pre_tax_amt'+i).val(pre_tax_amt);
pre_tax_total=pre_tax_total+parseFloat($('#pre_tax_amt'+i).val());
$('#pre_tax_amt_total').val(pre_tax_total.toFixed(2));
var tax_amt=(all_tax*pre_tax_amt)/100;
$('#tax_amt'+i).val(tax_amt.toFixed(2));
tax_amt_total=tax_amt_total+parseFloat($('#tax_amt'+i).val());
$('#tax_amt_total').val(tax_amt_total.toFixed(2));
var with_tax_amt=parseFloat($('#pre_tax_amt'+i).val())+parseFloat($('#tax_amt'+i).val());
$('#with_tax_amt'+i).val(with_tax_amt.toFixed(2));
var total_amt=parseFloat($('#pre_tax_amt_total').val())+parseFloat($('#tax_amt_total').val());
$('#total_amt').val(total_amt.toFixed(2));
var total_value=parseFloat($('#pre_tax_amt_total').val())+parseFloat($('#tax_amt_total').val());
$('#total_value').val(total_value.toFixed(2));
}

}

  $(document).ready(function(){
    //Load City by State
    $(document).on('change', '.rate', function() {
       calculate ();
    });   
    $(document).on('change', '.tax_structure', function() {
       //do something
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
if(supplier_type=='Internal'){
	$('.tr_discount').hide();
}
else{
$('.tr_discount').show();
}


});
</script>
<script>
$(document).on('click','#btn_refresh',function(){
var coun =$('.input_quantity').length;
var total_quantity=0;
var pre_tax_amt=0;
var tax_amt=0;
var with_tax_total=0;
for(var i=0;i<coun;i++){
total_quantity=parseInt(total_quantity)+parseInt($('#projected_quantity'+i).val());
pre_tax_amt=parseFloat(pre_tax_amt)+parseFloat($('#pre_tax_amt'+i).val());
tax_amt=parseFloat(tax_amt)+parseFloat($('#tax_amt'+i).val());
with_tax_total=parseFloat(with_tax_total)+parseFloat($('#with_tax_amt'+i).val());
}
$('#quantity_total').val(total_quantity);
$('#pre_tax_amt_total').val(pre_tax_amt.toFixed(2));
$('#tax_amt_total').val(tax_amt.toFixed(2));
$('#total_amt').val(with_tax_total.toFixed(2));
$('#total_value').val(with_tax_total.toFixed(2)-('#input_discount').val()+parseFloat($('').val())+parseFloat($('').val()));
});
</script>
    </body> 

</html>
