<?php

//Bookings.php

require_once 'Database.php';


class Booking {

	public $booking_id;
	public $status;
	public $start_date;
	public $is_deleted;
	public $booking_member_id;
	public $property_id;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->booking_id = (isset($data['booking_id'])) ? $data['booking_id'] : "";
		$this->status = 'Unconfirmed';
		$this->start_date = (isset($data['start_date'])) ? $data['start_date'] : "";
		$this->is_deleted = 0;
		$this->booking_member_id = (isset($data['booking_member_id'])) ? $data['booking_member_id'] : "";
		$this->property_id = (isset($data['property_id'])) ? $data['property_id'] : "";
	}
	
	// Alters the booking status to newStatus and stores changes in database
	public function alterBooking($newStatus){
		$db = new Database();
		$this->status= $newStatus;
		$data = array(
			"status" => "'$this->status'");
		);
		$db->update($data, 'Booking', 'booking_id = '.$this->booking_id);
	}

	
	public function save() {
		//create a new database object.
		$db = new Database();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewBooking) {
			//set the data array
			$data = array(
				"start_date" => "'$this->start_date'",
				"status" => "'$this->status'",
				"start_date" => "'$this->start_date'",
				"is_deleted" => "'$this->is_deleted'",
				"booking_member_id" => "'$this->booking_member_id'",
				"property_id" => "'$this->property_id'"
			);
			
			//update the row in the database
			$db->update($data, 'Booking', 'booking_id = '.$this->booking_id);
		}else {
		//if the booking is being registered for the first time.
			$data = array(
				"start_date" => "'$this->start_date'",
				"status" => "'$this->status'",
				"start_date" => "'$this->start_date'",
				"is_deleted" => "'$this->is_deleted'",
				"booking_member_id" => "'$this->booking_member_id'",
				"property_id" => "'$this->property_id'"
			);
			
			$db->insert($data, 'booking');
		}
		return true;
	}
	
}

?>