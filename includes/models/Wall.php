<?php

class _Wall extends Model
{
	private $user;
	private $posts;
	private $friends;
	private $name;

    public function init($uid) {
        $this->setUser($this->wallUser);
        $this->setName($this->wallUser->getName());
    }

	//Getters
	public function getUser(){
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
	public function setUser($user){
		$this->user = $user;
	}
	public function setFriends($user){
		/*
        Get friends from database
        */
	}
	public function setPosts($user){
		/*
        Get posts from database
        */
	}
	public function setName($name){
        $this->name = $name;

	}

}