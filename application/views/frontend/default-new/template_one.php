<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<link rel="stylesheet" href=<?php echo base_url() . "assets/frontend/default-new/css/template_one_style.css"; ?> />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    
    function clickedOn(type){
        alert(type);
        if('add_cart'){
            $(".add_cart").hide();
            $(".remove_cart").show();
        }else if("remove_cart"){
            $(".add_cart").show();
            $(".remove_cart").hide();
        }
    }
</script>
<?php
log_message("error", "The Slug is : " . $slug);
$course_details = $this->crud_model->get_course_by_slug($slug)->row_array();
// var_dump($course_details);
if (!$course_details) {
    //redirect(site_url('404_override'), 'refresh');
}
$course_id = $course_details['id'];
$lessons = $this->crud_model->get_lessons('course', $course_details['id']);
$instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
$course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
$video_course = false;
if ($course_details['is_top_course'] == 1 || $course_details['is_top10_course'] == 1 || $course_details['show_it_in_category'] == 1) {
    $video_course = false;
    $course_duration =  $course_details['course_duration_in_hours'] . " Hours";
} else {
    $video_course = true;
    $course_duration =  $course_duration;
}
$ratings_count = $this->crud_model->get_ratings_count($course_details['id']);
if ($ratings_count) {
    $one = $ratings_count['one_rating_count'];
    $two = $ratings_count['two_rating_count'];
    $three = $ratings_count['three_rating_count'];
    $four = $ratings_count['four_rating_count'];
    $five = $ratings_count['five_rating_count'];
    $number_of_ratings = $ratings_count['number_of_ratings'];
    $number_of_enrolments = $ratings_count['number_of_students_enrolled'];
    $average_ceil_rating = ceil((($one * 1) + ($two * 2) + ($three * 3) + ($four * 4) + ($five * 5)) / $number_of_ratings);
} else {
    $average_ceil_rating = 0;
    $number_of_ratings = 0;
    $number_of_enrolments = 0;
}

$cart_items = $this->session->userdata('cart_items');
?>

<!---------- Banner Start ---------->
<section class="hero-section bannar-area pt-5 mb-2">
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12  order-md-1 order-sm-2 order-2">
                <div class=" mb-3 mt-5">
                    <h1 class="hero-heading mb-4 fw-bold"> Empower your <br> <span class="cyber-para"><?php echo $course_details['title']; ?> career</span> </h1>
                    <p class="mb-5 col-lg-10 col-12">There's such a high demand for <?php echo $course_details['title']; ?> professionals that there will be an estimated 3.5 million unfilled jobs worldwide by 2025, according to Cybercert. So if you're interested in filling one of those 3.5 million positions, you should know the landscape of various career paths in the cybersecurity field</p>
                </div>
                <div class="buttons-mble">
                    <button class="hero-btn px-3 ">Request Demo</button>
                    <button class="hero-btn-2 px-3 ms-3"><a href="#" download name="current_broucher_link"><b><?php echo get_phrase('Download Broucher'); ?></b></a></button>
                    <?php if (is_purchased($course_details['id']) && !$this->crud_model->is_expired($course_details['id'])) : ?>
                        <button class="hero-btn-2 px-3 ms-3"><a href="<?php echo site_url('home/lesson/' . slugify($course_details['title']) . '/' . $course_details['id']) ?>"><i class="far fa-play-circle"></i> <?php echo get_phrase('Start Now'); ?></a></button>
                        <?php if ($course_details['is_free_course'] != 1) : ?>
                            <button class="hero-btn-2 px-3 ms-3"><a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id'] . '?gift=1'); ?>')"><i class="fas fa-gift"></i> <?php echo get_phrase('Gift someone else'); ?></a></button>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if ($course_details['is_free_course'] == 1) : ?>
                            <button class="hero-btn-2 px-3 ms-3"><a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_details['id']); ?>"><?php echo get_phrase('Enroll Now'); ?></a></button>
                        <?php else : ?>

                            <!-- Cart button -->
                            <button class="hero-btn-2 px-3 ms-3"><a id="added_to_cart_btn_<?php echo $course_details['id']; ?>" class="<?php if(!in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?> active" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>');"><i class="fas fa-minus"></i> <?php echo get_phrase('Remove from cart'); ?></a>
                            <a id="add_to_cart_btn_<?php echo $course_details['id']; ?>" class=" <?php if(in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>');; "><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/trolley_cart.png"; ?>" alt="" class="btn-log"> <?php echo get_phrase('Add to cart'); ?></a></button>
                            
                            <!-- Cart button ended-->

                            <button class="hero-btn-2 px-3 ms-3"><a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id']); ?>')"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/credit-card_i.png"; ?>" alt="" class="btn-log"> <?php echo get_phrase('Buy Now'); ?></a></button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12  mt-3 order-md-2 order-sm-1 order-1 pt-0 pt-md-5 ">
                <img src="<?php echo base_url('uploads/banner_image/' . $course_details['banner_image']); ?>" alt="" class="hero-img">
            </div>
        </div>
    </div>

    <div class="about-para-container container mt-4 pb-4">

        <div class="">
            <p class="about-para "><img src="
