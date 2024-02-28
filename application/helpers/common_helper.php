<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @author      ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license     http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since       Version 1.0
 * @filesource
 */
//phpinfo();
if (!function_exists('remove_js')) {
    function remove_js($description = '')
    {
        return preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $description);
    }
}


if (!function_exists('htmlspecialchars_')) {
    function htmlspecialchars_($description = '')
    {
        return htmlspecialchars($description ?? "");
    }
}
if (!function_exists('htmlspecialchars_decode_')) {
    function htmlspecialchars_decode_($description = '')
    {
        return htmlspecialchars_decode($description ?? "");
    }
}

if (!function_exists('isJson')) {
    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('set_url_history')) {
    function set_url_history($url)
    {
        $CI    = &get_instance();
        $CI->session->set_userdata('url_history', $url);
    }
}

if (!function_exists('has_permission')) {
    function has_permission($permission_for = '', $admin_id = '')
    {
        $CI    = &get_instance();
        $CI->load->database();

        // GET THE LOGGEDIN IN ADMIN ID
        if (empty($admin_id)) {
            $admin_id = $CI->session->userdata('user_id');
        }

        $CI->db->where('admin_id', $admin_id);
        $get_admin_permissions = $CI->db->get('permissions');
        if ($get_admin_permissions->num_rows() == 0) {
            return true;
        } else {
            $get_admin_permissions = $get_admin_permissions->row_array();
            $permissions = json_decode($get_admin_permissions['permissions']);
            if (in_array($permission_for, $permissions)) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission_for)
    {
        $CI    = &get_instance();
        $CI->load->database();

        if (!has_permission($permission_for)) {
            $CI->session->set_flashdata('error_message', get_phrase('you_are_not_authorized_to_access_this_page'));
            redirect(site_url('admin/dashboard'), 'refresh');
        }
    }
}

if (!function_exists('is_root_admin')) {
    function is_root_admin($admin_id = '')
    {
        $CI    = &get_instance();
        $CI->load->database();

        // GET THE LOGGEDIN IN ADMIN ID
        if (empty($admin_id)) {
            $admin_id = $CI->session->userdata('user_id');
        }

        $CI->db->where('admin_id', $admin_id);
        $get_admin_permissions = $CI->db->get('permissions');
        if ($get_admin_permissions->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('custom_date')) {
    function custom_date($strtotime = "", $format = "")
    {
        if ($format == "") {
            return date('d', $strtotime) . ' ' . site_phrase(date('M', $strtotime)) . ' ' . date('Y', $strtotime);
        } elseif ($format == 1) {
            return site_phrase(date('D', $strtotime)) . ', ' . date('d', $strtotime) . ' ' . site_phrase(date('M', $strtotime)) . ' ' . date('Y', $strtotime);
        }
    }
}

if (!function_exists('nice_number')) {
    function nice_number($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n <= 1000) return number_format($n);
        elseif ($n > 1000000000000) return round(($n / 1000000000000), 1) . 'T';
        elseif ($n > 1000000000) return round(($n / 1000000000), 1) . 'M';
        elseif ($n > 1000000) return round(($n / 1000000), 1) . 'M';
        elseif ($n > 1000) return round(($n / 1000), 1) . 'k';

        return number_format($n);
    }
}

if (!function_exists('get_past_time')) {
    function get_past_time($time = "")
    {
        $time_difference = time() - $time;

        if ($time_difference < 1) {
            return 'less than 1 second ago';
        }

        //864000 = 10 days
        if ($time_difference > 864000) {
            return custom_date($time, 1);
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60 =>  site_phrase('year'),
            30 * 24 * 60 * 60       =>  site_phrase('month'),
            24 * 60 * 60            =>  site_phrase('day'),
            60 * 60                 =>  site_phrase('hour'),
            60                      =>  site_phrase('minute'),
            1                       =>  site_phrase('second')
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ' . site_phrase('ago');
            }
        }
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($filelocation = "", $target_path = "", $width = "", $height = "")
    {
        $CI = &get_instance();
        $CI->load->database();

        if ($width == "") {
            $width = 200;
        }

        if ($height == "") {
            $maintain_ratio = TRUE;
        } else {
            $maintain_ratio = FALSE;
        }

        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $filelocation,
            'new_image' => $target_path,
            'maintain_ratio' => $maintain_ratio,
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => $width,
            'height' => $height
        );
        $CI->load->library('image_lib', $config_manip);

        if ($CI->image_lib->resize()) {
            return true;
        } else {
            $CI->image_lib->display_errors();
            return false;
        }
        $CI->image_lib->clear();
    }
}

if (!function_exists('get_settings')) {
    function get_settings($key = '', $type = "")
    {
        $CI    = &get_instance();
        $CI->load->database();

        $CI->db->where('key', $key);
        $result = $CI->db->get('settings')->row('value');

        if($key == 'course_selling_tax'){
            if(isset($_COOKIE["countryName"]) && $_COOKIE["countryName"] == 'India'){
                return $result;
            }else{
                return 0;
            }
        }

        if ($type) {
            return json_decode($result, true);
        } else {
            return $result;
        }
    }
}

if (!function_exists('currency')) {
    function currency($price = "")
    {
        $CI    = &get_instance();
        $CI->load->database();
        if ($price != "") {
            $CI->db->where('key', 'system_currency');
            $currency_code = $CI->db->get('settings')->row('value');

            $CI->db->where('code', $currency_code);
            $symbol = $CI->db->get('currency')->row('symbol');

            $CI->db->where('key', 'currency_position');
            $position = $CI->db->get('settings')->row('value');

            if ($position == 'right') {
                return $price . $symbol;
            } elseif ($position == 'right-space') {
                return $price . ' ' . $symbol;
            } elseif ($position == 'left') {
                return $symbol . $price;
            } elseif ($position == 'left-space') {
                return $symbol . ' ' . $price;
            }
        } else {
            $CI->db->where('key', 'system_currency');
            $currency_code = $CI->db->get('settings')->row('value');

            $CI->db->where('code', $currency_code);
            return $CI->db->get('currency')->row()->symbol;
        }
    }
}

if (!function_exists('currency_code_and_symbol')) {
    function currency_code_and_symbol($type = "")
    {
        $CI    = &get_instance();
        $CI->load->database();
        $CI->db->where('key', 'system_currency');
        $currency_code = $CI->db->get('settings')->row('value');

        $CI->db->where('code', $currency_code);
        $symbol = $CI->db->get('currency')->row()->symbol;
        if ($type == "") {
            return $symbol;
        } else {
            return $currency_code;
        }
    }
}

if (!function_exists('get_frontend_settings')) {
    function get_frontend_settings($key = '')
    {
        $CI    = &get_instance();
        $CI->load->database();

        $CI->db->where('key', $key);
        $result = $CI->db->get('frontend_settings')->row('value');



        if ($key == 'banner_image') {
            $banner_images = json_decode($result, true);
            return $banner_images[get_frontend_settings('home_page')];
        }
        return $result;
    }
}

if (!function_exists('get_current_banner')) {
    function get_current_banner($key = '')
    {
        $CI    = &get_instance();
        $CI->load->database();

        $CI->db->where('key', $key);
        $result = $CI->db->get('frontend_settings')->row('value');

        $banner_images = json_decode($result, true);

        if(!empty($_SERVER['HTTP_USER_AGENT'])){
            $user_ag = $_SERVER['HTTP_USER_AGENT'];
            if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
               return "home-banner-mobile.webp";
            }else{
                return $banner_images[get_frontend_settings('home_page')];
            }
         }else{
            return $banner_images[get_frontend_settings('home_page')];
         }
    }
}

