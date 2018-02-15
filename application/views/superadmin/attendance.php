
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#attendance1" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Attendance ');?>
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">            
                      
			<!----CREATION attendance1 FORM STARTS---->
			<div class="tab-pane box active" id="attendance1" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/attendance/attendancebox' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group custom-block">                                    
                                    <label class="control-label"><?php echo translate('student_Attendance'); ?></label>
                                    <div class="controls">
									
					 <a class="btn btn-blue" href="<?php echo base_url(); ?>index.php?admin/student_attendance" rel="tooltip" data-placement="right" 
               data-original-title="" window="new" win_height="816px" win_width="1200px">
                <span><?php echo translate('manage_student_Attendance'); ?></span>
            </a>
                                        
                                        
                                     </div>
                                </div> 
                             <div class="control-group custom-block">                                    
                                    <label class="control-label"><?php echo translate('employee_Attendance'); ?></label>
                                    <div class="controls">
									
									 
                         				 <a class="btn btn-blue" href="<?php echo base_url(); ?>index.php?admin/employee_attendance" rel="tooltip" data-placement="right" 
               data-original-title="" window="new" win_height="816px" win_width="1200px">
                <span><?php echo translate('manage_employee_Attendance'); ?></span>
            </a> </div>
                                </div> 
                        </div>
					
						
						
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
			
			<!----CREATION attendance2 FORM STARTS---->
			<div class="tab-pane box" id="attendance2" style="padding: 5px">
                
			</div>
			<!----CREATION College FORM ENDS--->
            
		</div>
	</div>
</div>