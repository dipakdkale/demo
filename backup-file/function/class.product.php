<?php 

class Product{
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
	function allpage(){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Products</h3>
                
                 <a href="product.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Item</a>
                  <a href="product.php?index=mapping" class="btn btn-warning m-b-5 pull-right" style="margin-top:-25px; margin-right:5px;">Product Branch Mapping</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Cost (Per Dish)</th>
                                    <th>Cost %</th>
                                    <th>Selling Price</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_PRODUCT." where 1 and brand_id='".$_SESSION['brand_id']."'  order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['quantity'];?></td>
                                    <td><?php echo $row['cost_per_dish'];?></td>
                                    <td><?php echo $row['profit'];?> </td>
                                    <td><?php echo $row['selling_price'];?></td>
                                    <td><?php echo $row['is_active'];?> <label class="switch_new" title="Make Menu Item Active/Inactive">
  <input type="checkbox" data-id="<?php echo $row['id'];?>" id="input_product_update" <?php if($row['is_active']=='yes') echo "checked";?> value="yes">
  <span class="slider round"></span>
</label>	</td>
                                    <td>
               <a href="product.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top" class="btn btn-warning"><i class="fa fa-edit"></i></a>  
               
               |<a class="btn_delete btn btn-danger" id="<?php echo $row[id];?>" title="Delete" ><i class="fa fa-trash-o"></i></a>| <a href="menu_ingradient.php?id=<?php echo $row['id'];?>" class="btn btn-primary" title="Proceed To Add Ingrafient"><i class="fa fa-share" aria-hidden="true"></i></a>  </td>
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
                            <label for="heading">Tax Slab</label>
                                <select class="form-control select_tax" id="tax_type1"  name="tax_slab" >
                               		 <option value="">Select Tax</option>
                                <?php 
                                $sql="select * from ".TBL_TAX_SLAB." where 1 order by id desc" ;
                                $result= $this->db->query($sql,__FILE__,__LINE__);
                                $x=1;
                                while($row = $this->db->fetch_array($result))
                                {
                                ?>
                                <option value="<?php echo $row['id'];?>" data-id="<?php echo $row['percentage'];?>" ><?php echo $row['name'];?></option>
                                <?php 
                                }?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="heading">Name</label>
                            <input type="text" required class="form-control" name="name" id="heading"  placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" required class="form-control" name="quantity" id="quantity" placeholder="Quantity">
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
	$this->sub_category_id=$sub_category_id;
	$this->name=$name;
	$this->quantity=$quantity;
	$this->cost_per_item=$cost_per_item;
	$this->cost_per_dish=$cost_per_dish;
	$this->profit=$profit;
	$this->selling_price=$selling_price;
	$this->tax_slab=$tax_slab;
	
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
	$return =false;
	if($return){
	$insert_sql_array = array();
	$insert_sql_array['category_id'] 	= $this->category_id;
	$insert_sql_array['sub_category_id'] 	= $this->sub_category_id;
	$insert_sql_array['name'] 	= $this->name;
	$insert_sql_array['quantity'] 	= $this->quantity;
	//$insert_sql_array['cost_per_item'] 	= $this->cost_per_item;
	$insert_sql_array['cost_per_dish'] 	= $this->cost_per_dish;
	$insert_sql_array['profit'] 	= $this->profit;
	$insert_sql_array['selling_price'] 	= $this->selling_price;
	$insert_sql_array['brand_id'] 	= $_SESSION['brand_id'];
	$insert_sql_array['tax_slab'] 	= $this->tax_slab;
	
	$this->db->insert(TBL_PRODUCT,$insert_sql_array);
	$last_id=$this->db->last_insert_id();
	$_SESSION['msg'] = 'Product has been added successfully';
	?>
	<script type="text/javascript">
	window.location = "menu_ingradient.php?id=<?php echo $last_id;?>";
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
$sql	=	"select * from ".TBL_PRODUCT." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
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
                            <label for="heading">Tax Slab</label>
                                <select class="form-control select_tax" id="tax_type1"  name="tax_slab" >
                               		 <option value="">Select Tax</option>
                                <?php 
                                $sql_tax="select * from ".TBL_TAX_SLAB." where 1 order by id desc" ;
                                $result_tax= $this->db->query($sql_tax,__FILE__,__LINE__);
                                $x=1;
                                while($row_tax = $this->db->fetch_array($result_tax))
                                {
                                ?>
                                <option value="<?php echo $row_tax['id'];?>" data-id="<?php echo $row_tax['percentage'];?>" <?php if($row['tax_slab']==$row_tax['id']) echo "selected=selected";?> ><?php echo $row_tax['name'];?></option>
                                <?php 
                                }?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="heading">Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['name'];?>" name="name" id="heading"  placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" required class="form-control" value="<?php echo $row['quantity'];?>" name="quantity" id="quantity" placeholder="Quantity">
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
	$this->sub_category_id=$sub_category_id;
	$this->name=$name;
	$this->quantity=$quantity;
	$this->tax_slab=$tax_slab;
	
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
	$return =false;
	if($return){
	$update_sql_array = array();
	$update_sql_array['category_id'] 	= $this->category_id;
	$update_sql_array['sub_category_id'] 	= $this->sub_category_id;
	$update_sql_array['name'] 	= $this->name;
	$update_sql_array['quantity'] 	= $this->quantity;
	$update_sql_array['tax_slab'] 	= $this->tax_slab;
	$update_sql_array['brand_id'] 	= $_SESSION['brand_id'];
	
	$this->db->update(TBL_PRODUCT,$update_sql_array,'id',$id);
	
	$_SESSION['msg'] = 'Product has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "menu_ingradient.php?id=<?php echo $id;?>";
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
function productBranchMapping($runat){
	
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Product Branch Mapping</h3>
                
               
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
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
							/*$sql2="select * from ".TBL_CATEGORY." where 1 AND brand_id='".$_SESSION['brand_id']."'  order by name asc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {*/
                            $sql="select * from ".TBL_PRODUCT." where 1 AND brand_id='".$_SESSION['brand_id']."'   order by name asc" ;
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
                             <?php $x++; }/* }*/ ?>
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