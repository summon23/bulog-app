<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	private $tableName;

	public function __construct($tableName)
	{
		parent::__construct();
		$this->tableName = $tableName;
	}

	/**
	 * Function to Save Data Model
	 */
	public function saveDataModel($data = array())
	{
		$table = $this->tableName;
		$qry = "SELECT * from $table";
		$res = $this->db->query($qry);
		// debug($res);
	}

	/**
	 * Function to Get Data Model (Single or Many)
	 */
	public function getDataModel($key = array())
	{

	}

	/**
	 * Function to Update Data Model By Field Key
	 */
	public function updateDataModel($key = array()) 
	{

	}

	/**
	 * Function to Delete Data Model (Single or Many)
	 */
	public function deleteModel($key = array())
	{

	}
}