<?php

	//Author: Md Shibbir Hossain
	//100864497
	//this page checks the manager credential and creates manager session
	session_start();
	if($_POST['action'] == 'checkManager') {
  		
  		$isAuthenticated = false;
  		//echo "Manager is called";
		//we get the manager id and password send from the mlogin.htm here
		$mid = $_POST['mid'];
		$password = $_POST['password'];

		//echo "From Mlogin php ".$mid." password : ".$password ;
  		$file = "manager.txt";
		$data = file_get_contents($file);

		//print_r($data);
		$data = explode(PHP_EOL, $data);
		foreach ($data as $hello) {
			// split manager id and password from file here for matching purpose
			$splitWords = explode(",", $hello);

			//trimming new line and white spaces from saved password and manager id
			$savedID = trim(preg_replace('/\s\s+/', ' ', $splitWords[0]));
			$savedPassword = trim(preg_replace('/\s\s+/', ' ', $splitWords[1]));


			if($savedID == $mid && $savedPassword == $password){
				//echo "Its a match, you are logged in";
    			$_SESSION['manager_id'] = $mid;
    			//echo $_SESSION['foo'];
				$isAuthenticated = true;	
			}
			
		}

		if($isAuthenticated){
			//echo "Success, Manager is authenticated";
			echo json_encode(
				array("message1" => "Success",
				"message2" => $_SESSION['manager_id'])
				);
		}
		else{
			echo json_encode(
				array("message1" => "Fail",
				"message2" => "")
				);
		}
	}
if($_POST['action'] == 'checkSession') {

		if(empty($_SESSION['manager_id'])){
			echo "fail";
		}
		else{
			echo $_SESSION['manager_id'];	
		}		
}
?>