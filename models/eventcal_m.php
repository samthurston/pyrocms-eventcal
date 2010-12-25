<?php defined('BASEPATH') or exit('No direct script access allowed');

class Eventcal_m extends MY_Model {

	function count()
	{
		return $this->db->count_all('eventcal');
	}
	
	function getEvents($params = array())
	{
	
	}
	
	function addEvent($params)
	{
	
	}
	
	function updateEvent($id,$params)
	{

	}
	
	function getEvent($id)
	{
	
	}
	
	function deleteEvent($id)
	{
	
	}

}

