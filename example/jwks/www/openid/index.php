<html>
	<head>
		<title>Test OpenID</title>
	</head>
	<body>
		<table width="100%" height="100%">
			<tr>
				<td valign="middle" align="center">

				Click to the link:<br>
<?php
	include_once('config.php');
	$link = $oauth_config['client'].'?iss='.$oauth_config['issuer'].'&vendor='.$oauth_config['vendor'].'&uatype='.$oauth_config['uatype'];
	echo "<a href='$link'>$link</a>";
?>
				</td>
			</tr>
		</table>
	</body>
</html>
