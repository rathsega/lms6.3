<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date    : 3 November, 2019
*  Academy
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Feedback extends CI_Controller
{

    protected $unique_identifier = "certificate";
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        /*ADDON SPECIFIC MODELS*/
        $this->load->model('crud_model');

    }

    
    function feedback($course_id = "", $user_id = ""){
        if($user_id == ""){
            $user_id = $this->session->userdata('user_id');
        }

        $existed_feedback = $this->crud_model->getUserFeedback($user_id, $course_id);
        $criterias = $this->db->get('criterias')->row_array();

        $response['html'] = [
            'elem' => '#feedback-content',
            'content' => $this->load->view('lessons/feedback', ['course_id' => $course_id, 'existed_feedback'=>$existed_feedback, 'criterias'=>$criterias], true)
        ];

        echo json_encode($response);
    }


}
