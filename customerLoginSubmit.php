<?php
	
    session_start();
	$email = $_POST['email'];
	$password = $_POST['password'];

	//echo "form submitter from php page ".$email."pass is ".$password;


	function checkCustomer($email, $password){

		$xmlFile = "../../data/customer.xml";

        $dom = DOMDocument::load($xmlFile);
        $customer = $dom->getElementsByTagName("customer"); 

        foreach($customer as $node) 
        { 
             $emailfromxml = $node->getElementsByTagName("email");
             $emailfromxml = $emailfromxml->item(0)->nodeValue;

             
          
          
            if ($emailfromxml == $email )
            {
            	$passwordfromxml = $node->getElementsByTagName("password");
             	$passwordfromxml = $passwordfromxml->item(0)->nodeValue;   
            	
            	if($passwordfromxml == $password){
                    $_SESSION['customer_email'] = $email;
            		return true;
            	}
                //return true;    
            }    
        }

        return false;

	}


	$isCustomerValid = checkCustomer($email, $password);

	if($isCustomerValid){
        
		echo 1;
	}
	else {
		echo "Sorry you are not registered";
	}
?>