<!-- app/View/Users/add.ctp -->
<div class="audio form">
<?php echo $this->Form->create('AudioSermon', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Add Audio Sermon'); ?></legend>
        <?php 
        echo $this->Form->input('title');
        echo $this->Form->input('date');
        echo $this->Form->input('speaker');
        echo $this->Form->file('filename');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>