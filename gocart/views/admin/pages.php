<?php include('header.php'); ?>

<script type="text/javascript">
function areYouSure(i)
{
	return confirm('Are you sure you want to delete '+i+'?');
}
</script>
<div class="button_set">
	<a href="<?php echo  base_url(); ?><?php echo $this->config->item('admin_folder');?>/pages/form">Add New Page</a>
	<a href="<?php echo  base_url(); ?><?php echo $this->config->item('admin_folder');?>/pages/link_form">Add New Link</a>
</div>

<?php if((bool)count($pages)):?>
<table class="gc_table" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			
			<th class="gc_cell_left">Title</th>
			<th class="gc_cell_right"></th>
		</tr>
	</thead>
	<tbody>
		
		<?php
		$GLOBALS['admin_folder'] = $this->config->item('admin_folder');
		function page_loop($pages, $dash = '')
		{
			foreach($pages as $page)
			{?>
			<tr class="gc_row">
				<td class="gc_cell_left">
					<?php echo $dash.' '.$page->title; ?>
				</td>
				<td class="gc_cell_right list_buttons">
					<a href="<?php echo  secure_base_url(); ?><?php echo $GLOBALS['admin_folder'];?>/pages/delete/<?php echo  $page->id; ?>" onclick="return areyousure();">Delete</a>

					
					
					<?php if(empty($page->content)): ?>
						<a href="<?php echo base_url(); ?><?php echo $GLOBALS['admin_folder'];?>/pages/link_form/<?php echo  $page->id; ?>">Edit</a>
						<a href="<?php echo $page->url;?>" target="_blank">Follow Link</a>
					<?php else: ?>
						<a href="<?php echo base_url(); ?><?php echo $GLOBALS['admin_folder'];?>/pages/form/<?php echo  $page->id; ?>">Edit</a>
						<a href="<?php echo secure_base_url(); ?><?php echo $page->slug; ?>" target="_blank">Go to Page</a>
					<?php endif; ?>
						
				</td>
			</tr>
			<?php
			page_loop($page->children, $dash.'-');
			}
		}
		page_loop($pages);
		?>
	</tbody>
</table>
<?php else :?>
	<h2>There are currently no pages.</h2>
<?php endif;?>
<?php include('footer.php'); ?>