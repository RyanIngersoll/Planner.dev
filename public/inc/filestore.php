<?php

//It is nice that the Filestore class can read and write to both regular text files and CSV files, however, it is cumbersome to have 2 methods for each type. Using substr() you can read the last 3 characters of a $filename and guess if it is text or CSV. Add a property to your Filestore class that is a boolean named $is_csv. Update the constructor to set this value to TRUE or FALSE based on the file's extension.

 class Filestore {

     public $filename = '';
     private $is_csv = FALSE;


     function __construct($filename = '') {
          $this->filename = $filename;
          if(substr($this->filename, -3) == 'csv') {
            $this->is_csv = TRUE;

          }
     }
     function chkNumChar($items) {
    // Check if $name is a string
    if (empty($items) || (strlen($items) >= 240)) {
        throw new Exception('todo item must be less than 240 char');
    }

}

      public function read(){
      if ($this->is_csv == TRUE){
        return $this->read_csv();
      }
      else{
        return $this->read_lines();
      }
     }

     public function write($array){
      if($this->is_csv == TRUE){
        return $this->write_csv($array);
      }
      else{
        return $this->write_lines($array);
      }

     }

     /**
      * Returns array of lines in $this->filename
      */
     private function read_lines() {
            $contents_array = [];
            //.txt files
        if (filesize($this->filename) > 0) {
            $handle = fopen($this->filename, "r");
            $contents = trim(fread($handle, filesize($this->filename)));
            $contents_array = explode("\n", $contents); 
            fclose($handle);
        }
        return $contents_array;   
         }

     /**
      * Writes each element in $array to a new line in $this->filename
      */
     private function write_lines($array) {
        $handle = fopen($this->filename, 'w');

          foreach ($array as $line) {
              fwrite($handle, $line . PHP_EOL);
              
          }

        fclose($handle);
     }

     /**
      * Reads contents of csv $this->filename, returns an array
      */
     private function read_csv() {
        $csvRow = [];

        $handle = fopen($this->filename, 'r');
        //errorMessage();
        //!feof = while not at the end of file for the pointer $handle, do the following things".

        while (!feof($handle)) {
            $row = fgetcsv($handle);
        //take each row from the $handle and if its not empty create a new array value called $row           
            if (!empty($row)){
                    $csvRow[] = $row;
                }

            }

        fclose($handle);
        return $csvRow;
            // Code to read file $this->filename

     }

     /**
      * Writes contents of $array to csv $this->filename
      */
     private function write_csv($array) {
          $handle = fopen($this->filename, 'w');

          foreach ($array as $row) {
              fputcsv($handle, $row);
          }

        fclose($handle);

     }

 }
