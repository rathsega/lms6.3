<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('upload_curriculam'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('upload_curriculam_form'); ?></h4>

                <form class="required-form" id="upload_curriculam_form" action="<?php echo site_url('admin/customsettings/upload_curriculam'); ?>" method="post" enctype="multipart/form-data">

                    
                    <div class="form-group">
                        <label for="multiple_course_id"><?php echo get_phrase('course'); ?><span class="required">*</span> </label>
                        <select class="select2 form-control select2-multiple" data-toggle="select2"  data-placeholder="Choose ..." name="course_id" id="multiple_course_id" required>
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
                                <label class="col-md-5 col-form-label" for="upload_file"><?php echo site_phrase('upload_file'); ?></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name = "curriculam_file" id="upload_file">
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
