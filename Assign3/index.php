<?php
include_once("Controller/authController.php");
$controllers = new authController();
$controllers->__construct();
$controllers->invoke();
?>