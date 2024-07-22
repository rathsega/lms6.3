<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/jobs/add'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_job'); ?></a>
                    <a href="<?php echo site_url('admin/jobs/applications'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-file"></i><?php echo get_phrase('job_applications'); ?></a>
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
                                        <a href="<?php echo site_url('admin/jobs/view/' . $job['id']); ?>" title="View"><i class="fa-solid fas fa-eye cursor-pointer"></i></a>
                                        <a href="<?php echo site_url('admin/jobs/edit/' . $job['id']); ?>" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                        <a href="<?php echo site_url('admin/jobs/delete/' . $job['id']); ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this job?');"><i class="dripicons-trash"></i></a>
                                        <!-- <input type="checkbox" name="enable_drip_content" value="1" id="enable_drip_content" class="toggle-status" data-switch="primary" data-id="<?= $job["id"] ?>" data-status="<?= $job["status"] ?>">
                                        <label for="enable_drip_content" style="width: 87px !important;" data-on-label="On" data-off-label="Off"></label> -->
                                        <input type="checkbox" class="toggle-status" name="enable_drip_content_<?= $job["id"] ?>" value="1" <?php if ($job['status'] == 1) echo 'checked'; ?> id="enable_drip_content_<?= $job["id"] ?>" data-switch="primary" data-id="<?= $job["id"] ?>" data-status="<?= $job["status"] ?>">
                                        <label for="enable_drip_content_<?= $job["id"] ?>" data-on-label="On" data-off-label="Off"></label>
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

<script>
    $(document).ready(function() {
        $('.toggle-status').click(function() {
            var button = $(this);
            var jobId = button.data('id');
            var status = button.data('status');

            $.ajax({
                url: '<?= site_url('jobs/toggle_status') ?>',
                type: 'POST',
                data: {
                    job_id: jobId,
                    status: status
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    button.data('status', result.status);
                    button.text(result.status == 1 ? 'Deactivate' : 'Activate');
                }
            });
        });
    });
</script>