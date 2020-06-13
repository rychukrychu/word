<?php 
session_start();
session_destroy();
unset($_SESSION['login']);
unset($_SESSION['id']);
unset($_SESSION['rola']);
if(!isset($_SESSION['login']) && !isset($_SESSION['id']) && !isset($_SESSION['rola']))
{
	header("Location: index.php");
}
?>