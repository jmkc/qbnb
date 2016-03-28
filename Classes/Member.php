<?php

//User.class.php

require_once 'Database.php';
require_once 'Booking.php';


class Member
{

	public $member_id;
	public $email;
	public $password;
	public $FName;
	public $LName;
    public $year;
    public $faculty;
    public $degree;
    public $is_admin;
    public $is_deleted;
	public $bookings;
	public $properties;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->member_id = (isset($data['member_id'])) ? $data['member_id'] : "";
		$this->email = (isset($data['email'])) ? $data['email'] : "";
		$this->password = (isset($data['password'])) ? $data['password'] : "";
		$this->FName = (isset($data['FName'])) ? $data['FName'] : "";
		$this->LName = (isset($data['LName'])) ? $data['LName'] : "";
        $this->year = (isset($data['year'])) ? $data['year'] : "";
        $this->faculty = (isset($data['faculty'])) ? $data['faculty'] : "";
        $this->degree = (isset($data['degree'])) ? $data['degree'] : "";
        $this->is_admin = 0;
        $this->is_deleted = 0;
		$this->bookings = []; // declare empty array
		$this->properties = [];
	}
	
	// Gets all bookings for this user and refreshes the instance property
	public function getAllBookings(){
		$db = new Database();
		$array = $db->select('booking','booking_member_id='.$this->member_id);
		$this->bookings = [];
		foreach ($array as $booking_data){
			$booking = new Booking($array);
			array_push($this->bookings, $booking);
		}
		return $this->bookings;
	}
	
	// Gets all properties for this user and refreshes the instance property
	public function getAllProperties(){
		$db = new Database();
		$array = $db->select('properties','owner_id='.$this->member_id);
		$this->properties = [];
		foreach ($array as $property_data){
			$property = new Property($array);
			array_push($this->properties, $property);
		}
		return $this->properties;
	}
	
	

	public function save($isNewUser = false) {
		//create a new database object.
		$db = new Database();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			$data = array(
				"password" => $this->password,
                "FName" => $this->FName,
                "LName" => $this->LName,
                "year" => $this->year,
                "faculty" => $this->faculty,
                "degree" => $this->degree,
                "is_admin" => $this->is_admin,
                "is_deleted" => $this->is_deleted
			);
			
			//update the row in the database
			$db->update($data, 'Member', 'member_id = '.$this->member_id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
				"email" => $this->email,
				"password" => $this->password,
				"FName" => $this->FName,
                "LName" => $this->LName,
                "year" => $this->year,
                "faculty" => $this->faculty,
                "degree" => $this->degree,
                "is_admin" => $this->is_admin,
                "is_deleted" => $this->is_deleted
			);
			
			$db->insert($data, 'Member');
		}
		return true;
	}
	
	
	
}

?>