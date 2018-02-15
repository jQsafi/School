<?php
class Result_process_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->helper('mark_sheet');
    }
	function verify_marks()
	{
		$result=$this->db->where('parent_id !=','0')->from('exam')->get();
		foreach($result->result() as $row)
		{
			$exam_id=$row->exam_id;
			$parent_id=$row->parent_id;
			$this->db->where('exam_id',$parent_id);
			$this->db->where('sub_exam_id','99999');
			$this->db->delete('mark');
		}
		$result=$this->db->where('parent_id','0')->from('exam')->get();
		foreach($result->result() as $row)
		{
			$exam_id=$row->exam_id;
			$sub_exam=$this->db->where('parent_id',$exam_id)->from('exam')->get();
			if($sub_exam->num_rows()>0)
			{
				$this->db->where('exam_id',$exam_id);
				$this->db->where('sub_exam_id','99999');
				$this->db->delete('mark');
			}
			else
			{
				$this->db->where('exam_id',$exam_id);
				$this->db->where('sub_exam_id !=','99999');
				$this->db->delete('mark');
			}
		}
		$this->db->where('total_marks','0');
		$this->db->delete('mark');
		$this->db->select('subject_id');
		$this->db->from('subject')->get();
		$subQuery = $this->db->last_query();
		$this->db->where_not_in("$subQuery");
		$this->db->delete('mark');
		$this->db->select('student_id');
		$this->db->from('student')->get();
		$subQuery = $this->db->last_query();
		$this->db->where_not_in("$subQuery");
		$this->db->delete('mark');
		return 'complete';
	}
	function update_subject_result()
	{
		$result=$this->db->from('mark')->get();
		foreach($result->result() as $row)
		{
			$mark_id=$row->mark_id;
			$subject_id=$row->subject_id;
			$exam_id=$row->exam_id;
			$class_id=$row->class_id;
			$sub_exam_id=$row->sub_exam_id;
			$formation=$row->formation;
			$objective=$row->objective;
			$practical=$row->practical;
			$sba=$row->sba;
			$sub_total=$row->sub_total;
			$total_marks=$row->total_marks;
			$gpa=get_gpa($sub_total,$total_marks);
			$condition_pass_mark=array(
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
				'exam_id'=>$exam_id,
				'sub_exam_id'=>$sub_exam_id
				);
			$written_pass_mark=0;
			$objective_pass_mark=0;
			$practical_pass_mark=0;
			$sba_pass_mark=0;
			$pass_query=$this->db->from('full_mark')->where($condition_pass_mark)->get();
			if($pass_query->num_rows())
			{
				foreach($pass_query->result() as $pm)
				{
					$written_pass_mark=$pm->written_pass_mark;
					$objective_pass_mark=$pm->objective_pass_mark;
					$practical_pass_mark=$pm->practical_pass_mark;
					$sba_pass_mark=$pm->sba_pass_mark;
				}
				if($formation<$written_pass_mark or $objective<$objective_pass_mark or $practical<$practical_pass_mark or $sba<$sba_pass_mark)
				{
					$gpa=0;
				}
			}
			$lg=get_letter_grade($gpa);
			$heights_condition=array(
			'subject_id'=>$subject_id,
			'class_id'=>$class_id,
			'exam_id'=>$exam_id,
			'sub_exam_id'=>$sub_exam_id
			//'grade !=' =>'F'
			);
			$highest_mark=get_single_value('max(sub_total)','mark',$heights_condition);
			$update_data=array(
			'sgpa'=>$gpa,
			'grade'=>$lg,
			'highest_mark'=>$highest_mark
			);
			$this->db->where('mark_id',$mark_id);
			$this->db->update('mark',$update_data);
		}
		return "complete";
	}
	function update_exam_result()
	{
		$this->db->truncate('exam_result');
		$this->db->select('student.student_id,fourth_id,mark.class_id,exam_id,sub_exam_id,sum(formation) as formation,sum(objective) as objective,sum(practical) as practical,sum(sba) as sba,sum(sub_total)as total_mark,sum(total_marks) as full_mark,sum(sgpa) as gpa');
		$this->db->from('mark');
		$this->db->group_by('student_id');
		$this->db->group_by('sub_exam_id');
		$this->db->group_by('exam_id');
		$this->db->group_by('mark.class_id');
		$this->db->join('student','student.student_id=mark.student_id','left_inner');
		$result=$this->db->get()->result();
		foreach($result as $row)
		{
			$data=array();
			$data['student_id']=$row->student_id;
			$data['class_id']=$row->class_id;
			$data['exam_id']=$row->exam_id;
			$data['sub_exam_id']=$row->sub_exam_id;
			$data['formation']=$row->formation;
			$data['objective']=$row->objective;
			$data['practical']=$row->practical;
			$data['sba']=$row->sba;
			$data['full_mark']=$row->full_mark;
			$total_mark=$row->total_mark;
			$gpa=$row->gpa;
			$total_subject=get_single_value('count(subject_id)','mark',array('student_id'=>$row->student_id,'class_id'=>$row->class_id,'exam_id'=>$row->exam_id,'sub_exam_id'=>$row->sub_exam_id));
			if($row->fourth_id)
			{
				$this->db->where('subject_id',$row->fourth_id);
				$this->db->where('exam_id',$row->exam_id);
				$this->db->where('class_id',$row->class_id);
				$this->db->where('sub_exam_id',$row->sub_exam_id);
				$this->db->where('student_id',$row->student_id);
				$fourth_mark=$this->db->from('mark')->get();
				foreach($fourth_mark->result() as $fmark)
				{
					$ftotal_mark=$fmark->sub_total;
					$ffull_mark=$fmark->total_marks;
					$total_mark=$total_mark-$ftotal_mark;
					$addition=$ftotal_mark-(($ffull_mark*40)/100);
					if($addition<0) $addition=0;
					$total_mark=$total_mark+$addition;
					$fgpa=$fmark->sgpa;
					$fgpa=$fgpa-2;
					if($fgpa<0) $fgpa=0;
					$gpa=$gpa+$fgpa;
					$total_subject=$total_subject-1;
				}
			}
			$gpa=$gpa/$total_subject;
			if($gpa>5)
			$gpa=5;
			$fgrade=get_single_value('count(mark_id)','mark',array('student_id'=>$row->student_id,'class_id'=>$row->class_id,'exam_id'=>$row->exam_id,'sub_exam_id'=>$row->sub_exam_id,'grade'=>'F'));
			if($fgrade)
			$gpa=0;
			$gpa=number_format($gpa,2);
			$data['total_mark']=$total_mark;
			$data['gpa']=$gpa;
			$data['grade']=get_letter_grade($gpa);
			$this->db->insert('exam_result',$data);
			}
			
			$this->db->select('student_id,class_id,exam_id,sum(formation) as formation,sum(objective) as objective,sum(practical) as practical,sum(sba) as sba,sum(total_mark)as total_mark,sum(full_mark) as full_mark,avg(gpa) as gpa');
			$this->db->from('exam_result');
			$this->db->group_by('student_id');
			$this->db->group_by('exam_id');
			$this->db->group_by('class_id');
			$this->db->where('sub_exam_id !=','99999');
			$result=$this->db->get()->result();
			foreach($result as $row)
			{
				$data=array();
				$data['student_id']=$row->student_id;
				$data['class_id']=$row->class_id;
				$data['exam_id']=$row->exam_id;
				$data['formation']=$row->formation;
				$data['objective']=$row->objective;
				$data['practical']=$row->practical;
				$data['sba']=$row->sba;
				$data['full_mark']=$row->full_mark;
				$data['total_mark']=$row->total_mark;
				$gpa=$row->gpa;
				if($gpa>5)
				$gpa=5;
				$fgrade=get_single_value('count(exam_id)','exam_result',array('student_id'=>$row->student_id,'class_id'=>$row->class_id,'exam_id'=>$row->exam_id,'grade'=>'F'));
				if($fgrade)
				$gpa=0;
				$gpa=number_format($gpa,2);
				$data['gpa']=$gpa;
				$data['grade']=get_letter_grade($gpa);
				$this->db->insert('exam_result',$data);
			}
			
			$this->db->select('student_id,class_id,sum(formation) as formation,sum(objective) as objective,sum(practical) as practical,sum(sba) as sba,sum(total_mark)as total_mark,sum(full_mark) as full_mark,avg(gpa) as gpa');
			$this->db->from('exam_result');
			$this->db->where('sub_exam_id !=','0');
			$this->db->group_by('student_id');
			$this->db->group_by('class_id');
			$result=$this->db->get()->result();
			foreach($result as $row)
			{
				$data=array();
				$data['student_id']=$row->student_id;
				$data['class_id']=$row->class_id;
				$data['formation']=$row->formation;
				$data['objective']=$row->objective;
				$data['practical']=$row->practical;
				$data['sba']=$row->sba;
				$data['full_mark']=$row->full_mark;
				$data['total_mark']=$row->total_mark;
				$gpa=$row->gpa;
				if($gpa>5)
				$gpa=5;
				$fgrade=get_single_value('count(exam_id)','exam_result',array('student_id'=>$row->student_id,'class_id'=>$row->class_id,'grade'=>'F'));
				if($fgrade)
				$gpa=0;
				$gpa=number_format($gpa,2);
				$data['gpa']=$gpa;
				$data['grade']=get_letter_grade($gpa);
				$this->db->insert('exam_result',$data);
			}
		return "complete";
	}
	function getrate_merit_list()
	{
		$this->db->select('exam_result.class_id,exam_result.exam_id,exam_result.sub_exam_id');
		$this->db->from('exam_result');
		$this->db->group_by('exam_result.class_id');
		$this->db->group_by('exam_result.exam_id');
		$this->db->group_by('exam_result.sub_exam_id');
		$this->db->where('exam_result.grade !=','F');
		$result=$this->db->get()->result();
		foreach($result as $row)
		{
			$condition=array(
			'class_id'=>$row->class_id,
			'exam_id'=>$row->exam_id,
			'sub_exam_id'=>$row->sub_exam_id
			);
			$this->db->select('exam_result.total_mark');
			$this->db->group_by('exam_result.total_mark');
			$this->db->order_by('exam_result.total_mark',"desc");
			$this->db->from('exam_result');
			$this->db->where($condition);
			$this->db->where('exam_result.grade !=','F');
			$numbers=$this->db->get()->result();
			$merit_position=1;
			foreach($numbers as $number)
			{
				$condition['total_mark']=$number->total_mark;
				$data['merit_position']=$merit_position;
				$this->db->where($condition);
				$this->db->update('exam_result',$data);
				$merit_position++;
			}
		}
		return 'complete';
	}
}
?>