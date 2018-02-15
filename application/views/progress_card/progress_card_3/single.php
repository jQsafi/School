<html>
<head>
	<title>
		Progress Card of <?php echo get_single_value('name','student',array('student_id'=>$student_id));?>-<?php echo date("Y");?>
	</title>
</head>
<body>
<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url();?>template/css/print.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/css/font.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/css/marksheet.css">




            <!----TABLE LISTING STARTS--->
                <?php if($class_id >0  ):?>
<?php 
	$this->load->language('mark_sheet') ;
	$marks_header=$this->lang->line('marks_header');
	$main_exam_name=get_single_value('name','exam',array('exam_id'=>$exam_id));
	$sub_exam_count=get_single_value('count(exam_id)','exam',array('parent_id'=>$exam_id));
	$header=TRUE;
	if(!$sub_exam_count) 
	{
		$sub_exam_count=1;
		$header=FALSE;
	}
	$header_row_span_count=$sub_exam_count;
	if($header_row_span_count==1) $header_row_span_count=2;
		$main_colspan_count=$sub_exam_count*9;
	$publish_date=get_single_value('publishing_date','exam',array('exam_id'=>$exam_id));
	$sub_exams=$this->prog_card->sub_exams($exam_id);
	$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
	$main_subject=$this->prog_card->main_subject();
	$subjects=array();
	foreach($main_subject->result() as $subject)
	{
		$subject_id=$subject->subject_id;
		$subjects[]=$subject_id;
	}
	$group_subject=get_single_value('subject_id','student',array('student_id'=>$student_id));
	$group_subject=explode('SC',$group_subject);
	foreach($group_subject as $subject_id)
	{
		if($subject_id)
		$subjects[]=$subject_id;
	}
	$total_subject=count($subjects);
	if($fourth_subject)
		$subjects[]=$fourth_subject;
	$sub_exam_head_str='';
	$total_str='';
	$merit_str='';
	if($sub_exams->num_rows()>0)
	{
		foreach($sub_exams->result() as $exam)
		{
			$sub_exam_id=$exam->exam_id;
			$sub_exam_name=$exam->name;
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id
			);
			$sub_exam_head_str.='<td colspan=9>'.$sub_exam_name.'</td>';
			$full=get_single_value('sum(total_marks)','mark',$mark_condition);
			$formation=get_single_value('sum(formation)','mark',$mark_condition);
			$objective=get_single_value('sum(objective)','mark',$mark_condition);
			$practical=get_single_value('sum(practical)','mark',$mark_condition);
			$sba=get_single_value('sum(sba)','mark',$mark_condition);
			$heigst= merit_position($sub_exam_id,$class_id,1);
			$total_mark=$this->prog_card->grand_total_mark($student_id,$exam_id,$sub_exam_id);
			$total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id,$sub_exam_id);
			
			$twenty=$total_mark*.2;
			$lg=get_letter_grade($total_gpa);
			$position=merit_position($sub_exam_id,$class_id,'',$student_id);
			if($total_gpa<0)
			{
				$total_gpa="-";	
				$lg="-";
				$full="-";
				$formation="-";
				$objective="-";
				$practical="-";
				$sba="-";
				$total_mark="-";
				
				$twenty="-";
				$position='-';
				$heigst='-';
			}
			$total_str.="<td>".$full."</td>";
			$total_str.="<td>".$formation."</td>";
			$total_str.="<td>".$objective."</td>";
			$total_str.="<td>".$practical."</td>";
			$total_str.="<td>".$sba."</td>";
			$total_str.="<td>".$total_mark."</td>";
			$total_str.="<td>".$heigst."</td>";
			$total_str.="<td>".$total_gpa."</td>";
			$total_str.="<td>".$lg."</td>";
			$merit_str.='<td colspan=9>'.$position.'</td>';
			
		}
	}
	else
	{
		$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'exam_id'=>$exam_id
			);
		$full=get_single_value('sum(total_marks)','mark',$mark_condition);
	$formation=get_single_value('sum(formation)','mark',$mark_condition);
	$objective=get_single_value('sum(objective)','mark',$mark_condition);
	$practical=get_single_value('sum(practical)','mark',$mark_condition);
	$sba=get_single_value('sum(sba)','mark',$mark_condition);
	$heigst= merit_position($exam_id,$class_id,1);
	$total_mark=$this->prog_card->grand_total_mark($student_id,$exam_id);
	$total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id);
	
	$twenty=$total_mark*.2;
	$lg=get_letter_grade($total_gpa);
	$position=merit_position($exam_id,$class_id,'',$student_id);
	if($lg=="F")
	{
		$position="X";
	}
	if($total_gpa<0)
	{
		$total_gpa="-";	
		$lg="-";
		$full="-";
		$formation="-";
		$objective="-";
		$practical="-";
		$sba="-";
		$total_mark="-";
		$twenty="-";
		$position='-';
		$heigst='-';
	}
	$total_str.="<td>".$full."</td>";
	$total_str.="<td>".$formation."</td>";
	$total_str.="<td>".$objective."</td>";
	$total_str.="<td>".$practical."</td>";
	$total_str.="<td>".$sba."</td>";
	$total_str.="<td>".$total_mark."</td>";
	$total_str.="<td>".$heigst."</td>";
	$total_str.="<td>".$total_gpa."</td>";
	$total_str.="<td>".$lg."</td>";
	$merit_str.='<td colspan=9>'.$position.'</td>';	
	}
	$main_subject=$this->prog_card->main_subject();
	$subjects=array();
	foreach($main_subject->result() as $subject)
	{
		$subject_id=$subject->subject_id;
		$subjects[]=$subject_id;
	}
	$group_subject=get_single_value('subject_id','student',array('student_id'=>$student_id));
	$group_subject=explode('SC',$group_subject);
	foreach($group_subject as $subject_id)
	{
		if($subject_id)
		$subjects[]=$subject_id;
	}
	if($fourth_subject)
	$subjects[]=$fourth_subject;
