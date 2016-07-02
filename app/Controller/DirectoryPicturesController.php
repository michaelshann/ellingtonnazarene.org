<?php
class DirectoryPicturesController extends AppController {
	var $components=array("Email","Session");
	var $helpers=array("Html","Form","Session");

	public function isAuthorized($user) {
	    // All registered users can veiw and index
	    if ($this->action === 'view' ||
	    	$this->action === 'download') {
	        return true;
	    }
	
	    // Users can preview, email or remove thier own families pic, this if is if you have to look up the family id
	    if (in_array($this->action, array('preview', 'emailpic', 'remove'))) {
	        $pictureID = (int)$this->request->params['pass'][0];
	        $picture = $this->DirectoryPicture->findById($pictureID);
			if($picture) {
		        if ($picture['DirectoryPicture']['directory_family_id'] == $user['DirectoryPerson']['directory_family_id']) {
		            return true;
		        }
		    }
	    }
	    
	    // Users can add and edit thier own pictures, this is if the family id is passed as a parameter and doesn't need to be looked up
	    if(in_array($this->action, array('add', 'edit'))) {
	        $familyID = (int)$this->request->params['pass'][0];
	        if ($familyID == $user['DirectoryPerson']['directory_family_id']) {
	            return true;
	        }		    
	    }
	
	    return parent::isAuthorized($user); // returns true if admin
	}

	public function add($family_id) {
	    if ($this->request->is('post')) {
			$this->DirectoryPicture->create();
			if ($this->DirectoryPicture->save($this->request->data)) {
				//$this->Session->setFlash('Your Picture has been submitted, It Must be approved by an Admin before it is visible');
				$this->redirect(array('action' => 'preview', $this->DirectoryPicture->getInsertID()));
			}
		}
		
		if (!$family_id) {
            throw new NotFoundException(__('Invalid Family ID'));
        }

        $family = $this->DirectoryPicture->DirectoryFamily->findById($family_id);
        if (!$family) {
            throw new NotFoundException(__('Invalid Family ID'));
        }
        
        $this->set('familyID',$family_id);   
	}
	
	// ACTUALLY DELETE A PHOTO
	public function delete($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if(!$id) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		$picture = $this->DirectoryPicture->findById($id);
		
		if(!$picture) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		$fid = $picture['DirectoryPicture']['directory_family_id'];
		
		// delete it in the DB - Files will be deleted with beforeDelete in the model
		if($this->DirectoryPicture->delete($id,false)) {
			
			$this->Session->setFlash('Your Picture has Deleted');
			$this->redirect(array('action' => 'view', $fid));
		} else {
			$this->Session->setFlash('Your Picture could not be deleted');
			$this->redirect(array('action' => 'view', $fid));			
		}
	}
	
	public function approve($id) {
		if(!$id) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		$picture = $this->DirectoryPicture->findById($id);
		
		if(!$picture) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
	
        $this->DirectoryPicture->id = $id;
        $this->DirectoryPicture->set('active', 1);
        
        if ($this->DirectoryPicture->save()) {
            $this->Session->setFlash(__('Your Picture has been activated.'));
            return $this->redirect(array('action' => 'view', $picture['DirectoryPicture']['directory_family_id']));
        }
        $this->Session->setFlash(__('Unable to approve the picture.'));	}
	
	public function emailpic($id) {
	
		if(!$id) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		$picture = $this->DirectoryPicture->findById($id);
		
		if(!$picture) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		/* SMTP Options */
		$Email = new CakeEmail('default');	
        
        $Email->template('approvepic');
        $Email->emailFormat('html');
        $Email->from(array('admin@ellingtonnazarene.org' => 'Ellington Nazarene'));
        $Email->to('michaelshann@gmail.com');
        $Email->subject('Approve EllingtonNazarene.org Picture');
		$Email->viewVars(array('picture' => $picture));

        $Email->send();
        $this->Session->setFlash(__('Your Picture has been submitted for approval', true));
        return $this->redirect(array('action' => 'view', $picture['DirectoryPicture']['directory_family_id']));
	}
	
	public function preview($id) {
		if(!$id) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		$picture = $this->DirectoryPicture->findById($id);
		
		if(!$picture) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		$this->set('picture',$picture);
		
	}

	public function edit($family_id = null) {
		if (!$family_id) {
            throw new NotFoundException(__('Invalid Family ID'));
        }

        $family = $this->DirectoryPicture->DirectoryFamily->findById($family_id);
        if (!$family) {
            throw new NotFoundException(__('Invalid Family ID'));
        }
		
		$this->set('family', $family);
		
		if($family_id == $this->Auth->user('directory_family_id') || $this->Auth->user('user_role_id') == 1) {
			$this->set('pictures', $this->DirectoryPicture->findAllByDirectoryFamilyId($family_id));
		} else {
			$this->set('pictures', $this->DirectoryPicture->findAllByDirectoryFamilyIdAndActive($family_id,TRUE));			
		} 
	}

	public function view($family_id = null) {
		if (!$family_id) {
            throw new NotFoundException(__('Invalid Family ID'));
        }

        $family = $this->DirectoryPicture->DirectoryFamily->findById($family_id);
        if (!$family) {
            throw new NotFoundException(__('Invalid Family ID'));
        }
        
        $this->set('family', $family);
        
        // Only Admin's can see inactive
        if($family_id == $this->Auth->user('directory_family_id') || $this->Auth->user('user_role_id') == 1) {
			$this->set('pictures', $this->DirectoryPicture->findAllByDirectoryFamilyId($family_id));
		} else {
			$this->set('pictures', $this->DirectoryPicture->findAllByDirectoryFamilyIdAndActive($family_id,TRUE));			
		} 
	}
	
	public function download($id) {
		if(!$id) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		$picture = $this->DirectoryPicture->findById($id);
		
		if(!$picture) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
		
		// to download the file
		$this->response->file(
		    'img/directory/pictures/' . $picture['DirectoryPicture']['image_name'],
		    array('download' => true, 'name' => $picture['AudioSermon']['image_name'])
		);
	    // Return response object to prevent controller from trying to render
	    // a view
	    return $this->response;
	}
	
	// MARK PHOTO AS INACTIVE
	public function remove($id) {
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    
		$picture = $this->DirectoryPicture->findById($id);
		
		if(!$picture) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
        
        // NOT ACTUALLY REMOVING JUST MARKING ACTIVE AS 0 - FALSE
        $this->DirectoryPicture->id = $id;
        $this->DirectoryPicture->set('active', 0);
		
	    if ($this->DirectoryPicture->save()) {
	        $this->Session->setFlash(__('Picture Has Been Removed'));
	        return $this->redirect(array('action' => 'view', $picture['DirectoryPicture']['directory_family_id']));
	    }	
	}
}