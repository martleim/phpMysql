<?php

require_once "vo/PersonVo.php";
require_once "dao/PeopleDao.php";

class DataAccess {
	
	private $peopleDao;
    private $peoplePerPage= 2;
	
		
	public function DataAccess()
	{
		// credentials must be defined in the header.php file
		
		require("dao/header.php");
		//mysql_connect($host, $user, $password);
		//mysql_select_db($db) ;

		$this->peopleDao = new PeopleDao;
		
	}

	
	// People

	public function getAllPeople()
	{
		return $this->PeopleDao->getAll();
	}


	public function getPerson($personID)
	{
		return $this->peopleDao->getOne($personID);
	}


	public function createPerson($person)
	{
		$person=$this->peopleDao->create($person);
		return $person;
	}

	public function updatePerson($person)
	{
		return $this->peopleDao->update($person);
	}
	
	public function deletePerson($personID)
	{
		return $this->peopleDao->delete($personID);
	}
	
	public function getAllPeopleByPage($page)
	{
		return $this->peopleDao->getAllPaged($page, $this->peoplePerPage);
	}
	
	public function getPeoplePagesCount()
	{
		$count=$this->peopleDao->countAll();
		$count=($count-($count % $this->peoplePerPage)) + $this->peoplePerPage;
		return ($count / $this->peoplePerPage);
	}
	

}

?>