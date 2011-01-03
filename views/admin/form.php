 <h2><?php echo lang('eventcal_admin_list');?></h2>
 
 <style type="text/css">
 .spinner{width: 2em;}
 </style>
 <?php echo form_open('admin/eventcal/'.$method, 'class="crud"'); ?>
 <ol>
 		<li class="even">
			<label for="event_name"><?php echo lang('eventcal_lbl_event_name'); ?></label>
			<?php echo form_input( array(
			      'name'        => 'event_name',
			      'id'          => 'event_name',
			      'value'       => $event->event_name,
			      'maxlength'   => '64',
			      'size'        => '20',
			    ) ); ?>
			    <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		<li>
			<label for="slug"><?php echo lang('eventcal_lbl_slug'); ?></label>
			<?php echo form_input( array(
			      'name'        => 'slug',
			      'id'          => 'slug',
			      'value'       => $event->slug,
			      'maxlength'   => '64',
			      'size'        => '20',
			    ) ); ?>
			    <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		<li class="even">
			<label for="start_date"><?php echo lang('eventcal_lbl_start_date'); ?></label> 
			<?php echo form_input('start_date', htmlspecialchars_decode($event->start_date), 'maxlength="10" style="width: 10em;" class="datepicker text width-20"'); ?>
			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		<li class="even">
			<label for="start_time"><?php echo lang('eventcal_lbl_start_time'); ?></label>
			<?php echo form_input('start_time_hr', htmlspecialchars_decode($event->start_time_hr), 'maxlength="2" size="2" style="width: 2em;" class="text"'); ?> : 
			<?php echo form_input('start_time_min', htmlspecialchars_decode($event->start_time_min), 'maxlength="2" size="2" style="width: 2em;" class="text"'); ?>
			
		</li>
		<li>
			<label for="end_date"><?php echo lang('eventcal_lbl_end_date'); ?></label>
			<?php echo form_input('end_date', htmlspecialchars_decode($event->end_date), 'maxlength="10" id="datepicker" style="width: 10em;" class="text width-20"'); ?>
			
		</li>
		<li>
			<label for="end_time"><?php echo lang('eventcal_lbl_end_time'); ?></label>
			<?php echo form_input('end_time_hr', htmlspecialchars_decode($event->end_time_hr), 'maxlength="2" size="2" style="width: 2em;" class="text"'); ?> : 
			<?php echo form_input('end_time_min', htmlspecialchars_decode($event->end_time_min), 'maxlength="2" size="2" style="width: 2em;" class="text"'); ?>
			
		</li>
		<li class="even">
			<label for="location"><?php echo lang('eventcal_lbl_location'); ?></label>
			<?php echo form_input( array(
			      'name'		=> 'location',
			      'id'		=> 'location',
			      'value'		=> $event->location,
			      'maxlength'	=> '64',
			      'size'		=> '20',
			    ) ); ?>
		</li>
		<li>
			<label for="details"><?php echo lang('eventcal_lbl_details'); ?></label>
			<?php echo form_textarea( array(
			      'name'		=> 'details',
			      'id'		=> 'details',
			      'value'		=> $event->details,
			      'cols'   		=> '50',
			      'rows'		=> '6',
			    ) ); ?>
		</li>
</ol>
<div class="float-right">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</div>
<?php echo form_hidden('id',$event->id) ?>
<?php echo form_close();?>
