				<?php
					$attributes = array('name' => 'filtreeri', 'method' => 'get');
					echo form_open('', $attributes);
				?>
				<select name="aasta" id="aasta">
					<?php
						$aastad = array(2012, 2013, 2014, 2015);
						for($i = 0; $i < sizeof($aastad); $i++)
						{
							if($valitudaasta == $aastad[$i])
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
						for($i=1; $i<13; $i++)
						{
							echo "<button class='hall' onlick='this.filtreeri2.submit' name='kuu' value='$i'>".$kuud[$i - 1]."</button>";
						}
					?>
				</p>
				</form>
				<table>
				<th>Kuupäev</th>
				<th>Ettevõte</th>
				<th>Odo algus</th>
				<th>Odo lõpp</th>
				<th>Km</th>
				<?php $kmkokku = 0;?>
				<?php foreach($sundmused as $sundmus):?>
					<?php
						echo "<tr>";
						echo "<td>".$sundmus['kuupaev']."</td>";
						echo "<td>".$sundmus['nimetus']."</td>";
						echo "<td>".$sundmus['odomeeter_algus']."</td>";
						echo "<td>".$sundmus['odomeeter_lopp']."</td>";
						echo "<td>".($sundmus['odomeeter_lopp'] - $sundmus['odomeeter_algus'])." km</td>";
						$kmkokku += ($sundmus['odomeeter_lopp'] - $sundmus['odomeeter_algus']);
						echo "</tr>";
					?>
				<?php endforeach ?>
				<?php echo "<tr><th></th><th></th><th></th><th></th><th>Kokku: ".$kmkokku." km</th></tr>";?>
				</table>