<?php session_start();
require_once 'head.php';
downtext($_SESSION['type'],$_SESSION['filename']);
?>