<h2 id="page_title"><?php echo lang('eventcal_title');?></h2>

<? $this->load->view('partials/calnav'); ?>

<div id="eventcal-agenda">
	<ol>
		<? foreach ( $events as $event ){ ?>
		<li><?php echo $event->start_time; ?> - 
			<a href="<?php echo base_url(); ?>/admin/eventcal/detail/<?php echo $event->slug; ?>">
			<?php echo $event->event_name; ?>
			</a>
		</li>
		<?php } ?>
	</ol>
</div>
