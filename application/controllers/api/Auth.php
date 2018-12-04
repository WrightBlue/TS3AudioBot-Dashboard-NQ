<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->output->set_content_type('application/json')->set_status_header(200);
        if ($this->session->userdata('logged')) {
            return $this->output->set_output(printJson(true, $this->config->item('lang')['login_api_logged']));
        }
        if (empty($this->input->post('login')) || empty($this->input->post('password'))) {
            return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_empty']));
        }
        if ($this->input->post('login') == $this->config->item('auth')['login'] && $this->input->post('password') == $this->config->item('auth')['password']) {
            $this->session->set_userdata('logged', true);
            return $this->output->set_output(printJson(true, $this->config->item('lang')['login_api_success']));
        }
        return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_danger']));
    }
}