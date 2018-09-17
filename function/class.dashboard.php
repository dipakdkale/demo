<?php 
class Sale{
	
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
	}
	function getSoftwareDetail($tblname,$id,$colname){
	$sql = "select * from ".$tblname." where id='".$id."' ";
	$record = $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($record);
	return	$row[$colname];
	}
	function SearchFilterForAmount($date_from,$date_to,$payment_mode)
	{
		$sql="select sum(total_amount) as amount from ".TBL_POS_ORDER." where 1 and branch_id='".$_SESSION['branch_id']."'  " ;
		if($date_from!='$current_date' && $date_to=='')
		{
		$sql.= "$current_date and order_date = $current_date ".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from!='' && $date_to=='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from=='' && $date_to!='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_to))."' ";
		}
		if($date_from!='' && $date_to!='')
		{
		$sql.=" and (order_date between  '".date('Y-m-d',strtotime($date_from))."' and  '".date('Y-m-d',strtotime($date_to))."') ";
		}
		$sql.=" and payment_mode='".$payment_mode."' ";
		$sql.="  order by id desc";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row	=	$this->db->fetch_array($result);
		return $row['amount'];
	}
	
	function SearchFilterForCategoryAmount($date_from,$date_to,$category_id,$search_by)
	{
		$sql="select id from ".TBL_POS_ORDER." where 1 and branch_id='".$_SESSION['branch_id']."'  " ;
		if($date_from!='' && $date_to=='')
		{
		$sql.=" and order_date =  '".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from=='' && $date_to!='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_to))."' ";
		}
		if($date_from!='' && $date_to!='')
		{
		$sql.=" and (order_date between  '".date('Y-m-d',strtotime($date_from))."' and  '".date('Y-m-d',strtotime($date_to))."') ";
		}
	
		$sql.="  order by id desc";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
		$amt=0;
		while($row	=	$this->db->fetch_array($result))
		{
 	 $sql2="select sum(total_price) as amount from ".TBL_POS_ITEM." where 1 and pos_order_id='".$row['id']."' and ".$search_by."='".$category_id."'  "; 
		$result2= $this->db->query($sql2,__FILE__,__LINE__);
		$row2	=	$this->db->fetch_array($result2);
		$amt+=$row2['amount'];
		
	$x++;	}
	
		return $amt;
		
	}
	function getSoftwareDate(){
	$sql="select * from ".TBL_SOFTWARE_TIME." where 1 and branch_id='".$_SESSION['branch_id']."' " ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$rows = $this->db->num_rows($result);
	$row = $this->db->fetch_array($result);
	if($rows==0)
	{
		return date('Y-m-d',time());
	}
	else
	{
	return $row['software_time'];
	}
	}
	function SearchFilterForItemQuantity($date_from,$date_to,$category_id,$search_by)
	{
		$sql="select sum(quantity) as amount from ".TBL_POS_ITEM." where 1 and branch_id='".$_SESSION['branch_id']."'  " ;
		if($date_from!='' && $date_to=='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from=='' && $date_to!='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_to))."' ";
		}
		if($date_from!='' && $date_to!='')
		{
		$sql.=" and (order_date between  '".date('Y-m-d 00:00:00',strtotime($date_from))."' and  '".date('Y-m-d 23:59:59',strtotime($date_to))."') ";
		}
		$sql.=" and ".$search_by."='".$category_id."' ";
		$sql.="  order by id desc";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row	=	$this->db->fetch_array($result);
		return $row['amount'];
	}
	function SearchFilterForCategoryTaxAmount($date_from,$date_to,$category_id,$search_by)
	{
		$sql="select id from ".TBL_POS_ORDER." where 1 and branch_id='".$_SESSION['branch_id']."'  " ;
		if($date_from!='' && $date_to=='')
		{
		$sql.=" and order_date =  '".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from=='' && $date_to!='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_to))."' ";
		}
		if($date_from!='' && $date_to!='')
		{
		$sql.=" and (order_date between  '".date('Y-m-d',strtotime($date_from))."' and  '".date('Y-m-d',strtotime($date_to))."') ";
		}
	
		$sql.="  order by id desc";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
		$amt=0;
		while($row	=	$this->db->fetch_array($result))
		{
 	 $sql2="select sum(tax_slab_amt) as amount from ".TBL_POS_ITEM." where 1 and pos_order_id='".$row['id']."' and ".$search_by."='".$category_id."'  "; 
		$result2= $this->db->query($sql2,__FILE__,__LINE__);
		$row2	=	$this->db->fetch_array($result2);
		$amt+=$row2['amount'];
		
	$x++;	}
	
		return round($amt,2);
	}
	function SearchFilterForCategoryCount($date_from,$date_to,$category_id,$search_by)
	{
	$sql="select id from ".TBL_POS_ORDER." where 1 and branch_id='".$_SESSION['branch_id']."'  " ;
		if($date_from!='' && $date_to=='')
		{
		$sql.=" and order_date =  '".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from=='' && $date_to!='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_to))."' ";
		}
		if($date_from!='' && $date_to!='')
		{
		$sql.=" and (order_date between  '".date('Y-m-d',strtotime($date_from))."' and  '".date('Y-m-d',strtotime($date_to))."') ";
		}
	
		$sql.="  order by id desc";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
	//	$amt=0;
		while($row	=	$this->db->fetch_array($result))
		{
 	 $sql2="select pos_order_id from ".TBL_POS_ITEM." where 1 and pos_order_id='".$row['id']."' and ".$search_by."='".$category_id."'  "; 
		$result2= $this->db->query($sql2,__FILE__,__LINE__);
		$row2	=	$this->db->fetch_array($result2);
		if($row2['pos_order_id']!='')
		{
		$amt2[]=$row2['pos_order_id'];
		}
		}
	//	print_r($amt2);
	array_unique($amt2);
		if(is_null($amt2))
		{
			return 0;
		}
		else
		return count(array_unique($amt2));
	}
	function SearchFilterForCount($date_from,$date_to,$payment_mode)
	{
		$sql="select count(id) as times from ".TBL_POS_ORDER." where 1 and branch_id='".$_SESSION['branch_id']."'  " ;
		if($date_from!='' && $date_to=='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from=='' && $date_to!='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_to))."' ";
		}
		if($date_from!='' && $date_to!='')
		{
		$sql.=" and (order_date between  '".date('Y-m-d',strtotime($date_from))."' and  '".date('Y-m-d',strtotime($date_to))."') ";
		}
		$sql.=" and payment_mode='".$payment_mode."' ";
		$sql.="  order by id desc";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row	=	$this->db->fetch_array($result);
		return $row['times'];
	}
	function SearchFilterForTaxAmount($date_from,$date_to,$payment_mode)
	{
		$sql="select id from ".TBL_POS_ORDER." where 1 and branch_id='".$_SESSION['branch_id']."'  " ;
		if($date_from!='' && $date_to=='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_from))."' ";
		}
		if($date_from=='' && $date_to!='')
		{
		$sql.=" and order_date = '".date('Y-m-d',strtotime($date_to))."' ";
		}
		if($date_from!='' && $date_to!='')
		{
			$sql.=" and (order_date between  '".date('Y-m-d',strtotime($date_from))."' and  '".date('Y-m-d',strtotime($date_to))."') ";
		}
		$sql.=" and payment_mode='".$payment_mode."' ";
		$sql.="  order by id desc"; 
		$result= $this->db->query($sql,__FILE__,__LINE__);
		while($row3	=	$this->db->fetch_array($result))
		{
			
			$sql2	=	"select sum(tax_slab_amt) as tax_amt from ".TBL_POS_ITEM." where pos_order_id='".$row3['id']."' ";
			$res2	=	$this->db->query($sql2,__FILE__,__LINE__);
			$row2	=	$this->db->fetch_array($res2);
			
		}
		return $row2['tax_amt'];
	}
	################ All Page ######################
	function allpage($date_from,$date_to){
		
		
		?>
<div class="row"  id="div_print">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><?php echo $this->getSoftwareDetail(TBL_COMPANY,$_SESSION['company_id'],'heading');?></h3>
                <h3 class="panel-title text-center"><?php echo $this->getSoftwareDetail(TBL_BRAND,$_SESSION['brand_id'],'heading');?></h3>
                <h3 class="panel-title text-center"><?php echo $this->getSoftwareDetail(TBL_BRANCH,$_SESSION['branch_id'],'heading');?></h3>
              
            </div>
           
            <div class="panel-body">
            <h2>Sale </h2>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                
                                    <th>Settlement</th>
                                    <th>Grand Total (in Rs.)</th>
                                    <th>No. Of Bills</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
							<tr class="tbl_row">
                                   
                                    <td>Cash</td>
                                    
                                     <td><?php echo round($this->SearchFilterForAmount($date_from,$date_to,'cash'),0);?></td>
                                       <td><?php echo $this->SearchFilterForCount($date_from,$date_to,'cash');?></td>
                                    
                                </tr>
                                <tr class="tbl_row">
                                  
                                    <td>Card</td>
                                    
                                     <td><?php echo round($this->SearchFilterForAmount($date_from,$date_to,'card'),0);?></td>
                                       <td><?php echo $this->SearchFilterForCount($date_from,$date_to,'card');?></td>
                                    
                                </tr>
                                <tr class="tbl_row">
                                   
                                    <td>E-Wellet</td>
      
                                     <td><?php echo round($this->SearchFilterForAmount($date_from,$date_to,'wallet'),0);?></td>
                                       <td><?php echo $this->SearchFilterForCount($date_from,$date_to,'wallet');?></td>
                                    
                                </tr>
                                <tr>
                               		<th>TOTAL :</th>

                                    <th><?php echo (round($this->SearchFilterForAmount($date_from,$date_to,'cash'),0))+(round($this->SearchFilterForAmount($date_from,$date_to,'card'),0))+(round($this->SearchFilterForAmount($date_from,$date_to,'wallet'),0));?></th>
                                    <th><?php echo ($this->SearchFilterForCount($date_from,$date_to,'cash'))+($this->SearchFilterForCount($date_from,$date_to,'card'))+($this->SearchFilterForCount($date_from,$date_to,'wallet'));?></th>
                                    
                                    
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel-body">
            <h2>Sale By Category</h2>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                
                                    <th>Settlement</th>
                                    <th>Amount (in Rs.)</th>
                                    <th>Tax Amount (in Rs.)</th>
                                     <th>Grand Total (in Rs.)</th>
                                    <th>Grand Total With Round Off (in Rs.)</th>
                                    <th>No. Of Bills</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_CATEGORY." where 1 and brand_id='".$_SESSION['brand_id']."' order by id asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
							$without_tax_amt=0;
							$tax_amt=0;
							$with_tax_amt=0;
							$with_round=0;
							$count=0;
                            while($row = $this->db->fetch_array($result))
                            {
								$branch_array=explode(', ',$row['branch_id_for_pos']);
								if(in_array($_SESSION['branch_id'],$branch_array))
								{
                            ?>
							<tr class="tbl_row">
                                   
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $this->SearchFilterForCategoryAmount($date_from,$date_to,$row['id'],'category_id')-$this->SearchFilterForCategoryTaxAmount($date_from,$date_to,$row['id'],'category_id');$without_tax_amt+=$this->SearchFilterForCategoryAmount($date_from,$date_to,$row['id'],'category_id')-$this->SearchFilterForCategoryTaxAmount($date_from,$date_to,$row['id'],'category_id');?></td>
                                     <td><?php echo round($this->SearchFilterForCategoryTaxAmount($date_from,$date_to,$row['id'],'category_id'),2);$tax_amt+=round($this->SearchFilterForCategoryTaxAmount($date_from,$date_to,$row['id'],'category_id'),2)?></td>
                                     <td><?php echo round($this->SearchFilterForCategoryAmount($date_from,$date_to,$row['id'],'category_id'),2);$with_tax_amt+=round($this->SearchFilterForCategoryAmount($date_from,$date_to,$row['id'],'category_id'),2);?></td>
                                     <td><?php echo round($this->SearchFilterForCategoryAmount($date_from,$date_to,$row['id'],'category_id'),0);$with_round+=round($this->SearchFilterForCategoryAmount($date_from,$date_to,$row['id'],'category_id'),0);?></td>
                                       <td><?php  echo $this->SearchFilterForCategoryCount($date_from,$date_to,$row['id'],'category_id');$count+=$this->SearchFilterForCategoryCount($date_from,$date_to,$row['id'],'category_id'); ?></td>
                                    
                                </tr>
                                <?php 
								}
							}
							?>
                                
                                <tr>
                               		<th>TOTAL :</th>
                                    <th><?php echo $without_tax_amt;?></th>
                                    <th><?php echo $tax_amt;?></th>
                                    <th><?php echo $with_tax_amt;?></th>
                                    <th><?php echo $with_round ;?></th>
                                    <th><?php echo ($this->SearchFilterForCount($date_from,$date_to,'cash'))+($this->SearchFilterForCount($date_from,$date_to,'card'))+($this->SearchFilterForCount($date_from,$date_to,'wallet'));?></th>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
<button class="btn btn-icon btn-purple m-b-5 btnPrint" type="button" id="btnPrint">Print <i class="fa fa-print"></i> </button>
        <?php 
	}

