<?php
$language_dir = 'ltr';
$language_dirs = get_settings('language_dirs');
if($language_dirs){
	$current_language = $this->session->userdata('language');
	$language_dirs_arr = json_decode($language_dirs, true);
	if(array_key_exists($current_language, $language_dirs_arr)){
		$language_dir = $language_dirs_arr[$current_language];
	}
}
?>

<!DOCTYPE html>
<html lang="en" dir="<?php echo $language_dir; ?>">
<head>
	<title><?php echo $course_details['title'].' | '.get_settings('system_name'); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
	<meta name="viewport" 
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="author" content="<?php echo get_settings('author') ?>" />
	<meta name="keywords" content="<?php echo $course_details['meta_keywords']; ?>"/>
	<meta name="description" content="<?php echo $course_details['meta_description']; ?>" />
	<link name="favicon" type="image/x-icon" href="<?php echo base_url('uploads/system/'.get_frontend_settings('favicon')); ?>" rel="shortcut icon" />

	<?php include 'includes_top.php';?>

	<style type="text/css">
		.custom-accordion .accordion-button{
			padding: 13px 0px !important;
		}
		.course-content-items .item a{
			font-family: "Inter", sans-serif;
			line-height: 20px !important;
		    font-size: 15px;
		    font-weight: 500;
		    line-height: 34px;
		    color: #737982;
		    transition: all 0.3s;
		}
		.course-content-items .item a > i{
			border-radius: 50%;
		    height: 29px;
		    width: 29px;
		    padding: 10.5px 11.5px;
		    font-size: 8px;
		    background-color: rgba(115, 121, 130, 0.2);
		    color: #6f7a8b;
		}
		.course-content-items .item.active a > i{
		    background-color: #fff;
		    color: #1663d4;
		}
		.course-content-items .item a .checkbox, .course-content-items .item .checkbox{
			min-height: 20.5px;
    		min-width: 35px;
    		position: relative;
		}
		.course-content-items .item a input, .course-content-items .item input{
		    min-width: 20px;
		    min-height: 20px;
		    position: absolute;
    		top: 4px;
    		left: 4.5px;
		}
		.course-content-items .lesson-icon{
			font-size: 10px;
		    margin-top: -2px !important;
		    display: inline-block;
		    font-weight: 700;
		}
		.course-content-items .item.active a{
			color: #fff;
		}
		.lesson_checkbox, .lesson_checkbox:hover{
			accent-color: #e3e4e6;
		}
	</style>
</head>

