<?php

	class _Groups extends Model
	{

		private $group_id;
		private $name;
		private $privacy;
		private $description;
		
		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters
		public function getGroup_id(){
		 	return $$this->group_id;
		 }
		 public function getName(){
		 	return $this->name;
		 }
		 public function getPrivacy(){
		 	return $this->privacy;
		 }
		 public function getDescription(){
		 	return $this->description;
		 }

		 //Setters

		public function setName($newThing){
			$this->name = $newThing;
		}
		public function setPrivacy($newThing){
			$this->privacy = $newThing;
		}
		public function setDescription($newThing){
			$this->description = $newThing;
		}
	}

?>