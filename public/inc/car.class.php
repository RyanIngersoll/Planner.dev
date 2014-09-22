<?php

class Car {
	public $make;
	public $model;
	public $doors;

	public function __construct($make, $model, $doors){
	$this->make = $make;
	$this->model = $model;
	$this->doors = $doors;
	}


	$taurus = new Car('ford', 'taurus', 4)
}