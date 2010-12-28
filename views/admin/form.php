 <h2>Event Details</h2>
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
			<label for="stub"><?php echo lang('eventcal_lbl_stub'); ?></label>
			<?php echo form_input( array(
			      'name'        => 'stub',
			      'id'          => 'stub',
			      'value'       => $event->stub,
			      'maxlength'   => '64',
			      'size'        => '20',
			    ) ); ?>
			    <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		<li class="even">
			<label for="start_date"><?php echo lang('eventcal_lbl_start_date'); ?></label>
			<?php echo form_input('start_date', htmlspecialchars_decode($event->start_date), 'maxlength="10" id="datepicker" class="text width-20"'); ?>
			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		<li class="even">
			<label for="start_t"><?php echo lang('eventcal_lbl_start_date'); ?></label>
			<?php echo form_input('', htmlspecialchars_decode($event->start_date), 'maxlength="10" class="text width-20"'); ?>
			<span class="requireimed-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		
</ol>
<div class="float-right">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</div>
<?php echo form_hidden('id',$event->id) ?>
<?php echo form_close();?>
