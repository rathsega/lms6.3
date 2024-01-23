<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<?php
log_message("error","The Slug is : ". $slug);
$course_details = $this->crud_model->get_course_by_slug($slug)->row_array();
// var_dump($course_details);
if(!$course_details){
    //redirect(site_url('404_override'), 'refresh');
}
$course_id = $course_details['id'];
$lessons = $this->crud_model->get_lessons('course', $course_details['id']);
$instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
$course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
$video_course = false;
if($course_details['is_top_course'] == 1 || $course_details['is_top10_course'] == 1 || $course_details['show_it_in_category'] == 1){
    $video_course = false;
    $course_duration =  $course_details['course_duration_in_hours'] . " Hours";
}else{
    $video_course = true;
    $course_duration =  $course_duration;
}
$ratings_count = $this->crud_model->get_ratings_count($course_details['id']);
if($ratings_count){
    $one = $ratings_count['one_rating_count'];
    $two = $ratings_count['two_rating_count'];
    $three = $ratings_count['three_rating_count'];
    $four = $ratings_count['four_rating_count'];
    $five = $ratings_count['five_rating_count'];
    $number_of_ratings = $ratings_count['number_of_ratings'];
    $number_of_enrolments = $ratings_count['number_of_students_enrolled'];
    $average_ceil_rating = ceil((($one*1) + ($two*2) + ($three*3)+($four*4)+($five*5))/$number_of_ratings);
}else{
    $average_ceil_rating = 0;
    $number_of_ratings = 0;
    $number_of_enrolments = 0;
}
?>

<!---------- Banner Start ---------->
<section>
    <div class="bread-crumb courses-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="courses-details-1st-text">
                        <h1><?php echo $course_details['title']; ?></h1>
                        <p class="mb-3"><?php echo $course_details['short_description']; ?></p>
                        <div class="review">
                            <div class="row ">
                                <div class="col-12 course-heading-info mb-3">
                                    <div class="info-tag">
                                            <img width="25px" height="25px" class="rounded-circle object-fit-cover me-1" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>">
                                        <p class="text-12px mt-5px me-1"><?php echo get_phrase('Created By'); ?></p>
                                        <p class="text-15px mt-1">
                                            <a class="created-by-instructor" href="<?php echo site_url('home/instructor_page/' . $course_details['creator']); ?>" ><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></a>
                                        </p> 
                                    </div>

                                    <div class="info-tag">
                                        <i class="fa-regular fa-clock text-15px mt-7px"></i>
                                        <p class="text-15px mt-1"><?php echo $course_duration; ?></p>
                                    </div>
                                    <div class="info-tag">
                                        <i class="fa-regular fa-user text-15px mt-7px"></i>
                                        <p class="text-15px mt-1"><?php echo $number_of_enrolments ?> <?php echo get_phrase('Enrolled'); ?></p>
                                    </div>

                                    <div class="info-tag">
                                        <div class="icon">
                                            <ul>
                                                <?php for ($i = 1; $i < 6; $i++) : ?>
                                                    <?php if ($i <= $average_ceil_rating) : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-15px  mt-7px"></i></li>
                                                    <?php else : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-light text-15px  mt-7px"></i></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                                <p class="text-15px mt-1">(<?php echo $number_of_ratings.' '.get_phrase('Reviews'); ?>)</p>
                                            </ul>
                                        </div>
                                    </div>                                   

                                    
                                </div>
                                <div class="col-12 course-heading-info mb-3">
                                    <div class="info-tag">
                                        <i class="fas fa-language text-15px mt-8px"></i>
                                        <p class="text-15px mt-1"><?php echo ucfirst($course_details['language']); ?></p>
                                    </div>  
                                    
                                    <div class="info-tag">
                                        <p><i class="far fa-calendar-alt text-15px mt-7px"></i></p>
                                        <p class="text-12px mt-5px me-1"><?php echo get_phrase('Last Updated'); ?></p>
                                        <p class="text-15px mt-1">
                                            <?php if ($course_details['last_modified'] > 0) : ?>
                                              <?php echo date('D, d-M-Y', $course_details['last_modified']); ?>
                                            <?php else : ?>
                                              <?php echo date('D, d-M-Y', $course_details['date_added']); ?>
                                            <?php endif; ?>
                                        </p> 
                                    </div>
                                    <div class="info-tag blink2" id="links">
                                        <i class="fa-regular fa-file text-15px mt-7px"></i>
                                        <p class="text-15px mt-1 content_button"> <a href="<?php echo base_url() . 'uploads/broucher/' . $course_details['broucher'] ?>" download="<?php echo end(explode("/",$slug)); ?>"  style="color:#F9B23A;" name="current_broucher_link" id="current_broucher_link"><b><?php echo get_phrase('Download Broucher'); ?></b></a></p>
                                        <p class="text-15px mt-1 contactus_form_button" id="openModalBtn1"> <a href="#" style="color:#F9B23A;" download name="current_broucher_link"><b><?php echo get_phrase('Download Broucher'); ?></b></a></p>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Banner Area End ---------->

