<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link rel="stylesheet" href="<?php echo base_url();?>template/css/font.css" />
		<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800">-->
        <!--<link href="<?php echo base_url();?>template/css/schoolsoft.css" media="screen" rel="stylesheet" type="text/css" />-->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url();?>template/js/html5shiv.js" type="text/javascript"></script>
        
        <![endif]-->
		<script src="<?php echo base_url();?>template/js/excanvas.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>template/js/ekattor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
		<script src="<?php echo base_url();?>template/js/sp8.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/sp-8-form-validation.js" type="text/javascript"></script>
		
        <?php
		//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
		
		$system_name	=	get_single_value('system_name','settings');
		$system_title	=	get_single_value('system_title','settings');
		?>
		<title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>
	<body>
		<?php
		$counter=1;
		foreach($student_id as $id)
		{
			echo "<center><div class='page_number'>".$counter."</div><div align='center' style='margin:0;padding:0;height:210mm;width:297mm;'>";
			echo "<iframe src=".site_url('progress_card/details/'.$type.'/'.$id.'/'.$exam_id.'/'.$class_id)." height='100%' width='100%'></iframe>"; 
			echo "</div><center>";
			$counter++;
		}
		?>
		<style>
		.page_number
		{
			width: 60px;
			padding: 4px;
			font-size: 32px;
			color: #FFFFFF;
			font-weight: bolder;
			background-color: rgb(17, 49, 101);
		}
		iframe
		{
			margin:0;
			padding:0;
			border:1px dashed #000000;
			margin-top:3px;					
		}
		@media print
		{
			
			iframe
			{
				border:solid 0px #FFFFFF;
			}
			.page_number
			{
				display: none;
			}
		}
		</style>
	</body>
</html>