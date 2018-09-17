<?php 

class Measurement{
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
                <h3 class="panel-title">All Measurements</h3>
                 <a href="manage_measurement.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Measurement</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Unit Type</th>
                                     <th>Unit</th>
                                    <th>Base Unit</th>
                                    <th>Conversion To Base Unit</th>
                                    <th>Is Base Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_MEASUREMENT." where 1 order by unit_type,name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {         
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['unit_type'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['base_unit'];?></td>
                                    <td><?php echo $row['conversion'];?></td>
                                    <td><?php echo ucwords($row['is_base_unit']);?></td>
                                    <td>
               <a href="manage_measurement.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
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
                <div class="panel-heading"><h3 class="panel-title">Add Measurement</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="form-group">
                            <label for="unit_type">Unit Type</label>
                           <select name="unit_type" class="form-control" id="unit_type">
                           		<option value="">Select Unit Type</option>
                                <option value="mass" <?php if($_POST['unit_type']=='mass') echo 'selected=selected';?>>Mass</option>
                                <option value="volume" <?php if($_POST['unit_type']=='volume') echo 'selected=selected';?>>Volume</option>
                                <option value="count" <?php if($_POST['unit_type']=='count') echo 'selected=selected';?>>Count</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="unit">Measurement Unit</label>
                            <input type="text" required class="form-control" name="unit" id="unit" placeholder="Measurement Unit">
                        </div>
                        <div class="form-group">
                            <label for="base_unit">Base Unit</label>
                            <input type="text" required class="form-control" value="<?php echo $_POST['base_unit'];?>" name="base_unit" id="base_unit" placeholder="Base Unit">
                        </div>
                        <div class="form-group">
                            <label for="conversion">Conversion To Base Unit</label>
                            <input type="text" required class="form-control" name="conversion" value="<?php echo $_POST['conversion'];?>" id="conversion" placeholder="Conversion Unit">
                        </div>
                        <div class="form-group">
                         <label for="is_base_unit">Conversion To Base Unit</label>
                            <label class="cr-styled">
                                <input type="checkbox" id="is_base_unit" name="is_base_unit" <?php if($_POST['is_base_unit']=='yes') echo "checked";?> value="yes">
                                <i class="fa"></i> 
                                Yes
                            </label>
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
$this->unit_type=$unit_type;
$this->unit=$unit;
$this->base_unit=$base_unit;
$this->conversion=$conversion;
if($is_base_unit==''){
		$this->is_base_unit='no';
	}
	else{
		$this->is_base_unit=$is_base_unit;
	}
$return =true;
if($this->Form->ValidField($unit,'empty','Please Enter Measurement Unit')==false)
$return =false;
$sql	=	"select * from ".TBL_MEASUREMENT." where  name='".$unit."' and base_unit='".$base_unit."' ";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->num_rows($res);
if($row==0)
{
if($return){
$insert_sql_array = array();
$insert_sql_array['unit_type'] 	= $this->unit_type;
$insert_sql_array['name'] 	= $this->unit;
$insert_sql_array['base_unit'] 	= $this->base_unit;
$insert_sql_array['conversion'] 	= $this->conversion;
$insert_sql_array['is_base_unit'] 	= $this->is_base_unit;

$this->db->insert(TBL_MEASUREMENT,$insert_sql_array);
$_SESSION['msg'] = 'Measurement has been added successfully';
?>
<script type="text/javascript">
	window.location = "manage_measurement.php?index=all";
</script>
<?php
exit();
} else {
echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
$this->editpage('local');
}
}
else
{
		$_SESSION['error_msg'] = 'Measurement already exist in database!';
?>
 <script type="text/javascript">
		window.location = "manage_measurement.php?index=add";
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
$sql	=	"select * from ".TBL_MEASUREMENT." where id=".$id."";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Measurement</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="form-group">
                            <label for="unit_type">Unit Type</label>
                           <select name="unit_type" class="form-control" id="unit_type">
                           		<option value="">Select Unit Type</option>
                                <option value="mass" <?php if($row['unit_type']=='mass') echo "selected=selected";?>>Mass</option>
                                <option value="volume"  <?php if($row['unit_type']=='volume') echo "selected=selected";?>>Volume</option>
                                <option value="count"  <?php if($row['unit_type']=='count') echo "selected=selected";?>>Count</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="unit">Measurement Unit</label>
                            <input type="text" required class="form-control" value="<?php echo $row['name'];?>" name="unit" id="unit" placeholder="Measurement Unit">
                        </div>
                        <div class="form-group">
                            <label for="base_unit">Base Unit</label>
                            <input type="text" required class="form-control" value="<?php echo $row['base_unit'];?>" name="base_unit" id="base_unit" placeholder="Base Unit">
                        </div>
                        <div class="form-group">
                            <label for="conversion">Conversion To Base Unit</label>
                            <input type="text" required class="form-control" value="<?php echo $row['conversion'];?>" name="conversion" id="conversion" placeholder="Conversion Unit">
                        </div>
                        <div class="form-group">
                         <label for="is_base_unit">Conversion To Base Unit</label>
                            <label class="cr-styled">
                                <input type="checkbox" id="is_base_unit" name="is_base_unit" <?php if($row['is_base_unit']=='yes') echo "checked";?> value="yes">
                                <i class="fa"></i> 
                                Yes
                            </label>
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
	$this->unit_type=$unit_type;
	$this->unit=$unit;
	$this->base_unit=$base_unit;
	$this->conversion=$conversion;
	if($is_base_unit==''){
		$this->is_base_unit='no';
	}
	else{
		$this->is_base_unit=$is_base_unit;
	}
	
	$return =true;
	if($this->Form->ValidField($unit,'empty','Please Enter Measurement Unit')==false)
	$return =false;
	$sql	=	"select * from ".TBL_MEASUREMENT." where name='".$unit."' and base_unit='".$base_unit."' and id!='".$id."' ";
	$res	=	$this->db->query($sql,__FILE__,__LINE__);
	$row	=	$this->db->num_rows($res);
	if($row==0)
	{
	if($return){
	$update_sql_array = array();
	$update_sql_array['unit_type'] 	= $this->unit_type;
	$update_sql_array['name'] 	= $this->unit;
	$update_sql_array['base_unit'] 	= $this->base_unit;
	$update_sql_array['conversion'] 	= $this->conversion;
	$update_sql_array['is_base_unit'] 	= $this->is_base_unit;
	$this->db->update(TBL_MEASUREMENT,$update_sql_array,'id',$id);
	$_SESSION['msg'] = 'Measurement has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_measurement.php?index=all";
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
		$_SESSION['error_msg'] = 'Measurement already exist in database!';
		?>
		<script type="text/javascript">
		window.location = "manage_measurement.php?index=edit&id=<?php echo $id;?>";
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