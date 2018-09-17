<?php 

class MenuIngradient extends HomePage{
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
	return $row['base_unit'];
	}
	function getMoreDetail($tbl_name,$id,$colname){
	$sql="select * from ".$tbl_name." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
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
	function getConversion($unit,$base_unit){
	 $sql="select conversion  from ".TBL_MEASUREMENT." where name='".$unit."' and base_unit='".$base_unit."' " ; 
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['conversion'];
	}
	function getAverageCost($item_id){
	 $sql="select avg(rate) as avg_rate  from ".TBL_RECEIVING_ITEM." where item_id='".$item_id."' and ( timestamp between '".date('Y-m-d H:i:s',strtotime('-7 days'))."' and '".date('Y-m-d H:i:s')."')  " ; 
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return round($row['avg_rate'],2);
    	}
    function ProductDescription($id){
    $sql	=	"select * from ".TBL_PRODUCT." where id='".$id."' ";
    $res	=	$this->db->query($sql,__FILE__,__LINE__);
    $row	=	$this->db->fetch_array($res);

    
    
?>
<div class="panel-body"> 
            <strong>Menu Item Name(Product):</strong><span class="badge bg-inverse" style="font-size:20px !important;"><?php echo $row['name'];?></span>
            <div class="pull-right"  style="margin-left:10px; height:40px !important;" ></div>
            <label class="switch_new pull-right" title="Make Menu Item Active/Inactive">
  <input type="checkbox" data-id="<?php echo $row['id'];?>" id="input_product_update" <?php if($row['is_active']=='yes') echo "checked";?> value="yes">
  <span class="slider round"></span>
</label>
            <button class="btn btn-icon btn-danger m-b-5 pull-right" title="Delete Menu Item"> <i class="fa fa-remove"></i> </button>
             <a href="product.php?index=editpage&id=<?php echo $row['id'];?>" class="btn btn-icon btn-success m-b-5 pull-right" title="Edit Product"> 					<i class="fa fa-edit"></i> </a>
 </div>
<?php 
}
function ingradientList($product_id){
	
?>
<div class="col-lg-12">
    <div class="panel panel-color panel-info">
        <div class="panel-heading"> 
            <h3 class="panel-title">Ingradient List</h3> 
        </div> 
        <div class="panel-body"> 
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Ingradient Standard Unit</th>
                        <th>Average Cost Price</th>
                        <th>Ingradient Quantity</th>
                        <th>Ingradient Unit</th>
                        <th>After Conversion Quantity</th>
                        <th>After Conversion Unit</th>
                        <th>Ingradient Cost After GST</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $sql="select * from ".TBL_PRODUCT_INGRADIENT." where 1 and product_id='".$product_id."' order by id asc" ;
                $result= $this->db->query($sql,__FILE__,__LINE__);
				$this->total_amt=0;
                $x=1;
                while($row = $this->db->fetch_array($result))
                {
					$this->total_amt+=$this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price')*$this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$row['quantity'];
                ?>
                    <tr class="tbl_row">
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'name');?></td>
                        <td><?php echo $this->getMeasurement($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'measurement'));?></td>
                        <td><?php echo $this->getAverageCost($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'id'))!=0? $this->getAverageCost($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'id')) : $this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price');?></td>
                        <td><span class="badge bg-info"><?php echo $row['quantity'];?></span></td>
                        <td><?php echo $row['ingradient_unit'];?></td>
                        <td><?php echo $this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$row['quantity'];?></td>                        
                         <td><?php echo $this->getMeasurement($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'measurement'));?></td>
                        
                        <td><span class="badge bg-purple"><?php  echo $this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price')."*".$this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$row['quantity']."=".$this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price')*$this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$row['quantity'];?></span></td>
                        
                        <td>
                        <a href="javascript:;" data-id="<?php echo $row['id'];?>" class="md-trigger btn btn-warning btn-sm btn_ing_edit" data-modal="modal-10"><i class="fa fa-edit"></i>
                                        </a> | 
        <a class="btn_delete btn btn-danger" id="<?php echo $row['id'];?>" ><i class="fa fa-trash"></i></a>  </td>
                    </tr>
                 <?php $x++; }?>
                </tbody>
                <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td colspan="3">
				<?php $submit = isset($_POST['submit']) ? $_POST['submit'] : '';
				
                extract($_REQUEST);           
                  	if($submit=='Submit')
					$this->submitPrice('server',$product_id);
					else
					$this->submitPrice('local',$product_id);
					?></td>
                    <td></td>	
                </tr>
            </table> 
        </div> 
    </div>
