
<?php 	
	$marks_header=$this->lang->line('marks_header_details');
	$sub_exam_id=$exam_id;
	$name=get_single_value('name','exam',array('exam_id'=>$exam_id));
	$main_exam_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
	$main_exam_head_str='';
	$sub_exam_head_str='';
	$marks_header_str='';
	$marks_header_str.='<tr>';
	$marks_header_str=$marks_header;
	$main_exam_head_str.='<tr class=main_exam><th width="300" rowspan=2>Subject Name</th><td colspan=11 class="exam_name">'.$name.'</td></tr>';
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
	$main_exam_str='';
	foreach($subjects as $subject_id)
	{
		$subject_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
		$main_exam_str.='<td>'.$subject_name.'</td>';
				$mark_condition=array(
				'class_id'=>$class_id,
				'student_id'=>$student_id,
				'subject_id'=>$subject_id,
				'sub_exam_id'=>$exam_id
				);
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$total=get_single_value('sub_total','mark',$mark_condition);
				$eighty    = $total * 0.8;
				$twenty    = $total * 0.2;
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
				$main_exam_str.='<td>'.$eighty.'</td>';
				$main_exam_str.='<td>'.$twenty.'</td>';
				$main_exam_str.='<td>'.$gpa.'</td>';
				$main_exam_str.='<td>'.$lg.'</td>';
		$main_exam_str.='<tr>';
		$subject_counter++;
	}
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'sub_exam_id'=>$exam_id,
			'exam_id'=>$parent_id
			);
			$heighst_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>$exam_id,
			'exam_id'=>$parent_id,
			'merit_position'=>'1'
			);
			$full_mark=get_single_value('full_mark','exam_result',$mark_condition);
			$formation=get_single_value('formation','exam_result',$mark_condition);
			$objective=get_single_value('objective','exam_result',$mark_condition);
			$practical=get_single_value('practical','exam_result',$mark_condition);
			$sba=get_single_value('sba','exam_result',$mark_condition);
			$total_mark =get_single_value('total_mark','exam_result',$mark_condition);
			$eighty    = $total_mark * 0.8;
			$twenty    = $total_mark * 0.2;
			$total_gpa =get_single_value('gpa','exam_result',$mark_condition);
			$lg =get_single_value('grade','exam_result',$mark_condition);
			$merit_list=get_single_value('merit_position','exam_result',$mark_condition);
			$merit_list=number_to_word($merit_list);
			$heigst=get_single_value('total_mark','exam_result',$heighst_condition);
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td class="green_header">'.$total_mark.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td>'.$eighty.'</td>';
			$total_str.='<td>'.$twenty.'</td>';
			$total_str.='<td class="green_header">'.$total_gpa.'</td>';
			$total_str.='<td class="final_gpa">'.$lg.'</td>';
			$merit_str.='<td colspan=11>'.$merit_list.'</td>';
			$total_str.='<tr>';
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