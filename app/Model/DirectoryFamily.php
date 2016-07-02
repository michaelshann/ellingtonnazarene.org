<?php

class DirectoryFamily extends AppModel {
	public $belongsTo = array('DirectoryHome',
							  'DirectoryPicture' => array(
									'className' => 'DirectoryPicture',
									'foreignKey' => 'default_image'
									)
    );

	public $hasMany = array('DirectoryPicture','DirectoryPerson');

}