
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
		<link rel="shortcut icon" href="<?=base_url()?>images/wemax_edu.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link href="<?php echo base_url();?>template/css/schoolsoft.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>template/css/uikit.gradient.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>template/css/context.bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>template/css/bootstrap-combobox.css" rel="stylesheet" type="text/css">
		<script src="<?php echo base_url();?>template/js/ekattor.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/bootstrap-combobox.js" type="text/javascript"></script>
		<!--<script src="<?php echo base_url();?>template/js/jquery.js" type="text/javascript"></script>-->
		<script src="<?php echo base_url();?>template/js/uikit.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/context.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/corner.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
		<script src="<?php echo base_url();?>template/js/sp8.js" type="text/javascript"></script>
		<?php
		$system_name	=	get_single_value('system_name','settings');
		$system_title	=	get_single_value('system_title','settings');
		?>
        <title><?php echo $system_title; ?>|<?php echo $system_title; ?></title>
    </head>


    <body style="overflow:hidden;" class="uk-height-viewport">
        <div id="main_body" style="height: 100vh" class="container-fluid">
			<?php include 'header.php'; ?>
            <?php $this->load->view($this->session->userdata('login_type') . '/navigation'); ?>
			<div class="main-content" style="height: 95vh;" class="container-fluid">
			<?php
			$login_type=$this->session->userdata('login_type');
			if($login_type=='parent')
			$login_type='parents';
			?>
			<iframe name="frame" height="100%" width="100%" src="<?=site_url($login_type.'/dashboard')?>" scrolling="yes" id="frame" style="overflow-x:scroll;">
			</iframe>
			</div>
        </div>
		<?php
		$this->load->view('footer');
		$this->load->view('loading',array('message'=>"<i class='uk-icon-justify uk-icon-spinner uk-icon-spin uk-icon-small'></i>&nbsp;&nbsp;&nbsp;".translate('Please wait..')));
		?>
		<?php include 'modal_hidden.php'; ?>
    </body>
</html>