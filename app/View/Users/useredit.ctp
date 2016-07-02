<!-- app/View/Users/edit.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php 
        echo $this->Form->input('User.username');
        echo $this->Form->input('User.first_name');
        echo $this->Form->input('User.last_name');
        echo $this->Form->input('User.email');;
        echo $this->Html->link('Change Password', array('action' => 'passwd',$id));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>