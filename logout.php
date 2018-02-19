<?php session_start(); ?>
<?php
	unset($_SESSION["nome"]); 
	header("Location: index.php");
?>