<body style="overflow-y: scroll">
<?php $full_page = $this->session->userdata('full_page_layout'); ?>
<nav class="navbar navbar-expand bg-dark fixed-top" style="height: 65px;">
	<div class="container-fluid">
		<a class="navbar-brand d-none d-md-block" href="<?php echo site_url(); ?>">
			<img width="150px" src="<?php echo site_url('uploads/system/'.get_frontend_settings('light_logo')) ?>" alt="" />
		</a>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link text-white p-0" aria-current="page" href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>">
						<?php $number_of_lessons = $this->crud_model->get_lessons('course', $course_details['id'])->num_rows(); ?>
						<p class="text-md-center fs-6"><?php echo $course_details['title']; ?></p>
						<?php if(isset($watch_history) && !empty($watch_history['completed_lesson']) && is_array(json_decode($watch_history['completed_lesson'], true))): ?>
							<p class="text-md-center text-12px"><?php echo $watch_history['course_progress'].'% '.get_phrase('Completed'); ?>(<?php echo count(json_decode($watch_history['completed_lesson'], true)) ?>/<?php echo $number_of_lessons; ?>)</p>
						<?php endif; ?>
					</a>
				</li>
			</ul>
			<!-----fedback-btn----------- -->
			<button class="btn btn btn-light btn-outline-secondary mx-1" id="feedback_form_button" onclick="openFeedbackForm()">Feedback</button> 
			<!-- ---fedback-btn----------- -->
			<?php if($full_page): ?>
				
				<a href="#" onclick="actionTo('<?php echo site_url('home/course_playing_page_layout'); ?>')" class="btn btn-outline-secondary mx-1"><i class="fas fa-arrows-alt"></i></a>
			<?php else: ?>
				<a href="#" onclick="actionTo('<?php echo site_url('home/course_playing_page_layout'); ?>')" class="btn btn-outline-secondary mx-1"><i class="fas fa-arrows-alt-h"></i></a>
			<?php endif; ?>

			<?php $user_id = $this->session->userdata('user_id');
				$is_course_instructor = $this->crud_model->is_course_instructor($course_details['id'], $user_id);?>
			<?php if($this->session->userdata('admin_login')): ?>
				<a href="<?php echo site_url('admin/course_form/course_edit/'.$course_details['id']); ?>" class="btn btn-outline-secondary">
					<span class="d-none d-sm-inline-block"><?php echo get_phrase('Course Manager'); ?></span>
					<i class="fas fa-angle-right ms-1 me-1"></i>
				</a>
			<?php elseif($is_course_instructor): ?>
				<a href="<?php echo site_url('user/course_form/course_edit/'.$course_details['id']); ?>" class="btn btn-outline-secondary">
					<span class="d-none d-sm-inline-block"><?php echo get_phrase('Course Manager'); ?></span>
					<i class="fas fa-angle-right ms-1 me-1"></i>
				</a>
			<?php else: ?>
				<a href="<?php echo site_url('home/my_courses'); ?>" class="btn btn-outline-secondary">
					<span class="d-none d-sm-inline-block"><?php echo get_phrase('My Courses'); ?></span>
					<i class="fas fa-angle-right ms-1 me-1"></i>
				</a>
			<?php endif; ?>
		</div>
	</div>
</nav>

<!-- ----------------pop-up-------------- -->

<div class="popup-form" id="feedback_form_modal">
    <span class="close-btn" id="feedback_form_close_button">&times;</span>
    <div class="form-container">
        <form action="javascript:void(0);" onsubmit="feedbackFormSubmit()" id="feedback_form" name="feedback_form">
        <div class="header-card">
            <h4 class="pb-2">Send us your feedback!</h4>
            <p>Please let us know if you have any suggestions or feedback</p>
        </div>
        <div class="d-flex flex-row">
        <div class="col-md-6 col-12 d-none d-md-block">
    <img src="https://res.cloudinary.com/dc2uykpox/image/upload/v1709807445/image-reviews_dtput6.png" alt="" class="feedback-img">
</div>
        <div class="forms-ips col-md-6 col-12">
            <!-- <label for="name">Name:</label> -->
            <input type="text" id="feedback_form_name" required name="feedback_form_name" required placeholder="Name">

            <!-- <label for="email">Email:</label> -->
            <input type="email" class="email-ip" id="feedback_form_email" required name="feedback_form_email" required placeholder="email">

            <!-- <label for="phone">Phone:</label> -->
            <input type="tel" id="feedback_form_phone" required name="feedback_form_phone"  required placeholder="Phone:">

            <!-- <label for="message">Message:</label> -->
            <textarea id="feedback_form_message" required name="feedback_form_message" rows="4" required placeholder="Message:"></textarea>
            
            <button class="button-sub w-100" type="submit">Submit</button>
        </div>
        </div>
        
            

        </form>
    </div>
</div>

