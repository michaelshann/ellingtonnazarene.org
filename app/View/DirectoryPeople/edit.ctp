<div class="df form">
<?php echo $this->Form->create('DirectoryPerson'); ?>
	<fieldset>
		<?php
		echo '<legend>' . __('Personal Information') . '</legend>';
		echo $this->Form->input('DirectoryPerson.first_name');
		echo $this->Form->input('DirectoryPerson.last_name');
		echo $this->Form->input('DirectoryPerson.directory_family_id', array(
        	'options' => $families,
        	'label' => 'Family'));
        echo $this->Form->input('DirectoryPerson.member', array(
        	'options' => array(0 => "No", 1 => "Yes"),
        	 'label' => 'Chuch Member',
        	 'empty' => ''));
		echo $this->Form->input('DirectoryPerson.cell_phone');
		echo $this->Form->input('DirectoryPerson.list_cell', array(
			'label' => 'List Cell Phone Number in Directory',
			'after' => '<p class="guidance">If unchecked your phone number will not be displayed for other people, but can be used as an emergency contact method.</p>'));
		echo $this->Form->input('DirectoryPerson.email');
		echo $this->Form->input('DirectoryPerson.birthday',
			array('between' => '<p class="guidance">Your birth year will not be displayed to other people</p>',
				  'empty' => array(
				  	'month'     => 'MONTH',
				  	'day'       => 'DAY',
				  	'year'      => 'YEAR'),
				  	'minYear' => date('Y') - 100,
				  	'maxYear' => date('Y')
            ));		
		echo $this->Form->input('DirectoryPerson.anniversary', 
			array('between' => '<p class="guidance">Your marriage year will not be displayed to other people</p>',
				  'empty' => array(
				  	'month'     => 'MONTH',
				  	'day'       => 'DAY',
				  	'year'      => 'YEAR'),
				  	'minYear' => date('Y') - 100,
				  	'maxYear' => date('Y')
            ));	
		echo $this->Form->input('DirectoryPerson.spouse_id', 
			array('options' => $spouses,
				  'empty' => '',));		
		echo $this->Form->input('DirectoryPerson.prayer_chain', 
			array('options' => $contact_options,
				  'empty' => '',
				  'between' => '<p class="guidance">How would you like to be contacted for Prayer Requests.</p>'));		
		echo $this->Form->input('DirectoryPerson.emergency_contact', 
			array('options' => $contact_options,
 				  'empty' => '',
				  'between' => '<p class="guidance">How would you like to be contacted for Emergencies. (i.e. Church is Canceled)</p>'));			
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>