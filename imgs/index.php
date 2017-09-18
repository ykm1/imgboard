<?php
require_once 'controller.php';
$iController = new ImgsController($_GET['action']);
$iController->run();
exit;
?>