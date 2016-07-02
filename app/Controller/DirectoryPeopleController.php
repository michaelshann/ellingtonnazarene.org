<?php
class DirectoryPeopleController extends AppController {
	var $components=array("Email","Session");
	var $helpers=array("Html","Form","Session");

    public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	  //  $this->Auth->allow();
	}
	
	public function isAuthorized($user) {
	    // All registered users can veiw and index
	    if ($this->action === 'view' ||
	    	$this->action === 'index') {
	        return true;
	    }
	
	    // Users can edit own family
	    if (in_array($this->action, array('edit', 'delete', 'remove'))) {
	        $id = (int)$this->request->params['pass'][0];
	    	$person = $this->DirectoryPerson->findById($id);
	        if (!$person) {
	            throw new NotFoundException(__('Invalid Person ID'));
	        }
	        if ($person['DirectoryPerson']['directory_family_id'] == $user['DirectoryPerson']['directory_family_id']) {
	            return true;
	        }
	    }
	    
	    if (in_array($this->action, array('add'))) {
		    if($this->request->params['pass'][0] == $user['DirectoryPerson']['directory_family_id']) {
			    return true;
		    }
	    }
	
	    return parent::isAuthorized($user);
	}
	
	
	
	public function emergency($type = null) {
	
		$print = isset($this->request->query['print']) ? $this->request->query['print'] : false;
	
		if(is_null($type)) {	// if not passed a type to limit only this type show all
			$people = $this->DirectoryPerson->find('all',  
				array('order' => 'DirectoryPerson.emergency_contact')
				);
		} else {
			$people = $this->DirectoryPerson->find('all',  
				array('order' => 'DirectoryPerson.emergency_contact',
					  'conditions' => array('DirectoryPerson.emergency_contact' => $type)));
		}
		
		$homes = $this->DirectoryPerson->DirectoryFamily->DirectoryHome->find('list', array(
			'fields' => array('DirectoryHome.id', 'DirectoryHome.phone'),
			'recursive' => 0));

		$this->set('homes',$homes);	
		$this->set('people',$people);
		
		if($print) {
			$this->autoRender = false;
			$this->layout = 'ajax';
			$this->render('emergency_print');
		}		
		
	
	}
	
	// Being Passed the Family ID to add the person to by default
	// Admin gets a list of all families, A User gets only thier family
	public function add($id) {
	
		 if ($this->request->is('post')) {
            $this->DirectoryPerson->create();
            if ($this->DirectoryPerson->save($this->request->data)) {
                $this->Session->setFlash(__('Your Person has been saved.'));
                return $this->redirect(array('action' => 'view', $this->DirectoryPerson->getInsertID()));
            }
            $this->Session->setFlash(__('Unable to add your Person.'));
        }
        
        // ONLY ADMIN CAN ADD TO ANY FAMILY
    	if($this->Auth->user('user_role_id') == 1) {
		    $this->set('families', $this->DirectoryPerson->DirectoryFamily->find('list', array(
		    		'fields' => array('id','family_display_name'))));
		    		
		    $this->set('spouses', $this->DirectoryPerson->find('list', 
		    	array('fields' => array('id','first_name','last_name'),
		    		  'order' => 'last_name ASC')));		
		} else { // IF EDITING YOUR OWN FAMILY AND NOT ADMIN ONLY GET TO SEE YOUR OWN FAMILY
		    $this->set('families',$this->DirectoryPerson->DirectoryFamily->find('list', array(
		    		'conditions' => array('id =' => $id),
		    		'fields' => array('id','family_display_name'))));
		    		
		    $this->set('spouses', $this->DirectoryPerson->find('list', 
		    	array('fields' => array('id', 'first_name', 'last_name'),
		    		  'conditions' => array('directory_family_id' => $id),
		    		  'order' => 'last_name ASC')));			    
		    
		}
		
		$this->set('family_id',$id);
	
		$this->set('contact_options',$this->DirectoryPerson->EmergencyContact->find('list', array('fields' => array('id','label'))));
	
	}
	
	// JUST MARK AS INACTIVE
	public function remove($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    
		$person = $this->DirectoryPerson->findById($id);
        if (!$person) {
            throw new NotFoundException(__('Invalid Person ID'));
        }
        
        $this->DirectoryPerson->id = $id;
        $this->DirectoryPerson->set('active', 0);
		
	    if ($this->DirectoryPerson->save()) {
	        $this->Session->setFlash(
	            __('%s has been removed.', h($person['DirectoryPerson']['first_name'] . ' ' . $person['DirectoryPerson']['last_name']))
	        );
	        return $this->redirect(array('controller' => 'DirectoryFamilies', 'action' => 'view', 
	        		$person['DirectoryPerson']['directory_family_id']));
	    }
	}
	
	// ACTUALLY DELETE FROM DB
	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
		
		$person = $this->DirectoryPerson->findById($id);
	    if (!$person) {
            throw new NotFoundException(__('Invalid Person ID'));
        }
        	
	    if ($this->DirectoryPerson->delete($id)) {
	        $this->Session->setFlash(
	            __('%s has been deleted.', h($person['DirectoryPerson']['first_name'] . ' ' . $person['DirectoryPerson']['last_name']))
	        );
	        return $this->redirect(array('controller' => 'DirectoryFamilies', 'action' => 'view', 
	        		$person['DirectoryPerson']['directory_family_id']));
	    }
	}
	
	public function edit($id) {
		if (!$id) {
            throw new NotFoundException(__('Invalid Person ID'));
        }

        $person = $this->DirectoryPerson->findById($id);
        if (!$person) {
            throw new NotFoundException(__('Invalid Person ID'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
	        $this->DirectoryPerson->id = $id;
        	if ($this->DirectoryPerson->save($this->request->data)) {
	        	$this->Session->setFlash(__('Your Data has been updated.'));
				return $this->redirect(array('action' => 'view', $id));
            }
	        $this->Session->setFlash(__('Unable to update your Data.'));
	   }
    	// ONLY ADMIN CAN ADD TO ANY FAMILY
    	if($this->Auth->user('user_role_id') == 1) {
		    $this->set('families', $this->DirectoryPerson->DirectoryFamily->find('list', array(
		    		'fields' => array('id','family_display_name'))));
		    		
		    $this->set('spouses', $this->DirectoryPerson->find('list', 
		    	array('fields' => array('id','first_name','last_name'),
		    		  'order' => 'last_name ASC')));		
		} else { // IF EDITING YOUR OWN FAMILY AND NOT ADMIN ONLY GET TO SEE YOUR OWN FAMILY
		    $this->set('families',$this->DirectoryPerson->DirectoryFamily->find('list', array(
		    		'conditions' => array('id =' => $person['DirectoryPerson']['directory_family_id']),
		    		'fields' => array('id','family_display_name'))));
		    		
		    $this->set('spouses', $this->DirectoryPerson->find('list', 
		    	array('fields' => array('id', 'first_name', 'last_name'),
		    		  'conditions' => array('directory_family_id' => $person['DirectoryPerson']['directory_family_id']),
		    		  'order' => 'last_name ASC')));			    
		    
		}
		
		$this->set('contact_options',$this->DirectoryPerson->EmergencyContact->find('list', array('fields' => array('id','label'))));
	
	    if (!$this->request->data) {
	        $this->request->data = $person;
	    }

	}
	
	public function view($id) {
		if (!$id) {
            throw new NotFoundException(__('Invalid Person ID'));
        }

        $person = $this->DirectoryPerson->findById($id);
        if (!$person) {
            throw new NotFoundException(__('Invalid Person ID'));
        }
        
        $self = $this->Auth->user('id') == $id;
        $admin = $this->Auth->user('user_role_id') == 1;
        
        if(!($self || $admin)) {
	        if(!$person['DirectoryPerson']['list_cell']) {
		        $person['DirectoryPerson']['cell_phone'] = '';
	        }
        }
        
       
        $this->set('person', $person);
        
	}

	public function index() {
		$this->set('people', $this->DirectoryPerson->find('all'));
	}
}