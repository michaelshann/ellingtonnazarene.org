<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
// app/Model/User.php
class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'min' => array(
		        'rule' => array('minLength', 6),
		        'message' => 'Usernames must be at least 6 characters.'
		      ),
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
		'confirm_password' => array(
		      'required'=> array(
		      	'rule' => 'notEmpty',
		      	'message' => 'Please Confirm Your Password'),
		      'match'=>array(
		        'rule' => 'validatePasswdConfirm',
		        'message' => 'Passwords do not match'
		      )
		    )
    );
    
	public $belongsTo = array('UserRole');
	
	public $hasOne = array('DirectoryPerson');


	function validatePasswdConfirm($data)
	{
	    if ($this->data['User']['password'] !== $data['confirm_password'])
	    {
	      return false;
	    }
	    return true;
	}

    public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    
//	    if (isset($this->data['User']['confirm_password']))
//	    {
//	      unset($this->data['User']['confirm_password']);
//	    }
	    
	    return true;
	}
    
    
}