<?php echo base_url() . "assets/frontend/default-new/image/templateone/video-presentation_icon.png"; ?>
" alt="" class="icon-log"> Lectures - <?php echo $course_details["number_of_lectures"];//$this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?></p>
        </div>
        <div class=" ">
            <p class="about-para "><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/team-skills_icon.png"; ?>" alt="" class="icon-log"> Skill level - <?php echo get_phrase($course_details['level']); ?></p>
        </div>
        <div class="">
            <p class="about-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/calendar-icon.png"; ?>" alt="" class="icon-log"> Duration - <?php echo $course_details['course_duration_in_months'] > 1 ? $course_details['course_duration_in_months'] . " Months" : $course_details['course_duration_in_months'] . " Month"; ?></p>
        </div>
        <div class="">
            <p class="about-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/clock_icon.png"; ?>" alt="" class="icon-log"> Daily - <?php echo $course_details['daily_class_duration_in_hours'] > 1 ? $course_details['daily_class_duration_in_hours'] . " Hours" : $course_details['daily_class_duration_in_hours'] . " Hour"; ?></p>
        </div>
        <div class="">
            <p class="about-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/certificate_icon.png"; ?>" alt="" class="icon-log"> Certificate - <?php echo get_phrase('Yes'); ?></p>
        </div>
        <div class="">
            <p class="about-para deflect-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/rating_icon.png"; ?>" alt="" class="icon-log"> (<?php echo $number_of_ratings; ?>)</p>
        </div>
    </div>

</section>
<!---------- Banner Area End ---------->

<!--------- course Decription Page Start ------>
<section class="about-section bannar-area pt-3 mb-5">
    <div class="container">
        <h1 class="text-center fw-bold">About Course</h1>
        <div class="row ">
            <div class="col-lg-5  col-sm-12 col-12 mt-4 mbl-ui">
               
                <div class="experience-card">
                    <span class="y-o-e"><?php echo $course_details["experience"]; ?> Years of</span>
                    <p class="t-e-p">Teaching Experience</p>
                </div>
                <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/abou_course.png"; ?>" alt="" class="hero-img-2">
                <div class="course-card d-flex flex-row">
                    <div>
                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/rating_course.png"; ?>" alt="" class="star-logo">
                    </div>
                    <div>
                        <span class="y-o-e text-dark" style="font-weight: 600;"><?php echo $number_of_ratings; ?></span>
                        <p class="t-e-p text-dark" style="font-weight: 500;">Course Reviews</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7  col-sm-12 col-12 mt-5">
                <div class="h-1-banner-text mb-3">
                    <h6 class="fw-bold">WHAT’S OUR MAIN GOAL</h6>
                    <h1 class="mbl-h1 mb-3">Take The Next Step Toward Your
                        Personal And Professional Goals
                        With TechleadsIT </h1>
                    <p>At TechleadsIT, we understand the pivotal role cybersecurity plays in today's digital landscape. As technology evolves, so does the need for skilled professionals to safeguard critical information. </p>
                </div>
                <div class="about-mbl">
                    <div class="container ">
                        <div class="row">
                            <div class="col-lg-2 mb-3">
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/student_course.png"; ?>" alt="" class="sec-icon">
                            </div>
                            <div class="col-lg-10">
                                <h6 class="fw-bold">Learn From Experts</h6>
                                <p>At TechleadsIT, we believe that learning from experts is the key to mastering </p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 mb-3">
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/book_course.png"; ?>" alt="" class="sec-icon">
                            </div>
                            <div class="col-lg-10">
                                <h6 class="fw-bold">Video Tutorialss</h6>
                                <p>Our video tutorials offer the flexibility to learn at your own pace & at your own time. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-sm-12  mt-5">
                <div class="accordion" id="accordionExample">
                    <?php $about_data = (array)json_decode($course_details['about']); ?>
                    <?php foreach ($about_data as $key => $about) : ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="<?php echo $key == 0 ? true : false; ?>" aria-controls="collapse<?php echo $key; ?>">
                                    <?php echo $about->title; ?>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $key; ?>" class="accordion-collapse collapse<?php echo $key == 0 ? " show" : ""; ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="accordian-p"> <?php echo $about->description; ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>


                </div>
            </div>
            <div class="col-lg-5  mt-5">
                <div class="lead-form-card ">
                    <h4 class="text-center mb-4 mt-2">Request a <span class="l-demo">Live Demo</span> </h4>
                    <div class="mb-4 container-fluid">
                        <input type="text" class="form-input w-100" placeholder="Name">
                    </div>
                    <div class="mb-4 container-fluid">
                        <input type="text" class="form-input w-100" placeholder="Email ID">
                    </div>
                    <div class="mb-4 container-fluid">
                        <input type="text" class="form-input w-100" placeholder="Phone Number">

                        <div class="container d-flex justify-content-center pt-5">
                            <button class="hero-btn px-3 ms-3 d-flex flex-row justify-content-center px-5">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</section>
<!--------- course Decription Page end ------>

<section class="curriculum-section pt-5 mb-5 pb-5">
    <div class="container">
        <h1 class="text-center fw-bold">Curriculum</h1>
        <p class="text-center">Discover courses in topics designed to help expand your career, business and horizons and to upgrade your skills for a new digital world.</p>
        <div class="about-para-container  mt-4 pb-4">

            <div class="">
                <p class="about-para "><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/video-presentation_icon.png"; ?>
