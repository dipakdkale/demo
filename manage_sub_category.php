<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.sub_category.php");
$cat_obj=new Sub_Category();
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

        <title>Manage Sub catgories</title>

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


        <!-- Plugins css -->
        <link href="assets/notifications/notification.css" rel="stylesheet" />


        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
    </head>


    <body>
		<?php echo $notify->Notify();?>
        <!-- Aside Start-->
        <?php $homepage->leftSidebar('sub_category');?>
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
				if($submit=="Submit")
				$cat_obj->addpage('server');
				else
				$cat_obj->addpage('local');				
				break;
				case 'editpage':
				if($submit=="Submit")
				$cat_obj->editpage('server',$id);
				else
				$cat_obj->editpage('local',$id);	
				break;
				case 'mapping':
				$cat_obj->productBranchMapping();
				break;
				default:
				$cat_obj->allpage();
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
<script src="assets/notifications/notify.min.js"></script>
<script src="assets/notifications/notify-metro.js"></script>
<script src="assets/notifications/notifications.js"></script>
<script src="js/jquery.app.js"></script>

<?php $homepage->deletePage(TBL_SUB_CATEGORY);?>
<script>
$(document).on('click','#input_category_update',function() {
	var id=$(this).attr('data-id');	
	var info = 'id=' + id;
	
	if($(this).is(':checked'))
	{
		$.ajax({
	type: "POST",
	url: "getdata.php?index=update_category_show&tbl_name=tbl_sub_category",
	data: info,
	success: function(response){
		window.location.reload();
	}
	});
	}
	else
	{
		$.ajax({
	type: "POST",
	url: "getdata.php?index=update_category_hide&tbl_name=tbl_sub_category",
	data: info,
	success: function(response){
		window.location.reload();
	}
	});
	}
	
});

$(document).on('click','.branch_id_for_pos',function() {
var pro_id =  $(this).attr('data-id');

var branch_id =  $(this).val();
$.ajax({
	type: "POST",
	url: "getdata.php?index=sub_category_brnch_mapping_for_pos",
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
	url: "getdata.php?index=sub_category_brnch_mapping_for_invent",
	data: {'pro_id':pro_id,'branch_id':branch_id},
	success: function(response){
		//window.location.reload();
	}
	});

});
</script>
    </body>

</html>
