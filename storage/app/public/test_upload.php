<?php
// Script test upload storage Laravel
$file = __DIR__ . '/test.txt';
$content = 'Hello, this is a test upload at ' . date('Y-m-d H:i:s');
file_put_contents($file, $content);
echo "Sukses! File test.txt berhasil dibuat di " . $file . "\n"; 