<?php
require_once __DIR__.'/config.php';

$dsn      = 'mysql:dbname='.$oauth_config['dbname'].';host='.$oauth_config['dbhost'];
$username = $oauth_config['dbuser'];
$password = $oauth_config['dbpass'];

// error reporting (this is a demo, after all!)
ini_set('display_errors',1);error_reporting(E_ALL);

// Autoloading (composer is preferred, but for this example let's just do this)
require_once($oauth_config['oauthdirpath'].'/Autoloader.php');
OAuth2\Autoloader::register();

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
$storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

$server = new OAuth2\Server($storage, array(
	'use_openid_connect' => true,
	'allow_implicit' => true,
	'issuer' => $oauth_config['issuer'],
));

$scope = new OAuth2\Scope(array(
  'supported_scopes' => array('profile', 'openid', 'preferred_username', 'email')
));

$server->setScopeUtil($scope);

/*
$publicKey  = file_get_contents('pubkey.pem');
$privateKey = file_get_contents('privkey.pem');

$keyStorage = new OAuth2\Storage\Memory(array('keys' => array(
    'public_key'  => $publicKey,
    'private_key' => $privateKey,
)));
$server->addStorage($keyStorage, 'public_key');
*/

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new OAuth2\OpenID\GrantType\AuthorizationCode($storage));

$grantType = new OAuth2\GrantType\JwtBearer($storage, 'skyvr-ocean');
