<?php 

class ManageTable{
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
                <h3 class="panel-title">All Tables</h3>
                 <a href="manage_table.php?index=addpage" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Table</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Table ID</th>
                                    <th>Table Name</th>
                                    <th>No. of Seats</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_MASTER_TABLE." where 1 and branch_id='".$_SESSION['branch_id']."'  order by name asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['no_of_seat'];?></td>
                                    <td>
               <a href="manage_table.php?index=editpage&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
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
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
		
<div class="wraper container-fluid">
    <div class="row">
        <!-- Basic example -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Table</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="heading">Table Name</label>
                            <input type="text" required class="form-control" name="name" id="heading" placeholder="Table Name">
                        </div>
                        <div class="form-group">
                            <label for="heading">Number of Seats</label>
                            <input type="text" required class="form-control" name="no_of_seat" id="heading" placeholder="Number of Seats">
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
							$sql	=	"select * from ".TBL_MASTER_TABLE." where name='".$name."' and branch_id='".$_SESSION['branch_id']."' ";
							$res	=	$this->db->query($sql,__FILE__,__LINE__);
							$row	=	$this->db->num_rows($res);
							if($row==0)
							{
							if($return){
							$insert_sql_array = array();
							$insert_sql_array['name'] 	= $this->name;
							$insert_sql_array['no_of_seat'] 	= $this->no_of_seat;
							$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
							$insert_sql_array['status'] 	= '';
							$this->db->insert(TBL_MASTER_TABLE,$insert_sql_array);
							$_SESSION['msg'] = 'Table has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "manage_table.php?index=all";
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
									$_SESSION['error_msg'] = 'Category already exist in database!';
									?>
                                 <script type="text/javascript">
							window.location = "manage_table.php?index=add";
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