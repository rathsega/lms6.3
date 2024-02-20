<div class="row">
    <div class="col-lg-9 col-md-8">
        <div class="cart-table">
            <div class="cart-heading-text">
                <h3><?php echo get_phrase('Your Cart Items') ?></h3>
            </div>
            <div class="cart-scroll-bar">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p><?php echo get_phrase('Items') ?></p>
                            </th>
                            <th scope="col">
                                <p class="text-start"><?php echo get_phrase('Price') ?></p>
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($this->session->userdata('cart_items') as $item) : ?>
                            <?php $course_details = $this->crud_model->get_course_by_id($item)->row_array();
                            if ($course_details['slug_count'] == 1 || $course_details['slug_count'] == 2) {
                                $course_details_slug = $course_details['slug'];
                            } else if ($course_details['slug_count'] == 3 || $course_details['slug_count'] == 4) {
                                $course_details_slug = $course_details['category_slug'] . '/' . $course_details['sub_category_slug'] . '/' . $course_details['slug'];
                            } else {
                                $course_details_slug = $course_details['slug'];
                            }
                            ?>
                            <tr>
                                <td>
                                    <div class="cart-table-image">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>">
                                        <a href="<?php echo site_url($course_details_slug) ?>">
                                            <h5 class="my-1"><?php echo $course_details['title']; ?></h5>
                                            <p class="ellipsis-line-2"><?php echo $course_details['short_description']; ?></p>
                                        </a>
                                    </div>
                                </td>
                                <td class="d-flex">
                                    <?php if ($course_details['is_free_course']) : ?>
                                        <h4><?php echo get_phrase('Free'); ?></h4>
                                    <?php elseif ($course_details['discount_flag']) : ?>
                                        <?php $total += $course_details['discounted_price']; ?>
                                        <h4><?php echo currency($course_details['discounted_price']); ?></h4>
                                        <h6 class="mt-2 ms-2"><del><?php echo currency($course_details['price']); ?></del></h6>
                                    <?php else : ?>
                                        <?php $total += $course_details['price']; ?>
                                        <h4><?php echo currency($course_details['price']); ?></h4>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a class="ms-auto" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>');"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="cart-total">
            <h4><?php echo get_phrase('Total'); ?></h4>
            <?php if (isset($coupon_code) && !empty($coupon_code)) : ?>
                <?php if ($this->crud_model->check_coupon_validity($coupon_code)) : ?>
                    <?php $coupon_details = $this->crud_model->get_coupon_details_by_code($coupon_code)->row_array(); ?>
                    <?php $coupon_discounted_price = ($total * $coupon_details['discount_percentage']) / 100; ?>

                    <div class="alert alert-success text-13px text-center py-2" role="alert">
                        <?php echo get_phrase('You received') . ' ' . currency($coupon_discounted_price) . ' (' . $coupon_details['discount_percentage']; ?>%) <?php echo site_phrase('coupon discount'); ?>
                    </div>
                    <?php
                    $total = $total - $coupon_discounted_price;
                    $total = ($total > 0) ? $total : 0;
                    $this->session->set_userdata('applied_coupon', $coupon_code);
                    ?>
                <?php else : ?>
                    <div class="alert alert-danger text-13px text-center py-2" role="alert">
                        <?php echo get_phrase('Your coupon code has expired'); ?>
                        <?php $this->session->set_userdata('applied_coupon', null); ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <?php $this->session->set_userdata('applied_coupon', null); ?>
            <?php endif; ?>

            <div class="tax">
                <h6><?php echo get_phrase('Subtotal') ?></h6>
                <h6><?php echo currency($total); ?></h6>
            </div>

            <?php if (get_settings('course_selling_tax') > 0 && isset($_COOKIE["countryName"]) && $_COOKIE["countryName"] == 'India') : ?>
                <div class="tax">
                    <?php
                    $tax = round(($total / 100) * get_settings('course_selling_tax'), 2);
                    $total = round($total + ($total / 100) * get_settings('course_selling_tax'), 2);
                    ?>
                    <h6><?php echo 'CGST' . ' <small class="fw-400">(' . (get_settings('course_selling_tax') / 2) . '%)</small>' ?></h6>
                    <h6><?php echo currency($tax / 2); ?></h6>
                </div>
                <div class="sub-total">
                    <h6><?php echo 'SGST' . ' <small class="fw-400">(' . (get_settings('course_selling_tax') / 2) . '%)</small>' ?></h6>
                    <h6><?php echo currency($tax / 2); ?></h6>
                </div>
            <?php endif; ?>
            <div class="tax">
                <?php $this->session->set_userdata('total_price_of_checking_out', $total); ?>
                <h6><?php echo get_phrase('Total') ?></h6>
                <h6><?php echo currency($total); ?></h6>
            </div>
            <?php $actcive_coupons = $this->crud_model->get_active_coupons(); ?>
            <?php if ($actcive_coupons > 0) : ?>
                <form class="ajaxForm" action="<?php echo site_url('home/apply_coupon') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="coupon_code" class="form-control text-14px" placeholder="<?php echo site_phrase('Apply coupon'); ?>" aria-label="<?php echo site_phrase('Apply coupon'); ?>">
                        <button class="btn-primary btn-primary text-white px-2 py-2 radius-end-8 text-14px" type="submit"><?php echo get_phrase('Apply') ?></button>
                    </div>
                </form>
            <?php endif; ?>

            <?php if (isset($coupon_code) && !empty($coupon_code) && isset($coupon_details) && $coupon_details['discount_percentage'] == 100 && $total == 0 && $coupon_details['expiry_date'] >= time()) : ?>
                <a href="<?php echo site_url('home/coupon_offer_100_percent'); ?>" class="btn btn-primary px-2 w-100"><?php echo get_phrase('Enroll Now') ?></a>
            <?php else : ?>
                <form action="<?php echo site_url('home/course_payment') ?>" method="post">
                    <div class="input-group mb-1">
                        <input type="checkbox" id="is_gift" name="is_gift" onchange="
                            if ($(this).prop('checked')==true){ 
                                $('#gift_email_section').removeClass('d-hidden');
                            }else{
                                $('#gift_email_section').addClass('d-hidden');
                            }
                            if ($('#gift_email').prop('required')) {
                                $('#gift_email').prop('required', false);
                            } else {
                                $('#gift_email').prop('required', true);
                            }" value="1" <?php if (isset($_GET['gift'])) echo 'checked'; ?>>
                        <label for="is_gift" class="ms-2 text-14px"><?php echo get_phrase('Send as a gift') ?></label>
                    </div>
                    <div id="gift_email_section" class="<?php if (isset($_GET['gift'])) : else : echo 'd-hidden';
                                                        endif; ?>">
                        <div class="input-group mb-0">
                            <input type="email" name="gift_email" id="gift_email" class="form-control text-14px py-2 w-100" onkeyup="check_gift_user(this)" placeholder="<?php echo site_phrase('Email address'); ?>" <?php if (isset($_GET['gift'])) echo 'required'; ?>>
                        </div>
                        <span id="check_gift_user_message" class="text-12px"></span>
                    </div>
                    <div class="cart-total-btn mt-3">
                        <button id="payment-button" type="submit" class="btn btn-primary px-2 w-100"><?php echo get_phrase('Continue to Payment') ?></button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    var timer = 0;

    function check_gift_user(e) {
        $('#payment-button').attr('disabled', true);
        $('#check_gift_user_message').html('<?php echo get_phrase('Searching'); ?>...');
        var gift_email = $(e).val().replace(/\s/g, '');

        clearTimeout(timer);
        timer = setTimeout(function() {
            actionTo('<?php echo site_url('home/check_gift_user?gift_email='); ?>' + gift_email, 'post');
            $(e).val(gift_email);
            $('#payment-button').attr('disabled', false);
        }, 2000);
    }

    function getCookie(name) {
        let cookie = {};
        console.log(document.cookie);
        document.cookie.split(';').forEach(function(el) {
            let split = el.split('=');
            cookie[split[0].trim()] = split.slice(1).join("=");
        })
        return cookie[name];
    }

    window.onload = function() {
        let continuePaymentButton = document.getElementById("payment-button");
        if (!getCookie('countryName')) {
            continuePaymentButton.style.display = 'none';
            if (confirm("Please provide location access for proceed further.")) {
                getLocation();
            } else {
                continuePaymentButton.style.display = 'none';
            }
        }else{
            continuePaymentButton.style.display = 'block';
        }
    };



    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback, options);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        // You can do something with the latitude and longitude here
        console.log("Latitude: " + latitude + " Longitude: " + longitude);
        displayLocation(latitude, longitude);
    }

    function displayLocation(latitude, longitude) {
        var request = new XMLHttpRequest();
        console.log("Latitude: " + latitude + " Longitude: " + longitude);
        var method = 'GET';
        var url = 'https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=' + latitude + '&longitude=' + longitude + '&localityLanguage=en';
        var async = true;

        request.open(method, url, async);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                console.log(data);
                //document.write(address.formatted_address);
                document.cookie = "city = " + data.city + "; path=/";
                document.cookie = "countryName = " + data.countryName + "; path=/";
                location.reload();
                return {
                    "city": data.city,
                    contryName: data.countryName
                };
            }
        };
        request.send();
    };

    var successCallback = function(position) {
        var x = position.coords.latitude;
        var y = position.coords.longitude;
        displayLocation(x, y);
    };

    var errorCallback = function(error) {
        var errorMessage = 'Unknown error';
        switch (error.code) {
            case 1:
                errorMessage = 'Permission denied';
                break;
            case 2:
                errorMessage = 'Position unavailable';
                break;
            case 3:
                errorMessage = 'Timeout';
                break;
        }
        //document.write(errorMessage);
    };

    var options = {
        enableHighAccuracy: true,
        timeout: 1000,
        maximumAge: 0
    };
</script>

<?php include "init.php"; ?>