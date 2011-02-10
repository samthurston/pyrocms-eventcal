<h2 id="page_title"><?php echo lang('eventcal_title');?></h2>

<? 

$this->load->view('partials/calnav'); 

$flag_today = false;
$flag_tomorrow = false;
$flag_thisweek = false;
$flag_nextweek = false;

// print_r($events);

?>

<div id="eventcal-agenda">
	<ol>
		<?php foreach ( $events as $event ){
		
		if ($event->start_date == $agenda_start && !$flag_today){
			echo '<li class="listdate">Today</li>';
			$flag_today = true;
		}
		
		if ((mysql_to_unix($event->start_date.'00000000') + strtotime('+1 day')) == ($agenda_start.'00000000') && !$flag_today){
			echo '<li class="listdate">Tomorrow</li>';
			$flag_today = true;
		}
		
		?>
		
		<li><?php echo $event->start_date .' @ '.$event->start_time; ?> - 
			<a href="<?php echo base_url(); ?>eventcal/detail/<?php echo $event->slug; ?>">
			<?php echo $event->event_name; ?>
			</a>
		</li>
		<?php } ?>
	</ol>
</div>
