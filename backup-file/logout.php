<?php
session_start();

require_once("class/config.inc.php");

  $auth = new Authentication();
  $auth->Destroy_Session();
?>