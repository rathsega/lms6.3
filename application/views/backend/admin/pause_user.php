<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo "Paused User Log"; ?>
                    <a href="<?php echo site_url('admin/user_status_modification'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo 'Pause User'; ?></a>
                    <a href="<?php echo base_url(); ?>excel_export/pauseduserlog" class="btn btn-outline-primary btn-rounded alignToTitle"><?php echo get_phrase('download'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive-sm">

                    <?php if (count($logs->result_array()) > 0) : ?>
                        <table id="basic-datatable" class="table table-striped table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logs->result_array() as $log) :
                                    date_default_timezone_set('Asia/Kolkata');
                                    $user_data = $this->db->get_where('users', array('email' => $log['email']))->row_array(); ?>
                                    <tr class="gradeU" style="color: <?php echo $user_data && $user_data['id'] ? 'green' : 'blue'; ?>;">
                                        <td>
                                            <b><?php echo $log['name']; ?></b><br>
                                            <small><?php echo $log['email']; ?></small>
                                        </td>
                                        <td data-sort='<?php echo strtotime($log['from_date']); ?>'><?php echo date('d-M-Y', strtotime($log['from_date'])); ?></td>
                                        <td><?php echo date('d-M-Y', strtotime($log['to_date'])); ?></td>
                                        <td>
                                            <?php if($log['from_date'] > date("Y-m-d")): ?>
                                                <a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_pause_user/' . $log['id']); ?>');"><?php echo get_phrase('Delete'); ?></a>
                                            <?php endif ?>
                                            <?php if($log['to_date'] > date("Y-m-d")): ?>
                                                <a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/update_pause_user/' . $log['id']); ?>');"><?php echo get_phrase('Edit'); ?></a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <?php if (count($logs->result_array()) == 0) : ?>
                        <div class="img-fluid w-100 text-center">
                            <img style="opacity: 1; width: 100px;" src="<?php echo base_url('assets/backend/images/file-search.svg'); ?>"><br>
                            <?php echo get_phrase('no_data_found'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script type="text/javascript">
    function update_date_range() {
        var x = $("#selectedValue").html();
        $("#date_range").val(x);
    }

    function redirect_to($url) {

    }
</script>