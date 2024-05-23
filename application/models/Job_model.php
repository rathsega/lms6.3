<?php
class Job_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_jobs($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('jobs');
            return $query->result_array();
        }

        $query = $this->db->get_where('jobs', array('id' => $id));
        return $query->row_array();
    }

    public function add_job($data) {
        $this->db->insert('jobs', $data);
        return $this->db->insert_id();
    }

    public function update_job($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('jobs', $data);
    }

    public function delete_job($id) {
        return $this->db->delete('jobs', array('id' => $id));
    }
}
