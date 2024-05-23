<style>
    .invoice-carui{
        width: 1000px;
        margin-bottom: 66px !important;
    }
@media screen and (max-width:767px){
  .mobile-invoice-ui {
    display: contents !important;
  }
  .tech_logo{
    width:95% !important;
  }
  .invoice-carui {
    width: 390px;
    }
    .main-invoice {
    margin: 21px;
    margin-top: 30px !important;
}
}
</style>
<div class="container invoice-carui col-md-7 col-12 shadow p-3 mb-5 bg-white manual_invoice">
    <div class="row" id="contentToPrint">
        <div class="col-lg-12">
            <div class="main-invoice">
                <div class="card-body">
                    <div class="invoice-title">
                        <!-- <h4 class="float-end font-size-15">Invoice #DS0204 <span class="badge bg-success font-size-12 ms-2">Paid</span></h4> -->
                        <div class="mb-4">
                            <img src="<?php echo site_url('uploads/system/' . get_frontend_settings('dark_logo')) ?>" alt="" class="tech_logo">
                        </div>
                        <div class="text-end col-12 pt-2 d-none d-md-block" id="extra_image">
                        <img src="<?php echo site_url('assets/frontend/default-new/image/custom_invoice.png') ?>" alt="" class="invoice-pic">
                        </div>
                        </div>

                    <!-- <hr class="my-4"> -->

                    
                    <div class="mobile-invoice-ui" style="display: flex; justify-content: space-between;margin-top:60px;">
                        <div style="flex-basis: 65%;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row" style="text-align: left;">Invoice:</th>
                                        <td>#<?php echo $purchase_history[0]['date_added']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align: left;">Date:</th>
                                        <td><?php echo date("j F, Y", $purchase_history[0]['date_added']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align: left;">Course Name:</th>
                                        <td><?php echo $purchase_history[0]['title']; ?></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                        <div style="flex-basis: 48%;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row" style="text-align: left;">Billed To:</th>
                                        <td><?php echo $buyer_details['first_name'].' '.$buyer_details['last_name']; ?></td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                    </tr>
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>

                  

                        <h4 class="fw-bold pt-4 text-primary"># Payment details</h4>
                        <hr class="my-4 horizontal">
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <?php
                    $total_paid_amount = 0;
                    foreach ($purchase_history as $history) {
                        $total_paid_amount += $history['amount'];
                    }
                    ?>
                    <div class="py-2">
                        <!-- <h5 class="font-size-15">Order Summary :</h5> -->

                        <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th style="text-align:left; width: 120px;" style="width: 70px;">S.No</th>
                                    <th style="text-align:left; width: 685px;">Course Name</th>
                                    <th style="text-align:left; width: 680px;">Payment Date</th>
                                    <th style="text-align:left;width: 120px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($purchase_history as $key => $payment) : ?>
                                    <tr>
                                        <td style="text-align:left;"><?php echo ++$key; ?></td>
                                        <td style="text-align:left;width:220px;"><?php echo $payment['title']; ?></td>
                                        <td style="text-align:left;width:220px;"><?php echo date("j F, Y H:i", strtotime($payment['datetime'])); ?></td>
                                        <td style="text-align:left;width:220px;"><?php echo currency($payment['amount']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr >
                                <td colspan="3" style="text-align: right;color:#0d6efd;" class=" fw-semibold">Sub Total:</td>
                                <td style="text-align:left;"><?php echo currency($total_paid_amount); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3" style="text-align: right;color:#0d6efd;" style="text-align:right;" class=" fw-semibold">Total:</td>
                                    <td  style="text-align:left;"><?php echo currency($total_paid_amount); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>

                                <?php
                                $purchase_history[0]['course_fee'] = 50000;
                                ?>
                        <?php if ($purchase_history[0]['course_fee'] > $total_paid_amount) : ?>
                            <div class=" mb-5 mt-4">
                                <div class="shadow-lg p-4 mb-5 bg-body-tertiary rounded">
                                    <h6 class="fw-bold">Your Total Due Amount = <span class="text-danger fw-bold"><?php echo currency($purchase_history[0]['course_fee'] - $total_paid_amount); ?></span></h6>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-sm-8 mt-5">
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="font-size-15 mb-1 text-center" style="text-align:center;">This inovice is computer generated</h5>
            </div>
        </div><!-- end col -->
  
        <div class="d-print-none print-btn" id="extra_buttons">
        <div class="float-end">
            <a href="javascript:void()" onclick="printContent()" class="btn btn-success me-1" style="margin-top:30px;"><span><i class="fa fa-print"></i> Print</span></a>
        </div>
    </div>
    </div>


  

<script>
    function printContent() {
        $("extra_image").hide();
        $("extra_buttons").hide();
        var content = document.getElementById("contentToPrint").innerHTML;
        var originalDocument = document.body.innerHTML;
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = originalDocument;
        $("extra_image").show();
        $("extra_buttons").show();
    }
</script>