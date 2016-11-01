<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();

include("dataBase.php");

if(isset($_SESSION['user-email']))
echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";

?>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				<meta charset="utf-8"/>
				<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet"/>
				<title>Questions XML</title>
				<style>
					p#name  {font-size: 250%; text-align: center; font-weight: 100;}
					body	{font-family: 'Roboto', sans-serif;}
					input   {font-size: 100%;}
					table	{border-collapse: collapse; width: 50%; }
					th		{text-align: center;padding: 8px; border-bottom: 1px solid #ddd;}
					td 		{padding: 8px; text-align: left; border-bottom: 1px solid #ddd;}
					tr:hover{background-color:#f5f5f5}

				</style>
			</head>
			<body>
				<p id='name' align='center'> Questions XML </p>

				<table align="center" cellpadding="5"> 
					<tr>
						<th> Question </th>
						<th> Difficulty </th>
						<th> Subject </th>
					</tr>
					<xsl:for-each select="assessmentItems/assessmentItem">
						<tr>
							<td><xsl:value-of select="itemBody/p"/></td>
							<td><xsl:value-of select="@complexity"/></td>
							<td><xsl:value-of select="@subject"/></td>
						</tr>
					</xsl:for-each>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>