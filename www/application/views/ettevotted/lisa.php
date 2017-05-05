				<div style="float:right">
					<h2>Olemasolevad ettev&otilde;tted</h2>
					<?php foreach ($ettevotted as $ettevote): ?>
						<p><?php
							echo $ettevote['nimetus'];
						?></p>
					<?php endforeach ?>
				</div>
				<h2>Lisa uus ettev&otilde;te</h2>
				<?php
					echo validation_errors();
					$attributes = array('name' => 'lisaettevote');
					echo form_open('lisaettevote', $attributes);
				?>
				<label for="uus_ettevotte_nimi">Ettev&otilde;tte nimi</label>
				<input type="text" id="uus_ettevotte_nimi" name="uus_ettevotte_nimi" /><br />
				<label for="uus_ettevotte_reg">Ettev&otilde;tte registrikood</label>
				<input type="text" id="uus_ettevotte_reg" name="uus_ettevotte_reg" /><br />
				<button class="hall" onclick="this.lisaettevote.submit()">L&uuml;kka</button>
				<p><a href='http://ariregister.rik.ee/lihtparing.py'>Äriregister</a></p>
				</form>