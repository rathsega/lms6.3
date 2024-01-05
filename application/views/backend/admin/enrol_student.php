<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('course_enrolment'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('enrolment_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/enrol_student/enrol'); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="multiple_user_id"><?php echo get_phrase('users'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="user_id[]" id="multiple_user_id" required>
                            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
                            <?php $user_list = $this->user_model->get_user()->result_array();
                                foreach ($user_list as $user):?>
                                <option value="<?php echo $user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?> (<?php echo $user['email']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="multiple_course_id"><?php echo get_phrase('course_to_enrol'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="course_id[]" id="multiple_course_id" required>
                            <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                            <?php $course_list = $this->crud_model->get_courses()->result_array();
                                foreach ($course_list as $course):
                                if ($course['status'] != 'active')
                                    continue;?>
                                <option value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expiry_date"><?php echo get_phrase('expiry_date'). " <b>(C)</b>"; ?><span class="required">*</span> </label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d',strtotime( "+12 month", strtotime( date('D, d-M-Y')  ) )); ?>" name="expiry_date" id="expiry_date" required>
                    </div>

                    <div class="form-group">
                        <label for="payment_amount"><?php echo get_phrase('payment_amount'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="number" class="form-control col-md-6 col-lg-6" placeholder="Payment amount" name="payment_amount" id="payment_amount">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="installment_1"><?php echo get_phrase('installment_1'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="date" class="form-control col-md-6 col-lg-6" name="installment_1_date" id="installment_1_date">
                            <input type="number" class="form-control col-md-6 col-lg-6" placeholder="First installment amount" name="installment_1_amount" id="installment_1_amount">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="installment_2"><?php echo get_phrase('installment_2'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="date" class="form-control col-md-6 col-lg-6" name="installment_2_date" id="installment_2_date" >
                            <input type="number" class="form-control col-md-6 col-lg-6" placeholder="Second installment amount" name="installment_2_amount" id="installment_2_amount" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="installment_3"><?php echo get_phrase('installment_3'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="date" class="form-control col-md-6 col-lg-6" name="installment_3_date" id="installment_3_date" >
                            <input type="number" class="form-control col-md-6 col-lg-6" placeholder="Third installment amount" name="installment_3_amount" id="installment_3_amount" >
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('enrol_student'); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
