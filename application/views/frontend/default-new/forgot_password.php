<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-xv4fTQPh9MlW7xjFO5FxuLgtQGg4ggzgGVkNqI8KDkQQUpVTl8r+pp9y9aX4ScWH" crossorigin="anonymous"></script> -->


<?php if (get_frontend_settings('recaptcha_status')) : ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

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
                    <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 9999">
                        <div id="mail_timer" class="toast hide bg-white" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Please Wait</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body ">

                                Your request is in process. Please wait <span id="timer">01:30</span> Minutes.
                                <div class="spinner-grow" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <img src="https://res.cloudinary.com/dc2uykpox/image/upload/v1709712486/Search_1_zlg5v4.png" alt="" class="vect-img float-right">

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