<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidateEnrolments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
    }


    public function index()
    {
        $Crud_model = $this->load->model('Crud_model');
        var_dump($this->Crud_model->deleteExpiredEnrolments());
    }
    

}
