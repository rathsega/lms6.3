<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/jobs'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><?php echo get_phrase('Back'); ?></a>
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
                                <th><?php echo get_phrase('Job'); ?></th>
                                <th><?php echo get_phrase('Name'); ?></th>
                                <th><?php echo get_phrase('Email'); ?></th>
                                <th><?php echo get_phrase('Phone'); ?></th>
                                <th><?php echo get_phrase('Date'); ?></th>
                                <th><?php echo get_phrase('Resume'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $key => $job) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $job['job_title']; ?></td>
                                    <td><?php echo $job['name']; ?></td>
                                    <td><?php echo $job['email']; ?></td>
                                    <td><?php echo $job['phone']; ?></td>
                                    <td><?php echo $job['date']; ?></td>
                                    <td><a href="<?php echo base_url('uploads/resume/' . $job['resume']); ?>" target="_blank">View Resume</a></td>
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