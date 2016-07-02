<div class='picture_index'>
<?php echo $this->element('directoryheader'); ?>
<h1>
<?php echo $this->Html->Link($family['DirectoryFamily']['family_display_name'],
			array('controller' => 'directoryFamilies','action' => 'view', $family['DirectoryFamily']['id'])); ?>
</h1>
<h2>
Main Picture
</h2>
<?php

	$editor = false;
	if(AuthComponent::user('user_role_id') == 1 || AuthComponent::user('directory_family_id') == $family['DirectoryFamily']['id']) {
		$editor = true;	
	}

	echo "<div class='imagebox'>";

	// MAIN SELECTED IMAGE
	echo $this->Html->Link($this->Html->image('directory/pictures/thumbnails/' . $family['DirectoryPicture']['image_name']),
		array('action' => 'download', $family['DirectoryPicture']['id']), 
		array('escape' => false));
	// IF EDITOR SHOW BUTTONS TO DELETE IMAGE, NOT REMOVE AS SELECTED YOU MUST SELECT A DIFFRENT PICTURE TO REPLACE IT
	if($editor) {
		echo "<div class='buttonlinks'>";
		echo $this->Form->postLink(
		 	'Delete',
		 	array('action' => 'delete', $family['DirectoryPicture']['id'],$family['DirectoryFamily']['id']),
		 	array('confirm' => 'Are you sure you want to delete this Picture?', 'class' => 'button')
		 	);		
		echo "</div>";
	}
	echo "</div>";
	
	echo "<span class='midheader'>";
	echo "<h2 id='otherimages'>Other Pictures</h2>";
	
	if($editor) {
		echo "<div class='buttonlinks'>";
		echo $this->Html->Link('Add New Picture', array('action' => 'add', $family['DirectoryFamily']['id']),array('class' => 'button'));
		echo "</div>";
		}
	
	echo "</span>";
	
	echo "<div class='imagegrid'>";
	// LOOP THOUGH ALL PICTURES ASSOCIATED WITH THE FAMILY
	foreach ($pictures as $pic):
		// DON'T SHOW THE SELECTED PICTURE WE ALREADY SHOWED THAT ABOVE
		if($pic['DirectoryPicture']['id'] != $family['DirectoryFamily']['default_image']) {  
			if($pic['DirectoryPicture']['active']) {
				echo "<div class='imagebox'>";
			} else {
				echo "<div class='inactive'>";
				echo "<h3>Inactive</h3>";
			}
			echo $this->Html->Link($this->Html->image('directory/pictures/thumbnails/' . $pic['DirectoryPicture']['image_name']),
				array('action' => 'download', $pic['DirectoryPicture']['id']), 
				array('escape' => false));
			//  ONLY SHOW EDITING BUTTONS IF YOUR AN EDITOR
			if($editor) {
				echo "<div class='buttonlinks'>";
				echo $this->Form->postLink(
				 	'Delete',
				 	array('action' => 'delete', $pic['DirectoryPicture']['id'],$family['DirectoryFamily']['id']),
				 	array('confirm' => 'Are you sure you want to delete this Picture?', 'class' => 'button')
				 	);
				// ONLY SHOW SET AS MAIN IMAGE IF THE IMAGE IS ACTIVE
				if($pic['DirectoryPicture']['active']) {
					echo $this->Html->Link('Set as Main Image', 
							array('controller' => 'DirectoryFamilies', 'action' => 'select_picture', $family['DirectoryFamily']['id'],
							$pic['DirectoryPicture']['id']), array('class' => 'button'));	
				} else {
					// ONLY ADMIN CAN APPROVE
					if(AuthComponent::user('user_role_id') == 1) {
						echo $this->Html->Link('Approve', 
							array('controller' => 'DirectoryPictures','action' => 'approve', $pic['DirectoryPicture']['id']), array('class' => 'button'));
					}
				}
				echo "</div>";

			}
			echo "</div>";
		}
	endforeach;		
	echo "</div>";
?>
</div>
