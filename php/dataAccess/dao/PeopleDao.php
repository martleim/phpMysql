<?php



class PeopleDao {
	
	private $table = "people";
	
	public function PeopleDao  ()
	{
		/*require_once "header.php";*/
		
	}

	
	private function mapRecordSet($recordset){
	
		$list=array();
		
		while($data=mysqli_fetch_array($recordset, MYSQLI_ASSOC)){
			$vo = new PersonVo();
			$vo->mapObject($data);
			array_push($list, $vo);
		}
		
		return $list ;
	
	}	


	public function getAll()
	{
		require("header.php");
		$rs = $connection->query("SELECT * FROM ".$this->table);
		return $this->mapRecordSet($rs);		
	}


	public function getOne($id)
	{
		require("header.php");
		$rs = $connection->query("SELECT * FROM ".$this->table." WHERE person_id = ".$id);

		$list = $this->mapRecordSet($rs);
		return $list[0];		
	}



	public function create($obj)
	{
		require("header.php");
        $sql = "INSERT INTO ".$this->table."
		
		( 
		person_name,
        person_email,
        person_telephone
		)
		
		VALUES
		
		(
		'".$connection->real_escape_string($obj->person_name)."',
		'".$connection->real_escape_string($obj->person_email)."',
        '".$connection->real_escape_string($obj->person_telephone)."')";

		if(!$connection->query($sql)) {
			trigger_error("Unable to create Person",  $connection->error);
			return;
		}
				
		return $this->getOne( $connection->insert_id );
				
	}

	public function update($obj)
	{
		require("header.php");
		$id = $obj->person_id;

		$sql = "UPDATE ".$this->table." SET 
		person_name = '".$connection->real_escape_string($obj->person_name)."',
        person_email = '".$connection->real_escape_string($obj->person_email)."',
        person_telephone = '".$connection->real_escape_string($obj->person_telephone)."'

		WHERE person_id =". $id;
	
		if(!$connection->query($sql)){
			trigger_error("Unable to update Person", $connection->error);
			return ;		
		}
				
		return $this->getOne($id);
		
	}

	public function delete($id)
	{
		require("header.php");
		$result = $connection->query("DELETE FROM ".$this->table." WHERE person_id = ".$id);
		
		if(!$result){
			trigger_error("Unable to delete Person",  $connection->error);
			return;
		}
		else return true ;						
		
	}
    
    public function getAllPaged($page,$offset)
	{
		require("header.php");
		
		$sql="SELECT * FROM ".$this->table." order by person_date";
		if($page!=null){
			$sql=$sql." LIMIT ".$offset." OFFSET ".($page*$offset);
		}
		$rs = $connection->query($sql);
		return $this->mapRecordSet($rs);
	}
	
	public function countAll()
	{
		require("header.php");
	
		$sql="SELECT COUNT(*) as cnt FROM ".$this->table." order by person_date ";
		$rs = $connection->query($sql);
        $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);        
		return $row['cnt'];
	}



}

?>