" alt="" class="icon-log" alt="" class="icon-log"> Lectures - <?php echo $course_details["number_of_lectures"]; //$this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?></p>
            </div>
            <div class=" ">
                <p class="about-para "><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/team-skills_icon.png"; ?>" alt="" class="icon-log"> Skill level - <?php echo get_phrase($course_details['level']); ?></p>
            </div>
            <div class="">
                <p class="about-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/calendar-icon.png"; ?>" alt="" class="icon-log"> Duration - <?php echo $course_details['course_duration_in_months'] > 1 ? $course_details['course_duration_in_months'] . " Months" : $course_details['course_duration_in_months'] . " Month"; ?></p>
            </div>
            <div class="">
                <p class="about-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/clock_icon.png"; ?>" alt="" class="icon-log"> Daily - <?php echo $course_details['daily_class_duration_in_hours'] > 1 ? $course_details['daily_class_duration_in_hours'] . " Hours" : $course_details['daily_class_duration_in_hours'] . " Hour"; ?></p>
            </div>
            <div class="">
                <p class="about-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/certificate_icon.png"; ?>" alt="" class="icon-log"> Certificate - <?php echo get_phrase('Yes'); ?></p>
            </div>
            <div class="">
                <p class="about-para deflect-para"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/rating_icon.png"; ?>" alt="" class="icon-log"> (<?php echo $number_of_ratings; ?>)</p>
            </div>
        </div>
        <div class="d-none d-md-block">
            <!-- Curriculam Start -->
            <?php
            $course_id = $course_details['id'];
            $sections = $this->crud_model->get_section('course', $course_id)->result_array();
            ?>
            <div class="d-flex ">
                <div class="nav flex-column nav-pills me-3 col-md-6" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php foreach ($sections as $skey => $svalue) : ?>
                        <button class=" <?php echo $skey == 0 ? "active" : ""  ?> text-start mb-3 cirrculam-btn" id="v-pills-<?php echo $skey; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo $skey; ?>" type="button" role="tab" aria-controls="v-pills-<?php echo $skey; ?>" aria-selected="true"><?php echo $svalue['title']; ?></button>
                    <?php endforeach; ?>
                </div>
                <div class="tab-content col-md-6" id="v-pills-tabContent">
                    <?php foreach ($sections as $skey => $svalue) : ?>
                        <div class="tab-pane fade <?php echo $skey == 0 ? " show active " : ""  ?>cirrculam-div" id="v-pills-<?php echo $skey; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $skey; ?>-tab" tabindex="0">
                            <?php
                            $chapter_count = $this->crud_model->get_chapter_count($svalue['id']);
                            if ($chapter_count == 0) {
                                $section_lesson_count = $this->crud_model->get_lesson_count('section', $svalue['id']);
                            } else {
                                $chapters = $this->crud_model->get_chapters('section', $svalue['id'])->result_array();
                            }
                            ?>
                            <?php if ($chapter_count > 0) : ?>
                                <?php foreach ($chapters as $ckey => $cvalue) : ?>
                                    <h5><?php echo $cvalue['title']; ?></h5>
                                    <?php $lessons = $this->crud_model->get_lessons('chapter', $cvalue['id'])->result_array(); ?>
                                    <?php if ($lessons) : ?>
                                        <hr class="hr-line">
                                        <ul>
                                            <?php foreach ($lessons as $lkey => $lvalue) : ?>
                                                <li> <?php echo $lvalue['title']; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php $lessons = $this->crud_model->get_lessons('section', $svalue['id'])->result_array(); ?>
                                <?php if ($lessons) : ?>
                                    <ul>
                                        <?php foreach ($lessons as $lkey => $lvalue) : ?>
                                            <li> <?php echo $lvalue['title']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

    </div>


</section>

<section class="infographics-section pt-5 mb-5 pb-5  d-none d-md-block">
    <?php
    $learn_data = (array)json_decode($course_details['learn']);
    $alphabet = ['a','b','c','d','c','d','a','b']//range('a', 'z');
    ?>

    <div class="container">
        <h1 class="text-center fw-bold">What you’ll learn?</h1>
        <p class="text-center"> Here's a list of common prerequisites that can enhance your readiness for a cybersecurity course:</p>

        <?php for ($i = 0; $i < count($learn_data); $i += 2) : ?>
            <div class="container info-container">
                <?php if($i==2) : ?>
                    <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/info_cb.png"; ?>" alt="" class="info-img">
                <?php endif; ?>
                <div class="section-<?php echo $alphabet[$i]; ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo base_url() . "uploads/learn/" . $learn_data[$i]->icon; ?>" alt="" class="info-svg">
                        </div>
                        <div class="col-md-9">
                            <h1 class="info-heading"><?php echo $learn_data[$i]->title; ?></h1>
                            <p class="info-para"><?php echo $learn_data[$i]->description; ?></p>
                        </div>
                    </div>

                </div>

                <div class="section-<?php echo $alphabet[$i + 1]; ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo base_url() . "uploads/learn/" . $learn_data[$i + 1]->icon; ?>" alt="" class="info-svg">
                        </div>
                        <div class="col-md-9">
                            <h1 class="info-heading"><?php echo $learn_data[$i + 1]->title; ?></h1>
                            <p class="info-para"><?php echo $learn_data[$i + 1]->description; ?></p>
                        </div>
                    </div>

                </div>
            </div>

        <?php endfor; ?>

    </div>
</section>



<section class="future-section bannar-area pt-5 mb-5">
    <div class="container">
        <h1 class="text-center fw-bold">How the future of career for Cybersecurity</h1>
        <p class="text-center">Choose from hundreds of courses from specialist organizations</p>
        <div class="container future-mbl">
            <div class="row g-2">
                <?php
                    $future_data = (array)json_decode($course_details['future']);
                ?>
                <?php foreach($future_data as $fkey => $fvalue): ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="row">
                            <div class="col-lg-2 mb-3">
                                <img src="<?php echo base_url() . "uploads/future/" . $fvalue->icon ?>" alt="" class="sec-icon">
                            </div>
                            <div class="col-lg-10 px-4">
                                <h6 class="fw-bold text-dark"><?php echo $fvalue->title; ?>:</h6>
                                <p><?php echo $fvalue->description; ?> </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>



