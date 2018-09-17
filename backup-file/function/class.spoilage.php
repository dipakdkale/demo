<?php 

class Spoilage{
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
	function getItemDetail($id,$colname){
	$sql="select * from ".TBL_ITEMS." where 1 and id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function getClosingStock($item_id){
	$sql="select * from ".TBL_MANAGE_STOCK." where 1 and item_id='".$item_id."' and branch_id='".$_SESSION['branch_id']."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['stock'];
	}
	function getMoreDetail($tbl_name,$id){
	$sql="select * from ".$tbl_name." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['name'];
	}
	################ All Page ######################
	function allpage(){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Items</h3>
                 <a href="spoilage.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Info.</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Cost Price</th>
                                    <th>Selling Price</th>
                                    <th>Rate</th>
                                    <th>Type</th>
                                    <th>Reason</th>
                                    <th>Waste Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_SPOILAGE." where 1 and branch_id='".$_SESSION['branch_id']."' order by id asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $this->getItemDetail($row['item_id'],'item_code');?></td>
                                    <td><?php echo $row['item_name'];?></td>
                                    <td><?php echo $row['cost_price'];?></td>
                                    <td><?php echo $row['selling_price'];?></td>
                                    <td><?php echo $row['rate'];?></td>
                                    <td><?php echo $row['type'];?></td>
                                    <td><?php echo $row['reason'];?></td>
                                    <td><?php echo $row['waste_quantity'];?></td>
                                   
                                    <td>
              <?php /*?> <a href="spoilage.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
               |<?php */?><a class="btn_delete" id="<?php echo $row[id];?>" ><i class="fa fa-ban"></i></a>  </td>
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
                <div class="panel-heading"><h3 class="panel-title">Spoilage Entry</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="item_id">Item Name</label>
                            <select name="item_id" required id="item_id" class="form-control">
                            	<option value="" >Select Item</option>
								<?php 
                                $sql="select * from ".TBL_ITEMS." where 1 and branch_id='".$_SESSION['branch_id']."' order by name asc" ;
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
                            <label for="type">Spoilage Type</label>
                            <select name="type" required id="type" class="form-control">
                            	<option value="" >Select Type</option>
								
                                <option value="damage">Damage</option>
                                <option value="spoilage">Spoilage</option>
                                <option value="wastage">Wastage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="Quantity" id="quantity">
                        </div>
                        <div class="form-group" id="div_measurement_unit" style="display:none;">
                            <label for="cost_price">Measurement Unit</label>
                            <input type="text" required class="form-control" id="measurement_unit" disabled>
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea class="form-control" name="reason" id="reason" placeholder="Write Reason Here.."></textarea>
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
	$this->item_id=$item_id;
	$this->item_name=$this->getItemDetail($item_id,'name');
	$this->item_code=$this->getItemDetail($item_id,'item_code');
	$this->cost_price=$this->getItemDetail($item_id,'cost_price');
	$this->selling_price=$this->getItemDetail($item_id,'selling_price');
	$this->measurement_unit=$this->getItemDetail($item_id,'measurement');
	$this->type=$type;
	$this->reason=$reason;
	$this->closing_stcok=$this->getClosingStock($item_id);
	$this->expiry_date=date('Y-m-d',strtotime($expiry_date));
	$this->quantity=$quantity;
	
	$return =true;
	if($this->Form->ValidField($quantity,'empty','Please Enter  Quanity')==false)
	$return =false;
	if($return){
	$insert_sql_array = array();
	$insert_sql_array['item_id'] 	= $this->item_id;
	$insert_sql_array['item_name'] 	= $this->item_name;
	$insert_sql_array['cost_price'] 	= $this->cost_price;
	$insert_sql_array['selling_price'] 	= $this->selling_price;
	$insert_sql_array['measurement_unit'] 	= $this->measurement_unit;
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['closing_stock'] 	= $this->closing_stcok;
	$insert_sql_array['type'] 	= $this->type;
	$insert_sql_array['reason'] 	= $this->reason;
	$insert_sql_array['waste_quantity'] 	= $this->quantity;	
	$this->db->insert(TBL_SPOILAGE,$insert_sql_array);
	$sql="select count(id) as record from ".TBL_MANAGE_STOCK." where 1 and branch_id='".$_SESSION['branch_id']."' and item_id='".$this->item_id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	if($row['record']!=0)
	{
			
		$update_sql_array = array();
		$update_sql_array['stock'] 	=$this->getClosingStock($item_id)-$this->quantity;
		$this->db->updateByTwoIds(TBL_MANAGE_STOCK,$update_sql_array,'branch_id',$_SESSION['branch_id'],'item_id', $this->item_id);
	}
	else
	{
	$insert_sql_array = array();
	$insert_sql_array['item_id'] 	= $this->item_id;
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['stock'] 	= -$this->quantity;	
	$insert_sql_array['cost_price'] 	= $this->cost_price;
	$insert_sql_array['selling_price'] 	= $this->selling_price;
		
	$insert_sql_array['tax1'] 	=$this->getItemDetail($item_id,'tax1');
	$insert_sql_array['tax2'] 	= $this->getItemDetail($item_id,'tax2');
	$insert_sql_array['tax3'] 	=$this->getItemDetail($item_id,'tax3');
	$this->db->insert(TBL_MANAGE_STOCK,$insert_sql_array);
	}
	
	$_SESSION['msg'] = 'Stock has been added successfully';
	?>
	<script type="text/javascript">
	window.location = "spoilage.php?index=all";
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
                            <div class="radio-inline">
                                <label class="cr-styled" for="taxation2">
                                    <input type="radio" id="taxation2" name="is_tax" value="no" <?php if($row['is_tax']=='no') echo 'checked';?>> 
                                    <i class="fa"></i> 
                                    Without Tax
                                </label>
                            </div>
                         
                        </div>
                        <div class="form-group" id="div_tax" <?php if($row['tax']=='') echo 'style="display:none";';else echo 'style="display:block;"';?>">
                            <label for="category_id">Tax</label>
                            <select name="tax"  id="tax" class="form-control">
                            	<option value="" >Select Tax</option>
                                <?php 
                            $sql1="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                            $result1= $this->db->query($sql1,__FILE__,__LINE__);
                            $x=1;
                            while($row1 = $this->db->fetch_array($result1))
                            {
                            ?>
                            <option value="<?php echo $row1['id'];?>" <?php if($row1['id']==$row['tax']) echo "selected=selected";?>><?php echo $row1['name'];?></option>
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
                        <label for="shelf_life">Manufacturing Date</label>
                                    <input type="text" class="form-control" value="<?php echo $row['manufacturing_date'];?>" name="manufacturing_date" placeholder="mm/dd/yyyy" id="datepicker">
                          </div>
                          <div class="form-group">
                            <label for="yield">Yield %</label>
                            <input type="text" required class="form-control" value="<?php echo $row['yield'];?>" name="yield" id="yield" placeholder="Yield">
                        </div>
                        <div class="form-group">
                            <label for="loyality_percentage">Loyality Percentage</label>
                            <input type="text" required class="form-control" value="<?php echo $row['loyality_percentage'];?>" name="loyality_percentage" id="loyality_percentage" placeholder="Loyality Percentage">
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
	if($is_tax=='yes')
	{
		$this->tax=$tax;
	}
	else
	{
		$this->tax='';
	}
	$this->veg_or_non=$veg_or_non;
	$this->cost_price=$cost_price;
	$this->selling_price=$selling_price;
	$this->shelf_life=$shelf_life;
	$this->manufacturing_date=$manufacturing_date;
	$this->yield=$yield;
	$this->loyality_percentage=$loyality_percentage;
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
	$return =false;
	if($return){
	$update_sql_array = array();
	$update_sql_array['name'] 	= $this->name;
	$update_sql_array['item_code'] 	= $this->item_code;
	$update_sql_array['measurement'] 	= $this->measurement;
	$update_sql_array['category_id'] 	= $this->category_id;
	$update_sql_array['sub_category_id'] 	= $this->sub_category_id;
	$update_sql_array['is_active'] 	= $this->is_active;
	$update_sql_array['is_tax'] 	= $this->is_tax;
	$update_sql_array['is_tax'] 	= $this->is_tax;
	$update_sql_array['tax'] 	= $this->tax;
	$update_sql_array['veg_or_non'] 	= $this->veg_or_non;
	$update_sql_array['cost_price'] 	= $this->cost_price;
	$update_sql_array['selling_price'] 	= $this->selling_price;
	$update_sql_array['shelf_life'] 	= $this->shelf_life;
	$update_sql_array['manufacturing_date'] 	= $this->manufacturing_date;
	$update_sql_array['yield'] 	= $this->yield;
	$update_sql_array['loyality_percentage'] 	= $this->loyality_percentage;
	$this->db->update(TBL_ITEMS,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Item has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "spoilage.php?index=all";
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