<?php 

class ManagePrinter{
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
                <h3 class="panel-title">All Printers</h3>
                 <a href="manage_printer.php?index=add" class="btn btn-success m-b-5 pull-right" style="margin-top:-25px;">Category To Printer Mapping</a>
            </div>
           
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Printer Name</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
                            $sql="select * from ".TBL_MANAGE_PRINTER." where 1 order by id desc" ;
                            $result= $this->db->query($sql,__FILE__,__LINE__);
                            $x=1;
                            while($row = $this->db->fetch_array($result))
                            {
                            ?>
                                <tr class="tbl_row">
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['printer_name'];?></td>
                                    <td>
               <a href="manage_printer.php?index=edit&id=<?php echo $row['id'];?>" title="View and Edit Printer-Category Mapping" rel="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>  
               
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
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Categories To Printer Mapping</h3></div>
            <div class="panel-body">
            
                <form class="form-horizontal" role="form" action="" method="post">
                <div class="form-group">
                <label for="printer_name">Printer Name</label>
                <input type="text" required class="form-control" name="printer_name" value="<?php echo $row['printer_name'];?>" id="printer_name" placeholder="Printer Name">
                
                </div>

                    <div class="form-group">
                    <label for="category">Categories</label>
                    
                        <?php 
                            $sql2="select * from ".TBL_CATEGORY." where 1 order by id desc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {
                        ?>
                            <div class="checkbox">
                                <label class="cr-styled">
                                    <input type="checkbox"  name="category[]" value="<?Php echo $row2['id'];?>">
                                    <i class="fa"></i> 
                                    <?php echo $row2['name'];?>
                                </label>
                            </div>
                            <?php }?>
                           
                            
                        
                    </div> <!-- form-group -->
                   <button type="submit" name="submit" value="Submit" class="btn btn-success">Submit</button>
                     <!-- form-group -->
                  
                </form>
            
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->


      <!-- col -->
     
</div> <!-- End row -->
</div>     
						<?php 
	
	break;
	case 'server':
	extract($_POST);
	$this->printer_name=$printer_name;
	$this->cateogry=implode(', ',$category);
	
	$return =true;
	if($this->Form->ValidField($printer_name,'empty','Please Enter Printer Name')==false)
	$return =false;

	if($return){
	$insert_sql_array = array();
	$insert_sql_array['branch_id'] 	= $_SESSION['branch_id'];
	$insert_sql_array['category'] 	= $this->cateogry;
	$insert_sql_array['printer_name'] 	= $this->printer_name;
	
	$this->db->insert(TBL_MANAGE_PRINTER,$insert_sql_array);
	$_SESSION['msg'] = 'Printer to category mapping has been done successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_printer.php?index=all";
	</script>
	<?php
	exit();
	} else {
	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
	$this->editpage('local');
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
$sql	=	"select * from ".TBL_MANAGE_PRINTER." where   branch_id='".$_SESSION['branch_id']."' and id='".$id."' ";
$res	=	$this->db->query($sql,__FILE__,__LINE__);
$row	=	$this->db->fetch_array($res);
$category=explode(', ',$row['category']);
?>
		
<div class="wraper container-fluid">
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Categories To Printer Mapping</h3></div>
            <div class="panel-body">
            
                <form class="form-horizontal" role="form" action="" method="post">
                <div class="form-group">
                <label for="printer_name">Printer Name</label>
                <input type="text" required class="form-control" title="Printer Name is required" required name="printer_name" value="<?php echo $row['printer_name'];?>" id="printer_name" placeholder="Printer Name">
                
                </div>

                    <div class="form-group">
                    <label for="category">Categories</label>
                    
                        <?php 
                            $sql2="select * from ".TBL_CATEGORY." where 1 order by id desc" ;
                            $result2= $this->db->query($sql2,__FILE__,__LINE__);
                            $x=1;
                            while($row2 = $this->db->fetch_array($result2))
                            {
                        ?>
                            <div class="checkbox">
                                <label class="cr-styled">
                                    <input type="checkbox"  name="category[]" value="<?Php echo $row2['id'];?>" <?php if(in_array($row2['id'],$category)) echo "checked";?>>
                                    <i class="fa"></i> 
                                    <?php echo $row2['name'];?>
                                </label>
                            </div>
                            <?php }?>
                           
                            
                        
                    </div> <!-- form-group -->
                   <button type="submit" name="submit" value="Submit" class="btn btn-success">Submit</button>
                     <!-- form-group -->
                  
                </form>
            
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->


      <!-- col -->
     
</div> <!-- End row -->
</div>     
						<?php 
					
	break;
	case 'server':
	extract($_POST);
	$this->printer_name=$printer_name;
	$this->category=implode(', ',$category);
	
	$return =true;
	if($this->Form->ValidField($printer_name,'empty','Please Enter Printer Name')==false)
	$return =false;
	if($return){
	

	
		$update_sql_array = array();
		$update_sql_array['printer_name'] 	= $this->printer_name;
		$update_sql_array['category'] 	= $this->category;
		$update_sql_array['branch_id'] 	= $_SESSION['branch_id'];
		
		$this->db->update(TBL_MANAGE_PRINTER,$update_sql_array,'id',$id);	

	$_SESSION['msg'] = 'Printer to category mapping has been updated successfully';
	?>
	<script type="text/javascript">
	window.location = "manage_printer.php?index=all";
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
	
	
}
?>