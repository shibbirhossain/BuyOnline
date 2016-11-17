<?php

$name = $_POST['name'];
//Author: Md Shibbir Hossain
//100864497
//in this file, add item funtionalities are handled
//echo "from server add item".$name;

addItemToCart($name);

     function addItemToCart($name){

        $xmlFile = "../../data/goods.xml";

        $dom = DOMDocument::load($xmlFile);
        $good = $dom->getElementsByTagName("good"); 

        foreach($good as $node) 
        { 
             $namefromxml = $node->getElementsByTagName("name");
             $namefromxml = $namefromxml->item(0)->nodeValue;
          
          
            if ($namefromxml == $name )
            {   
            	
            	$quantityfromxml = $node->getElementsByTagName("quantity");
            	$quantityfromxml = $quantityfromxml->item(0)->nodeValue-1;

              if($quantityfromxml < 0) echo "Can not add item because not available";
              else{

                $holdfromxml = $node->getElementsByTagName("hold");
                $holdfromxml = $holdfromxml->item(0)->nodeValue + 1;
                $idfromxml = $node->getElementsByTagName("id");
                $idfromxml = $idfromxml->item(0)->nodeValue;

                $pricefromxml = $node->getElementsByTagName("price");
                $pricefromxml = $pricefromxml->item(0)->nodeValue;

                updateQuantity($quantityfromxml, $name, $holdfromxml, $idfromxml, $pricefromxml);
    
              }
            	
            	/*$quantityfromxml = $node->getElementsByTagName("quantity");
            	$quantityfromxml = $quantityfromxml->item(0)->nodeValue;*/

			
        		//echo "cutten quantity is ".$quantityfromxml;            
            }
            
        }     
    }

  function updateQuantity($quantityfromxml, $name, $holdfromxml, $idfromxml, $pricefromxml){

  	$file = "../../data/goods.xml";

	$xml=simplexml_load_file($file);

	foreach ($xml->xpath("//good[name='$name']/quantity") as $quantity) {

	$dom=dom_import_simplexml($quantity);
	$dom->nodeValue = $quantityfromxml;

	}

	foreach ($xml->xpath("//good[name='$name']/hold") as $hold) {
		$dom=dom_import_simplexml($hold);
		$dom->nodeValue = $holdfromxml;
	}

	file_put_contents($file, $xml->asXML());


	/*echo json_encode(
				array("id" => $idfromxml,
				"quantity" => $quantityfromxml,
				"price" => $pricefromxml
				)
				);*/
		printcart();
  }

  function printcart(){

  	$xmlDoc = new DOMDocument("1.0");
	$xmlDoc->formatOutput = true;
	$xmlDoc->load("../../data/goods.xml");

	//xsl DOM Document
	$xslDoc = new DOMDocument("1.0");
	$xslDoc->load("cart.xsl");

	//xsl processor
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xslDoc);

	$strXml = $proc->transformToXML($xmlDoc);

	echo($strXml);
  }

?>