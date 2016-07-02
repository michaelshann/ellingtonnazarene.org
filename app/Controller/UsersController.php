<?php
// app/Controller/UsersController.php
class UsersController extends AppController {

	var $components=array("Email","Session");
	var $helpers=array("Html","Form","Session");

    public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('add', 'logout', 'login', 'forgotpw', 'reset', 'forgotuser');
	}
	
	public function isAuthorized($user) {
		// users can only view and edit thier own pages if not admin
		if (in_array($this->action, array('useredit', 'view', 'passwd'))) {
	        $uid = (int)$this->request->params['pass'][0];
	        if ($uid == $user['id']) {
	            return true;
	        }
	    }
	    
	    return parent::isAuthorized($user);
	}	
	
	public function login() {
	    if ($this->request->is('post')) {
	    
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirect());
	        }
	        $this->Session->setFlash(__('Invalid username or password, or account is not yet active.'));
	    }
	}
	
	
	// Remove a users Directory Family ID -> Given a user id at least removes any directory family id, if given a family id as well
	//   it will redirect back to that family id view page
	public function removeFamily($id = null, $family_id = null) {
        $this->request->onlyAllow('post');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        $this->User->saveField("directory_family_id", '', false);
        
        if($family_id) {
	        $this->redirect(array('controller' => 'DirectoryFamilies', 'action' => 'view', $family_id));
        } else {
	        $this->redirect(array('action' => 'view', $id));
        }
	}
	
    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

	
	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

    public function index() {
    	$this->set('roles',$this->User->UserRole->find('list'));
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $user = $this->User->read(null, $id);
        
        $this->set('roles',$this->User->UserRole->find('list'));
        $this->set('user', $user);
        
		if(!is_null($user['DirectoryPerson']['directory_family_id'])) {
			$this->set('family',$this->User->DirectoryPerson->DirectoryFamily->findById($user['DirectoryPerson']['directory_family_id']));	
		}
		
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved, please wait for activation email'));
                $this->_sendActivationEmail($this->request->data,$this->User->getInsertID());
                return $this->redirect(array('controller' => 'Pages', 'action' => 'display', 'home'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }
    
    public function approve($id) {
	     if (!$id) {
	        throw new NotFoundException(__('Invalid User'));
	    }
	
	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('Invalid user'));
	    }
	
        $this->User->id = $id;
        $this->User->set('active', 1);
        
        if ($this->User->save()) {
            $this->Session->setFlash(__('Your User has been activated.'));
            $this->_sendUserActivatedEmail($user);
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to activate the User.'));
    
    }
    
    // De activate the given user id
    public function block($id) {
	     if (!$id) {
	        throw new NotFoundException(__('Invalid User'));
	    }
	
	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('Invalid user'));
	    }
	
        $this->User->id = $id;
        $this->User->set('active', 0);
        
        if ($this->User->save()) {
            $this->Session->setFlash(__('Your User has been blocked.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to activate the User.'));
    
    }
    
    public function useredit($id = null) {
	    if(!isset($id) || $id == '') {
			throw new NotFoundException(__('Invalid user'));
	    }
	    $this->User->id = $id;
	    if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'view', $id));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
        	$this->set('id',$id);
        	$this->set('user_roles',$this->User->UserRole->find('list'));
        	$this->set('directory_families', $this->User->DirectoryFamily->find('list', array(
        				 'fields' => array('id', 'family_display_name'),
        				 'order' => array('family_last_name' => 'asc'))));
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

	public function passwd($id = null) {
		if(!isset($id) || $id == '') {
			throw new NotFoundException(__('Invalid user'));
	    }
	   
	    $this->User->id = $id;
	   
	    if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
		
		if ($this->request->is('post') || $this->request->is('put')) {
		    if(true) {
	            if ($this->User->save($this->request->data)) {
	                $this->Session->setFlash(__('The password has been saved'));
	                return $this->redirect(array('action' => 'view', $id));
	            }
	            $this->Session->setFlash(
	                __('The user could not be saved. Please, try again.')
	            );
			} else {
				$this->Session->setFlash(
	                __('The Password and Confirm Password do not match'));
			}
        } else {
            $this->set('id',$id);
        }
	}

    public function edit($id = null) {
        if(!isset($id) || $id == '') {
			throw new NotFoundException(__('Invalid user'));
	    }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'view', $id));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
        	$this->set('user_roles',$this->User->UserRole->find('list'));
        	$this->set('directory_families', $this->User->DirectoryFamily->find('list', array(
        				 'fields' => array('id', 'family_display_name'),
        				 'order' => array('family_last_name' => 'asc'))));
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

	function forgotuser(){
        //$this->layout="signup";
        $this->User->recursive=-1;
        if(!empty($this->data))
        {
            if(empty($this->data['User']['email']))
            {
                $this->Session->setFlash('Please Provide Your Email Adress that You used to Register with Us');
            }
            else
            {
                $email=$this->data['User']['email'];
                $fu=$this->User->find('first',array('conditions'=>array('User.email'=>$email)));
                if($fu)
                {
                    //debug($fu);
                    if($fu['User']['active'])
                    {
                        $uname = $fu['User']['username'];
						$this->Session->setFlash('Username: ' . $uname);
						$this->redirect(array('action' => 'login'));						
                    }
                    else
                    {
                        $this->Session->setFlash('This Account is not Active yet. The Admin will approve your account soon');
                    }
                }
                else
                {
                    $this->Session->setFlash('Email does Not Exist');
                }
            }
        }
    }

	function forgotpw(){
        //$this->layout="signup";
        $this->User->recursive=-1;
        if(!empty($this->data))
        {
            if(empty($this->data['User']['email']))
            {
                $this->Session->setFlash('Please Provide Your Email Adress that You used to Register with Us');
            }
            else
            {
                $email=$this->data['User']['email'];
                $fu=$this->User->find('first',array('conditions'=>array('User.email'=>$email)));
                if($fu)
                {
                    //debug($fu);
                    if($fu['User']['active'])
                    {
                        $key = Security::hash(String::uuid(),'sha512',true);
                        $uname = $fu['User']['username'];
                        $hash=sha1($uname.rand(0,100));
                        $url = Router::url( array('controller'=>'users','action'=>'reset'), true ).'/'.$key.'#'.$hash;
                        $link=$url;
                        $link=wordwrap($link,1000);
                        $fu['User']['tokenhash']=$key;
                        $this->User->id=$fu['User']['id'];
                        if($this->User->saveField('tokenhash',$fu['User']['tokenhash'])){
 
                            //============Email================//
                            /* SMTP Options */
							$Email = new CakeEmail('default');	
                            
                            $Email->template('resetpw');
                            $Email->emailFormat('text');
                            $Email->from(array('admin@ellingtonnazarene.org' => 'Ellington Nazarene'));
                            $Email->to($fu['User']['email']);
                            $Email->subject('Reset Your EllingtonNazarene.org Password');
							$Email->viewVars(array('link' => $link, 'uname' => $uname));

                            $Email->send();
                            $this->Session->setFlash(__('Check Your Email To Reset your password', true));
                            return $this->redirect(array('controller' => 'Pages', 'action' => 'display', 'home'));
 
                            //============EndEmail=============//
                        }
                        else{
                            $this->Session->setFlash("Error Generating Reset link");
                        }
                    }
                    else
                    {
                        $this->Session->setFlash('This Account is not Active yet.Check Your mail to activate it');
                    }
                }
                else
                {
                    $this->Session->setFlash('Email does Not Exist');
                }
            }
        }
    }
    
    function reset($token=null) {
    	
		//$this->layout="Login";
		$this->User->recursive=-1;
		if(!empty($token)) {
			$u=$this->User->findBytokenhash($token);
			if($u){
				$this->User->id=$u['User']['id'];
				if(!empty($this->data)){
					$this->User->data=$this->data;
					$this->User->data['User']['username']=$u['User']['username'];
					$new_hash=sha1($u['User']['username'].rand(0,100));//created token
					$this->User->data['User']['tokenhash']=$new_hash;
					if($this->User->save($this->User->data))
					{
						$this->Session->setFlash('Password Has been Updated');
						$this->redirect(array('controller'=>'users','action'=>'login'));
					} else {
						$this->Session->setFlash('Password Update Failed');
						$this->redirect(array('controller' => 'Pages', 'action' => 'Display', 'home'));
					}
				}
			}
			else
			{
				$this->Session->setFlash('Token Corrupted,,Please Retry.the reset link work only for once.');
			}
		} else {
			$this->redirect(array('action'=>'login'));
		}
		$this->render('passwd');
	}
	
    public function _sendUserActivatedEmail($user) {
	    $uname = $user['User']['username'];
		$name = $user['User']['first_name'] . ' ' . $user['User']['last_name'];
		$email = $user['User']['email'];
		
        $link = Router::url( array('controller'=>'users','action'=>'login'), true );
        //============Email================//
        /* SMTP Options */
		$Email = new CakeEmail('default');	
        $Email->template('youractive');
        $Email->emailFormat('text');
        $Email->from(array('admin@ellingtonnazarene.org' => 'Ellington Nazarene'));
        $Email->to($email);
        $Email->subject('Your EllingtonNazarene.org account is active');
		$Email->viewVars(array('link' => $link, 'uname' => $uname, 'name' => $name, 'email' => $email));

        $Email->send();
    }
    
    public function _sendActivationEmail($data,$id) {
	    $uname = $data['User']['username'];
		$name = $data['User']['first_name'] . ' ' . $data['User']['last_name'];
		$email = $data['User']['email'];
		
        $link = Router::url( array('controller'=>'users','action'=>'approve',$id), true );
        //============Email================//
        /* SMTP Options */
		$Email = new CakeEmail('default');	
        
        $Email->template('activation');
        $Email->emailFormat('text');
        $Email->from(array('admin@ellingtonnazarene.org' => 'Ellington Nazarene'));
        $Email->to('michaelshann@gmail.com');
        $Email->subject($uname. ' EllingtonNazarene.org');
		$Email->viewVars(array('link' => $link, 'uname' => $uname, 'name' => $name, 'email' => $email));

        $Email->send();
    }

}