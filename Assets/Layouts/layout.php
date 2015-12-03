<html>
	<head>
		<!-- Bootstrap CSS-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<?php 
		$layout_css_url = "http://" . $_SERVER["SERVER_NAME"] . "/assets/css/site_layout.css";
		echo "<link rel='stylesheet' type='text/css' href='" . $layout_css_url . "'>";
		?>

		<!-- Bootstrap JS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	</head>
	<body>
		<div id="nav">
			<?php 
			$nav = $_SERVER["DOCUMENT_ROOT"] . "/assets/layouts/navigation.php";
			include $nav;
			?>
		</div>
		<div id="section" class="container">
    	<?php if(isset($content)) { include $content; } ?>
		</div>
		<div id="footer">
			<?php 
			$foot = $_SERVER["DOCUMENT_ROOT"] . "/assets/layouts/footer.php";
			include $foot;
			?>
		</div>
	</body>
</html>

<script type='text/javascript'>

function replace_section(file) {
	$("#section.container").load(file);
}

function use_nav(el){
	el.closest('li').addClass("active").siblings().removeClass("active");
}
</script>