<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Eventcal module
 *
 * @author Samuel Thurston - circul8tion
 * @package Atrius
 * @subpackage Eventcal Module
 * @category Modules
 */
class Admin extends Admin_Controller
{
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	private $validation_rules = array();
	
	/**
	 * Constructor method
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::Admin_Controller();        
		$this->load->model('eventcal_m');
		$this->lang->load('eventcal');        
	
		// Load and set the validation rules
		$this->load->library('form_validation');
		
		$this->validation_rules = array(
			array(
				'field' => 'event_name',
				'label' => lang('eventcal_event_name'),
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'slug',
				'label' => lang('eventcal_slug'),
				'rules'	=> 'trim|required|alpha_dash'				
			),
			array(
				'field' => 'start_date',
				'label' => lang('eventcal_start_date'),
				'rules'	=> 'trim|required'				
			),
			array(
				'field' => 'end_date',
				'label' => lang('eventcal_end_date'),
				'rules'	=> 'trim|required'				
			),
			array(
				'field' => 'start_time_hr',
				'label' => lang('eventcal_start_time'),
				'rules'	=> 'trim|is_natural|max_length[2]'				
			),
			array(
				'field' => 'start_time_min',
				'label' => lang('eventcal_start_time'),
				'rules'	=> 'trim|is_natural|exact_length[2]'				
			),
			array(
				'field' => 'end_time_hr',
				'label' => lang('eventcal_end_time'),
				'rules'	=> 'trim|is_natural|max_length[2]'				
			),
			array(
				'field' => 'end_time_min',
				'label' => lang('eventcal_end_time'),
				'rules'	=> 'trim|is_natural|exact_length[2]'				
			),
			array(
				'field' => 'location',
				'label' => lang('eventcal_location'),
				'rules'	=> 'trim|required'				
			),
			array(
				'field' => 'details',
				'label' => lang('eventcal_details'),
				'rules'	=> 'trim|required'				
			),
		);
		$this->form_validation->set_rules($this->validation_rules);
		
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	}
	
	// Admin: Show Event List
	function index($year = 0, $month = 0)
	{	
		if(!$year || !$month){
			$year = date('Y');
			$month = date('j');
		}
		$params = array('start'=>date('Y-m-j'));
		$this->data->events = $this->eventcal_m->getEvents($params);
		
		// Render the view
		$this->template
			->title($this->module_details['name'])
			->build('admin/index', $this->data);
	}
	
	//Admin: edit a member	
	
	function edit($id = 0)
	{
		// if the id is not set in the url try the hidden field
		if (!$id){
			$id = $this->input->post('id');
		}
		// if it's still not set we have a problem
		if(!$id){
		
			$this->session->set_flashdata('error',lang('eventcal_id_err'));
			redirect('admin/members');
		}
	
		$this->data->method = 'edit/'.$id;
		
		// load the member data 
		$member = $this->members_m->getMember($id);	
		
		// run the validation
		if($this->form_validation->run()){
			// pull the field values through input filter
			foreach($this->validation_rules as $rule)
			{
				$member->{$rule['field']} = $this->input->post($rule['field']);
			}
			$this->data->member = $member;
			// update the record
			if ($this->members_m->update($id,$member)){
				$this->session->set_flashdata('success',"Successfully updated member ".$id);
			}else{
				$this->session->set_flashdata('error',"There was a problem updating ".$id);
			}
			
		}else{
			$this->data->member = $this->eventcal_m->getMember($id);	
		}
		
		$this->template->build('admin/form', $this->data);
	}
	
	// Admin: Create a new member
	function add()
	{
		$this->data->method = 'add';
		// Loop through each rule
		foreach($this->validation_rules as $rule)
		{
			$event->{$rule['field']} = $this->input->post($rule['field']);
		}
		
		// correcting some of the data fields from the db to match the form
		if(!$event->start_date){
			$event->start_date = date('n/j/Y');
		}
		if(!isset($event->start_time)){
			$event->start_time = date('g:i');
		}
		
		$stime = explode(':',$event->start_time);
		
		$event->start_time_hr = $stime[0];
		$event->start_time_min = $stime[1];
		
		if(!$event->end_date){
			$event->end_date = date('n/j/Y');
		}
		if(!isset($event->end_time)){
			$event->end_time = date('g:i',(time()+(60*60)));
		}
		
		$etime = explode(':',$event->end_time);
		
		$event->end_time_hr = $etime[0];
		$event->end_time_min = $etime[1];
	
		if ($this->form_validation->run())
		{
			$event->start_time = $event->start_time_hr . ':' . $event->start_time_min;
			$event->end_time = $event->end_time_hr . ':' . $event->end_time_min;
			
			unset($event->start_time_min);
			unset($event->start_time_hr);
			unset($event->end_time_min);
			unset($event->end_time_hr);
			
			$date_start = explode('/',$event->start_date);
			$event->start_date = $date_start[2].'/'.$date_start[1].'/'.$date_start[0];
			$date_end = explode('/',$event->end_date);
			$event->end_date = $date_end[2].'/'.$date_end[1].'/'.$date_end[0];
			
			if ($this->eventcal_m->addEvent($event))
			{
			
				$this->session->set_flashdata('success', sprintf(lang('eventcal_add_success'), $this->input->post('title'))); 
				redirect('admin/eventcal/index');
			}            
			else
			{
				$this->session->set_flashdata(array('error'=> lang('eventcal_add_error')));
			}
			
		}
		
		$event->id = '';
		
		$this->data->event =& $event;
		

		$this->template->build('admin/form', $this->data);
	}
	
	function action()
	{
		$ids = $this->input->post('action_to');
		$total = count($ids);
		$success_count = 0;
		
		foreach ($ids as $id){
			if($this->eventcal_m->delete($id)){
				$success_count += 1;
			}
		}
		
		if ($success_count == $total){
			$this->session->set_flashdata(array('success'=> $success_count.' '.lang('members_delete_mult_success')));
		}else{
			$this->session->set_flashdata(array('error'=> $succes_count.' '.lang('members_delete_mult_error')));
		}
		
		redirect('admin/eventcal');
		
	}
	
	function delete($id = 0)
	{
		if($this->members_m->delete($id)){
			$this->session->set_flashdata(array('success'=>$id.' '.lang('members_delete_success')));
		}else{
			$this->session->set_flashdata(array('error'=>$id.' '.lang('members_delete_error')));
		}
		
		redirect('admin/members');
	}
	

	
}
?>
