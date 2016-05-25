<?php

class Database extends PDO
{
	public function __construct($DBhost, $DBname, $DBuser, $DBpass)
	{
		parent::__construct("mysql:host=".$DBhost.";dbname=".$DBname.";", $DBuser, $DBpass);
	}

	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$sth = $this->prepare($sql);
		foreach ($array as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
		return $sth->fetchAll($fetchMode);
	}

	public function update($table, $where, $array = array())
	{
		ksort($array);

		$setn = array();
		foreach($array as $key => $value){
			$setn[] = $key.' = :'.$key;
		}
		$set = implode(", ", $setn);

		$sth = $this->prepare("UPDATE $table SET $set WHERE $where");
		foreach ($array as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}

	public function updateTwo($table, $where, $array = array())
	{
		ksort($array);
		ksort($where);

		$setn = array();
		foreach($array as $key => $value){
			$setn[] = $key.' = :'.$key;
		}
		foreach($where as $key => $value)
		{
			$whereNew[] = $key.' = :'.$key.' ';
		}
		$set = implode(", ", $setn);
		$whereNew = implode('AND ', $whereNew);

		$finArray = array_merge($array, $where);;

		$sth = $this->prepare("UPDATE $table SET $set WHERE $whereNew");
		foreach ($finArray as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}

	public function returnRowCount($sql, $array = array())
	{
		$sth = $this->prepare($sql);
		foreach ($array as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
		$rowCount = $sth->rowCount();
		return ($rowCount > 0) ? true : false;
	}

	public function getRowCount($table)
	{
		$sth = $this->prepare("SELECT * FROM $table");
		$sth->execute();
		$rowCount = $sth->rowCount();
		return $rowCount;
	}

	public function getRowCountCond($sql, $array = array())
	{
		$sth = $this->prepare($sql);
		foreach ($array as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
		$rowCount = $sth->rowCount();
		return $rowCount;
	}

	public function insert($table, $data)
	{
		ksort($data);
		
		$fieldNames = implode(", ", array_keys($data));
		$fieldValues = ':'. implode(', :', array_keys($data));
		
		$sth = $this->prepare("INSERT INTO $table ($fieldNames) VALUES ($fieldValues)");
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
		$id = $this->lastInsertId();
		$newRow = $this->select("select * from ".$table." where ".$table."_id = :id",array("id"=>$id));
		return $newRow[0];
	}
	
	public function delete($table, $where, $array = array())
	{
		$sth = $this->prepare("DELETE FROM $table WHERE $where");
		foreach ($array as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
	}
	
	public function deleteAll($table)
	{
		$sth = $this->prepare("DELETE FROM $table");
		$sth->execute();
	}
}