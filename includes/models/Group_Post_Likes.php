<?php

	class Group_Post_Likes extends Model
	{

		private $post_id;
		private $post_by;
		private $group_id;

		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters
		public function getPostID(){
		 	return this->post_id;
		 }
		 public function getPostBy(){
		 	return this->post_by;
		 }
		 public function getGroupID(){
		 	return this->group_id;
		 }
		

		 //Setters
		public function setPostBY($newThing){
			this->post_by = $newThing;
		}
		public function setGroupID($newThing){
			this->group_id = $newThing;
		}

	}

?>