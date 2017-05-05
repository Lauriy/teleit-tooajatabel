<?php echo validation_errors(); ?>
<?php $attributes = array('name' => 'lisapostitus'); echo form_open('lisapostitus', $attributes); ?>
	<label for="pealkiri">Pealkiri</label>
	<br/>
	<input type="text" name="pealkiri" id="pealkiri"/>
	<br/>
	<label for="sisu">Sisu</label>
	<br/>
	<textarea name="sisu" name="sisu" id="sisu"></textarea>
	<br/>
	<button class="hall" onclick="this.lisapostitus.submit()">L&uuml;kka</button>
</form>
<br/>
<h1>Veateated</h1>
<?php foreach ($postitused as $postitus):?>
	<?php
		echo "<a href='vaatapostitust?postid=".$postitus['id']."'>".$postitus['pealkiri']."</a>";
		echo "<br/>";
	?>
<?php endforeach ?>