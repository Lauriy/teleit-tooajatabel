			<div class='mainInfo'>
				<div style="float:right;">
					<h1>Olemasolevad kasutajad</h1>
					<?php foreach ($kasutajad as $kasutaja):?>
						<?php
							if($kasutaja['active'] == 1)
							{	
								echo "<p>".$kasutaja['username']." <a href='adminhaldus/haldakasutajat?user_id=".$kasutaja['id']."'>Muuda parooli</a> või <a href='http://tooajatabel.teleit.ee/index.php/adminhaldus/desaktiveeri?user_id=".$kasutaja['id']."'>Desaktiveeri</a></p>";
							}
							else
							{
								echo "<p>".$kasutaja['username']." <a href='adminhaldus/haldakasutajat?user_id=".$kasutaja['id']."'>Muuda parooli</a> või <a href='http://tooajatabel.teleit.ee/index.php/auth/activate/".$kasutaja['id']."'>Aktiveeri</a></p>";
							}
						?>
					<?php endforeach?>
				</div>
				<h1>Loo uus kasutaja</h1>
				<div id="infoMessage"><?php echo $message;?></div>
				<?php 
					$attributes = array('name' => 'lisakasutaja');
					echo form_open("auth/create_user", $attributes);
				?>
				<p>Eesnimi:<br />
					<?php echo form_input($first_name);?>
				</p>
				<p>Perekonnanimi:<br />
					<?php echo form_input($last_name);?>
				</p>
				<p>Email:<br />
					<?php echo form_input($email);?>
				</p>
				<p>Parool:<br />
					<?php echo form_input($password);?>
				</p>
				<p>Parool uuesti:<br />
					<?php echo form_input($password_confirm);?>
				</p>
				<p><button class="hall" onclick="this.lisakasutaja.submit()">L&uuml;kka</button></p>
				<?php echo form_close();?>
			</div>