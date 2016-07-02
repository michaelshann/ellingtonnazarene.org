<!-- app/View/Users/add.ctp -->
<div class="audio form">
<?php echo $this->Form->create('DirectoryPicture', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Add Directory Picture'); ?></legend>
        <?php 
        echo $this->Form->file('image_name');
        echo $this->Form->hidden('directory_family_id',array('default' => $familyID));
		?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>