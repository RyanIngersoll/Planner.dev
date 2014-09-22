<?php

require_once 'filestore.php';


 class AddressDataStore extends Filestore {

 	function __construct($filename = '') {
         parent::__construct(strtolower($filename));
     }


     function read_address_book() {
         $addressbook = $this->read_csv();
         return $addressbook;
     }

     function write_address_book($addresses_array) {
         $this->write_csv($addresses_array);
     }

 }


 ?>