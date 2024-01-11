<script>
	var quiz_ids = [];
</script>
<?php
$answer_details = $this->user_model->getUserQuizAnswers($quiz_id);
$user_answers = $answer_details['user_answers'];
$user_answers = $user_answers ? json_decode($user_answers, true) : $user_answers;
// var_dump($user_answers);
?>
<?php foreach ($quiz_questions->result_array() as $question_number => $quiz_question) : ?>
	<?php $question_number++;  ?>
	<?php if ($quiz_question['type'] == 'multiple_choice' || $quiz_question['type'] == 'single_choice') : ?>
		<form class="ajaxFormSubmission" id="submitForm<?php echo $question_number; ?>" action="<?php echo site_url('user/submit_quiz_answer/' . $quiz_question['quiz_id'] . '/' . $quiz_question['id'] . '/' . $quiz_question['type']); ?>" method="post" enctype="multipart/form-data">
			<?php $input_type = ($quiz_question['type'] == 'multiple_choice') ? 'checkbox' : 'radio'; ?>
			<hr class="bg-secondary">
			<div class="row justify-content-center"  id="<?php echo $quiz_question['id']; ?>">
				<div class="col-md-1 pt-1 text-start"><b><?php echo $question_number; ?>.</b></div>
				<div class="col-md-9">
					<?php echo remove_js(htmlspecialchars_decode_($quiz_question['title'])); ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-1"></div>
				<div class="col-md-9">
					<?php foreach (json_decode($quiz_question['options'], true) as $key => $option) : ?>
						<?php $key++; ?>
						<div class="form-group">
							<?php
							$current_question_answer = $user_answers[$quiz_question['id']];
							?>
							<input onchange="submit_quiz_answer('submitForm<?php echo $question_number; ?>');" id="option_<?php echo $question_number . '_' . $key; ?>" type="<?php echo $input_type; ?>" value="<?php echo $key; ?>" name="answer[]" <?php echo $current_question_answer && $current_question_answer != null && $current_question_answer != ''  && in_array($key, $current_question_answer) ? 'checked' : ''; ?> required>
							<label class="<?php echo $input_type; ?> text-dark" for="option_<?php echo $question_number . '_' . $key; ?>"><?php echo $option; ?></label><br>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row justify-content-center" style="display: none; color:red;">
				<div class="col-md-2 pt-1 text-start"><b>Error : </b></div>
				<div class="col-md-7">
					<b>Please answer above question</b>
				</div>
			</div>

		</form>
	<?php elseif (trim($quiz_question['type']) == 'fill_in_the_blank') : ?>
		<form class="ajaxFormSubmission" id="submitForm<?php echo $question_number; ?>" action="<?php echo site_url('user/submit_quiz_answer/' . $quiz_question['quiz_id'] . '/' . $quiz_question['id'] . '/' . $quiz_question['type']); ?>" method="post" enctype="multipart/form-data">
			<hr class="bg-secondary">
			<div class="row justify-content-center">
				<div class="col-1 pt-1"><b><?php echo $question_number; ?>.</b></div>
				<div class="col-md-9"  id="<?php echo $quiz_question['id']; ?>">
					<?php
					$correct_answers = json_decode($quiz_question['correct_answers'], true);
					$question_title = remove_js(htmlspecialchars_decode_($quiz_question['title']));
					foreach ($correct_answers as $correct_answer) :
						$question_title = str_replace($correct_answer, ' _____ ', $question_title);
					endforeach;
					echo $question_title;
					?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-1"></div>
				<div class="col-md-9">
					<div class="input-group mb-3">
						<?php
							$current_question_answer = $user_answers[$quiz_question['id']];
						?>
						<?php foreach ($correct_answers as $key => $word) : ?>
							<span class="input-group-text"><?php echo ++$key; ?></span>
							<input type="text" onblur="submit_quiz_answer('submitForm<?php echo $question_number; ?>');" class="form-control" value="<?php echo $current_question_answer[$key-1] ?>" name="answer[]">
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="row justify-content-center error" style="display: none;" id="<?php echo $quiz_question['id']; ?>">
				Please answer above question
			</div>
		</form>
	<?php endif; ?>
	<script>
		quiz_ids.push(<?php echo $quiz_question['id']; ?>);
	</script>
<?php endforeach; ?>

<!-- <form class="text-center" method="post" enctype="multipart/form-data">
	<button id="quizSubmissionBtn" type="submit" onclick="checkAllQuestionsAnsweredOrNot()" class="btn btn-primary mt-4 px-5"><?php echo site_phrase('submit'); ?></button>
</form> -->
<form class="ajaxFormSubmission text-center required-form" style="" action="<?php echo site_url('user/finish_quize_submission/'.$quiz_id); ?>" method="post" enctype="multipart/form-data">
	<button id="quizSubmissionBtn" type="button"  onclick="checkAllQuestionsAnsweredOrNot()" class="btn btn-primary mt-4 px-5"><?php echo site_phrase('submit'); ?></button>
</form>


<script type="text/javascript">

	function all_empty(answers){
		if(answers){
			let empty_answer = false;
			for(let i=0; i< answers.length; i++){
				if(!empty_answer && answers[i] == ""){
					empty_answer =true;
				}
			}
			return empty_answer;
		}else{
			return true;
		}
	}
	function checkAllQuestionsAnsweredOrNot() {
		$.ajax({
			url: '<?php echo site_url('home/get_user_answers'); ?>',
			type: 'POST',
			data: {
				quiz_id: <?php echo $quiz_id; ?>
			},
			success: function(response) {
				let all_questions_answered = true;
				let unanswered_question_ids = [];
				if (response) {
					response = JSON.parse(response);
					let user_answers = response.user_answers ? JSON.parse(response.user_answers) : {};
					console.log(user_answers);

					for (let i = 0; i < quiz_ids.length; i++) {
						if (user_answers.hasOwnProperty(quiz_ids[i]) && (user_answers[quiz_ids[i]] != null && user_answers[quiz_ids[i]] != "" && user_answers[quiz_ids[i]] != undefined)  && !all_empty(user_answers[quiz_ids[i]])) {

						} else {
							all_questions_answered = false;
							unanswered_question_ids.push(quiz_ids[i]);
						}
					}
				} else {
					let all_questions_answered = false;
					unanswered_question_ids = quiz_ids;
				}
				for (let j = 0; j < quiz_ids.length; j++) {
					if (unanswered_question_ids.indexOf(quiz_ids[j]) !== -1) {
						document.getElementById(quiz_ids[j]).style.color = "red";
					} else {
						document.getElementById(quiz_ids[j]).style.color = "#737982";
					}
				}
				if (!all_questions_answered) {
					alert("Please answer all questions.");
				}else{
					$('form.required-form').submit();
				}
			}
		});
	}

	function submit_quiz_answer(formId) {
		$("#" + formId).submit();
	}

	$(function() {
		$('.ajaxFormSubmission').ajaxForm({
			beforeSend: function() {
				var percentVal = '0%';
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
			},
			complete: function(xhr) {
				var jsonResponse = JSON.parse(xhr.responseText);
				if (jsonResponse.status == 'submit') {
					location.reload();
				}
			},
			error: function() {
				//You can write here your js error message
			}
		});
	});
</script>