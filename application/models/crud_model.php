<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    ////////STUDENT/////////////
    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_students_by_class($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        //return $query->result_array();
        $student = $query->result_array();
        $row = array();
        foreach ($student as $row1) {
            $row['student_id'][] = $row1['student_id'];
        }
        return $row;
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }
    
    function get_expense_info($expense_id) {
        $query = $this->db->get_where('expense', array('exp_id' => $expense_id));
        return $query->result_array();
    }
    
    function get_income_info($income_id) {
        $query = $this->db->get_where('income', array('inc_id' => $income_id));
        return $query->result_array();
    }

    /////////TEACHER/////////////
    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    //////////SUBJECT/////////////
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }
    function get_subExam_by_exam($class_id) {
        $query = $this->db->get_where('exam', array('parent_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    ////////////CLASS///////////
    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    //////////INVOICE/////////////
    function get_invoice_by_student($student_id) {
        $query = $this->db->get_where('invoice', array('student_id' => $student_id));
        return $query->result_array();
    }
    
    function get_invoice_by_class($class_id) {
        $query = $this->db->get_where('invoice', array('class_id' => $class_id));
        return $query->result_array();
    }
    function get_all_student_invoice_by_class($class_id) {
        //$query = $this->db->get_where('invoice', array('class_id' => $class_id));
        //return $query->result_array();
        
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('student', 'student.roll = invoice.student_id');
        //$this->db->join('class', 'class.class_id = student.class_id');
        $this->db->where('invoice.class_id', $class_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    function get_all_invoice() {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('student', 'student.roll = invoice.student_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_invoice_by_status($status) {
        $query = $this->db->get_where('invoice', array('status' => $status));
        return $query->result_array();
    }
    
    function get_all_student_invoice_by_status($status) {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('student', 'student.roll = invoice.student_id');
        //$this->db->join('class', 'class.class_id = student.class_id');
        $this->db->where('invoice.status', $status);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_all_student_invoice_by_date($start_date, $end_date) {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('student', 'student.student_id = invoice.student_id');
        $this->db->where('creation_date >=', $start_date);
        $this->db->where('creation_date <=', $end_date);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_fees_name() {
        $query = $this->db->get('fees_name');
        //$query = $this->db->get_where('fees_name', array('fees_name_id' => $fee_name_id));
        return $query->result_array();
    }
    function get_fees_name_by_id($fee_name_id){
        $this->db->select('fee_name');
        $this->db->from('fees_name');
        $this->db->where('fees_name_id', $fee_name_id);
        $query = $this->db->get();       
        
        return $query->result_array();
    }
    
    function get_expense_report($expense_by = "", $expense_id = "", $invoice_id = "", $expense_name = "", $category = "", $payment_to = "", $payment_method = "", $expense_date_from = "", $expense_date_to = "") {
        $this->db->select('*')->from('expense');
		if($expense_by)
        $this->db->where('expense_by', $expense_by);
		if($expense_id)
        $this->db->where('expense_id', $expense_id);
		if($invoice_id)
        $this->db->where('invoice_id', $invoice_id);
		if($expense_name)
        $this->db->where('expense_name', $expense_name);
		if($category)
        $this->db->where('category', $category);
		if($payment_to)
        $this->db->where('payment_to', $payment_to);
		if($payment_method)
        $this->db->where('payment_method', $payment_method);
		if($expense_date_from)
        $this->db->where('expense_date >=',$expense_date_from);
		if($expense_date_to)
        $this->db->where('expense_date <=', $expense_date_to);
        $query = $this->db->get()->result_array();        
        
        return $query;
    }
    
    function get_income_report($income_by = "", $income_id = "", $invoice_id = "", $income_name = "", $category = "", $payment_from = "", $payment_method = "", $income_date_from = "", $income_date_to = "") {
        $this->db->from('income');
		if($income_by)
        $this->db->where('income_by', $income_by);
		if($income_id)
        $this->db->where('income_id', $income_id);
		if($invoice_id)
        $this->db->where('invoice_id', $invoice_id);
		if($income_name)
        $this->db->where('income_name', $income_name);
		if($category)
        $this->db->where('category', $category);
		if($payment_from)
        $this->db->where('payment_from', $payment_from);
		if($payment_method)
        $this->db->where('payment_method', $payment_method);
		if($income_date_from)
        $this->db->where('income_date >=',$income_date_from);
		if($income_date_to)
		$this->db->where('income_date <=',$income_date_to);
        $query = $this->db->get();
        return $query;
    }

    //////////EXAMS/////////////
    function get_exams() {
		
		//$this->db->where('parent_id',0);
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    //////////GRADES/////////////
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_grade($mark_obtained) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function get_grade_from_gpa($gpa) {
	if ($gpa >= 80) {
            $point=5;
        } elseif ($gpa >= 70) {
            $point=4;
        } elseif ($gpa >= 60) {
            $point=3.5;
        } elseif ($gpa >= 50) {
            $point=3;
        } elseif ($gpa >= 40) {
            $point=2;
        } else {
            $point=0;
        }
	
	
        if ($point >= 5) {
            return 'A+';
        } elseif ($point >= 4) {
            return 'A';
        } elseif ($point >= 3.5) {
            return 'A-';
        } elseif ($point >= 3) {
            return 'B';
        } elseif ($point >= 2) {
            return 'D';
        } else {
            return 'F';
        }
        // return $gradeinfo;
    }
	
	
    function get_grade_point($gpa) {
	if ($gpa >= 80) {
           return $point=5;
        } elseif ($gpa >= 70) {
           return $point=4;
        } elseif ($gpa >= 60) {
           return $point=3.5;
        } elseif ($gpa >= 50) {
           return $point=3;
        } elseif ($gpa >= 40) {
           return $point=2;
        } else {
           return $point=0;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();
		$this->load->dbforge();
		$this->dbforge->rename_table('update', 'temp_update');
		$this->dbforge->rename_table('group', 'temp_group');
        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') 
		{
			$tables =  '';
            $options = array
			(
			'ignore'=>array('group','update'),
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"
        	);
			$file_name = 'system_backup';
			$backup =& $this->dbutil->backup($options);
        }
		else 
		{
			$options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n",
			'tables'   =>array($type)            
        	);
            $file_name = 'backup_' . $type;
			$backup =& $this->dbutil->backup($options);
        }

        


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() 
	{
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
		$this->load->dbforge();
		$this->dbforge->rename_table('temp_update', 'update');
		$this->dbforge->rename_table('temp_group', 'group');
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') { 
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

}

