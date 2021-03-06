<?php include('header.php'); ?>

<?php

$title			= array('class'=>'gc_tf1', 'name'=>'title', 'id'=>'title', 'value' => set_value('title', $title));
$enable_on		= array('class'=>'gc_tf1', 'id'=>'enable_on', 'value' => set_value('enable_on', reverse_format($enable_on)));
$disable_on		= array('class'=>'gc_tf1', 'id'=>'disable_on', 'value' => set_value('disable_on', reverse_format($disable_on)));
$f_image		= array('style'=>'pboxding:5px','name'=>'image', 'id'=>'image');
$link			= array('class'=>'gc_tf1', 'name'=>'link', 'id'=>'link', 'value' => set_value('link', $link));	
$new_window		= array('id'=>'new_window', 'name'=>'new_window', 'value'=>1, 'checked'=>set_checkbox('new_window', 1, $new_window));
?>

<?php echo form_open_multipart($this->config->item('admin_folder').'/boxes/form/'.$id); ?>

<div class="button_set">
	<input type="submit" value="Save Box"/>
</div>

<div id="gc_tabs">
	<ul>
		<li><a href="#gc_box_info">Homepage Boxes</a></li>
	</ul>
	<div id="gc_box_info">
		<div class="gc_field2">
			<label for="title">Title: </label>
			<?php echo form_input($title); ?>
		</div>

		<div class="gc_field2">
			<label for="link">Link: </label>
			<?php echo form_input($link); ?>
		</div>

		<div class="gc_field2">
			<label for="enable_on">Enable On: </label>
			<?php echo form_input($enable_on); ?>
			<input type="hidden" name="enable_on_alt" id="enable_on_alt" value="<?php echo set_value('enable_on', $enable_on) ?>" />
		</div>

		<div class="gc_field2">
			<label for="disable_on">Disable On: </label>
			<?php echo form_input($disable_on); ?>
			<input type="hidden" name="disable_on_alt" id="disable_on_alt" value="<?php echo set_value('disable_on', $disable_on) ?>" />
		</div>

		<div class="gc_field2">
			<?php echo form_checkbox($new_window); ?> <label>New Window</label>
		</div>

		<div class="gc_field2">
			<label for="image">Image: </label>
			<?php echo form_upload($f_image); ?>

			<?php if($id && $image != ''):?>
			<div style="text-align:center; pboxding:5px; border:1px solid #ccc;"><img src="<?php echo base_url();?>uploads/<?php echo $image;?>" alt="current"/><br/>Current File</div>
			<?php endif;?>
		</div>
		
	</div>
</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$("#enable_on").datepicker({ dateFormat: 'mm-dd-yy', altField: '#enable_on_alt', altFormat: 'yy-mm-dd' });
		$("#disable_on").datepicker({ dateFormat: 'mm-dd-yy', altField: '#disable_on_alt', altFormat: 'yy-mm-dd' });
	});
</script>
<?php include('footer.php'); ?>