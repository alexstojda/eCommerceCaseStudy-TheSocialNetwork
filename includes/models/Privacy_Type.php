<?php

	class Privacy_Type extends Model
	{

		private $privacy_id;
		private $descr;

		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters

		 public function getPrivacyID(){
		 	return this->privacy_id;
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