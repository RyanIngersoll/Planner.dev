<?php

// CLASS DEFINITION FOR INDIVIDUAL AD OBJECTS
class Ad {
    public $title = '';
    public $body = '';
    public $listDate = '';
    public $username = '';
    public $email = '';
    public $img = '';
    
    public function __construct($title, $body, $listDate, $username, $email, $img) {
        $this->title = $title;
        $this->body = $body;
        $this->listDate = $listDate;
        $this->username = $username;
        $this->email = $email;
        $this->img = $img;
    }
    // METHOD TO RETURN AD OBJECT AS AN ARRAY
    public function adArray() {
        return [$this->title, $this->body, $this->listDate, $this->username, $this->email, $this->img];
    }
}