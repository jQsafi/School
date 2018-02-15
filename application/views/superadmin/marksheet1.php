<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Mark Sheet');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/marksheet');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_exam');?></td>
                        <td><?php echo translate('Grade');?></td>
<!--                        <td><?php echo translate('select_class');?></td>
                        <td><?php echo translate('select_subject');?></td>-->
                        <td>&nbsp;</td>
                	</tr>
                	<tr>
                        <td>
                        	<select name="class_id" class=""  onchange="show_subjects(this.value)"  style="float:left;">
                                <option value=""><?php echo translate('select_a_class');?></option>
                                <?php 
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                                            Class <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                         <td>
                            <select name="grad" class=""  style="float:left;">
                                <option value=""><?php echo translate('Select Grad'); ?></option>
                                <option <?php echo (isset($grad) && $grad !="" && $grad =="A+") ? 'selected="selected"' : '';?>  value="A+">A+</option>
                                <option <?php echo (isset($grad) && $grad !="" && $grad =="A") ? 'selected="selected"' : '';?> value="A">A</option>
                                <option <?php echo (isset($grad) && $grad !="" && $grad =="A-") ? 'selected="selected"' : '';?> value="A-">A-</option>
                                <option <?php echo (isset($grad) && $grad !="" && $grad =="B") ? 'selected="selected"' : '';?> value="B">B</option>
                                <option <?php echo (isset($grad) && $grad !="" && $grad =="D") ? 'selected="selected"' : '';?> value="D">D</option>
                                <option <?php echo (isset($grad) && $grad !="" && $grad =="F") ? 'selected="selected"' : '';?> value="F">F</option>
                            </select>
                        </td>
                        
                        
                        
                        <td> 
                        	<input type="hidden" name="operation" value="selection" />
                    		<input type="submit" value="<?php echo translate('manage_marks');?>" class="btn btn-normal btn-gray" />
                        </td>
                	</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($class_id >0  ):?>
                <?php 
                    $this->db->select_max('total');
                    $this->db->from('marksheet');
                    
                    $this->db->where('marksheet.class_id', $class_id);	
                    if(isset($grad) && $grad !=""){
                    $this->db->where('marksheet.gpa', $grad);	
                    }
                    
                    $query_result = $this->db->get();
                    $marks_max = $query_result->row();
                     
                    $this->db->select('marksheet.*, student.name, student.roll, student.group, student.passing_year, student.section, student.student_unique_ID, exam.name as examname, class.name as classmname ');
                    $this->db->from('marksheet');
                    $this->db->join('student', 'marksheet.student_id=student.student_id', 'left');
                    $this->db->join('exam', 'marksheet.exam_id=exam.exam_id', 'left');
                    $this->db->join('class', 'marksheet.class_id=class.class_id', 'left');
                    
                    $this->db->where('marksheet.class_id', $class_id);	
                    if(isset($grad) && $grad !=""){
                     $this->db->where('marksheet.gpa', $grad);	
                    }
                    
                    $query_result = $this->db->get();
                     $marks = $query_result->result();
                
                 

		?>
                
                <table class="table table-normal box" >
                    <thead>
                        <tr>
                            <td><?php echo translate('Student ID');?></td>
                            <td><?php echo translate('Student Name');?></td>
                            <td><?php echo translate('Exam');?></td>
                            <td><?php echo translate('Publish Date');?></td>
                            <td><?php echo translate('Class');?></td>
                            <td><?php echo translate('Group');?></td>
                            <td><?php echo translate('Section');?></td>
                            <td><?php echo translate('Roll');?></td>
                            <td><?php echo translate('Session');?></td>
                            <td><?php echo translate('Grand Number');?></td>
                            <td><?php echo translate('Height Number');?></td>
                            <td><?php echo translate('GPA');?></td>
                            
                    </thead>
                        <?php foreach ($marks as $item ):?>
                    <tbody>
                        <tr>
                            <td><a href="<?php echo base_url();?>index.php?/admin/marksheet_single/<?php echo isset($item->class_id) ? $item->class_id : '';  echo isset($item->student_id) ? '/'.$item->student_id : '';?>"><?php echo $item->student_unique_ID;?></a></td>
                           <td><?php echo $item->name;?></td>
                           <td><?php echo $item->examname;?></td>
                           <td></td>
                           <td><?php echo $item->classmname;?></td>
                           <td><?php echo $item->group;?></td>
                           <td><?php echo date('Y');?></td>
                           <td><?php echo $item->roll;?></td>
                           <td><?php echo $item->section;?></td>
                           <td><?php echo $item->total;?></td>
                           <td><?php echo $marks_max->total;?></td>
                           <td><?php echo $item->gpa;?></td>
                            
                        </tr>
                     </tbody>
                        <?php endforeach;?>
                        
                  </table>
                                            
            
            <?php  endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</div>
 