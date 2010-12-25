<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Atrius - a fork of PyroCMS
 *
 * An open source CMS based on CodeIgniter
 *
 * @package		Atrius
 * @subpackage		eventcal
 * @author		Samuel Thurston @ circul8tion
 * @license		Apache License v2.0
 * @link		http://circul8tion.com
 * @since		Version 1.0.1
 * @filesource
 */

class Eventcal extends Public_Controller
{

	function __construct()
	{
		parent::Public_Controller();
		$this->load->model('eventcal_m');
		$this->lang->load('eventcal');
		// set some language strings?
		
	}

	function index($year = 0, $month = 0)
	{
		// calendar config
		$prefs['show_next_prev'] = TRUE;
		$prefs['next_prev_url'] = "eventcal/index";
		$prefs['day_type'] = "long";
		$prefs['template'] = '

			{table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

			{heading_row_start}<tr>{/heading_row_start}

			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			{heading_row_end}</tr>{/heading_row_end}

			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}

			{cal_row_start}<tr>{/cal_row_start}
			{cal_cell_start}<td>{/cal_cell_start}

			{cal_cell_content}<a href="/eventcal/agenda/{year}/{month}/{day}">{day}</a>{content}{/cal_cell_content}
			{cal_cell_content_today}<div class="today"><a href="/eventcal/agenda/{year}/{month}/{day}">{day}</a>{content}</div>{/cal_cell_content_today}

			{cal_cell_no_content}<a href="/eventcal/agenda/{year}/{month}/{day}">{day}</a>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="today">{day}</div>{/cal_cell_no_content_today}

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}

			{table_close}</table>{/table_close}
		';
		
		$this->load->library('calendar', $prefs);
		
		if ($year && $month){
			$calendar = $this->calendar->generate($year,$month);
		}else{
			$calendar = $this->calendar->generate();
		}
		
		$this->template
			->set('calendar', $calendar)
			->build('index');
	}
	
	function agenda($year = 0, $month = 0, $day = 0)
	{
		echo 'year:',$year;
	}
	
	


}

/* End of file eventcal.php */
