<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function required() {
    $CI = & get_instance();


    $CI->load->library('Ion_auth');
    $CI->load->library('session');
    $CI->load->library('form_validation');
    $CI->load->library('upload');

    // $CI->load->config('paypal');


    $RTR = & load_class('Router');

    $CI->settings = $CI->db->get('settings')->row();

    if ($RTR->class != "frontend" && $RTR->class != "auth"  && $RTR->class != "api" && $RTR->class != "remainder") {
        if (!$CI->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }

    if ($RTR->class != "frontend" && $RTR->class != "auth" && $RTR->class != "api") {
        $CI->language = $CI->db->get('settings')->row()->language;
        $CI->lang->load('system_syntax', $CI->language);
    }

    if ($CI->settings->emailtype == 'Domain Email') {
    //    echo 'df';
        $CI->load->library('email');
    }
    if ($CI->settings->emailtype == 'Smtp') {

        // $this->smtpCredentials($mailprovider);
        $email_Settings = $CI->db->get_where('email_settings', array('type' => $CI->settings->emailtype))->row();
        // print_r($emailSettings);
        $config['protocol'] = 'smtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = $email_Settings->smtp_host;
        $config['smtp_port'] = number_format($email_Settings->smtp_port);
        $config['smtp_user'] = $email_Settings->user;
        $config['smtp_pass'] = base64_decode($email_Settings->password);
        $config['smtp_crypto'] = 'tls';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['send_multipart'] = TRUE;
        $config['newline'] = "\r\n";
        $CI->load->library('email');
        $CI->email->initialize($config);
        $CI->load->library('email');
    }
    $CI->language = $CI->db->get('settings')->row()->language;
    $CI->lang->load('system_syntax', $CI->language);
    $settings = $CI->db->get('settings')->row();
    $CI->currency = $settings->currency;
    $CI->load->model('home/home_model');
    $CI->load->model('settings/settings_model');
    $CI->load->model('sms/sms_model');
    $CI->load->model('email/email_model');
    $CI->load->model('logs/logs_model');
    $CI->load->model('ion_auth_model');
    $CI->load->library('parser');
    $CI->load->helper('security');
}
