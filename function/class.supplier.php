<?php 

class Supplier{
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
	}
############### All Page ######################
	function allpage(){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Suppliers</h3>
                 <a href="manage_supplier.php?index=addpage" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Supplier</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Supplier Type</th>
                                    <th>Branch</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>GST Number</th>
                                    <th>VAT Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_SUPPLIER." where 1 and company_id='".$_SESSION['company_id']."'  order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['supplier_type'];?></td>
                                    <td><?php echo $row['branch_id'];?></td>
                                    <td><?php echo $row['department_id'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['phone'];?></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td><?php echo $row['gst_number'];?></td>
                                    <td><?php echo $row['vat_number'];?></td>
                                    <td>
               <a href="manage_supplier.php?index=editpage&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
               |<a href="manage_supplier.php?index=editpage&id=<?php echo $row['id'];?> class="btn_delete" id="<?php echo $row['id'];?>" ><i class="fa fa-ban"></i></a>  </td>
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
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Supplier</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="form-group">
                            <label for="supplier_type">Supplier Type</label>
                            <select class="form-control" id="supplier_type" name="supplier_type">
                            	<option value="">Select Supplier Type</option>
                                <option value="Internal">Internal</option>
                                <option value="External">External</option>
                            </select>
                        </div>
                            <div class="form-group">
                        
                            <label for="branch_id">Select Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id">
                            	<option value="">Select Branch</option>
                                <?php 
                            $sql1="select * from ".TBL_BRANCH." where 1 order by id desc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row['branch_id']==$row1['id']) echo "selected=selected";?>><?php echo $row1['heading'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                            <div class="form-group">
                        
                                                
                        <label for="department_id">Department Name</label>
                       <select class="form-control" name="department_id" id="department_id">
                            	<option value="">Select Department</option>
                                <?php 
                            $sql="select * from ".TBL_DEPARTMENT." where 1 and branch_id='".$_SESSION['branch_id']."'  order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['department_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                            <?php } ?>
                            
                            </select>
                            </div>
                           
                         </div> 
                        <div class="form-group">
                        
                            <label for="name">Name</label>
                            <input type="text" required class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" required class="form-control" name="phone" id="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" required class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text"  class="form-control" name="address" id="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="gst_number">GST Number</label>
                            <input type="text" required class="form-control" name="gst_number" id="gst_number" placeholder="GST Number">
                        </div>
                        <div class="form-group">
                            <label for="vat_number">VAT Number</label>
                            <input type="text" required class="form-control" name="vat_number" id="vat_number" placeholder="VAT Number">
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
							
							$this->name=$name;
							if($supplier_type=='Internal')
							{
							$this->name=$department_id;
							}
							else
							{
								$this->department_id=0;
							}
						$return =true;
							$this->email=$email;
							$this->phone=$phone;
							$this->address=$address;
							$this->gst_number=$gst_number;
							$this->vat_number=$vat_number;
							$this->supplier_type=$supplier_type;
						
							if($supplier_type=='Internal')
							{
							$this->department_id=$department_id;
							}
							else
							{
								$this->department_id=0;
							}
						$return =true;
						$this->supplier_type=$supplier_type;
						if($supplier_type=='Internal')
							{
								$this->branch_id=$branch_id;
					
							}
							else
							{
								$this->branch_id=0;
							}
						$return =true;
						$this->supplier_type=$supplier_type;
						
							if($supplier_type=='Internal')
							{
							$this->department_id=$department_id;
							}
							else
							{
								$this->department_id=0;
							}
						$return =true;
						
						if($this->Form->ValidField($name,'empty','Please Enter Name')==false)
							$return =false;
							if($this->Form->ValidField($gst_number,'empty','Please Enter GST Number')==false)
							$return =false;
							if($this->Form->ValidField($email,'empty','Please Enter Email')==false)
							$return =false;
							if($this->Form->ValidField($phone,'empty','Please Enter Phone')==false)
							$return =false;
							
							if($this->Form->ValidField($supplier_type,'empty','Please Select Supplier Type')==false)
							$return =false;
							if($return){
							$insert_sql_array = array();
							$insert_sql_array['name'] 	= $this->name;
							$insert_sql_array['branch_id'] 	= $this->branch_id;
							$insert_sql_array['department_id'] 	= $this->department_id;
							$insert_sql_array['company_id'] 	= $_SESSION['company_id'];
							$insert_sql_array['email'] 	= $this->email;
							$insert_sql_array['phone'] 	= $this->phone;
							$insert_sql_array['address'] 	= $this->address;
							$insert_sql_array['gst_number'] 	= $this->gst_number;
							$insert_sql_array['vat_number'] 	= $this->vat_number;
							$insert_sql_array['supplier_type'] 	= $this->supplier_type;
							$this->db->insert(TBL_SUPPLIER,$insert_sql_array);
							$_SESSION['msg'] = 'Supplier has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "manage_supplier.php?index=all";
							</script>
							<?php
							exit();
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->addpage('local');
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
$sql	=	"select * from ".TBL_SUPPLIER." where id=".id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Supplier</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="form-group">
                            <label for="supplier_type">Supplier Type</label>
                            <select class="form-control" name="supplier_type" id="supplier_type">
                            	<option value="">Select Supplier Type</option>
                                <option value="Internal" <?php if($row['supplier_type']=='Internal') echo "selected=selected";?>>Internal</option>
                                <option value="External" <?php if($row['supplier_type']=='External') echo "selected=selected";?>>External</option>
                            </select>
                        </div>
                        <div class="form-group" <?php echo $row['branch_id']=='0'?'style="display:none;"':'style="display:block;"';?> id="div_branch">
                        <div class="form-group" <?php echo $row['department_id']=='0'?'style="display:none;"':'style="display:block;"';?> id="div_department">
                            <label for="branch_id">Select Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id">
                            	<option value="">Select Branch</option>
                                <?php 
                            $sql1="select * from ".TBL_BRANCH." where 1 order by id desc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row['branch_id']==$row1['id']) echo "selected=selected";?> ><?php echo $row1['heading'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                                                
                        <label for="department_id">Department Name</label>
                       <select class="form-control" name="department_id" id="department_id">
                            	<option value="">Select Department</option>
                                <?php 
                            $sql="select * from ".tbl_department." where 1 and branch_id='".$_SESSION['branch_id']."'  order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['department_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                            <?php } ?>
                            
                            </select>
                            </div>
                           
                         </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['name'];?>" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" required class="form-control" value="<?php echo $row['phone'];?>" name="phone" id="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" required class="form-control" value="<?php echo $row['email'];?>" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text"  class="form-control" name="address" value="<?php echo $row['address'];?>" id="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="gst_number">GST Number</label>
                            <input type="text" required class="form-control" value="<?php echo $row['gst_number'];?>" name="gst_number" id="gst_number" placeholder="GST Number">
                        </div>
                        <div class="form-group">
                            <label for="vat_number">VAT Number</label>
                            <input type="text" required class="form-control" value="<?php echo $row['vat_number'];?>" name="vat_number" id="vat_number" placeholder="VAT Number">
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
	$this->name=$name;
	$this->email=$email;
	$this->phone=$phone;
	$this->address=$address;
	$this->gst_number=$gst_number;
	$this->vat_number=$vat_number;
	$this->supplier_type=$supplier_type;
	
		if($supplier_type=='Internal')
		{
		$this->department_id=$department_id;
		}
		else
		{
			$this->department_id=0;
		}
	$return =true;
	$this->supplier_type=$supplier_type;
	if($supplier_type=='Internal')
		{
			$this->branch_id=$branch_id;

		}
		else
		{
			$this->branch_id=0;
		}
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Name')==false)
	$return =false;
	if($this->Form->ValidField($supplier_type,'empty','Please Select Supplier Type ')==false)
	$return =false;
	if($this->Form->ValidField($gst_number,'empty','Please Enter GST Number')==false)
	$return =false;
	if($this->Form->ValidField($email,'empty','Please Enter Email')==false)
	$return =false;
	if($this->Form->ValidField($phone,'empty','Please Enter Phone')==false)
	$return =false;
	if($return){
	$update_sql_array = array();
	$update_sql_array['name'] 	= $this->name;
	$update_sql_array['email'] 	= $this->email;
	$update_sql_array['phone'] 	= $this->phone;
	$update_sql_array['address'] 	= $this->address;
	$update_sql_array['gst_number'] 	= $this->gst_number;
	$update_sql_array['vat_number'] 	= $this->vat_number;
	$update_sql_array['supplier_type'] 	= $this->supplier_type;
	$update_sql_array['branch_id'] 	= $this->branch_id;
	$update_sql_array['department_id'] 	= $this->department_id;
	$update_sql_array['company_id'] 	= $_SESSION['company_id'];
	$this->db->update(TBL_SUPPLIER,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Supplier has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_supplier.php?index=all";
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