<section class=" d-none d-md-block rocket-section bannar-area pt-5 mb-5">
    <div class="container">
        <h1 class="text-center fw-bold"> Cyber Security Learning Path</h1>
        <p class="text-center">The Pathway for full-fill your career with our course</p>
        <div class="col-md-4">
            <h1 class="fw-bold">Growth like Rocket </h1>
            <p>Consider pursuing a formal education in cybersecurity through a bachelor's or master's degree to deepen your knowledge.
                Evaluate programs that offer specialized tracks aligned with your career goals
            </p>
        </div>
        <img src="
<?php echo base_url() . "assets/frontend/default-new/image/templateone/rocket_info.png"; ?>
" alt="" class="rocket-img">
        <?php
            $growth_data = (array)json_decode($course_details['growth']);
            //var_dump($growth_data);
        ?>
        <div class="Rocket-content-1">
            <h6><?php echo $growth_data[3]->title; ?></h6>
            <p><?php echo $growth_data[3]->description; ?></p>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-3 rec-c">
                <h6><?php echo $growth_data[0]->title; ?></h6>
                <p><?php echo $growth_data[0]->description; ?></p>
            </div>
            <div class="col-lg-6  rec-d">
                <h6><?php echo $growth_data[2]->title; ?></h6>
                <p><?php echo $growth_data[2]->description; ?></p>

            </div>
            <div class="Rocket-content-2">
                <h6><?php echo $growth_data[1]->title; ?></h6>
                <p><?php echo $growth_data[1]->description; ?></p>
            </div>
        </div>

    </div>


</section>



<section class="upcomingcourse-section bannar-area pt-5 pb-5">
    <?php $upcoming_courses = $this->db->order_by('id', 'desc')->limit(3)->get_where('course', ['status' => 'upcoming']); ?>
    <?php if($upcoming_courses->num_rows() > 0): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h6 class=" fw-bold">Upcoming Batches</h6>
                    <h1 class="fw-bold">Techleads Upcoming Events & Batches</h1>
                </div>
                <div class="col-lg-5 pt-4">
                    <p>We have carefully designed an academic path that provides enormous value to our students at every stage of their journey Embark on a learning journey with our upcoming [Batch Name]. </p>
                </div>
            </div>
            <div class="row pt-4 course-container ">
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
                <div class="card ms-4" style="width: 22rem;">
                    <h6 class="text-center text-dark pt-3 pb-3" style="font-size: 1rem"><?php echo $upcoming_course['title']; ?></h6>
                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($upcoming_course['id']); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <span class="badge online-badge mb-2">Online</span>
                        <p class="card-text text-dark mb-3">New Batch Live Demo</p>
                        <button class="detials-btn" onclick="location.href='<?php echo site_url($upcoming_course_slug); ?>';">View Details</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>


<section class="Talktoexpert-section bannar-area pt-5 mb-5 d-none d-md-block">
    <h1 class="text-center fw-bold">Talk to an Expert Today?</h1>
    <p class="text-center">Offer online help or support for your doubts anywhere at any time directly in your website.</p>
    <div class="container expert-img ">
        <div class="content col-md-6 col-sm-12">
            <h1 class="expert-heading">Get Certified Today!</h1>
            <p class="expert-para">Become a certified candidate by taking part of our courses.</p>
            <button class="get-btn">Get Started</button>
        </div>
    </div>
</section>
<section class="Talktoexpert-section bannar-area pt-5 mb-5  d-md-none">
    <h1 class="text-center fw-bold">Talk to an Expert Toay?</h1>
    <p class="text-center">Offer online help or support for your doubts anywhere at any time directly in your website.</p>
    <div class="container ">
        <div class="content-mbl col-md-6 col-sm-12">
            <h1 class="expert-heading">Get Certified Today!</h1>
            <p class="expert-para">Become a certified candidate by taking part of our courses.</p>
            <button class="get-btn">Get Started</button>
        </div>
    </div>
</section>

