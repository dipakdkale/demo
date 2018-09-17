<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.home.php");

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

        <title>DIPOS</title>

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
            <!-- ================== -->            </header>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title" style="margin-right:20px" > 
                    
                   
                
                </div>

                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-pink">
                            <i class="ion-eye"></i> 
                            <h2 class="m-0 counter">50</h2>
                            
                           <div>Today Net sales</div>
                        </div>
                    
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-purple">
                            <i class="ion-paper-airplane"></i> 
                            <h2 class="m-0 counter">1205</h2>
                            <div>Yesterday's net sale</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-info">
                            <i class="ion-ios7-pricetag"></i> 
                            <h2 class="m-0 counter">1268</h2>
                             <div style="text-align:left">Weekly sale</div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-success">
                            <i class="ion-android-contacts"></i> 
                            <h2 class="m-0 counter">145</h2>
                            <div>Net sale</div>
                        </div>
                    </div>
                </div> <!-- end row -->
<div class="row">
                    <div class="col-lg-8">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Weekly Sales Report
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet1" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="morris-bar-example"  style="height: 320px;"></div>

                                    <div class="row text-center m-t-30 m-b-30">
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 126</h4>
                                            <small class="text-muted"> Today's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 967</h4>
                                            <small class="text-muted">This Week's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 4500</h4>
                                            <small class="text-muted">This Month's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 87,000</h4>
                                            <small class="text-muted">This Year's Sales</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->

                    </div> <!-- end col -->

                    <div class="col-lg-4">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                   Monthaly net SALES REPORT
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="morris-line-example" style="height: 200px;"></div>
                                    <div class="row text-center m-t-30">
                                <div class="col-sm-4">
                                    <h4>$ 86,956</h4>
                                    <small class="text-muted"> This Year's Report</small>
                                </div>
                                <div class="col-sm-4">
                                    <h4>$ 86,69</h4>
                                    <small class="text-muted">Weekly Sales Report</small>
                                </div>
                                <div class="col-sm-4">
                                    <h4>$ 948,16</h4>
                                    <small class="text-muted">Yearly Sales Report</small>
                                </div>

                            </div>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->
                        <div class="tile-stats white-bg"> 
                            <div class="col-sm-8">
                                <div class="status">
                                <h3 class="m-t-15">61.5%</h3> 
                                <p>Indian Rupees Share</p>
                            </div> 
                            </div>
                            <div class="col-sm-4 m-t-20">
                                <span class="sparkpie-big"><canvas width="98" height="50" style="display: inline-block; width: 98px; height: 50px; vertical-align: top;"></canvas></span> 
                            </div>
                        </div>
                    </div>
                </div> <!-- End row -->
            




            <div class=" container-fluid" style="  margin-left: 15px;   >
               

                <div class="row" >
                
                    <div class="col-md-12" >
                       
                            <div class="panel-body text-center" >
                                
                                <div class="row" >
                                    <div class="col-md-3" style="background-color:white; " >
                                    <div class="page-title" style="text-align: left"> 
                                      <h4 class="title">TOTAL REVENUE </h4> 
                                        </div>
                                        <div class="chart easy-pie-chart-3" data-percent="55">
                                            <span class="percent"></span>
                                            <h5 >Total sales made today </h5>

                                        <h3> 75   &#8377;</h3>
                                        </div>
                                    </div>
                             <div class="col-md-1"></div>
                                    <div class="col-md-3" style="background-color:white; " >
                                    <div class="page-title" style="text-align: left"> 
                             <h4 class="title">TOTAL REVENUE </h4> 
                           </div>
                                        <div class="chart easy-pie-chart-3" data-percent="80">
                                            <span class="percent"></span>
                                             <h5 >Total sales made today </h5>

                                        <h3>75    &#8377;</h3>
                                        </div>
                                    </div>
                       <div class="col-md-1"></div>
                                    <div class="col-md-3" style="background-color:white;">
                                    
                                          <div class="page-title" style="text-align: left"> 
                             <h4 class="title">TOTAL REVENUE </h4> 
                           </div>

                                        <div class="chart easy-pie-chart-3" data-percent="60">
                                            <span class="percent"></span>
                                             <h5 >Total sales made today </h5>

                                        <h3>75  &#8377;</h3></div>
                                        </div><div class="col-md-1"></div>
                                    </div>
