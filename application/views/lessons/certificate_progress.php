<?php
    //get profile completion percentage
    $user_profile = $this->crud_model->get_profile_completion_percentage();
    $pcp = 0;
    if($user_profile['first_name'] && $user_profile['last_name']){
        $pcp+=20;
    }
    if($user_profile['biography']){
        $pcp+=20;
    }
    if($user_profile['skills']){
        $pcp+=20;
    }
    if($user_profile['resume']){
        $pcp+=20;
    }
    if($user_profile['social_links']){
        $social_links = json_decode($user_profile['social_links']);
        if($social_links->facebook || $social_links->twitter || $social_links->linkedin){
            $pcp+=20;
        }
    }
?>
<?php if (course_progress($course_id) != 100) : ?>
    <!-- <div class="alert alert-info mt-5">
    <h4 class="alert-heading">You'll be able to access the course completion certificate upon watching all videos without skipping or fast-forwarding through them.</h4>
    </div> -->
<?php endif; ?>
<?php if ($pcp == 500) : ?>
    <div class="alert alert-info mt-5">
        <p><?php echo get_phrase('Please complete your profile to download the certificate'); ?></p>
        <p><?php echo '<ul><li>First Name and Last Name gives 20% Weightage</li><li>Any Social Link gives 20% Weightage</li><li>Skills gives 20% Weightage</li><li>Resume gives 20% Weightage</li><li>Biography gives 20% Weightage</li></ul>'; ?></p>
    </div>
<?php endif; ?>
<div class="progress-bar" data-percent="<?php echo course_progress($course_id); ?>" data-duration="1000" data-color="#ccc, #198754"><span><?php echo course_progress($course_id); ?>%</span></div>

<?php if (course_progress($course_id) == 100 && $pcp == 100)  : ?>
    <div class="alert alert-success mt-5" id="certificate-alert-success" role="alert">
        <h4 class="alert-heading"><?php echo get_phrase('well_done'); ?>!</h4>
        <hr>
        <p><?php echo get_phrase('congratulations') . '!!!'; ?></p>
        <p><?php echo get_phrase('you_are_now_eligible_to_download_the_course_completion_certificate'); ?>.</p>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <a class="btn bg-success text-white px-4" target="_blank" style="<?php if($pcp<100){echo "pointer-events: none";} ?>" <?php if($pcp<100){echo "disabled";} ?> href="<?php echo $this->certificate_model->get_certificate_url($this->session->userdata('user_id'), $course_id); ?>"><?= get_phrase('Get Certificate') ?></a>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-info mt-5" id="certificate-alert-warning" role="alert">
        <h4 class="alert-heading"><?php echo get_phrase('Notice'); ?></h4>
        <hr>
        <p>
            You have completed <?php echo course_progress($course_id); ?>% of the course and <?php echo $pcp; ?>% of your personal profile. Please complete your 100% profile and course to download the certificate.
                     
        </p>        
</br><ol type="1" style="text-align: left;"><li><b>Profile Weightage :</b>   </br></li><li>1. First Name and Last Name - 20% </li><li>2. Social Links - 20% </li><li>3. Skills - 20% </li><li>4. Resume - 20% </li><li>5. Biography - 20% </li></ol>
    </div>
<?php endif; ?>


<script>
    $(".progress-bar").loading();
</script> 