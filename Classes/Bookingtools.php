<?php
//UserTools.class.php


require_once 'Database.php';
require_once 'Booking.php';

class Bookingtools
{

	//get a booking
	//returns a Booking object. Takes the booking id as an input
	public function get($booking_id)
	{
		$db = new Database();
		$result = $db->select('Booking', "booking_id = $booking_id");

		return new Booking($result);
	}
	
}

?>