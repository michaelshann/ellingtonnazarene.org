<?php
// app/Controller/UsersController.php
class AudioSermonsController extends AppController {
	var $components=array("Email","Session");
	var $helpers=array("Html","Form","Session","Time");
	
	public function isAuthorized($user) {
	    return parent::isAuthorized($user);
	}
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('stream','download','index','listen');
	}
	
//	public $paginate = array(
//        'limit' => 10,
//        'order' => array(
//            'AudioSermon.created' => 'desc'
//        )
//    );

	public function stream($id) {
		$audio_sermon = $this->AudioSermon->findById($id);
		
		// to stream the file
		$this->response->file($audio_sermon['AudioSermon']['filename']); 
		
	    // Return response object to prevent controller from trying to render
	    // a view
	   // $this->response->sharable(true, 3600);
	    $this->response->type("audio/mpeg");
	    $this->response->disableCache();
	    return $this->response;
	}
	
	public function listen($id) {
		if (!$id) {
	        throw new NotFoundException(__('Invalid Audio Sermon'));
	    }
	    
	    $as = $this->AudioSermon->findById($id);
	    if (!$as) {
	        throw new NotFoundException(__('Invalid Audio Sermon'));
	    }
		$this->set('sermon', $as);
	}

	public function download($id) {
		$audio_sermon = $this->AudioSermon->findById($id);
		
		// to download the file
		$this->response->file(
		    $audio_sermon['AudioSermon']['filename'],
		    array('download' => true, 'name' => $audio_sermon['AudioSermon']['title'])
		);
	    // Return response object to prevent controller from trying to render
	    // a view
	    return $this->response;
	}

	public function index() {
		//$this->Paginator->settings = $this->paginate;
		
		//$sermons = $this->Paginator->paginate('AudioSermon');
		$sermons = $this->AudioSermon->find('all',array('order' => 'date DESC'));
		$this->set('sermons', $sermons);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->AudioSermon->create();
			if ($this->AudioSermon->save($this->request->data)) {
				$this->Session->setFlash('Your Audio Sermon has been submitted');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function edit($id)
    {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid Audio Sermon'));
	    }
	    
	    $as = $this->AudioSermon->findById($id);
	    if (!$as) {
	        throw new NotFoundException(__('Invalid Audio Sermon'));
	    }
	
	    if ($this->request->is('post') || $this->request->is('put')) {
	        $this->AudioSermon->id = $id;
	        if ($this->AudioSermon->save($this->request->data)) {
	            $this->Session->setFlash(__('Your Audio Sermon has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your Audio Sermon.'));
	    }
	
	    if (!$this->request->data) {
	        $this->request->data = $as;
	    }
    }
	
}
