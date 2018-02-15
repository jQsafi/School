<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('tabulation_sheet');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                       <td>
					   <?php echo translate('select_exam');?></td>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
						<td>&nbsp;</td>
                	</tr>
                	<tr>
                       <td>
                            <select name="exam_id" class=""  style="float:left;">
                                <option value=""><?php echo translate('all_exam'); ?></option>
                                <?php
                                $exams = $this->db->get('exam')->result_array();
                                foreach ($exams as $row):
                                    ?>
                                    <option value="<?php echo $row['exam_id']; ?>"
                                            <?php if ($_POST['exam_id'] == $row['exam_id']) echo 'selected'; ?>>
                                                <?php echo translate('exam_name:'); ?> <?php echo $row['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                        	<select name="class_id" class=""style="float:left;" required="">
                                <option value=""><?php echo translate('select_a_class');?></option>
                                <?php 
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($_POST['class_id'] == $row['class_id'])echo 'selected';?>>
                                            <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
						<td>
                        	<select name="group_id" class="" style="width:100%;" id="std_group_name">
							<option value="">Select Group</option>
                            <?php
								echo make_select('group','group_id','group_name',$_POST['group_id']);
							?>
                            </select>
                        </td>
					<td>
                    		<input type="submit" value="<?php echo translate('submit');?>" class="btn btn-normal btn-gray" />
                    </td>
					</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($_POST):
				$class_id=$this->input->post('class_id');
				$exam_id=$this->input->post('exam_id');
				$group_id=$this->input->post('group_id');
				$parent_id='';
				if($exam_id)
					$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
				?>
				<section id="print">
				<table id="export" class="table scrollable" style="font-size: 10px !important;">
				<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Subject</th>
					<?php
						$this->db->from('subject');
						$this->db->where('class_id',$_POST['class_id']);
						if($group_id)
						$this->db->where('group_id',$_POST['group_id']);
						$subject=$this->db->get();
						$total_subject=$subject->num_rows();
						$subject=$subject->result();
						$subjects=array();
						foreach($subject as $row)
						{
							$subject_id=$row->subject_id;
							$subject_name=$row->short_name;
							$subjects[]=$subject_id;
							?>
								<th colspan="6"><?=$subject_name?></th>
							<?php
						}
						?>
						<th colspan="4">
							<?=translate('total')?>
						</th>
						<?php if(!$parent_id){ ?>
						<th colspan="4">
							<?=translate('grand_total')?>
						</th>
						<?php
						}
						$all_result=FALSE;
						if(!$exam_id)
						{
							$all_result=TRUE;
							?>
								<th colspan="4">
									<?=translate('overall_total')?>
								</th>
							<?php
						}
						?>
						</tr>
						<tr>
						<th>Roll-Name</th>
						<th><?=translate('exam')?></th>
						<?php
						foreach($subject as $row)
						{
							?>
								<th>W</th>
								<th>O</th>
								<th>P</th>
								<th>T</th>
								<th>GPA</th>
								<th>LG</th>
							<?php
						}
					?>
					<?php if(!$parent_id){ ?>
					<th>
						Mark
					</th>
					<th>
						GPA
					</th>
					<th>
						Grade
					</th>
					<th>
						Position
					</th>
					<?php
					}
					?>
					<th>
						Mark
					</th>
					<th>
						GPA
					</th>
					<th>
						Grade
					</th>
					<th>
						Position
					</th>
					<?php
					if($all_result)
						{
						?>
							<th>
								Mark
							</th>
							<th>
								GPA
							</th>
							<th>
								Grade
							</th>
							<th>
								Position
							</th>
						<?php
						}
						?>
				</tr>
				</thead>
				<tbody>
                <?php
				if($exam_id)
				{
					$this->db->where('exam_id',$exam_id);
				}
				if(!$exam_id)
				{
					$this->db->where('parent_id','0');
				}
				$all_exams=$this->db->from('exam')->get()->result();
				$row_span=0;
				foreach($all_exams as $all_exam)
				{
					$xm_id=$all_exam->exam_id;
					$subexamcount=get_single_value('count(exam_id)','exam',array('parent_id'=>$xm_id));
					if(!$subexamcount)
					$subexamcount=1;
					$row_span+=$subexamcount;
				}
				$this->db->from('student');
				$this->db->where('student.class_id',$class_id);
				if($group_id)
				$this->db->where('group',$group_id);
				$res=$this->db->get()->result();
				$current_id=0;
				foreach($res as $row)
				{
					$student_id=$row->student_id;
					$student_name=$row->nick_name;
					$roll=$row->roll;
					$exam_counted=0;
					echo '<tr>';
					foreach($all_exams as $all_exam)
					{
					$exam_id=$all_exam->exam_id;
					$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
					$subexamcount=0;
					if(!$parent_id)
					{
						$subexamcount=get_single_value('count(exam_id)','exam',array('parent_id'=>$exam_id));
						if(!$subexamcount)
						{
							$exam_name=get_single_value('short_name','exam',array('exam_id'=>$exam_id));
							if(!$all_result)
							{
								?>
									<td><?=$roll?>&nbsp;-&nbsp;<?=$student_name?></td>
								<?php
							}
							if($all_result and !$exam_counted)
							{
								?>
									<td rowspan="<?=($row_span)?>"><?=$roll?>&nbsp;-&nbsp;<?=$student_name?></td>
								<?php
							}
							if($exam_counted)
							echo "<tr>";
							?>
							<td><?=$exam_name?></td>
							<?php
							foreach($subjects as $subject_id)
							{
								$this->db->where('subject_id',$subject_id);
								$this->db->where('exam_id',$exam_id);
								$this->db->where('sub_exam_id',"99999");
								$this->db->where('student_id',$student_id);
								$result=$this->db->from('mark')->get()->row();
								if($result)
								{
									echo "<td>".$result->formation."</td>";
									echo "<td>".$result->objective."</td>";
									echo "<td>".$result->practical."</td>";
									echo "<td>".$result->sub_total."</td>";
									$css_class='';
									if($result->grade=='F')
									$css_class="class='red'";
									echo "<td>".$result->sgpa."</td>";
									echo "<td ".$css_class.">".$result->grade."</td>";	
								}
								else
								{
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";	
								}
							}
							$this->db->where('exam_id',$exam_id);
							$this->db->where('sub_exam_id','99999');
							$this->db->where('student_id',$student_id);
							$extra_result=$this->db->from('exam_result')->get()->row();
							if(count($extra_result))
							{
								$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
								echo "<td>".$extra_result->total_mark."</td>";
								echo "<td>".$extra_result->gpa."</td>";
								echo "<td class=".$css_class.">".$extra_result->grade."</td>";
								echo "<td>".number_to_word($extra_result->merit_position)."</td>";	
							}
							else
							{
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
							}
							$this->db->where('exam_id',$exam_id);
							$this->db->where('sub_exam_id','0');
							$this->db->where('student_id',$student_id);
							$main_exam_result=$this->db->from('exam_result')->get()->row();
							if(count($main_exam_result))
							{
								$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
								echo "<td>".$main_exam_result->total_mark."</td>";
								echo "<td>".$main_exam_result->gpa."</td>";
								echo "<td>".$main_exam_result->grade."</td>";
								echo "<td>".number_to_word($main_exam_result->merit_position)."</td>";	
							}
							else
							{
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
							}
							if($all_result and !$exam_counted)
							{
								$this->db->where('exam_id','0');
								$this->db->where('sub_exam_id','0');
								$this->db->where('student_id',$student_id);
								$final_result=$this->db->from('exam_result')->get()->row();
								$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
								if(count($final_result))
								{
									echo "<td rowspan=".($row_span).">".$final_result->total_mark."</td>";
									echo "<td rowspan=".($row_span).">".$final_result->gpa."</td>";
									echo "<td rowspan=".($row_span).">".$final_result->grade."</td>";
									echo "<td rowspan=".($row_span).">".number_to_word($final_result->merit_position)."</td>";	
								}
								$exam_counted++;
							}
							echo '</tr>';
						}
						else
						{
							if($exam_counted)
							echo "<tr>";
							$sub_exams=$this->db->where('parent_id',$exam_id)->from('exam')->get()->result();
							$count=0;
							foreach($sub_exams as $exams)
							{
								$sub_exam_id=$exams->exam_id;
								$exam_name=$exams->short_name;
								$span=$subexamcount;
								if($all_result and !$exam_counted)
								{
									?>
										<td rowspan="<?=($row_span)?>"><?=$roll?>&nbsp;-&nbsp;<?=$student_name?></td>
									<?php
								}
								if($count==0)
								{
									if(!$all_result)
									{
										?>
											<td rowspan="<?=$span?>"><?=$roll?>&nbsp;-&nbsp;<?=$student_name?></td>
										<?php	
									}
								}
								?>
								<td><?=$exam_name?></td>
								<?php
								foreach($subjects as $subject_id)
								{
									$this->db->where('subject_id',$subject_id);
									$this->db->where('exam_id',$exam_id);
									$this->db->where('sub_exam_id',$sub_exam_id);
									$this->db->where('student_id',$student_id);
									$result=$this->db->from('mark')->get()->row();
									if($result)
									{
										$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
										echo "<td>".$result->formation."</td>";
										echo "<td>".$result->objective."</td>";
										echo "<td>".$result->practical."</td>";
										echo "<td>".$result->sub_total."</td>";
										echo "<td>".$result->sgpa."</td>";
										echo "<td>".$result->grade."</td>";	
									}
									else
									{
										echo "<td>-</td>";
										echo "<td>-</td>";
										echo "<td>-</td>";
										echo "<td>-</td>";
										echo "<td>-</td>";
										echo "<td>-</td>";
									}
								}
								$this->db->where('exam_id',$exam_id);
								$this->db->where('sub_exam_id',$sub_exam_id);
								$this->db->where('student_id',$student_id);
								$extra_result=$this->db->from('exam_result')->get()->row();
								if(count($extra_result))
								{
									$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
									echo "<td>".$extra_result->total_mark."</td>";
									echo "<td>".$extra_result->gpa."</td>";
									echo "<td>".$extra_result->grade."</td>";
									echo "<td>".number_to_word($extra_result->merit_position)."</td>";	
								}
								else
								{
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
								}
								if(!$count)	
								{
									$this->db->where('exam_id ',$exam_id);
									$this->db->where('sub_exam_id ','0');
									$this->db->where('student_id',$student_id);
									$gt_result=$this->db->from('exam_result')->get()->row();
									if($gt_result)
									{
										$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
										echo "<td rowspan=".$span.">".$gt_result->total_mark."</td>";
										echo "<td rowspan=".$span.">".$gt_result->gpa."</td>";
										echo "<td rowspan=".$span.">".$gt_result->grade."</td>";
										echo "<td rowspan=".$span.">".number_to_word($gt_result->merit_position)."</td>";
									}
									else
									{
										echo "<td rowspan=".$span.">-</td>";
										echo "<td rowspan=".$span.">-</td>";
										echo "<td rowspan=".$span.">-</td>";
										echo "<td rowspan=".$span.">-</td>";
									}
								}
								if($all_result and !$exam_counted)
								{
									$this->db->where('exam_id','0');
									$this->db->where('sub_exam_id','0');
									$this->db->where('student_id',$student_id);
									$final_result=$this->db->from('exam_result')->get()->row();
									if(count($all_result))
									{
										$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
										echo "<td rowspan=".($row_span).">".$final_result->total_mark."</td>";
										echo "<td rowspan=".($row_span).">".$final_result->gpa."</td>";
										echo "<td rowspan=".($row_span).">".$final_result->grade."</td>";
										echo "<td rowspan=".($row_span).">".number_to_word($final_result->merit_position)."</td>";	
									}
									$exam_counted++;
								}
								echo '</tr>';
								$count++;
							}
						}
					}
					else
					{
						$exam_name=get_single_value('short_name','exam',array('exam_id'=>$exam_id));
						
						if(!$all_result)
						{
							?>
							<td><?=$roll?>&nbsp;-&nbsp;<?=$student_name?></td>
							<?php
						}
						if($exam_counted)
							echo "<tr>";
						if($all_result and !$exam_counted)
								{
									?>
										<td rowspan="<?=($row_span+1)?>"><?=$roll?>&nbsp;-&nbsp;<?=$student_name?></td>
									<?php
								}
						?>
						
						<td><?=$exam_name?></td>
						<?php
						foreach($subjects as $subject_id)
						{
							$this->db->where('subject_id',$subject_id);
							$this->db->where('exam_id',$parent_id);
							$this->db->where('sub_exam_id',$exam_id);
							$this->db->where('student_id',$student_id);
							$result=$this->db->from('mark')->get()->row();
							if($result)
							{
								
							$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
							echo "<td>".$result->formation."</td>";
							echo "<td>".$result->objective."</td>";
							echo "<td>".$result->practical."</td>";
							echo "<td>".$result->sub_total."</td>";
							echo "<td>".$result->sgpa."</td>";
							echo "<td>".$result->grade."</td>";
							}
							else
							{
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
							}
						}
						$this->db->where('exam_id ',$parent_id);
						$this->db->where('student_id',$student_id);
						$this->db->where('sub_exam_id',$exam_id);
						$gt_result=$this->db->from('exam_result')->get()->row();
						if($gt_result)
						{
							$css_class='';
								if($extra_result->grade=='F')
								$css_class="class='red'";
							echo "<td>".$gt_result->total_mark."</td>";
						echo "<td>".$gt_result->gpa."</td>";
						echo "<td>".$gt_result->grade."</td>";
						echo "<td>".number_to_word($gt_result->merit_position)."</td>";
						}
						
						else
							{
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
							}
							if($all_result and !$exam_counted)
							{
								$this->db->where('exam_id','0');
								$this->db->where('sub_exam_id','0');
								$this->db->where('student_id',$student_id);
								$final_result=$this->db->from('exam_result')->get()->row();
								if(count($final_result))
								{
									$css_class='';
									if($extra_result->grade=='F')
									$css_class="class='red'";
									echo "<td rowspan=".($row_span).">".$final_result->total_mark."</td>";
									echo "<td rowspan=".($row_span).">".$final_result->gpa."</td>";
									echo "<td rowspan=".($row_span).">".$final_result->grade."</td>";
									echo "<td rowspan=".($row_span).">".number_to_word($final_result->merit_position)."</td>";	
								}
								$exam_counted++;
							}
							echo '</tr>';
					}
						?>
					<?php
					}
				}
				?>
				</tbody>
				</table>
				</section>
				<br>
				<button class="btn btn-blue" print="#export">Print</button>
            <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
			<div>
					                    
            
		</div>
	</div>
</div>
<style>
th
{
	text-align:center !important;
	border-top: 1px solid rgb(204, 204, 204) !important;
}
</style>