?>
<div class="mainCon">
    <h1><?php echo get_single_value('description','settings',array('type'=>'system_name'));?></h1>
    <h2><?php echo get_single_value('description','settings',array('type'=>'address'));?></h2>
    <h3>Progress Card <?php echo date("Y");?></h3>
</div>

<?php 
        $this->db->from('student');
        $this->db->where('student.student_id', $student_id);	
        $query_result = $this->db->get();
        $student = $query_result->row();
?>
<table class="marksheet-header-table">
    <tr>
        <td class="sPhoto">
			<img width="90" height="90" src="<?php echo base_url(). 'uploads/student_image/'. $student->student_id.'.jpg';?>" alt="No Photo"></td>
        <td>
            <p><strong>Name </strong>: <?php echo $student->name;?></p>
            <p><strong>Student ID </strong>: <?php echo $student->student_unique_ID;?></p>
			<p><strong>Father's Name </strong>: <?php echo $student->father_name;?></p>
			<p><strong>Mother's Name </strong>: <?php echo $student->mother_name;?></p>
            <p><strong>Result Publish Date </strong>: <?php echo $publish_date;?></p>
        </td>
        <td>
            <p><strong>Class : </strong><?php echo get_single_value('name','class',array('class_id'=>$class_id)); ?></p>
			<?php if($student->group):?>
            <p><strong>Group</strong>: <?php echo get_single_value('group_name','group',array('group_id'=>$student->group));?></p>
			<?php endif;
			if($student->section):?>
            <p><strong>Section</strong>: <?php echo $student->section;?></p>
			<?php endif;?>
            <p><strong>Roll</strong>: <?php echo $student->roll;?></p>
            <p><strong>Session</strong>: <?php echo date('Y');?></p>
            
        </td>
    </tr>