<section class="whytechleads-section bannar-area  mb-5">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-5 ">
                <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/why-student.png"; ?>" alt="" class="hero-img-3">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-5">
                <div class=" mb-4">
                    <h1 class="mbl-h1 mbl-h2 mb-3">Why Students Love <span class="cyber-para"> TechleadsIT ? </span></h1>
                </div>
                <div class="about-mbl">
                    <div class="container ">
                        <div class="row">
                            <div class="col-lg-2 mb-4">
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/why_computer_1.png"; ?>" alt="" class="sec-icon">
                            </div>
                            <div class="col-lg-10">
                                <h6 class="fw-bold text-dark">Easily Manage your trainings</h6>
                                <p>This flexibility allows students to learn at their own pace and fit their studies into their schedule. </p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 mb-4">
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/why_computer_2.png"; ?>" alt="" class="sec-icon">
                            </div>
                            <div class="col-lg-10">
                                <h6 class="fw-bold text-dark">Interactive Learning</h6>
                                <p>Interactive elements make the learning experience more dynamic and enjoyable. </p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 mb-3">
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/why-couse_3.png"; ?>" alt="" class="sec-icon">
                            </div>
                            <div class="col-lg-10">
                                <h6 class="fw-bold text-dark">Progress Tracking</h6>
                                <p>Students can track their progress, view grades, and monitor their completion of various modules or assignments. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<section class="Price-section pt-5 mb-5">
    <div class="container">

        <div class="col-lg-12">
            <h6 class=" fw-bold">Best in Industry</h6>
            <h1 class="fw-bold">Fees & Course Tracks</h1>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-body mt-4">
                            <div class="card-tle">
                                <h4 class="pt-2 text-dark fw-bold">Weekday track</h4>
                            </div>
                            <div class="container">
                                <div class="row pt-3 price-cont container mt-3">
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/graduation-cap.png"; ?>" alt="" class="price-icon-m">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark"><?php echo $course_details['course_duration_in_months'] > 1 ? $course_details['course_duration_in_months'] . "- Months" : $course_details['course_duration_in_months'] . "- Month"; ?></h6>
                                        <p class="price-para">Course Duration</p>
                                    </div>
                                    <div class="col-2 ">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/blackboard.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark"><?php echo $course_details['daily_class_duration_in_hours'] > 1 ? $course_details['daily_class_duration_in_hours'] . "- Hours" : $course_details['daily_class_duration_in_hours'] . "- Hour"; ?></h6>
                                        <p class="price-para">Session Duration</p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/part_time.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark">Part - Time</h6>
                                        <p class="price-para">Alternative Days</p>
                                    </div>
                                    <div class="col-2 ">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/growth.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark"><?php echo $course_details['week_track_sessions_count']; ?> Sessions</h6>
                                        <p class="price-para">Total Session Days
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/wallet.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark">Rs <?php echo $course_details['price']; ?>/-</h6>
                                        <p class="price-para">Course fees</p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="container pt-4 pb-4">
                                    <div class="button-container">
                                        <button class="price-btn"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/buy_n.png"; ?>" alt="" class="wallet-icon"> Buy Now</button>
                                        
                                        <!-- <button class="hero-btn-2 px-3 ms-3"></button> -->
                            

                                        <button class="price-btn ms-3">
                                            <a id="fee_weekday_added_to_cart_btn_<?php echo $course_details['id']; ?>" class="<?php if(!in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?> active" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id'] .'/null/weekday'); ?>');"><i class="fas fa-minus"></i> <?php echo get_phrase('Remove from cart'); ?></a>
                                            <a id="fee_weekday_add_to_cart_btn_<?php echo $course_details['id']; ?>" class=" <?php if(in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id'] .'/null/weekday'); ?>');; "><img src="https://res.cloudinary.com/dc2uykpox/image/upload/v1708414132/trolley_1_geedvl.png" alt="" class="btn-log"> <?php echo get_phrase('Add to cart'); ?></a>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-body mt-4">
                            <div class="card-tle">
                                <h4 class="pt-2 text-dark fw-bold">Weekend track</h4>
                            </div>
                            <div class="container">
                                <div class="row pt-3 price-cont container mt-3">
                                    <div class="col-2 ">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/graduation-cap.png"; ?>" alt="" class="price-icon-m">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark"><?php echo $course_details['weekend_course_duration_in_months'] > 1 ? $course_details['course_duration_in_months'] . "- Months" : $course_details['course_duration_in_months'] . "- Month"; ?></h6>
                                        <p class="price-para">Course Duration</p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/blackboard.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark"><?php echo $course_details['weekend_track_daily_class_duration_in_hours'] > 1 ? $course_details['weekend_track_daily_class_duration_in_hours'] . "- Hours" : $course_details['weekend_track_daily_class_duration_in_hours'] . "- Hour"; ?></h6>
                                        <p class="price-para">Session Duration</p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/part_time.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark">Part - Time</h6>
                                        <p class="price-para">Alternative Days</p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/growth.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark"><?php echo $course_details['weekend_track_sessions_count']; ?> Sessions</h6>
                                        <p class="price-para">Total Session Days
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="row pt-3 price-cont container">
                                    <div class="col-2 mt-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/wallet.png"; ?>" alt="" class="price-icon">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="card-text text-dark">Rs <?php echo $course_details['weekend_track_course_price']; ?>/-</h6>
                                        <p class="price-para">Course fees</p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/check.png"; ?>" alt="" class="price-icon-2">
                                    </div>
                                </div>
                                <div class="container pt-4 pb-4">
                                    <div class="button-container">
                                        <button class="price-btn"><img src="<?php echo base_url() . "assets/frontend/default-new/image/templateone/buy_n.png"; ?>" alt="" class="wallet-icon"> Buy Now</button>
                                        <button class="price-btn ms-3">
                                        <a id="fee_weekend_added_to_cart_btn_<?php echo $course_details['id']; ?>" class="<?php if(!in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?> active" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id'] .'/null/weekend'); ?>');"><i class="fas fa-minus"></i> <?php echo get_phrase('Remove from cart'); ?></a>
                                            <a id="fee_weekend_add_to_cart_btn_<?php echo $course_details['id']; ?>" class=" <?php if(in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id'] .'/null/weekend'); ?>');; "><img src="https://res.cloudinary.com/dc2uykpox/image/upload/v1708414132/trolley_1_geedvl.png" alt="" class="btn-log"> <?php echo get_phrase('Add to cart'); ?></a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-body mt-4">
                            <div class="card-tle">
                                <h4 class="pt-2 text-dark fw-bold">Contact Us</h4>
                            </div>
                            <div class="lead-form-card-2 ">
                                <div class="mb-4 container-fluid">
                                    <input type="text" class="form-input w-100" placeholder="Name">
                                </div>
                                <div class="mb-4 container-fluid">
                                    <input type="text" class="form-input w-100" placeholder="Email ID">
                                </div>
                                <div class="mb-4 container-fluid">
                                    <textarea class="text-area w-100" placeholder="Message" id="exampleTextarea" rows="3"></textarea>
                                </div>
                                <div class="container d-flex justify-content-center mb-2">
                                    <button class="hero-btn px-3 ms-3 d-flex flex-row justify-content-center px-5">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<section class="FAQs-section  mb-5">
    <h1 class="text-center fw-bold mb-3 pt-5">FAQ's</h1>
    <div class="container col-md-9 pb-5">
        <div class="accordion" id="accordionExample">
        <?php $faq_data = (array)json_decode($course_details['faqs']);?>
                        
            <?php $fkey = 0; foreach ($faq_data as $key => $faq) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $fkey; ?>" aria-expanded="<?php echo $fkey == 0 ? "true" : "false"; ?>" aria-controls="collapse<?php echo $fkey; ?>">
                        <?php echo $key; ?>
                    </button>
                </h2>
                <div id="collapse<?php echo $fkey; ?>" class="accordion-collapse collapse <?php echo $fkey == 0 ? " show" : ""; ?>" data-bs-parent="#accordionexample">
                    <div class="accordion-body">
                    <?php echo $faq; ?>
                    </div>
                </div>
            </div>
            <?php $fkey++; endforeach; ?>
            
        </div>
    </div>
