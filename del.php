<?php
require_once("class/config.inc.php");
include_once("function/class.homepage.php");
include_once("function/class.member.php");
$branch_obj=new Member();
$homepage = new HomePage();
extract($_REQUEST);
$notify = new Notification();
extract($_POST);
$delete = "DELETE FROM ".$table." WHERE id='".$id."' ";
$homepage->db->query($delete,__FILE__,__LINE__);
$sql="select * from ".$table." where page_id='".$id."'  ";
$result=$homepage->db->query($sql,__FILE__,__LINE__);
$row = $this->db->fetch_array($result);
$path		=	'../uploads/'.$row['image_path'];
unlink($path);
if($table==TBL_PRODUCT)
{
$delete = "DELETE FROM ".TBL_PRODUCT_INGRADIENT." WHERE product_id='".$id."' ";
$homepage->db->query($delete,__FILE__,__LINE__);
}
if($table==TBL_PURCHASE_ORDER){
$delete = "DELETE FROM ".TBL_PURCHASE_ITEM." WHERE order_id='".$id."' ";
$homepage->db->query($delete,__FILE__,__LINE__);

}
if($table==TBL_POS_ORDER){
$delete = "DELETE FROM ".TBL_POS_ORDER." WHERE order_id='".$id."' ";
$homepage->db->query($delete,__FILE__,__LINE__);

}

?>
