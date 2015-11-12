<?php

	class Post_Likes extends Model
	{

		private $post_id;
		private $post_by;
		private $responce;

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
		 	return this->responce;
		 }
		

		 //Setters
		public function setPostBY($newThing){
			this->post_by = $newThing;
		}
		public function setGroupID($newThing){
			this->responce = $newThing;
		}

	}

?>