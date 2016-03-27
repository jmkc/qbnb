<?php

//User.class.php

require_once 'DB.php';


class User {

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
        $this->is_admin = 0;
        $this->is_deleted = 0;
	}

	public function save($isNewUser = false) {
		//create a new database object.
		$db = new DB();
		
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
			$db->update($data, 'Member', 'member_id = '.$this->member_id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
				"email" => "'$this->email'",
				"password" => "'$this->password'",
				"FName" => "'this->FName'",
                "LName" => "'this->LName'",
                "year" => "'this->year'",
                "faculty" => "'this->faculty'",
                "degree" => "'this->degree'",
                "is_admin" => "'this->is_admin'",
                "is_deleted" => "'this->is_deleted'"
			);
			
			$this->member_id = $db->insert($data, 'Member');
		}
		return true;
	}
	
}

?>