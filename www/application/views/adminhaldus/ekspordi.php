<?php
	echo "<?xml version='1.0' encoding='UTF-8'?>";
	function clean_num($num)
	{
		return trim(trim($num,'0'),'.');
	}
	$file_id = substr(md5(date('Y-m-d').$sundmused[0]['id']),0,6);
	$total = 0;
	$firmad = array();
	echo "<E_Invoice>";
	echo "<Header>";
		echo "<Test>NO</Test>";
		echo "<Date>".date('Y-m-d')."</Date>";
		echo "<FileId>".$file_id."</FileId>";
		echo "<Version>1.1</Version>";
	echo "</Header>";
	foreach ($sundmused as $sundmus)
	{
		$firmad[] = $sundmus['ettevote_reg']."/".$sundmus['ettevote_nimetus'];
	}
	$totalid = 0;
	$firmad = array_unique($firmad);
	foreach ($firmad as $firma)
	{
		$sellefirmasundmused = array();
		foreach ($sundmused as $sundmus)
		{
			$firmaandmed = explode("/", $firma);
			if($sundmus['ettevote_nimetus'] == $firmaandmed[1])
			{
				$sellefirmasundmused[] = $sundmus;
			}
		}
		foreach ($sellefirmasundmused as $sellefirmasundmus)
		{
			$total = $sellefirmasundmus['hind_kmta'];
		}
		$totalid += $total;
		echo "<Invoice invoiceId='".$sellefirmasundmused[0]['id']."' regNumber='11405154'>";
		echo "<InvoiceParties>";
			echo "<SellerParty>";
				echo "<Name>Tele-IT OÜ</Name>";
				echo "<RegNumber>11405154</RegNumber>";
			echo "</SellerParty>";
			echo "<BuyerParty>";
				echo "<Name>".$firmaandmed[1]."</Name>";
				echo "<RegNumber>".$firmaandmed[0]."</RegNumber>";
			echo "</BuyerParty>";
		echo "</InvoiceParties>";
		echo "<InvoiceInformation>";
			echo "<Type type='DEB'/>";
			echo "<DocumentName>";
				echo "Arve";
			echo "</DocumentName>";
			echo "<InvoiceNumber>";
				echo $sellefirmasundmused[0]['id'];
			echo "</InvoiceNumber>";
			echo "<InvoiceDate>";
				$ajaandmed = explode("-", $sellefirmasundmused[0]['kuupaev']);
				$paevi = cal_days_in_month(CAL_GREGORIAN, $ajaandmed[1], $ajaandmed[2]);
				echo $ajaandmed[0]."-".$ajaandmed[1]."-".$paevi;
			echo "</InvoiceDate>";
		echo "</InvoiceInformation>";
		echo "<InvoiceSumGroup>";
			echo "<TotalSum>";
				echo $total;
			echo "</TotalSum>";
		echo "</InvoiceSumGroup>";
		foreach ($sellefirmasundmused as $sellefirmasundmus)
		{
			if($sellefirmasundmus['asukoht_nimetus'] == "Väljakutse")
			{
				echo "<InvoiceItem>";
					echo "<InvoiceItemGroup>";
						echo "<ItemEntry>";
							echo "<Description>";
								echo $sellefirmasundmus['asukoht_nimetus'];
							echo "</Description>";
							echo "<ItemDetailInfo>";
								echo "<ItemUnit>tk</ItemUnit>";
								echo "<ItemAmount>1</ItemAmount>";
								echo "<ItemPrice></ItemPrice>";
							echo "</ItemDetailInfo>";
						echo "</ItemEntry>";
					echo "</InvoiceItemGroup>";
				echo "</InvoiceItem>";
				echo "<InvoiceItem>";
					echo "<InvoiceItemGroup>";
						echo "<ItemEntry>";
							echo "<Description>";
								echo $sellefirmasundmus['sisu_nimetus'];
							echo "</Description>";
							echo "<ItemDetailInfo>";
								echo "<ItemUnit>h</ItemUnit>";
								$arvestatavaidminuteid = (((strtotime($sellefirmasundmus['lopp']) - strtotime($sellefirmasundmus['algus'])) / 60) + $sellefirmasundmus['transport'] - 20);
								$minutijaak = $arvestatavaidminuteid % 60;
								$taistunde = ($arvestatavaidminuteid - $minutijaak) / 60;
								if($minutijaak >= 10 && $minutijaak < 30)
								{
									$kolmandikke = 3333;
								}
								else if($minutijaak >= 30 && $minutijaak < 50)
								{
									$kolmandikke = 6666;
								}
								else
								{
									$kolmandikke = 0;
								}
								if($taistunde == 0)
								{
									echo "<ItemAmount>0".$kolmandikke."</ItemAmount>";
								}
								else
								{
									echo "<ItemAmount>".clean_num($taistunde).".".$kolmandikke."</ItemAmount>";
								}
								echo "<ItemPrice></ItemPrice>";
							echo "</ItemDetailInfo>";
						echo "</ItemEntry>";
					echo "</InvoiceItemGroup>";
				echo "</InvoiceItem>";
			}
			else if($sellefirmasundmus['liik_nimetus'] == "Müügitöö")
			{
				echo "<InvoiceItem>";
					echo "<InvoiceItemGroup>";
						echo "<ItemEntry>";
							echo "<Description>";
								echo $sellefirmasundmus['sisu_nimetus'];
							echo "</Description>";
							echo "<ItemDetailInfo>";
								echo "<ItemUnit>tk</ItemUnit>";
								echo "<ItemAmount>1</ItemAmount>";
								echo "<ItemPrice>".$sellefirmasundmus['hind_kmta']."</ItemPrice>";
							echo "</ItemDetailInfo>";
						echo "</ItemEntry>";
					echo "</InvoiceItemGroup>";
				echo "</InvoiceItem>";
			}
			else
			{
				echo "<InvoiceItem>";
					echo "<InvoiceItemGroup>";
						echo "<ItemEntry>";
							echo "<Description>";
								echo $sellefirmasundmus['sisu_nimetus'];
							echo "</Description>";
							echo "<ItemDetailInfo>";
								echo "<ItemUnit>h</ItemUnit>";
								$arvestatavaidminuteid = (((strtotime($sellefirmasundmus['lopp']) - strtotime($sellefirmasundmus['algus'])) / 60) + $sellefirmasundmus['transport']);
								$minutijaak = $arvestatavaidminuteid % 60;
								$taistunde = ($arvestatavaidminuteid - $minutijaak) / 60;
								if($minutijaak >= 10 && $minutijaak < 30)
								{
									$kolmandikke = 3333;
								}
								else if($minutijaak >= 30 && $minutijaak < 50)
								{
									$kolmandikke = 6666;
								}
								else
								{
									$kolmandikke = 0;
								}
								if($taistunde == 0)
								{
									echo "<ItemAmount>0".$kolmandikke."</ItemAmount>";
								}
								else
								{
									echo "<ItemAmount>".clean_num($taistunde).".".$kolmandikke."</ItemAmount>";
								}
								echo "<ItemPrice></ItemPrice>";
							echo "</ItemDetailInfo>";
						echo "</ItemEntry>";
					echo "</InvoiceItemGroup>";
				echo "</InvoiceItem>";
			}
		}
		echo "<PaymentInfo>";
			echo "<Currency>EUR</Currency>";
			echo "<PaymentDescription>Arve nr ".$sellefirmasundmused[0]['id']." tasumine</PaymentDescription>";
			echo "<Payable>YES</Payable>";
			echo "<PayDueDate>".date('Y-m-d', mktime(0,0,0,$ajaandmed[1],$paevi+10,$ajaandmed[0]))."</PayDueDate>";
			echo "<PaymentTotalSum>".$total."</PaymentTotalSum>";
			echo "<PayerName>".$firmaandmed[1]."</PayerName>";
			echo "<PaymentId>".$sellefirmasundmused[0]['id']."</PaymentId>";
			echo "<PayToAccount>221037417979</PayToAccount>";
			echo "<PayToName>Tele-IT OÜ</PayToName>";
		echo "</PaymentInfo>";
		echo "</Invoice>";
	}
	echo "<Footer>";
	echo "<TotalNumberInvoices>".count($firmad)."</TotalNumberInvoices>";
	echo "<TotalAmount>".$totalid."</TotalAmount>";
	echo "</Footer>";
	echo "</E_Invoice>";
	header("Content-type: text/xml"); 