<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<style>
    .contact_us_modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: -44px;
    width: 100%;
    height: 120%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow: auto;
    }
    .Us-color{
        color:#754FFE;
    }
    .c-img{
        height:66px;
    }
    .phon-enquery{
        margin-top:1.1rem;
    }
    input {
    margin-bottom: 0px;
}
    .contact_us_modal-content {
    border-radius: 6px;
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    /* border: 1px solid #888; */
    width: 40%;
    max-width: 80%;
    box-shadow: 0px 0px 60px 30px rgb(0 0 0 / 19%);
    /* height: 85%; */
    }
    .contact-p-label{
        margin-bottom:20px;
    }
    .form_label{
    color:black;
    font-weight:500;
    font-size:14px;
    }

    /* For tablet screens */
    @media (max-width: 768px) {
        .contact_us_modal-content {
            width: auto; /* Adjust width for tablets */
            max-width: 90%; /* Adjust max-width for tablets */
            height: auto; /* Adjust height for tablets */
            padding: 15px; /* Adjust padding for tablets */
        }
        .contact_us_modal {
            top: 3px;
            overflow: auto;
        }
        .c-img{
        height:50px;
    }
    .c-head{
        padding-right: 65px;
        padding-top: 2px;
    }
    .close{
        margin-top: -42px;
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
            height: 100%;
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

<div class="contact_us_modal" id="contactModal1">
  <div class="contact_us_modal-content">
    <div class="row">
        <div class="col-md-10 col-sm-10 col-md-lg-10 text-center c-head">
        <h4><img src="<?php echo site_url("assets/frontend/default-new/image/letter_send_1_1_zete2g.webp") ?>" alt="" class="c-img"> Contact <span class="Us-color">Us</span></h4>
        </div>
        <div class="col-md-2 col-sm-2 col-md-lg-2">
            <span class="close" id="closeModal1">&times;</span>
        </div>
    </div>

    <section class="sign-up my-4">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                <img width="65%" src="<?php echo site_url('assets/frontend/default-new/image/login-security.gif') ?>">
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="sing-up-right" style="margin-top: 0px !important;">
                    <!-- <h3><?php //echo get_phrase('Contact Us '); ?><span>!</span></h3>
                    <p><?php //echo get_phrase('Explore, learn, and grow with us. Enjoy a seamless and enriching educational journey. Lets begin!') ?></p> -->
                    <form action="javascript:void(0);" onsubmit="contactFormSubmit1()" name="contactForm1" id="contactForm1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div>
                                    <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="course" id="course1" required>
                                        <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                                        <?php $course_list = $this->crud_model->get_actual_courses()->result_array();
                                            foreach ($course_list as $course):
                                            if ($course['status'] != 'active')
                                                continue;?>
                                            <option value="<?php echo $course['id'] ?>" <?php echo isset($slug) && $course['slug'] == $slug ? 'selected' : ''; ?> ><?php echo $course['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <div>
                                <!-- <label class="form_label">First Name *</label> -->
                                    <input name="first_name" type="text" class="form-control" maxlength="26" id="first_name1" required placeholder="<?php echo get_phrase('First name *') ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <div>
                                <!-- <label class="form_label">Last Name</label> -->
                                    <input name="last_name" type="text" class="form-control" maxlength="26" id="last_name1" placeholder="<?php echo get_phrase('Last name') ?>">
                                </div>                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <div >
                                <!-- <label class="form_label">Email *</label> -->
                                    <input name="email" type="email" class="form-control" id="email1" required placeholder="<?php echo get_phrase('Email *') ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 phon-enquery">
                                <div >
                                    <input name="phone" type="text" class="form-control " id="phone1" required placeholder="<?php echo get_phrase('Phone *') ?>">
                                </div>                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div>
                                <!-- <label class="form_label">City</label> -->
                                    <input name="city" type="hidden" class="form-control" id="city1" placeholder="Hyderabad">
                                </div> 
                                <div class="input-group comment mt-3">
                                <!-- <label class="form_label">Write your message</label> -->
                                    <textarea name="message" class="form-control" aria-label="With textarea" id="message1" maxlength="500" placeholder="<?php echo get_phrase('Write your message'); ?>"></textarea>
                                </div>
                                <!-- <div class="cheack-box mt-3">
                                    <div class="form-check">
                                        <input name="i_agree" class="form-check-input" type="checkbox" required value="1" id="i_agree1">
                                        <label class="form-check-label" for="i_agree"> 
                                            <p><?php echo get_phrase('I agree that my submitted data is being collected and stored.'); ?></p>
                                        </label>
                                    </div>                                  
                                </div> -->
                                <?php if(get_frontend_settings('recaptcha_status')): ?>
                                    <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                                <?php endif; ?>
                                <div class="form-btn">
                                    <button type="submit" class="btn btn-primary col-12"><?php echo get_phrase('Submit'); ?></button>
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
    const contactModal1 = document.getElementById('contactModal1');
    const openModalBtn2 = document.getElementById('openModalBtn2');
    openModalBtn2.addEventListener('click', function() {
        contactModal1.style.display = 'block';
        localStorage.setItem('clickFrom', 'video');
    });

    const closeModal1 = document.getElementById('closeModal1');
    closeModal1.addEventListener('click', function() {
        contactModal1.style.display = 'none';
        let contactPopUpClosed = localStorage.getItem("contactPopUpClosed") ? parseInt(localStorage.getItem("contactPopUpClosed")) : 0;
        contactPopUpClosed += 1;
        localStorage.setItem("contactPopUpClosed", contactPopUpClosed)

    });

    function contactFormSubmit1(){
        var full_number = phoneInput1.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone'").val(full_number);
        var $inputs = $('#contactForm1 :input');

        const first_name = document.getElementById('first_name1').value.trim();
        const last_name = document.getElementById('last_name1').value.trim();
        const email = document.getElementById('email1').value.trim();
        const phone = document.getElementById('phone1').value.trim();
        const city = document.getElementById('city1').value.trim();
        const message = document.getElementById('message1').value.trim();
        const course = document.getElementById('course1').value.trim();
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
            //alert( xhr.responseText);
            if( xhr.responseText == 'Thank You For Contacting Us.'){
                // Optionally, reset the form after successful submission
                $('#contactForm1')[0].reset();
                contactModal1.style.display = 'none';
                localStorage.setItem("dataSubmitted", true);
                window.location.href = "<?php echo site_url('thankyou'); ?>";
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

    const phoneInputField1 = document.querySelector("#phone1");
    const phoneInput1 = window.intlTelInput(phoneInputField1, {
        preferredCountries:["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    $("form").submit(function() {
        var full_number = phoneInput1.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone'").val(full_number);
        
        });

        

</script>