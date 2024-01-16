<!---------- Header Section start  ---------->
<?php $cart_items = $this->session->userdata('cart_items'); ?>
<?php $user_id = $this->session->userdata('user_id'); ?>
<?php $user_login = $this->session->userdata('user_login'); ?>
<?php $admin_login = $this->session->userdata('admin_login'); ?>
<?php if($user_id > 0){$user_details = $this->user_model->get_all_user($user_id)->row_array();} ?>
<div class="sub-header py-0" style="position: fixed; width:100%; z-index: 2;">
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

        <!-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 blink2">
        <a class="btn btn-primary text-14px py-1 mt-2" href="#" id="openModalBtn">
                                                        <?php echo get_phrase('Enquire Now'); ?>
                                                    </a>
        </div> -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="icon right-icon">
            <?php $facebook = get_frontend_settings('facebook'); ?>
            <?php $twitter = get_frontend_settings('twitter'); ?>
            <?php $linkedin = get_frontend_settings('linkedin'); ?>
            <ul class="nav justify-content-end">

            <li class="nav-item align-items-center d-flex blink2">
              <a class="btn btn-primary text-14px py-1 mt-2" href="#" id="openModalBtn2">
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
              <a class="btn btn-primary text-14px py-1 mt-2" href="#" id="openModalBtn">
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
	</style>
  <?php include "enquire_now.php" ?>