<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('User Status Modification'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('user_status_modification_form'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/modify_user_status'); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="multiple_user_id"><?php echo get_phrase('users'); ?><span class="required">*</span> </label>
                            <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="user_id" id="multiple_user_id" required>
                                <option value=""><?php echo get_phrase('select_a_user'); ?></option>
                                <?php
                                foreach ($this->crud_model->enrolled_users() as $user) : ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?> (<?php echo $user['email']; ?>) - <?php echo $user['status'] == 1 ? 'Active' : 'Paused'; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="hidden" class="form-control" name="current_status" id="current_status">
                                <input type="hidden" class="form-control" name="paused_from_date" id="paused_from_date">
                                <input type="hidden" class="form-control" name="paused_to_date" id="paused_to_date">
                            </div>
                        </div>

                        <div class="form-group"  id="from_date">
                            <div class="col-md-7">
                                <input type="hidden" class="form-control"  min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" name="from_date" placeholder="<?php echo get_phrase('enter_from_date'); ?>" required>
                            </div>
                        </div>

                        <!-- <div class="form-group"  id="to_date">
                            <label class="col-md-5 col-form-label" for="to_date"><?php echo get_phrase('to_date'); ?> <span class="required">*</span> </label>
                            <div class="col-md-7">
                                <input type="date" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" name="to_date" placeholder="<?php echo get_phrase('enter_to_date'); ?>" required>
                            </div>
                        </div> -->

                        <button type="button" id="submit_button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('submit'); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script>
    $(document).ready(function() {

        //Student and enrolment Dependable dropdown
        $('#multiple_user_id').change(function() {
            var selectedValue = $(this).val();

            // Make an AJAX call to fetch dependent options
            $.ajax({
                url: "<?php echo base_url('admin/get_user_status'); ?>",
                method: 'post',
                data: {
                    student_id: selectedValue
                },
                dataType: 'json',
                success: function(response) {
                    $.each(response.data, function(key, value) {
                        $('#current_status').val(value.status);
                        if(value.status == 3){
                            document.getElementById("submit_button").innerText = "Resume";
                        }else{
                            document.getElementById("submit_button").innerText = "Pause";
                        }
                        $('#paused_from_date').val(value.paused_from_date);
                        $('#paused_to_date').val(value.paused_to_date);
                    });
                    
                }
            });
        });
    });
</script>