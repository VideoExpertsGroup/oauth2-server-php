# Requeriments

	* php5
	* apache
	* mysql
	* git
	
# Configuration

	$ cd ~
	$ git clone https://github.com/sea-kg/oauth2-server-php.git oauth2-server-php
	$ sudo cp -R oauth2-server-php/example/jwks/www/openid /var/www/html/
	$ sudo cp -R oauth2-server-php/src/OAuth2 /var/www/html/openid/
	$ sudo mv /var/www/html/openid/config.php.ini /var/www/html/openid/config.php

*Change file configs in /var/www/html/openid/config.php*

# Create database 

	$ mysql -u root -p
	Enter password: 

	> CREATE DATABASE `oauth2` CHARACTER SET utf8 COLLATE utf8_general_ci;
	> CREATE USER 'oauth2_user'@'localhost' IDENTIFIED BY 'oauth2_some_password';
	> GRANT ALL PRIVILEGES ON oauth2.* TO 'oauth2_user'@'localhost' WITH GRANT OPTION;
	> FLUSH PRIVILEGES;

# Create tables

	$ mysql -u root -p oauth2 < tables.sql

Or look here:

	https://github.com/dsquier/oauth2-server-php-mysql/blob/master/oauth.ddl

# Generate pem files

## private key

	$ cd ~
	$ openssl genrsa -out privkey.pem 2048

## public key

	$ cd ~
	$ openssl rsa -in privkey.pem -pubout -out pubkey.pem
	$ sudo cp pubkey.pem /var/www/html/openid/

## Where are your keys
	
	$ cd ~ && pwd

# Inserts to database:

	* generate client_id  (6 numbers) = '831438'
	* generate client_secret (32 hex chars) = 'ebb5f447aa497482fcc79f8cbcdffbb1'
	
	$ mysql -u oauth2_user -p oauth2

	> INSERT INTO oauth_clients(client_id, client_secret, redirect_uri) VALUES('831438', 'ebb5f447aa497482fcc79f8cbcdffbb1', 'http://client_host/svcauth/bycode')
	> INSERT INTO oauth_public_keys(client_id, encryption_algorithm) VALUES('831439', 'RS256');
	> UPDATE oauth_public_keys SET public_key = LOAD_FILE('where_are_your_keys/pubkey.pem') WHERE client_id = '831438';
	> UPDATE oauth_public_keys SET private_key = LOAD_FILE('where_are_your_keys/privkey.pem') WHERE client_id = '831438';

# Check

http://you_host/openid/


