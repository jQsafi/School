<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$this->load->library('grocery_crud');
		$this->gc = new grocery_CRUD();
		$this->gc->unset_print()->unset_add()->unset_edit()->unset_delete();
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('student_dashboard');
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE TEACHERS**** */

    function teacher($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
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
			->unset_read()
			->callback_column('photo',function($value)
			{
				if(!$value)
				return '<img src="'.base_url().'template/images/icons_big/teacher.png"/>';
				return "<img src=".base_url('uploads/teacher_image/'.$value)." height='60px' width='60px'>";
			})
			->add_action('View Profile', '', '','new_window',function($pk)
			{
				return site_url('modal/popup/teacher_profile/'.$pk);
			})
			->render();
        $page_data['teachers'] = $this->db->order_by('order')->get('teacher')->result_array();
		$page_data['output'] = $output;
        $page_data['page_name'] = 'teacher';
        $page_data['page_title'] = translate('teacher')." & ".translate('staff');
        $this->load->view('index', $page_data);
    }
    /*     * ******************************************************************************************************** */



    /*     * **MANAGE SUBJECTS**** */

    function subject($param1 = '', $param2 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $student_profile = $this->db->get_where('student', array(
                    'student_id' => $this->session->userdata('student_id')
                ))->row();
        $student_class_id = $student_profile->class_id;
        $page_data['subjects'] = $this->db->get_where('subject', array(
                    'class_id' => $student_class_id
                ))->result_array();
        $page_data['page_name'] = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE EXAM MARKS**** */

    function marks($exam_id = '', $class_id = '', $subject_id = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $student_profile = $this->db->get_where('student', array(
                    'student_id' => $this->session->userdata('student_id')
                ))->row();
        $page_data['class_id'] = $student_profile->class_id;

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id'] = $this->input->post('exam_id');
            //$page_data['class_id']	=	$this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');

            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'index.php?student/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?student/marks/', 'refresh');
            }
        }
        $page_data['exam_id'] = $exam_id;
        //$page_data['class_id']	=	$class_id;
        $page_data['subject_id'] = $subject_id;

        $page_data['page_info'] = 'Exam marks';

        $page_data['page_name'] = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('index', $page_data);
    }
	function result() 
	{
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		$page_data['current_student_id']=$this->session->userdata('student_id');
        $student_class_id = $student_profile->class_id;
        $page_data['page_name'] = 'result';
        $page_data['page_title'] = get_phrase('academic_result');
        $this->load->view('index', $page_data);
    }
    /*     * ********MANAGING CLASS ROUTINE***************** */
    function class_routine($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $student_profile = $this->db->get_where('student', array(
                    'student_id' => $this->session->userdata('student_id')
                ))->row();
        $page_data['class_id'] = $student_profile->class_id;
        $page_data['page_name'] = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('index', $page_data);
    }
	 function progress_card($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
			$student_profile = $this->db->get_where('student', array(
                    'student_id' => $this->session->userdata('student_id')
                ))->row();
			$output=$this->gc
			->set_table('exam_result')
			->where('exam_result.class_id',$student_profile->class_id)
			->where('exam_result.student_id',$student_profile->student_id)
			->set_theme('datatables')
			->set_relation('class_id','class','name')
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

    /*     * ****MANAGE BILLING / INVOICES WITH STATUS**** */

    function invoice($param1 = '', $param2 = '', $param3 = '') {
        //if($this->session->userdata('student_login')!=1)redirect(base_url() , 'refresh');
        if ($param1 == 'make_payment') {
            $invoice_id = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array(
                        'type' => 'paypal_email'
                    ))->row();
            $invoice_details = $this->db->get_where('invoice', array(
                        'invoice_id' => $invoice_id
                    ))->row();

            /*             * **TRANSFERRING USER TO PAYPAL TERMINAL*** */
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', base_url() . 'index.php?student/invoice/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url() . 'index.php?student/invoice/paypal_cancel');
            $this->paypal->add_field('return', base_url() . 'index.php?student/invoice/paypal_success');

            $this->paypal->submit_paypal_post();
            // submit the fields to paypal
        }
        if ($param1 == 'paypal_ipn') {
            if ($this->paypal->validate_ipn() == true) {
                $ipn_response = '';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $ipn_response .= "\n$key=$value";
                }
                $data['payment_details'] = $ipn_response;
                $data['payment_timestamp'] = strtotime(date("m/d/Y"));
                $data['payment_method'] = 'paypal';
                $data['status'] = 'paid';
                $invoice_id = $_POST['custom'];
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', $data);
            }
        }
        if ($param1 == 'paypal_cancel') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_cancelled'));
            redirect(base_url() . 'index.php?student/invoice/', 'refresh');
        }
        if ($param1 == 'paypal_success') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?student/invoice/', 'refresh');
        }
        $student_profile = $this->db->get_where('student', array(
                    'student_id' => $this->session->userdata('student_id')
                ))->row();
        $student_id = $student_profile->student_id;
        $page_data['invoices'] = $this->db->get_where('invoice', array(
                    'student_id' => $student_id
                ))->result_array();
        $page_data['page_name'] = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE LIBRARY / BOOKS******************* */

    function book($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['books'] = $this->db->get('book')->result_array();
        $page_data['page_name'] = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE TRANSPORT / VEHICLES / ROUTES******************* */

    function transport($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name'] = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE DORMITORY / HOSTELS / ROOMS ******************* */

    function dormitory($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name'] = 'dormitory';
        $page_data['page_title'] = get_phrase('manage_dormitory');
        $this->load->view('index', $page_data);
    }

    /*     * ********WATCH NOTICEBOARD AND EVENT ******************* */

    function noticeboard($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['notices'] = $this->db->get('noticeboard')->result_array();
        $page_data['page_name'] = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL****************** */

    function document($do = '', $document_id = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_name'] = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents'] = $this->db->get('document')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['religion'] = $this->input->post('religion');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');

            $this->db->where('student_id', $this->session->userdata('student_id'));
            $this->db->update('student', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = $this->input->post('password');
            $data['new_password'] = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');

            $current_password = $this->db->get_where('student', array(
                        'student_id' => $this->session->userdata('student_id')
                    ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('student_id', $this->session->userdata('student_id'));
                $this->db->update('student', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('student', array(
                    'student_id' => $this->session->userdata('student_id')
                ))->result_array();
        $this->load->view('index', $page_data);
    }

}
