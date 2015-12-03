<?php
if (!isset($content)) {
    $content = __FILE__;
    $layout_url = $_SERVER['DOCUMENT_ROOT'] . "/assets/layouts/layout.php";
    include $layout_url;
    exit;
}
readfile("./Views/home.php");
?>