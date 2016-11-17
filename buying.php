<?php
//Author: Md Shibbir Hossain
//100864497
//this page loads the items from xml
	session_start();

	if(isset($_SESSION['customer_email'])){
		$xmlDoc = new DOMDocument("1.0");
		$xmlDoc->formatOutput = true;
		$xmlDoc->load("../../data/goods.xml");

		//xsl DOM Document
		$xslDoc = new DOMDocument("1.0");
		$xslDoc->load("goods.xsl");

		//xsl processor
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xslDoc);

		$strXml = $proc->transformToXML($xmlDoc);

		echo($strXml);

	}
	else echo "<h1>Sorry, You are not logged in to view this page</h1>";
	
?>