
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class FrontUser{
	
	 var $user_id;
	 var $user;
	 var $type;
	 var $password;
	 var $db;
	 var $validity;
	 var $Form;
	 var $new_pass;
	 var $confirm_pass;
	 var $auth;
	 
	 
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
		
	}
	
	                  
					  
		  function showallpages()
		  {
			?>
            <div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">ALL USER</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
				 <th>#</th>  	
                 <th>Name</th>
                 <th>Email</th>
                 <th>Phone</th>
				 <th>Earn Points</th>
				 <th>Refer Points</th>
				 <th>Total Points</th>
				 <th>Status</th>
				 <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
				$x=1;	
                $sql	=	"select * from ".TBL_REGISTER." order by id desc" ;
				$res 	= 	$this->db->query($sql,__FILE__,__LINE__);
				while($row = $this->db->fetch_array($res)){
                 ?>
                <tr>
				  <td><?php echo $x; ?></td>	
                  <td><?php echo $row['user_name']; ?></td>
                  <td><?php echo $row['user_email']; ?></td>
				  <td><?php echo $row['user_phone']; ?></td>
				  <td><?php echo $row['earn_point']; ?></td>
				  <td><?php echo $row['refer_point']; ?></td>
				  <td><?php echo $row['refer_point']+$row['earn_point']; ?></td>
				  <td><?php 
				  if($row['admin_status']=='1')
						echo 'Active'; 
				  else
				  		echo 'Deactive'; 
				  		
				  ?></td>
                  <td>
             		<a title="View Detail" href="manage-user.php?index=view&id=<?php echo $row['id']; ?>"><i class="fa fa-plus"></i></a>
	                |
					<a title="Update Status" href="javascript: void(0);" onclick="javascript: if(confirm('Do u want to update status?')) { custom.updateStatus('<?php echo $row['id'];?>',{})};"><i class="fa fa-refresh"></i></a>
	                |
                    <a href="javascript: void(0);" onclick="javascript: if(confirm('Do u want to delete this user?')) { custom.deletepage('<?php echo $row['id'];?>',{})};" ><i class="fa fa-ban"></i>
					</a>	
                  </td>
                </tr>
                <?php 
				$x++;
				} ?>
               </tbody>
              </table>
            </div>
          </div>
		<?php 
		 }
		    
			
			
			
			
	function showDetail($id)
	{
		$sql	=	"select * from ".TBL_REGISTER." where id='".$id."'" ;
		$res 	= 	$this->db->query($sql,__FILE__,__LINE__);
		$row = $this->db->fetch_array($res);
			?>
            <div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">DETAIL</h3>
               <div class="pull-right box-tools">
                <a href="manage-user.php"><button class="pull-right btn btn-primary" type="button"><i class="fa fa-arrow-circle-left"></i> Back
                </button></a>
              </div>
            </div>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <tbody>
                <tr>
                  <th>Name</th><td><?php echo $row['user_name']; ?></td>
				</tr>
				<tr>  
                  <th>Email</th><td><?php echo $row['user_email']; ?></td>
				</tr>
				<tr>    
				  <th>DOB</th><td><?php echo $row['user_dob']; ?></td>
				</tr>
				<tr>    
				  <th>Gender</th><td><?php echo $row['user_gender']; ?></td>
				 </tr>
				<tr>   
				  <th>Phone</th><td><?php echo $row['user_phone']; ?></td>
				</tr>
				<tr>    
				  <th>Address</th><td><?php echo $row['user_address']; ?></td>
                </tr>
               </tbody>
              </table>
            </div>
          </div>
		  
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">EXTRA POINTS</h3>
			</div>
			<?php
			$FormName = "frm_addextrapoint";
						$ControlNames=array("extraPoint"=>array('extraPoint',"Number","Please enter point","span_extraPoint"),
											"description"=>array('description',"''","Please enter description","span_description")
						 );
						$ValidationFunctionName="CheckaddextraPointValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
			?>
			<form role="form" name="<?php echo $FormName; ?>" method="post" action="" enctype="multipart/form-data">
			  <div class="box-body">
				
			  <div class="form-group">
				  <label for="extraPoint">Point</label>
				  <input type="text" class="form-control" id="extraPoint" placeholder="Extra Point" name="extraPoint">
				  <span style="color:#FF0000" id="span_extraPoint"></span>
				</div>
				
			<div class="form-group">
				  <label for="description">Description</label>
				  <input type="text" class="form-control" id="description" placeholder="Description" name="description">
				  <span style="color:#FF0000" id="span_description"></span>
				</div>	
				
			  </div>
			  <div class="box-footer">
				<button type="button" name="submit" value="Submit" onclick="if(<?php echo $ValidationFunctionName ?>()) {custom.setExtraPoint(document.getElementById('extraPoint').value,document.getElementById('description').value,{}); }" class="btn btn-primary">Submit</button>
			  </div>
			</form>
		  </div>
		  
		  <div class="box box-primary">
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <tbody>
                <tr>
				  <th>S.No</th>	
                  <th>Extra Point</th>
				  <th>Date</th>
				  <th>Action</th>
				</tr>
				<?php
					$x=1;
					$sql_p	=	"select * from ".TBL_EXTRA_POINT." where user_id=".$_REQUEST['id']."";
					$res_p	=	$this->db->query($sql_p,__FILE__,__LINE__);
					$num	=	$this->db->num_rows($res_p);
					if($num>0){
					while($row_p	=	$this->db->fetch_array($res_p)){
				?>
				<tr>  
				  <td><?php echo $x; ?></td>	
                  <td><?php echo $row_p['point']; ?></td>
				  <td><?php echo date('d-m-Y',strtotime($row_p['timestamp'])); ?></td>
				  <td><a onclick="javascript: if(confirm('Do u want to delete this point?')) { custom.deletePoint('<?php echo $row_p['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete Point"><i class="fa fa-ban"></i></a></td>
				</tr>
				<?php
					$x++;
					}
					}else{
				?>
				<tr>
					<td colspan="4" align="center" style="color:#FF0000;">No record found.</td>
				</tr>
				<?php
					}
				?>
               </tbody>
              </table>
            </div>
          </div>
		  
		  
		<?php 
		 }		
 
 	function masterDetail($tbl,$id,$col)
	{
		$sql="select * from ".$tbl." where id='".$id."'";
		$result=$this->db->query($sql,__FILE__,__LINE__);
		$row=$this->db->fetch_array($result);
		return $row[$col];
	}
 
 
 	function setExtraPoint($extraPoint,$description)
	{
		ob_start();
		
		$user_point							=	$this->masterDetail(TBL_REGISTER,$_REQUEST['id'],'total_point') + $extraPoint;
		$update_sql_array					=	array();
		$update_sql_array['total_point']	=	$user_point;
		$this->db->update(TBL_REGISTER,$update_sql_array,'id',$_REQUEST['id']);
		
		
		$insert_sql_array					=	array();		
		$insert_sql_array['point']			=	$extraPoint;
		$insert_sql_array['user_id']		=	$_REQUEST['id'];
		$insert_sql_array['description']	=	$description;
		$this->db->insert(TBL_EXTRA_POINT,$insert_sql_array);
		$_SESSION['msg']	=	"Point updated successfully";
		?>
		<script>
			window.location.reload();
		</script>
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
 

	function updateStatus($id)
	{
		ob_start();
		
		$sql	=	"select * from ".TBL_REGISTER." where id='".$id."'";
		$res	=	$this->db->query($sql,__FILE__,__LINE__);
		$row	=	$this->db->fetch_array($res);
		
		if($row['admin_status']=='0')
		{
			$update_sql_array	=	array();
			$update_sql_array['admin_status']	=	'1';
			$this->db->update(TBL_REGISTER,$update_sql_array,'id',$id);
		}
		if($row['admin_status']=='1')
		{
			$update_sql_array	=	array();
			$update_sql_array['admin_status']	=	'0';
			$this->db->update(TBL_REGISTER,$update_sql_array,'id',$id);
		}
		
		$_SESSION['msg']	=	"Status update successfully";
		?>
		<script>
			window.location	=	"manage-user.php";
		</script>
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}



	function deletepage($id)
	{
		ob_start();
		
		$sql="delete from ".TBL_REGISTER." where id='".$id."'";
        $this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']= 'User has been Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "manage-user.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}		
	
	function deletePoint($id)
	{
		ob_start();
		
		$sql="delete from ".TBL_EXTRA_POINT." where id='".$id."'";
        $this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']= 'Point has been Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location.reload();
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}		
	


}
?>
