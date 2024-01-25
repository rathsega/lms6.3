<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('ratings_count_form'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('ratings_form'); ?></h4>

                <form class="required-form" id="rating_count_form" action="<?php echo site_url('admin/customsettings/ratings_count_form'); ?>" method="post" enctype="multipart/form-data">

                    
                    <div class="form-group">
                        <label for="multiple_course_id"><?php echo get_phrase('course'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose ..." name="id" onchange="fetch_review_count(this.value)" id="multiple_course_id" required>
                            <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                            <?php $course_list = $this->crud_model->get_courses()->result_array();
                                foreach ($course_list as $course):
                                if ($course['status'] != 'active')
                                    continue;?>
                                <option value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="number_of_students_enrolled"><?php echo get_phrase('number_of_students_enrolled'); ?> <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="number_of_students_enrolled" name = "number_of_students_enrolled" placeholder="<?php echo get_phrase('enter_number_of_students_enrolled'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="number_of_ratings"><?php echo get_phrase('number_of_ratings'); ?> <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="number_of_ratings" name = "number_of_ratings" placeholder="<?php echo get_phrase('enter_number_of_ratings'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="one_rating_count"><?php echo get_phrase('one_rating_count'); ?> <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="one_rating_count" name = "one_rating_count" placeholder="<?php echo get_phrase('enter_one_rating_count'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="two_rating_count"><?php echo get_phrase('two_rating_count'); ?> <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="two_rating_count" name = "two_rating_count" placeholder="<?php echo get_phrase('enter_two_rating_count'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="three_rating_count"><?php echo get_phrase('three_rating_count'); ?> <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="three_rating_count" name = "three_rating_count" placeholder="<?php echo get_phrase('enter_three_rating_count'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="four_rating_count"><?php echo get_phrase('four_rating_count'); ?> <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="four_rating_count" name = "four_rating_count" placeholder="<?php echo get_phrase('enter_four_rating_count'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="five_rating_count"><?php echo get_phrase('five_rating_count'); ?> <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="five_rating_count" name = "five_rating_count" placeholder="<?php echo get_phrase('enter_five_rating_count'); ?>" required>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" id="sub_button" onclick="checkRequiredFields()"><?php echo get_phrase('submit'); ?></button>
                    <span class="error" id="err_msg"></span>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script type="text/javascript">
    function fetch_review_count(id){
        if(id > 0){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/fetch_review_count'); ?>",
                data: {id : id},
                success: function(response){
                    let data = $.parseJSON(response);
                    console.log(data["data"]);
                    if(data["data"]){                        
                        var inputs = $('#rating_count_form [name]');
                        $.each(inputs, function(i, input){
                            var input_name = $(input).attr('name');
                            $(input).val(data["data"][input_name]);
                        })
                    }else{
                        var inputs = $('#rating_count_form [name]');
                        $.each(inputs, function(i, input){
                            var input_name = $(input).attr('name');
                            input_name!="id" ? $(input).val(0) : "";
                        })
                    }
                    //jQuery('#quiz_fields_type_wize').html(response);
                }
            });
        }else{
            var inputs = $('#rating_count_form [name]');
            $.each(inputs, function(i, input){
                var input_name = $(input).attr('name');
                input_name!="id" ? $(input).val(0) : "";
            })
        }
    }

    $("form :input").change(function() {
        let one_rating_count = parseInt(document.getElementById("one_rating_count").value);
        let two_rating_count = parseInt(document.getElementById("two_rating_count").value);
        let three_rating_count = parseInt(document.getElementById("three_rating_count").value);
        let four_rating_count = parseInt(document.getElementById("four_rating_count").value);
        let five_rating_count = parseInt(document.getElementById("five_rating_count").value);
        
        let number_of_ratings = parseInt(document.getElementById("number_of_ratings").value);

        let sub_button = document.getElementById("sub_button");
        let err_msg = document.getElementById("err_msg");
        alert(one_rating_count + two_rating_count + three_rating_count + four_rating_count + five_rating_count);
        alert(number_of_ratings);
        if((one_rating_count + two_rating_count + three_rating_count + four_rating_count + five_rating_count ) != number_of_ratings){
            err_msg.innerText = "Number of raing count is mismatched with individual rating count";
            sub_button.disabled = true;
        }else{
            err_msg.innerText = "";
            sub_button.disabled = false;
        }

    });

</script>