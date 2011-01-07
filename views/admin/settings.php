<h2><?php echo lang('eventcal_admin_settings');?></h2>
 
<?php echo form_open('admin/eventcal/settings', 'class="crud"'); ?>
<ol>
	<li class="even">
 	<?php
	echo form_label('Timezone Correction','correction');
	echo form_dropdown('correction', $zones, $correction, 'id="correction"'); ?>
	</li>
</ol>
<div class="float-right">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</div>
<? echo form_close(); ?>
