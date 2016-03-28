<?php

//Property.php

require_once 'Database.php';


class Property {

	public $property_id;
	public $address;
	public $number_of_rooms;
	public $room_type;
	public $price;
	public $is_deleted;
    public $owner_id;
    public $district_id;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->property_id = (isset($data['property_id'])) ? $data['property_id'] : "";
		$this->address = (isset($data['address'])) ? $data['address'] : "";
		$this->number_of_rooms = (isset($data['number_of_rooms'])) ? $data['number_of_rooms'] : "";
		$this->room_type = (isset($data['room_type'])) ? $data['room_type'] : "";
		$this->price = (isset($data['price'])) ? $data['price'] : "";
		$this->is_deleted = 0;
        $this->owner_id = (isset($data['owner_id'])) ? $data['owner_id'] : "";
        $this->district_id = (isset($data['district_id'])) ? $data['district_id'] : "";
	}

	public function save($isNewProperty = false) {
		//create a new database object.

		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewProperty) {
			//set the data array
			$data = array(
				"number_of_rooms" => "$this->number_of_rooms",
				"room_type" => "$this->room_type",
				"price" => "$this->price"
			);
			
			//update the row in the database
			$db = new Database();
            $db->update($data, 'Property', 'property_id = '.$this->property_id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
                
				"address" => "$this->address",
				"number_of_rooms" => "$this->number_of_rooms",
				"room_type" => "$this->room_type",
				"price" => "$this->price",
                "is_deleted" => "$this->is_deleted",
                "owner_id" => "$this->owner_id",
                "district_id" => "$this->district_id"
                
			);
            $db = new Database();
			 $db->insert($data, 'Property');
			//$this->property_id = $db->insert($data, 'Property');
		}
		return true;
	}
	 public function __toString()
    {
        return $this->property_id;
    }
	
}

?>