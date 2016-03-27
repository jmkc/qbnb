<?php

//User.class.php

require_once 'Database.php';


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
        $this->is_admin = (isset($data['is_admin'])) ? $data['is_admin'] : "";
        $this->is_deleted = (isset($data['is_deleted'])) ? $data['is_deleted'] : "";
	}

	public function save($isNewUser = false) {
		//create a new database object.
		$db = new Database();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			$data = array(
				"member_id" => "'$this->member_id'",
				"email" => "'$this->email'",
				"password" => "'$this->password'"
			);
			
			//update the row in the database
			$db->update($data, 'users', 'id = '.$this->id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
				"username" => "'$this->username'",
				"password" => "'$this->hashedPassword'",
				"email" => "'$this->email'",
				"join_date" => "'".date("Y-m-d H:i:s",time())."'"
			);
			
			$this->id = $db->insert($data, 'users');
			$this->joinDate = time();
		}
		return true;
	}
	
}

?>