<div class='picture_index'>
<h1>
<?php echo $this->Html->Link($family['DirectoryFamily']['family_display_name'],
			array('controller' => 'directoryFamilies','action' => 'view', $family['DirectoryFamily']['id'])); ?>
</h1>
<h2>
Main Image
</h2>
<?php

	echo $this->Html->Link($this->Html->image('directory/pictures/thumbnails/' . $family['DirectoryPicture']['image_name']),
		array('action' => 'download', $family['DirectoryPicture']['id']), 
		array('escape' => false));

	echo "<h2 id='otherimages'>Other Images</h2>";
	
	foreach ($pictures as $pic):
		if($pic['DirectoryPicture']['id'] != $family['DirectoryFamily']['default_image']) {
			echo $this->Html->Link($this->Html->image('directory/pictures/thumbnails/' . $pic['DirectoryPicture']['image_name']),
				array('action' => 'download', $pic['DirectoryPicture']['id']), 
				array('escape' => false));
		}
	endforeach;		
?>
</div>
