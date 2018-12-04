<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('logged')) {
            redirect(base_url('dash'));
        }
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }
}