</div>
                                    
                                </div>
                            </div>                        </div>
                   </div>
               
                </div> <!-- End row -->








                <div class="row">
                    <div class="col-lg-4">

                        <!-- Chat -->
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Chat
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet-3"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet-3" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="chat-conversation">
                                        <ul class="conversation-list nicescroll">
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="img/avatar-2.jpg" alt="male">
                                                    <i>10:00</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>John Deo</i>
                                                        <p>
                                                            Hello!
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="img/avatar-3.jpg" alt="Female">
                                                    <i>10:01</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>Smith</i>
                                                        <p>
                                                            Hi, How are you? What about our next meeting?
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="img/avatar-2.jpg" alt="male">
                                                    <i>10:01</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>John Deo</i>
                                                        <p>
                                                            Yeah everything is fine
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="img/avatar-3.jpg" alt="male">
                                                    <i>10:02</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>Smith</i>
                                                        <p>
                                                            Wow that's great
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="row">
                                            <div class="col-xs-9 chat-inputbar">
                                                <input type="text" class="form-control chat-input" placeholder="Enter your text">
                                            </div>
                                            <div class="col-xs-3 chat-send">
                                                <button type="submit" class="btn btn-info">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end Chat -->
                    </div> <!-- end col-->

                    <div class="col-lg-4">

                        <!-- TODO -->
                        <div class="portlet" id="todo-container"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Todo
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet-5" class="" aria-expanded="true"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet-5" class="panel-collapse collapse in">
                                <div class="portlet-body todoapp">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 id="todo-message"><span id="todo-remaining"></span> of <span id="todo-total"></span> remaining</h4> 
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="#" class="pull-right btn btn-primary btn-sm" id="btn-archive">Archive</a>
                                        </div>
                                    </div>

                                    <ul class="list-group no-margn nicescroll todo-list" style="max-height: 275px;" id="todo-list"></ul>

                                     <form name="todo-form" id="todo-form" role="form" class="m-t-20">
                                        <div class="row">
                                            <div class="col-sm-9 todo-inputbar">
                                                <input type="text" id="todo-input-text" name="todo-input-text" class="form-control" placeholder="Add new todo">
                                            </div>
                                            <div class="col-sm-3 todo-send">
                                                <button class="btn-info btn-block btn" type="button" id="todo-btn-submit">Add</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-lg-4">

                        <!-- Team-Member -->
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Team Members
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet-6" class="" aria-expanded="true"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet-6" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <ul class="list-group list-group-lg">
                                        <li class="list-group-item b-0">
                                            <a href="#" class=" m-r-10">
                                              <img src="img/avatar-3.jpg" class="thumb-sm br-radius">
                                            </a>
                                            <span class="pull-right label bg-primary inline m-t-10">CEO</span>
                                            <a href="#">Jonathan Deo</a>
                                        </li>
                                        <li class="list-group-item b-0">
                                            <a href="#" class=" m-r-10">
                                              <img src="img/avatar-4.jpg" class="thumb-sm br-radius">
                                            </a>
                                            <span class="pull-right label bg-info inline m-t-10">Webdesigner</span>
                                            <a href="#">Doler Perte</a>
                                        </li>
                                        <li class="list-group-item b-0">
                                            <a href="#" class=" m-r-10">
                                              <img src="img/avatar-5.jpg" class="thumb-sm br-radius">
                                            </a>
                                            <span class="pull-right label bg-warning inline m-t-10">Webdeveloper</span>
                                            <a href="#">Jannie Dvis</a>
                                        </li>
                                        <li class="list-group-item b-0">
                                            <a href="#" class=" m-r-10">
                                              <img src="img/avatar-6.jpg" class="thumb-sm br-radius">
                                            </a>
                                            <span class="pull-right label bg-pink inline m-t-10">Programmer</span>
                                            <a href="#">Emma Welson</a>
                                        </li>
                                        <li class="list-group-item b-0">
                                            <a href="#" class=" m-r-10">
                                              <img src="img/avatar-7.jpg" class="thumb-sm br-radius">
                                            </a>
                                            <span class="pull-right label bg-warning inline m-t-10">Webdeveloper</span>
                                            <a href="#">Jannie Dvis</a>
                                        </li>
                                        <li class="list-group-item b-0">
                                            <a href="#" class=" m-r-10">
                                              <img src="img/avatar-8.jpg" class="thumb-sm br-radius">
                                            </a>
                                            <span class="pull-right label bg-info inline m-t-10">Webdesigner</span>
                                            <a href="#">Petere Husen</a>
                                        </li>
                                        <li class="list-group-item b-0">
                                            <a href="#" class=" m-r-10">
                                              <img src="img/avatar-9.jpg" class="thumb-sm br-radius">
                                            </a>
                                            <span class="pull-right label bg-warning inline m-t-10">Webdeveloper</span>
                                            <a href="#">John Deo</a>
                                        </li>
                                    </ul>
                                </div> <!-- end portlet-body -->
                            </div> <!-- end portlet-collapsed -->
                        </div> <!-- end portlet/Team-member -->
                    </div> <!-- end col -->
                </div> <!-- End row -->


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
        


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="assets/chat/moment-2.2.1.js"></script>

        <!-- Counter-up -->
        <script src="js/waypoints.min.js" type="text/javascript"></script>
        <script src="js/jquery.counterup.min.js" type="text/javascript"></script>

        <!-- EASY PIE CHART JS -->
        <script src="assets/easypie-chart/easypiechart.min.js"></script>
        <script src="assets/easypie-chart/jquery.easypiechart.min.js"></script>
        <script src="assets/easypie-chart/example.js"></script>


        <!--C3 Chart-->
        <script src="assets/c3-chart/d3.v3.min.js"></script>
        <script src="assets/c3-chart/c3.js"></script>

        <!--Morris Chart-->
        <script src="assets/morris/morris.min.js"></script>
        <script src="assets/morris/raphael.min.js"></script>

        <!-- sparkline --> 
        <script src="assets/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script> 

        <!-- sweet alerts -->
        <script src="assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="assets/sweet-alert/sweet-alert.init.js"></script>

        <script src="js/jquery.app.js"></script>
        <!-- Chat -->
        <script src="js/jquery.chat.js"></script>
        <!-- Dashboard -->
        <script src="js/jquery.dashboard.js"></script>

        <!-- Todo -->
        <script src="js/jquery.todo.js"></script>


        <script type="text/javascript">
        /* ==============================================
             Counter Up
             =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>
    

    </body>

</html>

        


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
<?php $homepage->deletePage(TBL_PRODUCT);?>
<script>
$(document).on('click','.span_product',
function() {
var rowCount = $('#tbl_body_pro_list tr').length +1;
var id=$(this).attr('id');
var info = 'pro_id=' + id;
	$.ajax({
	type: "POST",
	url: "getdata.php?index=get_product_data",
	data: {'pro_id':id,'tr_count':rowCount},
	success: function(response){
		$('#tbl_body_pro_list').append(response);
	var total_amt=0;								  
	var i;
	for(i=1;i<= rowCount;i++)
	{
		var tmp=$('#td_amt'+i).val();
	
	total_amt +=parseInt(tmp);
	}
	$('#span_total_amt').html(total_amt);

	}
	});	
$("#span_total_quantity").html(rowCount);

});

$(document).on('click','#increase_date',function() {
var branch_id=<?php echo $_SESSION['branch_id'];?>;		
var newDate=<?php echo $homepage->getSoftwareDate();?>;

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
<?php $homepage->jqueryForChangeSession();?>
</body>
</html>
