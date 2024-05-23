<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/jobs/add'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_job'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Title'); ?></th>
                                <th><?php echo get_phrase('Company'); ?></th>
                                <th><?php echo get_phrase('Location'); ?></th>
                                <th><?php echo get_phrase('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($jobs as $key => $job) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $job['title']; ?></td>
                                    <td><?php echo $job['company_name']; ?></td>
                                    <td><?php echo $job['location']; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('admin/jobs/view/' . $job['id']); ?>">View</a>
                                        <a href="<?php echo site_url('admin/jobs/edit/' . $job['id']); ?>">Edit</a>
                                        <a href="<?php echo site_url('admin/jobs/delete/' . $job['id']); ?>" onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>