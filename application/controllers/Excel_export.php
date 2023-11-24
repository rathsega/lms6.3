<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excel_export extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // $this->load->library('stripe');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // CHECK CUSTOM SESSION DATA
        $this->user_model->check_session_data();


        //CHECKING COURSE ACCESSIBILITY STATUS
        if (get_settings('course_accessibility') != 'publicly' && !$this->session->userdata('user_id')) {
            redirect(site_url('login'), 'refresh');
        }
    }

    function index()
    {
        //   $this->load->model("excel_export_model");
        //   $data["employee_data"] = $this->excel_export_model->fetch_data();
        //   $this->load->view("excel_export_view", $data);
    }

    function action()
    {

        /*$enrol_data = [];
        $enrol_data = $this->crud_model->getEnrolHistory();
        header('Content-Disposition: attachment; filename="filename.csv";');
        $f = fopen('php://output', 'w');
        // loop over the input array
        foreach ($enrol_data->result_array()  as $enrol) {
            // generate csv lines from the inner arrays
            $line = array(
                $enrol['first_name'] . " " . $enrol['last_name'],
                $enrol['email'],
                $enrol['phone'],
                $enrol['title'],
                date('Y-m-d', $enrol['date_added']),
                $enrol['expiry_date'],
                $enrol['status']
            );
            fputcsv($f, $line, ";");
        }*/

        $enrol_data = [];
        $enrol_data = $this->crud_model->getEnrolHistory();

        // File Name & Content Header For Download
        $file_name = "enrolments_data.xls";
        header("Content-Disposition: attachment; filename=\"$file_name\"");
        header("Content-Type: application/vnd.ms-excel");

        //To define column name in first row.
        $column_names = false;
        $data = [];
        foreach ($enrol_data->result_array()  as $enrol) {
            // generate csv lines from the inner arrays
            $line = [];
            $line["Name"] =  $enrol['first_name'] . " " . $enrol['last_name'];
            $line["Email"] =  $enrol['email'];
            $line["Phone"] =  $enrol['phone'];
            $line["Course"] =  $enrol['title'];
            $line["Enrol Date"] =  date('Y-m-d', $enrol['date_added']);
            $line["Expire Date"] =  $enrol['expiry_date'];
            $line["User Status"] =  $enrol['status'];
            $data[] = $line;
        }
        // run loop through each row in $customers_data
        foreach ($data  as $row) {
            if (!$column_names) {
                echo implode("\t", array_keys($row)) . "\n";
                $column_names = true;
            }
            // The array_walk() function runs each array element in a user-defined function.
            //array_walk($row, 'filterCustomerData');
            echo implode("\t", array_values($row)) . "\n";
        }
    }

    // Filter Customer Data
    function filterCustomerData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
}
