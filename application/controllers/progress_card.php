<?php

if(!defined('BASEPATH'))    exit('No direct script access allowed');

class Progress_card extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('mark_sheet');
		$this->load->language('mark_sheet');
	}
	function details_progress_card()
	{
		if($this->session->userdata('login') != 1)            
			redirect(base_url(), 'refresh');

		if($this->input->post('operation') == 'selection'){
			$page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['class_id'] = $this->input->post('class_id');
			$page_data['subject_id'] = $this->input->post('subject_id');
			$page_data['grade'] = $this->input->post('grade');
			$details = array(
				'class_id'=>$page_data['class_id']
			);
			if($page_data['exam_id'])
			{
				$details = array(
				'class_id'=>$page_data['class_id'],
				'exam_id'=>$page_data['exam_id'],
			);
			}
			$this->load->library('progress_card_lib',$details,'prog_card');
		}
		$page_data['page_info'] = 'Progress Card';
		$page_data['page_name'] = 'details_progress_card';
		$page_data['page_title'] = 'Progress Card';
		$this->load->view('progress_card/progress_card', $page_data);
	}
	function progresscard($type='details')
	{

		if($this->session->userdata('login') != 1)            
			redirect(base_url(), 'refresh');

		if($this->input->post('operation') == 'selection'){
			$page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['class_id'] = $this->input->post('class_id');
			$page_data['subject_id'] = $this->input->post('subject_id');
			$page_data['grade'] = $this->input->post('grade');
		}
		$page_data['page_info'] = 'Progress Card';
		$page_data['page_name'] = 'progress_card_'.$type;
		$page_data['page_title'] = 'Progress Card';
		$page_data['type']=$type;
		$this->load->view('progress_card/progress_card', $page_data);
	}
	function details($type='details',$student_id,$exam_id='',$class_id='') 
	{
		if ($this->session->userdata('login') != 1)
            redirect(base_url(), 'refresh');
		if(!$class_id)
		$class_id=get_single_value('class_id','student',array('student_id'=>$student_id));
		
		$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
		$this->db->select('subject_id');
		$this->db->from('subject');
		$this->db->where('class_id',$class_id);
		$this->db->where('group_id',0);
		$this->db->where('status',0);
		if($fourth_subject)
		$this->db->where('subject_id !=',$fourth_subject);
		$result=$this->db->get();
		$subjects=array();
		foreach($result->result() as $sub)
		{
			$subjects[]=$sub->subject_id;
		}
		$group_subjects=get_single_value('subject_id','student',array('student_id'=>$student_id));
		$subject_ids=explode('SC',$group_subjects);
		foreach($subject_ids as $id)
		{
			if($id)
			{
				$subjects[]=$id;
			}
		}
		if($fourth_subject)
		{
			$subjects[]=$fourth_subject;
		}
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['exam_id'] = $exam_id;
		$page_data['subjects'] = $subjects;
        $page_data['page_info'] = 'Progress Card';
        $page_data['page_title'] = 'Progress Card';
		$page_data['type']=$type;
		$this->load->view('progress_card/card', $page_data);	
	}
	function progresscard_print_all($type='')
	{

		if($this->session->userdata('admin_login') != 1)            
			redirect(base_url(), 'refresh');
		if(!$type)
		$type="details";
		$class_id=$this->input->post('class_id');
		$exam_id=$this->input->post('exam_id');
		if(!$exam_id)
		$exam_id='all';
		$student_id=$this->input->post('student_id');
        $page_data['class_id'] = $class_id;
        $page_data['exam_id'] = $exam_id;
		$page_data['student_id'] = $student_id;
        $page_data['page_info'] = 'Progress Card';
        $page_data['page_title'] = 'Progress Card-Bulk Print';
		$page_data['type']=$type;
		$this->load->view('progress_card/print_all', $page_data);
	}
}