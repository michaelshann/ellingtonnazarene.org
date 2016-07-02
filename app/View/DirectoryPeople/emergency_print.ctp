<?php


foreach($people as $person):
	
	echo $person['DirectoryPerson']['first_name'] . ' ' . $person['DirectoryPerson']['last_name'] . '<br />';
	echo $person['EmergencyContact']['label'] . '<br />';
	
	if($person['EmergencyContact']['id'] == 1) {
		echo $person['DirectoryPerson']['email'];
	} else if($person['EmergencyContact']['id'] == 2) {
		echo $homes[$person['DirectoryFamily']['directory_home_id']];
	} else if($person['EmergencyContact']['id'] != 5) {
		echo $person['DirectoryPerson']['cell_phone'];
	} 
	
	echo "<br />&nbsp;<br />";
	
endforeach;