<h2><?php echo lang('eventcal_admin_list');?></h2>
<ul>
<?php foreach($events as $event){ ?>
	<li><a href="admin/eventcal/edit/<?php echo $event->id; ?>"><?php echo $event->slug ?></a></li>
<?php } ?>
</ul>
