<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Progress Card
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/progress_card_2');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_exam');?></td>
                        <td><?php echo translate('Grade');?></td>
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
                            <select name="exam" class=""  style="float:left;">
							<option value=""><?php echo translate('select_exam'); ?></option>
							<?php
								$exam=$this->input->post('exam');
								if(!$exam)
								$exam='';
								echo make_select('exam','exam_id','name',$exam);
							?>
							</select>
						</td>
                         <td>
                            <select name="grade" class=""  style="float:left;">
                                <option value=""><?php echo translate('Select Grade'); ?></option>
                                <?php
								$grade=$this->input->post('grade');
								if(!$grade)
								$grade='';
								echo make_select('grade','name','name',$grade,'grade_point','desc');
								?>
                            </select>
                        </td>
                        
                        
                        
                        <td> 
                        	<input type="hidden" name="operation" value="selection" />
                    		<input type="submit" value="Submit" class="btn btn-normal btn-gray" />
                        </td>
                	</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($class_id >0  ):?>
                <?php 
                     
                    $this->db->select('student.name,student_id,student.roll,student.group,student.passing_year, student.section, student.student_unique_ID,student.fourth_id,student.class_id');
                    $this->db->from('student');
                    $this->db->where('student.class_id', $class_id);
                    $query_result = $this->db->get();
		?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div><?php echo translate('Student ID');?></div></th>
							<th><div><?php echo translate('Roll');?></div></th>
                            <th><div><?php echo translate('Student Name');?></div></th>
                            <th><div><?php echo translate('Group');?></div></th>
                            <th><div><?php echo translate('Section');?></div></th>
                            <th><div><?php echo translate('Session');?></div></th>
							<th><div><?php echo translate('exam');?></div></th>
                            <th><div>Total Obtain Mark</div></th>
                            <th><div>Highest Mark</div></th>
							<th><div>Merit List</div></th>
                            <th><div><?php echo translate('GPA');?></div></th>
							<th><div>Letter Grade</div></th>
                        </tr>
                    </thead>
					<tbody>
						<?php
							/*$merit_list=$this->prog_card->merit_list();*/
						?>
                        <?php foreach ($query_result->result() as $item ):?>
						<?php
							$this->load->helper('mark_sheet');
							$student_id=$item->student_id;
							$class_id=$item->class_id;
							$fourth_id=$item->fourth_id;
							if($exam)
							{
								$exam_name=get_single_value('name','exam',array('exam_id'=>$exam));
								$position='';//merit_position($exam,$class_id,'',$student_id);
								$total_mark='';//merit_position($exam,$class_id,$position);
								$gpa=final_gpa($student_id,$class_id,$exam,$fourth_id);
								$highest_mark='';//merit_position($exam,$class_id,1);
								$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam));
								$link=site_url('progress_card/progress_card_details_2/'.$student_id.'/'.$exam.'/'.$class_id);
							}
							if(!$exam)
							{
								$exam_name='All Exam';
								$position='';//merit_position('',$class_id,'',$student_id);
								$total_mark='';//merit_position('',$class_id,$position);
								$highest_mark='';//merit_position('',$class_id,1);
								$link=site_url('progress_card/progress_card_details_2/'.$student_id.'/all/'.$class_id);
								$this->db->where('class_id',$class_id);
								//$this->db->where('student_id',$student_id);
								$this->db->select('distinct(exam_id)');
								$xms=$this->db->get('mark');
								$gpa=0;
								foreach($xms->result() as $xm)
								{
									$exam_id=$xm->exam_id;
									$gpa+=final_gpa($student_id,$class_id,$exam_id,$fourth_id);
								}
								$xm_number=$xms->num_rows();
								$gpa/=$xm_number;
								if($gpa>5)
								$gpa=5;
								$gpa=number_format($gpa,2);
							}
							$lg=get_letter_grade($gpa);
							if($lg=='F')
							{
								$position=0;
							}
							if($grade?$grade==$lg:$grade!=$lg):
						?>
                    
                        <tr>
                            <td>
								<a href="<?php echo $link;?>"  window="new" win_height="816px" win_width="800px"><?php echo $item->student_unique_ID;?></a>
							</td>
							<td>
								<a href="<?php echo $link;?>"  window="new" win_height="816px" win_width="800px"><?php echo $item->roll;?></a>
							</td>
                            <td><a href="<?php echo $link;?>"  window="new" win_height="816px" win_width="800px"><?php echo $item->name;?></a></td>
                           <td><?php echo get_single_value('group_name','group',array('group_id'=>$item->group));?></td>
						   <td><?php echo $item->section;?></td>
                           <td><?php echo date('Y');?></td>
						   <td><?php echo $exam_name;?></td>
                           <td><?php echo $total_mark;?></td>
                           <td><?php echo $highest_mark;?></td>
						   <td><?php echo $position;?></td>
						   <td><?php echo $gpa; ?></td>
                           <td><?php echo $lg;?></td>
                        </tr>
                        <?php 
						endif;
						endforeach;?>
                        </tbody>
                  </table>
                                            
            
            <?php  endif;?>
			</div>
			<div>
                    <a data-toggle="modal" href="#" onClick ="$('#export').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#export').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                </div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</div>
 