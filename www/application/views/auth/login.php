<div class='mainInfo'>
	<p>Logi sisse</p>
	<div id="infoMessage"><?php echo $message;?></div>
	<?php $attributes = array('name' => 'login'); echo form_open('auth/login', $attributes);?>
	<p>
		<label for="email">Email</label>
		<?php echo form_input($email);?>
	</p>
	<p>
		<label for="password">Parool</label>
		<?php echo form_input($password);?>
	</p> 
	<p>
		<label for="remember">Jäta mind meelde</label>
		<?php echo form_checkbox('remember', '1', FALSE);?>
	</p> 
	<?php 
		//$publickey = "6Ldk388SAAAAAAnVhXyW_5TG8eyBn4UJO3t8XvXK";
		//echo recaptcha_get_html($publickey);
	?>
	<button class="hall" onclick="this.login.submit()">Sisene</button>
	<?php echo form_close();?>
	<a href="unustasinparooli">Unustasid parooli?</a>
</div>