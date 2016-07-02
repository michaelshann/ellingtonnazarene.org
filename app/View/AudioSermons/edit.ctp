<!-- app/View/Users/add.ctp -->
<div class="audio form">
<?php echo $this->Form->create('AudioSermon'); ?>
    <fieldset>
        <legend><?php echo __('Edit Audio Sermon'); ?></legend>
        <?php 
        echo $this->Form->input('title');
        echo $this->Form->input('date');
        echo $this->Form->input('speaker');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>