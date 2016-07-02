<?php
class DirectoryHomesController extends AppController {
	var $components=array("Email","Session");
	var $helpers=array("Html","Form","Session");

    public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('index');
	}

	public function index() {
		$this->set('homes', $this->DirectoryHome->find('all'));
	}
}