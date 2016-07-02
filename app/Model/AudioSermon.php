<?php

class AudioSermon extends AppModel {

	public $uploadDir = 'files/audio_sermons';
	
	public $validate = array(
		'filename' => array(
			// http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::uploadError
			'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Something went wrong with the file upload',
				'required' => FALSE,
				'allowEmpty' => TRUE,
			),
			// http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::mimeType
			'mimeType' => array(
				'rule' => array('mimeType', array('audio/mp4','audio/mpeg','audio/vnd.wave','audio/ogg','audio/basic','audio/webm')),
				'message' => 'Invalid file, only audio allowed',
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
	
	/**
	 * Process the Upload
	 * @param array $check
	 * @return boolean
	 */
	public function processUpload($check=array()) {
		// deal with uploaded file
		if (!empty($check['filename']['tmp_name'])) {
	
			// check file is uploaded
			if (!is_uploaded_file($check['filename']['tmp_name'])) {
				return FALSE;
			}
	
			// build full filename
			$filename = WWW_ROOT . $this->uploadDir . DS . Inflector::slug(pathinfo($check['filename']['name'], 
				PATHINFO_FILENAME)).'.'.pathinfo($check['filename']['name'], PATHINFO_EXTENSION);
		
			// @todo check for duplicate filename
	
			// try moving file
			if (!move_uploaded_file($check['filename']['tmp_name'], $filename)) {
				return FALSE;
	
			// file successfully uploaded
			} else {
				// save the file path relative from WWW_ROOT e.g. uploads/example_filename.jpg
				$this->data[$this->alias]['filepath'] = str_replace(DS, "/", str_replace(WWW_ROOT, "", $filename) );
			}
		}
	
		return TRUE;
	}
	
	/**
	 * Before Save Callback
	 * @param array $options
	 * @return boolean
	 */
	public function beforeSave($options = array()) {
		// a file has been uploaded so grab the filepath
		if (!empty($this->data[$this->alias]['filepath'])) {
			$this->data[$this->alias]['filename'] = $this->data[$this->alias]['filepath'];
		}
			
		return parent::beforeSave($options);
	}

}