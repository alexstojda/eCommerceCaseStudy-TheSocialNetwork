<?php

	class _Group_Post extends Model
	{

		private $post_id;
		private $post_by;
		private $group_id;
		private $text;
		private $image_attachment;
		private $creation_date;
		
		public function __construct($tempID = 0){
			parent::__construct();
	 	}


		//Getters
		public function getPostID(){
		 	return $this->post_id;
		 }
		 public function getPostBy(){
		 	return $this->post_by;
		 }
		 public function getGroupID(){
		 	return $this->group_id;
		 }
		 public function getText(){
		 	return $this->text;
		 }
		 public function getImage(){
		 	return $this->image_attachment;
		 }
		 public function getCreationDate(){
		 	return $this->creation_date;
		 }

		 //Setters
		public function setPostBY($newThing){
			$this->post_by = $newThing;
		}
		public function setGroupID($newThing){
			$this->group_id = $newThing;
		}
		public function setText($newThing){
			$this->text = $newThing;
		}
		public function setImage($newThing){
			$this->image_attachment = $newThing;
		}
		public function setDate($newThing){
			$this->creation_date  = $newThing;
		}
	}

?>