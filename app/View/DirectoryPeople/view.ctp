<div class='userview'>
<?php echo $this->element('directoryheader'); ?>
<?php
	$id = $person['DirectoryPerson']['id'];
	$self = false;
	$admin = false;
	if(AuthComponent::user('directory_family_id') == $person['DirectoryPerson']['directory_family_id'] )
	{
		$self = true;
	}
?>
<h1>
<?php echo $person['DirectoryPerson']['first_name'] . " " . $person['DirectoryPerson']['last_name']; ?>
</h1>
<?php
	if($self || AuthComponent::user('user_role_id') == 1) {
		echo "<div class='buttonlinks leftalign smaller'>";
		echo $this->Html->link('edit',array('action' => 'edit', $id));
		$admin = true;
		echo "</div>";
	}
?>

<table>
<?php
	$table = array();
	
	$table[] = array('Family', $this->Html->link($person['DirectoryFamily']['family_display_name'], array(
					'controller' => 'DirectoryFamilies', 'action' => 'view', $person['DirectoryFamily']['id'])));

	if(isset($person['DirectoryPerson']['cell_phone']) && $person['DirectoryPerson']['cell_phone'] != '') {
		$table[] = array('Cell Phone', $person['DirectoryPerson']['cell_phone']);
	}
	
	if(isset($person['DirectoryPerson']['email']) && $person['DirectoryPerson']['email'] != '') {
 		$table[] = array('Email', $person['DirectoryPerson']['email']);
 	}
	
	
	if(isset($person['DirectoryPerson']['birthday']) && $person['DirectoryPerson']['birthday'] != '' && 
			$person['DirectoryPerson']['birthday'] != '0000-00-00') {
		$table[] = array('Birthday', $this->Time->format('F j',strtotime($person['DirectoryPerson']['birthday'])));
	}
	
	if(isset($person['DirectoryPerson']['anniversary']) && $person['DirectoryPerson']['anniversary'] != '' && 
			$person['DirectoryPerson']['anniversary'] != '0000-00-00') {
		$table[] = array('Anniversary', $this->Time->format('F j',strtotime($person['DirectoryPerson']['anniversary'])));
	}

	if(isset($person['Spouse']['first_name']) && $person['Spouse']['first_name'] != '') {
	 	$table[] = array('Spouse', $this->Html->link($person['Spouse']['first_name'] . ' ' . $person['Spouse']['last_name'], 
						array('action' => 'view', $person['Spouse']['id'])));
	}
	
	if($self || $admin) {
		$table[] = array('Prayer Chain Contact', $person['PrayerChain']['label']);
	
		$table[] = array('Emergency Contact', $person['EmergencyContact']['label']);
	}
	
	echo $this->Html->tableCells($table);
?>
</table>

</div>