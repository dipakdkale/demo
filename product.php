<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.product.php");
$ingrad_obj=new Product();
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

        <title> Products</title>

        <!-- Google-Fonts -->
        
        <!-- Bootstrap core CSS -->
         <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>


        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="css/animate.css" rel="stylesheet">
		 <link href="css/custom.css" rel="stylesheet">		
        <!--Icon-fonts css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
		<link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

        <!-- Plugins css -->
        <link href="assets/notifications/notification.css" rel="stylesheet" />


        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
    </head>


    <body>
    <?php $notify->Notify();?>

        <!-- Aside Start-->
        <?php $homepage->leftSidebar('product');?>
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
            $submit = isset($_POST['submit']) ? $_POST['submit'] : ''; 
            switch($index)
			{
				default:
                $ingrad_obj->allpage();
                break;
                case 'addpage':
				if($submit=="Submit")
				$ingrad_obj->addpage('server');
				else
				$ingrad_obj->addpage('local');				
				break;
				case 'editpage':
				if($submit=="Submit")
				$ingrad_obj->editpage('server',$id);
				else
				$ingrad_obj->editpage('local',$id);	
				break;
				case 'mapping':
				$ingrad_obj->productBranchMapping();
				break;
				
			};
			?>
            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <footer class="footer">
                2018 © DIPOS Digital Inventory POS and Other Services.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


        <!-- js placed at the end of the document so the pages load faster -->
  <script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/pace.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="assets/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/timepicker/bootstrap-datepicker.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/notifications/notify.min.js"></script>
<script src="assets/notifications/notify-metro.js"></script>
<script src="assets/notifications/notifications.js"></script>
<script src="js/jquery.app.js"></script>

<?php $homepage->deletePage(TBL_PRODUCT);?>
<script>
$(document).on('change','#category_id', function() {
var id=$(this).val();

var info = 'cat_id=' + id;

 $.ajax({
   type: "POST",
   url: "getdata.php?index=get_sub_category",
   data: info,
   success: function(response){
	   $('#sub_category_id').html(response);
 }
});

});

$(document).on('click','#taxation1',function() {
$('#div_tax').show();
});
$(document).on('click','#taxation2',function() {
$('#div_tax').hide();
});
jQuery('#datepicker').datepicker();
jQuery('#datepicker-inline').datepicker();
jQuery('#datepicker-multiple').datepicker({
	numberOfMonths: 3,
	showButtonPanel: true
});
</script>
<script>
$(document).on('click','#input_product_update',function() {
	var id=$(this).attr('data-id');	
	var info = 'id=' + id;
	$.ajax({
	type: "POST",
	url: "getdata.php?index=update_active_status",
	data: info,
	success: function(response){
		window.location.reload();
	}
	});
});
$(document).on('click','.branch_id_for_pos',function() {
var pro_id =  $(this).attr('data-id');

var branch_id =  $(this).val();
$.ajax({
	type: "POST",
	url: "getdata.php?index=product_brnch_mapping_for_pos",
	data: {'pro_id':pro_id,'branch_id':branch_id},
	success: function(response){
		//window.location.reload();
	}
	});

});

$(document).on('click','.branch_id_for_inventory',function() {
var pro_id =  $(this).attr('data-id');

var branch_id =  $(this).val();
$.ajax({
	type: "POST",
	url: "getdata.php?index=product_brnch_mapping_for_invent",
	data: {'pro_id':pro_id,'branch_id':branch_id},
	success: function(response){
		//window.location.reload();
	}
	});

});
</script>
</body>

</html>
