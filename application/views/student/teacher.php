<?php 
foreach($output->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($output->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

            		<div class="action-nav-normal">
                        <div class="action-nav-button" style="width:300px;">
                                    <a href="<?=site_url('student/teacher')?>" title="Teachers">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span> 
										<?php
										$condition=array();
										$condition['teacher_id >']='0';
										$total_teacher=get_single_value('count(teacher_id)','teacher',$condition);
										echo translate('total_teacher').' '.translate($total_teacher);
										?></span>	
                                    </a>
                                </div>
								<div class=" action-nav-button" style="width:300px;">
                                    <a href="<?=site_url('student/teacher/1')?>" title="Teacher">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span><?php 
										$condition['status']=1;
										$active=get_single_value('count(teacher_id)','teacher',$condition);
										echo translate('active_teacher').' '.translate($active);
										?></span>
                                    </a>
                                </div>
								<div class=" action-nav-button" style="width:300px;">
                                    <a href="<?=site_url('student/teacher/0')?>" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span><?php
										$condition['status']=0;
										$inactive=get_single_value('count(teacher_id)','teacher',$condition);
										echo translate('inactive_teacher').' '.translate($inactive);
										?> 
										</span>
                                    </a>
                                </div>
                    </div>
                    <div class="box box-header">
                        <div class="box-content">
							<?php
										echo $output->output;
							?>
						</div>
					</div>
<script>
	$(function()
{
	$(".edit_button").click(function(e)
	{
		e.preventDefault();
		$this=$(this);
		var goto=$this.attr('href');
		var height="800px";
		var width="1200px";
		var win = window.open(goto,'','width='+width+',height='+height+',menubar=yes,status=no,directories=no,scrollbars=yes,resizable=yes,toolbar=no');
		win.focus();
		return true;
	});
});
</script>