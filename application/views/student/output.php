<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url();?>template/css/colorpicker.css" />
<?php 
foreach($crud->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($crud->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<script type="text/javascript" src="<?php echo base_url();?>template/js/colorpicker.js"></script>
<?php echo $crud->output; ?>
<script>
 function color_picker(elem)
   {
   	$(elem).ColorPicker({
	color: '#0000ff',
	onChange: function (hsb, hex, rgb) {
		$(elem).css('backgroundColor', '#' + hex);
		$(elem).val("#"+hex);
	}
	});
   }
</script>