<!--------- course Decription Page Start ------>
<section class="course-decription">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 order-2 order-lg-1">
                <div class="course-left-side">
                    <ul class="nav nav-tabs" id="myTab" role="tablist"  style="position: sticky; top: 50px; z-index: 1; background-color:white;">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="course-overview-tab" data-bs-toggle="tab" data-bs-target="#course-overview" type="button" role="tab" aria-controls="course-overview" aria-selected="true" onclick="moveToStartPosition()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18.666" viewBox="0 0 14 18.666">
                              <g id="Group_8" data-name="Group 8" transform="translate(14 0) rotate(90)">
                                <path id="Shape" d="M7,14.307l3.7,3.78c1.3,1.326,3.3.227,3.3-1.81V0H0V16.277c0,2.037,2,3.136,3.3,1.81ZM2,2.385V16.277l5-5.11,5,5.11V2.385Z" transform="translate(0 14) rotate(-90)" fill="#1e293b" fill-rule="evenodd"/>
                              </g>
                            </svg>

                            <span class="ms-2"><?php echo get_phrase('Overview'); ?></button></span>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false" onclick="moveToStartPosition()">
                            <svg id="Group_13" data-name="Group 13" xmlns="http://www.w3.org/2000/svg" width="20" height="19.692" viewBox="0 0 20 19.692">
                              <path id="Shape" d="M14,2.5a.5.5,0,0,0-.5-.5H2.5a.5.5,0,0,0-.5.5V16.028a.455.455,0,0,0,.658.407,3,3,0,0,1,2.683,0L7.553,17.54a1,1,0,0,0,.894,0l2.211-1.106a3,3,0,0,1,2.683,0A.455.455,0,0,0,14,16.028Zm2,16.691a.5.5,0,0,1-.724.447l-2.829-1.415a1,1,0,0,0-.894,0L9.342,19.329a3,3,0,0,1-2.683,0L4.447,18.224a1,1,0,0,0-.894,0L.724,19.638A.5.5,0,0,1,0,19.191V0H16Z" transform="translate(2)" fill="#1e293b" fill-rule="evenodd"/>
                              <g id="Shape-2" data-name="Shape" transform="translate(6 4)">
                                <path id="_5D20F028-8654-4138-BE2C-2596CB0A8C99" data-name="5D20F028-8654-4138-BE2C-2596CB0A8C99" d="M1,0A1,1,0,0,0,1,2H3A1,1,0,0,0,3,0Z" fill="#1e293b"/>
                                <path id="CB5AF5FF-CA28-49F3-8207-42C293893700" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6)" fill="#1e293b"/>
                                <path id="ECA14E2E-A90F-4909-9E68-1DC1F5104902" d="M0,1A1,1,0,0,1,1,0H3A1,1,0,0,1,3,2H1A1,1,0,0,1,0,1Z" transform="translate(0 4)" fill="#1e293b"/>
                                <path id="_841F264B-A82E-487A-AEC1-CFCDCADF7975" data-name="841F264B-A82E-487A-AEC1-CFCDCADF7975" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6 4)" fill="#1e293b"/>
                                <path id="AD528B39-E6BD-4596-94B4-DC58311EEB90" d="M0,1A1,1,0,0,1,1,0H3A1,1,0,0,1,3,2H1A1,1,0,0,1,0,1Z" transform="translate(0 8)" fill="#1e293b"/>
                                <path id="_6CF152B9-DFD7-4CE1-B45B-12E7F5ED6D14" data-name="6CF152B9-DFD7-4CE1-B45B-12E7F5ED6D14" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6 8)" fill="#1e293b"/>
                              </g>
                              <path id="Shape-3" data-name="Shape" d="M0,1A1,1,0,0,1,1,0H19a1,1,0,0,1,0,2H1A1,1,0,0,1,0,1Z" fill="#1e293b"/>
                            </svg>

                           <span class="ms-2"><?php echo get_phrase('Curriculum') ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="moveToStartPosition()">
                            <svg id="Group_12" data-name="Group 12" xmlns="http://www.w3.org/2000/svg" width="15.582" height="19.666" viewBox="0 0 15.582 19.666">
                              <path id="Shape" d="M7.791,1.731a6.06,6.06,0,0,0-6.06,6.06V9.522A.866.866,0,1,1,0,9.522V7.791a7.791,7.791,0,0,1,15.582,0V9.522a.866.866,0,1,1-1.731,0V7.791A6.06,6.06,0,0,0,7.791,1.731Z" transform="translate(0 9.278)" fill="#1e293b"/>
                              <path id="Shape-2" data-name="Shape" d="M5.194,8.656A3.463,3.463,0,1,0,1.731,5.194,3.463,3.463,0,0,0,5.194,8.656Zm0,1.731A5.194,5.194,0,1,0,0,5.194,5.194,5.194,0,0,0,5.194,10.388Z" transform="translate(2.597)" fill="#1e293b" fill-rule="evenodd"/>
                            </svg>

                            <span class="ms-2"><?php echo get_phrase('Instructor') ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false"  onclick="moveToStartPosition()">
                                <svg id="Group_14" data-name="Group 14" xmlns="http://www.w3.org/2000/svg" width="20" height="19.749" viewBox="0 0 20 19.749">
                                  <path id="Shape" d="M5,13.9V17L10.062,14,10.591,14A40.888,40.888,0,0,0,16,13.533a1.9,1.9,0,0,0,1.649-1.542A23.708,23.708,0,0,0,18,8a23.709,23.709,0,0,0-.346-3.991A1.9,1.9,0,0,0,16,2.467,40.515,40.515,0,0,0,10,2a40.514,40.514,0,0,0-6,.467A1.9,1.9,0,0,0,2.346,4.009,23.7,23.7,0,0,0,2,8a23.7,23.7,0,0,0,.346,3.991,1.859,1.859,0,0,0,1.285,1.455ZM.375,3.67A3.9,3.9,0,0,1,3.695.489,42.513,42.513,0,0,1,10,0a42.512,42.512,0,0,1,6.305.489,3.9,3.9,0,0,1,3.319,3.18A25.7,25.7,0,0,1,20,8a25.694,25.694,0,0,1-.375,4.33,3.9,3.9,0,0,1-3.319,3.18,42.9,42.9,0,0,1-5.681.484L4.509,19.608A1,1,0,0,1,3,18.748v-3.4A3.859,3.859,0,0,1,.375,12.33,25.7,25.7,0,0,1,0,8,25.7,25.7,0,0,1,.375,3.67Z" fill="#1e293b" fill-rule="evenodd"/>
                                  <path id="Shape-2" data-name="Shape" d="M1,0A1,1,0,0,0,1,2H11a1,1,0,0,0,0-2ZM1,4A1,1,0,0,0,1,6H5A1,1,0,0,0,5,4Z" transform="translate(4 5)" fill="#1e293b" fill-rule="evenodd"/>
                                </svg>

                                <span class="ms-2"><?php echo get_phrase('Reviews') ?></span></button>
                          </li>
                    </ul>
                    <div class="tab-content" id="tab-content">
                        <div class="tab-pane fade show active" id="course-overview" role="tabpanel" aria-labelledby="course-overview-tab">
                            <?php include "course_page_info_description.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                            <?php include "course_page_curriculum.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                            <?php include "course_page_instructor.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews">
                                <?php include "course_page_reviews.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 order-1 order-lg-2">
                <div class="course-right-section">
                    <div class="course-card">
                        <div class="card-img">
                            <div class="courses-card-image">
                                
                                <div class="card-video-icon content_button" name="demo_video_link" id="demoVideoButton" onclick="lesson_preview('<?php echo site_url('home/course_preview/'.$course_details['id']); ?>', '<?php echo get_phrase($course_details['title']) ?>')">
                                    <i class="fa-solid fa-play"></i>
                                </div>

                                <div class="card-video-icon contactus_form_button" name="demo_video_link" id="openModalBtn">
                                    <i class="fa-solid fa-play"></i>
                                </div>

                                <img class="w-100" style="pointer-events: none" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>">

                                <div class="courses-icon <?php if(in_array($course_details['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIcon<?php echo $course_details['id']; ?>">
                                    <i class="fa-solid fa-heart me-2 cursor-pointer checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/'.$course_details['id']); ?>')"></i>
                                </div>
                            </div>
                        </div>
                        <div class="ammount d-flex">
                            <?php if($course_details['is_free_course']): ?>
                                <h1 class="fw-500"><?php echo get_phrase('Free'); ?></h1>
                            <?php elseif($course_details['discount_flag']): ?>
                                <h1 class="fw-500"><?php echo currency($course_details['discounted_price']); ?></h1>
                                <h3 class="fw-500"><del><?php echo currency($course_details['price']); ?></del></h3>
                            <?php else: ?>
                                <h1 class="fw-500"><?php echo currency($course_details['price']); ?></h1>
                            <?php endif; ?>

                            <!-- <a href="<?php echo base_url('home/compare?course-1='.slugify($course_details['title']).'&course-id-1='.$course_details['id']); ?>" title="<?php echo get_phrase('Compare this course') ?>" data-bs-toggle="tooltip" class="ms-auto py-2">
                                <img width="18px" src="<?php echo base_url('assets/frontend/default-new/image/compare.png') ?>" style="filter: invert(1);">
                            </a> -->
                        </div>
                        <div class="enrol">
                            <div class="icon">
                                <img src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-1.png') ?>">
                                <h4><?php echo get_phrase('Lectures') ?></h4>
                            </div>
                            <h5><?php echo $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?></h5>
                        </div>

                        <?php $number_of_quiz = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz'])->num_rows(); ?>
                        <?php if($number_of_quiz > 0): ?>
                            <div class="enrol">
                                <div class="icon">
                                    <img src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-4.png') ?>">
                                    <h4><?php echo get_phrase('Quizzes') ?></h4>
                                </div>
                                
                                <h5><?php echo $number_of_quiz; ?></h5>
                            </div>
                        <?php endif; ?>

                        <div class="enrol">
                            <div class="icon">
                                <img src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-2.png') ?>">
                                <h4><?php echo get_phrase('Skill level') ?></h4>
                            </div>
                            <h5><?php echo get_phrase($course_details['level']); ?></h5>
                        </div>
                        <div class="enrol">
                            <div class="icon">
                                <img src="<?php echo base_url('assets/frontend/default-new/image/a-s-1.png') ?>">
                                <h4><?php echo get_phrase('Duration') ?></h4>
                            </div>
                            <h5><?php echo $course_details['course_duration_in_months'] > 1 ? $course_details['course_duration_in_months'] ." Months" : $course_details['course_duration_in_months'] . " Month"; ?></h5>
                        </div>
                        <div class="enrol">
                            <div class="icon">
                                <img src="<?php echo base_url('assets/frontend/default-new/image/Group 17906.png') ?>">
                                <h4><?php echo get_phrase('Daily') ?></h4>
                            </div>
                            <h5><?php echo $course_details['daily_class_duration_in_hours'] > 1 ? $course_details['daily_class_duration_in_hours'] . " Hours" : $course_details['daily_class_duration_in_hours'] . " Hour"; ?></h5>
                        </div>

                        <?php if(addon_status('certificate')): ?>
                            <div class="enrol">
                                <div class="icon">
                                    <img src="<?php echo base_url('assets/frontend/default-new/image/certificate.png') ?>">
                                    <h4><?php echo get_phrase('Certificate') ?></h4>
                                </div>
                                
                                <h5><?php echo get_phrase('Yes') ?></h5>
                            </div>
                        <?php endif; ?>
                        <!-- button -->
                        <div class="button">
                            <?php $cart_items = $this->session->userdata('cart_items'); ?>
                            <?php if(is_purchased($course_details['id']) && !$this->crud_model->is_expired($course_details['id'])): ?>
                                <a href="<?php echo site_url('home/lesson/'.slugify($course_details['title']).'/'.$course_details['id']) ?>"><i class="far fa-play-circle"></i> <?php echo get_phrase('Start Now'); ?></a>
                                <?php if ($course_details['is_free_course'] != 1) : ?>
                                    <a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id'].'?gift=1'); ?>')"><i class="fas fa-gift"></i> <?php echo get_phrase('Gift someone else'); ?></a>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($course_details['is_free_course'] == 1) : ?>
                                    <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_details['id']); ?>"><?php echo get_phrase('Enroll Now'); ?></a>
                                <?php else : ?>

                                    <!-- Cart button -->
                                    <a id="added_to_cart_btn_<?php echo $course_details['id']; ?>" class="<?php if(!in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?> active" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>');"><i class="fas fa-minus"></i> <?php echo get_phrase('Remove from cart'); ?></a>
                                    <a id="add_to_cart_btn_<?php echo $course_details['id']; ?>" class="<?php if(in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>'); "><i class="fas fa-plus"></i> <?php echo get_phrase('Add to cart'); ?></a>
                                    <!-- Cart button ended-->

                                    <a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id']); ?>')"><i class="fas fa-credit-card"></i> <?php echo get_phrase('Buy Now'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (addon_status('affiliate_course')) : // course_addon start  adding
                              $CI    = &get_instance();
                              $CI->load->model('addons/affiliate_course_model');
                              $is_affiliattor = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));
                              if($is_affiliattor == 1): ?>
              
                                  <a class="btn-custom_coursepage text-decoration-none fw-600 hover-shadow-1 d-inline-block" href="#myModel" data-bs-toggle="modal" data-bs-target="#myModel" id="shareBtn" data-bs-placement="top"><i class="fas fa-user-plus"></i> <?php echo site_phrase('Share and Earn'); ?></a>
              
                              <?php endif; ?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <div id="cart_buttons"></div>
            </div>
        </div>
    </div>
