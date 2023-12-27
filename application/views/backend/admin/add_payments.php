<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_payment'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('add_payment_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/add_payment'); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="multiple_user_id"><?php echo get_phrase('users'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="user_id" id="multiple_user_id" required>
                            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
                            <?php $user_list = $this->user_model->get_user()->result_array();
                                foreach ($user_list as $user):?>
                                <option value="<?php echo $user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?> (<?php echo $user['email']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="multiple_course_id"><?php echo get_phrase('enrolment'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="enrolment_id" id="enrolments_dropdown" required>
                            <option value=""><?php echo get_phrase('select_a_enrolment'); ?></option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount"><?php echo get_phrase('amount'); ?><span class="required">*</span> </label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('submit'); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script>
    $(document).ready(function() {
    
    //Student and enrolment Dependable dropdown
    $('#multiple_user_id').change(function(){
        var selectedValue = $(this).val();

        // Make an AJAX call to fetch dependent options
        $.ajax({
            url: "<?php echo base_url('admin/get_student_active_enrolments'); ?>",
            method: 'post',
            data: { student_id: selectedValue },
            dataType: 'json',
            success: function(response){
                var options = '<option value="">Select Enrolment</option>';
                $.each(response.data, function(key, value){
                    options += '<option value="' + value.id + '">' + value.title + '</option>';
                });
                $('#enrolments_dropdown').html(options);
            }
        });
    });
});
</script>
