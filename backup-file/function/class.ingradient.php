<?php 

class Ingradient{
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
	}
	function getMeasurement($id){
	$sql="select * from ".TBL_MEASUREMENT." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['name'];
	}
	function getMeasurementDetail($id,$colname){
	$sql="select * from ".TBL_MEASUREMENT." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function getMoreDetail($tbl_name,$id){
	$sql="select * from ".$tbl_name." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['name'];
	}
	function getSiteMappingDetail($item_id,$colname){
	$sql="select * from ".TBL_ITEM_SITE_MAPPING." where 1 and item_id='".$item_id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	$record=explode(', ', $row[$colname]);
	return $record;
	
	}
	function getBranchId(){
	$sql="select * from ".TBL_USER." where 1 and id='".$_SESSION['user_id']."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	$sql2="select * from ".TBL_MEMBER." where 1 and id='".$row['mem_id']."' order by id asc" ;
	$result2= $this->db->query($sql2,__FILE__,__LINE__);
	$row2 = $this->db->fetch_array($result2);
	return $row2['branch_id'];
	}
	################ All Page ######################
	function allpage(){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Items</h3>
                 <a href="manage_ingradient.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Item</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Unit</th>
                                    <th>Unit Type</th>
                                    <th>Veg/Non-veg</th>
                                    <th>Cost Price</th>
                                    <th>Selling Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_ITEMS." where 1 and branch_id='".$_SESSION['branch_id']."'  order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $this->getMoreDetail(TBL_CATEGORY,$row['category_id']);?></td>
                                    <td><?php echo $this->getMoreDetail(TBL_SUB_CATEGORY,$row['sub_category_id']);?></td>
                                    <td><?php echo $this->getMeasurement($row['measurement']);?></td>
                                    <td><?php echo $row['measurement_type'];?></td>
                                    <td><?php echo $row['veg_or_non'];?></td>
                                    <td><?php echo $row['cost_price'];?></td>
                                    <td><?php echo $row['selling_price'];?></td>
                                    <td>
                                     <a href="manage_ingradient.php?index=view&id=<?php echo $row['id'];?>" title="View Page" rel="tooltip" data-placement="top"><i class="fa fa-search"></i></a>|
               <a href="manage_ingradient.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
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
                <div class="panel-heading"><h3 class="panel-title">Add Item</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="heading">Item Name</label>
                            <input type="text"  class="form-control" name="name" id="heading" required placeholder="Item Name">
                        </div>
                        <div class="form-group">
                            <label for="unit">Measurement Unit</label>
                            <select name="measurement" required id="measurement" class="form-control">
                            	<option value="" >Select Unit</option>
                                <?php 
                            $sql="select * from ".TBL_MEASUREMENT." where 1 and is_base_unit='yes' order by name asc" ;
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
                            <label for="category_id">Category</label>
                            <select name="category_id" required id="category_id" class="form-control">
                            	<option value="" >Select Category</option>
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
                        <div class="form-group" id="div_sub_category">
                            <label for="sub_category_id">Sub Category</label>
                            <select name="sub_category_id" required id="sub_category_id" class="form-control">
                            	<option value="" >Select Sub Category</option>
                                <?php 
                            $sql="select * from ".TBL_SUB_CATEGORY." where 1 order by name asc" ;
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
                        <label class="control-label">Is Active</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio4">
                                    <input type="radio" id="example-radio4" name="is_active" value="yes"> 
                                    <i class="fa"></i>
                                    YES 
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio5">
                                    <input type="radio" id="example-radio5" name="is_active" value="no"> 
                                    <i class="fa"></i> 
                                    NO
                                </label>
                            </div>
                         
                        </div>
                        <div class="form-group">
                        <label class="control-label">Taxation</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="taxation1">
                                    <input type="radio" id="taxation1" name="is_tax" checked="checked" value="yes"> 
                                    <i class="fa"></i>
                                    With Tax 
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="div_tax1" style="display:block;">
                            <label for="tax1">Tax 1</label>
                            <select name="tax1"  id="tax1" class="form-control">
                            	
                                <?php 
                            $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group" id="div_tax2" style="display:block;">
                            <label for="tax2">Tax 2</label>
                            <select name="tax2"  id="tax2" class="form-control">
                            	
                                <?php 
                            $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group" id="div_tax3" style="display:block;">
                            <label for="tax3">Tax 3</label>
                            <select name="tax3"  id="tax3" class="form-control">
                            	
                                <?php 
                            $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
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
                        <label class="control-label">Veg/Non-Veg</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="choice1">
                                    <input type="radio" id="choice1" name="veg_or_non" value="Veg"> 
                                    <i class="fa"></i>
                                    Veg
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="choice2">
                                    <input type="radio" id="choice2" name="veg_or_non" value="Non-Veg"> 
                                    <i class="fa"></i> 
                                    Non-Veg
                                </label>
                            </div>
                         	<div class="radio-inline">
                                <label class="cr-styled" for="choice3">
                                    <input type="radio" id="choice3" name="veg_or_non" value="Not Applied"> 
                                    <i class="fa"></i>
                                    Not Applied
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cost_price">Cost Price</label>
                            <input type="text" required class="form-control" name="cost_price" id="cost_price" placeholder="Cost Price">
                        </div>
                        <div class="form-group">
                            <label for="selling_price">Selling Price</label>
                            <input type="text" required class="form-control" name="selling_price" id="selling_price" placeholder="Selling Price">
                        </div>
                        <div class="form-group">
                            <label for="shelf_life">Shelf life (In Days)</label>
                            <input type="text" required class="form-control" name="shelf_life" id="shelf_life" placeholder="Shelf life">
                        </div>
                        
                          <div class="form-group">
                            <label for="yield">Yield %</label>
                            <input type="text" required class="form-control" name="yield" id="yield" placeholder="Yield">
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
	$this->measurement=$measurement;
	$this->item_code=$name."/".$this->getMeasurement($measurement);
	$this->category_id=$category_id;
	$this->sub_category_id=$sub_category_id;
	$this->is_active=$is_active;
	$this->is_tax=$is_tax;
	$this->tax1=$tax1;
	$this->tax2=$tax2;
	$this->tax3=$tax3;
	$this->veg_or_non=$veg_or_non;
	$this->cost_price=$cost_price;
	$this->selling_price=$selling_price;
	$this->shelf_life=$shelf_life;
	$this->manufacturing_date=$manufacturing_date;
	$this->yield=$yield;
	$this->measurement_type=$this->getMeasurementDetail($this->measurement,'unit_type');
	$this->loyality_percentage=$loyality_percentage;
	$this->branch_id=$this->getBranchId();
	
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
	$return =false;
	if($return){
	$insert_sql_array = array();
	$insert_sql_array['name'] 	= $this->name;
	$insert_sql_array['item_code'] 	= $this->item_code;
	$insert_sql_array['measurement'] 	= $this->measurement;
	$insert_sql_array['measurement_type'] 	= $this->measurement_type;
	$insert_sql_array['category_id'] 	= $this->category_id;
	$insert_sql_array['sub_category_id'] 	= $this->sub_category_id;
	$insert_sql_array['is_active'] 	= $this->is_active;
	$insert_sql_array['is_tax'] 	= $this->is_tax;
	
	$insert_sql_array['tax1'] 	= $this->tax1;
	$insert_sql_array['tax2'] 	= $this->tax2;
	$insert_sql_array['tax3'] 	= $this->tax3;
	$insert_sql_array['veg_or_non'] 	= $this->veg_or_non;
	$insert_sql_array['cost_price'] 	= $this->cost_price;
	$insert_sql_array['selling_price'] 	= $this->selling_price;
	$insert_sql_array['shelf_life'] 	= $this->shelf_life;

	$insert_sql_array['yield'] 	= $this->yield;
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	
	$this->db->insert(TBL_ITEMS,$insert_sql_array);
	$_SESSION['msg'] = 'Item has been added successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_ingradient.php?index=all";
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
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
$sql	=	"select * from ".TBL_ITEMS." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Item</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="heading">Item Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['name'];?>" name="name" id="heading"  placeholder="Item Name">
                        </div>
                        <div class="form-group">
                            <label for="unit">Measurement Unit</label>
                            <select name="measurement" required id="measurement" class="form-control">
                            	<option value="" >Select Unit</option>
                                <?php 
                            $sql1="select * from ".TBL_MEASUREMENT." where 1 order by name asc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row1['id']==$row['measurement']) echo "selected=selected";?>><?php echo $row1['name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" required id="category_id" class="form-control">
                            	<option value="" >Select Category</option>
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
                        <div class="form-group" id="div_sub_category">
                            <label for="sub_category_id">Sub Category</label>
                            <select name="sub_category_id" required id="sub_category_id" class="form-control">
                            	<option value="" >Select Sub Category</option>
                                <?php 
                            $sql1="select * from ".TBL_SUB_CATEGORY." where 1 order by name asc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row1['id']==$row['sub_category_id']) echo "selected=selected";?>><?php echo $row1['name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                         <div class="form-group">
                        <label class="control-label">Is Active</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio4">
                                    <input type="radio" id="example-radio4" name="is_active" value="yes" <?php if($row['is_active']=='yes') echo 'checked';?>> 
                                    <i class="fa"></i>
                                    YES 
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio5">
                                    <input type="radio" id="example-radio5" name="is_active" value="no" <?php if($row['is_active']=='no') echo 'checked';?>> 
                                    <i class="fa"></i> 
                                    NO
                                </label>
                            </div>
                         
                        </div>
                        <div class="form-group">
                        <label class="control-label">Taxation</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="taxation1">
                                    <input type="radio" id="taxation1" name="is_tax" value="yes" <?php if($row['is_tax']=='yes') echo 'checked';?>> 
                                    <i class="fa"></i>
                                    With Tax 
                                </label>
                            </div>
                            
                         
                        </div>
                        <div class="form-group" id="div_tax1" >
                            <label for="tax1">Tax 1</label>
                            <select name="tax1"  id="tax1" class="form-control">
                            	<option value="" >Select Tax</option>
                                <?php 
                            $sql1="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row1['id']==$row['tax1']) echo "selected=selected";?>><?php echo $row1['name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group" id="div_tax2" >
                            <label for="tax2">Tax 2</label>
                            <select name="tax2"  id="tax2" class="form-control">
                            	<option value="" >Select Tax</option>
                                <?php 
                            $sql1="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row1['id']==$row['tax2']) echo "selected=selected";?>><?php echo $row1['name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group" id="div_tax3" >
                            <label for="tax3">Tax 3</label>
                            <select name="tax3"  id="tax3" class="form-control">
                            	<option value="" >Select Tax</option>
                                <?php 
                            $sql1="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row1['id']==$row['tax3']) echo "selected=selected";?>><?php echo $row1['name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label class="control-label">Veg/Non-Veg</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="choice1">
                                    <input type="radio" id="choice1" name="veg_or_non"  value="Veg" <?php if($row['veg_or_non']=='Veg') echo 'checked';?>> 
                                    <i class="fa"></i>
                                    Veg
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="choice2">
                                    <input type="radio" id="choice2" name="veg_or_non" value="Non-Veg" <?php if($row['veg_or_non']=='Non-Veg') echo 'checked';?>> 
                                    <i class="fa"></i> 
                                    Non-Veg
                                </label>
                            </div>
                         	<div class="radio-inline">
                                <label class="cr-styled" for="choice3">
                                    <input type="radio" id="choice3" name="veg_or_non" value="Not Applied" <?php if($row['veg_or_non']=='Not Applied') echo 'checked';?>> 
                                    <i class="fa"></i>
                                    Not Applied
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cost_price">Cost Price</label>
                            <input type="text" required class="form-control" value="<?php echo $row['cost_price'];?>" name="cost_price" id="cost_price" placeholder="Cost Price">
                        </div>
                        <div class="form-group">
                            <label for="selling_price">Selling Price</label>
                            <input type="text" required class="form-control" value="<?php echo $row['selling_price'];?>" name="selling_price" id="selling_price" placeholder="Selling Price">
                        </div>
                        <div class="form-group">
                            <label for="shelf_life">Shelf life (In Days)</label>
                            <input type="text" required class="form-control" value="<?php echo $row['shelf_life'];?>" name="shelf_life" id="shelf_life" placeholder="Shelf life">
                        </div>
                        
                          <div class="form-group">
                            <label for="yield">Yield %</label>
                            <input type="text" required class="form-control" value="<?php echo $row['yield'];?>" name="yield" id="yield" placeholder="Yield">
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
	$this->measurement=$measurement;
	$this->measurement_type=$this->getMeasurementDetail($this->measurement,'unit_type');
	$this->item_code=$name."/".$this->getMeasurement($measurement);
	$this->category_id=$category_id;
	$this->sub_category_id=$sub_category_id;
	$this->is_active=$is_active;
	$this->is_tax=$is_tax;
	$this->tax1=$tax1;
	$this->tax2=$tax2;
	$this->tax3=$tax3;
	$this->veg_or_non=$veg_or_non;
	$this->cost_price=$cost_price;
	$this->selling_price=$selling_price;
	$this->shelf_life=$shelf_life;
	$this->manufacturing_date=$manufacturing_date;
	$this->yield=$yield;
	$this->branch_id=$this->getBranchId();
	$this->loyality_percentage=$loyality_percentage;
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
	$return =false;
	if($return){
	$update_sql_array = array();
	$update_sql_array['name'] 	= $this->name;
	$update_sql_array['item_code'] 	= $this->item_code;
	$update_sql_array['measurement'] 	= $this->measurement;
	$update_sql_array['measurement_type'] 	= $this->measurement_type;
	$update_sql_array['category_id'] 	= $this->category_id;
	$update_sql_array['sub_category_id'] 	= $this->sub_category_id;
	$update_sql_array['is_active'] 	= $this->is_active;
	$update_sql_array['is_tax'] 	= $this->is_tax;
	$update_sql_array['tax3'] 	= $this->tax3;
	$update_sql_array['tax1'] 	= $this->tax1;
	$update_sql_array['tax2'] 	= $this->tax2;
	$update_sql_array['veg_or_non'] 	= $this->veg_or_non;
	$update_sql_array['cost_price'] 	= $this->cost_price;
	$update_sql_array['selling_price'] 	= $this->selling_price;
	$update_sql_array['shelf_life'] 	= $this->shelf_life;
	
	$update_sql_array['yield'] 	= $this->yield;
	$update_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	
	$this->db->update(TBL_ITEMS,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Item has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_ingradient.php?index=all";
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
function viewPage($runat,$id){
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;

$sql	=	"select * from ".TBL_ITEMS." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Item Site Mapping</h3>
           <p style="margin-top:-20px;" class="pull-right">Item Name: <span class="badge bg-pink " style="margin-top:-20px;"><?php echo $this->getMoreDetail(TBL_ITEMS,$id);?></span></p>     
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                     <form action="" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                   
                                    <th>Site-id</th>
                                    <th>Site Name</th>
                                    <th>Available In Inventory</th>
                                    <th>Available On POS</th>
                                  
                                </tr>
                            </thead>
                             
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_BRANCH." where 1  order by id asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                          
                                <tr class="tbl_row">
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['heading'];?></td>
                                    <td><label class="cr-styled"><input type="checkbox" <?php  if(in_array($row['id'],$this->getSiteMappingDetail($id,'available_in_inventory'))) echo "checked";?> name="available_in_inventory[]" value="<?php echo $row['id'];?>" /><i class="fa"></i></label></td>
                                    
                                    <td><label class="cr-styled"><input type="checkbox" name="available_on_pos[]" <?php  if(in_array($row['id'],$this->getSiteMappingDetail($id,'available_on_pos'))) echo "checked";?> value="<?php echo $row['id'];?>" /><i class="fa"></i></label></td>
                                   
                                </tr>
                             <?php $x++; }?>
                             
                            </tbody>
                           
                           
                        </table>
                         <button type="submit" name="submit" value="Submit" class="btn btn-primary" >Update Record</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
break;
	case 'server':
	extract($_POST);
	$this->item_id=$id;
	$this->available_in_inventory=implode(", ",$available_in_inventory);
	$this->available_on_pos=implode(", ",$available_on_pos);
	
	$return =true;
	
	if($return){
	$sql="select * from ".TBL_ITEM_SITE_MAPPING." where 1 and item_id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$rows = $this->db->num_rows($result);
	if($rows==0)
	{
		$insert_sql_array = array();
		$insert_sql_array['item_id'] 	= $this->item_id;
		$insert_sql_array['available_in_inventory'] 	= $this->available_in_inventory;
		$insert_sql_array['available_on_pos'] 	= $this->available_on_pos;
		$this->db->insert(TBL_ITEM_SITE_MAPPING,$insert_sql_array);
		
	}
	else
	{
		$update_sql_array = array();
	
		$update_sql_array['available_in_inventory'] 	= $this->available_in_inventory;
		$update_sql_array['available_on_pos'] 	= $this->available_on_pos;
		$this->db->update(TBL_ITEM_SITE_MAPPING,$update_sql_array,'item_id',$id);
		
	}
	$_SESSION['msg'] = 'Item has been mapped to selected sites successfully.';
	?>
	<script type="text/javascript">
	window.location = "manage_ingradient.php?index=view&id=<?php echo $id;?>";
	</script>
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->viewPage('local');
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}	
}
?>