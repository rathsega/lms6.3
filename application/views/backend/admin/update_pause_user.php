<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo 'Pause / Resume User'; ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('Pause / Resume User'); ?></h4>
                    <?php  //var_dump($this->crud_model->enrolled_users());exit; ?>
                    <form class="required-form" action="<?php echo site_url('admin/update_pause_user_record/'). $data->id ; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="multiple_user_id"><?php echo get_phrase('user'); ?> :  </label>
                            <?php echo $data->name; ?> (<?php echo $data->email; ?>) - <?php echo $data->status == 1 ? 'Active' : 'Paused'; ?>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>" ?>
                        <div class="form-group"  id="from_date">
                        <label class="col-md-5 col-form-label" for="from_date"><?php echo get_phrase('from_date'); ?> <span class="required">*</span> </label>
                            <div class="col-md-7">
                                <input type="date" class="form-control"  min="<?= date('Y-m-d'); ?>" id="from_date_picker" value="<?= date('Y-m-d', strtotime($data->from_date)); ?>" name="from_date" placeholder="<?php echo get_phrase('enter_from_date'); ?>" required>
                            </div>
                        </div>

                        <div class="form-group"  id="to_date">
                            <label class="col-md-5 col-form-label" for="to_date"><?php echo get_phrase('to_date'); ?> <span class="required">*</span> </label>
                            <div class="col-md-7">
                                <input type="date" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d', strtotime($data->to_date)); ?>" name="to_date" placeholder="<?php echo get_phrase('enter_to_date'); ?>" required>
                            </div>
                        </div>

                        <button type="button" id="submit_button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('Update'); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