</section>

<section class="popularcourses-section pt-5 mb-5 mb-5">
    <h1 class="text-center fw-bold">Most Popular Courses</h1>
    <p class="text-center">Choose from hundreds of courses from specialist organizations.</p>
    <div class="container mt-5">
        <ul class="nav nav-tabs justify-content-center" id="myTabs">
            <?php $active_categories = $this->crud_model->getAllActiveCategories()->result_array(); ?>
            <?php if (count($active_categories) > 0): ?>
                <?php foreach($active_categories as $ackey => $active_category) : ?>
                    <?php //echo $ackey; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $ackey == 0 ? "active" : ""; ?>" id="tab<?php echo $ackey; ?>" data-bs-toggle="tab" href="#content<?php echo $ackey; ?>"><?php echo $active_category["name"]; ?> </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </ul>

        <div class="tab-content">
            <?php if (count($active_categories) > 0): ?>
                <?php foreach($active_categories as $ackey => $active_category) : ?>
                    <?php $popular_courses = $this->crud_model->get_actual_courses_by_category($active_category["id"])->result_array(); ?>
                    <?php //echo $active_category["id"]; echo count($popular_courses); ?>
                    <div class="tab-pane fade  <?php echo $ackey == 0 ? "show active" : ""; ?>" id="content<?php echo $ackey; ?>">
                        <div class="row course-container">
                            <?php if(count($popular_courses)>0) : ?>
                                <?php foreach($popular_courses as $pckey => $popular_course) : ?>
                                    <?php
                                        if($popular_course['slug_count'] == 1 || $popular_course['slug_count'] == 2){
                                            $popular_course_slug = $popular_course['slug'];
                                        }else if($popular_course['slug_count'] == 3 || $popular_course['slug_count'] == 4){
                                            $popular_course_slug = $popular_course['category_slug'] .'/' . $popular_course['sub_category_slug'] .'/' . $popular_course['slug'];
                                        }else{
                                            $popular_course_slug = $popular_course['slug'];
                                        }
                                        $lessons = $this->crud_model->get_lessons('course', $popular_course['id']);
                                        $instructor_details = $this->user_model->get_all_user($popular_course['creator'])->row_array();
                                        $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($popular_course['id']);
                                        $course_duration = $popular_course['is_top_course'] == 1 || $popular_course['is_top10_course'] == 1 || $popular_course['show_it_in_category'] == 1 ? $popular_course['course_duration_in_hours'] . " Hours" : $course_duration;
                                        $course_duration_in_months = $popular_course['course_duration_in_months'] >1 ? $popular_course['course_duration_in_months'] ." Months" : $popular_course['course_duration_in_months'] . " Month";
                                        if($popular_course['daily_class_duration_in_hours']){
                                            $hours_text = $popular_course['daily_class_duration_in_hours'] > 1 ? " Hours" : " Hour";
                                            $course_duration_in_months = $course_duration_in_months ." (Daily " . $popular_course['daily_class_duration_in_hours'] .$hours_text.")";
                                        }
                                        $total_rating =  $this->crud_model->get_ratings('course', $popular_course['id'], true)->row()->rating;
                                        $ratings_count = $this->crud_model->get_ratings_count($popular_course['id']);
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
                                    <div class="card ms-4 <?php echo $pckey > 3 ? " pt-4" : ""; ?>" style="width: 16rem;"  onclick="location.href='<?php echo site_url($popular_course_slug); ?>';">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($popular_course['id']); ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <span class="badge mb-2"><?php echo get_phrase($popular_course['level']); ?></span>
                                                
                                            </div>

                                            <h5 class="card-title"><?php echo $popular_course['title']; ?></h5>
                                            <div class="d-flex">
                                            <?php 
                                                for($i=1; $i<=5; $i++){
                                                    if($average_ceil_rating < $i ) {
                                                        if(is_float($average_ceil_rating) && (ceil($average_ceil_rating) == $i || floor($average_ceil_rating) == $i)){
                                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-star-half" viewBox="0 0 16 16" style="padding-right: 2px;">
                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                        </svg>';
                                                        }else{
                                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-star" viewBox="0 0 16 16" style="padding-right: 2px;">
                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z" />
                                                        </svg>';
                                                        }
                                                    }else {
                                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F7C32E" class="bi bi-star-fill" viewBox="0 0 16 16" style="padding-right: 2px;">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                    </svg>';
                                                    }
                                                }
                                            ?>
                                                
                                                <span class="rating-t"><?php echo $average_ceil_rating; ?>/5.0</span>
                                            </div>
                                            <hr>
                                            <div class="container">
                                                <div class="row botton-icon pt-2">
                                                    <div class="col-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D6293E" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-5">
                                                        <p class="le-1"><?php echo $course_duration; ?></p>
                                                    </div>

                                                    <div class="col-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#FD7E14" class="bi bi-table" viewBox="0 0 16 16">
                                                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="le-p"><?php echo $popular_course['week_track_sessions_count']; ?> Sessions</p>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </div>
    </div>

