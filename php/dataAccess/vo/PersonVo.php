<?php


class PersonVO {
	
	public $person_id;
	public $person_name;
    public $person_email;
	public $person_telephone;
    public $person_date;

	
	public function PersonVo() 
	{
		
	}
	
	public function mapObject($data)
	{
		
        $this->person_id = $data["person_id"];
        $this->person_name = $data["person_name"];
        $this->person_email = $data["person_email"];
        $this->person_telephone = $data["person_telephone"];
        $this->person_date = $data["person_date"];

	}

}
?>