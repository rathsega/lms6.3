<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));

        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        $this->user_model->check_session_data('admin');

        ini_set('memory_limit', '128M');
    }



    public function index()
    {
        if ($this->session->userdata('admin_login') == true) {
            $this->dashboard();
        } else {
            redirect(site_url('login'), 'refresh');
        }
    }

    public function dashboard()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index.php', $page_data);
    }

    public function categories($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('category');

        if ($param1 == 'add') {

            $response = $this->crud_model->add_category();
            if ($response) {
                $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('category_name_already_exists'));
            }
            redirect(site_url('admin/categories'), 'refresh');
        } elseif ($param1 == "edit") {

            $response = $this->crud_model->edit_category($param2);
            if ($response) {
                $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('category_name_already_exists'));
            }
            redirect(site_url('admin/categories'), 'refresh');
        } elseif ($param1 == "delete") {

            $this->crud_model->delete_category($param2);
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(site_url('admin/categories'), 'refresh');
        }
        $page_data['page_name'] = 'categories';
        $page_data['page_title'] = get_phrase('categories');
        $page_data['categories'] = $this->crud_model->get_categories($param2);
        $this->load->view('backend/index', $page_data);
    }

    public function category_form($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('category');

        if ($param1 == "add_category") {

            $page_data['page_name'] = 'category_add';
            $page_data['categories'] = $this->crud_model->get_categories()->result_array();
            $page_data['page_title'] = get_phrase('add_category');
        }
        if ($param1 == "edit_category") {

            $page_data['page_name'] = 'category_edit';
            $page_data['page_title'] = get_phrase('edit_category');
            $page_data['categories'] = $this->crud_model->get_categories()->result_array();
            $page_data['category_id'] = $param2;
        }

        $this->load->view('backend/index', $page_data);
    }

    public function sub_categories_by_category_id($category_id = 0)
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        $category_id = $this->input->post('category_id');
        redirect(site_url("admin/sub_categories/$category_id"), 'refresh');
    }

    public function sub_category_form($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('category');

        if ($param1 == 'add_sub_category') {
            $page_data['page_name'] = 'sub_category_add';
            $page_data['page_title'] = get_phrase('add_sub_category');
        } elseif ($param1 == 'edit_sub_category') {
            $page_data['page_name'] = 'sub_category_edit';
            $page_data['page_title'] = get_phrase('edit_sub_category');
            $page_data['sub_category_id'] = $param2;
        }
        $page_data['categories'] = $this->crud_model->get_categories();
        $this->load->view('backend/index', $page_data);
    }

    public function instructors($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('user');
        check_permission('instructor');

        if ($param1 == "add") {
            $this->user_model->add_user(true); // PROVIDING TRUE FOR INSTRUCTOR
            redirect(site_url('admin/instructors'), 'refresh');
        } elseif ($param1 == "edit") {
            $this->user_model->edit_user($param2);
            redirect(site_url('admin/instructors'), 'refresh');
        } elseif ($param1 == "delete") {
            $this->user_model->delete_user($param2);
            redirect(site_url('admin/instructors'), 'refresh');
        }

        $page_data['page_name'] = 'instructors';
        $page_data['page_title'] = get_phrase('instructor');
        $this->load->view('backend/index', $page_data);
    }

    public function instructor_form($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('user');
        check_permission('instructor');

        if ($param1 == 'add_instructor_form') {
            $page_data['page_name'] = 'instructor_add';
            $page_data['page_title'] = get_phrase('instructor_add');
            $this->load->view('backend/index', $page_data);
        } elseif ($param1 == 'edit_instructor_form') {
            $page_data['page_name'] = 'instructor_edit';
            $page_data['user_id'] = $param2;
            $page_data['page_title'] = get_phrase('instructor_edit');
            $this->load->view('backend/index', $page_data);
        }
    }

    public function users($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('user');
        check_permission('student');

        if ($param1 == "add") {
            $this->user_model->add_user();
            redirect(site_url('admin/users'), 'refresh');
        } elseif ($param1 == "edit") {
            $this->user_model->edit_user($param2);
            redirect(site_url('admin/users'), 'refresh');
        } elseif ($param1 == "delete") {
            $this->user_model->delete_user($param2);
            redirect(site_url('admin/users'), 'refresh');
        }

        $page_data['page_name'] = 'users';
        $page_data['page_title'] = get_phrase('student');
        $this->load->view('backend/index', $page_data);
    }

    function server_side_users_data()
    {

        $data = array();
        //mentioned all with colum of database table that related with html table
        $columns = array('id', 'id', 'first_name', 'email', 'phone', 'id', 'id');

        $limit = htmlspecialchars_($this->input->post('length'));
        $start = htmlspecialchars_($this->input->post('start'));

        $column_index = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];
        $total_number_of_row = $this->db->where('role_id !=', 1)->get('users')->num_rows();

        $filtered_number_of_row = $total_number_of_row;
        $search = $this->input->post('search')['value'];

        if (empty($search)) {
            $this->db->select('*');
            $this->db->limit($limit, $start);
            $this->db->order_by($column_index, $dir);
            $this->db->where('role_id', 2);
            $students = $this->db->get('users')->result_array();
        } else {
            $this->db->select('*');
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone', $search);
            $this->db->where('role_id', 2);
            $this->db->limit($limit, $start);
            $this->db->order_by($column_index, $dir);
            $students = $this->db->get('users')->result_array();


            $this->db->select('*');
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone', $search);
            $this->db->where('role_id', 2);
            $filtered_number_of_row = $this->db->get('users')->num_rows();
        }

        foreach ($students as $key => $student) :

            //photo
            $photo = '<img src="' . $this->user_model->get_user_image_url($student['id']) . '" alt="" height="50" width="50" class="img-fluid rounded-circle img-thumbnail">';

            //user name
            if ($student['status'] != 1) {
                $status = '<small><p>' . get_phrase('status') . '<span class="badge badge-danger-lighten">' . get_phrase('unverified') . '</span></p></small>';
            } else {
                $status = '';
            }
            $name = $student['first_name'] . ' ' . $student['last_name'] . $status;

            //user email
            $email = $student['email'];

            //enrolled courses
            $enrolled_courses = $this->crud_model->enrol_history_by_user_id($student['id']);
            $enrolled_courses_title = '<ul>';
            foreach ($enrolled_courses->result_array() as $enrolled_course) :
                $course_details = $this->crud_model->get_course_by_id($enrolled_course['course_id'])->row_array();
                $enrolled_courses_title .= '<li>' . $course_details['title'] . '</li>';
            endforeach;
            $enrolled_courses_title .= '</ul>';


            $action = '<div class="dropright dropright">
                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . site_url('admin/user_form/edit_user_form/' . $student['id']) . '">' . get_phrase('edit') . '</a></li>
                                <li><a class="dropdown-item" href="#" onclick="confirm_modal(&#39;' . site_url('admin/users/delete/' . $student['id']) . '&#39;);">' . get_phrase('delete') . '</a></li>
                            </ul>
                        </div>';


            $nestedData['key'] = ++$key;
            $nestedData['photo'] = $photo;
            $nestedData['name'] = $name;
            $nestedData['email'] = $email;
            $nestedData['phone'] = $student['phone'];
            $nestedData['enrolled_courses'] = $enrolled_courses_title;
            $nestedData['action'] = $action . '<script>$("a, i").tooltip();</script>';
            $data[] = $nestedData;
        endforeach;

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($total_number_of_row),
            "recordsFiltered" => intval($filtered_number_of_row),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    function server_side_instructors_data()
    {

        $data = array();
        //mentioned all with colum of database table that related with html table
        $columns = array('id', 'id', 'first_name', 'email', 'phone', 'id', 'id');

        $limit = htmlspecialchars_($this->input->post('length'));
        $start = htmlspecialchars_($this->input->post('start'));

        $column_index = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];
        $total_number_of_row = $this->db->where('is_instructor', 1)->where('role_id !=', 1)->get('users')->num_rows();

        $filtered_number_of_row = $total_number_of_row;
        $search = $this->input->post('search')['value'];

        if (empty($search)) {
            $this->db->select('*');
            $this->db->limit($limit, $start);
            $this->db->order_by($column_index, $dir);
            $this->db->group_start();
            $this->db->where('role_id', 2);
            $this->db->where('is_instructor', 1);
            $this->db->group_end();
            $instructors = $this->db->get('users')->result_array();
        } else {
            $this->db->select('*');
            $this->db->group_start();
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone', $search);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('role_id', 2);
            $this->db->where('is_instructor', 1);
            $this->db->group_end();
            $this->db->limit($limit, $start);
            $this->db->order_by($column_index, $dir);
            $instructors = $this->db->get('users')->result_array();


            $this->db->select('*');
            $this->db->group_start();
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone', $search);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('role_id', 2);
            $this->db->where('is_instructor', 1);
            $this->db->group_end();
            $filtered_number_of_row = $this->db->get('users')->num_rows();
        }

        foreach ($instructors as $key => $instructor) :

            //photo
            $photo = '<img src="' . $this->user_model->get_user_image_url($instructor['id']) . '" alt="" height="50" width="50" class="img-fluid rounded-circle img-thumbnail">';

            //user name
            if ($instructor['status'] != 1) {
                $status = '<small><p>' . get_phrase('status') . '<span class="badge badge-danger-lighten">' . get_phrase('unverified') . '</span></p></small>';
            } else {
                $status = '';
            }
            $name = $instructor['first_name'] . ' ' . $instructor['last_name'] . $status;

            //user email
            $email = $instructor['email'];

            //enrolled courses
            $enrolled_courses = $this->crud_model->enrol_history_by_user_id($instructor['id']);
            $enrolled_courses_title = '<ul>';
            foreach ($enrolled_courses->result_array() as $enrolled_course) :
                $course_details = $this->crud_model->get_course_by_id($enrolled_course['course_id'])->row_array();
                $enrolled_courses_title .= '<li>' . $course_details['title'] . '</li>';
            endforeach;
            $enrolled_courses_title .= '</ul>';
            $lable = $instructor['show_in_home_page'] ? get_phrase('hide_in_home_page') : get_phrase('show_in_home_page');
            $status = $instructor['show_in_home_page'] ? $instructor['show_in_home_page'] : 0;
            $action = '<div class="dropright dropright">
                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . site_url('admin/courses?category_id=all&status=all&instructor_id=' . $instructor['id'] . '&price=all') . '">' . get_phrase('view_courses') . '</a></li>
                                <li><a class="dropdown-item" href="' . site_url('admin/instructor_form/edit_instructor_form/' . $instructor['id']) . '">' . get_phrase('edit') . '</a></li>
                                <li><a class="dropdown-item" href="' . site_url('admin/manage_instructor_visibility/' . $instructor['id'] . '/' . $status) . '">' . $lable  . '</a></li>
                                <li><a class="dropdown-item" href="#" onclick="confirm_modal(&#39;' . site_url('admin/instructors/delete/' . $instructor['id']) . '&#39;);">' . get_phrase('delete') . '</a></li>
                            </ul>
                        </div>';


            $nestedData['key'] = ++$key;
            $nestedData['photo'] = $photo;
            $nestedData['name'] = $name;
            $nestedData['email'] = $email;
            $nestedData['phone'] = $instructor['phone'];
            $nestedData['enrolled_courses'] = $enrolled_courses_title;
            $nestedData['action'] = $action . '<script>$("a, i").tooltip();</script>';
            $data[] = $nestedData;
        endforeach;

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($total_number_of_row),
            "recordsFiltered" => intval($filtered_number_of_row),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function add_shortcut_student()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('user');
        check_permission('student');

        $is_instructor = 0;
        echo $this->user_model->add_shortcut_user($is_instructor);
    }

    public function user_form($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('user');
        check_permission('student');

        if ($param1 == 'add_user_form') {
            $page_data['page_name'] = 'user_add';
            $page_data['page_title'] = get_phrase('student_add');
            $this->load->view('backend/index', $page_data);
        } elseif ($param1 == 'edit_user_form') {
            $page_data['page_name'] = 'user_edit';
            $page_data['user_id'] = $param2;
            $page_data['page_title'] = get_phrase('student_edit');
            $this->load->view('backend/index', $page_data);
        }
    }

    public function enrol_history($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        /*if ($param1 != "") {
            $date_range                   = $this->input->get('date_range');
            $date_range                   = explode(" - ", $date_range);
            $page_data['timestamp_start'] = strtotime($date_range[0]);
            $page_data['timestamp_end']   = strtotime($date_range[1]);
        } else {
            $first_day_of_month = "1 " . date("M") . " " . date("Y") . ' 00:00:00';
            $last_day_of_month = date("t") . " " . date("M") . " " . date("Y") . ' 23:59:59';
            $page_data['timestamp_start']   = strtotime($first_day_of_month);
            $page_data['timestamp_end']     = strtotime($last_day_of_month);
        }
        $page_data['page_name'] = 'enrol_history';
        $page_data['enrol_history'] = $this->crud_model->enrol_history_by_date_range($page_data['timestamp_start'], $page_data['timestamp_end']);
        $page_data['page_title'] = get_phrase('enrol_history');
        $this->load->view('backend/index', $page_data);*/
        if ($this->input->get('name_email')) {
            $page_data['page_name'] = 'enrol_history';
            $page_data['enrol_history'] = $this->crud_model->enrol_history_by_name_email($this->input->get('name_email'));
        } else {
            if ($param1 != "") {
                $date_range                   = $this->input->get('date_range');
                $date_range                   = explode(" - ", $date_range);
                $page_data['timestamp_start'] = strtotime($date_range[0]);
                $page_data['timestamp_end']   = strtotime($date_range[1]);
            } else {
                $first_day_of_month = "1 " . date("M") . " " . date("Y") . ' 00:00:00';
                $last_day_of_month = date("t") . " " . date("M") . " " . date("Y") . ' 23:59:59';
                $page_data['timestamp_start']   = strtotime($first_day_of_month);
                $page_data['timestamp_end']     = strtotime($last_day_of_month);
            }
            $page_data['page_name'] = 'enrol_history';
            $page_data['enrol_history'] = $this->crud_model->enrol_history_by_date_range($page_data['timestamp_start'], $page_data['timestamp_end']);
        }
        $page_data['page_title'] = get_phrase('enrol_history');
        $this->load->view('backend/index', $page_data);
    }

    public function enrol_student($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        if ($param1 == 'enrol') {
            $this->crud_model->enrol_a_student_manually();
            redirect(site_url('admin/enrol_history'), 'refresh');
        } else if ($param1 == 'edit_enrol') {
            $this->crud_model->edit_enrol_a_student_manually();
            redirect(site_url('admin/enrol_history'), 'refresh');
        }
        $page_data['page_name'] = 'enrol_student';
        $page_data['page_title'] = get_phrase('course_enrolment');
        $this->load->view('backend/index', $page_data);
    }

    public function shortcut_enrol_student()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        echo $this->crud_model->shortcut_enrol_a_student_manually();
    }

    public function admin_revenue($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('revenue');

        if ($param1 != "") {
            $date_range                   = $this->input->get('date_range');
            $date_range                   = explode(" - ", $date_range);
            $page_data['timestamp_start'] = strtotime($date_range[0] . ' 00:00:00');
            $page_data['timestamp_end']   = strtotime($date_range[1] . ' 23:59:59');
        } else {
            $page_data['timestamp_start'] = strtotime(date("m/01/Y 00:00:00"));
            $page_data['timestamp_end']   = strtotime(date("m/t/Y 23:59:59"));
        }

        $page_data['page_name'] = 'admin_revenue';
        $page_data['payment_history'] = $this->crud_model->get_revenue_by_user_type($page_data['timestamp_start'], $page_data['timestamp_end'], 'admin_revenue');
        $page_data['page_title'] = get_phrase('admin_revenue');



        $this->load->view('backend/index', $page_data);
    }

    public function instructor_revenue($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('revenue');

        $page_data['page_name'] = 'instructor_revenue';
        $page_data['payment_history'] = $this->crud_model->get_revenue_by_user_type("", "", 'instructor_revenue');
        $page_data['page_title'] = get_phrase('instructor_revenue');
        $this->load->view('backend/index', $page_data);
    }

    function invoice($payout_id = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'invoice';
        $page_data['payout_id'] = $payout_id;
        $page_data['page_title'] = get_phrase('invoice');
        $this->load->view('backend/index', $page_data);
    }

    public function enrol_history_delete($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $this->crud_model->delete_enrol_history($param1);
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(site_url('admin/enrol_history'), 'refresh');
    }

    public function purchase_history()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'purchase_history';
        $page_data['purchase_history'] = $this->crud_model->purchase_history();
        $page_data['page_title'] = get_phrase('purchase_history');
        $this->load->view('backend/index', $page_data);
    }

    public function system_settings($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('settings');

        if ($param1 == 'system_update') {
            $this->crud_model->update_system_settings();
            $this->session->set_flashdata('flash_message', get_phrase('system_settings_updated'));
            redirect(site_url('admin/system_settings'), 'refresh');
        }

        if ($param1 == 'logo_upload') {
            move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/backend/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('backend_logo_updated'));
            redirect(site_url('admin/system_settings'), 'refresh');
        }

        if ($param1 == 'favicon_upload') {
            move_uploaded_file($_FILES['favicon']['tmp_name'], 'assets/favicon.png');
            $this->session->set_flashdata('flash_message', get_phrase('favicon_updated'));
            redirect(site_url('admin/system_settings'), 'refresh');
        }

        $page_data['languages']  = $this->crud_model->get_all_languages();
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $this->load->view('backend/index', $page_data);
    }

    public function frontend_settings($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('settings');

        if ($param1 == 'frontend_update') {
            $this->crud_model->update_frontend_settings();
            $this->session->set_flashdata('flash_message', get_phrase('frontend_settings_updated'));
            redirect(site_url('admin/frontend_settings?tab=frontendsettings'), 'refresh');
        }

        if ($param1 == 'recaptcha_update') {
            $this->crud_model->update_recaptcha_settings();
            $this->session->set_flashdata('flash_message', get_phrase('recaptcha_settings_updated'));
            redirect(site_url('admin/frontend_settings?tab=recaptcha'), 'refresh');
        }

        if ($param1 == 'banner_image_update') {
            $this->crud_model->update_frontend_banner();
            $this->session->set_flashdata('flash_message', get_phrase('banner_image_update'));
            redirect(site_url('admin/frontend_settings?tab=logo_and_images'), 'refresh');
        }
        if ($param1 == 'light_logo') {
            $this->crud_model->update_light_logo();
            $this->session->set_flashdata('flash_message', get_phrase('logo_updated'));
            redirect(site_url('admin/frontend_settings?tab=logo_and_images'), 'refresh');
        }
        if ($param1 == 'dark_logo') {
            $this->crud_model->update_dark_logo();
            $this->session->set_flashdata('flash_message', get_phrase('logo_updated'));
            redirect(site_url('admin/frontend_settings?tab=logo_and_images'), 'refresh');
        }
        if ($param1 == 'small_logo') {
            $this->crud_model->update_small_logo();
            $this->session->set_flashdata('flash_message', get_phrase('logo_updated'));
            redirect(site_url('admin/frontend_settings?tab=logo_and_images'), 'refresh');
        }
        if ($param1 == 'favicon') {
            $this->crud_model->update_favicon();
            $this->session->set_flashdata('flash_message', get_phrase('favicon_updated'));
            redirect(site_url('admin/frontend_settings?tab=logo_and_images'), 'refresh');
        }

        if ($param1 == 'motivational_speech') {
            $this->crud_model->update_motivational_speech();
            $this->session->set_flashdata('flash_message', get_phrase('Motivational speech updated successfully'));
            redirect(site_url('admin/frontend_settings?tab=motivational_speech'), 'refresh');
        }

        if ($param1 == 'website_faq') {
            $this->crud_model->update_website_faq();
            $this->session->set_flashdata('flash_message', get_phrase('Website FAQS updated successfully'));
            redirect(site_url('admin/frontend_settings?tab=websitefaqs'), 'refresh');
        }

        if ($param1 == 'contact_info') {
            $this->crud_model->update_contact_info();
            $this->session->set_flashdata('flash_message', get_phrase('Contact information updated successfully'));
            redirect(site_url('admin/frontend_settings?tab=contact_information'), 'refresh');
        }

        $page_data['page_name'] = 'frontend_settings';
        $page_data['page_title'] = get_phrase('frontend_settings');
        $this->load->view('backend/index', $page_data);
    }
    public function payment_settings($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('settings');

        if ($param1 == 'system_currency') {
            $this->crud_model->update_system_currency();
            redirect(site_url('admin/payment_settings'), 'refresh');
        }

        if (isset($_POST['identifier'])) {
            $this->crud_model->update_payment_settings();
            redirect(site_url('admin/payment_settings'), 'refresh');
        }

        $page_data['payment_gateways'] = $this->crud_model->get_payment_gateways()->result_array();
        $page_data['page_name'] = 'payment_settings';
        $page_data['page_title'] = get_phrase('payment_settings');
        $this->load->view('backend/index', $page_data);
    }


    public function notification_settings($param1 = "", $param2 = "", $param3 = "")
    {
        if ($param1 == 'smtp_settings') {
            $this->crud_model->update_smtp_settings();
            $this->session->set_flashdata('flash_message', get_phrase('smtp_settings_updated_successfully'));
            redirect(site_url('admin/notification_settings'), 'refresh');
        }

        if ($param1 == 'notification_enable_diable') {
            echo $this->crud_model->notification_enable_diable();
            return;
        }

        if (isset($_GET['tab'])) {
            $page_data['tab'] = $_GET['tab'];
        } else {
            $page_data['tab'] = 'smtp-settings';
        }

        $page_data['page_name'] = 'notification_settings';
        $page_data['page_title'] = get_phrase('Notification settings');
        $this->load->view('backend/index', $page_data);
    }


    function edit_email_template($id = "", $param2 = "")
    {

        if ($param2 == 'update') {
            $data['subject'] = json_encode($this->input->post('subject'));
            $data['template'] = json_encode($this->input->post('template'));
            $this->db->where('id', $id)->update('notification_settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('Email template updated successfully'));
            redirect(site_url('admin/notification_settings?tab=email-template'), 'refresh');
        }
        $page_data['notification'] = $this->db->where('id', $id)->get('notification_settings')->row_array();
        $this->load->view('backend/admin/edit_email_template', $page_data);
    }

    public function social_login_settings($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('settings');

        if ($param1 == 'update') {
            $this->crud_model->update_social_login_settings();
            $this->session->set_flashdata('flash_message', get_phrase('social_login_settings_updated_successfully'));
            redirect(site_url('admin/social_login_settings'), 'refresh');
        }

        $page_data['page_name'] = 'social_login';
        $page_data['page_title'] = get_phrase('social_login');
        $this->load->view('backend/index', $page_data);
    }

    public function instructor_settings($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('user');
        check_permission('instructor');

        if ($param1 == 'update') {
            $this->crud_model->update_instructor_settings();
            $this->session->set_flashdata('flash_message', get_phrase('instructor_settings_updated'));
            redirect(site_url('admin/instructor_settings'), 'refresh');
        }

        $page_data['page_name'] = 'instructor_settings';
        $page_data['page_title'] = get_phrase('instructor_settings');
        $this->load->view('backend/index', $page_data);
    }

    public function theme_settings($action = '')
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('theme');

        $page_data['page_name']  = 'theme_settings';
        $page_data['page_title'] = get_phrase('theme_settings');
        $this->load->view('backend/index', $page_data);
    }

    public function theme_actions($action = "", $theme = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('theme');

        if ($action == 'activate') {
            $theme_to_active  = $this->input->post('theme');
            $installed_themes = $this->crud_model->get_installed_themes();
            if (in_array($theme_to_active, $installed_themes)) {
                $this->crud_model->activate_theme($theme_to_active);
                echo true;
            } else {
                echo false;
            }
        } elseif ($action == 'remove') {
            if ($theme == get_frontend_settings('theme')) {
                $this->session->set_flashdata('error_message', get_phrase('activate_a_theme_first'));
            } else {
                $this->crud_model->remove_files_and_folders(APPPATH . '/views/frontend/' . $theme);
                $this->crud_model->remove_files_and_folders(FCPATH . '/assets/frontend/' . $theme);
                $this->session->set_flashdata('flash_message', $theme . ' ' . get_phrase('theme_removed_successfully'));
            }
            redirect(site_url('admin/theme_settings'), 'refresh');
        }
    }

    public function courses()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('course');

        $page_data['selected_category_id']   = isset($_GET['category_id']) ? $_GET['category_id'] : "all";
        $page_data['selected_instructor_id'] = isset($_GET['instructor_id']) ? $_GET['instructor_id'] : "all";
        $page_data['selected_price']         = isset($_GET['price']) ? $_GET['price'] : "all";
        $page_data['selected_status']        = isset($_GET['status']) ? $_GET['status'] : "all";

        $page_data['page_name']              = 'courses-server-side';
        $page_data['categories']             = $this->crud_model->get_categories();
        $page_data['page_title']             = get_phrase('active_courses');
        $this->load->view('backend/index', $page_data);
    }

    // This function is responsible for loading the course data from server side for datatable SILENTLY
    public function get_courses()
    {
        $data = array();
        //mentioned all with colum of database table that related with html table
        $columns = array('id', 'title', 'sub_category_id', 'section', 'id', 'status', 'price', 'id');

        // Filter portion
        $category_id   = $this->input->post('selected_category_id');
        $instructor_id = $this->input->post('selected_instructor_id');
        $price         = $this->input->post('selected_price');
        $status        = $this->input->post('selected_status');

        $limit = htmlspecialchars_($this->input->post('length'));
        $start = htmlspecialchars_($this->input->post('start'));

        $column_index = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        $total_number_of_row = $this->crud_model->get_courses()->num_rows();
        $search = $this->input->post('search')['value'];

        //FILTERED DATA
        $this->db->select('*');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('title', $search);
            $this->db->or_like('status', $search);
            $this->db->or_like('price', $search);
            $this->db->or_like('discounted_price', $search);
            $this->db->group_end();
        }
        if (!empty($category_id) && $category_id != 'all') {
            $this->db->where('sub_category_id', $category_id);
        }
        if (!empty($instructor_id) && $instructor_id != 'all') {
            $this->db->where('creator', $instructor_id);
        }
        if (!empty($price) && $price != 'all') {
            if ($price == 'free') {
                $this->db->where('is_free_course', 1);
            } elseif ($price == 'paid') {
                $this->db->where('is_free_course', null);
            }
        }

        if (!empty($status) && $status != 'all') {
            $this->db->group_start();
            $this->db->where('status', $status);
            $this->db->group_end();
        }

        $this->db->limit($limit, $start);
        $this->db->order_by($column_index, $dir);
        $courses = $this->db->get('course')->result_array();

        //WITHOUT FILTERED DATA
        $this->db->select('*');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('title', $search);
            $this->db->or_like('status', $search);
            $this->db->or_like('price', $search);
            $this->db->or_like('discounted_price', $search);
            $this->db->group_end();
        }
        if (!empty($category_id) && $category_id != 'all') {
            $this->db->where('sub_category_id', $category_id);
        }
        if (!empty($instructor_id) && $instructor_id != 'all') {
            $this->db->where('creator', $instructor_id);
        }
        if (!empty($price) && $price != 'all') {
            if ($price == 'free') {
                $this->db->where('is_free_course', 1);
            } elseif ($price == 'paid') {
                $this->db->where('is_free_course', null);
            }
        }
        if (!empty($status) && $status != 'all') {
            $this->db->group_start();
            $this->db->where('status', $status);
            $this->db->group_end();
        }
        $filtered_number_of_row = $this->db->get('course')->num_rows();


        // Fetch the data and make it as JSON format and return it.
        if (!empty($courses)) {
            foreach ($courses as $key => $row) {
                $instructor_details = $this->user_model->get_all_user($row['creator'])->row_array();
                $category_details = $this->crud_model->get_category_details_by_id($row['sub_category_id'])->row_array();
                $sections = $this->crud_model->get_section('course', $row['id']);
                $lessons = $this->crud_model->get_lessons('course', $row['id']);
                $enroll_history = $this->crud_model->enrol_history($row['id']);

                $status_badge = "badge-success-lighten";
                if ($row['status'] == 'pending') {
                    $status_badge = "badge-danger-lighten";
                } elseif ($row['status'] == 'draft') {
                    $status_badge = "badge-dark-lighten";
                } elseif ($row['status'] == 'private') {
                    $status_badge = "badge-dark";
                } elseif ($row['status'] == 'upcoming') {
                    $status_badge = "badge-warning-lighten";
                }



                $price_badge = "badge-dark-lighten";
                $price = 0;
                if ($row['is_free_course'] == null) {
                    if ($row['discount_flag'] == 1) {
                        $price = currency($row['discounted_price']);
                    } else {
                        $price = currency($row['price']);
                    }
                } elseif ($row['is_free_course'] == 1) {
                    $price_badge = "badge-success-lighten";
                    $price = get_phrase('free');
                }

                $price_field = '<span class="badge ' . $price_badge . '">' . $price . '</span>';
                if ($row['expiry_period'] > 0) {
                    $price_field .= '<p class="text-12">' . $row['expiry_period'] . ' ' . get_phrase('Months') . '</p>';
                } else {
                    $price_field .= '<p class="text-12">' . get_phrase('Lifetime') . '</p>';
                }

                if ($row['slug_count'] == 1 || $row['slug_count'] == 2) {
                    $row_slug = $row['slug'];
                } else if ($row['slug_count'] == 3 || $row['slug_count'] == 4) {
                    $row_slug = $row['category_slug'] . '/' . $row['sub_category_slug'] . '/' . $row['slug'];
                } else {
                    $row_slug = $row['slug'];
                }

                $view_course_on_frontend_url = site_url($row_slug);
                $go_to_course_playing_page = site_url('home/lesson/' . rawurlencode(slugify($row['title'])) . '/' . $row['id']);
                $edit_this_course_url = site_url('admin/course_form/course_edit/' . $row['id']);
                $section_and_lesson_url = site_url('admin/course_form/course_edit/' . $row['id']);
                $academic_progress_url = site_url('admin/course_form/course_edit/' . $row['id'] . '?tab=academic_progress');

                if ($row['status'] == 'active') {
                    $course_status_changing_message = get_phrase('mark_as_pending');
                    if ($row['user_id'] != $this->session->userdata('user_id')) {
                        $course_status_changing_action = "showAjaxModal('" . site_url('modal/popup/mail_on_course_status_changing_modal/pending/' . $row['id'] . '/' . $category_id . '/' . $instructor_id . '/all/' . $status) . "', '" . $course_status_changing_message . "')";
                    } else {
                        $course_status_changing_action = "confirm_modal('" . site_url('admin/change_course_status_for_admin/pending/' . $row['id'] . '/' . $category_id . '/' . $instructor_id . '/all/' . $status) . "')";
                    }
                } else {
                    $course_status_changing_message = get_phrase('mark_as_active');
                    if ($row['user_id'] != $this->session->userdata('user_id')) {
                        $course_status_changing_action = "showAjaxModal('" . site_url('modal/popup/mail_on_course_status_changing_modal/active/' . $row['id'] . '/' . $category_id . '/' . $instructor_id . '/all/' . $status) . "', '" . $course_status_changing_message . "')";
                    } else {
                        $course_status_changing_action = "confirm_modal('" . site_url('admin/change_course_status_for_admin/active/' . $row['id'] . '/' . $category_id . '/' . $instructor_id . '/all/' . $status) . "')";
                    }
                }



                $delete_course_url = "confirm_modal('" . site_url('admin/course_actions/delete/' . $row['id']) . "')";

                if ($row['course_type'] == 'general') {
                    $section_and_lesson_menu = '<li><a class="dropdown-item" href="' . $section_and_lesson_url . '">' . get_phrase("section_and_lesson") . '</a></li>';
                } else {
                    $section_and_lesson_menu = "";
                }

                $course_academic_progress_menu = '<li><a class="dropdown-item" href="' . $academic_progress_url . '">' . get_phrase("Academic progress") . '</a></li>';

                $course_edit_menu = '<li><a class="dropdown-item" href="' . $edit_this_course_url . '">' . get_phrase("edit_this_course") . '</a></li>';

                $course_delete_menu = '<li><a class="dropdown-item" href="javascript:;" onclick="' . $delete_course_url . '">' . get_phrase("delete") . '</a></li>';

                $action = '
                <div class="dropright dropright">
                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="' . $view_course_on_frontend_url . '" target="_blank">' . get_phrase("view_course_on_frontend") . '</a></li>
                <li><a class="dropdown-item" href="' . $go_to_course_playing_page . '" target="_blank">' . get_phrase("go_to_course_playing_page") . '</a></li>
                ' . $course_academic_progress_menu . $course_edit_menu . $section_and_lesson_menu . '
                <li><a class="dropdown-item" href="javascript:;" onclick="' . $course_status_changing_action . '">' . $course_status_changing_message . '</a></li>
                ' . $course_delete_menu . '
                </ul>
                </div>
                ';

                $nestedData['#'] = $key + 1;

                $instructor_names = "";
                foreach ($this->crud_model->get_course_instructors_id($row['id']) as $instructor_id) {
                    $multi_instructor = $this->user_model->get_all_user($instructor_id)->row_array();
                    $instructor_names = $multi_instructor['first_name'] . ' ' . $multi_instructor['last_name'];
                }

                $nestedData['title'] = '<strong><a href="' . site_url('admin/course_form/course_edit/' . $row['id']) . '">' . $row['title'] . '</a></strong><br>
                <small class="text-muted">' . get_phrase('instructor') . ': <b>' . $instructor_names . '</b></small>';

                $nestedData['category'] = '<span class="badge badge-dark-lighten">' . $category_details['name'] . '</span>';

                if ($row['course_type'] == 'scorm') {
                    $nestedData['lesson_and_section'] = '<span class="badge badge-info-lighten">' . get_phrase('scorm_course') . '</span>';
                } elseif ($row['course_type'] == 'h5p') {
                    $nestedData['lesson_and_section'] = '<span class="badge badge-info-lighten">' . get_phrase('h5p_course') . '</span>';
                } elseif ($row['course_type'] == 'general') {
                    $nestedData['lesson_and_section'] = '
                    <small class="text-muted"><b>' . get_phrase('Section') . '</b>: ' . $sections->num_rows() . '</small><br>
                    <small class="text-muted"><b>' . get_phrase('Lesson') . '</b>: ' . $lessons->num_rows() . '</small>';
                }

                $nestedData['enrolled_student'] = '<small class="text-muted"><b>' . get_phrase('Enrollments') . '</b>: ' . $enroll_history->num_rows() . '</small>';

                $nestedData['status'] = '<span class="badge ' . $status_badge . '">' . get_phrase($row['status']) . '</span>';

                $nestedData['price'] = $price_field;

                $nestedData['actions'] = $action;

                $nestedData['course_id'] = $row['id'];

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($total_number_of_row),
            "recordsFiltered" => intval($filtered_number_of_row),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function pending_courses()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('course');

        $page_data['page_name'] = 'pending_courses';
        $page_data['page_title'] = get_phrase('pending_courses');
        $this->load->view('backend/index', $page_data);
    }

    public function course_actions($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        // CHECK ACCESS PERMISSION
        check_permission('course');

        if ($param1 == "add") {
            $course_id = $this->crud_model->add_course();
            redirect(site_url('admin/course_form/course_edit/' . $course_id), 'refresh');
        } elseif ($param1 == 'add_shortcut') {
            echo $this->crud_model->add_shortcut_course();
        } elseif ($param1 == "edit") {

            $this->crud_model->update_course($param2);

            // CHECK IF LIVE CLASS ADDON EXISTS, ADD OR UPDATE IT TO ADDON MODEL
            if (addon_status('live-class')) {
                $this->load->model('addons/Liveclass_model', 'liveclass_model');
                $this->liveclass_model->update_live_class($param2);
            }

            // CHECK IF JITSI LIVE CLASS ADDON EXISTS, ADD OR UPDATE IT TO ADDON MODEL
            if (addon_status('jitsi-live-class')) {
                $this->load->model('addons/jitsi_liveclass_model', 'jitsi_liveclass_model');
                $this->jitsi_liveclass_model->update_live_class($param2);
            }

            redirect(site_url('admin/course_form/course_edit/' . $param2));
        } elseif ($param1 == 'delete') {

            $this->is_drafted_course($param2);
            $this->crud_model->delete_course($param2);
            redirect(site_url('admin/courses'), 'refresh');
        }
    }


    public function course_form($param1 = "", $param2 = "")
    {

        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('course');

        if ($param1 == 'add_course') {

            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['categories'] = $this->crud_model->get_categories();
            $page_data['companies'] = $this->crud_model->get_companies();
            $page_data['page_name'] = 'course_add';
            $page_data['page_title'] = get_phrase('add_course');
            $this->load->view('backend/index', $page_data);
        } elseif ($param1 == 'add_course_shortcut') {
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['categories'] = $this->crud_model->get_categories();
            $this->load->view('backend/admin/course_add_shortcut', $page_data);
        } elseif ($param1 == 'course_edit') {

            $this->is_drafted_course($param2);
            $page_data['page_name'] = 'course_edit';
            $page_data['course_id'] =  $param2;
            $page_data['page_title'] = get_phrase('edit_course');
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['categories'] = $this->crud_model->get_categories();
            $page_data['companies'] = $this->crud_model->get_companies();
            $this->load->view('backend/index', $page_data);
        }
    }

    private function is_drafted_course($course_id)
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        if ($course_details['status'] == 'draft') {
            $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_course'));
            redirect(site_url('admin/courses'), 'refresh');
        }
    }

    public function change_course_status($updated_status = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        $course_id = $this->input->post('course_id');
        $category_id = $this->input->post('category_id');
        $instructor_id = $this->input->post('instructor_id');
        $price = $this->input->post('price');
        $status = $this->input->post('status');
        if (isset($_POST['mail_subject']) && isset($_POST['mail_body'])) {
            $mail_subject = $this->input->post('mail_subject');
            $mail_body = $this->input->post('mail_body');
            $this->email_model->send_mail_on_course_status_changing($course_id, $mail_subject, $mail_body);
        }
        $this->crud_model->change_course_status($updated_status, $course_id);
        $this->session->set_flashdata('flash_message', get_phrase('course_status_updated'));
        //redirect(site_url('admin/courses?category_id=' . $category_id . '&status=' . $status . '&instructor_id=' . $instructor_id . '&price=' . $price), 'refresh');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function change_course_status_for_admin($updated_status = "", $course_id = "", $category_id = "", $status = "", $instructor_id = "", $price = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $this->crud_model->change_course_status($updated_status, $course_id);
        $this->session->set_flashdata('flash_message', get_phrase('course_status_updated'));
        redirect(site_url('admin/courses?category_id=' . $category_id . '&status=' . $status . '&instructor_id=' . $instructor_id . '&price=' . $price), 'refresh');
    }

    public function sections($param1 = "", $param2 = "", $param3 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('course');

        if ($param2 == 'add') {
            $this->crud_model->add_section($param1);
            $this->session->set_flashdata('flash_message', get_phrase('section_has_been_added_successfully'));
        } elseif ($param2 == 'edit') {
            $this->crud_model->edit_section($param3);
            $this->session->set_flashdata('flash_message', get_phrase('section_has_been_updated_successfully'));
        } elseif ($param2 == 'delete') {
            $this->crud_model->delete_section($param1, $param3);
            $this->session->set_flashdata('flash_message', get_phrase('section_has_been_deleted_successfully'));
        }
        redirect(site_url('admin/course_form/course_edit/' . $param1));
    }

    public function lessons($course_id = "", $param1 = "", $param2 = "")
    {
        // CHECK ACCESS PERMISSION
        check_permission('course');

        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        if ($param1 == 'add') {
            $response = $this->crud_model->add_lesson();
            echo $response;
            return;
        } elseif ($param1 == 'edit') {
            $response = $this->crud_model->edit_lesson($param2);
            echo $response;
            return;
        } elseif ($param1 == 'delete') {
            $this->crud_model->delete_lesson($param2);
            $this->session->set_flashdata('flash_message', get_phrase('lesson_has_been_deleted_successfully'));
            redirect('admin/course_form/course_edit/' . $course_id);
        } elseif ($param1 == 'filter') {
            redirect('admin/lessons/' . $this->input->post('course_id'));
        }
        $page_data['page_name'] = 'lessons';
        $page_data['lessons'] = $this->crud_model->get_lessons('course', $course_id);
        $page_data['course_id'] = $course_id;
        $page_data['page_title'] = get_phrase('lessons');
        $this->load->view('backend/index', $page_data);
    }

    public function watch_video($slugified_title = "", $lesson_id = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $lesson_details          = $this->crud_model->get_lessons('lesson', $lesson_id)->row_array();
        $page_data['provider']   = $lesson_details['video_type'];
        $page_data['video_url']  = $lesson_details['video_url'];
        $page_data['lesson_id']  = $lesson_id;
        $page_data['page_name']  = 'video_player';
        $page_data['page_title'] = get_phrase('video_player');
        $this->load->view('backend/index', $page_data);
    }


    // Language Functions
    public function manage_language($param1 = '', $param2 = '', $param3 = '')
    {

        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('settings');


        if ($param1 == 'add_language') {
            $language = strtolower(trimmer($this->input->post('language')));
            if ($language == 'n-a') {
                $this->session->set_flashdata('error_message', get_phrase('language_name_can_not_be_empty_or_can_not_have_special_characters'));
                redirect(site_url('admin/manage_language'), 'refresh');
            }

            if (!$this->db->field_exists($language, 'language')) {
                $this->load->dbforge();
                $fields = array(
                    $language => array(
                        'type' => 'TEXT',
                        'default' => null,
                        'null' => TRUE,
                        'collation' => 'utf8_unicode_ci'
                    )
                );
                $this->dbforge->add_column('language', $fields);
            }

            saveDefaultJSONFile($language);
            $this->session->set_flashdata('flash_message', get_phrase('language_added_successfully'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $new_phrase = get_phrase($this->input->post('phrase'));
            $this->session->set_flashdata('flash_message', $new_phrase . ' ' . get_phrase('has_been_added_successfully'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }

        if ($param1 == 'delete_language') {
            if (file_exists('application/language/' . $param2 . '.json')) {
                unlink('application/language/' . $param2 . '.json');
                $this->session->set_flashdata('flash_message', get_phrase('language_deleted_successfully'));
                redirect(site_url('admin/manage_language'), 'refresh');
            }
        }
        $page_data['languages']             = $this->crud_model->get_all_languages();
        $page_data['page_name']             =   'manage_language';
        $page_data['page_title']            =   get_phrase('multi_language_settings');
        $this->load->view('backend/index', $page_data);
    }

    public function update_phrase_with_ajax()
    {
        $current_editing_language = $this->input->post('currentEditingLanguage');
        $updatedValue = $this->input->post('updatedValue');
        $key = $this->input->post('key');
        saveJSONFile($current_editing_language, $key, $updatedValue);
        echo $current_editing_language . ' ' . $key . ' ' . $updatedValue;
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        // CHECK ACCESS PERMISSION
        check_permission('messaging');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(site_url('admin/message/message_read/' . $message_thread_code), 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2); //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(site_url('admin/message/message_read/' . $param2), 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2; // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name']               = 'message';
        $page_data['page_title']              = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'update_profile_info') {
            $this->user_model->edit_user($param2);
            redirect(site_url('admin/manage_profile'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $this->user_model->change_password($param2);
            redirect(site_url('admin/manage_profile'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('users', array(
            'id' => $this->session->userdata('user_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    public function paypal_checkout_for_instructor_revenue()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['amount_to_pay']         = $this->input->post('amount_to_pay');
        $page_data['payout_id']            = $this->input->post('payout_id');
        $page_data['instructor_name']       = $this->input->post('instructor_name');
        $page_data['production_client_id']  = $this->input->post('production_client_id');

        // BEFORE, CHECK PAYOUT AMOUNTS ARE VALID
        $payout_details = $this->crud_model->get_payouts($page_data['payout_id'], 'payout')->row_array();
        if ($payout_details['amount'] == $page_data['amount_to_pay'] && $payout_details['status'] == 0) {
            $this->load->view('backend/admin/paypal_checkout_for_instructor_revenue', $page_data);
        } else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_payout_data'));
            redirect(site_url('admin/instructor_payout'), 'refresh');
        }
    }


    // PAYPAL CHECKOUT ACTIONS
    public function paypal_payment($payout_id = "", $paypalPaymentID = "", $paypalPaymentToken = "", $paypalPayerID = "")
    {
        $payout_details = $this->crud_model->get_payouts($payout_id, 'payout')->row_array();
        $instructor_id = $payout_details['user_id'];
        $instructor_data = $this->db->get_where('users', array('id' => $instructor_id))->row_array();

        $payment_keys = json_decode($instructor_data['payment_keys'], true);
        $paypal_keys = $payment_keys['paypal'];
        $production_client_id = $paypal_keys['production_client_id'];
        $production_secret_key = $paypal_keys['production_secret_key'];

        //THIS IS HOW I CHECKED THE PAYPAL PAYMENT STATUS
        $status = $this->payment_model->paypal_payment($paypalPaymentID, $paypalPaymentToken, $paypalPayerID, $production_client_id, $production_secret_key);
        if (!$status) {
            $this->session->set_flashdata('error_message', get_phrase('an_error_occurred_during_payment'));
            redirect(site_url('admin/instructor_payout'), 'refresh');
        }
        $this->crud_model->update_payout_status($payout_id, 'paypal');
        $this->session->set_flashdata('flash_message', get_phrase('payout_updated_successfully'));
        redirect(site_url('admin/instructor_payout'), 'refresh');
    }

    public function stripe_checkout_for_instructor_revenue($payout_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        // BEFORE, CHECK PAYOUT AMOUNTS ARE VALID
        $payout_details = $this->crud_model->get_payouts($payout_id, 'payout')->row_array();
        if ($payout_details['amount'] > 0 && $payout_details['status'] == 0) {
            $page_data['user_details']    = $this->user_model->get_user($payout_details['user_id'])->row_array();
            $page_data['amount_to_pay']   = $payout_details['amount'];
            $page_data['payout_id']       = $payout_details['id'];
            $this->load->view('backend/admin/stripe_checkout_for_instructor_revenue', $page_data);
        } else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_payout_data'));
            redirect(site_url('admin/instructor_payout'), 'refresh');
        }
    }

    // STRIPE CHECKOUT ACTIONS
    public function stripe_payment($payout_id = "", $session_id = "")
    {
        $payout_details = $this->crud_model->get_payouts($payout_id, 'payout')->row_array();
        $instructor_id = $payout_details['user_id'];
        //THIS IS HOW I CHECKED THE STRIPE PAYMENT STATUS
        $response = $this->payment_model->stripe_payment($instructor_id, $session_id, true);

        if ($response['payment_status'] === 'succeeded') {
            $this->crud_model->update_payout_status($payout_id, 'stripe');
            $this->session->set_flashdata('flash_message', get_phrase('payout_updated_successfully'));
        } else {
            $this->session->set_flashdata('error_message', $response['status_msg']);
        }

        redirect(site_url('admin/instructor_payout'), 'refresh');
    }

    public function razorpay_checkout_for_instructor_revenue($user_id = "", $payout_id = "", $param1 = "", $razorpay_order_id = "", $payment_id = "", $amount = "", $signature = "")
    {
        if ($param1 == 'paid') {
            $status = $this->payment_model->razorpay_payment($razorpay_order_id, $payment_id, $amount, $signature);
            if ($status == true) {
                $this->crud_model->update_payout_status($payout_id, 'razorpay');
                $this->session->set_flashdata('flash_message', get_phrase('payout_updated_successfully'));
            } else {
                $this->session->set_flashdata('error_message', $response['status_msg']);
            }

            redirect(site_url('admin/instructor_payout'), 'refresh');
        }

        $page_data['payout_id']    = $payout_id;
        $page_data['user_details']    = $this->user_model->get_user($user_id)->row_array();
        $page_data['amount_to_pay']   = $this->input->post('total_price_of_checking_out');
        $this->load->view('backend/admin/razorpay_checkout', $page_data);
    }

    public function preview($course_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $this->is_drafted_course($course_id);
        if ($course_id > 0) {
            $courses = $this->crud_model->get_course_by_id($course_id);
            if ($courses->num_rows() > 0) {
                $course_details = $courses->row_array();
                redirect(site_url('home/lesson/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id']), 'refresh');
            }
        }
        redirect(site_url('admin/courses'), 'refresh');
    }

    // Manage Quizes
    public function quizes($course_id = "", $action = "", $quiz_id = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('course');

        if ($action == 'add') {
            $this->crud_model->add_quiz($course_id);
            $this->session->set_flashdata('flash_message', get_phrase('quiz_has_been_added_successfully'));
        } elseif ($action == 'edit') {
            $this->crud_model->edit_quiz($quiz_id);
            $this->session->set_flashdata('flash_message', get_phrase('quiz_has_been_updated_successfully'));
        } elseif ($action == 'delete') {
            $this->crud_model->delete_section($course_id, $quiz_id);
            $this->session->set_flashdata('flash_message', get_phrase('quiz_has_been_deleted_successfully'));
        }
        redirect(site_url('admin/course_form/course_edit/' . $course_id));
    }

    // Manage Quize Questions
    public function quiz_questions($quiz_id = "", $action = "", $question_id = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $quiz_details = $this->crud_model->get_lessons('lesson', $quiz_id)->row_array();

        if ($action == 'add' || $action == 'edit') {
            echo $this->crud_model->manage_quiz_questions($quiz_id, $question_id, $action);
        } elseif ($action == 'delete') {
            $response = $this->crud_model->delete_quiz_question($question_id);
            $this->session->set_flashdata('flash_message', get_phrase('question_has_been_deleted'));
            redirect(site_url('admin/course_form/course_edit/' . $quiz_details['course_id']), 'refresh');
        }
    }

    // software about page
    function about()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['application_details'] = $this->crud_model->get_application_details();
        $page_data['page_name']  = 'about';
        $page_data['page_title'] = get_phrase('about');
        $this->load->view('backend/index', $page_data);
    }

    public function install_theme($theme_to_install = '')
    {

        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('theme');

        $uninstalled_themes = $this->crud_model->get_uninstalled_themes();
        if (!in_array($theme_to_install, $uninstalled_themes)) {
            $this->session->set_flashdata('error_message', get_phrase('this_theme_is_not_available'));
            redirect(site_url('admin/theme_settings'));
        }

        if (!class_exists('ZipArchive')) {
            $this->session->set_flashdata('error_message', get_phrase('your_server_is_unable_to_extract_the_zip_file') . '. ' . get_phrase('please_enable_the_zip_extension_on_your_server') . ', ' . get_phrase('then_try_again'));
            redirect(site_url('admin/theme_settings'));
        }

        $zipped_file_name = $theme_to_install;
        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        // Create update directory.
        $views_directory  = 'application/views/frontend';
        $assets_directory = 'assets/frontend';

        //Unzip theme zip file and remove zip file.
        $theme_path = 'themes/' . $zipped_file_name;
        $theme_zip = new ZipArchive;
        $theme_result = $theme_zip->open($theme_path);
        if ($theme_result === TRUE) {
            $theme_zip->extractTo('themes');
            $theme_zip->close();
        }

        // unzip the views zip file to the application>views folder
        $views_path = 'themes/' . $unzipped_file_name . '/views/' . $zipped_file_name;
        $views_zip = new ZipArchive;
        $views_result = $views_zip->open($views_path);
        if ($views_result === TRUE) {
            $views_zip->extractTo($views_directory);
            $views_zip->close();
        }

        // unzip the assets zip file to the assets/frontend folder
        $assets_path = 'themes/' . $unzipped_file_name . '/assets/' . $zipped_file_name;
        $assets_zip = new ZipArchive;
        $assets_result = $assets_zip->open($assets_path);
        if ($assets_result === TRUE) {
            $assets_zip->extractTo($assets_directory);
            $assets_zip->close();
        }

        unlink($theme_path);
        $this->crud_model->remove_files_and_folders('themes/' . $unzipped_file_name);
        $this->session->set_flashdata('flash_message', get_phrase('theme_imported_successfully'));
        redirect(site_url('admin/theme_settings'));
    }

    public function available_addon()
    {
        $collectionId = '8226729';
        $personal_token = "FkA9UyDiQT0YiKwYLK3ghyFNRVV9SeUn";

        //setting the header for the rest of the api
        $bearer   = 'bearer ' . $personal_token;

        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v3/market/catalog/collection';
        $ch_verify = curl_init($verify_url . '?id=' . $collectionId);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        // collection, items, pagination
        $response_data = json_decode($cinit_verify_data, true);

        $page_data['items'] = $response_data['items'];
        $page_data['collectionId'] = $collectionId;

        $page_data['page_name'] = 'available_addons';
        $page_data['page_title'] = get_phrase('available_addons');
        $this->load->view('backend/index', $page_data);
    }

    //ADDON MANAGER PORTION STARTS HERE
    public function addon($param1 = "", $param2 = "", $param3 = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('addon');

        // ADD NEW ADDON FORM
        if ($param1 == 'add') {

            // CHECK ACCESS PERMISSION
            check_permission('addon');
            $page_data['page_name'] = 'addon_add';
            $page_data['page_title'] = get_phrase('add_addon');
        }

        if ($param1 == 'update') {
            // CHECK ACCESS PERMISSION
            check_permission('addon');

            $page_data['page_name'] = 'addon_update';
            $page_data['page_title'] = get_phrase('add_update');
        }

        // INSTALLING AN ADDON
        if ($param1 == 'install' || $param1 == 'version_update') {
            // CHECK ACCESS PERMISSION
            check_permission('addon');

            $this->addon_model->install_addon($param1);
        }

        // ACTIVATING AN ADDON
        if ($param1 == 'activate') {

            $update_message = $this->addon_model->addon_activate($param2);
            $this->session->set_flashdata('flash_message', get_phrase($update_message));
            redirect(site_url('admin/addon'), 'refresh');
        }

        // DEACTIVATING AN ADDON
        if ($param1 == 'deactivate') {
            $update_message = $this->addon_model->addon_deactivate($param2);
            $this->session->set_flashdata('flash_message', get_phrase($update_message));
            redirect(site_url('admin/addon'), 'refresh');
        }

        // REMOVING AN ADDON
        if ($param1 == 'delete') {
            $this->addon_model->addon_delete($param2);
            $this->session->set_flashdata('flash_message', get_phrase('addon_is_deleted_successfully'));
            redirect(site_url('admin/addon'), 'refresh');
        }

        // SHOWING LIST OF INSTALLED ADDONS
        if (empty($param1)) {
            $page_data['page_name'] = 'addons';
            $page_data['addons'] = $this->addon_model->addon_list()->result_array();
            $page_data['page_title'] = get_phrase('addon_manager');
        }
        $this->load->view('backend/index', $page_data);
    }


    public function instructor_application($param1 = "", $param2 = "")
    { // param1 is the status and param2 is the application id
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        // CHECK ACCESS PERMISSION
        check_permission('instructor');

        if ($param1 == 'approve' || $param1 == 'delete') {
            $this->user_model->update_status_of_application($param1, $param2);
        }
        $page_data['page_name']  = 'application_list';
        $page_data['page_title'] = get_phrase('instructor_application');
        $page_data['approved_applications'] = $this->user_model->get_approved_applications();
        $page_data['pending_applications'] = $this->user_model->get_pending_applications();
        $this->load->view('backend/index', $page_data);
    }


    // INSTRUCTOR PAYOUT SECTION
    public function instructor_payout($param1 = "")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        // CHECK ACCESS PERMISSION
        check_permission('instructor');

        if ($param1 != "") {
            $date_range                   = $this->input->get('date_range');
            $date_range                   = explode(" - ", $date_range);
            $page_data['timestamp_start'] = strtotime($date_range[0]);
            $page_data['timestamp_end']   = strtotime($date_range[1]);
        } else {
            $page_data['timestamp_start'] = strtotime(date('m/01/Y'));
            $page_data['timestamp_end']   = strtotime(date('m/t/Y'));
        }

        $page_data['page_name']  = 'instructor_payout';
        $page_data['page_title'] = get_phrase('instructor_payout');
        $page_data['completed_payouts'] = $this->crud_model->get_completed_payouts_by_date_range($page_data['timestamp_start'], $page_data['timestamp_end']);
        $page_data['pending_payouts'] = $this->crud_model->get_pending_payouts();
        $this->load->view('backend/index', $page_data);
    }

    // ADMINS SECTION STARTS
    public function admins($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('admin');

        if ($param1 == "add") {
            // CHECK ACCESS PERMISSION
            check_permission('admin');

            $this->user_model->add_user(false, true); // PROVIDING TRUE FOR INSTRUCTOR
            redirect(site_url('admin/admins'), 'refresh');
        } elseif ($param1 == "edit") {
            // CHECK ACCESS PERMISSION
            check_permission('admin');

            $this->user_model->edit_user($param2);
            redirect(site_url('admin/admins'), 'refresh');
        } elseif ($param1 == "delete") {
            // CHECK ACCESS PERMISSION
            check_permission('admin');

            $this->user_model->delete_user($param2);
            redirect(site_url('admin/admins'), 'refresh');
        }

        $page_data['page_name'] = 'admins';
        $page_data['page_title'] = get_phrase('admins');
        $page_data['admins'] = $this->user_model->get_admins()->result_array();
        $this->load->view('backend/index', $page_data);
    }

    public function admin_form($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        if ($param1 == 'add_admin_form') {
            // CHECK ACCESS PERMISSION
            check_permission('admin');

            $page_data['page_name'] = 'admin_add';
            $page_data['page_title'] = get_phrase('admin_add');
            $this->load->view('backend/index', $page_data);
        } elseif ($param1 == 'edit_admin_form') {
            // CHECK ACCESS PERMISSION
            check_permission('admin');

            $page_data['page_name'] = 'admin_edit';
            $page_data['user_id'] = $param2;
            $page_data['page_title'] = get_phrase('admin_edit');
            $this->load->view('backend/index', $page_data);
        }
    }

    public function permissions()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        // CHECK ACCESS PERMISSION
        check_permission('admin');

        if (!isset($_GET['permission_assing_to']) || empty($_GET['permission_assing_to'])) {
            $this->session->set_flashdata('error_message', get_phrase('you_have_select_an_admin_first'));
            redirect(site_url('admin/admins'), 'refresh');
        }

        $page_data['permission_assing_to'] = $this->input->get('permission_assing_to');
        $user_details = $this->user_model->get_all_user($page_data['permission_assing_to']);
        if ($user_details->num_rows() == 0) {
            $this->session->set_flashdata('error_message', get_phrase('invalid_admin'));
            redirect(site_url('admin/admins'), 'refresh');
        } else {
            $user_details = $user_details->row_array();
            if ($user_details['role_id'] != 1) {
                $this->session->set_flashdata('error_message', get_phrase('invalid_admin'));
                redirect(site_url('admin/admins'), 'refresh');
            }
            if (is_root_admin($user_details['id'])) {
                $this->session->set_flashdata('error_message', get_phrase('you_can_not_set_permission_to_the_root_admin'));
                redirect(site_url('admin/admins'), 'refresh');
            }
        }

        $page_data['permission_assign_to'] = $user_details;
        $page_data['page_name'] = 'admin_permission';
        $page_data['page_title'] = get_phrase('assign_permission');
        $this->load->view('backend/index', $page_data);
    }

    // ASSIGN PERMISSION TO ADMIN
    public function assign_permission()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('admin');

        echo $this->user_model->assign_permission();
    }

    // REMOVING INSTRUCTOR FROM COURSE
    public function remove_an_instructor($course_id, $instructor_id)
    {
        // CHECK ACCESS PERMISSION
        check_permission('course');

        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();

        if ($course_details['creator'] == $instructor_id) {
            $this->session->set_flashdata('error_message', get_phrase('course_creator_can_be_removed'));
            redirect('admin/course_form/course_edit/' . $course_id);
        }

        if ($course_details['multi_instructor']) {
            $instructor_ids = explode(',', $course_details['user_id']);

            if (in_array($instructor_id, $instructor_ids)) {
                if (count($instructor_ids) > 1) {
                    if (($key = array_search($instructor_id, $instructor_ids)) !== false) {
                        unset($instructor_ids[$key]);

                        $data['user_id'] = implode(",", $instructor_ids);
                        $this->db->where('id', $course_id);
                        $this->db->update('course', $data);

                        $this->session->set_flashdata('flash_message', get_phrase('instructor_has_been_removed'));
                        if ($this->session->userdata('user_id') == $instructor_id) {
                            redirect('admin/courses/');
                        } else {
                            redirect('admin/course_form/course_edit/' . $course_id);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('a_course_should_have_at_least_one_instructor'));
                    redirect('admin/course_form/course_edit/' . $course_id);
                }
            } else {
                $this->session->set_flashdata('error_message', get_phrase('invalid_instructor_id'));
                redirect('admin/course_form/course_edit/' . $course_id);
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('a_course_should_have_at_least_one_instructor'));
            redirect('admin/course_form/course_edit/' . $course_id);
        }
    }


    /** Coupons functionality starts */
    public function coupons($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('coupon');

        if ($param1 == "add") {
            // CHECK ACCESS PERMISSION
            check_permission('coupon');

            $response = $this->crud_model->add_coupon(); // PROVIDING TRUE FOR INSTRUCTOR
            $response ? $this->session->set_flashdata('flash_message', get_phrase('coupon_added_successfully')) : $this->session->set_flashdata('error_message', get_phrase('coupon_code_already_exists'));
            redirect(site_url('admin/coupons'), 'refresh');
        } elseif ($param1 == "edit") {
            // CHECK ACCESS PERMISSION
            check_permission('coupon');

            $response = $this->crud_model->edit_coupon($param2);
            $response ? $this->session->set_flashdata('flash_message', get_phrase('coupon_updated_successfully')) : $this->session->set_flashdata('error_message', get_phrase('coupon_code_already_exists'));
            redirect(site_url('admin/coupons'), 'refresh');
        } elseif ($param1 == "delete") {
            // CHECK ACCESS PERMISSION
            check_permission('coupon');

            $response = $this->crud_model->delete_coupon($param2);
            $response ? $this->session->set_flashdata('flash_message', get_phrase('coupon_deleted_successfully')) : $this->session->set_flashdata('error_message', get_phrase('coupon_code_already_exists'));
            redirect(site_url('admin/coupons'), 'refresh');
        }

        $page_data['page_name'] = 'coupons';
        $page_data['page_title'] = get_phrase('coupons');
        $page_data['coupons'] = $this->crud_model->get_coupons()->result_array();
        $this->load->view('backend/index', $page_data);
    }

    public function coupon_form($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('coupon');

        if ($param1 == 'add_coupon_form') {

            $page_data['page_name'] = 'coupon_add';
            $page_data['page_title'] = get_phrase('add_coupons');
            $this->load->view('backend/index', $page_data);
        } elseif ($param1 == 'edit_coupon_form') {

            $page_data['page_name'] = 'coupon_edit';
            $page_data['coupon'] = $this->crud_model->get_coupons($param2)->row_array();
            $page_data['page_title'] = get_phrase('coupon_edit');
            $this->load->view('backend/index', $page_data);
        }
    }
    // ADMINS SECTION ENDS



    // AJAX PORTION
    // this function is responsible for managing multiple choice question
    function quiz_fields_type_wize()
    {
        $page_data['question_type'] = $this->input->post('question_type');
        $this->load->view('backend/admin/quiz_fields_type_wize', $page_data);
    }

    public function ajax_get_sub_category($category_id)
    {
        $page_data['sub_categories'] = $this->crud_model->get_sub_categories($category_id);

        return $this->load->view('backend/admin/ajax_get_sub_category', $page_data);
    }

    public function ajax_get_section($course_id)
    {
        $page_data['sections'] = $this->crud_model->get_section('course', $course_id)->result_array();
        return $this->load->view('backend/admin/ajax_get_section', $page_data);
    }

    public function ajax_get_video_details()
    {
        $video_details = $this->video_model->getVideoDetails($_POST['video_url']);
        if (is_array($video_details)) {
            echo $video_details['duration'];
        }
    }
    public function ajax_sort_section()
    {
        $section_json = $this->input->post('itemJSON');
        $this->crud_model->sort_section($section_json);
    }
    public function ajax_sort_lesson()
    {
        $lesson_json = $this->input->post('itemJSON');
        $this->crud_model->sort_lesson($lesson_json);
    }
    public function ajax_sort_question()
    {
        $question_json = $this->input->post('itemJSON');
        $this->crud_model->sort_question($question_json);
    }
    public function ajax_sort_top_courses()
    {
        $top_courses_json = $this->input->post('itemJSON');
        $this->crud_model->sort_top_courses($top_courses_json);
    }
    public function ajax_sort_top_10_latest_courses()
    {
        $top_courses_json = $this->input->post('itemJSON');
        $this->crud_model->sort_top_10_latest_courses($top_courses_json);
    }
    public function ajax_sort_category_courses()
    {
        $top_courses_json = $this->input->post('itemJSON');
        $this->crud_model->sort_category_courses($top_courses_json);
    }




    //Start blog
    function add_blog_category()
    {
        $this->load->view('backend/admin/blog_category_add');
    }

    function edit_blog_category($blog_category_id = "")
    {
        $data['blog_category'] = $this->crud_model->get_blog_categories($blog_category_id)->row_array();
        $this->load->view('backend/admin/blog_category_edit', $data);
    }

    function blog_category($param1 = "", $param2 = "")
    {
        if ($param1 == 'add') {
            $response = $this->crud_model->add_blog_category();
            if ($response == true) {
                $this->session->set_flashdata('flash_message', get_phrase('blog_category_added_successfully'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('there_is_already_a_blog_with_this_name'));
            }
            redirect(site_url('admin/blog_category'), 'refresh');
        } elseif ($param1 == 'update') {
            $response = $this->crud_model->update_blog_category($param2);
            if ($response == true) {
                $this->session->set_flashdata('flash_message', get_phrase('blog_category_updated_successfully'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('there_is_already_a_blog_with_this_name'));
            }
            redirect(site_url('admin/blog_category'), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->crud_model->delete_blog_category($param2);
            $this->session->set_flashdata('flash_message', get_phrase('blog_category_deleted_successfully'));
            redirect(site_url('admin/blog_category'), 'refresh');
        }
        $page_data['categories'] = $this->crud_model->get_blog_categories();
        $page_data['page_title'] = get_phrase('blog_category');
        $page_data['page_name'] = 'blog_category';
        $this->load->view('backend/index', $page_data);
    }

    function add_blog()
    {
        $page_data['page_title'] = get_phrase('add_blog');
        $page_data['page_name'] = 'blog_add';
        $this->load->view('backend/index', $page_data);
    }

    function edit_blog($blog_id = "")
    {
        $page_data['blog'] = $this->crud_model->get_blogs($blog_id)->row_array();
        $page_data['page_title'] = get_phrase('edit_blog');
        $page_data['page_name'] = 'blog_edit';
        $this->load->view('backend/index', $page_data);
    }

    function blog($param1 = "", $param2 = "")
    {
        if ($param1 == 'add') {
            $this->crud_model->add_blog();
            $this->session->set_flashdata('flash_message', get_phrase('blog_added_successfully'));
            redirect(site_url('admin/blog'), 'refresh');
        } elseif ($param1 == 'update') {
            $this->crud_model->update_blog($param2);
            $this->session->set_flashdata('flash_message', get_phrase('blog_updated_successfully'));
            redirect(site_url('admin/blog'), 'refresh');
        } elseif ($param1 == 'status') {
            $this->crud_model->update_blog_status($param2);
            $this->session->set_flashdata('flash_message', get_phrase('blog_status_has_been_updated'));
            redirect(site_url('admin/blog'), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->crud_model->blog_delete($param2);
            $this->session->set_flashdata('flash_message', get_phrase('blog_deleted_successfully'));
            redirect(site_url('admin/blog'), 'refresh');
        }
        $page_data['blogs'] = $this->crud_model->get_blogs();
        $page_data['page_title'] = get_phrase('blog');
        $page_data['page_name'] = 'blog';
        $this->load->view('backend/index', $page_data);
    }

    function instructors_pending_blog($param1 = "", $param2 = "")
    {
        if ($param1 == 'approval_request') {
            $this->crud_model->approve_blog($param2);
            $this->session->set_flashdata('flash_message', get_phrase('the_blog_has_been_approved'));
            redirect(site_url('admin/instructors_pending_blog'), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->crud_model->blog_delete($param2);
            $this->session->set_flashdata('flash_message', get_phrase('blog_deleted_successfully'));
            redirect(site_url('admin/instructors_pending_blog'), 'refresh');
        }
        $page_data['pending_blogs'] = $this->crud_model->get_instructors_pending_blog();
        $page_data['page_title'] = get_phrase('instructors_pending_blog');
        $page_data['page_name'] = 'instructors_pending_blog';
        $this->load->view('backend/index', $page_data);
    }

    function blog_settings($param1 = "")
    {
        if ($param1 == 'update') {
            $this->crud_model->update_blog_settings();
            $this->session->set_flashdata('flash_message', get_phrase('blog_settings_updated_successfully'));
            redirect(site_url('admin/blog_settings'), 'refresh');
        }
        $page_data['page_title'] = get_phrase('blog_settings');
        $page_data['page_name'] = 'blog_settings';
        $this->load->view('backend/index', $page_data);
    }
    //End blog


    //Don't remove this code for security reasons
    function save_valid_purchase_code($param1 = "")
    {
        if ($param1 == 'update') {
            $data['value'] = htmlspecialchars_($this->input->post('purchase_code'));
            $status = $this->crud_model->curl_request($data['value']);
            if ($status) {
                $this->db->where('key', 'purchase_code');
                $this->db->update('settings', $data);
                $this->session->set_flashdata('flash_message', get_phrase('purchase_code_has_been_updated'));
                echo 1;
            } else {
                echo 0;
            }
        } else {
            $this->load->view('backend/admin/save_purchase_code_form');
        }
    }

    function drip_content_settings($param1 = "")
    {
        if ($param1 == 'update') {
            $this->crud_model->save_drip_content_settings();
            $this->session->set_flashdata('flash_message', get_phrase('drip_content_settings_updated_successfully'));
            redirect(site_url('admin/drip_content_settings'), 'refresh');
        }
        $page_data['drip_content_settings'] = json_decode(get_settings('drip_content_settings'), true);
        $page_data['page_title'] = get_phrase('drip_content_settings');
        $page_data['page_name'] = 'drip_content_settings';
        $this->load->view('backend/index', $page_data);
    }

    function custom_page($param1 = "", $param2 = "")
    {
        if ($param1 == 'add') {
            $this->crud_model->add_custom_page();
            $this->session->set_flashdata('flash_message', get_phrase('new_page_added_successfully'));
            redirect(site_url('admin/custom_page'), 'refresh');
        }

        if ($param1 == 'update') {
            $this->crud_model->update_custom_page($param2);
            $this->session->set_flashdata('flash_message', get_phrase('page_updated_successfully'));
            redirect(site_url('admin/custom_page'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_custom_page($param2);
            $this->session->set_flashdata('flash_message', get_phrase('page_deleted_successfully'));
            redirect(site_url('admin/custom_page'), 'refresh');
        }

        $page_data['custom_pages'] = $this->crud_model->get_custom_pages();
        $page_data['page_title'] = get_phrase('custom_pages');
        $page_data['page_name'] = 'custom_page';
        $this->load->view('backend/index', $page_data);
    }

    function add_custom_page($custom_page_id = "")
    {
        $page_data['page_title'] = get_phrase('add_custom_page');
        $page_data['page_name'] = 'add_custom_page';
        $this->load->view('backend/index', $page_data);
    }

    function edit_custom_page($custom_page_id = "")
    {
        $page_data['custom_page'] = $this->crud_model->get_custom_pages($custom_page_id)->row_array();
        $page_data['page_title'] = get_phrase('edit_custom_page');
        $page_data['page_name'] = 'edit_custom_page';
        $this->load->view('backend/index', $page_data);
    }





    //Start Academy Cloud coding
    function academy_cloud($param1 = "")
    {
        if ($param1 == 'update') {
            $this->academy_cloud_model->save_access_token();
            $this->session->set_flashdata('flash_message', get_phrase('access_token_saved_successfully'));
            redirect(site_url('admin/academy_cloud'), 'refresh');
        }

        $page_data['subscription_details'] = $this->academy_cloud_model->get_subscription_details();
        $page_data['cloud_videos'] = $this->academy_cloud_model->get_cloud_videos();
        $page_data['page_title'] = get_phrase('academy_cloud');
        $page_data['page_name'] = 'academy_cloud';
        $this->load->view('backend/index', $page_data);
    }
    //End of Academy Cloud coding


    //Start data center
    function data_center()
    {

        $page_data['page_title'] = get_phrase('data_center');
        $page_data['page_name'] = 'data_center';
        $this->load->view('backend/index', $page_data);
    }
    //End of data center

    //Select 2 server-side user data
    function get_select2_user_data($default = "")
    {
        $response = array();
        $result = $this->db->where('role_id !=', 1)->group_start()->like('first_name', $_GET['searchVal'])->or_like('last_name', $_GET['searchVal'])->or_like('email', $_GET['searchVal'])->group_end()->limit(100)->get('users')->result_array();
        if ($default != '') {
            $response[] = array(['id' => $default, 'text' => get_phrase($default)]);
        }
        foreach ($result as $key => $row) {
            $response[] = ['id' => $row['id'], 'text' => $row['first_name'] . ' ' . $row['last_name'] . '(' . $row['email'] . ')'];
        }
        echo json_encode($response);
    }
    //Select 2 server-side user data
    function get_select2_instructor_data($default = "")
    {
        $response = array();
        $result = $this->db->where('is_instructor', 1)->group_start()->like('first_name', $_GET['searchVal'])->or_like('last_name', $_GET['searchVal'])->or_like('email', $_GET['searchVal'])->group_end()->limit(100)->get('users')->result_array();
        if ($default != '') {
            $response[] = array(['id' => $default, 'text' => get_phrase($default)]);
        }
        foreach ($result as $key => $row) {
            $response[] = ['id' => $row['id'], 'text' => $row['first_name'] . ' ' . $row['last_name'] . ' (' . $row['email'] . ')'];
        }
        echo json_encode($response);
    }


    //Select 2 server-side enrollable data
    function get_select2_course_for_enroll($default = "")
    {
        $response = array();
        $result = $this->db->group_start()->where('status', 'active')->or_where('status', 'private')->group_end()->group_start()->like('title', $_GET['searchVal'])->or_like('description', $_GET['searchVal'])->group_end()->limit(100)->get('course')->result_array();
        if ($default != '') {
            $response[] = array(['id' => $default, 'text' => get_phrase($default)]);
        }
        foreach ($result as $key => $row) {
            $user = $this->user_model->get_all_user($row['creator'])->row_array();
            $response[] = ['id' => $row['id'], 'text' => $row['title'] . ' (' . get_phrase('Creator') . ': ' . $user['first_name'] . ' ' . $user['last_name'] . ')'];
        }
        echo json_encode($response);
    }

    //Select 2 server-side general data
    function get_select2_general_course($default = "")
    {
        $response = array();
        $result = $this->db->where('course_type', 'general')->group_start()->like('title', $_GET['searchVal'])->or_like('description', $_GET['searchVal'])->group_end()->limit(100)->get('course')->result_array();
        if ($default != '') {
            $response[] = array(['id' => $default, 'text' => get_phrase($default)]);
        }
        foreach ($result as $key => $row) {
            $user = $this->user_model->get_all_user($row['creator'])->row_array();
            $response[] = ['id' => $row['id'], 'text' => $row['title'] . ' (' . get_phrase('Creator') . ': ' . $user['first_name'] . ' ' . $user['last_name'] . ')'];
        }
        echo json_encode($response);
    }



    function instructor_payment($instructor_id = "")
    {
        $this->payment_model->configure_instructor_payment($instructor_id);
        redirect(site_url('payment'));
    }

    function open_ai_settings($param1 = "")
    {
        if ($param1 == "update") {
            $this->load->model('addons/ai_model');
            $this->ai_model->update_open_ai_settings();
        }
        $page_data['page_title'] = get_phrase('openai_settings');
        $page_data['page_name'] = 'open_ai_settings';
        $this->load->view('backend/index', $page_data);
    }

    function ai_img_download()
    {
        $this->load->model('addons/ai_model');
        $this->ai_model->ai_img_download();
    }

    function chat_gpt()
    {
        if (isset($_POST['service_type']) && !empty($_POST['service_type'])) {
            $this->load->model('addons/ai_model');
            echo $this->ai_model->chat_gpt();
        } else {
            $this->load->view('backend/admin/chat_gpt');
        }
    }

    function upload_theme()
    {
        if (is_array($_FILES) && count($_FILES) > 0) {
            move_uploaded_file($_FILES['theme_zip']['tmp_name'], 'themes/' . $_FILES['theme_zip']['name']);
            redirect(site_url('admin/theme_settings'), 'refresh');
        }
        $this->load->view('backend/admin/upload_theme');
    }

    function delete_course_review($rating_id = "")
    {
        $query = $this->db->where('id', $rating_id);
        $course_details = $this->db->where('id', $query->get('rating')->row('ratable_id'))->get('course')->row_array();
        $this->db->where('id', $rating_id)->delete('rating');

        $this->session->set_flashdata('flash_message', get_phrase('user_review_deleted_successfully'));
        if ($course_details['slug_count'] == 1 || $course_details['slug_count'] == 2) {
            $course_details_slug = $course_details['slug'];
        } else if ($course_details['slug_count'] == 3 || $course_details['slug_count'] == 4) {
            $course_details_slug = $course_details['category_slug'] . '/' . $course_details['sub_category_slug'] . '/' . $course_details['slug'];
        } else {
            $course_details_slug = $course_details['slug'];
        }
        redirect(site_url($course_details_slug), 'refresh');
    }

    //Start Notification
    function get_my_notification($type = "")
    {
        $user_id = $this->session->userdata('user_id');

        if ($type == 'mark_all_as_read') {
            $this->db->where('to_user', $user_id);
            $this->db->update('notifications', ['status' => 1]);
        }

        if ($type == 'remove_all') {
            $this->db->where('to_user', $user_id);
            $this->db->delete('notifications');
        }


        $this->db->where('to_user', $user_id);
        $this->db->limit(50);
        $query = $this->db->order_by('status ASC, id desc');
        $page_data['notifications'] = $query->get('notifications');

        if ($query->where('status', 0)->get('notifications')->num_rows() > 0) :
            $response['notification_icon_class'] = 'noti-icon-badge';
        else :
            $response['notification_icon_class'] = '';
        endif;
        $response['rendered_view'] = $this->load->view('backend/header_notification', $page_data, true);

        echo json_encode($response);
    }
    //End notification


    function language_import()
    {
        $this->load->dbforge();

        foreach ($_FILES['language_files']['name'] as $key => $language) {
            $language_name = strtolower(preg_replace('/\s+/', '_', explode('.', $_FILES['language_files']['name'][$key])[0]));
            //Create language column if not exist
            if (!$this->db->field_exists($language_name, 'language')) {
                $fields = array(
                    $language_name => array(
                        'type' => 'LONGTEXT',
                        'default' => null,
                        'null' => TRUE,
                        'collation' => 'utf8_unicode_ci'
                    )
                );
                $this->dbforge->add_column('language', $fields);
            }

            $language_content_arr = json_decode(file_get_contents($_FILES['language_files']['tmp_name'][$key]), true);
            if (is_array($language_content_arr)) {
                //Upload the json file
                move_uploaded_file($_FILES['language_files']['tmp_name'][$key], 'application/language/' . $language_name . '.json');
            } else {
                $this->session->set_flashdata('error_message', get_phrase('JSON_validation_failed') . '!');
                redirect(site_url('admin/manage_language'), 'refresh');
            }

            foreach ($language_content_arr as $phrase_key => $phrase) {
                $phrase_key = strtolower(preg_replace('/\s+/', '_', $phrase_key));
                $query = $this->db->get_where('language', ['phrase' => $phrase_key]);

                if ($query->num_rows() > 0) {
                    $this->db->where('phrase', $phrase_key);
                    $this->db->update('language', [$language_name => $phrase]);
                } else {
                    $this->db->insert('language', ['phrase' => $phrase_key, $language_name => $phrase]);
                }
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('language_file_import_successfully'));
        redirect(site_url('admin/manage_language'), 'refresh');
    }

    function export_language($language)
    {
        $this->load->helper('download');
        $language = strtolower($language);
        $json_content = array();

        foreach ($this->db->get('language')->result_array() as $row) {
            $json_content[$row['phrase']] = $row[$language];
        }
        force_download($language . '.json', json_encode($json_content));
    }

    function subscribed_user($type = "", $id = "")
    {
        if ($type == 'delete') {
            $this->db->where('id', $id)->delete('newsletter_subscriber');
            $this->session->set_flashdata('flash_message', get_phrase('Newsletter subscription deleted successfully'));
            redirect(site_url('admin/subscribed_user'), 'refresh');
        }

        if ($_POST) {
            $data = array();
            //mentioned all with colum of database table that related with html table
            $columns = array('id', 'email', 'id', 'id');

            $limit = htmlspecialchars_($this->input->post('length'));
            $start = htmlspecialchars_($this->input->post('start'));

            $column_index = $columns[$this->input->post('order')[0]['column']];

            $dir = $this->input->post('order')[0]['dir'];
            $total_number_of_row = $this->db->get('newsletter_subscriber')->num_rows();

            $filtered_number_of_row = $total_number_of_row;
            $search = $this->input->post('search')['value'];

            if (empty($search)) {
                $this->db->select('*');
                $this->db->limit($limit, $start);
                $this->db->order_by($column_index, $dir);
                $newsletter_subscriber = $this->db->get('newsletter_subscriber')->result_array();
            } else {
                $this->db->select('*');
                $this->db->like('email', $search);
                $this->db->limit($limit, $start);
                $this->db->order_by($column_index, $dir);
                $newsletter_subscriber = $this->db->get('newsletter_subscriber')->result_array();

                $filtered_number_of_row = count($newsletter_subscriber);
            }

            foreach ($newsletter_subscriber as $key => $row) :
                $user_row = $this->db->where('email', $row['email'])->get('users');
                //user email
                $email = $row['email'];


                if ($user_row->num_rows() > 0) {
                    if ($user_row->row('is_instructor') != 1) {
                        $user_status = '<p class="my-0">' . $user_row->row('first_name') . ' ' . $user_row->row('last_name') . '</p>';
                        $user_status .= '<span class="badge badge-primary">' . get_phrase('Student') . '</span>';
                    } else {
                        $user_status = '<p class="my-0">' . $user_row->row('first_name') . ' ' . $user_row->row('last_name') . '</p>';
                        $user_status .= '<span class="badge badge-success">' . get_phrase('Instructor') . '</span>';
                    }
                } else {
                    $user_status = '<span class="badge badge-warning">' . get_phrase('Not registered') . '</span>';
                }


                $action = '<div class="dropright dropright">
                                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="confirm_modal(&#39;' . site_url('admin/subscribed_user/delete/' . $row['id']) . '&#39;);">' . get_phrase('delete') . '</a></li>
                                </ul>
                            </div>';


                $nestedData['key'] = ++$key;
                $nestedData['email'] = $email;
                $nestedData['user_status'] = $user_status;
                $nestedData['action'] = $action . '<script>$("a, i").tooltip();</script>';
                $data[] = $nestedData;
            endforeach;

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($total_number_of_row),
                "recordsFiltered" => intval($filtered_number_of_row),
                "data"            => $data
            );
            echo json_encode($json_data);
        } else {
            $page_data['page_name'] = 'subscribed_user';
            $page_data['page_title'] = get_phrase('Subscribed user');
            $this->load->view('backend/index', $page_data);
        }
    }

    function newsletter_add_form()
    {
        $this->load->view('backend/admin/add_newsletter');
    }

    function newsletter_edit_form($id)
    {
        $page_data['newsletter'] = $this->db->where('id', $id)->get('newsletters')->row_array();
        $this->load->view('backend/admin/edit_newsletter', $page_data);
    }

    function newsletter_send_form($id)
    {
        $page_data['newsletter'] = $this->db->where('id', $id)->get('newsletters')->row_array();
        $this->load->view('backend/admin/send_newsletter', $page_data);
    }

    function newsletters($type = "", $id = "")
    {
        if ($type == 'add') {
            $this->crud_model->add_newsletter();
            $this->session->set_flashdata('flash_message', get_phrase('Newsletter added successfully'));
            redirect(site_url('admin/newsletters'), 'refresh');
        }
        if ($type == 'edit') {
            $this->crud_model->update_newsletter($id);
            $this->session->set_flashdata('flash_message', get_phrase('Newsletter updated successfully'));
            redirect(site_url('admin/newsletters?tab=' . $id), 'refresh');
        }

        if ($type == 'send') {
            $to = array();

            $subject = $this->input->post('subject');
            $description = $this->input->post('description', false);
            $send_to = $this->input->post('send_to');

            if ($send_to == 'all') {
                $all_users = $this->db->where('status', 1)->get('users')->result_array();
                foreach ($all_users as $key => $all_user) :
                    $to[] = $all_user['email'];
                endforeach;
            } elseif ($send_to == 'student') {
                $all_users = $this->db->where('status', 1)->where('is_instructor !=', 1)->get('users')->result_array();
                foreach ($all_users as $key => $all_user) :
                    $to[] = $all_user['email'];
                endforeach;
            } elseif ($send_to == 'instructor') {
                $all_users = $this->db->where('status', 1)->where('is_instructor', 1)->get('users')->result_array();
                foreach ($all_users as $key => $all_user) :
                    $to[] = $all_user['email'];
                endforeach;
            } elseif ($send_to == 'all_subscriber') {
                $all_subscriber = $this->db->get('newsletter_subscriber')->result_array();
                foreach ($all_subscriber as $key => $subscriber) :
                    $to[] = $subscriber['email'];
                endforeach;
            } elseif ($send_to == 'registered_subscriber') {
                $all_subscriber = $this->db->get('newsletter_subscriber')->result_array();
                foreach ($all_subscriber as $key => $subscriber) :
                    $registration = $this->db->where('status', 1)->where('email', $subscriber['email'])->get('users');
                    if ($registration->num_rows() > 0) {
                        $to[] = $subscriber['email'];
                    }
                endforeach;
            } elseif ($send_to == 'non_registered_subscriber') {
                $all_subscriber = $this->db->get('newsletter_subscriber')->result_array();
                foreach ($all_subscriber as $key => $subscriber) :
                    $registration = $this->db->where('status', 1)->where('email', $subscriber['email'])->get('users');
                    if ($registration->num_rows() == 0) {
                        $to[] = $subscriber['email'];
                    }
                endforeach;
            } elseif ($send_to == 'selected_user') {
                $user_ids = $this->input->post('user_id');
                $all_users = $this->db->where_in('id', $user_ids)->get('users')->result_array();
                foreach ($all_users as $key => $all_user) :
                    $to[] = $all_user['email'];
                endforeach;
            }


            $email_data['subject'] = $subject;
            $email_data['message'] = $description;
            $email_template = $this->load->view('email/static_common_template', $email_data, TRUE);
            $this->email_model->send_smtp_mail($email_template, $subject, $to);
            $this->session->set_flashdata('flash_message', get_phrase('Newsletter sent successfully'));
            redirect(site_url('admin/newsletters'), 'refresh');
        }

        if ($type == 'delete') {
            $this->crud_model->delete_newsletter($id);
            $this->session->set_flashdata('flash_message', get_phrase('Newsletter deleted successfully'));
            redirect(site_url('admin/newsletters'), 'refresh');
        }
        $page_data['page_name'] = 'newsletters';
        $page_data['page_title'] = get_phrase('Newsletters');
        $this->load->view('backend/index', $page_data);
    }

    function student_academic_progress($course_id = "")
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $multi_instructors = explode(',', $course_details['user_id']);


        $page_data['course_details'] = $course_details;
        $this->load->view('backend/admin/student_academic_progress', $page_data);
    }

    function student_academic_quiz_result($course_id = "", $student_id = "")
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $multi_instructors = explode(',', $course_details['user_id']);

        if (!in_array($this->session->userdata('user_id'), $multi_instructors)) {
            return false;
        }

        $page_data['course_details'] = $course_details;
        $page_data['student_id'] = $student_id;
        $this->load->view('backend/admin/student_academic_quiz_result', $page_data);
    }

    function home_page_layout($home_page = "")
    {
        $this->db->where('key', 'home_page');
        $this->db->update('frontend_settings', ['value' => $home_page]);
        $this->session->set_flashdata('flash_message', get_phrase('New home page layout has been activated'));
        redirect(site_url('admin/frontend_settings?tab=homePageLayout'), 'refresh');
    }


    function student_certificate($user_id = "", $course_id = "")
    {
        $this->load->model('addons/Certificate_model', 'certificate_model');
        $course_progress = $this->crud_model->get_watch_histories($user_id, $course_id)->row('course_progress');
        if ($course_progress >= 100) {
            $this->certificate_model->check_certificate_eligibility($course_id, $user_id);
            $certificate = $this->db->get_where('certificates', array('course_id' => $course_id, 'student_id' => $user_id));
            redirect(site_url('certificate/' . $certificate->row('shareable_url')));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('The course is not compleated yet'));
            redirect(site_url('admin/course_form/course_edit/' . $course_id . '?tab=academic_progress'));
        }
    }

    function contact($type = "", $id = "")
    {
        if ($type == 'delete') {
            $this->db->where('id', $id)->delete('contact');
            $this->session->set_flashdata('flash_message', get_phrase('Contact deleted successfully'));
            redirect(site_url('admin/contact'), 'refresh');
        }

        if ($type == '') {
            $page_data['page_name'] = 'contact';
            $page_data['page_title'] = get_phrase('Contact');
            $this->load->view('backend/index', $page_data);
        }

        if ($type == 'contact_reply_form' && $id != '') {
            $page_data['contact'] = $this->crud_model->get_contacts($id)->row_array();
            $this->load->view('backend/admin/contact_reply_form', $page_data);
        }

        if ($type == 'send_reply' && $id != '') {
            $message = $this->input->post('reply_message');
            $contact_details = $this->crud_model->get_contacts($id)->row_array();
            $this->email_model->send_smtp_mail($message, get_phrase('Reply from - ') . get_settings('system_name'), $contact_details['email']);
            $this->db->where('id', $id)->update('contact', ['replied' => 1]);
            $this->session->set_flashdata('flash_message', get_phrase('Reply sent successfully'));
            redirect(site_url('admin/contact'), 'refresh');
        }

        if ($type == 'data-table' && $_GET) {
            $this->db->where('has_read', null)->update('contact', ['has_read' => 1]);

            $data = array();
            //mentioned all with colum of database table that related with html table
            $columns = array('id', 'first_name', 'email', 'message', 'id');

            $limit = htmlspecialchars_($this->input->get('length'));
            $start = htmlspecialchars_($this->input->get('start'));

            $column_index = $columns[$this->input->get('order')[0]['column']];

            $dir = $this->input->get('order')[0]['dir'];
            $total_number_of_row = $this->db->get('contact')->num_rows();

            $filtered_number_of_row = $total_number_of_row;
            $search = $this->input->get('search')['value'];

            if (empty($search)) {
                $this->db->limit($limit, $start);
                $this->db->order_by($column_index, $dir);
                $contacts = $this->db->get('contact')->result_array();
            } else {
                $this->db->like('first_name', $search);
                $this->db->or_like('last_name', $search);
                $this->db->or_like('email', $search);
                $this->db->or_like('phone', $search);
                $this->db->or_like('address', $search);
                $this->db->or_like('message', $search);
                $this->db->limit($limit, $start);
                $this->db->order_by($column_index, $dir);
                $contacts = $this->db->get('contact');
                $filtered_number_of_row = $contacts->num_rows();
                $contacts = $contacts->result_array();
            }

            foreach ($contacts as $key => $row) :
                if ($row['replied'] == 1) :
                    $reply_sent = ' <i class="fas fa-check-circle text-success" title="' . get_phrase('Reply sent') . '" data-toggle="tooltip"></i>';
                else :
                    $reply_sent = '';
                endif;

                $user_row = $this->db->where('email', $row['email'])->get('users');
                if ($user_row->num_rows() > 0) {
                    if ($user_row->row('is_instructor') != 1) {
                        $user_status = '<span class="badge badge-primary">' . get_phrase('Student') . '</span>';
                    } else {
                        $user_status = '<span class="badge badge-success">' . get_phrase('Instructor') . '</span>';
                    }
                } else {
                    $user_status = '<span class="badge badge-warning">' . get_phrase('Not registered') . '</span>';
                }


                $contact_info = '<p class="my-0">' . get_phrase('Email') . ': <a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></p>';
                if ($row['phone'] != '') {
                    $contact_info .= '<p class="my-0">' . get_phrase('Phone') . ': <a href="tel:' . $row['phone'] . '">' . $row['phone'] . '</a></p>';
                }
                if ($row['address'] != '') {
                    $contact_info .= '<p class="my-0">' . $row['address'] . '</a></p>';
                }



                $action = '<div class="dropright dropright">
                                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="showAjaxModal(&#39;' . site_url('admin/contact/contact_reply_form/' . $row['id']) . '&#39;, &#39;' . get_phrase('Reply to ' . $row['first_name'] . ' ' . $row['last_name']) . '&#39;);">' . get_phrase('Reply') . '</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirm_modal(&#39;' . site_url('admin/contact/delete/' . $row['id']) . '&#39;);">' . get_phrase('delete') . '</a></li>
                                </ul>
                            </div>';


                $nestedData['key'] = ++$key;
                $nestedData['name'] = '<p class="my-0">' . $row['first_name'] . ' ' . $row['last_name'] . $reply_sent . '</p>' . $user_status;
                $nestedData['contact'] = $contact_info;
                $nestedData['message'] = $row['message'];
                $nestedData['action'] = $action . '<script>$("a, i").tooltip();</script>';
                $data[] = $nestedData;
            endforeach;

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($total_number_of_row),
                "recordsFiltered" => intval($filtered_number_of_row),
                "data"            => $data
            );
            echo json_encode($json_data);
        }
    }

    function update_language_direction()
    {
        $language = $this->input->post('language');
        $dir = $this->input->post('dir');
        $language_dirs = get_settings('language_dirs') ? json_decode(get_settings('language_dirs'), true) : ['english' => 'ltr'];

        $language_dirs[$language] = $dir;

        $data['value'] = json_encode($language_dirs);

        if ($this->db->get_where('settings', ['key' => 'language_dirs'])->num_rows() > 0) {
            $this->db->where('key', 'language_dirs')->update('settings', $data);
        } else {
            $data['key'] = 'language_dirs';
            $this->db->insert('settings', $data);
        }
        echo get_phrase('Language direction updated successfully');
    }

    public function ratings_count_form($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');
        $page_data['page_name'] = 'ratings_count_form';
        $page_data['page_title'] = get_phrase('ratings_count_form');
        $this->load->view('backend/index', $page_data);
    }

    public function custom_reviews($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');
        $page_data['page_name'] = 'custom_reviews';
        $page_data['page_title'] = get_phrase('custom_reviews');
        $this->load->view('backend/index', $page_data);
    }

    public function generate_certificate($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        $page_data['page_name'] = 'generate_certificate';
        $page_data['page_title'] = get_phrase('generate_certificate');
        $this->load->view('backend/index', $page_data);
    }

    public function user_login_history()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        if ($this->input->post('user_id')) {
            $page_data['user_login_history'] = $this->crud_model->user_login_history_by_user_id($this->input->post('user_id'));
        } else {
            $page_data['user_login_history'] = $this->crud_model->user_login_history();
        }
        // CHECK ACCESS PERMISSION
        $page_data['page_name'] = 'user_login_history';
        $page_data['page_title'] = get_phrase('user_login_history');
        $this->load->view('backend/index', $page_data);
    }

    public function generate_certificate_manually()
    {
        $user_id = $this->input->post('user_id');
        $course_id = $this->input->post('course_id');
        $certificate_identifier = $this->api_model->certificate_addon_get_forcefully($user_id, $course_id);
        if ($certificate_identifier) {
            $certificate = $this->db->get_where('certificates', array('course_id' => $course_id, 'student_id' => $user_id));
            redirect(site_url('certificate/' . $certificate->row('shareable_url')));
        }
    }

    public function customsettings($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        if ($param1 == 'ratings_count_form') {
            $this->crud_model->save_ratings_count();
            redirect(site_url('admin/ratings_count_form'), 'refresh');
        } else if ($param1 == 'custom_reviews_form') {
            $this->crud_model->save_custom_reiews();
            redirect(site_url('admin/custom_reviews'), 'refresh');
        } else if ($param1 == "broucher_form") {
            $this->crud_model->save_broucher_form();
            redirect(site_url('admin/broucher'), 'refresh');
        } else if ($param1 == "upload_curriculam") {
            $this->crud_model->upload_curriculam();
            redirect(site_url('admin/upload_curriculam'), 'refresh');
        } else if ($param1 == "add_payment") {
            $this->crud_model->add_payment();
            redirect(site_url('admin/payments_list'), 'refresh');
        } else if ($param1 == 'generate_image_link') {
            $file_name = $this->crud_model->generate_image_link();
            $this->session->set_flashdata('flash_message', $file_name);
            redirect(site_url('admin/generate_image_link'), 'refresh');
        } else if ($param1 == 'copy_course_data') {
            $file_name = $this->crud_model->copy_curriculum();
            $this->session->set_flashdata('flash_message', $file_name);
            redirect(site_url('admin/copycoursedata'), 'refresh');
        }

        // $page_data['page_name'] = 'enrol_student';
        // $page_data['page_title'] = get_phrase('course_enrolment');
        // $this->load->view('backend/index', $page_data);
    }

    public function generate_image_link()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        $page_data['page_name'] = 'generate_image_link';
        $page_data['page_title'] = get_phrase('generate_image_link');
        $this->load->view('backend/index', $page_data);
    }

    public function fetch_review_count()
    {
        $id = $this->input->post('id');
        $data = $this->crud_model->get_ratings_count($id);
        echo json_encode(array("data" => $data));
    }


    public function get_custom_reviews()
    {
        $id = $this->input->post('id');
        $data = $this->crud_model->get_custom_reviews($id);
        echo json_encode(array("data" => $data));
    }

    public function contactus()
    {
        $page_data['page_name'] = 'contactus';
        $page_data['page_title'] = "Contact Us";
        $page_data['contactus'] = $this->crud_model->getAllContactUs();
        $this->load->view('backend/index', $page_data);
    }

    public function feedback()
    {
        $page_data['page_name'] = 'feedback';
        $page_data['page_title'] = "Contact Us";
        $page_data['feedbacks'] = $this->crud_model->getAllFeedback();
        $this->load->view('backend/index', $page_data);
    }

    public function demorequests()
    {
        $page_data['page_name'] = 'demorequests';
        $page_data['page_title'] = "Contact Us";
        $page_data['demorequests'] = $this->crud_model->getAllDemoRequests();
        $this->load->view('backend/index', $page_data);
    }

    public function cartpagevisitors()
    {
        $page_data['page_name'] = 'cartpagevisitors';
        $page_data['page_title'] = "Cart Page Visitors";
        $page_data['cartpagevisitors'] = $this->crud_model->getAllCartpagevisitors();
        $this->load->view('backend/index', $page_data);
    }

    public function broucher()
    {
        $page_data['page_name'] = 'broucher';
        $page_data['page_title'] = "Broucher";
        $this->load->view('backend/index', $page_data);
    }

    public function fetch_broucher()
    {
        $id = $this->input->post('id');
        $data = $this->user_model->get_broucher_url_of_custom_review($id);
        echo json_encode(array("data" => $data));
    }

    function download_enrol_history()
    {
        $enrol_data = [];
        $enrol_data = $this->crud_model->getEnrolHistory();
        $page_data['page_name'] = 'excel_export_view';

        $page_data['page_title'] = "Enrol History Download";
        $page_data['enrol_history'] = $enrol_data;
        $this->load->view('backend/index', $page_data);
        // redirect(site_url('admin/excel_export_view'), 'refresh');
    }

    public function enrol_history_edit($param1 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'edit_enrol_student';
        $page_data['enrolment_data'] = $this->crud_model->get_enrol_history($param1);
        $page_data['page_title'] = "Edit Enrolment";
        $this->load->view('backend/index', $page_data);
    }

    public function user_actions()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'user_actions';
        $page_data['user_actions'] = $this->crud_model->user_actions();
        $page_data['page_title'] = "User Actions";
        $this->load->view('backend/index', $page_data);
    }

    public function installment_settings()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'installment_settings';
        $page_data['installment_settings'] = $this->crud_model->get_installment_settings();
        $page_data['page_title'] = "Installment Settings";
        $this->load->view('backend/index', $page_data);
    }

    public function payments_list()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'payments_list';
        $page_data['payments_list'] = $this->crud_model->payments_list();
        $page_data['page_title'] = "Payments List";
        $this->load->view('backend/index', $page_data);
    }
    public function add_payments()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'add_payments';
        $page_data['page_title'] = "Add Payments";
        $this->load->view('backend/index', $page_data);
    }
    public function course_feedback()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'course_feedback';
        $page_data['page_title'] = "Course Feedback";
        $course_feedback = $this->crud_model->course_feedbacks_list();
        $page_data['course_feedbacks'] = $course_feedback;
        $this->load->view('backend/index', $page_data);
    }

    public function pause_user()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');
        $page_data['enrol_user_data'] = $this->crud_model->enrolment_details();
        $page_data['logs'] = $this->crud_model->getAllPausedUserLog();
        $page_data['page_name'] = 'pause_user';
        $page_data['page_title'] = "Pause User";
        $this->load->view('backend/index', $page_data);
    }

    public function update_pause_user($id)
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');
        $page_data['enrol_user_data'] = $this->crud_model->getPauseRecord($id);
        $page_data['data'] = $this->crud_model->getAllPausedUserLog()->row();
        $page_data['page_name'] = 'update_pause_user';
        $page_data['page_title'] = "Update Pause User";
        $this->load->view('backend/index', $page_data);
    }

    public function user_status_modification()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');
        $page_data['enrol_user_data'] = $this->crud_model->enrolment_details();
        $page_data['page_name'] = 'user_status_modification';
        $page_data['page_title'] = "Pause / Resume User";
        $this->load->view('backend/index', $page_data);
    }


    public function jobs($action = "", $id = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');
        $this->load->model('Job_model');

        if ($action == "add") {
            $page_data['page_name'] = 'add_job';
            $page_data['page_title'] = "Add Job";
        } else if ($action == "view") {
            $page_data['page_name'] = 'view_job';
            $page_data['page_title'] = "View Job";
            $page_data['job'] = $this->Job_model->get_jobs($id);
        } else if ($action == "edit") {
            $page_data['page_name'] = 'edit_job';
            $page_data['page_title'] = "Edit Job";
            $page_data['job'] = $this->Job_model->get_jobs($id);
        } else if ($action == "delete") {
            $this->Job_model->delete_job($id);
            $this->session->set_flashdata('flash_message', get_phrase('job_deleted_successfully'));
            redirect(site_url('admin/jobs'), 'refresh');
        } else {
            $page_data['jobs'] = $this->Job_model->get_jobs();
            $page_data['page_name'] = 'jobs';
            $page_data['page_title'] = "Jobs";
        }

        $this->load->view('backend/index', $page_data);
    }

    public function create_job()
    {
        $this->load->model('Job_model');

        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'company_name' => $this->input->post('company_name'),
            'employment_type' => $this->input->post('employment_type'),
            'location' => $this->input->post('location'),
            'min_pay_scale' => $this->input->post('min_pay_scale'),
            'max_pay_scale' => $this->input->post('max_pay_scale'),
            'min_experience' => $this->input->post('min_experience'),
            'max_experience' => $this->input->post('max_experience'),
            'qualification' => json_encode($this->input->post('qualification')), // Assuming qualification is an array
            'required_skills' => json_encode($this->input->post('required_skills')), // Assuming required_skills is an array
            'work_mode' => $this->input->post('work_mode'),
            'industry' => $this->input->post('industry'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->Job_model->add_job($data);
        redirect(site_url('admin/jobs'), 'refresh');
    }

    public function update_job($id)
    {
        $this->load->model('Job_model');
        $update_data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'company_name' => $this->input->post('company_name'),
            'employment_type' => $this->input->post('employment_type'),
            'location' => $this->input->post('location'),
            'min_pay_scale' => $this->input->post('min_pay_scale'),
            'max_pay_scale' => $this->input->post('max_pay_scale'),
            'min_experience' => $this->input->post('min_experience'),
            'max_experience' => $this->input->post('max_experience'),
            'qualification' => json_encode($this->input->post('qualification')), // Assuming qualification is an array
            'required_skills' => json_encode($this->input->post('required_skills')), // Assuming required_skills is an array
            'work_mode' => $this->input->post('work_mode'),
            'industry' => $this->input->post('industry'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->Job_model->update_job($id, $update_data);
        redirect(site_url('admin/jobs'), 'refresh');
    }
    public function course_feedback_ciriterias()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'add_criteria';
        $page_data['page_title'] = "Add Criteria";
        $criterias = $this->db->get('criterias')->row_array();
        $page_data['criteria_details'] = $criterias;
        $this->load->view('backend/index', $page_data);
    }

    public function add_criteria()
    {
        $criteria = array();
        if (!empty($this->input->post('criteria_title'))) :
            foreach (array_filter($this->input->post('criteria_title')) as $criteria_key => $criteria_title) {
                $criteria[$criteria_key] = $criteria_title;
            }
            $this->crud_model->add_criteria($criteria);
            $this->session->set_flashdata('flash_message', get_phrase('criteria_has_been_updated_successfully'));

            $page_data['page_name'] = 'add_criteria';
            $page_data['page_title'] = "Add Criteria";
            $criterias = $this->db->get('criterias')->row_array();
            $page_data['criteria_details'] = $criterias;
            $this->load->view('backend/index', $page_data);
        endif;
    }

    public function view_course_feedback($id)
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'view_course_feedback';
        $page_data['page_title'] = "View Course Feedback";
        $this->db->where('id', $id);
        $course_feedback = $this->crud_model->view_course_feedback($id); //$this->db->get('course_feedback')->row_array();
        $page_data['existed_feedback'] = $course_feedback;
        $this->load->view('backend/index', $page_data);
    }

    public function edit_payments($id)
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'edit_payments';
        $page_data['data'] = $this->crud_model->manual_payment_details($id);
        $page_data['page_title'] = "Edit Payments";
        $this->load->view('backend/index', $page_data);
    }


    public function chapters($param1 = "", $param2 = "", $param3 = "")
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('course');

        if ($param2 == 'add') {
            $this->crud_model->add_chapter($param1);
            $this->session->set_flashdata('flash_message', get_phrase('chapter_has_been_added_successfully'));
        } elseif ($param2 == 'edit') {
            $this->crud_model->edit_chapter($param3);
            $this->session->set_flashdata('flash_message', get_phrase('chapter_has_been_updated_successfully'));
        } elseif ($param2 == 'delete') {
            $this->crud_model->delete_chapter($param1, $param3);
            $this->session->set_flashdata('flash_message', get_phrase('chapter_has_been_deleted_successfully'));
        }
        redirect(site_url('admin/course_form/course_edit/' . $param1));
    }

    public function getChaptersBySectionId()
    {
        $data =  $this->crud_model->get_chapters('section', $_POST['section_id'])->result_array();
        echo json_encode(array('data' => $data));
    }

    public function ajax_sort_chapter()
    {
        $chapter_json = $this->input->post('itemJSON');
        $this->crud_model->sort_chapter($chapter_json);
    }


    public function upload_curriculam()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'upload_curriculam';
        $page_data['page_title'] = "User Actions";
        $this->load->view('backend/index', $page_data);
    }

    public function get_student_active_enrolments()
    {
        $data =  $this->crud_model->get_student_active_enrolments($_POST['student_id'])->result_array();
        echo json_encode(array('data' => $data));
    }

    public function update_installment_settings()
    {
        $response = $this->crud_model->update_installment_settings();
        if ($response) {
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('failed_to_update_data'));
        }
        redirect(site_url('admin/installment_settings'), 'refresh');
    }

    public function add_payment()
    {
        $response = $this->crud_model->add_payment();
        if ($response) {
            $this->session->set_flashdata('flash_message', get_phrase('payment_added_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('failed_to_add_payment'));
        }
        redirect(site_url('admin/payments_list'), 'refresh');
    }
    public function delete_payment($id)
    {
        $response = $this->crud_model->delete_payment($id);
        if ($response) {
            $this->session->set_flashdata('flash_message', get_phrase('payment_added_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('failed_to_add_payment'));
        }
        redirect(site_url('admin/payments_list'), 'refresh');
    }

    public function payment_notification_settings()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'payment_notification_settings';
        $page_data['payment_notification_settings'] = $this->crud_model->get_payment_notification_settings();
        $page_data['page_title'] = "payment_notification Settings";
        $this->load->view('backend/index', $page_data);
    }

    public function sort_courses()
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        // CHECK ACCESS PERMISSION
        check_permission('enrolment');

        $page_data['page_name'] = 'sort_courses';
        $page_data['page_title'] = "Sort Courses";
        $this->load->view('backend/index', $page_data);
    }

    public function add_payment_notification_settings()
    {
        $response = $this->crud_model->add_payment_notification_settings();
        if ($response) {
            $this->session->set_flashdata('flash_message', get_phrase('added_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('failed_to_add'));
        }
        redirect(site_url('admin/payment_notification_settings'), 'refresh');
    }

    public function get_payment_notification_setting()
    {
        $data =  $this->crud_model->get_payment_notification_setting($_POST['student_id']);
        echo json_encode(array('data' => $data));
    }

    public function manage_instructor_visibility($id, $status = 0)
    {
        log_message("error", "Id : " . $id . ", status : " . $status);
        $response = $this->crud_model->manage_instructor_visibility($id, $status);
        if ($response) {
            $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('failed_to_update'));
        }
        redirect(site_url('admin/instructors'), 'refresh');
    }

    public function copycoursedata()
    {
        $page_data['page_name'] = 'copycoursedata';
        $page_data['page_title'] = "Cart Page Visitors";
        $this->load->view('backend/index', $page_data);
    }

    public function get_user_status()
    {
        $data =  $this->crud_model->get_user_status($_POST['student_id'])->result_array();
        echo json_encode(array('data' => $data));
    }

    public function modify_user_status_old()
    {
        $user_id = $_POST['user_id'];
        $current_status = $_POST['current_status'];
        $from_date = $_POST['from_date'];
        //$to_date = $_POST['to_date'];
        /*if(date('Y-m-d', strtotime($from_date)) > date('Y-m-d', strtotime($to_date))){
            $this->session->set_flashdata('error_message', get_phrase('please select correct date range'));
            redirect(site_url('admin/user_status_modification'),'refresh');
        }*/

        $data =  [];
        if ($current_status == 1) {
            $data['status'] = 3;
            $data['paused_from_date'] = $from_date;
            //$data['paused_to_date'] = $to_date;
            $this->db->where('id', $user_id);
            $updated = $this->db->update('users', $data);
        } else if ($current_status == 3) {
            $data['status'] = 1;
            $data['paused_from_date'] = null;
            //$data['paused_to_date'] = null;
            $date1 = date_create($_POST['paused_from_date']);
            $date2 = date_create(date("Y-m-d"));
            $diff = date_diff($date1, $date2);
            if ($diff->invert == 0) {
                $updated = $this->crud_model->update_enrol_expiry_date($user_id, $diff->days, $_POST['paused_from_date']);
            } else {
                $updated = true;
            }

            if ($updated) {
                $this->db->where('id', $user_id);
                $updated = $this->db->update('users', $data);
            }
        }

        if ($updated) {
            $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('failed_to_update'));
        }
        redirect(site_url('admin/user_status_modification'), 'refresh');
    }

    public function modify_user_status()
    {
        $user_id = $_POST['user_id'];
        $current_status = $_POST['current_status'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        if (date('Y-m-d', strtotime($from_date)) > date('Y-m-d', strtotime($to_date))) {
            $this->session->set_flashdata('error_message', get_phrase('please select correct date range'));
            redirect(site_url('admin/user_status_modification'), 'refresh');
        }

        if ($this->check_date_overlap($from_date, $to_date, $user_id)) {
            $this->session->set_flashdata('error_message', get_phrase('A record already exists with overlapping dates.'));
        } else {
            $data =  [];
            //update user status as paused if from date and today are same
            if (date("Y-m-d") == $from_date) {
                $data['status'] = 3;
                $this->db->where('id', $user_id);
                $this->db->update('users', $data);
            }


            //insert paused dates into pause user table
            $data = [];
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            $data['user_id'] = $user_id;
            $updated = $this->db->insert("pause_user", $data);

            if ($updated) {
                $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('failed_to_update'));
            }
        }


        redirect(site_url('admin/pause_user'), 'refresh');
    }

    public function update_user_status_automatically()
    {
    }


    public function pause_user_log()
    {
        $page_data['page_name'] = 'pause_user_log';
        $page_data['page_title'] = "Pause Use Log";
        $page_data['logs'] = $this->crud_model->getAllPausedUserLog();
        $this->load->view('backend/index', $page_data);
    }

    public function delete_pause_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pause_user');
        $this->session->set_flashdata('flash_message', get_phrase('deleted_successfully'));
        redirect(site_url('admin/pause_user'), 'refresh');
    }

    public function update_pause_user_record($id)
    {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $user_id = $_POST['user_id'];

        if ($this->check_date_overlap($from_date, $to_date, $user_id, $id)) {
            $this->session->set_flashdata('error_message', get_phrase('A record already exists with overlapping dates.'));
        } else {
            $data = [];
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            $this->db->where('id', $id);
            $updated = $this->db->update('pause_user', $data);
            if ($updated) {
                $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('failed_to_update'));
            }
        }
        redirect(site_url('admin/pause_user'), 'refresh');
    }

    public function check_date_overlap($from_date, $to_date, $user_id, $id = null)
    {
        $this->db->select('*');
        $this->db->from('pause_user');
        $this->db->where('user_id', $user_id);
        $this->db->where('to_date >=', $from_date);
        $this->db->where('from_date <=', $to_date);
        if ($id) {
            $this->db->where('id !=', $id);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function toggle_status() {
        $job_id = $this->input->post('job_id');
        $status = $this->input->post('status');
        $new_status = $status == 1 ? 0 : 1;
        $this->load->model('Job_model');
        $this->Job_model->update_status($job_id, $new_status);
        echo json_encode(['status' => $new_status]);
    }
}
