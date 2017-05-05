				<br/>
				<br/>
				<h2>Muuda sündmust</h2>
				<p>Tärniga väljad on kohustuslikud.</p>
				<script type="text/javascript">
					$(function()
					{
						$("#a").timepicker({});
						$("#l").timepicker({});
						$("#kp").datepicker({dateFormat: "yy-mm-dd"});
					});
				</script>
				<?php echo validation_errors(); ?>
				<?php $sundmus = $sundmused[0]; $attributes = array('name' => 'muuda'); echo form_open('adminhaldus/muuda?id='.$sundmus['id'], $attributes);?>
					<input type='hidden' name='id' value='<?php echo $sundmus["id"];?>'/>
					<input type='hidden' name='kid' value='<?php echo $sundmus['kasutaja_id'];?>'/>
					<label for="aid">Asukoht*</label>&nbsp;
					<select name="aid" id="aid">
						<?php foreach ($asukohad as $asukoht):?>
							<?php
								if($sundmus['asukoht_nimetus'] == $asukoht['nimetus'])
								{
									echo "<option selected='selected' value='".$asukoht['id']."'>".$asukoht['nimetus']."</option>";
								}
								else
								{
									echo "<option value='".$asukoht['id']."'>".$asukoht['nimetus']."</option>";
								}
							?>
						<?php endforeach ?>
					</select>
					<label for="eid">Ettev&otilde;te*</label>&nbsp;
					<select name="eid" id="eid">
						<?php foreach ($ettevotted as $ettevote):?>
							<?php
								if($sundmus['ettevote_nimetus'] == $ettevote['nimetus'])
								{
									echo "<option selected='selected' value='".$ettevote['id']."'>".$ettevote['nimetus']."</option>";
								}
								else
								{
									echo "<option value='".$ettevote['id']."'>".$ettevote['nimetus']."</option>";
								}
							?>
						<?php endforeach ?>
					</select>
					<label for="lid">Liik*</label>&nbsp;
					<select name="lid" id="lid">
						<?php foreach ($liigid as $liik):?>
							<?php
								if($sundmus['liik_nimetus'] == $liik['nimetus'])
								{
									echo "<option selected='selected' value='".$liik['id']."'>".$liik['nimetus']."</option>";
								}
								else
								{
									echo "<option value='".$liik['id']."'>".$liik['nimetus']."</option>";
								}
							?>
						<?php endforeach ?>
					</select>&nbsp;
					<label for="sid">Sisu*</label>&nbsp;
					<select name="sid" id="sid">
						<?php foreach ($sisud as $sisu):?>
							<?php
								if($sundmus['sisu_nimetus'] == $sisu['nimetus'])
								{
									echo "<option selected='selected' value='".$sisu['id']."'>".$sisu['nimetus']."</option>";
								}
								else
								{
									echo "<option value='".$sisu['id']."'>".$sisu['nimetus']."</option>";
								}
							?>
						<?php endforeach ?>
					</select>
					<br/>
					<label for="kp">Kuup&auml;ev*</label>
					<input type="text" id="kp" name="kp" value='<?php echo $sundmus['kuupaev'];?>'/>
					<label for="a">Algus*</label>
					<input type="text" id="a" name="a" value='<?php echo $sundmus['algus'];?>'/>
					<label for="l">L&otilde;pp*</label>
					<input type="text" id="l" name="l" value='<?php echo $sundmus['lopp'];?>'/>
					<label for="t">Minutid transpordile*</label>
					<input type="text" name="t" id="t" value='<?php echo $sundmus['transport'];?>'/>
					<br/>
					<label for="odoa">Odomeetri näit alguses</label>
					<input type="text" id="odoa" name="odoa" value='<?php echo $sundmus['odomeeter_algus'];?>'/>
					<label for="odol">Odomeetri näit l&otilde;pus</label>
					<input type="text" id="odol" name="odol" value='<?php echo $sundmus['odomeeter_lopp'];?>'/>
					<br/>
					<label for="hkmta">Hind k&auml;ibemaksuta</label>
					<input type="text" name="hkmta" id="hkmta" value='<?php echo $sundmus['hind_kmta'];?>'/>
					<label for="kmtuup">K&auml;ibemaksu t&uuml;&uuml;p</label>
					<select name="kmtuup" id="kmtuup">
						<?php foreach ($kmid as $km):?>
							<?php
								if($sundmus['kmtuup'] == $km['nimetus'])
								{
									echo "<option selected='selected' value='".$km['nimetus']."'>".$km['nimetus']."%</option>";
								}
								else
								{
									echo "<option value='".$km['nimetus']."'>".$km['nimetus']."%</option>";
								}
							?>
						<?php endforeach ?>
					</select>
					<br/>
					<label for="lisa">Lisainfo*</label>
					<textarea name="lisa" id="lisa"><?php echo $sundmus['lisainfo'];?></textarea>
					<br/>
					<button class="hall" onclick="this.muuda.submit()">L&uuml;kka</button>
				</form>