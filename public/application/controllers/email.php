<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('email');
}

    public function index() {
    $this->load->library('email');
            $config['protocol']='smtp';
            $config['smtp_host']='ssl://smtp.gmail.com';
            $config['smtp_port']='465';
            $config['smtp_timeout']='30';
            $config['smtp_user']='zulisk93@gmail.com';
            $config['smtp_pass']='zulf1k4r.';
            $config['charset']='utf-8';
            $config['newline']="\r\n";
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('zulisk93@gmail.com', 'Site name');
            $this->email->to('vkar93@yahoo.co.id');
            $this->email->subject('Notification Mail');
            $this->email->message('Your message');
            $this->email->send();

        echo $this->email->print_debugger();
    }
	
}

?>