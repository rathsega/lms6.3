<?php
    $qr_code = 'uploads/certificates/qrcodes/'. $certificate_identifier.'.jpg';
    if(!file_exists($qr_code)){
        include APPPATH.'libraries/phpqrcode/qrlib.php';
        QRcode::png(site_url('certificate/'.$certificate_identifier), $qr_code, QR_ECLEVEL_L, 3, 4);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo get_phrase('certificate'); ?> | <?php echo get_settings('system_title'); ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('uploads/system/').get_frontend_settings('favicon');?>">
    <script src="<?php echo base_url('assets/global/html2canvas/'); ?>html2canvas.min.js"></script>
    <script src="<?php echo base_url('assets/backend/js/jquery-3.3.1.min.js'); ?>" charset="utf-8"></script>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&family=WindSong:wght@500&display=swap" rel="stylesheet"> -->
   <!--  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script> -->
   <style type="text/css">
        /* @import url('https://fonts.googleapis.com/css2?family=Italianno&display=swap'); */
        .download{
            padding: 12px 15px;
            background-color: #2d32d5;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin-top: 100px;
        }

        @font-face {
            font-family: 'Nova Classic';
            src: url('<?php echo base_url('assets/frontend/default-new/webfonts/Nova-Classic-Personal-Use-Only-Regular.ttf'); ?>') format('truetype');
            /* Add more src declarations if you have additional font formats */
        }

        
   </style>

    <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap'); */
    </style>
</head>

<body >
    <div id="capture" style="position: relative; width: 750px; margin-left: auto; margin-right: auto;">
        <?php
        
            $lessons = $this->crud_model->get_lessons('course', $certificate['course_id']);
            $lesson_count=$lessons->num_rows();
            $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($certificate['course_id']);
            $language = $course['language'];
            $level =$course['level'];
        
            $certificate = $this->db->get_where('certificates', array('shareable_url' => $certificate_identifier))->row_array();
            $course = $this->crud_model->get_course_by_id($certificate['course_id'])->row_array();
            $student_row = $this->user_model->get_all_user($certificate['student_id'])->row_array();
            $student = $student_row['first_name'].' '.$student_row['last_name'];
            $certificate_template= str_replace("..\..\uploads/certificates/template.jpg","..\uploads/certificates/template.jpg",remove_js(htmlspecialchars_decode(get_settings('certificate-text-positons'))));
            // echo get_settings('certificate-text-positons');exit;
            // echo get_settings('certificate-text-positons');exit;
            $certificate_template =  str_replace("{date}", date('d M Y'), $certificate_template);
            $certificate_template =  str_replace("{course}",$course['title'], $certificate_template);
            $certificate_template =  str_replace("{student}", '<span style="font-size:45px;">'.$student.'</span>', $certificate_template);
            $certificate_template =  str_replace("{course_language}", '<i class="fas fa-language"></i> '.ucfirst($language), $certificate_template);
            $certificate_template =  str_replace("{course_level}", "", $certificate_template);
            $certificate_template =  str_replace("{total_duration}","", $certificate_template);
             $certificate_template =  str_replace("{total_lesson}", "", $certificate_template);
            $certificate_template =  str_replace("{instructor}", "", $certificate_template);
            echo $certificate_template;
        ?>
    </div>
    <div class="" style="width: 100%; margin-top: 20px; text-align: center;">
        <a class="download" download><?php echo site_phrase('download'); ?></a>
    </div>

    <script type="text/javascript">
        $('.qrCode').html('<img src="<?php echo base_url($qr_code); ?>" width="100%">');
        
        html2canvas(document.querySelector("#capture"),
            {
                allowTaint: true,
                width: '750',
            },
            ).then(canvas => {
                document.querySelector("#capture").appendChild(canvas);
                $("canvas").hide();

                setTimeout(function(){
                    var canvas = document.querySelector("canvas");

                    var dataUrl    = canvas.toDataURL("png");

                    $('.download').attr('href', dataUrl);
                }, 1000);
            }
        );
    </script>
</body>
</html>
