<?php
// error_reporting(E_ERROR);
// include our OAuth2 Server object
require_once __DIR__.'/server.php';

$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

$scope = new OAuth2\Scope(array(
  'supported_scopes' => array('profile', 'openid', 'preferred_username', 'email')
));

$server->setScopeUtil($scope);

// validate the authorize request
if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
    die;
}

// display an authorization form
if (empty($_POST)) {
  exit('
<form method="POST">
  <label>Do You Authorize TestClient?</label><br />
  <input type="submit" name="authorized" value="yes">
  <input type="submit" name="authorized" value="no">
</form>');
}

// print the authorization code if the user has authorized your client
$is_authorized = ($_POST['authorized'] === 'yes');
$user_id = 'test';
$extendIdToken = array(
	'svc_access' => array(
		'account' => $user_id,
		'acl' => array(
			array(
				"S" => "Camera",
				"F" => array('6FFE80C889EB', '5C56EAE7F7EA'),
				"O" => "Camera",
				"P" => array("Play")
			),
			array(
				"S" => "Camera",
				"F" => array('6FFE80C889EB', '5C56EAE7F7EA'),
				"O" => "Clips",
				"P" => array("Play")
			),
		)
	)
);

$server->handleAuthorizeRequest($request, $response, $is_authorized, $user_id, $extendIdToken);
if ($is_authorized) {
	$redirect_uri = $_GET['redirect_uri'];
	header('Location: '.$response->getHttpHeader('Location'));
	exit();
	// this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
	$code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
	exit("SUCCESS! Authorization Code: $code");
}
$response->send();
