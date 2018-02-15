
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


    <body style="padding-bottom: 20px;overflow: scroll;">
        <div id="main_body">
            <div class="main-content" style="margin-left: 0;">
                <?php include 'page_info.php'; ?>
                <div class="container-fluid padded">
				<?php
				
				if(!$module)
				$module=$this->session->userdata('login_type');
				$this->load->view($module."/".$page_name);
				?>
                </div>       
                
            </div>
        </div>
    </body>
    <?php 
	include 'modal_hidden.php'; 
	$this->load->view('context_menu');?> 
	<script>
		print_css="<?php echo base_url();?>template/css/schoolsoft.css";
		base_url="<?=base_url()?>";
	</script>
</html>