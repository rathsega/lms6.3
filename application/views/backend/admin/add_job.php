<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Add_job'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('add_job_form'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/create_job'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required  value="<?php echo set_value('title'); ?>">

                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea name="description" id="description" required><?php echo set_value('description'); ?></textarea>

                        </div>
                        <div class="form-group">

                            <label for="company_name">Company Name<span class="required">*</span></label>
                            <input type="text" name="company_name" required class="form-control"  value="<?php echo set_value('company_name'); ?>">

                        </div>
                        <div class="form-group">
                            <label for="employment_type">Employment Type<span class="required">*</span></label>
                            <select name="employment_type" required class="select2 form-control select2-multiple">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Temporary">Temporary</option>
                            </select>
                        </div>
                        <div class="form-group">

                            <label for="location">Location<span class="required">*</span></label>
                            <select name="location" required class="select2 form-control select2-multiple">
                                <option value="New York">New York</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="Los Angeles">Los Angeles</option>
                                <option value="Chicago">Chicago</option>
                            </select>
                        </div>
                        <div class="form-group">


                            <label for="pay_scale">Pay Scale(in rupees)<span class="required">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="min_pay_scale" class="form-control" placeholder="Minimum Pay Scale" required value="<?php echo set_value('min_pay_scale'); ?>">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="max_pay_scale" class="form-control" placeholder="Maximum Pay Scale" required value="<?php echo set_value('max_pay_scale'); ?>">
                            </div>

                        </div>
                        <div class="form-group">


                            <label for="experience">Experience<span class="required">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="min_experience" class="form-control" placeholder="Minimum Experience" required value="<?php echo set_value('min_experience'); ?>">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="max_experience" class="form-control" placeholder="Maximum Experience" required value="<?php echo set_value('max_experience'); ?>">
                            </div>

                        </div>
                        <div class="form-group">
                        
                            <label for="qualification">Qualification<span class="required">*</span></label>
                            <input type="checkbox" name="qualification[]"  value="Bachelors"> Bachelors
                            <input type="checkbox" name="qualification[]"  value="Masters"> Masters
                            <input type="checkbox" name="qualification[]"  value="PhD"> PhD

                        </div>
                        <div class="form-group">


                            <label for="required_skills">Required Skills<span class="required">*</span></label>
                            <select name="required_skills[]" multiple required class="select2 form-control select2-multiple">
                                <option value="PHP">PHP</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="MySQL">MySQL</option>
                                <option value="HTML">HTML</option>
                            </select>
                        </div>
                        <div class="form-group">

                            <label for="work_mode">Work Mode<span class="required">*</span></label>
                            <select name="work_mode" required class="select2 form-control select2-multiple">
                                <option value="On-Site">On-Site</option>
                                <option value="Remote">Remote</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="industry">Industry<span class="required">*</span></label>
                            <select name="industry" required class="select2 form-control select2-multiple">
                                <option value="Technology">Technology</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Finance">Finance</option>
                                <option value="Education">Education</option>
                            </select>
                        </div>



                        <input type="submit" class="btn btn-primary" name="submit" value="Add Job">
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initSummerNote(['#description']);
    });
</script>