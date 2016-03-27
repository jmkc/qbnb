<?php

//Bookings.php

require_once 'Database.php';


class Booking {

	public $booking_id;
	public $status;
	public $start_date;
	public $is_deleted;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->booking_id = (isset($data['booking_id'])) ? $data['booking_id'] : "";
		$this->status = 'Unconfirmed';
		$this->start_date = (isset($data['start_date'])) ? $data['start_date'] : "";
		$this->is_deleted = 0;
	}

	public function save($isNewBooking = false) {
		//create a new database object.
		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewBooking) {
			//set the data array
			$data = array(
				"start_date" => "'$this->start_date'"
			);
			
			//update the row in the database
			$db->update($data, 'Booking', 'booking_id = '.$this->booking_id);
		}else {
		//if the booking is being registered for the first time.
			$data = array(
				"status" => $this->status,
				"start_date" => $this->start_date,
				"is_deleted" => $this->is_deleted
			);
			
			$db->insert($data, 'Booking');
		}
		return true;
	}
	
}

?>