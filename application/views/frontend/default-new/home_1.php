
<style>
    @media all and (max-width: 500px) {
	#tilt {
		height: 298px;
	  }
}
@media all and (max-width: 576px) {

	#tilt {
		display: block;
		/* height: 400px; */
		width: auto;
		margin: 0 auto;
		transition: box-shadow 0.1s, transform 0.1s;
		/* background-image: url("../image/h-banner-img.png"); */
		background-size: 85%;
		background-repeat: no-repeat;
		background-position: center;
	}

}
@media only screen and (min-width: 768px) {
  .upcoming_couse_section{
    margin-top: 110px;
  }

}

</style>
<?php
/**
 * Maintain Session here
 * set user_id based on ip_address, to recent record
 * then
 * if is there any records with same user_id, then delete it
 */
$user_id = $this->session->userdata('user_id');

?>
<?php
#check payment due details
$payment_pending = false;

$user_active_enrolments = $this->crud_model->get_active_enrol_by_user_id();
$notice_message = "";
foreach($user_active_enrolments as $key => $enrol_data){
    $show_notification = false;  
    $actual_installment_amount = "";
    $actual_due_date = "";
    $course_details = $this->crud_model->get_course_by_id($enrol_data['course_id'])->row_array();
    $course_duration_in_months = $course_details['course_duration_in_months']?$course_details['course_duration_in_months'] : 2;
    $course_price = $course_details['price'];

    $installment_settings = json_decode($enrol_data['installment_details']);
    $installment_settings = $installment_settings ? $installment_settings : [];

    //Manual Payments
    $payments_list = $this->crud_model->get_payments_list_by_by_enrolment_id($enrol_data['id']);
    $total_paid_amount = 0;
    for ($i=0; $i < count($payments_list); $i++) { 
        $total_paid_amount += (int)$payments_list[$i]['amount'];
    }

    //Online Payments
    $online_payments_list = $this->crud_model->get_online_payments_list_by_by_course_id($enrol_data['course_id']);
    $online_payments_list = $online_payments_list ? $online_payments_list : [];
    log_message("error", "online payments list : " . json_encode($online_payments_list));
    for ($i=0; $i < count($online_payments_list); $i++) { 
        $total_paid_amount += (int)$online_payments_list[$i]['amount'];
    }  

    //get user notification settings
    $user_notification_settings = $this->crud_model->get_payment_notification_setting($enrol_data['user_id']);
    $grace_period = $user_notification_settings ? $user_notification_settings['grace_period'] : 7;
    
     //calculate installment and notification dates for installment 1
     $today = date('Y-m-d');
     if($installment_settings && $installment_settings[0] && $installment_settings[0]->date && $installment_settings[0]->amount){
        $installment_date = $installment_settings[0]->date;
        $installment_amount = (int)$installment_settings[0]->amount;
        if($grace_period){
            $notifiction_start_date = date('Y-m-d', strtotime("-$grace_period days", strtotime($installment_date))); 
        }else{
            $notifiction_start_date = $installment_date;
        }
        if($today >= $notifiction_start_date && $total_paid_amount < $installment_amount){
            $show_notification = true;    
            $actual_installment_amount = $installment_amount;
            $actual_due_date = $installment_date;
        }
     }

     //calculate installment and notification dates for installment 2
     if($installment_settings && $installment_settings[1] && $installment_settings[1]->date && $installment_settings[1]->amount){
        $installment_date = $installment_settings[1]->date;
        $installment_amount = (int)$installment_settings[1]->amount +  (int)$installment_amount;
        if($grace_period){
            $notifiction_start_date = date('Y-m-d', strtotime("-$grace_period days", strtotime($installment_date))); 
        }else{
            $notifiction_start_date = $installment_date;
        }
        if($today >= $notifiction_start_date && $total_paid_amount < $installment_amount){
            $show_notification = true; 
            $actual_installment_amount = $installment_amount;
            $actual_due_date = $installment_date;             
        }
     }

     //calculate installment and notification dates for installment 3
     if($installment_settings && $installment_settings[2] && $installment_settings[1]->date && $installment_settings[1]->amount){
        $installment_date = $installment_settings[2]->date;
        $installment_amount = (int)$installment_settings[2]->amount +  (int)$installment_amount;
        if($grace_period){
            $notifiction_start_date = date('Y-m-d', strtotime("-$grace_period days", strtotime($installment_date))); 
        }else{
            $notifiction_start_date = $installment_date;
        }
        if($today >= $notifiction_start_date && $total_paid_amount < $installment_amount){
            $show_notification = true;              
            $actual_installment_amount = $installment_amount - $total_paid_amount;
            $actual_due_date = $installment_date;
        }
     }
    if($show_notification){
        $payment_pending = true;
        $date1 = new DateTime($installment_date);
        $date2 = new DateTime(date('Y-m-d'));
        $diff_days = $date1->diff($date2);            
        $notice_message .= "Payment is pending for the course " . $course_details['title'] . ', installment date is : ' . $actual_due_date . ', installment amount is : ' . $installment_amount - $total_paid_amount .'\n\n' ;
    }
    
}
if($payment_pending){
    echo "<script>alert('".$notice_message."');</script>";
}
?>
<!---------- Banner Section Start ---------------->
<section class="h-1-banner bannar-area pt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 order-md-1 order-sm-2 order-2">
                <div class="h-1-banner-text mb-3">
                    <h1>Tech Leads <span class="d-inline-block">IT</span></h1>
                    
                    <p>Study oracle fusion courses from industry experts</p>
                </div>
                <div class="search-option">
                    <form action="<?php echo site_url('home/courses'); ?>" method="get">
                        <input class="form-control" type="text" placeholder="<?php echo get_phrase('What do you want to learn'); ?>" name="query">
                        <button class="submit-cls" type="submit"><i class="fa fa-search"></i><?php echo get_phrase('Search') ?></button>
                    </form>
                </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 order-md-2 order-sm-1 order-1 pt-0 pt-md-5 ">
            <link id="tilt" rel="preload"  fetchpriority="high" as="image" href="<?php echo base_url("assets/frontend/default-new/image/menu.png"); ?>" style="background-image: url('<?php echo base_url("uploads/system/" . get_current_banner('banner_image')); ?>'" type="image/png">
                <!-- <div id="tilt" style="background-image: url('<?php echo base_url("uploads/system/" . get_current_banner('banner_image')); ?>');"></div> -->
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-6">
                <div class="students-rating container">
                    <div class="row">
                        <div class="col-lg-3 col-md-2 col-sm-2 col-3">
                            <?php $all_students = $this->db->get_where('users', ['role_id !=' => 1]); ?>
                            <h1><?php echo nice_number($all_students->num_rows()); ?>+</h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <p><?php echo get_phrase('Happy') ?></p>
                            <p><?php echo get_phrase('Students') ?></p>
                        </div> 
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <img src="<?php echo base_url('assets/frontend/default-new/image/h-1-ban-st.png')?>" alt="">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <?php $all_instructor = $this->db->get_where('users', ['is_instructor' => 1, 'show_in_home_page' => 1]); ?>
                            <h1><?php echo nice_number($all_instructor->num_rows()); ?>+</h1>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <p><?php echo get_phrase('Experienced') ?></p>
                            <p><?php echo get_phrase('Instructors') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bannar-card pb-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="banner-card-1">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="<?php echo base_url('assets/frontend/default-new/image/h-1-bnar-c-1.webp')?>">
                            </div>
                            <div class="col-lg-10">
                                <h6><?php
                                    $status_wise_courses = $this->crud_model->get_status_wise_courses_front();
                                    $number_of_courses = $status_wise_courses['active']->num_rows();
                                    echo $number_of_courses . ' ' . site_phrase('online_courses'); ?></h6>
                                <p><?php echo site_phrase('explore_a_variety_of_fresh_topics'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="banner-card-1">
                        <div class="row">
                            <div class="col-lg-2">
                            <img src="<?php echo base_url('assets/frontend/default-new/image/h-1-bnar-c-2.webp')?>">
                            </div>
                            <div class="col-lg-10">
                                <h6><?php echo site_phrase('expert_instruction'); ?></h6>
                                <p><?php echo site_phrase('find_the_right_course_for_you'); ?></p>
                            </div>
                        </div>
                    </div>           
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="banner-card-1">
                        <div class="row">
                            <div class="col-lg-2">
                            <img src="<?php echo base_url('assets/frontend/default-new/image/h-1-bnar-c-3.webp')?>">
                            </div>
                            <div class="col-lg-10">
                                <h6><?php echo site_phrase('Smart solution'); ?></h6>
                                <p><?php echo site_phrase('learn_on_your_schedule'); ?></p>
                            </div>
                        </div>
                    </div>           
                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Banner Section End ---------------->

<!-- Start Upcoming Courses -->
<?php $upcoming_courses = $this->db->order_by('id', 'desc')->limit(6)->get_where('course', ['status' => 'upcoming']); ?>
<?php if($upcoming_courses->num_rows() > 0): ?>
    <section class="upcoming_couse_section">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="title-one pb-20">
              <p class="subtitle text-uppercase"><?php echo get_phrase('Upcoming'); ?></p>
              <h4 class="title"><?php echo get_phrase('Upcoming courses'); ?></h4>
              <div class="bar"></div>
            </div>
            <p class="fz_15_m_24"><?php echo get_phrase('Discover a world of learning opportunities through our upcoming courses, where industry experts and thought leaders will guide you in acquiring new expertise, expanding your horizons, and reaching your full potential.') ?></p>
          </div>
          <div class="col-lg-8">
            <!-- Items -->
            <div class="row g-3">
              <?php
                foreach($upcoming_courses->result_array() as $upcoming_course):
                    if($upcoming_course['slug_count'] == 1 || $upcoming_course['slug_count'] == 2){
                        $upcoming_course_slug = $upcoming_course['slug'];
                    }else if($upcoming_course['slug_count'] == 3 || $upcoming_course['slug_count'] == 4){
                        $upcoming_course_slug = $upcoming_course['category_slug'] .'/' . $upcoming_course['sub_category_slug'] .'/' . $upcoming_course['slug'];
                    }else{
                        $upcoming_course_slug = $upcoming_course['slug'];
                    }
                ?>
                <div class="col-lg-4">
                  <a href="<?php echo site_url($upcoming_course_slug); ?>" class="course-item-one">
                    <div class="img-rating">
                      <div class="img"><img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($upcoming_course['id']); ?>" alt="" /></div>
                    </div>
                    <div class="content">
                      <h4 class="title up-comoing-course-title"><?php echo $upcoming_course['title']; ?></h4>
                      <p class="info ellipsis-line-2 fw-400"><?php echo $upcoming_course['short_description']; ?></p>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php endif; ?>
<!-- End Upcoming Courses -->


<!---------- Top courses Section start --------------->
<section class="courses grid-view-body pt-50 pb-4">
    <div class="container">
        <h1><span><?php echo site_phrase('top_courses'); ?></span></h1>
        <p class='fs-16'><?php echo site_phrase('These_are_the_most_popular_courses_among_Listen_Courses_learners_worldwide')?></p>
        <div class="courses-card">
            <div class="course-group-slider">
                <?php
                $top_courses = $this->crud_model->get_top_courses()->result_array();
                foreach ($top_courses as $top_course) :
                    if($top_course['slug_count'] == 1 || $top_course['slug_count'] == 2){
                        $top_course_slug = $top_course['slug'];
                    }else if($top_course['slug_count'] == 3 || $top_course['slug_count'] == 4){
                        $top_course_slug = $top_course['category_slug'] .'/' . $top_course['sub_category_slug'] .'/' . $top_course['slug'];
                    }else{
                        $top_course_slug = $top_course['slug'];
                    }
                    $lessons = $this->crud_model->get_lessons('course', $top_course['id']);
                    $instructor_details = $this->user_model->get_all_user($top_course['creator'])->row_array();
                    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($top_course['id']);
                    $course_duration = $top_course['is_top_course'] == 1 || $top_course['is_top10_course'] == 1 || $top_course['show_it_in_category'] == 1 ? $top_course['course_duration_in_hours'] . " Hours" : $course_duration;
                    $course_duration_in_months = $top_course['course_duration_in_months'] >1 ? $top_course['course_duration_in_months'] ." Months" : $top_course['course_duration_in_months'] . " Month";
                    if($top_course['daily_class_duration_in_hours']){
                        $hours_text = $top_course['daily_class_duration_in_hours'] > 1 ? " Hours" : " Hour";
                        $course_duration_in_months = $course_duration_in_months ." (Daily " . $top_course['daily_class_duration_in_hours'] .$hours_text.")";
                    }
                    $total_rating =  $this->crud_model->get_ratings('course', $top_course['id'], true)->row()->rating;
                    $ratings_count = $this->crud_model->get_ratings_count($top_course['id']);
                    if($ratings_count){
                        $one = $ratings_count['one_rating_count'];
                        $two = $ratings_count['two_rating_count'];
                        $three = $ratings_count['three_rating_count'];
                        $four = $ratings_count['four_rating_count'];
                        $five = $ratings_count['five_rating_count'];
                        $number_of_ratings = $ratings_count['number_of_ratings'];
                        $number_of_enrolments = $ratings_count['number_of_students_enrolled'];
                        $average_ceil_rating = round((($one*1) + ($two*2) + ($three*3)+($four*4)+($five*5))/$number_of_ratings,1);
                    }else{
                        $average_ceil_rating = 0;
                        $number_of_ratings = 0;
                        $number_of_enrolments = 0;
                    }
                    ?>
                    <div class="single-popup-course">
                        <a href="<?php echo site_url($top_course_slug); ?>" id="top_course_<?php echo $top_course['id']; ?>" class="checkPropagation courses-card-body">
                            <div class="courses-card-image ">
                                <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($top_course['id']); ?>">
                                <div class="courses-icon <?php if(in_array($top_course['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIconTopCourse<?php echo $top_course['id']; ?>">
                                    <i class="fa-solid fa-heart checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/'.$top_course['id'].'/TopCourse'); ?>')"></i>
                                </div>
                                <div class="courses-card-image-text">
                                    <h3><?php echo get_phrase($top_course['level']); ?></h3>
                                </div> 
                            </div>
                            <div class="courses-text">
                                <h5 class="mb-2 top-course-slider"><?php echo $top_course['title']; ?></h5>
                                <div class="review-icon">
                                    <div class="review-icon-star align-items-center">
                                        <p><?php echo $average_ceil_rating; ?></p>
                                        <p><?php 
                                            for($i=1; $i<=5; $i++){
                                                if($average_ceil_rating < $i ) {
                                                    if(is_float($average_ceil_rating) && (ceil($average_ceil_rating) == $i || floor($average_ceil_rating) == $i)){
                                                        echo $i==5 ? '<i class="fa-regular fa-star-half-stroke filled"></i>' : '<i style="margin-right:-7px;" class="fa-regular fa-star-half-stroke filled"></i>';
                                                    }else{
                                                        echo $i==5 ? '<i class="fa-solid fa-star"></i>' : '<i style="margin-right:-7px;" class="fa-solid fa-star"></i>';
                                                    }
                                                 }else {
                                                    echo $i==5 ? '<i class="fa-solid fa-star filled"></i>' : '<i style="margin-right:-7px;" class="fa-solid fa-star filled"></i>';
                                                 }
                                            }
                                        ?></p>
                                        <!-- <i class="fa-solid fa-star <?php if($number_of_ratings > 0) echo 'filled'; ?>"></i> -->
                                        <p>(<?php echo $number_of_ratings; ?> <?php echo get_phrase('Reviews') ?>)</p>
                                    </div>
                                    <div class="review-btn d-flex align-items-center">
                                       
                                    </div>
                                </div>
                                <div class="courses-price-border">
                                    <div class="courses-price">
                                        <div class="courses-price-left">
                                            <?php if($top_course['is_free_course']): ?>
                                                <h5><?php echo get_phrase('Free'); ?></h5>
                                            <?php elseif($top_course['discount_flag']): ?>
                                                <h5><?php echo currency($top_course['discounted_price']); ?></h5>
                                                <p class="mt-1"><del><?php echo currency($top_course['price']); ?></del><span><?php echo " +Taxes"; ?></span></p>
                                            <?php else: ?>
                                                <h5><?php echo currency($top_course['price']); ?><span><?php echo " +Taxes"; ?></span></h5>
                                            <?php endif; ?>
                                        </div>
                                        <div class="courses-price-right ">
                                            <p class="m-0"> <i class="fa-regular fa-clock p-0 text-15px"></i> <?php echo $course_duration; ?></p>
                                        </div>
                                    </div>
                                    <div class="courses-price">
                                        <p class="m-0"> <i class="fa-regular fa-clock p-0 text-15px"></i> <?php echo $course_duration_in_months; ?></p>
                                    </div>
                                </div>
                             </div>
                        </a>




                        <div id="top_course_feature_<?php echo $top_course['id']; ?>" class="course-popover-content">
                            <?php if ($top_course['last_modified'] == "") : ?>
                                <p class="last-update"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $top_course['date_added']); ?></p>
                            <?php else : ?>
                                <p class="last-update"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $top_course['last_modified']); ?></p>
                            <?php endif; ?>
                            <div class="course-title">
                                 <a href="<?php echo site_url($top_course_slug); ?>"><?php echo $top_course['title']; ?></a>
                            </div>
                            <div class="course-meta">
                                <?php if ($top_course['course_type'] == 'general') : ?>
                                    <span class=""><i class="fas fa-play-circle"></i>
                                        <?php echo $top_course["number_of_lectures"]/*$this->crud_model->get_lessons('course', $top_course['id'])->num_rows()*/ . ' ' . site_phrase('lessons'); ?>
                                    </span>
                                    <span class=""><i class="far fa-clock"></i>
                                        <?php echo $course_duration; ?>
                                    </span>
                                <?php elseif ($top_course['course_type'] == 'h5p') : ?>
                                    <span class="badge bg-light"><?= site_phrase('h5p_course'); ?></span>
                                <?php elseif ($top_course['course_type'] == 'scorm') : ?>
                                    <span class="badge bg-light"><?= site_phrase('scorm_course'); ?></span>
                                <?php endif; ?>
                                <span class=""><i class="fas fa-closed-captioning"></i><?php echo ucfirst($top_course['language']); ?></span>
                             </div>
                             <div class="course-meta">
                                    <span class=""><i class="far fa-clock"></i>
                                        <?php echo $course_duration_in_months; ?>
                                    </span>
                             </div>
                            <h6 class="text-black text-14px mb-1"><?php echo get_phrase('Outcomes') ?>:</h6>
                            <ul class="will-learn">
                                <?php $outcomes = json_decode($top_course['outcomes']);
                                foreach ($outcomes as $outcome) : ?>
                                    <li><?php echo $outcome; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="popover-btns">
                                <?php $cart_items = $this->session->userdata('cart_items'); ?>
                                <?php if(is_purchased($top_course['id'])): ?>
                                    <a href="<?php echo site_url('home/lesson/'.slugify($top_course['title']).'/'.$top_course['id']) ?>" class="purchase-btn d-flex align-items-center  me-auto"><i class="far fa-play-circle me-2"></i> <?php echo get_phrase('Start Now'); ?></a>
                                    <?php if ($top_course['is_free_course'] != 1) : ?>
                                        <button type="button" class="gift-btn ms-auto" title="<?php echo get_phrase('Gift someone else'); ?>" data-bs-toggle="tooltip" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $top_course['id'].'?gift=1'); ?>')"><i class="fas fa-gift"></i></button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if ($top_course['is_free_course'] == 1) : ?>
                                        <a class="purchase-btn green_purchase ms-auto" href="<?php echo site_url('home/get_enrolled_to_free_course/' . $top_course['id']); ?>"><?php echo get_phrase('Enroll Now'); ?></a>
                                    <?php else : ?>

                                        <!-- Cart button -->
                                        <a id="added_to_cart_btn_top_course<?php echo $top_course['id']; ?>" class="purchase-btn align-items-center me-auto <?php if(!in_array($top_course['id'], $cart_items)) echo 'd-hidden'; ?>" href="javascript:void(0)" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $top_course['id'].'/top_course'); ?>');">
                                            <i class="fas fa-minus me-2"></i> <?php echo get_phrase('Remove from cart'); ?>
                                        </a>
                                        <a id="add_to_cart_btn_top_course<?php echo $top_course['id']; ?>" class="purchase-btn align-items-center me-auto <?php if(in_array($top_course['id'], $cart_items)) echo 'd-hidden'; ?>" href="javascript:void(0)" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $top_course['id'].'/top_course'); ?>'); ">
                                            <i class="fas fa-plus me-2"></i> <?php echo get_phrase('Add to cart'); ?>
                                        </a>
                                        <!-- Cart button ended-->
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $('#top_course_<?php echo $top_course['id']; ?>').webuiPopover({
                                        url:'#top_course_feature_<?php echo $top_course['id']; ?>',
                                        trigger:'hover',
                                        animation:'pop',
                                        cache:false,
                                        multi:true,
                                        direction:'rtl', 
                                        placement:'horizontal',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!---------- Top courses Section End --------------->


<!---------- Top Categories Start ------------->
<section class="top-categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h1 class="text-center mt-4"><?php echo site_phrase('top_categories'); ?></h1>
                <p class="text-center mt-4 fs-16"><?php echo site_phrase('These_are_the_most_popular_courses_among_Listen_Courses_learners_worldwide')?></p>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <div class="category-product mt-5">
            <div class="row justify-content-center">
                <?php $top_10_categories = $this->crud_model->get_top_categories(12, 'sub_category_id'); ?>
                <?php foreach($top_10_categories as $top_10_category): ?>
                <?php $category_details = $this->crud_model->get_category_details_by_id($top_10_category['sub_category_id'])->row_array(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <a href="<?php echo site_url('home/courses?category='.$category_details['slug']); ?>" class="category-product-body position-relative">
                           <div class="cate-icon"  style="color: #<?php echo rand(100000, 999999); ?>">
                                <i class="<?php echo $category_details['font_awesome_class']; ?>"></i>
                            </div>
                            <span class="category-hide-icon"><i class="fa-solid fa-angle-right"></i></span>
                            <h5 class="pt-0"> <?php echo $category_details['name']; ?></h5>
                            <p class="hide-cat-text"><?php echo $top_10_category['course_number'].' '.site_phrase('courses'); ?></p>
                         </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!---------- Top Categories end ------------->

<!---------- Latest courses Section start --------------->
<section class="courses grid-view-body pb-4">
    <div class="container">
        <h1 class="text-center"><span><?php echo site_phrase('top') . ' 10 ' . site_phrase('latest_courses'); ?></span></h1>
        <p class="text-center fs-16"><?php echo site_phrase('These_are_the_most_latest_courses_among_Listen_Courses_learners_worldwide')?></p>
        <div class="courses-card">
            <div class="course-group-slider ">
                <?php
                $latest_courses = $this->crud_model->get_latest_10_course();
                foreach ($latest_courses as $latest_course) :
                    if($latest_course['slug_count'] == 1 || $latest_course['slug_count'] == 2){
                        $latest_course_slug = $latest_course['slug'];
                    }else if($latest_course['slug_count'] == 3 || $latest_course['slug_count'] == 4){
                        $latest_course_slug = $latest_course['category_slug'] .'/' . $latest_course['sub_category_slug'] .'/' . $latest_course['slug'];
                    }else{
                        $latest_course_slug = $latest_course['slug'];
                    }
                    $lessons = $this->crud_model->get_lessons('course', $latest_course['id']);
                    $instructor_details = $this->user_model->get_all_user($latest_course['creator'])->row_array();
                    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($latest_course['id']);
                    $course_duration = $latest_course['is_top_course'] == 1 || $latest_course['is_top10_course'] == 1 || $latest_course['show_it_in_category'] == 1 ? $latest_course['course_duration_in_hours'] . " Hours" : $course_duration;
                    $course_duration_in_months = $top_course['course_duration_in_months'] >1 ? $latest_course['course_duration_in_months'] ." Months" : $latest_course['course_duration_in_months'] . " Month";
                    if($latest_course['daily_class_duration_in_hours']){
                        $hours_text = $latest_course['daily_class_duration_in_hours'] > 1 ? " Hours" : " Hour";
                        $course_duration_in_months = $course_duration_in_months ." (Daily " . $latest_course['daily_class_duration_in_hours'] .$hours_text.")";
                    }
                    $total_rating =  $this->crud_model->get_ratings('course', $latest_course['id'], true)->row()->rating;
                    $ratings_count = $this->crud_model->get_ratings_count($latest_course['id']);
                    if($ratings_count){
                        $one = $ratings_count['one_rating_count'];
                        $two = $ratings_count['two_rating_count'];
                        $three = $ratings_count['three_rating_count'];
                        $four = $ratings_count['four_rating_count'];
                        $five = $ratings_count['five_rating_count'];
                        $number_of_ratings = $ratings_count['number_of_ratings'];
                        $number_of_enrolments = $ratings_count['number_of_students_enrolled'];
                        $average_ceil_rating = round((($one*1) + ($two*2) + ($three*3)+($four*4)+($five*5))/$number_of_ratings,1);
                    }else{
                        $average_ceil_rating = 0;
                        $number_of_ratings = 0;
                        $number_of_enrolments = 0;
                    }
                    ?>
                    <div class="single-popup-course">
                        <a href="<?php echo site_url($latest_course_slug); ?>" id="latest_course_<?php echo $latest_course['id']; ?>" class="checkPropagation courses-card-body">
                            <div class="courses-card-image ">
                                <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>">
                                <div class="courses-icon <?php if(in_array($latest_course['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIconLatestCourse<?php echo $latest_course['id']; ?>">
                                    <i class="fa-solid fa-heart checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/'.$latest_course['id'].'/LatestCourse'); ?>')"></i>
                                </div>
                                <div class="courses-card-image-text">
                                    <h3><?php echo get_phrase($latest_course['level']); ?></h3>
                                </div> 
                            </div>
                            <div class="courses-text">
                                <h5 class="mb-2 top-10-latest-course-title"><?php echo $latest_course['title']; ?></h5>
                                <div class="review-icon">
                                    <div class="review-icon-star align-items-center">
                                        <p><?php echo $average_ceil_rating; ?></p>
                                        <p><?php 
                                            for($i=1; $i<=5; $i++){
                                                if($average_ceil_rating < $i ) {
                                                    if(is_float($average_ceil_rating) && (ceil($average_ceil_rating) == $i || floor($average_ceil_rating) == $i)){
                                                        echo $i==5 ? '<i class="fa-regular fa-star-half-stroke filled"></i>' : '<i style="margin-right:-7px;" class="fa-regular fa-star-half-stroke filled"></i>';
                                                    }else{
                                                        echo $i==5 ? '<i class="fa-solid fa-star"></i>' : '<i style="margin-right:-7px;" class="fa-solid fa-star"></i>';
                                                    }
                                                 }else {
                                                    echo $i==5 ? '<i class="fa-solid fa-star filled"></i>' : '<i style="margin-right:-7px;" class="fa-solid fa-star filled"></i>';
                                                 }
                                            }
                                        ?></p>
                                        <!-- <p><i class="fa-solid fa-star <?php if($number_of_ratings > 0) echo 'filled'; ?>"></i></p> -->
                                        <p>(<?php echo $number_of_ratings; ?> <?php echo get_phrase('Reviews') ?>)</p>
                                    </div>
                                    <div class="review-btn d-flex align-items-center">
                                       
                                    </div>
                                </div>
                                <div class="courses-price-border">
                                    <div class="courses-price">
                                        <div class="courses-price-left">
                                            <?php if($latest_course['is_free_course']): ?>
                                                <h5><?php echo get_phrase('Free'); ?></h5>
                                            <?php elseif($latest_course['discount_flag']): ?>
                                                <h5><?php echo currency($latest_course['discounted_price']); ?></h5>
                                                <p class="mt-1"><del><?php echo currency($latest_course['price']); ?></del><span><?php echo " +Taxes"; ?></span></p>
                                            <?php else: ?>
                                                <h5><?php echo currency($latest_course['price']); ?><span><?php echo " +Taxes"; ?></span></h5>
                                            <?php endif; ?>
                                        </div>
                                        <div class="courses-price-right ">
                                            <p class="m-0"><i class="fa-regular fa-clock p-0 text-15px"></i> <?php echo $course_duration; ?></p>
                                        </div>
                                    </div>
                                    <div class="courses-price">
                                        <p class="m-0"> <i class="fa-regular fa-clock p-0 text-15px"></i> <?php echo $course_duration_in_months; ?></p>
                                    </div>
                                </div>
                             </div>
                        </a>




                        <div id="latest_course_feature_<?php echo $latest_course['id']; ?>" class="course-popover-content">
                            <?php if ($latest_course['last_modified'] == "") : ?>
                                <p class="last-update"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $latest_course['date_added']); ?></p>
                            <?php else : ?>
                                <p class="last-update"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $latest_course['last_modified']); ?></p>
                            <?php endif; ?>
                            <div class="course-title">
                                 <a href="<?php echo site_url($latest_course_slug); ?>"><?php echo $latest_course['title']; ?></a>
                            </div>
                            <div class="course-meta">
                                <?php if ($latest_course['course_type'] == 'general') : ?>
                                    <span class=""><i class="fas fa-play-circle"></i>
                                        <?php echo $latest_course["number_of_lectures"]/*$this->crud_model->get_lessons('course', $latest_course['id'])->num_rows()*/ . ' ' . site_phrase('lessons'); ?>
                                    </span>
                                    <span class=""><i class="far fa-clock"></i>
                                        <?php echo $course_duration; ?>
                                    </span>
                                <?php elseif ($latest_course['course_type'] == 'h5p') : ?>
                                    <span class="badge bg-light"><?= site_phrase('h5p_course'); ?></span>
                                <?php elseif ($latest_course['course_type'] == 'scorm') : ?>
                                    <span class="badge bg-light"><?= site_phrase('scorm_course'); ?></span>
                                <?php endif; ?>
                                <span class=""><i class="fas fa-closed-captioning"></i><?php echo ucfirst($latest_course['language']); ?></span>
                             </div>
                             <div class="course-meta">
                                    <span class=""><i class="far fa-clock"></i>
                                        <?php echo $course_duration_in_months; ?>
                                    </span>
                             </div>
                            <h6 class="text-black text-14px mb-1"><?php echo get_phrase('Outcomes') ?>:</h6>
                            <ul class="will-learn">
                                <?php $outcomes = json_decode($latest_course['outcomes']);
                                foreach ($outcomes as $outcome) : ?>
                                    <li><?php echo $outcome; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="popover-btns">
                                <?php $cart_items = $this->session->userdata('cart_items'); ?>
                                <?php if(is_purchased($latest_course['id'])): ?>
                                    <a href="<?php echo site_url('home/lesson/'.slugify($latest_course['title']).'/'.$latest_course['id']) ?>" class="purchase-btn d-flex align-items-center  me-auto"><i class="far fa-play-circle me-2"></i> <?php echo get_phrase('Start Now'); ?></a>
                                    <?php if ($latest_course['is_free_course'] != 1) : ?>
                                        <button type="button" class="gift-btn ms-auto" title="<?php echo get_phrase('Gift someone else'); ?>" data-bs-toggle="tooltip" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $latest_course['id'].'?gift=1'); ?>')"><i class="fas fa-gift"></i></button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if ($latest_course['is_free_course'] == 1) : ?>
                                        <a class="purchase-btn green_purchase ms-auto" href="<?php echo site_url('home/get_enrolled_to_free_course/' . $latest_course['id']); ?>"><?php echo get_phrase('Enroll Now'); ?></a>
                                    <?php else : ?>

                                        <!-- Cart button -->
                                        <a id="added_to_cart_btn_latest_course<?php echo $latest_course['id']; ?>" class="purchase-btn align-items-center me-auto <?php if(!in_array($latest_course['id'], $cart_items)) echo 'd-hidden'; ?>" href="javascript:void(0)" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $latest_course['id'].'/latest_course'); ?>');">
                                            <i class="fas fa-minus me-2"></i> <?php echo get_phrase('Remove from cart'); ?>
                                        </a>
                                        <a id="add_to_cart_btn_latest_course<?php echo $latest_course['id']; ?>" class="purchase-btn align-items-center me-auto <?php if(in_array($latest_course['id'], $cart_items)) echo 'd-hidden'; ?>" href="javascript:void(0)" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $latest_course['id'].'/latest_course'); ?>'); ">
                                            <i class="fas fa-plus me-2"></i> <?php echo get_phrase('Add to cart'); ?>
                                        </a>
                                        <!-- Cart button ended-->
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $('#latest_course_<?php echo $latest_course['id']; ?>').webuiPopover({
                                        url:'#latest_course_feature_<?php echo $latest_course['id']; ?>',
                                        trigger:'hover',
                                        animation:'pop',
                                        cache:false,
                                        multi:true,
                                        direction:'rtl', 
                                        placement:'horizontal',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!---------- Latest courses Section End --------------->



<!---------  Expert Instructor Start ---------------->
<?php $top_instructor_ids = $this->user_model->get_instructor_for_home_page()->result_array(); 
    $top_instructor_ids = array_slice($top_instructor_ids, 0, 10);
?>
<?php if(count($top_instructor_ids) > 0): ?>
<section class="expert-instructor top-categories pb-3 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h1 class="text-center mt-4"><?php echo get_phrase('Top Instructors') ?></h1>
                <p class="text-center mt-4 mb-4 fs-16"><?php echo get_phrase('They efficiently serve large number of students on our platform') ?></p>
            </div>
            <div class="col-lg-3 "></div>
        </div>
        <div class="instructor-card">
            <div class="row justify-content-center">
                <?php foreach($top_instructor_ids as $top_instructor_id):
                    $top_instructor = $this->user_model->get_all_user($top_instructor_id['id'])->row_array();
                    $social_links  = json_decode($instructor_details['social_links'], true); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 ">
                        <div class="instructor-card-body">
                            <div class="instructor-card-img">
                                <!-- <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($top_instructor['id']); ?>"> -->
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/professor_i.png"; ?>" alt="">
                            </div>
                            <div class="instructor-card-text">
                                <div class="icon">
                                    <div class="icon-div-2">
                                        <?php if($social_links['facebook']): ?>
                                            <a class="" href="<?php echo $social_links['facebook']; ?>" target="_blank">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if($social_links['twitter']): ?>
                                            <a class="" href="<?php echo $social_links['twitter']; ?>" target="_blank">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                           
                                        <?php endif; ?>
                                        <?php if($social_links['linkedin']): ?>
                                            <a class="" href="<?php echo $social_links['linkedin']; ?>" target="_blank">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <a class="text-muted w-100" href="<?php echo site_url('home/instructor_page/'.$top_instructor['id']); ?>">
                                    <h3 class="text-center"><?php echo $top_instructor['first_name'].' '.$top_instructor['last_name']; ?></h3>
                                    <p class="ellipsis-line-2"><?php echo $top_instructor['title']; ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php $motivational_speechs = json_decode(get_frontend_settings('motivational_speech'), true); ?>
<?php if(count($motivational_speechs) > 0): ?>
<!---------  Motivetional Speech Start ---------------->
<section class="expert-instructor top-categories pb-3 performance-hide">
  <div class="container">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <h1 class="text-center mt-4"><?php echo get_phrase('Think more clearly'); ?></h1>
        <p class="text-center mt-4 mb-4 fs-16"><?php echo get_phrase('Gather your thoughts, and make your decisions clearly') ?></p>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <ul class="speech-items">
        <?php $counter = 0; ?>
        <?php foreach($motivational_speechs as $key => $motivational_speech): ?>
        <?php $counter = $counter+1; ?>
        <li>
            <div class="speech-item">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5">
                        <div class="speech-item-img">
                            <img loading="lazy" src="<?php echo site_url('uploads/system/motivations/'.$motivational_speech['image']) ?>" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="speech-item-content">
                            <p class="no"><?php echo $counter; ?></p>
                            <div class="inner">
                                <h4 class="title">
                                    <?php echo $motivational_speech['title']; ?>
                                </h4>
                                <p class="info">
                                    <?php echo nl2br($motivational_speech['description']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
  </div>
</section>
<!---------  Motivetional Speech end ---------------->
<?php endif; ?>

<?php $website_faqs = json_decode(get_frontend_settings('website_faqs'), true); ?>
<?php if(count($website_faqs) > 0): ?>
<!---------- Questions Section Start  -------------->
<section class="faq performance-hide">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h1 class="text-center mt-4"><?php echo get_phrase('Frequently Asked Questions') ?></h1>
                <p class="text-center mt-4 mb-5 fs-16"><?php echo get_phrase('Have something to know?') ?> <?php echo get_phrase('Check here if you have any questions about us.') ?></p>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="faq-accrodion mb-0">
                    <div class="accordion" id="accordionFaq">
                        <?php foreach($website_faqs as $key => $faq): ?>
                            <?php if($key > 4) break; ?>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="<?php echo 'faqItemHeading'.$key; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel'.$key; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel'.$key; ?>">
                                    <?php echo $faq['question']; ?>
                                </button>
                              </h2>
                              <div id="<?php echo 'faqItempanel'.$key; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading'.$key; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br($faq['answer']); ?></p>
                                </div>
                              </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if(count($website_faqs) > 5): ?>
                        <a href="<?php echo site_url('home/faq') ?>" class="btn btn-primary mt-5"><?php echo get_phrase('See More'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Questions Section End  -------------->
<?php endif; ?>


<!------------- Blog Section Start ------------>
<?php $latest_blogs = $this->crud_model->get_latest_blogs(3); ?>
<?php if(get_frontend_settings('blog_visibility_on_the_home_page') && $latest_blogs->num_rows() > 0): ?>
<section class="courses blog performance-hide">
    <div class="container">
        <h1 class="text-center"><span><?php echo site_phrase('Visit our latest blogs')?></span></h1>
        <p class="text-center fs-16"><?php echo site_phrase('Visit our valuable articles to get more information.')?>
        <div class="courses-card">
            <div class="row">
               <?php foreach($latest_blogs->result_array() as $latest_blog):
                $user_details = $this->user_model->get_all_user($latest_blog['user_id'])->row_array();
                $blog_category = $this->crud_model->get_blog_categories($latest_blog['blog_category_id'])->row_array(); ?>  
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="<?php echo site_url('blog/details/'.slugify($latest_blog['title']).'/'.$latest_blog['blog_id']); ?>" class="courses-card-body">
                        <div class="courses-card-image">
                            <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$latest_blog['thumbnail'];
                               if(!file_exists($blog_thumbnail) || !is_file($blog_thumbnail)):
                                   $blog_thumbnail = base_url('uploads/blog/thumbnail/placeholder.png');
                              endif; ?>
                            <div class="courses-card-image">
                             <img loading="lazy" src="<?php echo $blog_thumbnail; ?>">
                            </div>
                            <div class="courses-card-image-text">
                                <h3><?php echo $blog_category['title']; ?></h3>
                            </div> 
                        </div>
                        <div class="courses-text">
                            <h5 class="truncate-text"><?php echo $latest_blog['title']; ?></h5>
                            <p class="ellipsis-line-2"><?php echo ellipsis(strip_tags(htmlspecialchars_decode_($latest_blog['description'])), 100); ?></p>
                            <div class="courses-price-border">
                                <div class="courses-price">
                                    <div class="courses-price-left">
                                        <img loading="lazy" class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>">
                                        <h5><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></h5>
                                    </div>
                                    <div class="courses-price-right ">
                                        <p><?php echo get_past_time($latest_blog['added_date']); ?></p>
                                    </div>
                                </div>
                            </div>
                           </div>
                     </a>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<!------------- Become Students Section start --------->
<section class="student performance-hide">
    <div class="container">
        <div class="row">
            <div class="col-lg-6  <?php if (get_settings('allow_instructor') != 1) echo 'w-100'; ?>">
                <div class="student-body-1">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                            <div class="student-body-text">
                                <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/2.png')?>">
                                <h1><?php echo site_phrase('join_now_to_start_learning'); ?></h1>
                                <p><?php echo site_phrase('Learn from our quality instructors!')?> </p>
                                <a href="<?php echo site_url('sign_up'); ?>"><?php echo site_phrase('get_started'); ?></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <img loading="lazy" class="man" src="<?php echo base_url('assets/frontend/default-new/image/student-1.webp')?>">
                        </div>
                     </div>
                </div>      
            </div>
            <?php if (get_settings('allow_instructor') == 1) : ?>
                <div class="col-lg-6 ">
                    <div class="student-body-2">
                    <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 ">
                                <div class="student-body-text">
                                  <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/2.png')?>">
                                    <h1><?php echo site_phrase('become_a_new_instructor'); ?></h1>
                                    <p><?php echo site_phrase('Teach_thousands_of_students_and_earn_money!')?> </p>
                                    <?php if($this->session->userdata('user_id')): ?>
                                       <a  href="<?php echo site_url('user/become_an_instructor'); ?>"><?php echo site_phrase('join_now'); ?></a>
                                      <?php else: ?>
                                        <a  href="<?php echo site_url('sign_up?instructor=yes'); ?>"><?php echo site_phrase('join_now'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <img loading="lazy" class="man" src="<?php echo base_url('assets/frontend/default-new/image/student-2.webp')?>">
                            </div>
                        </div>  
                    </div> 
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>



<script>
    let user_id = "<?php echo $this->session->userdata('user_id') ? true : false; ?>";
    if(user_id){
        localStorage.removeItem('dataSubmitted');
        localStorage.removeItem('clickFrom');
        localStorage.removeItem('userData');
    }
    
</script>

<!------------- Become Students Section End --------->




<script>

    function getSpaces(len){
        let text = "";
        for(let j=0; j<=len; j++){
            text += "\xa0"; 
        }
        return text;
    }
    let top_courses = document.getElementsByClassName("top-course-slider");
    let heights = [];
    Array.prototype.max = function() {
        return Math.max.apply(null, this);
    };
    
    for(let i=0; i<top_courses.length; i++){
        heights.push((top_courses[i].innerText).length);
    }
    let max_height  = heights.max();
    for(let i=0; i<top_courses.length; i++){
        let text = getSpaces(max_height - heights[i]);
        top_courses[i].innerText = top_courses[i].innerText + text;
    }

    let top_10_courses = document.getElementsByClassName("top-10-latest-course-title");
    let top_10_courses_heights = [];
    for(let i=0; i<top_10_courses.length; i++){
        top_10_courses_heights.push((top_10_courses[i].innerText).length);
    }
    let max_top_10_courses_height  = top_10_courses_heights.max();
    for(let i=0; i<top_10_courses.length; i++){
        let text = getSpaces(max_top_10_courses_height - top_10_courses_heights[i]);
        top_10_courses[i].innerText = top_10_courses[i].innerText + text;
    }

    function upcomingCourseHeightAlignment(){
        let up_coming_courses = document.getElementsByClassName("title up-comoing-course-title");
        console.log(up_coming_courses);
        let up_coming_courses_heights = [];
        for(let i=0; i<up_coming_courses.length; i++){
            up_coming_courses_heights.push(up_coming_courses[i].offsetHeight);
            console.log(up_coming_courses[0].offsetHeight);
        }
        let max_up_coming_courses_height  = up_coming_courses_heights.max();
        console.log(max_up_coming_courses_height);
        for(let i=0; i<up_coming_courses.length; i++){
            let text = getSpaces(max_up_coming_courses_height - up_coming_courses_heights[i]);
            up_coming_courses[i].style.height = max_up_coming_courses_height + "px";
            console.log(up_coming_courses[i].offsetHeight);
        }
    }

</script>

<script>
    window.onscroll = function() {myFunction()};
    function myFunction(){
        let hide_sections = document.getElementsByClassName("performance-hide");
        for(let i=0; i<hide_sections.length; i++){
            hide_sections[i].classList.remove('performance-hide');
            if(hide_sections[i] && typeof hide_sections[i].classList){
                hide_sections[i].classList.add('performance-show');
            }
        }
    }
</script>