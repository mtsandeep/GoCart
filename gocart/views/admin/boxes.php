<?php include('header.php'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	create_sortable();	
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};
function create_sortable()
{
	$('#boxes_sortable').sortable({
		scroll: true,
		helper: fixHelper,
		axis: 'y',
		update: function(){
			save_sortable();
		}
	});	
	$('#boxes_sortable').sortable('enable');
}

function save_sortable()
{
	serial=$('#boxes_sortable').sortable('serialize');
			
	$.ajax({
		url:'/<?php echo $this->config->item('admin_folder');?>/boxes/organize',
		type:'POST',
		data:serial
	});
}
function areyousure()
{
	return confirm('Are you sure you want to delete this box?');
}
//]]>
</script>



<div class="button_set">
	<a href="<?php echo  base_url(); ?><?php echo $this->config->item('admin_folder');?>/boxes/form" >Add New Box</a>
</div>

<?php if ($boxes): ?>
<table class="gc_table" cellspacing="0" cellpboxding="0">
	<thead>
		<tr>
			<th class="gc_cell_left">Title</th>
			<th>Enable On</th>
			<th>Disable On</th>
			<th class="gc_cell_right"></th>
		</tr>
	</thead>
	<tbody id="boxes_sortable">
		<?php echo (count($boxes) < 1)?'<tr><td style="text-align:center;" colspan="4">There are currently no boxes.</td></tr>':''?>
	<?php

	foreach ($boxes as $box):

		//clear the dates out if they're all zeros
		if ($box->enable_on == '0000-00-00')
		{
			$enable_test	= false;
			$enable			= '';
		}
		else
		{
			$eo			 	= explode('-', $box->enable_on);
			$enable_test	= $eo[0].$eo[1].$eo[2];
			$enable			= $eo[1].'-'.$eo[2].'-'.$eo[0];
		}

		if ($box->disable_on == '0000-00-00')
		{
			$disable_test	= false;
			$disable		= '';
		}
		else
		{
			$do			 	= explode('-', $box->disable_on);
			$disable_test	= $do[0].$do[1].$do[2];
			$disable		= $do[1].'-'.$do[2].'-'.$do[0];
		}


		$disabled_icon	= '';
		$curDate		= date('Ymd');

		if (($enable_test && $enable_test > $curDate) || ($disable_test && $disable_test <= $curDate))
		{
			$disabled_icon	= '<span style="color:#ff0000;">&bull;</span> ';
		}
		?>
		<tr id="boxes-<?php echo $box->id;?>">
			<td><?php echo $disabled_icon.$box->title;?></td>
			<td><?php echo $enable;?></td>
			<td><?php echo $disable;?></td>
			<td class="gc_cell_right list_buttons">
				<a href="<?php echo  base_url(); ?><?php echo $this->config->item('admin_folder');?>/boxes/delete/<?php echo  $box->id; ?>" onclick="return areyousure();" >Delete</a>
				<a href="<?php echo  base_url(); ?><?php echo $this->config->item('admin_folder');?>/boxes/form/<?php echo  $box->id; ?>">Edit</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php else : ?>
	<h2>
		There are currently no boxes.
	</h2>
<?php endif;?>
<?php include('footer.php'); ?>
