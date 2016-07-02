<div class='userview'>
<?php
	$id = $user['User']['id'];
?>
<h1>
	<?php 	echo $user['User']['username']; ?>
</h1>
<table>
	<?php
		$table = array();
		
		$table[] = array('Name', $user['User']['first_name'] . ' ' . $user['User']['last_name']);
		
		$table[] = array('Role', $roles[$user['User']['user_role_id']]);
		
		$table[] = array('Email', $user['User']['email']);
		
		
		if(!is_null($family)) {
			$table[] = array('Directory Family', $this->Html->link($family['DirectoryFamily']['family_display_name'],
					array('controller' => 'DirectoryFamilies', 'action' => 'view', $family['DirectoryFamily']['id'])));
		}
		
		$table[] = array('Password', $this->Html->link("New Password", array('action' => 'passwd', $id)));
		
		if(AuthComponent::user('user_role_id') == 1) {
			echo $this->Html->link('edit',array('action' => 'edit', $id));
		} else {
			echo $this->Html->link('edit',array('action' => 'useredit', $id));
		}
 
		echo $this->Html->tableCells($table);

	?>

</table>

</div>