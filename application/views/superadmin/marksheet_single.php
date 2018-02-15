<html>
<head>
	<title>
		Progress Card of <?php echo get_single_value('name','student',array('student_id'=>$student_id));?>-<?php echo date("Y");?>
	</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/css/marksheet.css">




            <!----TABLE LISTING STARTS--->
                <?php if($class_id >0  ):?>
<?php 
	$this->load->language('mark_sheet') ;
	$marks_header=$this->lang->line('marks_header');
	$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
	$this->db->select('distinct(exam_id)');
	$this->db->from('marksheet');
	$this->db->where('class_id',$class_id);
	if($exam_id)
	$this->db->where('exam_id',$exam_id);
	$result=$this->db->get();
	$main_exam_head_str='';
	$sub_exam_head_str='';
	$marks_header_str='';
	$main_exam_head_str.='<tr><th width="400px" rowspan=3>Subject&nbsp;Name</th>';
	$sub_exam_head_str.='<tr>';
	$marks_header_str.='<tr>';
	$header_row_span_count=0;
	foreach($result->result() as $row)
	{
		$exam_id=$row->exam_id;
		$exams[]=$row->exam_id;
		$main_exam_name=get_single_value('name','exam',array('exam_id'=>$exam_id));
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$colspan_count=$sub_exam_count*11;
		if(!$colspan_count)
			$colspan_count=11;
		if($sub_exam_count>$header_row_span_count)
			$header_row_span_count=$sub_exam_count;
		if($sub_exam_count)
		{
			$main_exam_head_str.='<th class="exam_name" colspan='.$colspan_count.'>'.$main_exam_name.'</th>';
			$main_exam_head_str.='<th class="exam_name" colspan=3>Final Result</th>';
		}
		else
		{
			$main_exam_head_str.='<th colspan='.$colspan_count.' rowspan=2>'.$main_exam_name.'</th>';	
			$marks_header_str.=$marks_header;
		}
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		foreach($sub_xm_res->result() as $sub_xm)
		{
			$sub_exam_id=$sub_xm->exam_id;
			$sub_exam_name=$sub_xm->name;
			$sub_exam_head_str.='<th class="sub_exam_name" colspan=11>'.$sub_exam_name.'</th>';
			$marks_header_str.=$marks_header;
		}
	}
	if($sub_exam_count)
	$sub_exam_head_str.='<th rowspan=2>Grand </br>Total</th><th rowspan=2>GPA</th><th rowspan=2>Letter</br>Grade</th>';
	$main_exam_head_str.='</tr>';
	$sub_exam_head_str.='</tr>';
	$marks_header_str.='</tr>';
	
	
 	$student_group=get_single_value('group','student',array('student_id'=>$student_id));
 	$this->db->select('subject_id,name,group_id');
	$this->db->from('subject');
	$this->db->where('class_id',$class_id);
	$this->db->where('group_id',0);
	$this->db->where('status',0);
	$this->db->where('subject_id !=',$fourth_subject);
	$result=$this->db->get();
	$subjects=array();
	foreach($result->result() as $row)
	{
		$subjects[]=$row->subject_id;	
	}
	$group_subjects=get_single_value('subject_id','student',array('student_id'=>$student_id));
	$subject_ids=explode('SC',$group_subjects);
	foreach($subject_ids as $id)
	{
		if($id)
		$subjects[]=$id;
	}
	$total_subject=count($subjects);
	if($fourth_subject)
		$subjects[]=$fourth_subject;
	$total_str='';
	$sub_exam_str='';
	$merit_str='';
	$total_str.='<tr class="total-row"><td>Total</td>';
	$merit_str.='<tr class="merit"><td>Merit</td>';
	$final_gpa=0;
	$subject_counter=0;
	$total_gpa=0;
	$this->db->select('distinct(exam_id)');
	$this->db->from('marksheet');
	$this->db->where('class_id',$class_id);
	$this->db->where('exam_id',$exam_id);
	$result=$this->db->get();
	$header_row_span_count=0;
	$exam_counter=0;
	$gran_final_gpa=0;
	$final_totals=array();
	$over_all_total=0;
	foreach($result->result() as $row)
	{
		$exam_counter++;
		$exam_id=$row->exam_id;
		$final_totals[$exam_id]['total']=0;
		$final_totals[$exam_id]['gpa']=0;
		$final_gpa=final_gpa($student_id,$class_id,$exam_id);
		$gran_final_gpa+=$final_gpa;
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		$position_exam=merit_position($exam_id,$class_id,'',$student_id);
		foreach($sub_xm_res->result() as $sub_xm)
		{
			$sub_exam_id=$sub_xm->exam_id;
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id,
			'subject_id !='=>$fourth_subject
			);
			$full_mark=get_single_value('sum(total_marks)','mark',$mark_condition);
			$formation=get_single_value('sum(formation)','mark',$mark_condition);
			$objective=get_single_value('sum(objective)','mark',$mark_condition);
			$practical=get_single_value('sum(practical)','mark',$mark_condition);
			$sba=get_single_value('sum(sba)','mark',$mark_condition);
			$heigst=merit_position($sub_exam_id,$class_id,1);
			$final_totals[$exam_id]['total']+=$total;
			$heigst=merit_position($sub_exam_id,$class_id,1);
			$position=merit_position($sub_exam_id,$class_id,'',$student_id);
			$total=merit_position($sub_exam_id,$class_id,$position);
			$eighty=$total*0.8;
			$twenty=$total*0.2;
			$final_gpa=sub_total_gpa($student_id,$class_id,$exam_id,$sub_exam_id,$fourth_subject);
			$lg=get_letter_grade($final_gpa);
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td class="green_header">'.$total.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td>'.$eighty.'</td>';
			$total_str.='<td>'.$twenty.'</td>';
			$total_str.='<td class="green_header">'.$final_gpa.'</td>';
			$total_str.='<td class="final_gpa">'.$lg.'</td>';
			$merit_str.='<td colspan=11>'.$position.'</td>';
		}
		if(!$sub_exam_count)
		{
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'exam_id'=>$exam_id,
			'subject_id !='=>$fourth_subject
			);
			$heigst_mark_condition=array(
			'class_id'=>$class_id,
			'exam_id'=>$exam_id
			);
			$full_mark=get_single_value('sum(total_marks)','mark',$mark_condition);
			$formation=get_single_value('sum(formation)','mark',$mark_condition);
			$objective=get_single_value('sum(objective)','mark',$mark_condition);
			$practical=get_single_value('sum(practical)','mark',$mark_condition);
			$sba=get_single_value('sum(sba)','mark',$mark_condition);
			$position_exam=merit_position($sub_exam_id,$class_id,'',$student_id);
			$total=merit_position($exam_id,$class_id,$position_exam);
			$heigst=merit_position($exam_id,$class_id,1);
			//$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
			$eighty=$total*0.8;
			$twenty=$total*0.2;
			$final_gpa=final_gpa($student_id,$class_id,$exam_id,$fourth_subject);
			$final_totals[$exam_id]['gpa']+=$final_gpa;
			$total_gpa+=$final_gpa;
			$temp_gpa=(int)$final_gpa;
			$heigst=merit_position($exam_id,$class_id,1);
			$final_gpa=final_gpa($student_id,$class_id,$exam_id,$fourth_subject);
			$lg=get_letter_grade($final_gpa);
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td>'.$total.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td>'.$eighty.'</td>';
			$total_str.='<td>'.$twenty.'</td>';
			$total_str.='<td>'.$final_gpa.'</td>';
			$total_str.='<td>'.$lg.'</td>';
			$merit_str.='<td colspan=11>'.$position_exam.'</td>';
		}
		if($sub_exam_count)
		{
			$merit_str.='<td colspan=3>'.$position_exam.'</td>';
			$total_str.='<td colspan=3></td>';	
		}
	}
	$merit_list=merit_list_sub($student_id,$class_id);
	$total_str.='<tr>';
	foreach($subjects as $subject_id)
	{
		$subject_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
		$main_exam_str.='<td>'.$subject_name.'</td>';
		$this->db->select('distinct(exam_id)');
		$this->db->from('marksheet');
		$this->db->where('class_id',$class_id);
		$this->db->where('exam_id',$exam_id);
		$result=$this->db->get();
		$header_row_span_count=0;
		$exam_counter=0;
		foreach($result->result() as $row)
		{
			$exam_counter++;
			$exam_id=$row->exam_id;
			$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
			$colspan_count=$sub_exam_count*11;
			if(!$colspan_count)
				$colspan_count=11;
			if($sub_exam_count>$header_row_span_count)
				$header_row_span_count=$sub_exam_count;
			$this->db->from('exam');
			$this->db->where('parent_id',$exam_id);
			$sub_xm_res=$this->db->get();
			foreach($sub_xm_res->result() as $sub_xm)
			{
				$sub_exam_id=$sub_xm->exam_id;
				$mark_condition=array(
				'class_id'=>$class_id,
				'student_id'=>$student_id,
				'subject_id'=>$subject_id,
				'sub_exam_id'=>$sub_exam_id,
				'exam_id'=>$exam_id
				);
				$heigst_mark_condition=array(
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
				'sub_exam_id'=>$sub_exam_id,
				'exam_id'=>$exam_id
				);
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$total=get_single_value('sub_total','mark',$mark_condition);
				$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
				$heigst+=0;
				$eighty=$total*0.8;
				$twenty=$total*0.2;
				$gpa=get_gpa($total,$full_mark);
				$lg=get_single_value('name','grade',array('grade_point'=>$gpa));
				$main_exam_str.='<td>'.$full_mark.'</td>';
				$main_exam_str.='<td>'.$formation.'</td>';
				$main_exam_str.='<td>'.$objective.'</td>';
				$main_exam_str.='<td>'.$practical.'</td>';
				$main_exam_str.='<td>'.$sba.'</td>';
				$main_exam_str.='<td>'.$total.'</td>';
				$main_exam_str.='<td>'.$heigst.'</td>';
				$main_exam_str.='<td>'.$eighty.'</td>';
				$main_exam_str.='<td>'.$twenty.'</td>';
				$main_exam_str.='<td>'.$gpa.'</td>';
				$main_exam_str.='<td>'.$lg.'</td>';
			}
			if(!$sub_exam_count)
			{
				$mark_condition=array(
				'class_id'=>$class_id,
				'student_id'=>$student_id,
				'subject_id'=>$subject_id,
				'exam_id'=>$exam_id
				);
				$heigst_mark_condition=array(
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
				'exam_id'=>$exam_id
				);
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$position_exam=merit_position($exam_id,$class_id,'',$student_id);
				$total=get_single_value('sub_total','mark',$mark_condition);
				$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
				$heigst+=0;
				$eighty=$total*0.8;
				$twenty=$total*0.2;
				$gpa=get_gpa($total,$full_mark);
				$lg=get_single_value('name','grade',array('grade_point'=>$gpa));
				$main_exam_str.='<td>'.$full_mark.'</td>';
				$main_exam_str.='<td>'.$formation.'</td>';
				$main_exam_str.='<td>'.$objective.'</td>';
				$main_exam_str.='<td>'.$practical.'</td>';
				$main_exam_str.='<td>'.$sba.'</td>';
				$main_exam_str.='<td>'.$total.'</td>';
				$main_exam_str.='<td>'.$heigst.'</td>';
				$main_exam_str.='<td>'.$eighty.'</td>';
				$main_exam_str.='<td>'.$twenty.'</td>';
				$main_exam_str.='<td>'.$gpa.'</td>';
				$main_exam_str.='<td>'.$lg.'</td>';
				$final_gpa+=$gpa;
			}
			if($subject_counter==0 and $sub_exam_count)
			{
				$position_exam=merit_position($exam_id,$class_id,'',$student_id);
				$total_mark=merit_position($exam_id,$class_id,$position_exam);
				$final_exam_gpa=final_gpa($student_id,$class_id,$exam_id,$fourth_subject);
				$sub_exam_str.='<td rowspan='.count($subjects).'>'.$total_mark.'</td>';
				$sub_exam_str.='<td rowspan='.count($subjects).'>'.$final_exam_gpa.'</td>';
				$sub_exam_str.='<td rowspan='.count($subjects).'>'.get_letter_grade($final_exam_gpa).'</td>';
			}
			$main_exam_str.=$sub_exam_str;
			$sub_exam_str='';
		}
		$main_exam_str.='<tr>';
		$subject_counter++;
	}
	$publish_date=get_single_value('publishing_date','exam',array('exam_id'=>$exam_id));
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
		$publish_date=get_single_value('publishing_date','exam',array('exam_id'=>$exam_id));
  	$group_name=get_single_value('group_name','group',array('group_id'=>$student->group));       
