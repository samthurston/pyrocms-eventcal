<h3><?php echo lang('eventcal_admin_list');?></h3>
<?php if (!empty($events)):?>
<?php echo form_open('admin/eventcal/action'); ?>
		<table border="0" class="table-list">
			<thead>
				<tr>
					<th align="center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
					<th><?php echo lang('eventcal_lbl_event_name');?></th>
					<th><?php echo lang('eventcal_lbl_start_date');?></th>
					<th><?php echo lang('eventcal_lbl_start_time');?></th>
					<th><?php echo lang('eventcal_lbl_end_date');?></th>
					<th><?php echo lang('eventcal_lbl_end_time');?></th>
					<th><?php echo lang('eventcal_lbl_actions');?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php foreach ($events as $event): ?>
				<tr>
					<td align="center"><?php echo form_checkbox('action_to[]', $event->id) ?></td>
					<td><?php echo anchor('admin/eventcal/edit/' . $event->id,$event->event_name); ?></td>
					<td><?php echo $event->start_date; ?></td>
					<td><?php echo $event->start_time; ?></td>
					<td><?php echo $event->end_date; ?></td>
					<td><?php echo $event->end_time; ?></td>
					<td>
						<?php echo anchor('admin/eventcal/edit/' . $event->id, lang('user_edit_label'), array('class'=>'minibutton')); ?>  
						<?php echo anchor('admin/eventcal/delete/' . $event->id, lang('user_delete_label'), array('class'=>'confirm minibutton')); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>	
		</table>
	<div class="float-right">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
	</div>
<?php else: ?>
	<div class="blank-slate">
	
		<img src="<?php echo site_url('system/pyrocms/modules/users/img/user.png') ?>" />
		
		<h2><?php echo lang('events_no_events');?></h2>
	</div>
<?php endif; ?>
