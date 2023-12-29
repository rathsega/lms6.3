<?php
foreach ($lessons as $lesson) : ?>
    <li>
        <a href="#" onclick="actionTo('<?php echo site_url('home/play_lesson/'.$lesson['id']); ?>')" class="checkPropagation">
            <span class="d-flex align-items-center ellipsis-line-2">
                <i class="<?php echo $lesson['lesson_type'] == 'video' ? 'fa-regular fa-circle-play' : 'fa fa-arrow-right'; ?>"></i>
                <?php echo $lesson['title']; ?>
            </span>

            <?php if($lesson['is_free']): ?>
                <div class="lecture-info ms-auto pe-2 me-2">
                    <span onclick="lesson_preview('<?php echo site_url('home/play_lesson/'.$lesson['id'].'/preview') ?>', '<?php echo $lesson['title']; ?>', 'lg')" class="checkPropagation cursor-pointer badge bg-light text-dark fw-400 text-13px"><i class="fas fa-eye me-1 text-13px"></i> <?php echo get_phrase('Preview') ?></span>
                </div>
            <?php endif; ?>

            <div class="lecture-info" style="width: 60px"><?php echo $lesson['lesson_type'] == 'video' ? $lesson['duration'] : ''; ?></div>
        </a>
    </li>
<?php endforeach; ?>