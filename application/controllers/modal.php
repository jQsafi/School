<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        
    }

    function popup($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == 'student_profile') {
			$page_data['page_title'] = 'Student Information';
            $page_data['current_student_id'] = $param2;
        } else if ($param1 == 'student_academic_result') {
            $page_data['current_student_id'] = $param2;
        } else if ($param1 == 'student_id_card') {
            $page_data['current_student_id'] = $param2;
        } else if ($param1 == 'edit_student') {
			$page_data['page_title'] = 'Student Information';
            $page_data['edit_data'] = $this->db->get_where('student', array('student_id' => $param2))->result_array();
            $page_data['class_id'] = $param3;
			$page_data['student_id'] = $param2;
        } else if ($param1 == 'teacher_profile') {
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit_teacher') 
		{
            $page_data['edit_data'] = $this->db->get_where('teacher', array('teacher_id' => $param2))->result_array();
			$this->load->library('grocery_CRUD');
			$crud = new grocery_CRUD();
			$crud->set_table('teacher_education')
				->where(array('teacher_id' => $param2))
								//->set_theme('datatables')
								->set_subject(translate('educational_qualification'))
								->field_type('teacher_id', 'hidden',$param2)
								->unset_columns('teacher_id')
								->unset_texteditor('institute_address','full_text')
								->unset_read()
								->unset_export()
								->unset_jquery()
								->unset_print();
			$output = $crud->render();
			$page_data['output']=$output;
			
		}	else if ($param1 == 'edit_salary') {
            $page_data['edit_data'] = $this->db->get_where('salarysetup', array('id' => $param2))->result_array();
        } else if ($param1 == 'add_parent') {
            $page_data['student_id'] = $param2;
            $page_data['class_id'] = $param3;
        } else if ($param1 == 'edit_parent') {
            $page_data['edit_data'] = $this->db->get_where('parent', array('parent_id' => $param2))->result_array();
            $page_data['class_id'] = $param3;
        } else if ($param1 == 'edit_subject') {
            $page_data['edit_data'] = $this->db->get_where('subject', array('subject_id' => $param2))->result_array();
        } else if ($param1 == 'college_subject') {
            $page_data['edit_data'] = $this->db->get_where('collegesubject', array('subject_id' => $param2))->result_array();
        } else if ($param1 == 'edit_class') {
            $page_data['edit_data'] = $this->db->get_where('class', array('class_id' => $param2))->result_array();
        } else if ($param1 == 'edit_exam') {
            $page_data['edit_data'] = $this->db->get_where('exam', array('exam_id' => $param2))->result_array();
        } else if ($param1 == 'edit_grade') {
            $page_data['edit_data'] = $this->db->get_where('grade', array('grade_id' => $param2))->result_array();
        } else if ($param1 == 'edit_class_routine') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array('class_routine_id' => $param2))->result_array();
        } else if ($param1 == 'view_invoice') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
            //$page_data['edit_data'] = $this->db->get_where('invoice', array('student_id' => $param3))->result_array();
        } else if ($param1 == 'view_payment') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
			$page_data['invoice_id']=$param2;
        } else if ($param1 == 'edit_invoice') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
        } else if ($param1 == 'edit_book') {
            $page_data['edit_data'] = $this->db->get_where('book', array('book_id' => $param2))->result_array();
        } else if ($param1 == 'edit_transport') {
            $page_data['edit_data'] = $this->db->get_where('transport', array('transport_id' => $param2))->result_array();
        } else if ($param1 == 'edit_dormitory') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array('dormitory_id' => $param2))->result_array();
        } else if ($param1 == 'edit_notice') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array('notice_id' => $param2))->result_array();
        } else if ($param1 == 'expense_detail') {
            $page_data['current_expense_id'] = $param2;
        } else if ($param1 == 'edit_expense') {
            $page_data['edit_data'] = $this->db->get_where('expense', array('exp_id' => $param2))->result_array();
        } else if ($param1 == 'income_detail') {
            $page_data['current_income_id'] = $param2;
        } else if ($param1 == 'edit_income') {
            $page_data['edit_data'] = $this->db->get_where('income', array('inc_id' => $param2))->result_array();
        } else if ($param1 == 'edit_fees_setup') {
            $page_data['edit_data'] = $this->db->get_where('fees_setup', array('class_id' => $param2))->result_array();
        } else if ($param1 == 'month_salary') {
            $page_data['month'] =$param2;
            $page_data['year'] = $param3;
			$data['status'] = 1;
			$this->db->where(array('month' => $param2,'year' => $param3));
            $this->db->update('csalary',$data);
			$page_data['salarymonth'] = $this->db->where(array('month' => $param2,'year' => $param2,'status' =>1))->get('csalary')->result_array();	
        }else if ($param1 == 'edit_holiday') {
            $page_data['edit_data'] = $this->db->get_where('holiday', array('holidayid' => $param2))->result_array();
        }else if ($param1 == 'edit_attendance_type') {
            $page_data['edit_data'] = $this->db->get_where('attendance_type', array('type_id' => $param2))->result_array();
        }else if ($param1 == 'edit_admitcard') {
            $page_data['edit_data'] = $this->db->get_where('admit_card', array('admit_id' => $param2))->result_array();
        }else if ($param1 == 'edit_testimonial') {
            $page_data['edit_data'] = $this->db->get_where('testimonial', array('testimonial_id' => $param2))->result_array();
        }else if ($param1 == 'edit_TC') {
            $page_data['edit_data'] = $this->db->get_where('transfer_certificate', array('tc_id' => $param2))->result_array();
        }


        $page_data['page_name'] = $param1;
        $this->load->view('modal', $page_data);
    }

}

