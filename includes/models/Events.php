<?php
class Events extends Model
{
	private $eventID;
	private $owner_id;
	private $e_name;
	private $description;
	private $start;
	private $end;
	private $visibility;

	public function __construct($tempID = 0){
			parent::__construct();
	}

	//Getters
	public function getEventID(){
	 	return this->eventID;
	 }

	 public function getOwner(){
	 	return this->owner_id;
	 }

	 public function getName(){
	 	return this->e_name;
	 }

	 public function getDescription(){
	 	return this->description;
	 }

	 public function getStart(){
	 	return this->start;
	 }

	 public function getEnd(){
	 	return this->end;
	 }

	 public function getVisibility(){
	 	return this->visibility;
	 }

	 
	 //SETTERS
	 public function setName($newThing){
	 	this->e_name = $newThing;
	}
	public function setDescription($newThing){
	 	this->description = $newThing;
	}
	public function setStart($newThing){
	 	this->start = $newThing;
	}
	public function setEnd($newThing){
	 	this->end = $newThing;
	}
	public function setVisibility($newThing){
	 	this->visibility = $newThing;
	}
	
}

?>