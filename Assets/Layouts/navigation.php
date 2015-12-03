<?php 

$root_url = "http://" . $_SERVER["SERVER_NAME"];
$home_url = $root_url . "/Views/home.php";
$charities_url = $root_url . "/Views/Charity/index.php";
$surveys_url = $root_url . "/Views/Survey/index.php";
$my_pennies_url = $root_url . "/Views/Survey/index.php";
$reports_url = $root_url . "/Views/reports.php";
$about_url = $root_url . "/Views/about.php";

function nav_replace_link($class, $url, $text){
	echo "<a class='". $class ."' href='javascript:void(0);' onclick='replace_section(\"". $url ."\");use_nav(this);'>". $text ."</a>";
}
function replace_link($url, $text){
	echo "<a href='javascript:void(0);' onclick='replace_section(\"". $url ."\");'>". $text ."</a>";
}

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <p class="navbar-brand">PennyDrop</p>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active">
        	<?php nav_replace_link("home_link", $home_url, "Home"); ?>
        </li>
        <li>
        	<?php nav_replace_link("charities_link",$charities_url, "Charities"); ?>
        </li>
        <li>
        	<?php nav_replace_link("surveys_link", $surveys_url, "Surveys"); ?>
        </li>
        <li>
        	<?php nav_replace_link("my_pennies_link", $my_pennies_url, "MyPennies"); ?>
        </li>
        <li>
        	<?php nav_replace_link("about_link", $about_url, "About"); ?>
        </li>
      </ul>
      <div id="login_button" class="navbar-form navbar-right">
				<?php 
				$login = $_SERVER["DOCUMENT_ROOT"] . "/assets/layouts/login_button.php";
				include $login;
				?>
      </div>
    </div>
  </div>
</nav>