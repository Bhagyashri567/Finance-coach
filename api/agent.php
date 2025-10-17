<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status()===PHP_SESSION_NONE) session_start();
header('Content-Type: application/json');

// Simple CORS for local dev
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Access-Control-Allow-Methods: POST, OPTIONS');
	exit;
}
header('Access-Control-Allow-Origin: *');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?: [];
$message = isset($data['message']) ? trim($data['message']) : '';
$userId = isset($_SESSION['uid']) ? (string)$_SESSION['uid'] : 'guest';

if ($message === '') {
	echo json_encode(['error' => 'Empty message']);
	exit;
}

$payload = json_encode([
	'message' => $message,
	'user_id' => $userId,
]);

$python = 'python'; // or 'py' on some Windows setups
$script = realpath(__DIR__ . '/../ai/agent.py');

if (!is_file($script)) {
	echo json_encode(['error' => 'Agent script not found: ' . $script]);
	exit;
}

$descriptors = [
	0 => ['pipe', 'r'],
	1 => ['pipe', 'w'],
	2 => ['pipe', 'w'],
];

$process = proc_open("$python \"$script\"", $descriptors, $pipes, dirname($script));

if (!is_resource($process)) {
	echo json_encode(['error' => 'Failed to start agent']);
	exit;
}

fwrite($pipes[0], $payload);
fclose($pipes[0]);

$stdout = stream_get_contents($pipes[1]);
$stderr = stream_get_contents($pipes[2]);
fclose($pipes[1]);
fclose($pipes[2]);

$exitCode = proc_close($process);

if ($exitCode !== 0 && $stdout === '') {
	echo json_encode(['error' => 'Agent crashed', 'details' => $stderr]);
	exit;
}

$resp = json_decode($stdout, true);
if ($resp === null) {
	echo json_encode(['error' => 'Invalid agent response', 'raw' => $stdout]);
	exit;
}

echo json_encode($resp);
?>