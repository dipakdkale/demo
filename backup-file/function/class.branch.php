<?php 

class Branch{
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
                <h3 class="panel-title">All Branches</h3>
                 <a href="manage_branch.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Branch</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_BRANCH." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['heading'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['phone'];?></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td>
               <a href="manage_branch.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
               |<a class="btn_delete" id="<?php echo $row[id];?>" ><i class="fa fa-ban"></i></a>  </td>
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
                <div class="panel-heading"><h3 class="panel-title">Add Brand</h3></div>
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
                            <label for="heading">Branch Name</label>
                            <input type="text" required class="form-control" name="heading" id="heading" placeholder="Branch Name">
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
							$this->email=$email;
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
							$insert_sql_array['heading'] 	= $this->heading;
							$insert_sql_array['email'] 	= $this->email;
							$insert_sql_array['phone'] 	= $this->phone;
							$insert_sql_array['address'] 	= $this->address;
							$insert_sql_array['gst_number'] 	= $this->gst_number;
							$this->db->insert(TBL_BRANCH,$insert_sql_array);
							$_SESSION['msg'] = 'Branch has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "manage_branch.php?index=all";
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
$sql	=	"select * from ".TBL_BRANCH." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Brand</h3></div>
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
                            <label for="heading">Branch Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['heading'];?>" name="heading" id="heading" placeholder="Branch Name">
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
	$update_sql_array['email'] 	= $this->email;
	$update_sql_array['phone'] 	= $this->phone;
	$update_sql_array['address'] 	= $this->address;
	$update_sql_array['gst_number'] 	= $this->gst_number;
	$this->db->update(TBL_BRANCH,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Branch has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_branch.php?index=all";
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