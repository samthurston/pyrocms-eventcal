<?php defined('BASEPATH') or exit('No direct script access allowed');

class Eventcal_m extends MY_Model {

	var $event_tbl = 'eventcal';
	
	function getEvents($params = array())
	{
		if(isset($params['start'])){
			$this->db->where('start_date >=', $params['start']);
		}
		
		if(isset($params['end'])){
			$this->db->where('start_date <=', $params['end']);
		}
	
		$query = $this->db->get($this->event_tbl);
		return $query->result();
	}
	
	function addEvent($params)
	{
		$this->db->insert($this->event_tbl,$params);
	}
	
	function update($id,$params)
	{
		$this->db->where('id',$id);
		if($this->db->update($this->event_tbl,$params)){
			return true;
		}else{
			return false;
		}
	}
	
	function getEvent($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get($this->event_tbl);
		
		$result = $query->result();
		return($result[0]);
	}
	
	function deleteEvent($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->event_tbl);
	}
	
	function getBySlug($slug)
	{
		$this->db->where('slug',$slug);
		$query = $this->db->get($this->event_tbl);
		
		if($query){
			$events = $query->result();
			$event = $events[0];
			return $event;
		}else{
			return false;
		}
	}

}

