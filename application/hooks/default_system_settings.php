<?php
function set_language()
{
	$ci=& get_instance();
	$ci->load->helper('language');
	if(!$ci->input->cookie('language'))
	{
		$ci->input->set_cookie('language','english','1296000');
	}
	$current_language=$ci->input->cookie('language');
	$ci->lang->load('school',$current_language);
}
function server_setting()
{
	ini_set('max_execution_time','120000');
	ini_set('max_input_time','-1');
	ini_set('post_max_size','128M');
	ini_set('upload_max_filesize','100M');
	ini_set('max_file_uploads','20');
	ini_set('post_max_size','128M');
	ini_set('max_input_vars','100000');
	ini_set('memory_limit', '256M');
}
?>