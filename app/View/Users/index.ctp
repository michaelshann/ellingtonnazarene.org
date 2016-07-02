<div class='indexpage'>
<h1>Users </h1>
<table>
	<?php
		echo $this->Html->tableHeaders(array('Username','Name','Role','Email','Active','Family ID', 'Actions'));
		$table_array = array();
		foreach($users as $user):
			$row_array = array();
			$id = $user['User']['id'];
			
			$row_array[] = $this->Html->link($user['User']['username'],array('action' => 'view', $id));
			$row_array[] = $user['User']['first_name'] . ' ' . $user['User']['last_name'];
			$row_array[] = $roles[$user['User']['user_role_id']];
			$row_array[] = $user['User']['email'];
			
			if($user['User']['active']) {
				$row_array[] = 'active';				
			} else {
				$row_array[] = 'blocked';
			}

	//		$row_array[] = $this->Html->link($user['DirectoryFamily']['family_display_name'], 
	//							array('controller' => 'directoryFamilies', 'action' => 'view', $user['DirectoryFamily']['id']));
			
			$activeLink = '';
			if(!$user['User']['active']) {
					$activeLink = $this->Html->link('Activate',array('action' => 'approve', $id));
				} else {
					$activeLink = $this->Html->link(' Block ',array('action' => 'block', $id));
				}
			
			$row_array[] = 
				$this->Html->link('View',array('action' => 'view', $id)) . ' &nbsp; ' .
				$this->Html->link('Edit',array('action' => 'edit', $id)) . ' &nbsp; ' .
				$activeLink .  ' &nbsp; ' . 
				$this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $id),
                    array('confirm' => 'Are you sure you want to delete this user?')
					);
					
			$table_array[] = $row_array;
		endforeach;
		
		echo $this->Html->tableCells($table_array);
	?>
</table>
<?php echo $this->element('pager'); ?>
</div>
