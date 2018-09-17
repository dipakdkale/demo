<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.menu_ingradient.php");
include_once("function/class.purchase_invoice.php");
//$branch_obj=new Branch();
$pur_invoice_obj=new PurchaseInvoice();
$ingrad_obj=new MenuIngradient();
$homepage = new HomePage();
extract($_REQUEST);
if($index=='get_sub_category')
{
	$data1='<option value="" >Select Sub Category</option>';
	$sql="select * from ".TBL_SUB_CATEGORY." where 1 and category_id='".$cat_id."' order by name asc" ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$x=1;
	while($row = $homepage->db->fetch_array($result))
	{	
	$data1.='<option value="'.$row['id'].'" >'.$row['name'].'</option>';
	}
	echo $data1;
}
if($index=='get_sub_category_for_pos')
{
	$data1='';
	$sql="select * from ".TBL_SUB_CATEGORY." where 1 and category_id='".$cat_id."' order by name asc" ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$x=1;
	while($row = $homepage->db->fetch_array($result))
	{	
	$data1.='<button class="btn btn-pink m-b-5 btn_sub_cat" value="'.$row['id'].'">'.$row['name'].'</button> ';
	}
	echo $data1;
}

if($index=='get_product_grid')
{
	$data1='';
	$sql="select * from ".TBL_PRODUCT." where 1 and sub_category_id='".$sub_id."'   order by name asc" ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$x=1;
	while($row = $homepage->db->fetch_array($result))
	{	
		
	$data1.='<div class="col-md-3">';
	$data1.='<img src="img/foo.png" style="width:100; cursor:pointer;" data-id="'.$row['category_id'].'"  class="span_product" id="'.$row['id'].'"><h4>'.$row['name'].'</h4>';
	$data1.='</div>';
	$x++;
	}
	
	
	echo $data1;
}


if($index=='get_items')
{
	$data33='<ul  id="list_item" style="list-style:none; background:#ccc;">';
	$sql="select * from ".TBL_ITEMS." where 1 and branch_id='".$_SESSION['branch_id']."' and name like '%".$name."%' order by name asc" ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$num_rows= $homepage->db->num_rows($result);
	$x=1;
	if($num_rows>0)
	{
		while($row = $homepage->db->fetch_array($result))
		{
			$data33.=' <li  data-id="'.$row['id'].'" style="">'.$row['name'].'</li>';
			$x++;
		}
	}
	else
	{
		$data33 .='<li> Data Not Found.!</li>';
	}
	$data33.='</ul>';
	echo $data33;
}
if($index=='get_measurement')	
{
	$sql="select * from ".TBL_ITEMS." where 1 and id='".$id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	$sql2	=	"select * from ".TBL_MEASUREMENT." where id=".$row['measurement']."";
	$res	=	$homepage->db->query($sql2,__FILE__,__LINE__);
	$row2	=	$homepage->db->fetch_array($res);
	echo $row2['name'];
}
if($index=='get_editable_data')
{
	$data11=array();
	$sql	=	"select * from ".TBL_PRODUCT_INGRADIENT." where id=".$ing_id."";
	$res	=	$homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($res);
	$data11['ing_id']=$row['id'];
	$data11['item_name']= $ingrad_obj->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'name');
	$data11['measurement_unit']=$ingrad_obj->getMeasurement($ingrad_obj->getMoreDetail(TBL_ITEMS,$row['ingradient_id'],'measurement'));
	$data11['quantity']=$row['quantity'];
	$record=json_encode($data11);
	echo $record;
}
if($index=='get_product_data')
{
	$dataxx='';
	$sql_update="update ".TBL_MASTER_TABLE." set status='booked' where id='".$tbl_id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
	$sql="select * from ".TBL_PRODUCT." where 1 and id='".$pro_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$x=1;
	$row	=	$homepage->db->fetch_array($result);
	
		$dataxx.='<tr class="success tbl_row"><input type="hidden" class="pro_id" name="pro_id[]" value="'.$pro_id.'">
		<td>'.$row['name'].'<input type="hidden" name="pro_name[]" value="'.$row['name'].'"></td>
				<td>'.$row['quantity'].'<input type="hidden" name="quantity[]" id="td_qty'.$tr_count.'" data-id="'.$pro_id.'" class="td_qty" value="'.$row['quantity'].'"></td>
				
				<td>'.$row['selling_price'].'<input type="hidden" name="selling_price[]" data-id="'.$pro_id.'" id="td_amt'.$tr_count.'" value="'.$row['selling_price'].'"></td>
				<td><input type="number"  style="width:30px;" name="quantity[]" id="td_perior'.$tr_count.'"  class="td_perior" value="1"></td>
				<td><a class="btn_delete btn btn-danger" id="'.$row['id'].'" ><i class="fa fa-trash"></i></a></td> ';
		$dataxx.='</tr>';
	$insert_sql_array = array();
	$insert_sql_array['table_id'] 	= $tbl_id;
	$insert_sql_array['item_id'] 	= $pro_id;
	$insert_sql_array['item_name'] 	= $row['name'];
	$insert_sql_array['periority'] 	= 1;
	$insert_sql_array['quantity'] 	= $row['quantity'];
	$insert_sql_array['selling_price_without_tax'] 	= $row['selling_price_without_tax'];
	$insert_sql_array['price'] 	= $row['selling_price'];
	$insert_sql_array['total_price'] 	= $row['selling_price'];
	$insert_sql_array['category_id'] 	= $row['category_id'];
	$insert_sql_array['tax_slab'] 	= $row['tax_slab'];
	$insert_sql_array['tax_slab_amt'] 	= $row['tax_slab_amt'];
	$insert_sql_array['total_tax_slab_amt'] 	= $row['tax_slab_amt'];
	$insert_sql_array['order_date'] 	= $homepage->getSoftwareDate();
	$homepage->db->insert(TBL_POS_ITEM_TEMP,$insert_sql_array);
	
	
	
	echo $dataxx;
}
if($index=='get_product_data2')
{
	$dataxx='';
	$sql_update="update ".TBL_CUSTOMER." set status='on_going' where id='".$cus_id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
	$sql="select * from ".TBL_PRODUCT." where 1 and id='".$pro_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$x=1;
	$row	=	$homepage->db->fetch_array($result);
	
		$dataxx.='<tr class="success tbl_row"><input type="hidden" class="pro_id" name="pro_id[]" value="'.$pro_id.'">
		<td>'.$row['name'].'<input type="hidden" name="pro_name[]" value="'.$row['name'].'"></td>
				<td>'.$row['quantity'].'<input type="hidden" name="quantity[]" id="td_qty'.$tr_count.'" data-id="'.$pro_id.'" class="td_qty" value="'.$row['quantity'].'"></td>
				<td>'.$row['selling_price'].'<input type="hidden" name="selling_price[]" data-id="'.$pro_id.'" id="td_amt'.$tr_count.'" value="'.$row['selling_price'].'"></td>
				<td><a class="btn_delete btn btn-danger" id="'.$row['id'].'" ><i class="fa fa-trash"></i></a></td> ';
			$dataxx.='</tr>';
	$insert_sql_array = array();
	$insert_sql_array['customer_id'] 	= $cus_id;
	$insert_sql_array['item_id'] 	= $pro_id;
	$insert_sql_array['item_name'] 	= $row['name'];
	$insert_sql_array['quantity'] 	= $row['quantity'];
	$insert_sql_array['cost_price_without_tax'] 	= $row['cost_price_without_tax'];
	$insert_sql_array['price'] 	= $row['selling_price'];
	$insert_sql_array['category_id'] 	= $row['category_id'];
	$insert_sql_array['tax_slab'] 	= $row['tax_slab'];
	$insert_sql_array['tax_slab_amt'] 	= $row['tax_slab_amt'];
	$homepage->db->insert(TBL_TAKE_AWAY_ITEM_TEMP,$insert_sql_array);
	
	echo $dataxx;
}

