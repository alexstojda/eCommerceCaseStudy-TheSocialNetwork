<?php

	class Response_Type extends Model
	{

		private $responce_id;
		private $descr;

		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters

		 public function getResponceID(){
		 	return this->responce_id;
		 }
		 public function getDescription(){
		 	return this->descr;
		 }
		

		 //Setters
		public function setDescription($newThing){
			this->descr = $newThing;
		}

	}

?>