				<div style="float:right">
					<h2>Olemasolevad käibemaksu tüübid</h2>
					<?php foreach ($kmid as $km): ?>
						<p><?php
							echo $km['nimetus']."%";
						?></p>
					<?php endforeach ?>
				</div>
				<h2>Lisa uus k&auml;ibemaks</h2>
				<?php
					echo validation_errors();
					$attributes = array('name' => 'lisakm');
					echo form_open('lisakm', $attributes);
				?>
				<label for="uus_km_nimi">K&auml;ibemaksu suurus</label>
				<input type="text" id="uus_km_nimi" name="uus_km_nimi" /><br />
				<button class="hall" onclick="this.lisakm.submit()">L&uuml;kka</button>
				</form>