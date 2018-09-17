<?php
 /***********************************************************************************

Class Discription : This class will handle the creation and modification
					of User.
************************************************************************************/

class User{
	
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
	

	
	function AdminLogin($runat){
		switch($runat){
			case 'local' :
							if(count($_POST)>0 and $_POST['submit']=='Login'){
								extract($_POST);
								$this->adminuser = $adminuser;
							}
							$FormName = "form_login";
							$ControlNames=array("adminuser"			=>array('adminuser',"''","Please enter User Name","span_adminuser"),
												"adminpassword"			=>array('adminpassword',"''","Please enter Password","span_adminpassword")
												);
	
							$ValidationFunctionName="CheckLoginValidity";
						
							$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
							echo $JsCodeForFormValidation;
							?>
	         <div id="mws-login-wrapper">
        <div id="mws-login">
            <h1><img src="images/New folder/logo.png"/></h1>
            <div class="mws-login-lock"><i class="icon-lock"></i></div>
            <div id="mws-login-form">
               	<form method="post" action="" enctype="multipart/form-data" id="" name="<?php echo $FormName ?>" >
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="text" name="adminuser" class="mws-login-username required" placeholder="username">
                            <span style="color:#F00;" id="span_adminuser"></span>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="password" name="adminpassword" class="mws-login-password required" placeholder="password">
                            <span style="color:#F00;" id="span_adminpassword"></span>
                        </div>
                    </div>
                    <div id="mws-login-remember" class="mws-form-row mws-inset">
                        <ul class="mws-form-list inline">
                            <li>
                                <input id="remember" type="checkbox"> 
                                <label for="remember">Remember me</label>
                            </li>
                        </ul>
                    </div>
                    <div class="mws-form-row">
                        <input type="submit" value="Login" name="adminlogin" class="btn btn-success mws-login-button" onclick="return <?php echo $ValidationFunctionName ?>();">
                    </div>
                </form>
            </div>
        </div>
    </div>
				
							<?php
							break;
			case 'server' :
							
						extract($_POST);
						$this->adminuser = $adminuser;
						$this->adminpassword = $adminpassword;
						//server side validation
						$return =true;
						if($this->Form->ValidField($adminuser,'empty','Please Enter User Name')==false)
							$return =false;
						if($this->Form->ValidField($adminpassword,'empty','Please Enter Your Password')==false)
							$return =false;
							
						if($return){
						
							$sql = "select * from ".TBL_USER." where user='".$adminuser."'";
							$record = $this->db->query($sql,__FILE__,__LINE__);
							$row = $this->db->fetch_array($record);
							if($this->adminuser == $row['user'] and $this->adminpassword == $row['password'])
								{
									if($row['status'] == 'block')
									{
									$_SESSION['error_msg']='User is Blocked Please Contact Administrator ...';
									?>
									<script type="text/javascript">
									window.location="index.php";
									</script>
									<?php
									exit();
									}
									else
									{
									$this->user_id= $row['user_id'];
									$this->groups= $row['auth_to'];
									$this->user_type= $row['type'];
									
									$this->auth->Create_Session($this->adminuser,$this->user_id,'','','');
									?>
									<script type="text/javascript">
									window.location="index.php";
									</script>
									<?php
									
									}
								}
								else
								{
									$_SESSION['error_msg']='Invalid username or password, please try again ...';
								}
							?>
							<script type="text/javascript">
							window.location="<?php echo $_SERVER['PHP_SELF'] ?>";
							</script>
							<?php
							
							}
							else
							{
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AdminLogin('local');
							}
						break;
			default : echo 'Wrong Paramemter passed';
		}
	}

	function changePassword($runat)
	{
		switch($runat){
			case 'local' :
							
							$FormName = "frm_changePw";
							$ControlNames=array("oldpassword"			=>array('oldpassword',"''","Please enter password","spanoldpassword"),
												"password"			=>array('password',"''","Please enter Password","spanpassword"),
												"repassword"			=>array('repassword',"RePassword","Password Donot Match","spanrepassword",'password')
												);
	
							$ValidationFunctionName="CheckPWValidity";
						
							$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
							echo $JsCodeForFormValidation;
					?>
                            <div  class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span>Change Password</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" class="mws-form" enctype="multipart/form-data" name="<?php echo $FormName ?>" >	
                    <div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Old Password</label>
                    				<div class="mws-form-col-2-8">
                                    <input type="password" name="oldpassword" value="">
                                   <span id="spanoldpassword"></span></span>
                                     </div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">New Password</label>
                    				<div class="mws-form-col-2-8">
                                    <input type="password" name="password" value="" >
                                    <span id="spanpassword"></span></span>
                                    </div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Re-Type Password</label>
                    				<div class="mws-form-col-2-8">
                                    <input type="password" name="repassword" value="" >
                                   <span id="spanrepassword"></span></span>
                                     </div>
                    			</div>
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="btn btn-danger" name="submit" onclick="return <?php echo $ValidationFunctionName ?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
							<?php
							break;
			case 'server' :
							
						extract($_POST);
						
						//server side validation
						$return =true;
						if($this->Form->ValidField($oldpassword,'empty','Please Enter User Name')==false)
							$return =false;
						if($this->Form->ValidField($password,'empty','Please Enter Your Password')==false)
							$return =false;
						if($this->Form->ValidField($repassword,'empty','Password Donot Match')==false)
							$return =false;
						
							
						if($return){
							$sql = "select * from ".TBL_USER." where user_id='".$_SESSION['user_id']."'";
							$record = $this->db->query($sql,__FILE__,__LINE__);
							$row = $this->db->fetch_array($record);
							if($oldpassword == $row['password'])
								{
									$update_sql_array = array();
									$update_sql_array['password'] = $password;
									
									$this->db->update(TBL_USER,$update_sql_array,'user_id',$_SESSION['user_id']);
									$_SESSION['msg']='Password Changed Successfully';
									?>
									<script type="text/javascript">
									window.location="home.php";
									</script>
									<?php
									exit();
								}
								else
								{
									$_SESSION['msg']='Old password do not match, please try again ...';
								}
							?>
							<script type="text/javascript">
							window.location="ChangePassword.php";
							</script>
							<?php
							exit();
							}
							else
							{
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->changePassword('local');
							}
						break;
			default : echo 'Wrong Paramemter passed';
		}
	}
	
	

	
	
	function blockUser($user_id)
	{
		ob_start();
		
		$update_array = array();
		$update_array['status'] = 'block';
		
		$this->db->update(TBL_USER,$update_array,'user_id',$user_id);
		
		$_SESSION['msg']='User has been Blocked successfully';
		
		?>
		<script type="text/javascript">
			window.location = "editUser.php"
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	function unblockUser($user_id)
	{
		ob_start();
		
		$update_array = array();
		$update_array['status'] = '';
		
		$this->db->update(TBL_USER,$update_array,'user_id',$user_id);
		
		$_SESSION['msg']='User has been Un-Blocked successfully';
		
		?>
		<script type="text/javascript">
			window.location = "editUser.php"
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	
}
?>