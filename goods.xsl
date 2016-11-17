<?xml version="1.0"?><!-- DWXMLSource="results.xml" -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:output method="html"/>
 <xsl:template match="/">
 <HTML>
 <HEAD>
 <TITLE> Goods</TITLE>
 </HEAD>
 <BODY>
 

 	<xsl:for-each select="Goods/good[quantity &gt; '0']">

 		<tr>
 			
 			<td> <xsl:value-of select="id" /></td>
			<td style="color:blue; font-weight:bold;"><xsl:value-of select="name"  /></td>
			<td style="color:red; font-style: italic; "><xsl:value-of select="substring(description,0,20)"/></td>
			<td style=""><xsl:value-of select="price"/></td>
			<td> <xsl:value-of select="quantity" /></td>
			<td><button type="button" class="btn btn-primary" onclick="addItem('{name}')">Add one to cart</button></td>
		</tr>

	</xsl:for-each>
 </BODY>
 </HTML>
 </xsl:template>
</xsl:stylesheet>