if($index=='get_product_data3')
{
	$dataxx='';
	$sql_update="update ".TBL_CUSTOMER." set status='on_going' where id='".$cus_id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
	$sql="select * from ".TBL_PRODUCT." where 1 and id='".$pro_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$x=1;
	$row	=	$homepage->db->fetch_array($result);
	
		$dataxx.='<tr class="success tbl_row"><input type="hidden" class="pro_id" name="pro_id[]" value="'.$pro_id.'">
		<td>'.$row['name'].'<input type="hidden" name="pro_name[]" value="'.$row['name'].'"></td>
				<td>'.$row['quantity'].'<input type="hidden" name="quantity[]" id="td_qty'.$tr_count.'" data-id="'.$pro_id.'" class="td_qty" value="'.$row['quantity'].'"></td>
				<td>'.$row['selling_price'].'<input type="hidden" name="selling_price[]" data-id="'.$pro_id.'" id="td_amt'.$tr_count.'" value="'.$row['selling_price'].'"></td>
				<td><a class="btn_delete btn btn-danger" id="'.$row['id'].'" ><i class="fa fa-trash"></i></a></td> ';
			$dataxx.='</tr>';
	$insert_sql_array = array();
	$insert_sql_array['customer_id'] 	= $cus_id;
	$insert_sql_array['item_id'] 	= $pro_id;
	$insert_sql_array['item_name'] 	= $row['name'];
	$insert_sql_array['quantity'] 	= $row['quantity'];
	$insert_sql_array['cost_price_without_tax'] 	= $row['cost_price_without_tax'];
	$insert_sql_array['price'] 	= $row['selling_price'];
	$insert_sql_array['category_id'] 	= $row['category_id'];
	$insert_sql_array['tax_slab'] 	= $row['tax_slab'];
	$insert_sql_array['tax_slab_amt'] 	= $row['tax_slab_amt'];
	$homepage->db->insert(TBL_HOME_DELIVERY_ITEM_TEMP,$insert_sql_array);
	
	echo $dataxx;
}

