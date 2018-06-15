<?php

require __DIR__ . '/../src/autoload.php';
require __DIR__ . '/../src/validation_sharex_upload.php';
require __DIR__ . '/../src/validation_headers.php';

[
    'uploadDir' => $uploadDir,
    'baseUrl' => $baseUrl,
    'cdnUrl' => $cdnUrl,
    'useAppNamePrefix' => $useAppNamePrefix,
    'writeJsonMetadata' => $writeJsonMetadata
] = Config::get();
[$uuid, $fileName] = sharex_create_filename($uploadDir, $_FILES['sharex_image']['name'], $useAppNamePrefix);

move_uploaded_file($_FILES['sharex_image']['tmp_name'], $fileName);

$json = json_encode([
    'urls' => [
        'full' => $cdnUrl . '/' . $uuid . '.png',
        'delete' => $baseUrl . '/delete.php?uuid=' . $uuid,
    ],
    'uploader' => [
        'name' => strtolower($_SERVER['HTTP_X_SENDER'] ?? 'Unknown'),
    ],
    'file' => [
        'name' => $_FILES['sharex_image']['name'] ?? null,
        'size' => $_FILES['sharex_image']['size'],
        'type' => image_type_to_mime_type(exif_imagetype($uploadDir . $uuid . '.png')) ?? 'image/png',
    ],
    'meta' => [
        'uploaded_on' => (new \DateTime('now', new \DateTimeZone('Etc/UTC')))->format(\DateTime::ATOM),
    ]
]);

if ($writeJsonMetadata) {
    file_put_contents($uploadDir . $uuid . '.json', $json);
}

echo $json;
