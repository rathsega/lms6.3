<?php
class Job_model extends CI_Model
{

    protected $table = 'jobs';

    public function __construct()
    {
        $this->load->database();
    }

    public function get_jobs($id = FALSE)
    {
        if ($id === FALSE) {
            $this->db->order_by("id", "desc");
            $query = $this->db->get('jobs');
            return $query->result_array();
        }

        
        $query = $this->db->get_where('jobs', array('id' => $id));
        return $query->row_array();
    }

    public function add_job($data)
    {
        $this->db->insert('jobs', $data);
        return $this->db->insert_id();
    }

    public function update_job($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('jobs', $data);
    }

    public function delete_job($id)
    {
        return $this->db->delete('jobs', array('id' => $id));
    }

    // Fetch distinct values for filters
    public function get_filter_options()
    {
        $this->db->distinct();
        $this->db->select('work_mode, location, min_experience, max_experience, min_pay_scale, max_pay_scale, required_skills');
        $query = $this->db->get('jobs');
        return $query->result();
    }

    // Fetch jobs based on filters
    public function get_flitered_jobs($filters, $page, $records)
    {
        if (!empty($filters['work_mode'])) {
            $this->db->where('work_mode', $filters['work_mode']);
        }
        if (!empty($filters['location'])) {
            $this->db->where('location', $filters['location']);
        }
        if (!empty($filters['experience'])) {
            $this->db->where('experience >=', $filters['experience']['min']);
            $this->db->where('experience <=', $filters['experience']['max']);
        }
        if (!empty($filters['salary'])) {
            $this->db->where('min_pay_scale >=', $filters['salary']['min']);
            $this->db->where('max_pay_scale <=', $filters['salary']['max']);
        }
        if (!empty($filters['skills'])) {
            $this->db->like('required_skills', $filters['skills']);
        }

        $this->db->limit($page * 10);
        $query = $this->db->get('jobs');
        return $query->result();
    }

    public function findAll()
    {
        $query = $this->db->get('jobs');
        return $query->result_array();
    }

    public function get_experience_options()
    {
        $this->db->distinct();
        $this->db->select('min_experience, max_experience');
        $this->db->from('jobs');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_location_options()
    {
        $this->db->distinct();
        $this->db->select('location');
        $this->db->from('jobs');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getInitialJobs($criteria, $limit, $offset)
    {
        $this->db->from('jobs');
        $this->apply_search_criteria($criteria);
        $this->db->where('status', 1);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    private function apply_search_criteria($criteria)
    {
        if (!empty($criteria['query'])) {
            $this->db->group_start();
            $this->db->like('title', $criteria['query']);
            $this->db->or_like('company_name', $criteria['query']);
            $this->db->or_like('required_skills', $criteria['query']);
            $this->db->group_end();
        }
        if (!empty($criteria['experience'])) {
            $this->db->where('min_experience <=', $criteria['experience']);
            $this->db->where('max_experience >=', $criteria['experience']);
        }
        if (!empty($criteria['location'])) {
            $this->db->like('location', $criteria['location']);
        }
    }

    public function getPaginatedJobs($page = 1, $perPage = 10, $filters = [])
    {
        $offset = ((int)$page - 1) * $perPage;
        $this->db->order_by('created_at', 'DESC')->limit($perPage, $offset);

        if (isset($filters['work_mode'])) {
            $this->db->where_in('work_mode', explode(',', $filters['work_mode']));
        }

        if (isset($filters['experience'])) {
            $this->db->group_start();
            foreach (explode(',', $filters['experience']) as $experience) {
                $this->db->or_where("FIND_IN_SET('{$experience}', experience) >", 0);
            }
            $this->db->group_end();
        }

        if (isset($filters['location'])) {
            $this->db->where_in('location', explode(',', $filters['location']));
        }

        if (isset($filters['pay_scale'])) {
            $this->db->group_start();
            foreach (explode(',', $filters['pay_scale']) as $payScale) {
                $this->db->or_where("FIND_IN_SET('{$payScale}', pay_scale) >", 0);
            }
            $this->db->group_end();
        }

        $query = $this->db->get('jobs');
        return $query->result();
    }

    public function find($id)
    {
        $query = $this->db->get_where('jobs', ['id' => $id]);
        return $query->row_array();
    }

    public function getUniqueWorkModes()
    {
        $this->db->select('work_mode, count(id) as count');
        $this->db->group_by('work_mode');
        $query = $this->db->get('jobs');
        return $query->result_array();
    }

    public function getUniqueExperiences()
    {
        $this->db->select('MIN(min_experience) as min_experience, MAX(max_experience) as max_experience');
        $query = $this->db->get('jobs');
        return $query->row_array();
    }

    public function getUniqueLocations()
    {
        $this->db->select('location, count(id) as count');
        $this->db->group_by('location');
        $query = $this->db->get('jobs');
        return $query->result_array();
    }

    public function getUniquePayScales()
    {
        $this->db->select('MIN(min_pay_scale) as min_pay_scale, MAX(max_pay_scale) as max_pay_scale');
        $query = $this->db->get('jobs');
        return $query->row_array();
    }

    public function getJobsCount()
    {
        $this->db->select('count(id) as job_count');
        $query = $this->db->get('jobs');
        return $query->row()->job_count;
    }

    public function getJobTitle($id)
    {
        $this->db->select('title');
        $query = $this->db->get_where('jobs', ['id' => $id]);
        return $query->row_array();
    }

    public function applyJob($data)
    {
        $this->db->insert('applied_jobs', $data);
        return $this->db->insert_id();
    }

    public function get_all_applied_jobs()
    {
        $this->db->select('applied_jobs.id, applied_jobs.name, applied_jobs.email, applied_jobs.phone, applied_jobs.resume, applied_jobs.created_at, jobs.title as job_title');
        $this->db->from('applied_jobs');
        $this->db->join('jobs', 'applied_jobs.job_id = jobs.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function toggle_status($job_id, $data){
        $this->db->where('id', $job_id);
        return $this->db->update('jobs', $data);
    }

    public function getLatestThreeJobs(){
        $this->db->where('status', 1);
        $this->db->order_by("id", "desc");
        $this->db->limit(3);
        $query = $this->db->get('jobs');
        return $query->result_array();
    }
}
