<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo "Broucher Form"; ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo "Broucher Form"; ?></h4>

                <form class="required-form" id="broucher_form" action="<?php echo site_url('admin/customsettings/broucher_form'); ?>" method="post" enctype="multipart/form-data">

                    
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

                    <div class="form-group row mb-3" id="current_broucher" style="display:none;">
                        <label class="col-md-5 col-form-label" for="broucher"><?php echo "Current Broucher" ?></label>
                        <div class="col-md-7">
                            <a href="" download name="current_broucher_link" id="current_broucher_link">download</a>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="broucher"><?php echo "Upload Broucher" ?><span class="required">*</span></label>
                        <div class="col-md-7">
                            <input type="file" class="form-control" name = "broucher" id="broucher" required>
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
    function fetch_review_count(id){
        if(id > 0){
            // document.getElementById("current_broucher").style.display = "block";
            // var inputs = $('#broucher_form[current_broucher_link]');
            // $.each(inputs, function(i, input){
                // $(input).attr('href') = <?php //echo $this->user_model->get_user_image_url_of_custom_review(, $key_id); ?>
            // })
            
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/fetch_broucher'); ?>",
                data: {id : id},
                success: function(response){
                    let data = $.parseJSON(response);
                    console.log(data["data"]);
                    if(data["data"]){          
                        document.getElementById("current_broucher").style.display = "block";              
                        $('#current_broucher_link').attr('href', data["data"]);
                    }else{
                        document.getElementById("current_broucher").style.display = "none";
                    }
                    //jQuery('#quiz_fields_type_wize').html(response);
                }
            });
        }else{
            document.getElementById("current_broucher").style.display = "none";
        }
    }

</script>