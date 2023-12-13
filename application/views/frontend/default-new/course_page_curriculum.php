<div class="accordion curriculum-accordion mx-2">
    <?php
    $sections = $this->crud_model->get_section('course', $course_id)->result_array();
    foreach ($sections as $key => $section) : ?>
    <!-- Accordion Area -->
        <div class="accordion-item">
            <h2 class="accordion-header mx-2">
                <button class="accordion-button <?php if($key > 0) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#curriculumSectionCol<?php echo $section['id']; ?>" aria-expanded="false" aria-controls="curriculumSectionCol<?php echo $section['id']; ?>">
                    <div class="row w-100">
                        <div class="col-auto accordion-item-title d-flex flex-column">
                            

                            <!-- Study plan start-->
                            <?php if(date('d-M-Y-H-i-s', $section['start_date']) != date('d-M-Y-H-i-s', $section['end_date'])): ?>
                                <span style="margin-top: -10px;"><?php echo $section['title']; ?></span>
                                <small class="text-12px text-muted mt-1" data-bs-toggle="tooltip" title="<?php echo get_phrase('Study plan') ?>">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php if(date('d-M-Y', $section['start_date']) == date('d-M-Y', $section['end_date'])): ?>
                                         <?php echo date('d M Y', $section['start_date']); ?>:
                                         <?php echo date('h:i A', $section['start_date']).' - '.date('h:i A', $section['end_date']); ?>
                                    <?php else: ?>
                                        <?php echo date('d M Y h:i A', $section['start_date']).' - '.date('d M Y h:i A', $section['end_date']); ?>
                                    <?php endif ?>
                                </small>
                            <?php else: ?>
                                <span><?php echo $section['title']; ?></span>
                            <?php endif; ?>
                            <!-- Study plan END-->

                        </div>
                        <div class="col-auto ms-auto pe-0">
                            <span class="ms-auto me-2 pe-2 border-end text-14px text-muted fw-400">
                                <?php echo $this->crud_model->get_lessons('section', $section['id'])->num_rows() . ' ' . site_phrase('lessons'); ?>
                            </span>
                            <span class="me-0 text-14px text-muted fw-400">
                                <?php echo $this->crud_model->get_total_duration_of_lesson_by_section_id($section['id']); ?>
                            </span>
                        </div>
                    </div>
                </button>
            </h2>
            <div id="curriculumSectionCol<?php echo $section['id']; ?>" class="accordion-collapse collapse <?php if($key == 0) echo 'show'; ?>" data-bs-parent="#curriculumSection<?php echo $section['id']; ?>">
                <div class="accordion-body p-0">
                    <ul class="ac-lecture">
                        <?php 
                            $chapters = $this->crud_model->get_chapters('section', $section['id'])->result_array(); 
                            if($chapters && count($chapters) > 0){
                                include "course_page_curriculam_chapter.php";
                            }else{
                                $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
                                include "course_page_curriculam_lesson.php";
                            }
                        
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
