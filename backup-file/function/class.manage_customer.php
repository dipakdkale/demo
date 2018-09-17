<?php 

class ManageCustomer{
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
	function getMoreDetail($tbl_name,$id){
	$sql="select * from ".$tbl_name." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['name'];
	}
	################ All Page ######################
	function allpage($type){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Customers</h3>
                 <a href="all-customer.php?index=add&type=<?php echo $type;?>" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Customer</a>
            </div>
           
            <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
        
        </div>
        <div class="panel-body">
            <div class="row">
				<?php 
                $sql="select * from ".TBL_CUSTOMER." where 1 and customer_type='".$type."' and status!='paid' and branch_id='".$_SESSION['branch_id']."'  order by id desc" ;
                $result= $this->db->query($sql,__FILE__,__LINE__);
                $x=1;
                while($row = $this->db->fetch_array($result))
                {
                ?>
                <?php if($row['customer_type']=='take_away') { ?>
                <a href="take-away-pos.php?cus_id=<?php echo $row['id'];?>" class="btn <?php echo $row['status']=='on_going'?'btn-success': 'btn-purple';?> m-b-5" title="<?php echo $row['status']=='on_going'?'On Going Customer': 'New Customer';?>" style="padding:30px;"><?php echo $row['customer_name']."<br>".$row['phone'];?></a>
                <?php } if($row['customer_type']=='home_delivery') { ?>
                <a href="home-delivery-pos.php?cus_id=<?php echo $row['id'];?>" class="btn <?php echo $row['status']=='on_going'?'btn-success': 'btn-purple';?> m-b-5" title="<?php echo $row['status']=='on_going'?'On Going Customer': 'New Customer';?>" style="padding:30px;"><?php echo $row['customer_name']."<br>".$row['phone'];?></a>
                <?php }?>
                <?php }?>
            </div>
            
            
        </div>
    </div>
</div>
        </div>
    </div>
</div>
        <?php 
	}

function addpage($runat,$type){
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
                <div class="panel-heading"><h3 class="panel-title">Add Customer</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" placehoder="Customer Name.." id="customer_name"  required/>
                        </div>
                        <div class="form-group" id="div_sub_category">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" <?php if($type=='home_delivery') echo 'required';?> class="form-control" id="phone" placeholder="Phone.." />
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" <?php if($type=='home_delivery') echo 'required';?> class="form-control" name="email" id="email" placeholder="Email..">
                        </div>
                        <?php if($type=='home_delivery') { ?>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" palceholder="Address.."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="near_by">Near By</label>
                            <input type="text" required class="form-control" name="near_by" id="near_by" placeholder="Near By..">
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" required class="form-control" name="pincode" id="pincode" placeholder="Pincode..">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" required class="form-control" name="city" id="city" placeholder="City..">
                        </div>
                        <?php }?>
                        
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
	$this->customer_name=$customer_name;
	$this->phone=$phone;
	$this->email=$email;
	$this->address=$address;
	$this->near_by=$near_by;
	$this->city=$city;
	$this->pincode=$pincode;
	
	$return =true;
	if($this->Form->ValidField($customer_name,'empty','Please Enter Customer Name')==false)
	$return =false;
	if($return){
	$insert_sql_array = array();
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['customer_name'] 	= $this->customer_name;
	$insert_sql_array['phone'] 	= $this->phone;
	$insert_sql_array['email'] 	= $this->email;
	$insert_sql_array['address'] 	= $this->address;
	$insert_sql_array['near_by'] 	= $this->near_by;
	$insert_sql_array['city'] 	= $this->city;
	$insert_sql_array['pincode'] 	= $this->pincode;
	$insert_sql_array['customer_type'] 	= $type;
	$this->db->insert(TBL_CUSTOMER,$insert_sql_array);
	$this->last_id=$this->db->last_insert_id();
	$_SESSION['msg'] = 'Customer has been added successfully';
	if($type=='take_away') {
	?>
	<script type="text/javascript">
	window.location = "take-away-pos.php?cus_id=<?php echo $this->last_id;?>";
	</script>
	<?php } else { ?>
    <script type="text/javascript">
	window.location = "home-delivery-pos.php?cus_id=<?php echo $this->last_id;?>";
	</script>
    <?php }
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
	
	
}
?>