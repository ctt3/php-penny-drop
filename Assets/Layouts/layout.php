<html>
	<head>
		<?php 
		$layout_css_url = "http://" . $_SERVER["SERVER_NAME"] . "/Assets/css/my_layout.css";
		echo "<link rel='stylesheet' type='text/css' href='" . $layout_css_url . "'>";
		?>
	</head>
	<body>
		<div id="header">
			<?php 
			$head = $_SERVER["DOCUMENT_ROOT"] . "/Assets/Layouts/header.php";
			include $head;
			?>
		</div>
		<div id="nav">
			<?php 
			$nav = $_SERVER["DOCUMENT_ROOT"] . "/Assets/Layouts/navigation.php";
			include $nav;
			?>
		</div>
		<div id="section">
		    <?php if(isset($content)) { include $content; } ?>
		</div>
		<div id="footer">
			<?php 
			$foot = $_SERVER["DOCUMENT_ROOT"] . "/Assets/Layouts/footer.php";
			include $foot;
			?>
		</div>
	</body>
</html>