</section>

<section class="Newsletter-section  pt-5 ">
    <div class="new-img">
        <div class="container">
            <div class="col-md-10 pt-4 pb-2">
                <h1 class="mbl-h1">Find Out About The Latest Courses With The <span class="cyber-para">Tech LeadsIT</span> Newsletter</h1>
            </div>
          
            <div class="row">
                <div class="mb-4  col-12 col-md-3">
                    <input type="text" class="form-input w-100" placeholder="Name">
                  </div>
                  <div class="mb-4  col-12 col-md-3">
                    <input type="text" class="form-input w-100" placeholder="Email ID">
                  </div>
                  <div class="mb-4  col-12 col-md-3">
                    <input type="text" class="form-input w-100" placeholder="Phone Number">
                  </div>
                  <div class=" mb-4 col-12 col-md-3">
                  <button class="hero-btn px-4 text-center">Submit</button>
                </div>
              
        </div>
           
        </div>
    </div>
</section>


   
<section class="blogs-section bannar-area pt-5 mb-5">
    <h1 class="text-center fw-bold">Our Recent Blogs</h1>
    <p class="text-center">Expert-curated tips, guides, and articles — the one-stop solution for all your tech-related queries</p>
    <div class="container">
        <?php
            $recent_blogs = $this->crud_model->get_latest_blogs(4)->result_array();
            $blog_thumbnail = base_url('uploads/blog/thumbnail/'.$recent_blogs[0]['thumbnail']);
            if(!file_exists($blog_thumbnail) || !is_file($blog_thumbnail)):
                $blog_thumbnail = base_url('uploads/blog/thumbnail/placeholder.png');
            endif; 

        ?>
        <div class="row">
           <div class="col-lg-6 col-sm-12">
                  <div>
                    <img src="<?php echo $blog_thumbnail; ?>" alt="" class="blog-img1">
                  </div>  
                   <div>
                    <h5 class="pt-2"><?php echo $recent_blogs[0]['title']; ?></h5>
                    <p><?php echo ellipsis(strip_tags(htmlspecialchars_decode_($recent_blogs[0]['description'])), 350); ?></p>
                   </div>
               
           </div>

           <div class="col-lg-6 col-md-12">
            <div class="about-mbl">  
                <?php for($i=1; $i < count($recent_blogs); $i++) : ?>
                    <?php
                        $blog_thumbnail = base_url('uploads/blog/thumbnail/'.$recent_blogs[$i]['thumbnail']);
                        if(!file_exists($blog_thumbnail) || !is_file($blog_thumbnail)):
                            $blog_thumbnail = base_url('uploads/blog/thumbnail/placeholder.png');
                        endif;
                    ?>
                    <div class="container ">
                    <div class="row">
                        <div class="col-lg-3 mt-3">
                              <img src="<?php echo $blog_thumbnail; ?>" alt="" class="blog-img2">
                        </div>
                        <div class="col-lg-9">
                            <h6 class="fw-bold mt-3"><?php echo $recent_blogs[$i]['title']; ?></h6>
                            <p><?php echo ellipsis(strip_tags(htmlspecialchars_decode_($recent_blogs[$i]['description'])), 200); ?> </p>
                        </div>
                    </div> 
                </div>
                <?php endfor; ?>
                
                
            </div> 

           </div>
        </div>
    </div>
</section>

<!-------- Related course section start ----->

