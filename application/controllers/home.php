<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Wemax Software Ltd.
 * 	Address	: Bagdad Shopping Complex [4th floor], Mirpur-1, Dhaka-1216, Bangladesh
 * 	http://wemaxsoftware.com/
 */

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
       if ($this->session->userdata('login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('login') == TRUE)
		{
	        $this->load->view('home');
		}
    }
}