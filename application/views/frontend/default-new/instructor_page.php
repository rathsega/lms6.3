<?php
$instructor_details = $this->user_model->get_all_user($instructor_id)->row_array();
$social_links  = json_decode($instructor_details['social_links'], true);
$course_ids = $this->crud_model->get_instructor_wise_courses($instructor_id, 'simple_array');

$this->db->where_in('id', $course_ids);
$total_students_result = $this->db->get('ratings_count');
$total_students = 0;
foreach ($total_students_result->result_array() as $d) {
    $total_students += $d['number_of_students_enrolled'];
}
?>

<?php include "breadcrumb.php"; ?>

<!--------- Instructor section start ---------->
<section class="instructor-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- About  section start -->
                <div class="instructor-about">
                    <div class="instructor-about-heading">
                        <div class="row mb-3">
                            <div class="col-lg-8 col-md-7 col-sm-7 col-7">
                                <div class="pro-heading">
                                    <div class="pro-img">
                                        <img src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']);?>" style="height: 110px; width: auto; border-radius: 10px;">
                                    </div>
                                    <div class="name">
                                        <a href="#"><h4><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></h4></a>
                                        <p class="ellipsis-line-3"><?php echo $instructor_details['title']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 col-5">
                                <div class="rating">
                                    <h4 class="text-end"><?php echo get_phrase('Ratings'); ?></h4>
                                    <?php
                                    $total_rating = $this->crud_model->get_instructor_wise_course_ratings($instructor_details['id'], 'course', true)->row('rating');
									$number_of_ratings = $this->crud_model->get_instructor_wise_course_ratings($instructor_details['id'], 'course')->num_rows();
									if ($number_of_ratings > 0) {
										$average_ceil_rating = ceil($total_rating / $number_of_ratings);
									} else {
										$average_ceil_rating = 0;
									}
									
									?>
                                    <div class="rating-point">
                                        <p><?php echo $average_ceil_rating; ?></p>
                                        <i class="fa-solid fa-star"></i>
                                        <p>(<?php echo $number_of_ratings.' '.get_phrase('Reviews'); ?>)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-text">
                        <h3><?php echo get_phrase('About') ?></h3>
                        <?php echo $instructor_details['biography']; ?>
                    </div>

                    <?php $skills = explode(',', $instructor_details['skills']); ?>
                    <?php if($instructor_details['skills'] && is_array($skills) && count($skills) > 0): ?>
	                    <div class="about-text teachers">
	                        <h3><?php echo get_phrase('Professional Skills'); ?></h3>
	                        <ul>
			                    <?php foreach($skills as $skill): ?>
			                      <li><a href="#"><?php echo $skill; ?></a>
			                    <?php endforeach; ?>
	                        </ul>  
	                    </div>
	                <?php endif; ?>

                    <div class="skill">
                        <h3><?php echo get_phrase('Statistics') ?></h3>
                        <div class="skill-point">
                            <div class="skill-point-1">
                                <h1><?php echo $total_students; ?></h1>
                                <h4><?php echo get_phrase('Total Students') ?></h4>
                            </div>
                            <div class="skill-point-1">
                                <h1><?php echo sizeof($course_ids); ?></h1>
                                <h4><?php echo get_phrase('Courses'); ?></h4>
                            </div>
                            <div class="skill-point-1">
                                <h1><?php echo $number_of_ratings; ?></h1>
                                <h4><?php echo get_phrase('Reviews'); ?></h4>
                            </div>
                        </div>
                    </div>




                    
                </div>
                
                <!-- About section End -->
            </div>
            <div class="col-lg-4">
                <div class="instructor-right">
                    <div class="instructon-contact">

                    	<?php if(!empty($instructor_details['phone'])): ?>
	                        <div class="instructon-icon">
	                            <i class="fa-solid fa-phone"></i>
	                            <div class="instructon-number">
	                                <h4><?php echo get_phrase('Phone Number'); ?>:</h4>
	                                <p><?php echo $instructor_details['phone']; ?></p>
	                            </div>
	                        </div>
	                    <?php endif; ?>

                        <?php if(!empty($instructor_details['email'])): ?>
	                        <div class="instructon-icon">
	                            <i class="fa-solid fa-envelope"></i>
	                            <div class="instructon-number">
	                                <h4><?php echo get_phrase('Email'); ?>:</h4>
	                                <p><?php echo $instructor_details['email']; ?></p>
	                            </div>
	                        </div>
	                    <?php endif; ?>

                        <?php if(!empty($instructor_details['address'])): ?>
	                        <div class="instructon-icon">
	                            <i class="fa-solid fa-location-dot"></i>
	                            <div class="instructon-number">
	                                <h4><?php echo get_phrase('Address'); ?>:</h4>
	                                <p><?php echo $instructor_details['address']; ?></p>
	                            </div>
	                        </div>
	                    <?php endif; ?>

	                    <div class="row mt-4 justify-content-center">
	                    	<div class="col-auto px-1">
			                    <?php if($social_links['facebook']): ?>
		                            <a class="text-center social-btn" href="<?php echo $social_links['facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i> <?php echo site_phrase('facebook'); ?></a>
		                        <?php endif; ?>
		                    </div>
	                    	<div class="col-auto px-1">
		                        <?php if($social_links['twitter']): ?>
		                            <a class="text-center social-btn" href="<?php echo $social_links['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i> <?php echo site_phrase('twitter'); ?></a>
		                        <?php endif; ?>
		                    </div>
	                    	<div class="col-auto px-1">
		                        <?php if($social_links['linkedin']): ?>
		                            <a class="text-center social-btn" href="<?php echo $social_links['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin-in"></i> <?php echo site_phrase('linkedin'); ?></a>
		                        <?php endif; ?>
		                    </div>
		                </div>

                    </div>
                    <div class="instructor-msg">
                        <button class="btn btn-primary" type="button" onclick="redirectTo('<?php echo site_url('home/my_messages?instructor_id='.$instructor_details['id']); ?>')"> <i class="fa-solid fa-envelope"></i> <?php echo get_phrase('Message') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--------- Instructor section end ---------->