<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('View_job'); ?>
                <a href="<?php echo site_url('admin/jobs'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-left-arrow"></i><?php echo get_phrase('Back to Jobs'); ?></a>
            </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">

                    <h1><?php echo $job['title']; ?></h1>
                    <p><strong>Description:</strong> <?php echo $job['description']; ?></p>
                    <p><strong>Company Name:</strong> <?php echo $job['company_name']; ?></p>
                    <p><strong>Employment Type:</strong> <?php echo $job['employment_type']; ?></p>
                    <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
                    <p><strong>Pay Scale:</strong> <?php echo $job['pay_scale']; ?></p>
                    <p><strong>Experience:</strong> <?php echo $job['experience']; ?></p>
                    <p><strong>Qualification:</strong> <?php echo implode(', ', json_decode($job['qualification'])); ?></p>
                    <p><strong>Required Skills:</strong> <?php echo implode(', ', json_decode($job['required_skills'])); ?></p>
                    <p><strong>Work Mode:</strong> <?php echo $job['work_mode']; ?></p>
                    <p><strong>Industry:</strong> <?php echo $job['industry']; ?></p>
                    <p><a href="<?php echo site_url('admin/jobs/edit/' . $job['id']); ?>">Edit</a> |&nbsp;&nbsp; <a href="<?php echo site_url('admin/jobs'); ?>">Back to Jobs</a></p>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>