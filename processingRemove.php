<?php
	//Author: Md Shibbir Hossain
  //100864497
  //this page handles the removal of node and reassigning of sold element to zero
	removeItemFromGood();
	function removeItemFromGood(){

        $xmlFile = "../../data/goods.xml";

        $dom = DOMDocument::load($xmlFile);
        $thedocument = $dom->documentElement;

        $good = $dom->getElementsByTagName("good"); 
        $nodetoremove = null;

        foreach($good as $node) 
        { 
             $soldfromxml = $node->getElementsByTagName("sold");
             $soldfromxml = $soldfromxml->item(0)->nodeValue;
          
          
            if ($soldfromxml > 0 )
            {   
            	
            	$quantityfromxml = $node->getElementsByTagName("quantity");
            	$quantityfromxml = $quantityfromxml->item(0)->nodeValue;
            	
            	$holdfromxml = $node->getElementsByTagName("hold");
            	$holdfromxml = $holdfromxml->item(0)->nodeValue;

            	$namefromxml = $node->getElementsByTagName("name");
            	$namefromxml = $namefromxml->item(0)->nodeValue;
            	
      			$soldfromxml = 0;

      			if($quantityfromxml == 0 && $holdfromxml == 0){

      				$nodetoremove = $namefromxml;
      				
      			}

            	updateQuantity($soldfromxml, $namefromxml, $nodetoremove);
   
            }
            
        }     
    }


    function updateQuantity($soldfromxml, $namefromxml, $nodetoremove){

	  	$file = "../../data/goods.xml";

		$xml=simplexml_load_file($file);

		foreach ($xml->xpath("//good[name='$namefromxml']/sold") as $sold) {

			$dom=dom_import_simplexml($sold);
			$dom->nodeValue = $soldfromxml;
		}

		if($nodetoremove != null){
			foreach ($xml->xpath("//good[name='$nodetoremove']") as $node ) {
				$dom = dom_import_simplexml($node);
        unset($node[0]);
			}
		}
		


		file_put_contents($file, $xml->asXML());

    echo "Successfully processed";
  }

?>