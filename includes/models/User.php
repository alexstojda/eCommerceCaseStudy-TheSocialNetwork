<?php

class User extends Model
{
/*	public $fname;
	public $mname;
	public $lname;
	public $email;

	//small validation rules for $$this model
	public function isValid(){
		$email = filter_var($$this->email, FILTER_VALIDATE_EMAIL);
		$name = $$this->fname != '' && $$this->lname != '';
		return $name && $email;
	}*/
	private $username;
	private $userID;
	private $passwurd;
	private $email;
	private $fname;
	private $lname;
	private $phone;
	private $address;
	private $city;
	private $province;
	private $postalcode;
	private $birth;
	private $privacy;

//andrew did $this...i don't understand it. -Evan
	public function __construct($tempID = 0){
			parent::__construct();
	 }

//LOOK AT THE GETTERS
	 public function getUsername(){
	 	return $this->username;
	 }
	 public function getPasswurd(){
	 	return $this->passwurd;
	 }
	 public function getEmail(){
	 	return $this->email;
	 }
	 public function getFname(){
	 	return $this->fname;
	 }
	 public function getLname(){
	 	return $this->lname;
	 }
	 public function getPhone(){
	 	return $this->phone;
	 }
	 public function getAddress(){
	 	return $this->address;
	 }
	 public function getCity(){
	 	return $this->city;
	 }
	 public function getProvince(){
	 	return $this->province;
	 }
	 public function getPostalcode(){
	 	return $this->postalcode;
	 }
	 public function getBirth(){
	 	return $this->birth;
	 }
	 public function getPrivacy(){
	 	return $this->privacy;
	 }

	 /////////////setters
	 public function setPasswurd($newThing){
	 	$this->u_password = $newThing;
	 }
	 public function setEmail($newThings){
	 	$this->email = $newThings;
	 }
	 public function setFname($newThings){
	 	 $this->fname = $newThings;
	 }
	 public function setLname($newThings){
	 	 $this->lname = $newThings;
	 }
	 public function setPhone($newThings){
	 	 $this->phone = $newThings;
	 }
	 public function setAddress($newThings){
	 	 $this->address = $newThings;
	 }
	 public function setCity($newThings){
	 	 $this->city = $newThings;
	 }
	 public function setProvince($newThings){
	 	 $this->province = $newThings;
	 }
	 public function setPostalcode($newThings){
	 	 $this->postalcode = $newThings;
	 }
	 public function setBirth($newThings){
	 	 $this->birth = $newThings;
	 }
	 public function setPrivacy($newThings){
	 	 $this->privacy = $newThings;
	 }
}

?>