<?php


//Author: Md Shibbir Hossain
	//100864497
	//this page handles the activities when logout link button is clicked
session_start();



if(!empty($_SESSION['manager_id'])){
	$manager_id = $_SESSION['manager_id'];
	session_destroy();
	echo $manager_id;
}
else if(!empty($_SESSION['customer_email'])){
	$customer_id = $_SESSION['customer_email'];
	session_destroy();
	echo $customer_id;
}

else echo "0";


?>