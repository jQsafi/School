<?php 
	$this->load->language('mark_sheet') ;
	$marks_header=$this->lang->line('marks_header');
	$this->db->select('distinct(exam_id)');
	$this->db->from('exam_result');
	$this->db->where('class_id',$class_id);
	$this->db->where('exam_id !=',"0");
	$result=$this->db->get();
	$main_exam_str='';
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
	$main_exam_head_str.="<th class='exam_name' colspan=3>Grand Final</th>";
	$main_exam_head_str.='</tr>';
	$sub_exam_head_str.='</tr>';
	$marks_header_str.='</tr>';
	$total_str='';
	$sub_exam_str='';
	$merit_str='';
	$total_str.='<tr class="total-row"><td>Total</td>';
	$merit_str.='<tr class="merit"><td>Merit</td>';
	$final_gpa=0;
	$subject_counter=0;
	$total_gpa=0;
	$result=$this->db
	->select('distinct(exam_id)')
	->from('exam_result')
	->where('exam_id !=',"0")
	->where('sub_exam_id !=',"0")
	->where('class_id',$class_id)
	->get();
	$header_row_span_count=0;
	$exam_counter=0;
	$gran_final_gpa=0;
	$final_totals=array();
	$over_all_total=0;
	foreach($result->result() as $row)
	{
		$exam_counter++;
		$exam_id=$row->exam_id;
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		foreach($sub_xm_res->result() as $sub_xm)
		{
			$sub_exam_id=$sub_xm->exam_id;
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id
			);
			$full_mark=get_single_value('full_mark','exam_result',$mark_condition);
			$formation=get_single_value('formation','exam_result',$mark_condition);
			$objective=get_single_value('objective','exam_result',$mark_condition);
			$practical=get_single_value('practical','exam_result',$mark_condition);
			$sba=get_single_value('sba','exam_result',$mark_condition);
			$total_mark=get_single_value('total_mark','exam_result',$mark_condition);
			$total_gpa=get_single_value('gpa','exam_result',$mark_condition);
			$lg=get_single_value('grade','exam_result',$mark_condition);
			$merit_position=get_single_value('merit_position','exam_result',$mark_condition);
			$position=number_to_word($merit_position);
			$heighst_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id,
			'merit_position'=>'1'
			);
			$heigst=get_single_value('total_mark','exam_result',$heighst_condition);
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td class="">'.$total_mark.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td class="">'.$total_gpa.'</td>';
			$total_str.='<td class="">'.$lg.'</td>';
			$merit_str.='<td colspan=9>'.$position.'</td>';
		}
		if(!$sub_exam_count)
		{
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'exam_id'=>$exam_id,
			'sub_exam_id'=>"99999"
			);
			$this->db->where($mark_condition);
			$marks=$this->db->from('exam_result')->get();
			$heighst_condition=array(
					'class_id'=>$class_id,
					'sub_exam_id'=>"99999",
					'exam_id'=>$exam_id,
					'merit_position'=>'1'
					);
			$heigst=get_single_value('total_mark','exam_result',$heighst_condition);
			foreach($marks->result() as $mark)
			{
					$total_str.='<td>'.$mark->full_mark.'</td>';
					$total_str.='<td>'.$mark->formation.'</td>';
					$total_str.='<td>'.$mark->objective.'</td>';
					$total_str.='<td>'.$mark->practical.'</td>';
					$total_str.='<td>'.$mark->sba.'</td>';
					$total_str.='<td>'.$mark->total_mark.'</td>';
					$total_str.='<td>'.$heigst.'</td>';
					$total_str.='<td>'.$mark->gpa.'</td>';
					$total_str.='<td>'.$mark->grade.'</td>';
					$merit_str.='<td colspan=9>'.number_to_word($mark->merit_position).'</td>';
			}
		}
		if($sub_exam_count)
		{
			$heighst_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>'0',
			'exam_id'=>$exam_id,
			'student_id'=>$student_id
			);
			$position_exam=get_single_value('merit_position','exam_result',$heighst_condition);
			$merit_str.='<td colspan=3>'.number_to_word($position_exam).'</td>';
		}
	}
	$heighst_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>'0',
			'exam_id'=>'0',
			'student_id'=>$student_id
			);
	$position=get_single_value('merit_position','exam_result',$heighst_condition);
	$merit_str.='<td colspan=3>'.number_to_word($position).'</td>';
	$total_str.='<tr>';
	foreach($subjects as $subject_id)
	{
		$subject_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
		$main_exam_str.='<td>'.$subject_name.'</td>';
		$this->db->select('distinct(exam_id)');
		$this->db->from('exam_result');
		$this->db->where('exam_id !=',"0");
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
				$exam_id=$sub_xm->parent_id;
				$mark_condition=array(
				'class_id'=>$class_id,
				'student_id'=>$student_id,
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
				$heigst=get_single_value('highest_mark','mark',$mark_condition);
				$gpa=get_single_value('sgpa','mark',$mark_condition);
				$lg=get_single_value('grade','mark',$mark_condition);
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
				'exam_id'=>$exam_id,
				'sub_exam_id'=>'99999'
				);
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$total=get_single_value('sub_total','mark',$mark_condition);
				$heigst=get_single_value('highest_mark','mark',$mark_condition);
				$gpa=get_single_value('sgpa','mark',$mark_condition);
				$lg=get_single_value('grade','mark',$mark_condition);
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
			if($subject_counter==0 and $sub_exam_count)
			{
				$heighst_condition=array(
					'class_id'=>$class_id,
					'sub_exam_id'=>'0',
					'exam_id'=>$exam_id,
					'student_id'=>$student_id
					);
					$total_mark=get_single_value('total_mark','exam_result',$heighst_condition);
					$total_gpa=get_single_value('gpa','exam_result',$heighst_condition);
					$lg=get_single_value('grade','exam_result',$heighst_condition);
					$sub_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_mark.'</td>';
					$sub_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$total_gpa.'</td>';
					$sub_exam_str.='<td rowspan='.(count($subjects)+2).'>'.$lg.'</td>';
			}
			$main_exam_str.=$sub_exam_str;
			$sub_exam_str='';
		}
		if($subject_counter==0)
			{
				$rowspan=count($subjects);
			$sub_row_spn=$rowspan+2;
			$heighst_condition=array(
					'class_id'=>$class_id,
					'sub_exam_id'=>'0',
					'exam_id'=>'0',
					'student_id'=>$student_id
					);
			$total_mark=get_single_value('total_mark','exam_result',$heighst_condition);
			$total_gpa=get_single_value('gpa','exam_result',$heighst_condition);
			$lg=get_single_value('grade','exam_result',$heighst_condition);
			$main_exam_str.='<td rowspan='.$sub_row_spn.'>'.$total_mark.'</td>';
			$main_exam_str.='<td rowspan='.$sub_row_spn.'>'.$total_gpa.'</td>';
			$main_exam_str.='<td rowspan='.$sub_row_spn.'>'.$lg.'</td>';
			}
		$main_exam_str.='<tr>';
		$subject_counter++;
	}
?>
		<table class="result-card">
					<?php
				echo $main_exam_head_str.$sub_exam_head_str.$marks_header_str;
				echo $main_exam_str;
				echo $total_str;
				echo $merit_str;
				?>
        </table>