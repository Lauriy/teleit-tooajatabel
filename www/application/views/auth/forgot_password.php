<h1>Unustatud parool</h1>
<p>Palun sisesta oma <?php echo $identity_human;?> et saaksime teie parooli taastada.</p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/forgot_password");?>

      <p><?php echo $identity_human;?>:<br />
      <?php echo form_input($identity);?>
      </p>
      
      <p><?php echo form_submit('submit', 'Lükka');?></p>
      
<?php echo form_close();?>