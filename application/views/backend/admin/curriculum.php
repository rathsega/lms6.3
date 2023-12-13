<?php
$sections = $this->crud_model->get_section('course', $course_id)->result_array();
?>
<div class="row justify-content-center">
    <div class="col-xl-12 mb-4 text-center mt-3">
        <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/section_add/' . $course_id); ?>', '<?php echo get_phrase('add_new_section'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_section'); ?></a>
        <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/chapter_add/' . $course_id); ?>', '<?php echo get_phrase('add_new_chapter'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_chapter'); ?></a>
        <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_types/' . $course_id); ?>', '<?php echo get_phrase('add_new_lesson'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_lesson'); ?></a>
        <?php if (count($sections) > 0) : ?>
            <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/quiz_add/' . $course_id); ?>', '<?php echo get_phrase('add_new_quiz'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_quiz'); ?></a>
            <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_section/' . $course_id); ?>', '<?php echo get_phrase('sort_sections'); ?>')"><i class="mdi mdi-sort-variant"></i> <?php echo get_phrase('sort_sections'); ?></a>
        <?php endif; ?>
    </div>

    <div class="col-xl-8">
        <div class="row">
            <?php
            $lesson_counter = 0;
            $quiz_counter   = 0;
            foreach ($sections as $key => $section) : ?>
                <div class="col-xl-12">
                    <div class="card bg-light text-seconday on-hover-action mb-5" id="section-<?php echo $section['id']; ?>">
                        <div class="card-body">
                            <?php $chapters = $this->crud_model->get_chapters('section', $section['id'])->result_array(); ?>

                            <!-- Study plan -->
                            <?php if (date('d-M-Y-H-i-s', $section['start_date']) != date('d-M-Y-H-i-s', $section['end_date'])) : ?>
                                <p class="bg-dark text-center" style="padding: 8px 9px; border-radius: 6px 6px 0px 0px !important; font-weight: 700; margin: -25px -25px 15px -25px;">
                                    <?php echo get_phrase('Study plan'); ?>

                                    <?php if (date('d-M-Y', $section['start_date']) == date('d-M-Y', $section['end_date'])) : ?>
                                        - <?php echo date('d M Y', $section['start_date']); ?>
                                        <br>
                                        <?php echo date('h:i A', $section['start_date']) . ' ' . get_phrase('To') . ' ' . date('h:i A', $section['end_date']); ?>
                                    <?php else : ?>
                                        <br>
                                        <?php echo date('d M Y h:i A', $section['start_date']) . ' - ' . date('d M Y h:i A', $section['end_date']); ?>
                                    <?php endif ?>
                                </p>
                            <?php endif; ?>
                            <!-- Study plan END-->

                            <h5 class="card-title" class="mb-3" style="min-height: 45px;"><span class="font-weight-light"><?php echo get_phrase('section') . ' ' . ++$key; ?></span>: <?php echo $section['title']; ?>
                                <div class="row justify-content-center alignToTitle display-none" id="widgets-of-section-<?php echo $section['id']; ?>">
                                    <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button" onclick="showLargeModal('<?php echo $chapters && count($chapters) > 0 ? site_url('modal/popup/sort_chapter/' . $section['id']) : site_url('modal/popup/sort_lesson_by_section/' . $section['id']); ?>', '<?php echo  $chapters && count($chapters) > 0 ? get_phrase('sort_chapters') : get_phrase('sort_lessons'); ?>')"><i class="mdi mdi-sort-variant"></i> <?php echo $chapters && count($chapters) > 0 ? get_phrase('sort_chapter') :  get_phrase('sort_lesson'); ?></button>
                                    <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm ml-1" name="button" onclick="showAjaxModal('<?php echo site_url('modal/popup/section_edit/' . $section['id'] . '/' . $course_id); ?>', '<?php echo get_phrase('update_section'); ?>')"><i class="mdi mdi-pencil-outline"></i> <?php echo get_phrase('edit_section'); ?></button>
                                    <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm ml-1" name="button" onclick="confirm_modal('<?php echo site_url('admin/sections/' . $course_id . '/delete' . '/' . $section['id']); ?>');"><i class="mdi mdi-window-close"></i> <?php echo get_phrase('delete_section'); ?></button>
                                </div>
                            </h5>
                            <div class="clearfix"></div>

                            <div class="col-xl-12">
                                <div class="row">
                                    <?php
                                    if (!$chapters || count($chapters) == 0): ?>
                                        <?php include 'lesson.php'; ?>
                                    <?php else : ?>
                                        <?php include 'chapter.php'; ?>
                                    <?php endif ?>                                    
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>