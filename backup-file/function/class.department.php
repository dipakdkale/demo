<?php 

class Department{
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
                <h3 class="panel-title">All Department</h3>
                 <a href="manage_department.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Department</a>
            </div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dialogo-destinos">
  Launch Modal
</button>
            <div class="panel-body">
                <div class="row">
                   <div class="col-md-12">
  		      <table id="tabla-datos-destinos" class="bootstrap-table table table-striped table-hover"
                data-pagination="true" data-search="true" data-show-header="true"
                data-show-columns="true" data-show-refresh="true" data-toolbar="#custom-toolbar"
                data-show-toggle="true" data-show-export="true">
           <thead>
                                <tr>
 				     <th data-field="#" data-sortable="true">Sr No</th>
                                    <th data-field="branch" data-sortable="true">Branch Name</th>
                                    <th data-field="department" data-sortable="true">Department Name</th>
                                    <th data-field="phone" data-sortable="true">Phone</th>
                                    <th data-field="address" data-sortable="true">Address</th>
                                    <th data-field="operate" data-formatter="operateFormatter" data-events="operateEventsDestinos">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 		
                           $sql="select * from ".tbl_department." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                      <td><?php echo $row['branch_id'];?></td>
                                    <td><?php echo $row['heading'];?></td>
                                    <td><?php echo $row['phone'];?></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td>
               <a href="manage_department.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
               |<a class="btn_delete" id="<?php echo $row[id];?>" ><i class="fa fa-ban"></i></a>  
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Branch-Department</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="form-group">
                            <label for="company_id">Company Name</label>
                            <select class="form-control" name="company_id" id="company_id">
                            	<option value="">Select Company</option>
                                <?php 
                            $sql="select * from ".TBL_COMPANY." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="brand_id">Brand Name</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                            	<option value="">Select Brand</option>
                                <?php 
                            $sql="select * from ".TBL_BRAND." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                       <div class="form-group">
                            <label for="branch_id">Branch Name</label>
                            <select class="form-control" name="branch_id" id="branch_id">
                            	<option value="">Select Branch</option>
                                <?php 
                            $sql="select * from ".TBL_BRANCH." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                       
                        <div class="form-group">
                            <label for="heading",label for="supplier_id">Department Name</label>
                            <input type="text" required class="form-control" name="heading" id="heading" placeholder="Department Name">
                        </div>
                        </select>
                            </div>
                    	<div class="col-md-3">
                           <div class="form-group">
                            <label for="supplier_type">Supplier Type</label>
                              <select class="form-control" id="supplier_type" name="supplier_type">               
                                <option value="Internal">Internal</option>
                           </select>
                        </div>
                     
                            </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" required class="form-control" name="phone" id="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" required class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" required class="form-control" name="address" id="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="gst_number">GST Number</label>
                            <input type="text" required class="form-control" name="gst_number" id="gst_number" placeholder="GST Number">
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
							$this->heading=$heading;
							$this->company_id=$company_id;
							$this->brand_id=$brand_id;
							$this->branch_id=$branch_id;
							$this->email=$email;
							$this->supplier_type=$supplier_type;
							$this->supplier_id=$supplier_id;
							$this->phone=$phone;
							$this->address=$address;
							$this->gst_number=$gst_number;
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Company Name')==false)
							$return =false;
							if($return){
							$insert_sql_array = array();
							$insert_sql_array['company_id'] 	= $this->company_id;
							$insert_sql_array['brand_id'] 	= $this->brand_id;
							$insert_sql_array['branch_id'] 	= $this->branch_id;
							$insert_sql_array['supplier_type'] 	= $this->supplier_type;
							$insert_sql_array['supplier_id'] 	= $this->supplier_id;
							$insert_sql_array['heading'] 	= $this->heading;
							$insert_sql_array['email'] 	= $this->email;
							$insert_sql_array['phone'] 	= $this->phone;
							$insert_sql_array['address'] 	= $this->address;
							$insert_sql_array['gst_number'] 	= $this->gst_number;
							$this->db->insert(tbl_department,$insert_sql_array);
							$_SESSION['msg'] = 'DEPARTMENT has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "manage_department.php?index=all";
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
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
$sql	=	"select * from ".tbl_department." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Department</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="form-group">
                            <label for="company_id">Company Name</label>
                            <select class="form-control" name="company_id" id="company_id">
                            	<option value="">Select Company</option>
                                <?php 
                            $sql1="select * from ".TBL_COMPANY." where 1 order by id desc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row['company_id']==$row1['id']) echo "selected=selected";?> ><?php echo $row1['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="brand_id">Brand Name</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                            	<option value="">Select Brand</option>
                                <?php 
                            $sql2="select * from ".TBL_BRAND." where 1 order by id desc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {
                            ?>
                            <option value="<?php echo $row2['id'];?>" <?php if($row['brand_id']==$row2['id']) echo "selected=selected";?>><?php echo $row2['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="branch_id">Branch Name</label>
                            <select class="form-control" name="branch_id" id="branch_id">
                            	<option value="">Select Branch</option>
                                <?php 
                            $sql2="select * from ".TBL_BRANCH." where 1 order by id desc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {
                            ?>
                            <option value="<?php echo $row2['id'];?>" <?php if($row['branch_id']==$row2['id']) echo "selected=selected";?>><?php echo $row2['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="heading">Department Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['heading'];?>" name="heading" id="heading" placeholder="Department Name">
                        </div>
                       
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" required class="form-control" value="<?php echo $row['phone'];?>"  name="phone" id="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" required class="form-control" value="<?php echo $row['email'];?>"  name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" required class="form-control" value="<?php echo $row['address'];?>"  name="address" id="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="gst_number">GST Number</label>
                            <input type="text" required class="form-control" value="<?php echo $row['gst_number'];?>" name="gst_number" id="gst_number" placeholder="GST Number">
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
	$this->heading=$heading;
	$this->company_id=$company_id;
	$this->brand_id=$brand_id;
	$this->branch_id=$branch_id;
	$this->email=$email;
	$this->phone=$phone;
	$this->address=$address;
	$this->gst_number=$gst_number;
	$return =true;
	if($this->Form->ValidField($heading,'empty','Please Enter Company Name')==false)
	$return =false;
	if($return){
	$update_sql_array = array();
	$update_sql_array['company_id'] 	= $this->company_id;
	$update_sql_array['heading'] 	= $this->heading;
	$update_sql_array['brand_id'] 	= $this->brand_id;
	$update_sql_array['branch_id'] 	= $this->branch_id;
	$update_sql_array['email'] 	= $this->email;
	$update_sql_array['phone'] 	= $this->phone;
	$update_sql_array['address'] 	= $this->address;
	$update_sql_array['gst_number'] 	= $this->gst_number;
	$this->db->update(tbl_department,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Department has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_department.php?index=all";
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
	
	
};
?>