?>
<table class="mainT table table-normal box">
    <tr>
        <td class="sPhoto">
			<img width="90" height="90" src="<?php echo base_url(). 'uploads/student_image/'. $student->student_id.'.jpg';?>" alt="No Photo"></td>
        <td>
            <p><strong>Name : </strong><?php echo $student->name;?></p>
            <p><strong>Student ID : </strong><?php echo $student->student_unique_ID;?></p>
			<p><strong>Father's Name : </strong><?php echo $student->father_name;?></p>
			<p><strong>Mother's Name : </strong><?php echo $student->mother_name;?></p>
            <p><strong>Result Publish Date : </strong><?php echo $publish_date;?></p>
        </td>
        <td>
            <p><strong>Class : </strong><?php echo get_single_value('name','class',array('class_id'=>$student->class_id)); ?></p>
			<?php
			if($group_name):
			?>
            <p><strong>Group : </strong><?php echo $group_name;?></p>
			<?php
			endif;
			?>
            <p><strong>Section : </strong><?php echo $student->section;?></p>
            <p><strong>Roll: </strong><?php echo $student->roll;?></p>
            <p><strong>Session : </strong><?php echo date('Y');?></p>
            
        </td>
    </tr>
</table>
                 
            <div class="exam-wraper" style=" min-width: 800px;">
		<table class="result-card">
					<?php
				echo $main_exam_head_str.$sub_exam_head_str.$marks_header_str;
				echo $main_exam_str;
				echo $total_str;
				echo $merit_str;
				?>
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