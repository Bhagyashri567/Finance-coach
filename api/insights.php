<?php
if (session_status()===PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');

$userId = isset($_SESSION['uid']) ? (int)$_SESSION['uid'] : 0;
$conn = db();

$stmt = $conn->prepare('SELECT text, created_at FROM insights WHERE user_id IN (?, 0) ORDER BY priority ASC, created_at DESC LIMIT 5');
$stmt->bind_param('i', $userId);
$stmt->execute();
$res = $stmt->get_result();
$items = [];
while ($row = $res->fetch_assoc()) {
	$items[] = ['text' => $row['text'], 'created_at' => $row['created_at']];
}

echo json_encode(['items' => $items]);
?>


