<?php

class User extends Model
{
/*	public $fname;
	public $mname;
	public $lname;
	public $email;

	//small validation rules for this model
	public function isValid(){
		$email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
		$name = $this->fname != '' && $this->lname != '';
		return $name && $email;
	}*/
	private $username;
	private $userID;
	private $u_password;
	private $u_email;
	private $fname;
	private $lname;
	private $phone;
	private $address;
	private $city;
	private $province;
	private $postalcode;
	private $birth;
	private $privacy;

	public function isFriend($frdID = 0)
	{

		//make sql code that returns results of created_date where id_a == this->userID 
		//and id_b == $frdID. If returns a date. return true. 
		//else 
		//repeat process but reverse id's a and b. and try again. if not found return false;
		$value = "SELECT created_date FROM friends WHERE id_a = $userID AND id_b = $frdID";
		if($value != null)
			return true;

		$value = "SELECT created_date FROM friends WHERE id_b = $userID AND id_a = $frdID";
		if($value != null)
			return true;

		return false;

	}
//andrew did this...i don't understand it. -Evan
	public function __construct($tempID = 0){
			parent::__construct();
	 }


//LOOK AT THE GETTERS
	 public function getUsername(){
	 	return this->username;
	 }
	 public function getPasswurd(){
	 	return this->u_password;
	 }

	 public function getEmail(){
	 	return this->email;
	 }
	 public function getFname(){
	 	return this->fname;
	 }
	 public function getLname(){
	 	return this->lname;
	 }
	 public function getPhone(){
	 	return this->phone;
	 }
	 public function getAddress(){
	 	return this->address;
	 }
	 public function getCity(){
	 	return this->city;
	 }
	 public function getProvince(){
	 	return this->province;
	 }
	 public function getPostalcode(){
	 	return this->postalcode;
	 }
	 public function getBirth(){
	 	return this->birth;
	 }
	 public function getPrivacy(){
	 	return this->privacy;
	 }

	 /////////////setters
	 public function setPasswurd($newThing){
	 	this->u_password = $newThing;
	 }

	 public function getEmail($newThings){
	 	this->email = $newThings;
	 }
	 public function getFname($newThings){
	 	 this->fname = $newThings;
	 }
	 public function getLname($newThings){
	 	 this->lname = $newThings;
	 }
	 public function getPhone($newThings){
	 	 this->phone = $newThings;
	 }
	 public function getAddress($newThings){
	 	 this->address = $newThings;
	 }
	 public function getCity($newThings){
	 	 this->city = $newThings;
	 }
	 public function getProvince($newThings){
	 	 this->province = $newThings;
	 }
	 public function getPostalcode($newThings){
	 	 this->postalcode = $newThings;
	 }
	 public function getBirth($newThings){
	 	 this->birth = $newThings;
	 }
	 public function getPrivacy($newThings){
	 	 this->privacy = $newThings;
	 }
}

?>