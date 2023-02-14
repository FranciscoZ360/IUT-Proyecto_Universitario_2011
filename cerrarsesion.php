<?php 
session_start(); 	// recuperar la sesion
session_destroy();	// eliminar la sesion
header("Location: login.php"); 
?>