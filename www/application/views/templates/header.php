<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title ?> - S&uuml;ndmuste haldamise süsteem</title>
		<link href="<?php echo base_url()?>css/kujundus.css" rel="stylesheet" type="text/css"/>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<link rel="shortcut icon" href="<?php echo base_url()?>img/favicon.ico" type="image/x-icon"/>  
		<script type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>js/timepicker.js"></script>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<div class="konteiner">
			<div class="pais">
				<div id="yleminenav">
					<ul class="nav" style="font: 14px/1.4 Georgia;">
						<?php
							if($this->ion_auth->is_admin())
							{
								echo "<li><a href='".base_url()."index.php/adminhaldus'> Administraatorile </a></li>";
							}
							if($this->ion_auth->logged_in() && !$this->ion_auth->is_raamatupidaja())
							{
								echo "<li><a href='".base_url()."index.php/minusundmused'> S&uuml;ndmused </a></li>";
								echo "<li><a href='".base_url()."index.php/minusoidupaevik'> Sõidupäevik </a></li>";
								echo "<li><a href='".base_url()."index.php/muudaparooli'> Parool </a></li>";
								echo "<li><a href='".base_url()."index.php/teataveast'> Vead </a></li>";
							}
							if($this->ion_auth->logged_in())
							{
								echo "<li><a href='".base_url()."index.php/logout'> Logi v&auml;lja </a></li>";
							}
							else
							{
								echo "<li><a href='".base_url()."index.php/login'> Logi sisse </a></li>";
							}
						?>
					</ul>
				</div>
			</div>
			<div class="sisu">
