				<h2>Lisa uus s&uuml;ndmus</h2>
				<script type="text/javascript">
					$(function()
					{
						$("#a").timepicker({});
						$("#l").timepicker({});
						$("#kp").datepicker({dateFormat: "yy-mm-dd"});
					});
				</script>
				<?php echo validation_errors(); ?>
				<?php $attributes = array('name' => 'lisasundmusadmin'); echo form_open('lisasundmusadmin', $attributes); ?>
					<label for="aid">Asukoht*</label>
					<select name="aid" id="aid">
						<?php foreach ($asukohad as $asukoht):?>
							<?php
								echo "<option value='".$asukoht['id']."'>".$asukoht['nimetus']."</option>";
							?>
						<?php endforeach ?>
					</select>&nbsp;
					<label for="eid">Ettev&otilde;te*</label>
					<select name="eid" id="eid">
						<?php foreach ($ettevotted as $ettevote):?>
							<?php
								echo "<option value='".$ettevote['id']."'>".$ettevote['nimetus']."</option>";
							?>
						<?php endforeach ?>
					</select>&nbsp;
					<label for="lid">Liik*</label>
					<select name="lid" id="lid">
						<?php foreach ($liigid as $liik):?>
							<?php
								echo "<option value='".$liik['id']."'>".$liik['nimetus']."</option>";
							?>
						<?php endforeach ?>
					</select>
					<label for="sid">Sisu*</label>
					<select name="sid" id="sid">
						<?php foreach ($sisud as $sisu):?>
							<?php
								echo "<option value='".$sisu['id']."'>".$sisu['nimetus']."</option>";
							?>
						<?php endforeach ?>
					</select>
					<br/>
					<label for="kp">Kuup&auml;ev*</label>
					<input type="text" id="kp" name="kp"/>
					<label for="a">Algus*</label>
					<input type="text" id="a" name="a"/>
					<label for="l">L&otilde;pp*</label>
					<input type="text" id="l" name="l"/>
					<label for="t">Minutid transpordile</label>
					<input type="text" name="t" id="t"/>
					<br/>
					<label for="odoa">Odomeetri näit alguses</label>
					<input type="text" id="odoa" name="odoa"/>
					<label for="odol">Odomeetri näit l&otilde;pus</label>
					<input type="text" id="odol" name="odol"/>
					<br/>
					<label for="hkmta">Hind k&auml;ibemaksuta</label>
					<input type="text" name="hkmta" id="hkmta"/>
					<label for="kmtuup">K&auml;ibemaksu t&uuml;&uuml;p</label>
					<select name="kmtuup" id="kmtuup">
						<?php foreach ($kmid as $km):?>
							<?php
								echo "<option value='".$km['nimetus']."'>".$km['nimetus']."%</option>";
							?>
						<?php endforeach ?>
					</select>
					<br/>
					<label for="lisa">Lisainfo*</label>
					<textarea name="lisa" id="lisa"></textarea>
					<br/>
					<label for="kid">Kasutaja*</label>
					<select name="kid" id="kid">
						<?php foreach ($kasutajad as $kasutaja):?>
							<?php
								echo "<option value='".$kasutaja['id']."'>".$kasutaja['username']."</option>";
							?>
						<?php endforeach ?>
					</select>
					<br/>
					<button class="hall" onclick="this.lisasundmusadmin.submit()">Sisesta</button>
				</form>