if (!function_exists('slugify')) {
    function slugify($text)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        //$text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
            return 'n-a';
        return $text;
    }
}

if (!function_exists('get_video_extension')) {
    // Checks if a video is youtube, vimeo or any other
    function get_video_extension($url)
    {
        if (strpos($url, '.mp4') > 0) {
            return 'mp4';
        } elseif (strpos($url, '.webm') > 0) {
            return 'webm';
        } else {
            return 'unknown';
        }
    }
}

if (!function_exists('ellipsis')) {
    // Checks if a video is youtube, vimeo or any other
    function ellipsis($long_string, $max_character = 30)
    {
        $short_string = strlen($long_string) > $max_character ? mb_substr($long_string, 0, $max_character) . "..." : $long_string;
        return $short_string;
    }
}

// This function helps us to decode the theme configuration json file and return that array to us
if (!function_exists('themeConfiguration')) {
    function themeConfiguration($theme, $key = "")
    {
        $themeConfigs = [];
        if (file_exists('assets/frontend/' . $theme . '/config/theme-config.json')) {
            $themeConfigs = file_get_contents('assets/frontend/' . $theme . '/config/theme-config.json');
            $themeConfigs = json_decode($themeConfigs, true);
            if ($key != "") {
                if (array_key_exists($key, $themeConfigs)) {
                    return $themeConfigs[$key];
                } else {
                    return false;
                }
            } else {
                return $themeConfigs;
            }
        } else {
            return false;
        }
    }
}

