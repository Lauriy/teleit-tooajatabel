<h1>Muuda parooli</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>

      <p>Vana parool:<br />
      <?php echo form_input($old_password);?>
      </p>
      
      <p>Uus parool:<br />
      <?php echo form_input($new_password);?>
      </p>
      
      <p>Uus parool uuesti:<br />
      <?php echo form_input($new_password_confirm);?>
      </p>
      
      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', 'Lükka');?></p>
	  
	  
      
<?php echo form_close();?>