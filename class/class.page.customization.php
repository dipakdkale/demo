
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class Program{
	
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
	
	
	
			function editpage($runat,$id)
			{
				
    
		switch($runat){
			case 'local':
							$FormName = "frm_editpage";
						$ControlNames=array("website_name"=>array('website_name',"''","Please Enter Website name","span_website_name")
											
										
						 );

						$ValidationFunctionName="CheckaddpageValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						
						$sql="select * from ".TBL_CUSTOMIZATION." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
    	                    
                       
<div class="mws-panel grid_8">

                	<div class="mws-panel-header">
                    	<span>Website Setting </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Logo Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="<?php echo $row['image_url'];?>" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess"></span>
                                        <img src="gallery/<?php echo $row['image_url'];?>" style="width:100px; height:60px;"/>
                                        
                                    </div>
                                </div>
                           </div>
                           
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Website Name:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="website_name" value="<?php echo $row['website_name'];?>" rel="tooltip" data-placement="bottom" name="website_name" >
                                      <span style="color:#F00;" id="span_website_name"></span> 
                                    </div>
                                </div>

                           </div>
                           
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Website Url:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="website_Url" value="<?php echo $row['website_url'];?>" rel="tooltip" data-placement="bottom" name="website_url" >
                                     
                                    </div>
                                </div>

                           </div>
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Home Page Title:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="homepage_title" value="<?php echo $row['homepage_title'];?>" rel="tooltip" data-placement="bottom" name="homepage_title" >
                                        
                                    </div>
                                </div>

                           </div>
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Home Page Keywords:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="homepage_keyword" value="<?php echo $row['homepage_keyword'];?>" rel="tooltip" data-placement="bottom" name="homepage_keyword" >
                                      
                                    </div>
                                </div>

                           </div>
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Home Page Description:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="homepage_description" value="<?php echo $row['homepage_description'];?>" rel="tooltip" data-placement="bottom" name="homepage_description" >
                                     
                                    </div>
                                </div>
                           </div>
                          <?php /*?> <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Phone 1:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="phone1" rel="tooltip" value="<?php echo $row['phone1'];?>" data-placement="bottom" name="phone1" >
                                     
                                    </div>
                                </div>
                           </div>
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Phone 2:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="phone2" value="<?php echo $row['phone2'];?>" rel="tooltip" data-placement="bottom" name="phone2" >
                                     
                                    </div>
                                </div>
                           </div><?php */?>
                           <?php /*?><div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Email For Website:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Email For Website" value="<?php echo $row['email2'];?>" rel="tooltip" data-placement="bottom" name="email2" >
                                     
                                    </div>
                                </div>
                           </div><?php */?>
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Email For Getting Request:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Email For Getting Request" value="<?php echo $row['email1'];?>" rel="tooltip" data-placement="bottom" name="email1" >
                                     
                                    </div>
                                </div>
                           </div>
                           
                          <?php /*?><div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Address:</label>
                                    <div class="mws-form-item">
                                        <textarea type="text" class="large" title="Address" value="" rel="tooltip" data-placement="bottom" name="address" ><?php echo $row['address'];?></textarea>
                                     
                                    </div>
                                </div>
                             </div><?php */?>   
                                
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Facebook Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="facebook_link" value="<?php echo $row['facebook_link'];?>" rel="tooltip" data-placement="bottom" name="facebook_link" >
                                     
                                    </div>
                                </div>
                           </div><div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Twitter Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="twitter_link" value="<?php echo $row['twitter_link'];?>" rel="tooltip" data-placement="bottom" name="twitter_link" >
                                     
                                    </div>
                                </div>
                           </div>
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">LinkedIn Link :</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="linkedin_link" value="<?php echo $row['linkedin_link'];?>" rel="tooltip" data-placement="bottom" name="linkedin_link" >
                                     
                                    </div>
                                </div>
                           </div>
                           
                           <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Google Plus Link :</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="goggleplus_link" value="<?php echo $row['goggleplus_link'];?>" rel="tooltip" data-placement="bottom" name="goggleplus_link" >
                                     
                                    </div>
                                </div>
                           </div>
                           
                            <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">You Tube Link :</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="You tube link" value="<?php echo $row['youtube_link'];?>" rel="tooltip" data-placement="bottom" name="youtube_link" >
                                     
                                    </div>
                                </div>
                           </div>
						   
						   
						   <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Point :</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Point" value="<?php echo $row['url_point'];?>" rel="tooltip" data-placement="bottom" name="url_point" >
                                     
                                    </div>
                                </div>
                           </div>
                           
                          <?php /*?> <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Contact Map :</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Map" value="<?php echo $row['map'];?>" rel="tooltip" data-placement="bottom" name="map" >
                                     
                                    </div>
                                </div>
                           </div><?php */?>
                          
                           
                            
                      
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
								
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_CUSTOMIZATION." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_url'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= 'userimage'.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
						$this->path=$path;
						
						
						
						
						$this->address=$address;
						$this->address2=$address2;
						$this->address3=$address3;
						$this->website_name=$website_name;
						$this->website_url=$website_url;
						$this->homepage_title=$homepage_title;
						$this->homepage_keyword=$homepage_keyword;
						$this->homepage_description=$homepage_description;
						$this->phone1=$phone1;
						$this->phone2=$phone2;
						$this->email1=$email1;
						$this->email2=$email2;
						$this->facebook_link=$facebook_link;
						$this->twitter_link=$twitter_link;
						$this->linkedin_link=$linkedin_link;
						$this->goggleplus_link=$goggleplus_link;
						$this->map=$map;
						$this->videolink=$videolink;
						$this->youtube_link=$youtube_link;
						$this->url_point=$url_point;
						
							
						$return =true;
						if($this->Form->ValidField($website_name,'empty','Please Enter Website Name')==false)
							$return =false;
							if($return){
							
							$update_sql_array = array();

							//$update_sql_array['pfalogo'] = $this->pfalogo;
							//$update_sql_array['nightpictower'] = $this->nightpictower;
							//$update_sql_array['grandreceptionpic'] = $this->grandreceptionpic;
							
						
							$update_sql_array['image_url'] = $this->path;
							$update_sql_array['website_name'] = $this->website_name;
							$update_sql_array['website_url'] = $this->website_url;
							
							
							$update_sql_array['homepage_title'] = $this->homepage_title;
							$update_sql_array['homepage_keyword'] = $this->homepage_keyword;
							$update_sql_array['homepage_description'] = $this->homepage_description;
							$update_sql_array['phone1'] = $this->phone1;
							$update_sql_array['phone2'] = $this->phone2;
							$update_sql_array['email1'] = $this->email1;
							$update_sql_array['email2'] = $this->email2;
							$update_sql_array['address'] = $this->address;
							$update_sql_array['videolink'] = $this->videolink;
							//$update_sql_array['address3'] = $this->address3;
							$update_sql_array['facebook_link'] = $this->facebook_link;
							$update_sql_array['twitter_link'] = $this->twitter_link;
							$update_sql_array['linkedin_link'] = $this->linkedin_link;
							$update_sql_array['goggleplus_link'] = $this->goggleplus_link;
							$update_sql_array['map'] = $this->map;
							$update_sql_array['youtube_link'] = $this->youtube_link;
							$update_sql_array['url_point'] = $this->url_point;
							
 							
							$this->db->update(TBL_CUSTOMIZATION,$update_sql_array,id,$id);
							
							
							
							$_SESSION['msg'] = 'Website Settings has been Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "customization.php?index=edit&id=1"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editpage('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	}
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////// Country////////////////////////////////////////////////////////////////////////


  function showallpageCountry()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Country Name </span>
                        
                         <a href="country.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add Country</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="80%">Country Name </th>
                        
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_COUNTRY." where 1 order by country ASC" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center"><?php echo $row['country'];?></td>
                                    
                                     
									
                                   <td align="center">
                                   
                                   <a href="country.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this Country?')) { programobj.deletepage('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }



function AddPageCountry($runat)
	{
    
		
	switch($runat){
			case 'local':
						$FormName = "frm_addpage";
						$ControlNames=array("country"=>array('country',"''","Please Enter Country Name","span_country"),
						 );
						$ValidationFunctionName="CheckaddpageValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						
						
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Country Name</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Country:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Country Name" rel="tooltip" data-placement="bottom" name="country" >
                                        <span style="color:#F00;" id="span_country"></span>
                                    </div>
                                </div>
                           </div>
						    
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
					    	<?php 
						    break;
			                case 'server':
							extract($_POST);
						    $this->country=$country;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($country,'empty','Please Enter Country Name')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();
							$insert_sql_array['country'] = $this->country;
 							
							$this->db->insert(TBL_COUNTRY,$insert_sql_array);
							$_SESSION['msg'] = 'Country Name has been Successfully added';
							?>
							<script type="text/javascript">
							  window.location = "country.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddPageCountry('local');
							}
							break;
		                	default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	
	
	
	
	
function editpageCountry($runat,$id)
	{
    
		
	switch($runat){
			case 'local':
						$FormName = "frm_editpage";
						$ControlNames=array("country"=>array('country',"''","Please Enter Country Name","span_country"),
						 );
						$ValidationFunctionName="CheckaddpageValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						
						$sql="select * from ".TBL_COUNTRY." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row = $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Course Name</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Country:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Country Name" value="<?php echo $row['country'];?>" rel="tooltip" data-placement="bottom" name="country" >
                                        <span style="color:#F00;" id="span_country"></span>
                                    </div>
                                </div>
                           </div>
						    
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
					    	<?php 
						    break;
			                case 'server':
							extract($_POST);
						    $this->country=$country;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($country,'empty','Please Enter Country Name')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();
							$update_sql_array['country'] = $this->country;
 							
							$this->db->update(TBL_COUNTRY,$update_sql_array,'id',$id);
							$_SESSION['msg'] = 'Country Name has been Successfully Updated';
							?>
							<script type="text/javascript">
							  window.location = "country.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editpageCountry('local',$id);
							}
							break;
		                	default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	
	function deletepage($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_COUNTRY." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']='country has been Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "country.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	
	
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////// Subject////////////////////////////////////////////////////////////////////////


  function showallpageSubject()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Course Specialization  </span>
                        
                         <a href="coursespecialization.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add Course Specialization</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="80%">Course Specialization </th>
                        
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_SUBJECT." where 1 order by subject ASC" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center"><?php echo $row['subject'];?></td>
                                    
                                     
									
                                   <td align="center">
                                   
                                   <a href="coursespecialization.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this Course?')) { programobj.deletepageSubject('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }



function AddPageSubject($runat)
	{
    
		
	switch($runat){
			case 'local':
						$FormName = "frm_addpage";
						$ControlNames=array("subject"=>array('subject',"''","Please Enter Country Name","span_subject"),
						 );
						$ValidationFunctionName="CheckaddpageValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						
						
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Course Name</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Course Specialization:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Course Specialization" rel="tooltip" data-placement="bottom" name="subject" >
                                        <span style="color:#F00;" id="span_country"></span>
                                    </div>
                                </div>
                           </div>
						    
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
					    	<?php 
						    break;
			                case 'server':
							extract($_POST);
						    $this->subject=$subject;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($subject,'empty','Please Enter Country Name')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();
							$insert_sql_array['subject'] = $this->subject;
 							
							$this->db->insert(TBL_SUBJECT,$insert_sql_array);
							$_SESSION['msg'] = 'course specialization Name has been Successfully added';
							?>
							<script type="text/javascript">
							  window.location = "coursespecialization.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddPageSubject('local');
							}
							break;
		                	default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	
	
	
	
	
function editpageSubject($runat,$id)
	{
    
		
	switch($runat){
			case 'local':
						$FormName = "frm_editpage";
						$ControlNames=array("subject"=>array('subject',"''","Please Enter Country Name","span_subject"),
						 );
						$ValidationFunctionName="CheckaddpageValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						
						$sql="select * from ".TBL_SUBJECT." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row = $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Course Specialization</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Course Specialization:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Course Specialization" value="<?php echo $row['subject'];?>" rel="tooltip" data-placement="bottom" name="subject" >
                                        <span style="color:#F00;" id="span_subject"></span>
                                    </div>
                                </div>
                           </div>
						    
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
					    	<?php 
						    break;
			                case 'server':
							extract($_POST);
						    $this->subject=$subject;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($subject,'empty','Please Enter Country Name')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();
							$update_sql_array['subject'] = $this->subject;
 							
							$this->db->update(TBL_SUBJECT,$update_sql_array,'id',$id);
							$_SESSION['msg'] = 'course specialization Name has been Successfully Updated';
							?>
							<script type="text/javascript">
							  window.location = "coursespecialization.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editpageSubject('local',$id);
							}
							break;
		                	default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	
	function deletepageSubject($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_SUBJECT." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']='course specialization has been Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "coursespecialization.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////E- Brochure/////////////////////////////////////////////////

function AddEbrochure($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddEbrochure";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading","span_heading"),
											 "filess"=>array('filess',"''","Please Select An Image","span_filess"),
											 "ebrochur"=>array('ebrochur',"''","Please Select Brochur Document","span_ebrochur"),
						 );
						$ValidationFunctionName="CheckAddEbrochureValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add E-Brochure</span>
                         <a href="e-brochure.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                
                             <?php /*?>   <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                <?php */?>
                                
                                
                                
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess" style="color:#F00;"></span>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">E-Brochure:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="ebrochur" value="" class="large" title="E-Brochure"  rel="tooltip" data-placement="bottom"> <span id="span_ebrochur" style="color:#F00;"></span>
                                    </div>
                                </div>
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_EBROCHURE." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $this->headingmix.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
							
							$tmx=time();
							if ($_FILES["ebrochur"]["error"] > 0)
							{
							$sql3="select * from ".TBL_EBROCHURE." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $ebrochure=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["ebrochur"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["ebrochur"]["type"];
							$type= explode('/',$tmp);
							if($name[1]=='doc'||$name[1]=='DOC'||$name[1]=='docx'||$name[1]=='DOCX'||$name[1]=='pdf'||$name[1]=='PDF')
							{						
						
						    $ebrochure= $this->headingmix.$tmx.".".$name[1];
							
							move_uploaded_file($_FILES["ebrochur"][tmp_name],"../file/".$ebrochure); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
					    $this->path=$path;
						
						$this->heading=$heading;
						$this->content=$content;
						$this->ebrochure=$ebrochure;
						
						
					
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
						
							if($return){							
							$insert_sql_array = array();

							
							$insert_sql_array['image_path'] = $this->path;
							$insert_sql_array['heading'] = $this->heading;
							$insert_sql_array['download_path'] = $this->ebrochure;
							//$insert_sql_array['content'] = $this->content;
							
 							
							$this->db->insert(TBL_EBROCHURE,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "e-brochure.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddEbrochure('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallEbrochure()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>E-Brochure</span>
                        <a href="e-brochure.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add E-Brochure</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="20%">Heading</th>
                        <th  width="30%">Image</th>
                        <th  width="30%">Download E-Brouchure</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_EBROCHURE." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center"><?php echo $row['heading'];?></td>
                                     <td align="center">
                                     <?php if($row['image_path']!=''){?>
                                   <img src="gallery/<?php echo $row['image_path'];?>" style="height:60px;"/>
                                     <?php }else{?>
                                     No Image
                                    <?php }?>
                                    
                                    </td>
                                    <td align="center">
                                    
                                    <?php if($row['download_path']!=''){?>
                                    <a href="download.php?file=../file/<?php echo $row['download_path'];?>">
                                    <i class="icol-download"></i> Download  E-Brochure</a>
                                    <?php }else{?>
                                     E-Brochure Not Uploaded
                                    <?php }?>
                                    </td>
                                    
                                    <td align="center">
                                  
                                   <a href="e-brochure.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this E-Brochure?')) { programobj.deletepageEbrochure('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
		    
			function EditEbrochure($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditEbrochure";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading","span_heading"),
						 );
						$ValidationFunctionName="CheckEditEbrochureValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_EBROCHURE." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated E-Brochure</span>
                         <a href="e-brochure.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                              <?php /*?>  <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                <?php */?>
                                
                                
                             
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess"></span>
                                        <img src="gallery/<?php echo $row['image_path'];?>" style=" height:60px;"/>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">E-Brochure:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="ebrochur" value="" class="large" title="E-Brochure"  rel="tooltip" data-placement="bottom"> <span id="span_filess"></span>
                                       <?php echo $row['download_path'];?>
                                    </div>
                                </div>
                               
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
						
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_EBROCHURE." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $this->headingmix.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
							
							$tmx=time();
							if ($_FILES["ebrochur"]["error"] > 0)
							{
							$sql31="select * from ".TBL_EBROCHURE." where id='".$id."'" ;
							$result31= $this->db->query($sql31,__FILE__,__LINE__);
							$row31= $this->db->fetch_array($result31);
						    $ebrochure=$row31['download_path'];
							}
							else
							{
							$tmpname=$_FILES["ebrochur"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["ebrochur"]["type"];
							$type= explode('/',$tmp);
							if($name[1]=='doc'||$name[1]=='DOC'||$name[1]=='docx'||$name[1]=='DOCX'||$name[1]=='pdf'||$name[1]=='PDF')
							{						
						
						    $ebrochure= $this->headingmix.$tmx.".".$name[1];
							
							move_uploaded_file($_FILES["ebrochur"][tmp_name],"../file/".$ebrochure); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
						
					    $this->path=$path;
						
						$this->heading=$heading;
						$this->content=$content;
						$this->ebrochure=$ebrochure;
						
						
					
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
						
							if($return){							
							$update_sql_array = array();

							
							$update_sql_array['image_path'] = $this->path;
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['download_path'] = $this->ebrochure;
							//$update_sql_array['content'] = $this->content;
							
 							
								$this->db->update(TBL_EBROCHURE,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "e-brochure.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditEbrochure('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageEbrochure($id)
	{
		ob_start();
		$sql1="select * from ".TBL_EBROCHURE." where id='".$id."'" ;
		$result1= $this->db->query($sql1,__FILE__,__LINE__);
		$row1= $this->db->fetch_array($result1);
		$path='../gallery/'.$row1['image_path'];
		$path1='../file/'.$row1['download_path'];
		unlink($path);
		unlink($path1);
		
		
		$sql="delete from ".TBL_EBROCHURE." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "e-brochure.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////E - MAGAZINE/////////////////////////////////////////////////

function AddEmagazine($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddEmagazine";
						$ControlNames=array("filess"=>array('filess',"''","Please Select An Image","span_filess"),
											 "emagazine"=>array('emagazine',"''","Please Select Brochur Document","span_emagazine"),
						 );
						$ValidationFunctionName="CheckAddEmagazineValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add E-Magazine</span>
                         <a href="e-magazine.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Volume:</label>
                                    <div class="mws-form-item">
                                      
                                         <select class="large" name="volume" >
                                           <option value=""> Select Volume.</option>
                                           <option value="I"> I</option>
                                           <option value="II"> II</option>
                                           <option value="III"> III</option>
                                           <option value="IV"> IV</option>
                                           <option value="V"> V</option>
                                           <option value="VI"> VI</option>
                                           <option value="VII"> VII</option>
                                           <option value="VIII"> VIII</option>
                                           <option value="IX"> IX</option>
                                           <option value="X"> X</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_volume"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Book No.:</label>
                                    <div class="mws-form-item">
                                        <select class="large" name="no" >
                                           <option value=""> Select No.</option>
                                           <?php for($a=1;$a<=10;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        <span style="color:#F00;" id="span_no"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">E-Magazine Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="E-Magazine Date" rel="tooltip" value="<?php echo date('Y-m-d');?>" data-placement="bottom" name="magazine_date" >
                                        <span style="color:#F00;" id="span_magazine_date"></span>
                                    </div>
                                </div>
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess" style="color:#F00;"></span>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">E-Magzine:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="emagazine" value="" class="large" title="E-Magzine"  rel="tooltip" data-placement="bottom"> <span id="span_emagazine" style="color:#F00;"></span>
                                    </div>
                                </div>
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_EMAGAZINE." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $this->headingmix.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
							
							$tmx=time();
							if ($_FILES["emagazine"]["error"] > 0)
							{
							$sql3="select * from ".TBL_EMAGAZINE." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $emagazine=$row3['download_path'];
							}
							else
							{
							$tmpname=$_FILES["emagazine"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["emagazine"]["type"];
							$type= explode('/',$tmp);
							if($name[1]=='doc'||$name[1]=='DOC'||$name[1]=='docx'||$name[1]=='DOCX'||$name[1]=='pdf'||$name[1]=='PDF')
							{						
						
						    $emagazine= $this->headingmix.$tmx.".".$name[1];
							
							move_uploaded_file($_FILES["emagazine"][tmp_name],"../file/".$emagazine); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							$this->path=$path;
							
							$this->heading=$heading;
							$this->magazine_date=$magazine_date;
							$this->emagazine=$emagazine;
							
							$this->no=$no;
							$this->volume=$volume;
							$this->magazine_date=$magazine_date;
						
						
					
							//server side validation
							$return =true;
							//if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							//$return =false;
						
						
							if($return){							
							$insert_sql_array = array();

							
							$insert_sql_array['image_path'] = $this->path;
							$insert_sql_array['heading'] = $this->heading;
							$insert_sql_array['download_path'] = $this->emagazine;
							$insert_sql_array['no'] = $this->no;
							$insert_sql_array['volume'] = $this->volume;
							$insert_sql_array['magazine_date'] = $this->magazine_date;
							
 							
							$this->db->insert(TBL_EMAGAZINE,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "e-magazine.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddEmagazine('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallEmagazine()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>E-Magazine</span>
                        <a href="e-magazine.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add E-Magazine</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="20%">Heading</th>
                        <th  width="20%">Image</th>
                        <th  width="20%">Date</th>
                        <th  width="20%">Download E-Magazine</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_EMAGAZINE." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									
									<?php 
									if($row['heading']!=''){echo $row['heading'];}?><?php  if($row['volume']!=''){ echo ', Vol '.$row['volume']; }?><?php  if($row['no']!=''){ echo ', No '.$row['no'];}?>
                                    
                                    </td>
                                     <td align="center">
                                     <?php if($row['image_path']!=''){?>
                                   <img src="gallery/<?php echo $row['image_path'];?>" style="height:60px;"/>
                                     <?php }else{?>
                                     No Image
                                    <?php }?>
                                    
                                    </td>
                                     <td align="center"><?php echo date('F, d - Y',strtotime($row['magazine_date']));?></td>
                                    <td align="center">
                                    
                                    <?php if($row['download_path']!=''){?>
                                    <a href="download.php?file=../file/<?php echo $row['download_path'];?>">
                                    <i class="icol-download"></i> Download  E-Magazine</a>
                                    <?php }else{?>
                                     E-Magazine Not Uploaded
                                    <?php }?>
                                    </td>
                                    
                                    <td align="center">
                                  
                                   <a href="e-magazine.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this E-Magazine?')) { programobj.deletepageEmagazine('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
		    
			function EditEmagazine($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditEbrochure";
						$ControlNames=array(
						 );
						$ValidationFunctionName="CheckEditEbrochureValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_EMAGAZINE." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated E-Magazine</span>
                         <a href="e-brochure.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                              <div class="mws-form-row">
                                    <label class="mws-form-label">Volume:</label>
                                    <div class="mws-form-item">
                                      
                                         <select class="large" name="volume" >
                                           <option value=""> Select Volume.</option>
                                           <option <?php if($row['volume']=='I'){?>selected="selected"<?php }?> value="I"> I</option>
                                           <option <?php if($row['volume']=='II'){?>selected="selected"<?php }?> value="II"> II</option>
                                           <option <?php if($row['volume']=='III'){?>selected="selected"<?php }?> value="III"> III</option>
                                           <option <?php if($row['volume']=='IV'){?>selected="selected"<?php }?> value="IV"> IV</option>
                                           <option <?php if($row['volume']=='V'){?>selected="selected"<?php }?> value="V"> V</option>
                                           <option <?php if($row['volume']=='VI'){?>selected="selected"<?php }?> value="VI"> VI</option>
                                           <option <?php if($row['volume']=='VII'){?>selected="selected"<?php }?> value="VII"> VII</option>
                                           <option <?php if($row['volume']=='VIII'){?>selected="selected"<?php }?> value="VIII"> VIII</option>
                                           <option <?php if($row['volume']=='IX'){?>selected="selected"<?php }?> value="IX"> IX</option>
                                           <option <?php if($row['volume']=='X'){?>selected="selected"<?php }?> value="X"> X</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_volume"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Book No.:</label>
                                    <div class="mws-form-item">
                                        <select class="large" name="no" >
                                           <option value=""> Select No.</option>
                                           <?php for($a=1;$a<=10;$a++){?>
                                           <option <?php if($row['no']==$a){?>selected="selected"<?php }?> value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        <span style="color:#F00;" id="span_no"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">E-Magazine Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="E-Magazine Date" rel="tooltip" value="<?php echo $row['magazine_date'];?>" data-placement="bottom" name="magazine_date" >
                                        <span style="color:#F00;" id="span_magazine_date"></span>
                                    </div>
                                </div>
                          
                    			
                                
                                
                                
                             
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess"></span>
                                        <img src="gallery/<?php echo $row['image_path'];?>" style=" height:60px;"/>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">E-Magzine:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="emagazine" value="" class="large" title="E-Magzine"  rel="tooltip" data-placement="bottom"> <span id="span_emagazine" style="color:#F00;"></span><?php echo $row['download_path'];?>
                                    </div>
                                </div>
                                
                               
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
						
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_EMAGAZINE." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $this->headingmix.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
							
							$tmx=time();
							if ($_FILES["emagazine"]["error"] > 0)
							{
							$sql3="select * from ".TBL_EMAGAZINE." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $emagazine=$row3['download_path'];
							}
							else
							{
							$tmpname=$_FILES["emagazine"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["emagazine"]["type"];
							$type= explode('/',$tmp);
							if($name[1]=='doc'||$name[1]=='DOC'||$name[1]=='docx'||$name[1]=='DOCX'||$name[1]=='pdf'||$name[1]=='PDF')
							{						
						
						    $emagazine= $this->headingmix.$tmx.".".$name[1];
							
							move_uploaded_file($_FILES["emagazine"][tmp_name],"../file/".$emagazine); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
						
					        $this->path=$path;
							$this->heading=$heading;
							$this->magazine_date=$magazine_date;
							$this->emagazine=$emagazine;
							
							$this->no=$no;
							$this->volume=$volume;
							$this->magazine_date=$magazine_date;
						
						
					
							//server side validation
							$return =true;
							//if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							//$return =false;
						
						
							if($return){							
							$update_sql_array = array();

							
							
 							$update_sql_array['image_path'] = $this->path;
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['download_path'] = $this->emagazine;
							$update_sql_array['no'] = $this->no;
							$update_sql_array['volume'] = $this->volume;
							$update_sql_array['magazine_date'] = $this->magazine_date;
							$this->db->update(TBL_EMAGAZINE,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "e-magazine.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditEmagazine('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageEmagazine($id)
	{
		ob_start();
		$sql1="select * from ".TBL_EMAGAZINE." where id='".$id."'" ;
		$result1= $this->db->query($sql1,__FILE__,__LINE__);
		$row1= $this->db->fetch_array($result1);
		$path='../gallery/'.$row['image_path'];
		$path1='../file/'.$row['download_path'];
		unlink($path);
		unlink($path1);
		
		
		$sql="delete from ".TBL_EMAGAZINE." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "e-magazine.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Webinars Archives /////////////////////////////////////////////////

function AddWebinarArchives($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddEbrochure";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading","span_heading"),
										 "filess"=>array('filess',"''","Please Select an Image","span_filess"),
										 "video_link"=>array('video_link',"''","Please Enter Video Link","span_video_link"),
						 );
						$ValidationFunctionName="CheckAddEbrochureValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Webinars Archives</span>
                         <a href="webinar.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Webinars Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                
                          
                    			<?php /*?><div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess" style="color:#F00;"></span>
                                    </div>
                                </div><?php */?>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Webinars Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Webinars Date" rel="tooltip" data-placement="bottom" name="webinar_date" value="<?php echo date('Y-m-d');?>" id="datepicker" >
                                        <span style="color:#F00;" id="span_webinar_date"></span>
                                    </div>
                                </div>
                               
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Video Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Video Link" rel="tooltip" data-placement="bottom" name="video_link" >
                                        <small>Like <font color="#FF0000">Bl6ogW9oSNY</font> This Type Code Of You tube</small>
                                        <span style="color:#F00;" id="span_video_link"></span>
                                    </div>
                                </div>
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							/*$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_WEBINAR_ARCHIVES." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $this->headingmix.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}*/
							
								
							$this->path=$path;
							$this->video_link=$video_link;
							$this->heading=$heading;
							$this->webinar_date=$webinar_date;
						
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
						
							if($return){							
							$insert_sql_array = array();
							$insert_sql_array['image_path'] = $this->path;
							$insert_sql_array['heading'] = $this->heading;
							$insert_sql_array['video_link'] = $this->video_link;
							$insert_sql_array['webinar_date'] = $this->webinar_date;
 							
							$this->db->insert(TBL_WEBINAR_ARCHIVES,$insert_sql_array);
							$_SESSION['msg'] = 'Successfully added';
							?>
							<script type="text/javascript">
							  window.location = "webinar.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddWebinarArchives('local');
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallWebinarArchives()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Webinars Archives</span>
                        <a href="webinar.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add Webinars</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="20%">Heading</th>
                       <?php /*?> <th  width="20%">Image</th><?php */?>
                        <th  width="20%">Date</th>
                        <th  width="20%">Video</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_WEBINAR_ARCHIVES." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center"><?php echo $row['heading'];?></td>
                                     <?php /*?><td align="center">
                                     <?php if($row['image_path']!=''){?>
                                   <img src="../gallery/<?php echo $row['image_path'];?>" style="height:60px;"/>
                                     <?php }else{?>
                                     No Image
                                    <?php }?>
                                    
                                    </td><?php */?>
                                     <td align="center"><?php echo date('jS, M Y',strtotime($row['webinar_date']));?></td>
                                      <td align="center">
                                      
                                      <img src="http://img.youtube.com/vi/<?php echo $row['video_link'];?>/0.jpg" style="height:80px;" />
                                      
									 <?php /*?> <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $row['video_link'];?>" frameborder="0" allowfullscreen></iframe>
									  <?php */?>
									  <?php // echo $row['video_link'];?></td>
                                    
                                    <td align="center">
                                  
                                   <a href="webinar.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this Webinars?')) { programobj.deletepageWebinarArchives('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
		    
			function EditWebinarArchives($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditEbrochure";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading","span_heading"),
						 );
						$ValidationFunctionName="CheckEditEbrochureValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_WEBINAR_ARCHIVES." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Webinars Archives</span>
                         <a href="webinar.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                            
                                
                             
                          <?php /*?>
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess"></span>
                                        <img src="../gallery/<?php echo $row['image_path'];?>" style=" height:60px;"/>
                                    </div>
                                </div><?php */?>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Webinars Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Webinars Date" rel="tooltip" data-placement="bottom" name="webinar_date" value="<?php echo $row['webinar_date'];?>" id="datepicker" >
                                        <span style="color:#F00;" id="span_webinar_date"></span>
                                    </div>
                                </div>
                               
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Video Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" value="<?php echo $row['video_link'];?>" class="large" title="Video Link" rel="tooltip" data-placement="bottom" name="video_link" >
                                        <small>Like <font color="#FF0000">Bl6ogW9oSNY</font> This Type Code Of You tube</small>
                                        <span style="color:#F00;" id="span_video_link"></span>
                                    </div>
                                </div>
                            
                               
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
						
							/*$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_WEBINAR_ARCHIVES." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $this->headingmix.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}*/
							
						
					        $this->path=$path;
							$this->video_link=$video_link;
							$this->heading=$heading;
							$this->webinar_date=$webinar_date;
						
					
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();
							$update_sql_array['image_path'] = $this->path;
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['webinar_date'] = $this->webinar_date;
							$update_sql_array['video_link'] = $this->video_link;
							
 							
							$this->db->update(TBL_WEBINAR_ARCHIVES,$update_sql_array,id,$id);
							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "webinar.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditWebinarArchives('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageWebinarArchives($id)
	{
		ob_start();
		$sql1="select * from ".TBL_WEBINAR_ARCHIVES." where id='".$id."'" ;
		$result1= $this->db->query($sql1,__FILE__,__LINE__);
		$row1= $this->db->fetch_array($result1);
		$path='../gallery/'.$row['image_path'];
		
		unlink($path);
		
		
		
		$sql="delete from ".TBL_WEBINAR_ARCHIVES." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "webinar.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	






 function getcityname($id)
			 {
				        $sql="select * from ".TBL_CITY." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						return $row['city'];
			 }
			 
			 function getbranchname($id)
			 {
				        $sql="select * from ".TBL_BRANCH." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						return $row['branch'];
			 }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////E - Event/////////////////////////////////////////////////

function AddEvent($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddEvent";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading ","span_heading"),
										 "starttime"=>array('starttime',"''","Please Enter Start time ","span_starttime"),
										 "endtime"=>array('endtime',"''","Please Enter End time ","span_endtime"),
										 "event_date"=>array('event_date',"''","Please Enter Event date ","span_event_date"),
											 
						 );
						$ValidationFunctionName="CheckAddEventValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Event</span>
                         <a href="event.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                
                                
                                     <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Event Time:</label>
                                    <div class="mws-form-item">
                                    
                                       <div class="grid_4"> 
                                        <select  name="starttime" >
                                           <option value=""> Select Start Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        
                                        
                                        <select  name="starttime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                         <span style="color:#F00;" id="span_starttime"></span>
                                        </div>
                                        
                                         <div class="grid_4"> 
                                        
                                         <select  name="endtime" >
                                           <option value=""> Select End Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                         <select  name="endtime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_endtime"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Event Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Event Date" rel="tooltip" value="<?php echo date('Y-m-d');?>" data-placement="bottom" id="datepicker" name="event_date" >
                                        <span style="color:#F00;" id="span_event_date"></span>
                                    </div>
                                </div>
                          
                    			
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Branch City:</label>
                                    <div class="mws-form-item">
                                        <select  name="city_id" >
                                           <option value=""> --Select City--</option>
                                            <?php
								
                                $sql_con="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                $result_con= $this->db->query($sql_con,__FILE__,__LINE__);
                                while($row_con= $this->db->fetch_array($result_con))
                                {
									
									
                                ?>
                                <option value="<?php echo $row_con['id'];?>"><?php echo $row_con['branch'];?></option>
                                <?php }?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
		                 	case 'server':
							extract($_POST);
							
							$this->city_id=$city_id;
							$this->heading=$heading;
							$this->event_date=$event_date;
							$this->content=$content;
							$this->event_time=$starttime.' '.$starttime1.' To '.$endtime.' '.$endtime1;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();

                            $insert_sql_array['city_id'] = $this->city_id;
							$insert_sql_array['event_date'] = $this->event_date;
							$insert_sql_array['heading'] = $this->heading;
							$insert_sql_array['content'] = $this->content;
							$insert_sql_array['event_time'] = $this->event_time;
							
							
 							
							$this->db->insert(TBL_EVENTS,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "event.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddEvent('local');
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallEvent()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Event</span>
                        <a href="event.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add Event</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="20%">Heading</th>
                      
                        <th  width="20%">Event Date</th>
                        <th  width="20%">Event Time</th>
                        <th  width="20%">Branch City</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_EVENTS." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['heading'];?>
                                    </td>
                                     <td align="center"><?php echo date('F, d - Y',strtotime($row['event_date']));?></td>
                                    <td align="center">
                                    
                                   <?php echo $row['event_time'];?>
                                    </td>
                                    
                                    <td align="center">
                                    
                                   <?php echo $this->getbranchname($row['city_id']);?>
                                    </td>
                                    
                                    <td align="center">
                                  
                                   <a href="event.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this Event?')) { programobj.deletepageEvent('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
			
			 
		    
function EditEvent($runat,$id)
	{
    $sql="select * from ".TBL_EVENTS." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
	switch($runat){
			case 'local':
						$FormName = "frm_EditEvent";
						$ControlNames=array(
						 );
						$ValidationFunctionName="CheckEditEventValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Event</span>
                         <a href="event.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                                 <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Event Time:</label>
                                    <div class="mws-form-item">
                                    
                                       <div class="grid_4"> 
                                        <select  name="starttime" >
                                           <option value=""> Select Start Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        
                                        
                                        <select  name="starttime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                         <span style="color:#F00;" id="span_starttime"></span>
                                        </div>
                                        
                                         <div class="grid_4"> 
                                        
                                         <select  name="endtime" >
                                           <option value=""> Select End Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                         <select  name="endtime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_endtime"></span>
                                        </div>
                                        <?php echo $row['event_time'];?>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Event Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Event Date" rel="tooltip" value="<?php echo $row['event_date']?>" id="datepicker" data-placement="bottom" name="event_date" >
                                        <span style="color:#F00;" id="span_event_date"></span>
                                    </div>
                                </div>
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Branch City:</label>
                                    <div class="mws-form-item">
                                        <select  name="city_id" >
                                           <option value=""> --Select City--</option>
                                            <?php
								
                                $sql_con="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                $result_con= $this->db->query($sql_con,__FILE__,__LINE__);
                                while($row_con= $this->db->fetch_array($result_con))
                                {
									
									
                                ?>
                                <option <?php if($row['city_id']==$row_con['id']){?> selected="selected"<?php }?> value="<?php echo $row_con['id'];?>"><?php echo $row_con['branch'];?></option>
                                <?php }?>
                                        </select>
                                    </div>
                                </div>
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							 $this->city_id=$city_id;
						    $this->heading=$heading;
							$this->event_date=$event_date;
							$this->content=$content;
							
							
							if($starttime=='')
							{
								$this->event_time=$row['event_time'];
							}
							else
							{
								$this->event_time=$starttime.' '.$starttime1.' To '.$endtime.' '.$endtime1;
							}
							
							
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();

							$update_sql_array['event_date'] = $this->event_date;
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['content'] = $this->content;
							$update_sql_array['event_time'] = $this->event_time;
							$update_sql_array['city_id'] = $this->city_id;
							
							
							$this->db->update(TBL_EVENTS,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "event.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditEvent('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageEvent($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_EVENTS." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "event.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Press Release/////////////////////////////////////////////////

function AddPressRelease($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddPressRelease";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading ","span_heading"),
										 
										 "release_date"=>array('release_date',"''","Please Enter PressRelease date ","span_release_date"),
										 "city"=>array('city',"''","Please Enter City Name ","span_city"),
											 
						 );
						$ValidationFunctionName="CheckAddPressReleaseValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Press Release</span>
                         <a href="press-release.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                
                                
                                     <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Press Release Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Press Release Date" rel="tooltip" value="<?php echo date('Y-m-d');?>" id="datepicker" data-placement="bottom" name="release_date" >
                                        <span style="color:#F00;" id="span_release_date"></span>
                                    </div>
                                </div>
                          
                    			
                                <div class="mws-form-row">
                                    <label class="mws-form-label">City:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="City" rel="tooltip" data-placement="bottom" name="city" >
                                        <span style="color:#F00;" id="span_city"></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
		                 	case 'server':
							extract($_POST);
							
							$this->city=$city;
							$this->heading=$heading;
							$this->release_date=$release_date;
							$this->content=$content;
							
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();

                            $insert_sql_array['city'] = $this->city;
							$insert_sql_array['release_date'] = $this->release_date;
							$insert_sql_array['heading'] = $this->heading;
							$insert_sql_array['content'] = $this->content;
							
							
							
 							
							$this->db->insert(TBL_PRESS_RELEASE,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "press-release.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddPressRelease('local');
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallPressRelease()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All PressRelease</span>
                        <a href="press-release.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add PressRelease</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="30%">Heading</th>
                      
                        <th  width="20%">Press Release Date</th>
                        
                        <th  width="30%">City</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_PRESS_RELEASE." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['heading'];?>
                                    </td>
                                     <td align="center"><?php echo date('F, d - Y',strtotime($row['release_date']));?></td>
                                    
                                    
                                    <td align="center">
                                    
                                   <?php echo $row['city'];?>
                                    </td>
                                    
                                    <td align="center">
                                  
                                   <a href="press-release.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this PressRelease?')) { programobj.deletepagePressRelease('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
		
		    
function EditPressRelease($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditPressRelease";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading ","span_heading"),
										 
										 "release_date"=>array('release_date',"''","Please Enter PressRelease date ","span_release_date"),
										 "city"=>array('city',"''","Please Enter City Name ","span_city"),
											 
						 );
						$ValidationFunctionName="CheckEditPressReleaseValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_PRESS_RELEASE." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Press Release</span>
                         <a href="press-release.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                                 <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Press Release Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Press Release Date" rel="tooltip" value="<?php echo $row['release_date'];?>" id="datepicker" data-placement="bottom" name="release_date" >
                                        <span style="color:#F00;" id="span_release_date"></span>
                                    </div>
                                </div>
                          
                    			
                                <div class="mws-form-row">
                                    <label class="mws-form-label">City:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="City" rel="tooltip" data-placement="bottom" name="city" value="<?php echo $row['city'];?>" >
                                        <span style="color:#F00;" id="span_city"></span>
                                    </div>
                                </div>
                    			
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							$this->city=$city;
							$this->heading=$heading;
							$this->release_date=$release_date;
							$this->content=$content;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();

							$update_sql_array['release_date'] = $this->release_date;
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['content'] = $this->content;
							$update_sql_array['city'] = $this->city;
							
							
							$this->db->update(TBL_PRESS_RELEASE,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "press-release.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditPressRelease('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepagePressRelease($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_PRESS_RELEASE." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "press-release.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Posting Job In career tab /////////////////////////////////////////////////

function AddJob($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddJob";
						$ControlNames=array("designation"=>array('designation',"''","Please Enter Designation ","span_designation"),
										 
										 "location"=>array('location',"''","Please Select Location Branch ","span_location"),
										 "department"=>array('department',"''","Please Enter Department ","span_department"),
											 
						 );
						$ValidationFunctionName="CheckAddJobValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Job</span>
                         <a href="career-job.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Designation:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Designation" rel="tooltip" data-placement="bottom" name="designation" >
                                        <span style="color:#F00;" id="span_designation"></span>
                                    </div>
                                </div>
                                
                                
                                  <div class="mws-form-row">
                    				<label class="mws-form-label">Job Details</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Department:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Department" rel="tooltip"  data-placement="bottom" name="department" >
                                        <span style="color:#F00;" id="span_department"></span>
                                    </div>
                                </div>
                          
                    			
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Location:</label>
                                    <div class="mws-form-item">
                                        
                                          <select class="large" name="location">
                                              <option value="">--Select Location Branch--</option>
                                              <option value="All our Branches">All our Branches</option>
                                                <?php
                                                $sql_branch="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                                $result_branch= $this->db->query($sql_branch,__FILE__,__LINE__);
                                                while($row_branch= $this->db->fetch_array($result_branch))
                                                {
                                                ?>
                                                <option value="<?php echo $row_branch['branch'];?>"><?php echo $row_branch['branch'];?></option>
                                                <?php }?>
                                                
                                                
                                           </select>
                                        
                                        <span style="color:#F00;" id="span_location"></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
		                 	case 'server':
							extract($_POST);
							
							$this->designation=$designation;
							$this->content=$content;
							$this->location=$location;
							$this->department=$department;
							
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($designation,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();

                            $insert_sql_array['designation'] = $this->designation;
							$insert_sql_array['content'] = $this->content;
							$insert_sql_array['location'] = $this->location;
							$insert_sql_array['department'] = $this->department;
							
							
							
 							
							$this->db->insert(TBL_CAREER_JOB,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "career-job.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddJob('local');
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallJob()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Job</span>
                        <a href="career-job.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add Job</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Designation</th>
                        <th width="30%">Department</th>
                        <th width="20%">Location</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_CAREER_JOB." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['designation'];?>
                                    </td>
                                     <td align="center">
									  <?php echo $row['department'];?>
                                    </td>
                                    <td align="center">
									  <?php echo $row['location'];?>
                                    </td>
                                    
                                    <td align="center">
                                  
                                   <a href="career-job.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this Job?')) { programobj.deletepageJob('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
		
		    
function EditJob($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditJob";
						$ControlNames=array("designation"=>array('designation',"''","Please Enter Designation ","span_designation"),
										     "location"=>array('location',"''","Please Select Location Branch ","span_location"),
										     "department"=>array('department',"''","Please Enter Department ","span_department"),
											 
						 );
						$ValidationFunctionName="CheckEditJobValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_CAREER_JOB." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Job</span>
                         <a href="career-job.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			
                             
                              <div class="mws-form-row">
                                    <label class="mws-form-label">Designation:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Designation" rel="tooltip" data-placement="bottom" name="designation" value="<?php echo $row['designation'];?>" >
                                        <span style="color:#F00;" id="span_designation"></span>
                                    </div>
                                </div>
                                
                                
                                  <div class="mws-form-row">
                    				<label class="mws-form-label">Job Details</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Department:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Department" rel="tooltip"  data-placement="bottom" name="department" value="<?php echo $row['department'];?>">
                                        <span style="color:#F00;" id="span_department"></span>
                                    </div>
                                </div>
                          
                    			
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Location:</label>
                                    <div class="mws-form-item">
                                        
                                          <select class="large" name="location">
                                              <option value="">--Select Location Branch--</option>
                                              <option <?php if($row['location']=='All our Branches'){?> selected="selected"<?php }?> value="All our Branches">All our Branches</option>
                                                <?php
                                                $sql_branch="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                                $result_branch= $this->db->query($sql_branch,__FILE__,__LINE__);
                                                while($row_branch= $this->db->fetch_array($result_branch))
                                                {
                                                ?>
                                                <option <?php if($row_branch['branch']==$row['location']){?> selected="selected"<?php }?> value="<?php echo $row_branch['branch'];?>"><?php echo $row_branch['branch'];?></option>
                                                <?php }?>
                                                
                                                
                                           </select>
                                        
                                        <span style="color:#F00;" id="span_location"></span>
                                    </div>
                                </div>
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							$this->designation=$designation;
							$this->content=$content;
							$this->location=$location;
							$this->department=$department;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($designation,'empty','Please Enter designation')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();

							$update_sql_array['designation'] = $this->designation;
							$update_sql_array['location'] = $this->location;
							$update_sql_array['content'] = $this->content;
							$update_sql_array['department'] = $this->department;
							
							
							$this->db->update(TBL_CAREER_JOB,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "career-job.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditJob('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageJob($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_CAREER_JOB." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "career-job.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Manage Branch /////////////////////////////////////////////////

function AddBranch($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddBranch";
						$ControlNames=array("branch"=>array('branch',"''","Please Enter Designation ","span_branch"),
										 
										 "address"=>array('address',"''","Please Enter Address ","span_address"),
										 "lattitude"=>array('lattitude',"''","Please Enter Lattitude ","span_lattitude"),
										 "longitude"=>array('longitude',"''","Please Enter Longitude ","span_longitude"),
											 
						 );
						$ValidationFunctionName="CheckAddBranchValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Branch</span>
                         <a href="branch.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Branch Name:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Branch" rel="tooltip" data-placement="bottom" name="branch" >
                                        <span style="color:#F00;" id="span_branch"></span>
                                    </div>
                                </div>
                                
                                
                                  <div class="mws-form-row">
                    				<label class="mws-form-label">Full Address</label>
                                     <div class="mws-form-item">
                    				<textarea class="large"  name="address" ></textarea>
									<span style="color:#F00;" id="span_address"></span><br />
                                    </div>
                    			</div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Latitude:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Latitude" rel="tooltip"  data-placement="bottom" name="lattitude" >
                                        <span style="color:#F00;" id="span_lattitude"></span>
                                        <a href="http://www.latlong.net/" target="blank">Find Lattitude</a>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">
Longitude</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Longitude" rel="tooltip"  data-placement="bottom" name="longitude" >
                                        <span style="color:#F00;" id="span_longitude"></span>
                                        <a href="http://www.latlong.net/" target="blank">Find Longitude</a>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Telephone No:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Telephone" rel="tooltip"  data-placement="bottom" name="phone" >
                                        <span style="color:#F00;" id="span_phone"></span>
                                    </div>
                                </div>
                                
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">Mobile:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Mobile" rel="tooltip"  data-placement="bottom" name="mobile" >
                                        <span style="color:#F00;" id="span_mobile"></span>
                                    </div>
                                </div>
                                
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">Fax:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Fax" rel="tooltip"  data-placement="bottom" name="fax" >
                                        <span style="color:#F00;" id="span_fax"></span>
                                    </div>
                                </div>
                                
                                
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">Email:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Email" rel="tooltip"  data-placement="bottom" name="email" >
                                        <span style="color:#F00;" id="span_email"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Facebook Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Facebook Link" rel="tooltip"  data-placement="bottom" name="facebook_link" >
                                        <span style="color:#F00;" id="span_facebook"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Google Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Google Link" rel="tooltip"  data-placement="bottom" name="google_link" >
                                        <span style="color:#F00;" id="span_google"></span>
                                    </div>
                                </div>
                          
                    			
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
		                 	case 'server':
							extract($_POST);
							
							$this->branch=$branch;
							$this->address=$address;
							$this->phone=$phone;
							$this->mobile=$mobile;
							$this->fax=$fax;
							$this->email=$email;
							$this->facebook_link=$facebook_link;
							$this->google_link=$google_link;
							
							$this->lattitude=$lattitude;
							$this->longitude=$longitude;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($branch,'empty','Please Enter branch')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();

                            $insert_sql_array['branch'] = $this->branch;
							$insert_sql_array['address'] = $this->address;
							$insert_sql_array['phone'] = $this->phone;
							$insert_sql_array['fax'] = $this->fax;
							$insert_sql_array['mobile'] = $this->mobile;
							$insert_sql_array['email'] = $this->email;
							
							$insert_sql_array['lattitude'] = $this->lattitude;
							$insert_sql_array['longitude'] = $this->longitude;
							
							$insert_sql_array['facebook_link'] = $this->facebook_link;
							$insert_sql_array['google_link'] = $this->google_link;
							
							$this->db->insert(TBL_BRANCH,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "branch.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddBranch('local');
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallBranch()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Branch</span>
                        <a href="branch.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add Branch</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Branch Name</th>
                        <th width="25%">Address</th>
                        <th width="20%">Contact No</th>
                         <th width="15%">Email</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_BRANCH." order by branch asc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['branch'];?>
                                    </td>
                                     <td align="center">
									  <?php echo $row['address'];?>
                                    </td>
                                    <td align="left">
									  Tel :<?php echo $row['phone'];?><br>
                                      Mob :<?php echo $row['mobile'];?><br>
                                      Fax :<?php echo $row['fax'];?><br>
                                    </td>
                                    <td align="center">
									  <?php echo $row['email'];?>
                                    </td>
                                    <td align="center">
                                  
                                   <a href="branch.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this Branch?')) { programobj.deletepageBranch('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
		
		    
function EditBranch($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditBranch";
						$ControlNames=array("designation"=>array('designation',"''","Please Enter Designation ","span_designation"),
										      "address"=>array('address',"''","Please Enter Address ","span_address"),
										 "lattitude"=>array('lattitude',"''","Please Enter Lattitude ","span_lattitude"),
										 "longitude"=>array('longitude',"''","Please Enter Longitude ","span_longitude"),
											 
						 );
						$ValidationFunctionName="CheckEditBranchValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_BRANCH." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Branch</span>
                         <a href="branch.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			
                             
                              
                                
                            <div class="mws-form-row">
                                    <label class="mws-form-label">Branch Name:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Branch" rel="tooltip" data-placement="bottom" name="branch" value="<?php echo $row['branch'];?>" >
                                        <span style="color:#F00;" id="span_branch"></span>
                                    </div>
                                </div>
                                
                                
                                  <div class="mws-form-row">
                    				<label class="mws-form-label">Full Address</label>
                                      <div class="mws-form-item">
                    				<textarea  class="large"  name="address" ><?php echo $row['address'];?></textarea>
                                    
									<span style="color:#F00;" id="span_address"></span><br />
                                    </div>
                    			</div>
                                
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">Latitude:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Latitude" rel="tooltip" value="<?php echo $row['lattitude'];?>"  data-placement="bottom" name="lattitude" >
                                        <span style="color:#F00;" id="span_lattitude"></span>
                                        <a href="http://www.latlong.net/" target="blank">Find Lattitude</a>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">
Longitude</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Longitude" rel="tooltip" value="<?php echo $row['longitude'];?>"  data-placement="bottom" name="longitude" >
                                        <span style="color:#F00;" id="span_longitude"></span>
                                        <a href="http://www.latlong.net/" target="blank">Find Longitude</a>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Telephone No:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Telephone" rel="tooltip"  data-placement="bottom" name="phone" value="<?php echo $row['phone'];?>" >
                                        <span style="color:#F00;" id="span_phone"></span>
                                    </div>
                                </div>
                                
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">Mobile:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Mobile" rel="tooltip" value="<?php echo $row['mobile'];?>"  data-placement="bottom" name="mobile" >
                                        <span style="color:#F00;" id="span_mobile"></span>
                                    </div>
                                </div>
                                
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">Fax:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Fax" rel="tooltip" value="<?php echo $row['fax'];?>" data-placement="bottom" name="fax" >
                                        <span style="color:#F00;" id="span_fax"></span>
                                    </div>
                                </div>
                                
                                
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">Email:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Email" rel="tooltip" value="<?php echo $row['email'];?>"  data-placement="bottom" name="email" >
                                        <span style="color:#F00;" id="span_email"></span>
                                    </div>
                                </div>
                           <div class="mws-form-row">
                                    <label class="mws-form-label">Facebook Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Facebook Link" rel="tooltip"  data-placement="bottom" name="facebook_link" value="<?php echo $row['facebook_link'];?>" >
                                        <span style="color:#F00;" id="span_facebook"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Google Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Google Link" rel="tooltip"  data-placement="bottom" name="google_link" value="<?php echo $row['google_link'];?>" >
                                        <span style="color:#F00;" id="span_google"></span>
                                    </div>
                                </div>
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							$this->branch=$branch;
							$this->address=$address;
							$this->phone=$phone;
							$this->mobile=$mobile;
							$this->fax=$fax;
							$this->email=$email;
							$this->google_link=$google_link;
							$this->facebook_link=$facebook_link;
							
							$this->lattitude=$lattitude;
							$this->longitude=$longitude;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($branch,'empty','Please Enter branch')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();

							$update_sql_array['branch'] = $this->branch;
							$update_sql_array['address'] = $this->address;
							$update_sql_array['phone'] = $this->phone;
							$update_sql_array['mobile'] = $this->mobile;
							$update_sql_array['fax'] = $this->fax;
							$update_sql_array['email'] = $this->email;
							$update_sql_array['google_link'] = $this->google_link;
							$update_sql_array['facebook_link'] = $this->facebook_link;
							
							$update_sql_array['longitude'] = $this->longitude;
							$update_sql_array['lattitude'] = $this->lattitude;
							$this->db->update(TBL_BRANCH,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "branch.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditBranch('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageBranch($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_BRANCH." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "branch.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////University Visits/////////////////////////////////////////////////


function GetUniversity($id)
	{
		ob_start();
		
		
		
		?>
		<select class="large"  name="university_id" >
                    <option value=""> --Select University--</option>
					<?php
                    $sql="select * from ".TBL_UNIVERSITY." where country_id='".$id."' order by university_name ASC";
                    $result= $this->db->query($sql,__FILE__,__LINE__);
                    while($row= $this->db->fetch_array($result))
                    {
                    ?>
                      <option value="<?php echo $row['id'];?>"><?php echo $row['university_name'];?></option>
                    <?php }?>
         </select>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	

function AddUniversityVisits($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddUniversityVisits";
						$ControlNames=array("starttime"=>array('starttime',"''","Please Enter Start time ","span_starttime"),
										 "endtime"=>array('endtime',"''","Please Enter End time ","span_endtime"),
										 "visit_date"=>array('visit_date',"''","Please Enter Visit date ","span_visit_date"),
										 "country_id"=>array('country_id',"''","Please Select Country Name ","span_country_id"),
										 "university_id"=>array('university_id',"''","Please Select University Name ","span_university_id"),
										 "branch_id"=>array('branch_id',"''","Please Select Branch Name ","span_branch_id"),
											 
						 );
						$ValidationFunctionName="CheckAddUniversityVisitsValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add University Visits</span>
                         <a href="university-visits.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Select Country:</label>
                                    <div class="mws-form-item">
                                        <select class="large" onchange="programobj.GetUniversity(this.value,{target:'UniversityDiv'})"  name="country_id" >
                                           <option value=""> --Select Country--</option>
												<?php
                                                $sql_coun="select * from ".TBL_COUNTRY." where 1 order by country ASC";
                                                $result_coun= $this->db->query($sql_coun,__FILE__,__LINE__);
                                                while($row_coun= $this->db->fetch_array($result_coun))
                                                {
                                                ?>
                                                <option value="<?php echo $row_coun['id'];?>"><?php echo $row_coun['country'];?></option>
                                                <?php }?>
                                        </select>
                                        <span style="color:#F00;" id="span_country_id"></span>
                                    </div>
                                </div>
                                
                                
                                  <div class="mws-form-row" >
                                    <label class="mws-form-label">Select University:</label>
                                    <div class="mws-form-item" >
                                      <div id="UniversityDiv">
                                        <select class="large"  name="university_id" >
                                           <option value=""> --Select University--</option>
                                        </select>
                                      </div>  
                                      <span style="color:#F00;" id="span_university_id"></span>
                                    </div>
                                 </div>   
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">University Visits Time:</label>
                                    <div class="mws-form-item">
                                    
                                       <div class="grid_4"> 
                                        <select  name="starttime" >
                                           <option value=""> Select Start Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        
                                        
                                        <select  name="starttime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                         <span style="color:#F00;" id="span_starttime"></span>
                                        </div>
                                        
                                         <div class="grid_4"> 
                                        
                                         <select  name="endtime" >
                                           <option value=""> Select End Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                         <select  name="endtime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_endtime"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">University Visit Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="University Visit Date" rel="tooltip" id="datepicker" value="<?php echo date('Y-m-d');?>" data-placement="bottom" name="visit_date" >
                                        <span style="color:#F00;" id="span_visit_date"></span>
                                    </div>
                                </div>
                          
                    			
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Branch City:</label>
                                    <div class="mws-form-item">
                                        <select  name="branch_id" >
                                           <option value=""> --Select City--</option>
                                            <?php
								
                                $sql_con="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                $result_con= $this->db->query($sql_con,__FILE__,__LINE__);
                                while($row_con= $this->db->fetch_array($result_con))
                                {
									
									
                                ?>
                                <option value="<?php echo $row_con['id'];?>"><?php echo $row_con['branch'];?></option>
                                <?php }?>
                                        </select>
                                         <span style="color:#F00;" id="span_branch_id"></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
		                 	case 'server':
							extract($_POST);
							
							$this->branch_id=$branch_id;
							$this->country_id=$country_id;
							$this->visit_date=$visit_date;
							$this->university_id=$university_id;
							$this->visit_time=$starttime.' '.$starttime1.' To '.$endtime.' '.$endtime1;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($country_id,'empty','Please Enter Country')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();

                            $insert_sql_array['country_id'] = $this->country_id;
							$insert_sql_array['visit_date'] = $this->visit_date;
							$insert_sql_array['university_id'] = $this->university_id;
							$insert_sql_array['branch_id'] = $this->branch_id;
							$insert_sql_array['visit_time'] = $this->visit_time;
							
							
 							
							$this->db->insert(TBL_UNIVERSITYVISITS,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "university-visits.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddUniversityVisits('local');
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	   
function GetUniversityName($id)
	{
		
                    $sql="select * from ".TBL_UNIVERSITY." where id='".$id."' ";
                    $result= $this->db->query($sql,__FILE__,__LINE__);
                    $row= $this->db->fetch_array($result);
                    return $row['university_name'];
		
		
	}	 
	
	function GetCountryName($id)
	{
		
                    $sql="select * from ".TBL_COUNTRY." where id='".$id."' ";
                    $result= $this->db->query($sql,__FILE__,__LINE__);
                    $row= $this->db->fetch_array($result);
                    return $row['country'];
		
		
	}	 
					  
		  function showallUniversityVisits()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All University Visits</span>
                        <a href="university-visits.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add University Visits</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="20%">University Name</th>
                      
                        <th  width="20%">Visit Date</th>
                        <th  width="20%"> Visit Time</th>
                        <th  width="20%">Branch </th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_UNIVERSITYVISITS." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $this->GetUniversityName($row['university_id']);?> -  <?php echo $this->GetCountryName($row['country_id']);?>
                                    </td>
                                     <td align="center"><?php echo date('F, d - Y',strtotime($row['visit_date']));?></td>
                                    <td align="center">
                                    
                                   <?php echo $row['visit_time'];?>
                                    </td>
                                    
                                    <td align="center">
                                    
                                   <?php echo $this->getbranchname($row['branch_id']);?>
                                    </td>
                                    
                                    <td align="center">
                                  
                                   <a href="university-visits.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this University Visits?')) { programobj.deletepageUniversityVisits('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
			
			 
		    
function EditUniversityVisits($runat,$id)
	{
	$sql="select * from ".TBL_UNIVERSITYVISITS." where id='".$id."'" ;
	$result= $this->db->query($sql,__FILE__,__LINE__);
	$row= $this->db->fetch_array($result);
	
	switch($runat){
			case 'local':
						$FormName = "frm_EditUniversityVisits";
						$ControlNames=array("visit_date"=>array('visit_date',"''","Please Enter Visit date ","span_visit_date"),
										 "country_id"=>array('country_id',"''","Please Select Country Name ","span_country_id"),
										 "university_id"=>array('university_id',"''","Please Select University Name ","span_university_id"),
										 "branch_id"=>array('branch_id',"''","Please Select Branch Name ","span_branch_id"),
						 );
						$ValidationFunctionName="CheckEditUniversityVisitsValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated University Visits</span>
                         <a href="university-visits.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Select Country:</label>
                                    <div class="mws-form-item">
                                        <select class="large" onchange="programobj.GetUniversity(this.value,{target:'UniversityDiv'})"  name="country_id" >
                                           <option value=""> --Select Country--</option>
												<?php
                                                $sql_coun="select * from ".TBL_COUNTRY." where 1 order by country ASC";
                                                $result_coun= $this->db->query($sql_coun,__FILE__,__LINE__);
                                                while($row_coun= $this->db->fetch_array($result_coun))
                                                {
                                                ?>
                                                <option <?php if($row['country_id']==$row_coun['id']){?> selected="selected"<?php }?> value="<?php echo $row_coun['id'];?>"><?php echo $row_coun['country'];?></option>
                                                <?php }?>
                                        </select>
                                        <span style="color:#F00;" id="span_country_id"></span>
                                    </div>
                                </div>
                                
                                
                                  <div class="mws-form-row" >
                                    <label class="mws-form-label">Select University:</label>
                                    <div class="mws-form-item" >
                                      <div id="UniversityDiv">
                                          <select class="large"  name="university_id" >
                                                        <option value=""> --Select University--</option>
                                                        <?php
                                                        $sql1="select * from ".TBL_UNIVERSITY." where country_id='".$row['country_id']."' order by university_name ASC";
                                                        $result1= $this->db->query($sql1,__FILE__,__LINE__);
                                                        while($row1= $this->db->fetch_array($result1))
                                                        {
                                                        ?>
                                                          <option <?php if($row['university_id']==$row1['id']){?> selected="selected"<?php }?>  value="<?php echo $row1['id'];?>"><?php echo $row1['university_name'];?></option>
                                                        <?php }?>
                                             </select>
                                      </div>  
                                      <span style="color:#F00;" id="span_university_id"></span>
                                    </div>
                                 </div>   
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">University Visits Time:</label>
                                    <div class="mws-form-item">
                                    
                                       <div class="grid_4"> 
                                        <select  name="starttime" >
                                           <option value=""> Select Start Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        
                                        
                                        <select  name="starttime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                         <span style="color:#F00;" id="span_starttime"></span>
                                        </div>
                                        
                                         <div class="grid_4"> 
                                        
                                         <select  name="endtime" >
                                           <option value=""> Select End Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                         <select  name="endtime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_endtime"></span>
                                        </div>
                                        <?php echo $row['visit_time'];?>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">University Visits Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="University Visits Date" rel="tooltip" value="<?php echo $row['visit_date']?>" id="datepicker" data-placement="bottom" name="visit_date" >
                                        <span style="color:#F00;" id="span_visit_date"></span>
                                    </div>
                                </div>
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Branch City:</label>
                                    <div class="mws-form-item">
                                        <select  name="branch_id" >
                                           <option value=""> --Select City--</option>
                                            <?php
								
                                $sql_con="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                $result_con= $this->db->query($sql_con,__FILE__,__LINE__);
                                while($row_con= $this->db->fetch_array($result_con))
                                {
									
									
                                ?>
                                <option <?php if($row['branch_id']==$row_con['id']){?> selected="selected"<?php }?> value="<?php echo $row_con['id'];?>"><?php echo $row_con['branch'];?></option>
                                <?php }?>
                                        </select>
                                        <span style="color:#F00;" id="span_branch_id"></span>
                                    </div>
                                </div>
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							$this->branch_id=$branch_id;
							$this->country_id=$country_id;
							$this->visit_date=$visit_date;
							$this->university_id=$university_id;
							
							
							if($starttime=='')
							{
								$this->visit_time=$row['visit_time'];
							}
							else
							{
								$this->visit_time=$starttime.' '.$starttime1.' To '.$endtime.' '.$endtime1;
							}
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($country_id,'empty','Please Enter Country')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();

							$update_sql_array['branch_id'] = $this->branch_id;
							$update_sql_array['country_id'] = $this->country_id;
							$update_sql_array['visit_date'] = $this->visit_date;
							$update_sql_array['university_id'] = $this->university_id;
							$update_sql_array['visit_time'] = $this->visit_time;
							
							
							$this->db->update(TBL_UNIVERSITYVISITS,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "university-visits.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditUniversityVisits('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageUniversityVisits($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_UNIVERSITYVISITS." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "university-visits.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////In-House Fairs/////////////////////////////////////////////////

function AddInHouseFairs($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddInHouseFairs";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading ","span_heading"),
										 "starttime"=>array('starttime',"''","Please Enter Start time ","span_starttime"),
										 "endtime"=>array('endtime',"''","Please Enter End time ","span_endtime"),
										 "fairs_date"=>array('fairs_date',"''","Please Enter Fairs Date ","span_fairs_date"),
										 "branch_id"=>array('branch_id',"''","Please Select Branch ","span_branch_id"),
											 
						 );
						$ValidationFunctionName="CheckAddInHouseFairsValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add In-House Fairs</span>
                         <a href="in-house-fairs.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                
                                
                                     <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">In-House Fairs Time:</label>
                                    <div class="mws-form-item">
                                    
                                       <div class="grid_4"> 
                                        <select  name="starttime" >
                                           <option value=""> Select Start Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        
                                        
                                        <select  name="starttime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                         <span style="color:#F00;" id="span_starttime"></span>
                                        </div>
                                        
                                         <div class="grid_4"> 
                                        
                                         <select  name="endtime" >
                                           <option value=""> Select End Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                         <select  name="endtime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_endtime"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">In-House Fairs Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="In-House Fairs Date" rel="tooltip" value="<?php echo date('Y-m-d');?>" data-placement="bottom" id="datepicker" name="fairs_date" >
                                        <span style="color:#F00;" id="span_fairs_date"></span>
                                    </div>
                                </div>
                          
                    			
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Branch City:</label>
                                    <div class="mws-form-item">
                                        <select  name="branch_id" >
                                           <option value=""> --Select City--</option>
                                            <?php
								
                                $sql_con="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                $result_con= $this->db->query($sql_con,__FILE__,__LINE__);
                                while($row_con= $this->db->fetch_array($result_con))
                                {
									
									
                                ?>
                                <option value="<?php echo $row_con['id'];?>"><?php echo $row_con['branch'];?></option>
                                <?php }?>
                                        </select>
                                        <span style="color:#F00;" id="span_branch_id"></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
		                 	case 'server':
							extract($_POST);
							
							$this->branch_id=$branch_id;
							$this->heading=$heading;
							$this->fairs_date=$fairs_date;
							$this->content=$content;
							$this->fairs_time=$starttime.' '.$starttime1.' To '.$endtime.' '.$endtime1;
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$insert_sql_array = array();

                            $insert_sql_array['branch_id'] = $this->branch_id;
							$insert_sql_array['fairs_date'] = $this->fairs_date;
							$insert_sql_array['heading'] = $this->heading;
							$insert_sql_array['content'] = $this->content;
							$insert_sql_array['fairs_time'] = $this->fairs_time;
							
							
 							
							$this->db->insert(TBL_IN_HOUSE_FAIRS,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "in-house-fairs.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddInHouseFairs('local');
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		  function showallInHouseFairs()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All In-House Fairs</span>
                        <a href="in-house-fairs.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add In-House Fairs</button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="20%">Heading</th>
                      
                        <th  width="20%">Fairs Date</th>
                        <th  width="20%">Fairs Time</th>
                        <th  width="20%">Branch</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_IN_HOUSE_FAIRS." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['heading'];?>
                                    </td>
                                     <td align="center"><?php echo date('F, d - Y',strtotime($row['fairs_date']));?></td>
                                    <td align="center">
                                    
                                   <?php echo $row['fairs_time'];?>
                                    </td>
                                    
                                    <td align="center">
                                    
                                   <?php echo $this->getbranchname($row['branch_id']);?>
                                    </td>
                                    
                                    <td align="center">
                                  
                                   <a href="in-house-fairs.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   | <a onclick="javascript: if(confirm('Do u want to delete this In-House Fairs?')) { programobj.deletepageInHouseFairs('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
			
			 
		    
function EditInHouseFairs($runat,$id)
	{
		$sql="select * from ".TBL_IN_HOUSE_FAIRS." where id='".$id."'" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row= $this->db->fetch_array($result);
	switch($runat){
			case 'local':
						$FormName = "frm_EditInHouseFairs";
						$ControlNames=array(
						 );
						$ValidationFunctionName="CheckEditInHouseFairsValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated In-House Fairs</span>
                         <a href="in-house-fairs.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                                 <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">In-House Fairs Time:</label>
                                    <div class="mws-form-item">
                                    
                                       <div class="grid_4"> 
                                        <select  name="starttime" >
                                           <option value=""> Select Start Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                        
                                        
                                        <select  name="starttime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                         <span style="color:#F00;" id="span_starttime"></span>
                                        </div>
                                        
                                         <div class="grid_4"> 
                                        
                                         <select  name="endtime" >
                                           <option value=""> Select End Time.</option>
                                           <?php for($a=1;$a<=12;$a++){?>
                                           <option value="<?php echo $a;?>"> <?php echo $a;?></option>
                                           <?php }?>
                                        </select>
                                         <select  name="endtime1" >
                                           <option value="AM">AM</option>
                                           <option value="PM">PM</option>
                                           
                                        </select>
                                        <span style="color:#F00;" id="span_endtime"></span>
                                        </div>
                                        <?php echo $row['fairs_time'];?>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">In-House Fairs Date:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="In-House Fairs Date" rel="tooltip" value="<?php echo $row['fairs_date']?>" id="datepicker" data-placement="bottom" name="fairs_date" >
                                        <span style="color:#F00;" id="span_fairs_date"></span>
                                    </div>
                                </div>
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Branch City:</label>
                                    <div class="mws-form-item">
                                        <select  name="branch_id" >
                                           <option value=""> --Select City--</option>
                                            <?php
								
                                $sql_con="select * from ".TBL_BRANCH." where 1 order by branch ASC";
                                $result_con= $this->db->query($sql_con,__FILE__,__LINE__);
                                while($row_con= $this->db->fetch_array($result_con))
                                {
									
									
                                ?>
                                <option <?php if($row['branch_id']==$row_con['id']){?> selected="selected"<?php }?> value="<?php echo $row_con['id'];?>"><?php echo $row_con['branch'];?></option>
                                <?php }?>
                                        </select>
                                    </div>
                                </div>
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							 $this->branch_id=$branch_id;
						    $this->heading=$heading;
							$this->fairs_date=$fairs_date;
							$this->content=$content;
							
							
							if($starttime=='')
							{
								$this->fairs_time=$row['fairs_time'];
							}
							else
							{
								$this->fairs_time=$starttime.' '.$starttime1.' To '.$endtime.' '.$endtime1;
							}
							
							
							
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();

							$update_sql_array['fairs_date'] = $this->fairs_date;
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['content'] = $this->content;
							$update_sql_array['fairs_time'] = $this->fairs_time;
							$update_sql_array['branch_id'] = $this->branch_id;
							
							
							$this->db->update(TBL_IN_HOUSE_FAIRS,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "in-house-fairs.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditInHouseFairs('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	
	
	function deletepageInHouseFairs($id)
	{
		ob_start();
		
		
		
		$sql="delete from ".TBL_IN_HOUSE_FAIRS." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "in-house-fairs.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Global Education Fairs////////////////////////////////////////////////////




			  
		  function showallGlobalEducationFairs()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Global Education Fairs</span>
                       <?php /*?> <a href="globaleducationfairs.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add In-House Fairs</button></div></a><?php */?>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="40%">Heading</th>
                        <th  width="40%">Video</th>
                       
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_GLOBAL_EDUCATION_FAIRS." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['heading'];?>
                                    </td>
                                     <td align="center">
									  <img src="http://img.youtube.com/vi/<?php echo $row['videolink'];?>/0.jpg" style="height:120px;" />
									 </td>
                                    <td align="center">
                                  
                                   <a href="globaleducationfairs.php?index=img&id=<?php echo $row['id'];?>" title="Manage Image" rel="tooltip" data-placement="top"><i class="icol-photo"></i></a>  
                                  |
                                   <a href="globaleducationfairs.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>  
                                   
                                   </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
			
			 
		    
function EditGlobalEducationFairs($runat,$id)
	{
		$sql="select * from ".TBL_GLOBAL_EDUCATION_FAIRS." where id='".$id."'" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row= $this->db->fetch_array($result);
	switch($runat){
			case 'local':
						$FormName = "frm_GlobalEducationFairs";
						$ControlNames=array(
						 );
						$ValidationFunctionName="CheckGlobalEducationFairsValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Global Education Fairs</span>
                         <a href="globaleducationfairs.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                                 <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                                
                                
                                
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Video Link:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Video Link" rel="tooltip" value="<?php echo $row['videolink']?>" data-placement="bottom" name="videolink" >
                                        <span style="color:#F00;" id="span_videolink"></span>
                                    </div>
                                </div>
                          
                    			
                                
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
						    $this->heading=$heading;
							$this->videolink=$videolink;
							$this->content=$content;
							
							
						
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
							if($return){							
							$update_sql_array = array();

						
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['content'] = $this->content;
							$update_sql_array['videolink'] = $this->videolink;
							
							
							
							$this->db->update(TBL_GLOBAL_EDUCATION_FAIRS,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "globaleducationfairs.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditGlobalEducationFairs('local',$id);
							}
							break;
			                default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	





 function AllImg()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Global Education Fairs Image</span>
                        <a href="globaleducationfairs.php?index=addimg"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add </button></div></a>
                        
                         <a href="globaleducationfairs.php"/><div align="right"><button type="button" style="margin-right:80px;margin-top:-30px;"class="btn btn-success"><i class="icon-plus"></i> Back </button></div></a>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="40%">Heading</th>
                        <th  width="40%">Image</th>
                       
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_GLOBAL_EDUCATION_FAIRS_IMG." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['heading'];?>
                                    </td>
                                     <td align="center">
									   <img src="../gallery/<?php echo $row['image_path'];?>" style="height:70px;" />
									 </td>
                                    <td align="center">
                                  
                                   <a href="globaleducationfairs.php?index=editimg&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a> 
                                   
                                    | <a onclick="javascript: if(confirm('Do u want to delete this Image?')) { programobj.deletepageImg('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  
                                   
                                   </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
			
function AddImg($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddImg";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading","span_heading"),
											 "filess"=>array('filess',"''","Please Select An Image","span_filess"),
											 
						 );
						$ValidationFunctionName="CheckAddEbrochureValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Image</span>
                         <a href="globaleducationfairs.php?index=img"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                
                          
                                
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess" style="color:#F00;"></span>
                                    </div>
                                </div>
                                
                               
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_GLOBAL_EDUCATION_FAIRS_IMG." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
						
					    $this->path=$path;
						
						$this->heading=$heading;
						
						
						
					
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
						
							if($return){							
							$insert_sql_array = array();

							
							$insert_sql_array['image_path'] = $this->path;
							$insert_sql_array['heading'] = $this->heading;
							
							
 							
							$this->db->insert(TBL_GLOBAL_EDUCATION_FAIRS_IMG,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "globaleducationfairs.php?index=img"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddImg('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		
		    
			function EditImg($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditEditImg";
						$ControlNames=array("heading"=>array('heading',"''","Please Enter Heading","span_heading"),
						 );
						$ValidationFunctionName="CheckEditEditImgValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_GLOBAL_EDUCATION_FAIRS_IMG." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Image</span>
                         <a href="globaleducationfairs.php?index=img"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" value="<?php echo $row['heading'];?>" data-placement="bottom" name="heading" >
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                             
                             
                             
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess"></span>
                                        <img src="../gallery/<?php echo $row['image_path'];?>" style=" height:60px;"/>
                                    </div>
                                </div>
                                
                              
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
						
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_GLOBAL_EDUCATION_FAIRS_IMG." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
							
						
					    $this->path=$path;
						
						$this->heading=$heading;
						
						
						
					
							//server side validation
							$return =true;
							if($this->Form->ValidField($heading,'empty','Please Enter Heading')==false)
							$return =false;
						
						
							if($return){							
							$update_sql_array = array();

							
							$update_sql_array['image_path'] = $this->path;
							$update_sql_array['heading'] = $this->heading;
							
 							
								$this->db->update(TBL_GLOBAL_EDUCATION_FAIRS_IMG,$update_sql_array,id,$id);

							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "globaleducationfairs.php?index=img"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditImg('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	

function deletepageImg($id)
	{
		ob_start();
		
		$sql1="select * from ".TBL_GLOBAL_EDUCATION_FAIRS_IMG." where id='".$id."'" ;
		$result1= $this->db->query($sql1,__FILE__,__LINE__);
		$row1= $this->db->fetch_array($result1);
		$path='../gallery/'.$row1['image_path'];
		
		unlink($path);
		
		$sql="delete from ".TBL_GLOBAL_EDUCATION_FAIRS_IMG." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "globaleducationfairs.php?index=img";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Student Dairy//////////////////////////////////////////




 function ShowallStudentDairy()
		 {
				
			?>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Student Dairy</span>
                        <a href="student-dairy.php?index=add"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-plus"></i> Add </button></div></a>
                        
                        
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="10%">ID</th>
                        <th  width="20%">Student Name</th>
                        
                        <th  width="30%">University Name</th>
                        <th  width="30%">Image</th>
                       
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
							<?php 
                            $sql="select * from ".TBL_STUDENT_DAIRY." order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                					<tr>
                                    <td align="center"><?php echo $x?></td>
                                    <td align="center">
									  <?php echo $row['name'];?>
                                    </td>
                                    
                                    <td align="center">
									 <?php echo $this->GetUniversityName($row['university_id']);?>
                                    </td>
                                     <td align="center">
									   <img src="../gallery/<?php echo $row['image_path'];?>" style="height:70px;" />
									 </td>
                                    <td align="center">
                                  
                                   <a href="student-dairy.php?index=edit&id=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a> 
                                   
                                    | <a onclick="javascript: if(confirm('Do u want to delete this Image?')) { programobj.deletepageStudentDairy('<?php echo $row['id'];?>',{}) };" data-placement="top" rel="tooltip" href="javascript: void(0);" data-original-title="Delete"><i class="icol-application-delete"></i></a>  
                                   
                                   </td>
                                    </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                    </table>
                    </div>
                	</div>
	
                       
                            
                    <?php 
		
		
			 }
			 
			 
			
function AddStudentDairy($runat)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_AddStudentDairy";
						$ControlNames=array("fname"=>array('fname',"''","Please Enter Name","span_fname"),
											 "filess"=>array('filess',"''","Please Select An Image","span_filess"),
											  "university_id"=>array('university_id',"''","Please Select University Name","span_university_id"),
											 
											 
											 
						 );
						$ValidationFunctionName="CheckAddStudentDairyValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add Student Dairy</span>
                         <a href="student-dairy.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Student Name:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Student Name" rel="tooltip" data-placement="bottom" name="fname" >
                                        <span style="color:#F00;" id="span_fname"></span>
                                    </div>
                                </div>
                                
                                
                               <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                                
                          
                              <div class="mws-form-row">
                                    <label class="mws-form-label">University:</label>
                                    <div class="mws-form-item">
                                         <select class="large"  name="university_id" >
                                                    <option value=""> --Select University--</option>
                                                    <?php
                                                    $sql="select * from ".TBL_UNIVERSITY." where 1 order by university_name ASC";
                                                    $result= $this->db->query($sql,__FILE__,__LINE__);
                                                    while($row= $this->db->fetch_array($result))
                                                    {
                                                    ?>
                                                      <option value="<?php echo $row['id'];?>"><?php echo $row['university_name'];?></option>
                                                    <?php }?>
                                         </select>
                                        <span style="color:#F00;" id="span_university_id"></span>
                                    </div>
                                </div>
                                
                          
                        
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess" style="color:#F00;"></span>
                                    </div>
                                </div>
                                
                               
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_STUDENT_DAIRY." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
						
					    $this->path=$path;
						
						$this->fname=$fname;
						$this->content=$content;
						$this->university_id=$university_id;
						
						
						
					
							//server side validation
							$return =true;
							if($this->Form->ValidField($fname,'empty','Please Enter name')==false)
							$return =false;
						
						
							if($return){							
							$insert_sql_array = array();

							
							$insert_sql_array['image_path'] = $this->path;
							$insert_sql_array['name'] = $this->fname;
							$insert_sql_array['content'] = $this->content;
							$insert_sql_array['university_id'] = $this->university_id;
							
							
 							
							$this->db->insert(TBL_STUDENT_DAIRY,$insert_sql_array);

							$_SESSION['msg'] = 'Successfully added';
							
							?>
							<script type="text/javascript">
							window.location = "student-dairy.php";
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddStudentDairy('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	                  
					  
		
		    
			function EditStudentDairy($runat,$id)
	{
    
	switch($runat){
			case 'local':
						$FormName = "frm_EditEditStudentDairy";
						$ControlNames=array("fname"=>array('fname',"''","Please Enter name","span_fname"),
						 );
						$ValidationFunctionName="CheckEditEditStudentDairyValidity";
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						
						$sql="select * from ".TBL_STUDENT_DAIRY." where id='".$id."'" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Updated Student Dairy</span>
                         <a href="student-dairy.php"/><div align="right"><button type="button" style="margin-left:25px;margin-top:-25px;"class="btn btn-success"><i class="icon-cyclop"></i> Back</button></div></a>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		
						   
                             <div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Student Name:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Student Name" rel="tooltip" value="<?php echo $row['name'];?>" data-placement="bottom" name="fname" >
                                        <span style="color:#F00;" id="span_fname"></span>
                                    </div>
                                </div>
                             
                             <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
										include_once("fckeditor/fckeditor.php");
										$sBasePath = $_SERVER['PHP_SELF'] ;
										$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
										$oFCKeditor = new FCKeditor('content') ;
										//$oFCKedditor->skin="office";
										$oFCKeditor->BasePath	= $sBasePath ;
										$oFCKeditor->Value		=  $row['content']; ;
										$oFCKeditor->Create() ;
										?>
                    				</div>
									<span style="color:#F00;" id="span_content"></span><br />
                    			</div>
                              <div class="mws-form-row">
                                    <label class="mws-form-label">University:</label>
                                    <div class="mws-form-item">
                                         <select class="large"  name="university_id" >
                                                    <option value=""> --Select University--</option>
                                                    <?php
                                                    $sql1="select * from ".TBL_UNIVERSITY." where 1 order by university_name ASC";
                                                    $result1= $this->db->query($sql1,__FILE__,__LINE__);
                                                    while($row1= $this->db->fetch_array($result1))
                                                    {
                                                    ?>
                                                      <option <?php if($row['university_id']==$row1['id']){?> selected="selected"<?php }?> value="<?php echo $row1['id'];?>"><?php echo $row1['university_name'];?></option>
                                                    <?php }?>
                                         </select>
                                        <span style="color:#F00;" id="span_university_id"></span>
                                    </div>
                                </div>
                          
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Image:</label>
                                    <div class="mws-form-item">
                                        <input type="file"  name="filess" value="" class="large" title="image"  rel="tooltip" data-placement="bottom"> <span id="span_filess"></span>
                                        <img src="../gallery/<?php echo $row['image_path'];?>" style=" height:60px;"/>
                                    </div>
                                </div>
                                
                              
                             </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
						
							$this->headingmix= str_replace(' ','-',$heading);
							
							 
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_STUDENT_DAIRY." where id='".$id."'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image_path'];
							}
							else
							{
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= $tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							
							
							
							
						$this->path=$path;
						
						$this->fname=$fname;
						$this->content=$content;
						$this->university_id=$university_id;
						
						
						
					
							//server side validation
							$return =true;
							if($this->Form->ValidField($fname,'empty','Please Enter Student Name')==false)
							$return =false;
						
						
							if($return){							
							$update_sql_array = array();

							
							$update_sql_array['image_path'] = $this->path;
							$update_sql_array['name'] = $this->fname;
							$update_sql_array['content'] = $this->content;
							$update_sql_array['university_id'] = $this->university_id;
							
 							
							$this->db->update(TBL_STUDENT_DAIRY,$update_sql_array,id,$id);
							$_SESSION['msg'] = 'Successfully Updated';
							
							?>
							<script type="text/javascript">
							window.location = "student-dairy.php"
							
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditStudentDairy('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	
	}
	    
	

function deletepageStudentDairy($id)
	{
		ob_start();
		
		$sql1="select * from ".TBL_STUDENT_DAIRY." where id='".$id."'" ;
		$result1= $this->db->query($sql1,__FILE__,__LINE__);
		$row1= $this->db->fetch_array($result1);
		$path='../gallery/'.$row1['image_path'];
		
		unlink($path);
		
		$sql="delete from ".TBL_STUDENT_DAIRY." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']=' Deleted successfully';
		
		?>
		<script type="text/javascript">
		 window.location= "student-dairy.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}	





}


?>