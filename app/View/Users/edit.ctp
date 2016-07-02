<!-- app/View/Users/edit.ctp -->
<div class="users_form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php 
        echo $this->Form->input('User.first_name');
        echo $this->Form->input('User.last_name');
        echo $this->Form->input('User.email');
        echo $this->Form->input('User.user_role_id', array(
        	'options' => $user_roles));
		echo $this->Form->input('User.directory_family_id', array(
			'options' => $directory_families));
        echo $this->Form->input('User.username');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>