<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Job_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function getAllJobs()
    {
        $jobs = $this->Job_model->findAll();
        echo json_encode($jobs);
    }

    public function getPaginatedJobs($page = 1, $limit = 10)
    {
        $filters = [
            'work_mode' => $this->input->get('work_mode'),
            'experience' => $this->input->get('experience'),
            'location' => $this->input->get('location'),
            'pay_scale' => $this->input->get('pay_scale'),
        ];

        $filters = array_filter($filters, function ($value) {
            return $value !== null && $value !== '';
        });

        $jobs = $this->Job_model->getPaginatedJobs($page, $limit, $filters);
        echo json_encode($jobs);
    }

    public function show($id = null)
    {
        $job = $this->Job_model->find($id);
        if (!$job) {
            show_404();
        }
        echo json_encode($job);
    }    

    public function create()
    {
        $data = $this->input->post();
        if ($this->Job_model->insert($data)) {
            echo json_encode($this->Job_model->find($this->db->insert_id()));
        } else {
            show_error('Failed to create job.', 500);
        }
    }

    public function update($id = null)
    {
        $data = $this->input->input_stream();
        $job = $this->Job_model->find($id);
        if (!$job) {
            show_404();
        }
        $this->Job_model->update($id, $data);
        echo json_encode($this->Job_model->find($id));
    }

    public function delete($id = null)
    {
        $job = $this->Job_model->find($id);
        if (!$job) {
            show_404();
        }
        $this->Job_model->delete($id);
        echo json_encode(['id' => $id]);
    }

    public function apply()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [
            'name' => $input['apply_job_name'],
            'email' => $input['apply_job_email'],
            'phone' => $input['apply_job_phone'],
            'resume' => basename($input['resume_file']),
            'job_id' => $input['job_id']
        ];

        $this->load->model('AppliedJob_model');
        $this->AppliedJob_model->insert($data);
        echo json_encode(["message" => "Application Submitted Successfully."]);
    }

    public function getFilterData()
    {
        $workModes = $this->Job_model->getUniqueWorkModes();
        $experiences = $this->Job_model->getUniqueExperiences();
        $locations = $this->Job_model->getUniqueLocations();
        $payScales = $this->Job_model->getUniquePayScales();

        echo json_encode([
            'work_modes' => $workModes,
            'experiences' => $experiences,
            'locations' => $locations,
            'pay_scales' => $payScales
        ]);
    }

    public function getJobsCount()
    {
        $count = $this->Job_model->getJobsCount();
        echo json_encode(["count" => $count]);
    }

    /*public function getJobsByUsingFilters() {
        $input = json_decode(file_get_contents('php://input'), true);

        $filters = [
            'work_mode' => $input['work_mode'],
            'experience' => $input['experience'],
            'location' => $input['location'],
            'pay_scale' => $input['pay_scale']
        ];

        $jobs = $this->Job_model->getPaginatedJobs($input['page'], $input['limit'], $filters);
        echo json_encode($jobs);
    }*/
    function getJobsByUsingFilters()
    {

        $input = json_decode(file_get_contents('php://input'), true);

        // Get filter parameters from the request
        $work_mode = (string)$input['work_mode'];
        $experience = (string)$input['experience'];
        $location = (string)$input['location'];
        $pay_scale = (string)$input['pay_scale'];
        $perPage = $input['limit'];
        $page = $input['page'];
        
        // Load the model
        $this->load->model('Job_model');
        
        // Initialize the query builder for total count
        $this->db->select('id')->from('jobs');
        
        // Apply filters for total count
        if ($work_mode) {
            $work_modes = explode(',', $work_mode);
            $this->db->where_in('work_mode', $work_modes);
        }
        
        if ($experience) {
            $experience_ranges = explode(',', $experience);
            $this->db->group_start();
            foreach ($experience_ranges as $range) {
                list($min_exp, $max_exp) = explode('-', $range);
                $this->db->or_group_start()
                    ->where('min_experience <=', $max_exp)
                    ->where('max_experience >=', $min_exp)
                    ->group_end();
            }
            $this->db->group_end();
        }
        
        if ($location) {
            $locations = explode(',', $location);
            $this->db->where_in('location', $locations);
        }
        
        if ($pay_scale) {
            $pay_scale_ranges = explode(',', $pay_scale);
            $this->db->group_start();
            foreach ($pay_scale_ranges as $range) {
                list($min_pay, $max_pay) = explode('-', $range);
                $this->db->or_group_start()
                    ->where('min_pay_scale <=', $max_pay)
                    ->where('max_pay_scale >=', $min_pay)
                    ->group_end();
            }
            $this->db->group_end();
        }
        
        // Get total count
        $total_count = $this->db->count_all_results();
        
        // Initialize the query builder for paginated results
        $this->db->select('*')->from('jobs');
        
        // Apply filters for paginated results
        if ($work_mode) {
            $work_modes = explode(',', $work_mode);
            $this->db->where_in('work_mode', $work_modes);
        }
        
        if ($experience) {
            $experience_ranges = explode(',', $experience);
            $this->db->group_start();
            foreach ($experience_ranges as $range) {
                list($min_exp, $max_exp) = explode('-', $range);
                $this->db->or_group_start()
                    ->where('min_experience <=', $max_exp)
                    ->where('max_experience >=', $min_exp)
                    ->group_end();
            }
            $this->db->group_end();
        }
        
        if ($location) {
            $locations = explode(',', $location);
            $this->db->where_in('location', $locations);
        }
        
        if ($pay_scale) {
            $pay_scale_ranges = explode(',', $pay_scale);
            $this->db->group_start();
            foreach ($pay_scale_ranges as $range) {
                list($min_pay, $max_pay) = explode('-', $range);
                $this->db->or_group_start()
                    ->where('min_pay_scale <=', $max_pay)
                    ->where('max_pay_scale >=', $min_pay)
                    ->group_end();
            }
            $this->db->group_end();
        }
        
        // Pagination
        $offset = ($page - 1) * $perPage;
        $this->db->order_by('created_at', 'DESC')
            ->limit($perPage, $offset);
        
        $query = $this->db->get();
        $jobs = $query->result_array();
        
        // Prepare the response
        $response = [
            'total_count' => $total_count,
            'jobs' => $jobs
        ];
        
        echo json_encode($response);
        
    }

    public function toggle_status(){
        $this->load->library('session');
        $this->load->model('Job_model');
        $job_id = $_POST['job_id'];
        $status = $_POST['status'];
        $data = array('status'=>!$status);
        $updated = $this->Job_model->toggle_status($job_id, $data);

        // $this->session->set_flashdata('flash_message', get_phrase('Status updated successfully.'));
    }

}
