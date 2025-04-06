<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
	define('DBNAME', 'themis');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('ROOT', 'http://localhost/themisrepo/public');

}else
{
	/** database config **/
	define('DBNAME', 'my_db');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.yourwebsite.com');

}

define('APP_NAME', "My Webiste");
define('APP_DESC', "Best website on the planet");

/** true means show errors **/
define('DEBUG', true);

// stripe API keys
define('STRIPE_SECRET', 'sk_test');
define('STRIPE_PUBLIC', 'pk_test'); //update this when using in the END presentation