</section>
<!--------- course Decription Page end ------>


<!-------- Related course section start ----->
<section class="courses grid-view-body course-details-card">
    <div class="container">
        <h1><?php echo get_phrase('Related Courses'); ?></h1>
        <div class="courses-card">
            <div class="row">
                <?php $related_courses = $this->crud_model->get_related_courses($course_details['category_id'], $course_details['sub_category_id'], $course_details['id'], 12)->result_array(); ?>
                <?php foreach($related_courses as $key => $course):
                    if($course['slug_count'] == 1 || $course['slug_count'] == 2){
                        $related_course_slug = $course['slug'];
                    }else if($course['slug_count'] == 3 || $course['slug_count'] == 4){
                        $related_course_slug = $course['category_slug'] .'/' . $course['sub_category_slug'] .'/' . $course['slug'];
                    }else{
                        $related_course_slug = $course['slug'];
                    }
                    $lessons = $this->crud_model->get_lessons('course', $course['id']);
                    $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
                    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']);
                    $course_duration = $course['is_top_course'] == 1 || $course['is_top10_course'] == 1 || $course['show_it_in_category'] == 1 ? $course['course_duration_in_hours'] . " Hours" : $course_duration;
                    $course_duration_in_months = $course['course_duration_in_months'] > 1 ? $course['course_duration_in_months'] ." Months" :  $course['course_duration_in_months'] . " Month";
                    if($course['daily_class_duration_in_hours']){
                        $hours_text = $course['daily_class_duration_in_hours'] > 1 ? " Hours" : " Hour";
                        $course_duration_in_months = $course_duration_in_months ." (Daily " . $course['daily_class_duration_in_hours'] .$hours_text.")";
                    }
                    $ratings_count = $this->crud_model->get_ratings_count($course['id']);
                    if($ratings_count){
                        $one = $ratings_count['one_rating_count'];
                        $two = $ratings_count['two_rating_count'];
                        $three = $ratings_count['three_rating_count'];
                        $four = $ratings_count['four_rating_count'];
                        $five = $ratings_count['five_rating_count'];
                        $number_of_ratings = $ratings_count['number_of_ratings'];
                        $number_of_enrolments = $ratings_count['number_of_students_enrolled'];
                        $average_ceil_rating = ceil((($one*1) + ($two*2) + ($three*3)+($four*4)+($five*5))/$number_of_ratings);
                    }else{
                        $average_ceil_rating = 0;
                        $number_of_ratings = 0;
                        $number_of_enrolments = 0;
                    }
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <a href="<?php echo site_url($related_course_slug); ?>" class="checkPropagation courses-card-body">
                            <div class="courses-card-image">
                                <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>">
                                <div class="courses-icon <?php if(in_array($course['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIcon<?php echo $course['id']; ?>">
                                    <i class="fa-solid fa-heart checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/'.$course['id']); ?>')"></i>
                                </div>
                                <div class="courses-card-image-text">
                                    <h3><?php echo get_phrase($course['level']); ?></h3>
                                </div> 
                            </div>
                            <div class="courses-text">
                                <h5 class="mb-2 related-course-title"><?php echo $course['title']; ?></h5>
                                <div class="review-icon">
                                    <div class="review-icon-star">
                                        <p><?php echo $average_ceil_rating; ?></p>
                                        <i class="fa-solid fa-star <?php if($number_of_ratings > 0) echo 'filled'; ?>"></i>
                                        <p>(<?php echo $number_of_ratings; ?> <?php echo get_phrase('Reviews') ?>)</p>
                                    </div>
                                    <div class="review-btn">
                                       <!-- <span class="compare-img checkPropagation" onclick="redirectTo('<?php echo base_url('home/compare?course-1='.slugify($course['title']).'&course-id-1='.$course['id']); ?>');">
                                            <img src="<?php echo base_url('assets/frontend/default-new/image/compare.png') ?>">
                                            <?php echo get_phrase('Compare'); ?>
                                        </span> -->
                                    </div>
                                </div>
                                <p class="ellipsis-line-2 mx-0"><?php echo $course['short_description']; ?></p>
                                <div class="courses-price-border">
                                    <div class="courses-price">
                                        <div class="courses-price-left">
                                            <?php if($course['is_free_course']): ?>
                                                <h5><?php echo get_phrase('Free'); ?></h5>
                                            <?php elseif($course['discount_flag']): ?>
                                                <h5><?php echo currency($course['discounted_price']); ?></h5>
                                                <p class="mt-1"><del><?php echo currency($course['price']); ?></del></p>
                                            <?php else: ?>
                                                <h5><?php echo currency($course['price']); ?></h5>
                                            <?php endif; ?>
                                        </div>
                                        <div class="courses-price-right ">
                                            <i class="fa-regular fa-clock"></i>
                                            <p class="m-0"><?php echo $course_duration; ?></p>
                                        </div>
                                    </div>
                                    <div class="courses-price">
                                    <p class="m-0"><i class="fa-regular fa-clock text-15px p-0"></i> <?php echo $course_duration_in_months; ?></p>
                                </div>
                                </div>
                             </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<script>

    function getSpaces(len){
        let text = "";
        for(let j=0; j<=len; j++){
            text += "\xa0"; 
        }
        return text;
    }
    let top_courses = document.getElementsByClassName("related-course-title");
    let heights = [];
    Array.prototype.max = function() {
        return Math.max.apply(null, this);
    };
    console.log(top_courses);
    for(let i=0; i<top_courses.length; i++){
        heights.push((top_courses[i].innerText).length);
    }
    let max_height  = heights.max();
    for(let i=0; i<top_courses.length; i++){
        let text = getSpaces(max_height - heights[i]);
        top_courses[i].innerText = top_courses[i].innerText + text;
    }

