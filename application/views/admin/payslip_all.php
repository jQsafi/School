<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
      <?php 
	  $system_name	=	get_single_value('system_name','settings');
		$system_title	=	get_single_value('system_title','settings');
	  include 'application/views/includes.php';?>
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>
<body>
	
					<?php	foreach($paysliparray as $payslipid):
					
						?>
							<center><iframe src="<?=site_url('admin/payslip/'.$payslipid)?>" class='a4 height-half' scrolling="no" resize="yes"></iframe></center>
							<?php
           
                        endforeach;?>
				
</body>
</html>