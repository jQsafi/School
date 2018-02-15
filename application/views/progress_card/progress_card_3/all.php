<html>
<head>
	<title>
		Progress Card of <?php echo get_single_value('name','student',array('student_id'=>$student_id));?>-<?php echo date("Y");?>
	</title>
</head>
<body>
<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url();?>template/css/print.css">
<link rel="stylesheet" type="text/css" media="" href="<?php echo base_url();?>template/css/font.css">
<link rel="stylesheet" type="text/css" media="" href="<?php echo base_url();?>template/css/marksheet.css">




            <!----TABLE LISTING STARTS--->
                <?php if($class_id >0  ):?>
<?php 
	$this->load->language('mark_sheet') ;
	$marks_header=$this->lang->line('marks_header');
	$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
	$this->db->select('distinct(exam_id)');
	$this->db->from('marksheet');
	$this->db->where('class_id',$class_id);
	$result=$this->db->get();
	$main_exam_head_str='';
	$sub_exam_head_str='';
	$marks_header_str='';
	$main_exam_head_str.='<tr><th width="300px" rowspan=3>Subject&nbsp;Name</th>';
	$sub_exam_head_str.='<tr>';
	$marks_header_str.='<tr>';
	$header_row_span_count=0;
	foreach($result->result() as $row)
	{
		$exam_id=$row->exam_id;
		$exams[]=$row->exam_id;
		$main_exam_name=get_single_value('name','exam',array('exam_id'=>$exam_id));
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$colspan_count=$sub_exam_count*9;
		if(!$colspan_count)
			$colspan_count=9;
		if($sub_exam_count>$header_row_span_count)
			$header_row_span_count=$sub_exam_count;
		if($sub_exam_count)
		{
			$main_exam_head_str.='<th class="exam_name" colspan='.$colspan_count.'>'.$main_exam_name.'</th>';
			$main_exam_head_str.='<th class="exam_name" colspan=3>Final Result</th>';
		}
		else
		{
			$main_exam_head_str.='<th class="exam_name" colspan='.$colspan_count.' rowspan=2>'.$main_exam_name.'</th>';	
			$marks_header_str.=$marks_header;
		}
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		foreach($sub_xm_res->result() as $sub_xm)
		{
			$sub_exam_id=$sub_xm->exam_id;
			$sub_exam_name=$sub_xm->name;
			$sub_exam_head_str.='<th class="sub_exam_name" colspan=9>'.$sub_exam_name.'</th>';
			$marks_header_str.=$marks_header;
		}
		if($sub_exam_count)
	$sub_exam_head_str.='<th rowspan=2>Grand </br>Total</th><th rowspan=2>GPA</th><th rowspan=2>Letter</br>Grade</th>';
	}
	$sub_exam_head_str.='<th rowspan=2>Grand </br>Total</th><th rowspan=2>GPA</th><th rowspan=2>Letter</br>Grade</th>';
	$main_exam_head_str.="<th class=exam_name colspan=3>Grand Final</th>";
	$main_exam_head_str.='</tr>';
	$sub_exam_head_str.='</tr>';
	$marks_header_str.='</tr>';
	
	
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
			'exam_id'=>$exam_id
			);
			$full_mark=get_single_value('sum(total_marks)','mark',$mark_condition);
			$formation=get_single_value('sum(formation)','mark',$mark_condition);
			$objective=get_single_value('sum(objective)','mark',$mark_condition);
			$practical=get_single_value('sum(practical)','mark',$mark_condition);
			$sba=get_single_value('sum(sba)','mark',$mark_condition);
			$heigst=merit_position($sub_exam_id,$class_id,1);
			$total_mark=$this->prog_card->grand_total_mark($student_id,$exam_id,$sub_exam_id);
			$total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id,$sub_exam_id);
			$lg=get_letter_grade($total_gpa);
			if($total_gpa=="F")
			{
				$position_exam="X";
			}
			if($total_gpa==-1)
			{
				$full_mark='-';
				$formation='-';
				$objective='-';
				$practical='-';
				$sba='-';
				$total_mark='-';
				$heigst='-';
				
				$total_gpa='-';
				$lg='-';
				$position='-';
			}
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td class="green_header">'.$total_mark.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td class="green_header">'.$total_gpa.'</td>';
			$total_str.='<td class="final_gpa">'.$lg.'</td>';
			$merit_str.='<td colspan=9>'.$position.'</td>';
		}
		if(!$sub_exam_count)
		{
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'exam_id'=>$exam_id
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
			$heigst=merit_position($exam_id,$class_id,1);
			$total_mark=$this->prog_card->grand_total_mark($student_id,$exam_id);
			$total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id);
			$lg=get_letter_grade($total_gpa);
			if($lg=="F")
			{
				$position_exam="X";
			}
			if($total_gpa==-1)
			{
				$full_mark='-';
				$formation='-';
				$objective='-';
				$practical='-';
				$sba='-';
				$total_mark='-';
				$heigst='-';
				$total_gpa='-';
				$lg='-';
				$position='-';
			}
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td>'.$total_mark.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td>'.$total_gpa.'</td>';
			$total_str.='<td>'.$lg.'</td>';
			$merit_str.='<td colspan=9>'.$position_exam.'</td>';
		}
		if($sub_exam_count)
		{
			$merit_str.='<td colspan=3>'.$position_exam.'</td>';
		}
	}
	$merit_list=merit_position('',$class_id,'',$student_id);
	$total_gpa=$this->prog_card->grand_total_gpa($student_id);
	$lg=get_letter_grade($total_gpa);
	if($total_gpa=="F")
	{
		$merit_list="X";
	}
	$merit_str.='<td colspan=3>'.$merit_list.'</td>';
	$total_str.='<tr>';
	foreach($subjects as $subject_id)
	{
		$subject_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
		$main_exam_str.='<td>'.$subject_name.'</td>';
		$this->db->select('distinct(exam_id)');
		$this->db->from('marksheet');
		$this->db->where('class_id',$class_id);
		$result=$this->db->get();
		$header_row_span_count=0;
		$exam_counter=0;
		foreach($result->result() as $row)
		{
			$exam_counter++;
			$exam_id=$row->exam_id;
			$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
			$colspan_count=$sub_exam_count*9;
			if(!$colspan_count)
				$colspan_count=9;
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
				$total+=0;
				$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
				$heigst+=0;
				$gpa=get_gpa($total,$full_mark);
				$lg=get_letter_grade($gpa);
				if($full_mark=='-' or !$full_mark)
				{
					$full_mark='-';
					$formation='-';
					$objective='-';
					$practical='-';
					$sba='-';
					$total='-';
					$heigst='-';
					$gpa='-';
					$lg='-';
				}
				$main_exam_str.='<td>'.$full_mark.'</td>';
				$main_exam_str.='<td>'.$formation.'</td>';
				$main_exam_str.='<td>'.$objective.'</td>';
				$main_exam_str.='<td>'.$practical.'</td>';
				$main_exam_str.='<td>'.$sba.'</td>';
				$main_exam_str.='<td>'.$total.'</td>';
				$main_exam_str.='<td>'.$heigst.'</td>';
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
				$total+=0;
				$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
				$heigst+=0;
				
				$gpa=get_gpa($total,$full_mark);
				$lg=get_letter_grade($gpa);
				if($full_mark=='-' or !$full_mark)
				{
					$full_mark='-';
					$formation='-';
					$objective='-';
					$practical='-';
					$sba='-';
					$total='-';
					$heigst='-';
					
					$gpa='-';
					$lg='-';
				}
				$main_exam_str.='<td>'.$full_mark.'</td>';
				$main_exam_str.='<td>'.$formation.'</td>';
				$main_exam_str.='<td>'.$objective.'</td>';
				$main_exam_str.='<td>'.$practical.'</td>';
				$main_exam_str.='<td>'.$sba.'</td>';
				$main_exam_str.='<td>'.$total.'</td>';
				$main_exam_str.='<td>'.$heigst.'</td>';
				$main_exam_str.='<td>'.$gpa.'</td>';
				$main_exam_str.='<td>'.$lg.'</td>';
				$final_gpa+=$gpa;
			}
			if($subject_counter==0 and $sub_exam_count)
			{
				$position_exam=merit_position($exam_id,$class_id,'',$student_id);
				$total_mark=$this->prog_card->grand_total_mark($student_id,$exam_id);
				$total_gpa=$this->prog_card->grand_total_gpa($student_id,$exam_id);
				$total_lg=get_letter_grade($total_gpa);
				if($total_gpa==-1)
				{
					$total_mark='-';
					$total_gpa='-';
					$total_lg='-';
					
				}
				$sub_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_mark.'</td>';
				$sub_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_gpa.'</td>';
				$sub_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_lg.'</td>';
			}
			$main_exam_str.=$sub_exam_str;
			$sub_exam_str='';
		}
		if($subject_counter==0)
			{
				$total_mark=$this->prog_card->grand_total_mark($student_id);
				$total_gpa=$this->prog_card->grand_total_gpa($student_id);
				$total_lg=get_letter_grade($total_gpa);
				$main_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_mark.'</td>';
				$main_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_gpa.'</td>';
				$main_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_lg.'</td>';
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
	$publish_date=get_single_value('publishing_date','exam',array('exam_id'=>$exam_id));
	$this->db->from('student');
    $this->db->where('student.student_id', $student_id);	
    $query_result = $this->db->get();
    $student = $query_result->row();
	$info_data=array('publish_date'=>$publish_date,'student'=>$student);
	$this->load->view('progress_card/student_info',$info_data);
?>
                 
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