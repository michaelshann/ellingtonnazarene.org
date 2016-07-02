<div class='directory_index'>
<h1>Listen</h1>

<?php
	echo "<audio controls>";
	echo "<source src='/" . $sermon['AudioSermon']['filename'] . "' type='audio/mpeg'>";
	echo "Your browser does not support the audio element.";
	echo "</audio>";
?>


</div>