</script>
 <!-------- Related course section end ----->


<?php if (addon_status('affiliate_course') && $is_affiliattor==1): ?>
    <?php include 'affiliate_course_modal.php';  // course_addon  single line /adding ?>
<?php endif; ?>

<style>
    .contact_us_modal {
    display: none;
    position: fixed;
    z-index: 3;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow: auto;
    }

    .contact_us_modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    max-width: 80%;
    /* height: 85%; */
    }

    /* For tablet screens */
    @media (max-width: 768px) {
        .contact_us_modal-content {
            width: auto; /* Adjust width for tablets */
            max-width: 90%; /* Adjust max-width for tablets */
            height: auto; /* Adjust height for tablets */
            padding: 15px; /* Adjust padding for tablets */
        }
    }

    /* For mobile screens */
    @media (max-width: 480px) {
        .contact_us_modal-content {
            width: 90%; /* Adjust width for mobile */
            max-width: 95%; /* Adjust max-width for mobile */
            height: auto; /* Adjust height for mobile */
            padding: 10px; /* Adjust padding for mobile */
            margin: 10% auto; /* Adjust margin for mobile */
            border: none; /* Remove border for mobile */
        }
    }

    .close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;

    }

    .close:hover,
    .close:focus {
    cursor: pointer;
    text-decoration: none;
    }

    /* Media query for tablet screens */
    @media (max-width: 768px) {
        .contact_us_modal {
            /* Adjust styles for tablet screens */
            /* For example: */
            width: 90%;
            height: 90%;
        }
    }

    /* Media query for mobile screens */
    @media (max-width: 480px) {
        .contact_us_modal {
            /* Adjust styles for mobile screens */
            /* For example: */
            width: 95%;
            height: 95%;
        }
    }

    /* Hide visual search icon in Edge */
    input[type="search"]::-ms-clear,
    input[type="search"]::-ms-reveal {
        display: none;
        width: 0;
        height: 0;
    }
