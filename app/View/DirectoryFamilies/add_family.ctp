<div class="df form">
<?php echo $this->Form->create('DirectoryFamily'); ?>
	<fieldset>
		<?php
		echo '<legend>' . __('Family Information') . '</legend>';
		echo $this->Form->input('DirectoryFamily.family_display_name');
		echo $this->Form->input('DirectoryFamily.family_last_name');
		
		echo '<legend>' . __('Home Information') . '</legend>';
		echo $this->Form->input('DirectoryHome.phone', array('label' => 'Home Phone'));		
		echo $this->Form->input('DirectoryHome.street_address');
		echo $this->Form->input('DirectoryHome.city');
		echo $this->Form->input('DirectoryHome.state');
		echo $this->Form->input('DirectoryHome.zip');
		
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>