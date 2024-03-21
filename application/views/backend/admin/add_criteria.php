<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_criteria'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('add_criteria_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/add_criteria'); ?>" method="post" enctype="multipart/form-data">

                <div class="tab-pane" id="criteria">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-12">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="criteria"><?php echo get_phrase('criteria'); ?></label>
                                                    <div class="col-md-9">
                                                        <div id = "criteria_area">
                                                            <?php $criteria_counter = 0; ?>
                                                            <?php $course_criteria_arr = !empty($criteria_details['criterias']) ? json_decode($criteria_details['criterias'], true):[]; ?>
                                                            <?php $course_criteria_arr = is_array($course_criteria_arr) ? $course_criteria_arr : array(); ?>
                                                            <?php foreach($course_criteria_arr as $criteria_key => $criteria_val): ?>
                                                                <?php $criteria_title = $criteria_val; ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" required class="form-control" value="<?php echo $criteria_title; ?>" name="criteria_title[]" id="criteria" placeholder="<?php echo get_phrase('criteria_title'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <?php if($criteria_counter == 0): ?>
                                                                            <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendCriteria()"> <i class="fa fa-plus"></i> </button>
                                                                        <?php else: ?>
                                                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeCriteria(this)"> <i class="fa fa-minus"></i> </button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <?php $criteria_counter++; ?>
                                                            <?php endforeach; ?>

                                                            <?php if($criteria_counter == 0): ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" required class="form-control" name="criteria_title[]" id="criteria" placeholder="<?php echo get_phrase('criteria_title'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendCriteria()"> <i class="fa fa-plus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div id = "blank_criteria_field">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" required class="form-control" name="criteria_title[]" id="criteria" placeholder="<?php echo get_phrase('criteria_title'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeCriteria(this)"> <i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <button type="button" class="btn btn-primary text-center" onclick="checkRequiredFields()"><?php echo get_phrase('submit'); ?></button>
                                    </div>

                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script>
    
        //Student and enrolment Dependable dropdown
        var blank_criteria = jQuery('#blank_criteria_field').html();
        function appendCriteria() {
            jQuery('#criteria_area').append(blank_criteria);
        }
        function removeCriteria(criteriaElem) {
            jQuery(criteriaElem).parent().parent().remove();
        }
</script>
