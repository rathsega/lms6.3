<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo "Edit Enrolment"; ?></h4>
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
                <form class="required-form" action="<?php echo site_url('admin/enrol_student/edit_enrol'); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="multiple_user_id"><?php echo get_phrase('users'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control" disabled data-toggle="select2" data-placeholder="Choose ..." name="user_id" id="multiple_user_id" required>
                            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
                            <?php $user_list = $this->user_model->get_user()->result_array();
                                foreach ($user_list as $user):?>
                                <option  <?php  echo $user['id'] == $enrolment_data['user_id'] ? 'selected' : ''; ?> value="<?php echo $user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?> (<?php echo $user['email']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="multiple_course_id"><?php echo get_phrase('course_to_enrol'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control" disabled  data-toggle="select2" data-placeholder="Choose ..." name="course_id" required>
                            <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                            <?php $course_list = $this->crud_model->get_courses()->result_array();
                                foreach ($course_list as $course):
                                if ($course['status'] != 'active')
                                    continue;?>
                                <option <?php  echo $course['id'] == $enrolment_data['course_id'] ? 'selected' : ''; ?> value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expiry_date"><?php echo get_phrase('expiry_date'); ?><span class="required">*</span> </label>
                        <input type="date" class="form-control" value="<?php echo $enrolment_data['expiry_date']; ?>" name="expiry_date" id="expiry_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="course_fee"><?php echo get_phrase('course_fee'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="number" class="form-control col-md-12 col-lg-12" placeholder="Course fee" value="<?php echo $enrolment_data['course_fee']; ?>" name="course_fee" id="course_fee">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="installment_1"><?php echo get_phrase('installment_1'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="date" class="form-control col-md-6 col-lg-6" name="installment_1_date"  value="<?php echo $enrolment_data['installment_details'][0]->date; ?>" id="installment_1_date" >
                            <input type="number" class="form-control col-md-6 col-lg-6" placeholder="First installment amount" value="<?php echo $enrolment_data['installment_details'][0]->amount; ?>" name="installment_1_amount" id="installment_1_amount" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="installment_2"><?php echo get_phrase('installment_2'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="date" class="form-control col-md-6 col-lg-6" name="installment_2_date"  value="<?php echo $enrolment_data['installment_details'][1]->date; ?>" id="installment_2_date" >
                            <input type="number" class="form-control col-md-6 col-lg-6" placeholder="Second installment amount" value="<?php echo $enrolment_data['installment_details'][1]->amount; ?>" name="installment_2_amount" id="installment_2_amount" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="installment_3"><?php echo get_phrase('installment_3'). " <b>(C)</b>"; ?></label>
                        <div class="row">
                            <input type="date" class="form-control col-md-6 col-lg-6" name="installment_3_date"  value="<?php echo $enrolment_data['installment_details'][2]->date; ?>" id="installment_3_date" >
                            <input type="number" class="form-control col-md-6 col-lg-6" placeholder="Third installment amount" value="<?php echo $enrolment_data['installment_details'][2]->amount; ?>" name="installment_3_amount" id="installment_3_amount" >
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $enrolment_data['id']; ?>" />
                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('enrol_student'); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
