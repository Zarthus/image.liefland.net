<?php

require __DIR__ . '/../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    unauthorized();
}

require __DIR__ . '/../src/validation_headers.php';

if (!isset($_POST['uuid'])) {
    unauthorized();
}

['uploadDir' => $uploadDir] = Config::get();

$deleteFile = $_POST['uuid'];
$filePath = $uploadDir . '/' . $deleteFile . '.png';

if (!preg_match('/^[a-zA-Z0-9_\-]+$/', $deleteFile) || !file_exists($filePath) || !is_file($filePath)) {
    unauthorized();
}

$success = unlink($filePath);

if (file_exists($uploadDir . '/' . $deleteFile . '.json')) {
    $success = $success && unlink($uploadDir . '/' . $deleteFile . '.json');
}

$json = json_encode([
    'deleted' => $success,
    'uploader' => [
        'name' => strtolower($_SERVER['HTTP_X_SENDER'] ?? 'Unknown'),
    ],
    'meta' => [
        'deleted_on' => (new \DateTime('now', new \DateTimeZone('Etc/UTC')))->format(\DateTime::ATOM),
    ]
]);

echo $json;
