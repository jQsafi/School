<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Tabulation Sheet');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/tabulation_sba');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                       <td><?php echo translate('select_exam');?></td>
                        <!--<td><?php echo translate('Sub_exam');?></td>-->
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
                        <td><?php echo translate('select_subject');?></td>
						<td>&nbsp;</td>
                	</tr>
                	<tr>
                       <td>
                            <select name="exam_id" class=""  style="float:left;"  onchange="show_subExam(this.value)">
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
                        	<select name="class_id" class=""  onchange="show_subjects(this.value);showgroup(this.value);"  style="float:left;">
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
                        	<!-----SELECT SUBJECT ACCORDING TO SELECTED CLASS--------->
							<?php 
                                $classes	=	$this->crud_model->get_classes(); 
                                foreach($classes as $row): ?>
                                
                                <select name="<?php if($class_id == $row['class_id'])echo 'subject_id';else echo 'temp';?>" 
                                      id="subject_id_<?php echo $row['class_id'];?>" 
                                          style="display:<?php if($class_id == $row['class_id'])echo 'block';else echo 'none';?>;" class=""  style="float:left;">
                                  
                                    <option value="">Subject of class <?php echo $row['name'];?></option>
                                    
                                    <?php 
                                    $subjects	=	$this->crud_model->get_subjects_by_class($row['class_id']); 
                                    foreach($subjects as $row2):
									$group_id=$row2['group_id'];
									//if($status==0)
									{
									?>
                                    <option value="<?php echo $row2['subject_id'];?>" 
									<?php if(isset($subject_id) && $subject_id == $row2['subject_id'])
                                                echo 'selected="selected"'; echo 'group='.$group_id;?>>
												<?php echo $row2['name'];?>
                                    </option>
                                    <?php 
									}
									endforeach;?>
                                    
                                    
                                </select> 
                            <?php endforeach;?>
                            
                            
                            <select name="temp" id="subject_id_0" 
                              style="display:<?php if(isset($subject_id) && $subject_id >0)echo 'none';else echo 'block';?>;" class="" style="float:left;">
                                    <option value="">Select a class first</option>
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
                
                
                <?php if($_POST):?>
				<table id="export" class="table table-normal table-bordered">
				<thead>
				<tr>
					<td colspan="9" align="center">
    <h1><?php echo get_single_value('description','settings',array('type'=>'system_name'));?></h1>
    <h2><?php echo get_single_value('description','settings',array('type'=>'address'));?></h2>
					</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<th>Subject</th>
					<?php
						$this->prog_card->meritlist();
						$this->db->from('subject');
						if($_POST['class_id'])
						$this->db->where('class_id',$_POST['class_id']);
						if($_POST['group_id'])
						$this->db->where('group_id',$_POST['group_id']);
						if($_POST['subject_id'])
						$this->db->where('subject_id',$_POST['subject_id']);
						$subject=$this->db->get();
						$total_subject=$subject->num_rows();
						$subject=$subject->result();
						foreach($subject as $row)
						{
							$subject_id=$row->subject_id;
							$subject_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
							?>
								<th colspan="5"><?=$subject_name?></th>
							<?php
						}
						?>
						<th rowspan="2">
							Grand Total
						</th>
						<th rowspan="2">
							Merit List
						</th>
						</tr>
						<tr>
						<th>Name</th><th>Exam Name</th>
						<?php
						foreach($subject as $row)
						{
							?>
								<th>W</th><th>O</th><th>P</th><th>S</th><th>T</th>
							<?php
						}
					?>
				</tr>
				</thead>
				<tbody>
                <?php
				$this->db->from('student');
				if($_POST['class_id'])
				$this->db->where('class_id',$_POST['class_id']);
				if($_POST['group_id'])
				$this->db->where('group',$_POST['group_id']);
				$students=$this->db->get()->result();
				if(!$_POST['exam_id'])
				$exam_id='';
				$this->prog_card->meritlist($exam_id);
				foreach($students as $row)
				{
					$student_id=$row->student_id;
					$name=$row->name;
					$roll=$row->roll;
					$this->db->select('distinct(exam_id)');
					$this->db->from('mark');
					$this->db->where('student_id',$student_id);
					if($_POST['exam_id'])
					$this->db->where('exam_id',$_POST['exam_id']);
					$marks=$this->db->get();
					$row_span=$marks->num_rows();
					$row_span+=2;
					?>
						<tr>
							<td rowspan="<?=$row_span?>"><?=$roll?>&nbsp;-&nbsp;<?=$name?></td>
						</tr>
						<tr>
					<?php
					foreach($marks->result() as $m)
					{
						$exam_id=$m->exam_id;
						$exam_name=get_single_value('name','exam',array('exam_id'=>$exam_id));
						?>
						<td><?=$exam_name?></td>
						<?php
						foreach($subject as $sub)
						{
							$subject_id=$sub->subject_id;
							$mark_condition=array(
							'student_id'=>$student_id,
							'exam_id'=>$exam_id,
							'subject_id'=>$subject_id
							);
							$full_mark=get_single_value('total_marks','mark',$mark_condition);
							$formation=get_single_value('formation','mark',$mark_condition);
							$objective=get_single_value('objective','mark',$mark_condition);
							$practical=get_single_value('practical','mark',$mark_condition);
							$sba=get_single_value('sba','mark',$mark_condition);
							$total=get_single_value('sub_total','mark',$mark_condition);
							$total+=0;
							$gpa=get_gpa($total,$full_mark);
							if(!$full_mark)
							{
								$full_mark="-";
								$formation="-";
								$objective="-";
								$practical="-";
								$sba="-";
								$total="-";
								$gpa="-";
							}
							$td_class="bg-success";
							if(!$gpa)
							$td_class="alert-error";
							?>
							<td><?=$formation?></td>
							<td><?=$objective?></td>
							<td><?=$practical?></td>
							<td><?=$sba?></td>
							<td class="<?=$td_class?>"><?=$total?></td>
							<?php
						}
						$position=$this->prog_card->get_position($student_id);
						//$position=merit_position($exam_id,$_POST['class_id'],'',$student_id);
						$total_mark=$this->prog_card->grand_total_mark($student_id,$exam_id);
						$total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id);
						if($total_gpa<=0)
						{
							$position='X';
						}
						?>
						<td><?=$total_mark?></td>
						<td><?=$position?></td>
						<?php
					}
					?>
					</tr>
					<tr>
					<th>Grand Total</th>
					<?php
						foreach($subject as $sub)
						{
							$subject_id=$sub->subject_id;
							$mark_condition=array(
							'student_id'=>$student_id,
							'subject_id'=>$subject_id
							);
							$full_mark=get_single_value('sum(total_marks)','mark',$mark_condition);
							$formation=get_single_value('sum(formation)','mark',$mark_condition);
							$objective=get_single_value('sum(objective)','mark',$mark_condition);
							$practical=get_single_value('sum(practical)','mark',$mark_condition);
							$sba=get_single_value('sum(sba)','mark',$mark_condition);
							$total=get_single_value('sum(sub_total)','mark',$mark_condition);
							$total+=0;
							$total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id);
							if($total_gpa<=0)
							{
								$position='X';
							}
							?>
							<th><?=$formation?></th>
							<th><?=$objective?></th>
							<th><?=$practical?></th>
							<td><?=$sba?></td>
							<th><?=$total?></th>
							<?php
						}
					?>
					<?php
							$total_mark=$this->prog_card->grand_total_mark($student_id);
							$total_gpa=$this->prog_card->grand_total_gpa($student_id);
							//$position=merit_position('',$_POST['class_id'],'',$student_id);
							$position=$this->prog_card->get_position($student_id);
							if($total_gpa<=0)
							{
								$position='X';
							}
							?>
							<th><?=$total_mark?></th>
							<th><?=$position?></th>
					</tr>
					<?php
				}
				?>
				</tbody>
				</table>
				<br>
				<a data-toggle="modal" href="#" onClick ="$('#export').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
					                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
					                    </a>
					                    <a data-toggle="modal" href="#" onClick ="$('#export').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
					                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
					                    </a>
            <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
			<div>
					                    
            
		</div>
	</div>
</div>
<script type="text/javascript">
$(function()
{
	$("#std_group_name").trigger('change');
});
$("#std_group_name").change(function()
{
	var group=$(this).val();
	$("[group]").hide();
	$("[group="+group+"]").show();
	$("[group=0]").show();
});
  function show_subjects(class_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('subject_id_'+i).style.display = 'none' ;
	  		  document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
      document.getElementById('subject_id_'+class_id).style.display = 'block' ;
	  document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
  }
  function showgroup(class_id)
  {
  	/*if(class_id<9)
	{
		$("#std_group_name").val('');
		$("#std_group_name").attr('disabled','false');
	}
	else
	{
		$("#std_group_name").removeAttr('disabled','true');
	}*/
  }
  function show_subExam(exam_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('exam_id_'+i).style.display = 'none' ;
	  		  document.getElementById('exam_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
	  if(exam_id >0)
	  {
        document.getElementById('exam_id_'+ exam_id ).style.display = 'block' ;
		document.getElementById('exam_id_'+ exam_id ).setAttribute("name" , "exam_sub_id");
		}
  }

</script> 