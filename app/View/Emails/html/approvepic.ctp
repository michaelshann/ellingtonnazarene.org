<h1>Preview Uploads</h1>
<h2>Thumbnail</h2>
<?php 
	echo $this->Html->image('directory/pictures/thumbnails/' . $picture['DirectoryPicture']['image_name'], array('fullBase' => true));
?>
<br />
</div>
<div style="clear: both">
<h2>Square </h2>
<?php
	echo $this->Html->image('directory/pictures/square/' .  $picture['DirectoryPicture']['image_name'], array('fullBase' => true));
?>
<br />
</div>
&nbsp;
<br />
<div style="clear: both">
<?php 
  echo $this->Form->postLink("Reject",array('action' => 'delete', $picture['DirectoryPicture']['id'], 'full_base' => true));
  echo "&nbsp;";
  echo $this->Html->link("Accept", array('action' => 'approve', $picture['DirectoryPicture']['id'], 'full_base' => true));
?>
</div>

</div>