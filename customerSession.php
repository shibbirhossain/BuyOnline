<?php
	//Author: Md Shibbir Hossain
	//100864497
	//this page checks the customer session
	session_start();

	if(empty($_SESSION['customer_email'])){
		echo "Not logged in";
	}
	else echo $_SESSION['customer_email'];
?>