<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Responsive Form Card</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="index.css">
</head>
<style>
  body {

    /* height: 100vh;  */
    /* background-color: #bde5d2;  */
    /* font-family: 'Poppins', sans-serif;  */

  }

  .textup {
    text-align: center;
    color: #754ffe;
    font-weight: 500;
  }

  i {
    margin-right: 3px;
  }

  .form-var-tab {
    padding:9px;
    max-width: none !important;
  }

  .form-box {
    background-color: #fff;
    /* box-shadow: 0 0 10px rgba(36, 67, 40, 0.8);  */
    padding: 15px;
    border-radius: 8px;
    width: 70%;
    border: 1px solid #423d3d4d;
  }

  .form-var-tab {
    max-width: 400px;
    margin: 10px auto;
  }

  .radio-group {
    display: flex;
    margin-bottom: 16px;
  }

  input[type="radio"] {
    margin-right: 8px;
  }

  label {
    display: block;
    margin-bottom: 8px;
    font-size: 17px;
    color: #754ffe;
    font-weight: 500;
  }


  .feed-bk {
    width: 100%;
    padding: 8px;
    margin: -3px 0 21px;
    /* Shorthand for margin-top, margin-right, margin-bottom, margin-left */
    box-sizing: border-box;
    border-radius: 6px;
    border: 1px solid #6666665e;
  }


  .sbt_btn {
    background-color: #754ffe;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    width: 18%;
    font-size: 15px;
    transition: .2s linear;
    float: right;
  }

  .sbt_btn:hover {
    background-color: #0a6808;
    border: none;
    transform: translateY(-10px);
    color: white;
  }

  h1 {
    color: #754ffe;
  }

  .rating-para {
    color: #754ffe;
    font-size: 15px;
    font-weight: 600;
    line-height: 28px;
    width: 145%;
  }

  /* -ratings----------- */
  .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
  }

  .rate:not(:checked)>input {
    position: absolute;
    top: -9999px;
  }

  .rate:not(:checked)>label {
    float: right;
    width: 1em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
  }

  .rate:not(:checked)>label:before {
    content: '★ ';
  }

  .rate>input:checked~label {
    color: #ffc700;
  }

  .rate:not(:checked)>label:hover,
  .rate:not(:checked)>label:hover~label {
    color: #deb217;
  }

  .rate>input:checked+label:hover,
  .rate>input:checked+label:hover~label,
  .rate>input:checked~label:hover,
  .rate>input:checked~label:hover~label,
  .rate>label:hover~input:checked~label {
    color: #c59b08;
  }

  .rating-container {
    display: flex;
    justify-content: flex-end;
  }

  /* -ratings-end----------- */
  @media only screen and (max-width: 768px) {
    .rating-container {
      display: flex;
      /* justify-content: flex-start !important; */
    }

    .rating-para {
      width: 187px;
    line-height: 22px;
    margin-top:13px !important;
    font-size: 12px;
    font-weight: 600;
    }
    .sbt_btn {
    width:45%;
  }
  .form-box {
    padding-top: 1px;
    padding-bottom: 29px;
    width: 95%;
  }
  

  }
</style>

<body>
  <div class="d-flex justify-content-center">
    <!-- <h1>Feedback Form</h1>  -->
    <div class="form-box">

      <form class="form-var-tab"  action="javascript:void(0);" onsubmit="feedbackFormBottomTabSubmit()" id="lesson_feedback_form_bottom_tab" name="lesson_feedback_form_bottom_tab">
        <?php $criterias = json_decode($criterias['criterias']); ?>
        <?php 
          if($existed_feedback->num_rows()){
            $data = $existed_feedback->row_array();
            $existed_feedback_data = json_decode($data['feedback']);
            $criterias  = $existed_feedback_data->criterias;
            $ratings  = $existed_feedback_data->ratings;
            $message = $existed_feedback_data->message;
            //var_dump($existed_feedback_data);
          } else{
            $existed_feedback_data = json_decode(json_encode(array()));;
            $message = "";
          }
          ?>
        <?php foreach($criterias as $key => $criteria) : ?>
        <div class="row">
          <div class="col-6">
            <p class="mt-2 rating-para"><?php echo $criteria; ?>:</p>
          </div>
          <div class="col rating-container">
            <div class="row">
              <div class="col-lg-9 com-md-9 col-sm-12 mt-3">
                <div class="stars">
                  <div class="stars__selection"></div>
                  <input type="hidden" class="ratings" value="<?php echo $ratings[$key]; ?>" name="lesson_feedback_form_bottom_tab_ratings[]" required>
                  <input type="hidden" class="criterias" value="<?php echo $criteria; ?>" name="lesson_feedback_form_bottom_tab_criterias[]" required>
                  <span class="rating_val"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <div class="mt-4">
          <label for="lesson_feedback_form_bottom_tab_message">
            <i class="fa-solid fa-comments text-dark" style="margin-right: 3px;"></i>
            <span class="text-dark">Write your review: </span>
          </label>
              <textarea class="feed-bk" id="lesson_feedback_form_bottom_tab_message" name="lesson_feedback_form_bottom_tab_message" rows="4" cols="10" required><?php echo $message; ?>
          </textarea>
          <button class="sbt_btn" type="submit">
            Submit
          </button>
        </div>

      </form>
    </div>
  </div>
</body>

</html>