// Human readable time
if (!function_exists('readable_time_for_humans')) {
    function readable_time_for_humans($duration)
    {
        if ($duration) {
            $duration_array = explode(':', $duration);
            $hour   = $duration_array[0];
            $minute = $duration_array[1];
            $second = $duration_array[2];
            if ($hour > 0) {
                $duration = $hour . ' ' . get_phrase('hr') . ' ' . $minute . ' ' . get_phrase('min');
            } elseif ($minute > 0) {
                if ($second > 0) {
                    $duration = ($minute + 1) . ' ' . get_phrase('min');
                } else {
                    $duration = $minute . ' ' . get_phrase('min');
                }
            } elseif ($second > 0) {
                $duration = $second . ' ' . get_phrase('sec');
            } else {
                $duration = '00:00';
            }
        } else {
            $duration = '00:00';
        }
        return $duration;
    }
}

// Human readable time
if (!function_exists('seconds_to_time_format')) {
    function seconds_to_time_format($seconds = "0")
    {
        if ($seconds) {
            $hours = floor($seconds / 3600); // Calculate the number of hours
            $minutes = floor(($seconds % 3600) / 60); // Calculate the number of minutes
            $totalSeconds = $seconds % 60; // Calculate the number of seconds

            return sprintf("%02d:%02d:%02d", $hours, $minutes, $totalSeconds); // Format the time as HH:MM:SS
        } else {
            $duration = '00:00:00';
        }
        return $duration;
    }
}

// Human readable time
if (!function_exists('time_to_seconds')) {
    function time_to_seconds($time)
    {
        $time = explode(':', $time);
        $seconds = $time[0] * 3600;
        $seconds = $seconds + ($time[1] * 60);
        return $seconds = $seconds + $time[2];
    }
}

if (!function_exists('trimmer')) {
    function trimmer($text)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
            return 'n-a';
        return $text;
    }
}

if (!function_exists('lesson_progress')) {
    function lesson_progress($lesson_id = "", $user_id = "", $course_id = "")
    {
        $CI    = &get_instance();
        $CI->load->database();
        if ($user_id == "") {
            $user_id = $CI->session->userdata('user_id');
        }
        if ($course_id == "") {
            $course_id = $CI->db->get_where('lesson', array('id' => $lesson_id))->row('course_id');
        }

        $query = $CI->db->get_where('watch_histories', array('course_id' => $course_id, 'student_id' => $user_id));

        if ($query->num_rows() > 0) {
            $lesson_ids = json_decode($query->row('completed_lesson'), true);
            if (is_array($lesson_ids) && in_array($lesson_id, $lesson_ids)) {
                return 1;
            } else {
                return 0;
            }
        }
    }
}
if (!function_exists('course_progress')) {
    function course_progress($course_id = "", $user_id = "", $return_type = "")
    {
        $CI    = &get_instance();
        $CI->load->database();
        if ($user_id == "") {
            $user_id = $CI->session->userdata('user_id');
        }

        $watch_history = $CI->crud_model->get_watch_histories($user_id, $course_id)->row_array();

        if ($return_type == "completed_lesson_ids") {
            return json_decode($watch_history['completed_lesson']);
        }
        if (is_array($watch_history) && $watch_history['course_progress'] > 0) {
            return $watch_history['course_progress'];
        } else {
            return 0;
        }
    }
}

// RANDOM NUMBER GENERATOR FOR ELSEWHERE
if (!function_exists('random')) {
    function random($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }
}

// RANDOM NUMBER GENERATOR FOR ELSEWHERE
if (!function_exists('phpFileUploadErrors')) {
    function phpFileUploadErrors($error_code)
    {
        $phpFileUploadErrorsArray = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        return $phpFileUploadErrorsArray[$error_code];
    }
}


