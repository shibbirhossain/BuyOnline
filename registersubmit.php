<?php

    //Author: Md Shibbir Hossain
    //100864497
    //this page handles the registration of customer and writing customer in xml file	
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	$email = $_POST['email'];
	$id1 = getUniqueID();
	$password = $_POST['password'];
	$contact = $_POST['contact'];
	$isDuplicate = false;


    function getUniqueID(){

        $xmlFile = "../../data/customer.xml";

        $dom = DOMDocument::load($xmlFile);
        $customer = $dom->getElementsByTagName("customer"); 
        $findMax = 0;

        foreach ($customer as $node) {

            $idfromxml = $node->getElementsByTagName("id");
            $idfromxml = $idfromxml->item(0)->nodeValue;

            if($findMax < $idfromxml){
               $findMax = $idfromxml; 
            }
        }
        $id = $findMax + 1;

        return $id; 
    }

    function checkDuplicateEmail($email){

        $xmlFile = "../../data/customer.xml";

        $dom = DOMDocument::load($xmlFile);
        $customer = $dom->getElementsByTagName("customer"); 

        foreach($customer as $node) 
        { 
             $emailfromxml = $node->getElementsByTagName("email");
             $emailfromxml = $emailfromxml->item(0)->nodeValue;
          
          
            if ($emailfromxml == $email )
            {   
                return true;    
            }
            
        }

        return false; 
    }

$xmldoc = new DomDocument( '1.0' );
$xmldoc->preserveWhiteSpace = false;
$xmldoc->formatOutput = true;

$alreadyExists = checkDuplicateEmail($email);

if( ($xml = file_get_contents( '../../data/customer.xml'))  &&  !($alreadyExists) ) {
    $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

    
    $root = $xmldoc->getElementsByTagName('customers')->item(0);

    // create the <customer> tag
    $customer = $xmldoc->createElement('customer');
    
    $root->insertBefore( $customer, $root->firstChild );

    
    $id = $xmldoc->createElement('id');
    $customer->appendChild($id);
    $idValue = $xmldoc->createTextNode($id1);
    $id->appendChild($idValue);

    $firstnameElement = $xmldoc->createElement('firstname');
    $customer->appendChild($firstnameElement);
    $firstnameText = $xmldoc->createTextNode($firstname);
    $firstnameElement->appendChild($firstnameText);

    $surnameElement = $xmldoc->createElement('surname');
    $customer->appendChild($surnameElement);
    $surnameText = $xmldoc->createTextNode($lastname);
    $surnameElement->appendChild($surnameText);

    $emailElement = $xmldoc->createElement('email');
    $customer->appendChild($emailElement);
    $emailText = $xmldoc->createTextNode($email);
    $emailElement->appendChild($emailText);

    $passwordElement = $xmldoc->createElement('password');
    $customer->appendChild($passwordElement);
    $passwordText = $xmldoc->createTextNode($password);
    $passwordElement->appendChild($passwordText);

    $contactElement = $xmldoc->createElement('contactphone');
    $customer->appendChild($contactElement);
    $contactText = $xmldoc->createTextNode($contact);
    $contactElement->appendChild($contactText);


    $xmldoc->save('../../data/customer.xml');
    echo "Successfully registered with Email: ".$email."\nFirst Name: ".$firstname."\nLast Name: ".$lastname."\nID: ".$id1."";
}
else{
    echo "Duplicate entry found";
}
?>
