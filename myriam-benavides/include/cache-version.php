<?php

function asset_version(string $path): string
{
    $fullPath = __DIR__ . '/../' . ltrim($path, '/');

    if (file_exists($fullPath)) {
        return (string) filemtime($fullPath);
    }

    return (string) time();
}