// course bundle subscription data
if (!function_exists('get_bundle_validity')) {
    function get_bundle_validity($bundle_id = "", $user_id = "")
    {
        $CI = &get_instance();
        $CI->load->database();
        if ($user_id == "") {
            $user_id = $CI->session->userdata('user_id');
        }
        $today = strtotime(date('d M Y'));

        $course_bundle = $CI->db->get_where('course_bundle', array('id' => $bundle_id))->row_array();

        $CI->db->limit(1);
        $CI->db->order_by('id', 'desc');
        $bundle_payment = $CI->db->get_where('bundle_payment', array('bundle_id' => $bundle_id, 'user_id' => $user_id));

        //convert day to seconds
        $subscription_limit_timestamp = $course_bundle['subscription_limit'] * 86400;

        if ($bundle_payment->num_rows() > 0) {
            $max_valid_date = $bundle_payment->row_array()['date_added'] + $subscription_limit_timestamp;
            if ($today <= $max_valid_date) {
                //validate
                return 'valid';
            } else {
                //expire
                return 'expire';
            }
        } else {
            return 'invalid';
        }
    }
}


if (!function_exists('get_lesson_type')) {
    function get_lesson_type($lesson_id = "")
    {
        $CI = &get_instance();
        $CI->load->database();
        $lesson = $CI->db->get_where('lesson', ['id' => $lesson_id]);
        if ($lesson->num_rows() > 0) {
            $lesson = $lesson->row_array();
            if ($lesson['lesson_type'] == 'video' && $lesson['video_type'] == 'YouTube' || $lesson['video_type'] == 'youtube') {
                return 'youtube_video_url';
            } elseif ($lesson['lesson_type'] == 'video' && $lesson['video_type'] == 'google_drive') {
                return 'google_drive_video_url';
            } elseif ($lesson['lesson_type'] == 'video' && $lesson['video_type'] == 'Vimeo' || $lesson['video_type'] == 'vimeo') {
                return 'vimeo_video_url';
            } elseif ($lesson['lesson_type'] == 'video' && $lesson['video_type'] == 'amazon') {
                return 'amazon_video_url';
            } elseif ($lesson['lesson_type'] == 'video' && $lesson['video_type'] == 'system') {
                return 'video_file';
            } elseif ($lesson['lesson_type'] == 'video' && $lesson['video_type'] == 'academy_cloud') {
                return 'academy_cloud';
            } elseif ($lesson['lesson_type'] == 'video' && $lesson['video_type'] == 'html5') {
                return 'html5_video_url';
            } elseif ($lesson['lesson_type'] == 'quiz') {
                return 'quiz';
            } elseif ($lesson['lesson_type'] == 'text') {
                return 'text';
            } elseif ($lesson['lesson_type'] == 'other' && $lesson['attachment_type'] == 'txt') {
                return 'text_file';
            } elseif ($lesson['lesson_type'] == 'other' && $lesson['attachment_type'] == 'pdf') {
                return 'pdf_file';
            } elseif ($lesson['lesson_type'] == 'other' && $lesson['attachment_type'] == 'doc') {
                return 'doc_file';
            } elseif ($lesson['lesson_type'] == 'other' && $lesson['attachment_type'] == 'img') {
                return 'image_file';
            } else {
                return 'iframe';
            }

            //'image_file' || 'doc_file' || 'pdf_file' || 'text_file' || 
        }
    }

    if (!function_exists('get_latest_ci_session_id')) {
        function get_latest_ci_session_id($session_id, $user_id)
        {
            $CI    = &get_instance();
            $CI->load->database();
            $CI->db->select('id');
            $CI->db->from('ci_sessions');
            $CI->db->where('id', $session_id);
            $CI->db->order_by('timestamp', 'desc');
            $CI->db->limit(1);
            $query = $CI->db->get();
            return $query->result();
        }
    }


    if (!function_exists('set_user_id_in_session')) {
        function set_user_id_in_session($id, $user_id)
        {
            $CI    = &get_instance();
            $CI->load->database();

            $CI->db->where('id', $id);
            $data = array("user_id" => $user_id);
            return $CI->db->update('ci_sessions', $data);
        }
    }

    if (!function_exists('get_active_sessions_of_current_user')) {
        function get_active_sessions_of_current_user($user_id)
        {
            $CI    = &get_instance();
            $CI->load->database();

            $CI->db->where('user_id', $user_id);
            $CI->db->order_by('timestamp', 'desc');
            return $CI->db->get('ci_sessions')->result_array();
        }
    }


    if (!function_exists('delete_sessions')) {
        function delete_sessions($ids)
        {
            $CI    = &get_instance();
            $CI->load->database();

            $CI->db->where_in('id', $ids);
            return $CI->db->delete('ci_sessions');
        }
    }

    if (!function_exists('update_user_sessions')) {
        function update_user_sessions($ids, $user_id)
        {
            $CI    = &get_instance();
            $CI->load->database();

            $CI->db->where('id', $user_id);
            $data = array("sessions" => $ids);
            return $CI->db->update('users', $data);
        }
    }

    if (!function_exists('get_browser_details')) {
        function get_browser_details()
        {
            return get_browser();
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            $browser        =   "Unknown Browser";

            $browser_array  = array(
                '/msie/i'       =>  'Internet Explorer',
                '/firefox/i'    =>  'Firefox',
                '/safari/i'     =>  'Safari',
                '/chrome/i'     =>  'Chrome',
                '/opera/i'      =>  'Opera',
                '/netscape/i'   =>  'Netscape',
                '/maxthon/i'    =>  'Maxthon',
                '/konqueror/i'  =>  'Konqueror',
                '/mobile/i'     =>  'Handheld Browser'
            );
            $found = false;
            foreach ($browser_array as $regex => $value) {
                if ($found)
                    break;
                else if (preg_match($regex, $user_agent, $result)) {
                    $browser    =   $value;
                    $found = true;
                }
            }
            return $browser;
        }
    }

    if (!function_exists('get_system_info')) {
        function get_system_info()
        {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $os_platform = 'Unknown';
            $version = "";
            
            //First get the platform?
            if (preg_match('/iPhone/i', $u_agent)) {
                $os_platform = 'iPhone';
            }elseif (preg_match('/Android/i', $u_agent)) {
                $os_platform = 'Android';
            }elseif (preg_match('/linux/i', $u_agent)) {
                $os_platform = 'linux';
            } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $os_platform = 'mac';
            } elseif (preg_match('/windows|win32/i', $u_agent)) {
                $os_platform = 'windows';
            }

            // Next get the name of the useragent yes seperately and for good reason
            if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            } elseif (preg_match('/Firefox/i', $u_agent)) {
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            } elseif (preg_match('/OPR/i', $u_agent)) {
                $bname = 'Opera';
                $ub = "Opera";
            } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent) && !preg_match('/Edg/i', $u_agent)) {
                $bname = 'Google Chrome';
                $ub = "Chrome";
            } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent) && !preg_match('/Edg/i', $u_agent)) {
                $bname = 'Apple Safari';
                $ub = "Safari";
            } elseif (preg_match('/Netscape/i', $u_agent)) {
                $bname = 'Netscape';
                $ub = "Netscape";
            } elseif (preg_match('/Edge/i', $u_agent)) {
                $bname = 'Edge';
                $ub = "Edge";
            } elseif (preg_match('/Edg/i', $u_agent)) {
                $bname = 'Edge';
                $ub = "Edge";
            } elseif (preg_match('/Trident/i', $u_agent)) {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }

            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }
            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                    $version = $matches['version'][0];
                } else {
                    $version = $matches['version'][1];
                }
            } else {
                $version = $matches['version'][0];
            }

            // check if we have a number
            if ($version == null || $version == "") {
                $version = "?";
            }


            $device = !preg_match('/(windows|mac|linux|ubuntu)/i', $os_platform)
                ? 'MOBILE' : (preg_match('/phone/i', $os_platform) ? 'MOBILE' : 'SYSTEM');
            $device = !$device ? 'SYSTEM' : $device;

            return array(
                'userAgent' => $u_agent,
                'browser'      => $bname,
                'version'   => $version,
                'os'  => $os_platform,
                'pattern'    => $pattern,
                'device' => $device
            );
        }

        
    }
}


// ------------------------------------------------------------------------
/* End of file common_helper.php */
/* Location: ./system/helpers/common.php */
