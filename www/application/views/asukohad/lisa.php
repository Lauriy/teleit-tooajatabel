				<div style="float:right">
					<h2>Olemasolevad asukohad</h2>
					<?php foreach ($asukohad as $asukoht): ?>
						<p><?php
							echo $asukoht['nimetus'];
						?></p>
					<?php endforeach ?>
				</div>
				<h2>Lisa uus asukoht</h2>
				<?php
					echo validation_errors();
					$attributes = array('name' => 'lisaasukoht');
					echo form_open('lisaasukoht', $attributes);
				?>
				<label for="uus_asukoha_nimi">Asukoha nimetus</label>
				<input type="text" id="uus_asukoha_nimi" name="uus_asukoha_nimi" /><br />
				<button class="hall" onclick="this.lisaasukoht.submit()">L&uuml;kka</button>
				</form>