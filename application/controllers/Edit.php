<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller
{

    public function index()
    {
        if (!$this->session->userdata('logged')) {
            redirect(base_url('home'));
        }
        if (empty($this->uri->segment(2))) {
            redirect(base_url('dash'));
        }
        if (!file_exists('/home/TS3AudioBot-FREE/config/'.$this->uri->segment(2).'.cfg')) {
            redirect(base_url('dash'));
        }
        $this->load->view('header');
        $this->load->view('edit');
        $this->load->view('footer');
    }
}