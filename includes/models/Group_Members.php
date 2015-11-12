<?php

	class Group_members extends Model
	{

		private $user_id;
		private $group_id;
		private $user_status;
		
		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters
		public function getUserID(){
		 	return this->user_id;
		 }
		 public function getGroupID(){
		 	return this->group_id;
		 }
		 public function getUser_status(){
		 	return this->user_status;
		 }

		 //Setters
		 public function setStatus($newThing){
			this->user_status = $newThing;
		}
	}

?>