<div class="popup-form" id="feedback_form_modal">
    <span class="close-btn" id="feedback_form_close_button">&times;</span>
    <div class="form-container">
        <form action="javascript:void(0);" onsubmit="feedbackFormSubmit()" id="feedback_form" name="feedback_form">
            <h4 class="pb-3">Feedback</h4>
            <!-- <label for="name">Name:</label> -->
            <input type="text" id="feedback_form_name" required name="feedback_form_name" required placeholder="Name">

            <!-- <label for="email">Email:</label> -->
            <input type="email" class="email-ip" id="feedback_form_email" required name="feedback_form_email" required placeholder="email">

            <!-- <label for="phone">Phone:</label> -->
            <input type="tel" id="feedback_form_phone" required name="feedback_form_phone"  required placeholder="Phone:">

            <!-- <label for="message">Message:</label> -->
            <textarea id="feedback_form_message" required name="feedback_form_message" rows="4" required placeholder="Message:"></textarea>

            <button class="button-sub" type="submit">Submit</button>
        </form>
    </div>
</div>

<script>
    const feedback_form_modal = document.getElementById('feedback_form_modal');
    const feedback_form_button = document.getElementById('feedback_form_button');
    feedback_form_button && feedback_form_button.addEventListener('click', function() {
        feedback_form_modal.style.display = 'block';
    });

    const feedback_form_close_button = document.getElementById('feedback_form_close_button');
    feedback_form_close_button && feedback_form_close_button.addEventListener('click', function() {
        feedback_form_modal.style.display = 'none';
    });

    function feedbackFormSubmit() {
        var full_number = feedback_form_phone_input.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='feedback_form_phone'").val(full_number);
        var $inputs = $('#feedback_form :input');

        const name = document.getElementById('feedback_form_name').value.trim();
        const email = document.getElementById('feedback_form_email').value.trim();
        const phone = document.getElementById('feedback_form_phone').value.trim();
        const message = document.getElementById('feedback_form_message').value.trim();

        // Regular expressions for email and phone number validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Perform validations
        if (name === '') {
            alert('Please enter your name.');
            return;
        }

        if (email === '' || !emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        var formData = {
            name: name,
            email: email,
            phone: phone,
            message: message
        };
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the request (GET method, URL)
        xhr.open('POST', '<?php echo site_url('home/feedback_from_submitted'); ?>', true);

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
                    // Optionally, reset the form after successful submission
                    $('#feedback_form')[0].reset();
                    feedback_form_modal.style.display = 'none';
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

    const feedback_form_phone = document.querySelector("#feedback_form_phone");
    const feedback_form_phone_input = feedback_form_phone && window.intlTelInput(feedback_form_phone, {
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    $("form").submit(function() {
        var full_number = feedback_form_phone_input.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='feedback_form_phone'").val(full_number);
    });
</script>