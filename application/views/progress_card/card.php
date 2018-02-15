<html>
<head>
	<title>
		Progress Card of 
		<?php 
			echo get_single_value('name','student',array('student_id'=>$student_id));?>-<?php echo date("Y");?>
	</title>
	<link rel="stylesheet" type="text/css" media="" href="<?php echo base_url();?>template/css/font.css" />
	<link rel="stylesheet" type="text/css" media="" href="<?php echo base_url();?>template/css/school_marksheet.css" />
	<!--<link rel="stylesheet" type="text/css" media="" href="<?php echo base_url();?>template/css/uikit.gradient.css" />-->
</head>
<body contenteditable="true" spellcheck="false" class="editable editable-container">
<div>
<div class="mainCon">
    <h1><?php echo get_single_value('system_name','settings'); ?></h1>
    <h2><?php echo get_single_value('address','settings'); ?></h2>
    <h3>Progress Card <?php echo date("Y");?></h3>
</div>
<?php
	$this->load->view('progress_card/student_info');
	$this->load->view('progress_card/attendance_info');
?>
<div class="exam-wraper">
		<?php
		if($exam_id=='all')
		{
			$card_name='all';
		}
		else
		{
			$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
			if(!$parent_id)
			{
				$card_name='single';
			}
			else
			{
				$card_name='sub';
			}
		}
		?>
		<center>
		<?php
		$this->load->view('progress_card/'.$type.'/'.$card_name);
		$this->load->view('progress_card/bottom');
		?>
		</center>
</div>
</div>
</body>
</html>  