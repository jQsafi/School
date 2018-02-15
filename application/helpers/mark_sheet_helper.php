<?php
	function get_gpa($mark,$total_mark)
	{
		$hundred=($mark*100)/$total_mark;
		$mark_from=((int)($hundred/10))*10;
		$mark_upto=$mark_from+10;
		$fgrade=get_single_value('mark_upto','grade',array('grade_point'=>0));
		if($hundred>=80)
		{
			$mark_from=80;
			$mark_upto=100;
		}
		if($hundred<=$fgrade)
		{
			$mark_from=0;
			$mark_upto=$fgrade;
		}
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('mark_from >=',$mark_from);
		$ci->db->where('mark_upto <=',$mark_upto);
		$ci->db->select('grade_point');
		$ci->db->from('grade');
		$result=$ci->db->get();
		foreach($result->result() as $rows)
		{
			$grade_point=$rows->grade_point;
		}
		return $grade_point;
	}
	function merit_list_sub($student_id,$class_id,$exam_id='',$sub_exam_id='')
	{
		$ci=& get_instance();
		$ci->load->database();
		if($exam_id)
		$ci->db->where('exam_id',$exam_id);
		if($sub_exam_id)
		$ci->db->where('sub_exam_id',$sub_exam_id);
		$ci->db->where('class_id',$class_id);
		$ci->db->select('student_id,sum(sub_total) as total');
		$ci->db->group_by('student_id');
		$ci->db->order_by('total','desc');
		$ci->db->from('mark');
		$result=$ci->db->get();
		$position=1;
		foreach($result->result() as $row)
		{
			$std_id=$row->student_id;
			$total=$row->total;
			if($student_id==$std_id)
			return number_to_word($position);
			$position++;
		}
	}
	function total_heigst($class_id,$exam_id='',$sub_exam_id='')
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->select('subject_id,name,group_id');
		$ci->db->from('subject');
		$ci->db->where('class_id',$class_id);
		$result=$ci->db->get();
		$total_heigst=0;
		foreach($result->result() as $row)
		{
			$subject_id=$row->subject_id;
			$heigst_mark_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id,
			'subject_id'=>$subject_id
			);
			$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
			$total_heigst+=$heigst;
		}
		return $total_heigst;
	}
	function get_letter_grade($grade_point)
	{
		if($grade_point>=3.5 and $grade_point<4)
		$grade_point=3.5;
		else
		$grade_point=(int)$grade_point;
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('grade_point',$grade_point);
		$ci->db->select('name');
		$ci->db->from('grade');
		$result=$ci->db->get();
		$name='';
		foreach($result->result() as $rows)
		{
			$name=$rows->name;
		}
		return $name;
	}
	function final_gpa($student_id,$class_id,$exam_id,$fourth_subject='')
	{
		$ci=& get_instance();
		$ci->load->database();
		$sub_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$total_subject=get_single_value('count(subject_id)','subject',array('class_id'=>$class_id));
		if($fourth_subject)
			$total_subject--;
		$total_gpa=0;
		if($sub_count)
		{
			$ci->db->from('exam');
			$ci->db->where('parent_id',$exam_id);
			$sub_xm_res=$ci->db->get();
			$total_sub_total_gpa=0;
			foreach($sub_xm_res->result() as $sub_xm)
			{
				$sub_exam_id=$sub_xm->exam_id;
				$sub_total_gpa=sub_total_gpa($student_id,$class_id,$exam_id,$sub_exam_id,$fourth_subject);
				$total_sub_total_gpa+=$sub_total_gpa;
				if(!$sub_total_gpa or $sub_total_gpa==0)
				return 0;
			}
			$final_gpa=$total_sub_total_gpa/$sub_count;
		}
		else
		{
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'exam_id'=>$exam_id
			);
			$sub_sum_gpa=0;
			$ci->db->select('total_marks,sub_total');
			$ci->db->where($mark_condition);
			if($fourth_subject)
			$ci->db->where('subject_id !=',$fourth_subject);
			$ci->db->from('mark');
			$result=$ci->db->get();
			foreach($result->result() as $row)
			{
				$total=$row->sub_total;
				$full_mark=$row->total_marks;
				$gpa=get_gpa($total,$full_mark);
				if(!$gpa)
				{
					return 0;
				}
				$sub_sum_gpa+=$gpa;
			}
			if($fourth_subject)
			{
				$ci->db->select('total_marks,sub_total');
				$ci->db->where($mark_condition);
				$ci->db->where('subject_id',$fourth_subject);
				$ci->db->from('mark');
				$result=$ci->db->get();
				foreach($result->result() as $row)
				{
					$total=$row->sub_total;
					$fm=$row->total_marks;
					$gpa=get_gpa($total,$fm);
					if($gpa>2)
					$gpa=$gpa-2;
					else
					$gpa=0;
					$sub_sum_gpa+=$gpa;
				}
			}
			$final_gpa=$sub_sum_gpa/$total_subject;
		}
		if($final_gpa>5)
		$final_gpa=5;
		return number_format($final_gpa,2);
	}
	function subject_counter($student_id,$class_id,$fourth_subject='')
	{
		$ci=& get_instance();
		$ci->load->database();
		if(!$class_id)
		$class_id=get_single_value('class_id','student',array('student_id'=>$student_id));
		$ci->db->select('subject_id,name,group_id');
		$ci->db->from('subject');
		$ci->db->where('class_id',$class_id);
		$ci->db->where('group_id',0);
		if($fourth_subject)
			$ci->db->where('subject_id !=',$fourth_subject);
		$result=$ci->db->get();
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
		return $total_subject=count($subjects);
	}
	function subjects($student_id,$class_id='',$fourth_subject='')
	{
		$ci=& get_instance();
		$ci->load->database();
		if(!$class_id)
		$class_id=get_single_value('class_id','student',array('student_id'=>$student_id));
		$ci->db->select('subject_id');
		$ci->db->from('subject');
		$ci->db->where('class_id',$class_id);
		$ci->db->where('group_id',0);
		if($fourth_subject)
			$ci->db->where('subject_id !=',$fourth_subject);
		$result=$ci->db->get();
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
		if(!$fourth_subject)
			$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
		if($fourth_subject)
		$subjects[]=$fourth_subject;
		return $subjects;
	}
	function sub_total_gpa($student_id,$class_id,$exam_id,$sub_exam_id,$fourth_subject='')
	{
		$ci=& get_instance();
		$ci->load->database();
		$total_subject=subject_counter($student_id,$class_id,$fourth_subject);
		$mark_condition=array(
		'class_id'=>$class_id,
		'student_id'=>$student_id,
		'sub_exam_id'=>$sub_exam_id,
		'exam_id'=>$exam_id
		);
		$sub_sum_gpa=0;
		$ci->db->select('total_marks,sub_total');
		$ci->db->where($mark_condition);
		if($fourth_subject)
		$ci->db->where('subject_id !=',$fourth_subject);
		$ci->db->from('mark');
		$result=$ci->db->get();
		$failed=FALSE;
		foreach($result->result() as $row)
		{
			$total=$row->sub_total;
			$fm=$row->total_marks;
			$gpa=get_gpa($total,$fm);
			if(!$gpa)
			{
				return 0;
			}
			$sub_sum_gpa+=$gpa;
		}
		if($fourth_subject)
		{
			$ci->db->select('total_marks,sub_total');
			$ci->db->where($mark_condition);
			$ci->db->where('subject_id',$fourth_subject);
			$ci->db->from('mark');
			$result=$ci->db->get();
			foreach($result->result() as $row)
			{
				$total=$row->sub_total;
				$fm=$row->total_marks;
				$gpa=get_gpa($total,$fm);
				if($gpa>2)
				$gpa=$gpa-2;
				else
				$gpa=0;
				$sub_sum_gpa+=$gpa;
			}
		}
		$final_gpa=$sub_sum_gpa/$total_subject;
		if($final_gpa>5)
		$final_gpa=5;
		return number_format($final_gpa,2);
	}
	function fourth_subject_calculation($student_id,$class_id,$exam_id,$fourth_subject='')
	{
		$ci=& get_instance();
		$ci->load->database();
		$sub_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		if(!$fourth_subject)
		$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
		$get_total_added_mark=0;
		$subjects=subjects($student_id);
		if($sub_count)
		{
			$ci->db->from('exam');
			$ci->db->where('parent_id',$exam_id);
			$sub_xm_res=$ci->db->get();
			foreach($sub_xm_res->result() as $sub_xm)
			{
				$sub_exam_id=$sub_xm->exam_id;
				$condition=array(
				'exam_id'=>$exam_id,
				'sub_exam_id'=>$sub_exam_id,
				'subject_id'=>$fourth_subject,
				'student_id'=>$student_id
				);
				$get_mark=get_single_value('sub_total','mark',$condition);
				$full_mark=get_single_value('total_marks','mark',$condition);
				$fourty=($full_mark*40)/100;
				$will_add=$get_mark-$fourty;
				if($will_add<=0)
				$will_add=0;
				$get_total_added_mark+=$will_add;
			}
		}
		else
		{
			$condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'exam_id'=>$exam_id,
			'subject_id'=>$fourth_subject
			);
			$get_mark=get_single_value('sub_total','mark',$condition);
			$full_mark=get_single_value('total_marks','mark',$condition);
			$fourty=($full_mark*40)/100;
			$will_add=$get_mark-$fourty;
			if($will_add<0)
			{
				$will_add=0;	
			}
			$get_total_added_mark+=$will_add;
		}
		return $get_total_added_mark;
	}
	function get_total_category_mark($student_id,$class_id,$exam_id)
	{
		$ci=& get_instance();
		$ci->load->database();
		$subjects=subjects($student_id);
		$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
		if($parent_id)
		{
			$ci->db->where('sub_exam_id',$exam_id);
			$ci->db->where('exam_id',$parent_id);
		}
		else
		{
			$ci->db->where('exam_id',$exam_id);
		}
		$ci->db->where('student_id',$student_id);
		$ci->db->where('class_id',$class_id);
		$ci->db->where_in('subject_id',$subjects);
		$ci->db->select('sum(total_marks),sum(formation),sum(objective),sum(practical),sum(sba)');
		$ci->db->from('mark');
		$result=$ci->db->get();
		$totals=array();
		foreach($result->result() as $row)
		{
			$total_marks=$row->total_marks;
		}
	}
	function merit_position($exam_id='',$class_id='',$position_for_mark='',$id_for_position='')
	{
		$ci=& get_instance();
		$ci->load->database();
		$details = array(
			'class_id'=>$class_id
		);
		$ci->load->library('progress_card_lib',$details,'prog_card');
		$ci->db->select('distinct(student_id)');
		$ci->db->where('class_id',$class_id);
		$ci->db->from('mark');
		$result=$ci->db->get();
		$list=array();
		foreach($result->result() as $row)
		{
			$student_id=$row->student_id;
			if ($exam_id)
			{
				$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
				if($parent_id and $parent_id!="-")
				{
					$grace_total_mark = $ci->prog_card->grand_total_mark($student_id,$parent_id,$exam_id);
					$gpa = $ci->prog_card->grand_total_gpa($student_id,$parent_id,$exam_id);
				}
				else
				{
					$grace_total_mark = $ci->prog_card->grand_total_mark($student_id,$exam_id);
					$gpa = $ci->prog_card->grand_total_gpa($student_id,$exam_id);
				}
			}																					
			else if(!$exam_id)
			{
				$grace_total_mark = $ci->prog_card->grand_total_mark($student_id);
				$gpa = $ci->prog_card->grand_total_gpa($student_id);
			}
			$lg=get_letter_grade($gpa);
			if($lg!="F")
			$list[$student_id]=$grace_total_mark;
		}
		if($position_for_mark)
		{
			rsort($list);
			$position_for_mark--;
			return $list[$position_for_mark];
		}
		if($id_for_position)
		{
			arsort($list);
			$keys=array_keys($list);
			$position=array_search($id_for_position,$keys);
			$position++;
			if(!$position)
			return "X";
			return number_to_word($position);
		}
	}
?>