</div>

<?php
}
function addIngradient($runat,$product_id){
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
echo $JsCodeForFormValidation;
?>
<div class="col-lg-12">
    <div class="panel panel-color panel-warning">
        <?php /*?><div class="panel-heading"> 
            <h3 class="panel-title">Add Ingradients</h3> 
        </div><?php */?> 
        <div class="panel-body"> 
        <form class="form-inline" role="form" action="" method="post">
                                    <div class="form-group">
                                        <label class="sr-only" for="ingradient">Ingradient</label>
                                        <input type="text" class="form-control" title="Ingradient" id="ingradient" autocomplete="on" placeholder="Enter Menu Ingradient...">
                                        <input type="hidden" name="ingradient_id" id="ingradient_id" />
                                        <div id="ingradient_list">
                </div>
                                    </div>
                                      
                                    <div class="form-group m-l-10">
                                        <label class="sr-only" for="inputPassword3">Quantity</label>
                                        <input type="number" value="0.000" name="quantity" step="0.001" title="Quantity" class="form-control" id="inputPassword3" placeholder="Enter Quantity..">
                                    </div>
                                    <div class="form-group m-l-10" id="div_measurement_unit" style="display:none;">
                                        <label class="sr-only" for="ingradient_unit">Measurement Unit</label>
                                           <select name="ingradient_unit" id="ingradient_unit" class="form-control">
                                           		<option value="">Select Unit</option>
                                                <?php
													$sql	=	"select distinct(name) from ".TBL_MEASUREMENT." where 1 order by name asc ";
													$res	=	$this->db->query($sql,__FILE__,__LINE__);
													while($row	=	$this->db->fetch_array($res))
													{
												?>
                                                <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                                                <?php }?>
                                           </select>
                                            
                                        
                                    </div>
                                    <button type="submit" name="submit" value="Add" class="btn btn-success m-l-10">Add In List</button>
                                </form>
            
        </div> 
    </div>
</div>
<?php 
	break;
	case 'server':
	extract($_POST);
	$this->product_id=$product_id;
	$this->ingradient_id=$ingradient_id;
	$this->quantity=$quantity;
	$this->cost_per_dish=$cost_per_dish;
	$this->profit=$profit;
	$this->selling_price=$selling_price;
	$this->ingradient_unit=$ingradient_unit;
	$return =true;
	if($this->Form->ValidField($ingradient_id,'empty','Please Enter Ingradient')==false)
	$return =false;
	if($return){
	$insert_sql_array = array();
	$insert_sql_array['product_id'] 	= $this->product_id;
	$insert_sql_array['ingradient_id'] 	= $this->ingradient_id;
	$insert_sql_array['quantity'] 	= $this->quantity;
	$insert_sql_array['ingradient_unit'] 	= $this->ingradient_unit;
	$this->db->insert(TBL_PRODUCT_INGRADIENT,$insert_sql_array);
	$last_id=$this->db->last_insert_id();
	$_SESSION['msg'] = 'Ingradient has been added successfully';
	?>
	<script type="text/javascript">
	window.location = "menu_ingradient.php?id=<?php echo $product_id;?>";
	</script>
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->addIngradient('local',$product_id);
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}
function editIngradient($runat,$id)
{
	
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
echo $JsCodeForFor , jsValidation;
?>
<div class="col-lg-12">
    <div class="panel panel-color panel-warning">
         
        <div class="panel-body"> 
            <form class="form-horizontal" action="" method="post" role="form">
                <div class="form-group">
                    <label for="ingradient" class="col-sm-3 control-label">Ingradient</label>
                    <div class="col-sm-9">
                     <span class="badge bg-purple" id="span_ingradient_name" style="font-size:20px !important ;"></span>
                     <input type="hidden" name="ing_id" id="hidden_ing_id" />
                    </div>
                </div>
                <div id="ingradient_list">
                </div>
                <div class="form-group">
                    <label for="ingradient" class="col-sm-3 control-label">Unit</label>
                    <div class="col-sm-9">
                     <span class="badge bg-warning" id="span_unit" style="font-size:20px !important ;"></span>
                    </div>
                </div>
                <div class="form-group" >
                    <label for="inputPassword3" class="col-sm-3 control-label">Quantity</label>
                    <div class="col-sm-9">
                      <input type="number" value="1" name="quantity" class="form-control" id="input_quantity" placeholder="Enter..">
                    </div>
                </div>
                
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" name="submit" value="Update" class="btn btn-info">Update</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
</div>
<?php 
	break;
	case 'server':
	extract($_POST);
	$this->quantity=$quantity;
	$this->ing_id=$ing_id;
	
	$return =true;
	if($return){
	$update_sql_array = array();
	$update_sql_array['quantity'] 	= $this->quantity;
	$this->db->update(TBL_PRODUCT_INGRADIENT,$update_sql_array,'$ing_id',$this->ing_id);
	$last_id=$this->db->last_insert_id();
	$_SESSION['msg'] = 'Ingradient has been upddated successfully';
	?>
	<script type="text/javascript">
	window.location = "menu_ingradient.php?id=<?php echo $id;?>";
	</script>
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->addIngradient('local',$product_id);
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}
function submitPrice($runat,$product_id){
switch($runat){
case 'local':
$FormName = "frm_addpage";
    $ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
echo $JsCodeForFormValidation;
$sql    =   "select * from ".TBL_PRODUCT." where id=".id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-color panel-purple" style="padding:2px !important;">
            <div class="panel-heading"> 
                <h3 class="panel-title">Total Ingredients Price</h3> 
            </div>
            <div class="panel-body"> 
                <form class="form-horizontal" action="" method="post" role="form">
                <div class="form-group">
                    <label for="ingradient" class="col-sm-6 control-label">Cost Price</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" style="text-align:right;"  required name="cost_price" value="<?php echo $this->total_amt;?>" readonly="readonly" id="cost_price" placeholder="Enter...">
                  
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-6 control-label">Cost %</label>
                    <div class="col-sm-6">
                      <input type="text" name="profit" style="text-align:right;"  class="form-control" value="<?php echo $row['profit'];?>" id="profit_percentage2" readonly="readonly" placeholder="Enter..">
                    </div>
                </div>
              <span class="badge bg-danger">Old Selling Price :<?php echo $row['selling_price'];?></span>
                <div class="form-group">
                    <label for="selling_price" class="col-sm-6 control-label">Net selling price</label>
                    <div class="col-sm-6">
                      <input type="text" name="selling_price_without_tax" required style="text-align:right;" class="form-control" value="" id="selling_price_without_tax"  placeholder="Net Selling price..">
                      
                    </div>
                </div>
                <div class="form-group">
                    <label for="ingradient" class="col-sm-6 control-label"><?php echo $this->getTaxDetail($row['tax_slab'],'name');?></label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" style="text-align:right;" data-id="<?php echo $this->getTaxDetail($row['tax_slab'],'percentage');?>"   name="tax_slab_amt" value="" readonly="readonly" id="tax_percentage" placeholder="Tax...">
                  
                    </div>
                </div>
                <div class="form-group">
                    <label for="ingradient" class="col-sm-6 control-label">Gross Selling Price(With Tax)</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" style="text-align:right;"  required name="selling_price" value="" readonly="readonly" id="selling_price" placeholder="Gross selling price...">
                  
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" name="submit" value="Submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form> 
            </div> 
        </div>
    </div>
    
    
</div>
<?php 
	break;
	case 'server':
	extract($_POST);
	
	$this->cost_price=$cost_price;
	$this->profit=round($profit,2);
	$this->selling_price=$selling_price;
	$this->tax_slab_amt=$tax_slab_amt;
	$this->selling_price_without_tax=$selling_price_without_tax;
	$return =true;
	if($cost_price!=0)
	{
	if($return){
	$update_sql_array = array();
	$update_sql_array['selling_price_without_tax'] 	= $this->selling_price_without_tax;
	$update_sql_array['cost_per_dish'] 	= $this->cost_price;
	$update_sql_array['profit'] 	= $this->profit;
	$update_sql_array['tax_slab_amt'] 	= $this->tax_slab_amt;
	$update_sql_array['selling_price'] 	= $this->selling_price;
	$this->db->update(TBL_PRODUCT,$update_sql_array,'id',$product_id);
	
	$_SESSION['msg'] = 'Product has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "product.php?index=all";
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
		$_SESSION['error_msg'] = 'Please Add Item then Submit.';
		$this->submitPrice('local','id');
		?>
        <script type="text/javascript">
	window.location = "menu_ingradient.php?id=<?php echo $product_id;?>;
	</script>
        <?php
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}
}
?>