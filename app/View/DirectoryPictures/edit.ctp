<div class='picture_index'>
<h1>
<?php echo $this->Html->Link($family['DirectoryFamily']['family_display_name'],
			array('controller' => 'directoryFamilies','action' => 'view', $family['DirectoryFamily']['id'])); ?>
</h1>
<h2>
Main Picture
</h2>
<?php

	echo "<div class='imagebox'>";

	echo $this->Html->Link($this->Html->image('directory/pictures/thumbnails/' . $family['DirectoryPicture']['image_name']),
		array('action' => 'download', $family['DirectoryPicture']['id']), 
		array('escape' => false));
	echo "<div class='imagebuttons'>";		
	echo $this->Html->Link('Delete Picture', array('action' => 'delete', $family['DirectoryPicture']['id']), array('class' => 'button'));
	echo "</div>";
	echo "</div>";
	
	echo "<h2 id='otherimages'>Other Pictures</h2>";
	echo $this->Html->Link('Add New Picture', array('action' => 'add', $family['DirectoryFamily']['id']),array('class' => 'button'));
	// LOOP THOUGH ALL PICTURES ASSOCIATED WITH THE FAMILY
	foreach ($pictures as $pic):
		// DON'T SHOW THE SELECTED PICTURE WE ALREADY SHOWED THAT ABOVE
		if($pic['DirectoryPicture']['id'] != $family['DirectoryFamily']['default_image']) {  
			echo "<div class='imagebox'>";
			echo $this->Html->Link($this->Html->image('directory/pictures/thumbnails/' . $pic['DirectoryPicture']['image_name']),
				array('action' => 'download', $pic['DirectoryPicture']['id']), 
				array('escape' => false));
			echo "<div class='imagebuttons'>";
			echo $this->Html->Link('Delete Picture', array('action' => 'delete', $pic['DirectoryPicture']['id']), array('class' => 'button'));				echo $this->Html->Link('Set as Main Image', array('controller' => 'DirectoryFamilies', 'action' => 'select_picture', $family['DirectoryFamily']['id'],  $pic['DirectoryPicture']['id']), array('class' => 'button'));	
			echo "</div>";
			echo "</div>";
		}
	endforeach;		
?>
</div>
