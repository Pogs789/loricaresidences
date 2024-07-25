<?php
$image_path = $_GET['path'];
if (file_exists($image_path)) {
    $mime_type = mime_content_type($image_path);
    header('Content-Type: ' . $mime_type);
    readfile($image_path);
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Image not found.";
}