<div class="accordion custom-accordion"  data-bs-parent="#accordionContent" id="accordionContentOne">
      <?php foreach($chapters as $key => $chapter): ?>

        <div class="accordion-item">
          <h2 class="accordion-header" id="chapter<?php echo $chapter['id']; ?>">
            <button class="accordion-button <?php if($lesson_details['chapter_id'] != $chapter['id']) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $chapter['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $chapter['id'] ?>">
              <div class="d-flex flex-column" style="line-height:28px">
                <span><?php echo $chapter['title']; ?></span>
              </div>
                
            </button>
          </h2>
          <div id="collapseOne<?php echo $chapter['id'] ?>" class="accordion-collapse collapse <?php if($lesson_details['chapter_id'] == $chapter['id']) echo 'show'; ?>" aria-labelledby="chapter<?php echo $chapter['id']; ?>" data-bs-parent="#accordionContentOne">
            <div class="accordion-body position-relative">

              <?php if($is_restricted): ?>
                <div class="locked-chapter">
                  <div class="locked-card">
                    <i class="fas fa-lock text-30px"></i>
                    <h6 class="w-100 text-center text-dark my-2"><?php echo get_phrase('This chapter is not included in the current study plan'); ?></h6>
                    <small class="text-12px"><?php echo date('d M Y h:i A', $chapter['start_date']).' - '.date('d M Y h:i A', $chapter['end_date']); ?></small>
                  </div>
                </div>
              <?php endif; ?>

              <?php 
                  $lessons = $this->crud_model->get_lessons('chapter', $chapter['id'])->result_array();
                  include "sidebar_lessons.php";
              ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>