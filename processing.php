<?php
	//Author: Md Shibbir Hossain
	//100864497
	//this page handles the processing activities of manager
session_start();
if(isset($_SESSION['manager_id'])){
	$xmlDoc = new DOMDocument();
	$xmlDoc->formatOutput = true;
	$xmlDoc->load("../../data/goods.xml");

	//xsl DOM Document
	$xslDoc = new DOMDocument();
	$xslDoc->load("processing.xsl");

	//xsl processor
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xslDoc);

	$strXml = $proc->transformToXML($xmlDoc);

	echo($strXml);

}
else{
	echo "Sorry you are not logged in to view the contents.";
}


?>