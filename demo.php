<?php
	include 'haversine.php';

	if( !empty($_POST) )
	{
		$arrPost_Clean['startLat'] = filter_input( INPUT_POST, 'startLat', FILTER_SANITIZE_NUMBER_FLOAT);
		$arrPost_Clean['startLong'] = filter_input( INPUT_POST, 'startLong', FILTER_SANITIZE_NUMBER_FLOAT);
		$arrPost_Clean['endLat'] = filter_input( INPUT_POST, 'endLat', FILTER_SANITIZE_NUMBER_FLOAT);
		$arrPost_Clean['endLong'] = filter_input( INPUT_POST, 'endLong', FILTER_SANITIZE_NUMBER_FLOAT);

		foreach( $arrPost_Clean as $strKey => $mxdValue )
		{
			if( $mxdValue === false )
			{
				die('Invalid data, feck off.');
			}
		}

		$objHaversine = new Haversine;
		$objHaversine->getDistance($arrPost_Clean['startLat'], $arrPost_Clean['startLong'], $arrPost_Clean['endLat'], $arrPost_Clean['endLong'])
		?>
		--------------------<br />;
		Distance: <?php echo $distance;?>
		--------------------<br />;
		<?php

	}
?>
<form action="" method="post">
	<fielset>
		<legend>Haversine - Demo</legend>
		<label form="startLat">Start Lat</label>
		<input type="text" name="startLat" value="" />

		<label form="startLat">Start Long</label>
		<input type="text" name="startLong" value="" />

		<label form="startLat">End Lat</label>
		<input type="text" name="endLat" value="" />

		<label form="startLat">End Long</label>
		<input type="text" name="endLong" value="" />

		<input type="submit" value="Get Distance" />
	</fieldset>
</form>