<?php

/*
 *  MODEL FOR API
 */

class Api_Model extends SEVEN_THUNDERS
{
    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * 
	 */
	public function getAdvanced()
	{
		$return = array();
		foreach($_POST as $key => $each)
		{
			$select = "select ";
			if(isset($each['type']))
			{
				$select .= $each['type'];
			}
			if(isset($each['only']))
			{
				$select .= " ".$each['only']." ";
			}else{
				// select all columns by default
				$select .= " *";
			}
			$select .= "from ".$each['from']." ";
			if(isset($each['join']))
			{
				foreach($each['join'] as $join)
				{
					$select .= " ".$join['type']." join ".$join['on']." on ".$join['where']." ";
				}
			}
			if(isset($each['where']))
			{
				$select .= "where ".$each['where']." ";
			}
			if(isset($each['order']))
			{
				$select .= "order by ".$each['order']['by']." ".$each['order']['type']." ";
			}
			if(isset($each['limit']))
			{
				$select .= "limit ".$each['limit'];
			}
			$result = $this->select($select);
			$return[$key] = $result;
		}
		return $return;
	}

	/**
	 * 
	 */
	public function pushAdvanced()
	{
		$return = array();
		foreach($_POST as $key => $each)
		{
			$return[$key] = $this->insert($each['table'], $each['object']);
		}
		return $return;
	}

	/**
	 *
	 */
	public function updateTable($table, $where, $data)
	{
		$where = $this->createArray($where);
		$this->updateTwo($table, $where, $data);
	}

	/**
	 *
	 */
	public function deleteFrom($table, $where)
	{
		$where = $this->stringafy($where);
		$this->delete($table, $where);
	}
    
    // CREATE KEY => VALUE PAIRS FROM URL
    public function cKVP($array)
    {
        $newArray = [];
        $array = array_values($array);
        $pairs = array_chunk($array,2);
        foreach($pairs as $value)
            $newArray[$value[0]] = $value[1];
        return $newArray;
    }

	/**
	 *
	 */
	public function createArray($data)
	{
		$data = explode(',', $data);
		foreach($data as $d)
		{
			$param[] = explode('-', $d);
		}
		foreach($param as $p)
		{
			$arrayData[$p[0]] = $p[1];
		}

		return $arrayData;
	}

	/**
	 *
	 */
	public function stringafy($data)
	{
		$data = str_replace('-', ' = ', $data);
		$data = str_replace(',', " AND ", $data);
		return $data;
	}
}