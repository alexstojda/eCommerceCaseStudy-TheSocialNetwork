<?php

	class Wall extends Model
	{

		private $user;
		private $posts;
		private $friends;
		


		//Getters
		public function getUId(){
		 	return $this->user;
		 }
		 public function getUPosts(){
		 	return $this->posts;
		 }
		 public function getUFriends(){
		 	return $this->friends;
		 }

		 //Setters
		 public function setID($userID){

		 	$this->user = $userID;
		 }
		 public function setFriends($userID){
			/*
			Get friends from database
			*/
		}

		 public function setPosts($userID){
			/*
			Get posts from database
			*/
		}
	}

?>