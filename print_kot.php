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

        <title>Print KOT</title>

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
                     <span class="badge bg-info" style="font-size:24px !important;">Print KOT</span>
                   
                </div>
			<div class="row"> 
                    <div class="col-md-4" id="div_kot">
                    	<?php $homepage->printKot($cat_id);?>
                    </div> 
                </div>
            </div>
            
            <!-- Page Content Ends -->
            <!-- ================== -->
    
            <!-- Footer Start -->
            <footer class="footer">
                2018 © DIPOS-Digital Inventory Pos & Other Services.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        

	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    	<script src="js/pace.min.js"></script>
	<script src="js/wow.min.js"></script>
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
    
    <!-- Modal-Effect -->
    <script src="assets/modal-effect/js/classie.js"></script>
    <script src="assets/modal-effect/js/modalEffects.js"></script>
    <script src="assets/notifications/notify.min.js"></script>
    <script src="assets/notifications/notify-metro.js"></script>
    <script src="assets/notifications/notifications.js"></script>
    
    <script src="js/jquery.app.js"></script>

</body>
</html>