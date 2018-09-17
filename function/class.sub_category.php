<?php 

class Sub_Category{
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
                <h3 class="panel-title">All Categories</h3>
                 <a href="manage_sub_category.php?index=addpage" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Sub Category</a>
                   <?php if($_SESSION['user_type']=='sadmin' || $_SESSION['user_type']=='admin') {?>
                  <a href="manage_sub_category.php?index=mapping" class="btn btn-warning m-b-5 pull-right" style="margin-top:-25px; margin-right:5px;">Sub-Category Branch Mapping</a>
                  <?php }?>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Name</th>
                                    <th> HSL Category Number</th>
                                    <th> Loyality Percentage (%)</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_SUB_CATEGORY." where 1  and brand_id='".$_SESSION['brand_id']."' order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['hsl_category_no'];?></td>
                                    <td><?php echo $row['loyality_percentage'];?></td>
                                    <td><?php $hide_for=explode(', ',$row['hide_for']); if(!in_array($_SESSION['branch_id'],$hide_for)) echo "Yes"; else echo "No";?><label class="switch_new" title="Make Category  Active/Inactive for Current Branch">
  <input type="checkbox" data-id="<?php echo $row['id'];?>" id="input_category_update" <?php $hide_for=explode(', ',$row['hide_for']); if(!in_array($_SESSION['branch_id'],$hide_for)) echo "checked";?> value="yes">
  <span class="slider round" style="margin-left:10px; margin-top:-15px;"></span>
</label>	</td>
                                    <td>
               <a href="manage_sub_category.php?index=editpage&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
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
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
						?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Sub Category</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="category_id">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control">
                            	<option value="">Select Category</option>
                                <?php 
                            $sql="select * from ".TBL_CATEGORY." where 1 order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                               <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option> 
                               <?php }?>
                            </select>
                           
                        </div>
                        <div class="form-group">
                            <label for="heading">Name</label>
                            <input type="text" required class="form-control" name="name" id="heading" placeholder=" Name">
                        </div>
                        <div class="form-group">
                            <label for="hsl_category_no">HSL Category Number</label>
                            <input type="text" required class="form-control" name="hsl_category_no" id="hsl_category_no" placeholder=" HSL Category Number">
                        </div>
                        <div class="form-group">
                            <label for="loyality_percentage">Loyality Percentage (%)</label>
                            <input type="text" required class="form-control" name="loyality_percentage" id="loyality_percentage" placeholder="Loyality Percentage">
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
$this->category_id=$category_id;
$this->name=$name;
$this->loyality_percentage=$loyality_percentage;
$this->hsl_category_no=$hsl_category_no;
$return =true;
if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
$return =false;
$sql	=	"select * from ".TBL_SUB_CATEGORY." where name='".$name."' and category_id='".$category_id."' and brand_id='".$_SESSION['brand_id']."' ";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->num_rows($res);
if($row==0)
{
if($return){
$insert_sql_array = array();
$insert_sql_array['name'] 	= $this->name;
$insert_sql_array['category_id'] 	= $this->category_id;
$insert_sql_array['hsl_category_no'] 	= $this->hsl_category_no;
$insert_sql_array['brand_id'] 	= $_SESSION['brand_id'];
$insert_sql_array['loyality_percentage'] 	= $this->loyality_percentage;
$this->db->insert(TBL_SUB_CATEGORY,$insert_sql_array);
$_SESSION['msg'] = 'Sub category has been added successfully.';
?>
<script type="text/javascript">
window.location = "manage_sub_category.php?index=all";
</script>
<?php
exit();
} else {
echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
$this->addpage('local');
}
}
else
{
		$_SESSION['error_msg'] = 'Sub Category already exist in database!';
		?>
	 <script type="text/javascript">
window.location = "manage_sub_category.php?index=addpage";
</script>   
 <?php
}
break;
default 	: 
echo "Wrong Parameter passed";
}
}

#### Edit page### 

