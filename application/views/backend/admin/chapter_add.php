<?php
$course_details = $this->crud_model->get_course_by_id($param2)->row_array();
$sections = $this->crud_model->get_section('course', $param2)->result_array();
?>
<form action="<?php echo site_url('admin/chapters/'.$param2.'/add'); ?>" method="post">
    <div class="form-group">
        <input type="hidden" name="course_id" value="<?php echo $param2; ?>">
        <div class="form-group">
            <label><?php echo get_phrase('title'); ?></label>
            <input type="text" name = "title" class="form-control" required>
        </div>

        <div class="form-group">
            <label><?php echo get_phrase('section'); ?></label>
            <select class="form-control select2" data-toggle="select2" name="section_id" required>
                <?php foreach ($sections as $section): ?>
                    <option value="<?php echo $section['id']; ?>"><?php echo $section['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="text-right">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('submit'); ?></button>
    </div>
</form>


<!-- <script type="text/javascript">
    $(function() {
        'use strict';
        $('.date-range-with-time').daterangepicker({
            timePicker: true,
            startDate: '<?php echo date('m/d/y 00:00:00'); ?>',
            endDate: '<?php echo date('m/d/y 00:00:00'); ?>',
            locale: {
                format: 'M/DD/YY hh:mm A'
            }
        });
    });
</script> -->

<style type="text/css">
    .calendar-time select{
        color: #787878 !important;
    }
</style>