</style>

<div class="contact_us_modal" id="contactModal">
  <div class="contact_us_modal-content">
    <div class="row">
        <div class="col-md-10 col-sm-10 col-md-lg-10">
            <h2>Contact Us</h2>
        </div>
        <div class="col-md-2 col-sm-2 col-md-lg-2">
            <span class="close" id="closeModal">&times;</span>
        </div>
    </div>

    <section class="sign-up my-5 pt-1">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                <img width="65%" src="<?php echo site_url('assets/frontend/default-new/image/login-security.gif') ?>">
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="sing-up-right" style="margin-top: 0px !important;">
                    <!-- <h3><?php //echo get_phrase('Contact Us '); ?><span>!</span></h3>
                    <p><?php //echo get_phrase('Explore, learn, and grow with us. Enjoy a seamless and enriching educational journey. Lets begin!') ?></p> -->
                    <form action="javascript:void(0);" onsubmit="contactFormSubmit()" name="contactForm" id="contactForm">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="course" id="course" required>
                                        <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                                        <?php $course_list = $this->crud_model->get_actual_courses()->result_array();
                                            foreach ($course_list as $course):
                                            if ($course['status'] != 'active')
                                                continue;?>
                                            <option value="<?php echo $course['id'] ?>" <?php echo $course['slug'] == $slug ? 'selected' : ''; ?>><?php echo $course['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <input name="first_name" type="text" class="form-control" maxlength="26" id="first_name" required placeholder="<?php echo get_phrase('First Name *') ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <input name="last_name" type="text" class="form-control" maxlength="26" id="last_name" placeholder="<?php echo get_phrase('Last Name') ?>">
                                </div>                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <input name="email" type="email" class="form-control" id="email" required placeholder="<?php echo get_phrase('Email *') ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <input name="phone" type="tel" class="form-control" id="phone" required placeholder="<?php echo get_phrase('Phone *') ?>">
                                </div>                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input name="city" type="text" class="form-control" id="city" placeholder="City">
                                </div> 
                                <div class="input-group comment">
                                    <textarea name="message" class="form-control" aria-label="With textarea" id="message" maxlength="500" placeholder="<?php echo get_phrase('Write your message'); ?>"></textarea>
                                </div>
                                <div class="cheack-box">
                                    <div class="form-check">
                                        <input name="i_agree" class="form-check-input" type="checkbox" required value="1" id="i_agree">
                                        <label class="form-check-label" for="i_agree"> 
                                            <p><?php echo get_phrase('I agree that my submitted data is being collected and stored.'); ?></p>
                                        </label>
                                    </div>                                  
                                </div>
                                <?php if(get_frontend_settings('recaptcha_status')): ?>
                                    <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                                <?php endif; ?>
                                <div class="form-btn">
                                    <button type="submit" class="btn btn-primary"><?php echo get_phrase('Submit'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
  </div>
</div>
<script>
    //If user
    let user_already_loggedin = '<?php echo $this->session->userdata('user_id'); ?>';

    function hideShowVideoIcons(){
        /**
         * If the user has previously submitted details, 
         * the system will display the original icons. Otherwise, 
         * it will show the contact form navigated icons.
         */
        let details_submitted = localStorage.getItem('dataSubmitted');
        if(details_submitted == "true" || user_already_loggedin){
            var content_button_divs = document.getElementsByClassName('content_button');
            // Loop through the selected divs and set their display property to 'block'
            for (var i = 0; i < content_button_divs.length; i++) {
                content_button_divs[i].style.display = 'block';
            }

            var contactus_form_button_divs = document.getElementsByClassName('contactus_form_button');
            // Loop through the selected divs and set their display property to 'none'
            for (var i = 0; i < contactus_form_button_divs.length; i++) {
                contactus_form_button_divs[i].style.display = 'none';
            }
        }else{
            var content_button_divs = document.getElementsByClassName('content_button');
            // Loop through the selected divs and set their display property to 'none'
            for (var i = 0; i < content_button_divs.length; i++) {
                content_button_divs[i].style.display = 'none';
            }

            var contactus_form_button_divs = document.getElementsByClassName('contactus_form_button');
            // Loop through the selected divs and set their display property to 'block'
            for (var i = 0; i < contactus_form_button_divs.length; i++) {
                contactus_form_button_divs[i].style.display = 'block';
            }
        }
    }

    


    const openModalBtn = document.getElementById('openModalBtn');
    const openModalBtn1 = document.getElementById('openModalBtn1');
    const contactModal = document.getElementById('contactModal');
    const closeModal = document.getElementById('closeModal');

    //Save user actions
    const demoVideoButton = document.getElementById('demoVideoButton');
    demoVideoButton.addEventListener('click', function() {
        saveUserActions('demo_video');
    });
    const current_broucher_link = document.getElementById('current_broucher_link');
    current_broucher_link.addEventListener('click', function() {
        saveUserActions('broucher_link');
    });

    openModalBtn.addEventListener('click', function() {
        contactModal.style.display = 'block';
        localStorage.setItem('clickFrom', 'video');
    });

    openModalBtn1.addEventListener('click', function() {
        contactModal.style.display = 'block';
        localStorage.setItem('clickFrom', 'broucher');
    });

    closeModal.addEventListener('click', function() {
        contactModal.style.display = 'none';
    });

    /*window.addEventListener('click', function(event) {
        if (event.target === contactModal) {
            contactModal.style.display = 'none';
        }
    });*/
    hideShowVideoIcons();

    function contactFormSubmit(){
        var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone'").val(full_number);
        var $inputs = $('#contactForm :input');

        const first_name = document.getElementById('first_name').value.trim();
        const last_name = document.getElementById('last_name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const city = document.getElementById('city').value.trim();
        const message = document.getElementById('message').value.trim();
        const course = document.getElementById('course').value.trim();
        // const phone = document.getElementsByName('full')[0].value.trim();

        // Regular expressions for email and phone number validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Perform validations
        if (first_name === '') {
            alert('Please enter your first name.');
            return;
        }

        if (email === '' || !emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        var formData = {
            first_name: first_name,
            last_name: last_name,
            email: email,
            phone: phone,
            city: city,
            message: message,
            course: course,
        };
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the request (GET method, URL)
        xhr.open('POST', '<?php echo site_url('home/contactus_submitted'); ?>', true);

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Convert the data object to JSON format
        serialize = function(obj) {
        var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }
        localStorage.setItem('userData', JSON.stringify({
            first_name: first_name,
            last_name: last_name,
            email: email,
            phone: phone,
            city: city
        }));
        var jsonData = serialize(formData);

        // Set up a function to handle the response
        xhr.onload = function() {
        if (xhr.status === 200) {
            // Request was successful
            alert( xhr.responseText);
            if( xhr.responseText == 'Thank You For Contacting Us.'){
                localStorage.setItem("dataSubmitted", true);
                // Optionally, reset the form after successful submission
                $('#contactForm')[0].reset();
                contactModal.style.display = 'none';
                hideShowVideoIcons();
                if(localStorage.getItem('clickFrom') == 'video'){
                    document.getElementById("demoVideoButton").click();
                }else if(localStorage.getItem('clickFrom') == 'broucher'){
                    document.getElementById('current_broucher_link').click();
                }
            }
            

            // Perform actions with the response data here
        } else {
            // Error handling if the request fails
            console.error('Request failed. Status:', xhr.status);
        }
        };

        // Send the POST request with the JSON data
        xhr.send(jsonData);
    }

    function saveUserActions(from){
        var userData = {};
        if(user_already_loggedin){
            if(user_already_loggedin == 1){
                return true;
            }
            userData.user_id = user_already_loggedin
        }else{
            userData = JSON.parse(localStorage.getItem('userData'));
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo site_url('home/user_actions'); ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        userData.action_from = from;
        userData.course = <?php echo $course_id?>;
        serialize = function(obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            }
            return str.join("&");
        }
        var jsonData = serialize(userData);
        xhr.onload = function() {
        };
        xhr.send(jsonData);

    }
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries:["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    $("form").submit(function() {
        var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone'").val(full_number);
        
        });
</script>
<?php include "move_to_top.php"; ?>
<script>
    function moveToStartPosition(){
        if($(window).width() >= 680) {
            $("#links").get(0).scrollIntoView({behavior: 'smooth'});
        }else{
            $("#cart_buttons").get(0).scrollIntoView({behavior: 'smooth'});
            //$("#links").get(document.getElementById("instructor").getBoundingClientRect().top).scrollIntoView({behavior: 'smooth'});
        }
    }
</script>