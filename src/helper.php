<?php
declare(strict_types=1);

function unauthorized(): void
{
    http_response_code(401);
    die('Unauthorized.');
}

/**
 * @param string $uploadDir
 * @param string $originalFileName
 * @param bool $useAppNamePrefix
 *
 * @return array
 * @throws \Exception (only on old oses)
 */
function sharex_create_filename(string $uploadDir, string $originalFileName, bool $useAppNamePrefix): array
{
    $prefix = '';

    if ($useAppNamePrefix) {
        $parts = explode('_', $originalFileName, 2);

        if (\count($parts) !== 0) {
            $appName = preg_replace('/[^a-zA-Z0-9\-]+/', '-', $parts[0]);
            $prefix .= $appName . '_';
        }
    }

    $namingStrategy = new RandomBytes();
    do {
        $uuid = $namingStrategy->generate();
    } while (file_exists($prefix . $uploadDir . $uuid . '.png'));

    return [$uuid, $prefix . $uploadDir . $uuid . '.png'];
}