</table>
                 
            <div class="exam-wraper" style=" min-width: 800px;">
		<table class="result-card">
			<tr>
				<th  rowspan="<?=$header_row_span_count;?>" width="300px;">Subject&nbsp;Name</th>
				<th colspan="<?=$main_colspan_count?>"><?=$main_exam_name?></th>
				<?php if($header){
					?>
					<th colspan="3" rowspan="<?=($header_row_span_count-1)?>">Grand&nbsp;Total</th>
					<?php
				}
				?>
			</tr>
			<?php
				if($sub_exam_head_str)
				echo "<tr>".$sub_exam_head_str."</tr>";
			?>
			<tr>
				<?php 
				$exam_counter=0;
				while($exam_counter!=$sub_exam_count)
				{
					echo $marks_header;
					$exam_counter++;
				}
				if($header)
				{
				?>
				<td>Mark</td>
				<td>GPA</td>
				<td>Later Grade</td>
				<?php } ?>
			</tr>
			<?php 
			$exam_subject_count=0;
			$grand_total_mark=$this->prog_card->grand_total_mark($student_id,$exam_id);
			$grand_total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id);
			$grand_total_lg=get_letter_grade($grand_total_gpa);
			for($loop=0;$loop<count($subjects);$loop++):
			$subject=$subjects[$loop];
			?>
			<tr>
				<td><?=get_single_value('name','subject',array('subject_id'=>$subject))?></td>
				<?php
					if($sub_exams->num_rows()>0)
					{
						$exam_subject_count=0;
						$exam_total_mark=0;
						foreach($sub_exams->result() as $exam)
						{
							$sub_exam_id=$exam->exam_id;
							$marks=$this->prog_card->get_mark($student_id,$subject,$exam_id,$sub_exam_id);
							if($marks->num_rows()>0)
							{
								$exam_subject_count++;
								foreach($marks->result() as $rows)
								{
									$full_mark=$rows->total_marks;
									$written=$rows->formation;
									$objective=$rows->objective;
									$practical=$rows->practical;
									$sba=$rows->sba;
									$total=$rows->sub_total;
									$total+=0;
									$heigst=get_single_value('max(sub_total)','mark',array('subject_id'=>$subject,'exam_id'=>$exam_id,'sub_exam_id'=>$sub_exam_id));
									$heigst+=0;
									$gpa=get_gpa($total,$full_mark);
									$lg=get_letter_grade($gpa);
									if($full_mark=='-' or !$full_mark)
									{
										$full_mark='-';
										$written='-';
										$objective='-';
										$practical='-';
										$sba='-';
										$total='-';
										$heigst='-';
										$gpa='-'; 
										$lg='-';
									}
									echo "<td>".$full_mark."</td>";
									echo "<td>".$written."</td>";
									echo "<td>".$objective."</td>";
									echo "<td>".$practical."</td>";
									echo "<td>".$sba."</td>";
									echo "<td>".$total."</td>";
									echo "<td>".$heigst."</td>";
									echo "<td>".$gpa."</td>";
									echo "<td>".$lg."</td>";
								}
							}
							else
							{
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								//echo "<td>-</td>";
								//echo "<td>-</td>";
								echo "<td>-</td>";
							}
						}
					}
					else
					{
					$marks=$this->prog_card->get_mark($student_id,$subject,$exam_id);
					if($marks->num_rows()>0)
					{
						foreach($marks->result() as $rows)
						{
							$full_mark=$rows->total_marks;
							$written=$rows->formation;
							$objective=$rows->objective;
							$practical=$rows->practical;
							$sba=$rows->sba;
							$total=$rows->sub_total;
							$total+=0;
							$heigst=get_single_value('max(sub_total)','mark',array('subject_id'=>$subject,'exam_id'=>$exam_id));
							$heigst+=0;
							$gpa=get_gpa($total,$full_mark);
							$lg=get_letter_grade($gpa);
							if($full_mark=='-' or !$full_mark)
							{
								$full_mark='-';$written='-';$objective='-';$practical='-';$sba='-';$total='-';$heigst='-';$heigst='-';$eighty='-';$twenty='-';$gpa='-';$lg='-';
							}
							echo "<td>".$full_mark."</td>";
							echo "<td>".$written."</td>";
							echo "<td>".$objective."</td>";
							echo "<td>".$practical."</td>";
							echo "<td>".$sba."</td>";
							echo "<td>".$total."</td>";
							echo "<td>".$heigst."</td>";
							echo "<td>".$gpa."</td>";
							echo "<td>".$lg."</td>";
						}
					}
					else
					{
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
					}	
					}
					if($loop==0 and $header)
					{
						echo "<td rowspan='".(count($subjects)+1)."'>".$grand_total_mark."</td>";
						echo "<td rowspan='".(count($subjects)+1)."'>".$grand_total_gpa."</td>";
						echo "<td rowspan='".(count($subjects)+1)."'>".$grand_total_lg."</td>";
					}
				?>
			</tr>
			<?php endfor;?>
			<tr>
				<td>Total</td><?=$total_str;?>
			</tr>
			<tr class=merit><td>Merit</td><?=$merit_str;?><?php if($header){ ?><td colspan="3"><?=merit_position('',$class_id,'',$student_id);?></td> <?php } ?>
        </table>
				
	</div>                         
            
            <?php  endif;?>
			
	<table class="signature">
		<tr>
			<td><hr>Guardian Signature</td>
			<td><hr>Class Teacher<br><b>Shafayatul Islam</b></td>
			<td><hr>Examination Controller<br><b>Shafayatul Islam</b></td>
		</tr>
	</table>
	</body>
</html>