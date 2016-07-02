<?php

class DirectoryPicture extends AppModel {
	public $belongsTo = 'DirectoryFamily';
	
	public $uploadDir = 'img/directory/pictures';
	public $thumbDir =  'img/directory/pictures/thumbnails';
	public $squareDir =  'img/directory/pictures/square';
	
	public $validate = array(
		'image_name' => array(
			// http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::uploadError
			'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Something went wrong with the file upload',
				'required' => FALSE,
				'allowEmpty' => TRUE,
			),
			// http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::mimeType
			'mimeType' => array(
				'rule' => array('mimeType', array('image/gif','image/jpeg','image/png')),
				'message' => 'Invalid file, only jpeg/gif/png allowed',
				'required' => FALSE,
				'allowEmpty' => TRUE,
			),
			// custom callback to deal with the file upload
			'processUpload' => array(
				'rule' => 'processUpload',
				'message' => 'Something went wrong processing your file',
				'required' => FALSE,
				'allowEmpty' => TRUE,
				'last' => TRUE,
			)
		)
    );
    
    public function processUpload($check=array()) {
		// deal with uploaded file
		if (!empty($check['image_name']['tmp_name'])) {
	
			// check file is uploaded
			if (!is_uploaded_file($check['image_name']['tmp_name'])) {
				return FALSE;
			}
			
			$filename = Inflector::slug(pathinfo($check['image_name']['name'], 
				PATHINFO_FILENAME)).'.'.pathinfo($check['image_name']['name'],PATHINFO_EXTENSION);
			
			// build full filename
			$filepath = WWW_ROOT . $this->uploadDir . DS . $filename;
		
			$sqr_filepath = WWW_ROOT . $this->squareDir . DS . $filename;
		
			$thumb_filepath = WWW_ROOT . $this->thumbDir . DS . $filename;

		
			// @todo check for duplicate filename
	
			// try moving file
			if (!move_uploaded_file($check['image_name']['tmp_name'], $filepath)) {
				return FALSE;

			// file successfully uploaded
			} else {
				// save the file path relative from WWW_ROOT e.g. uploads/example_filename.jpg
				$this->data[$this->alias]['image_name'] = $filename;
			
				try {
					// create thumbnail and square of image
					$square = new Imagick($filepath);
					$square->cropThumbnailImage(240,240);
					$square->writeImage($sqr_filepath);
					
					$thumb = new Imagick($filepath);
					$thumb->thumbnailImage(320,320,true);
					$thumb->writeImage($thumb_filepath);
				} catch (ImagickException $ie) {
					return FALSE;
				}
			}
		}
	
		return TRUE;
	}
    
    public function beforeDelete($cascade = true) {

		$picture = $this->findById($this->id);
		
		// build full filename
		$filename = WWW_ROOT . $this->uploadDir . DS . Inflector::slug(pathinfo($picture[$this->alias]['image_name'], 
			PATHINFO_FILENAME)).'.'.pathinfo($picture[$this->alias]['image_name'],PATHINFO_EXTENSION);
	
		$sqr_filename = WWW_ROOT . $this->squareDir . DS . Inflector::slug(pathinfo($picture[$this->alias]['image_name'], 
			PATHINFO_FILENAME)).'.'.pathinfo($picture[$this->alias]['image_name'],PATHINFO_EXTENSION);
	
		$thumb_filename = WWW_ROOT . $this->thumbDir . DS . Inflector::slug(pathinfo($picture[$this->alias]['image_name'], 
			PATHINFO_FILENAME)).'.'.pathinfo($picture[$this->alias]['image_name'],PATHINFO_EXTENSION);
    
    
	    $original = new File($filename);
		$square = new File($sqr_filename);
		$thumb = new File($thumb_filename);
			
	    if(!$original->delete() || !$square->delete() || !$thumb->delete()) {
		    return false;
	    }
	    
		return true;
    }
    
    public function beforeSave($options = array()) {
		// a file has been uploaded so grab the filepath
		if (!empty($this->data[$this->alias]['image_name']['name'])) {
			$this->data[$this->alias]['image_name'] = $this->data[$this->alias]['image_name']['name'];
		}
			
		return parent::beforeSave($options);
	}
    
}