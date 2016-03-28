<?php

//Bookings.php

require_once 'Database.php';



class Comment {

	public $comment_id;
	public $rating;
	public $text;
	public $Date;
    public $is_deleted;
    public $commenting_member_id;
    public $property_id;
	//Constructor is called whenever a new object is created.
	//Takes an associative array with the Database row as an argument.
	function __construct($data) {
		$this->comment_id = (isset($data['comment_id'])) ? $data['comment_id'] : "";
		$this->rating = (isset($data['rating'])) ? $data['rating'] : "";
		$this->text = (isset($data['text'])) ? $data['text'] : "";
		$this->property_id = (isset($data['property_id'])) ? $data['property_id'] : "";
		$this->commenting_member_id = (isset($data['commenting_member_id'])) ? $data['commenting_member_id'] : "";
		$this->Date = 0000-00-00;
        $this->is_deleted = 0;
	}
	
	public function save($isNewComment = false) {
		//create a new Database object.
		$Database = new Database();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewComment) {
			//set the data array
			$data = array(
				"rating" => $this->rating,
                "text" => $this->text,
				"is_deleted" => $this->is_deleted,
				"Date" => $this->Date,
				"commenting_member_id" => $this->commenting_member_id,
				"property_id" => $this->property_id
			);
			
			//update the row in the Database
			$Database->update($data, 'Booking', 'booking_id = '.$this->booking_id);
		}else {
		//if the booking is being registered for the first time.
			$data = array(
				"rating" => $this->rating,
                "text" => $this->text,
				"is_deleted" => $this->is_deleted,
				"Date" => $this->Date,
				"commenting_member_id" => $this->commenting_member_id,
				"property_id" => $this->property_id
			);
			$Database->insert($data, 'Comment');
		}
		return true;
	}
	
}

?>