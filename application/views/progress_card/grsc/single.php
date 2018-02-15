<?php 
	$marks_header=$this->lang->line('marks_header_grsc');
	$marks_header_other=$this->lang->line('marks_header_other');
	$this->db->select('distinct(exam_id)');
	$this->db->from('exam_result');
	$this->db->where('class_id',$class_id);
	if($exam_id)
	$this->db->where('exam_id',$exam_id);
	$result=$this->db->get();
	$main_exam_head_str='';
	$sub_exam_head_str='';
	$marks_header_str='';
	$main_exam_head_str.='<tr><th width="600px" rowspan=3>Subject&nbsp;Name</th>';
	$sub_exam_head_str.='<tr>';
	$marks_header_str.='<tr>';
	$header_row_span_count=0;
	foreach($result->result() as $row)
	{
		$exam_id=$row->exam_id;
		$exams[]=$row->exam_id;
		$main_exam_name=get_single_value('name','exam',array('exam_id'=>$exam_id));
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		if($sub_exam_count>1)
		{
			$colspan_count=($sub_exam_count-1)*4+9;
			$last_sub=get_single_value('exam_id','exam',array('parent_id'=>$exam_id));	
		}
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
			$main_exam_head_str.='<th colspan='.$colspan_count.' rowspan=2 class=exam_name>'.$main_exam_name.'</th>';	
			$marks_header_str.=$marks_header;
		}
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		foreach($sub_xm_res->result() as $sub_xm)
		{
			$sub_exam_id=$sub_xm->exam_id;
			$sub_exam_name=$sub_xm->name;
			if($last_sub==$sub_exam_id)
			{
				$sub_exam_head_str.='<td colspan=9>'.$sub_exam_name.'</td>';	
				$marks_header_str.=$marks_header;
			}
			else
			{
				$sub_exam_head_str.='<td colspan=4>'.$sub_exam_name.'</td>';	
				$marks_header_str.=$marks_header_other;
			}
		}
	}
	if($sub_exam_count)
	$sub_exam_head_str.='<th rowspan=2>Grand </br>Total</th><th rowspan=2>GPA</th><th rowspan=2>Letter</br>Grade</th>';
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
	$this->db->select('distinct(exam_id)');
	$this->db->from('exam_result');
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
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		$last_sub=get_single_value('exam_id','exam',array('parent_id'=>$exam_id));
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
			if($last_sub==$sub_exam_id)
			{
				$total_str.='<td>'.$full_mark.'</td>';
				$total_str.='<td>'.$formation.'</td>';
				$total_str.='<td>'.$objective.'</td>';
				$total_str.='<td>'.$practical.'</td>';
				$total_str.='<td>'.$sba.'</td>';
				$total_str.='<td>'.$total_mark.'</td>';
				$total_str.='<td>'.$heigst.'</td>';
				$total_str.='<td>'.$total_gpa.'</td>';
				$total_str.='<td>'.$lg.'</td>';
				$merit_str.='<td colspan=9>'.$position.'</td>';	
			}
			else
			{
				$total_str.='<td>'.$full_mark.'</td>';
				$total_str.='<td>'.$total_mark.'</td>';
				$total_str.='<td>'.$total_gpa.'</td>';
				$total_str.='<td>'.$lg.'</td>';
				$merit_str.='<td colspan=4>'.$position.'</td>';
			}
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
					$merit_str.='<td colspan=11>'.number_to_word($mark->merit_position).'</td>';
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
			//$total_str.='<td colspan=3></td>';	
		}
	}
	$total_str.='<tr>';
	foreach($subjects as $subject_id)
	{
		$subject_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
		$main_exam_str.='<td>'.$subject_name.'</td>';
		$this->db->select('distinct(exam_id)');
		$this->db->from('exam_result');
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
			$last_sub=get_single_value('exam_id','exam',array('parent_id'=>$exam_id));
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
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$total=get_single_value('sub_total','mark',$mark_condition);
				$heigst=get_single_value('highest_mark','mark',$mark_condition);
				$gpa=get_single_value('sgpa','mark',$mark_condition);
				$lg=get_single_value('grade','mark',$mark_condition);
				$heigst+=0;
				$eighty=$total*0.8;
				$twenty=$total*0.2;
				if($sub_exam_id==$last_sub)
				{
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
				else
				{
					$main_exam_str.='<td>'.$full_mark.'</td>';
					$main_exam_str.='<td>'.$total.'</td>';
					$main_exam_str.='<td>'.$gpa.'</td>';
					$main_exam_str.='<td>'.$lg.'</td>';
				}
			}
			if(!$sub_exam_count)
			{
				$mark_condition=array(
				'class_id'=>$class_id,
				'student_id'=>$student_id,
				'subject_id'=>$subject_id,
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