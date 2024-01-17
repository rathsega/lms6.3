<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Sort Courses') . ': ' . $course_details['title']; ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<h5 class="card-title" class="mb-3" style="min-height: 45px;"><span class="font-weight-light">
    <div class="row justify-content-left alignToTitle" id="widgets-of-section">
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_top_courses'); ?>', 'Sort Top Courses')"><i class="mdi mdi-sort-variant"></i> <?php echo get_phrase('Sort Top Courses'); ?></button>
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_top_10_latest_courses'); ?>', 'Sort Top 10 Latest Courses')"><i class="mdi mdi-sort-variant"></i> <?php echo get_phrase('Sort Top 10 Latest Courses'); ?></button>
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_category_courses'); ?>', 'Sort Show in Category Courses')"><i class="mdi mdi-sort-variant"></i> <?php echo get_phrase('Sort Showin category Courses'); ?></button>
    </div>
</h5>
<div class="clearfix"></div>