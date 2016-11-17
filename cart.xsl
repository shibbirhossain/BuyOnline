<?xml version="1.0"?><!-- DWXMLSource="results.xml" -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:output method="html"/>
 <xsl:template match="/">
 <HTML>
 <HEAD>
 <TITLE> Goods</TITLE>
 </HEAD>
 <BODY>
 

 	<xsl:for-each select="Goods/good[hold &gt; '0']">

 		<tr class='tablerow'>
 			
 			<td> <xsl:value-of select="id" /></td>
			<td> <xsl:value-of select="name" /></td>
			<td style="color:blue; font-weight:bold;" class='price'><xsl:value-of select="price"  /></td>
			<td style="color:red; font-style: italic; " class='hold'><xsl:value-of select="hold" /></td>
			<td><button type="button" class="btn btn-primary" onclick="removeItem('{name}')">Remove from cart</button></td>
		</tr>
	</xsl:for-each>



	
		<!-- <xsl:variable name="total" select="sum( Goods/good[hold &gt; '0'] /price)"/>-->
		<p id="cartTotal"> </p> 
	
 
	<div class="btn-toolbar">
		<button type="button" class="btn btn-primary" onclick="confirmPurchase()">Confirm Purchase</button> 
		<button type="button" class="btn btn-primary" onclick="cancelPurchase()">Cancel Purchase</button>
	</div>
	
 </BODY>
 </HTML>
 </xsl:template>
</xsl:stylesheet>