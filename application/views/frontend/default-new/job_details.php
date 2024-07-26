<style>
    .input-group img {
        position: absolute;
        top: 50%;
        left: 16px;
        transform: translateY(-50%);
    }

    .location-para {
        font-size: 12px;
        font-weight: 500;
        padding-right: 13px;
    }

    .job-description p {
        font-size: 14px;
    }

    ul.custom-list {
        list-style-type: none;
    }

    ul.custom-list li {
        color: black;
        position: relative;
    }

    .jd-custom-list li {
        font-size: 14px;
        line-height: 30px;
    }

    .logo-w {
        width: 13.66666%;
    }

    ul.custom-list li::before {
        content: '•';
        color: #754ffe;
        position: absolute;
        left: -1.5em;
    }

    .job-description-card {
        background: #754ffe1f;
    }

    .btn-primary {

        padding: 3px 32px;
    }

    .subs-title {
        font-size: 18px;
        font-weight: 700;
        color: #392C7D;
        margin-bottom: 20px;
    }

    .job-logo {
        height: 80px;
        padding: 10px;
        border-radius: 8px;
    }

    .detail-button-2 {
        color: #0162ff !important;
        font-size: 10px !important;
        font-weight: 400 !important;
        padding: 1px 8px !important;
        border-radius: 4px !important;
        margin-right: 4px;
    }

    .job-details h6 {
        font-size: 14px;
        line-height: 4px;
        font-weight: 600;
        padding-top: 8px;
        color: #754ffe;
        padding-bottom: 8px;
    }

    .job-details p {
        font-size: 12px;
        font-weight: 500;
        color: #000;
    }

    .error {
        color: red;
        font-size: 14px;
    }

    .note {
        font-size: 12px;
        color: gray;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: green;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        margin-left: 3%;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .share-social-media img {
        width: 27px !important;

    }

    .share-social-media {
        display: flex !important;
        flex-direction: row !important;
    }
</style>

<script>
    function enableShareOptions() {
        event.stopPropagation();
        console.log("clicked");
        let myDiv = document.getElementById("share-button-lg");
        $("#share-button-lg").toggle('show');

    }

    function shareOnFacebook() {
        event.preventDefault();
        event.stopPropagation();
        const url = window.location.href;
        const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        window.open(facebookUrl, '_blank');
    }

    function shareOnLinkedin() {
        event.preventDefault();
        event.stopPropagation();
        let title = document.getElementById('job_title').innerText;
        const url = window.location.href;
        const linkedinUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}&title=${encodeURIComponent(title)}`;
        window.open(linkedinUrl, '_blank');
    }

    function shareOnWhatsApp() {
        event.preventDefault();
        event.stopPropagation();
        let title = document.getElementById('job_title').innerText;
        const url = window.location.href;
        const text = `Check out this course: ${title} - ${url}`;
        const whatsappUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(text)}`;
        window.open(whatsappUrl, '_blank');
    }

    function shareOnSkype() {
        event.preventDefault();
        event.stopPropagation();
        let title = document.getElementById('job_title').innerText;
        const url = window.location.href;
        const text = `Check out this course: ${title} - ${url}`;
        const skypeUrl = `https://web.skype.com/share?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
        window.open(skypeUrl, '_blank');
    }

</script>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Home Banner -->
    <section class="home-slide-2 d-flex align-items-center mt-5 mb-5">
        <div class="container">
            <div class="row ">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-2 logo-w">
                            <img id="client_logo" height="90px" width="90px" alt="">
                        </div>
                        <div class="col-md-10 mbl-conte job_details_page">
                            <h1 class="job-card-title " id="job_title"></h1>
                            <img src="<?php echo base_url() . "assets/frontend/default-new/image/office-building.svg"; ?>" alt=""> <span class="text-secondary location-para" id="comapny_name"></span>
                            <img src="<?php echo base_url() . "assets/frontend/default-new/image/loaction_pin.svg"; ?>" alt=""> <span class="text-secondary location-para job_location"></span>
                            <img src="<?php echo base_url() . "assets/frontend/default-new/image/clock_mnth.svg"; ?>" alt=""> <span class="text-secondary location-para job_created_at"></span>
                            <img src="<?php echo base_url() . "assets/frontend/default-new/image/wallet_job.svg"; ?>" alt=""> <span class="text-secondary location-para job_salary"></span>
                            <div class="job-detail-buttons mb-3 ellipsis-line-2">
                                <button class="search-buttons detail-button" id="job_employment_type"> </button>
                                <button class="search-buttons detail-button" id="job_work_mode"></button>
                                <button class="search-buttons detail-button" id="job_required_skills_text"></button>
                            </div>
                        </div>
                    </div>
                    <div class="job-description pt-3">
                        <h5 class="subs-title">Job Description</h5>
                        <p id="job_description"></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <button class="btn btn-primary px-5 w-75" id="apply_job_btn" data-fancybox="">Apply Now</button>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary px-5 w-75 mt-2" onclick="enableShareOptions()" data-fancybox=""> <i class="fa fa-share"></i> Share</button>
                    </div>

                    <div class="job-description-card mt-4 p-3 rounded dropdown-content" id="share-button-lg">
                        <div class=" shadow-lg bg-info-subtle rounded">
                            <div class="share-social-media ">
                                <a href="#" onclick="shareOnFacebook()" class="facebook-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/facebook_share_icon.svg"; ?>" alt=""></a>
                                <a href="#" onclick="shareOnLinkedin()" class="linkedin-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/linkedin_share_icon.svg"; ?>" alt=""></a>
                                <a href="#" onclick="shareOnWhatsApp()" class="whatsapp-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/whatsapp_share_icon.svg"; ?>" alt=""></a>
                                <a href="#" onclick="shareOnSkype()" class="skype-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/skype_share_icon.svg"; ?>" alt=""></a>

                            </div>
                        </div>
                    </div>
                    <div class="job-description-card mt-4 p-3 rounded">
                        <div class="d-flex ">
                            <div>
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/job-calendar.svg"; ?>" alt="" class="job-icons">
                            </div>
                            <div class="px-3 job-details">
                                <h6>Date Posted</h6>
                                <p class="job_created_at"></p>
                            </div>
                        </div>
                        <div class="d-flex pt-3">
                            <div>
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/job-d-location.svg"; ?>" alt="" class="job-icons">
                            </div>
                            <div class="px-3 job-details">
                                <h6>Loaction</h6>
                                <p class="job_location"></p>
                            </div>
                        </div>
                        <div class="d-flex pt-3">
                            <div>
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/job-d-salary.svg"; ?>" alt="" class="job-icons">
                            </div>
                            <div class="px-3 job-details">
                                <h6>Offered Salary</h6>
                                <p class="job_salary"></p>
                            </div>
                        </div>
                        <div class="d-flex pt-3">
                            <div>
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/expertise_job.svg"; ?>" alt="" class="job-icons">
                            </div>
                            <div class="px-3 job-details">
                                <h6>Experience</h6>
                                <p id="job_experience"></p>
                            </div>
                        </div>
                        <div class="d-flex pt-3">
                            <div>
                                <img src="<?php echo base_url() . "assets/frontend/default-new/image/qualifucation_b.svg"; ?>" alt="" class="job-icons">
                            </div>
                            <div class="px-3 job-details">
                                <h6>Qualification</h6>
                                <p id="job_qualification"></p>
                            </div>
                        </div>
                    </div>
                    <div class="job-description-card mt-4 p-3 rounded">
                        <h5 class="subs-title">Job Skills</h5>
                        <div class="job-detail-buttons mb-3 " id="job_required_skills_tiles">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="contact_us_modal" id="applyjobModal">
    <div class="contact_us_modal-content">
        <div class="row">
            <div class="col-md-10 col-sm-10 col-md-lg-10 text-center c-head">
                <h4>Apply <span class="Us-color">Job</span></h4>
            </div>
            <div class="col-md-2 col-sm-2 col-md-lg-2">
                <span class="close" id="closeModal2">&times;</span>
            </div>
        </div>

        <section class="sign-up my-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="sing-up-right" style="margin-top: 0px !important;">
                            <form action="javascript:void(0);" name="apply_job_popup_form" id="apply_job_popup_form">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <div>
                                            <!-- <label class="form_label">First Name *</label> -->
                                            <input name="apply_job_name" type="text" class="form-control" maxlength="26" id="apply_job_name" required placeholder="<?php echo get_phrase('Name *') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <div>
                                            <!-- <label class="form_label">Email *</label> -->
                                            <input name="apply_job_email" type="email" class="form-control" id="apply_job_email" required placeholder="<?php echo get_phrase('Email *') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 phon-enquery">
                                        <div>
                                            <input name="apply_job_phone" type="text" class="form-control " id="apply_job_phone" required placeholder="<?php echo get_phrase('Phone *') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 phon-enquery">
                                        <div>
                                            <input name="apply_job_resume" type="file" class="form-control " id="apply_job_resume" required placeholder="<?php echo get_phrase('Phone *') ?>">
                                            <div class="note">Note: Allows PDF, DOC, DOCX files only up to 2MB size.</div>
                                            <div class="error" id="fileError"></div>
                                            <ul id="fileList"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">

                                        <div class="form-btn">
                                            <button type="submit" class="btn btn-primary col-12"><?php echo get_phrase('Submit'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    const applyJobPhone = document.querySelector("#apply_job_phone");
    const applyJobPhoneConf = window.intlTelInput(applyJobPhone, {
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    const applyjobModal = document.getElementById('applyjobModal');
    const apply_job_btn = document.getElementById('apply_job_btn');
    apply_job_btn.addEventListener('click', function() {
        applyjobModal.style.display = 'block';
        localStorage.setItem('clickFrom', 'video');
    });

    const closeModal2 = document.getElementById('closeModal2');
    closeModal2.addEventListener('click', function() {
        applyjobModal.style.display = 'none';
        let contactPopUpClosed = localStorage.getItem("contactPopUpClosed") ? parseInt(localStorage.getItem("contactPopUpClosed")) : 0;
        contactPopUpClosed += 1;
        localStorage.setItem("contactPopUpClosed", contactPopUpClosed)

    });

    //Resume handling
    document.getElementById('apply_job_resume').addEventListener('change', function(event) {
        let file = event.target.files[0];
        if (file) {

            var fileInput = document.getElementById('apply_job_resume');
            var fileError = document.getElementById('fileError');
            var allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
            var maxSize = 2 * 1024 * 1024; // 2MB

            fileError.textContent = '';

            if (!allowedExtensions.exec(file.name)) {
                fileError.textContent = 'Invalid file type. Only PDF, DOC, and DOCX files are allowed.';
                fileInput.value = '';
                e.preventDefault();
                return false;
            }

            if (file.size > maxSize) {
                fileError.textContent = 'File size exceeds 2MB.';
                fileInput.value = '';
                e.preventDefault();
                return false;
            }

            //delete if there is a file
            if ($("#resume_file").val()) {
                deleteFile($("#resume_file").val());
            }
            let formData = new FormData();
            formData.append('file', file);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', "<?php echo base_url("home/upload"); ?>", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    document.getElementById('fileList').innerHTML = "";
                    let li = document.createElement('li');
                    li.innerHTML = `
                        <input type="hidden" name="resume_file" id="resume_file" value="${response.filePath}">
                    `;
                    document.getElementById('fileList').appendChild(li);
                }
            };
            xhr.send(formData);
        }
    });

    window.onload = function() {
        function convertdateStringToDate(dateString) {
            // Create a new Date object from the input string
            const date = new Date(dateString);

            // Array of month names
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            // Extract the month, day, and year from the Date object
            const month = monthNames[date.getMonth()];
            const day = date.getDate();
            const year = date.getFullYear();

            // Format the date string as "May 21, 2024"
            const formattedDate = `${month} ${day}, ${year}`;
            return formattedDate;
        }

        function numberWithCommas(x) {
            return x.toString().split('.')[0].length > 3 ? x.toString().substring(0, x.toString().split('.')[0].length - 3).replace(/\B(?=(\d{2})+(?!\d))/g, ",") + "," + x.toString().substring(x.toString().split('.')[0].length - 3) : x.toString();
        }

        function ajax(url, method, data, successCallback, errorCallback) {
            // var apiUrl = "http://localhost/dreams_angular/rest/public/";
            var baseUrl = "<?php echo base_url(); ?>";
            var xhr = new XMLHttpRequest();
            xhr.open(method, baseUrl + url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        var responseData = xhr.responseText ? JSON.parse(xhr.responseText) : null;
                        successCallback(responseData);
                    }
                }
            };
            console.log(method);
            console.log(data);
            if (data && method !== 'GET') {
                xhr.send(JSON.stringify(data));
            } else {
                xhr.send();
            }
        }

        let searchParams = new URLSearchParams(window.location.search);
        let id = searchParams.get('id');
        ajax('jobs/show/' + id, 'GET', null, function(response) {
            //title
            $("#job_title").text(response.title);
            //company name
            $("#comapny_name").text(response.company_name);
            //location
            $(".job_location").text(response.location);
            //craeted date
            $(".job_created_at").text(convertdateStringToDate(response.created_at));
            //salary
            if (response.min_pay_scale == response.max_pay_scale) {
                if (response.min_pay_scale > 0) {
                    $(".job_salary").text('₹' + numberWithCommas(response.min_pay_scale) + ' PA');
                } else {
                    $(".job_salary").text('Not discolsed');

                }
            } else {
                $(".job_salary").text('₹' + numberWithCommas(response.min_pay_scale) + '- ₹' + numberWithCommas(response.max_pay_scale) + ' PA');
            }
            //employment type
            $("#job_employment_type").text(response.employment_type);
            //work mode
            $("#job_work_mode").text(response.work_mode);
            //required skills
            $('#job_required_skills_text').text((JSON.parse(response.required_skills)).join(", "))
            $('#job_required_skills_tiles').html(composeRequiredSkillsTiles(JSON.parse(response.required_skills)));
            //experience
            $("#job_experience").text(response.min_experience + '-' + response.max_experience + ' Years');
            //qualification
            $('#job_qualification').text((JSON.parse(response.qualification)).toString())
            //description
            $("#job_description").html(response.description);
            //client logo
            if (response.logo) {
                $('#client_logo').attr('src', '<?php echo base_url() . "uploads/jobs/logo/";  ?>' + response.logo)
            } else {
                $('#client_logo').attr('src', '<?php echo base_url() . "assets/frontend/default-new/image/icon/office-building.png";  ?>')
            }

        })

        function composeRequiredSkillsTiles(skills) {
            let skill_tiles = "";
            if (skills) {
                skills.forEach(element => {
                    skill_tiles += `<button class="search-buttons detail-button-2 bg-light">${element} </button>`;
                });
            }
            return skill_tiles;
        }

        function deleteFile(filePath) {
            let xhr = new XMLHttpRequest();
            xhr.open('DELETE', '<?php echo base_url("home/deleteFile"); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.status === 200) {}
                }
            };
            xhr.send(JSON.stringify({
                filePath: filePath
            }));
        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePhoneNumber(phone) {
            const phoneRegex = /^\+?(?:[0-9]+(?:[ -][0-9]+)*)$/; // Regex for numbers, spaces, hyphens, and plus signs
            return phoneRegex.test(phone);
        }

        $('#apply_job_popup_form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var btn = $(this);
            btn.prop("disabled", true);

            var full_number = applyJobPhoneConf.getNumber(intlTelInputUtils.numberFormat.E164);
            //$("#course_details_popup_form_phone").val(full_number);

            // Validation
            let isValid = true;
            const name = $('#apply_job_name').val().trim();
            const email = $('#apply_job_email').val().trim();
            const phone = full_number;
            let searchParams = new URLSearchParams(window.location.search);
            const job_id = searchParams.get('id');
            if (!name) {
                alert('Name is required');
                isValid = false;
            }

            if (!email) {
                alert('Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                alert('Invalid email format');
                isValid = false;
            }

            if (!phone) {
                alert('Phone number is required');
                isValid = false;
            } else if (!validatePhoneNumber(phone)) {
                alert('Invalid phone number format');
                isValid = false;
            }

            //getting form into Jquery Wrapper Instance to enable JQuery Functions on form                    
            var form = $("#apply_job_popup_form");

            //Serializing all For Input Values (not files!) in an Array Collection so that we can iterate this collection later.
            var params = form.serializeArray();

            //Getting Files Collection
            var files = $("#apply_job_resume")[0].files;

            //Declaring new Form Data Instance  
            var formData = new FormData();


            //Now Looping the parameters for all form input fields and assigning them as Name Value pairs. 
            $(params).each(function(index, element) {
                formData.append(element.name, element.value);
            });

            // dump formData object
            var data = {};
            formData.forEach(function(value, key) {
                if (key == apply_job_phone) {
                    data[key] = data["full"];
                } else {
                    data[key] = value;
                }
            });
            //Looping through uploaded files collection in case there is a Multi File Upload. This also works for single i.e simply remove MULTIPLE attribute from file control in HTML.  
            for (var i = 0; i < files.length; i++) {
                data['resume'] = files;
            }

            data["job_id"] = job_id;

            ajax('home/applyJob', 'POST', data, function(response) {
                btn.prop("disabled", false);
                // Click the button to dismiss the modal
                if (response.message == 'Application Submitted Successfully.') {
                    $("#closeModal2").click();
                }

                alert(response.message);

            }, function(status, statusText, error) {
                btn.prop("disabled", false);
                alert((JSON.parse(error.responseText)).messages.error);
                console.error('Error:', status, (JSON.parse(error.responseText)).messages.error);
            });
        });

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('#share-button-lg')) {
                const dropdowns = document.getElementsByClassName('dropdown-content');
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        };
    }
</script>