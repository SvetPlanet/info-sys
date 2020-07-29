<?php
session_start();

if (isset($_SESSION['filename']))
{
    $filename = $_SESSION['filename'];
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: application/pdf; charset=utf-8');

    header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($filename));

    readfile($filename);
    exit;
}
else if (!isset($_SESSION['filename']))
{
    header("Location: price.php");
}

?>