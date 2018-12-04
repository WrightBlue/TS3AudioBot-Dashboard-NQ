<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller
{

    public function index()
    {
        if (!$this->session->userdata('logged')) {
            redirect(base_url('home'));
        }
        $this->load->view('header');
        $this->load->view('dash');
        $this->load->view('footer');
    }
}