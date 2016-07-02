
<div class='indexpage'>
<?php 
	echo "<h1>";
	echo $this->Html->Link('Emergency Contact', array('action' => 'emergency'));
	echo "</h1>";

	echo "<br/>";
	
	echo $this->Html->Link("View By Person", array('controller' => 'DirectoryPeople', 'action' => 'emergency'));
	
	echo "<table>";
	echo $this->Html->tableHeaders(array('Family', 'Name', 'Contact Method', 'Contact'));
	$table_array = array();
	foreach($families as $family):
		$no_person = true;
		foreach($family['DirectoryPerson'] as $person):
			if(!is_null($person['emergency_contact']) && $person['emergency_contact'] != 5) {
				$row_array = array();
				$row_array[] = $this->Html->Link($family['DirectoryFamily']['family_display_name'], 
						array('action' => 'view', $family['DirectoryFamily']['id'] ));
		
				$row_array[] = $this->Html->Link($person['first_name'] . ' ' . $person['last_name'], array(
					'controller' => 'DirectoryPeople', 'action' => 'view', $person['id']));
				
				$row_array[] = $contact[$person['emergency_contact']];
				if($person['emergency_contact'] == 1)
					$row_array[] = $person['email'];
				else if($person['emergency_contact'] == 2)
					$row_array[] = $family['DirectoryHome']['phone'];
				else if($person['emergency_contact'] == 3 || $person['emergency_contact'] == 4)
					$row_array[] = $person['cell_phone'];
					
				$no_person = false;	
				$table_array[] = $row_array;
			}
		endforeach;
		
		if($no_person) {
			$row_array = array();
			$row_array[] = $family['DirectoryFamily']['family_display_name'];
			$row_array[] = "NO CONTACT";
			$row_array[] = "&nbsp;";
			$row_array[] = "&nbsp;";
			$table_array[] = $row_array;
		}
			
	endforeach;
	
	
	echo $this->Html->tableCells($table_array);
	
 ?>
</table>
</div>

