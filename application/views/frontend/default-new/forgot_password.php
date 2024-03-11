<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-xv4fTQPh9MlW7xjFO5FxuLgtQGg4ggzgGVkNqI8KDkQQUpVTl8r+pp9y9aX4ScWH" crossorigin="anonymous"></script> -->


<?php if (get_frontend_settings('recaptcha_status')) : ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<style>
    .btn-close {
        width: 2em;
    height: 2em;
    padding: 1.2em 1.2em;
    margin-left: 136px !important;
    }
    .toast-header{
        margin-bottom: -32px;
        padding-left: 23px;

    } 
    .timmer-img {
    height:60px;
    animation: moveUpDown 2s ease-in-out infinite alternate; /* Adjust the duration and timing function as needed */
}

@keyframes moveUpDown {
    0% {
        transform: translateY(0);
    }

    100% {
        transform: translateY(-10px); /* Adjust the vertical movement distance as needed */
    }
}
    .toast-body{
        padding: 16px;
    }
    .toast-box{
    border-radius: 10px;
    box-shadow: 0 0 10px rgb(0 0 0 / 41%);
    width: 55%;
    }
    #loadingProgress {
        width: 100%;
    background-color: #ddd;
    height: 4px;
    margin-bottom: 8px;
    margin-top: -16px;
}

#loadingBar {
  width: 1%;
  height: 4px;
  background-color: #754ffe;
}
</style>
<!---------- Header Section End  ---------->
<section class="sign-up my-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12 col-12 text-center ">
                <img width="65%" src="<?php echo site_url('assets/frontend/default-new/image/cloud-security.gif') ?>">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 col-12 ">
                <div class="sing-up-right">
                    <h3><?php echo get_phrase('Forgot password'); ?><span>!</span></h3>
                    <p><?php echo get_phrase('Explore, learn, and grow with us. Enjoy a seamless and enriching educational journey. Lets begin!') ?></p>

                    <form action="<?php echo site_url('login/forgot_password/frontend'); ?>" method="post">
                        <div class="mb-3">
                            <h5><?php echo get_phrase('Your email'); ?></h5>
                            <div class="position-relative">
                                <i class="fa-solid fa-user"></i>
                                <input class="form-control" id="forgot_email" type="email" name="email" required placeholder="<?php echo get_phrase('Enter your email'); ?>">
                            </div>
                        </div>
                        <?php if (get_frontend_settings('recaptcha_status')) : ?>
                            <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                        <?php endif; ?>
                        <div class="log-in">
                            <button type="submit" onclick="showToast()" class="btn btn-primary">
                                <?php echo get_phrase('Send Request') ?>
                            </button>
                        </div>

                    </form>

                    <!-- Toast Container -->
                    <div class="position-fixed top-50 start-50 translate-middle " style="z-index: 9999; width: 65%; margin-left: 17%;">
                        <div id="mail_timer" class=" bg-white toast-box " role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <h6 class="text-center fw-bold" style="color:#754ffe;" >We are sending  you an email</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <hr>
                            <!-- <div id="loadingProgress">
                                <div id="loadingBar"></div>
                            </div> -->
                            <!-- <button onclick="move()">Move it</button>  -->
                            <div class="toast-body ">
                            <div class="d-flex flex-column align-items-center">
                            <img src="https://res.cloudinary.com/dc2uykpox/image/upload/v1710156850/Group_1000002114_naekcf.png" alt="" class="timmer-img">
                            <p class="text-center pt-3" style="color:black;">Please check your email after <span id="timer">01:30</span> Minutes to get your reset password link. <span class="text-success fw-bold">Give it few minutes, and don't forget to check your spam folder</span></p>
                             <p class="text-center">Didn't receive the email?<br><a href="http://localhost/lms/home/contact_us">Contact Techleads IT support</a></p>
                              
                            </div>
                                <!-- <div class="spinner-grow" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> -->
                                <!-- <img src="https://res.cloudinary.com/dc2uykpox/image/upload/v1709712486/Search_1_zlg5v4.png" alt="" class="vect-img float-right"> -->

                            </div>
                        </div>
                    </div>
                    <div class="log-in">
                        <a href="<?php echo site_url('login') ?>" class="btn btn-primary my-0">
                            <span class="fas fa-angle-left"></span>
                            <?php echo get_phrase('Back to login') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .vect-img {
        height: 120px;
    }
</style>
<script>
    
    function showToast() {
        if(document.getElementById("forgot_email").value){
            var toastElement = document.getElementById('mail_timer');
            $('#mail_timer').show();
            var twoMinutes = 60 * 1.5,
            display = document.querySelector('#timer');
            startTimer(twoMinutes, display);
        }
        
    }

    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                $('#mail_timer').hide();
                timer = duration;
            }
        }, 1000);
    }

</script>
<script>
var i = 0;
function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("loadingBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
      } else {
        width++;
        elem.style.width = width + "%";
      }
    }
  }
}
</script>