<!-- start page title -->
<style>
    .location-item,
    .skill-item {
        display: inline-block;
        background-color: #e0e0e0;
        border: 1px solid #c0c0c0;
        padding: 5px;
        margin: 5px;
        border-radius: 3px;
    }

    .location-item button,
    .skill-item button {
        background: none;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    .error {
        color: red;
        font-size: 14px;
    }

    .note {
        font-size: 12px;
        color: gray;
    }
</style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="<?php echo base_url("assets/frontend/default-new/js/jsuites.js") ?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/frontend/default-new/css/jsuites.css") ?>" type="text/css" />


<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Add_job'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?php
$qualifications = [
    "Diploma",
    "Any Graduate",
    "Any Postgraduate",
    "B.Tech/B.E.",
    "B.Com",
    "B.A",
    "BBA",
    "BBM",
    "B.Sc",
    "BA",
    "BCA",
    "MCA",
    "M.Tech",
    "M.Com",
    "MBA/PGDM",
    "M.Sc",
    "M.A",
    "PhD"
];

?>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('add_job_form'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/create_job'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required value="<?php echo set_value('title'); ?>">

                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea name="description" id="description" required><?php echo set_value('description'); ?></textarea>

                        </div>
                        <div class="form-group">

                            <label for="company_name">Company Name<span class="required">*</span></label>
                            <input type="text" name="company_name" required class="form-control" value="<?php echo set_value('company_name'); ?>">

                        </div>
                        <div class="form-group">
                            <label for="employment_type">Employment Type<span class="required">*</span></label>
                            <select name="employment_type" required class="select2 form-control select2-multiple">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                        <div class="form-group">

                            <label for="location">Location<span class="required">*</span></label>
                            <input type="text" id="location_autocomplete" required class="form-control" value="<?php echo set_value('location'); ?>">
                            <div id="selected-locations"></div>
                        </div>
                        <div class="form-group">


                            <label for="pay_scale">Pay Scale(in rupees per annum)</label>
                            <div class="col-lg-6">
                                <input type="text" name="min_pay_scale" class="form-control" placeholder="Minimum Pay Scale" value="<?php echo set_value('min_pay_scale'); ?>">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="max_pay_scale" class="form-control" placeholder="Maximum Pay Scale" value="<?php echo set_value('max_pay_scale'); ?>">
                            </div>

                        </div>
                        <div class="form-group">


                            <label for="experience">Experience<span class="required">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="min_experience" class="form-control" placeholder="Minimum Experience" required value="<?php echo set_value('min_experience'); ?>">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="max_experience" class="form-control" placeholder="Maximum Experience" required value="<?php echo set_value('max_experience'); ?>">
                            </div>

                        </div>
                        <div class="form-group">

                            <label for="qualification">Qualification<span class="required">*</span></label>
                            <select id="qualification" name="qualification[]" multiple class="form-control" required>
                                <?php foreach ($qualifications as $qualification) : ?>
                                    <option value="<?= htmlspecialchars($qualification) ?>"><?= htmlspecialchars($qualification) ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-group">


                            <label for="required_skills">Required Skills<span class="required">*</span></label>
                            <input type="text" id="skill_autocomplete" required class="form-control" value="<?php echo set_value('company_name'); ?>">
                            <div id="selected-skills"></div>
                        </div>
                        <div class="form-group">

                            <label for="work_mode">Work Mode<span class="required">*</span></label>
                            <select name="work_mode" required class="select2 form-control select2-multiple">
                                <option value="On-Site">On-Site</option>
                                <option value="Remote">Remote</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Work from office">Work from office</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="industry">Industry<span class="required">*</span></label>
                            <select class="form-control select2" data-toggle="select2" name="industry" id="industry" required>
                                <option value=""><?php echo get_phrase('select_a_industry'); ?></option>
                                <?php $industries = $this->Job_model->getAllIndustries(); ?>
                                <?php foreach ($industries->result_array() as $industry) : ?>
                                            <option value="<?php echo $industry['industry_name']; ?>"><?php echo $industry['industry_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="og_banner">OG Banner</label>
                            <input type="file" class="form-control" id="og_banner" name="og_banner" size="20" />
                            <div class="note">Note: Allows image files only up to 2MB size.</div>
                            <div class="error" id="ogBannerError"></div>
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" id="client_logo" class="form-control" name="logo" size="20" />
                            <div class="note">Note: Allows image files only up to 100KB size.</div>
                            <div class="error" id="logoError"></div>
                        </div>


                        <div class="from-group"></div>


                        <input type="submit" onclick="" class="btn btn-primary" name="submit" value="Add Job">
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initSummerNote(['#description']);
    });

    var requestOptions = {
        method: 'GET',
    };

    var apiURL = 'https://api.geoapify.com/v1/geocode/autocomplete?text=' + $('#location_autocomplete').val() + '&format=json&apiKey=ce181f92a86a452fb5128fe72d2d8b74';
    $("#location_autocomplete").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: 'https://api.geoapify.com/v1/geocode/autocomplete?text=' + $('#location_autocomplete').val() + '&format=json&apiKey=ce181f92a86a452fb5128fe72d2d8b74',
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    // Parse the response to extract the required fields
                    // data.results = data.results.filter(r=>r.category == 'administrative' || r.category == 'populated_place');
                    data.results = data.results.filter(r => (r.rank.confidence_city_level == 1));
                    console.log(data.results);
                    var suggestions = $.map(data.results, function(item) {
                        return {
                            // label: item.city + ', ' + item.country,
                            label: item.formatted,
                            value: item.city
                        };
                    });
                    console.log(suggestions);
                    response(suggestions);
                }
            });
        },
        minLength: 3,
        select: function(event, ui) {
            // Prevent value from being put in the input field
            event.preventDefault();
            // Append the selected value to a list
            var selectedLocation = ui.item.value;
            if ($("#selected-locations").find(`input[value="${selectedLocation}"]`).length === 0) {
                $("#selected-locations").append(`<span class="location-item">${selectedLocation}<input type="hidden" name="locations[]" value="${selectedLocation}"><button type="button" class="remove-location">x</button></span>`);
                $("#location_autocomplete").removeAttr("required");

            }
            // Clear the input field
            $("#location_autocomplete").val('');

        }
    });

    // Remove location item
    $(document).on('click', '.remove-location', function() {
        $(this).parent().remove();
        if ($('.location-item').length == 0) {
            $("#location_autocomplete").attr("required", "required");
        }
    });

    //Skills multi selectable auto suggestion dropdown
    var skillsApiURL = '<?php echo base_url("jobs/get_skills"); ?>' + '';
    $("#skill_autocomplete").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: '<?php echo base_url("jobs/get_skills"); ?>' + '/' + $('#skill_autocomplete').val(),
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    console.log(data);
                    var suggestions = $.map(data, function(item) {
                        return {
                            // label: item.city + ', ' + item.country,
                            label: item.skill,
                            value: item.skill
                        };
                    });
                    console.log(suggestions);
                    response(suggestions);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            // Prevent value from being put in the input field
            event.preventDefault();
            // Append the selected value to a list
            var selectedSkill = ui.item.value;
            if ($("#selected-skills").find(`input[value="${selectedSkill}"]`).length === 0) {
                $("#selected-skills").append(`<span class="skill-item">${selectedSkill}<input type="hidden" name="required_skills[]" value="${selectedSkill}"><button type="button" class="remove-skill">x</button></span>`);
                $("#skill_autocomplete").removeAttr("required");
            }
            // Clear the input field
            $("#skill_autocomplete").val('');
        }
    });

    // Remove skill item
    $(document).on('click', '.remove-skill', function() {
        $(this).parent().remove();
        $("#skill_autocomplete").attr("required", "required");
    });

    // Function to validate file
    function validateFile(inputId, errorId, maxSize) {
        var fileInput = document.getElementById(inputId);
        var fileError = document.getElementById(errorId);
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        fileInput.addEventListener('change', function() {
            fileError.textContent = ''; // Clear previous error

            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];

                // Check file type
                if (!allowedExtensions.exec(file.name)) {
                    fileError.textContent = 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
                    fileInput.value = ''; // Clear file input field
                    return;
                }

                // Check file size
                if (file.size > maxSize) {
                    fileError.textContent = 'File size exceeds';
                    fileInput.value = ''; // Clear file input field
                    return;
                }
            }
        });
    }

    //Og banner  handling
    validateFile('og_banner', 'ogBannerError', 2 * 1024 * 1024);
    validateFile('client_logo', 'logoError', 100 * 1024);
</script>