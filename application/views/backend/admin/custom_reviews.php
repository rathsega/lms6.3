<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('custom_reviews'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('custom_reviews_form'); ?></h4>

                <form class="required-form" id="custom_reviews_form" action="<?php echo site_url('admin/customsettings/custom_reviews_form'); ?>" method="post" enctype="multipart/form-data">

                    
                    <div class="form-group">
                        <label for="multiple_course_id"><?php echo get_phrase('course'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control select2-multiple" data-toggle="select2"  onchange="get_custom_reviews(this.value)" data-placeholder="Choose ..." name="id" id="multiple_course_id" required>
                            <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                            <?php $course_list = $this->crud_model->get_courses()->result_array();
                                foreach ($course_list as $course):
                                if ($course['status'] != 'active')
                                    continue;?>
                                <option value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="student_name_1"><?php echo get_phrase('student_name'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="student_name_1" name = "student_name[0]" placeholder="<?php echo get_phrase('enter_student_name'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="rating_1"><?php echo get_phrase('rating'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="rating_1" name = "rating[0]" placeholder="<?php echo get_phrase('enter_rating'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="user_image_1"><?php echo site_phrase('upload_image'); ?><span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name = "user_image[0]" id="user_image_1" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="review_1"><?php echo get_phrase('review'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <textarea name="review[0]" id="review_1" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="student_name_2"><?php echo get_phrase('student_name'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="student_name_2" name = "student_name[1]" placeholder="<?php echo get_phrase('enter_student_name'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="rating_2"><?php echo get_phrase('rating'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="rating_2" name = "rating[1]" placeholder="<?php echo get_phrase('enter_rating'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="user_image_2"><?php echo site_phrase('upload_image'); ?><span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name = "user_image[1]" id="user_image_2" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="review_2"><?php echo get_phrase('review'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <textarea name="review[1]" id="review_1" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="student_name_3"><?php echo get_phrase('student_name'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="student_name_3" name = "student_name[2]" placeholder="<?php echo get_phrase('enter_student_name'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="rating_3"><?php echo get_phrase('rating'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="rating_3" name = "rating[2]" placeholder="<?php echo get_phrase('enter_rating'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="user_image_3"><?php echo site_phrase('upload_image'); ?><span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name = "user_image[2]" id="user_image_3" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="review_3"><?php echo get_phrase('review'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <textarea name="review[2]" id="review_3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="student_name_4"><?php echo get_phrase('student_name'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="student_name_4" name = "student_name[3]" placeholder="<?php echo get_phrase('enter_student_name'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="rating_4"><?php echo get_phrase('rating'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="rating_4" name = "rating[3]" placeholder="<?php echo get_phrase('enter_rating'); ?>" required>
                                </div>
                            </div>

                            
                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="user_image_4"><?php echo site_phrase('upload_image'); ?><span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name = "user_image[3]" id="user_image_4" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="review_4"><?php echo get_phrase('review'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <textarea name="review[3]" id="review_4" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="student_name_5"><?php echo get_phrase('student_name'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="student_name_5" name = "student_name[4]" placeholder="<?php echo get_phrase('enter_student_name'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="rating_5"><?php echo get_phrase('rating'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="rating_5" name = "rating[4]" placeholder="<?php echo get_phrase('enter_rating'); ?>" required>
                                </div>
                            </div>

                            
                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="user_image_5"><?php echo site_phrase('upload_image'); ?><span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name = "user_image[4]" id="user_image_5" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-5 col-form-label" for="review_5"><?php echo get_phrase('review'); ?> <span class="required">*</span> </label>
                                <div class="col-md-7">
                                    <textarea name="review[4]" id="review_5" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('submit'); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script type="text/javascript">
    function get_custom_reviews(id){
        if(id > 0){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/get_custom_reviews'); ?>",
                data: {id : id},
                success: function(response){
                    let data = $.parseJSON(response);
                    console.log(data["data"].length);
                    if(data["data"][0]){                        
                        var inputs = $('#custom_reviews_form [name]');
                        $.each(inputs, function(i, input){                            
                            if($(input).attr('name') != "id"){                                
                                let key = $(input).attr('name').split('[')[0];
                                let index = ($(input).attr('name').split('[')[1]).split(']')[0];
                                console.log("inde : " + index + ", input : " + $(input).attr('name') + ", Key : " + key);
                                $(input).val(data["data"][index][key]);
                            }
                        })
                    }else{
                        var inputs = $('#custom_reviews_form [name]');
                        $.each(inputs, function(i, input){
                            if($(input).attr('name') != "id"){                                
                                $(input).val("");
                            }
                        })
                    }
                    //jQuery('#quiz_fields_type_wize').html(response);
                }
            });
        }else{
            var inputs = $('#custom_reviews_form [name]');
            $.each(inputs, function(i, input){
                if($(input).attr('name') != "id"){                                
                    $(input).val("");
                }
            })
        }
    }

</script>
