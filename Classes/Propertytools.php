<?php
//UserTools.class.php

require_once 'Property.php';
require_once 'Database.php';

class Propertytools
{
	
	//get a property
	//returns a Property object. Takes the property id as an input
	public function get($property_id)
	{
		$db = new Database();
		$result = $db->select('Property', "property_id = $property_id");

		return new Property($result);
	}
	
}

?>