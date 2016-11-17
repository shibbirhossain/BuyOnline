<?php
	session_start();
    //Author: Md Shibbir Hossain
    //100864497
    //this page handles the activities when manager add a new item into goods
	$name = $_POST['name'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$id1 = getUniqueID();
	$description = $_POST['description'];
	$isDuplicate = false;


    function getUniqueID(){

        $xmlFile = "../../data/goods.xml";

        $dom = DOMDocument::load($xmlFile);
        $good = $dom->getElementsByTagName("good"); 
        $findMax = 0;

        foreach ($good as $node) {

            $idfromxml = $node->getElementsByTagName("id");
            $idfromxml = $idfromxml->item(0)->nodeValue;

            if($findMax < $idfromxml){
               $findMax = $idfromxml; 
            }
        }
        $id = $findMax + 1;

        return $id; 
    }


    function checkDuplicateEmail($name){

        $xmlFile = "../../data/goods.xml";

        $dom = DOMDocument::load($xmlFile);
        $good = $dom->getElementsByTagName("good"); 

        foreach($good as $node) 
        { 
             $namefromxml = $node->getElementsByTagName("name");
             $namefromxml = $namefromxml->item(0)->nodeValue;
          
          
            if ($namefromxml == $name )
            {   
                return true;    
            }
            
        }

        return false; 
    }

if(isset($_SESSION['manager_id'])){
    $xmldoc = new DomDocument( '1.0' );
$xmldoc->preserveWhiteSpace = false;
$xmldoc->formatOutput = true;

$alreadyExists = checkDuplicateEmail($name);

if( ($xml = file_get_contents( '../../data/goods.xml'))  &&  !($alreadyExists) ) {
    $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

    $hold = 0;
    $sold = 0;
    // find the headercontent tag
    $root = $xmldoc->getElementsByTagName('Goods')->item(0);

    // create the <customer> tag
    $good = $xmldoc->createElement('good');
    //$numAttribute = $xmldoc->createAttribute("num");
    //$numAttribute->value = $productNum;
    //$product->appendChild($numAttribute);

    // add the product tag before the first element in the <headercontent> tag
    $root->insertBefore( $good, $root->firstChild );

    // create other elements and add it to the <product> tag.
    $id = $xmldoc->createElement('id');
    $good->appendChild($id);
    $idValue = $xmldoc->createTextNode($id1);
    $id->appendChild($idValue);

    $nameElement = $xmldoc->createElement('name');
    $good->appendChild($nameElement);
    $nameText = $xmldoc->createTextNode($name);
    $nameElement->appendChild($nameText);

    $priceElement = $xmldoc->createElement('price');
    $good->appendChild($priceElement);
    $priceText = $xmldoc->createTextNode($price);
    $priceElement->appendChild($priceText);

    $quantityElement = $xmldoc->createElement('quantity');
    $good->appendChild($quantityElement);
    $quantityText = $xmldoc->createTextNode($quantity);
    $quantityElement->appendChild($quantityText);

    $quantityElement = $xmldoc->createElement('hold');
    $good->appendChild($quantityElement);
    $quantityText = $xmldoc->createTextNode($hold);
    $quantityElement->appendChild($quantityText);

    $quantityElement = $xmldoc->createElement('sold');
    $good->appendChild($quantityElement);
    $quantityText = $xmldoc->createTextNode($sold);
    $quantityElement->appendChild($quantityText);

    $descriptionElement = $xmldoc->createElement('description');
    $good->appendChild($descriptionElement);
    $descriptionText = $xmldoc->createTextNode($description);
    $descriptionElement->appendChild($descriptionText);

    $xmldoc->save('../../data/goods.xml');
    echo "Successfully registered";
}
else{
    echo "Duplicate entry found";
}

}//end of if->isset
else{
    echo "Sorry you are not logged in to add items";
}

?>
