<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller
{

    public function index()
    {
        if (!$this->session->userdata('logged')) {
            redirect(base_url('home'));
        }
        $this->load->view('header');
        $this->load->view('logs');
        $this->load->view('footer');
    }

    public function show()
    {
        if (!$this->session->userdata('logged')) {
            redirect(base_url('home'));
        }
        $this->load->view('header');
        $this->load->view('logs-show');
        $this->load->view('footer');
    }
}