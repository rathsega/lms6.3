<?php $enrolments = $this->user_model->my_courses()->result_array(); ?>
<?php $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>
<?php include "breadcrumb.php"; ?>

<!-------- Wish List body section start ------>
<section class="wish-list-body ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="my-course-1-full-body">
                    <h1><?php echo get_phrase('Courses'); ?></h1>
                    <div class="row">
                        <?php foreach($enrolments as $enrolment):
                            $course_details = $this->crud_model->get_course_by_id($enrolment['course_id'])->row_array();
                            $instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
                            $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
                            $lectures = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz']);
                            $quizzes = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz']);
                            $watch_history = $this->crud_model->get_watch_histories($this->session->userdata('user_id'), $course_details['id'])->row_array();
                            $course_progress = isset($watch_history['course_progress']) ? $watch_history['course_progress'] : 0;
                            $ratings_count = $this->crud_model->get_ratings_count($course_details['id']);
                            if($course_details['slug_count'] == 1 || $course_details['slug_count'] == 2){
                                $enrolment_slug = $course_details['slug'];
                            }else if($course_details['slug_count'] == 3 || $course_details['slug_count'] == 4){
                                $enrolment_slug = $course_details['category_slug'] .'/' . $course_details['sub_category_slug'] .'/' . $course_details['slug'];
                            }else{
                                $enrolment_slug = $course_details['slug'];
                            }
                            if($ratings_count){
                                $one = $ratings_count['one_rating_count'];
                                $two = $ratings_count['two_rating_count'];
                                $three = $ratings_count['three_rating_count'];
                                $four = $ratings_count['four_rating_count'];
                                $five = $ratings_count['five_rating_count'];
                                $number_of_ratings = $ratings_count['number_of_ratings'];
    
                                $average_ceil_rating = ceil((($one*1) + ($two*2) + ($three*3)+($four*4)+($five*5))/$number_of_ratings);
                            }else{
                                $average_ceil_rating = 0;
                                $number_of_ratings = 0;
                            }
                            ?>

                            <a  href="<?php echo ($enrolment['expiry_date'] > 0 && strtotime($enrolment['expiry_date']) < time()) ? site_url($enrolment_slug) : site_url('home/lesson/'.slugify($course_details['title']).'/'.$course_details['id']) ?>"><div class="col-lg-12 col-md-12 col-sm-6 col-12 mb-5">
                                <div class="my-course-1-full-body-card">
                                    <div class="my-course-1-img">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="">
                                    </div>
                                    <div class="my-course-1-text pt-1">
                                        <div class="my-course-1-text-heading">
                                            <h3><?php echo $course_details['title']; ?></h3>
                                            <div class="child-icon">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle py-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                        <li>
                                                            <a class="dropdown-item py-2" href="<?php echo site_url($enrolment_slug); ?>"><?php echo get_phrase('Go to course page') ?></a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item py-2" href="<?php echo site_url('home/instructor_page/'.$course_details['creator']) ?>"><?php echo get_phrase('Author profile') ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-course-1-lesson-text mb-2">
                                            <div class="icon-1">
                                                <p><i class="far fa-play-circle"></i> <?php echo get_phrase('Lectures').' '. $course_details["number_of_lectures"]; ?></p>
                                            </div>
                                            <div class="icon-1">
                                                <p><i class="far fa-question-circle"></i> <?php echo get_phrase('Quizzes').' '.$quizzes->num_rows(); ?></p>
                                            </div>
                                            <div class="icon-1">
                                                <p><i class="fa-regular fa-clock"></i> <?php echo $course_duration; ?></p>
                                            </div>
                                        </div>
                                        <div class="my-course-1-skill">
                                              <div class="skill-bar-container">
                                                <div class="skill-bar" style="width: <?php echo $course_progress; ?>%; animation: unset"></div>
                                              </div>
                                              <p><?php echo $course_progress; ?>%</p>
                                        </div>

                                        <?php include 'live_class_scadule.php'; ?>

                                        <div class="my-course-1-last">
                                            <div class="icon-img d-grid">
                                                <?php $my_rating = $this->crud_model->get_user_specific_rating('course', $course_details['id']); ?>
                                                <div class="d-flex align-items-center">
                                                    <img class="ms-0" src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="">
                                                    <span class="text-14px ms-1 mt-1"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?> </span>
                                                    <div class="star m-0">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <i class="fa-solid fa-star <?php if($average_ceil_rating >= $i) echo 'gold'; ?>"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                                <?php if($enrolment['expiry_date'] > 0 && $enrolment['expiry_date'] < time()): ?>
                                                    <span class="text-12px text-start mt-2"><?php echo get_phrase('Expired') ?> - <b style="color: var(--bs-code-color);"><?php echo date('d M Y, H:i A', $enrolment['expiry_date']); ?></b></span>
                                                <?php else: ?>
                                                    <?php if($enrolment['expiry_date'] == 0): ?>
                                                        <span class="text-12px text-start mt-2"><?php echo get_phrase('Expiry period') ?> - <b class="text-success text-uppercase"><?php echo get_phrase('Lifetime Access'); ?></b></span>
                                                    <?php else: ?>
                                                        <span class="text-12px text-end mt-2 mbl-cou-para"><?php echo get_phrase('Expiration On') ?> - <?php if(strtotime($enrolment['expiry_date']) - 60*24*60*60 < time()): ?><b style="color: var(--bs-code-color);"><?php echo date('d M Y, H:i A', strtotime($enrolment['expiry_date'])); ?></b><?php else: ?><b><?php echo date('d M Y, H:i A', strtotime($enrolment['expiry_date'])); ?></b><?php endif; ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="my-course-1-btn pt-4 me-4">
                                                <?php if($enrolment['expiry_date'] > 0 && strtotime($enrolment['expiry_date']) < time()): ?>
                                                    <a class="btn text-14px py-1 text-white" style="background-color: var(--bs-code-color);"  href="<?php echo site_url($enrolment_slug) ?>">
                                                        <i class="far fa-calendar-plus"></i>
                                                        <?php echo get_phrase('View Course'); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a class="btn btn-primary text-14px py-1" href="<?php echo site_url('home/lesson/'.slugify($course_details['title']).'/'.$course_details['id']) ?>">
                                                        <i class="far fa-play-circle"></i>
                                                        <?php echo get_phrase('Start Now'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-------- wish list bosy section end ------->
<script>
        window.onload = function() {
            getLocation();
            upcomingCourseHeightAlignment();
        };

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback,errorCallback,options);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            // You can do something with the latitude and longitude here
            console.log("Latitude: " + latitude + " Longitude: " + longitude);
            displayLocation(latitude, longitude);
        }

        function displayLocation(latitude,longitude){
            var request = new XMLHttpRequest();
            console.log("Latitude: " + latitude + " Longitude: " + longitude);
            var method = 'GET';
            var url = 'https://api.bigdatacloud.net/data/reverse-geocode-client?latitude='+latitude+'&longitude='+longitude+'&localityLanguage=en';
            var async = true;

            request.open(method, url, async);
            request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                console.log(data);
                //document.write(address.formatted_address);
                document.cookie = "city = "+ data.city + "; path=/";
                document.cookie = "countryName = "+ data.countryName + "; path=/";
                return {"city":data.city, contryName:data.countryName};
            }
            };
            request.send();
        };

        var successCallback = function(position){
            var x = position.coords.latitude;
            var y = position.coords.longitude;
            displayLocation(x,y);
        };

        var errorCallback = function(error){
            var errorMessage = 'Unknown error';
            switch(error.code) {
            case 1:
                errorMessage = 'Permission denied';
                break;
            case 2:
                errorMessage = 'Position unavailable';
                break;
            case 3:
                errorMessage = 'Timeout';
                break;
            }
            //document.write(errorMessage);
        };

        var options = {
            enableHighAccuracy: true,
            timeout: 1000,
            maximumAge: 0
        };

      
    </script>
