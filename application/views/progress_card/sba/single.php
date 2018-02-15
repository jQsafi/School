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
	$sub_exam_head_str='';
	$total_str='';
	$merit_str='';
	$sub_exams=$this->db->where('parent_id',$exam_id)->from('exam')->get();
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
			$full=get_single_value('full_mark','exam_result',$mark_condition);
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
?>
		<table class="result-card">
			<tr>
				<th  rowspan="<?=$header_row_span_count;?>" width="300px;">Subject&nbsp;Name</th>
				<th colspan="<?=$main_colspan_count?>" class="exam_name"><?=$main_exam_name?></th>
				<?php if($header){
					?>
					<th colspan="3" rowspan="<?=($header_row_span_count-1)?>">Grand&nbsp;Total</th>
					<?php
				}
				?>
			</tr>
			<?php
				if($sub_exam_head_str)
				echo "<tr class='sub_exam_name'>".$sub_exam_head_str."</tr>";
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
							$exam_id=$exam->parent_id;
							$marks=$this->db->where('subject_id',$subjects[$loop])->where('exam_id',$exam_id)->where('sub_exam_id',$sub_exam_id)->where('class_id',$class_id)->where('student_id',$student_id)->from('mark')->get();
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
									$heigst=$rows->highest_mark;
									$gpa=$rows->sgpa;
									$lg=$rows->grade;
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
					$marks=$this->db
								->where('exam_id',$exam_id)
								->where('sub_exam_id','99999')
								->where('class_id',$class_id)
								->where('student_id',$student_id)
								->where('subject_id',$subject)
								->from('mark')->get();
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
							$heigst=$rows->highest_mark;
							$gpa=$rows->sgpa;
							$lg=$rows->grade;
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
						$heighst_condition=array(
						'class_id'=>$class_id,
						'sub_exam_id'=>'0',
						'exam_id'=>$exam_id,
						'student_id'=>$student_id
						);
						$total_mark=get_single_value('total_mark','exam_result',$heighst_condition);
						$total_gpa=get_single_value('gpa','exam_result',$heighst_condition);
						$lg=get_single_value('grade','exam_result',$heighst_condition);
						echo '<td rowspan='.(count($subjects)+1).'>'.$total_mark.'</td>';
						echo '<td rowspan='.(count($subjects)+1).'>'.$total_gpa.'</td>';
						echo '<td rowspan='.(count($subjects)+1).'>'.$lg.'</td>';
					}
				?>
			</tr>
			<?php endfor;?>
			<tr class="total-row">
				<td>Total</td><?=$total_str;?>
			</tr>
			<?php
			$heighst_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>'0',
			'exam_id'=>$exam_id,
			'student_id'=>$student_id
			);
			$position=get_single_value('merit_position','exam_result',$heighst_condition);
			$position=number_to_word($position);
			?>
			<tr class=merit>
				<td>Merit</td>
					<?=$merit_str;?><?php if($header){ ?><td colspan="3"><?=$position;?></td> <?php } ?></tr>
        </table>