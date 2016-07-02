<?php

class DirectoryPerson extends AppModel {
	public $belongsTo = array(
		'DirectoryFamily', 
		'PrayerChain' => array(
            'className' => 'DirectoryContactOption',
            'foreignKey' => 'prayer_chain'
        ),
        'EmergencyContact' => array(
            'className' => 'DirectoryContactOption',
            'foreignKey' => 'emergency_contact'
        ),
        'Spouse' => array(
        	'className' => 'DirectoryPerson',
        	'foreignKey' => 'spouse_id'),
        'User');
     
        	
	 public $validate = array(
        'first_name' => 'alphaNumeric',
        'last_name' => 'alphaNumeric',
        'email' => array(
	        'rule'     => 'email',
	        'required' => false,
	        'allowEmpty' => true
	    ),
        'birthday'  => array(
        	'rule' => 'date',
        	'required' => false,
	        'allowEmpty' => true),
        'anniversary' => array(
        	'rule' => 'date',
        	'required' => false,
	        'allowEmpty' => true),
        'cell_phone' => array(
        	'rule' => array('phone', null, 'us'),
        	'required' => false,
	        'allowEmpty' => true
			),
		
    );
    

    

}