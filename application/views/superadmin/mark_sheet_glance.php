
<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?=translate('mark_sheet_at_glance')?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane" id="list">
				<center>
                <?php echo form_open('');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                       <td><?php echo translate('select_exam');?></td>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
						<td>&nbsp;</td>
                	</tr>
                	<tr>
                       <td>
                            <select name="exam_id" class=""  style="float:left;">
                                <option value=""><?php echo translate('select_an_exam'); ?></option>
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
                        	<select name="class_id" class=""style="float:left;">
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
				if($exam_id)
				{
					$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
					if($parent_id)
					{
						$sub_exam_id=$exam_id;
						$exam_id=$parent_id;
					}
					else
					{
						$subexamcount=get_single_value('count(exam_id)','exam',array('parent_id'=>$exam_id));
						if(!$subexamcount)
						$sub_exam_id='99999';
						else
						$sub_exam_id=0;
					}
				}
				?>
<section>
<table class="table" id="print">
	<tr>
		<th colspan="2" align="center">
			<h2><?php echo translate('mark sheet at a glance report');?></h2>
		</th>
	</tr>
	<tr>
		<th>
			Total Student 
		</th>
		<td>
			<?php
			$condition=array();
			if($class_id)
			$condition['class_id']=$class_id;
			if($group_id)
			$condition['group']=$group_id;
			echo $total_students=get_single_value('count(student_id)','student',$condition);
			?>
		</td>
	</tr>
	<tr>
		<th>
			Total Examinee
		</th>
		<td>
			<?php
			$condition=array();
			if($class_id)
			$condition['class_id']=$class_id;
			if($exam_id)
			{
				$condition['exam_id']=$exam_id;
				$condition['sub_exam_id']=$sub_exam_id;
			}
			echo $total_examinee=get_single_value('count(distinct(student_id))','exam_result',$condition);
			?>
		</td>
	</tr>
	<tr>
		<th>
			Total Absent
		</th>
		<td>
			<?php
			echo $total_absent=$total_students-$total_examinee;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Total Passed Student Amount
		</th>
		<td>
			<?php
			$total_passed=0;
			$this->load->helper('mark_sheet');
			$this->db->select('student_id,fourth_id,class_id');
			if($class_id)
			$this->db->where('class_id',$class_id);
			if($group_id)
			$this->db->where('group',$group_id);
			$this->db->from('student');
			$students=$this->db->get();
			$ap=0;
			$A=0;
			$am=0;
			$B=0;
			$C=0;
			$D=0;
			$F=0;
			foreach($students->result() as $student)
			{
				$student_id=$student->student_id;
				$total_gpa=0;
				$exam_count=0;
				$lg=get_single_value('grade','exam_result',array('student_id'=>$student_id,'exam_id'=>'0','sub_exam_id'=>'0'));
				if($lg and $lg!='F' and $lg!='-')
				{
					$total_passed++;
				}
				if($lg=='A+')
				{
					$ap++;
				}
				else if($lg=='A-')
				{
					$am++;
				}
				else
				{
					$$lg++;
				}
			}
			echo $total_passed;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Total Passed Student By Persent
		</th>
		<td>
			<?php
				$total_passed_persent=($total_passed*100)/$total_examinee;
				$total_passed_persent=number_format($total_passed_persent,2);
				echo $total_passed_persent;
			?>%
		</td>
	</tr>
	<tr>
		<th>
			Total Failed
		</th>
		<td>
			<?php
				$total_failed=$total_examinee-$total_passed;
				echo $total_failed;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Amount Of A+
		</th>
		<td>
			<?php
				echo $ap;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Amount Of A
		</th>
		<td>
			<?php
				echo $A;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Amount Of A-
		</th>
		<td>
			<?php
				echo $am;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Amount Of B
		</th>
		<td>
			<?php
				echo $B;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Amount Of C
		</th>
		<td>
			<?php
				echo $C;
			?>
		</td>
	</tr>
	<tr>
		<th>
			Amount Of D
		</th>
		<td>
			<?php
				echo $D;
			?>
		</td>
	</tr>
	<tr>
		<th colspan="2">
			 Failed 
		</th>
	</tr>
	<?php
		$subject_str='';
		$this->db->select('subject.subject_id,subject.name,class.name as class_name,count(student_id) as failed');
		$this->db->from('subject');
		$this->db->where('mark.sgpa','0');
		$this->db->join('mark','subject.subject_id=mark.subject_id','left');
		$this->db->group_by('subject.subject_id');
		if($class_id)
		$this->db->where('subject.class_id',$class_id);
		if($group_id)
		$this->db->where('subject.group_id',$group_id);
		//$this->db->order_by('subject.name');
		$this->db->order_by('subject.class_id');
		$this->db->join('class','class.class_id=subject.class_id');
		$subjects=$this->db->get();
		foreach($subjects->result() as $subject)
		{
			$subject_name=$subject->name;
			$subject_id=$subject->subject_id;
			$failed_count=$subject->failed;
			$class_name=$subject->class_name;
			//$failed_count=get_single_value('count(student_id)','mark',$condition);
			$subject_str.='<tr><th>Failed in '.$subject_name.'&nbsp;&nbsp;<span class="muted">[&nbsp;'.$class_name.'&nbsp;]&nbsp;</span></th><td>'.$failed_count.'</tr>';
		}
		echo $subject_str;
	?>
</table>
</section>
<button class="btn btn-blue" print="#print">Print</button>
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