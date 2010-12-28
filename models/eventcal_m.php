<?php defined('BASEPATH') or exit('No direct script access allowed');

class Eventcal_m extends MY_Model {
	
	function getEvents($params = array())
	{
		if(isset($params['start'])){
			$this->db->where('start >', $params['start']);
		}
		
		if(isset($params['end'])){
			$this->db->where('start <', $params['end']);
		}
	
		$query = $this->db->get('eventcal');
		return $query->result();
	}
	
	function addEvent($params)
	{
		$this->db->insert('eventcal',$params);
	}
	
	function updateEvent($id,$params)
	{
		$this->db->where('id',$id);
		$this->db->update('eventcal',$params);
	}
	
	function getEvent($id)
	{
		$this->db->where('id',$id);
		$this->db->get('eventcal');
	}
	
	function deleteEvent($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('eventcal');
	}

}

