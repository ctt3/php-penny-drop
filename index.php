<?php
if (!isset($content)) {
    $content = __FILE__;
    $layout_url = $_SERVER['DOCUMENT_ROOT'] . "/Assets/Layouts/layout.php";
    include $layout_url;
    exit;
}
?>
<a href="http://www.google.com">SPLOOGLE</a>