if($index=='update_active_status'){
	$sql="select * from ".TBL_PRODUCT." where 1 and id='".$id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	if($row['is_active']=='yes'){
		$set_status='no';
	}
	else{
		$set_status='yes';
	}
	$sql2="update ".TBL_PRODUCT." set is_active='".$set_status."' where id='".$id."' " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
}
if($index=='update_category_hide'){
	$hide_for=array();
	
	$sql="select * from ".$tbl_name." where 1 and id='".$id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	if($row['hide_for']==''){
		array_push($hide_for,$_SESSION['branch_id']);
		$str_hide_for=implode(', ',$hide_for);
	}
	else{
		$array_hide_for=explode(', ',$row['hide_for']);
		array_push($array_hide_for,$_SESSION['branch_id']);
		$str_hide_for=implode(', ',$array_hide_for);
	}
	$sql2="update ".$tbl_name." set hide_for='".$str_hide_for."' where id='".$id."' " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
}
if($index=='update_category_show'){
	$hide_for=array();
	
	$sql="select * from ".$tbl_name." where 1 and id='".$id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	 $replaced_str=str_replace($_SESSION['branch_id'],'##',$row['hide_for']);
	 $array_replace=explode(', ',$replaced_str);
	 if (($key = array_search('##', $array_replace)) !== false) {
   	 unset($array_replace[$key]);
	 }
	 $replaced_str=implode(', ',$array_replace);
	$sql2="update ".$tbl_name." set hide_for='".$replaced_str."' where id='".$id."' " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
}

