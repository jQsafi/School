<html>
<head>
	<title>
		Progress Card of <?php echo get_single_value('name','student',array('student_id'=>$student_id));?>-<?php echo date("Y");?>
	</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/css/marksheet.css">
<body>
<div class="college-progress-card">
<div class="mainCon">
   
   <br>
    <h3>Progress Card <?php echo date("Y");?></h3>

</div>

<?php 
        $this->db->from('student');
        $this->db->where('student.student_id', $student_id);	
        $query_result = $this->db->get();
        $student = $query_result->row();
         
?>


            <!----TABLE LISTING STARTS--->
                <?php if($class_id >0  ):?>
<?php 
	$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
	$this->load->language('mark_sheet') ;
	$marks_header=$this->lang->line('marks_header');
	$sub_exam_id=$exam_id;
	$name=get_single_value('name','exam',array('exam_id'=>$exam_id));
	$main_exam_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
	$main_exam_head_str='';
	$sub_exam_head_str='';
	$marks_header_str='';
	$marks_header_str.='<tr>';
	$marks_header_str=$marks_header;
	$main_exam_head_str.='<tr class=main_exam><th width="300" rowspan=2>Subject Name</th><td colspan=9 class="exam_name">'.$name.'</td></tr>';
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
	$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
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
				$heigst_mark_condition=array(
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
				'sub_exam_id'=>$exam_id
				);
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$total=get_single_value('sub_total','mark',$mark_condition);
			$total=$total+0;
				$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
				$gpa=get_gpa($total,$full_mark);
				$lg=get_letter_grade($gpa);
				if($full_mark=='-' or !$full_mark):
					$full_mark='-';
					$total='-';
					$heigst='-';
					$gpa='-';
					$lg='-';
					$formation='-';
					$objective='-';
					$practical='-';
					$sba='-';
					$total='-';
					$heigst='-';
					$gpa='-';
					$lg='-';
				endif;
				$main_exam_str.='<td>'.$full_mark.'</td>';
				$main_exam_str.='<td>'.$formation.'</td>';
				$main_exam_str.='<td>'.$objective.'</td>';
				$main_exam_str.='<td>'.$practical.'</td>';
				$main_exam_str.='<td>'.$sba.'</td>';
				$main_exam_str.='<td>'.$total.'</td>';
				$main_exam_str.='<td>'.$heigst.'</td>';
				$main_exam_str.='<td>'.$gpa.'</td>';
				$main_exam_str.='<td>'.$lg.'</td>';
		$main_exam_str.='<tr>';
		$subject_counter++;
	}
	//$total_gpa=number_format($total_gpa,2);
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'sub_exam_id'=>$exam_id,
			'exam_id'=>$parent_id
			);
			$full_mark=get_single_value('sum(total_marks)','mark',$mark_condition);
			$formation=get_single_value('sum(formation)','mark',$mark_condition);
			$objective=get_single_value('sum(objective)','mark',$mark_condition);
			$practical=get_single_value('sum(practical)','mark',$mark_condition);
			$sba=get_single_value('sum(sba)','mark',$mark_condition);
			$heigst=merit_position($exam_id,$class_id,1);
			$total_mark=$this->prog_card->grand_total_mark($student_id,$parent_id,$exam_id);
			$total_gpa=$this->prog_card->grand_total_gpa($student_id,$parent_id,$exam_id);
			$lg=get_letter_grade($total_gpa);
			$merit_list=merit_list_sub($student_id,$class_id,'',$sub_exam_id);
			if($total_gpa<0)
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
				$full_mark='-';
				$merit_list='-';
			}
			if($lg=='F')
			$merit_list="X";
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td class="green_header">'.$total_mark.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td class="green_header">'.$total_gpa.'</td>';
			$total_str.='<td class="final_gpa">'.$lg.'</td>';
			$merit_str.='<td colspan=11>'.$merit_list.'</td>';
			$total_str.='<tr>';
?>
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
	</div>                         
            
            <?php  endif;?>
	
	
	<table class="signature">
		<tr>
			<td><hr>Guardian Signature</td>
			<td><hr>Compared By</td>
			<td><hr>Principal Signature</td>
		</tr>
	</table>
	</div>
	</body>
</html>