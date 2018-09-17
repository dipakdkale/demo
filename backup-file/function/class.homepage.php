<?php

/***********************************************************************************
Class Discription : This class will handle the creation and modification of Basic functions.
**********************************************************************************/

class HomePage{    
	 var $user_id; 
     	var $first_name;
	 var $last_name;
	 var $email_id;
	 var $country_code;
	 var $area_code;
	 var $phone_no;
	 var $agree;
	 var $password;
	 var $db;
	 var $validity;
	 var $Form;
         var $new_pass;
	 var $confirm_pass;
	 var $auth;
	 var $temppass; 
	 var $mail_obj;
	 var $template;
	 private $adminuser;
	 private $adminpassword;
 

	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
	}
	###########GEt user Detail############
	function getMeasurement($id){
	$sql="select * from ".TBL_MEASUREMENT." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	
	$row = $this->db->fetch_array($result);
	
		return $row['base_unit'];
	
	}
	
	function getSoftwareDate(){
	$sql="select * from ".TBL_SOFTWARE_TIME." where 1 and branch_id='".$_SESSION['branch_id']."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$rows = $this->db->num_rows($result);
	$row = $this->db->fetch_array($result);
	if($rows==0)
	{
		return date('Y-m-d',time());
	}
	else
	{
	return $row['software_time'];
	}
	}
	function branchMaster($colname){
	$sql="select * from ".TBL_SOFTWARE_TIME." where 1 and branch_id='".$_SESSION['branch_id']."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function branchTax($colname){
	$sql="select * from ".TBL_BRANCH_TAX." where 1 and branch_id='".$_SESSION['branch_id']."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function managePrinter($cat_id){
	$sql="select * from ".TBL_MANAGE_PRINTER." where 1 and branch_id='".$_SESSION['branch_id']."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	$category=explode(', ', $row['category']);
	return in_array($cat_id,$category);
	}
	function getTaxDetail($id,$colname){
	$sql="select * from ".TBL_TAX_SLAB." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function getUserDetail($colname){
    $sql = "select * from ".TBL_USER." where id='".$_SESSION['user_id']."' ";
    $record = $this->db->query($sql,__FILE__,__LINE__);
    $row = $this->db->fetch_array($record);
 return	$row[$colname];
}
function getUserDetailById($id,$colname){
    $sql = "select * from ".TBL_USER." where id='".$id."' ";
    $record = $this->db->query($sql,__FILE__,__LINE__);
    $row = $this->db->fetch_array($record);
 return	$row[$colname];
}
function getBillNumber(){
    $sql = "select * from ".TBL_POS_ORDER." where  1 ";
    $record = $this->db->query($sql,__FILE__,__LINE__);
    $row = $this->db->fetch_array($record);
	 return	$row['id']+1;
}
function getConversion($unit,$base_unit){
	 $sql="select conversion  from ".TBL_MEASUREMENT." where name='".$unit."' and base_unit='".$base_unit."' " ;  
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['conversion'];
	}
function getSoftwareDetail($tblname,$id,$colname){
    $sql = "select * from ".$tblname." where id='".$id."' ";
    $record = $this->db->query($sql,__FILE__,__LINE__);
    $row = $this->db->fetch_array($record);
 return	$row[$colname];
}
function getMemberDetail($id,$colname){
	$sql="select * from ".TBL_USER." where 1 and id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	$sql2="select * from ".TBL_MEMBER." where 1 and id='".$row['mem_id']."' order by id asc" ;
	$result2= $this->db->query($sql2,__FILE__,__LINE__);
	$row2 = $this->db->fetch_array($result2);
	return $row2[$colname];
	}
	function getDepartment($id){
	$sql="select * from ".TBL_DEPARTMENT." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
		$row = $this->db->fetch_array($result);
	
	}
	

############Log in Start###########
        
	function LogIn($runat)
	{ 
	switch($runat){
		case 'local':
		$FormName = "frm_Login";
			$ControlNames=array("user_name"=>array('user_name',"''","The user name field is required.","span_user_name"),
								"password"=>array('password',"''","The Password field is required.","span_password"));
									$ValidationFunctionName="checkValidation";
			
			$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
			echo $JsCodeForFormValidation;
		
	?>
    <form class="form-horizontal m-t-40" action="" method="post">
                                
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" name="user_name" type="text" placeholder="Username">
            </div>
        </div>
        <div class="form-group ">
            
            <div class="col-xs-12">
                <input class="form-control" name="password" type="password" placeholder="Password">
            </div>
        </div>
    
        
        
        <div class="form-group text-right">
            <div class="col-xs-12">
                <button class="btn btn-purple w-md" name="submit" value="Submit" type="submit">Log In</button>
            </div>
        </div>
        <div class="form-group m-t-30">
            <div class="col-sm-7">
                <a href="recoverpw.html"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
            </div>
            <div class="col-sm-5 text-right">
                <a href="register.html">Create an account</a>
            </div>
        </div>
    </form>
	<?php 	
	 break;
     case 'server':
     extract($_POST);

				$this->user_name = $user_name;
				$this->password=$password;

				///server side validation

				$return =true;
				if($this->Form->ValidField($this->user_name,'empty','The Username field is required.')==false)
				$return =false;

				if($this->Form->ValidField($this->password,'empty','The Password field is required.')==false)
				$return =false;
			

				if($return)
				{
					$sql = "select * from ".TBL_USER." where username='".$this->user_name."' ";
					$record = $this->db->query($sql,__FILE__,__LINE__);
					$row = $this->db->fetch_array($record);
					$password=$this->password;
					

					if($this->user_name == $row['username'] and $password == $row['password'] and $row['is_active']== 'yes')
					{
						
						
							$this->user_id		= $row['id'];
							$this->fname    = $row['fname'];
							$this->user_name	= $row['username'];
							$this->user_type	= $row['user_type'];
							$this->branch_id=$this->getMemberDetail($row['id'],'branch_id');
							$this->brand_id=$this->getMemberDetail($row['id'],'brand_id');
							$this->company_id=$this->getMemberDetail($row['id'],'company_id');
							$this->company_id=$this->getMemberDetail($row['id'],'company_id');
							$this->auth->Create_Session($this->user_id,$this->user_name,$this->user_type,$this->branch_id,$this->brand_id,$this->company_id);
					   ?>
							<script type="text/javascript">
								window.location="home.php";
							</script>
						<?php
						
					}
					else
					{
						$_SESSION['error_msg']='Are you a user ? If yes then Invalid username or password, please try again ...';
						?>
						<script type="text/javascript">
						window.location="index.php";
						</script>
						<?php
					}
				}
				break;
			default :
			echo "Wrong Parameter passed";
		}
		}
##########Login End################
##########Logout Start#############
	function logout($id)
	{
	ob_start();
	$this->auth->Destroy_Session();
	$_SESSION['msg']	=	"Logout Successfully";
	?>
	<script>
	window.location="index.php";
	</script>
	<?php

	$html = ob_get_contents();
	ob_end_clean();
	return $html;
	}
