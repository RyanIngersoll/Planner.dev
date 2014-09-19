<?php
// STORE THE CLASS ADDRESSDATASTORE{} for inclusion later.
class AddressDataStore {
    public $error;
     public $filename = CSVFILE;
     public $friday = '';
     public function __construct($filename) {
       $this->filename = $filename;


       if($filename == 'text/csv'){
            $error = TRUE;
        }
        if($filename != 'text/csv'){
            $error = FALSE;
        }
    }

    public function __destruct() {
        echo "good bye friday!!!";
        //return $error;
    }

   
   
   // creates new empty array then converts CSV file into multi-dimensional array $newaddressbook

     function readCsvFile() {
        $newaddressbook = [];
        $handle = fopen($this->filename, 'r');
        //errorMessage();
//!feof = while not at the end of file for the pointer $handle, do the following things".
        while (!feof($handle)) {
            $row = fgetcsv($handle);
 //take each row from the $handle and if its not empty create a new array value called $row           
            if (!empty($row)){
                    $newaddressbook[] = $row;
                }

            }
        fclose($handle);
        return $newaddressbook;
            // Code to read file $this->filename
        }

// opens files and stores it into $handle and converts to CSV data stored in seperate fields. 

     function writeToFile($addressbook) {
         $handle = fopen($this->filename, 'w');
            foreach ($addressbook as $fields) {
                fputcsv($handle, $fields);
                //errorMessage();
            }

        fclose($handle);
       
     }

 }
 ?>