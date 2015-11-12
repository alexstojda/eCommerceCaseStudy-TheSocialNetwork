<?php

	class Event_invites extends Model
	{

		private $event_id;
		private $user_id;
		private $status;
		
		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters
		public function getEventID(){
		 	return this->eventID;
		 }
		 public function getUser(){
		 	return this->user_id;
		 }
		 public function getStatus(){
		 	return this->status;
		 }

		 //Setters

		 public function setStatus($newThing){
			this->status = $newThing;
		}
	}

?>