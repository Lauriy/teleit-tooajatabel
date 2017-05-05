<?php foreach ($postitused as $postitus):?>
	<?php
		echo "<h1>".$postitus['pealkiri']."</h1>";
		echo "<p>".$postitus['sisu']."</p>";
	?>
<?php endforeach ?>
<a href="teataveast">Tagasi</a>