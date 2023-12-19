<?php
  if(is_array($watch_history) && !empty($watch_history['completed_lesson'])):
    $completed_lessons = json_decode($watch_history['completed_lesson'], true);
  else:
    $completed_lessons = array();
  endif;
  $completed_lessons = is_array($completed_lessons) ? $completed_lessons : array();
  $user_id = $this->session->userdata('user_id');
  $is_course_instructor = $this->crud_model->is_course_instructor($course_details['id'], $user_id);
  $is_locked = 0;
  $locked_lesson_ids = array();

  $restricted_section_ids = [];
  $is_restricted = 1;
?>
<?php if(is_array($sections) && count($sections) > 0): ?>
  <div class="course-playing-sidebar">
    <h4 class="title"><?php echo get_phrase('Course Content'); ?></h4>
    
    <!-- Content List -->
    <div class="accordion custom-accordion" id="accordionContent">
      <?php foreach($sections as $key => $section): ?>


        <!-- Study plan START-->
        <?php
          if($section['restricted_by'] == 'date_range' && time() >= $section['start_date'] && time() <= $section['end_date']){
            $is_restricted = 0;
          }

          if($section['restricted_by'] == 'start_date' && time() >= $section['start_date']){
            $is_restricted = 0;
          }

          if($section['restricted_by'] == ''){
            $is_restricted = 0;
          }

          if($is_course_instructor || $this->session->userdata('admin_login')){
            $is_restricted = 0;
          }

          if($is_restricted){
            $restricted_section_ids[] = $section['id'];
          }
        ?>
        <!-- Study plan END-->

        <div class="accordion-item">
          <h2 class="accordion-header" id="section<?php echo $section['id']; ?>">
            <button class="accordion-button <?php if($lesson_details['section_id'] != $section['id']) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $section['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $section['id'] ?>">
              <div class="d-flex flex-column" style="line-height:28px">
                <span><?php echo $section['title']; ?></span>

                <!-- Study plan start-->
                <?php if(date('d-M-Y-H-i-s', $section['start_date']) != date('d-M-Y-H-i-s', $section['end_date'])): ?>
                    <small class="text-12px text-muted" data-bs-toggle="tooltip" title="<?php echo get_phrase('Study plan') ?>">
                        <i class="far fa-calendar-alt"></i>
                        <?php if(date('d-M-Y', $section['start_date']) == date('d-M-Y', $section['end_date'])): ?>
                             <?php echo date('d M Y', $section['start_date']); ?>:
                             <?php echo date('h:i A', $section['start_date']).' - '.date('h:i A', $section['end_date']); ?>
                        <?php else: ?>
                            <?php echo date('d M Y h:i A', $section['start_date']).' - '.date('d M Y h:i A', $section['end_date']); ?>
                        <?php endif ?>
                    </small>
                <?php endif; ?>
                <!-- Study plan END-->
              </div>
                
            </button>
          </h2>
          <div id="collapseOne<?php echo $section['id'] ?>" class="accordion-collapse collapse <?php if($lesson_details['section_id'] == $section['id']) echo 'show'; ?>" aria-labelledby="section<?php echo $section['id']; ?>" data-bs-parent="#accordionContent">
            <div class="accordion-body position-relative">

              <?php if($is_restricted): ?>
                <div class="locked-section">
                  <div class="locked-card">
                    <i class="fas fa-lock text-30px"></i>
                    <h6 class="w-100 text-center text-dark my-2"><?php echo get_phrase('This section is not included in the current study plan'); ?></h6>
                    <small class="text-12px"><?php echo date('d M Y h:i A', $section['start_date']).' - '.date('d M Y h:i A', $section['end_date']); ?></small>
                  </div>
                </div>
              <?php endif; ?>

              <?php 
                $chapters = $this->crud_model->get_chapters('section', $section['id'])->result_array();
                if (!$chapters || count($chapters) == 0){
                  $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
                  include "sidebar_lessons.php";
                }else{
                  include "sidebar_chapters.php";
                }
              ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>


<script type="text/javascript">
  $(document).ready(function() {
    $('.checkbox-box').each(function(index) {
      var checkboxBox = $(this).html();
      $(this).parent().parent().prepend('<div class="checkbox custom-checkbox" style="width: 20px; height: 20px;">'+checkboxBox+'</div>');
      $(this).remove();
    });
  });

</script>