<?php 

class ManageReceipt{
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
	}
	################ All Page ######################
	function allpage(){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Companies</h3>
                 <a href="manage_receipt.php?index=addpage" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Company</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_COMPANY." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['heading'];?></td>
                                    <td>
               <a href="manage_receipt.php?index=editpage&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
               |<a class="btn_delete" id="<?php echo $row['id'];?>" ><i class="fa fa-ban"></i></a>  </td>
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

function addpage($runat){
		switch($runat){
			case 'local':
						$FormName = "frm_addpage";
						$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
						 );
						$ValidationFunctionName="CheckaddpageValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
						echo $JsCodeForFormValidation;
						?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Company</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="heading">Brand Name</label>
                            <input type="text" required class="form-control" name="brnad_name" id="heading" placeholder="Brand Name">
                            <label for="company_name">Company Name</label>
                            <input type="text" required class="form-control" name="company_name1" id="compant_name" placeholder="Company Name">
                             <label for="company_name">Company Name</label>
                            <input type="text" required class="form-control" name="company_name2" id="compant_name" placeholder="Company Name">
                            <label for="address1">Address</label>
                            <input type="text" name="address1" class="form-control" id="address1" placeholder="Address" />
                            <label for="address2">Address</label>
                            <input type="text" name="address2" class="form-control" id="address2" placeholder="Address" />
                            <label for="address3">Address</label>
                            <input type="text" name="address3" class="form-control" id="address3" placeholder="Address" />
							<label for="line1">Line 1</label>
                            <input type="text" required class="form-control" name="line1" id="line1" placeholder="Line 1">
                            <label for="line2">Line 2</label>
                            <input type="text" required class="form-control" name="line2" id="line2" placeholder="Line 2">
                            <label for="line3">Line 3</label>
                            <input type="text" required class="form-control" name="line3" id="line3" placeholder="Line 3">
                            <label for="line4">Line 4</label>
                            <input type="text" required class="form-control" name="line4" id="line4" placeholder="Line 4">
                        </div>
                        <button type="submit" name="submit" value="Submit" class="btn btn-purple">Submit</button>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-->
    </div> <!-- End row -->
</div>     
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							$this->brand_name=$brand_name;
							$this->company_name1=$company_name1;
							$this->company_name2=$company_name2;
							$this->address1=$address1;
							$this->address2=$address2;
							$this->address3=$address3;
							$this->line1=$line1;
							$this->line2=$line2;
							$this->line3=$line3;
							$this->line4=$line4;
							$return =true;
							if($this->Form->ValidField($brand_name,'empty','Please Enter Brand Name')==false)
							$return =false;
							$return =true;
							if($this->Form->ValidField($company_name1,'empty','Please Enter Company Name')==false)
							$return =false;
							$return =true;
							if($this->Form->ValidField($address1,'empty','Please Enter Address Name')==false)
							$return =false;
							if($return){
							$insert_sql_array = array();
							$insert_sql_array['brand_name'] 	= $this->brand_name;
							$insert_sql_array['company_name1'] 	= $this->company_name1;
							$insert_sql_array['company_name2'] 	= $this->company_name2;
							$insert_sql_array['address1'] 	= $this->address1;
							$insert_sql_array['address2'] 	= $this->address2;
							$insert_sql_array['address3'] 	= $this->address3;
							$insert_sql_array['line1'] 	= $this->line1;
							$insert_sql_array['line2'] 	= $this->line2;
							$insert_sql_array['line3'] 	= $this->line3;
							$insert_sql_array['line4'] 	= $this->line4;
							$this->db->insert(TBL_RECEIPT_HEADER,$insert_sql_array);
							$_SESSION['msg'] = 'Receipt header has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "manage_receipt.php?index=all";
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
function editpage($runat,$id){
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
echo $JsCodeForFormValidation;
$sql	=	"select * from ".TBL_RECEIPT_HEADER." where   branch_id='".$_SESSION['branch_id']."' ";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Receipt Header</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="heading">Brand Name</label>
                            <input type="text" required class="form-control" name="brand_name" value="<?php echo $row['brand_name'];?>" id="heading" placeholder="Brand Name">
                            <label for="company_name">Company Name</label>
                            <input type="text" required class="form-control" name="company_name1" value="<?php echo $row['company_name1'];?>" id="compant_name" placeholder="Company Name">
                             <label for="company_name">Company Name</label>
                            <input type="text" required class="form-control" name="company_name2" value="<?php echo $row['company_name2'];?>" id="compant_name" placeholder="Company Name">
                            <label for="address1">Address</label>
                            <input type="text" name="address1" class="form-control" id="address1" value="<?php echo $row['address1'];?>" placeholder="Address" />
                            <label for="address2">Address</label>
                            <input type="text" name="address2" class="form-control" id="address2" value="<?php echo $row['address2'];?>" placeholder="Address" />
                            <label for="address3">Address</label>
                            <input type="text" name="address3" class="form-control" id="address3" value="<?php echo $row['address3'];?>" placeholder="Address" />
							<label for="line1">Line 1</label>
                            <input type="text"  class="form-control" name="line1" value="<?php echo $row['line1'];?>" id="line1" placeholder="Line 1" />
                            <label for="line2">Line 2</label>
                            <input type="text"  class="form-control" name="line2" value="<?php echo $row['line2'];?>" id="line2" placeholder="Line 2" />
                            <label for="line3">Line 3</label>
                            <input type="text"  class="form-control" name="line3" value="<?php echo $row['line3'];?>" id="line3" placeholder="Line 3" />
                            <label for="line4">Line 4</label>
                            <input type="text"  class="form-control" name="line4" value="<?php echo $row['line4'];?>" id="line4" placeholder="Line 4" />
                        </div>
                        <button type="submit" name="submit" value="Submit" class="btn btn-purple">Submit</button>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-->
    </div> <!-- End row -->
</div>     
						<?php 
					
	break;
	case 'server':
	extract($_POST);
	$this->brand_name=$brand_name;
	$this->company_name1=$company_name1;
	$this->company_name2=$company_name2;
	$this->address1=$address1;
	$this->address2=$address2;
	$this->address3=$address3;
	$this->line1=$line1;
	$this->line2=$line2;
	$this->line3=$line3;
	$this->line4=$line4;
	$return =true;
	if($this->Form->ValidField($brand_name,'empty','Please Enter Brand Name')==false)
	$return =false;
	$return =true;
	if($this->Form->ValidField($company_name1,'empty','Please Enter Company Name')==false)
	$return =false;
	$return =true;
	if($this->Form->ValidField($address1,'empty','Please Enter Address Name')==false)
	$return =false;
	if($return){
	
	$sql="select * from ".TBL_RECEIPT_HEADER." where 1 and branch_id='".$_SESSION['branch_id']."' order by id desc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$rows = $this->db->num_rows($result);
	if($rows==0){
		$insert_sql_array = array();
		$insert_sql_array['brand_name'] 	= $this->brand_name;
		$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
		$insert_sql_array['company_name1'] 	= $this->company_name1;
		$insert_sql_array['company_name2'] 	= $this->company_name2;
		$insert_sql_array['address1'] 	= $this->address1;
		$insert_sql_array['address2'] 	= $this->address2;
		$insert_sql_array['address3'] 	= $this->address3;
		$insert_sql_array['line1'] 	= $this->line1;
		$insert_sql_array['line2'] 	= $this->line2;
		$insert_sql_array['line3'] 	= $this->line3;
		$insert_sql_array['line4'] 	= $this->line4;
		$this->db->insert(TBL_RECEIPT_HEADER,$insert_sql_array);
	}
	else
	{
		$update_sql_array = array();
		//$update_sql_array['heading'] 	= $this->heading;
		$update_sql_array['brand_name'] 	= $this->brand_name;
		$update_sql_array['company_name1'] 	= $this->company_name1;
		$update_sql_array['company_name2'] 	= $this->company_name2;
		$update_sql_array['address1'] 	= $this->address1;
		$update_sql_array['address2'] 	= $this->address2;
		$update_sql_array['address3'] 	= $this->address3;
		$update_sql_array['line1'] 	= $this->line1;
		$update_sql_array['line2'] 	= $this->line2;
		$update_sql_array['line3'] 	= $this->line3;
		$update_sql_array['line4'] 	= $this->line4;
		$this->db->update(TBL_RECEIPT_HEADER,$update_sql_array,'branch_id',$_SESSION['branch_id']);	
	}
	
	$_SESSION['msg'] = 'Receipt header has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_receipt.php?index=all";
	</script>
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->editpage('local',$id);
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}	
	
	
}
?>