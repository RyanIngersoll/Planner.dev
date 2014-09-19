<?php
 
class Ad {
    public $image = '';
	public $title = '';
	public $body = '';
	public $contactName = '';
	public $contactEmail = '';
	public $createdAt = '';
 
    public function __construct($image, $title, $body, $contactName, $contactEmail, $createdAt)

    {   $this->image = $image;
        $this->title = $title;
        $this->body = $body;
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->createdAt = $createdAt;
    }
 
    public function toArray()
    {
    	return [$this->image, $this->title, $this->body, $this->contactName, $this->contactEmail, $this->createdAt];
    }
}