if($index=='get_purchase_invoice'){
	$data21='<option value="" >Select Invoice Number</option>';
	$sql="select * from ".TBL_PURCHASE_ORDER." where 1 and supplier_id='".$supplier_id."' order by id desc" ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$x=1;
	while($row = $homepage->db->fetch_array($result))
	{	
	$data21.='<option value="'.$row['id'].'" >'.$row['purchase_invoice_no'].'</option>';
	}
	echo $data21;
}
if($index=='get_purchase_items'){
$data2='';
$sql="select * from ".TBL_PURCHASE_ITEM." where 1 and order_id='".$id."' " ;
$result= $homepage->db->query($sql,__FILE__,__LINE__);
$x=0;
while($row	=	$homepage->db->fetch_array($result))
{
	//$unit_ofcurrent_stock=$ingrad_obj->getMeasurement($ingrad_obj->getMoreDetail(TBL_ITEMS,$row['item_id'],'measurement'));
	$data2.='<tr><td>'.++$x.'</td>
			<td>'.$row["item_name"].'<input type="hidden" name="item_id[]" value="'.$row['item_id'].'"></td>
			<td>'.$row["hsn_no"].'<input type="hidden" name="hsn_no[]" value="'.$row['hsn_no'].'"></td>
			<td>'.$ingrad_obj->getMeasurement($row["unit_of_measurement"]).'<input value="'.$ingrad_obj->getMeasurement($row["unit_of_measurement"]).'" type="hidden" name="unit_name[]"><input type="hidden" name="unit_of_measurement[]" value="'.$row['unit_of_measurement'].'"></td>
			<td>'.$row["in_hand_stock"]." ".$ingrad_obj->getMeasurement($ingrad_obj->getMoreDetail(TBL_ITEMS,$row['item_id'],'measurement')).'<input type="hidden" name="unit_of_stock[]" value="'.$ingrad_obj->getMeasurement($ingrad_obj->getMoreDetail(TBL_ITEMS,$row['item_id'],'measurement')).'"><input type="hidden" name="in_hand_stock[]" value="'.$row["in_hand_stock"].'"></td>
			<td>'.$ingrad_obj->getMoreDetail(TBL_TAX_SLAB,$row["tax1"],"name").'<input type="hidden" value="'.$row["tax1"].'" data-id="'.$ingrad_obj->getMoreDetail(TBL_TAX_SLAB,$row["tax1"],"percentage").'" id="tax1_per'.$x.'" name="tax1[]" class="tax_structure"></td>
			<td>'.$ingrad_obj->getMoreDetail(TBL_TAX_SLAB,$row["tax2"],"name").'<input type="hidden" value="'.$row["tax2"].'" data-id="'.$ingrad_obj->getMoreDetail(TBL_TAX_SLAB,$row["tax2"],"percentage").'" id="tax2_per'.$x.'" name="tax2[]" class="tax_structure"></td>
			<td>'.$ingrad_obj->getMoreDetail(TBL_TAX_SLAB,$row["tax3"],"name").'<input type="hidden" value="'.$row["tax3"].'" data-id="'.$ingrad_obj->getMoreDetail(TBL_TAX_SLAB,$row["tax3"],"percentage").'" id="tax3_per'.$x.'" name="tax3[]" class="tax_structure"></td>
			<td>'.$row["projected_quantity"]." ".$ingrad_obj->getMeasurement($row["unit_of_measurement"]).'<input type="hidden" name="quantity[]" value="'.$row["projected_quantity"].'"></td>
			<td><input type="text" name="transfer_quantity[]" style="width:80px;" class="transfer_quantity" value="0" id="transfer_quantity'.$x.'"></td>
			<td><input type="text" name="received_quantity[]"  class="received_quantity" style="width:80px;"  value="0" id="received_quantity'.$x.'"></td>
			<td><input type="text" name="rate[]" value="'.$row["rate"].'" class="rate" id="rate'.$x.'" style="width:80px;"></td>	
			<td><input type="text" value="'.$row["pre_tax_amt"].'" name="pre_tax_amt[]" id="pre_tax_amt'.$x.'" style="width:80px;" class="pre_tax_amt"> </td>	
			<td><input type="text" name="tax_amt[]" value="'.$row["tax_amt"].'" class="tax_amt" id="tax_amt'.$x.'" style="width:80px;"></td>
			<td><input type="text" name="with_tax_amt[]" value="'.$row["with_tax_amt"].'" class="with_tax_amt" id="with_tax_amt'.$x.'" style="width:80px;"></td>
			</td></tr>';
			
}
echo $data2;
}
if($index=='get_purchase_order_detail'){
	$data2222=array();
	$sql="select * from ".TBL_PURCHASE_ORDER." where 1 and id='".$id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	$data2222['user_name']=$row['user_name'];
	$data2222['current_date']=$row['current_date'];
	$data2222['manufacturing_date']=$row['manufacturing_date'];
	$data2222['purchase_time']=$row['purchase_time'];
	$data2222['quantity_total']=$row['quantity_total'];
	
	$data2222['pre_tax_amt_total']=$row['pre_tax_amt_total'];
	$data2222['tax_amt_total']=$row['tax_amt_total'];
	
	
	$data2222['total_amt']=$row['total_amt'];
	$data2222['discount']=$row['discount'];
	$data2222['bill_after_discount']=$row['bill_after_discount'];
	$data2222['transportation_charge']=$row['transportation_charge'];
	$data2222['handling_charge']=$row['handling_charge'];
	$data2222['grand_total_amt']=$row['grand_total_amt'];
	echo json_encode($data2222);
}
if($index=='get_stock'){
	$data='';
	$sql="select stock from ".TBL_MANAGE_STOCK." where 1 and item_id='".$pur_invoice_obj->getItemId($name)."' and branch_id='".$_SESSION['branch_id']."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	$sql2="select hsl_category_no from ".TBL_SUB_CATEGORY." where 1 and id='".$pur_invoice_obj->getItemDetailByName($name,'sub_category_id')."' " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
	$row2	=	$homepage->db->fetch_array($result2);
	$data['hsn_no']=$row2['hsl_category_no'];
	
	$sql_unit="select id,base_unit from ".TBL_MEASUREMENT." where 1 and id='".$pur_invoice_obj->getItemDetailByName($name,'measurement')."' " ;
	$result_unit= $homepage->db->query($sql_unit,__FILE__,__LINE__);
	$row_unit	=	$homepage->db->fetch_array($result_unit);
	$data['measurement']=$row_unit['base_unit'];
	$data['measurement_unit']=$row_unit['id'];
	
	$sql_tax1="select id,name,percentage from ".TBL_TAX_SLAB." where 1 and id='".$pur_invoice_obj->getItemDetailByName($name,'tax1')."' " ;
	$result_tax1= $homepage->db->query($sql_tax1,__FILE__,__LINE__);
	$row_tax1	=	$homepage->db->fetch_array($result_tax1);
	$data['tax1_id']=$row_tax1['id'];
	$data['tax1_name']=$row_tax1['name'];
	$data['tax1_percentage']=$row_tax1['percentage'];
	
	$sql_tax2="select id,name,percentage from ".TBL_TAX_SLAB." where 1 and id='".$pur_invoice_obj->getItemDetailByName($name,'tax2')."' " ;
	$result_tax2= $homepage->db->query($sql_tax2,__FILE__,__LINE__);
	$row_tax2	=	$homepage->db->fetch_array($result_tax2);
	$data['tax2_id']=$row_tax2['id'];
	$data['tax2_name']=$row_tax2['name'];
	$data['tax2_percentage']=$row_tax2['percentage'];
	
	$sql_tax3="select id,name,percentage from ".TBL_TAX_SLAB." where 1 and id='".$pur_invoice_obj->getItemDetailByName($name,'tax3')."' " ;
	$result_tax3= $homepage->db->query($sql_tax3,__FILE__,__LINE__);
	$row_tax3	=	$homepage->db->fetch_array($result_tax3);
	$data['tax3_id']=$row_tax3['id'];
	$data['tax3_name']=$row_tax3['name'];
	$data['tax3_percentage']=$row_tax3['percentage'];
	
	$all_tax=$row_tax1['percentage']+$row_tax2['percentage']+$row_tax3['percentage'];
	
	$unit=$pur_invoice_obj->getMeasurement($pur_invoice_obj->getItemDetailByName($name,'measurement'));
	$data['quantity']=$row['stock'];
	$data['quantity_with_unit']= $row['stock']." ".$unit;
	$data['measure_unit']=$unit;
	$x=1;
	$qua_total=0;
	$ondate = date('Y-m-d', strtotime('-1 day'));
	$b_date = explode('-',$ondate);
	$ondate_to=array();
	for($i=7;$i<=49;)
	{
		$ondate_to[] = date('Y-m-d',mktime(0,0,0,$b_date[1],$b_date[2]-$i,$b_date[0]));
		$i+=7;
		$x++;
	}
		$ondate123=implode("','",$ondate_to); 
		$sql3="select count(A.id) as denomin ,sum(A.quantity) as item_value ,sum(A.rate) as avg_rate from ".TBL_PURCHASE_ITEM." AS A LEFT JOIN ".												TBL_PURCHASE_ORDER." as B ON A.order_id=B.id where 1 and B.manufacturing_date in ('".$ondate123."') and A.item_id='".$pur_invoice_obj->getItemId($name)."'  " ;
		$result3= $homepage->db->query($sql3,__FILE__,__LINE__);
	$row3	=	$homepage->db->fetch_array($result3);
	if($row3['denomin']==0)
	{
		$qua_total=0;
		$rate_total=0;
	}
	else
	{
		 $qua_total=round($row3['item_value']/$row3['denomin'],2);
		 $rate_total=round($row3['avg_rate']/$row3['denomin'],2);
	}
	$data['avg_quantity']=$qua_total;
	$data['avg_rate']=$rate_total;
	$projected_quantity=($qua_total*$projected_per)/100;
	$data['projected_quantity']=$projected_quantity;
	$total_pre_tax_amt=$projected_quantity*$rate_total;
	$data['total_pre_tax_amt']=$total_pre_tax_amt;
	$tax_amount=($all_tax*$total_pre_tax_amt)/100;
	$data['tax_amount']=round($tax_amount,2);
	$with_tax_amount=$tax_amount+$total_pre_tax_amt;
	$data['with_tax_amount']=round($with_tax_amount,2);
	echo json_encode($data);
	
}
if($index=='get_realive_units'){
	$sql="select unit_type from ".TBL_MEASUREMENT." where 1 and name='".$unit."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row2	=	$homepage->db->fetch_array($result);
	$sql2="select * from ".TBL_MEASUREMENT." where 1 and unit_type='".$row2['unit_type']."' " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
	$data='<option value="">Select Unit </option>';
	while($row	=	$homepage->db->fetch_array($result2))
	{
		$data.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
	echo $data;
}


if($index=='get_supplier'){
	$sql="select * from ".TBL_SUPPLIER." where 1 and supplier_type='".$supplier_type."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$data='<option value="">Select Supplier </option>';
	while($row	=	$homepage->db->fetch_array($result))
	{
		$data.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
	echo $data;
}
if($index=='get_brand'){
	$sql="select * from ".TBL_BRAND." where 1 and company_id='".$comp_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$data='<option value="">Select Brand</option>';
	while($row	=	$homepage->db->fetch_array($result))
	{
		$data.='<option value="'.$row['id'].'">'.$row['heading'].'</option>';
	}
	echo $data;
}
if($index=='get_branch'){
	$sql="select * from ".TBL_BRANCH." where 1 and brand_id='".$branch_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$data='<option value="">Select Branch</option>';
	while($row	=	$homepage->db->fetch_array($result))
	{
		$data.='<option value="'.$row['id'].'">'.$row['heading'].'</option>';
	}
	echo $data;
}
if($index=='get_product_kot_for_pos'){
	
	
	/*$sql="select distinct(category_id) from ".TBL_POS_ITEM_TEMP." where 1 and is_kot_print='0' and table_id='".$table_id."'  " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	while($row	=	$homepage->db->fetch_array($result))
	{
	
	}*/
	$sql2="select * from ".TBL_POS_ITEM_TEMP." where 1 and table_id='".$table_id."' and is_kot_print='0' order by periority asc  " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
	while($row2	=	$homepage->db->fetch_array($result2))
	{
	$insert_sql_array=array();
	$insert_sql_array['table_id'] 	= $table_id;
	$insert_sql_array['is_print_kot'] 	= 'no';
	$insert_sql_array['category_id'] 	= $row2['category_id'];
	$insert_sql_array['branch_id']=$_SESSION['branch_id'];
	$homepage->db->insert(TBL_KOT,$insert_sql_array);
	$last_id=$homepage->db->last_insert_id();
	$insert_sql_array=array();
	$insert_sql_array['kot_id'] 	= $last_id;
	$insert_sql_array['category_id'] 	= $row2['category_id'];
	$insert_sql_array['product_name'] 	= $row2['item_name'];
	$insert_sql_array['quantity'] 	= $row2['quantity'];
	$homepage->db->insert(TBL_KOT_ITEM,$insert_sql_array);
	}
	
	$sql_update="update ".TBL_POS_ITEM_TEMP." set is_kot_print='1' where table_id='".$table_id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
	
	
}
if($index=='get_product_kot_for_take_away'){
	
	
	/*$sql="select distinct(category_id) from ".TBL_POS_ITEM_TEMP." where 1 and is_kot_print='0' and table_id='".$table_id."'  " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	while($row	=	$homepage->db->fetch_array($result))
	{
	
	}*/
	$sql2="select * from ".TBL_TAKE_AWAY_ITEM_TEMP." where 1 and customer_id='".$cus_id."' and is_kot_print='0'  " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
	while($row2	=	$homepage->db->fetch_array($result2))
	{
	$insert_sql_array=array();
	$insert_sql_array['table_id'] 	= $cus_id;
	$insert_sql_array['is_print_kot'] 	= 'no';
	$insert_sql_array['category_id'] 	= $row2['category_id'];
	$homepage->db->insert(TBL_KOT,$insert_sql_array);
	$last_id=$homepage->db->last_insert_id();
	$insert_sql_array=array();
	$insert_sql_array['kot_id'] 	= $last_id;
	$insert_sql_array['category_id'] 	= $row2['category_id'];
	$insert_sql_array['product_name'] 	= $row2['item_name'];
	$insert_sql_array['quantity'] 	= $row2['quantity'];
	$homepage->db->insert(TBL_KOT_ITEM,$insert_sql_array);
	}
	
	$sql_update="update ".TBL_TAKE_AWAY_ITEM_TEMP." set is_kot_print='1' where customer_id='".$cus_id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
	
	
}
if($index=='get_product_kot_for_home_delivery'){
	
	
	/*$sql="select distinct(category_id) from ".TBL_POS_ITEM_TEMP." where 1 and is_kot_print='0' and table_id='".$table_id."'  " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	while($row	=	$homepage->db->fetch_array($result))
	{
	
	}*/
	$sql2="select * from ".TBL_HOME_DELIVERY_ITEM_TEMP." where 1 and customer_id='".$cus_id."' and is_kot_print='0'  " ;
	$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
	while($row2	=	$homepage->db->fetch_array($result2))
	{
	$insert_sql_array=array();
	$insert_sql_array['table_id'] 	= $cus_id;
	$insert_sql_array['is_print_kot'] 	= 'no';
	$insert_sql_array['category_id'] 	= $row2['category_id'];
	$homepage->db->insert(TBL_KOT,$insert_sql_array);
	$last_id=$homepage->db->last_insert_id();
	$insert_sql_array=array();
	$insert_sql_array['kot_id'] 	= $last_id;
	$insert_sql_array['category_id'] 	= $row2['category_id'];
	$insert_sql_array['product_name'] 	= $row2['item_name'];
	$insert_sql_array['quantity'] 	= $row2['quantity'];
	$homepage->db->insert(TBL_KOT_ITEM,$insert_sql_array);
	}
	
	$sql_update="update ".TBL_HOME_DELIVERY_ITEM_TEMP." set is_kot_print='1' where customer_id='".$cus_id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
	
	
}
if($index=='change_kot_status')
{
	$sql4="select * from ".TBL_MANAGE_PRINTER." where 1 and id='".$id."' order by id asc " ;
    $result4= $homepage->db->query($sql4,__FILE__,__LINE__);
	$row4	=	$homepage->db->fetch_array($result4);
	$category=explode(', ',$row4['category']);
	foreach($category as $cat_id) 
	{
		$sql_status="update ".TBL_KOT." set is_print_kot='yes' where category_id='".$cat_id."' "	;
		$homepage->db->query($sql_status,__FILE__,__LINE__);
	}
}
if($index=='cancel_order')
{
$sql_update="update ".TBL_MASTER_TABLE." set status='vacant' where id='".$table_id."' ";
$homepage->db->query($sql_update,__FILE__,__LINE__);	
$delete = "DELETE FROM ".TBL_POS_ITEM_TEMP." WHERE table_id='".$table_id."' ";
$homepage->db->query($delete,__FILE__,__LINE__);
$sql2="select * from ".TBL_KOT." where 1 and table_id='".$table_id."'   " ;
$result2= $homepage->db->query($sql2,__FILE__,__LINE__);
while($row2	=	$homepage->db->fetch_array($result2))
{
$delete = "DELETE FROM ".TBL_KOT_ITEM." WHERE kot_id='".$row2['id']."' ";
$homepage->db->query($delete,__FILE__,__LINE__);
}
$delete = "DELETE FROM ".TBL_KOT." WHERE table_id='".$table_id."' ";
$homepage->db->query($delete,__FILE__,__LINE__);
}
if($index=='set_periority'){
	$sql_update="update ".TBL_POS_ITEM_TEMP." set periority='".$perior."' where id='".$id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
}
if($index=='update_quantity'){
	$sql_update="update ".TBL_POS_ITEM_TEMP." set quantity='".$quantity."',total_price='".$price."', total_tax_slab_amt='".$total_tax_slab_amt."' where id='".$id."' ";
	$homepage->db->query($sql_update,__FILE__,__LINE__);
}
if($index=='product_brnch_mapping_for_pos'){
	$pos_array=array();
	$invent_array=array();
	$sql4="select branch_id_for_pos from ".TBL_PRODUCT." where 1 and id='".$pro_id."' order by id asc " ;
    $result4= $homepage->db->query($sql4,__FILE__,__LINE__);
	$row4	=	$homepage->db->fetch_array($result4);
	if($row4['branch_id_for_pos']=='')
	{
		$sql_update="update ".TBL_PRODUCT." set branch_id_for_pos='".$branch_id.", "."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
	}
	else
	{
		
		$pos=explode(', ',$row4['branch_id_for_pos']);
		if(!in_array($branch_id,$pos)){
		array_push($pos,$branch_id);
		$str_pos=implode(', ',$pos);
		$sql_update="update ".TBL_PRODUCT." set branch_id_for_pos='".$str_pos."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
		else
		{
			$key=array_search($branch_id,$pos);
			 unset($pos[$key]);
			 $str_pos=implode(', ',$pos);
			 $sql_update="update ".TBL_PRODUCT." set branch_id_for_pos='".$str_pos."' where id='".$pro_id."' ";
			$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
			 
	}
}

if($index=='product_brnch_mapping_for_invent'){
	$pos_array=array();
	$invent_array=array();
	$sql4="select branch_id_for_inventory from ".TBL_PRODUCT." where 1 and id='".$pro_id."' order by id asc " ;
    $result4= $homepage->db->query($sql4,__FILE__,__LINE__);
	$row4	=	$homepage->db->fetch_array($result4);
	if($row4['branch_id_for_inventory']=='')
	{
		$sql_update="update ".TBL_PRODUCT." set branch_id_for_inventory='".$branch_id.", "."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
	}
	else
	{
		
		$pos=explode(', ',$row4['branch_id_for_inventory']);
		if(!in_array($branch_id,$pos)){
		array_push($pos,$branch_id);
		$str_pos=implode(', ',$pos);
		$sql_update="update ".TBL_PRODUCT." set branch_id_for_inventory='".$str_pos."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
		else
		{
			$key=array_search($branch_id,$pos);
			 unset($pos[$key]);
			 $str_pos=implode(', ',$pos);
			 $sql_update="update ".TBL_PRODUCT." set branch_id_for_inventory='".$str_pos."' where id='".$pro_id."' ";
			$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
			 
	}
}

if($index=='category_brnch_mapping_for_pos'){
	$pos_array=array();
	$invent_array=array();
	$sql4="select branch_id_for_pos from ".TBL_CATEGORY." where 1 and id='".$pro_id."' order by id asc " ;
    $result4= $homepage->db->query($sql4,__FILE__,__LINE__);
	$row4	=	$homepage->db->fetch_array($result4);
	if($row4['branch_id_for_pos']=='')
	{
		$sql_update="update ".TBL_CATEGORY." set branch_id_for_pos='".$branch_id.", "."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
	}
	else
	{
		
		$pos=explode(', ',$row4['branch_id_for_pos']);
		if(!in_array($branch_id,$pos)){
		array_push($pos,$branch_id);
		$str_pos=implode(', ',$pos);
		$sql_update="update ".TBL_CATEGORY." set branch_id_for_pos='".$str_pos."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
		else
		{
			$key=array_search($branch_id,$pos);
			 unset($pos[$key]);
			 $str_pos=implode(', ',$pos);
			 $sql_update="update ".TBL_CATEGORY." set branch_id_for_pos='".$str_pos."' where id='".$pro_id."' ";
			$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
			 
	}
}

if($index=='category_brnch_mapping_for_invent'){
	$pos_array=array();
	$invent_array=array();
	$sql4="select branch_id_for_inventory from ".TBL_CATEGORY." where 1 and id='".$pro_id."' order by id asc " ;
    $result4= $homepage->db->query($sql4,__FILE__,__LINE__);
	$row4	=	$homepage->db->fetch_array($result4);
	if($row4['branch_id_for_inventory']=='')
	{
		$sql_update="update ".TBL_CATEGORY." set branch_id_for_inventory='".$branch_id.", "."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
	}
	else
	{
		
		$pos=explode(', ',$row4['branch_id_for_inventory']);
		if(!in_array($branch_id,$pos)){
		array_push($pos,$branch_id);
		$str_pos=implode(', ',$pos);
		$sql_update="update ".TBL_CATEGORY." set branch_id_for_inventory='".$str_pos."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
		else
		{
			$key=array_search($branch_id,$pos);
			 unset($pos[$key]);
			 $str_pos=implode(', ',$pos);
			 $sql_update="update ".TBL_CATEGORY." set branch_id_for_inventory='".$str_pos."' where id='".$pro_id."' ";
			$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
			 
	}
}

if($index=='sub_category_brnch_mapping_for_pos'){
	$pos_array=array();
	$invent_array=array();
	$sql4="select branch_id_for_pos from ".TBL_SUB_CATEGORY." where 1 and id='".$pro_id."' order by id asc " ;
    $result4= $homepage->db->query($sql4,__FILE__,__LINE__);
	$row4	=	$homepage->db->fetch_array($result4);
	if($row4['branch_id_for_pos']=='')
	{
		$sql_update="update ".TBL_SUB_CATEGORY." set branch_id_for_pos='".$branch_id.", "."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
	}
	else
	{
		
		$pos=explode(', ',$row4['branch_id_for_pos']);
		if(!in_array($branch_id,$pos)){
		array_push($pos,$branch_id);
		$str_pos=implode(', ',$pos);
		$sql_update="update ".TBL_SUB_CATEGORY." set branch_id_for_pos='".$str_pos."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
		else
		{
			$key=array_search($branch_id,$pos);
			 unset($pos[$key]);
			 $str_pos=implode(', ',$pos);
			 $sql_update="update ".TBL_SUB_CATEGORY." set branch_id_for_pos='".$str_pos."' where id='".$pro_id."' ";
			$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
			 
	}
}

if($index=='sub_category_brnch_mapping_for_invent'){
	$pos_array=array();
	$invent_array=array();
	$sql4="select branch_id_for_inventory from ".TBL_SUB_CATEGORY." where 1 and id='".$pro_id."' order by id asc " ;
    $result4= $homepage->db->query($sql4,__FILE__,__LINE__);
	$row4	=	$homepage->db->fetch_array($result4);
	if($row4['branch_id_for_inventory']=='')
	{
		$sql_update="update ".TBL_SUB_CATEGORY." set branch_id_for_inventory='".$branch_id.", "."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
	}
	else
	{
		
		$pos=explode(', ',$row4['branch_id_for_inventory']);
		if(!in_array($branch_id,$pos)){
		array_push($pos,$branch_id);
		$str_pos=implode(', ',$pos);
		$sql_update="update ".TBL_SUB_CATEGORY." set branch_id_for_inventory='".$str_pos."' where id='".$pro_id."' ";
		$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
		else
		{
			$key=array_search($branch_id,$pos);
			 unset($pos[$key]);
			 $str_pos=implode(', ',$pos);
			 $sql_update="update ".TBL_SUB_CATEGORY." set branch_id_for_inventory='".$str_pos."' where id='".$pro_id."' ";
			$homepage->db->query($sql_update,__FILE__,__LINE__);
		}
			 
	}
}
if($index=='delete_temp_record'){
	$sql_delete="delete from ".TBL_POS_ITEM_TEMP." where table_id='".$table_id."' ";
	$result= $homepage->db->query($sql_delete,__FILE__,__LINE__);
	$sql="select * from ".TBL_KOT." where 1 and table_id='".$table_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);

	while($row	=	$homepage->db->fetch_array($result))
	{
		$sql_delete="delete from ".TBL_KOT_ITEM." where kot_id='".$row['id']."' ";
		$result= $homepage->db->query($sql_delete,__FILE__,__LINE__);
	}
	$sql_delete_kot="delete from ".TBL_KOT." where table_id='".$table_id."' ";
	$result= $homepage->db->query($sql_delete_kot,__FILE__,__LINE__);
}
if($index=='delete_kot_record'){
	
	$sql="select * from ".TBL_KOT." where 1 and table_id='".$table_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);

	while($row	=	$homepage->db->fetch_array($result))
	{
		$sql_delete="delete from ".TBL_KOT_ITEM." where kot_id='".$row['id']."' ";
		$result= $homepage->db->query($sql_delete,__FILE__,__LINE__);
	}
	$sql_delete_kot="delete from ".TBL_KOT." where table_id='".$table_id."' ";
	$result= $homepage->db->query($sql_delete_kot,__FILE__,__LINE__);
}
if($index=='increase_date')
{
	$sql="select count(id) as dates,software_time from ".TBL_SOFTWARE_TIME." where 1 and branch_id='".$branch_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	if($row['dates']==0)
	{
		$insert_sql_array=array();
		$insert_sql_array['branch_id'] 	= $branch_id;
		$insert_sql_array['software_time'] 	= date('y-m-d',time()+86400);
		$homepage->db->insert(TBL_SOFTWARE_TIME,$insert_sql_array);
	}
	else
	{
		$sd=$row['software_time'];
		$update_sql_array=array();
		$update_sql_array['software_time'] 	= date('y-m-d',strtotime($sd.' +1 day'));
		$homepage->db->update(TBL_SOFTWARE_TIME,$update_sql_array,'branch_id',$branch_id);
	}
	
	
	
}
if($index=='increase_date_by_admin')
{
	$update_sql_array=array();
	$update_sql_array['software_time'] 	= date('y-m-d',strtotime($cng_date));
	$update_sql_array['branch_tax1'] 	= $branch_tax1;
	$update_sql_array['branch_tax2'] 	= $branch_tax2;
	$homepage->db->update(TBL_SOFTWARE_TIME,$update_sql_array,'branch_id',$branch_id);
	
	$sql="select count(id) as IDS from ".TBL_BRANCH_TAX." where 1 and branch_id='".$branch_id."' " ;
	$result= $homepage->db->query($sql,__FILE__,__LINE__);
	$row	=	$homepage->db->fetch_array($result);
	if($row['IDS']==0)
	{
		$insert_sql_array=array();
		$insert_sql_array['branch_id'] 	= $branch_id;
		$insert_sql_array['branch_tax1'] 	= $branch_tax1;
		$insert_sql_array['branch_tax2'] 	= $branch_tax2;
		$homepage->db->insert(TBL_BRANCH_TAX,$insert_sql_array);
	}
	else
	{
		$update_sql_array=array();
		
		$update_sql_array['branch_tax1'] 	= $branch_tax1;
		$update_sql_array['branch_tax2'] 	= $branch_tax2;
		$homepage->db->update(TBL_BRANCH_TAX,$update_sql_array,'branch_id',$branch_id);
	}
}
if($index=='change_tax_percentage1')
{
	$update_sql_array=array();
	$update_sql_array['branch_tax1'] 	= $tax_id;
	//$update_sql_array['branch_tax2'] 	= $branch_tax2;
	$homepage->db->update(TBL_BRANCH_TAX,$update_sql_array,'branch_id',$_SESSION['branch_id']);
}
if($index=='change_tax_percentage2')
{
	$update_sql_array=array();
	$update_sql_array['branch_tax2'] 	= $tax_id;
	//$update_sql_array['branch_tax2'] 	= $branch_tax2;
	$homepage->db->update(TBL_BRANCH_TAX,$update_sql_array,'branch_id',$_SESSION['branch_id']);
}

?>