<div class='mainInfo'>
    <div class="pageTitleBorder"></div>
	<p>Oled kindel et soovid desaktiveerida kasutaja '<?php echo $user['username']; ?>'</p>
	
    <?php echo form_open("auth/deactivate/".$user['id']);?>
    	
      <p>
      	<label for="confirm">Jah:</label>
		<input type="radio" name="confirm" value="yes" checked="checked" />
      	<label for="confirm">Ei:</label>
		<input type="radio" name="confirm" value="no" />
      </p>
      
      <?php echo form_hidden($csrf); ?>
      <?php echo form_hidden(array('id'=>$user['id'])); ?>
      
      <p><?php echo form_submit('submit', 'Lükka');?></p>

    <?php echo form_close();?>

</div>
