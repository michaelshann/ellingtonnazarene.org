<!-- app/View/Users/add.ctp -->
<div class="users_form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        	<p> Your account will be created and sent to admin for approval.  You will be emailed when your account is activated</p>
        <?php 
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('email');
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirm Password'));

    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>