<?php
	echo "<?xml version='1.0'?>";
	echo "<root>";
	foreach ($sundmused as $sundmus)
	{
		echo "<sundmus>";
		echo $sundmus['lisainfo'];
		echo "</sundmus>";
	}
	echo "</root>";