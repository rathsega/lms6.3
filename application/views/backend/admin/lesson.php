<?php

if (!$chapters || count($chapters) == 0){
    $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
}else{
    $lessons = $this->crud_model->get_lessons('chapter', $chapter['id'])->result_array();
}
foreach ($lessons as $index => $lesson) : ?>
    <div class="col-md-12">
        <!-- Portlet card -->
        <div class="card text-secondary on-hover-action mb-2 w-100" id="<?php echo 'lesson-' . $lesson['id']; ?>">
            <div class="card-body thinner-card-body">
                <div class="card-widgets display-none" id="widgets-of-lesson-<?php echo $lesson['id']; ?>">
                    <?php if ($lesson['lesson_type'] == 'quiz') : ?>
                        <a href="<?php echo site_url('home/lesson/' . slugify($course_details['title']) . '/' . $course_details['id'] . '/' . $lesson['id']); ?>" target="_blank" data-toggle="tooltip" title="<?php echo get_phrase('quiz_results'); ?>"><i class="mdi mdi-file-document-box-outline"></i></a>

                        <a href="javascript:;" onclick="showLargeModal('<?php echo site_url('modal/popup/quiz_questions/' . $lesson['id']); ?>', '<?php echo get_phrase('manage_quiz_questions'); ?>')" data-toggle="tooltip" title="<?php echo get_phrase('quiz_questions'); ?>"><i class="mdi mdi-comment-question-outline"></i></a>

                        <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/quiz_edit/' . $lesson['id'] . '/' . $course_id); ?>', '<?php echo get_phrase('update_quiz_information'); ?>')" data-toggle="tooltip" title="<?php echo get_phrase('edit'); ?>"><i class="mdi mdi-pencil-outline"></i></a>
                    <?php else : ?>
                        <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_edit/' . $lesson['id'] . '/' . $course_id); ?>', '<?php echo get_phrase('update_lesson'); ?>')" data-toggle="tooltip" title="<?php echo get_phrase('edit'); ?>"><i class="mdi mdi-pencil-outline"></i></a>
                    <?php endif; ?>
                    <a href="javascript:;" onclick="confirm_modal('<?php echo site_url('admin/lessons/' . $course_id . '/delete' . '/' . $lesson['id']); ?>');" data-toggle="tooltip" title="<?php echo get_phrase('delete'); ?>"><i class="mdi mdi-window-close"></i></a>
                </div>
                <h5 class="card-title mb-0">
                    <span class="font-weight-light">
                        <?php
                        if ($lesson['lesson_type'] == 'quiz') {
                            $quiz_counter++; // Keeps track of number of quiz
                            $lesson_type = $lesson['lesson_type'];
                        } else {
                            $lesson_counter++; // Keeps track of number of lesson
                            if ($lesson['attachment_type'] == 'txt' || $lesson['attachment_type'] == 'pdf' || $lesson['attachment_type'] == 'doc' || $lesson['attachment_type'] == 'img') {
                                $lesson_type = $lesson['attachment_type'];
                            } else {
                                $lesson_type = 'video';
                            }
                        }
                        ?>
                        <img src="<?php echo base_url('assets/backend/lesson_icon/' . $lesson_type . '.png'); ?>" alt="" height="16">
                        <?php echo $lesson['lesson_type'] == 'quiz' ? get_phrase('quiz') . ' ' . $quiz_counter : get_phrase('lesson') . ' ' . $lesson_counter; ?>
                    </span>: <?php echo $lesson['title']; ?>
                </h5>
            </div>
        </div> <!-- end card-->
    </div>
<?php endforeach; ?>