function searchPanel(){
		
						?>
		
<div class=" container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Date Wise Report</h3></div>
                <div class="panel-body">
                    <form role="form" method="get" action="sale.php">
                       		<div class="col-md-4" style="margin:0;">
                            <strong>Date From :</strong>
                          	<input type="hidden" name="index" value="search" />
                            <input type="date" <input type="date" value="<?php echo date("Y-m-d"); ?>" name="date_from" placeholder="mm/dd/yyyy" id="">
                       		</div>
                       		<div class="col-md-4" style="margin:0;">
                            <strong>Date To:</strong>
<input type="date" <input type="date" value="<?php echo date("Y-m-d"); ?>" name="date_from" placeholder="mm/dd/yyyy" id="datepicker2">
                        </div>
                        <div class="col-md-4" style="margin:0;">
                        <strong><br />
</strong>
                        <button type="submit" name="submit" value="Submit" class="btn btn-purple">Search</button>
                        </div>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-->
    </div> <!-- End row -->
</div>     
						<?php 
					
	
}
function addpage($runat,$id){
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
echo $JsCodeForFormValidation;
$sql	=	"select * from ".TBL_MASTER_TABLE." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>

function editpage($runat,$id){
switch($runat){
case 'local':
$FormName = "frm_addpage";
$ControlNames=array("filess"=>array('filess',"''","Please slider image","span_filess")
);
$ValidationFunctionName="CheckaddpageValidity";
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
$sql	=	"select * from ".TBL_MASTER_TABLE." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Table</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="heading">Table Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['name'];?>" name="name" id="heading" placeholder="Table Name">
                        </div>
                        <div class="form-group">
                            <label for="heading">Number of Seats</label>
                            <input type="text" required class="form-control" name="no_of_seat" value="<?php echo $row['no_of_seat'];?>" id="heading" placeholder="Number of Seats">
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
	$this->no_of_seat=$no_of_seat;
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Measurement Name')==false)
	$return =false;
	$sql	=	"select * from ".TBL_MASTER_TABLE." where name='".$name."' and branch_id='".$_SESSION['branch_id']."' and id!='".$id."' ";
	$res	=	$this->db->query($sql,__FILE__,__LINE__);
	$row	=	$this->db->num_rows($res);
	
	if($row==0)
	{
	if($return){
	$update_sql_array = array();
	$update_sql_array['name'] 	= $this->name;
	$update_sql_array['no_of_seat'] 	= $this->no_of_seat;
	$update_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$this->db->update(TBL_MASTER_TABLE,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Category has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_table.php?index=all";
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
		$_SESSION['error_msg'] = 'Table already exist in database!';
		?>
		<script type="text/javascript">
		window.location = "manage_table.php?index=edit&id=<?php echo $id;?>";
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