<?php
//**************** Notification class Created for displaying notification messages across the website ****************
	class Notification
	{
	
		var $notice;	
		var $timeout;
	
		function __construct()
		{
			$this->notice=$_SESSION['msg'];
			$this->error=$_SESSION['error_msg'];
			$this->timeout=1000;
		}
		function SetNote($note)
		{
			$this->notice=$note;
		}
		
		function SetTimeout($SetTimeout)
		{
			$this->SetTimeout=$SetTimeout;
		}
		
		function Notify()
		{
			?>
            <style>
			.closebtn {
			margin-left: 15px;
			color: white;
			font-weight: bold;
			float: right;
			font-size: 22px;
			line-height: 20px;
			cursor: pointer;
			transition: 0.3s;
			}
			</style>
            <?php
			
			if($this->notice!='') {
			?>
         
			<script type="text/javascript">
			$.Notification.autoHideNotify('success','top center');
		<?php /*?>	setTimeout('document.getElementById("message_t").style.display="none";',<?php echo $this->timeout; ?>);<?php */?>
			</script> 
            <div class="notifyjs-corner"  style="top: 0px; left: 45%;"> 
            <div class="notifyjs-wrapper">
  <div class="notifyjs-arrow" style="">
  
  </div>
  <div class="notifyjs-container" id="message_t" style="">
  <div class="notifyjs-metro-base notifyjs-metro-success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  <div class="image" data-notify-html="image"><i class="fa fa-check"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title">Success</div><div class="text" data-notify-html="text"><?php echo $this->notice; ?></div></div></div></div>
</div></div>
			
			<?php
			$this->destroy_note();
			}
			else if($this->error!='')
			{
			?>
			<script type="text/javascript">
			$.Notification.autoHideNotify('error','top center');
			setTimeout('document.getElementById("message_t").style.display="none";',<?php echo $this->timeout; ?>);
			</script> 
            <div class="notifyjs-corner"  style="top: 0px; left: 45%;">
                <div class="notifyjs-wrapper">
                    <div class="notifyjs-arrow" style="">
                    </div>
                <div class="notifyjs-container" id="message_t" style="">
                <div class="notifyjs-metro-base notifyjs-metro-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <div class="image" data-notify-html="image"><i class="fa fa-exclamation"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title">Error</div><div class="text" data-notify-html="text"><?php echo $this->error; ?></div></div></div></div>
                </div></div>
			<?php
			$this->destroy_note();
			}
		}
		
		function destroy_note()
		{
			$_SESSION['msg']='';
			$_SESSION['error_msg']='';
		}
	
	}

?>