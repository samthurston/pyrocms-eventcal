<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Newsletter Subscribe Widget
 *
 * @author 	Stephen Cozart - PyroCMS Development Team
 * @package 	PyroCMS
 * @subpackage 	Newsletters
 * @category	Widgets
 */
class Widget_Event_list extends Widgets
{
	
	public $title = 'Event List';
	public $description = 'List upcoming events in a widget area.';
	public $author = 'Samuel Thurston';
	public $website = 'http://circul8tion.com/';
	public $version = '1.0';
	
	//run the widget
	public function run($options)
	{
		$this->load->model('modules/module_m');
		$this->load->model('eventcal/eventcal_m');
		
		//check that the module is installed AND enabled
		$eventcal = $this->module_m->get('eventcal');
	
		//Prevent the widget from displaying if disabled or not installed		
		if($eventcal === FALSE OR empty($eventcal))
		{
			return FALSE;
		}
		
		$this->lang->load('eventcal/eventcal');
		
		$options['events']->events = array();
		
		
		$options['lang_none'] = 'hi there sailor';// lang('eventcal_no_events');
		$options['events'] = $this->eventcal_m->getEvents();

		return $options;
		
	}
	
}
