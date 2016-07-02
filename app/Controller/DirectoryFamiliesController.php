<?php
class DirectoryFamiliesController extends AppController {
	var $components=array("Email","Session","Paginator");
	var $helpers=array("Html","Form","Session","Time");
	
	
    public $paginate = array(
        'limit' => 12,
        'order' => array(
            'DirectoryFamily.family_last_name' => 'asc'
        )
    );
	
	public function isAuthorized($user) {
	    // All registered users can veiw and index
	    if ($this->action === 'view' ||
	    	$this->action === 'index') {
	        return true;
	    }
	
	    // Users can edit own family
	    if (in_array($this->action, array('edit', 'delete'))) {
	        $familyID = (int)$this->request->params['pass'][0];
	        if ($familyID == $user['DirectoryPerson']['directory_family_id']) {
	            return true;
	        }
	    }
	
	    return parent::isAuthorized($user);
	}
	
	public function defaultPictures() {
		if(is_null($type)) {	// if not passed a type to limit only this type show all
			$families = $this->DirectoryFamily->find('all');
		} 
		
		$contact = $this->DirectoryFamily->DirectoryPerson->EmergencyContact->find('list', array(
			'fields' => array('EmergencyContact.id', 'EmergencyContact.label')));
		
		$this->set('contact', $contact);
		$this->set('families',$families);
		
		if($print) {
			$this->autoRender = false;
			$this->layout = 'print';
			$this->render('default_pictures');
		}	
	}
	
	public function emergencyContact($type = null, $print = false) {
		
		if(is_null($type)) {	// if not passed a type to limit only this type show all
			$families = $this->DirectoryFamily->find('all');
		} 
		
		$contact = $this->DirectoryFamily->DirectoryPerson->EmergencyContact->find('list', array(
			'fields' => array('EmergencyContact.id', 'EmergencyContact.label')));
		
		$this->set('contact', $contact);
		$this->set('families',$families);
		
		if($print) {
			$this->autoRender = false;
			$this->layout = 'print';
			$this->render('emergency_print');
		}	
		
	}
	
	public function addFamily() {
		
		$this->request->data['DirectoryFamily']['default_image'] = 1;
		
	    if ($this->request->is('post') || $this->request->is('put')) {
	    	if($this->DirectoryFamily->saveAll($this->request->data)) {
	    		
		        	$this->Session->setFlash(__('Your Family has been updated.'));
					return $this->redirect(array('action' => 'view', $this->DirectoryFamily->id));
	            
            }
	        $this->Session->setFlash(__('Unable to update your Family.'));
	    }
	
	}

	
	public function addUser($id = null) {
		$this->DirectoryFamily->id = $id;
		
		if(!$id) {
			throw new NotFoundException(__('Invalid family id'));	
		}   
		
		 if ($this->request->is('post') || $this->request->is('put')) {
        	if ($this->DirectoryFamily->save($this->request->data)) {
	        	$this->Session->setFlash(__('Your Family has been updated.'));
				return $this->redirect(array('action' => 'view', $id));
            }
	        $this->Session->setFlash(__('Unable to update your Family.'));
	    }
		
		$family = $this->DirectoryFamily->findById($id);     
		
        if (!$family) {
            throw new NotFoundException(__('Invalid family id'));
        }
        
        $users = $this->DirectoryFamily->User->find('list', array(
        	'fields' => array('User.id', 'User.username'),
        	'conditions' => array('User.active' => true), 
        	'order' => array('User.username')
		));
		
		$this->set('family',$family);
		$this->set('users',$users);
        
	}
	