<style>
        .stars,
        .stars__selection {
            display: block;
            width: 80px;
            height: 16px;
            cursor: pointer;
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAgCAIAAACU62+bAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAldJREFUeNqMVMuOEkEUPY0EQksHFBIHXKgxEBIW+gGYsHVhcOXCzfgp8wluTVjgxoQlP4C4x2QmhkAgRFagBmLzGKAJ2J6qAqaZ7mHm5qa4j3Nudd1bhWbbNtzy5ZlY3/90Z3we6P43rHpCe5W7Eb6f4TGE/vh4BwLL/6nhAYTSoHuMsBqL8ieAX+qJ3I1Bh2h2/QzTntBBTQQMICXRlDXQAabSTuRhPKVq9icgLlXf4dxC5hwYCvUhX8Jf4N7NaMgUAYTlSz6kT/GqhBZweTOBKQIIS5/KQx/nONCOLtF5/gGmF4FBpiT6sK1slO5F0GXKYw6jcwR2tiVVSUCmHOffT83EfdnB38AvGeHgHkEEV6ZrB14BXeIugH95vD3Hu54wLmRQx/6O7AiznhjN5Uu8ruHNV8RewHgiDLoMziVgezXUe2h/3vZKSqvFRiKTyWzLObL+q7Y6pF6vHxAcWY/3wPJTKWqf2x8Qyz+Uova5hdDv91k7IYUG3WsAbTKZMDEcDi3LUmi2IZ1Oi6O225qmGYaRTCaDwWA8Hqetlcvl0WgUkBIKhZiIRCJcxbgtazwec10sFispsVhMWy6XlUrFNM1sNuv3e7+J9XrdaDSi0WihUBBzYA1y5vN5KpVyc4judDq6rhPNncWh+UOHISaYPoK+6hKdXC7Hb91sNk4CXQaZUuiDtrJdiukkKFelrl9vNjQcDitjMBiIf5ZEgn1kkBEPAkfBtdvtspVsPG1+PVu8T3nsMJvNWJLnUwTOsVqtMnjwnfZOisVis9m0XcIgU3v3vwADALitWRkkbzItAAAAAElFTkSuQmCC) 0 -16px;
        }

        .stars__selection {
            width: 0;
            background-position: 0 0;
            cursor: pointer;
        }
    </style>

    <script>
        var existed_ratings = <?php echo json_encode($ratings); ?>;
        if(existed_ratings){
          existed_ratings.forEach((val,key) => {
            document.getElementsByClassName('stars__selection')[key+1].style.width = (val*16)+"px";
            document.getElementsByClassName('ratings')[key].value = val;
              // document.getElementsByClassName('rating_val')[key].innerText = val + '/5';
          });
        }
        $('.stars').on('mouseover mousemove', function(event) {
          var x = event.pageX - $(this).offset().left;
            $(this).find('.stars__selection').width(x);
            var width = $(this).width();
            var result = Math.round(x / width * 100); // in percent
            var integer_rating = Math.floor(result / 20, 1);
            var float_rating = integer_rating < 5 ? Math.ceil((result % 20) / 2) : 0;
            if (float_rating == 10) {
                ++integer_rating;
                float_rating = 0;
            }
            //alert(result + '---' + integer_rating +'.' + float_rating + '% selected');
            $(this).find('.ratings').val(integer_rating + '.' + float_rating);
            // $(this).find('.rating_val').innerText = integer_rating + '.' + float_rating + '/5';
        }).on('mouseout', function() {
            // $(this).find('.stars__selection').width(0);
        }).on('click', function(event) {
            var x = event.pageX - $(this).offset().left;
            $(this).find('.stars__selection').width(x);
            var width = $(this).width();
            var result = Math.round(x / width * 100); // in percent
            var integer_rating = Math.floor(result / 20, 1);
            var float_rating = integer_rating < 5 ? Math.ceil((result % 20) / 2) : 0;
            if (float_rating == 10) {
                ++integer_rating;
                float_rating = 0;
            }
            //alert(result + '---' + integer_rating +'.' + float_rating + '% selected');
            $(this).find('.ratings').val(integer_rating + '.' + float_rating);
            // $(this).find('.rating_val').innerText = integer_rating + '.' + float_rating + '/5';
        });

        var lesson_feedback_form_modal_bottom_tab = document.getElementById('lesson_feedback_form_modal');
        var lesson_feedback_form_button_bottom_tab = document.getElementById('lesson_feedback_form_button');
        lesson_feedback_form_button_bottom_tab.addEventListener('click', function() {
            lesson_feedback_form_modal_bottom_tab.style.display = 'block';
        });

        

        function feedbackFormBottomTabSubmit() {
            var rating = document.getElementsByName("lesson_feedback_form_bottom_tab_ratings[]")
            var message = document.getElementById('lesson_feedback_form_bottom_tab_message').value.trim();
            var ratings = [];
            var criterias = [];

            $("[name='lesson_feedback_form_bottom_tab_ratings[]']").each(function(){
              ratings.push($(this).val());
            });
            $("[name='lesson_feedback_form_bottom_tab_criterias[]']").each(function(){
              criterias.push($(this).val());
            });

            var formData = {
                ratings: JSON.stringify(ratings) ,
                message: message,
                criterias: JSON.stringify(criterias),
                course_id: <?php echo $course_id; ?>
            };
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the request (GET method, URL)
            xhr.open('POST', '<?php echo site_url('home/bottom_tab_feedback_from_submitted'); ?>', true);

            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Convert the data object to JSON format
            serialize = function(obj) {
                var str = [];
                for (var p in obj)
                    if (obj.hasOwnProperty(p)) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                return str.join("&");
            }

            var jsonData = serialize(formData);

            // Set up a function to handle the response
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Request was successful
                    alert(xhr.responseText);
                    if (xhr.responseText == 'Thank You For Providing Your Feedback.') {
                        lesson_feedback_form_modal_bottom_tab.style.display = 'none';
                    }


                    // Perform actions with the response data here
                } else {
                    // Error handling if the request fails
                    console.error('Request failed. Status:', xhr.status);
                }
            };

            // Send the POST request with the JSON data
            xhr.send(jsonData);
        }
    </script>