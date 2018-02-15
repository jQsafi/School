<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#attendance1" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('student_Attendance ');?>
                    	</a></li>
			<li>
            	<a href="#attendance2" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('employee_Attendance');?>
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
									
										<input type="text" class="datepicker fill-up" name="attandancedate" placeholder="Enter Date"/>
                                        <select name="classid" class="uniform" style="width:100%;" id="classid">
                                            <option value="">- Select Class -</option>
                                            <?php
                                            $classes = $this->db->get('class')->result_array();
                                            foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id']; ?>">
                                                    <?php echo $row['name']; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <select name="group" class="uniform" style="width:100%;" id="subjectid">
                                            <option value="">- Select Subject -</option>
											<?php
                                            $classes = $this->db->get('subject')->result_array();
                                            foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['subject_id']; ?>">
                                                    <?php echo $row['name']; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>                                    
                                         <button type="submit" class="btn btn-blue"><?php echo translate('manage_attendance');?></button>
                                    </div>
                                </div> 
                        </div>
						</form>
						
						<?php echo form_open('admin/subject/create' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="form-actions">
						<div id="manageattendance"></div>
						
                            <button type="submit" class="btn btn-gray"><?php echo translate('save');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
			
			<!----CREATION attendance2 FORM STARTS---->
			<div class="tab-pane box" id="attendance2" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/college/create' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('group');?></label>
                                <div class="controls">
                                    <select name="group_id" class="uniform" style="width:100%;">
                                    	<option value="1">Science</option>
										<option value="2">Business Studies</option>
										<option value="3">Humanities</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('category');?></label>
                                <div class="controls">
                                    <select name="category_id" class="uniform" style="width:100%;">
                                    	<option value="1">Compulsory</option>
										<option value="2">Other Subject</option>
										<option value="3">Optional</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('add_subject');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION College FORM ENDS--->
            
		</div>
	</div>
</div>