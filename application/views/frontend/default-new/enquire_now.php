<style>
    .contact_us_modal {
    display: none;
    position: fixed;
    z-index: 1;
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
    height: 85%;
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
    openModalBtn.addEventListener('click', function() {
        contactModal.style.display = 'block';
        localStorage.setItem('clickFrom', 'video');
    });
</script>