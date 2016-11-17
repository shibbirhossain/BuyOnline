<?xml version="1.0"?><!-- DWXMLSource="results.xml" -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:output method="html"/>
 <xsl:template match="/">
 <HTML>
 <HEAD>
 <TITLE> Manager Processing</TITLE>
 </HEAD>
 <BODY>
 

 	<xsl:for-each select="Goods/good[sold &gt; '0']">

 		<tr>
 			
 			<td> <xsl:value-of select="id" /></td>
			<td style="color:blue; font-weight:bold;"><xsl:value-of select="name"  /></td>
			<td style="color:red; font-style: italic; "><xsl:value-of select="price"/></td>
			<td style=""><xsl:value-of select="quantity"/></td>
			<td> <xsl:value-of select="hold" /></td>
			<td> <xsl:value-of select="sold" /></td>
			
		</tr>

	</xsl:for-each>

	<div class="btn-toolbar">
		<button type="button" class="btn btn-primary" onclick="processItems()">Process</button> 
		
	</div>
 </BODY>
 </HTML>
 </xsl:template>
</xsl:stylesheet>