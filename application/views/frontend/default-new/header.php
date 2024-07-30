<!---------- Header Section start  ---------->
<?php $cart_items = $this->session->userdata('cart_items'); ?>
<?php $user_id = $this->session->userdata('user_id'); ?>
<?php $user_login = $this->session->userdata('user_login'); ?>
<?php $admin_login = $this->session->userdata('admin_login'); ?>
<?php if ($user_id > 0) {
  $user_details = $this->user_model->get_all_user($user_id)->row_array();
} ?>
<div class="sub-header py-0" style="position: fixed; width:100%; z-index: 999;">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">
        <div class="icon icon-left">
          <ul class="nav">
            <li class="nav-item px-2">
              <a href="tel:<?php echo get_settings('phone'); ?>"><i class="fa-solid fa-phone"></i> <?php echo get_settings('phone'); ?></a>
            </li>
            <div class="vartical"></div>
            <li class="nav-item px-2">
              <a href="mailto:<?php echo get_settings('system_email'); ?>"><i class="fas fa-envelope"></i> <?php echo get_settings('system_email'); ?></a>
            </li>

            </li>
          </ul>
        </div>
      </div>

      <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 iso_mark_desktop">
        <div class="icon right-icon">
          <ul class="nav justify-content-end mt-1">
            <li class="nav-item">
            <img src="<?php echo base_url() . "assets/frontend/default-new/image/iso_logomark_2.png"; ?>" alt="" class="iso_mark">
            </li>

          </ul>
        </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <div class="icon right-icon mb-1">
          <ul class="nav justify-content-end mt-1">
            <li class="nav-item blink2">
              <a class="btn btn-primary text-14px py-1" href="#" id="openModalBtn2" style="color:white;">
                <?php echo get_phrase('Enquire Now'); ?>
              </a>
            </li>

            <li class="nav-item ms-3">
              <a class="btn btn-primary text-14px py-1" href="<?php echo base_url("home/jobs_list"); ?>" style="color:white;">
                <?php echo get_phrase('Careers'); ?>
              </a>
            </li>
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

  .fa-x-twitter:before {
    content: "\e61b";
  }

  .iso_mark {
    height: 32px;
  }

  .iso_mark_mbl {
    display: none;
  }

  .iso_mark_desktop {
    display: block;
  }

  .email-ip {
    margin-top: 1px !important;
  }

  .iti--allow-dropdown input,
  .iti--allow-dropdown input[type=text],
  .iti--allow-dropdown input[type=tel],
  .iti--separate-dial-code input,
  .iti--separate-dial-code input[type=text],
  .iti--separate-dial-code input[type=tel] {
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
    border-radius: 5px;
    box-shadow: 0 0 10px rgb(0 0 0 / 41%);
  }

  .forms-ips {
    padding: 7px 26px 16px 26px;
    width: 44%;
  }

  /* .header-card{
  p{
    font-size:13px;
    line-height:16px;
  }
} */
  input,
  textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #0000007d;
    border-radius: 4px;
    margin-top: 20px;
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

  input,
  textarea {

    margin-top: 0px;
  }

  .button-sub {
    background-color: #754ffe;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  /* button:hover {
    background-color: #45a049;
  } */
  @media screen and (max-width: 767px) {
    .form-container {
      width: 290px !important;
      margin-left: -133px;
    }

    .forms-ips {
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

    .iso_mark {
      height: 34px;
      width: 99px;
    }

    .iso_mark_mbl {
      display: block;
    }

    .iso_mark_desktop {
      display: none;
    }
  }



  @media screen and (min-width: 820px) and (max-width: 1180px) {

    .menubar {
      margin-top: 40px;
    }
  }

  @media screen and (min-width: 768px) and (max-width: 1024px) {

    .menubar {
      margin-top: 40px;
    }
  }


</style>
<?php include "enquire_now.php" ?>
<?php //include "feedback.php" 
?>
<script>
  function openFeedbackForm() {
    document.getElementById("feedbackForm").style.display = "block";
  }

  function closeFeedbackForm() {
    document.getElementById("feedbackForm").style.display = "none";
  }
</script>