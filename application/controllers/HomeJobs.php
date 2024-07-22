<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeJobs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Job_model');
        $this->load->library('pagination');
    }

    public function getAllJobs() {
        $search_criteria = array(
            'query' => $this->input->get('query'),
            'experience' => $this->input->get('experience'),
            'location' => $this->input->get('location'),
            'work_mode' => $this->input->get('work_mode'),
            'experience_level' => $this->input->get('experience_level'),
            'salary_range' => $this->input->get('salary_range'),
            'location_checkboxes' => $this->input->get('location_checkboxes')
        );

        // Pagination configuration
        $config['base_url'] = base_url('jobs/index');
        $config['total_rows'] = $this->Job_model->get_jobs_count($search_criteria);
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $page = $this->input->get('per_page');
        $data['jobs'] = $this->Job_model->get_jobs($search_criteria, $config['per_page'], $page);

        $this->load->view('jobs_list', $data);
    }

    public function filter_jobs() {
        $search_criteria = array(
            'work_mode' => $this->input->post('work_mode'),
            'experience_level' => $this->input->post('experience_level'),
            'salary_range' => $this->input->post('salary_range'),
            'location_checkboxes' => $this->input->post('location_checkboxes')
        );

        $data['jobs'] = $this->Job_model->get_filtered_jobs($search_criteria);

        $this->load->view('jobs_list_partial', $data);
    }
}
