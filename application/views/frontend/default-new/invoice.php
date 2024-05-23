<?php
$course_details = $this->crud_model->get_course_by_id($payment_info['course_id'])->row_array();
$buyer_details = $this->user_model->get_all_user($payment_info['user_id'])->row_array();
$sub_category_details = $this->crud_model->get_category_details_by_id($course_details['sub_category_id'])->row_array();
$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
?>


<!------------ Invoice secton end -------->

<div class="container col-md-7 col-12 shadow p-3 mb-5 bg-white mt-5 manual_invoice">
    <div class="row" id="contentToPrint">
        <div class="col-lg-12">
            <div class="main-invoice">
                <div class="card-body">
                    <div class="invoice-title">
                        <!-- <h4 class="float-end font-size-15">Invoice #DS0204 <span class="badge bg-success font-size-12 ms-2">Paid</span></h4> -->
                        <div class="mb-4">
                            <img src="<?php echo site_url('uploads/system/' . get_frontend_settings('dark_logo')) ?>" alt="" class="tech_logo">
                        </div>
                        <div class="text-end col-12 pt-2" id="extra_image">
                            <img src="<?php echo site_url('assets/frontend/default-new/image/custom_invoice.png') ?>" alt="" class="invoice-pic">
                        </div>
                    </div>

                    <!-- <hr class="my-4"> -->

                    <div class="row">
                        <div class="col-sm-8">
                            <div>
                                <!-- <h5 class="font-size-16 "><span class="fw-bold text-primary">Accounting</span> Services</h5> -->
                                <h5 class="font-size-15 mb-1 ">Invoice #<?php echo $payment_info['date_added']; ?> </h5>
                                <h5 class="font-size-15 mb-1 ">Date: <?php echo date("j F, Y", $payment_info['date_added']); ?></h5>
                                <!-- <p class="mb-1">Hyderbad, 500001</p>
                                <p>001-234-5678</p> -->
                                <h6 class=" mb-1  mt-2"> Course Name: <?php echo $course_details['title']; ?></h6>
                                <p>Actual Price: <?php echo currency($payment_info['amount']); ?></p>

                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-4">
                            <div class="mt-4">
                                <div class="">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Billed To: <?php echo $buyer_details['first_name'].' '.$buyer_details['last_name']; ?></h5>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <h4 class="fw-bold pt-4 text-primary"># Payment details</h4>
                        <hr class="my-4 horizontal">
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="py-2">
                        <!-- <h5 class="font-size-15">Order Summary :</h5> -->

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">S.No</th>
                                        <th>Course Name</th>
                                        <th>Paymenyt Date</th>
                                        <th class="text-end" style="width: 120px;">Amount</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                        <tr>
                                            <th scope="row"><?php echo 1; ?></th>
                                            <td>
                                                <div>
                                                    <h6 class="text-truncate mb-1"><?php echo $course_details['title']; ?> </h6>

                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <h6 class="text-truncate mb-1"><?php echo date("j F, Y", $payment_info['date_added']); ?> </h6>

                                                </div>
                                            </td>
                                            <td class="text-end"><?php echo currency($payment_info['admin_revenue'] + $payment_info['instructor_revenue']) ?></td>
                                        </tr>
                                        <!-- end tr -->


                                    <tr>
                                        <th scope="row" colspan="3" class="text-end">Sub Total</th>
                                        <td class="text-end"><?php echo currency($payment_info['admin_revenue'] + $payment_info['instructor_revenue']); ?></td>
                                    </tr>
                                    
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="3" class=" text-end">
                                            TAXES</th>
                                        <td class=" text-end"><?php echo currency($payment_info['tax']); ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row" colspan="3" class=" text-end fw-semibold">Total</th>
                                        <td class=" text-end">
                                            <h4 class="m-0 fw-semibold"><?php echo currency($payment_info['amount']); ?></h4>
                                        </td>
                                    </tr>

                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>


                        <?php if ($purchase_history[0]['course_fee'] > $total_paid_amount) : ?>
                            <div class=" mb-5 mt-4">
                                <div class="shadow-lg p-4 mb-5 bg-body-tertiary rounded">
                                    <h6 class="fw-bold">Your Total Due Amount = <span class="text-danger fw-bold"><?php echo currency($purchase_history[0]['course_fee'] - $total_paid_amount); ?></span></h6>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="d-print-none mt-4" id="extra_buttons">
                            <div class="float-end">
                                <a href="javascript:void()" onclick="printContent()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                        <!-- <div class="col-sm-8 mt-5">
                        <div>
                            <h5 class="font-size-15 mb-1">Billed To:</h5>
                            <p class="font-size-15">John Deo</p>
                            <p class="font-size-15">Student ID: #466545</p>
                            <p class="font-size-15">Address: Hyderabad , 507111</p>
                         
  
                        </div>
                    </div> -->

                        <div class="col-sm-8 mt-5">
                            <div>
               

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="font-size-15 mb-1 text-center">This inovice is computer generated</h5>
            </div>

        </div><!-- end col -->
    </div>
</div>

<script>
    function printContent() {
        let extra_image = document.getElementById("extra_image");
        let extra_button = document.getElementById("extra_buttons");
        extra_image.style.display = "none";
        extra_button.style.display = "none";
        var content = document.getElementById("contentToPrint").innerHTML;
        var originalDocument = document.body.innerHTML;
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = originalDocument;
        extra_image.style.display = "block";
        extra_button.style.display = "block";
    }
</script>