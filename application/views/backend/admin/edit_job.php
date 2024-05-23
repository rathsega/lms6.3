<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Edit_job'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('edit_job_form'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/update_job/' . $job['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required value="<?php echo set_value('title', $job['title']); ?>">

                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea name="description" id="description" required><?php echo set_value('description', $job['description']); ?></textarea>

                        </div>
                        <div class="form-group">

                            <label for="company_name">Company Name<span class="required">*</span></label>
                            <input type="text" name="company_name" required class="form-control" value="<?php echo set_value('company_name', $job['company_name']); ?>">

                        </div>
                        <div class="form-group">
                            <label for="employment_type">Employment Type<span class="required">*</span></label>
                            <select name="employment_type" required class="select2 form-control select2-multiple">
                                <option value="Full-Time" <?php echo set_select('employment_type', 'Full-Time', $job['employment_type'] == 'Full-Time'); ?>>Full-Time</option>
                                <option value="Part-Time" <?php echo set_select('employment_type', 'Part-Time', $job['employment_type'] == 'Part-Time'); ?>>Part-Time</option>
                                <option value="Contract" <?php echo set_select('employment_type', 'Contract', $job['employment_type'] == 'Contract'); ?>>Contract</option>
                                <option value="Temporary" <?php echo set_select('employment_type', 'Temporary', $job['employment_type'] == 'Temporary'); ?>>Temporary</option>
                            </select>
                        </div>
                        <div class="form-group">

                            <label for="location">Location<span class="required">*</span></label>
                            <select name="location" required class="select2 form-control select2-multiple">
                                <option value="New York" <?php echo set_select('location', 'New York', $job['location'] == 'New York'); ?>>New York</option>
                                <option value="San Francisco" <?php echo set_select('location', 'San Francisco', $job['location'] == 'San Francisco'); ?>>San Francisco</option>
                                <option value="Los Angeles" <?php echo set_select('location', 'Los Angeles', $job['location'] == 'Los Angeles'); ?>>Los Angeles</option>
                                <option value="Chicago" <?php echo set_select('location', 'Chicago', $job['location'] == 'Chicago'); ?>>Chicago</option>
                            </select>
                        </div>
                        <div class="form-group">


                            <label for="pay_scale">Pay Scale<span class="required">*</span></label>
                            <input type="text" name="pay_scale" class="form-control" required value="<?php echo set_value('pay_scale', $job['pay_scale']); ?>">

                        </div>
                        <div class="form-group">


                            <label for="experience">Experience<span class="required">*</span></label>
                            <input type="text" name="experience" class="form-control" required value="<?php echo set_value('experience', $job['experience']); ?>">

                        </div>
                        <div class="form-group">
                            <?php
                            $qualifications = json_decode($job['qualification']);
                            ?>
                            <label for="qualification">Qualification<span class="required">*</span></label>
                            <input type="checkbox" name="qualification[]" value="Bachelors" <?php echo set_checkbox('qualification[]', 'Bachelors', in_array('Bachelors', $qualifications)); ?>> Bachelors
                            <input type="checkbox" name="qualification[]" value="Masters" <?php echo set_checkbox('qualification[]', 'Masters', in_array('Masters', $qualifications)); ?>> Masters
                            <input type="checkbox" name="qualification[]" value="PhD" <?php echo set_checkbox('qualification[]', 'PhD', in_array('PhD', $qualifications)); ?>> PhD

                        </div>
                        <div class="form-group">
                            <?php
                            $skills = json_decode($job['required_skills']);
                            ?>

                            <label for="required_skills">Required Skills<span class="required">*</span></label>
                            <select name="required_skills[]" multiple required class="select2 form-control select2-multiple">
                                <option value="PHP" <?php echo set_select('required_skills[]', 'PHP', in_array('PHP', $skills)); ?>>PHP</option>
                                <option value="JavaScript" <?php echo set_select('required_skills[]', 'JavaScript', in_array('JavaScript', $skills)); ?>>JavaScript</option>
                                <option value="MySQL" <?php echo set_select('required_skills[]', 'MySQL', in_array('MySQL', $skills)); ?>>MySQL</option>
                                <option value="HTML" <?php echo set_select('required_skills[]', 'HTML', in_array('HTML', $skills)); ?>>HTML</option>
                            </select>
                        </div>
                        <div class="form-group">

                            <label for="work_mode">Work Mode<span class="required">*</span></label>
                            <select name="work_mode" required class="select2 form-control select2-multiple">
                                <option value="On-Site" <?php echo set_select('work_mode', 'On-Site', $job['work_mode'] == 'On-Site'); ?>>On-Site</option>
                                <option value="Remote" <?php echo set_select('work_mode', 'Remote', $job['work_mode'] == 'Remote'); ?>>Remote</option>
                                <option value="Hybrid" <?php echo set_select('work_mode', 'Hybrid', $job['work_mode'] == 'Hybrid'); ?>>Hybrid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="industry">Industry<span class="required">*</span></label>
                            <select name="industry" required class="select2 form-control select2-multiple">
                                <option value="Technology" <?php echo set_select('industry', 'Technology', $job['industry'] == 'Technology'); ?>>Technology</option>
                                <option value="Healthcare" <?php echo set_select('industry', 'Healthcare', $job['industry'] == 'Healthcare'); ?>>Healthcare</option>
                                <option value="Finance" <?php echo set_select('industry', 'Finance', $job['industry'] == 'Finance'); ?>>Finance</option>
                                <option value="Education" <?php echo set_select('industry', 'Education', $job['industry'] == 'Education'); ?>>Education</option>
                            </select>
                        </div>



                        <input type="submit" class="btn btn-primary" name="submit" value="Update Job">
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