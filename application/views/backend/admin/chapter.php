<?php foreach ($chapters as $key => $chapter) : ?>
    <div class="col-xl-12">
        <div class="card bg-light text-seconday on-hover-action mb-1" id="chapter-<?php echo $chapter['id']; ?>">
            <div class="card-body">
                <h5 class="card-title" class="mb-3" style="min-height: 45px;"><span class="font-weight-light"><?php echo get_phrase('chapter') . ' ' . ++$key; ?></span>: <?php echo $chapter['title']; ?>
                    <div class="row justify-content-center alignToTitle display-none" id="widgets-of-chapter-<?php echo $chapter['id']; ?>">
                        <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_lesson_by_chapter/' . $section['id'] .'/' . $chapter['id']); ?>', '<?php echo get_phrase('sort_lessons'); ?>')"><i class="mdi mdi-sort-variant"></i> <?php echo get_phrase('sort_lesson'); ?></button>
                        <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm ml-1" name="button" onclick="showAjaxModal('<?php echo site_url('modal/popup/chapter_edit/' . $course_id. '/' . $section['id'] .'/' . $chapter['id'] ); ?>', '<?php echo get_phrase('update_chapter'); ?>')"><i class="mdi mdi-pencil-outline"></i> <?php echo get_phrase('edit_chapter'); ?></button>
                        <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm ml-1" name="button" onclick="confirm_modal('<?php echo site_url('admin/chapters/' . $course_id . '/delete' . '/' . $chapter['id']); ?>');"><i class="mdi mdi-window-close"></i> <?php echo get_phrase('delete_chapter'); ?></button>
                    </div>
                </h5>
                <div class="clearfix"></div>

                <?php include 'lesson.php'; ?>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
<?php endforeach; ?>