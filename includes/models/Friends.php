<?php

	class Friends extends Model
	{

		private $user_a;
		private $user_b;
		private $dateAccepted;
		
		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters
		public function getUA(){
		 	return $this->user_a;
		 }
		 public function getUB(){
		 	return $this->user_b;
		 }
		 public function getAcceptance(){
		 	return $this->dateAccepted;
		 }

		 //Setters

		 public function setAcceptance($newThing){
			$this->dateAccepted = $newThing;
		}
	}

?>