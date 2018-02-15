<link href="<?=base_url()?>template/css/hover.css" type="text/css" rel="stylesheet">
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#process" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Result Process ');?>
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">            
                      
			<!----CREATION attendance1 FORM STARTS---->
			<div class="tab-pane box active" id="attendance1" style="padding: 5px">
                <div class="box-content">
					<button class="btn btn-gray grow" onclick="start_process()">Start Process</button>
                </div>                
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('loading',array('message'=>"Processing Result.Please wait...."));
?>
<script>
	function start_process()
	{
		$("#loading").show();
		$.ajax({
			url:"<?=site_url('admin/result_process/process')?>",
			success:function(msg)
			{
				$("#loading").hide();
				Growl.info({title:"Info",text:"Result Process Completed."});
			}
		});
	}
	/*function check_status()
	{
			var msg="<?php $this->session->userdata('status'); ?>";
			$("#loading_message").html(msg);
	}*/
</script>