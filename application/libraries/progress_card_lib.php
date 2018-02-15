<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Progress_card_lib
{
	private $class_id='';
	private $exam_id='';
	private $section='';
	private $group='';
	private $merits=array();
	private $CI;
    public function __construct($cardof=array())
    {
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->helper('mark_sheet');
		$this->class_id=$cardof['class_id'];
		if(array_key_exists('exam_id',$cardof))
		$this->exam_id=$cardof['exam_id'];
    }
	function meritlist($exam_id='',$sub_exam_id='')
	{
		$this->CI->db->select('distinct(student_id)');
		$this->CI->db->where('class_id',$this->class_id);
		if($exam_id)
		$this->CI->db->where('exam_id',$exam_id);
		if($sub_exam_id)
		$this->CI->db->where('sub_exam_id',$sub_exam_id);
		$this->CI->db->from('mark');
		$result=$this->CI->db->get();
		$list=array();
		foreach($result->result() as $row)
		{
			$student_id=$row->student_id;
			if ($sub_exam_id)
			{
				$grace_total_mark = $this->grand_total_mark($student_id,$exam_id,$sub_exam_id);
				$gpa = $this->grand_total_gpa($student_id,$exam_id,$sub_exam_id);
			}																					
			else if($exam_id)
			{
				$grace_total_mark =$this->grand_total_mark($student_id,$exam_id);
				$gpa = $this->grand_total_gpa($student_id,$exam_id);
			}
			else if(!$exam_id)
			{
				$grace_total_mark =$this->grand_total_mark($student_id);
				$gpa = $this->grand_total_gpa($student_id);
			}
			$lg=get_letter_grade($gpa);
			if($lg!="F")
			$list[$student_id]=$grace_total_mark;
		}
		$this->merits=$list;
	}
	function get_mark_from_list($position=1)
	{
		$list=$this->merits;
		rsort($list);
		$position--;
		return $list[$position];
	}
	function get_position($student_id='')
	{
		if(!$student_id)
		return;
		$list=$this->merits;
		/*arsort($list);
		$keys=array_keys($list);
		$position=array_search($student_id,$keys);*/
		$position=$this->sp_get_position($list[$student_id]);
		if(!$position)
		return "X";
		return number_to_word($position);
	}
	function sp_get_position($mark)
	{
		$list=$this->merits;
		$list=array_unique($list);
		rsort($list);
		$position=array_search($mark,$list);
		$position++;
		return $position;
	}
	function sub_exams($exam_id='')
	{
		$this->CI->db->where('parent_id',$exam_id);
		$result=$this->CI->db->from('exam')->get();
		return $result;
	}
	function main_subject()
	{
		$this->CI->db->where('class_id',$this->class_id);
		$this->CI->db->where('group_id',0);
		$this->CI->db->where('status',0);
		$result=$this->CI->db->from('subject')->get();
		return $result;
	}
	function get_mark($student_id,$subject_id,$exam_id,$sub_exam_id='')
	{
		$this->CI->db->where('class_id',$this->class_id);
		$this->CI->db->where('subject_id',$subject_id);
		$this->CI->db->where('student_id',$student_id);
		$this->CI->db->where('exam_id',$exam_id);
		if($sub_exam_id)
		$this->CI->db->where('sub_exam_id',$sub_exam_id);
		$result=$this->CI->db->from('mark')->get();
		return $result;
	}
	function grand_total_mark($student_id,$exam_id='',$sub_exam_id='')
	{
		$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
		$this->CI->db->where('class_id',$this->class_id)->where('total_marks !=',0);
		if($fourth_subject)
		$this->CI->db->where('subject_id !=',$fourth_subject);
		$this->CI->db->where('student_id',$student_id);
		if($exam_id)
		$this->CI->db->where('exam_id',$exam_id);
		if($sub_exam_id)
		$this->CI->db->where('sub_exam_id',$sub_exam_id);
		$result=$this->CI->db->select('sum(sub_total) as total')->from('mark')->get()->result();
		foreach($result as $rows)
		{
			$total=$rows->total;
		}
		$total+=0;
		if($fourth_subject):
		$this->CI->db->where('class_id',$this->class_id);
		$this->CI->db->where('subject_id',$fourth_subject);
		$this->CI->db->where('student_id',$student_id);
		if($exam_id)
		$this->CI->db->where('exam_id',$exam_id);
		if($sub_exam_id)
		$this->CI->db->where('sub_exam_id',$sub_exam_id);
		$result=$this->CI->db->from('mark')->get()->result();
		$extra_mark=0;
		foreach($result as $row)
		{
			$fourth_subject_full=$row->total_marks;
			$fourth_subject_mark=$row->sub_total;
			$extra_mark=$fourth_subject_mark-(($fourth_subject_full*40)/100);
			if($extra_mark<0) $extra_mark=0;
			$total+=$extra_mark;
		}
		$total+=0;
		endif;
		return $total;
	}
	function grand_total_gpa($student_id,$exam_id='',$sub_exam_id='')
	{
		if(!$exam_id)
		{
			$gpa=0;
			$this->CI->db->select('distinct(exam_id)');
			$this->CI->db->from('mark');
			$this->CI->db->where('student_id',$student_id);
			$exams=$this->CI->db->get();
			foreach($exams->result() as $row)
			{
				$exam_id=$row->exam_id;
				$cgpa=$this->grand_total_gpa($student_id,$exam_id);
				if($cgpa>=0)
				{
					$gpa+=$cgpa;
				}
				else
				{
					return 0;
				}
			}
			$exams_number=$exams->num_rows();
			$gpa=$gpa/$exams_number;
			if($gpa>5) $gpa=5;
			$gpa=number_format($gpa,2);
			return $gpa;
		}
		$sub_exam_count=get_single_value('count(exam_id)','exam',array('parent_id'=>$exam_id));
		if(!$sub_exam_id and $sub_exam_count)
		{
			$gpa=0;
			$sub_exams=$this->sub_exams($exam_id);
			$exam_counted=0;
			foreach($sub_exams->result() as $exam)
			{
				$sub_exam_id=$exam->exam_id;
				$cgpa=$this->grand_total_gpa($student_id,$exam_id,$sub_exam_id);
				if($cgpa>=0)
				{
					$exam_counted++;
					$gpa+=$cgpa;
				}
				if($cgpa==0)
				{
					return 0;
				}
			}
			$gpa=$gpa/$exam_counted;
			if($gpa>5) $gpa=5;
			$gpa=number_format($gpa,2);
			return $gpa;
		}
		$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
		if($fourth_subject)
		$this->CI->db->where('subject_id !=',$fourth_subject);
		$this->CI->db->where('class_id',$this->class_id);
		$this->CI->db->where('total_marks !=',0);
		$this->CI->db->where('student_id',$student_id);
		$this->CI->db->where('exam_id',$exam_id);
		if($sub_exam_id)
		$this->CI->db->where('sub_exam_id',$sub_exam_id);
		$marks=$this->CI->db->from('mark')->get();
		$total_gpa=0;
		foreach($marks->result() as $row)
		{
			$full=$row->total_marks;
			$mark=$row->sub_total;
			$subject_id=$row->subject_id;
			$formation=$row->formation;
			$objective=$row->objective;
			$practical=$row->practical;
			$sba=$row->sba;
			$gpa=get_gpa($mark,$full);
			$condition_pass_mark=array(
				'class_id'=>$this->class_id,
				'subject_id'=>$subject_id,
				'exam_id'=>$exam_id
				);
			if($sub_exam_id)
			{
				$condition_pass_mark=array(
				'class_id'=>$this->class_id,
				'subject_id'=>$subject_id,
				'exam_id'=>$exam_id,
				'sub_exam_id'=>$sub_exam_id
				);
			}
			$written_pass_mark=get_single_value('written_pass_mark','full_mark',$condition_pass_mark);
			$objective_pass_mark=get_single_value('objective_pass_mark','full_mark',$condition_pass_mark);
			$practical_pass_mark=get_single_value('practical_pass_mark','full_mark',$condition_pass_mark);
			$sba_pass_mark=get_single_value('sba_pass_mark','full_mark',$condition_pass_mark);
			if($written_pass_mark>$formation or $objective_pass_mark>$objective or $practical_pass_mark>$practical or $sba_pass_mark>$sba)
			{
				$gpa=0;
			}
			if($gpa==0)
			return 0;
			$total_gpa+=$gpa;
		}
		if($fourth_subject):
            $this->CI->db->where('class_id',$this->class_id)->where('total_marks !=',0);;
			$this->CI->db->where('subject_id =',$fourth_subject);
			$this->CI->db->where('student_id',$student_id);
			if($exam_id)
			$this->CI->db->where('exam_id',$exam_id);
			if($sub_exam_id)
			$this->CI->db->where('sub_exam_id',$sub_exam_id);
			$marksfourth=$this->CI->db->from('mark')->get();
			$extra_gpa=0;
			foreach($marksfourth->result() as $row)
			{
	            $full=$row->total_marks;
				$mark=$row->sub_total;
				$gpa=get_gpa($mark,$full);
				$extra_gpa=$gpa-2;
				if($extra_gpa<0)
				$extra_gpa=0;
			}
	                 
			$total_gpa+=$extra_gpa;
		endif;
		$subject_number=$marks->num_rows();
		if(!$subject_number)
		return -1;
		$gpa=$total_gpa/$subject_number;
		if($gpa>5) $gpa=5;
		$gpa=number_format($gpa,2);
		return $gpa;
	}
}

?>