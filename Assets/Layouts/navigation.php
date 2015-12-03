<?php 
$root_url = "http://" . $_SERVER["SERVER_NAME"];
$home_url = $root_url . "/Views/home.php";
$charities_url = $root_url . "/Views/Charity/index.php";
$surveys_url = $root_url . "/Views/Survey/index.php";
$my_pennies_url = $root_url . "/Views/Survey/index.php";
$reports_url = $root_url . "/Views/reports.php";
$about_url = $root_url . "/Views/about.php";
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
        	<?php echo "<a class='home_link' href='javascript:void(0);' onclick='replace_section(\"". $home_url ."\");use_nav(this);'>Home</a>" ?>
        </li>
        <li>
        	<?php echo "<a class='charities_link' href='javascript:void(0);' onclick='replace_section(\"". $charities_url ."\");use_nav(this);'>Charities</a>" ?>
        </li>
        <li>
        	<?php echo "<a class='surveys_link' href='javascript:void(0);' onclick='replace_section(\"". $surveys_url ."\");use_nav(this);'>Surveys</a>" ?>
        </li>
        <li>
        	<?php echo "<a class='pennies_link' href='javascript:void(0);' onclick='replace_section(\"". $my_pennies_url ."\");use_nav(this);'>MyPennies</a>" ?>
        </li>
        <li>
        	<?php echo "<a class='reports_link' href='javascript:void(0);' onclick='replace_section(\"". $reports_url ."\");use_nav(this);'>Reports</a>" ?>
        </li>
        <li>
        	<?php echo "<a class='about_link' href='javascript:void(0);' onclick='replace_section(\"". $about_url ."\");use_nav(this);'>About</a>" ?>
        </li>
      </ul>
    </div>
  </div>
</nav>