<script>
    function getSpaces(len) {
        let text = "";
        for (let j = 0; j <= len; j++) {
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
    for (let i = 0; i < top_courses.length; i++) {
        heights.push((top_courses[i].innerText).length);
    }
    let max_height = heights.max();
    for (let i = 0; i < top_courses.length; i++) {
        let text = getSpaces(max_height - heights[i]);
        top_courses[i].innerText = top_courses[i].innerText + text;
    }
</script>
<!-------- Related course section end ----->


<?php if (addon_status('affiliate_course') && $is_affiliattor == 1) : ?>
    <?php include 'affiliate_course_modal.php';  // course_addon  single line /adding 
    ?>
<?php endif; ?>

<style>
    .contact_us_modal {
        display: none;
        position: fixed;
        z-index: 999;
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
            width: auto;
            /* Adjust width for tablets */
            max-width: 90%;
            /* Adjust max-width for tablets */
            height: auto;
            /* Adjust height for tablets */
            padding: 15px;
            /* Adjust padding for tablets */
        }

        .nav-tabs {
            top: 90px !important;
        }
    }

    /* For mobile screens */
    @media (max-width: 480px) {
        .contact_us_modal-content {
            width: 90%;
            /* Adjust width for mobile */
            max-width: 95%;
            /* Adjust max-width for mobile */
            height: auto;
            /* Adjust height for mobile */
            padding: 10px;
            /* Adjust padding for mobile */
            margin: 10% auto;
            /* Adjust margin for mobile */
            border: none;
            /* Remove border for mobile */
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
                            <!-- <h3><?php //echo get_phrase('Contact Us '); 
                                        ?><span>!</span></h3>
                    <p><?php //echo get_phrase('Explore, learn, and grow with us. Enjoy a seamless and enriching educational journey. Lets begin!') 
                        ?></p> -->
                            <form action="javascript:void(0);" onsubmit="contactFormSubmit()" name="contactForm" id="contactForm">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="course" id="course" required>
                                                <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                                                <?php $course_list = $this->crud_model->get_actual_courses()->result_array();
                                                foreach ($course_list as $course) :
                                                    if ($course['status'] != 'active')
                                                        continue; ?>
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
                                        <?php if (get_frontend_settings('recaptcha_status')) : ?>
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

    function hideShowVideoIcons() {
        /**
         * If the user has previously submitted details, 
         * the system will display the original icons. Otherwise, 
         * it will show the contact form navigated icons.
         */
        let details_submitted = localStorage.getItem('dataSubmitted');
        if (details_submitted == "true" || user_already_loggedin) {
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
        } else {
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

    function contactFormSubmit() {
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
                alert(xhr.responseText);
                if (xhr.responseText == 'Thank You For Contacting Us.') {
                    localStorage.setItem("dataSubmitted", true);
                    // Optionally, reset the form after successful submission
                    $('#contactForm')[0].reset();
                    contactModal.style.display = 'none';
                    hideShowVideoIcons();
                    if (localStorage.getItem('clickFrom') == 'video') {
                        document.getElementById("demoVideoButton").click();
                    } else if (localStorage.getItem('clickFrom') == 'broucher') {
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

    function saveUserActions(from) {
        var userData = {};
        if (user_already_loggedin) {
            if (user_already_loggedin == 1) {
                return true;
            }
            userData.user_id = user_already_loggedin
        } else {
            userData = JSON.parse(localStorage.getItem('userData'));
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo site_url('home/user_actions'); ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        userData.action_from = from;
        userData.course = <?php echo $course_id ?>;
        serialize = function(obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }
        var jsonData = serialize(userData);
        xhr.onload = function() {};
        xhr.send(jsonData);

    }
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    $("form").submit(function() {
        var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone'").val(full_number);

    });
</script>
<script>
    function moveToStartPosition() {
        if ($(window).width() >= 680) {
            $("#links").get(0).scrollIntoView({
                behavior: 'smooth'
            });
        } else {
            $("#cart_buttons").get(0).scrollIntoView({
                behavior: 'smooth'
            });
            //$("#links").get(document.getElementById("instructor").getBoundingClientRect().top).scrollIntoView({behavior: 'smooth'});
        }
    }
</script>
<style>
    .iti--allow-dropdown {
        width: 100%;
    }
</style>
<script>
    function demoRequestFormSubmit() {
        let drfull_number = drphoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='drphone'").val(drfull_number);

        const name = document.getElementById('drname').value.trim();
        const email = document.getElementById('dremail').value.trim();
        const phone = document.getElementById('drphone').value.trim();
        const course = document.getElementById('drcourse').value.trim();

        let formData = {
            name: name,
            email: email,
            phone: phone,
            course: course,
        };
        // Create a new XMLHttpRequest object
        let xhr = new XMLHttpRequest();

        // Define the request (GET method, URL)
        xhr.open('POST', '<?php echo site_url('home/demorequest_submitted'); ?>', true);

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Convert the data object to JSON format
        serialize = function(obj) {
            let str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }
        let jsonData = serialize(formData);

        // Set up a function to handle the response
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Request was successful
                alert(xhr.responseText);
                if (xhr.responseText == 'Thank You For Contacting Us for Demo.') {
                    // Optionally, reset the form after successful submission
                    $('#demoRequestForm')[0].reset();
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

    const drphoneInputField = document.querySelector("#drphone");
    const drphoneInput = window.intlTelInput(drphoneInputField, {
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    $("form").submit(function() {
        var drfull_number = drphoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='drphone'").val(drfull_number);

    });

    function demoRequestFormSubmitTwo() {
        let drfull_number_two = drphoneInputTwo.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='drphone'").val(drfull_number_two);

        const name = document.getElementById('drnametwo').value.trim();
        const email = document.getElementById('dremailtwo').value.trim();
        const phone = document.getElementById('drphonetwo').value.trim();
        const course = document.getElementById('drcoursetwo').value.trim();

        let formData = {
            name: name,
            email: email,
            phone: phone,
            course: course,
        };
        // Create a new XMLHttpRequest object
        let xhr = new XMLHttpRequest();

        // Define the request (GET method, URL)
        xhr.open('POST', '<?php echo site_url('home/demorequest_submitted'); ?>', true);

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Convert the data object to JSON format
        serialize = function(obj) {
            let str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }
        let jsonData = serialize(formData);

        // Set up a function to handle the response
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Request was successful
                alert(xhr.responseText);
                if (xhr.responseText == 'Thank You For Contacting Us for Demo.') {
                    // Optionally, reset the form after successful submission
                    $('#demoRequestFormTwo')[0].reset();
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

    const drphoneInputFieldTwo = document.querySelector("#drphonetwo");
    const drphoneInputTwo = window.intlTelInput(drphoneInputFieldTwo, {
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    $("form").submit(function() {
        var drfull_number_two = drphoneInputTwo.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='drphonetwo'").val(drfull_number_two);

    });

</script>