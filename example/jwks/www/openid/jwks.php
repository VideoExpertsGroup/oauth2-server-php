<?php

$pub_key = openssl_pkey_get_public(file_get_contents('./pubkey.pem'));
$keyData = openssl_pkey_get_details($pub_key);

$response = array(
	"keys" => array(),
);

$response['keys'][0] = array();
$response['keys'][0]["kty"] = "RSA";
$response['keys'][0]["n"] = base64_encode($keyData["rsa"]["n"]);
$response['keys'][0]["e"] = base64_encode($keyData["rsa"]["e"]);
$response['keys'][0]["kid"] = "1";

header('Content-Type: application/json');
echo json_encode($response);
