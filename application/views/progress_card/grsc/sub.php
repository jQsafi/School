<?php 
	$marks_header='<tr class="green_header"><td>Full Mark</td><td>Written</td><td>Objective</td><td>Practical</td><td>SBA</td><td>Total</td><td>Highest<br/> Mark</td><td>GPA</td><td>Later <br/>Grade</td></tr>';
	$sub_exam_id=$exam_id;
	$name=get_single_value('name','exam',array('exam_id'=>$exam_id));
	$main_exam_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
	$main_exam_head_str='';
	$sub_exam_head_str='';
	$marks_header_str='';
	$marks_header_str.='<tr>';
	$marks_header_str=$marks_header;
	$main_exam_head_str.='<tr class=main_exam><th width="250px" rowspan=2>Subject Name</th><td colspan=9 class="exam_name">'.$name.'</td></tr>';
	$marks_header_str.='</tr>';
	
	$total_str='';
	$sub_exam_str='';
	$merit_str='';
	$total_str.='<tr class="total-row"><td>Total</td>';
	$merit_str.='<tr class="merit"><td>Merit</td>';
	$final_gpa=0;
	$subject_counter=0;
	$total_gpa=0;
	$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
	$mark_condition=array(
	'mark.class_id'=>$class_id,
	'student_id'=>$student_id,
	'sub_exam_id'=>$exam_id,
	'exam_id'=>$parent_id
	);
	$this->db->where($mark_condition);
	$this->db->select('formation,objective,practical,sba,total_marks,sub_total,sgpa,grade,highest_mark,name');
	$this->db->join('subject','subject.subject_id=mark.subject_id');
	$marks=$this->db->from('mark')->get();
	$main_exam_str='';
	foreach($marks->result() as $mark)
	{
			$main_exam_str.='<tr><td>'.$mark->name.'</td>';
			$main_exam_str.='<td>'.$mark->total_marks.'</td>';
			$main_exam_str.='<td>'.$mark->formation.'</td>';
			$main_exam_str.='<td>'.$mark->objective.'</td>';
			$main_exam_str.='<td>'.$mark->practical.'</td>';
			$main_exam_str.='<td>'.$mark->sba.'</td>';
			$main_exam_str.='<td>'.$mark->sub_total.'</td>';
			$main_exam_str.='<td>'.$mark->highest_mark.'</td>';
			$main_exam_str.='<td>'.$mark->sgpa.'</td>';
			$main_exam_str.='<td class="">'.$mark->grade.'</td>';
			$main_exam_str.='</tr>';
	}
	$mark_condition=array(
	'class_id'=>$class_id,
	'student_id'=>$student_id,
	'sub_exam_id'=>$exam_id,
	'exam_id'=>$parent_id
	);
	$this->db->where($mark_condition);
	$marks=$this->db->from('exam_result')->get();
	foreach($marks->result() as $mark)
	{
			
			$heighst_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>$exam_id,
			'exam_id'=>$parent_id,
			'merit_position'=>'1'
			);
			$merit_position=$mark->merit_position;
			$merit_position=number_to_word($merit_position);
			$hm=get_single_value('total_mark','exam_result',$heighst_condition);
			$total_str.='<td>'.$mark->full_mark.'</td>';
			$total_str.='<td>'.$mark->formation.'</td>';
			$total_str.='<td>'.$mark->objective.'</td>';
			$total_str.='<td>'.$mark->practical.'</td>';
			$total_str.='<td>'.$mark->sba.'</td>';
			$total_str.='<td class="">'.$mark->total_mark.'</td>';
			$total_str.='<td>'.$hm.'</td>';
			$total_str.='<td>'.$mark->gpa.'</td>';
			$total_str.='<td>'.$mark->grade.'</td>';
			$merit_str.='<td colspan=9>'.$merit_position.'</td></tr>';
			$total_str.='</tr>';
	}
?>
                 
			<center>
		<table class="result-card" width="100%">
					<?php
				echo $main_exam_head_str.$sub_exam_head_str.$marks_header_str;
				echo $main_exam_str;
				echo $total_str;
				echo $merit_str;
				?>
        </table>
		</center>