
<div class='family_view'>
<?php echo $this->element('directoryheader'); ?>
<?php
	// AN EDITOR IS SOMEONE WITHIN THE FAMILY (USER HOLDS FAMILY ID) OR A SITE ADMIN USER_ROLE_ID = 1
	
	echo "<div class='directory_item family_item'>";
	echo $this->Html->image('directory/pictures/thumbnails/' . $family['DirectoryPicture']['image_name'], 
			array('url' => array('controller' => 'DirectoryPictures', 'action' => 'view', $family['DirectoryFamily']['id'])));
	echo "<div class='buttonlinks'>";
	if($editor) {
		echo $this->Html->Link('Edit Pictures', array('controller' => 'DirectoryPictures', 'action' => 'view', $family['DirectoryFamily']['id']));		
	} else {
		echo $this->Html->Link('More Pictures', array('controller' => 'DirectoryPictures', 'action' => 'view', $family['DirectoryFamily']['id']));
	}
	echo "</div>";
	echo "</div>";
	
	echo "<div class='family_view_right'>";
	echo "<h1>";
	echo $family['DirectoryFamily']['family_display_name'];
	echo "</h1>";
	
	echo "<div class='address'>";
	
	echo "<h3>";
	if(isset($family['DirectoryHome']['phone']) && $family['DirectoryHome']['phone'] != '') {
		echo $family['DirectoryHome']['phone'] . "<br />";	
	}
	echo $family['DirectoryHome']['street_address'] . "<br />";
	echo $family['DirectoryHome']['city'] . " ";
	echo $family['DirectoryHome']['state'] . " ";
	echo $family['DirectoryHome']['zip'] . " ";
	echo "</h3>";
	
		// IF EDITOR SHOW EDIT BUTTONS
	if($editor) {
		echo "<div class='buttonlinks'>";
		echo $this->Html->Link("edit", array('action' => 'edit', $family['DirectoryFamily']['id']));
		echo "&nbsp; &nbsp;";
		echo $this->Form->postLink(
		 	'delete',
		 	array('controller' => 'DirectoryFamilies','action' => 'remove', $family['DirectoryFamily']['id']),
		 	array('confirm' => 'Are you sure you want to delete this family?')
		 	);
		echo "&nbsp; &nbsp;";
		echo $this->Html->Link("print", array('action' => 'view', $family['DirectoryFamily']['id'], "?" => array("print" => 'true')),
							array("target" => "_blank"));
		echo "</div>";
	 }
	echo "</div>";

	
?>	
	</div>
	<div class='people_table'>
	<h3>Family Members </h3>
		<table>
<?php
		$headers = array("Name", "Cell Phone", "Email", "Birthday", "Anniversary");
		if($editor) {
			$headers[] = 'Actions';
		}
		
		echo $this->Html->tableHeaders($headers);
		$table = array();
		
		foreach($family['DirectoryPerson'] as $person):
			if($person['active']) {
				$row = array();
				$row[] = $this->Html->link(
					$person['first_name'] . " " . $person['last_name']
					,array('controller' => 'DirectoryPeople', 'action' => 'view', $person['id']));
				
				if($person['list_cell']) {
					$row[] = $person['cell_phone'];
				} else {
					$row[] = '&nbsp;';
				}
				
				$row[] = $person['email'];
				
				if(isset($person['birthday']) && $person['birthday'] != '') {
					$row[] = $this->Time->format('F j',strtotime($person['birthday']));
				} else {
					$row[] = "&nbsp;";
				}
				
				if(isset($person['anniversary']) && $person['anniversary'] != '') {
					$row[] = $this->Time->format('F j',strtotime($person['anniversary']));
				} else {
					$row[] = "&nbsp;";		
				}
				
				if($editor) {
					$row[] = "<div class='buttonlinks intable'> " . 
								$this->Html->link('edit', array('controller' => 'DirectoryPeople', 'action' => 'edit', $person['id'])) . " " .
								$this->Form->postLink(
							 	'delete',
							 	array('controller' => 'DirectoryPeople','action' => 'remove', $person['id']),
							 	array('confirm' => 'Are you sure you want to delete this person?')
							 	) . " </div>";
				}
				
				$table[] = $row;
			}
		endforeach;
		
		if($editor) {
		$table[] = array("", "", "", "", "", "<div class='buttonlinks intable'> " . 
			$this->Html->link("add member", array('controller' => 'DirectoryPeople', 'action' => 'add', $family['DirectoryFamily']['id'])) . "</div>"); 
		} 
		
		echo $this->Html->tableCells($table);
?>	
		</table>
	</div>

</div>