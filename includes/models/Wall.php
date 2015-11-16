<?php

	class _Wall extends Model
	{

		private $user;
		private $posts;
		private $friends;
		private $name;

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
		 public function getName(){
		 	return $this->name;
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
		 public function setName($userID){

		 	$this->name = $this->db->select("SELECT CONCAT(first_name, ' ', last_name) as 'name' FROM users WHERE user_id = :uid",  array(
            ':uid' => $userID))[0];
		 }

		 public function init($userID) {
		 	self::setID($userID);
		 	self::setName($userID);
		 }
	}

?>