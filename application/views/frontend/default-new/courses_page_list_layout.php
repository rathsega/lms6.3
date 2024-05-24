<div class="grid-view-body courses courses-list-view-body">

    <?php include 'courses_page_sorting_section.php'; ?>

    <div class="courses-card courses-list-view-card">
        <?php foreach ($courses as $course) : ?>
            <?php
            if($course['slug_count'] == 1 || $course['slug_count'] == 2){
                $course_slug = $course['slug'];
            }else if($course['slug_count'] == 3 || $course['slug_count'] == 4){
                $course_slug = $course['category_slug'] .'/' . $course['sub_category_slug'] .'/' . $course['slug'];
            }else{
                $course_slug = $course['slug'];
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
            $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
            $ratings_count = $this->crud_model->get_ratings_count($course['id']);
            if($ratings_count){
                $one = $ratings_count['one_rating_count'];
                $two = $ratings_count['two_rating_count'];
                $three = $ratings_count['three_rating_count'];
                $four = $ratings_count['four_rating_count'];
                $five = $ratings_count['five_rating_count'];
                $number_of_ratings = $ratings_count['number_of_ratings'];
                $number_of_enrolments = $ratings_count['number_of_students_enrolled'];
                $average_ceil_rating = round((($one*1) + ($two*2) + ($three*3)+($four*4)+($five*5))/$number_of_ratings, 1);
            }else{
                $average_ceil_rating = 0;
                $number_of_ratings = 0;
                $number_of_enrolments = 0;
            }
            ?>
            <!-- Course List Card -->
            <a href="<?php echo site_url($course_slug); ?>" class="courses-list-view-card-body courses-card-body card-img-car checkPropagation">
                <div class="courses-card-image  col-md-4">
                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>">
                    <div class="courses-icon <?php if(in_array($course['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIcon<?php echo $course['id']; ?>">
                        <i class="fa-solid fa-heart checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/'.$course['id']); ?>')"></i>
                    </div>
                    <div class="courses-card-image-text"> 
                        <h3><?php echo get_phrase($course['level']); ?></h3>
                    </div> 
                </div>
                <div class="courses-text w-100">
                    <div class="courses-d-flex-text">
                        <h5><?php echo $course['title']; ?></h5>
                        <!-- <span class="compare-img checkPropagation" onclick="redirectTo('<?php echo base_url('home/compare?course-1='.slugify($course['title']).'&course-id-1='.$course['id']); ?>');">
                            <img src="<?php echo base_url('assets/frontend/default-new/image/compare.png') ?>">
                            <?php echo get_phrase('Compare'); ?>
                        </span> -->
                   </div>
                    <div class="review-icon">
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
                        <p><i class="fas fa-closed-captioning"></i><?php echo site_phrase($course['language']); ?></p>
                    </div>
                    <div class="courses-price-border">
                        <div class="courses-price">
                            <div class="courses-price-left">
                                <?php if($course['is_free_course']): ?>
                                    <h5 class="price-free"><?php echo get_phrase('Free'); ?></h5>
                                <?php elseif($course['discount_flag']): ?>
                                    <h5><?php echo currency($course['discounted_price']); ?></h5>
                                    <p class="mt-1"><del><?php echo currency($course['price']); ?></del><span><?php echo " +Tax"; ?></span></p>
                                <?php else: ?>
                                    <h5><?php echo currency($course['price']); ?><span><?php echo " +Tax"; ?></span></h5>
                                <?php endif; ?>
                            </div>
                            <div class="courses-price-right ">
                                <p class="me-2"><i class="fa-regular fa-list-alt p-0 text-15px"></i> <?php echo $course["number_of_lectures"]/*$lessons->num_rows()*/.' '.get_phrase('lessons'); ?></p>
                                <p class="me-2"><i class="fa-regular fa-clock text-15px p-0"></i> <?php echo $course_duration; ?></p>
                                <p><i class="far fa-calendar-alt text-15px p-0"></i> <?php echo $course_duration_in_months; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a> 
            <!-- End Course List Card -->
        <?php endforeach; ?>

        <!------- pagination Start ------>
        <div class="pagenation-items mb-0 mt-3">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>