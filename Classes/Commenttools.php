<?php
//UserTools.class.php


require_once 'Database.php';
require_once 'Commenttools.php';

class Commenttools
{

	//get a booking
	//returns a Booking object. Takes the booking id as an input
	public function get($comment_id)
	{
		$db = new Database();
		$result = $db->select('Comment', "comment_id = $comment_id");

		return new Comment($result);
	}
	
}

?>