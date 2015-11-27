<?php
if (!isset($content)) {
    $content = __FILE__;
    $layout_url = $_SERVER['DOCUMENT_ROOT'] . "/assets/layouts/layout.php";
    include $layout_url;
    exit;
}
?>
<div class="jumbotron">
  <h1 class="text-center">PennyDrop</h1>
  <p class="lead text-center">Welcome to a magical place where giving to those in need requires only time and thought.</p>
	<p class="text-center"><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
</div>