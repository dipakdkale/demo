<?php 

class Member{
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
	function getUserDetail($id,$colname){
	$sql="select * from ".TBL_USER." where 1 and mem_id='".$id."' order by id asc" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row = $this->db->fetch_array($result);
	return $row[$colname];
	}
	################ All Page ######################
	function allpage(){
		?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Employees</h3>
                 <a href="manage_user.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Add Employee</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-16 col-sm-12 col-xs-16">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                     <th>User Name</th>
                                     <th>Company/Brand/Branch/department</th>
                                    <th>Office Email</th>
                                    <th>Phone</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_MEMBER." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['fname']." ".$row['lname'];?></td>
                                    <td><?php echo $this->getUserDetail($row['id'],'user_type');?></td>
                                     <td><?php echo $this->getUserDetail($row['id'],'user_name');?></td>
                                    <td><?php echo $this->getMoreDetail(TBL_COMPANY,$row['company_id']).'/ '.$this->getMoreDetail(TBL_BRAND,$row['brand_id']).'/ '.$this->getMoreDetail(TBL_BRANCH,$row['branch_id']).'/ '.$this->getMoreDetail(tbl_department,$row['department_id']);?></td>
                                     <td><?php echo $row['office_email'];?></td>
                                   
                                    <td><?php echo $row['phone'];?></td>
                                  
                                    <td>
               <a href="manage_user.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
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
                <div class="panel-heading"><h3 class="panel-title">Add Employee</h3></div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" required class="form-control" value="<?php echo $_POST['fname'];?>" name="fname" id="fname" placeholder="First Name">
                        </div>
                    </div>
                  	<div class="col-md-6">
                    <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" required class="form-control" value="<?php echo $_POST['lname'];?>" name="lname" id="lname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label class="control-label">Gender</label>
                       
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio4">
                                    <input type="radio" id="example-radio4" name="gender" <?php if($_POST['gender']=='male') echo 'checked';?> value="male"> 
                                    <i class="fa"></i>
                                    MALE 
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio5">
                                    <input type="radio" id="example-radio5" name="gender" <?php if($_POST['gender']=='female') echo 'checked';?> value="female"> 
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="department_id">Department Name</label>
                            <select class="form-control" name="department_id" id="department_id">
                            	<option value="">Select Department</option>
                                <?php 
                            $sql="select * from ".tbl_department." where 1 order by heading asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                            <option value="<?php echo $row['id'];?>" <?php if($_POST['department_id']==$row['id']) echo "selected=selected";?>><?php echo $row['heading'];?></option>
                            <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="aadhar">Aadhar Card Number</label>
                            <input class="form-control" type="text" placeholder="Aadhar Card Number" value="<?php echo $_POST['aadhar'];?>" id="aadhar" name="aadhar" required pattern="[0-9]{12}" title="Enter your 12 digits Aadhar Number">
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="pan">PAN Card Number</label>
                            <input type="pan" required class="form-control" name="pan" value="<?php echo $_POST['pan'];?>" id="pan" placeholder="PAN Card Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="phone">Phone Contact Number</label>
                            <input class="form-control" type="text" placeholder="Your Phone" value="<?php echo $_POST['phone'];?>" id="phone" name="phone" required pattern="[7-9]{1}[0-9]{9}" title="Enter your 10 digit mobile number only, Starting from 9,8 or 7">
                          
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="user_role">User Type</label>
                            <input type="text"  class="form-control" name="user_role" value="<?php echo $_POST['user_role'];?>" id="user_role" placeholder="User Type">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="office_email">Office Email ID</label>
                            <input type="email" required class="form-control" value="<?php echo $_POST['office_email'];?>" name="office_email" id="office_email" placeholder="Office Email ID">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="personal_email">Personal Email ID</label>
                            <input type="email" required class="form-control" value="<?php echo $_POST['personal_email'];?>" name="personal_email" id="personal_email" placeholder="Personal Email ID">
                        </div>
                    </div>
                         <div class="col-md-6">
                    <div class="form-group">
                            <label for="c_address">Communiation Address</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['address'];?>" name="c_address" id="c_address" placeholder="Communication Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="c_pincode">Pincode</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['c_pincode'];?>" name="c_pincode" id="c_pincode" placeholder="Pincode">
                        </div>
                    </div>
                         <div class="col-md-6">
                    <div class="form-group">
                            <label for="p_address">Permanent Address</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['p_address'];?>" name="p_address" id="p_address" placeholder="Permanent Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="p_pincode">Pincode</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['p_pincode'];?>" name="p_pincode" id="p_pincode" placeholder="Pincode">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="employee_code">Employee Code</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['employee_code'];?>" name="employee_code" id="employee_code" placeholder="Employee Code">
                        </div>
                 
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="esci_number">ESCI No</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['pan'];?>" name="esci_no" id="esci_number" placeholder="ESCI No">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="pay_grade">Pay Grade</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['pay_grade'];?>" name="pay_grade" id="pay_grade" placeholder="Pay Grade">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="designation">Designation in Company</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['designation'];?>" name="designation" id="designation" placeholder="Designation in Company">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="pf_no">PF Number</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['pf_no'];?>" name="pf_no" id="pf_no" placeholder="PF Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="uan_no">UAN Number</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['uan_no'];?>" name="uan_no" id="uan_no" placeholder="UAN Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="basic_salary">Basic Salary</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['basic_salary'];?>" name="basic_salary" id="basic_salary" placeholder="Basic Salary">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="conveyance">Conveyance</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['conveyance'];?>" name="conveyance" id="conveyance" placeholder="Conveyance">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="cca">CCA</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['cca'];?>" name="cca" id="cca" placeholder="CCA">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="hra">HRA</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['hra'];?>" name="hra" id="hra" placeholder="HRA">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="basicedu_allowance_salary">Edu Allowance</label>
                            <input type="text"  class="form-control" value="<?php echo $_POST['edu_allowance'];?>" name="edu_allowance" id="edu_allowance" placeholder="Edu Allowance">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" required class="form-control"  name="username" id="username" placeholder="User Name">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" required class="form-control"  name="password" id="password" placeholder="Password">
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
							$this->department_id=$department_id;
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
							if($this->Form->ValidField($username,'empty','Please Enter Username')==false)
							$return =false;
							if($this->Form->ValidField($password,'empty','Please Enter Password')==false)
							$return =false;
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
							$insert_sql_array = array();
							$insert_sql_array['company_id'] 	= $this->company_id;
							$insert_sql_array['brand_id'] 	= $this->brand_id;
							$insert_sql_array['branch_id'] 	= $this->branch_id;
							$insert_sql_array['fname'] 	= $this->fname;
							$insert_sql_array['lname'] 	= $this->lname;
							$insert_sql_array['gender'] 	= $this->gender;
							$insert_sql_array['aadhar'] 	= $this->aadhar;
							$insert_sql_array['pan'] 	= $this->pan;
							$insert_sql_array['phone'] 	= $this->phone;
							$insert_sql_array['user_role'] 	= $this->user_role;
							
							$insert_sql_array['office_email'] 	= $this->office_email;
							$insert_sql_array['personal_email'] 	= $this->personal_email;
							$insert_sql_array['c_address'] 	= $this->c_address;
							$insert_sql_array['c_pincode'] 	= $this->c_pincode;
							$insert_sql_array['p_address'] 	= $this->p_address;
							$insert_sql_array['p_pincode'] 	= $this->p_pincode;
							$insert_sql_array['employee_code'] 	= $this->employee_code;
							$insert_sql_array['esci_no'] 	= $this->esci_no;
							$insert_sql_array['pay_grade'] 	= $this->pay_grade;
							$insert_sql_array['designation'] 	= $this->designation;
							
							$insert_sql_array['pf_no'] 	= $this->pf_no;
							$insert_sql_array['uan_no'] 	= $this->uan_no;
							$insert_sql_array['basic_salary'] 	= $this->basic_salary;
							$insert_sql_array['conveyance'] 	= $this->conveyance;
							$insert_sql_array['cca'] 	= $this->cca;
							$insert_sql_array['hra'] 	= $this->hra;
							$insert_sql_array['edu_allowance'] 	= $this->edu_allowance;
							
							$this->db->insert(TBL_MEMBER,$insert_sql_array);
							$last_id=$this->db->last_insert_id();
							$insert_sql_array = array();
							$insert_sql_array['mem_id'] 	= $last_id;
							$insert_sql_array['fname'] 	= $this->fname;
							$insert_sql_array['lname'] 	= $this->lname;
							$insert_sql_array['username'] 	= $this->username;
							$insert_sql_array['password'] 	= $this->password;
							$insert_sql_array['user_type'] 	= $this->user_type;
							$insert_sql_array['is_active'] 	= 'yes';
							$this->db->insert(TBL_USER,$insert_sql_array);
							
							$_SESSION['msg'] = 'Employee has been added successfully';
							?>
							<script type="text/javascript">
							window.location = "manage_user.php?index=all";
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
									?>
                                 <div class="alert alert-danger"><li>Username Already Exists in database..!</li></div>
                                    <?php 
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
	$this->department_id=$department_id;
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
	$update_sql_array['department_id'] 	= $this->department_id;
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
	window.location = "manage_user.php?index=all";
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