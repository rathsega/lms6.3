<div class="accordion curriculum-accordion mx-4">
    <?php
    foreach ($chapters as $key => $chapter) : ?>
    <!-- Accordion Area -->
        <div class="accordion-item">
            <h2 class="accordion-header mx-2">
                <button class="accordion-button <?php if($key > 0) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#curriculumChapterCol<?php echo $chapter['id']; ?>" aria-expanded="false" aria-controls="curriculumChapterCol<?php echo $chapter['id']; ?>">
                    <div class="row w-100">
                        <div class="col-auto accordion-item-title d-flex flex-column">
                            <span><?php echo $chapter['title']; ?></span>
                        </div>
                        <div class="col-auto ms-auto pe-0">
                            <span class="ms-auto me-2 pe-2 border-end text-14px text-muted fw-400">
                                <?php echo $this->crud_model->get_lessons('chapter', $chapter['id'])->num_rows() . ' ' . site_phrase('lessons'); ?>
                            </span>
                            <span class="me-0 text-14px text-muted fw-400">
                                <?php echo $video_course ? $this->crud_model->get_total_duration_of_lesson_by_chapter_id($chapter['id']) : ""; ?>
                            </span>
                        </div>
                    </div>
                </button>
            </h2>
            <div id="curriculumChapterCol<?php echo $chapter['id']; ?>" class="accordion-collapse collapse <?php if($key == 0) echo 'show'; ?>" data-bs-parent="#curriculumChapter<?php echo $chapter['id']; ?>">
                <div class="accordion-body pl-20">
                    <ul class="ac-lecture">
                        <?php $lessons = $this->crud_model->get_lessons('chapter', $chapter['id'])->result_array(); 
                            include "course_page_curriculam_lesson.php";
                        ?>                        
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
