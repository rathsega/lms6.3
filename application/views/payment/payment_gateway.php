<style>
	body {
		padding-top: 50px;
		padding-bottom: 50px;
	}

	.payment-header-text {
		font-size: 23px;

	}

	.close-btn-light {
		padding-left: 10px;
		padding-right: 10px;
		height: 35px;
		line-height: 35px;
		text-align: center;
		font-size: 25px;
		background-color: #F1EAE9;
		color: #a45e72;
		border-radius: 5px;
	}

	.close-btn-light:hover {
		padding-left: 10px;
		padding-right: 10px;
		height: 35px;
		line-height: 35px;
		text-align: center;
		font-size: 25px;
		background-color: #a45e72;
		color: #FFFFFF;
		border-radius: 5px;
	}

	.payment-header {
		font-size: 14px;
	}

	.item {
		width: 100%;
		height: 50px;
		display: block;
	}

	.count-item {
		padding-left: 13px;
		padding-right: 13px;
		padding-top: 5px;
		padding-bottom: 5px;

		margin-bottom: 100%;
		margin-right: 18px;
		margin-top: 8px;

		color: #00B491;
		background-color: #DEF6F3;
		border-radius: 5px;
		float: left;
	}

	.item-title {
		font-weight: bold;
		font-size: 13.5px;
		display: block;
		margin-top: 6px;
	}

	.item-price {
		float: right;
		color: #00B491;
	}

	.by-owner {
		font-size: 11px;
		color: #76767E;
		display: block;
		margin-top: -3px;
	}

	.total {
		border-radius: 8px 0px 0px 8px;
		background-color: #DBF3F0;
		padding: 10px;
		padding-left: 30px;
		padding-right: 30px;
		font-size: 18px;
	}

	.total-price {
		border-radius: 0px 8px 8px 0px;
		background-color: #CCD4DD;
		padding: 10px;
		padding-left: 25px;
		padding-right: 25px;
		font-size: 18px;
	}

	.indicated-price {
		padding-bottom: 20px;
		margin-bottom: 0px;
	}

	.payment-button {
		background-color: #1DBDA0;
		border-radius: 8px;
		padding: 10px;
		padding-left: 30px;
		padding-right: 30px;
		color: #fff;
		border: none;
		font-size: 18px;
	}

	.payment-gateway {
		border: 2px solid #D3DCDD;
		border-radius: 5px;
		padding-top: 15px;
		padding-bottom: 15px;
		margin-bottom: 15px;
		cursor: pointer;
	}

	.payment-gateway:hover {
		border: 2px solid #00D04F;
		border-radius: 5px;
		padding-top: 15px;
		padding-bottom: 15px;
		margin-bottom: 15px;
		cursor: pointer;
	}

	.payment-gateway-icon {
		width: 80%;
		float: right;
	}

	.tick-icon {
		margin: 0px;
		padding: 0px;
		width: 15%;
		float: left;
		display: none;
	}

	.paypal-form,
	.stripe-form,
	.razorpay-form,
	.payu_latam-form {
		display: none;
	}

	@media only screen and (max-width: 600px) {

		.paypal,
		.stripe,
		.paytm,
		.paystack,
		.payumoney,
		.razorpay,
		.payu_latam {
			margin-left: 5px;
			width: 70%;
		}
	}
</style>

<?php
$paypal = json_decode(get_settings('paypal'));
$stripe = json_decode(get_settings('stripe_keys'));
$razorpay = json_decode(get_settings('razorpay_keys'));
$total_price_of_checking_out = $this->session->userdata('total_price_of_checking_out');
?>

