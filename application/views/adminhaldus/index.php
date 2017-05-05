				<a href="lisasundmusadmin">Lisa s&uuml;ndmus</a>&nbsp;//&nbsp;
				<a href="lisakasutaja">Kasutajad</a>&nbsp;//&nbsp;
				<a href="lisaettevote">Ettev&otilde;tted</a>&nbsp;//&nbsp;
				<a href="lisaliik">T&ouml;&ouml;de liigid</a>&nbsp;//&nbsp;
				<a href="lisaasukoht">T&ouml;&ouml;de asukohad</a>&nbsp;//&nbsp;
				<a href="lisasisu">T&ouml;&ouml;de sisud</a>&nbsp;//&nbsp;
				<a href="lisakm">K&auml;ibemaksu t&uuml;&uuml;bid</a>&nbsp;//&nbsp;
				<a href="lukustamatasundmused">Lukustamata s&uuml;ndmused</a>
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
				<?php $attributes = array('name' => 'filtreeri', 'method' => 'get'); echo form_open('adminhaldus/filtreeri', $attributes); ?>
				<label for="alates">Alates&nbsp;&nbsp;&nbsp;</label>
				<input type="text" id="alates" name="alates"/>
				<label for="kuni">Kuni&nbsp;&nbsp;&nbsp;</label>
				<input type="text" id="kuni" name="kuni"/>
				<label for="kid">Kasutaja&nbsp;&nbsp;&nbsp;</label>
				<select name="kid" id="kid">
					<?php foreach ($kasutajad as $kasutaja):?>
						<?php
							echo "<option value='".$kasutaja['id']."'>".$kasutaja['username']."</option>";
						?>
					<?php endforeach ?>
				</select>
				<button class="hall" onclick="this.filtreeri.submit()">L&uuml;kka</button>
				</form>
				<h2>Kuude vaade</h2>
				<?php
					$attributes = array('name' => 'filtreeri2', 'method' => 'get');
					echo form_open('adminhaldus/filtreeri2', $attributes);
				?>
				<select name="aasta" id="aasta">
					<?php
						$aastad = array(2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015);
						for($i = 0; $i < sizeof($aastad); $i++)
						{
							if($valitudaasta && $valitudaasta == $aastad[$i])
							{
								echo "<option selected='selected' value=".$aastad[$i].">".$aastad[$i]."</option>";
							}
							else if(!$valitudaasta && $aastad[$i] == date("Y"))
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
					<th>Kasutaja</th>
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
								if((($sundmus['sisu_nimetus'] == 'Kuuhooldus') || ($sundmus['sisu_nimetus'] == 'Regulaarhooldus')) && (!($sundmus['ettevote_nimetus'] == 'TeleIT')))
								{
									$tasustatud_tooaeg_min += ((strtotime($sundmus['lopp']) - strtotime($sundmus['algus'])) / 60);
								}
							}
							if(!($sundmus['ettevote_nimetus'] == 'TeleIT'))
							{
								if(!$sundmus['liik_nimetus'] == 'Hooldus')
								{
									$tasustatud_tooaeg_min += ((strtotime($sundmus['lopp']) - strtotime($sundmus['algus'])) / 60);
								}
							}
							echo "<td>".$sundmus['kasutaja']."</td>";
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
								echo "<td class='kommentaar' title='".htmlspecialchars($sundmus['lisainfo'], ENT_QUOTES)."'>".substr($sundmus['lisainfo'], 0, 40)."...</td>";
							}
							else
							{
								echo "<td></td>";
							}
							echo "<td>".$sundmus['hind_kmta']."</td>";
							echo "<td>".$sundmus['hind_kmga']."</td>";
							if($sundmus['lukustatud'] == 0)
							{
								echo "<td><a href='lukusta?id=".$sundmus['id']."'>Kinnita</a></td>";
								echo "<td><a href='adminhaldus/muuda?id=".$sundmus['id']."'>Muuda</a></td>";
								echo "<td><a href='/index.php/adminhaldus/kustuta?id=".$sundmus['id']."'>Kustuta</a></td>";
							}
							else
							{
								echo "<td style='color: green'>OK</td>";
								echo "<td><a href='adminhaldus/muuda?id=".$sundmus['id']."'>Muuda</a></td>";
								echo "<td><a href='adminhaldus/kustuta?id=".$sundmus['id']."'>Kustuta</a></td>";
							}
							echo "</tr>";
						?>
					<?php endforeach ?>
				<?php endif; ?>
				</table>
				</form>
				<br/>