<?php

	$emergency = false;
	
	echo "<h1>";
	echo $family['DirectoryFamily']['family_display_name'];
	echo "</h1>";

	echo "Family Display Name: ";
	echo $family['DirectoryFamily']['family_display_name'];
	echo "</strong><br />Address: ";
	echo $family['DirectoryHome']['street_address'] . " ";
	echo $family['DirectoryHome']['city'] . " ";
	echo $family['DirectoryHome']['state'] . " ";
	echo $family['DirectoryHome']['zip'] . "<br />";
	
	echo "Home Phone: ";
	echo $family['DirectoryHome']['phone'];
	
	echo "<br /> &nbsp; <br /> Family Members: <br /> <br />";
	
	foreach($family['DirectoryPerson'] as $person):
	
		echo "Name: ";
		echo $person['first_name'] . " " . $person['last_name'] . "<br />";
		echo "Cell Phone: ";
		echo $person['cell_phone'] . "<br />";
		echo "Email: ";
		echo $person['email'] . "<br />";
		echo "Birthday: ";
		$birthday_text = isset($person['birthday']) && $person['birthday'] != '' ? $birthday_text = $this->Time->format('F j',strtotime($person['birthday'])) : "";
		echo $birthday_text;
		echo "<br />Anniversary: ";
		$anniversary_text = isset($person['anniversary']) && $person['anniversary'] != '' ? $this->Time->format('F j',strtotime($person['anniversary'])) : "";
		echo $anniversary_text;		
		echo "<br />Church Member: ";
		echo $person['member'] ? "Yes" : "No";
		echo "<br />List Cell Phone: ";
		echo $person['list_cell'] ? "Yes" : "No";
		echo "<br />Prayer Chain: ";
		echo $contact[$person['prayer_chain']];
		echo "<br />Emergency Contact: ";
		echo $contact[$person['emergency_contact']];
		$emergency = $person['emergency_contact'] != 5 ? true : $emergency; // if you are contacted then set emergency to true so we know someone is contacted
		echo "<br /> &nbsp; <br />";
	endforeach;
	
	if(!$emergency)
		echo "<strong>*****  YOUR FAMILY WILL NOT BE CONTACTED IN AN EMERGENCY ***** </strong>";