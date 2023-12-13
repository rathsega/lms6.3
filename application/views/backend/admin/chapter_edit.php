<?php
$course_details = $this->crud_model->get_course_by_id($param2)->row_array();
$sections = $this->crud_model->get_section('course', $param2)->result_array();
$chapter_details = $this->crud_model->get_chapters('chapter', $param4)->result_array();
?>
<form action="<?php echo site_url('admin/chapters/'.$param2.'/edit/' . $param4); ?>" method="post">
    <div class="form-group">
        <input type="hidden" name="course_id" value="<?php echo $param2; ?>">
        <input type="hidden" name="chapter_id" value="<?php echo $param4; ?>">
        <div class="form-group">
            <label><?php echo get_phrase('title'); ?></label>
            <input type="text" name = "title" value="<?php echo $chapter_details[0]['title']; ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label><?php echo get_phrase('section'); ?></label>
            <select class="form-control select2" data-toggle="select2" name="section_id" disabled required>
                <?php foreach ($sections as $section): ?>
                    <option <?php  echo $section['id'] == $param3 ? 'selected' : ''; ?> value="<?php echo $section['id']; ?>"><?php echo $section['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="text-right">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('submit'); ?></button>
    </div>
</form>


<style type="text/css">
    .calendar-time select{
        color: #787878 !important;
    }
</style>