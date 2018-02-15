
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
		<link rel="shortcut icon" href="<?=base_url()?>images/wemax_edu.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php include 'includes.php'; ?>
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>


    <body>
        <div id="main_body">
			<?php
			include $this->session->userdata('login_type') . 'navigation.php'; ?>
			<iframe name="frame" height="100%" width="100%" src="<?=site_url('superadmin/dashboard')?>" style="margin-top:200px;">
			</iframe>
			 <?php include 'footer.php'; ?>
        </div>
    </body>
    <?php include 'modal_hidden.php'; ?> 
</html>