#############logout end#############
##########Left Sidebar#############
function leftSidebar($page){
?>
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="home.php" class="logo-expanded">
            <img src="img/single-logo.png" alt="logo">
            <span class="nav-label">DIPOS</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
       		<?php if($_SESSION['user_type']=='sadmin') { ?>
            <li class="has-submenu <?php if($page=='company') echo 'active';?>"><a href="manage_company.php"><i class="fa fa-university"></i> <span class="nav-label">Manage Company </span></a>
            </li>
            <?php }?>
       <?php if($_SESSION['user_type']=='sadmin' || $_SESSION['user_type']=='company_admin') { ?>
            <li class="has-submenu  <?php if($page=='brand') echo 'active';?>"><a href="manage_brand.php"><i class="ion-flask"></i> <span class="nav-label">Manage Brand</span></a>
            <?php }?> 
             <?php if($_SESSION['user_type']=='sadmin' || $_SESSION['user_type']=='company_admin'|| $_SESSION['user_type']=='branch_admin') { ?>
            </li>
            <li class="has-submenu  <?php if($page=='branch') echo 'active';?>"><a href="manage_branch.php"><i class="ion-settings"></i> <span class="nav-label">Manage Branch</span></a>
             <li class="has-submenu  <?php if($page=='department') echo 'active';?>"><a href="manage_department.php"><i class="ion-settings"></i> <span class="nav-label">Manage Department</span></a>
            </li>
            <?php }?>
            
            <li class="has-submenu <?php if($page=='member') echo 'active';?>"><a href="manage_user.php"><i class="ion-compose"></i> <span class="nav-label">Manage Employee</span></a>
            </li>
             <li class="has-submenu <?php if($page=='product') echo 'active';?>"><a href="product.php"><i class="fa fa-list"></i> <span class="nav-label">Menu Items</span></a>
            </li>
            <li class="has-submenu  <?php if($page=='category'  ) echo 'active';?><?php if($page=='ingradient') echo 'active';?>"><a href="#"><i class="ion-grid"></i> <span class="nav-label">Manage Items</span></a>
                <ul class="list-unstyled">
                	<li class="<?php if($page=='ingradient') echo 'active';?>"><a href="manage_ingradient.php">Ingredients / Items</a></li>

                    <li class="<?php if($page=='category') echo 'active';?>"><a href="manage_category.php">Manage Category</a></li>
                    <li class="<?php if($page=='sub_category') echo 'active';?>"><a href="manage_sub_category.php">Manage Sub Category</a></li>
                    
                </ul>
            </li>
           <li class="has-submenu <?php if($page=='inventoy' || $page=='supplier') echo 'active';?> "><a href="#"><i class="fa fa-archive	"></i> <span class="nav-label">Manage Inventory</span></a>
                <ul class="list-unstyled">
                    <li class="<?php if($page=='inventoy') echo 'active';?>"><a href="inventory.php">Closing Stock</a></li>
                    <li class="<?php if($page=='supplier') echo 'active';?>"><a href="manage_supplier.php">Manage Supplier</a></li>
                    <li class="<?php if($page=='purchase_invoice') echo 'active';?>"><a href="purchase_invoice.php">Requisition Invoice</a></li>
                    <li class="<?php if($page=='transfer') echo 'active';?>"><a href="transfer.php">Transfer Receipts</a></li>
                   <li class="<?php if($page=='manage_receiving') echo 'active';?>"><a href="manage_receiving.php">Purchase & Receiving Receipts</a></li>
		   <li class="<?php if($page=='spoilage') echo 'active';?>"><a href="spoilage.php">Manage Spoilage</a></li>                    
                </ul>
            </li>
            <li class="has-submenu <?php if($page=='report' || $page=='report'|| $page=='report'|| $page=='report') echo 'active';?> "><a href="#"><i class="fa fa-archive	"></i> <span class="nav-label">Reports</span></a>
            <ul class="list-unstyled">
            <li class="<?php if($page=='report') echo 'active';?>"><a href="report.php">Sale Report</a></li>
             <li class="<?php if($page=='report') echo 'active';?>"><a href="report.php">Wastage Report</a></li>
              <li class="<?php if($page=='report') echo 'active';?>"><a href="report.php">Requisition Report</a></li>
               <li class="<?php if($page=='report') echo 'active';?>"><a href="report.php">Transfer receipt Report</a></li>
               <li class="<?php if($page=='report') echo 'active';?>"><a href="report.php">Purchase& receiving Report</a></li>
               <li class="<?php if($page=='report') echo 'active';?>"><a href="report.php">Consumption Report</a></li>
            </ul>
            </li>
            
            <li class="has-submenu <?php if($page=='measurement' || $page=='receipt' || $page=='printer') echo 'active';?> <?php if($page=='tax_slab') echo 'active';?>"><a href="#"><i class="ion-stats-bars"></i> <span class="nav-label">Master Settings</span></a>
                <ul class="list-unstyled">
                    <li class="<?php if($page=='tax_slab') echo 'active';?>"><a href="tax_slab.php">Tax Slab</a></li>
                    <li class="<?php if($page=='measurement') echo 'active';?>"><a href="manage_measurement.php">Manage Measurement</a></li>
                    <li class="<?php if($page=='table') echo 'active';?>"><a href="manage_table.php">Manage Table</a></li>
                    <li class="<?php if($page=='receipt') echo 'active';?>"><a href="manage_receipt.php">Manage Bill/Receipt Info</a></li>
                   <li class="<?php if($page=='printer') echo 'active';?>"><a href="manage_printer.php">Manage Printer</a></li>
                   
                   
                   <?php if($_SESSION['user_type']=='sadmin') {?>
                   <li class="<?php if($page=='software_date') echo 'active';?>"><a href="javaacript:void(0);" data-toggle="modal" data-target=".bs-example-modal-sm">Branch Master</a></li>

                    
                   <?php }?>
                </ul>
            </li>
             
         <li class="has-submenu"><a href="#"><i class="ion-location"></i> <span class="nav-label">Maps</span></a>
                <ul class="list-unstyled">
                    <li><a href="gmap.html"> Google Map</a></li>
                    <li><a href="vector-map.html"> Vector Map</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="ion-document"></i> <span class="nav-label">Pages</span></a>
                <ul class="list-unstyled">
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="timeline.html">Timeline</a></li>
                    <li><a href="invoice.html">Invoice</a></li>
                    <li><a href="contact.html">Contact-list</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="recoverpw.html">Recover Password</a></li>
                    <li><a href="lock-screen.html">Lock Screen</a></li>
                    <li><a href="blank.html">Blank Page</a></li>
                    <li><a href="404.html">404 Error</a></li>
                    <li><a href="404_alt.html">404 alt</a></li>
                    <li><a href="500.html">500 Error</a></li>
                </ul>
            </li>
        </ul>
    </nav>
        
</aside>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="mySmallModalLabel">Branch Master</h4>
            </div>
            <div class="modal-body">
           <input type="text" class="form-control datepicker" name="Increase Date" value="<?php echo date('d-m-Y',strtotime($this->branchMaster('software_time')));?>" placeholder="Change Software Date" id="input_change_date"/>
           <select class="form-control" name="tax1" id="branch_tax1">
           <option value="0">Select Default Tax 1</option>
           <?php
		   $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
            $result= $this->db->query($sql,__FILE__,__LINE__);
            while($row = $this->db->fetch_array($result))
            {
		   ?>
           <option value="<?php echo $row['id'];?>" <?php if($this->branchMaster('branch_tax1')==$row['id']) echo "selected=selected";?>><?php echo $row['name'];?></option>
           <?php }?>
           </select>
           <select class="form-control" name="tax1" id="branch_tax2">
           <option value="0">Select Default Tax 2</option>
           <?php
		   $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
            $result= $this->db->query($sql,__FILE__,__LINE__);
            while($row = $this->db->fetch_array($result))
            {
		   ?>
           <option value="<?php echo $row['id'];?>" <?php if($this->branchMaster('branch_tax2')==$row['id']) echo "selected=selected";?>><?php echo $row['name'];?></option>
           <?php }?>
           </select>
           <button type="button" class="btn btn-success" id="change_date" >Make Changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php
}
##############page Header######################
function pageHeader(){
?>
<header class="top-head container-fluid">
    <button type="button" class="navbar-toggle pull-left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
  

    
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set Branch</h4>
      </div>
      <div class="modal-body">
      <?php 
	  extract($_REQUEST);
	  if($submit=='saveSession')
	  $this->saveSession('server');
	  else
	  $this->saveSession('local');
	  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<ul class="list-inline top-menu navbar-left top-left-menu">
<li><span class="badge bg-warning" style="font-size:14px !important;"<strong>Current Date:</strong> <?php echo date('d-m-Y',time());?></span></li>
	<li><span class="badge bg-success" style="font-size:14px !important;"><strong>Software Date:</strong> <?php echo date('d-m-Y',strtotime($this->getSoftwareDate()))?></span></li>
   
    <li title="Click to day close.!"><a href="javascript:void(0);" style="cursor:pointer;"><span class="badge bg-inverse" style="font-size:14px !important;" id="increase_date"><i class="ion-clock"></i></span></a></li>
    
</ul>
   
    <!-- Right navbar -->
    <ul class="list-inline navbar-right top-menu top-right-menu">  
    
    <li class="dropdown ">
    <a data-toggle="dropdown" class="dropdown-toggle" style="cursor:pointer" aria-expanded="true">
        <i class="fa fa-bell-o"></i>
     <?php /*?>   <span class="badge badge-sm up bg-pink count">3</span><?php */?>
    </a>
    <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002" style="overflow: hidden; outline: none;">
   <li><p>Company: <span class="badge bg-purple"><?php echo $this->getSoftwareDetail(TBL_COMPANY,$_SESSION['company_id'],'heading');?></span></p></li>
    <li><p>Brand: <span class="badge bg-pink"><?php echo $this->getSoftwareDetail(TBL_BRAND,$_SESSION['brand_id'],'heading');?></span></p> </li>
    <li><p>Branch: <span class="badge bg-warning"><?php echo $this->getSoftwareDetail(TBL_BRANCH,$_SESSION['branch_id'],'heading');?></span></p> </li>     <li align="center"><a href="javascript:;" class="md-trigger btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Change Branch </a></li>
    </ul>
</li>
        <!-- mesages -->  
        
        <li><a href="pos_table.php" class="btn btn-info" style="padding:5px 10px;"> <i class="fa fa-shop"></i> <span>DINE</span> </a></li>
        <li><a href="all-customer.php?type=take_away" class="btn btn-success" style="padding:5px 10px; margin-left:3px;"> <i class="fa fa-shop"></i> <span>TAKE AWAY POS</span> </a></li>
        <li><a href="all-customer.php?type=home_delivery" class="btn btn-primary" style="padding:5px 10px; margin-left:3px;"> <i class="fa fa-shop"></i> <span>HOME DELIVERY POS</span> </a></li>
        <!-- /messages -->
        <!-- Notification -->
        
        <!-- /Notification -->

        <!-- user login dropdown start-->
        <li class="dropdown text-center">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="img/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                <span class="username"><?php echo $this->getUserDetail('fname')." ".$this->getUserDetail('lname');?> </span> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                <li><a href="profile.html"><i class="fa fa-briefcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>

                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->       
    </ul>
    <!-- End right navbar -->

</header>
<?php 
}
function saveSession($runat){
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
?>	
<form action="" method="post">
<div class="col-md-12">
    <div class="panel panel-default">
        
        <div class="panel-body">
            <form class="form-horizontal" role="form">
           
                <div class="form-group">
                    <label for="company_id" class="col-sm-3 control-label">Company</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="company_id" id="company_id">
                        <option value="">Select Company</option>
                        <?php 
                    $sql="select * from ".TBL_COMPANY." where 1 order by heading asc" ;
                    $result= $this->db->query($sql,__FILE__,__LINE__);
                    $x=1;
                    while($row = $this->db->fetch_array($result))
                    {
                    ?>
                    <option value="<?php echo $row['id'];?>" <?php if($_SESSION['company_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                    <?php } ?>
                    </select>
                    </div>
                </div>
             
                <div class="form-group">
                    <label for="brand_id" class="col-sm-3 control-label">Brand</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="brand_id" id="brand_id">
                        <option value="">Select Brand</option>
                    <?php 
                    $sql="select * from ".TBL_BRAND." where 1 order by heading asc" ;
                    $result= $this->db->query($sql,__FILE__,__LINE__);
                    $x=1;
                    while($row = $this->db->fetch_array($result))
                    {
                    ?>
                    <option value="<?php echo $row['id'];?>" <?php if($_SESSION['brand_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                    <?php } ?>
                    </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="branch_id" class="col-sm-3 control-label">Branch</label>
                    <div class="col-sm-9">
                     <select class="form-control" name="branch_id" id="branch_id">
                        <option value="">Select Branch</option>
                        <?php 
                    $sql="select * from ".TBL_BRANCH." where 1 order by heading asc" ;
                    $result= $this->db->query($sql,__FILE__,__LINE__);
                    $x=1;
                    while($row = $this->db->fetch_array($result))
                    {
                    ?>
                    <option value="<?php echo $row['id'];?>" <?php if($_SESSION['branch_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                    <?php } ?>
                    </select>
                    </div>
                </div>
             
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" name="submit" value="saveSession" class="btn btn-info">Save Changes</button>
                    </div>
                </div>
            </form>
        </div> <!-- panel-body -->
    </div> <!-- panel -->
</div>
</form>	
<?php	
break;
case 'server':
extract($_POST);
//if($_SESSION['company_id']==0)
$_SESSION['company_id']=$company_id;
//if($_SESSION['brand_id']==0)
$_SESSION['brand_id']=$brand_id;
//if($_SESSION['branch_id']==0)
$_SESSION['branch_id']=$branch_id;

?>

<script>
window.location="<?php echo $_SERVER['REQUEST_URI'];?>";
</script>
<?php	
}
}
function deletePage($tblname){
?>
<script type="text/javascript">
$(document).on('click','.btn_delete',function() {

								
var element = $(this);
var del_id = element.attr("id");

var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "del.php?table=<?php echo $tblname;?>",
   data: info,
   success: function(){
	   location.reload();
	   
 }
});
  $(this).parents(".tbl_row").animate({ backgroundColor: "#003" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;

});

</script>
<?php 
}
function menuItemList(){
?>
<div class="col-lg-7"> 
    <div class="panel" style="background:#CECECE;">
        <div class="panel-heading" style="border:#CECECE;"> 
		<?php 
        $sql="select * from ".TBL_CATEGORY." where 1 and brand_id='".$_SESSION['brand_id']."' order by id desc" ;
        $result= $this->db->query($sql,__FILE__,__LINE__);
        $x=1;
        while($row = $this->db->fetch_array($result))
        {
			$branch_array=explode(', ',$row['branch_id_for_pos']);
			if(in_array($_SESSION['branch_id'],$branch_array))
			{
        ?>
            <button class="btn btn-inverse m-b-5 btn_category" value="<?php echo $row['id'];?>"><?php echo $row['name'];?></button> 
          <?php } }?>
        </div> 
         
    </div>
 	<div class="panel panel-color panel-warning" style="display:none;" id="div_sub_cat">
            <div class="panel-heading" id="panel_subcategory"> 
		
            </div> 
            <div class="panel-body" id="product_grid"> 
               
            </div> 
        </div>
    <div class="tab-content"> 
    <?php 
   $sql="select * from ".TBL_CATEGORY." where 1 and brand_id='".$_SESSION['brand_id']."' order by id desc" ;
    $result= $this->db->query($sql,__FILE__,__LINE__);
    $x=1;
    while($row = $this->db->fetch_array($result))
    {
    ?>
        <div class="tab-pane" id="<?php echo $row['id'];?>"> 
		<?php
        $sql2="select * from ".TBL_SUB_CATEGORY." where 1 and category_id='".$row['id']."' order by id desc" ;
        $result2= $this->db->query($sql2,__FILE__,__LINE__);
        while($row2 = $this->db->fetch_array($result2))
        {
        ?>
            <div> 
            <div style="border-bottom:1px solid #900; background:#0F6;">
            <h4><?php echo $row2['name'];?></h4>
            </div>
			<?php
            $sql3="select * from ".TBL_PRODUCT." where 1 and  category_id='".$row['id']."' AND sub_category_id='".$row2['id']."' order by id desc" ;
            $result3= $this->db->query($sql3,__FILE__,__LINE__);
            while($row3 = $this->db->fetch_array($result3))
            {
            ?>
			<span id="<?php echo $row3['id'];?>" class="badge bg-purple span_product" style="cursor:pointer;" ><?php echo $row3['name'];?></span>
            <?php }?>
            </div> 
            <?php } ?>
        </div>
        <?php $x++;  } ?> 
    </div> 
</div>
<?php
}
function orderList($tbl_id,$bill_id){
?>
<div class="col-md-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Order List</h3>
             <button class="btn btn-icon btn-pink m-b-5  pull-right" style="margin-top:-25px;  margin-left:5px;" type="button" id="delete_temp_record" data-id="<?php echo $tbl_id;?>">Close This Bill <i class="fa fa-times"></i> </button>
             <button class="btn btn-icon btn-purple m-b-5 btnPrint2 pull-right" style="margin-top:-25px;" type="button" id="btnPrint">Print <i class="fa fa-print"></i> </button>
        </div>
        <?php
		extract($_POST);
		if($submit=='Submit')
		$this->saveOrder('server',$tbl_id,$bill_id);
		else
		$this->saveOrder('local',$tbl_id,$bill_id);
        ?>
    </div>
</div>
<?php 
}
function allTables(){
?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">All Tables</h3>
             <a href="pos_table.php?index=old_bills"  class="btn btn-pink btn-rounded m-b-5 pull-right" style="margin-top:-30px;"> <i class="fa fa-calculator" aria-hidden="true"></i> Bills Register</a>
        </div>
        <div class="panel-body">
            <div class="row">
				<?php 
                $sql="select * from ".TBL_MASTER_TABLE." where 1 and branch_id='".$_SESSION['branch_id']."' order by name asc" ;
                $result= $this->db->query($sql,__FILE__,__LINE__);
                $x=1;
                while($row = $this->db->fetch_array($result))
                {
                ?>
                <?php if($row['status']=='booked') { ?>
                <a href="pos.php?tbl_id=<?php echo $row['id'];?>" class="btn btn-success m-b-5" title="Table is booked" style="padding:30px;"><?php echo $row['name'];?></a>
                <?php } else { ?>
                <a href="pos.php?tbl_id=<?php echo $row['id'];?>" class="btn btn-purple m-b-5" title="Table is vacant" style="padding:30px;"><?php echo $row['name'];?></a>
                <?php }?>
                <?php }?>
            </div>
            
            
        </div>
    </div>
</div>
<?php 
}
function saveOrder($runat,$tbl_id,$bill_id){
switch($runat){
	case 'local':
?>
<form action="" method="post">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="table">
                        <thead>
                            <tr>
                               
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price (&#8377;)</th>
                                <th>Priority</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_pro_list">
						<?php 
                        $sql="select * from ".TBL_POS_ITEM_TEMP." where 1 and  table_id='".$tbl_id."'  order by periority asc" ;
                        $result= $this->db->query($sql,__FILE__,__LINE__);
                        $x=1;
                        while($row = $this->db->fetch_array($result))
                        {
                        ?>
                        <tr class="success tbl_row" >
                                  
                                    <td> <input type="hidden" name="pro_id[]" class="pro_id" value="<?php echo $row['item_id'];?>" /><?php echo $row['item_name'];?> <input type="hidden" name="pro_name[]" value="<?php echo $row['item_name'];?>" />
                                    <input type="hidden" name="cost_price_without_tax[]" value="<?php echo $row['selling_price_without_tax'];?>" />
                                    <input type="hidden" name="tax_slab[]" value="<?php echo $row['tax_slab'];?>" />
                                    <input type="hidden" name="tax_slab_amt[]" value="<?php echo $row['tax_slab_amt'];?>" class="tax_slab" />
                                    <input type="hidden" name="category_id[]" value="<?php echo $row['category_id'];?>" />
                                    
                                    </td>
                                    <td><i style="cursor:pointer;" title="Decrease Quantity" class="fa fa-minus-circle btn_minus" data-id="<?php echo $row['id'];?>" aria-hidden="true"></i> <?php echo $row['quantity'];?><input type="hidden" class="td_qty" id="td_qty<?php echo $x;?>" name="quantity[]" value="<?php echo $row['quantity'];?>" /> <i class="fa fa-plus-circle btn_plus" style="cursor:pointer;" title="Increase Qunatity" aria-hidden="true" data-id="<?php echo $row['id'];?>"></i></td>
                                    <td ><?php echo round($row['total_price']-$row['total_tax_slab_amt'],2);?><input type="hidden" id="td_amt2<?php echo $x;?>" class="tb_amt2" value="<?php echo $row['total_price'] ?>" name="selling_price[]" /><input type="hidden" id="td_amt<?php echo $x;?>" class="tb_amt" value="<?php echo $row['price'] ?>" name="total_price[]" />  </td>
                                    <td ><input type="number" class="td_perior" data-id="<?php echo $row['id'];?>" style="width:30px;" id="td_perior<?php echo $x;?>" value="<?php echo $row['periority'] ?>" name="periority[]" />  </td>
                                    
                                    <td>
               <a class="btn_delete btn btn-danger" id="<?php echo $row[id];?>" title="Delete" ><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <?php $x++; }?>
                        </tbody>
                        
                    </table>
                    
                </div>
               <?php 
				$sql2="select sum(quantity) as total_quantity, sum(total_price) as amt,sum(total_tax_slab_amt) as total_tax_slab from ".TBL_POS_ITEM_TEMP." where 1 and  table_id='".$tbl_id."' order by id desc" ;
				$result2= $this->db->query($sql2,__FILE__,__LINE__);
				$row2 = $this->db->fetch_array($result2);
			   ?>
               
            </div>
			<?php
            $tax_total=0;
            $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
            $result= $this->db->query($sql,__FILE__,__LINE__);
            while($row = $this->db->fetch_array($result))
            {
            
            $sql3="select sum(total_tax_slab_amt) as amt,sum(total_price) as price_sum from ".TBL_POS_ITEM_TEMP." where 1  and table_id='".$tbl_id."' and tax_slab='".$row['id']."' order by id desc" ;
            $result3= $this->db->query($sql3,__FILE__,__LINE__);
            $row3= $this->db->fetch_array($result3);
            if($row3['amt']>0)
            {
            $tax_total+=round($row3['amt'],2);
            ?>
            <div class="row">
            	<div class="col-md-6">
                	<strong><?php echo $row['name'];?></strong>
                </div>
                <div class="col-md-6 pull-right">
                	<h4 align="right"><?php echo round($row3['amt'],2);?> &#8377;</h4>
                </div>
            </div>
            <?php 
			} }?>
            <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
            <label class="btn-success">Qty:</label>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="hidden" value="<?php echo $row2['total_quantity'];?>" name="total_quantity" id="total_quantity" />
           <span id="span_total_quantity" class="badge bg-purple " ><?php echo $row2['total_quantity'];?></span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <label class="btn-success">Total:</label>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="hidden" value="<?php echo round($row2['amt'],2);?>" name="total_amount" id="total_amount" />
          <span class="badge bg-purple " id="span_total_amt"><?php echo round($row2['amt'],2);?></span> &#8377;
            </div>
            </div>
            <div class="row">
           <div class="col-md-8 col-sm-8 col-xs-12">
           		<select class="form-control select_tax" id="tax_type1"  name="tax_type1" >
                <option value="0">Select Tax :</option>
				<?php 
				 $id=$this->branchTax('branch_tax1');
                $sql="select * from ".TBL_TAX_SLAB." where 1   order by id desc" ;
                $result= $this->db->query($sql,__FILE__,__LINE__);
                $x=1;
                while($row = $this->db->fetch_array($result))
                {
                ?>
				<option value="<?php echo $row['id'];?>" data-id="<?php echo $row['percentage'];?>" <?php if($row['id']==$id) { echo "selected=selected"; $tax_per2=$row['percentage']/100 ;} ?>><?php echo $row['name'];?></option>
                <?php 
				}?>
                </select>
           </div>
           <div class="col-md-4 col-sm-4 col-xs-12">
           	<input type="text" readonly="readonly" value="<?php echo $row2['amt']*$tax_per2;?>" name="tax1" style="width:40px;" id="tax1" />
           </div>
            </div>
            <div class="row">
           <div class="col-md-8 col-sm-8 col-xs-12">
           		<select class="form-control select_tax"  id="tax_type2" name="tax_type2" >
                <option value="0">Select Tax :</option>
				<?php 
				$id2=$this->branchTax('branch_tax2');
                $sql="select * from ".TBL_TAX_SLAB." where 1  order by id desc" ;
                $result= $this->db->query($sql,__FILE__,__LINE__);
                $x=1;
                while($row = $this->db->fetch_array($result))
                {
                ?>
				<option value="<?php echo $row['id'];?>" data-id="<?php echo $row['percentage'];?>" <?php if($row['id']==$id2) { echo "selected=selected"; $tax_per1=$row['percentage']/100 ;} ?>><?php echo $row['name'];?></option>
                <?php 
				}?>
                </select>
           </div>
           <div class="col-md-4 col-sm-4 col-xs-12">
           	<input type="text" style="width:40px;" value="<?php echo $row2['amt']*$tax_per1;?>" name="tax2" readonly="readonly" id="tax2" />
           </div>
            </div>
            <div class="row">
            	<div class="col-md-8 col-sm-8 col-xs-12">
                <h4>Grand Total</h4>
                 </div>
           		<div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" readonly="readonly" id="grand_total" name="grand_total" value="<?php echo round($row2['amt'],2)+$row2['amt']*$tax_per1+$row2['amt']*$tax_per2;?>" style="width:40px;" />
                </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-pink m-b-5" id="btn_cancel_order"> Cancel </button>
            <a href="pos_table.php" class="btn btn-warning m-b-5"> Hold </a>
       <?php if($bill_id=='') { ?>
         <button type="button" class="btn btn-info m-b-5 " data-toggle="modal" id="modal_open" data-target="#PaymentModal">Payment</button>
         <?php } else { ?>
         <button class="btn btn-icon btn-purple m-b-5 btnPrint" type="button" id="btnPrint3">Print <i class="fa fa-print"></i> </button>
         <?php }?>
         <button type="button" id="generate_kot" class="btn btn-purple m-b-5">Generate KOT</button>
         <div class="modal fade" id="PaymentModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Panel</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_payment_mode">
            <div class="form-group">
             	<label for="customer_name">Customer Name</label>
               	<input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Customer Name" />    
 				</div>
                <div class="form-group">
             	<label for="customer_email">Customer Email</label>
               	<input type="text" id="customer_email" name="customer_email" class="form-control" placeholder="Customer Email"
 />    
 				</div>
                <div class="form-group">
             	<label for="customer_phone">Customer Mobile Number</label>
               	<input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Customer Mobile Number"
 />    
 				</div>
             <div class="form-group">
             	<label for="brand_id">Payment Mode</label>
                <select name="mode_of_payment" id="mode_of_payment" class="form-control">
                    <option value="">Select Payment Mode</option>
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="wallet">E-Wallet</option>
                </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_for_cash" style="display:none;">
             <div class="form-group">
             	<label for="brand_id">Enter Amount Given By Customer</label>
               	<input type="text" id="input_cash" name="cash_taken" class="form-control" placeholder="Enter Amount Given By Customer here.."
 />    
 				</div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_for_card" style="display:none;">
             <div class="form-group">
             	<label for="brand_id">Bank Name</label>
               	<input type="text" id="input_bank_name" name="bank_name" class="form-control" placeholder="Enter Bank Name.."
 />    
 </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_for_wallet" style="display:none;">
             <div class="form-group">
             	<label for="brand_id">Wallet Name</label>
               	<input type="text" id="input_wallet_name" name="wallet_name" class="form-control" placeholder="Enter Wallet Name.."
 />    	</div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_return" style="display:none;" >
             <div class="form-group">
             	
             <label class="btn-success">Return to Customer</label>
             <input type="hidden" name="cash_returned" id="hidden_cash_return" />
              <span class="badge bg-purple " id="return_to_customer"></span> &#8377;
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" value="Submit" id="confirm_payment" class="btn btn-info " >Confirm Payment</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
            </div>
            </div>
        </div>
       </form>
<?php 
	break;
	case 'server':
	extract($_POST);
	$num_of_items=sizeof($pro_id);
	$this->table_id=$tbl_id;
	$this->payment_mode=$mode_of_payment;
	if($this->payment_mode=='cash')
	{
		$this->cash_taken=$cash_taken;
		$this->cash_returned=$cash_returned;
	}
	if($this->payment_mode=='card')
	{
		$this->payment_detail=$bank_name;

	}
	if($this->payment_mode=='wallet')
	{
		$this->payment_detail=$wallet_name;

	}
	$this->total_amount=$total_amount;
	$this->total_quantity=$total_quantity;
	$this->grand_total=$grand_total;
//	echo $num_of_items;
	$return =true;
	
	if($return){
	$insert_sql_array = array();
	$insert_sql_array['table_id'] 	= $this->table_id;
	$insert_sql_array['company_id'] 	= $_SESSION['company_id'];
	$insert_sql_array['brand_id'] 	= $_SESSION['brand_id'];
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['customer_name'] 	= $customer_name;
	$insert_sql_array['customer_email'] 	= $customer_email;
	$insert_sql_array['customer_phone'] 	= $customer_phone;
	
	$insert_sql_array['payment_mode'] 	= $this->payment_mode;
	$insert_sql_array['cash_taken'] 	= $this->cash_taken;
	$insert_sql_array['cash_returned'] 	= $this->cash_returned;
	$insert_sql_array['payment_detail'] 	= $this->payment_detail;
	$insert_sql_array['total_amount'] 	= $this->grand_total;
	$insert_sql_array['total_quantity'] 	= $this->total_quantity;
	$insert_sql_array['tax1'] 	= $tax1;
	$insert_sql_array['tax2'] 	= $tax2;
	$insert_sql_array['user_id'] 	= $_SESSION['user_id'];
	$insert_sql_array['order_date'] 	= $this->getSoftwareDate();
	$this->db->insert(TBL_POS_ORDER,$insert_sql_array);
	$this->last_id=$this->db->last_insert_id();
	
	for($i=0;$i<$num_of_items;$i++){
	$insert_sql_array = array();
	$insert_sql_array['pos_order_id'] 	= $this->last_id;
	$insert_sql_array['item_id'] 	= $pro_id[$i];
	$insert_sql_array['item_name'] 	= $pro_name[$i];
	$insert_sql_array['selling_price_without_tax'] 	= $cost_price_without_tax[$i];
	$insert_sql_array['price'] 	= $total_price[$i];
	$insert_sql_array['quantity'] 	= $quantity[$i];
	$insert_sql_array['total_price'] 	= $selling_price[$i];
	$insert_sql_array['category_id'] 	= $category_id[$i];
	$insert_sql_array['tax_slab'] 	= $tax_slab[$i];
	$insert_sql_array['tax_slab_amt'] 	= $tax_slab_amt[$i];
	$insert_sql_array['order_date'] 	= $this->getSoftwareDate();
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$this->db->insert(TBL_POS_ITEM,$insert_sql_array);
	
   	$sql="select * from ".TBL_PRODUCT_INGRADIENT." where 1 and product_id='".$pro_id[$i]."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	while($row = $this->db->fetch_array($result))
	{
 	$sql2="select count(id) as num_rows, stock from ".TBL_MANAGE_STOCK." where 1 and item_id='".$row['ingradient_id']."' and branch_id='".$_SESSION['branch_id']."' " ; 
	$result2= $this->db->query($sql2,__FILE__,__LINE__);
	$row2 = $this->db->fetch_array($result2);
	
	 $stock= $row2['stock']-($this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$row['quantity']);
	if($row2['num_rows']==0)
	{
		$insert_sql_array = array();
		$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
		$insert_sql_array['item_id'] 	= $row['ingradient_id'];
		$insert_sql_array['stock'] 	= $stock;
		$insert_sql_array['cost_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'cost_price');
		$insert_sql_array['selling_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price');
		$insert_sql_array['tax1'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax1');
		$insert_sql_array['tax2'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax2');
		$insert_sql_array['tax3'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax3');
		$this->db->insert(TBL_MANAGE_STOCK,$insert_sql_array);
	}
	else
	{
		$update_sql_array = array();
		$update_sql_array['branch_id'] 	= $_SESSION['branch_id'];
		$update_sql_array['item_id'] 	= $row['ingradient_id'];
		$update_sql_array['stock'] 	=$stock;
		$update_sql_array['cost_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'cost_price');
		$update_sql_array['selling_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price');
		$update_sql_array['tax1'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax1');
		$update_sql_array['tax2'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax2');
		$update_sql_array['tax3'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax3');
		$this->db->updateByTwoIds(TBL_MANAGE_STOCK,$update_sql_array,'branch_id',$_SESSION['branch_id'],'item_id', $row['ingradient_id']);
		
	}
	$insert_sql_array = array();
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['item_id'] 	= $row['ingradient_id'];
	$insert_sql_array['stock'] 	= -$this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$quantity[$i];
	$this->db->insert(TBL_STOCK,$insert_sql_array);
	}
	
	}
	
	//$sql_delete="delete from ".TBL_POS_ITEM_TEMP." where table_id='".$tbl_id."' ";
	//$result= $this->db->query($sql_delete,__FILE__,__LINE__);
	$update_sql_array = array();
	$update_sql_array['status']='vacant';
	$this->db->update(TBL_MASTER_TABLE,$update_sql_array,'id',$tbl_id);
	$_SESSION['msg'] = 'Payment has been done successfully';
	?>
    	
	<script type="text/javascript">
	window.location = "pos.php?tbl_id=<?php echo $tbl_id;?>&bill_id=<?php echo $this->last_id;?>";
	</script>
   
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->editpage('local');
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}
function jqueryForChangeSession()
{
?>
<?php if($_SESSION['company_id']==0||$_SESSION['brand_id']==0||$_SESSION['branch_id']==0) 
{
?>
<script> $(window).load(function(){        
   $('#myModal').modal('show');
    });
</script>

<?php 
}?>
<?php
}
function modalForReceipt(){
?>
 <script> $(window).load(function(){        
   $('#receiptModel').modal('show');
    });
</script>
<?php
}

function generateReceipt($tbl_id)
{
	$sql	=	"select * from ".TBL_RECEIPT_HEADER." where   branch_id='".$_SESSION['branch_id']."' ";
	$res	=	$this->db->query($sql,__FILE__,__LINE__);
	$row	=	$this->db->fetch_array($res);
?>

<div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <table>
                <?php if($row['brnad_name']!='') { ?>
                	<tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['brand_name'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['company_name1']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['company_name1'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['company_name2']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['company_name2'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address1']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address1'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address2']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address2'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address3']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address3'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address4']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address4'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line1']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line1'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line2']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line2'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line3']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line3'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line4']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line4'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                </table>
                <table style="border-bottom:1px dashed #000;">
                <tr><td ><strong>No:</strong> <?php echo $this->getBillNumber();?></td><td ></td><td ><strong>Dt:</strong> <?php echo date('d-m-Y',strtotime($this->getSoftwareDate()));?></td></tr>
                <tr><td ><strong>Tb:</strong> <?php echo $tbl_id;?></td><td ></td><td ><strong>Px:</strong></td></tr>
                <tr><td ><strong>Wt:</strong> <?php echo $this->getUserDetail('fname')." ".$this->getUserDetail('lname');?></td><td ></td><td ><strong>Op:</strong></td></tr>
                </table>
               
                 
                    <table >
                        <thead >
                            <tr style="border-bottom:1px dashed #000;">
                                <th style="text-align:left;">Name</th>
                                <th style="text-align:center;">Quantity</th>
                                <th style="text-align:center;">Price (in Rs.)</th>
                            </tr>
                        </thead>
                        <tbody id="" >
						<?php 
						
                        	$sql="select * from ".TBL_POS_ITEM_TEMP." where 1 and  table_id='".$tbl_id."' order by id desc" ;
						
                        $result= $this->db->query($sql,__FILE__,__LINE__);
                        $x=1;
                        while($row = $this->db->fetch_array($result))
                        {
                        ?>
                        <tr class="" style=" border-bottom:1px dashed #000;" >
                                   
                                    <td style="text-align:left;"><?php echo $row['item_name'];?> </td>
                                    <td style="text-align:center;"><?php echo $row['quantity'];?></td>
                                    <td style="text-align:center;" ><?php echo round($row['total_price']-$row['total_tax_slab_amt'],2);?>   <span style="font-size:12px;"><?php echo $this->getTaxDetail($row['tax_slab'],'tax_symbol');?></span></td>
                                </tr>
                              <?php $x++; }?>
                              <tr><td colspan="3" style="background-color:#fff; height:1px;">----------------------------------------------------------------------</td></tr>
                               <?php
								$tax_total=0;
                                $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                                $result= $this->db->query($sql,__FILE__,__LINE__);
                                while($row = $this->db->fetch_array($result))
                                {
									
                                $sql3="select sum(total_tax_slab_amt) as amt,sum(total_price) as price_sum from ".TBL_POS_ITEM_TEMP." where 1  and table_id='".$tbl_id."' and tax_slab='".$row['id']."' order by id desc" ;
                                $result3= $this->db->query($sql3,__FILE__,__LINE__);
                                $row3= $this->db->fetch_array($result3);
                                if($row3['amt']>0)
								{
									$tax_total+=round($row3['amt'],2);
								?>
                                <tr>
                                	<td><?php echo $row['name'];?> :</td>
                                    <td></td>
                                    <td><?php echo round($row3['amt'],2);?></td>
                                </tr>
                                <?php } }?>
                               
								<?php 
						
							$sql2="select sum(quantity) as total_quantity,sum(total_price) as total_amount,sum(total_tax_slab_amt) as total_tax_slab from ".TBL_POS_ITEM_TEMP." where 1 and  table_id='".$tbl_id."' order by id desc" ;
						
						
                                $result2= $this->db->query($sql2,__FILE__,__LINE__);
                                $row2 = $this->db->fetch_array($result2);
                                ?>        
                                
                                <tr style="border-bottom:1px dashed #000;"><th>Total</th><th><?php echo $row2['total_quantity'];?></th><th><?php echo round($row2['total_amount'],2);?> (in Rs.)</th></tr>
                                <?php if($this->branchTax('branch_tax1')!=0) {?>
                                <tr><td><?php echo $this->getTaxDetail($this->branchTax('branch_tax1'),'name');?></td><td>&nbsp;&nbsp;&nbsp;</td><td style="text-align:center;"><?php echo $row2['total_amount']*$this->getTaxDetail($this->branchTax('branch_tax1'),'percentage')/100;?>  <?php echo $this->getTaxDetail($this->branchTax('branch_tax1'),'tax_symbol');?></td></tr>
                                <?php } ?>
                                <?php if($this->branchTax('branch_tax2')!=0) {?>
                                <tr><td><?php echo $this->getTaxDetail($this->branchTax('branch_tax2'),'name');?></td><td>&nbsp;&nbsp;&nbsp;</td><td style="text-align:center;"><?php echo $row2['total_amount']*$this->getTaxDetail($this->branchTax('branch_tax2'),'percentage')/100;?>  <?php echo $this->getTaxDetail($this->branchTax('branch_tax2'),'tax_symbol');?></td></tr>
                                <?php } ?>
                                  <tr style="border-bottom:1px dashed #000;"><th>Grand Total:</th><td>&nbsp;&nbsp;</td><th style="text-align:center;"><?php echo round($row2['total_amount'],2)+$row2['total_amount']*$this->getTaxDetail($this->branchTax('branch_tax2'),'percentage')/100+$row2['total_amount']*$this->getTaxDetail($this->branchTax('branch_tax1'),'percentage')/100;?> (in Rs.)</th></tr>
                                  <tr><td colspan="3"><hr /></td></tr>
                                  
                                 
                              
                               
                        </tbody>
                    </table>
                    <table style="border-bottom:1px solid #000;">
                    <thead>
                    <tr>
                    	<th>Tax-Type</th>
                        <th>Taxable</th>
                        <th>Tax-Amt</th>
                        <th>Net-Amt</th>
                        
                    </tr>
                    </thead>
                    	
                                  
                                <?php
								$tax_total=0;
                                $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                                $result= $this->db->query($sql,__FILE__,__LINE__);
                                while($row = $this->db->fetch_array($result))
                                {
									
                                $sql3="select sum(total_tax_slab_amt) as amt,sum(total_price) as price_sum from ".TBL_POS_ITEM_TEMP." where 1  and table_id='".$tbl_id."' and tax_slab='".$row['id']."' order by id desc" ;
                                $result3= $this->db->query($sql3,__FILE__,__LINE__);
                                $row3= $this->db->fetch_array($result3);
                                if($row3['amt']>0)
								{
									$tax_total+=round($row3['amt'],2);
								?>
                                 <tr>
                                 	<td align="left"> <?php echo $row['name'];?> </td>
                                    <td><?php echo round($row3['price_sum']-$row3['amt'],2);?></td>
                                    <td><?php echo round($row3['amt'],2);?></td>
                                    <td><?php echo $row3['price_sum'];?>  <span style="font-size:12px;"><?php echo $this->getTaxDetail($row['id'],'tax_symbol');?></span></td>
                                  </tr>
                                    <?php
								}
                               
                                }
                                ?>
                               <tr>
                               	<td colspan="2">Total Tax</td>
                                <td colspan="2"><?php echo $tax_total;?>
                               </tr>
                                 
                             
                            
                    </table>
                    <table style="border-top:1px solid #ccc; border-bottom:1px dashed #000;">
                    <thead>
                    <tr>
                    	<th>GST%</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>IGST</th>
                        <th>Total</th>
                        
                    </tr>
                    </thead>
                    	
                                  
                                <?php
								$tax_total=0;
                                $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                                $result= $this->db->query($sql,__FILE__,__LINE__);
                                while($row = $this->db->fetch_array($result))
                                {
									
                                $sql3="select sum(total_tax_slab_amt) as amt,sum(total_price) as price_sum,tax_slab,sum(selling_price_without_tax) as price_without_tax from ".TBL_POS_ITEM_TEMP." where 1  and table_id='".$tbl_id."' and tax_slab='".$row['id']."' order by id desc" ;
                                $result3= $this->db->query($sql3,__FILE__,__LINE__);
                                $row3= $this->db->fetch_array($result3);
                                if($row3['amt']>0)
								{
									$tax_total+=round($row3['amt'],2);
									
								?>
                                
                                 <tr>
                                 	<td align="left"> <?php echo str_replace('GST-','',$row['name']);?> </td>
                                    <td><?php echo round($row3['price_without_tax']*$this->getTaxDetail($row3['tax_slab'],'cgst')/100,2);?></td>
                                    <td><?php echo round($row3['price_without_tax']*$this->getTaxDetail($row3['tax_slab'],'sgst')/100,2);?></td>
                                   <td><?php echo round($row3['price_without_tax']*$this->getTaxDetail($row3['tax_slab'],'igst')/100,2);?></td>
                                   <td><?php echo round($row3['amt'],2);?> <span style="font-size:12px;"><?php echo $this->getTaxDetail($row3['tax_slab'],'tax_symbol');?></span></td>
                                  </tr>
                                    <?php
									
								}
                               
                                }
                                ?>
                               
                    </table>
                	<table style="border-bottom:1px dashed #000; text-align:center;">
                     <tr><td colspan="4"><strong>*****Thank You!!*****<br />
                     ***Visit Again***</strong></td></tr>
                    </table>
                    
                </div>
              
               
            </div>
            
            
        </div>
<?php 
}
function oldKots($tbl_id){
	
	$sql4="select * from ".TBL_MANAGE_PRINTER." where 1 and branch_id='".$_SESSION['branch_id']."' order by id asc " ;
    $result4= $this->db->query($sql4,__FILE__,__LINE__);
	while($row4	=	$this->db->fetch_array($result4))
	{
		$category=explode(', ',$row4['category']);
?>
 <button class="btn btn-inverse btn-custom m-b-5 btn_change_print_status" data-id="<?php echo $row4['id'];?>"  type="button" id="<?php echo $btn_id='btn1_'.$row4['id'];?>" >
   <div id="div1_<?php echo $row4['id'];?>">
   
   <table class="table">
   
    <thead>
     <tr><td colspan="2" style="text-align:center;"><?php echo $row4['printer_name'];?></td></tr>
    <tr><td colspan="2" style="text-align:center;"><?php echo $this->getSoftwareDetail(TBL_MASTER_TABLE,$tbl_id,'name');?></td></tr>
    <tr><td colspan="2" style="text-align:center;"><strong>Date:</strong> <?php echo date('d M-Y',time());?></td></tr>
        <tr>
            <th>Item</th>
            <th>Qty</th>
           
        </tr>
    </thead>
    <tbody  class="tr_item">
    <?php 
	$y=0;
	$check=array();
	foreach($category as $cat_id) {
	$sql6="select * from ".TBL_KOT." where 1   and category_id='".$cat_id."' and branch_id='".$_SESSION['branch_id']."' and is_print_kot='yes'  " ;
    $result6= $this->db->query($sql6,__FILE__,__LINE__);
	
    while($row6	=	$this->db->fetch_array($result6))
	{
     $sql5="select * from ".TBL_KOT_ITEM." where 1  and kot_id='".$row6['id']."'  " ;
    $result5= $this->db->query($sql5,__FILE__,__LINE__);
	
    while($row5	=	$this->db->fetch_array($result5))
    {
    ?>
    <tr class="">
        <td><?php echo $row5['product_name'];?> </td>
        <td><?php echo $row5['quantity'];?></td>
     <input type="button" onclick="window.print()" value="Print" /></i></a>   </tr>
     <?php  
	$y++;
	 }
	}
	} 
	
	
	if($y==0){
	$check[]=$btn_id;
	
	}
	
	
	?>
                  
            
    </tbody>
    
</table>
</div> </button>
<script type="text/javascript">

$(document).on('click','#<?php echo $btn_id='btn1_'.$row4['id'];?>',function() {

        var contents = $("#div1_<?php echo $row4['id'];?>").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc=frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Kot Receipt</title>');
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
<?php 
foreach($check as $chk)
{
	?>
	$('#<?php echo $chk;?>').hide();
	<?php	
}
?>
</script>
<?php	
		}
}

function newKots($tbl_id){
	$sql4="select * from ".TBL_MANAGE_PRINTER." where 1 and branch_id='".$_SESSION['branch_id']."' order by id asc " ;
    $result4= $this->db->query($sql4,__FILE__,__LINE__);
	while($row4	=	$this->db->fetch_array($result4))
	{
		$category=explode(', ',$row4['category']);
?>
 <button class="btn btn-primary btn-custom m-b-5 btn_change_print_status" data-id="<?php echo $row4['id'];?>"  type="button" id="<?php echo $btn_id='btn_'.$row4['id'];?>" >
   <div id="div_<?php echo $row4['id'];?>">
   
   <table class="table">
   
    <thead>
     <tr><td colspan="2" style="text-align:center;"><?php echo $row4['printer_name'];?></td></tr>
    <tr><td colspan="2" style="text-align:center;"><?php echo $this->getSoftwareDetail(TBL_MASTER_TABLE,$tbl_id,'name');?></td></tr>
    <tr><td colspan="2" style="text-align:center;"><strong>Date:</strong> <?php echo date('d M-Y',time());?></td></tr>
        <tr>
            <th>Item</th>
            <th>Qty</th>
           
        </tr>
    </thead>
    <tbody class="tr_item">
    <?php 
	$y=0;
	$check=array();
	foreach($category as $cat_id) {
	$sql6="select * from ".TBL_KOT." where 1   and category_id='".$cat_id."' and branch_id='".$_SESSION['branch_id']."' and is_print_kot='no'  " ;
    $result6= $this->db->query($sql6,__FILE__,__LINE__);
    while($row6	=	$this->db->fetch_array($result6))
	{
     $sql5="select * from ".TBL_KOT_ITEM." where 1  and kot_id='".$row6['id']."'  " ;
    $result5= $this->db->query($sql5,__FILE__,__LINE__);
    while($row5	=	$this->db->fetch_array($result5))
    {
    ?>
    <tr class="">
               
                <td><?php echo $row5['product_name'];?> </td>
                <td><?php echo $row5['quantity'];?></td>
                
            </tr>
     <?php
	 $y++;
	 }
	}
	}
	
	if($y==0){
	$check[]=$btn_id;
	
	}
	?>
                  
            
    </tbody>
    
</table>
</div> </button>
<script type="text/javascript">

$(document).on('click','#<?php echo $btn_id='btn_'.$row4['id'];?>',function() {

        var contents = $("#div_<?php echo $row4['id'];?>").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Kot Receipt</title>');
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
<?php 
foreach($check as $chk)
{
	?>
	$('#<?php echo $chk;?>').hide();
	<?php	
}
?>
</script>
<?php	

}
}

function old_bills()
{
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Bill Register</h3>
               <a href="pos_table.php"  class="btn btn-purple btn-rounded m-b-5 pull-right" style="margin-top:-30px;"> <i class="fa fa-arrow-left" aria-hidden="true"></i> All Tables</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Table</th>
                                    <th>Total quantity</th>
                                    <th>Total Amount</th>
                                    <th>Payment Mode</th>
				    <th>Bill Date</th>
				       <th>Transaction Date</th>
                                    <th>Branch name</th>
                                    <th>Cashier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_POS_ORDER." where 1 and branch_id='".$_SESSION['branch_id']."' order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $this->getSoftwareDetail(TBL_MASTER_TABLE,$row['table_id'],'name');?></td>
                                    <td><?php echo $row['total_quantity'];?></td>
                                    <td><?php echo $row['total_amount'];?></td>
                                    <td><?php echo $row['payment_mode'];?></td>
			  	   <td><?php echo date('d-m-Y',strtotime($row['timestamp']));?></td>
                                   <td><?php echo date('d-m-Y',strtotime($row['timestamp']));?></td>
                                   <td><?php echo $row['branch_id'];?></td>
                                   <td><?php echo $this->getUserDetailById($row['user_id'],'fname');?></td>
                                                                       <td>
                                        <?php /*?>       <a class="btnPrint"  title="Print" rel="tooltip" data-placement="top"><i class="fa fa-print"></i></a> | <?php */?>
              
               <a class="btn_delete" id="<?php echo $row[id];?>" ><i class="fa fa-ban"></i></a>  
               <input type="button" onclick="window.print()" value="Print" /></i></a>  
               </td>
              
                                </tr>
                             <?php $x++; }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
function deleteOrder($tbl_id){
$sql="delete from ".TBL_POS_ITEM_TEMP." where table_id='".$tbl_id."' "	;
$result= $this->db->query($sql,__FILE__,__LINE__);
?>
<script>
window.location="pos_table.php";
</script>
<?php	
}
}
?>

