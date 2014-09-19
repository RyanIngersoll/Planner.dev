<?php
// STORE THE CLASS ADDRESSDATASTORE{} for inclusion later.
class AddressDataStore {
    public $error;
     public $filename = CSVFILE;

     public function __construct($filename) {
       $this->filename = $filename;


       if($filename == 'text/csv'){
            $error = TRUE;
        }
        if($filename != 'text/csv'){
            $error = FALSE;
        }
    }
   
   // creates new empty array then converts CSV file into multi-dimensional array $newAdBook

     function readCsvFile() {
        $newAdBook = [];
        $handle = fopen($this->filename, 'r');
        //errorMessage();
//!feof = while not at the end of file for the pointer $handle, do the following things".
        while (!feof($handle)) {
            $row = fgetcsv($handle);
 //take each row from the $handle and if its not empty create a new array value called $row           
            if (!empty($row)){
                    $newAdBook[] = $row;
                }

            }
        fclose($handle);
        return $newAdBook;
            // Code to read file $this->filename
        }

// opens files and stores it into $handle and converts to CSV data stored in seperate fields. 

     function writeToFile($adBook) {
         $handle = fopen($this->filename, 'w');
            foreach ($adBook as $fields) {
                fputcsv($handle, $fields);
                //errorMessage();
            }

        fclose($handle);
       
     }

 }
 ?>