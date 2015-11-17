<?php

class _Post extends Model
{
	
	private $post_id;
	private $post_by;
	private $post_to;
	private $post_text;
	private $post_image;
	private $date;
	private $privacy;
	
		public function __construct($tempID = 0){
			parent::__construct();
	 	}

	//GETTERS
	public function getPostID(){
	 	return $$this->post_id;
	 }

	 public function getPost_by(){
	 	return $this->post_by;
	 }

	public function getPost_To(){
	 	return $this->post_to;
	 }

	public function getPostText(){
	 	return $this->post_text;
	 }

	public function getPostImage(){
	 	return $this->post_image;
	 }

	public function getDate(){
	 	return $this->date;
	 }

	public function getPrivacy(){
	 	return $this->privacy;
	 }


	//SETTERS
	public function setPostText($newThing){
	 	$this->post_text = $newThing;
	}

	public function setPrivacy($newThing){
	 	$this->privacy = $newThing;
	}

	public function setImage($newThing){
	 	$this->post_image = $newThing;
	}

}