<script>
    const feedback_form_modal = document.getElementById('feedback_form_modal');
    const feedback_form_button = document.getElementById('feedback_form_button');
    feedback_form_button.addEventListener('click', function() {
        feedback_form_modal.style.display = 'block';
    });

    const feedback_form_close_button = document.getElementById('feedback_form_close_button');
    feedback_form_close_button.addEventListener('click', function() {
        feedback_form_modal.style.display = 'none';
    });

    function feedbackFormSubmit() {
        var full_number = feedback_form_phone_input.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='feedback_form_phone'").val(full_number);
        var $inputs = $('#feedback_form :input');

        const name = document.getElementById('feedback_form_name').value.trim();
        const email = document.getElementById('feedback_form_email').value.trim();
        const phone = document.getElementById('feedback_form_phone').value.trim();
        const message = document.getElementById('feedback_form_message').value.trim();

        // Regular expressions for email and phone number validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Perform validations
        if (name === '') {
            alert('Please enter your name.');
            return;
        }

        if (email === '' || !emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        var formData = {
            name: name,
            email: email,
            phone: phone,
            message: message
        };
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the request (GET method, URL)
        xhr.open('POST', '<?php echo site_url('home/feedback_from_submitted'); ?>', true);

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

        var jsonData = serialize(formData);

        // Set up a function to handle the response
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Request was successful
                alert(xhr.responseText);
                if (xhr.responseText == 'Thank You For Providing Your Feedback.') {
                    // Optionally, reset the form after successful submission
                    $('#feedback_form')[0].reset();
                    feedback_form_modal.style.display = 'none';
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

    const feedback_form_phone = document.querySelector("#feedback_form_phone");
    const feedback_form_phone_input = window.intlTelInput(feedback_form_phone, {
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    $("form").submit(function() {
        var full_number = feedback_form_phone_input.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='feedback_form_phone'").val(full_number);
    });
</script>

<!-------------------pop-up-------------- -->


<!-------------------pop-up-styles-------------- -->
<style>
    .header-card{
     background: #754ffe;
    color: white;
    padding: 24px 15px 24px 15px;
    }
    .feedback-img{
    height: 246px;
    margin-top: 66px;
    margin-left: 20px;
}
.popup-form {
          display: none;
    position: fixed;
    top: 53%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 50px;
    background-color: #fff0;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); */
    z-index: 1000;
    border-radius: 10px;
    width: 66%;

}
<style>
	    html {
          touch-action: manipulation;
        }
        .popup-form {
          display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 50px;
    background-color: #fff0;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); */
    z-index: 1040;
    border-radius: 10px;
    width: 66%;

}
.email-ip{
  margin-top: 1px !important;
}
.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
    padding-right: 44px !important;
}
.close-btn {
  position: absolute;
    top: 55px;
    right: 50px;
    cursor: pointer;
    color: white;
    /* height: 53px; */
    font-size: 37px;
    background: #754ffe;
    border-radius: 38px;
    padding: 10px;
}
.form-container {
  /* max-width: 400px; */
    margin: 0 auto;
     background-color: #ffffff;
    border-radius:5px;
    box-shadow: 0 0 10px rgb(0 0 0 / 41%);
}
.forms-ips{
  padding: 7px 26px 16px 26px;
  width: 44%;
}
/* .header-card{
  p{
    font-size:13px;
    line-height:16px;
  }
} */
  input, textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #0000007d;
    border-radius: 4px;
    margin-top:20px;
  }
 
  label {
    display: block;
    margin-bottom: 0px;
    font-weight: 500;
  }


  input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #0000007d;
    border-radius: 5px;

  }


  .button-sub {
    background-color: #754ffe;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  
  button:hover {
    background-color: #45a049;
  }
  @media screen and (max-width: 767px) {
    .form-container {
      width: 290px !important;
    margin-left: -133px;
}
.forms-ips{
width: 100%;
}
.form-container {
    margin-left: -73px;
}

.close-btn {
    position: absolute;
    top: 25px;
    right: -17px;
    cursor: pointer;
    color: white;
    /* height: 53px; */
    font-size: 40px;
    background: #754ffe;
    border-radius: 38px;
    padding: 14px;
}
  }
	</style>

	<!-------------------pop-up -styles-end-------------- -->
</style>
<script>
	<?php include "enquire_now.php" ?>
  <?php include "feedback.php" ?>
    function openFeedbackForm() {
        document.getElementById("feedbackForm").style.display = "block";
    }

    function closeFeedbackForm() {
        document.getElementById("feedbackForm").style.display = "none";
    }
  </script>

<!-- ----------popu-up- script-end------------- -->










	<!-- Start Course Playing -->
	<section class="course-playing">
		<div class="container-fluid">
			<div class="row g-3 justify-content-center">
				<!-- Sidebar -->
				<?php if($course_details['course_type'] == 'general'): ?>
					<?php if(!is_array($lesson_details)): ?>
						<h5 class="w-100 text-center text-black"><?php echo get_phrase('Course content not found') ?></h5>
						<p class="w-100 text-center"><?php echo get_phrase('Please ensure that your course has at least one section and one lesson.'); ?></p>
					<?php endif; ?>

					<div class="<?php if($full_page){ echo 'col-lg-12'; }else{ echo 'col-lg-4'; } ?> order-2">
						<?php include "sidebar.php"; ?>
					</div>
					<!-- Content -->
					<div class="<?php if($full_page){ echo 'col-lg-12'; }else{ echo 'col-lg-8'; } ?> order-1">
						<?php if(is_array($lesson_details)): ?>
							<div class="course-playing-content">
								<div class="mb-4 mt-2" <?php if($full_page) echo 'style="margin-top: -2px; margin-left: -12px; margin-right: -12px;"'; ?>>
									<?php if(in_array($lesson_details['id'], $locked_lesson_ids) && $course_details['enable_drip_content']): ?>
					                    <div class="py-5">
					                        <?php echo remove_js(htmlspecialchars_decode_($drip_content_settings['locked_lesson_message'])); ?>
					                    </div>
					                <?php else: ?>
					                	<?php if(in_array($lesson_details['section_id'], $restricted_section_ids)): ?>
					                		<div class="py-5">
					                			<div class="locked-card">
								                    <i class="fas fa-lock text-30px"></i>
								                    <h6 class="w-100 text-center text-dark my-2"><?php echo get_phrase('This section is not included in the current study plan'); ?></h6>
								                    <small class="text-12px"><?php echo date('d M Y h:i A', $section['start_date']).' - '.date('d M Y h:i A', $section['end_date']); ?></small>
								                </div>
					                		</div>
										<?php else: ?>
											<?php include $course_details['course_type'].'_course_content_body.php'; ?>
										<?php endif ?>
									<?php endif; ?>
								</div>
								<div class="content">
									<h4 class="cp-title"><?php echo get_phrase('Summary'); ?>:</h4>
									<div class="cp-info pb-50">
										<?php echo htmlspecialchars_decode_($lesson_details['summary']); ?>
									</div>
									<div>
										<?php if(addon_status('forum') || addon_status('noticeboard') || addon_status('assignment') || addon_status('certificate') || addon_status('live-class') || addon_status('jitsi-live-class')):?>
											<?php include "bottom_tabs.php"; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="col-lg-12">
						
						<?php include $course_details['course_type'].'_course_content_body.php'; ?>

						<div class="row">
							<div class="col-md-12 pt-5">
								<?php if(addon_status('forum') || addon_status('noticeboard') || addon_status('assignment') || addon_status('certificate') || addon_status('live-class') || addon_status('jitsi-live-class')):?>
									<?php include "bottom_tabs.php"; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
    <!-- End Course Playing -->
    <?php include "includes_bottom.php"; ?>
    <?php include APPPATH."views/frontend/default-new/common_scripts.php"; ?>
    <?php include APPPATH."views/frontend/default-new/init.php"; ?>
</body>
</html>

<style>

html, body {
    height: 100%;
    margin: 0;
}

body {
    overflow: auto;
}
	::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-thumb {
    background-color: #888;
}

/* For Firefox */
scrollbar-width: thin;
scrollbar-color: #888;
</style>
