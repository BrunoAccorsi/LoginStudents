<?php
require_once "controllers/UserController.php";

$userController = new UserController();
$userController->logout();

header("Location: index.php");
exit;
?>