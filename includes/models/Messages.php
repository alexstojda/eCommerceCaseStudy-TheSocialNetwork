<?php

	class Messages extends Model
	{

		private $message_id;
		private $from;
		private $to;
		private $message;
		//no time sent?
//		private $creation_date;
		
		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters
		public function getMessage_id(){
		 	return this->message;
		 }
		 public function getFrom_id(){
		 	return this->from;
		 }
		 public function getTo_id(){
		 	return this->to;
		 }
		 public function getMessage(){
		 	return this->message;
		 }
	/*	 public function getDate(){
		 	return this->creation_date;
		 }*/
		 
		 //Setters
		public function setToID($newThing){
			this->to = $newThing;
		}
		public function setFromID($newThing){
			this->from = $newThing;
		}
		public function setMessage($newThing){
			this->message = $newThing;
		}
	/*	public function setDate($newThing){
			this->creation_date  = $newThing;
		}*/
	}

?>