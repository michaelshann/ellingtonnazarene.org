
<div class='indexpage'>
<?php 
	echo "<h1>";
	echo $this->Html->Link('Emergency Contact', array('action' => 'emergency'));
	echo "</h1>";

	echo "<br/>";
	echo "<span>";
		
		echo $this->Html->Link("View By Families", array('controller' => 'DirectoryFamilies', 'action' => 'emergencyContact'));
		
		echo "&nbsp; &nbsp; &nbsp;";
		
		if($this->request->pass) {
			echo $this->Html->Link("Print", array('action' => 'emergency', $this->request->pass[0],  '?' => array('print' => true)));
		} else {
			echo $this->Html->Link("Print", array('action' => 'emergency', '?' => array('print' => true)));		
		}
		
		echo "&nbsp; &nbsp; &nbsp;";

		echo $this->Html->Link("Reset Filters", array('action' => 'emergency'));
		
	echo "</span>";
	
	echo "<table>";
	echo $this->Html->tableHeaders(array('Name','Contact Method','Number or Email'));
	$table_array = array();
	foreach($people as $person):
		$row_array = array();
		
		$row_array[] = $this->Html->Link($person['DirectoryPerson']['first_name'] . ' ' . $person['DirectoryPerson']['last_name'], 
			array('controller' => 'DirectoryFamilies', 'action' => 'view', $person['DirectoryFamily']['id'] ));

		$row_array[] = $this->Html->Link($person['EmergencyContact']['label'], 
			array('action' => 'emergency', $person['EmergencyContact']['id']
			));
		
		if($person['EmergencyContact']['id'] == 1) {
			$row_array[] = $person['DirectoryPerson']['email'];
		} else if($person['EmergencyContact']['id'] == 2) {
			$row_array[] = $homes[$person['DirectoryFamily']['directory_home_id']];
		} else if($person['EmergencyContact']['id'] != 5) {
			$row_array[] = $person['DirectoryPerson']['cell_phone'];
		} else {
			$row_array[] = "&nbsp;";
		}
		
		
		$table_array[] = $row_array;
			
	endforeach;
	
	
	echo $this->Html->tableCells($table_array);
	
 ?>
</table>
</div>

