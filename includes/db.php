<?php
if (!defined('DB_HOST')) {
	define('DB_HOST', '127.0.0.1');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'financecoach');
}

function db(): mysqli {
	static $conn = null;
	if ($conn instanceof mysqli) return $conn;
	$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_errno) {
		die('DB connection failed: ' . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	return $conn;
}
?>