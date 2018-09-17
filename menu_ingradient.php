<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.menu_ingradient.php");
$ingrad_obj=new MenuIngradient();
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

        <title>Menu ingradient</title>
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
 		<link href="assets/modal-effect/css/component.css" rel="stylesheet">
        <!-- Plugins css-->
        <link href="assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
        <link href="assets/toggles/toggles.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="assets/colorpicker/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/multi-select.css" />
        <link rel="stylesheet" type="text/css" href="assets/select2/select2.css" />


        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
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
                
                <div class="wraper container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-color panel-success">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Add Ingradients</h3> 
                                <a href="product.php" class="btn btn-purple btn-rounded m-b-5 pull-right" style="margin-top:-25px;"> <i class="fa fa-arrow-left" aria-hidden="true"></i> All Products</a>
                            </div> 
                             <?php $ingrad_obj->ProductDescription('$id');?>
                             
                        </div>
                    </div>
                </div> <!-- End row -->
              

                <div class="row">
                    <?php 
                    $submit = isset($_POST['submit']) ? $_POST['submit'] : ''; 
					if($submit=='addIngradient')
					$ingrad_obj->addIngradient('server','$id');
					else
					$ingrad_obj->addIngradient('local','$id');
					?>
                    <?php $ingrad_obj->ingradientList('$id');?>
                </div> <!-- End row -->
                
					
                 <!-- End row -->


            </div>
			<?php /*
            
            $submit = isset($_POST['submit']) ? $_POST['submit'] : '';

			switch($index)
			{
				case '$addpage':
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
				default:
				$ingrad_obj->allpage();
                
			} */
			?>
            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <footer class="footer">
                2018 © DIPOS -Digital Inventory POS & Other Services.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
<div class="md-modal md-effect-13" id="modal-13">
    <div class="md-content">
        <h3>Edit Ingradients</h3>
        <div>
		<?php     
        {
            $submit = isset($_POST['submit']) ? $_POST['submit'] : '';
        if($submit=='Update')
        $ingrad_obj->editIngradient('server',$id);
        else
        $ingrad_obj->editIngradient('local',$id);
        }
        ?>
           
            <button class="md-close btn-sm btn-primary">Close me!</button>
        </div>
    </div>
</div>      
<div class="md-overlay"></div>

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
		<script src="assets/modal-effect/js/classie.js"></script>
        <script src="assets/modal-effect/js/modalEffects.js"></script>

        <script src="js/jquery.app.js"></script>
<?php $homepage->deletePage(TBL_PRODUCT_INGRADIENT);?>
<?php ?>
<script type="text/javascript">
$(function() {
$(".btn_delete").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "del.php?table=<?php echo TBL_PRODUCT_INGRADIENT ;?>",
   data: info,
   success: function(){
	  
	    window.location.reload();
 }
});
  $(this).parents(".tbl_row").animate({ backgroundColor: "#003" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});

});
</script><?php ?>

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

$(document).on('keyup','#selling_price_without_tax',function() {
var sp=$(this).val();
var tp=$("#tax_percentage").attr('data-id');
var tax_amt=((sp*tp)/100);
$('#tax_percentage').val(tax_amt);
var spwithtax=parseFloat(sp)+parseFloat(((sp*tp)/100));
$('#selling_price').val(spwithtax.toFixed(2));
var cp=$('#cost_price').val();
var cost_percentage=cp/sp;


$('#profit_percentage2').val(cost_percentage.toFixed(2));
});
</script>
<script>
$(document).on('click','.btn_ing_edit',function() {
var ing_id=$(this).attr('data-id');
var info = 'ing_id=' + ing_id;
	$.ajax({
	type: "POST",
	url: "getdata.php?index=get_editable_data",
	data: info,
	success: function(response){
	   $('#div_measurement_unit').show();
	   $('#measurement_unit').val(response);
	   var json_obj = $.parseJSON(response);
	   $('#span_ungradient_name').html(json_obj.item_name);
	   $('#span_unit').html(json_obj.measurement_unit);
	   $('#input_quantity').val(json_obj.quantity);
	   $('#hidden_ing_id').val(json_obj.ing_id);
	}
	});	
		
});
</script>
<script>
            jQuery(document).ready(function() {
                    
                // Tags Input
                jQuery('#tags').tagsInput({width:'auto'});

                // Form Toggles
                jQuery('.toggle').toggles({on: true});

                // Time Picker
                jQuery('#timepicker').timepicker({defaultTIme: false});
                jQuery('#timepicker2').timepicker({showMeridian: false});
                jQuery('#timepicker3').timepicker({minuteStep: 15});

                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple').datepicker({
                    numberOfMonths: 3,
                    showButtonPanel: true
                });
                //colorpicker start

                $('.colorpicker-default').colorpicker({
                    format: 'hex'
                });
                $('.colorpicker-rgba').colorpicker();


                //multiselect start

                $('#my_multi_select1').multiSelect();
                $('#my_multi_select2').multiSelect({
                    selectableOptgroup: true
                });

                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });

                //spinner start
                $('#spinner1').spinner();
                $('#spinner2').spinner({disabled: true});
                $('#spinner3').spinner({value:0, min: 0, max: 10});
                $('#spinner4').spinner({value:0, step: 5, min: 0, max: 200});
                //spinner end

                // Select2
                jQuery(".select2").select2({
                    width: '100%'
                });
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
			   // window.location.reload();
			}
			});
			

});
		</script>
        
</body>

</html>
