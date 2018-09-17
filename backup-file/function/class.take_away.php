<?php 
class TakeAway{
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
	function getUserDetail($colname){
    $sql = "select * from ".TBL_USER." where id='".$_SESSION['user_id']."' ";
    $record = $this->db->query($sql,__FILE__,__LINE__);
    $row = $this->db->fetch_array($record);
 return	$row[$colname];
}
function getConversion($unit,$base_unit){
	 $sql="select conversion  from ".TBL_MEASUREMENT." where name='".$unit."' and base_unit='".$base_unit."' " ;  
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['conversion'];
	}
function getSoftwareDetail($tblname,$id,$colname){
    $sql = "select * from ".$tblname." where id='".$id."' ";
    $record = $this->db->query($sql,__FILE__,__LINE__);
    $row = $this->db->fetch_array($record);
 return	$row[$colname];
}
function getMemberDetail($id,$colname){
	$sql="select * from ".TBL_USER." where 1 and id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	$sql2="select * from ".TBL_MEMBER." where 1 and id='".$row['mem_id']."' order by id asc" ;
	$result2= $this->db->query($sql2,__FILE__,__LINE__);
	$row2 = $this->db->fetch_array($result2);
	return $row2[$colname];
	}
	function orderList($tbl_id,$bill_id,$cus_id){
?>
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Order List</h3>
            <button class="btn btn-icon btn-purple m-b-5 btnPrint pull-right" style="margin-top:-25px;" type="button" id="btnPrint">Print <i class="fa fa-print"></i> </button>
        </div>
        <?php
		extract($_POST);
		if($submit=='Submit')
		$this->saveOrder('server',$tbl_id,$bill_id,$cus_id);
		else
		$this->saveOrder('local',$tbl_id,$bill_id,$cus_id);
        ?>
    </div>
</div>
<?php 
}
function saveOrder($runat,$tbl_id,$bill_id,$cus_id){
switch($runat){
	case 'local':
?>
<form action="" method="post">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="table">
                        <thead>
                            <tr>
                               
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price (&#8377;)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_pro_list">
						<?php 
                        $sql="select * from ".TBL_TAKE_AWAY_ITEM_TEMP." where 1 and  customer_id='".$cus_id."' order by id desc" ;
                        $result= $this->db->query($sql,__FILE__,__LINE__);
                        $x=1;
                        while($row = $this->db->fetch_array($result))
                        {
                        ?>
                        <tr class="success tbl_row" >
                                  
                                    <td> <input type="hidden" name="pro_id[]" class="pro_id" value="<?php echo $row['item_id'];?>" /><?php echo $row['item_name'];?> <input type="hidden" name="pro_name[]" value="<?php echo $row['item_name'];?>" /></td>
                                    <td><?php echo $row['quantity'];?><input type="hidden" class="td_qty" id="td_qty<?php echo $x;?>" name="quantity[]" value="<?php echo $row['quantity'];?>" /></td>
                                    <td ><?php echo $row['price'];?><input type="hidden" id="td_amt<?php echo $x;?>" value="<?php echo $row['price'] ?>" name="selling_price[]" /></td>
                                    
                                    <td>
               <a class="btn_delete btn btn-danger" id="<?php echo $row[id];?>" title="Delete" ><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <?php $x++; }?>
                        </tbody>
                        
                    </table>
                    
                </div>
               <?php 
				$sql2="select count(id) as total_quantity, sum(price) as amt from ".TBL_TAKE_AWAY_ITEM_TEMP." where 1 and  customer_id='".$cus_id."' order by id desc" ;
				$result2= $this->db->query($sql2,__FILE__,__LINE__);
				$row2 = $this->db->fetch_array($result2);
			   ?>
               
            </div>
            <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
            <label class="btn-success">Qty:</label>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="hidden" value="<?php echo $row2['total_quantity'];?>" name="total_quantity" id="total_quantity" />
           <span id="span_total_quantity" class="badge bg-purple " ><?php echo $row2['total_quantity'];?></span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <label class="btn-success">Total:</label>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="hidden" value="<?php echo $row2['amt'];?>" name="total_amount" id="total_amount" />
          <span class="badge bg-purple " id="span_total_amt"><?php echo $row2['amt'];?></span> &#8377;
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-pink m-b-5"> Cancel </button>
            <a href="all-customer.php?type=take_away" class="btn btn-warning m-b-5"> Hold </a>
       <?php if($bill_id=='') { ?>
         <button type="button" class="btn btn-info m-b-5 " data-toggle="modal" id="modal_open" data-target="#PaymentModal">Payment</button>
         <?php } else { ?>
         <button class="btn btn-icon btn-purple m-b-5 btnPrint" type="button" id="btnPrint">Print <i class="fa fa-print"></i> </button>
         <?php }?>
         <button type="button" id="generate_kot" class="btn btn-purple m-b-5">Generate KOT</button>
         <div class="modal fade" id="PaymentModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Panel</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_payment_mode">
             <div class="form-group">
             	<label for="brand_id">Payment Mode</label>
                <select name="mode_of_payment" id="mode_of_payment" class="form-control">
                    <option value="">Select Payment Mode</option>
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="wallet">E-Wallet</option>
                </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_for_cash" style="display:none;">
             <div class="form-group">
             	<label for="brand_id">Enter Amount Given By Customer</label>
               	<input type="text" id="input_cash" name="cash_taken" class="form-control" placeholder="Enter Amount Given By Customer here.."
 />    
 				</div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_for_card" style="display:none;">
             <div class="form-group">
             	<label for="brand_id">Bank Name</label>
               	<input type="text" id="input_bank_name" name="bank_name" class="form-control" placeholder="Enter Bank Name.."
 />    
 </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_for_wallet" style="display:none;">
             <div class="form-group">
             	<label for="brand_id">Wallet Name</label>
               	<input type="text" id="input_wallet_name" name="wallet_name" class="form-control" placeholder="Enter Wallet Name.."
 />    	</div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="div_return" style="display:none;" >
             <div class="form-group">
             	
             <label class="btn-success">Return to Customer</label>
             <input type="hidden" name="cash_returned" id="hidden_cash_return" />
              <span class="badge bg-purple " id="return_to_customer"></span> &#8377;
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" value="Submit" class="btn btn-info " >Confirm Payment</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
            </div>
            </div>
        </div>
       </form>
<?php 
	break;
	case 'server':
	extract($_POST);
	$num_of_items=sizeof($pro_id);
	$this->table_id=$tbl_id;
	$this->payment_mode=$mode_of_payment;
	if($this->payment_mode=='cash')
	{
		$this->cash_taken=$cash_taken;
		$this->cash_returned=$cash_returned;
	}
	if($this->payment_mode=='card')
	{
		$this->payment_detail=$bank_name;

	}
	if($this->payment_mode=='wallet')
	{
		$this->payment_detail=$wallet_name;

	}
	$this->total_amount=$total_amount;
	$this->total_quantity=$total_quantity;
//	echo $num_of_items;
	$return =true;
	
	if($return){
	$insert_sql_array = array();
	$insert_sql_array['customer_id'] 	= $cus_id;
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['payment_mode'] 	= $this->payment_mode;
	$insert_sql_array['cash_taken'] 	= $this->cash_taken;
	$insert_sql_array['cash_returned'] 	= $this->cash_returned;
	$insert_sql_array['payment_detail'] 	= $this->payment_detail;
	$insert_sql_array['total_amount'] 	= $this->total_amount;
	$insert_sql_array['total_quantity'] 	= $this->total_quantity;
	$this->db->insert(TBL_TAKE_AWAY_ORDER,$insert_sql_array);
	$this->last_id=$this->db->last_insert_id();
	
	for($i=0;$i<$num_of_items;$i++){
	$insert_sql_array = array();
	$insert_sql_array['pos_order_id'] 	= $this->last_id;
	$insert_sql_array['item_id'] 	= $pro_id[$i];
	$insert_sql_array['item_name'] 	= $pro_name[$i];
	$insert_sql_array['quantity'] 	= $quantity[$i];
	$insert_sql_array['price'] 	= $selling_price[$i];
	$this->db->insert(TBL_TAKE_AWAY_ITEM,$insert_sql_array);
	
   	$sql="select * from ".TBL_PRODUCT_INGRADIENT." where 1 and product_id='".$pro_id[$i]."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	while($row = $this->db->fetch_array($result))
	{
 	$sql2="select count(id) as num_rows, stock from ".TBL_MANAGE_STOCK." where 1 and item_id='".$row['ingradient_id']."' and branch_id='".$_SESSION['branch_id']."' " ; 
	$result2= $this->db->query($sql2,__FILE__,__LINE__);
	$row2 = $this->db->fetch_array($result2);
	
	 $stock= $row2['stock']-($this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$row['quantity']);
	if($row2['num_rows']==0)
	{
		$insert_sql_array = array();
		$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
		$insert_sql_array['item_id'] 	= $row['ingradient_id'];
		$insert_sql_array['stock'] 	= $stock;
		$insert_sql_array['cost_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'cost_price');
		$insert_sql_array['selling_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price');
		$insert_sql_array['tax1'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax1');
		$insert_sql_array['tax2'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax2');
		$insert_sql_array['tax3'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax3');
		$this->db->insert(TBL_MANAGE_STOCK,$insert_sql_array);
	}
	else
	{
		$update_sql_array = array();
		$update_sql_array['branch_id'] 	= $_SESSION['branch_id'];
		$update_sql_array['item_id'] 	= $row['ingradient_id'];
		$update_sql_array['stock'] 	=$stock;
		$update_sql_array['cost_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'cost_price');
		$update_sql_array['selling_price'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'selling_price');
		$update_sql_array['tax1'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax1');
		$update_sql_array['tax2'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax2');
		$update_sql_array['tax3'] 	= $this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'tax3');
		$this->db->updateByTwoIds(TBL_MANAGE_STOCK,$update_sql_array,'branch_id',$_SESSION['branch_id'],'item_id', $row['ingradient_id']);
		
	}
	$insert_sql_array = array();
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['item_id'] 	= $row['ingradient_id'];
	$insert_sql_array['stock'] 	= -$this->getConversion($row['ingradient_unit'],$this->getMeasurement($this->getSoftwareDetail(TBL_ITEMS,$row['ingradient_id'],'measurement')))*$quantity[$i];
	$this->db->insert(TBL_STOCK,$insert_sql_array);
	}
	
	}
	
	$sql_delete="delete from ".TBL_TAKE_AWAY_ITEM_TEMP." where customer_id='".$cus_id."' ";
	$result= $this->db->query($sql_delete,__FILE__,__LINE__);
	$update_sql_array = array();
	$update_sql_array['status']='paid';
	$this->db->update(TBL_CUSTOMER,$update_sql_array,'id',$cus_id);
	$_SESSION['msg'] = 'Payment has been done successfully';
	?>
    	
	<script type="text/javascript">
	window.location = "take-away-pos.php?tbl_id=<?php echo $tbl_id;?>&bill_id=<?php echo $this->last_id;?>&cus_id=<?php echo $cus_id;?>";
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
function menuItemList(){
?>
<div class="col-lg-8"> 
    <div class="panel" style="background:#CECECE;">
        <div class="panel-heading" style="border:#CECECE;"> 
		<?php 
        $sql="select * from ".TBL_CATEGORY." where 1 and brand_id='".$_SESSION['brand_id']."' order by id desc" ;
        $result= $this->db->query($sql,__FILE__,__LINE__);
        $x=1;
        while($row = $this->db->fetch_array($result))
        {
        ?>
            <button class="btn btn-inverse m-b-5 btn_category" value="<?php echo $row['id'];?>"><?php echo $row['name'];?></button> 
          <?php }?>
        </div> 
         
    </div>
 	<div class="panel panel-color panel-warning" style="display:none;" id="div_sub_cat">
            <div class="panel-heading" id="panel_subcategory"> 
		
            </div> 
            <div class="panel-body" id="product_grid"> 
               
            </div> 
        </div>
    <div class="tab-content"> 
    <?php 
   $sql="select * from ".TBL_CATEGORY." where 1 and brand_id='".$_SESSION['brand_id']."' order by id desc" ;
    $result= $this->db->query($sql,__FILE__,__LINE__);
    $x=1;
    while($row = $this->db->fetch_array($result))
    {
    ?>
        <div class="tab-pane" id="<?php echo $row['id'];?>"> 
		<?php
        $sql2="select * from ".TBL_SUB_CATEGORY." where 1 and category_id='".$row['id']."' order by id desc" ;
        $result2= $this->db->query($sql2,__FILE__,__LINE__);
        while($row2 = $this->db->fetch_array($result2))
        {
        ?>
            <div> 
            <div style="border-bottom:1px solid #900; background:#0F6;">
            <h4><?php echo $row2['name'];?></h4>
            </div>
			<?php
            $sql3="select * from ".TBL_PRODUCT." where 1 and  category_id='".$row['id']."' AND sub_category_id='".$row2['id']."' order by id desc" ;
            $result3= $this->db->query($sql3,__FILE__,__LINE__);
            while($row3 = $this->db->fetch_array($result3))
            {
            ?>
			<span id="<?php echo $row3['id'];?>" class="badge bg-purple span_product" style="cursor:pointer;" id="span_ungradient_name"><?php echo $row3['name'];?></span>
            <?php }?>
            </div> 
            <?php } ?>
        </div>
        <?php $x++;  } ?> 
    </div> 
</div>
<?php
}
function generateReceipt($cus_id)
{
	$sql	=	"select * from ".TBL_RECEIPT_HEADER." where   branch_id='".$_SESSION['branch_id']."' ";
	$res	=	$this->db->query($sql,__FILE__,__LINE__);
	$row	=	$this->db->fetch_array($res);
?>
<div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <table>
                <?php if($row['brnad_name']!='') { ?>
                	<tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['brand_name'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['company_name1']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['company_name1'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['company_name2']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['company_name2'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address1']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address1'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address2']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address2'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address3']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address3'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['address4']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['address4'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line1']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line1'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line2']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line2'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line3']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line3'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                    <?php if($row['line4']!='') { ?>
                    <tr><td style="width:25%;"></td><td style="width:50%;" align="center"><?php echo $row['line4'];?></td><td style="width:25%;"></td></tr>
                    <?php } ?>
                </table>
                <table style="border-bottom:1px dashed #000;">
                <tr><td ><strong>No:</strong> <?php echo $this->getBillNumber();?></td><td ></td><td ><strong>Dt:</strong> <?php echo date('d-M-Y h:i:s',time());?></td></tr>
                <tr><td ><strong>Tb:</strong> <?php echo $tbl_id;?></td><td ></td><td ><strong>Px:</strong></td></tr>
                <tr><td ><strong>Wt:</strong> <?php echo $this->getUserDetail('fname')." ".$this->getUserDetail('lname');?></td><td ></td><td ><strong>Op:</strong></td></tr>
                </table>
               
                 
                    <table >
                        <thead >
                            <tr style="border-bottom:1px dashed #000;">
                                <th style="text-align:left;">Name</th>
                                <th style="text-align:center;">Qunatity</th>
                                <th style="text-align:center;">Price (in Rs.)</th>
                            </tr>
                        </thead>
                        <tbody id="" >
						<?php 
						
                        	$sql="select * from ".TBL_TAKE_AWAY_ITEM_TEMP." where 1 and  customer_id='".$cus_id."' order by id desc" ;
						
                        $result= $this->db->query($sql,__FILE__,__LINE__);
                        $x=1;
                        while($row = $this->db->fetch_array($result))
                        {
                        ?>
                        <tr class="" style=" border-bottom:1px dashed #000;" >
                                   
                                    <td style="text-align:left;"><?php echo $row['item_name'];?> </td>
                                    <td style="text-align:center;"><?php echo $row['quantity'];?></td>
                                    <td style="text-align:center;" ><?php echo $row['price'];?>   <span style="font-size:12px;"><?php echo $this->getTaxDetail($row['tax_slab'],'tax_symbol');?></span></td>
                                </tr>
                              <?php $x++; }?>
                                
								<?php 
						
							$sql2="select sum(quantity) as total_quantity,sum(price) as total_amount from ".TBL_TAKE_AWAY_ITEM_TEMP." where 1 and  customer_id='".$cus_id."' order by id desc" ;
						
						
                                $result2= $this->db->query($sql2,__FILE__,__LINE__);
                                $row2 = $this->db->fetch_array($result2);
                                ?>        
                                <tr style="border-bottom:1px dashed #000;"><th>Total</th><th><?php echo $row2['total_quantity'];?></th><th><?php echo $row2['total_amount'];?> (in Rs.)</th></tr>
                           <?php /*?>     <tr><td><?php echo $this->getTaxDetail(9,'name');?></td><td>&nbsp;&nbsp;&nbsp;</td><td style="text-align:center;"><?php echo $row2['total_amount']*$this->getTaxDetail(9,'percentage')/100;?>  <?php echo $this->getTaxDetail(9,'tax_symbol');?></td></tr>
                                <tr><td><?php echo $this->getTaxDetail(5,'name');?></td><td>&nbsp;&nbsp;&nbsp;</td><td style="text-align:center;"><?php echo $row2['total_amount']*$this->getTaxDetail(5,'percentage')/100;?>  <?php echo $this->getTaxDetail(5,'tax_symbol');?></td></tr>
                                  <tr style="border-bottom:1px dashed #000;"><th>Grand Total:</th><td>&nbsp;&nbsp;</td><th style="text-align:center;"><?php echo $row2['total_amount']+$row2['total_amount']*$this->getTaxDetail(9,'percentage')/100+$row2['total_amount']*$this->getTaxDetail(5,'percentage')/100;?> (in Rs.)</th></tr><?php */?>
                                  <tr><td colspan="3"><hr /></td></tr>
                                  
                                 
                              
                               
                        </tbody>
                    </table>
                    <table style="border-bottom:1px solid #000;">
                    <thead>
                    <tr>
                    	<th>Tax-Type</th>
                        <th>Taxable</th>
                        <th>Tax-Amt</th>
                        <th>Net-Amt</th>
                        
                    </tr>
                    </thead>
                    	
                                  
                                <?php
								$tax_total=0;
                                $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                                $result= $this->db->query($sql,__FILE__,__LINE__);
                                while($row = $this->db->fetch_array($result))
                                {
									
                                $sql3="select sum(tax_slab_amt) as amt,sum(price) as price_sum from ".TBL_TAKE_AWAY_ITEM_TEMP." where 1  and customer_id='".$cus_id."' and tax_slab='".$row['id']."' order by id desc" ;
                                $result3= $this->db->query($sql3,__FILE__,__LINE__);
                                $row3= $this->db->fetch_array($result3);
                                if($row3['amt']>0)
								{
									$tax_total+=$row3['amt'];
								?>
                                 <tr>
                                 	<td align="left"> <?php echo $row['name'];?> </td>

                                    <td><?php echo $row3['price_sum']-$row3['amt'];?></td>
                                    <td><?php echo $row3['amt'];?></td>
                                    <td><?php echo $row3['price_sum'];?>  <span style="font-size:12px;"><?php echo $this->getTaxDetail($row['id'],'tax_symbol');?></span></td>
                                  </tr>
                                    <?php
								}
                               
                                }
                                ?>
                               <tr>
                               	<td colspan="2">Total Tax</td>
                                <td colspan="2"><?php echo $tax_total;?>
                               </tr>
                                 
                             
                            
                    </table>
                    <table style="border-top:1px solid #ccc; border-bottom:1px dashed #000;">
                    <thead>
                    <tr>
                    	<th>GST%</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>IGST</th>
                        <th>Total</th>
                        
                    </tr>
                    </thead>
                    	
                                  
                                <?php
								$tax_total=0;
                                $sql="select * from ".TBL_TAX_SLAB." where 1 order by name asc" ;
                                $result= $this->db->query($sql,__FILE__,__LINE__);
                                while($row = $this->db->fetch_array($result))
                                {
									
                                $sql3="select sum(tax_slab_amt) as amt,sum(price) as price_sum,tax_slab,sum(cost_price_without_tax) as price_without_tax from ".TBL_TAKE_AWAY_ITEM_TEMP." where 1  and customer_id='".$cus_id."' and tax_slab='".$row['id']."' order by id desc" ;
                                $result3= $this->db->query($sql3,__FILE__,__LINE__);
                                $row3= $this->db->fetch_array($result3);
                                if($row3['amt']>0)
								{
									$tax_total+=$row3['amt'];
									
								?>
                                
                                 <tr>
                                 	<td align="left"> <?php echo str_replace('GST-','',$row['name']);?> </td>
                                    <td><?php echo $row3['price_without_tax']*$this->getTaxDetail($row3['tax_slab'],'cgst')/100;?></td>
                                    <td><?php echo $row3['price_without_tax']*$this->getTaxDetail($row3['tax_slab'],'sgst')/100;?></td>
                                   <td><?php echo $row3['price_without_tax']*$this->getTaxDetail($row3['tax_slab'],'igst')/100;?></td>
                                   <td><?php echo $row3['amt'];?> <span style="font-size:12px;"><?php echo $this->getTaxDetail($row3['tax_slab'],'tax_symbol');?></span></td>
                                  </tr>
                                    <?php
									
								}
                               
                                }
                                ?>
                               
                    </table>
                	<table style="border-bottom:1px dashed #000; text-align:center;">
                     <tr><td colspan="4"><strong>*****Thank You!!*****Visit Again*****</strong></td></tr>
                    </table>
                    
                </div>
              
               
            </div>
            
            
        </div>
<?php 
}
function getTaxDetail($id,$colname){
	$sql="select * from ".TBL_TAX_SLAB." where 1 and id='".$id."' order by name asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function getBillNumber(){
    $sql = "select * from ".TBL_POS_ORDER." where  1 ";
    $record = $this->db->query($sql,__FILE__,__LINE__);
    $row = $this->db->fetch_array($record);
	 return	$row['id']+1;
}
function oldKots($cus_id){
	$sql4="select * from ".TBL_KOT." where 1 and table_id='".$cus_id."' and is_print_kot='yes'  " ;
    $result4= $this->db->query($sql4,__FILE__,__LINE__);
	while($row4	=	$this->db->fetch_array($result4))
	{
?>
 <button class="btn btn-inverse btn-custom m-b-5 btn_change_print_status" data-id="<?php echo $row4['id'];?>"  type="button" id="btn_<?php echo $row4['id'];?>" ><?php echo $this->getSoftwareDetail(TBL_CATEGORY,$row4['category_id'],'name');?>
   <div id="div_<?php echo $row4['id'];?>">
   <table class="table">
   
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
           
        </tr>
    </thead>
    <tbody id="">
    <?php 
	
     $sql5="select * from ".TBL_KOT_ITEM." where 1  and kot_id='".$row4['id']."' and  category_id='".$row4['category_id']."'  " ;
    $result5= $this->db->query($sql5,__FILE__,__LINE__);
    while($row5	=	$this->db->fetch_array($result5))
    {
    ?>
    <tr class="">
               
                <td><?php echo $row5['product_name'];?> </td>
                <td><?php echo $row5['quantity'];?></td>
                
            </tr>
     <?php  }?>
                  
            
    </tbody>
    
</table>
</div> </button>
<script type="text/javascript">
$(document).on('click','#btn_<?php echo $row4['id'];?>',function() {

        var contents = $("#div_<?php echo $row4['id'];?>").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
    //frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    
});
</script>
<?php	

	}
}
function newKots($cus_id){
	$sql4="select * from ".TBL_KOT." where 1 and table_id='".$cus_id."' and is_print_kot='no'  " ;
    $result4= $this->db->query($sql4,__FILE__,__LINE__);
	while($row4	=	$this->db->fetch_array($result4))
	{
?>
 <button class="btn btn-primary btn-custom m-b-5 btn_change_print_status" data-id="<?php echo $row4['id'];?>"  type="button" id="btn_<?php echo $row4['id'];?>" ><?php echo $this->getSoftwareDetail(TBL_CATEGORY,$row4['category_id'],'name');?>
   <div id="div_<?php echo $row4['id'];?>">
   <table class="table">
   
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
           
        </tr>
    </thead>
    <tbody id="">
    <?php 
	
     $sql5="select * from ".TBL_KOT_ITEM." where 1  and kot_id='".$row4['id']."' and category_id='".$row4['category_id']."'  " ;
    $result5= $this->db->query($sql5,__FILE__,__LINE__);
    while($row5	=	$this->db->fetch_array($result5))
    {
    ?>
    <tr class="">
               
                <td><?php echo $row5['product_name'];?> </td>
                <td><?php echo $row5['quantity'];?></td>
                
            </tr>
     <?php  }?>
                  
            
    </tbody>
    
</table>
</div> </button>
<script type="text/javascript">
$(document).on('click','#btn_<?php echo $row4['id'];?>',function() {

        var contents = $("#div_<?php echo $row4['id'];?>").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
    //frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    
});
</script>
<?php	

	}
}
}
?>