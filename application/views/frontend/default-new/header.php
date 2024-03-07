<!---------- Header Section start  ---------->
<?php $cart_items = $this->session->userdata('cart_items'); ?>
<?php $user_id = $this->session->userdata('user_id'); ?>
<?php $user_login = $this->session->userdata('user_login'); ?>
<?php $admin_login = $this->session->userdata('admin_login'); ?>
<?php if($user_id > 0){$user_details = $this->user_model->get_all_user($user_id)->row_array();} ?>
<div class="sub-header py-0" style="position: fixed; width:100%; z-index: 999;">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
          <div class="icon icon-left">
            <ul class="nav">
              <li class="nav-item px-2">
                <a href="tel:<?php echo get_settings('phone'); ?>"><i class="fa-solid fa-phone"></i> <?php echo get_settings('phone'); ?></a>
              </li>
              <div class="vartical"></div>
              <li class="nav-item px-2">
                <a href="mailto:<?php echo get_settings('system_email'); ?>"><i class="fas fa-envelope"></i> <?php echo get_settings('system_email'); ?></a>
              </li>
              <button class="feedback-btn" id="feedback_form_button" onclick="openFeedbackForm()">Feedback</button>

                
              <li class="pt-2 px-2">
                <a href=""><img src='https://res.cloudinary.com/dc2uykpox/image/upload/v1706501405/Group_1000001779_tstmkl.png' alt="" class="isomark"></a>
                <!-- assets/frontend/default-new/image/ISOmark.png -->
              </li>
            </ul>
          </div>
        </div>

        
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
          <div class="icon right-icon">
            <?php $facebook = get_frontend_settings('facebook'); ?>
            <?php $twitter = get_frontend_settings('twitter'); ?>
            <?php $linkedin = get_frontend_settings('linkedin'); ?>
            <ul class="nav justify-content-end">

            <li class="nav-item align-items-center d-flex blink2">
              <a class="btn btn-primary text-14px py-1 enquire-mbl" href="#" id="openModalBtn2" style="color:white;">
                                                        <?php echo get_phrase('Enquire Now'); ?>
                                                    </a>
              </li>

            <a href="#" class="invisible" onclick="actionTo('<?php echo site_url('home/dark_and_light_mode') ?>')"><i class="fas fa-moon"></i></a>

              <?php if($facebook): ?>
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $facebook; ?>"><i class="fa-brands fa-facebook-f"></i></a>
                </li>
              <?php endif; ?>
              <?php if($twitter): ?>
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $twitter; ?>"><i class="fa-brands fa-twitter"></i></a>
                </li>
              <?php endif; ?>
              <?php if($linkedin): ?>
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $linkedin; ?>"><i class="fa-brands fa-linkedin"></i></a>
                </li>
              <?php endif; ?>


              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
<header>
  <!-- Sub Header Start -->
  <div class="sub-header py-0">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="icon icon-left">
            <ul class="nav">
              <li class="nav-item px-2">
                <a href="tel:<?php echo get_settings('phone'); ?>"><i class="fa-solid fa-phone"></i> <?php echo get_settings('phone'); ?></a>
              </li>
              <div class="vartical"></div>
              <li class="nav-item px-2">
                <a href="mailto:<?php echo get_settings('system_email'); ?>"><i class="fas fa-envelope"></i> <?php echo get_settings('system_email'); ?></a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="icon right-icon">
            <?php $facebook = get_frontend_settings('facebook'); ?>
            <?php $twitter = get_frontend_settings('twitter'); ?>
            <?php $linkedin = get_frontend_settings('linkedin'); ?>
            <ul class="nav justify-content-end">
            <li class="nav-item align-items-center d-flex blink2">
              <a class="btn btn-primary text-14px py-1 " href="#" id="openModalBtn2">
                                                        <?php echo get_phrase('Enquire Now'); ?>
                                                    </a>
              </li>

            <a href="#" class="invisible" onclick="actionTo('<?php echo site_url('home/dark_and_light_mode') ?>')"><i class="fas fa-moon"></i></a>

              <?php if($facebook): ?>
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $facebook; ?>"><i class="fa-brands fa-facebook-f"></i></a>
                </li>
              <?php endif; ?>
              <?php if($twitter): ?>
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $twitter; ?>"><i class="fa-brands fa-twitter"></i></a>
                </li>
              <?php endif; ?>
              <?php if($linkedin): ?>
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $linkedin; ?>"><i class="fa-brands fa-linkedin"></i></a>
                </li>
              <?php endif; ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---- Sub Header End ------>
  
  <section class="menubar">
    <?php include "header_lg_device.php"; ?>
    <!-- Offcanves Menu  -->
    <?php include "header_sm_device.php"; ?>
  </section>
</header>
<!---------- Header Section End  ---------->
<style>
	    html {
          touch-action: manipulation;
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
  <?php include "enquire_now.php" ?>
  <?php include "feedback.php" ?>
  <script>
    function openFeedbackForm() {
        document.getElementById("feedbackForm").style.display = "block";
    }

    function closeFeedbackForm() {
        document.getElementById("feedbackForm").style.display = "none";
    }
  </script>