<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
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
			<div id="alerts_container"></div>
			<?php 
			$foot = $_SERVER["DOCUMENT_ROOT"] . "/assets/layouts/footer.php";
			include $foot;
			?>
		</div>
		<div id="modal_area"></div>
	</body>
</html>

<script type='text/javascript'>

function replace_section(file) {
	$("#section.container").load(file);
}

function use_nav(el){
	el.closest('li').addClass("active").siblings().removeClass("active");
}

function flash_alert(type, text){
  alert = '<div class="alert alert-dismissable ' + type  +'"><button class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><p>' + text + '</p></div>';
  $("#alerts_container").html(alert);

	setTimeout (function(){ 
		$(".alert-dismissable").slideDown(500, function(){
			$(".alert-dismissable").remove();
		});
	}, 3000);
}

function reload_login_button(){
	$("#login_button").load("/assets/layouts/login_button.php")
}

function load_modal(file){
	$("#modal_area").load(file);
	$(".modal").modal("show");
}

function login(){	
  username=$("#username").val();
  password=$("#password").val();
  $.ajax({
  	type: "POST",
  	url: "./Views/login.php",
		data: "username="+username+"&password="+password,
		success: function(html){    
			if(html!='true'){
				flash_alert("alert-danger", "Wrong username or password");
			}else{
				flash_alert("alert-success", "Welcome "+username+"!");
			}
		},
  });
  reload_login_button();
	return false;
}

function logout(){	
  $.ajax({
  	type: "POST",
  	url: "./assets/layouts/logout.php",
		success: function(html){    
			if(html=='true'){
				flash_alert("alert-success", "Goodbye!");
			}
		},
  });
  reload_login_button();
	return false;
}


</script>