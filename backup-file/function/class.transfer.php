<?php 

class Transfer{
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
	}
	function getMoreDetail($tbl_name,$id){
	$sql="select * from ".$tbl_name." where 1 and id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['heading'];
	}
	function getSupplierDetail($id){
	$sql="select * from ".TBL_SUPPLIER." where 1 and id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['name'];
	}
	function getUserDetail($id,$colname){
	$sql="select * from ".TBL_USER." where 1 and mem_id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function getPurchaeseId(){
	$sql="select max(id) as total from ".TBL_PURCHASE_ORDER." " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['total']+1;
	}
	function getSenderBranchId($id){
		$sql="select * from ".TBL_SUPPLIER." where 1 and id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['branch_id'];
	}
	function getItemDetail($id,$colname){
	$sql="select * from ".TBL_ITEMS." where 1 and id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	function getReceiverBranchId(){
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
	function getCurrentInhandStock($id,$item_id){
	$sql="select stock  from ".TBL_MANAGE_STOCK." where  branch_id='".$id."' and item_id='".$item_id."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row['stock'];
	}
	################ All Page ######################
	function allpage(){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Transfer Receipts </h3>
                 <a href="transfer.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add  Transfer Receipt</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice Number</th>
                                    <th>Branch</th>
                                    <th>Departement</th>
                                     <th>Supplier</th>
                                    <th>Invoice Qunatity</th>
                                    <th>Transfer Qunatity</th>
                                     <th>Received Qunatity</th>
                                     <th>Pre Tax Amount</th>
                                    <th>Bill After Discount</th>
                                    <th>Grand Total</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_RECEIVING_ORDER." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['purchase_invoice_no'];?></td>
                                    <td><?php echo $this->getMoreDetail(TBL_BRANCH,$row['branch_id']);?></td>   
                                     <td><?php echo $this->getMoreDetail(TBL_DEPARTMENT,$row['departement_id']);?></td>
                                    <td><?php echo $this->getSupplierDetail($row['supplier_id']);?></td>                                 
                                    <td><?php echo $row['quantity_total'];?></td>
                                    <td><?php echo $row['transfer_quantity_total'];?></td>
                                    <td><?php echo $row['received_quantity_total'];?></td>
                                    <td><?php echo $row['pre_tax_amt_total'];?></td>
                                    <td><?php echo $row['bill_after_discount'];?></td>
                                    <td><?php echo $row['grand_total_amt'];?></td>
                                    <td>
             <?php /*?>  <a href="purchase_invoice.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               |<?php */?>
               <a class="btn_delete" id="<?php echo $row[id];?>" ><i class="fa fa-ban"></i></a>  </td>
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
########Add Page######################
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
                <div class="panel-heading"><h3 class="panel-title">Manage Transfer</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    
                    <?php if($_SESSION['user_type']=='sadmin') { ?>
                    <div class="col-md-4">
                    <div class="form-group">
                            <label for="company_id">Company Name</label>
                            <select class="form-control" name="company_id" readonly="readonly" id="company_id">
                            	<option value="">Select Company</option>
                                <?php 
                            $sql="select * from ".TBL_COMPANY." where 1 order by heading asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['company_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                    </div> 
                    <?php }?>
                    <?php if($_SESSION['user_type']=='sadmin' || $_SESSION['user_type']=='company_admin') { ?>
                    <div class="col-md-4">
                    	<div class="form-group">
                            <label for="brand_id">Brand Name</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                            	<option value="">Select Brand</option>
							<?php 
                            $sql="select * from ".TBL_BRAND." where 1 order by heading asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['brand_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                    </div>
                    <?php }?>
                    <?php if($_SESSION['user_type']=='sadmin' || $_SESSION['user_type']=='company_admin' || $_SESSION['user_type']=='brand_admin') { ?>
                    <div class="col-md-4">
                    	<div class="form-group">
                            <label for="branch_id">Branch Name</label>
                            <select class="form-control" name="branch_id" id="branch_id">
                            	<option value="">Select Branch</option>
                                <?php 
                            $sql="select * from ".TBL_BRANCH." where 1 order by heading asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['branch_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                    </div>
                    <?php }?>
                 
                    <?php 
                    </div>
                    	<div class="col-md-3">
                           <div class="form-group">
                            <label for="supplier_type">Supplier Type</label>
                              <select class="form-control" id="supplier_type" name="supplier_type">
                           		<option value="">Select Supplier Type</option>
                                <option value="External">External</option>
                                <option value="Internal">Internal</option>
                           </select>
                        </div>
                      </div>
 
                    <div class="col-md-4">
                    	<div class="form-group">
                        <label for="supplier_id">Supplier Name</label>
                       <select class="form-control" name="supplier_id" id="supplier_id">
                            	<option value="">Select Supplier</option>
                                <?php 
                            $sql="select * from ".TBL_SUPPLIER." where 1 and supplier_type='Internal' order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['supplier_id']==$row['id']) echo "selected=selected";?>><?php echo $row['name'];?></option>
                            <?php } ?>
                            </select>
                            </div>
                        </div>
                  	<div class="col-md-4">
                    <div class="form-group">
                            <label for="supplier_type">PO Number</label>
                           <select class="form-control" id="purchase_invoice_no" name="purchase_invoice_no">
                           		<option value="">Select Invoice Number</option>
                               <?php 
                            $sql="select * from ".TBL_PURCHASE_ORDER." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['supplier_id']==$row['id']) echo "selected=selected";?>><?php echo $row['purchase_invoice_no'];?></option>
                            <?php } ?>
                           </select>
                        </div>
                    </div>
                        <?php /*?><div class="col-md-4">
                    <div class="form-group">
                            <label for="fname">Transfer Invoice For</label>
                           <select class="form-control" name="branch_id" id="branch_id">
                            	<option value="">Select Brand</option>
							<?php 
                            $sql="select * from ".TBL_BRANCH." where 1 order by heading asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['branch_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div><?php */?>
                    <div class="col-md-3">
                    <div class="form-group">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" readonly="readonly" value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                            <label for="user_name">Current Date & Time</label>
                            <input type="text" class="form-control" id="current_date" name="current_date" readonly="readonly" value="<?php // echo date('Y-m-d h:i:s',time());?>" />
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                            <label for="user_name">Order For The Date</label>
                           <input type="text" class="form-control" name="manufacturing_date" readonly="readonly" placeholder="mm/dd/yyyy" id="manufacturing_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                            <label for="user_name">Time</label>
                            <div class="bootstrap-timepicker"><input id="purchase_time" readonly="readonly" name="purchase_time" type="text" class="form-control"/></div>
                        </div>
                    </div>
                    <?php /*?><!--<div class="col-md-4">
                     <input type="text" class="form-control" autocomplete="off" id="ingradient" placeholder="Enter Ingradient">
                     <div id="ingradient_list">
                     </div>
                    </div>
                    <div class="col-md-8">
                     <button type="button" class="btn btn-icon btn-purple m-b-5 add-row"> <i class="fa fa-paper-plane-o"></i> ADD ROW</button>
                      </div>
                  --><?php */?>
                    <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" style="overflow:auto;">
                        <table class="table table-bordered" id="data_table">
                            <thead>
                                <tr>
                                    <th style="width:5%;">#</th>
                                    <th style="width:10%">Item Name</th>
                                    <th style="width:10%">HSN Category Number</th>
                                    <th style="width:10%">Unit Of Measument For Order</th>
                                    <th style="width:10%">Current In Hand stock</th>
                                    <th style="width:10%">Tax 1</th>
                                    <th style="width:10%">Tax 2</th>
                                    <th style="width:10%">Tax 3</th>
                                    <th style="width:10%">Purchase Inovice quantity</th>
                                    <th style="width:10%">Transfer quantity</th>
                                    <th style="width:10%">Received quantity</th>
                                    <th style="width:5%">Rate</th>
                                    <th style="width:10%">Total Pretax Amount</th>
                                    <th style="width:10%">Tax Amount</th>
                                    <th style="width:10%">With Tax amount</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_body">
							
                            </tbody>
                            <tbody id="tbl_body1">
							
                            </tbody>
                            <tbody>
							<tr>
                                	<td style="width:40px;"></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <th style="">Total</th>
                                    <th style=""> <input type="text" readonly="readonly" id="quantity_total" style="width:80px;" name="quantity_total" /></th>
                                    <td><input type="text" readonly="readonly" name="transfer_quantity_total" style="width:80px;" id="transfer_quantity_total"></td>
									<td><input type="text" readonly="readonly" name="received_quantity_total" style="width:80px;" id="received_quantity_total"></td>
                                    <td style=""></td>
                                    <th style=""><input type="text" value="0" readonly="readonly" id="pre_tax_amt_total" style="width:80px;" name="pre_tax_amt_total" /></th>
                                    <th style=""><input type="text"  readonly="readonly" id="tax_amt_total" style="width:80px;" name="tax_amt_total" /></th>
                                    <th style=""><input type="text" value="0" readonly="readonly" class="total_amt" id="total_amt" style="width:80px;" name="total_amt" /></th>
                                </tr>
                                <tr>
                                	<td style="width:40px;"></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <th style=""></th>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                     <th style="">Transfer Invoice</th>
                                    <td style=""><input type="text" id="gross_amt" class="total_amt" value="0" readonly="readonly" style="width:80px;" name="transfer_invoice" /></td>
                                </tr>
                                
                                <tr>
                                	<td style="width:40px;"></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <th style=""></th>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <th style="">Trans. Charges</th>
                                    <td style=""><input type="text" id="transportation_charge"  style="width:80px;" placeholder="Enter.." name="transportation_charge" /><input type="hidden" id="amt_after_transportation" /></td>
                                </tr>
                                <tr>
                                	<td style="width:40px;"></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <th style=""></th>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                      <th style="">Handling Charges</th>
                                    <td style=""><input type="text" id="handling_charge" style="width:80px;" placeholder="Enter.." name="handling_charge" /></td>
                                </tr>
                                <tr>
                                	<td style="width:40px;"></td>
                                    
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <th style=""></th>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td><td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <th style="">Total Value</th>
                                    <th style=""><input type="text" id="total_value" style="width:80px;" readonly="readonly" name="grand_total_amt" /></th>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                
                            </thead>
                            
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        
                    </div>
                </div>
            </div>
                   		<button type="submit"  name="save" value="Save" class="btn btn-info">Save</button>
                        <button type="submit" disabled="disabled" name="submit" value="Submit" class="btn btn-purple">Submit</button>
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
							$num_of_items=sizeof($item_id); 
							$this->hsn_no=$hsn_no;
							$this->unit_of_measurement=$unit_of_measurement;
							$this->in_hand_stock=$in_hand_stock;
							$this->tax_structure=$tax_structure;
							$this->quantity=$quantity;
							$this->transfer_quantity=$transfer_quantity;
							$this->received_quantity=$received_quantity;	
							$this->rate=$rate;
							$this->pre_text_amt=$pre_text_amt;
							$this->tax_amt=$tax_amt;
							$this->with_tax_amt=$with_tax_amt;
							$this->supplier_id=$supplier_id;
							$this->purchase_invoice_no=$purchase_invoice_no;
							$this->user_name=$user_name;
							$this->current_date=$current_date;
							$this->manufacturing_date=date('Y-m-d',strtotime($manufacturing_date));
							$this->purchase_time=$purchase_time;
							$this->quantity_total=$quantity_total;
							$this->transfer_quantity_total=$transfer_quantity_total;
							$this->received_quantity_total=$received_quantity_total;
							$this->pre_tax_amt_total=$pre_tax_amt_total;
							$this->tax_amt_total=$tax_amt_total;
							$this->transportation_charge=$transportation_charge;
							$this->handling_charge=$handling_charge;
							$this->discount=$discount;
							$this->total_amt=$total_amt;
							$this->bill_after_discount=$bill_after_discount;
							$this->transportation_charge=$transportation_charge;
							$this->grand_total_amt=$grand_total_amt;
						 $this->senderBranch_id=$this->getSenderBranchId($supplier_id);
							if($_SESSION['user_type']=='employee')
							{
								$this->receiverBranchId=$this->getReceiverBranchId();
							}
							else
							{
								$this->receiverBranchId=$branch_id;
							}
						
							$return =true;
						
							if($return){
							$insert_sql_array = array();
							$insert_sql_array['company_id'] 	= $_SESSION['company_id'];
							$insert_sql_array['brand_id'] 	= $_SESSION['brand_id'];
							$insert_sql_array['branch_id'] 	=  $_SESSION['branch_id'];
							$insert_sql_array['sender_branch_id'] 	= $this->senderBranch_id;
							
							$insert_sql_array['supplier_id'] 	= $this->supplier_id;
							$insert_sql_array['purchase_invoice_no'] 	= $this->purchase_invoice_no;
							$insert_sql_array['user_name'] 	= $this->user_name;
							$insert_sql_array['current_date'] 	= $this->current_date;
							$insert_sql_array['manufacturing_date'] 	= $this->manufacturing_date;
							$insert_sql_array['purchase_time'] 	= $this->purchase_time;
							$insert_sql_array['quantity_total'] 	= $this->quantity_total;
							$insert_sql_array['transfer_quantity_total'] 	= $this->transfer_quantity_total;
							$insert_sql_array['received_quantity_total'] 	= $this->received_quantity_total;
							$insert_sql_array['pre_tax_amt_total'] 	= $this->pre_tax_amt_total;
							$insert_sql_array['tax_amt_total'] 	= $this->tax_amt_total;
							$insert_sql_array['transportation_charge'] 	= $this->transportation_charge;
							$insert_sql_array['handling_charge'] 	= $this->handling_charge;
							$insert_sql_array['quantity_total'] 	= $this->quantity_total;
							$insert_sql_array['total_amt'] 	= $this->total_amt;
							
							$insert_sql_array['grand_total_amt'] 	= $this->grand_total_amt;
							$this->db->insert(TBL_TRANSFER,$insert_sql_array);
							$last_id=$this->db->last_insert_id();
							?>
                            <?php
							for($i=0;$i<$num_of_items;$i++){
							$insert_sql_array = array();
							$insert_sql_array['receiving_id'] 	= $last_id;
							$insert_sql_array['item_id'] 	= $item_id[$i];
							$insert_sql_array['hsn_no'] 	= $hsn_no[$i];
							$insert_sql_array['unit_of_measurement'] 	= $unit_of_measurement[$i];
							$insert_sql_array['in_hand_stock'] 	= $in_hand_stock[$i];
							$insert_sql_array['tax1'] 	= $tax1[$i];
							$insert_sql_array['tax2'] 	= $tax2[$i];
							$insert_sql_array['tax2'] 	= $tax2[$i];
							$insert_sql_array['quantity'] 	= $quantity[$i];
							$insert_sql_array['transfer_quantity'] 	= $transfer_quantity[$i];
							$insert_sql_array['received_quantity'] 	= $received_quantity[$i];
							$insert_sql_array['rate'] 	= $rate[$i];
							$insert_sql_array['pre_tax_amt'] 	= $pre_tax_amt[$i];
							$insert_sql_array['tax_amt'] 	= $tax_amt[$i];
							$insert_sql_array['with_tax_amt'] 	= $with_tax_amt[$i];
							$this->db->insert(TBL_TRANSFER_ITEM,$insert_sql_array);
							$insert_sql_array = array();
							$insert_sql_array['item_id'] 	= $item_id[$i];
							$insert_sql_array['supplier_id'] 	= $this->supplier_id;
							$insert_sql_array['branch_id'] 	= $this->receiverBranchId;
							$insert_sql_array['stock'] 	= $received_quantity[$i];
							$this->db->insert(TBL_STOCK,$insert_sql_array);
							$insert_sql_array = array();
							$insert_sql_array['item_id'] 	= $item_id[$i];
							//$insert_sql_array['supplier_id'] 	= $this->supplier_id;
							$insert_sql_array['branch_id'] 	= $this->senderBranch_id;
							$insert_sql_array['stock'] 	= '-'.$received_quantity[$i];
							$this->db->insert(TBL_STOCK,$insert_sql_array);
							if($transfer_quantity[$i]- $received_quantity[$i]!=0)
							{
								$insert_sql_array = array();   
								$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
								$insert_sql_array['item_id'] 	= $item_id[$i];
								$insert_sql_array['item_name'] 	= $this->getItemDetail($item_id[$i],'name');
								$insert_sql_array['type'] 	= 'damage';
								$insert_sql_array['reason'] 	= 'transportation false';
								$insert_sql_array['waste_quantity'] 	= $this->getConversion($unit_name[$i],$unit_of_stock[$i])*($transfer_quantity[$i]- $received_quantity[$i]);
								$insert_sql_array['measurement_unit'] 	= $unit_of_measurement[$i];
								$insert_sql_array['cost_price'] 	= $this->getItemDetail($item_id[$i],'cost_price');
								$insert_sql_array['selling_price'] 	= $this->getItemDetail($item_id[$i],'selling_price');
								$insert_sql_array['rate'] 	= $rate[$i];
								$this->db->insert(TBL_SPOILAGE,$insert_sql_array);
							}
		 					$sql="select stock from ".TBL_MANAGE_STOCK." where 1 and (branch_id='".$_SESSION['branch_id']."' and item_id='".$item_id[$i]."') " ; 
							$result= $this->db->query($sql,__FILE__,__LINE__);
							$rows	=	$this->db->num_rows($result);
							if($rows==0)
							{ 
								$insert_sql_array = array();
								$insert_sql_array['item_id'] 	= $item_id[$i];
								$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
								$insert_sql_array['stock'] 	= $this->getCurrentInhandStock($_SESSION['branch_id'],$item_id[$i])+$this->getConversion($unit_name[$i],$unit_of_stock[$i])*$received_quantity[$i];
								$insert_sql_array['cost_price'] 	= $this->getItemDetail($item_id[$i],'cost_price');
								$insert_sql_array['selling_price'] 	= $this->getItemDetail($item_id[$i],'selling_price');
								$insert_sql_array['tax1'] 	= $this->getItemDetail($item_id[$i],'tax1');
								$insert_sql_array['tax2'] 	= $this->getItemDetail($item_id[$i],'tax2');
								$insert_sql_array['tax3'] 	= $this->getItemDetail($item_id[$i],'tax3');
								$this->db->insert(TBL_MANAGE_STOCK,$insert_sql_array);
								$update_sql_array = array();
								
							
								 
								$update_sql_array['branch_id'] 	= $this->senderBranch_id;
								$update_sql_array['stock'] 	= $this->getCurrentInhandStock($this->senderBranch_id,$item_id[$i])-$this->getConversion($unit_name[$i],$unit_of_stock[$i])*$received_quantity[$i];
								$this->db->updateByTwoIds(TBL_MANAGE_STOCK,$update_sql_array,'branch_id',$this->senderBranch_id,'item_id', $item_id[$i]);
							}
							else
							{
								
							
								 
								$update_sql_array = array();
								$update_sql_array['stock'] 	=$this->getCurrentInhandStock($_SESSION['branch_id'],$item_id[$i])+$this->getConversion($unit_name[$i],$unit_of_stock[$i])*$received_quantity[$i];
								$this->db->updateByTwoIds(TBL_MANAGE_STOCK,$update_sql_array,'branch_id',$_SESSION['branch_id'],'item_id', $item_id[$i]);
								
							
							
								$update_sql_array = array();
								$update_sql_array['item_id'] 	= $item_id[$i];
								$update_sql_array['branch_id'] 	= $this->senderBranch_id;
								$update_sql_array['stock'] 	= $this->getCurrentInhandStock($this->senderBranch_id,$item_id[$i])-$this->getConversion($unit_name[$i],$unit_of_stock[$i])*$received_quantity[$i];
								$this->db->updateByTwoIds(TBL_MANAGE_STOCK,$update_sql_array,'branch_id',$this->senderBranch_id,'item_id' ,$item_id[$i]);
								$sql_update1="update ".TBL_PURCHASE_ORDER."  set status='completed' where id='".$purchase_invoice_no."' ";
								$result= $this->db->query($sql_update1,__FILE__,__LINE__);
							}
							
							}
							$_SESSION['msg'] = 'Invoice has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "transfer.php?index=all";
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
$sql	=	"select * from ".TBL_MEMBER." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Employee</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['fname'];?>" name="fname" id="fname" placeholder="First Name">
                        </div>
                    </div>
                  	<div class="col-md-6">
                    <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['lname'];?>" name="lname" id="lname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label class="control-label">Gender</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio4">
                                    <input type="radio" id="example-radio4" name="gender" <?php if($row['gender']=='male') echo 'checked';?> value="male"> 
                                    <i class="fa"></i>
                                    MALE 
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio5">
                                    <input type="radio" id="example-radio5" name="gender" <?php if($row['gender']=='female') echo 'checked';?> value="female"> 
                                    <i class="fa"></i> 
                                    FEMALE
                                </label>
                            </div>
                         
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="company_id">Company Name</label>
                            <select class="form-control" name="company_id" id="company_id">
                            	<option value="">Select Company</option>
                                <?php 
                            $sql2="select * from ".TBL_COMPANY." where 1 order by heading asc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {
                            ?>
                            <option value="<?php echo $row2['id'];?>" <?php if($row['company_id']==$row2['id']) echo "selected=selected";?>><?php echo $row2['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="brand_id">Brand Name</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                            	<option value="">Select Brand</option>
							<?php 
                            $sql2="select * from ".TBL_BRAND." where 1 order by heading asc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {
                            ?>
                            <option value="<?php echo $row2['id'];?>" <?php if($row['brand_id']==$row2['id']) echo "selected=selected";?>><?php echo $row2['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="branch_id">Branch Name</label>
                            <select class="form-control" name="branch_id" id="branch_id">
                            	<option value="">Select Brand</option>
                                <?php 
                            $sql2="select * from ".TBL_BRANCH." where 1 order by heading asc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {
                            ?>
                            <option value="<?php echo $row2['id'];?>" <?php if($row['branch_id']==$row2['id']) echo "selected=selected";?>><?php echo $row2['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="aadhar">Aadhar Card Number</label>
                            <input class="form-control" type="text" placeholder="Aadhar Card Number" value="<?php echo $row['aadhar'];?>" id="aadhar" name="aadhar" required pattern="[0-9]{12}" title="Enter your 12 digits Aadhar Number">
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="pan">PAN Card Number</label>
                            <input type="pan" required class="form-control" name="pan" value="<?php echo $row['pan'];?>" id="pan" placeholder="PAN Card Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="phone">Phone Contact Number</label>
                            <input class="form-control" type="text" placeholder="Your Phone" value="<?php echo $row['phone'];?>" id="phone" name="phone" required pattern="[7-9]{1}[0-9]{9}" title="Enter your 10 digit mobile number only, Starting from 9,8 or 7">
                          
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="user_role">User Role</label>
                            <input type="text"  class="form-control" name="user_role" value="<?php echo $row['user_role'];?>" id="user_role" placeholder="User Role">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="office_email">Office Email ID</label>
                            <input type="email" required class="form-control" value="<?php echo $row['office_email'];?>" name="office_email" id="office_email" placeholder="Office Email ID">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="personal_email">Personal Email ID</label>
                            <input type="email" required class="form-control" value="<?php echo $row['personal_email'];?>" name="personal_email" id="personal_email" placeholder="Personal Email ID">
                        </div>
                    </div>
                         <div class="col-md-6">
                    <div class="form-group">
                            <label for="c_address">Communiation Address</label>
                            <input type="text"  class="form-control" value="<?php echo $row['address'];?>" name="c_address" id="c_address" placeholder="Communication Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="c_pincode">Pincode</label>
                            <input type="text"  class="form-control" value="<?php echo $row['c_pincode'];?>" name="c_pincode" id="c_pincode" placeholder="Pincode">
                        </div>
                    </div>
                         <div class="col-md-6">
                    <div class="form-group">
                            <label for="p_address">Permanent Address</label>
                            <input type="text"  class="form-control" value="<?php echo $row['p_address'];?>" name="p_address" id="p_address" placeholder="Permanent Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="p_pincode">Pincode</label>
                            <input type="text"  class="form-control" value="<?php echo $row['p_pincode'];?>" name="p_pincode" id="p_pincode" placeholder="Pincode">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="employee_code">Employee Code</label>
                            <input type="text"  class="form-control" value="<?php echo $row['employee_code'];?>" name="employee_code" id="employee_code" placeholder="Employee Code">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text"  class="form-control" value="<?php echo $row['department'];?>" name="department" id="department" placeholder="Department">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="esci_number">ESCI No</label>
                            <input type="text"  class="form-control" value="<?php echo $row['pan'];?>" name="esci_no" id="esci_number" placeholder="ESCI No">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="pay_grade">Pay Grade</label>
                            <input type="text"  class="form-control" value="<?php echo $row['pay_grade'];?>" name="pay_grade" id="pay_grade" placeholder="Pay Grade">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="designation">Designation in Company</label>
                            <input type="text"  class="form-control" value="<?php echo $row['designation'];?>" name="designation" id="designation" placeholder="Designation in Company">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="pf_no">PF Number</label>
                            <input type="text"  class="form-control" value="<?php echo $row['pf_no'];?>" name="pf_no" id="pf_no" placeholder="PF Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="uan_no">UAN Number</label>
                            <input type="text"  class="form-control" value="<?php echo $row['uan_no'];?>" name="uan_no" id="uan_no" placeholder="UAN Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="basic_salary">Basic Salary</label>
                            <input type="text"  class="form-control" value="<?php echo $row['basic_salary'];?>" name="basic_salary" id="basic_salary" placeholder="Basic Salary">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="conveyance">Conveyance</label>
                            <input type="text"  class="form-control" value="<?php echo $row['conveyance'];?>" name="conveyance" id="conveyance" placeholder="Conveyance">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="cca">CCA</label>
                            <input type="text"  class="form-control" value="<?php echo $row['cca'];?>" name="cca" id="cca" placeholder="CCA">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="hra">HRA</label>
                            <input type="text"  class="form-control" value="<?php echo $row['hra'];?>" name="hra" id="hra" placeholder="HRA">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="basicedu_allowance_salary">Edu Allowance</label>
                            <input type="text"  class="form-control" value="<?php echo $row['edu_allowance'];?>" name="edu_allowance" id="edu_allowance" placeholder="Edu Allowance">
                        </div>
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
	$this->company_id=$company_id;
	$this->brand_id=$brand_id;
	$this->branch_id=$branch_id;
	$this->fname=$fname;
	$this->lname=$lname;
	$this->gender=$gender;
	$this->aadhar=$aadhar;
	$this->pan=$pan;
	$this->phone=$phone;
	$this->user_role=$user_role;
	$this->office_email=$office_email;
	$this->personal_email=$personal_email;
	$this->c_address=$c_address;
	$this->c_pincode=$c_pincode;
	$this->p_address=$p_address;
	$this->p_pincode=$p_pincode;
	$this->employee_code=$employee_code;
	$this->esci_no=$esci_no;
	$this->pay_grade=$pay_grade;
	$this->designation=$designation;
	$this->pf_no=$pf_no;
	$this->uan_no=$uan_no;
	$this->basic_salary=$basic_salary;
	$this->conveyance=$conveyance;
	$this->cca=$cca;
	$this->hra=$hra;
	$this->edu_allowance=$edu_allowance;
	
	
	
	$this->username=$username;
	$this->password=$password;
	if($company_id!='' && $brand_id!='' && $branch_id!='')
	{ 
	$this->user_type='employee';
	}
	elseif($company_id!='' && $brand_id!='')
	{
	$this->user_type='brand_admin';
	}
	else
	{
	$this->user_type='company_admin';
	}
	$return =true;
	
	if($this->Form->ValidField($fname,'empty','Please Enter First Name')==false)
	$return =false;
	if($this->Form->ValidField($lname,'empty','Please Enter Last Name')==false)
	$return =false;
	if($this->Form->ValidField($office_email,'empty','Please Enter Email')==false)
	$return =false;
	if($this->Form->ValidField($phone,'empty','Please Enter Phone')==false)
	$return =false;
	$sql="select * from ".TBL_USER." where 1 AND username='".$this->username."' order by id desc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->num_rows($result);
	if($row==0){
	if($return){
	$update_sql_array = array();
	$update_sql_array['company_id'] 	= $this->company_id;
	$update_sql_array['brand_id'] 	= $this->brand_id;
	$update_sql_array['branch_id'] 	= $this->branch_id;
	$update_sql_array['fname'] 	= $this->fname;
	$update_sql_array['lname'] 	= $this->lname;
	$update_sql_array['gender'] 	= $this->gender;
	$update_sql_array['aadhar'] 	= $this->aadhar;
	$update_sql_array['pan'] 	= $this->pan;
	$update_sql_array['phone'] 	= $this->phone;
	$update_sql_array['user_role'] 	= $this->user_role;
	
	$update_sql_array['office_email'] 	= $this->office_email;
	$update_sql_array['personal_email'] 	= $this->personal_email;
	$update_sql_array['c_address'] 	= $this->c_address;
	$update_sql_array['c_pincode'] 	= $this->c_pincode;
	$update_sql_array['p_address'] 	= $this->p_address;
	$update_sql_array['p_pincode'] 	= $this->p_pincode;
	$update_sql_array['employee_code'] 	= $this->employee_code;
	$update_sql_array['esci_no'] 	= $this->esci_no;
	$update_sql_array['pay_grade'] 	= $this->pay_grade;
	$update_sql_array['designation'] 	= $this->designation;
	
	$update_sql_array['pf_no'] 	= $this->pf_no;
	$update_sql_array['uan_no'] 	= $this->uan_no;
	$update_sql_array['basic_salary'] 	= $this->basic_salary;
	$update_sql_array['conveyance'] 	= $this->conveyance;
	$update_sql_array['cca'] 	= $this->cca;
	$update_sql_array['hra'] 	= $this->hra;
	$update_sql_array['edu_allowance'] 	= $this->edu_allowance;
	$this->db->update(TBL_MEMBER,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Employee has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "transfer.php?index=all";
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
	?>
	<div class="alert alert-danger"><li>Username Already Exists in database..!</li></div>
	<?php 
	$this->editpage('local',$id);
	}
	break;
	default 	: 
	echo "Wrong Parameter passed";
	}
	
}	
	
	
}
?>