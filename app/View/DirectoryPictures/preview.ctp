<div class='family_view'>
<h1>Preview Uploads</h1>
<div style="clear: both">
<h2>Thumbnail</h2>
<?php 
	echo $this->Html->image('directory/pictures/thumbnails/' . $picture['DirectoryPicture']['image_name']);
?>
<br />
</div>
<div style="clear: both">
<h2>Square </h2>
<?php
	echo $this->Html->image('directory/pictures/square/' .  $picture['DirectoryPicture']['image_name']);
?>
<br />
</div>
&nbsp;
<br />
<div style="clear: both">
<?php 
  echo $this->Form->postLink("Reject",array('action' => 'delete', $picture['DirectoryPicture']['id']), array('class' => 'button'));
  if(AuthComponent::user('user_role_id') != 1) { // if admin you can approve instantly if user submit for approval
  	echo $this->Html->link("Accept", array('action' => 'emailpic', $picture['DirectoryPicture']['id']), array('class' => 'button'));
  } else {
	echo $this->Html->link("Accept", array('action' => 'approve', $picture['DirectoryPicture']['id']), array('class' => 'button'));
  }
?>
</div>

</div>