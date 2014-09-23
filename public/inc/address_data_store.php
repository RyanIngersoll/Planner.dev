<?php

require_once 'filestore.php';


 class AddressDataStore extends Filestore {

 	function __construct($filename = '') {
         parent::__construct(strtolower($filename));
     }


     function read_address_book() {
         $addressbook = $this->read();
         return $addressbook;
     }

     function write_address_book($addresses_array) {
         $this->write($addresses_array);
     }

     function chkNumChar($post) {
	    foreach ($post as $item) {
	    	if (empty($item) || (strlen($item) > 125)) {
	        	throw new Exception('todo item must be less than 126 char');
	    	}
		}
	}
}


 ?>