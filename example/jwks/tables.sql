	CREATE TABLE oauth_access_tokens (
	  access_token         VARCHAR(40)    NOT NULL COMMENT 'System generated access token',
	  client_id            VARCHAR(80)             COMMENT 'OAUTH_CLIENTS.CLIENT_ID',
	  user_id              VARCHAR(80)             COMMENT 'OAUTH_USERS.USER_ID',
	  expires              TIMESTAMP      NOT NULL COMMENT 'When the token becomes invalid',
	  scope                VARCHAR(4000)           COMMENT 'Space-delimited list of scopes token can access',
	  PRIMARY KEY (access_token)
	);

	CREATE TABLE oauth_authorization_codes (
	  authorization_code   VARCHAR(40)    NOT NULL COMMENT 'System generated authorization code',
	  client_id            VARCHAR(80)             COMMENT 'OAUTH_CLIENTS.CLIENT_ID',
	  user_id              VARCHAR(80)             COMMENT 'OAUTH_USERS.USER_ID',
	  redirect_uri         VARCHAR(2000)           COMMENT 'URI to redirect user after authorization',
	  expires              TIMESTAMP      NOT NULL COMMENT 'When the code becomes invalid',
	  scope                VARCHAR(4000)           COMMENT 'Space-delimited list scopes code can request',
	  id_token             TEXT                    COMMENT 'JSON web token used for OpenID Connect',
	  PRIMARY KEY (authorization_code)
	);

	CREATE TABLE oauth_clients (
	  client_id            VARCHAR(80)   NOT NULL COMMENT 'A unique client identifier',
	  client_secret        VARCHAR(80)            COMMENT 'Used to secure Client Credentials Grant',
	  redirect_uri         VARCHAR(2000)          COMMENT 'Redirect URI used for Authorization Grant',
	  grant_types          VARCHAR(80)            COMMENT 'Space-delimited list of permitted grant types',
	  scope                VARCHAR(4000)          COMMENT 'Space-delimited list of permitted scopes',
	  user_id              VARCHAR(80)            COMMENT 'OAUTH_USERS.USER_ID',
	  PRIMARY KEY (client_id)
	);

	CREATE TABLE oauth_jti (
	  issuer              VARCHAR(80)   NOT NULL,
	  subject             VARCHAR(80),
	  audience            VARCHAR(80),
	  expires             TIMESTAMP     NOT NULL,
	  jti                 VARCHAR(2000) NOT NULL
	);

	CREATE TABLE oauth_jwt (
	  client_id           VARCHAR(80)   NOT NULL,
	  subject             VARCHAR(80),
	  public_key          VARCHAR(2000) NOT NULL
	);

	CREATE TABLE oauth_public_keys (
	  client_id            VARCHAR(80),
	  public_key           VARCHAR(2000),
	  private_key          VARCHAR(2000),
	  encryption_algorithm VARCHAR(100) DEFAULT "RS256"
	);

	CREATE TABLE oauth_refresh_tokens (
	  refresh_token        VARCHAR(40)    NOT NULL COMMENT 'System generated refresh token',
	  client_id            VARCHAR(80)             COMMENT 'OAUTH_CLIENTS.CLIENT_ID',
	  user_id              VARCHAR(80)             COMMENT 'OAUTH_USERS.USER_ID',
	  expires              TIMESTAMP      NOT NULL COMMENT 'When the token becomes invalid',
	  scope                VARCHAR(4000)           COMMENT 'Space-delimited list scopes token can access',
	  PRIMARY KEY (refresh_token)
	);

	CREATE TABLE oauth_scopes (
	  scope                VARCHAR(80)    NOT NULL COMMENT 'Name of scope, without spaces',
	  is_default           BOOLEAN                 COMMENT 'True to grant scope',
	  PRIMARY KEY (scope)
	);

	CREATE TABLE oauth_users (
	  username            VARCHAR(80),
	  password            VARCHAR(80),
	  first_name          VARCHAR(80),
	  last_name           VARCHAR(80),
	  email               VARCHAR(80),
	  email_verified      BOOLEAN,
	  scope               VARCHAR(4000)
	);
