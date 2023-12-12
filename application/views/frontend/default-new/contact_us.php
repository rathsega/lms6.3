<?php include "breadcrumb.php"; ?>

<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<!------------ Contact section start ----->
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="contact-heading">
                    <h3><?php //echo get_phrase('Contact Us') ?></h3>
                    <p><?php echo get_frontend_settings('contact_us'); ?></p>
                </div>               
            </div>
            <div class="col-lg-6 col-md-4">
                <!-- no content -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact-image">
                    <img src="<?php echo site_url('assets/frontend/default-new/'); ?>image/contact-img.png">
                </div>
                
                
            </div>
            <div class="col-lg-6 col-md-6">
                <form action="<?php echo site_url('home/contact_us/submit'); ?>" method="post" class="form-section" id="actualContactForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mb-3">
                                <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="course" id="course" required>
                                    <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                                    <?php $course_list = $this->crud_model->get_courses()->result_array();
                                        foreach ($course_list as $course):
                                        if ($course['status'] != 'active')
                                            continue;?>
                                        <option value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="first_name" type="text" maxlength="26" class="form-control" id="first_name" required placeholder="<?php echo get_phrase('First Name *') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="last_name" type="text" maxlength="26" class="form-control" id="last_name" placeholder="<?php echo get_phrase('Last Name') ?>">
                            </div>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="email" type="email" class="form-control" id="email" required placeholder="<?php echo get_phrase('Email *') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="phone" type="text" class="form-control" id="phone" required placeholder="<?php echo get_phrase('Phone *') ?>">
                            </div>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <input name="city" type="text" class="form-control" id="city" placeholder="City">
                            </div> 
                            <div class="input-group comment">
                                <textarea name="message" class="form-control" maxlength="500" aria-label="With textarea" id="message" placeholder="<?php echo get_phrase('Write your message'); ?>"></textarea>
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
</section>
<!------------ Contact secton end -------->

<script  type="text/javascript">

    function validateForm(){
        const first_name = document.getElementById('first_name').value.trim();
        const last_name = document.getElementById('last_name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const city = document.getElementById('city').value.trim();
        const message = document.getElementById('message').value.trim();
        const course = document.getElementById('course').value.trim();

        // Regular expressions for email and phone number validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^[6-9]{1}[0-9]{9}$/;
        var msg = "";
        // Perform validations
        
        if(message && message.length > 500){
            msg = 'Message should not exceed 500 characters';;
        }

        if (first_name === '') {
            msg = 'Please enter your first name.';
        }

        if (email === '' || !emailRegex.test(email)) {
            msg = 'Please enter a valid email address.';
        }

        if (phone !== '' && !phoneRegex.test(phone)) {
            msg = 'Please enter a valid 10-digit phone number.';
        }
        if(msg){
            alert(msg);
            return false;
        }else{
            return true;
        }
    }
       
</script>