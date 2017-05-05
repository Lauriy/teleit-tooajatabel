				<div style="float: right">
					<h2>Olemasolevad t&ouml;&ouml;de liigid</h2>
					<?php foreach ($liigid as $liik): ?>
						<p><?php
							echo $liik['nimetus'];
						?></p>
					<?php endforeach ?>
				</div>
				<h2>Lisa uus liik</h2>
				<?php
					echo validation_errors();
					$attributes = array('name' => 'lisaliik');
					echo form_open('lisaliik', $attributes);
				?>
				<label for="uus_liigi_nimi">Liigi nimetus</label>
				<input type="text" id="uus_liigi_nimi" name="uus_liigi_nimi" /><br />
				<button class="hall" onclick="this.lisaliik.submit()">L&uuml;kka</button>
				</form>