				<div style="float:right">
					<h2>Olemasolevad t&ouml;&ouml;de sisud</h2>
					<?php foreach ($sisud as $sisu): ?>
						<p><?php
							echo $sisu['nimetus'];
						?></p>
					<?php endforeach ?>
				</div>
				<h2>Lisa uus sisu</h2>
				<?php
					echo validation_errors();
					$attributes = array('name' => 'lisasisu');
					echo form_open('lisasisu', $attributes);
				?>
				<label for="uus_sisu_nimi">Sisu nimetus</label>
				<input type="text" id="uus_sisu_nimi" name="uus_sisu_nimi" /><br />
				<button class="hall" onclick="this.lisasisu.submit()">L&uuml;kka</button>
				</form>