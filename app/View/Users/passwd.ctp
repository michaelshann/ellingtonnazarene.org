<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Reset Password'); ?></legend>
        <?php 
        echo $this->Form->input('password', array('label' => 'New Password'));
        echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirm New Password'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>