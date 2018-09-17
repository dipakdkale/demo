<?php 

class Tax_Slab{
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
                <h3 class="panel-title">All Tax Slabs</h3>
                 <a href="tax_slab.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Tax Slab</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tax Slab</th>
                                     <th>Percentage</th>
                                    <th>CGST</th>
                                    <th>SGST</th>
                                    <th>IGST</th>
                                    <th>Tax Symbol</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_TAX_SLAB." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['percentage'];?> %</td>
                                    <td><?php echo $row['cgst'];?> %</td>
                                    <td><?php echo $row['sgst'];?> %</td>
                                    <td><?php echo $row['igst'];?> %</td>
                                    <td><?php echo $row['tax_symbol'];?></td>
                                    <td>
               <a href="tax_slab.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
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
$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName);
echo $JsCodeForFormValidation;
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Tax Slab</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="fname">Tax Name</label>
                            <input type="text" required class="form-control" name="name" id="name" placeholder="Tax Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Percentage</label>
                            <input type="text" required class="form-control" name="percentage" id="percentage" placeholder="Percentage">
                        </div>
                        <div class="form-group">
                            <label for="cgst">CGST (in %)</label>
                            <input type="text" required class="form-control" name="cgst" id="cgst" placeholder="CGST">
                        </div>
                        <div class="form-group">
                            <label for="sgst">SGST (in %)</label>
                            <input type="text" required class="form-control" name="sgst" id="sgst" placeholder="SGST">
                        </div>
                        <div class="form-group">
                            <label for="igst">IGST (in %)</label>
                            <input type="text" required class="form-control" name="igst" id="igst" placeholder="IGST">
                        </div>
                        <div class="form-group">
                            <label for="tax_symbol">Tax Symbol</label>
                            <input type="text" required class="form-control" name="tax_symbol" id="tax_symbol" placeholder="Tax Symbol">
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
							$this->percentage=$percentage;
							$this->cgst=$cgst;
							$this->sgst=$sgst;
							$this->igst=$igst;
							$this->tax_symbol=$tax_symbol;
							$return =true;
							if($this->Form->ValidField($name,'empty','Please Enter Tax Slab Name')==false)
							$return =false;
							if($this->Form->ValidField($percentage,'empty','Please Enter Percentage')==false)
							$return =false;
							if($this->Form->ValidField($tax_symbol,'empty','Please Enter Tax Symbol')==false)
							$return =false;
							$sql	=	"select * from ".TBL_TAX_SLAB." where tax_symbol='".$tax_symbol."' ";
							$res	=	$this->db->query($sql,__FILE__,__LINE__);
							$rows	=	$this->db->num_rows($res);
							if($rows==0)
							{

							if($return){
							$insert_sql_array = array();
							$insert_sql_array['name'] 	= $this->name;
							$insert_sql_array['percentage'] 	= $this->percentage;
							$insert_sql_array['cgst'] 	= $this->cgst;
							$insert_sql_array['sgst'] 	= $this->sgst;
							$insert_sql_array['igst'] 	= $this->igst;
							$insert_sql_array['tax_symbol'] 	= $this->tax_symbol;
							
							$this->db->insert(TBL_TAX_SLAB,$insert_sql_array);
							
							$_SESSION['msg'] = 'Tax Slab has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "tax_slab.php?index=all";
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
								$_SESSION['error_msg'] = 'Tax Symbol must be unique for all taxes!!';
								?>
							<script type="text/javascript">
							window.location = "tax_slab.php?index=add";
							</script>
							<?php
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
$sql	=	"select * from ".TBL_TAX_SLAB." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Tax Slab</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="fname">Tax Name</label>
                            <input type="text" required class="form-control" value="<?php echo $row['name'];?>" name="name" id="name" placeholder="Tax Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Percentage</label>
                            <input type="text" required class="form-control" value="<?php echo $row['percentage'];?>" name="percentage" id="percentage" placeholder="Percentage">
                        </div>
                        <div class="form-group">
                            <label for="cgst">CGST (in %)</label>
                            <input type="text" required class="form-control" value="<?php echo $row['cgst'];?>" name="cgst" id="cgst" placeholder="CGST">
                        </div>
                        <div class="form-group">
                            <label for="sgst">SGST (in %)</label>
                            <input type="text" required class="form-control" value="<?php echo $row['sgst'];?>" name="sgst" id="sgst" placeholder="SGST">
                        </div>
                        <div class="form-group">
                            <label for="igst">IGST (in %)</label>
                            <input type="text" required class="form-control" value="<?php echo $row['igst'];?>" name="igst" id="igst" placeholder="IGST">
                        </div>
                        <div class="form-group">
                            <label for="tax_symbol">Tax Symbol</label>
                            <input type="text" required class="form-control" value="<?php echo $row['tax_symbol'];?>" name="tax_symbol" id="tax_symbol" placeholder="Tax Symbol">
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
	$this->percentage=$percentage;
	$this->cgst=$cgst;
	$this->sgst=$sgst;
	$this->igst=$igst;
	$this->tax_symbol=$tax_symbol;
	$return =true;
	if($this->Form->ValidField($name,'empty','Please Enter Tax Slab Name')==false)
	$return =false;
	if($this->Form->ValidField($percentage,'empty','Please Enter Percentage')==false)
	$return =false;
	$sql	=	"select * from ".TBL_TAX_SLAB." where tax_symbol='".$tax_symbol."' and id!='".$id."' ";
	$res	=	$this->db->query($sql,__FILE__,__LINE__);
	$rows	=	$this->db->num_rows($res);
	if($rows==0)
	{

	if($return){
	$update_sql_array = array();
	$update_sql_array['name'] 	= $this->name;
	$update_sql_array['percentage'] 	= $this->percentage;
	$update_sql_array['cgst'] 	= $this->cgst;
	$update_sql_array['sgst'] 	= $this->sgst;
	$update_sql_array['igst'] 	= $this->igst;
	$update_sql_array['tax_symbol'] 	= $this->tax_symbol;
	$this->db->update(TBL_TAX_SLAB,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Tax Slab has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "tax_slab.php?index=all";
	</script>
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->editpage('local',$id);
	}
	}
	else{
		$_SESSION['error_msg'] = 'Tax Symbol must be unique for all taxes!!';
		?>
	<script type="text/javascript">
	window.location = "tax_slab.php?index=edit&id=<?php echo $id;?>";
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