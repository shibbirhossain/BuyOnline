<?php

	//Author: Md Shibbir Hossain
	//100864497
	//this page checks the manager session	
	session_start();

	if(empty($_SESSION['manager_id'])){
		echo "Not logged in";
	}
	else echo $_SESSION['manager_id'];
?>