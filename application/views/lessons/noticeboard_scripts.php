<div class="col-md-12 p-4">
	<!--Show more loading icon-->
	<div class="row justify-content-center">
	    <div class="col-md-7 p-0 text-center hidden py-5" id="loading_gif_icon">
	        <img width="60" class="my-5" src="<?php echo base_url('assets/global/gif/page-loader-2.gif'); ?>">
	    </div>
	</div>
</div>

<script type="text/javascript">
	'use strict';
	
	function load_course_notices(course_id){
		$('.remove-active').removeClass('active');
		$('#noticeboard-tab').addClass('active');

		$('#noticeboard-content').hide();
		$('#loading_gif_icon').show();
		$.ajax({
			url: '<?= site_url('addons/noticeboard/load_notices_for_lesson_page/'); ?>'+course_id,
			success: function(response){
				setTimeout(function(){
					$('#loading_gif_icon').hide();
					$('#noticeboard-content').show();
					$('#noticeboard-content').html(response);
				},200);
			}
  		});
	}
</script>