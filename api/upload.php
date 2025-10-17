<?php
if (session_status()===PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo json_encode(['error' => 'Use POST']);
	exit;
}

$userId = isset($_SESSION['uid']) ? (int)$_SESSION['uid'] : 0;
if ($userId <= 0) {
	echo json_encode(['error' => 'Unauthorized']);
	exit;
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
	echo json_encode(['error' => 'No file uploaded']);
	exit;
}

$tmp = $_FILES['file']['tmp_name'];
$f = fopen($tmp, 'r');
if (!$f) {
	echo json_encode(['error' => 'Failed to open file']);
	exit;
}

$conn = db();
$insert = $conn->prepare('INSERT INTO transactions (user_id, tx_date, amount, category, description, tx_type) VALUES (?,?,?,?,?,?)');
$insert->bind_param('isdsss', $userId, $txDateInt, $amountFloat, $categoryStr, $descStr, $typeStr);

$header = fgetcsv($f);
// expected headers: date, amount, category, description, type
$count = 0;
while (($row = fgetcsv($f)) !== false) {
	if (count($row) < 2) continue;
	$rawDate = trim($row[0]);
	$rawAmount = trim($row[1]);
	$categoryStr = isset($row[2]) ? substr(trim($row[2]), 0, 120) : null;
	$descStr = isset($row[3]) ? substr(trim($row[3]), 0, 255) : null;
	$typeStr = isset($row[4]) && strtolower($row[4])==='credit' ? 'credit' : 'debit';

	$ts = strtotime($rawDate);
	$txDateInt = $ts ? date('Y-m-d', $ts) : date('Y-m-d');
	$amountFloat = (float)$rawAmount;

	$insert->execute();
	$count++;
}
fclose($f);

echo json_encode(['ok' => true, 'imported' => $count]);
?>