function editpage($runat,$id){
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
echo $JsCodeForFormValidation;
$sql	=	"select * from ".TBL_SUB_CATEGORY." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Sub Category</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="category_id">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control">
                            	<option value="">Select Category</option>
                                <?php 
                            $sql1="select * from ".TBL_CATEGORY." where 1 order by name asc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                               <option value="<?php echo $row1['id'];?>" <?php if($row1['id']==$row['category_id']) echo "selected=selected";?>><?php echo $row1['name'];?></option> 
                               <?php }?>
                            </select>
                     
                        </div>
                        <div class="form-group">
                            <label for="heading">Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['name'];?>" name="name" id="heading" placeholder=" Name">
                        </div>
                        <div class="form-group">
                            <label for="hsl_category_no">HSL Category Number</label>
                            <input type="text" required class="form-control" name="hsl_category_no" value="<?php echo $row['hsl_category_no'];?>" id="hsl_category_no" placeholder=" HSL Category Number">
                        </div>
                        <div class="form-group">
                            <label for="loyality_percentage">Loyality Percentage (%)</label>
                            <input type="text" required class="form-control" name="loyality_percentage" value="<?php echo $row['loyality_percentage'];?>" id="loyality_percentage" placeholder="Loyality Percentage">
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
	$this->category_id=$category_id;
	$this->loyality_percentage=$loyality_percentage;
	$this->hsl_category_no=$hsl_category_no;
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
	$return =false;
	$sql	=	"select * from ".TBL_SUB_CATEGORY." where name='".$name."' and category_id='".$category_id."' and id!='".$id."' ";
	$res	=	$this->db->query($sql,__FILE__,__LINE__);
	$row	=	$this->db->num_rows($res);
	if($row==0)
	{
	if($return){
	$update_sql_array = array();
	$update_sql_array['name'] 	= $this->name;
	$update_sql_array['category_id'] 	= $this->category_id;
	$update_sql_array['loyality_percentage'] 	= $this->loyality_percentage;
	$update_sql_array['hsl_category_no'] 	= $this->hsl_category_no;
	$update_sql_array['brand_id'] 	= $_SESSION['brand_id'];
	$this->db->update(TBL_SUB_CATEGORY,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Sub category has been updated successfully.';
	?>
	<script type="text/javascript">
	window.location = "manage_sub_category.php?index=all";
	</script>
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->editpage('local',$id);
	}
	}
	else
	{
	$_SESSION['error_msg'] = 'Sub Category already exist in database!';
	?>
	<script type="text/javascript">
	window.location = "manage_sub_category.php?index=editpage&id=<?php echo $id;?>";
	</script>   
	<?php
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}	

function productBranchMapping($runat){
	
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Sub-Category Branch Mapping</h3>
                
               
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
									<?php 
                                    $sql3="select * from ".TBL_BRANCH." where 1  order by id asc" ;
                                    $result3= $this->db->query($sql3,__FILE__,__LINE__);
                                  
                                    while($row3 = $this->db->fetch_array($result3))
                                    {
                                    ?>
                                    <th><?php echo $row3['heading'];?></th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_SUB_CATEGORY." where 1  order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
								$pos=explode(', ',$row['branch_id_for_pos']);
								$invent=explode(', ',$row['branch_id_for_inventory']);
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['name'];?></td>
                                   <?php 
                                    $sql2="select * from ".TBL_BRANCH." where 1  order by id asc" ;
                                    $result2= $this->db->query($sql2,__FILE__,__LINE__);
                                    
                                    while($row2 = $this->db->fetch_array($result2))
                                    {
                                    ?>
                                    <td>
                                        <div class="checkbox">
                                        <label class="cr-styled" title="POS" style="padding-left:0px;">
                                        <input type="checkbox" class="branch_id_for_pos" name="branch_id_for_pos[]" title="POS" data-id="<?php echo $row['id'];?>" value="<?php echo $row2['id'];?>" <?php if(in_array($row2['id'],$pos)) echo "checked";?>>
                                        <i class="fa"></i> P </label>
                                        </div>
                                        <div class="checkbox" >
                                        <label class="cr-styled" title="Inventory" style="padding-left:0px;">
                                        <input type="checkbox" class="branch_id_for_inventory" title="Inventory" name="branch_id_for_inventory[]" data-id="<?php echo $row['id'];?>" value="<?php echo $row2['id'];?>" <?php if(in_array($row2['id'],$invent)) echo "checked";?>>
                                        <i class="fa"></i> I </label>
                                        </div>
                            </td>
                                    <?php }?>
                                </tr>
                             <?php $x++; }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success" name="submit" value="Submit" >Map</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
	
}
?>