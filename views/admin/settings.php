<h2><?php echo lang('eventcal_admin_settings');?></h2>
 
<?php echo form_open('admin/eventcal/settings', 'class="crud"'); ?>
<ol>
	<li class="even">
 	<?php
	echo form_label(array('Timezone Correction','correction'));
	echo form_dropdown('shirts', $options, 'large'); ?>
	</li>
</ol>
<? echo form_close(); ?>
