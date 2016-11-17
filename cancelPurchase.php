<?php
	
	//Author: Md Shibbir Hossain
	//100864497
	//this page handles the activities when cancel purchase button is clicked
	cancelPurchase();

	    function cancelPurchase(){

	        $xmlFile = "../../data/goods.xml";

	        $dom = DOMDocument::load($xmlFile);
	        $good = $dom->getElementsByTagName("good"); 

	        foreach($good as $node) 
	        { 
	             $holdfromxml = $node->getElementsByTagName("hold");
	             $holdfromxml = $holdfromxml->item(0)->nodeValue;
	          
	          
	            if ($holdfromxml > 0 )
	            {   
	            	
	            	$quantityfromxml = $node->getElementsByTagName("quantity");
	            	$quantityfromxml = ($quantityfromxml->item(0)->nodeValue)+$holdfromxml;
	            	
	            	$holdfromxml = $node->getElementsByTagName("hold");
	            	$holdfromxml = ($holdfromxml->item(0)->nodeValue);

	            	/*$pricefromxml = $node->getElementsByTagName("price");
	            	$pricefromxml = $pricefromxml->item(0)->nodeValue;*/

	            	$namefromxml = $node->getElementsByTagName("name");
	            	$namefromxml = $namefromxml->item(0)->nodeValue;

	            	$holdfromxml = 0;

	            	updateQuantity($quantityfromxml, $holdfromxml, $namefromxml);
	            }
	            
	        }     
    }


    function updateQuantity($quantityfromxml, $holdfromxml, $namefromxml){

	  	$file = "../../data/goods.xml";

		$xml=simplexml_load_file($file);

		foreach ($xml->xpath("//good[name='$namefromxml']/quantity") as $quantity) {

		$dom=dom_import_simplexml($quantity);
		$dom->nodeValue = $quantityfromxml;

		}

		foreach ($xml->xpath("//good[name='$namefromxml']/hold") as $hold) {
			$dom=dom_import_simplexml($hold);
			$dom->nodeValue = $holdfromxml;
		}

		file_put_contents($file, $xml->asXML());
  }


?>