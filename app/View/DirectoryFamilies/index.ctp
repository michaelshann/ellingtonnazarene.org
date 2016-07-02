
<div class='directory_index'>
<h1>
	<?php echo $this->Html->Link('Ellington Directory',array('controller' => 'DirectoryFamilies','action' => 'index')); ?>
</h1>
<?php
	foreach($families as $family):
		echo $this->Html->link(
			$this->Html->div(
				'directory_item',
				$this->Html->image('directory/pictures/square/' . $family['DirectoryPicture']['image_name']) .
				$this->Html->link($family['DirectoryFamily']['family_display_name'], array('action' => 'view',
					$family['DirectoryFamily']['id'] ))
			),
			array('action' => 'view',$family['DirectoryFamily']['id']),
			array('escape' => false) 
		);

	endforeach;
?>
<?php echo $this->element('pager'); ?>
</div>