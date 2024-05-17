<!--------- footer Section Start--------------->
<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-12 mb-5">
                <img src="<?php echo base_url('uploads/system/'.get_frontend_settings('light_logo')); ?>">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 lattest-news">
                    <h1><?php echo get_phrase('Subscribe to our Newsletter'); ?></h1>
                    <form class="ajaxForm resetable" action="<?php echo site_url('home/subscribe_to_our_newsletter'); ?>" method="post">
                        <input type="email" class="form-control" id="subscribe_email" placeholder="<?php echo get_phrase('Enter your email address'); ?>" name="email">
                        <button class="form-arrow" type="submit" aria-label="Subscribe to our Newsletter"><i class="fa-solid fa-arrow-right-long"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-4 mb-5">
                <h1><?php echo site_phrase('top_categories'); ?></h1>
                <ul>
                <?php $top_10_categories = $this->crud_model->get_top_categories(6, 'sub_category_id'); ?>
                <?php foreach($top_10_categories as $top_10_category): ?>
                  <?php $category_details = $this->crud_model->get_category_details_by_id($top_10_category['sub_category_id'])->row_array(); ?>
                    <li><a href="<?php echo site_url('home/courses?category='.$category_details['slug']); ?>"> <?php echo $category_details['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                <h1><?php echo site_phrase('useful_links'); ?></h1>
                <ul>
                    <?php if (get_settings('allow_instructor') == 1) : ?>
                        <li> <a href="<?php echo site_url('home/become_an_instructor'); ?>"><?php echo site_phrase('Become an instructor'); ?></a></li>
                    <?php endif; ?>
                    <li> <a href="<?php echo site_url('blog'); ?>"><?php echo site_phrase('blog'); ?></a></li>
                    <li><a href="<?php echo site_url('home/courses'); ?>"><?php echo site_phrase('all_courses'); ?></a></li>
                    <li><a href="<?php echo site_url('sign_up'); ?>"><?php echo site_phrase('sign_up'); ?></a></li>
                    <?php $custom_page_menus = $this->crud_model->get_custom_pages('', 'footer'); ?>
                    <?php foreach($custom_page_menus->result_array() as $custom_page_menu): ?>
                      <li><a href="<?php echo site_url('page/'.$custom_page_menu['page_url']); ?>"><?php echo $custom_page_menu['button_title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                <h1><?php echo site_phrase('help'); ?></h1>
                <ul>
                    <li><a href="<?php echo site_url('home/contact_us'); ?>"><?php echo site_phrase('contact_us'); ?></a></li>
                    <li><a href="<?php echo site_url('home/about_us'); ?>"><?php echo site_phrase('about_us'); ?></a></li>
                    <li><a href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo site_phrase('privacy_policy'); ?></a></li>
                    <li><a href="<?php echo site_url('home/terms_and_condition'); ?>"><?php echo site_phrase('terms_and_condition'); ?></a></li>
                    <li><a href="<?php echo site_url('home/refund_policy'); ?>"><?php echo site_phrase('refund_policy'); ?></a></li>
                </ul>
            </div>
        </div>
        <div class="lattest-news">
            <div class="row">
               <div class="col-lg-4 col-md-6 col-sm-12 com-12">
                <!-- TrustBox widget - Review Collector -->
<div class="trustpilot-widget" data-locale="en-US" data-template-id="56278e9abfbbba0bdcd568bc" data-businessunit-id="65eae6a9fca37546b09273d9" data-style-height="52px" data-style-width="100%">
  <a href="https://www.trustpilot.com/review/techleadsit.com" target="_blank" rel="noopener">Trustpilot</a>
</div>
<!-- End TrustBox widget -->
               </div>
                
                <div class="col-lg-8 col-md-6  col-sm-12 col-12">
                    <div class="icon right-icon">
                        <ul class="nav justify-content-end">
                          <li class="nav-item">
                            <a target="_blank" href="<?php echo get_settings('footer_link'); ?>">
                              <?php echo site_phrase(get_settings('footer_text')); ?>
                            </a>
                          </li>
                        </ul>
                    </div>  
                              
                </div>
            </div>
        </div>
    </div>
</section>
<!--------- footer Section End--------------->

<!-- PAYMENT MODAL -->
<!-- Modal -->
<?php
$paypal_info = json_decode(get_settings('paypal'), true);
$stripe_info = json_decode(get_settings('stripe_keys'), true);
if ($paypal_info[0]['active'] == 0) {
  $paypal_status = 'disabled';
}else {
  $paypal_status = '';
}
if ($stripe_info[0]['active'] == 0) {
  $stripe_status = 'disabled';
}else {
  $stripe_status = '';
}
?>

<?php include "move_to_top.php"; ?>

<div class="container">
  <div class="row">
    <!-- Form -->
    <div class="nb-form">
      <!-- <p class="title title-mess">S</p> -->
      <div class="user-container">
      <img src="<?php echo base_url() . "assets/frontend/default-new/image/message-widget.png"; ?>"  class="user-icon" id="userIcon">
      </div>
      <form action="javascript:void(0);" onsubmit="footerContactFormSubmit()" name="footerContactForm" id="footerContactForm">
        <input type="text" name="cpname" id="footerCFName" placeholder="Name:" required>
        <input type="email" name="cpemail" id="footerCFEmail" placeholder="Email:" required>
        <input type="tel" name="cpphone" id="footerCFPhone" placeholder="Phone:" required>
        <textarea name="cpmessage" id="footerCFMessage" placeholder="Message:" required></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>
<style>
/*.rotate-on-hover:click {
  transform: rotate(180deg); 
  transition: transform 0.3s ease; 
}*/
</style>

<script>

(function (w, d, s, u) {
        w.gbwawc = {
            url: u,
            options: {
                waId: "918886252627",
                siteName: "Tech Leads IT",
                siteTag: "Online",
                siteLogo: "https://files.gallabox.com/65261c5bc8129752ae1df6dd/a849b8a7-83b1-4e83-bbe3-bfd6ba30caa5-TechLeadsITIcon.png",
                widgetPosition: "LEFT",
                welcomeMessage: "Welcome to Tech Leads IT!!!",
                brandColor: "#25D366",
                messageText: "How can I help you?",
                replyOptions: [],
            },
        };
        var h = d.getElementsByTagName(s)[0],
            j = d.createElement(s);
        j.async = true;
        j.src = u + "/whatsapp-widget.min.js?_=" + Math.random();
        h.parentNode.insertBefore(j, h);
    })(window, document, "script", "https://waw.gallabox.com");
    
    </script>

    <script>
        $(".user-icon").click(function(){
            if($('.nb-form').css("bottom") == "0px"){
                $('.nb-form').css("bottom", "-335px");
            }else{
                $('.nb-form').css("bottom", "0px");
            }
        });

        setInterval(function(){
            if(!localStorage.getItem("dataSubmitted")){
                $('.nb-form').css("bottom", "0px");
            }
        },120000)

        function footerContactFormSubmit(){
            var full_number = CFPhoneInputField.getNumber(intlTelInputUtils.numberFormat.E164);
            $("input[name='cpphone'").val(full_number);
            var $inputs = $('#footerContactForm :input');

            const name = document.getElementById('footerCFName').value.trim();
            const email = document.getElementById('footerCFEmail').value.trim();
            const phone = document.getElementById('footerCFPhone').value.trim();
            const message = document.getElementById('footerCFMessage').value.trim();

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
                message: message,
            };
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the request (GET method, URL)
            xhr.open('POST', '<?php echo site_url('home/footer_contactus_submitted'); ?>', true);

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
                first_name: name,
                last_name: name,
                email: email,
                phone: phone,
                city: ""
            }));
            var jsonData = serialize(formData);

            // Set up a function to handle the response
            xhr.onload = function() {
            if (xhr.status === 200) {
                // Request was successful
                alert( xhr.responseText);
                if( xhr.responseText == 'Thank You For Contacting Us.'){
                    // Optionally, reset the form after successful submission
                    $('#footerContactForm')[0].reset();
                    localStorage.setItem("dataSubmitted", true);
                    $('.nb-form').css("bottom", "-335px");
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

    const footerCFPhoneInputField = document.querySelector("#footerCFPhone");
    const CFPhoneInputField = window.intlTelInput(footerCFPhoneInputField, {
        preferredCountries:["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    $("form").submit(function() {
        var full_number = CFPhoneInputField.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='cpphone'").val(full_number);
        
        });

        $(document).ready(function(){
            let details_submitted = localStorage.getItem('dataSubmitted');
            let user_id = "<?php echo $this->session->userdata('user_id'); ?>";
            let contactPopUpClosed = localStorage.getItem("contactPopUpClosed") ? parseInt(localStorage.getItem("contactPopUpClosed")) : 0;
            if(details_submitted != "true" && !user_id && contactPopUpClosed < 2){
                setTimeout(()=>{
                    if((details_submitted != "true" && !user_id) && contactPopUpClosed < 2 ){
                       var curr_url = window.location.href;
                       if(!curr_url.includes('forgot_password_request') && !curr_url.includes('login')  && !curr_url.includes('sign_up')){
                                openModalBtn2.click();
                        }
                    }
                }, 10000)
            } // 10000 to load it after 10 seconds from page load
        });
    </script>


