				<a href="<?php echo base_url();?>index.php/lisaettevote">Lisa uus ettev&otilde;te</a>
				<br/>
				<br/>
				<h2>Lisa uus s&uuml;ndmus</h2>
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
				<?php $attributes = array('name' => 'lisasundmus'); echo form_open('lisasundmus', $attributes); ?>
					<label for="aid">Asukoht*</label>&nbsp;
					<select name="aid" id="aid">
						<?php foreach ($asukohad as $asukoht):?>
							<?php
								echo "<option value='".$asukoht['id']."'>".$asukoht['nimetus']."</option>";
							?>
						<?php endforeach ?>
					</select>
					<label for="eid">Ettev&otilde;te*</label>&nbsp;
					<select name="eid" id="eid">
						<?php foreach ($ettevotted as $ettevote):?>
							<?php
								echo "<option value='".$ettevote['id']."'>".$ettevote['nimetus']."</option>";
							?>
						<?php endforeach ?>
					</select>
					<label for="lid">Liik*</label>&nbsp;
					<select name="lid" id="lid">
						<?php foreach ($liigid as $liik):?>
							<?php
								echo "<option value='".$liik['id']."'>".$liik['nimetus']."</option>";
							?>
						<?php endforeach ?>
					</select>&nbsp;
					<label for="sid">Sisu*</label>&nbsp;
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
					<button class="hall" onclick="this.lisasundmus.submit()">Sisesta</button>
				</form>
				<script type="text/javascript">
					$(function()
					{
						$("#alates").datepicker({dateFormat: "yy-mm-dd"});
						$("#kuni").datepicker({dateFormat: "yy-mm-dd"});
						$(".kommentaar").tooltip();
					});
				</script>
				<link rel="stylesheet" href="<?php echo base_url();?>css/jquery.tooltip.css"/>
				<script src="<?php echo base_url();?>js/jquery.bgiframe.js" type="text/javascript"></script>
				<script src="<?php echo base_url();?>js/jquery.dimensions.js" type="text/javascript"></script>
				<script src="<?php echo base_url();?>js/jquery.tooltip.min.js" type="text/javascript"></script>
				<script src="<?php echo base_url();?>js/chili-1.7.pack.js" type="text/javascript"></script>
				<br/>
				<h2>Filtreeri</h2>
				<?php
					$attributes = array('name' => 'filtreeri', 'method' => 'get');
					echo form_open('sundmused/filtreeri', $attributes);
				?>
				<label for="alates">Alates&nbsp;&nbsp;&nbsp;</label>
				<input type="text" id="alates" name="alates"/>
				<label for="kuni">Kuni&nbsp;&nbsp;&nbsp;</label>
				<input type="text" id="kuni" name="kuni"/>
				<button class="hall" onclick="this.filtreeri.submit()">L&uuml;kka</button>
				<br/>
				<br/>
				</form>
				<h2>Kuude vaade</h2>
				<?php
					$attributes = array('name' => 'filtreeri2', 'method' => 'get');
					echo form_open('sundmused/filtreeri2', $attributes);
				?>
				<select name="aasta" id="aasta">
					<?php
						$aastad = array(2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015);
						for($i = 0; $i < sizeof($aastad); $i++)
						{
							if(isSet($valitudaasta))
							{
								if($valitudaasta == $aastad[$i])
								{
									echo "<option selected='selected' value=".$aastad[$i].">".$aastad[$i]."</option>";
								}
							}
							else if($jooksevaasta == $aastad[$i])
							{
								echo "<option selected='selected' value=".$aastad[$i].">".$aastad[$i]."</option>";
							}
							else
							{
								echo "<option value=".$aastad[$i].">".$aastad[$i]."</option>";
							}
						}
					?>
				</select>
				<p>
					<?php
						$kuud = array('Jaanuar', 'Veebruar', 'Märts', 'Aprill', 'Mai', 'Juuni', 'Juuli', 'August', 'September', 'Oktoober', 'November', 'Detsember');
						echo "<table>";
							echo "<tr>";
								for($i=1; $i<13; $i++)
								{
									echo "<button class='hall' onlick='this.filtreeri2.submit' name='kuu' value='$i'>".$kuud[$i - 1]."</button>";
								}
							echo "</tr>";
						echo "</table>";
					?>
				</p>
				</form>
				<table style="font: 14px/1.4 Georgia;">
				<tr>
					<th>Kp</th>
					<th>Algus</th>
					<th>L&otilde;pp</th>
					<th>T&ouml;&ouml;aeg</th>
					<th>S&otilde;iduaeg</th>
					<th>Dist</th>
					<th>Asukoht</th>
					<th>Ettev&otilde;te</th>
					<th>Liik</th>
					<th>Sisu</th>
					<th>Lisainfo</th>
					<th>Hind km-ta</th>
					<th>Hind km-ga</th>
					<th>Staatus</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
				<?php $tasustatud_tooaeg_min = 0;?>
				<?php if($sundmused):?>
					<?php $kord = 0; foreach ($sundmused as $sundmus):?>
						<?php
							if($kord == 0)
							{
								echo "<tr style='background-color: #E8E6ED;'>";
								$kord = 1;
							}
							else
							{
								echo "<tr>";
								$kord = 0;
							}
							if($sundmus['liik_nimetus'] == 'Hooldus')
							{
								if((($sundmus['sisu_nimetus'] == 'Kuuhooldus') || ($sundmus['sisu_nimetus'] == 'Regulaarhooldus')) && (!($sundmus['ettevote_nimetus'] == 'Tele-IT OÜ')))
								{
									$tasustatud_tooaeg_min += ((strtotime($sundmus['lopp']) - strtotime($sundmus['algus'])) / 60);
								}
							}
							if(!($sundmus['ettevote_nimetus'] == 'Tele-IT OÜ'))
							{
								if(!$sundmus['liik_nimetus'] == 'Hooldus')
								{
									$tasustatud_tooaeg_min += ((strtotime($sundmus['lopp']) - strtotime($sundmus['algus'])) / 60);
								}
							}
							echo "<td>".substr($sundmus['kuupaev'], 5, 16)."</td>";
							echo "<td>".substr($sundmus['algus'], 0, 5)."</td>";
							echo "<td>".substr($sundmus['lopp'], 0, 5)."</td>";
							echo "<td>".((strtotime($sundmus['lopp']) - strtotime($sundmus['algus'])) / 60)." min (".round((strtotime($sundmus['lopp']) - strtotime($sundmus['algus'])) / 60 / 60, 2)." h)</td>";
							echo "<td>".$sundmus['transport']." min</td>";
							if($sundmus['odomeeter_algus'] && $sundmus['odomeeter_lopp'])
							{
								echo "<td>".(($sundmus['odomeeter_lopp']) - ($sundmus['odomeeter_algus']))." km</td>";
							}
							else
							{
								echo "<td></td>";
							}
							echo "<td>".$sundmus['asukoht_nimetus']."</td>";
							echo "<td>".$sundmus['ettevote_nimetus']."</td>";
							echo "<td>".$sundmus['liik_nimetus']."</td>";
							echo "<td>".$sundmus['sisu_nimetus']."</td>";
							if($sundmus['lisainfo'] != "")
							{
								echo "<td class='kommentaar' title='".$sundmus['lisainfo']."'>Loe</td>";
							}
							else
							{
								echo "<td></td>";
							}
							echo "<td>".$sundmus['hind_kmta']."</td>";
							echo "<td>".$sundmus['hind_kmga']."</td>";
							if($sundmus['lukustatud'] == 0)
							{
								echo "<td style='color: red'>X</td>";
								echo "<td><a href='muuda?id=".$sundmus['id']."'>Muuda</a></td>";
								echo "<td><a href='kustuta?id=".$sundmus['id']."'>Kustuta</a></td>";
							}
							else
							{
								echo "<td style='color: green'>OK</td>";
								echo "<td></td>";
								echo "<td></td>";
							}
							echo "</tr>";
						?>
					<?php endforeach ?>
				<?php endif; ?>
				</table>
				</form>
				<br/>
				<?php echo "<b>Tasustatud tööaega kokku: ".$tasustatud_tooaeg_min." min (".(($tasustatud_tooaeg_min - ($tasustatud_tooaeg_min % 60))/60)." h ".($tasustatud_tooaeg_min % 60)." m)</b>";?>
				<p>Ei tasustata hooldustöid (v.a. regulaar- ja kuuhooldus) ja töid mis tehtud TeleIT ettevõttele.</p>