	// MARKS A FAMILY AS INACTIVE
	//  -MAYBE SEND EMAIL TO ADMIN TELLING HIM IT HAS BEEN MARKED INACTIVE?
	public function remove($id) {
		 if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    
		$family = $this->DirectoryFamily->findById($id);
        if (!$family) {
            throw new NotFoundException(__('Invalid Family ID'));
        }
        
        // NOT ACTUALLY REMOVING JUST MARKING ACTIVE AS 0 - FALSE
        $this->DirectoryFamily->id = $id;
        $this->DirectoryFamily->set('active', 0);
		
	    if ($this->DirectoryFamily->save()) {
	        $this->Session->setFlash(
	            __('%s has been removed.', h($family['DirectoryFamily']['family_display_name']))
	        );
	        return $this->redirect(array('controller' => 'DirectoryFamilies', 'action' => 'index'));
	    }
	}
		
	public function select_picture($family_id,$id) {
		if(!$id) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		if(!$family_id) {
			throw new NotFoundException(__('Invalid Family ID'));
		}
		
		$picture = $this->DirectoryFamily->DirectoryPicture->findById($id);
		$family = $this->DirectoryFamily->findById($family_id);
		
		if(!$family) {
			throw new NotFoundException(__('Invalid Family ID'));
		}
		if(!$picture) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
        $this->DirectoryFamily->id = $family_id;
        $this->DirectoryFamily->set('default_image', $id);
		
	    if ($this->DirectoryFamily->save()) {
	        $this->Session->setFlash(
	            __('Default Picture Update')
	        );
	        return $this->redirect(array('controller' => 'DirectoryPictures', 'action' => 'view', $family_id));
	    }
		
	}
	
	public function edit($id) 
	{
	    if (!$id) {
	        throw new NotFoundException(__('Invalid Family ID'));
	    }
	    
	    $fam = $this->DirectoryFamily->findById($id);
	    if (!$fam) {
	        throw new NotFoundException(__('Invalid Family ID'));
	    }
	
	    if ($this->request->is('post') || $this->request->is('put')) {
	        $this->DirectoryFamily->id = $id;
        	if ($this->DirectoryFamily->save($this->request->data)) {
        		$this->DirectoryFamily->DirectoryHome->save($this->request->data);
	        	$this->Session->setFlash(__('Your Family has been updated.'));
				return $this->redirect(array('action' => 'view', $id));
            }
	        $this->Session->setFlash(__('Unable to update your Family.'));
	    }
	
	    if (!$this->request->data) {
	        $this->request->data = $fam;
	    }
    }

	
	public function index() {
		$this->Paginator->settings = $this->paginate;
		
		$families = $this->Paginator->paginate('DirectoryFamily', array('DirectoryFamily.active ' => 'TRUE'));
		$this->set('families', $families);
	}
	
	public function printable() {
		
		$families = $this->DirectoryFamily->find('all', array('conditions' => array('DirectoryFamily.active ' => 'TRUE')));
		$this->set('families', $families);
	}
	
	public function view($id) {
	
		$print = isset($this->request->query['print']) ? $this->request->query['print'] : false;
	
		if (!$id) {
            throw new NotFoundException(__('Invalid Family ID'));
        }

        $family = $this->DirectoryFamily->findById($id);

        if (!$family) {
            throw new NotFoundException(__('Invalid Family ID'));
        }
		
		$contact = $this->DirectoryFamily->DirectoryPerson->EmergencyContact->find('list', array(
			'fields' => array('EmergencyContact.id', 'EmergencyContact.label')));
		
		$this->set('contact', $contact);        
        $this->set('family', $family);
        
        // This is for setting weather or not this user can edit the page they are about too see, if thier in the family or an admin they can
        $editor = false;
        $editor = $this->Auth->user('user_role_id') == 1;
        $user_person = $this->DirectoryFamily->DirectoryPerson->findByUserId($this->Auth->user('id'));
		
		if(isset($user_person) && isset($user_person['DirectoryFamily']) && !$editor) {
			$editor = $id == $user_person['DirectoryFamily']['id'];
		}
		
		$this->set('editor', $editor);
		
		if($print) {
			$this->autoRender = false;
			$this->layout = 'print';
			$this->render('print_family');
		}	
	}

}