<html>
    <head>
		<link rel="shortcut icon" href="<?=base_url()?>images/wemax_edu.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<link rel="stylesheet" href="<?php echo base_url();?>template/css/font.css" />
        <link href="<?php echo base_url();?>template/css/schoolsoft.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>template/css/uikit.gradient.css" media="screen" rel="stylesheet" type="text/css" />
		<?php
		$system_name	=	get_single_value('system_name','settings');
		$system_title	=	get_single_value('system_title','settings');
		$system_title=translate('student_list_of_class ').get_single_value('name','class',array('class_id'=>$class_id));
		?>
		<title><?php echo $system_name."||".$system_title; ?></title>
    </head>


    <body style="padding: 20px;overflow: scroll;">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<?php echo $output; ?>
<style>
	td,th
	{
		font-size: 12px !important;
	}
</style>
</body>
</html>