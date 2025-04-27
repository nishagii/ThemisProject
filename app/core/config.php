<?php

// Load environment variables from .env file
function loadEnv($path)
{
	if (!file_exists($path)) {
		return false;
	}

	$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($lines as $line) {
		// Skip comments
		if (strpos(trim($line), '#') === 0) {
			continue;
		}

		// Parse the line
		list($name, $value) = explode('=', $line, 2);
		$name = trim($name);
		$value = trim($value);

		// Remove quotes if present
		if (strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) {
			$value = substr($value, 1, -1);
		}

		// Set as environment variable
		putenv("$name=$value");
		$_ENV[$name] = $value;
	}

	return true;
}

// Load .env file from the same directory
loadEnv(__DIR__ . '/.env');

if ($_SERVER['SERVER_NAME'] == 'localhost') {
	/** database config **/
	define('DBNAME', 'crud');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'http://localhost/themisrepo/public');
} else {
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

// Use Stripe API keys from .env file
define('STRIPE_SECRET', getenv('SECRET_KEY') ?: 'sk_test');
define('STRIPE_PUBLIC', getenv('PUBLISHABLE_KEY') ?: 'pk_test');
