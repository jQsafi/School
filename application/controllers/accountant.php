<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Accountant extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
		$this->load->library('grocery_crud');
		$this->gc = new grocery_CRUD();
		$this->gc->unset_print();
    }
    
   
    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('accountant_login') == 1)
		{
	     $this->load->view('home', $page_data);
		}
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = translate('admin_dashboard');
        $this->load->view('index', $page_data);
    }

	/*     * *ADMIN DASHBOARD** */

    function attendance($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
			
		if ($param1 == 'attendancebox') {
            $date = $this->input->post('attandancedate');
            $classid = $this->input->post('classid');
            $subjectid= $this->input->post('subjectid');

            $page_data['attendence'] = $this->db->get_where('student', array('class_id' => $classid))->result_array();
			$page_data['class_id'] = $classid;	
			$page_data['page_name'] = 'attendance';
            $page_data['page_title'] = translate('attendance');
            $this->load->view('index', $page_data);
        }
		
        $page_data['page_name'] = 'attendance';
        $page_data['page_title'] = translate('attendance');
        $this->load->view('index', $page_data);
    }
	function result_process($param1 = '', $param2 = '', $param3 = '') 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

		
		if ($param1 == 'process') 
		{
            if ($this->session->userdata('accountant_login') != 1)
            {
                echo "Please login to continue";
                return;
            }
			$this->load->model('result_process_model');	
			$progress1=$this->result_process_model->verify_marks();
			if($progress1)
			{
				$progress2=$this->result_process_model->update_subject_result();

				if($progress2)
				{
					$progress3=$this->result_process_model->update_exam_result();
				}
				if($progress3)
				{
					$progress4=$this->result_process_model->getrate_merit_list();
					echo $progress4;
				}
			}
			return;
        }
        $page_data['page_name'] = 'result_process';
        $page_data['page_title'] = translate('process_result');
        $this->load->view('index', $page_data);
    }
    /*     * **MANAGE STUDENTS CLASSWISE**** */

    function student($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['admission_form_no'] = $this->input->post('admission_form_no');
            $data['registration_no'] = $this->input->post('registration_no');
            $data['student_unique_ID'] = $this->input->post('student_unique_ID');
            
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['present_address'] = $this->input->post('present_address');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['religion'] = $this->input->post('religion');
            $data['nationality'] = $this->input->post('nationality');
            $data['password'] = $this->input->post('password');

            $data['father_name'] = $this->input->post('father_name');
            $data['father_age'] = $this->input->post('father_age');
            $data['father_education'] = $this->input->post('father_education');
            $data['father_occupation'] = $this->input->post('father_occupation');
			$data['father_mobile'] = $this->input->post('father_mobile');
			$data['father_blood_group'] = $this->input->post('father_blood_group');
			$data['father_nidnumber'] = $this->input->post('father_nidnumber');

            $data['mother_name'] = $this->input->post('mother_name');
            $data['mother_age'] = $this->input->post('mother_age');
            $data['mother_education'] = $this->input->post('mother_education');
            $data['mother_occupation'] = $this->input->post('mother_occupation');
			$data['mother_mobile'] = $this->input->post('mother_mobile');
			$data['mother_blood_group'] = $this->input->post('mother_blood_group');
			$data['mother_nidnumber'] = $this->input->post('mother_nidnumber');

            $data['guardian_name'] = $this->input->post('guardian_name');
            $data['guardian_profession'] = $this->input->post('guardian_profession');
            $data['guardian_age'] = $this->input->post('guardian_age');
            $data['guardian_income'] = $this->input->post('guardian_income');
            $data['guardian_land'] = $this->input->post('guardian_land');
			$data['guardian_nid']=$this->input->post('guardian_nid');  
            $data['guardian_address'] = $this->input->post('guardian_address');

            $data['prev_institution_name'] = $this->input->post('prev_institution_name');
            $data['prev_class_id'] = $this->input->post('prev_class_id');
            $data['prev_passing_yrs'] = $this->input->post('prev_passing_yrs');
            $data['prev_gpa'] = $this->input->post('prev_gpa');
            $data['prev_institution_address'] = $this->input->post('prev_institution_address');
            $data['tc_institution_name'] = $this->input->post('tc_institution_name');
            $data['tc_form_no'] = $this->input->post('tc_form_no');
            $data['tc_date'] = $this->input->post('tc_date');

            $data['clearance_no'] = $this->input->post('clearance_no');

            if ($this->input->post('admission_type') == "re-admission") {
                $data['class_id'] = $this->input->post('re_class_id');
            } else {
                $data['class_id'] = $this->input->post('class_id');
            }
            $data['roll'] = $this->input->post('roll');
            $data['section'] = $this->input->post('section');
            $data['group'] = $this->input->post('group');

            $data['passing_year'] = $this->input->post('passing_year');
            $data['other_student_name'] = $this->input->post('other_student_name');
            $data['others_class_id'] = $this->input->post('others_class_id');
            $data['group_others'] = $this->input->post('group_others');
            $data['others_section'] = $this->input->post('others_section');
            $data['others_roll'] = $this->input->post('others_roll');

            $this->db->insert('student', $data);
            $student_id = mysql_insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/student/' . $data['class_id'], 'refresh');
        }
        if ($param2 == 'do_update') {

            $data['admission_form_no'] = $this->input->post('admission_form_no');
            $data['registration_no'] = $this->input->post('registration_no');
            $data['student_unique_ID'] = $this->input->post('student_unique_ID');

            $data['name'] = $this->input->post('name');
			$data['nick_name'] = $this->input->post('nick_name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
			$data['maritial_status'] = $this->input->post('maritial_status');
            $data['present_address'] = $this->input->post('present_address');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['religion'] = $this->input->post('religion');
            $data['nationality'] = $this->input->post('nationality');
            $data['password'] = $this->input->post('password');

            $data['father_name'] = $this->input->post('father_name');
            $data['father_age'] = $this->input->post('father_age');
            $data['father_education'] = $this->input->post('father_education');
            $data['father_occupation'] = $this->input->post('father_occupation');
			$data['father_mobile'] = $this->input->post('father_mobile');
			$data['father_blood_group'] = $this->input->post('father_blood_group');
			$data['father_nidnumber'] = $this->input->post('father_nidnumber');
			$data['father_birthday'] = $this->input->post('father_birthday');
			

            $data['mother_name'] = $this->input->post('mother_name');
            $data['mother_age'] = $this->input->post('mother_age');
            $data['mother_education'] = $this->input->post('mother_education');
            $data['mother_occupation'] = $this->input->post('mother_occupation');
			$data['mother_mobile'] = $this->input->post('mother_mobile');
			$data['mother_blood_group'] = $this->input->post('mother_blood_group');
			$data['mother_nidnumber'] = $this->input->post('mother_nidnumber');
			$data['mother_birthday'] = $this->input->post('mother_birthday');
			
            $data['guardian_name'] = $this->input->post('guardian_name');
            $data['guardian_profession'] = $this->input->post('guardian_profession');
            $data['guardian_age'] = $this->input->post('guardian_age');
            $data['guardian_income'] = $this->input->post('guardian_income');
            $data['guardian_land'] = $this->input->post('guardian_land');
            $data['guardian_address'] = $this->input->post('guardian_address');
			$data['gardian_mobile'] = $this->input->post('gardian_mobile');
			$data['guardian_birthday'] = $this->input->post('guardian_birthday');
			$data['gardian_blood_group'] = $this->input->post('gardian_blood_group');
			$data['guardian_nid'] = $this->input->post('guardian_nid');
			$data['relation_id']=$this->input->post('relation_id');
            $data['prev_institution_name'] = $this->input->post('prev_institution_name');
            $data['prev_class_id'] = $this->input->post('prev_class_id');
            $data['prev_passing_yrs'] = $this->input->post('prev_passing_yrs');
            $data['prev_gpa'] = $this->input->post('prev_gpa');
            $data['prev_institution_address'] = $this->input->post('prev_institution_address');
            $data['tc_institution_name'] = $this->input->post('tc_institution_name');
            $data['tc_form_no'] = $this->input->post('tc_form_no');
            $data['tc_date'] = $this->input->post('tc_date');

            $data['clearance_no'] = $this->input->post('clearance_no');

            
             if ($this->input->post('admission_type') == "re-admission") {
                $data['class_id'] = $this->input->post('re_class_id');
				$data['roll'] = $this->input->post('roll');
				$data['section'] = $this->input->post('section');
				$data['group'] = $this->input->post('group');
				$data['passing_year'] = date("Y",$this->input->post('passing_year'));
				
				
				
            } else {
                $data['class_id'] = $this->input->post('class_id');
				$data['roll'] = $this->input->post('roll');
				$data['section'] = $this->input->post('section');
				$data['group'] = $this->input->post('group');
				$data['academic_year'] = $this->input->post('academic_year');
            }
			$mainsubject =$this->input->post('mainsubject');
            $subject_array=array();
			if($mainsubject)
            {
			$strsubject="";
            foreach ($mainsubject as $hobys=>$value) 
            {
            $strsubject.=$value."SC";
            $subject_array[]=$value;
			}
			}
			if($mainsubject)
            {
			$data['subject_id'] = $strsubject;
			}
			
			
            $forthsubject =$this->input->post('forthsubject');
			if($forthsubject)
            {
            foreach ($forthsubject as $hobys=>$value) 
            {
                $strforthsubject=$value;
                $subject_array[]=$value;
            }
			}
			if($forthsubject)
            {
                $data['fourth_id'] = $strforthsubject;
			}
            $this->db->where_not_in('subject_id',$subject_array);
            $this->db->where('student_id', $param3);
            $delete_mark_of_updated=$this->db->delete('marks');
            $data['other_student_name'] = $this->input->post('other_student_name');
            $data['others_class_id'] = $this->input->post('others_class_id');
            $data['group_others'] = $this->input->post('group_others');
            $data['others_section'] = $this->input->post('others_section');
            $data['others_roll'] = $this->input->post('others_roll');
            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
			$this->crud_model->clear_cache();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            redirect(site_url('modal/popup/edit_student/'.$param3));
        } else if ($param2 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('student', array(
                        'student_id' => $param3
                    ))->result_array();
        } else if ($param2 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_student_id'] = $param3;
        } else if ($param2 == 'academic_result') {
            $page_data['academic_result'] = true;
            $page_data['current_student_id'] = $param3;
        }
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?admin/student/' . $param1, 'refresh');
        }
        $page_data['class_id'] = $param1;
        $page_data['students_number'] = $this->db->where('status',1)->get('student')->result_array();
        
        $page_data['students'] = $this->db->get_where('student', array('class_id' => $param1,'status'=>1))->result_array();
        $page_data['page_name'] = 'student';
        $page_data['page_title'] = translate('manage_student');
        $this->load->view('index', $page_data);
    }
	
	
	function student_add($param1 = '', $param2 = '', $param3 = '') {
           if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['admission_form_no'] = $this->input->post('admission_form_no');
            $data['registration_no'] = $this->input->post('registration_no');
            $data['student_unique_ID'] = $this->input->post('student_unique_ID');
            
            $data['name'] = $this->input->post('name');
			$data['nick_name'] = $this->input->post('nick_name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('maritial_status');
			$data['maritial_status'] = $this->input->post('sex');
            $data['present_address'] = $this->input->post('present_address');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['religion'] = $this->input->post('religion');
            $data['nationality'] = $this->input->post('nationality');
            $data['password'] = $this->input->post('password');

            $data['father_name'] = $this->input->post('father_name');
            $data['father_age'] = $this->input->post('father_age');
            $data['father_education'] = $this->input->post('father_education');
            $data['father_occupation'] = $this->input->post('father_occupation');
			$data['father_mobile'] = $this->input->post('father_mobile');
			$data['father_blood_group'] = $this->input->post('father_blood_group');
			$data['father_nidnumber'] = $this->input->post('father_nidnumber');
			$data['father_birthday'] = $this->input->post('father_birthday');
			
            $data['mother_name'] = $this->input->post('mother_name');
            $data['mother_age'] = $this->input->post('mother_age');
            $data['mother_education'] = $this->input->post('mother_education');
            $data['mother_occupation'] = $this->input->post('mother_occupation');
			$data['mother_mobile'] = $this->input->post('mother_mobile');
			$data['mother_blood_group'] = $this->input->post('mother_blood_group');
			$data['mother_nidnumber'] = $this->input->post('mother_nidnumber');
			$data['mother_birthday'] = $this->input->post('mother_birthday');
			
            $data['guardian_name'] = $this->input->post('guardian_name');
            $data['guardian_profession'] = $this->input->post('guardian_profession');
            $data['guardian_age'] = $this->input->post('guardian_age');
            $data['guardian_income'] = $this->input->post('guardian_income');
            $data['guardian_land'] = $this->input->post('guardian_land');
            $data['guardian_address'] = $this->input->post('guardian_address');
			$data['guardian_nid'] = $this->input->post('guardian_nid');
			$data['guardian_birthday'] = $this->input->post('guardian_birthday');
			$data['gardian_mobile'] = $this->input->post('gardian_mobile');
			$data['gardian_blood_group'] = $this->input->post('gardian_blood_group');
			$data['relation_id']=$this->input->post('relation_id');
			
            $data['prev_institution_name'] = $this->input->post('prev_institution_name');
            $data['prev_class_id'] = $this->input->post('prev_class_id');
            $data['prev_passing_yrs'] = $this->input->post('prev_passing_yrs');
            $data['prev_gpa'] = $this->input->post('prev_gpa');
            $data['prev_institution_address'] = $this->input->post('prev_institution_address');
            $data['tc_institution_name'] = $this->input->post('tc_institution_name');
            $data['tc_form_no'] = $this->input->post('tc_form_no');
            $data['tc_date'] = $this->input->post('tc_date');

            $data['clearance_no'] = $this->input->post('clearance_no');

           
            $mainsubject =$this->input->post('mainsubject');
			if($mainsubject){
			$strsubject="";
            foreach ($mainsubject as $hobys=>$value) {
            $strsubject.=$value."SC";
				}
			}
			if($mainsubject){
			$data['subject_id'] = $strsubject;
			}
			
			
            $forthsubject =$this->input->post('forthsubject');
			if($forthsubject){
            foreach ($forthsubject as $hobys=>$value) {
            $strforthsubject=$value;
				}
			}
			if($forthsubject){
			$data['fourth_id'] = $strforthsubject;
			}
			
			
			
			
			
			
            $data['class_id'] = $this->input->post('class_id');

            $data['roll'] = $this->input->post('roll');
            $data['section'] = $this->input->post('section');
            $data['group'] = $this->input->post('group');
			$data['academic_year']=$this->input->post('academic_year');
            $data['passing_year'] = $this->input->post('passing_year');
            $data['other_student_name'] = $this->input->post('other_student_name');
            $data['others_class_id'] = $this->input->post('others_class_id');
            $data['group_others'] = $this->input->post('group_others');
            $data['others_section'] = $this->input->post('others_section');
            $data['others_roll'] = $this->input->post('others_roll');

            $this->db->insert('student', $data);
            $student_id = mysql_insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            redirect(site_url('admin/student_add'), 'refresh');
        }

        $page_data['page_name'] = 'student_add';
        $page_data['page_title'] = translate('student_admission');
        $this->load->view('index', $page_data);
    }
	function student_control($param1 = '', $param2 = '', $param3 = '') 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
		$class_id=$this->input->post('class_id');
		if($class_id)
		{
			$this->gc->where(array('student.class_id'=>$class_id));
			$page_data['class_id'] = $class_id;
		}
		if(is_numeric($param1))
		{
			$this->gc->where('status',$param1);
			if($param1==0)
			{
				$this->gc->unset_edit();
			}
		}
		$output=$this->gc
		->set_table('student')
		->columns('name','sex','class_id','roll','section','group','passing_year','status')
		->edit_fields('name','status')
		->callback_column('sex',function($value,$row)
		{
			return ucfirst($value);
		})
		->set_relation('class_id','class','name')
		->set_relation('group','group','group_name')
		->field_type('name', 'readonly')
		->callback_edit_field('status',function($value, $primary_key)
		{
			if(!$value)
			return translate('inactive');
			else
			{
				return "<input type='radio' name='status' value='0' class='radio form-control'>".translate('inactive')."<input type='radio' name='status' value='1'  class='radio form-control'>".translate('active');
			}
		})
		//->field_type('status', 'readonly')
		->unset_add()
		->unset_read()
		->render();
		$page_data['students']=$output;
		$page_data['module']='common';
        $page_data['page_name'] = 'student_control';
        $page_data['page_title'] = translate('student_list');
        $this->load->view('index', $page_data);
    }
    /*     * **MANAGE PARENTS CLASSWISE**** */

    function parent($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['student_id'] = $param2;
            $data['relation_with_student'] = $this->input->post('relation_with_student');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['profession'] = $this->input->post('profession');
            $this->db->insert('parent', $data);
            $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL

            $class_id = $this->db->get_where('student', array('student_id' => $data['student_id']))->row()->class_id;
            redirect(base_url() . 'index.php?admin/parent/' . $class_id, 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['relation_with_student'] = $this->input->post('relation_with_student');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['profession'] = $this->input->post('profession');

            $this->db->where('parent_id', $param2);
            $this->db->update('parent', $data);

            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('parent', array(
                        'parent_id' => $param3
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id', $param2);
            $this->db->delete('parent');
            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');
        }
        $page_data['class_id'] = $param1;
        $page_data['students'] = $this->db->get_where('student', array(
                    'class_id' => $param1
                ))->result_array();
        $page_data['page_name'] = 'parent';
        $page_data['page_title'] = translate('manage_parent');
        $this->load->view('index', $page_data);
    }

	
    /*     * **MANAGE TEACHERS**** */

    function teacher($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
			if(is_numeric($param1))
			{
				$this->gc->where('status',$param1);
			}
			$output=$this->gc->set_table('teacher')
			->set_theme('school')
			->order_by('order','asc')
		   	->columns('photo','name','designation','qualification','address','phone')
			->set_subject(translate('teacher'))
			->set_field_upload('photo','uploads/teacher_image')
			->set_field_upload('document','uploads/teacher_document')
			->set_relation('religion','religion','religion_name')
			->set_relation('designation','designation','name')
			->set_relation('shift_id','shift','shift_name')
			->display_as('designation',translate('designation'))
			->set_relation('blood_group','blood_group','group')
			->display_as('address',translate('present_address'))
			->display_as('shift_id',translate('shift'))
			->display_as('per_address',translate('permanent_address'))
			->display_as('employeeID',translate('employee_ID'))
			->unset_add_fields('salary_setup')
			->unset_edit_fields('salary_setup')
			->unset_read_fields('salary_setup')
			->callback_column('photo',function($value)
			{
				if(!$value)
				return '<img src="'.base_url().'template/images/icons_big/teacher.png"/>';
				return "<img src=".base_url('uploads/teacher_image/'.$value)." height='60px' width='60px'>";
			})
			->add_action('View Profile', '', '','new_window',function($pk)
			{
				//return "<a href='".site_url('modal/popup/teacher_profile/'.$row->teacher_id)."' window='new' win_height='800px' win_width='1200px' class='btn btn-gray'>View</a>";
				return site_url('modal/popup/teacher_profile/'.$pk);
			})
			->render();
        $page_data['teachers'] = $this->db->order_by('order')->get('teacher')->result_array();
		$page_data['output'] = $output;
        $page_data['page_name'] = 'teacher';
        $page_data['page_title'] = translate('teacher')." & ".translate('staff');
        $this->load->view('index', $page_data);
    }
	function employee_attendance_report($param1='')
	{
		if($param1=='search')
		{
			$page_data['month']= $this->input->post('month');
			$page_data['year'] = $this->input->post('year');
			$page_data['teacher_id'] = $this->input->post('teacher_id');
		}
		$page_data['page_name'] = 'employee_attendance_report';
        $page_data['page_title'] = translate('employee_attendance_report');
        $this->load->view('index', $page_data);
	}
	function leave_type()
	{
		if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
			$output=$this->gc->set_table('leave_type')
			->set_subject(translate('leave_type'))
			->render();
		$page_data['crud'] = $output;
        $page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('leave_type_setup');
        $this->load->view('index', $page_data);
	}
    /*     * **MANAGE SUBJECTS**** */

    function subject($param1 = '', $param2 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
		    $forthchk = $this->input->post('fourthsub');
            $data['name'] = $this->input->post('name');
            $data['class_id'] = $this->input->post('class_id');
            $data['group_id'] = $this->input->post('group_id');
			if($forthchk)
			$data['status'] =  $forthchk;
			
			$data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('subject', $data);
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
        if ($param1 == 'do_update') {
		    $forthchk = $this->input->post('fourthsub');
            $data['name'] = $this->input->post('name');
            $data['class_id'] = $this->input->post('class_id');
			$data['group_id'] = $this->input->post('group_id');
			if($forthchk)
			$data['status'] =  $forthchk;
			
            $data['teacher_id'] = $this->input->post('teacher_id');

            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                        'subject_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
        $page_data['subjects'] = $this->db->get('subject')->result_array();
		$page_data['Csubjects'] = $this->db->get('collegesubject')->result_array();
        $page_data['page_name'] = 'subject';
        $page_data['page_title'] = translate('manage_subject');
        $this->load->view('index', $page_data);
    }
	
	function subject_setup() 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
		$this->gc
		->set_table('subject')
		->set_theme('school')
		->set_subject(translate('subject'))
		->set_relation('class_id','class','name')
		->set_relation('group_id','group','group_name')
		->set_relation('teacher_id','teacher','name')
		->required_fields('name','short_name','class_id')
		->display_as('name',translate('subject_name'))
		->display_as('short_name',translate('short_name'))
		->display_as('class_id',translate('class'))
		->display_as('group_id',translate('group'))
		->display_as('teacher_id',translate('teacher'))
		->change_field_type('status', 'true_false', array('1' => 'Yes', '0' => 'No'))
		->display_as('status',translate('Fourth&nbsp;Subject?'));
		$output=$this->gc->render();
        $page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('manage_subject');
		$page_data['crud']=$output;
        $this->load->view('index', $page_data);
    }
	function exam_setup() 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
		$output=$this->gc
		->set_table('exam')
		->set_theme('school')
		->set_subject(translate('Exam'))
		->set_relation('parent_id','exam','name')
		->required_fields('name','short_name','date','publishing_date')
		->display_as('name',translate('exam_name'))
		->display_as('short_name',translate('short_name'))
		->display_as('class_id',translate('class'))
		->display_as('parent_id',translate('parent_exam'))
		->display_as('date',translate('start_date'))
		->display_as('publishing_date',translate('publish_date'))
		->display_as('comment',translate('remark'))
		//->unset_delete()
		->render();
        $page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('manage_exam');
		$page_data['crud']=$output;
        $this->load->view('index', $page_data);
    }
	function class_setup() 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
		$result=$this->db->select('teacher_id,name')->from('teacher')->get()->result();
		$teachers=array();
		foreach($result as $row)
		{
			$teachers[$row->teacher_id]=$row->name;
		}
		$output=$this->gc
		->set_table('class')
		->set_theme('school')
		->set_subject(translate('class'))
		//->set_relation('teacher_id','teacher','name')
		->display_as('name',translate('class_name'))
		->display_as('teacher_id',translate('assigned_teacher'))
		->display_as('name_word',translate('name_word'))
		->display_as('name_numeric',translate('numeric_name'))
		->display_as('date',translate('start_date'))
		->display_as('publishing_date',translate('publish_date'))
		->display_as('comment',translate('remark'))
		->field_type('teacher_id', 'multiselect',$teachers)
		->unset_read()
		->render();
        $page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('manage_class');
		$page_data['crud']=$output;
        $this->load->view('index', $page_data);
    }
	function grade_setup() 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
		$output=$this->gc
		->set_table('grade')
		->set_theme('school')
		->set_subject(translate('grade'))
		->order_by('grade_id')
		->columns('mark_upto','mark_from','grade_point','name')
		->display_as('mark_upto',translate('mark_upto'))
		->display_as('mark_from',translate('mark_from'))
		->display_as('name_word',translate('name_word'))
		->display_as('name',translate('letter_grade'))
		->unset_read()
		->render();
        $page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('manage_grade');
		$page_data['crud']=$output;
        $this->load->view('index', $page_data);
    }
	/*     * **MANAGE College SUBJECTS**** */

    function college($param1 = '', $param2 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['group_id'] = $this->input->post('group_id');
            $data['catagory_id'] = $this->input->post('category_id');
			$data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('collegesubject', $data);
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['group_id'] = $this->input->post('group_id');
            $data['catagory_id'] = $this->input->post('category_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->where('subject_id', $param2);
            $this->db->update('collegesubject', $data);
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('collegesubject', array(
                        'subject_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('collegesubject');
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
        $page_data['subjects'] = $this->db->get('subject')->result_array();
		$page_data['Csubjects'] = $this->db->get('collegesubject')->result_array();
        $page_data['page_name'] = 'subject';
        $page_data['page_title'] = translate('manage_subject');
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE CLASSES**** */

    function classes($param1 = '', $param2 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('class', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id'] = $this->input->post('teacher_id');

            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                        'class_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        $page_data['classes'] = $this->db->get('class')->result_array();
        $page_data['page_name'] = 'class';
        $page_data['page_title'] = translate('manage_class');
        $this->load->view('index', $page_data);
    }

     /*     * **MANAGE EXAMS**** */

    function exam($param1 = '', $param2 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['parent_id'] = $this->input->post('parent_id');
            $data['date'] = $this->input->post('date');
			$data['publishing_date'] = $this->input->post('publishing_date');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('exam', $data);
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['date'] = $this->input->post('date');
			$data['publishing_date'] = $this->input->post('publishing_date');
            $data['comment'] = $this->input->post('comment');

            $this->db->where('exam_id', $param2);
            $this->db->update('exam', $data);
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                        'exam_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
			$parent=get_single_value('parent_id','exam',array('exam_id'=>$param2));
			if($parent)
			{
				$condition=array('sub_exam_id'=>$param2);
			}
			else
			{
				$condition=array('exam_id'=>$param2);
			}
			$this->db->delete('mark',$condition);
			$this->db->delete('marksheet',$condition);
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $page_data['exams'] = $this->db->where('parent_id',0)->get('exam')->result_array();
        $page_data['page_name'] = 'exam';
        $page_data['page_title'] = translate('manage_exam');
        $this->load->view('index', $page_data);
    }

     /*     * **MANAGE EXAM MARKS**** */

    function marks($exam_id = '', $class_id = '', $subject_id = '' , $sub_exam_id = '', $group_name = '') {
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['group_name'] = $this->input->post('group_name');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            $page_data['sub_exam_id'] = $this->input->post('exam_sub_id');
			if($page_data['sub_exam_id'])
		$page_data['sub_exam_id'] = $this->input->post('exam_sub_id');
			else
		$page_data['sub_exam_id']=99999;
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0 ) {
                redirect(base_url() . 'index.php?admin/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'] . '/' . $page_data['sub_exam_id'].'/' . $page_data['group_name'], 'refresh');
            }else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            
            
            $updateMarks = $this->input->post('marks');
            if(!empty($updateMarks)){
                foreach ($updateMarks as $item){
                    
                    $id = $item['mark_id'];
                    unset($item['mark_id']);
                    $total= $item['formation'] + $item['objective'] + $item['practical'] + $item['sba'];
                    $this->db->set('sub_total', $total);
                    $this->db->where('mark_id', $id);
                    $this->db->update('mark', $item);
                  
                    $verify_data = array(	
                        'exam_id' => $item['exam_id'] ,
                        'class_id' => $item['class_id'] ,
                        'sub_exam_id' => $item['sub_exam_id'] , 
                        'student_id' => $item['student_id'],
						'subject_id' => $item['subject_id']
                            );
                    
                    $query = $this->db->get_where('mark' , $verify_data);
                    $make_num = $query->num_rows() ;
                    $marksheet = $query->result();
                    $total_marks=$item['total_marks'];
                    $marksheet_total = array(
                        'total' => 0,
						'overall_total' => 0,
                        'exam_id' => $item['exam_id'] ,
                        'class_id' => $item['class_id'] ,
                        'sub_exam_id' => $item['sub_exam_id'] , 
                        'student_id' => $item['student_id']
                        );
                    foreach ($marksheet as $mark_item){
						//$total=$mark_item->total_marks;
                        $marksheet_total['total'] +=  $mark_item->sub_total;  
						$marksheet_total['overall_total'] +=  $mark_item->total_marks; 
                    }
                    $marksheet_total['subject_id']=$item['subject_id'];
					
                    $make_gpa = ($marksheet_total['total'] / $total_marks)*100;
			        $overall_gpa = ($marksheet_total['total'] / $marksheet_total['overall_total'] )*100;
                    $marksheet_total['gpa'] = $this->get_grade_from_gpa($make_gpa);
					$marksheet_total['overall_gpa'] =$marksheet_total['total']."===".$marksheet_total['overall_total'];
					
					$this->get_grade_from_gpa($make_gpa); 
                    
                      
                    
                    $query = $this->db->get_where('marksheet' , $verify_data);
                    if($query->num_rows() == 0){
                        $this->db->insert('marksheet' , $marksheet_total);
                    }else{
                        $update =$query->row();
                        $this->db->where('id', $update->id);
                        $this->db->update('marksheet', $marksheet_total);
                    }
					
				/*	$verify_data2 = array(	
                        'exam_id' => $item['exam_id'] ,
                        'class_id' => $item['class_id'] ,
                        'sub_exam_id' => $item['sub_exam_id'] , 
                        'student_id' => $item['student_id']
                            );
					$query1 = $this->db->get_where('mark' , $verify_data);
                    $marksheet1 = $query->result();
					
					$marksheet_overall = array(
                        'total' => 0,
						'overall_total' => 0,
                        'exam_id' => $item['exam_id'] ,
                        'class_id' => $item['class_id'] ,
                        'sub_exam_id' => $item['sub_exam_id'] , 
                        'student_id' => $item['student_id']
                        );
                    foreach ($marksheet1 as $mark_item){
                        $marksheet_overall['total'] +=  $mark_item->sub_total;  
						$marksheet_overall['overall_total'] +=  $mark_item->total_marks; 
                    }
					
					 $query = $this->db->get_where('overallmarksheet' , $verify_data);
                    if($query->num_rows() == 0){
                        $this->db->insert('overallmarksheet' , $marksheet_overall);
                    }else{
                        $update =$query->row();
                        $this->db->where('id', $update->id);
                        $this->db->update('overallmarksheet', $marksheet_overall);
                    }
					*/
					
                } 
            }
            redirect(base_url() . 'index.php?admin/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id') . '/'.  $this->input->post('exam_sub_id').'/' . $this->input->post('group_name')  , 'refresh');
        }
        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['subject_id'] = $subject_id;
        $page_data['group_name'] = $group_name;
		$page_data['sub_exam_id'] = $sub_exam_id;
        $page_data['page_info'] = 'Exam marks';
        $page_data['page_name'] = 'marks';
        $page_data['page_title'] = translate('manage_exam_marks');
        $this->load->view('admin/marks', $page_data);
    }
	function marks_input_sheet($exam_id = '', $class_id = '', $subject_id = '' , $sub_exam_id = '', $group_name = '') {
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') 
		{
			$page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['group_name'] = $this->input->post('group_name');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            $page_data['sub_exam_id'] = $this->input->post('exam_sub_id');
        }
        $page_data['page_info'] = 'Exam marks';
        $page_data['page_name'] = 'marks_input_sheet';
        $page_data['page_title'] = translate('manage_exam_marks');
		$page_data['system_title'] = "Powered By Wemax Software Ltd.";
        $this->load->view('admin/marks_input_sheet', $page_data);
    }
    function manage_attendance($class_id,$exam_id,$sub_exam_id='',$group_id='')
	{
		$page_data['class_id'] = $class_id;
        $page_data['group_id'] = $group_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sub_exam_id'] = $sub_exam_id;
        $page_data['page_info'] = translate('manage_attendance');
        $page_data['page_title'] = translate('manage_attendance');
		if($this->input->post('action')=='save')
		{
			$total_row=$this->input->post('total');
			for($loop=0;$loop<$total_row;$loop++)
			{
				$check=array(
				'student_id' =>$this->input->post('student_id')[$loop],
				'class_id' =>$class_id,
				'exam_id' =>$exam_id,
				'sub_exam_id' =>$sub_exam_id
				);
				$data=array(
				'student_id' =>$this->input->post('student_id')[$loop],
				'class_id' =>$class_id,
				'exam_id' =>$exam_id,
				'sub_exam_id' =>$sub_exam_id,
				'attend'=>$this->input->post('attend')[$loop],
				'classday'=>$this->input->post('classday')[$loop],
				'homework'=>$this->input->post('homework')[$loop],
				'gardian_care'=>$this->input->post('gardian_care')[$loop],
				'attention'=>$this->input->post('attention')[$loop],
				'behave'=>$this->input->post('behave')[$loop],
				);
				$this->db->where($check);
				$this->db->delete('attendance_mark');
				$this->db->insert('attendance_mark',$data);
			}
		}
        $this->load->view('admin/manage_attendance', $page_data);
	}
    function full_mark()
	{
		$condition=array(
		'class_id'=>$_POST['class_id'],
		'exam_id'=>$_POST['exam_id'],
		'sub_exam_id'=>$_POST['sub_exam_id'],
		'subject_id'=>$_POST['subject_id']
		);
		$this->db->where($condition);
		$this->db->update('full_mark',$_POST);
		if(!$this->db->affected_rows())
		$this->db->insert('full_mark',$_POST);
		redirect(base_url() . 'index.php?admin/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id') . '/'.  $this->input->post('sub_exam_id').'/' . $this->input->post('group_id')  , 'refresh');
	}
    
        function get_grade_from_gpa($gpa) {
            if ($gpa >= 80) {
                return 'A+';
            } elseif ($gpa >= 70) {
                return 'A';
            } elseif ($gpa >= 60) {
                return 'A-';
            } elseif ($gpa >= 50) {
                return 'B';
            } elseif ($gpa >= 40) {
                return 'D';
            } else {
                return 'F';
            }
        // return $gradeinfo;
    }
    /*     * **MANAGE EXAM MARKS**** */

    function marksheet() {
       
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            $page_data['grad'] = $this->input->post('grad');
			$details=array(
			'class_id'=>$page_data['class_id'],
			'exam_id'=>$page_data['exam_id']
			);
			$this->load->library('progress_card_lib',$details,'prog_card');
        }
		
        $page_data['page_info'] = 'Progress Card.';
        $page_data['page_name'] = 'marksheet';
        $page_data['page_title'] = 'Progress Card';
        $this->load->view('index', $page_data);   
        
        
        
    }

    /*     * **MANAGE GRADES**** */
	function tabulation_sheet($param1='') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
		$page_data['page_info'] = translate('tabulation_sheet');
		$page_data['page_title'] = translate('tabulation_sheet');
		$page_data['page_name'] = 'tabulation_sheet';
		if($param1=='sba')
		{
			$page_data['page_info'] = translate('tabulation_sheet_sba');
        	$page_data['page_title'] = translate('tabulation_sheet_SBA');
			$page_data['page_name'] = 'tabulation_sheet_sba';
		}
        $this->load->view('index', $page_data);
    }
    function grade($param1 = '', $param2 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from'] = $this->input->post('mark_from');
            $data['mark_upto'] = $this->input->post('mark_upto');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('grade', $data);
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from'] = $this->input->post('mark_from');
            $data['mark_upto'] = $this->input->post('mark_upto');
            $data['comment'] = $this->input->post('comment');

            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('grade', array(
                        'grade_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        $page_data['grades'] = $this->db->get('grade')->result_array();
        $page_data['page_name'] = 'grade';
        $page_data['page_title'] = translate('manage_grade');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGING CLASS ROUTINE***************** */

    function class_routine($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id'] = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('starting_time');
            $data['time_end'] = $this->input->post('ending_time');
            $data['day'] = $this->input->post('day');
            $this->db->insert('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id'] = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('starting_time');
            $data['time_end'] = $this->input->post('ending_time');
            $data['day'] = $this->input->post('day');

            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                        'class_routine_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        }
        $page_data['page_name'] = 'class_routine';
        $page_data['page_title'] = translate('manage_class_routine');
        $this->load->view('index', $page_data);
    }
	
			function routineprint($param1 = ''){
	 
	 	$page_data['page_name'] = 'print_class_routine';
        $page_data['page_title'] = translate('print_class_routine');
		$page_data['class_id'] = $param1;
	    $this->load->view('index', $page_data);
	               
	}

    /*     * ****MANAGE BILLING / INVOICES WITH STATUS**** */

    function invoice($param1 = '', $param2 = '', $param3 = '', $param4 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            
            $class_id = $this->input->post('class_id');
            $student_id = $this->input->post('student_id');
            
            $this->db->select('*')->from('invoice')->where('class_id', $class_id);
            $this->db->where('student_id', $student_id);
            $invoice_data = $this->db->get()->result_array();
            
            $num_rows = count($invoice_data);
            
            if($num_rows > 0){
                $next_payment_data = array();
                foreach ( $_POST as $key => $value )
                {
                    $next_payment_data[$key] = $this->input->post($key);
                }
                $next_payment_data['creation_date'] = date('Y-m-d', strtotime($this->input->post('creation_date')));
                $next_payment_data['creation_timestamp'] = strtotime($this->input->post('creation_date'));

                unset($next_payment_data['class_id_select']);
                
                $this->db->insert('invoice', $next_payment_data);
                redirect(base_url() . 'index.php?admin/invoice', 'refresh');
                
            }else {
                $data = array();
                foreach ( $_POST as $key => $value )
                {
                    $data[$key] = $this->input->post($key);
                }
                $data['creation_date'] = date('Y-m-d', strtotime($this->input->post('creation_date')));
                $data['creation_timestamp'] = strtotime($this->input->post('creation_date'));

                unset($data['class_id_select']);
            
                $this->db->insert('invoice', $data);
                redirect(base_url() . 'index.php?admin/invoice', 'refresh');
            }            
        }
        if ($param1 == 'do_update') {
            $data['student_id'] = $this->input->post('student_id');
            $data['class_id'] = $this->input->post('class_id');
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['monthly_fees'] = $this->input->post('monthly_fees');
            $data['admission_fees'] = $this->input->post('admission_fees');
            $data['dev_fees'] = $this->input->post('dev_fees');
            $data['session_fee_1st_installment'] = $this->input->post('session_fee_1st_installment');
            $data['session_fee_2nd_installment'] = $this->input->post('session_fee_2nd_installment');
            $data['sports_fees'] = $this->input->post('sports_fees');
            $data['lib_fees'] = $this->input->post('lib_fees');
            $data['cultural_program'] = $this->input->post('cultural_program');
            $data['invoice_book'] = $this->input->post('invoice_book');
            $data['receipt_books'] = $this->input->post('receipt_books');
            $data['exam_fee'] = $this->input->post('exam_fee');
            $data['registration_fee'] = $this->input->post('registration_fee');
            $data['poor_fund'] = $this->input->post('poor_fund');
            $data['lab_charge'] = $this->input->post('lab_charge');
            $data['electricity_charge'] = $this->input->post('electricity_charge');
            $data['total_bill'] = $this->input->post('total_bill');
            $data['deposit'] = $this->input->post('deposit');
            $data['due'] = $this->input->post('due');
            $data['overdue'] = $this->input->post('overdue');
            $data['Fine'] = $this->input->post('Fine');
            $data['absence_fine'] = $this->input->post('absence_fine');
            $data['late_fine'] = $this->input->post('late_fine');
            $data['bad_behavior'] = $this->input->post('bad_behavior');
            $data['status'] = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                        'invoice_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') 
		{
			
			$this->db->delete('invoice',array('invoice_id'=>$param2));
			$this->db->delete('invoice_details',array('invoice_id'=>$param2));
           redirect(base_url() . 'index.php?admin/invoice', 'refresh');
		   return;
        }
        
        if($this->uri->segment(3) == "loadfee_by_class") 
		{
            $class_id = $this->uri->segment(4);
            $student_id = $this->uri->segment(5);
            
            $invoice_data = $this->db->select('*')->from('invoice')->where('class_id', $class_id)->where('student_id', $student_id)->get()->result_array();
            $num_rows = count($invoice_data);
            
            if($num_rows > 0){                
                foreach($invoice_data as $prev_invoice_info){ }
                
                $next_payment_data['total_bill_next'] = $prev_invoice_info['due'];                
                echo json_encode ($next_payment_data);
                die;
                
            }else {            
                $this->db->select('*')->from('fees_name')->join('fees_setup', 'fees_setup.fees_name_id = fees_name.fees_name_id');
                $fee_data = $this->db->where('fees_setup.class_id', $this->uri->segment(4))->get()->result_array();

                echo json_encode ($fee_data);
                die;
            }
        }
        
        $page_data['page_name'] = 'invoice';
        $page_data['page_title'] = translate('Fees Payment');
        $this->db->order_by('invoice_id', 'asc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        //$page_data['invoices'] = $this->crud_model->get_all_invoice();
        $this->load->view('index', $page_data);
    }
	function bill_collection($param1='',$param2='')
	{
		if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') 
		{
           $page_data['student_id'] = $this->input->post('student_id');
		   $page_data['class_id']=$this->input->post('class_id');
		}
		if($param1=='collect')
		{
			$payment_month=implode($this->input->post('payment_month'),',');
			$invoice_data=array(
			'student_id'=>$this->input->post('student_id'),
			'payment_month'=>$payment_month,
			'payment_year'=>$this->input->post('payment_year'),
			'payment_date'=>$this->input->post('payment_date'),
			'description'=>$this->input->post('description'),
			'invoice_number'=>$this->input->post('invoice_number'),
			'invoice_name'=>$this->input->post('invoice_name'),
			'total_collection'=>$this->input->post('total_collection'),
			'total_weaver'=>$this->input->post('total_weaver'),
			'total_fine'=>$this->input->post('total_fine'),
			'payment_status'=>$this->input->post('payment_status'),
			'payment_type'=>$this->input->post('payment_type'),
			);
            $invoice_data['payment_date']=date("Y-m-d",strtotime(str_replace("/","-",$invoice_data['payment_date'])));
			$this->db->insert('invoice',$invoice_data);
			$invoice_id=$this->db->insert_id();
			$this->db->where('student_id',$this->input->post('student_id'));
			$query_result = $this->db->from('fees')->get();
			foreach ($query_result->result() as $item )
			{
				$fees_id=$item->fees_id;
				$collection_amount=0;
				if($this->input->post('collection_amount_'.$fees_id))
				{
					$collection_amount=$this->input->post('collection_amount_'.$fees_id);
				}
				$invoice_details_data=array(
				"invoice_id"		=>$invoice_id,
				"fees_id"			=>$fees_id,
				"collection_amount"	=>$collection_amount,
				"weaver"			=>$this->input->post('weaver_'.$fees_id),
				"fine"				=>$this->input->post('fine_'.$fees_id),
				"student_id"		=>$this->input->post('student_id')
				);
				$this->db->insert('invoice_details',$invoice_details_data);
			}
			$page_data['type']='print';
			$page_data['invoice_id']=$invoice_id;
		}
		$page_data['page_name'] = 'bill_collection';
        $page_data['page_title'] =translate('fess_payment');
        $this->load->view('index', $page_data);
	}

    /*     * ****MANAGE BILLING / INVOICES WITH STATUS**** */

    /*     * ****MANAGE BILLING / EXPENSE WITH STATUS**** */

    function expense($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'create') {
            $data['expense_by'] = $this->input->post('expense_by');
            $data['expense_id'] = $this->input->post('expense_id');
            $data['invoice_id'] = $this->input->post('invoice_id');
            $data['expense_name'] = $this->input->post('expense_name');
            $data['description'] = $this->input->post('description');
            $data['category'] = $this->input->post('category');
            $data['material_name'] = $this->input->post('material_name');
            $data['document_name'] = $this->input->post('document_name');
            $data['payment_to'] = $this->input->post('payment_to');
            $data['payment_method'] = $this->input->post('payment_method');
            $data['amount'] = $this->input->post('amount');
            $data['expense_date'] = date('Y-m-d', strtotime($this->input->post('expense_date')));
            $data['expense_timestamp'] = strtotime($this->input->post('expense_date'));

//            echo "##############";
//            echo '<pre>';
//            print_r($data);
//            die;

            $this->db->insert('expense', $data);
            $exp_id = mysql_insert_id();
            move_uploaded_file($_FILES['document_name']['tmp_name'], 'uploads/expense_image/' . $exp_id . '.jpg');

            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['expense_by'] = $this->input->post('expense_by');
            $data['expense_id'] = $this->input->post('expense_id');
            $data['invoice_id'] = $this->input->post('invoice_id');
            $data['expense_name'] = $this->input->post('expense_name');
            $data['description'] = $this->input->post('description');
            $data['category'] = $this->input->post('category');
            $data['material_name'] = $this->input->post('material_name');
            $data['document_name'] = $this->input->post('document_name');
            $data['payment_to'] = $this->input->post('payment_to');
            $data['payment_method'] = $this->input->post('payment_method');
            $data['amount'] = $this->input->post('amount');
            $data['expense_date'] = date('Y-m-d', strtotime($this->input->post('expense_date')));
            $data['expense_timestamp'] = strtotime($this->input->post('expense_date'));

            $this->db->where('exp_id', $param2);
            $this->db->update('expense', $data);
            move_uploaded_file($_FILES['document_name']['tmp_name'], 'uploads/expense_image/' . $param2 . '.jpg');
            $this->crud_model->clear_cache();

            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('expense', array('exp_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exp_id', $param2);
            $this->db->delete('expense');
            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }
        $page_data['page_name'] = 'expense';
        $page_data['page_title'] = translate('manage_expense');
        $this->db->order_by('expense_date', 'desc');
        $page_data['expenses'] = $this->db->get('expense')->result_array();
        //$page_data['expenses'] = $this->crud_model->get_all_expense();
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE BILLING / EXPENSE WITH STATUS**** */

    /*     * ****MANAGE BILLING / INCOME WITH STATUS**** */

    function income($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'create') {
            $data['income_by'] = $this->input->post('income_by');
            $data['income_id'] = $this->input->post('income_id');
            $data['invoice_id'] = $this->input->post('invoice_id');
            $data['income_name'] = $this->input->post('income_name');
            $data['description'] = $this->input->post('description');
            $data['category'] = $this->input->post('category');
            $data['material_name'] = $this->input->post('material_name');
            $data['document_name'] = $this->input->post('document_name');
            $data['payment_to'] = $this->input->post('payment_to');
            $data['payment_method'] = $this->input->post('payment_method');
            $data['amount'] = $this->input->post('amount');
            $data['income_date'] = date('Y-m-d', strtotime($this->input->post('income_date')));
            $data['income_timestamp'] = strtotime($this->input->post('income_date'));

//            echo '<pre>';
//            print_r($data);
//            die;

            $this->db->insert('income', $data);
            $inc_id = mysql_insert_id();
            move_uploaded_file($_FILES['document_name']['tmp_name'], 'uploads/income_image/' . $inc_id . '.jpg');

            redirect(base_url() . 'index.php?admin/income', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['income_by'] = $this->input->post('income_by');
            $data['income_id'] = $this->input->post('income_id');
            $data['invoice_id'] = $this->input->post('invoice_id');
            $data['income_name'] = $this->input->post('income_name');
            $data['description'] = $this->input->post('description');
            $data['category'] = $this->input->post('category');
            $data['material_name'] = $this->input->post('material_name');
            $data['document_name'] = $this->input->post('document_name');
            $data['payment_to'] = $this->input->post('payment_to');
            $data['payment_method'] = $this->input->post('payment_method');
            $data['amount'] = $this->input->post('amount');
            $data['income_date'] = date('Y-m-d', strtotime($this->input->post('income_date')));
            $data['income_timestamp'] = strtotime($this->input->post('income_date'));

            $this->db->where('inc_id', $param2);
            $this->db->update('income', $data);
            move_uploaded_file($_FILES['document_name']['tmp_name'], 'uploads/income_image/' . $param2 . '.jpg');
            $this->crud_model->clear_cache();

            redirect(base_url() . 'index.php?admin/income', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('income', array('inc_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('inc_id', $param2);
            $this->db->delete('income');
            redirect(base_url() . 'index.php?admin/income', 'refresh');
        }
        $page_data['page_name'] = 'income';
        $page_data['page_title'] = translate('manage_income');
        $this->db->order_by('income_id', 'asc');
        $page_data['incomes'] = $this->db->get('income')->result_array();
        //$page_data['incomes'] = $this->crud_model->get_all_income();
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE BILLING / INCOME WITH STATUS**** */

    function monthlyReport($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {


            $this->db->insert('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        if ($param1 == 'do_update') {


            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                        'invoice_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            redirect(base_url() . 'index.php?admin/monthlyReport', 'refresh');
        }
        $page_data['page_name'] = 'monthlyReport';
        $page_data['page_title'] = translate('MonthlyReport');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE BILLING / INVOICES WITH STATUS**** */

    public function fees_report($param1='')
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
	        if ($param1=='show_report')
			{
				$posted=$this->input->post("posted");
				$class_id=$this->input->post("class_id");
				$group=$this->input->post("group");
				$section=$this->input->post("section");
				$student_id=$this->input->post("student_id");
				$payment_status=$this->input->post("payment_status");
				$fees_id=$this->input->post("fees_id");
				$weaver_con=$this->input->post("weaver_con");
				$weaver=$this->input->post("weaver");
				$fine_con=$this->input->post("fine_con");
				$fine=$this->input->post("fine");
				$due_con=$this->input->post("due_con");
				$due=$this->input->post("due");
				$payment_type=$this->input->post("payment_type");
				$date_from=$this->input->post("date_from");
				$date_to=$this->input->post("date_to");
				$invoice_id=$this->input->post("invoice_id");
				$page_data["posted"]=$this->input->post("posted");
				$page_data["class_id"]=$this->input->post("class_id");
				$page_data["group"]=$this->input->post("group");
				$page_data["section"]=$this->input->post("section");
				$page_data["student_id"]=$this->input->post("student_id");
				$page_data["payment_status"]=$this->input->post("payment_status");
				$page_data["fees_id"]=$this->input->post("fees_id");
				$page_data["weaver_con"]=$this->input->post("weaver_con");
				$page_data["weaver"]=$this->input->post("weaver");
				$page_data["fine_con"]=$this->input->post("fine_con");
				$page_data["fine"]=$this->input->post("fine");
				$page_data["due_con"]=$this->input->post("due_con");
				$page_data["due"]=$this->input->post("due");
				$page_data["payment_type"]=$this->input->post("payment_type");
				$page_data["invoice_id"]=$this->input->post("invoice_id");
				$page_data["date_from"]=$this->input->post("date_from");
				$page_data["date_to"]=$this->input->post("date_to");
				if($date_from)
				{
					$date_from=date("Y-m-d",strtotime(str_replace("/","-",$date_from)));
					$page_data['date_from']=$date_from;
				}
				if($date_to)
				{
					$date_to=date("Y-m-d",strtotime(str_replace("/","-",$date_to)));
					$page_data['date_to']=$date_to;	
				}
	        }
		$page_data['page_name'] = 'fees_report';
        $page_data['page_title'] = translate('fees_report');
        $this->load->view('index', $page_data);
    }
    function due_report() {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'due_report';
        $page_data['page_title'] = translate('Due Report');
        $this->load->view('index', $page_data);
    }
    
    function expense_report($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['expense_by'] = $this->input->post('expense_by');
            $page_data['expense_id'] = $this->input->post('expense_id');
            $page_data['invoice_id'] = $this->input->post('invoice_id');
            $page_data['expense_name'] = $this->input->post('expense_name');
            $page_data['category'] = $this->input->post('category');
            $page_data['material_name'] = $this->input->post('material_name');
            $page_data['payment_to'] = $this->input->post('payment_to');
            $page_data['payment_method'] = $this->input->post('payment_method');
            if($this->input->post('expense_date_from'))
			{
				$date_from_string = strtotime(str_replace('/','-',$this->input->post('expense_date_from')));
				$expense_date_from=date("Y-m-d",$date_from_string);
	            $page_data['expense_date_from'] = date("d/m/Y", $date_from_string);	
			}
			if($this->input->post('expense_date_to'))
			{
				$date_to_string = strtotime(str_replace('/','-',$this->input->post('expense_date_to')));
				$expense_date_to=date("Y-m-d",$date_to_string);
	            $page_data['expense_date_to'] = date("d/m/Y", $date_to_string);			
			}

            
           // $this->session->set_userdata($page_data);
            
            $page_data['expense_report_data'] = $this->crud_model->get_expense_report(
                                    $page_data['expense_by'], 
                                    $page_data['expense_id'], 
                                    $page_data['invoice_id'], 
                                    $page_data['expense_name'], 
                                    $page_data['category'], 
                                    $page_data['payment_to'], 
                                    $page_data['payment_method'], 
                                    $expense_date_from,
                                    $expense_date_to
                                );             
          //  $this->load->view('index', $page_data2);
        }
		$this->db->order_by('expense_id', 'asc');
    	$page_data['expenses'] = $this->db->get('expense')->result_array();
        $page_data['page_name'] = 'expense_report';
        $page_data['page_title'] = translate('expense_report');
        
        $this->load->view('index', $page_data);
    }
    
    function income_report($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'income_report';
        $page_data['page_title'] = translate('income_report');
        if ($this->input->post('operation') == 'selection') {
            $page_data['income_by'] = $this->input->post('income_by');
            $page_data['income_id'] = $this->input->post('income_id');
            $page_data['invoice_id'] = $this->input->post('invoice_id');
            $page_data['income_name'] = $this->input->post('income_name');
            $page_data['category'] = $this->input->post('category');
            $page_data['material_name'] = $this->input->post('material_name');
            $page_data['payment_from'] = $this->input->post('payment_from');
            $page_data['payment_method'] = $this->input->post('payment_method');
            $date_from_string=$this->input->post('income_date_from');
			if($date_from_string)
			{
				$date_from_string=str_replace('/','-',$date_from_string);
	            $date_from_string = strtotime($date_from_string);
				$date_from_string=date("Y-m-d", $date_from_string);
	            $page_data['income_date_from'] =$date_from_string;	
			}
			$page_data['income_date_from_timestamp'] = $this->input->post('income_date_from');
			$date_to_string=$this->input->post('income_date_to');
			if($date_to_string)
			{
				$date_to_string=str_replace('/','-',$date_to_string);
				$date_to_string = strtotime($date_to_string);
				$date_to_string=date("Y-m-d", $date_to_string);
	            $page_data['income_date_to'] = $date_to_string;
			}
			$page_data['income_date_to_timestamp'] = $this->input->post('income_date_to');	
            $page_data['income_report_data'] = $this->crud_model->get_income_report(
                                    $page_data['income_by'], 
                                    $page_data['income_id'], 
                                    $page_data['invoice_id'], 
                                    $page_data['income_name'], 
                                    $page_data['category'], 
                                    $page_data['payment_from'], 
                                    $page_data['payment_method'], 
                                    $page_data['income_date_from'],
                                    $page_data['income_date_to']
                                ); 
			//echo $this->db->last_query();
//            echo '<pre>';
//            print_r($page_data2); die;
            
          /*  $this->load->view('index', $page_data);
			return;
            */
            //redirect(base_url() . 'index.php?admin/income_report/'.$page_data['income_id'], 'refresh');
        }
	   	$this->db->order_by('income_id', 'asc');
        $page_data['incomes'] = $this->db->get('income')->result_array();
        $this->load->view('index', $page_data);
    }
    
    function incomeReportByDate($start_date = '', $end_date = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('start_date') != '') {	
            $page_data['start_date'] = $this->input->post('start_date');
            $page_data['end_date'] = $this->input->post('end_date');

            if ($page_data['start_date'] != '' && $page_data['end_date'] != '') {
                redirect(base_url() . 'index.php?admin/incomeReportByDate/' . $page_data['start_date'], 'refresh');
            } else {
                $this->session->set_flashdata('class_report', 'Choose date to check date Wise Report');
                redirect(base_url() . 'index.php?admin/incomeReportByDate/', 'refresh');
            }
        }
        
        $page_data['page_info'] = 'Date Wise Report';
        $page_data['start_date'] = $start_date;
        $page_data['end_date'] = $end_date;
        $page_data['page_name'] = 'dateWise';
        //$sql = "select * from income where income_date between ? and ?";
        //$sql = "select * from income";
        //$page_data['incomes'] = $this->db->query($sql, array($page_data['start_date'], $page_data['end_date']))->result_array();
        
//        $page_data['reports_by_date'] = $this->db->get_where('income',array('start_date <='=>$page_data['start_date'],'end_date >='=>$page_data['end_date']))->result_array();
        $page_data['reports_by_date'] = $this->db->get('income')->result_array();
        $page_data['page_title'] = translate('Date Wise Report');
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE BILLING / INVOICES WITH STATUS**** */

    function grandTotal($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'grandTotal';
        $page_data['page_title'] = translate('Grand Total');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE BILLING / INVOICES WITH STATUS**** */
    /* function classWise($param1 = '', $param2 = '', $param3 = '')
      {
      if ($this->session->userdata('accountant_login') != 1)
      redirect(base_url(), 'refresh');
      $page_data['page_name']  = 'classWise';
      $page_data['page_title'] = translate('Total By Class');
      $this->db->order_by('creation_timestamp', 'desc');
      $page_data['invoices'] = $this->db->get('invoice')->result_array();
      $this->load->view('index', $page_data);
      } */

    function classWise($class_id = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['class_id'] = $this->input->post('class_id');

            if ($page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?admin/classWise/' . $page_data['class_id'], 'refresh');
            } else {
                $this->session->set_flashdata('class_report', 'Choose Class, to check Class Wise Report');
                redirect(base_url() . 'index.php?admin/classWise/', 'refresh');
            }
        }
        $page_data['class_id'] = $class_id;
        $page_data['page_info'] = 'Class Wise Report';
        $page_data['page_name'] = 'classWise';
        $page_data['page_title'] = translate('Class Wise Report');
        $this->load->view('index', $page_data);
    }
	
	/*     * **MANAGE salary setup**** */

    function salary_setup($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
		    $data['teacher_id'] = $this->input->post('employeename');
            $data['Basic'] = $this->input->post('Basic');
            $data['MedicalAllowance'] = $this->input->post('MedicalAllowance');
            $data['HouseRent'] = $this->input->post('HouseRent');
            $data['Convince'] = $this->input->post('Convince');
			$data['WorkingHour'] = $this->input->post('WorkingHour');
			$data['Tax'] = $this->input->post('Tax');
			$data['Others'] = $this->input->post('Others');
			$data['pf'] = $this->input->post('pf');
			$data['Advance'] = $this->input->post('Advance');
			$data['Deduction'] = $this->input->post('Deduction');
            $data['Note'] = $this->input->post('notes');
            $this->db->insert('salarysetup', $data);
			
			$upid=$data['teacher_id'];
			$updata['salary_setup'] =1;
			$this->db->where('teacher_id', $upid);
            $this->db->update('teacher', $updata);
            redirect(base_url() . 'index.php?admin/salary_setup/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['Basic'] = $this->input->post('Basic');
            $data['MedicalAllowance'] = $this->input->post('MedicalAllowance');
            $data['HouseRent'] = $this->input->post('HouseRent');
            $data['Convince'] = $this->input->post('Convince');
			$data['WorkingHour'] = $this->input->post('WorkingHour');
			$data['Tax'] = $this->input->post('Tax');
			$data['pf'] = $this->input->post('pf');
			$data['Others'] = $this->input->post('Others');
			$data['Advance'] = $this->input->post('Advance');
			$data['Deduction'] = $this->input->post('Deduction');
            $data['Note'] = $this->input->post('notes');

            $this->db->where('id', $param2);
            $this->db->update('salarysetup', $data);
            redirect(base_url() . 'index.php?admin/salary_setup/', 'refresh');
			//return;
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('salarysetup');
			$updata['salary_setup'] =0;
			$this->db->where('teacher_id', $param3);
            $this->db->update('teacher', $updata);		
            redirect(base_url() . 'index.php?admin/salary_setup/', 'refresh');
        }
        $page_data['teachers'] = $this->db->get('salarysetup')->result_array();
        $page_data['page_name'] = 'salary_setup';
        $page_data['page_title'] = translate('salary_setups');
        $this->load->view('index', $page_data);
    }
	
	function salary_genarate($param1 = '', $param2 = '') {
        
		if ($param1 == 'create') {
		    $data['teacher_id'] = $this->input->post('eid');
			$data['employeeID'] = $this->input->post('employeeID');
			$data['tname'] = $this->input->post('ename');
            $data['month'] = $this->input->post('month');
            $data['year'] = $this->input->post('year');
            $data['designation'] = $this->input->post('dname');
            $data['Basic'] = $this->input->post('Basic');
            $data['MedicalAllowance'] = $this->input->post('MedicalAllowance');
            $data['HouseRent'] = $this->input->post('HouseRent');
            $data['Convince'] = $this->input->post('Convince');
			$data['WorkingHour'] = $this->input->post('WorkingHour');
			$data['present_day'] = $this->input->post('present_day');
			$data['Tax'] = $this->input->post('Tax');
			$data['Others'] = $this->input->post('Others');
			$data['Advance'] = $this->input->post('Advance');
			$data['Deduction'] = $this->input->post('Deduction');
			$data['bonus'] = $this->input->post('bonus');
			$data['loan'] = $this->input->post('loan');
			$data['pf'] = $this->input->post('pf');
			$data['gsalary'] = (floatval($data['Basic']))+(floatval($data['MedicalAllowance']))+(floatval($data['HouseRent']))+(floatval($data['Convince']))+(floatval($data['Others']));
			$data['tsalary'] = $data['gsalary']-(floatval($data['Tax']))-(floatval($data['Advance']))-(floatval($data['Deduction']))+(floatval($data['bonus']))-(floatval($data['loan']))-(floatval($data['pf']));
            $data['Note'] = $this->input->post('notes');
            $this->db->insert('csalary', $data);
            redirect(base_url() . 'index.php?admin/salary_genarate/', 'refresh');
        }
		if($param1=='salary_info')
		{
			$page_data['teacher_id'] = $param2;
	        $deg_id = $this->db->get_where('teacher', array('teacher_id' => $param2))->row()->designation;  
	        $page_data['designation'] = $this->db->get_where('designation', array('id' => $deg_id))->row()->name;
			$page_data['Ename'] = $this->db->get_where('teacher', array('teacher_id' => $param2))->row()->name;
			$page_data['employeeID'] = $this->db->get_where('teacher', array('teacher_id' => $param2))->row()->employeeID;
			$page_data['basicsalary'] =$this->db->get_where('salarysetup', array('teacher_id' => $param2))->result_array();	
		}

        $page_data['page_info'] = 'Salary Adjustments';
        $page_data['page_name'] = 'salary_genarate';
        $page_data['page_title'] = translate('Salary_Adjustments');
		
		$this->load->view('index', $page_data);
       }
	   function provident_report($param1='')
	   {
		   	if($param1=='get_report')
			{
				$page_data['month'] = $this->input->post('month');
				$page_data['year'] = $this->input->post('year');
		        $page_data['employeeID'] = $this->input->post('EmployeeID');
				$page_data['tname'] = $this->input->post('tname');
		        $page_data['designation'] = $this->input->post('designation');
				$page_data['status']='get_report';
			}
	   	$page_data['page_info'] = 'provident_report';
        $page_data['page_name'] = 'provident_report';
        $page_data['page_title'] = translate('provident_report');
		$this->load->view('index', $page_data);
	   }
	function provident_payment($param1='')
	{
		   	if($param1=='get_record')
			{
		        $page_data['employeeID'] = $this->input->post('EmployeeID');
				$page_data['tname'] = $this->input->post('tname');
		        $page_data['designation'] = $this->input->post('designation');
				$page_data['status']='get_record';
			}
			if($param1=='pay')
			{
				$teacher_id=$this->input->post('teacher_id');
				$payment_date=$this->input->post('payment_date');
				$paid_amount=$this->input->post('paid_amount');
				$count=0;
				foreach($teacher_id as $id)
				{
					$date=$payment_date[$count];
					$date=str_replace('/','-',$date);
					$date=date('Y-m-d',strtotime($date));
					$amount=$paid_amount[$count];
					if($amount)
					{
						$data=array(
							'teacher_id'=>$id,
							'paid_amount'=>$amount,
							'payment_date'=>$date
							);
						$this->db->insert('provident_payment',$data);
					}
					$count++;
				}
				redirect(site_url('admin/provident_payment'),'refresh');
			}
	   	$page_data['page_info'] = 'provident_payment';
        $page_data['page_name'] = 'provident_payment';
        $page_data['page_title'] = translate('provident_payment');
		$this->load->view('index', $page_data);
	   }
	function salary_status1111($param1 = '', $param2 = '') {

        $page_data['page_info'] = 'Salary Sheet';
        $page_data['page_name'] = 'salary_status';
        $page_data['page_title'] = translate('Salary_Sheet');
		
		$this->load->view('index', $page_data);
       }
	   
	   function salary_status($param1 = '', $param2 = '') {
            if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('csalary');	
            redirect(base_url() . 'index.php?admin/salary_status/', 'refresh');
        }
            $month=$this->input->post('month');
            $year=$this->input->post('year');
            $data['month'] = $this->input->post('month');
	    $data['year'] = $this->input->post('year');
            
            if($data['month']&& $data['year'])
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year))->get('csalary')->result_array();
		
		else if($data['month'])
		$page_data['salaryreport'] = $this->db->where(array('month' => $month))->get('csalary')->result_array();
		
		else if($data['year'])
		$page_data['salaryreport'] = $this->db->where(array('year' => $year))->get('csalary')->result_array();
		
            
            
            
        $page_data['page_info'] = 'Salary Sheet';
       $page_data['page_name'] = 'salary_status';
        $page_data['page_title'] = translate('Salary_Sheet');
		
		//$this->load->view('index', $page_data);
            
            $this->load->view('index',$page_data);
       }
	
	
	function salaryreport($param1 = '', $param2 = '') {
	
	
	         if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('csalary');	
            redirect(base_url() . 'index.php?admin/salaryreport/', 'refresh');
        }
	
	
        
		$data['month'] = $this->input->post('month');
		$data['year'] = $this->input->post('year');
        $data['EmployeeID'] = $this->input->post('EmployeeID');
        $data['designation'] = $this->input->post('designation');
        $data['gsalary'] = $this->input->post('gsalary');
        $data['advance'] = $this->input->post('advance');
		$data['deduction'] = $this->input->post('deduction');
        $data['tsalary'] = $this->input->post('tsalary');
		$page_data['month'] = $this->input->post('month');
		$page_data['year'] = $this->input->post('year');
        $page_data['EmployeeID'] = $this->input->post('EmployeeID');
        $page_data['designation'] = $this->input->post('designation');
        $page_data['gsalary'] = $this->input->post('gsalary');
        $page_data['advance'] = $this->input->post('advance');
		$page_data['deduction'] = $this->input->post('deduction');
        $page_data['tsalary'] = $this->input->post('tsalary');
		$month=$data['month'];
		$year=$data['year'];
		$EmployeeID=$data['EmployeeID'];
		$designation=$data['designation'];
		$gsalary=$data['gsalary'];
		$advance=$data['advance'];
		$deduction=$data['deduction'];
		$tsalary=$data['tsalary'];

		/*if($data['month']&& $data['year'] && $data['EmployeeID'] && $data['designation'] && $data['gsalary'] && $data['advance'] && $data['deduction'] && $data['tsalary'] and count($data)==8)
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year,'designation' => $designation,
		'employeeID' => $EmployeeID,'gsalary' => $gsalary,'tsalary' => $tsalary,'Advance' => $advance,'Deduction' => $deduction))->get('csalary')->result_array();
		
		else if($data['month']&& $data['year'] && $data['EmployeeID'] && $data['designation'] && $data['gsalary'] && $data['advance'] && $data['deduction'] and count($data)==7)
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year,'designation' => $designation,
		'employeeID' => $EmployeeID,'gsalary' => $gsalary,'Advance' => $advance,'Deduction' => $deduction))->get('csalary')->result_array();
		
		else if($data['month']&& $data['year'] && $data['EmployeeID'] && $data['designation'] && $data['gsalary'] && $data['advance'] and count($data)==6)
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year,'designation' => $designation,
		'employeeID' => $EmployeeID,'gsalary' => $gsalary,'Advance' => $advance))->get('csalary')->result_array();
		
		else if($data['month']&& $data['year'] && $data['EmployeeID'] && $data['designation'] && $data['gsalary'] and count($data)==5)
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year,'designation' => $designation,
		'employeeID' => $EmployeeID,'gsalary' => $gsalary))->get('csalary')->result_array();
		
		else if($data['month']&& $data['year'] && $data['EmployeeID'] && $data['designation'] and count($data)==4)
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year,'designation' => $designation,
		'employeeID' => $EmployeeID))->get('csalary')->result_array();
		
		else if($data['month']&& $data['year'] && $data['EmployeeID'] and count($data)==3)
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year,
		'employeeID' => $EmployeeID))->get('csalary')->result_array();
		
		else if($data['month']&& $data['year'] and count($data)==2)
		$page_data['salaryreport'] = $this->db->where(array('month' => $month,'year' => $year))->get('csalary')->result_array();*/
		
		if($data['month'])
		$page_data['salaryreport'] = $this->db->where(array('month' => $month));
		
		if($data['year'])
		$this->db->where(array('year' => $year));
		
		if($data['EmployeeID'])
		$this->db->where(array('employeeID' => $EmployeeID));
		
		if($data['designation'])
		$this->db->where(array('designation' => $designation));
		
		if($data['gsalary'])
		$this->db->where(array('gsalary' => $gsalary));
		
		if($data['advance'])
		$this->db->where(array('Advance' => $advance));
		
		if($data['deduction'])
		$this->db->where(array('Deduction' => $deduction));
		
		if($data['tsalary'])
		$this->db->where(array('tsalary' => $tsalary));
		$page_data['salaryreport']=$this->db->get('csalary')->result_array();
        $page_data['page_info'] = 'salary_report';
        $page_data['page_name'] = 'salaryreport';
        $page_data['page_title'] = translate('salary_report');
        $this->load->view('index', $page_data);
    }

    function sectionWise($class_id = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['class_id'] = $this->input->post('class_id');

            if ($page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?admin/sectionWise/' . $page_data['class_id'], 'refresh');
            } else {
                $this->session->set_flashdata('class_report', 'Choose section, to check section Wise Report');
                redirect(base_url() . 'index.php?admin/sectionWise/', 'refresh');
            }
        }
        $page_data['class_id'] = $class_id;

        $page_data['page_info'] = 'Section Wise Report';

        $page_data['page_name'] = 'sectionWise';
        $page_data['page_title'] = translate('Section Wise Report');
        $this->load->view('index', $page_data);
    }

    function dateWise($start_date = '', $end_date = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('start_date') != '') {
            // $page_data['class_id']   = $this->input->post('class_id');
            $date_string= strtotime(str_replace('/', '-', $this->input->post('start_date')));
            $page_data['start_date'] = date("Y-m-d",$date_string);            
            //$page_data['start_date'] = $this->input->post('start_date');
            
            $date_string= strtotime(str_replace('/', '-', $this->input->post('end_date')));
            $page_data['end_date'] = date("Y-m-d", $date_string);
            //$page_data['end_date'] = $this->input->post('end_date');
            if ($page_data['start_date'] != '' && $page_data['end_date'] != '') {
                
                redirect(base_url() . 'index.php?admin/dateWise/' . $page_data['start_date'] .'/'. $page_data['end_date'] , 'refresh');
            } else {
                $this->session->set_flashdata('class_report', 'Choose section, to check section Wise Report');
                redirect(base_url() . 'index.php?admin/dateWise/', 'refresh');
            }
        }
        //$page_data['class_id']   = $class_id;

        $page_data['page_info'] = 'Date Wise Report';
        $page_data['start_date'] = date('d/m/Y',strtotime($start_date));
        $page_data['end_date'] = date('d/m/Y',strtotime($end_date));
        $page_data['page_name'] = 'dateWise';
        $sql = "select * from invoice where creation_date between '$start_date' and '$end_date'";
        //$sql = "select * from invoice";
        $page_data['invoices'] = $this->db->query($sql)->result_array();

        $page_data['page_title'] = translate('Date Wise Report');
        $this->load->view('index', $page_data);
    }

    function statusWise($status = "") {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['status'] = $this->input->post('status');

            if ($page_data['status']) {
                redirect(base_url() . 'index.php?admin/statusWise/' . $page_data['status'], 'refresh');
            } else {
                $this->session->set_flashdata('class_report', 'Choose Class, to check Class Wise Report');
                redirect(base_url() . 'index.php?admin/statusWise/', 'refresh');
            }
        }
        $page_data['status'] = $status;
        $page_data['page_info'] = 'Class Wise Report';
        $page_data['page_name'] = 'statusWise';
        $page_data['page_title'] = translate('Class Wise Report');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE LIBRARY / BOOKS******************* */

    function book($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price'] = $this->input->post('price');
            $data['author'] = $this->input->post('author');
            $data['class_id'] = $this->input->post('class_id');
            $data['status'] = $this->input->post('status');
            $this->db->insert('book', $data);
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price'] = $this->input->post('price');
            $data['author'] = $this->input->post('author');
            $data['class_id'] = $this->input->post('class_id');
            $data['status'] = $this->input->post('status');

            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                        'book_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        $page_data['books'] = $this->db->get('book')->result_array();
        $page_data['page_name'] = 'book';
        $page_data['page_title'] = translate('manage_library_books');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE TRANSPORT / VEHICLES / ROUTES******************* */

    function transport($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['route_name'] = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description'] = $this->input->post('description');
            $data['route_fare'] = $this->input->post('route_fare');
            $this->db->insert('transport', $data);
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name'] = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description'] = $this->input->post('description');
            $data['route_fare'] = $this->input->post('route_fare');

            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                        'transport_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name'] = 'transport';
        $page_data['page_title'] = translate('manage_transport');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE DORMITORY / HOSTELS / ROOMS ******************* */

    function dormitory($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description'] = $this->input->post('description');
            $this->db->insert('dormitory', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description'] = $this->input->post('description');

            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                        'dormitory_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name'] = 'dormitory';
        $page_data['page_title'] = translate('manage_dormitory');
        $this->load->view('index', $page_data);
    }

    /*     * *MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD* */

    function noticeboard($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['notice_title'] = $this->input->post('notice_title');
            $data['notice'] = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title'] = $this->input->post('notice_title');
            $data['notice'] = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', translate('notice_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                        'notice_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        $page_data['page_name'] = 'noticeboard';
        $page_data['page_title'] = translate('manage_noticeboard');
        $page_data['notices'] = $this->db->get('noticeboard')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ***SITE/SYSTEM SETTINGS******** */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param2 == 'do_update') {
            $this->db->where('type', $param1);
            $this->db->update('settings', array(
                'description' => $this->input->post('description')
            ));
            $this->session->set_flashdata('flash_message', translate('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', translate('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = translate('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('index', $page_data);
    }
	function settings($param='')
	{
		if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
		$this->load->config('grocery_crud');
    	$this->config->set_item('grocery_crud_file_upload_allow_file_types','gif|jpeg|jpg|png');
		$have_settings=get_single_value('count(settings_id)','settings');
		if($have_settings)
		{
			$this->gc->unset_add();
			$this->gc->unset_list();
		}
			$output=$this->gc->set_theme('flexigrid')
		->set_table('settings')
		->set_subject(translate('system_settings'))
		->set_field_upload('logo','uploads')
		->callback_after_upload(function($uploader_response,$field_info, $files_to_upload)
		{
			$this->load->library('image_moo');
			$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
    		$this->image_moo->load($file_uploaded)->resize(500,500)->save($file_uploaded,true);	
		})
		->unset_read()->unset_delete()
		->render();
		$page_data['crud']=$output;
		$page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('system_settings');
		$this->load->view('index', $page_data);
	}
    /*     * ***LANGUAGE SETTINGS******** */

    /*     * ***SITE/SYSTEM SETTINGS******** */

	
	function fees() 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') 
		{
            $page_data['class_id'] = $this->input->post('class_id');
			$page_data['group_id'] = $this->input->post('group_id');
			$page_data['fess_id']=$this->input->post('fess_id');
        }
		 if ($this->input->post('operation') == 'update') 
		{
            $class_id = $this->input->post('class_id');
			$group_id = $this->input->post('group_id');
			$fees_id=$this->input->post('fess_id');
			if($group_id)
			$students = $this->db->get_where('student', array('class_id' => $class_id,'group' => $group_id))->result_array();
			else
			$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
			foreach($students as $row)
			{
				$student_id=$row['student_id'];
				$amount=$this->input->post($student_id);
				$data=array('student_id'=>$student_id,'fees_id'=>$fees_id,'amount'=>$amount);
				$current_amount=get_single_value('amount','fees',array('student_id'=>$student_id,'fees_id'=>$fees_id));
				if(!$current_amount or $current_amount=='-')
				{
					$this->db->insert('fees',$data);
				}
				else
				{
					$this->db->where(array('student_id'=>$student_id,'fees_id'=>$fees_id));
					$this->db->update('fees',$data);
				}
			}
			redirect(site_url('admin/fees'),'refresh');
        }
        $page_data['page_info'] = translate('Manage Fees');
        $page_data['page_name'] = 'fees';
        $page_data['page_title'] = translate('Manage Fees');
        $this->load->view('index', $page_data);
    }
	function fees_setup($param1 = '', $param2 = '', $param3 = '') 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
			$output=$this->gc
		->set_table('fees_name')
		->set_subject(translate('fees_name'))
		->display_as('fee_full_name',translate('fee_name'))
		->columns('fee_full_name')
		->unset_edit_fields('fee_name')
		->unset_add()->unset_read()->unset_delete()
		->render();
        $page_data['fees_list'] = $this->load->view('admin/output',array('crud'=>$output),TRUE);
        if ($param1 == 'create') 
		{
			if($this->input->post('montly_fee')==1)
			{
				for ($m=1; $m<=12; $m++)
				{
					$month = date('M', mktime(0,0,0,$m));
					$data['fee_name'] = strtolower(str_replace(' ', '_', $this->input->post('fee_name'))."_".$month);
	            	$data['fee_full_name'] = $this->input->post('fee_name')." [".$month."]";
	                $this->db->insert('fees_name', $data);
				}
			}
			else
			{
				$data['fee_name'] = strtolower(str_replace(' ', '_', $this->input->post('fee_name')));
	            $data['fee_full_name'] = $this->input->post('fee_name');
	                        
	            $this->db->insert('fees_name', $data);
			}
            redirect(base_url() . 'index.php?admin/fees_setup/', 'refresh');
        }

        if ($param1 == 'set_fees') {

            $class_id = $_POST['data'][1]['class_id'];
            if ($class_id == null) {
                $class_id = $this->db->count_all('fees_setup');
                $class_id = $_POST['data'][$class_id + 1]['class_id'];
            }

            $final_data = array();
            $total_bill = array();
            $counter = 0;
            foreach ($_POST['data'] as $key2 => $fees_setup_data2) {
                $total_bill[$counter]['total_bill'] = $total_bill[$counter]['total_bill'] + $fees_setup_data2['fees_amount'];
            }
                       
            foreach ($_POST['data'] as $key => $fees_setup_data) {
                $final_data[$key]['class_id'] = $class_id;
                $final_data[$key]['fees_name_id'] = $fees_setup_data['fees_name_id'];
                $final_data[$key]['fees_amount'] = $fees_setup_data['fees_amount']; 
                $final_data[$key]['total_bill'] = $total_bill[0]['total_bill'];
            }
            $this->db->insert_batch('fees_setup', $final_data);            
            redirect(base_url() . 'index.php?admin/fees_setup/', 'refresh');
        }
        
        if($this->uri->segment(3) == "set_fees_by_class") {
            $class_id = $this->uri->segment(4);
            
            $fees_setup_data = $this->db->select('*')->from('fees_setup')->where('class_id', $class_id)->get()->result_array();
            $num_rows = count($fees_setup_data);
            
            if($num_rows > 0){                                
                echo json_encode ($fees_setup_data);
                die;                
            }else {            
                echo "not_exist";
                die;
            }
        }
        
        if ($param1 == 'do_update') {

            $final_data = array();
            foreach ($_POST['data'] as $fees_setup_data) {
                $final_data['fees_id'] = $fees_setup_data['fees_id'];
                $final_data['fees_amount'] = $fees_setup_data['fees_amount'];

                $this->db->where('fees_id', $final_data['fees_id']);
                $this->db->update('fees_setup', $final_data);
            }

            $this->session->set_flashdata('flash_message', translate('settings_updated'));
            redirect(base_url() . 'index.php?admin/fees_setup', 'refresh');
        } /*else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('fees_name', array(
                        'class_id' => $param2
                    ))->result_array();
        }*/
        $page_data['page_name'] = 'fees_setup';
        $page_data['page_title'] = translate('fees_setup');
        $page_data['fees_setup'] = $this->db->get('fees_setup')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ***LANGUAGE SETTINGS******** */

    function manage_language($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language = $param2;
            $total_phrase = $this->input->post('total_phrase');
            for ($i = 1; $i < $total_phrase; $i++) {
                //$data[$language]	=	$this->input->post('phrase').$i;
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', translate('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', translate('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('flash_message', translate('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', translate('settings_updated'));

            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        $page_data['page_name'] = 'manage_language';
        $page_data['page_title'] = translate('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ***BACKUP / RESTORE / DELETE DATA PAGE********* */

    function backup_restore($operation = '', $type = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }

        $page_data['page_info'] = 'Create backup / restore from backup';
        $page_data['page_name'] = 'backup_restore';
        $page_data['page_title'] = translate('manage_backup_restore');
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            $this->session->set_flashdata('flash_message', translate('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = $this->input->post('password');
            $data['new_password'] = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');

            $current_password = $this->db->get_where('admin', array(
                        'admin_id' => $this->session->userdata('admin_id')
                    ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', translate('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', translate('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = translate('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->result_array();
        $this->load->view('index', $page_data);
    }
	function mark_sheet_glance($class_id="")
	{
		if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
		$this->load->helper('mark_sheet');
		$page_data['page_name'] = 'mark_sheet_glance';
        $page_data['page_title'] = translate('mark sheet at glance');
        $this->load->view('index', $page_data);
	}
	public function studentlist($class_id='')
	{
		$con=array();
		if($class_id)
		$this->db->where('class_id',$class_id);
		$this->db->order_by('class_id', 'asc');
		$students = $this->db->get('student')->result_array();
		$str='<option value="">All</option>';
        foreach ($students as $row):
            $str.='<option value="'.$row['student_id'].'">';
			if($row['student_unique_ID'])
			$str.=$row['student_unique_ID'].'-';
			$str.=$row['name'];
			if($row['class_id'])
			{
				$str.='-Class-'.$this->crud_model->get_class_name($row['class_id']);
			}
			if($row['roll'])
			{
				$str.='-Roll-'.$row['roll'];
			}
            $str.='</option>';
        endforeach;
		echo $str;
	}
        
         function student_info_sheet($param1='')
		 {
		 	if($param1=='upload_excel')
			{
				$class_id=$this->input->post('class_id');
				$page_data['class_id']=$class_id;
				$config['upload_path'] = './uploads/excel_sheet/';
				$config['allowed_types'] = 'csv';
				$config['max_size']	= '1000';
                $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('xlfile'))
			   {
			   		$page_data['error'] =$this->upload->display_errors();
					echo $this->upload->display_errors();
			   }
			   else
			   {
			   		$this->load->helper('text');
			   		$file_info = $this->upload->data();
			   		$filename = $file_info['file_name'];
		         	$file =base_url().'/uploads/excel_sheet/'.$filename;
					$this->load->library('getcsv');
					$data = $this->getcsv->set_file_path($file)->get_csv_array();
					$i = 0;
					foreach ($data as $key => $val) 
					{
						if($key > 1)
						{
							 $rn=str_split ($val[17]);
							 $rel_name='';
							 foreach($rn as $char)
							 {
							 	$char=strtolower($char);
								if($char>='a' and $char<='z')
								{
									$rel_name.=$char;	
								}
							 }
							 $religion='';
							if($rel_name)
							$religion=get_single_value('religion_id','religion',array('religion_name'=>$rel_name));
							$group_name=str_split ($val[26]);
							 $gn='';
							 foreach($group_name as $char)
							 {
							 	$char=strtolower($char);
								if($char>='a' and $char<='z')
								{
									$gn.=$char;	
								}
							 }
							 $group_id='';
							if($gn)
							$group_id=get_single_value('group_id','group',array('group_name'=>$gn));
							$student_data=array(
							'name'=>$val[0],
							'nick_name'=>$val[1],
							'father_name'=>$val[2],
							'father_education'=>$val[3],
							'father_occupation'=>$val[4],
							'father_mobile'=>$val[5],
							'father_nidnumber'=>$val[6],
							'mother_name'=>$val[7],
							'mother_education'=>$val[8],
							'mother_occupation'=>$val[9],
							'mother_mobile'=>$val[10],
							'mother_nidnumber'=>$val[11],
							'present_address'=>$val[12],
							'permanent_address'=>$val[13],
							'birthday'=>$val[14],
							'sex'=>$val[15],
							'maritial_status'=>$val[16],
							'religion'=>$religion,
							'nationality'=>$val[18],
							'phone'=>$val[19],
							'admission_form_no'=>$val[20],
							'student_unique_ID'=>$val[21],
							'academic_year'=>$val[22],
							'class_id'=>$class_id,
							'roll'=>$val[24],
							'section'=>$val[25],
							'group'=>$group_id
							);
							$filteredarray = array_values( array_filter($student_data) );
							if(count($filteredarray)>10)
							{
								$this->db->insert('student',$student_data);
							}
						}
					}
					$this->session->set_flashdata('message','Data Imported Successfully');
					redirect('admin/student_info_sheet','refresh');
			   }
			}
	        $page_data['page_name'] = 'student_info_sheet';
	        $page_data['page_title'] = translate('Export/Import Information');
	        $this->load->view('index', $page_data); 
		}
		function student_excel($class_id)
		{
			if($class_id)
				{
					$this->config->set_item('grocery_crud_default_per_page',50);
				$output=$this->gc->set_table('student')//->set_theme('flexigrid')
								->where('student.class_id',$class_id)
								->columns('name','nick_name','father_name','father_education','father_occupation','father_mobile','father_nidnumber','mother_name','mother_education','mother_occupation','mother_mobile','mother_nidnumber','present_address','permanent_address','birthday','sex','maritial_status','religion','nationality','phone','admission_form_no','student_unique_ID','academic_year','class_id','roll','section','group')
								->set_relation('religion','religion','religion_name')
								->set_relation('group','group','group_name')
								->callback_column('class_id',function($value)
								{
									return get_single_value('name','class',array('class_id'=>$value));
								})
								->display_as('class_id','Class')
								->display_as('student_unique_ID','Student ID')
								->unset_add()->unset_edit()->unset_read()->unset_delete()
								->render();
								$output->class_id=$class_id;
						$this->load->view('admin/student_excel',$output);
				}
		}
        
                                
                                
                                function createxlsx(){
            $classid=$this->input->post('class_id');
            if(!$classid){
                        $page_data['error'] ="Please Select a class";
                        $page_data['page_name'] = 'studentbulk';
                        $page_data['page_title'] = translate('Bulk_student');
			$this->load->view('index', $page_data);
                        return false;   
            }
                            
$query=$this->db->get_where('student', array('class_id' => $classid));
    if(!$query){
                        $page_data['error'] ="no student Found";
                        $page_data['page_name'] = 'studentbulk';
                        $page_data['page_title'] = translate('Bulk_student');
			$this->load->view('index', $page_data);
                        return false;   
            }
    $classname=$this->db->get_where('class', array('class_id' => $classid))->row()->name; 
// $total=$this->db->get_where('student', array('class_id' => $classid))->result_array(); 
//$totalst=count($total)+100;
$this->load->library('excel');
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('student info');


$this->excel->getActiveSheet()->getProtection()->setSheet(true);
$this->excel->getActiveSheet()->getProtection()->setPassword('WeMAX2015');


foreach(range('B','Z') as $columnID) {
$this->excel->getActiveSheet()->getStyle($columnID)->getProtection()->setLocked(
PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
} 
foreach(range('A','R') as $columnID) { 
   $this->excel->getActiveSheet()->getStyle('A'.$columnID)->getProtection()->setLocked(
PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
   
}

$this->excel->getActiveSheet()->getStyle('A1:AR1')->getProtection()->setLocked(
PHPExcel_Style_Protection::PROTECTION_PROTECTED
);

$this->excel->getActiveSheet()->protectCells('A1:B1', 'PHP');

foreach(range('A','Z') as $columnID) {
   $this->excel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
} 
foreach(range('A','R') as $columnID) {
   $this->excel->getActiveSheet()->getColumnDimension('A'.$columnID)
        ->setAutoSize(true);
}

    $this->excel->getActiveSheet()->getStyle("A1:AR1")->getFont()->setBold(true);

$fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
         if($field!='email' && $field!='password' && $field!='prev_institution_name' && $field!='prev_class_id' && $field!='prev_passing_yrs' && $field!='prev_gpa' && $field!='prev_institution_address' && $field!='tc_institution_name' && $field!='tc_form_no' && $field!='tc_date'&& $field!='clearance_no'&& $field!='group_others'&& $field!='passing_year'&& $field!='other_student_name'&& $field!='others_class_id'&& $field!='others_section'&& $field!='others_roll'&& $field!='transport_id'&& $field!='dormitory_id'&& $field!='dormitory_room_number' && $field!='subject_id'&& $field!='fourth_id'){ 
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
               }
        }
 
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
           foreach ($fields as $field)
           {                  
        if($field!='email' && $field!='password' && $field!='prev_institution_name' && $field!='prev_class_id' && $field!='prev_passing_yrs' && $field!='prev_gpa' && $field!='prev_institution_address' && $field!='tc_institution_name' && $field!='tc_form_no' && $field!='tc_date'&& $field!='clearance_no'&& $field!='group_others'&& $field!='passing_year'&& $field!='other_student_name'&& $field!='others_class_id'&& $field!='others_section'&& $field!='others_roll'&& $field!='transport_id'&& $field!='dormitory_id'&& $field!='dormitory_room_number' && $field!='subject_id'&& $field!='fourth_id'){
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
            $col++;
               }
            }
 
            $row++;
        }

$filename='Class_'.$classname.'_'.date("Y-m-d").'.xlsx'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007'); 
ob_end_clean();
$objWriter->save('php://output');
exit;
}

function upxlsandimport(){
    
    $Stclassid=$this->input->post('Stclassid');
            if(!$Stclassid){
                        $page_data['error'] ="Please Select a class";
                        $page_data['page_name'] = 'studentbulk';
                        $page_data['page_title'] = translate('Bulk_student');
			$this->load->view('index', $page_data);
                        return false;   
            }
                $config['upload_path'] = './uploads/excel_sheet/';
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size']	= '1000';
                $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('xlfile'))
		{
                       $page_data['error'] =$this->upload->display_errors();
                       $page_data['page_name'] = 'studentbulk';
                       $page_data['page_title'] = translate('Bulk_student');
			$this->load->view('index', $page_data);
                }
                else{
            $file_info = $this->upload->data();
	   $filename = $file_info['file_name'];
         $file =getcwd() .'/uploads/excel_sheet/'.$filename;
          $this->load->library('excel');



try {
	$objPHPExcel = PHPExcel_IOFactory::load($file);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet); 
$count=1;
for($i=2;$i<=$arrayCount;$i++){
    $count++;
$student_id = trim($allDataInSheet[$i]["A"]);

$query = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
            $data['admission_form_no'] = trim($allDataInSheet[$i]["A"]);
            $data['registration_no'] = trim($allDataInSheet[$i]["C"]);
            $data['student_unique_ID'] = trim($allDataInSheet[$i]["D"]);
            $data['academic_year'] = trim($allDataInSheet[$i]["E"]);
            $data['name'] = trim($allDataInSheet[$i]["F"]);
            $data['birthday'] = trim($allDataInSheet[$i]["G"]);
            $data['sex'] = trim($allDataInSheet[$i]["H"]);
            $data['religion'] = trim($allDataInSheet[$i]["I"]);
            $data['nationality'] = trim($allDataInSheet[$i]["J"]);
            $data['blood_group'] = trim($allDataInSheet[$i]["K"]);
            $data['present_address'] = trim($allDataInSheet[$i]["L"]);
            $data['permanent_address'] = trim($allDataInSheet[$i]["M"]);
            $data['phone'] = trim($allDataInSheet[$i]["N"]);
            $data['father_name'] = trim($allDataInSheet[$i]["O"]);
            $data['father_age'] = trim($allDataInSheet[$i]["P"]);
            $data['father_education'] = trim($allDataInSheet[$i]["Q"]);
            $data['father_occupation'] = trim($allDataInSheet[$i]["R"]);
            $data['father_mobile'] = trim($allDataInSheet[$i]["S"]);
            $data['father_blood_group'] = trim($allDataInSheet[$i]["T"]);
            $data['father_nidnumber'] = trim($allDataInSheet[$i]["U"]);
            $data['mother_name'] = trim($allDataInSheet[$i]["V"]);
            $data['mother_age'] = trim($allDataInSheet[$i]["W"]);
            $data['mother_education'] =trim($allDataInSheet[$i]["X"]);
            $data['mother_occupation'] = trim($allDataInSheet[$i]["Y"]);
            $data['mother_mobile'] = trim($allDataInSheet[$i]["Z"]);
            $data['mother_blood_group'] = trim($allDataInSheet[$i]["AA"]);
            $data['mother_nidnumber'] = trim($allDataInSheet[$i]["AB"]);
            $data['guardian_name'] = trim($allDataInSheet[$i]["AC"]);
            $data['guardian_profession'] = trim($allDataInSheet[$i]["AD"]);
            $data['guardian_age'] = trim($allDataInSheet[$i]["AE"]);
            $data['guardian_income'] = trim($allDataInSheet[$i]["AF"]);
            $data['guardian_land'] = trim($allDataInSheet[$i]["AG"]);
	    $data['guardian_nid']=trim($allDataInSheet[$i]["AH"]); 
            $data['guardian_address'] = trim($allDataInSheet[$i]["AI"]);
            $data['roll'] = trim($allDataInSheet[$i]["AK"]);
            $data['section'] = trim($allDataInSheet[$i]["AL"]);
            $data['group'] = trim($allDataInSheet[$i]["AM"]);
            $data['father_birthday'] = trim($allDataInSheet[$i]["AN"]);
            $data['mother_birthday'] = trim($allDataInSheet[$i]["AO"]);
            $data['gardian_blood_group'] = trim($allDataInSheet[$i]["AP"]);
            $data['gardian_mobile'] = trim($allDataInSheet[$i]["AQ"]);
            $data['guardian_birthday'] = trim($allDataInSheet[$i]["AR"]);
            
    if(count($query)==1){
            $data['class_id'] = $Stclassid;
            $this->db->where('student_id', $student_id);
            $this->db->update('student', $data);
            
           if($this->db->affected_rows()){
                             // echo "sucessfully updated";
                                         }
                       }
    if(count($query)==0){
            $data['class_id'] = $Stclassid;
            $this->db->insert('student', $data);
            $student_id = mysql_insert_id();
           if($student_id){
             // echo "sucessfully inserted";
                        }


                }        
    
    }
    

    if($count==$arrayCount){
        
                        $page_data['error'] ="Your Xlsx  File Imported Sucessfully";
                        $page_data['page_name'] = 'studentbulk';
                        $page_data['page_title'] = translate('Bulk_student');
			$this->load->view('index', $page_data);
                        return false;
        
                            }
       
           
                    }
    

            }   

            function payslip($param='')
			{
						if($param=='all')
						{
							$payslipid=$this->input->post('payslipid');
							$page_data['page_title']=translate('pay_slip');
							$page_data['paysliparray']=$payslipid;
							$this->load->view('admin/payslip_all',$page_data);
						}
						else
						{
							$page_data['page_title']=translate('pay_slip');
							$page_data['payslipid'] = $param;
							$this->load->view('admin/payslip',$page_data);
						}
                
            }
		function holiday($param1 = '', $param2 = '', $param3 = '') {
       
            if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
   
                if ($param1 == 'create') {        
           $data['holidayname'] = $this->input->post('holiday_name');
           $date_string= strtotime(str_replace('/', '-', $this->input->post('holiday_date')));
           $data['holidaydate'] =date("Y-m-d",$date_string); 
            $this->db->insert('holiday', $data);
           redirect(base_url() . 'index.php?admin/holiday', 'refresh');
                                          } 
                 if ($param1 == 'do_update') {
           $data['holidayname'] = $this->input->post('holiday_name');
           $date_string= strtotime(str_replace('/', '-', $this->input->post('holiday_date')));
           $data['holidaydate'] =date("Y-m-d",$date_string); 

            $this->db->where('holidayid', $param2);
            $this->db->update('holiday', $data);
            redirect(base_url() . 'index.php?admin/holiday', 'refresh');
        }    
              if ($param1 == 'delete') {
            $this->db->where('holidayid', $param2);
            $this->db->delete('holiday');
            redirect(base_url() . 'index.php?admin/holiday', 'refresh');
        }
                    
        $page_data['holidays'] = $this->db->get('holiday')->result_array();
        $page_data['page_name'] = 'holiday';
        $page_data['page_title'] = translate('manage_holiday');
        $this->load->view('index', $page_data);    

    }                                
        function stattendancetype($param1 = '', $param2 = '', $param3 = '') {
       
            if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
   
                if ($param1 == 'create') {        
           $data['attendance_type'] = $this->input->post('attendance_type');
           $data['short_form'] =$this->input->post('short_form');
            $this->db->insert('attendance_type', $data);
           redirect(base_url() . 'index.php?admin/stattendancetype', 'refresh');
                                          } 
                 if ($param1 == 'do_update') {
         $data['attendance_type'] = $this->input->post('attendance_type');
           $data['short_form'] =$this->input->post('short_form');

            $this->db->where('type_id', $param2);
            $this->db->update('attendance_type', $data);
            redirect(base_url() . 'index.php?admin/stattendancetype', 'refresh');
        }    
              if ($param1 == 'delete') {
            $this->db->where('type_id', $param2);
            $this->db->delete('attendance_type');
            redirect(base_url() . 'index.php?admin/stattendancetype', 'refresh');
        }
                    
        $page_data['attendstype'] = $this->db->get('attendance_type')->result_array();
        $page_data['page_name'] = 'stattendancetype';
        $page_data['page_title'] = translate('Student Attendance Type');
        $this->load->view('index', $page_data);    

    }
	function stattendancetype_setup() 
	{
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
		$output=$this->gc
		->set_table('attendance_type')
		->set_theme('school')
		->set_subject(translate('attendance_type'))
		->required_fields('attendance_type','short_form','color')
		->callback_field('color',function($value)
		{
			return "<input type='text' name='color' id='color' value='".$value."' onfocus='color_picker(this)' style='background-color:".$value.";'>";
		})
		->callback_column('color',function($value)
		{
			return "<div class='span1' style='background-color:".$value.";height:100%;width:70%;'>&nbsp;</div>";
		})
		->unset_read()
		->render();
        $page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('manage_attendance_type');
		$page_data['crud']=$output;
        $this->load->view('index', $page_data);
    }
    
    
                        
   
      function student_attendance($month = '', $year = '', $class_id = '',$subject_id = '' , $group_name = '') {
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['month'] = $this->input->post('month');
	    $page_data['year'] = $this->input->post('year');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            $page_data['group_name'] = $this->input->post('group_name');
            
            if(!$page_data['subject_id']){
              $page_data['subject_id']=99999;  
            }
  

            if ($page_data['month'] > 0 && $page_data['year'] > 0 && $page_data['class_id'] > 0 ) {
                redirect(base_url() . 'index.php?admin/student_attendance/' . $page_data['month'] . '/' . $page_data['year'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'].'/' . $page_data['group_name'], 'refresh');
            }else {
                $this->session->set_flashdata('mark_message', 'Choose month,year and class');
                redirect(base_url() . 'index.php?admin/student_attendance/', 'refresh');
            }   
        }
    
      if ($this->input->post('operation') == 'update') {
          
         
           $AllAttendance = $this->input->post('attendance');
           
        if(!empty($AllAttendance)){
                foreach ($AllAttendance as $item){
                  $month=$item['month'];
                  $year=$item['year'];
                  $data['year']=$item['year'];
                  $data['month']=$item['month'];
                  $data['student_id']=$item['student_id'];
                  $data['subject_id']=$item['subject_id'];
                  $data['class_id']=$item['class_id'];
                  $totalday = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                  for($day=1;$day<=$totalday;$day++){
                      $data["date_".$day]=$item[$day];
                                                    } 
                                                    
                                   $verify_data = array(	
                        'month' => $item['month'] ,
                        'class_id' => $item['class_id'] ,
                        'year' => $item['year'] , 
                        'student_id' => $item['student_id'],
			'subject_id' => $item['subject_id']
                            );                                  
                        $query = $this->db->get_where('attendance' , $verify_data);
                    $existrow = $query->num_rows() ; 
                    
                    
                    if($existrow>0){
                        
                        
                        $this->db->where($verify_data);
                        $this->db->update('attendance', $data);
                        
                    }else{
   
              $this->db->insert('attendance' , $data);
                         }
                  
                  
                  
                    }      
        
            }
    
      }    
        
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['subject_id'] = $subject_id;
        $page_data['group_name'] = $group_name;
        $page_data['page_info'] = 'student attendance';
        $page_data['page_name'] = 'student_attendance';
        $page_data['page_title'] = translate('student attendance');
		$page_data['system_title'] = "Powered By Wemax Software Ltd.";
		//$this->load->view('includes', $page_data);
        $this->load->view('index', $page_data);
    }
  
	function employee_attendance($month = '', $year = '',$teacher_id='') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') 
		{
            $page_data['month'] = $this->input->post('month');
	    	$page_data['year'] = $this->input->post('year');
            $page_data['teacher_id'] = $this->input->post('teacher_id');

            if ($page_data['month'] > 0 && $page_data['year'] > 0) {
                redirect(base_url() . 'index.php?admin/employee_attendance/' . $page_data['month'] . '/' . $page_data['year']. '/' . $page_data['teacher_id'], 'refresh');
            }else {
                $this->session->set_flashdata('mark_message', 'Choose month,year and class');
                redirect(base_url() . 'index.php?admin/employee_attendance/', 'refresh');
            }   
        }
    
      if ($this->input->post('operation') == 'update') 
	  {
	  	$teacher_id=$this->input->post('teacher_id');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		$days=$this->input->post('day');
		$in_times=$this->input->post('in_time');
		$out_times=$this->input->post('out_time');
		$status_s=$this->input->post('status');
	  	for($loop=0;$loop<=count($in_times);$loop++)
		{
			$in_time=$in_times[$loop];
			$out_time=$out_times[$loop];
			$status=$status_s[$loop];
			if($in_time or $out_time or $status)
			{
				$day=$days[$loop];
				$condition=array(
				'teacher_id'=>$teacher_id,
				'year'=>$year,
				'month'=>$month,
				'day'=>$day
				);
				$this->db->where($condition);
				$this->db->delete('employee_attendance');
				$data=array(
				'teacher_id'=>$teacher_id,
				'year'=>$year,
				'month'=>$month,
				'day'=>$day,
				'in_time'=>$in_time,
				'out_time'=>$out_time,
				'status'=>$status
				);
				$this->db->insert('employee_attendance',$data);
			}
		}
		redirect(base_url() . 'index.php?admin/employee_attendance/'.$month.'/'.$year.'/'.$teacher_id, 'refresh');
      }    
        
        $page_data['month'] = $month;
        $page_data['year'] = $year;
		$page_data['teacher_id']=$teacher_id;
        $page_data['page_info'] = 'employee_attendance';
        $page_data['page_name'] = 'employee_attendance';        
		$page_data['page_title'] = translate('employee_attendance');
        $this->load->view('index', $page_data);
    }
    function shift_setup()
	{
		if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
		$this->gc
		->set_table('shift')
		->set_subject(translate('shift_setup'))
		->field_type('in_time','time');
		$output=$this->gc->render();
        $page_data['page_name'] = 'output';
        $page_data['page_title'] = translate('shift_setup');
		$page_data['crud']=$output;
        $this->load->view('index', $page_data);
	}
    function attendance_report($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
          
            $date_form=$this->input->post('attendance_date_from');
			if(!$date_form)
			$date_form=date("Y-m-d");
            $date_from_string = date('Y-m-d', strtotime(str_replace('/', '-', $date_form)));
            $date_from_date=date("d",strtotime(str_replace('/', '-', $date_form)));
            $date_from_month=date("m",strtotime(str_replace('/', '-', $date_form)));
            $date_from_year=date("Y",strtotime(str_replace('/', '-', $date_form)));
            $date_to=$this->input->post('attendance_date_to');
			if(!$date_to)
			$date_to=date("Y-m-d");
            $date_to_string = date('Y-m-d', strtotime(str_replace('/', '-', $date_to)));
            $date_to_month=date("m",strtotime(str_replace('/', '-', $date_to)));
            $date_to_year=date("Y",strtotime(str_replace('/', '-', $date_to)));
            $date_to_date=date("d",strtotime(str_replace('/', '-', $date_to)));
             
             
            
            $page_data['start_month'] = $date_from_month;
             $page_data['end_month'] = $date_to_month;
             $page_data['start_day'] = $date_from_date;
             $page_data['end_day'] = $date_to_date;
             $page_data['report_year'] = $date_from_year;
             $page_data['class_id'] = $this->input->post('class_id');
             $page_data['subject_id'] = $this->input->post('subject_id');
             $page_data['group_name'] = $this->input->post('group_name');
             $page_data['Att_type_report'] = $this->input->post('Attendance_type');
             $page_data['student_id_attends'] = $this->input->post('student_id');
             $page_data['section_name'] = $this->input->post('section_name');
             $page_data['page_name'] = 'attendance_report';
             $page_data['page_title'] = translate('attendance_report');
             
             if ($date_to_month < $date_from_month)
			 {
            		redirect(base_url() . 'index.php?admin/attendance_report/', 'refresh');          
             }
             
             
             if((empty($page_data['class_id']) || empty($page_data['student_id_attends']))&&( $date_from_year ==1970 || $date_to_year==1970 )){

           redirect(base_url() . 'index.php?admin/attendance_report/', 'refresh');     
             } 
             
             if(empty($page_data['class_id']) && empty($page_data['student_id_attends'])){
        $student_class_id=$this->db->get_where('student', array('student_id' => $page_data['student_id_attends']))->row()->class_id;
        if($student_class_id !=$page_data['class_id']){
                redirect(base_url() . 'index.php?admin/attendance_report/', 'refresh');
        }
             
             }
             
              $this->load->view('includes', $page_data);
              $this->load->view('admin/attendance_report_details',$page_data);
          
        }else{
        
        $page_data['page_name'] = 'attendance_report';
        $page_data['page_title'] = translate('attendance_report');
        $page_data['attendstype'] = $this->db->get('attendance_type')->result_array();
       // $this->load->view('index', $page_data);
        $this->load->view('index', $page_data);
       
        }
    }
    
    
    	function admit_card() 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') 
		{
            $page_data['class_id'] = $this->input->post('class_id');
			$page_data['group_id'] = $this->input->post('group_id');
			$page_data['exam_id']=$this->input->post('exam_id');
                        $page_data['year']=$this->input->post('year');
        }
		 if ($this->input->post('operation') == 'update') 
		{
                        $class_id = $this->input->post('class_id');
			$exam_id=$this->input->post('exam_id');
                        $year=$this->input->post('year');
                
                        
                        
                      $data['class_id']=$class_id;
                      $data['exam_id']=$exam_id;
                      $data['year']=$year;

       
     
                      
                     
                 $admitsinfo = $this->input->post('admitcard'); 
                 foreach($admitsinfo as $student_id){
                     
                     
           $grantedto=$this->input->post('grantedto'.$student_id);
           $grantedform=$this->input->post('grantedform'.$student_id);
           $date_string1= strtotime(str_replace('/', '-', $grantedform));
           $date_string2= strtotime(str_replace('/', '-', $grantedto));
           $data['grantedform'] =date("Y-m-d",$date_string1); 
           $data['grantedto'] =date("Y-m-d",$date_string2);
                    $data['student_id']=$student_id; 
                     $verify_data = array(	
                        'student_id' => $student_id ,
                         'class_id' => $class_id,
                        'exam_id' => $exam_id ,
                        'year' => $year
                            );                                  
                        $query = $this->db->get_where('admit_card' , $verify_data);
                    $existrow = $query->num_rows() ; 
                    
                    
                    if($existrow>0){
                        
                        
                        $this->db->where($verify_data);
                        $this->db->update('admit_card', $data);
                        
                    }else{
   
              $this->db->insert('admit_card' , $data);
                         }
                  
                     
                     
                     
                     
                 }
                 
                 
                 
               
        }
        $page_data['page_info'] = translate('Manage Admit Card');
        $page_data['page_name'] = 'admitcard';
        $page_data['page_title'] = translate('Manage Admit Card');
        $this->load->view('index', $page_data);
    }
    
    	function admit_card_print($param1 = '', $param2 = '', $param3 = '') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
         if ($param1 == 'do_update') {
          
           $date_string= strtotime(str_replace('/', '-', $this->input->post('granted_form')));
           $data['grantedform'] =date("Y-m-d",$date_string); 
           
           $date_string2= strtotime(str_replace('/', '-', $this->input->post('granted_to')));
           $data['grantedto'] =date("Y-m-d",$date_string2);

            $this->db->where('admit_id', $param2);
            $this->db->update('admit_card', $data);
            redirect(site_url('modal/popup/edit_admitcard/'.$param2));
        }  
        

           if ($param1 == 'delete') {
            $this->db->where('admit_id', $param2);
            $this->db->delete('admit_card');
            $page_data['class_id'] =$param3;
            $page_data['year']=2015;
        }
                if ($this->input->post('operation') == 'selection') 
		{
            $page_data['class_id'] = $this->input->post('class_id');
			$page_data['group_id'] = $this->input->post('group_id');
			$page_data['exam_id']=$this->input->post('exam_id');
                        $page_data['year']=$this->input->post('year');
        }
        $page_data['examlist'] = $this->db->get('exam')->result_array();
        $page_data['page_info'] = translate('Admit Card Print');
        $page_data['page_name'] = 'admitcard';
        $page_data['page_title'] = translate('Admit Card Print');
        $this->load->view('admin/admitcard_print', $page_data);
        }
        
        function view_admit_card($param1 = '') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_title'] = translate('Admit Card');
        if ($this->input->post('operation') == 'printall')
		{
        $data = $this->input->post('admitcard');
          $page_data['print_all'] ="yes"; 
          $page_data['all_admitid'] =$data;
          $this->load->view('admin/view_admit_card', $page_data);
          //pdf crate
         /* $html = $this->output->get_output();
		  echo $html;*/
         /* $filename="admitcard";
          $this->pdf_create($html,$filename,FALSE,'a4');*/
          // end of pdf
        }else{
           $page_data['print_all'] ="no";
           $page_data['admit_id'] =$param1; 
           $page_data['admitsinfo'] = $this->db->get_where('admit_card', array('admit_id' => $param1))->result_array(); 
           $this->load->view('admin/view_admit_card', $page_data);
             }
        
        }
function pdf_create($html, $filename='',$stream=FALSE,$size)
      {
    
           $this->load->library('dompdf_gen');
           $this->dompdf->load_html($html);

           $this->dompdf->set_paper($size);
           $this->dompdf->render();
           if ($stream) {
            $this->dompdf->stream($filename.".pdf");
                } else {
            $this->dompdf->stream($filename.".pdf",array('Attachment'=>0));             
                       }   
           }        
        
function testimonial(){
     if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') 
		{
            $page_data['class_id'] = $this->input->post('class_id');
			$page_data['group_id'] = $this->input->post('group_id');
        }
		 if ($this->input->post('operation') == 'update') 
		{
            $class_id = $this->input->post('class_id');
            $data['class_id']=$class_id;
            $data['Date']=date("Y-m-d");
			$testimonial = $this->input->post('testimonial');
			foreach($testimonial as $student_id)
			{
				$testimonialinfo = $this->input->post('testimonialinfo'.$student_id);
				$data['student_id'] = $student_id;
				$data['testimonial_info'] = $testimonialinfo;
				if(strlen(trim($testimonialinfo))){
					$this->db->insert('testimonial' , $data);
				}

			}
               
        }
        $page_data['page_info'] = translate('Manage Testimonial');
        $page_data['page_name'] = 'testimonial';
        $page_data['page_title'] = translate('Manage Testimonial');
        $this->load->view('index', $page_data);
    
          }
          
   function testimonial_print($param1 = '', $param2 = '', $param3 = '') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
         if ($param1 == 'do_update') {
           $data['testimonial_info'] =$this->input->post('testimonialinfo');
            $this->db->where('testimonial_id', $param2);
            $this->db->update('testimonial', $data);
            redirect(site_url('modal/popup/edit_testimonial/'.$param2));
        }  
        

           if ($param1 == 'delete') {
            $this->db->where('testimonial_id', $param2);
            $this->db->delete('testimonial');
            $page_data['class_id'] =$param3;
           // redirect(base_url() . 'index.php?admin/testimonial_print', 'refresh');
        }
                if ($this->input->post('operation') == 'selection') 
		{
                        $page_data['class_id'] = $this->input->post('class_id');
			$page_data['group_id'] = $this->input->post('group_id');
        }
        $page_data['examlist'] = $this->db->get('exam')->result_array();
        $page_data['page_info'] = translate('testimonial Print');
        $page_data['page_name'] = 'testimonial_print';
        $page_data['page_title'] = translate('testimonial Print');
        $this->load->view('index', $page_data);
        }
        
        function view_testimonial($param1 = '') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'printall'){
            
        $data = $this->input->post('testimonial');
          $page_data['print_all'] ="yes"; 
          $page_data['all_testimonial'] =$data;
        }else{
           $page_data['print_all'] ="no";
           $page_data['admit_id'] =$param1; 
           $page_data['testimonialinfo'] = $this->db->get_where('testimonial', array('testimonial_id' => $param1))->result_array(); 
           
             }
		$this->load->view('admin/view_testimonial', $page_data);
        }
        
        function transfar_certificate() 
        {
      if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') 
		{
                        $page_data['class_id'] = $this->input->post('class_id');
			$page_data['group_id'] = $this->input->post('group_id');
        }
		 if ($this->input->post('operation') == 'update') 
		{
                        $class_id = $this->input->post('class_id');
                        $data['class_id']=$class_id;
                        $data['TC_date']=date("Y-m-d");
                     
                 $TC = $this->input->post('TC'); 
                 foreach($TC as $student_id){
            $data['student_id']=$student_id;         
            $data['admitted_class']=$this->input->post('admitted_class'.$student_id); 
            $last_day_attends=$this->input->post('last_day_attends'.$student_id);
            $date_string= strtotime(str_replace('/', '-', $last_day_attends));
           $data['last_day_attends'] =date("Y-m-d",$date_string); 
            $data['result']=$this->input->post('result_'.$student_id);
            $data['obserbation']=$this->input->post('obserbation_'.$student_id);
            $leavingdate=$this->input->post('leavingdate_'.$student_id);
            $date_string1= strtotime(str_replace('/', '-', $leavingdate));
           $data['leavingdate'] =date("Y-m-d",$date_string1);
            
               if (strlen(trim($data['admitted_class']))&& strlen(trim($data['result']))){
                $this->db->insert('transfer_certificate' , $data); 
                                                  }
   
                 }
                 
                 
                 
               
        }
        $page_data['page_info'] = translate('Manage TC');
        $page_data['page_name'] = 'transfar_certificate';
        $page_data['page_title'] = translate('Manage TC');
        $this->load->view('index', $page_data);
           
    }
    
    function transfar_certificate_print($param1 = '', $param2 = '', $param3 = '') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
         if ($param1 == 'do_update') {
           $data['admitted_class'] =$this->input->post('admitted_class');
            $last_day_attends=$this->input->post('last_day_attends');
            $date_string= strtotime(str_replace('/', '-', $last_day_attends));
            $data['last_day_attends'] =date("Y-m-d",$date_string); 
            $data['result'] =$this->input->post('result');
            $data['obserbation'] =$this->input->post('obserbation');
            $leavingdate=$this->input->post('leavingdate');
            $date_string1= strtotime(str_replace('/', '-', $leavingdate));
            $data['leavingdate'] =date("Y-m-d",$date_string1);
            
            $this->db->where('tc_id', $param2);
            $this->db->update('transfer_certificate', $data);
            redirect(site_url('modal/popup/edit_TC/'.$param2));
        }  
        

           if ($param1 == 'delete') {
            $this->db->where('tc_id', $param2);
            $this->db->delete('transfer_certificate');
            $page_data['class_id'] =$param3;
        }
                if ($this->input->post('operation') == 'selection') 
		{
                        $page_data['class_id'] = $this->input->post('class_id');
			$page_data['group_id'] = $this->input->post('group_id');
        }
        $page_data['examlist'] = $this->db->get('exam')->result_array();
        $page_data['page_info'] = translate('testimonial Print');
        $page_data['page_name'] = 'testimonial_print';
        $page_data['page_title'] = translate('testimonial Print');
        $this->load->view('admin/transfar_certificate_print', $page_data);
        }
        
        function view_transfar_certificate($param1 = '') 
	{
        
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'printall'){
            
        $data = $this->input->post('TC');
          $page_data['print_all'] ="yes"; 
          $page_data['all_tcinfo'] =$data;
          $this->load->view('admin/view_transfar_certificate', $page_data);
        }else{
           $page_data['print_all'] ="no";
           $page_data['admit_id'] =$param1; 
           $page_data['tcinfo'] = $this->db->get_where('transfer_certificate', array('tc_id' => $param1))->result_array(); 
           $this->load->view('admin/view_transfar_certificate', $page_data);
             }
        
        }
        
        function teglist(){
         if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');    
        $page_data['page_info'] = translate('teg List');
        $page_data['page_title'] = translate('teg List');
        $page_data['teglistinfo'] =$this->db->list_fields('student');
        $this->load->view('admin/teglist', $page_data);
        }
		function new_nav(){
         if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');    
        $page_data['page_info'] = translate('new_nav');
        $page_data['page_title'] = translate('new_nav');
        $this->load->view('admin/home', $page_data);
        }
		function add_bank_account()
		{
			if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
			$output=$this->gc
			->set_table('bank_account')
			->set_theme('school')
			->set_subject(translate('bank_account'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('bank_account');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
		function bank_deposit()
		{
			if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
			$output=$this->gc
			->set_table('bank_deposit')
			->set_theme('school')
			->set_relation('bank_account_id','bank_account','account_number')
			->set_subject(translate('bank_deposit'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('bank_deposit');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
		function bank_expense()
		{
			if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
			$output=$this->gc
			->set_table('bank_expense')
			->set_theme('school')
			->set_relation('bank_account_id','bank_account','account_number')
			->set_subject(translate('withdraw'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('withdraw');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
		function check_statement($param1='')
		{
			if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
			if($param1=='show')
			{
				$page_data['bank_account_id']=$this->input->post('bank_account_id');
				$page_data['date_from']=$this->input->post('date_from');
				$page_data['date_to']=$this->input->post('date_to');
			}
	        $page_data['page_name'] = 'check_statement';
	        $page_data['page_title'] = translate('check_statement');
	        $this->load->view('index', $page_data);
		}
		function mark_mange($class_id='')
		{
			if(!$class_id)
			return;
			$output=$this->gc
			->set_table('mark')
			->where('mark.class_id',$class_id)
			->where('mark.exam_id','13')
			->set_theme('flexigrid')
			->set_relation('class_id','class','name')
			->set_relation('subject_id','subject','name')
			->set_relation('student_id','student','name')
			->set_relation('exam_id','exam','name')
			->set_relation('sub_exam_id','exam','name')
			->set_subject(translate('mark_input'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('mark_input');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
		function balance_sheet($param1='',$param2='')
		{
			if($param1=='show')
			{
				$page_data['date_from']=$this->input->post('date_from');
				$page_data['date_to']=$this->input->post('date_to');
			}
			$page_data['page_name'] = 'balance_sheet';
	        $page_data['page_title'] = translate('balance_sheet');
	        $this->load->view('index', $page_data);
		}
		function class_section()
		{
			$output=$this->gc
			->set_table('class_section')
			->set_subject(translate('class_section'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('class_section');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
		function academic_year()
		{
			$output=$this->gc
			->set_table('academic_year')
			->set_subject(translate('academic_year'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('academic_year');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
		function designation()
		{
			$output=$this->gc
			->set_table('designation')
			->set_subject(translate('designation'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('designation');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
		function committee()
		{
			$output=$this->gc
			->set_table('designation')
			->set_subject(translate('designation'))
			->unset_read()
			->render();
	        $page_data['page_name'] = 'output';
	        $page_data['page_title'] = translate('designation');
			$page_data['crud']=$output;
	        $this->load->view('index', $page_data);
		}
}