<div class="container">
	<div class="row justify-content-center mb-5">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<span class="payment-header-text float-start"><b><?php echo get_phrase('make_payment'); ?></b></span>
					<a href="<?php echo site_url('home/shopping_cart'); ?>" class="close-btn-light float-end"><i class="fa fa-times"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-3">
					<p class="pb-2 payment-header"><?php echo get_phrase('select_payment_gateway'); ?></p>

					<?php if ($paypal[0]->active != 0) : ?>
						<div class="row payment-gateway paypal" onclick="selectedPaymentGateway('paypal')">
							<div class="col-12">
								<img class="tick-icon paypal-icon" src="<?php echo base_url('assets/payment/tick.png'); ?>">
								<img class="payment-gateway-icon" src="<?php echo base_url('assets/payment/paypal.png'); ?>">
							</div>
						</div>
					<?php endif;

					if ($stripe[0]->active != 0) : ?>
						<div class="row payment-gateway stripe" onclick="selectedPaymentGateway('stripe')">
							<div class="col-12">
								<img class="tick-icon stripe-icon" src="<?php echo base_url('assets/payment/tick.png'); ?>">
								<img class="payment-gateway-icon" src="<?php echo base_url('assets/payment/stripe.png'); ?>">
							</div>
						</div>
					<?php endif;

					if ($razorpay[0]->active != 0) : ?>
						<div class="row payment-gateway razorpay" onclick="selectedPaymentGateway('razorpay')">
							<div class="col-12 py-3px">
								<img class="tick-icon razorpay-icon" src="<?php echo base_url('assets/payment/tick.png'); ?>">
								<img class="payment-gateway-icon" src="<?php echo base_url('assets/payment/razorpay.png'); ?>">
							</div>
						</div>
					<?php endif; ?>

					<!--paystack payment gateway addon-->
					<?php
					if (addon_status('paystack') == 1) :
						include "paystack_payment_gateway.php";
					endif;
					?>

					<!--payumoney payment gateway addon-->
					<?php
					if (addon_status('payumoney') == 1) :
						include "payumoney_payment_gateway.php";
					endif;
					?>
					<!--instamojo payment gateway addon-->
					<?php
					if (addon_status('instamojo') == 1) :
						include "instamojo/instamojo_payment_gateway.php";
					endif;
					?>
					<!--pagseguro payment gateway addon-->
					<?php
					if (addon_status('pagseguro') == 1) :
						include "pagseguro/pagseguro_payment_gateway.php";
					endif;
					?>
					<!--mercadopago payment gateway addon-->
					<?php
					if (addon_status('mercadopago') == 1) :
						include "mercadopago/mercadopago_payment_gateway.php";
					endif;
					?>
					<!--ccavenue payment gateway addon-->
					<?php
					if (addon_status('ccavenue') == 1) :
						include "ccavenue/ccavenue_payment_gateway.php";
					endif;
					?>
					<!--flutterwave payment gateway addon-->
					<?php
					if (addon_status('flutterwave') == 1) :
						include "flutterwave/flutterwave_payment_gateway.php";
					endif;
					?>
					<!--paytm payment gateway addon-->
					<?php
					if (addon_status('paytm') == 1) :
						include "paytm_payment_gateway.php";
					endif;
					?>

					<!--offline payment gateway addon-->
					<?php
					if (addon_status('offline_payment') == 1) :
						include "offline_payment_gateway.php";
					endif;
					?>

					<?php
	                if (addon_status('iyzico') == 1) :
	                    include "iyzico/iyzico_payment_gateway.php";
	                endif;
	                ?>

	                <?php
	                if (addon_status('payu_latam') == 1) :
	                    include "payu_latam/payu_latam_payment_gateway.php";
	                endif;
	                ?>
				</div>

				<div class="col-md-1"></div>

				<div class="col-md-8">
					<div class="w-100 d-grid">
						<p class="pb-2 payment-header"><?php echo get_phrase('order'); ?> <?php echo get_phrase('summary'); ?></p>
						<?php $counter = 0; $actual_amount = 0; ?>
						<?php $track_data = $this->session->userdata('track'); ?>
						<?php foreach ($this->session->userdata('cart_items') as $cart_item) :
							$counter++;
							$course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
							$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array(); ?>
							    <?php $course_details['price'] = $track_data[$course_details["id"]] == "weekday" ? $course_details['price'] : $course_details["weekend_track_course_price"]; ?>
							<p class="item float-start">
								<span class="count-item"><?php echo $counter; ?></span>
								<span class="item-title"><?php echo $course_details['title']; ?>
									<span class="item-price">
										<?php if ($course_details['discount_flag'] == 1) :
											$actual_amount+=$course_details['discounted_price'];
											echo currency($course_details['discounted_price']);
										else :
											$actual_amount+=$course_details['price'];
											echo currency($course_details['price']);
										endif; ?>
									</span>
								</span> 
								<span class="by-owner">
									<?php echo get_phrase('by'); ?>
									<?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?>
								</span>
							</p>
						<?php endforeach; ?>
						<?php if(get_settings('course_selling_tax') > 0 && isset($_COOKIE["countryName"]) && $_COOKIE["countryName"] == 'India'): ?>
							<p class="item float-start">
									<span class="item-title">CGST<?php echo '<small class="fw-400">('.(get_settings('course_selling_tax')/2).'%)</small>' ?>
									
									<span class="item-price">
											<?php echo currency(($actual_amount/100)*(get_settings('course_selling_tax')/2));?>
										</span>
										</span> 
							</p>
							<p class="item float-start">
									<span class="item-title">SGST<?php echo '<small class="fw-400">('.(get_settings('course_selling_tax')/2).'%)</small>' ?>
									
									<span class="item-price">
											<?php echo currency(($actual_amount/100)*(get_settings('course_selling_tax')/2));?>
										</span>
										</span> 
							</p>
						<?php endif; ?>
					</div>
					<div class="w-100 float-start mt-4 indicated-price">
						<div class="float-end total-price"><?php echo currency($total_price_of_checking_out); ?></div>
						<div class="float-end total"><?php echo get_phrase('total'); ?></div>
					</div>
					<div class="w-100 float-start">
						<form action="<?php echo site_url('home/paypal_checkout'); ?>" method="post" class="paypal-form form">
							<hr class="border mb-4">
							<input type="hidden" name="total_price_of_checking_out" value="<?php echo $total_price_of_checking_out; ?>">
							<button type="submit" class="payment-button float-end"><?php echo get_phrase('pay_by_paypal'); ?></button>
						</form>

						<div class="stripe-form form">
							<hr class="border mb-4">
							<?php include "stripe/stripe_payment_gateway_form.php"; ?>
						</div>

						<form action="<?php echo site_url('home/razorpay_checkout'); ?>" method="post" class="razorpay-form form">
							<hr class="border mb-4">
							<input type="hidden" name="total_price_of_checking_out" value="<?php echo $total_price_of_checking_out; ?>">
							<button type="submit" class="payment-button float-end"><?php echo get_phrase('pay_by_razorpay'); ?></button>
						</form>

						<!--Paystack payment gateway addon-->
						<?php
						if (addon_status('paystack') == 1) :
							include "paystack_payment_gateway_form.php";
						endif;
						?>

						<!--payumoney payment gateway addon-->
						<?php
						if (addon_status('payumoney') == 1) :
							include "payumoney_payment_gateway_form.php";
						endif;
						?>
						<!--instamojo payment gateway addon-->
						<?php
						if (addon_status('instamojo') == 1) :
							include "instamojo_payment_gateway_form.php";
						endif;
						?>

						<!--pagseguro payment gateway addon-->
						<?php
						if (addon_status('pagseguro') == 1) :
							include "pagseguro_payment_gateway_form.php";
						endif;
						?>

						<!--mercadopago payment gateway addon-->
						<?php
						if (addon_status('mercadopago') == 1) :
							include "mercadopago_payment_gateway_form.php";
						endif;
						?>

						<!--ccavenue payment gateway addon-->
						<?php
						if (addon_status('ccavenue') == 1) :
							include "ccavenue/ccavenue_payment_gateway_form.php";
						endif;
						?>

						<!--flutterwave payment gateway addon-->
						<?php
						if (addon_status('flutterwave') == 1) :
							include "flutterwave_payment_gateway_form.php";
						endif;
						?>

						<!--paytm payment gateway addon-->
						<?php
						if (addon_status('paytm') == 1) :
							include "paytm_payment_gateway_form.php";
						endif;
						?>

						<!--offline payment gateway addon-->
						<?php
						if (addon_status('offline_payment') == 1) :
							include "offline_payment_gateway_form.php";
						endif;
						?>

						<?php
                        if (addon_status('iyzico') == 1) :
                            include "iyzico/iyzico_payment_gateway_form.php";
                        endif;
                        ?>
                        
                        <!--payu_latam payment gateway addon-->
						<?php
						if (addon_status('payu_latam') == 1) :
							include "payu_latam/payu_latam_payment_gateway_form.php";
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function selectedPaymentGateway(gateway) {
		if (gateway == 'paypal') {

			$(".payment-gateway").css("border", "2px solid #D3DCDD");
			$('.tick-icon').hide();
			$('.form').hide();

			$(".paypal").css("border", "2px solid #00D04F");
			$('.paypal-icon').show();
			$('.paypal-form').show();
		} else if (gateway == 'stripe') {

			$(".payment-gateway").css("border", "2px solid #D3DCDD");
			$('.tick-icon').hide();
			$('.form').hide();

			$(".stripe").css("border", "2px solid #00D04F");
			$('.stripe-icon').show();
			$('.stripe-form').show();
		} else if (gateway == 'razorpay') {

			$(".payment-gateway").css("border", "2px solid #D3DCDD");
			$('.tick-icon').hide();
			$('.form').hide();

			$(".razorpay").css("border", "2px solid #00D04F");
			$('.razorpay-icon').show();
			$('.razorpay-form').show();
		}else if (gateway == 'payu_latam') {

			$(".payment-gateway").css("border", "2px solid #D3DCDD");
			$('.tick-icon').hide();
			$('.form').hide();

			$(".payu_latam").css("border", "2px solid #00D04F");
			$('.payu_latam-icon').show();
			$('.payu_latam-form').show();
		}
	}
</script>