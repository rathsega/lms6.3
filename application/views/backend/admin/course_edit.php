<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
function is_json_array_empty($json_string)
{
    $decoded_array = json_decode($json_string, true);

    // Check if the JSON decoding was successful and the result is an array
    if (is_array($decoded_array)) {
        // Check if the array is empty
        return empty($decoded_array);
    } else {
        // Handle invalid JSON string if necessary
        // For example, you can throw an exception or return false
        return true; // Assuming invalid JSON is considered "empty"
    }
}
if (is_json_array_empty($course_details["career_growth"])) {
    $course_details["career_growth"][] = array("job_title" => "", "min_salary" => "", "max_salary" => "", "company" => array(), "growth" => "");
    $course_details["career_growth"] = json_encode($course_details["career_growth"]);
}
?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('update') . ': ' . $course_details['title']; ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!--ajax page loader-->
            <div class="ajax_loader w-100">
                <div class="ajax_loaderBar"></div>
            </div>
            <!--end ajax page loader-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="header-title my-1"><?php echo get_phrase('course_manager'); ?></h4>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo site_url('admin/preview/' . $course_id); ?>" class="alignToTitle btn btn-outline-secondary btn-rounded btn-sm ml-1 my-1" target="_blank"><?php echo get_phrase('view_on_frontend'); ?> <i class="mdi mdi-arrow-right"></i> </a>

                        <a href="<?php echo site_url('admin/courses'); ?>" class="alignToTitle btn btn-outline-secondary btn-rounded btn-sm my-1"> <i class=" mdi mdi-keyboard-backspace"></i> <?php echo get_phrase('back_to_course_list'); ?></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <form class="required-form" action="<?php echo site_url('admin/course_actions/edit/' . $course_id); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="scrollable-tab-section" id="basicwizard">

                                <button type="button" class="scrollable-tab-btn-left"><i class="mdi mdi-arrow-left"></i></button>

                                <div class="scrollable-tab">
                                    <ul class="nav nav-pills nav-justified form-wizard-header">
                                        <li class="nav-item">
                                            <a href="#curriculum" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-account-circle"></i>
                                                <span class=""><?php echo get_phrase('curriculum'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#academic_progress" onclick="student_academic_progress('<?php echo $course_details['id']; ?>')" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-chart-bar-stacked"></i>
                                                <span class=""><?php echo get_phrase('Academic progress'); ?></span>
                                            </a>
                                        </li>
                                        <?php if (addon_status('live-class')) : ?>
                                            <li class="nav-item jitsiLiveClassNavItem">
                                                <a href="#live-class" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                    <i class="mdi mdi-video-account"></i>
                                                    <span class=""><?php echo get_phrase('zoom_live_class'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (addon_status('jitsi-live-class')) : ?>
                                            <li class="nav-item">
                                                <a href="#jitsi-live-class" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                    <i class="mdi mdi-video-account"></i>
                                                    <span class=""><?php echo get_phrase('jitsi_live_class'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (addon_status('assignment')) : ?>
                                            <li class="nav-item">
                                                <a href="#assignment" onclick="load_assignment_list()" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                    <i class="dripicons-document"></i>
                                                    <span class=""><?php echo get_phrase('assignment'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (addon_status('noticeboard')) : ?>
                                            <li class="nav-item">
                                                <a href="#noticeboard" onclick="load_notic_list()" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                    <i class="mdi mdi-clipboard-text-outline"></i>
                                                    <span class=""><?php echo get_phrase('noticeboard'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (addon_status('course_analytics')) : ?>
                                            <li class="nav-item">
                                                <a href="#course_analytics" onclick="load_analytics_chart()" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                    <i class="mdi mdi-chart-bar"></i>
                                                    <span class=""><?php echo get_phrase('analytics'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <li class="nav-item">
                                            <a href="#basic" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-fountain-pen-tip"></i>
                                                <span class=""><?php echo get_phrase('basic'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-information-outline"></i>
                                                <span class=""><?php echo get_phrase('info'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#pricing" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-currency-cny"></i>
                                                <span class=""><?php echo get_phrase('pricing'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#media" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-library-video"></i>
                                                <span class=""><?php echo get_phrase('media'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#seo" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('seo'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#email_template" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('email_template'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#upcoming_batches" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('upcoming_batches'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#growth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('growth'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#about" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('About (X)'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#future" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('Future of the course (X)'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#learn" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('What will you learn (X)'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#growth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('Course growth (X)'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#other" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('Other details (X)'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                                <span class=""><?php echo get_phrase('finish'); ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <button type="button" class="scrollable-tab-btn-right"><i class="mdi mdi-arrow-right"></i></button>

                                <div class="tab-content b-0 mb-0">
                                    <div class="tab-pane" id="curriculum">
                                        <?php
                                        if ($course_details['course_type'] == 'general') :
                                            include 'curriculum.php';
                                        elseif ($course_details['course_type'] == 'scorm' && addon_status('scorm_course') == true) :
                                            include 'scorm_curriculum.php';
                                        elseif ($course_details['course_type'] == 'h5p' && addon_status('h5p') == true) :
                                            include 'h5p_curriculum.php';
                                        else : ?>
                                            <?php if ($course_details['course_type'] == 'scorm_course') : ?>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="alert alert-warning" role="alert">
                                                            <h4 class="alert-heading"><?= get_phrase('heads_up'); ?>!</h4>
                                                            <p><?= get_phrase('currently_the_scorm_course_addon_is_deactivate'); ?>. <?= get_phrase('please_activate_the_scorm_course_addon_to_use_it'); ?>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($course_details['course_type'] == 'h5p') : ?>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="alert alert-warning" role="alert">
                                                            <h4 class="alert-heading"><?= get_phrase('heads_up'); ?>!</h4>
                                                            <p><?= get_phrase('currently_the_h5p_course_addon_is_deactivate'); ?>. <?= get_phrase('please_activate_the_h5p_course_addon_to_use_it'); ?>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tab-pane" id="academic_progress"></div>

                                    <!-- LIVE CLASS CODE BASE -->
                                    <?php if (addon_status('live-class')) : ?>
                                        <?php include 'live_class.php'; ?>
                                    <?php endif; ?>

                                    <!-- Jitsi live class CODE BASE -->
                                    <?php if (addon_status('jitsi-live-class')) : ?>
                                        <div class="tab-pane" id="jitsi-live-class">
                                            <?php include 'jitsi_live_class.php'; ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- LIVE CLASS CODE BASE -->

                                    <!-- ASSIGNMENT CODE BASE -->
                                    <?php if (addon_status('assignment')) : ?>
                                        <div class="tab-pane" id="assignment">
                                            <?php include 'assignment.php'; ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- NOTICEBOARD CODE BASE -->
                                    <?php if (addon_status('noticeboard')) : ?>
                                        <div class="tab-pane" id="noticeboard">
                                            <?php include 'noticeboard.php'; ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- NOTICEBOARD CODE BASE -->

                                    <!-- COURSE ANALYTICS CODE BASE -->
                                    <?php if (addon_status('course_analytics')) : ?>
                                        <div class="tab-pane" id="course_analytics">
                                            <?php include 'course_analytics.php'; ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- COURSE ANALYTICS CODE BASE -->

                                    <div class="tab-pane" id="basic">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="course_type"><?php echo get_phrase('course_type'); ?></label>
                                                    <div class="col-md-10">
                                                        <div class="alert alert-light" role="alert">
                                                            <h4 class="alert-heading"><?= get_phrase($course_details['course_type']); ?></h4>
                                                            <hr class="m-1">
                                                            <p class="mb-0"><?= get_phrase('the_course_type_can_not_be_editable'); ?>.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="existing_instructors"><?php echo get_phrase('instructor_of_this_course'); ?></label>
                                                    <div class="col-md-10">
                                                        <?php if ($course_details['multi_instructor']) :
                                                            $instructor_ids = explode(',', $course_details['user_id']);
                                                        ?>
                                                            <?php foreach ($instructor_ids as $instructor_id) :
                                                            ?>
                                                                <?php $instructor_details = $this->user_model->get_instructor($instructor_id)->row_array(); ?>
                                                                <div class="m-2">
                                                                    <img class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']);; ?>" height="30px" alt="">
                                                                    <span style="font-weight: 700; font-size: 15px; vertical-align: sub; margin-left: 6px;">
                                                                        <?php echo html_escape($instructor_details['first_name'] . ' ' . $instructor_details['last_name']); ?>
                                                                    </span>
                                                                    <?php if (count($instructor_ids) > 1 && $course_details['creator'] != $instructor_id) : ?>
                                                                        <a href="javascript:void(0)" onclick="confirm_modal('<?php echo site_url('admin/remove_an_instructor/' . $course_details['id'] . '/' . $instructor_details['id']); ?>');" style="display: inline-block; height: 20px; width: 20px; border-radius: 50%; background-color: rgb(239,83,80); color: white; margin-left: 6px; vertical-align: sub;"> <i class="mdi mdi-window-close" style="margin-left: 3px; font-weight: bold; vertical-align: middle;"></i> </a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else : ?>
                                                            <?php $instructor_details = $this->user_model->get_instructor($course_details['user_id'])->row_array(); ?>
                                                            <div>
                                                                <img class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']);; ?>" height="30px" alt="">
                                                                <span style="font-weight: 700; font-size: 15px; vertical-align: sub; margin-left: 6px;">
                                                                    <?php echo html_escape($instructor_details['first_name'] . ' ' . $instructor_details['last_name']); ?>
                                                                </span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="new_instructor"><?php echo get_phrase('add_new_instructor'); ?></label>
                                                    <div class="col-md-10">
                                                        <select class="select2 form-control multi-select-dropdown" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="new_instructors[]">
                                                            <?php $instructors = $this->user_model->get_instructor()->result_array(); ?>
                                                            <?php foreach ($instructors as $key => $instructor) : ?>
                                                                <option value="<?php echo html_escape($instructor['id']); ?>"><?php echo html_escape($instructor['first_name'] . ' ' . $instructor['last_name']); ?> ( <?php echo html_escape($instructor['email']); ?> )</option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="course_title"><?php echo get_phrase('course_title'); ?><span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="course_title" name="title" placeholder="<?php echo get_phrase('enter_course_title'); ?>" value="<?php echo $course_details['title']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="short_description"><?php echo get_phrase('short_description'); ?></label>
                                                    <div class="col-md-10">
                                                        <textarea name="short_description" id="short_description" class="form-control"><?php echo $course_details['short_description']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="description"><?php echo get_phrase('description'); ?></label>
                                                    <div class="col-md-10">
                                                        <textarea name="description" id="description" class="form-control"><?php echo $course_details['description']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="sub_category_id"><?php echo get_phrase('category'); ?><span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <select class="form-control select2" data-toggle="select2" name="sub_category_id" id="sub_category_id" required>
                                                            <option value=""><?php echo get_phrase('select_a_category'); ?></option>
                                                            <?php foreach ($categories->result_array() as $category) : ?>
                                                                <optgroup label="<?php echo $category['name']; ?>">
                                                                    <?php $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                                                                    foreach ($sub_categories as $sub_category) : ?>
                                                                        <option value="<?php echo $sub_category['id']; ?>" <?php if ($sub_category['id'] == $course_details['sub_category_id']) echo 'selected'; ?>><?php echo $sub_category['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </optgroup>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-muted"><?php echo get_phrase('select_sub_category'); ?></small>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="level"><?php echo get_phrase('level'); ?></label>
                                                    <div class="col-md-10">
                                                        <select class="form-control select2" data-toggle="select2" name="level" id="level">
                                                            <option value="beginner" <?php if ($course_details['level'] == "beginner") echo 'selected'; ?>><?php echo get_phrase('beginner'); ?></option>
                                                            <option value="advanced" <?php if ($course_details['level'] == "advanced") echo 'selected'; ?>><?php echo get_phrase('advanced'); ?></option>
                                                            <option value="intermediate" <?php if ($course_details['level'] == "intermediate") echo 'selected'; ?>><?php echo get_phrase('intermediate'); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="language_made_in"><?php echo get_phrase('language_made_in'); ?></label>
                                                    <div class="col-md-10">
                                                        <select class="form-control select2" data-toggle="select2" name="language_made_in" id="language_made_in">
                                                            <?php foreach ($languages as $language) : ?>
                                                                <option value="<?php echo $language; ?>" <?php if ($course_details['language'] == $language) echo 'selected'; ?>><?php echo ucfirst($language); ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="enable_drip_content"><?php echo get_phrase('enable_drip_content'); ?></label>
                                                    <div class="col-md-10 pt-2">
                                                        <input type="checkbox" name="enable_drip_content" value="1" id="enable_drip_content" data-switch="primary" <?php if ($course_details['enable_drip_content'] == 1) echo 'checked'; ?>>
                                                        <label for="enable_drip_content" data-on-label="On" data-off-label="Off"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label pt-1" for="enable_drip_content"><?php echo get_phrase('Updated as a'); ?></label>
                                                    <div class="col-md-10 pt-1">
                                                        <div class="custom-control custom-radio mb-1">
                                                            <input type="radio" id="status_active" name="status" class="custom-control-input" value="active" <?php echo $course_details['status'] == 'active' ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="status_active"><?php echo get_phrase('Active course'); ?></label>
                                                        </div>

                                                        <div class="custom-control custom-radio mb-1">
                                                            <input type="radio" id="status_private" name="status" class="custom-control-input" value="private" <?php echo $course_details['status'] == 'private' ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="status_private"><?php echo get_phrase('Private course'); ?></label>
                                                        </div>

                                                        <div class="custom-control custom-radio mb-1">
                                                            <input type="radio" id="status_upcoming" name="status" class="custom-control-input" value="upcoming" <?php echo $course_details['status'] == 'upcoming' ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="status_upcoming"><?php echo get_phrase('Upcoming course'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="offset-md-2 col-md-10">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="is_top_course" id="is_top_course" value="1" <?php if ($course_details['is_top_course'] == 1) echo 'checked'; ?>>
                                                            <label class="custom-control-label" for="is_top_course"><?php echo get_phrase('check_if_this_course_is_top_course'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <div class="offset-md-2 col-md-10">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="is_top10_course" id="is_top10_course" value="1" <?php if ($course_details['is_top10_course'] == 1) echo 'checked'; ?>>
                                                            <label class="custom-control-label" for="is_top10_course"><?php echo get_phrase('check_if_this_course_is_top10_course') . " <b>(X)</b>"; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <div class="offset-md-2 col-md-10">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="show_it_in_category" id="show_it_in_category" value="1" <?php if ($course_details['show_it_in_category'] == 1) echo 'checked'; ?>>
                                                            <label class="custom-control-label" for="show_it_in_category"><?php echo get_phrase('check_if_this_course_should_show_in_category') . " <b>(X)</b>"; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="course_duration_in_hours"><?php echo get_phrase('course_duration_in_hours') . " <b>(X)</b>"; ?> </label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="course_duration_in_hours" name="course_duration_in_hours" value="<?php echo $course_details['course_duration_in_hours']; ?>" placeholder="HH:MM:SS">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="course_duration_in_months"><?php echo get_phrase('course_duration_in_months') . " <b>(X)</b>"; ?> </label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="course_duration_in_months" name="course_duration_in_months" value="<?php echo $course_details['course_duration_in_months']; ?>" placeholder="2.5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="daily_class_duration_in_hours"><?php echo get_phrase('daily_class_duration_in_hours') . " <b>(X)</b>"; ?> </label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="daily_class_duration_in_hours" name="daily_class_duration_in_hours" value="<?php echo $course_details['daily_class_duration_in_hours']; ?>" placeholder="2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div> <!-- end tab pane -->

                                    <div class="tab-pane" id="info">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="faq"><?php echo get_phrase('course_faq'); ?></label>
                                                    <div class="col-md-10">
                                                        <div id="faq_area">
                                                            <?php $faq_counter = 0; ?>
                                                            <?php $course_faqs_arr = !empty($course_details['faqs']) ? json_decode($course_details['faqs'], true) : []; ?>
                                                            <?php $course_faqs_arr = is_array($course_faqs_arr) ? $course_faqs_arr : array(); ?>
                                                            <?php foreach ($course_faqs_arr as $faq_title => $faq_description) : ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" value="<?php echo $faq_title; ?>" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                                                            <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"><?php echo $faq_description; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <?php if ($faq_counter == 0) : ?>
                                                                            <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendFaq()"> <i class="fa fa-plus"></i> </button>
                                                                        <?php else : ?>
                                                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeFaq(this)"> <i class="fa fa-minus"></i> </button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <?php $faq_counter++; ?>
                                                            <?php endforeach; ?>

                                                            <?php if ($faq_counter == 0) : ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                                                            <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendFaq()"> <i class="fa fa-plus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div id="blank_faq_field">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                                                            <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeFaq(this)"> <i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3 pt-2">
                                                    <label class="col-md-2 col-form-label" for="requirements"><?php echo get_phrase('requirements'); ?></label>
                                                    <div class="col-md-10">
                                                        <div id="requirement_area">
                                                            <?php if (count(json_decode($course_details['requirements'])) > 0) : ?>
                                                                <?php
                                                                $counter = 0;
                                                                foreach (json_decode($course_details['requirements']) as $requirement) : ?>
                                                                    <?php if ($counter == 0) :
                                                                        $counter++; ?>
                                                                        <div class="d-flex mt-2">
                                                                            <div class="flex-grow-1 px-3">
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>" value="<?php echo $requirement; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="">
                                                                                <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendRequirement()"> <i class="fa fa-plus"></i> </button>
                                                                            </div>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="d-flex mt-2">
                                                                            <div class="flex-grow-1 px-3">
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>" value="<?php echo $requirement; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="">
                                                                                <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeRequirement(this)"> <i class="fa fa-minus"></i> </button>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendRequirement()"> <i class="fa fa-plus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div id="blank_requirement_field">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeRequirement(this)"> <i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3 pt-2">
                                                    <label class="col-md-2 col-form-label" for="outcomes"><?php echo get_phrase('outcomes'); ?></label>
                                                    <div class="col-md-10">
                                                        <div id="outcomes_area">
                                                            <?php if (count(json_decode($course_details['outcomes'])) > 0) : ?>
                                                                <?php
                                                                $counter = 0;
                                                                foreach (json_decode($course_details['outcomes']) as $outcome) : ?>
                                                                    <?php if ($counter == 0) :
                                                                        $counter++; ?>
                                                                        <div class="d-flex mt-2">
                                                                            <div class="flex-grow-1 px-3">
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control" name="outcomes[]" placeholder="<?php echo get_phrase('provide_outcomes'); ?>" value="<?php echo $outcome; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="">
                                                                                <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendOutcome()"> <i class="fa fa-plus"></i> </button>
                                                                            </div>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="d-flex mt-2">
                                                                            <div class="flex-grow-1 px-3">
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control" name="outcomes[]" placeholder="<?php echo get_phrase('provide_outcomes'); ?>" value="<?php echo $outcome; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="">
                                                                                <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeOutcome(this)"> <i class="fa fa-minus"></i> </button>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="outcomes[]" placeholder="<?php echo get_phrase('provide_outcomes'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendOutcome()"> <i class="fa fa-plus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div id="blank_outcome_field">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="outcomes[]" id="outcomes" placeholder="<?php echo get_phrase('provide_outcomes'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeOutcome(this)"> <i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="pricing">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <div class="offset-md-2 col-md-10">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="is_free_course" id="is_free_course" value="1" <?php if ($course_details['is_free_course'] == 1) echo 'checked'; ?> onclick="togglePriceFields(this.id)">
                                                            <label class="custom-control-label" for="is_free_course"><?php echo get_phrase('check_if_this_is_a_free_course'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="paid-course-stuffs">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-2 col-form-label" for="price"><?php echo get_phrase('course_price') . ' (' . currency_code_and_symbol() . ')'; ?></label>
                                                        <div class="col-md-10">
                                                            <input type="number" class="form-control" id="price" name="price" min="0" placeholder="<?php echo get_phrase('enter_course_course_price'); ?>" value="<?php echo $course_details['price']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <div class="offset-md-2 col-md-10">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="discount_flag" id="discount_flag" value="1" <?php if ($course_details['discount_flag'] == 1) echo 'checked'; ?>>
                                                                <label class="custom-control-label" for="discount_flag"><?php echo get_phrase('check_if_this_course_has_discount'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-2 col-form-label" for="discounted_price"><?php echo get_phrase('discounted_price') . ' (' . currency_code_and_symbol() . ')'; ?></label>
                                                        <div class="col-md-10">
                                                            <input type="number" class="form-control" name="discounted_price" id="discounted_price" onkeyup="calculateDiscountPercentage(this.value)" value="<?php echo $course_details['discounted_price']; ?>" min="0">
                                                            <small class="text-muted"><?php echo get_phrase('this_course_has'); ?> <span id="discounted_percentage" class="text-danger">0%</span> <?php echo get_phrase('discount'); ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label"><?php echo get_phrase('Expiry period'); ?></label>
                                                    <div class="col-md-10 pt-2 d-flex">
                                                        <div class="custom-control custom-radio mr-2">
                                                            <input type="radio" id="lifetime_expiry_period" name="expiry_period" class="custom-control-input" value="lifetime" onchange="checkExpiryPeriod(this)" <?php if ($course_details['expiry_period'] == 0) echo 'checked'; ?>>
                                                            <label class="custom-control-label" for="lifetime_expiry_period"><?php echo get_phrase('Lifetime'); ?></label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="limited_expiry_period" name="expiry_period" class="custom-control-input" value="limited_time" onchange="checkExpiryPeriod(this)" <?php if ($course_details['expiry_period'] > 0) echo 'checked'; ?>>
                                                            <label class="custom-control-label" for="limited_expiry_period"><?php echo get_phrase('Limited time'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3" id="number_of_month" style="<?php if ($course_details['expiry_period'] == '') echo 'display: none'; ?>">
                                                    <label class="col-md-2 col-form-label"><?php echo get_phrase('Number of month'); ?></label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number" name="number_of_month" min="1" value="<?php echo $course_details['expiry_period']; ?>">
                                                        <small class="badge badge-light"><?php echo get_phrase('After purchase, students can access the course until your selected time.'); ?></small>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div> <!-- end tab-pane -->
                                    <div class="tab-pane" id="media">
                                        <div class="row justify-content-center">

                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="course_overview_provider"><?php echo get_phrase('course_overview_provider'); ?></label>
                                                    <div class="col-md-10">
                                                        <select class="form-control select2" data-toggle="select2" name="course_overview_provider" id="course_overview_provider">
                                                            <option value="youtube" <?php if ($course_details['course_overview_provider'] == 'youtube') echo 'selected'; ?>><?php echo get_phrase('youtube'); ?></option>
                                                            <option value="vimeo" <?php if ($course_details['course_overview_provider'] == 'vimeo') echo 'selected'; ?>><?php echo get_phrase('vimeo'); ?></option>
                                                            <option value="html5" <?php if ($course_details['course_overview_provider'] == 'html5') echo 'selected'; ?>><?php echo get_phrase('HTML5'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="course_overview_url"><?php echo get_phrase('course_overview_url'); ?></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="course_overview_url" id="course_overview_url" placeholder="E.g: https://www.youtube.com/watch?v=oBtf8Yglw2w" value="<?php echo $course_details['video_url'] ?>">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <!-- Course media content edit file starts -->
                                            <?php include 'course_media_edit.php'; ?>
                                            <!-- Course media content edit file ends -->
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="seo">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="website_keywords"><?php echo get_phrase('meta_keywords'); ?></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control bootstrap-tag-input" id="meta_keywords" name="meta_keywords" data-role="tagsinput" style="width: 100%;" value="<?php echo $course_details['meta_keywords']; ?>" placeholder="<?php echo get_phrase('write_a_keyword_and_then_press_enter_button'); ?>" . />
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="slug"><?php echo "Slug"; ?></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="slug" name="slug" style="width: 100%;" value="<?php echo $course_details['slug']; ?>" . />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="slug_count"><?php echo "Slug Count"; ?></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="slug_count" name="slug_count" style="width: 100%;" value="<?php echo $course_details['slug_count']; ?>" . />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="meta_description"><?php echo get_phrase('meta_description'); ?></label>
                                                    <div class="col-md-10">
                                                        <textarea name="meta_description" class="form-control"><?php echo $course_details['meta_description']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="email_template">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="subject"><?php echo get_phrase('subject'); ?></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control bootstrap-tag-input" id="subject" name="subject" style="width: 100%;" value="<?php echo $course_details['subject']; ?>" placeholder="<?php echo get_phrase('subject'); ?>" . />
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="message"><?php echo get_phrase('message'); ?></label>
                                                    <div class="col-md-10">
                                                        <textarea name="message" id="message" class="form-control"><?php echo $course_details['message']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="upcoming_batches">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-4 col-form-label" for="batch_1"><?php echo get_phrase('batch_1') . "(In IST)"; ?></label>
                                                    <div class="col-md-4">
                                                        <input type="datetime-local" class="form-control bootstrap-tag-input" id="batch_1" name="batch_1" style="width: 100%;" value="<?php echo $course_details['batch_1']; ?>" placeholder="<?php echo get_phrase('subject'); ?>" . />
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-4 col-form-label" for="batch_2"><?php echo get_phrase('batch_2') . "(In IST)"; ?></label>
                                                    <div class="col-md-4">
                                                        <input type="datetime-local" class="form-control bootstrap-tag-input" id="batch_2" name="batch_2" style="width: 100%;" value="<?php echo $course_details['batch_2']; ?>" placeholder="<?php echo get_phrase('subject'); ?>" . />
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="growth">
                                        <div class="row justify-content-center">
                                            <div id="growth_form_groups">
                                                <?php foreach (json_decode($course_details['career_growth']) as $gkey => $growth) : ?>

                                                    <div class="group">
                                                        <div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="title"><?php echo get_phrase('Title'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="job_title[]" style="width: 100%;" placeholder="<?php echo get_phrase('title'); ?>" value="<?php echo $growth->job_title; ?>" />
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="min_salary"><?php echo get_phrase('min_salary'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="min_salary[]" style="width: 100%;" placeholder="<?php echo get_phrase('min_salary'); ?>" value="<?php echo $growth->min_salary; ?>" />
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="max_salary"><?php echo get_phrase('max_salary'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="max_salary[]" style="width: 100%;" placeholder="<?php echo get_phrase('max_salary'); ?>" value="<?php echo $growth->max_salary; ?>" />
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="company"><?php echo get_phrase('Select Companies'); ?></label>
                                                                <div class="col-md-8">
                                                                    <select name="company[<?php echo $gkey; ?>][]" class="form-control select2" data-toggle="select2" multiple>
                                                                        <?php foreach ($companies as $company) : ?>
                                                                            <option value="<?php echo $company->id; ?>" <?php echo in_array($company->id, $growth->company) ? 'selected' : ''; ?>><?php echo $company->title; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="demand"><?php echo get_phrase('Demand in Percentage'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="demand[]" style="width: 100%;" placeholder="<?php echo get_phrase('Demand in Percentage'); ?>" value="<?php echo $growth->demand; ?>" />
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <div class="col-md-4">
                                                                    <button type="button" class="removeGroup">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                <?php endforeach; ?>

                                            </div>

                                        </div> <!-- end row -->
                                        <ul class="list-inline mb-4 wizard text-center">
                                            <li class="list-inline-item">
                                                <button type="button" class="btn btn-primary text-center" id="addGroup">Add Group</button>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="tab-pane" id="about">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="about"><?php echo get_phrase('About Course'); ?></label>
                                                    <div class="col-md-10">
                                                        <div id="about_area">
                                                            <?php $about_counter = 0; ?>
                                                            <?php $course_about_arr = !empty($course_details['about']) ? json_decode($course_details['about'], true) : []; ?>
                                                            <?php $course_about_arr = is_array($course_about_arr) ? $course_about_arr : array(); ?>
                                                            <?php foreach ($course_about_arr as $about_key => $about_val) : ?>
                                                                <?php $about_title = $about_val['title']; ?>
                                                                <?php $about_description = $about_val['description']; ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" value="<?php echo $about_title; ?>" name="about_title[]" id="about" placeholder="<?php echo get_phrase('about_title'); ?>">
                                                                            <textarea name="about_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"><?php echo $about_description; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <?php if ($about_counter == 0) : ?>
                                                                            <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendAbout()"> <i class="fa fa-plus"></i> </button>
                                                                        <?php else : ?>
                                                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeAbout(this)"> <i class="fa fa-minus"></i> </button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <?php $about_counter++; ?>
                                                            <?php endforeach; ?>

                                                            <?php if ($about_counter == 0) : ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="about_title[]" id="about" placeholder="<?php echo get_phrase('about_title'); ?>">
                                                                            <textarea name="about_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendAbout()"> <i class="fa fa-plus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div id="blank_about_field">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="about_title[]" id="about" placeholder="<?php echo get_phrase('about_title'); ?>">
                                                                            <textarea name="about_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeAbout(this)"> <i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="future">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="future"><?php echo get_phrase('Future of the course'); ?></label>
                                                    <div class="col-md-10">
                                                        <div id="future_area">
                                                            <?php $future_counter = 0; ?>
                                                            <?php $course_future_arr = !empty($course_details['future']) ? json_decode($course_details['future'], true) : []; ?>
                                                            <?php $course_future_arr = is_array($course_future_arr) ? $course_future_arr : array(); ?>
                                                            <?php foreach ($course_future_arr as $future_key => $future_val) : ?>
                                                                <?php $future_title = $future_val['title']; ?>
                                                                <?php $future_description = $future_val['description']; ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="file" name="future_icon[]" class="form-control" accept="image/*" placeholder="<?php echo get_phrase('icon'); ?>">
                                                                            Note : File size should be 92*75 px and format should be .webp only
                                                                            <input type="hidden" name="future_previous_icon[]" value="<?php if ($future_val['icon']) {
                                                                                                                                            echo $future_val['icon'];
                                                                                                                                        } ?>">

                                                                            <input type="text" class="form-control" value="<?php echo $future_title; ?>" name="future_title[]" id="future" placeholder="<?php echo get_phrase('future_title'); ?>">
                                                                            <textarea name="future_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"><?php echo $future_description; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <?php if ($future_counter == 0) : ?>
                                                                            <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendFuture()"> <i class="fa fa-plus"></i> </button>
                                                                        <?php else : ?>
                                                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeFuture(this)"> <i class="fa fa-minus"></i> </button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <?php $future_counter++; ?>
                                                            <?php endforeach; ?>

                                                            <?php if ($future_counter == 0) : ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="file" name="future_icon[]" class="form-control" accept="image/*" placeholder="<?php echo get_phrase('icon'); ?>">
                                                                            Note : File size should be 92*75 px and format should be .webp only
                                                                            <input type="text" class="form-control" name="future_title[]" id="future" placeholder="<?php echo get_phrase('future_title'); ?>">
                                                                            <textarea name="future_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendFuture()"> <i class="fa fa-plus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div id="blank_future_field">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="file" name="future_icon[]" class="form-control" accept="image/*" placeholder="<?php echo get_phrase('icon'); ?>">
                                                                            Note : File size should be 92*75 px and format should be .webp only
                                                                            <input type="text" class="form-control" name="future_title[]" id="future" placeholder="<?php echo get_phrase('future_title'); ?>">
                                                                            <textarea name="future_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeFuture(this)"> <i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="learn">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="learn"><?php echo get_phrase('learn of the course'); ?></label>
                                                    <div class="col-md-10">
                                                        <div id="learn_area">
                                                            <?php $learn_counter = 0; ?>
                                                            <?php $course_learn_arr = !empty($course_details['learn']) ? json_decode($course_details['learn'], true) : []; ?>
                                                            <?php $course_learn_arr = is_array($course_learn_arr) ? $course_learn_arr : array(); ?>
                                                            <?php foreach ($course_learn_arr as $learn_key => $learn_val) : ?>
                                                                <?php $learn_title = $learn_val['title']; ?>
                                                                <?php $learn_description = $learn_val['description']; ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="file" name="learn_icon[]" class="form-control" accept="image/*" placeholder="<?php echo get_phrase('icon'); ?>">
                                                                            Note : File size should be 94*92 px and format should be .webp only
                                                                            <input type="hidden" name="learn_previous_icon[]" value="<?php if ($learn_val['icon']) {
                                                                                                                                            echo $learn_val['icon'];
                                                                                                                                        } ?>">
                                                                            <input type="text" class="form-control" value="<?php echo $learn_title; ?>" name="learn_title[]" id="learn" placeholder="<?php echo get_phrase('learn_title'); ?>">
                                                                            <textarea name="learn_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"><?php echo $learn_description; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <?php if ($learn_counter == 0) : ?>
                                                                            <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendLearn()"> <i class="fa fa-plus"></i> </button>
                                                                        <?php else : ?>
                                                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeLearn(this)"> <i class="fa fa-minus"></i> </button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <?php $learn_counter++; ?>
                                                            <?php endforeach; ?>

                                                            <?php if ($learn_counter == 0) : ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="file" name="learn_icon[]" class="form-control" accept="image/*" placeholder="<?php echo get_phrase('icon'); ?>">
                                                                            Note : File size should be 94*92 px and format should be .webp only
                                                                            <input type="text" class="form-control" name="learn_title[]" id="learn" placeholder="<?php echo get_phrase('learn_title'); ?>">
                                                                            <textarea name="learn_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('description'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendLearn()"> <i class="fa fa-plus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div id="blank_learn_field">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 px-3">
                                                                        <div class="form-group">
                                                                            <input type="file" name="learn_icon[]" class="form-control" accept="image/*" placeholder="<?php echo get_phrase('icon'); ?>">
                                                                            Note : File size should be 94*92 px and format should be .webp only
                                                                            <input type="text" class="form-control" name="learn_title[]" id="learn" placeholder="<?php echo get_phrase('learn_title'); ?>">
                                                                            <textarea name="learn_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('description'); ?>"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeLearn(this)"> <i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="growth">
                                        <div class="row justify-content-center">
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label" for="growth"><?php echo get_phrase('Course growth'); ?></label>
                                                <div class="col-md-8">
                                                    <div id="growth_area">
                                                        <?php $growth_counter = 0; ?>
                                                        <?php $course_growth_arr = !empty($course_details['growth']) ? json_decode($course_details['growth'], true) : []; ?>
                                                        <?php $course_growth_arr = is_array($course_growth_arr) ? $course_growth_arr : array(); ?>
                                                        <?php foreach ($course_growth_arr as $growth_key => $growth_val) : ?>
                                                            <?php $growth_title = $growth_val['title']; ?>
                                                            <?php $growth_description = $growth_val['description']; ?>
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" value="<?php echo $growth_title; ?>" name="growth_title[]" id="growth" placeholder="<?php echo get_phrase('growth_title'); ?>">
                                                                        <textarea name="growth_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('description'); ?>"><?php echo $growth_description; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <?php if ($growth_counter == 0) : ?>
                                                                        <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendGrowth()"> <i class="fa fa-plus"></i> </button>
                                                                    <?php else : ?>
                                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeGrowth(this)"> <i class="fa fa-minus"></i> </button>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <?php $growth_counter++; ?>
                                                        <?php endforeach; ?>

                                                        <?php if ($growth_counter == 0) : ?>
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="growth_title[]" id="growth" placeholder="<?php echo get_phrase('growth_title'); ?>">
                                                                        <textarea name="growth_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('description'); ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendGrowth()"> <i class="fa fa-plus"></i> </button>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div id="blank_growth_field">
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="growth_title[]" id="growth" placeholder="<?php echo get_phrase('growth_title'); ?>">
                                                                        <textarea name="growth_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('description'); ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeGrowth(this)"> <i class="fa fa-minus"></i> </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="other">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="experience"><?php echo get_phrase('Experience'); ?></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control bootstrap-tag-input" id="experience" name="experience" data-role="experience" style="width: 100%;" value="<?php echo $course_details['experience']; ?>" placeholder="<?php echo get_phrase('enter the years of experience in course teaching'); ?>" . />
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="template"><?php echo get_phrase('template'); ?></label>
                                                    <div class="col-md-10">
                                                        <select class="form-control select2" data-toggle="select2" name="template" id="template">
                                                            <option value="default" <?php if ($course_details['template'] == "default") echo 'selected'; ?>><?php echo get_phrase('default'); ?></option>
                                                            <option value="template one" <?php if ($course_details['template'] == "template one") echo 'selected'; ?>><?php echo get_phrase('template one'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="weekend_track_course_duration_in_months"><?php echo get_phrase('weekend_track_course_duration_in_months'); ?> </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="weekend_track_course_duration_in_months" name="weekend_track_course_duration_in_months" value="<?php echo $course_details['weekend_track_course_duration_in_months']; ?>" placeholder="2.5">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="weekend_track_daily_class_duration_in_hours"><?php echo get_phrase('weekend_track_daily_class_duration_in_hours'); ?> </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="weekend_track_daily_class_duration_in_hours" name="weekend_track_daily_class_duration_in_hours" value="<?php echo $course_details['weekend_track_daily_class_duration_in_hours']; ?>" placeholder="2">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="weekend_track_course_price"><?php echo get_phrase('weekend_track_course_price'); ?> </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="weekend_track_course_price" name="weekend_track_course_price" value="<?php echo $course_details['weekend_track_course_price']; ?>" placeholder="28000">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="week_track_sessions_count"><?php echo get_phrase('week_track_sessions_count'); ?> </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="week_track_sessions_count" name="week_track_sessions_count" value="<?php echo $course_details['week_track_sessions_count']; ?>" placeholder="25">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="weekend_track_sessions_count"><?php echo get_phrase('weekend_track_sessions_count'); ?> </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="weekend_track_sessions_count" name="weekend_track_sessions_count" value="<?php echo $course_details['weekend_track_sessions_count']; ?>" placeholder="25">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="number_of_lectures"><?php echo get_phrase('number_of_lectures'); ?> </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="number_of_lectures" name="number_of_lectures" value="<?php echo $course_details['number_of_lectures']; ?>" placeholder="25">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="banner_image_label"><?php echo get_phrase("banner image"); ?></label>
                                                    <div class="col-md-10">
                                                        <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                            <div class="box" style="width: 250px;">
                                                                <div class="js--image-preview" style="background-image: url(<?php echo $this->crud_model->get_course_banner_image_url($course_details['id'], "course_thumbnail"); ?>); background-color: #F5F5F5;"></div>
                                                                <div class="upload-options">
                                                                    <label for="banner_image" class="btn"> <i class="mdi mdi-camera"></i> <?php echo get_phrase("banner image"); ?> <br> <small>(<?php echo $size; ?>)</small> </label>
                                                                    <input id="banner_image" style="visibility:hidden;" type="file" class="image-upload" name="banner_image" accept="image/*">
                                                                    <input type="hidden" name="previous_banner_image" value="<?php if ($course_details['banner_image']) {
                                                                                                                                    echo $course_details['banner_image'];
                                                                                                                                } ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="finish">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                    <h3 class="mt-0"><?php echo get_phrase('thank_you'); ?> !</h3>

                                                    <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_just_one_click_away'); ?></p>

                                                    <div class="mb-3 mt-3">
                                                        <button type="button" class="btn btn-primary text-center" onclick="checkRequiredFields()"><?php echo get_phrase('submit'); ?></button>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>

                                    <ul class="list-inline mb-0 wizard text-center">
                                        <li class="previous list-inline-item">
                                            <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i> </a>
                                        </li>
                                        <li class="next list-inline-item">
                                            <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-right-bold"></i> </a>
                                        </li>
                                    </ul>

                                </div> <!-- tab-content -->
                            </div> <!-- end #progressbarwizard-->
                        </form>
                    </div>
                </div><!-- end row-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initSummerNote(['#description']);
        initSummerNote(['#message']);
        togglePriceFields('is_free_course');
    });
</script>

<script type="text/javascript">
    var blank_faq = jQuery('#blank_faq_field').html();
    var blank_about = jQuery('#blank_about_field').html();
    var blank_future = jQuery('#blank_future_field').html();
    var blank_learn = jQuery('#blank_learn_field').html();
    var blank_growth = jQuery('#blank_growth_field').html();
    var blank_outcome = jQuery('#blank_outcome_field').html();
    var blank_requirement = jQuery('#blank_requirement_field').html();
    jQuery(document).ready(function() {
        jQuery('#blank_faq_field').hide();
        jQuery('#blank_outcome_field').hide();
        jQuery('#blank_requirement_field').hide();
        calculateDiscountPercentage($('#discounted_price').val());
    });

    function appendFaq() {
        jQuery('#faq_area').append(blank_faq);
    }

    function removeFaq(faqElem) {
        jQuery(faqElem).parent().parent().remove();
    }

    function appendAbout() {
        jQuery('#about_area').append(blank_about);
    }

    function removeAbout(aboutElem) {
        jQuery(aboutElem).parent().parent().remove();
    }

    function appendFuture() {
        jQuery('#future_area').append(blank_future);
    }

    function removeFuture(futureElem) {
        jQuery(futureElem).parent().parent().remove();
    }

    function appendLearn() {
        jQuery('#learn_area').append(blank_learn);
    }

    function removeLearn(learnElem) {
        jQuery(learnElem).parent().parent().remove();
    }

    function appendGrowth() {
        jQuery('#growth_area').append(blank_growth);
    }

    function removeGrowth(growthElem) {
        jQuery(growthElem).parent().parent().remove();
    }

    function appendOutcome() {
        jQuery('#outcomes_area').append(blank_outcome);
    }

    function removeOutcome(outcomeElem) {
        jQuery(outcomeElem).parent().parent().remove();
    }

    function appendRequirement() {
        jQuery('#requirement_area').append(blank_requirement);
    }

    function removeRequirement(requirementElem) {
        jQuery(requirementElem).parent().parent().remove();
    }

    function ajax_get_sub_category(category_id) {
        $.ajax({
            url: '<?php echo site_url('admin/ajax_get_sub_category/'); ?>' + category_id,
            success: function(response) {
                jQuery('#sub_category_id').html(response);
            }
        });
    }

    function priceChecked(elem) {
        if (jQuery('#discountCheckbox').is(':checked')) {

            jQuery('#discountCheckbox').prop("checked", false);
        } else {

            jQuery('#discountCheckbox').prop("checked", true);
        }
    }

    function topCourseChecked(elem) {
        if (jQuery('#isTopCourseCheckbox').is(':checked')) {

            jQuery('#isTopCourseCheckbox').prop("checked", false);
        } else {

            jQuery('#isTopCourseCheckbox').prop("checked", true);
        }
    }

    function isFreeCourseChecked(elem) {

        if (jQuery('#' + elem.id).is(':checked')) {
            $('#price').prop('required', false);
        } else {
            $('#price').prop('required', true);
        }
    }

    function calculateDiscountPercentage(discounted_price) {
        if (discounted_price > 0) {
            var actualPrice = jQuery('#price').val();
            if (actualPrice > 0) {
                var reducedPrice = actualPrice - discounted_price;
                var discountedPercentage = (reducedPrice / actualPrice) * 100;
                if (discountedPercentage > 0) {
                    jQuery('#discounted_percentage').text(discountedPercentage.toFixed(2) + "%");

                } else {
                    jQuery('#discounted_percentage').text('<?php echo '0%'; ?>');
                }
            }
        }
    }

    $('.on-hover-action').mouseenter(function() {
        var id = this.id;
        $('#widgets-of-' + id).show();
    });
    $('.on-hover-action').mouseleave(function() {
        var id = this.id;
        $('#widgets-of-' + id).hide();
    });


    function student_academic_progress(course_id) {
        var academicProgressContent = $('#academic_progress').html();
        if (academicProgressContent == '') {
            $('.ajax_loader').addClass('start_ajax_loading');
            $.ajax({
                url: '<?php echo site_url('admin/student_academic_progress/'); ?>' + course_id,
                success: function(response) {
                    $('#academic_progress').html(response);
                    $('.ajax_loader').removeClass('start_ajax_loading');
                }
            });
        }
    }


    //Show specific tab by passing the tab id when reload browser
    <?php if (isset($_GET['tab'])) : ?>
        $('.ajax_loader').addClass('start_ajax_loading');
        const tabClickInterval = setInterval(function() {
            if (!$("a[href$=<?= $_GET['tab']; ?>]").hasClass('active')) {
                $("a[href$=<?= $_GET['tab']; ?>]").click();
            } else {
                $('.ajax_loader').removeClass('start_ajax_loading');
                clearInterval(tabClickInterval);
            }
        }, 1000);
    <?php endif; ?>

    $(document).ready(function() {
        //$('.multi-select-dropdown').select2();
        $('#addGroup').click(function() {
            var newGroup = $('<div class="group"></div>');

            var input1 = $(`<div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="title"><?php echo get_phrase('Title'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="job_title[]" style="width: 100%;" placeholder="<?php echo get_phrase('title'); ?>" />
                                                                </div>
                                                            </div>
                                                        </div>`);
            var input2 = $(`<div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="min_salary"><?php echo get_phrase('min_salary'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="min_salary[]" style="width: 100%;" placeholder="<?php echo get_phrase('min_salary'); ?>" />
                                                                </div>
                                                            </div>
                                                        </div>`);
            var input3 = $(`<div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="max_salary"><?php echo get_phrase('max_salary'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="max_salary[]" style="width: 100%;" placeholder="<?php echo get_phrase('max_salary'); ?>" />
                                                                </div>
                                                            </div>
                                                        </div>`);
            var input4 = $(`<div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="demand"><?php echo get_phrase('Demand in Percentage'); ?></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control bootstrap-tag-input" name="demand[]" style="width: 100%;" placeholder="<?php echo get_phrase('Demand in Percentage'); ?>" />
                                                                </div>
                                                            </div>
                                                        </div>`);

            var selectField = $(`<div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-4 col-form-label" for="company"><?php echo get_phrase('Select Companies'); ?></label>
                                                                <div class="col-md-8">
                                                                    <select name="company[${$('.group').length}][]" class="form-control select2" data-toggle="select2" multiple>
                                                                        <?php foreach ($companies as $company) : ?>
                                                                            <option value="<?php echo $company->id; ?>" ><?php echo $company->title; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>`);
            var removeButton = $(`<div class="col-xl-12">
                                                            <div class="form-group row mb-3">
                                                                <div class="col-md-4">
                                                                    <button type="button" class="removeGroup">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>`);


            // Append inputs and select field to the new group
            newGroup.append(input1, input2, input3, selectField, input4, removeButton);

            $('#growth_form_groups').append(newGroup);

        });


        $(document).on('click', '.removeGroup', function() {
            if ($('.group').length > 1) {
                $(this).closest('.group').remove();
            }
        });
    });
</script>

<style>
    .group {
        margin-bottom: 15px;
    }
</style>