<?php

//User.class.php

require_once 'DB.php';


class Comment {

	public $comment_id;
	public $rating;
	public $text;
	public $Date;
    public $is_deleted;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->comment_id = (isset($data['comment_id'])) ? $data['comment_id'] : "";
		$this->rating = (isset($data['rating'])) ? $data['rating'] : "";
		$this->text = (isset($data['text'])) ? $data['text'] : "";
		$this->Date = (isset($data['Date'])) ? $data['Date'] : "";
        $this->is_deleted = (isset($data['is_deleted'])) ? $data['is_deleted'] : "";
	}

	public function save($isNewComment = false) {
		//create a new database object.
		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			$data = array(
				"comment_id" => "'$this->comment_id'",
				"rating" => "'$this->rating'",
				"password" => "'$this->password'"
			);
			
			//update the row in the database
			$db->update($data, 'users', 'id = '.$this->id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
				"username" => "'$this->username'",
				"password" => "'$this->hashedPassword'",
				"rating" => "'$this->rating'",
				"join_date" => "'".date("Y-m-d H:i:s",time())."'"
			);
			
			$this->id = $db->insert($data, 'users');
			$this->joinDate = time();
		}
		return true;
	}
	
}

?>