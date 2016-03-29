<?php

// include our OAuth2 Server object
require_once __DIR__.'/server.php';

// Handle a request to a resource and authenticate the access token
if (!$server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
    $server->getResponse()->send();
    die;
}

$response = array(
	'name' => 'John Smith',
	'given_name' => 'John',
	'family_name' => 'Smith',
	'sub' => 'test',
	'middle_name' => 'John',
	'nickname' => 'johnsmith',
	'preferred_username' => 'johnsmith',
	'profile' => '',
	'picture' => '',
	'website' => 'http://johnsmith.com/',
	'gender' => '',
	'birthdate' => '',
	'zoneinfo' => '',
	'locale' => '',
	'updated_at' => '',
	'email' => 'johnsmith@johnsmith.com',
	'email_verified' => true,
	'phone_number' => '',
	'phone_number_verified' => '',
	'phone_number' => '',
	'address' => array(
		'formatted' => '',
		'street_address' => '',
		'locality' => '',
		'region' => '',
		'postal_code' => '',
		'country' => 'India',
	)
);

echo json_encode($response);
