<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body py-2">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('generate_image_link'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row ">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo site_url('admin/customsettings/generate_image_link'); ?>" method="post" enctype="multipart/form-data">


                    <div class="form-group row mb-3">
                        <label class="col-md-5 col-form-label" for="image_file"><?php echo site_phrase('upload_image'); ?></label>
                        <div class="col-md-7">
                            <input type="file" class="form-control" name="image_file" id="image_file">
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button class="btn btn-success"><?php echo get_phrase('upload'); ?></button>
                    </div>
                    <div>Uploaded File Path : <?php echo base_url(). "uploads/image_files/" . $this->session->flashdata('flash_message'); ?></div>
                </form>
            </div>
        </div>
    </div>
</div>