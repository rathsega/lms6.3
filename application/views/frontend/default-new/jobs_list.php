<style>
    .search-bar {
        background-color: #fff;
        border-radius: 30px;
        padding: 14px;
        box-shadow: rgba(50, 50, 93, 0.25) -1px 4px 12px 0px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }

    .form-select {
        border: 1px solid #ffffff;
        /* Light border for selectors */
    }


    .wider-select {
        width: 200px;
        /* Adjust width as needed */
        color: #685f78e0;
    }

    .wider-select-2 {
        width: 380px;
        color: #685f78e0;
    }

    .j-s-btn {
        border-radius: 23px;
    }

    .home-slide-3 {
        position: relative;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        margin-top: 5vh;
        margin-bottom: 70px;
    }

    .job-wrapper {
        padding-top: 4px;
    }

    .form-select {
        border: 1px solid #ffffff !important;
        font-size: 16px;
    }

    .btn-primary {
        padding: 5px 28px;

    }

    .navigation-btn {
        margin-left: auto;
    }

    .job-style {
        display: none;
    }

    .type-container {
        label {
            margin-left: 2px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
    }

    .type-container {
        display: flex;
        align-items: center;
        color: #484849;
        font-size: 13px;
        padding-bottom: 8px;
    }

    .job-time-title {
        color: #2f2f33;
        font-size: 15px;
        font-weight: 500;
    }

    .job-style:checked+label:before {
        background-color: #0162ff;
        border-color: #0162ff;
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='26' height='26' fill='white' class='bi bi-check-lg' viewBox='0 0 16 16'%3E%3Cpath d='M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z'/%3E%3C/svg%3E");
        /* Inline SVG code */
        background-position: 50%;
        background-size: 14px;
        background-repeat: no-repeat;
    }

    .job-style+label:before {
        content: "";
        margin-right: 10px;
        width: 16px;
        height: 16px;
        border: 1px solid #83838e;
        border-radius: 4px;
        cursor: pointer;
    }

    .job-style:checked+label+span {
        background-color: #e1ebfb;
        color: #0162ff;
    }

    .job-number {
        margin-left: auto;
        background-color: #f0f0f0;
        color: #484849;
        font-size: 10px;
        font-weight: 500;
        padding: 5px;
        border-radius: 4px;
    }

    input:checked~label,
    label:hover,
    label:hover~label {
        color: #754ffe !important;
        font-weight: 500;
    }

    .job-card-title {
        font-size: 16px;
        line-height: 18px;
        font-weight: 600;
        color: #392C7D;
    }

    .location-para {
        font-size: 12px;
        font-weight: 500;
        padding-right: 13px;
    }

    .job-time-card {
        /* box-shadow: rgb(17 17 26 / 7%) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px; */
        box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;
        padding: 18px;
        border-radius: 6px;
    }

    .view-m-links {
        color: #0162ff;
        font-size: 12px;
        font-weight: 500;
    }

    .dropdown-item {
        color: #000000;
    }

    .dropdown-item.active,
    .dropdown-item:active {
        background-color: #000000;
    }

    .dropdown-item.active,
    .dropdown-item:active {
        color: #ffffff;
    }

    .dropdown-toggle {
        margin-left: auto;
        white-space: nowrap;
        background: #e9ecef !important;
        color: black !important;
        border: none !important;
    }

    .dropdown-item:focus,
    .dropdown-item:hover {
        color: #000;
        font-weight: 500;
    }

    .dropdown-item.active,
    .dropdown-item:active {
        color: #ffffff;
    }

    .job-listings-section-card {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        padding: 18px;
        border-radius: 6px;
        margin-top: 30px;
        padding-top: 30px;
    }

    .job-logo-listing {
        height: 55px;
        padding: 10px;
        border-radius: 8px;
    }

    .logo-w-listing {
        width: 9.66666%;
    }

    .badge-size {
        font-size: 8px !important;
        font-weight: 400;
    }

    .job-action {
        svg {
            width: 32px;
            border: 1px solid #d8d8d8;
            color: #83838e;
            border-radius: 8px;
            padding: 6px;
        }
    }

    .page-item:last-child:not(.active) .page-link,
    .page-item:first-child:not(.active) .page-link {
        border-radius: 5px;
        border: none;
        background-color: #e0d7ff;
        color: #754ffe;
        /* border: 1px solid var(--bg-white); */
    }

    @media (max-width:768px) {
        .wider-select-2 {
            width: 345px;
            margin-bottom: 18px;
        }

        .wider-select {
            width: 346px;
            margin-bottom: 18px;
        }

        .j-s-btn {
            border-radius: 23px;
            width: 103px;
        }

        .home-slide-3 {
            margin-top: 12vh;
        }

        .filter-btn {
            margin-left: auto !important;
        }
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
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
    function enableShareOptions(job_id) {
        event.stopPropagation();
        console.log("clicked");
        console.log(job_id);
        let myDiv = document.getElementById("share-options-" + job_id);
        console.log(myDiv.style.display);
        if (myDiv.style.display === "none" || myDiv.style.display == "") {
            myDiv.style.display = "block";
        } else {
            myDiv.style.display = "none";
        }
    }

    function shareOnFacebook(job_id) {
        event.preventDefault();
        event.stopPropagation();
        const url = "<?php echo base_url("home/job_details?id=") ?>" + job_id;
        const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        window.open(facebookUrl, '_blank');
    }

    function shareOnLinkedin(job_id, title) {
        event.preventDefault();
        event.stopPropagation();
        const url = "<?php echo base_url("home/job_details?id=") ?>" + job_id;
        const linkedinUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}&title=${encodeURIComponent(title)}`;
        window.open(linkedinUrl, '_blank');
    }

    function shareOnWhatsApp(job_id, title) {
        event.preventDefault();
        event.stopPropagation();
        const url = "<?php echo base_url("home/job_details?id=") ?>" + job_id;
        const text = `Check out this course: ${title} - ${url}`;
        const whatsappUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(text)}`;
        window.open(whatsappUrl, '_blank');
    }

    function shareOnSkype(job_id, title) {
        event.preventDefault();
        event.stopPropagation();
        const url = "<?php echo base_url("home/job_details?id=") ?>" + job_id;
        const text = `Check out this course: ${title} - ${url}`;
        const skypeUrl = `https://web.skype.com/share?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
        window.open(skypeUrl, '_blank');
    }

    function showJobDetails(job_id) {
        const url = "<?php echo base_url("home/job_details?id=") ?>" + job_id;
        window.open(url, '_blank');
    }
</script>
<!-- Main Wrapper -->
<div class="main-wrapper">

    <?php
    $payscale_ranges = [
        "0-300000" => "0-3 Lakhs",
        "300000-600000" => "3-6 Lakhs",
        "600000-1000000" => "6-10 Lakhs",
        "1000000-1500000" => "10-15 Lakhs",
        "1500000-2000000" => "15-20 Lakhs",
        "2000000-3000000" => "20-30 Lakhs",
        "3000000-5000000" => "30-50 Lakhs",
        "5000000-7500000" => "50-75 Lakhs",
        "7500000-10000000" => "75-100 Lakhs",
        "10000000-50000000" => "1-5 Cr"
    ];

    ?>

    <!-- Home Banner -->
    <section class="home-slide-3 d-flex align-items-center d-none d-md-block">


    </section>

    <!-- --------mobile--filter------------------------- -->
    <section class="home-slide-3 d-flex align-items-center d-block d-md-none">
        <div class="container">
            <div class="col-md-10 mx-auto search-bar align-items-center ">
                <div class="flex-grow-1 me-2">
                    <select class="form-select wider-select-2" aria-label="Skill">
                        <option selected>Enter skills / designation / companies</option>
                        <option value="skill1">Skill 1</option>
                        <option value="skill2">Skill 2</option>
                        <option value="skill3">Skill 3</option>
                    </select>
                </div>
                <div class="flex-grow-1 me-2">
                    <select class="form-select wider-select" aria-label="Experience (Years)">
                        <option selected>Select experience</option>
                        <option value="1">1 Year</option>
                        <option value="2">2 Years</option>
                        <option value="3">3 Years +</option>
                    </select>
                </div>
                <div class="flex-grow-1 me-2">
                    <select class="form-select wider-select" aria-label="Location">
                        <option selected>Enter location</option>
                        <option value="location1">Location 1</option>
                        <option value="location2">Location 2</option>
                        <option value="location3">Location 3</option>
                    </select>
                </div>
                <div class="input-group d-flex align-items-center">
                    <div>
                        <button class="btn btn-primary px-3 j-s-btn" type="submit">Search</button>
                    </div>
                    <div class="filter-btn">
                        <svg type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000" class="bi bi-funnel-fill order-2" viewBox="0 0 16 16">
                            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z" />
                        </svg>
                    </div>
                    <!-- ---------side-bar mobile canvas---------------- -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel">Filter Options</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="col-md-3 ">
                                <div class="job-time job-time-card mb-4">
                                    <div class="job-time-title">Job title</div>
                                    <div class="job-wrapper">
                                        <div class="type-container">
                                            <input type="checkbox" id="job1" class="job-style" checked="">
                                            <label for="job1">Front-end Developer</label>
                                            <span class="job-number">56</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="job2" class="job-style">
                                            <label for="job2">UI-UX Designer</label>
                                            <span class="job-number">43</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="job3" class="job-style">
                                            <label for="job3">UI - Developer</label>
                                            <span class="job-number">24</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="job4" class="job-style">
                                            <label for="job4">Back-end Developer</label>
                                            <span class="job-number">27</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="job5" class="job-style">
                                            <label for="job5">Graphic-Designer</label>
                                            <span class="job-number">76</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="job6" class="job-style">
                                            <label for="job6">SEO</label>
                                            <span class="job-number">28</span>
                                        </div>
                                        <a href="" class="view-m-links"> View More</a>
                                    </div>
                                </div>

                                <div class="job-time job-time-card mb-3">
                                    <div class="job-time-title">Work Mode</div>
                                    <div class="job-wrapper">
                                        <div class="type-container">
                                            <input type="checkbox" id="wm1" class="job-style" checked="">
                                            <label for="wm1">Work from office</label>
                                            <span class="job-number">56</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="wm2" class="job-style">
                                            <label for="wm2">Remote</label>
                                            <span class="job-number">43</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="wm3" class="job-style">
                                            <label for="wm3">Work from home</label>
                                            <span class="job-number">24</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="wm4" class="job-style">
                                            <label for="wm4">WFH - WFO</label>
                                            <span class="job-number">27</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="wm5" class="job-style">
                                            <label for="wm5">Temp - WFH</label>
                                            <span class="job-number">76</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="wm6" class="job-style">
                                            <label for="wm6">Freelancing</label>
                                            <span class="job-number">16</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="job-time job-time-card mb-3">
                                    <div class="job-time-title">Experience - Level</div>
                                    <div class="job-wrapper">
                                        <label for="customRange1" class="form-label">0 - Any</label>
                                        <input type="range" class="form-range" id="customRange1">
                                    </div>
                                </div>


                                <div class="job-time job-time-card mb-3">
                                    <div class="job-time-title">Location</div>
                                    <div class="job-wrapper">
                                        <div class="type-container">
                                            <input type="checkbox" id="loc1" class="job-style" checked="">
                                            <label for="loc1">Hyderabad</label>
                                            <span class="job-number">56</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="loc2" class="job-style">
                                            <label for="loc2">Delhi</label>
                                            <span class="job-number">43</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="loc3" class="job-style">
                                            <label for="loc3">Bangaluru</label>
                                            <span class="job-number">24</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="loc4" class="job-style">
                                            <label for="loc4">Mumbai</label>
                                            <span class="job-number">27</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="loc5" class="job-style">
                                            <label for="loc5">Kolkata</label>
                                            <span class="job-number">76</span>
                                        </div>
                                    </div>
                                    <a href="" class="view-m-links"> View More</a>
                                </div>


                                <div class="job-time job-time-card mb-3">
                                    <div class="job-time-title">Salary range</div>
                                    <div class="job-wrapper">
                                        <div class="type-container">
                                            <input type="checkbox" id="sal1" class="job-style" checked="">
                                            <label for="sal1">0-3 Lakhs</label>
                                            <span class="job-number">56</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="sal2" class="job-style">
                                            <label for="sal2">3-6 Lakhs</label>
                                            <span class="job-number">43</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="sal3" class="job-style">
                                            <label for="sal3">6-10 Lakhs</label>
                                            <span class="job-number">24</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="sal4" class="job-style">
                                            <label for="sal4">10-13 Lakhs</label>
                                            <span class="job-number">27</span>
                                        </div>
                                        <div class="type-container">
                                            <input type="checkbox" id="sal5" class="job-style">
                                            <label for="sal5">13-15 Lakhs</label>
                                            <span class="job-number">76</span>
                                        </div>
                                    </div>
                                    <a href="" class="view-m-links"> View More</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- ---------side-bar mobile canvas//---------------- -->
                </div>


            </div>
        </div>
    </section>
    <!-- --------mobile//--filter------------------------- -->
    <div class="listing-jobs-section container">
        <div class="row">
            <div class="col-md-3 d-none d-md-block" id="filterButton">

                <div class="job-time job-time-card mb-3">
                    <div class="job-time-title">Work mode</div>
                    <div class="job-wrapper">
                    <div class="job-time job-time-card mb-3" id="workModeFilters"></div>

                    </div>
                </div>

                <div class="job-time job-time-card mb-3">
                    <div class="job-time-title">Experience - Level</div>
                    <div class="job-wrapper" id="experienceFilters">
                    </div>
                </div>


                <div class="job-time job-time-card mb-3">
                    <div class="job-time-title">Location</div>
                    <div class="job-wrapper  truncate-location-filters">
                    <div class="job-time job-time-card mb-3" id="locationFilters"></div>

                    </div>
                    <a href="javascript:void(0);" id="showMoreLocBtn" class="view-m-links"> Show More</a>
                </div>


                <div class="job-time job-time-card mb-3">
                    <div class="job-time-title">Salary Range</div>
                    <div class="job-wrapper truncate-pay-scale-filters" id="payScaleFilters">
                        <div class="job-time job-time-card mb-3">
                            <div class="job-wrapper">
                                
                                    <?php foreach ($payscale_ranges as $value => $label) : ?>
                                        <div class="type-container">
                                            <input type="checkbox" id="<?= htmlspecialchars($label) ?>" name="pay_scales[]" value="<?= htmlspecialchars($value) ?>" class="pay-scale job-style">
                                            <label for="<?= htmlspecialchars($label) ?>"><?= htmlspecialchars($label) ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                
                            </div>
                        </div>

                    </div>
                    <a href="javascript:void(0);" id="showMorePayScaleBtn" class="view-m-links"> Show More</a>
                </div>

            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 d-none d-md-block">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" id="job_prev_btn">Previous</a>
                                </li>
                                <li class="page-item navigation-btn">
                                    <a class="page-link navi-bord" href="javascript:void(0);" id="page_numbers"></a>
                                </li>
                                <li class="page-item navigation-btn">
                                    <a class="page-link" href="javascript:void(0);" id="job_nxt_btn">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>

                <div id="jobs_slides"></div>

            </div>
        </div>
    </div>




</div>
<script>
    let paginationDetails = {
        current_page_number: 1,
        records_per_page: 10,
        get currentPageNumber() {
            return this.current_page_number;
        },
        set currentPageNumber(number) {
            this.current_page_number = number;
        },
        total_records_count: 0,
        set totalRecordsCount(number) {
            this.total_records_count = number;
        },
        get totalRecordsCount() {
            return this.total_records_count;
        },
        get pageCount() {
            return this.totalRecordsCount % this.records_per_page == 0 ? this.totalRecordsCount / this.records_per_page : (parseInt(this.totalRecordsCount / this.records_per_page) + 1);
        }
    }

    $(document).ready(function() {


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

        function getPaginatedJobs() {
            ajax('jobs/getPaginatedJobs/' + paginationDetails.currentPageNumber + '/' + paginationDetails.records_per_page, 'GET', null, function(response) {

                let jobs_slides = composeJobsSlide(response);
                document.getElementById("jobs_slides").innerHTML = jobs_slides;
                // configureBlogsSlides();
            }, function(status, statusText) {
                console.error('Error:', status, statusText);
            });
        }

        function composeJobsSlide(jobs = null) {
            let jobs_slides = '';
            jobs.forEach(slide => {
                let skills = JSON.parse(slide.required_skills);
                let skills_html = "";
                skills.forEach(skill => {
                    skills_html += `<span class="badge text-bg-dark">${skill}</span>`
                })

                let client_logo = '';
                if (slide.logo) {
                    client_logo = '<?php echo base_url() . "uploads/jobs/logo/";  ?>' + slide.logo;
                } else {
                    client_logo = '<?php echo base_url() . "assets/frontend/default-new/image/icon/office-building.png";  ?>';
                }

                let pay_scale = '';
                if (slide.min_pay_scale == slide.max_pay_scale) {
                    if (slide.min_pay_scale > 0) {
                        pay_scale = '₹' + numberWithCommas(slide.min_pay_scale) + ' PA';
                    } else {
                        pay_scale = 'Not discolsed';

                    }
                } else {
                    pay_scale = '₹' + numberWithCommas(slide.min_pay_scale) + '- ₹' + numberWithCommas(slide.max_pay_scale) + ' PA';
                }
                jobs_slides += `<div class="job-listings-section-card mb-5" onclick="showJobDetails(${slide.id})" style="cursor: pointer !important;">
              <div class="row">
                <div class="col-md-2 logo-w-listing">
                  <img height="70px" width="70px" src="${client_logo}" alt="">
                </div>
                <div class="col-md-8 mbl-conte">
                  <h1 class="job-card-title ">${slide.title} </h1>
                  <img src="<?php echo base_url() . "assets/frontend/default-new/image/office-building.svg"; ?>" alt=""> <span class="text-secondary location-para">${slide.company_name}</span>
                  <img src="<?php echo base_url() . "assets/frontend/default-new/image/yaer_of-work.svg"; ?>" alt=""> <span class="text-secondary location-para">${slide.min_experience == slide.max_experience ? slide.min_experience : slide.min_experience + " - " + slide.max_experience} Years</span>
                  <img src="<?php echo base_url() . "assets/frontend/default-new/image/loaction_pin.svg"; ?>" alt=""> <span class="text-secondary location-para">${slide.location}</span>
                  <!-- <img src="<?php echo base_url() . "assets/frontend/default-new/image/clock_mnth.svg"; ?>" alt=""> <span class="text-secondary location-para">${convertdateStringToDate(slide.created_at)}</span> -->

                  <img src="<?php echo base_url() . "assets/frontend/default-new/image/wallet_job.svg"; ?>" alt=""> <span class="text-secondary location-para">${pay_scale}</span>
                  <div class="job-detail-buttons mb-3 ellipsis-line-2">
                    <button class="search-buttons detail-button">${slide.employment_type} </button>
                    <button class="search-buttons detail-button">${slide.work_mode}</button>
                    <button class="search-buttons detail-button">${(JSON.parse(slide.required_skills)).join(", ")}</button>
                  </div>
                </div>
                <div class="col-md-2 d-flex justify-content-end">
                  <div class="job-action">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" onclick="enableShareOptions(${slide.id})"  class="share-button-lg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2">
                      <circle cx="18" cy="5" r="3"></circle>
                      <circle cx="6" cy="12" r="3"></circle>
                      <circle cx="18" cy="19" r="3"></circle>
                      <path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path>
                    </svg>
                    <div id="share-options-${slide.id}" class="dropdown-content shadow-lg bg-info-subtle rounded">
										<div class="share-social-media ">
											<a href="#" onclick="shareOnFacebook(${slide.id})" class="facebook-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/facebook_share_icon.svg"; ?>" alt=""></a>
											<a href="#" onclick="shareOnLinkedin(${slide.id}, '${slide.title}')" class="linkedin-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/linkedin_share_icon.svg"; ?>" alt=""></a>
											<a href="#" onclick="shareOnWhatsApp(${slide.id}, '${slide.title}')" class="whatsapp-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/whatsapp_share_icon.svg"; ?>" alt=""></a>
											<a href="#" onclick="shareOnSkype(${slide.id}, '${slide.title}')" class="skype-share"><img src="<?php echo base_url() . "assets/frontend/default-new/image/icon/skype_share_icon.svg"; ?>" alt=""></a>

										</div>
									</div>
                  </div>
                </div>
              </div>
            </div>`;
            })
            return jobs_slides;
        }

        function getJobsCount() {
            ajax('jobs/getJobsCount', 'GET', null, function(response) {
                let jobs_count = response.count;
                paginationDetails.totalRecordsCount = jobs_count;
                displayPageNumbers()
                //composePaginationButtons();
            }, function(status, statusText) {
                console.error('Error:', status, statusText);
            });
        }




        function generateFilters(min, max, type, interval, id) {
            console.log(min, max, type, interval, id)
            let filterOptions = '';
            for (let i = parseInt(min); i <= parseInt(max); i += interval) {
                let end = i + interval;
                if (end > parseInt(max)) {
                    end = parseInt(max);
                }
                let label = "";
                if (type == 'experience') {
                    label = `<label for="${type}_${i}_${end}"> ${i} - ${end} Years</label>`;
                } else {
                    label = `<label for="${type}_${i}_${end}">₹ ${numberWithCommas(i)} - ₹ ${numberWithCommas(end)}</label>`;
                }
                let field = '';
                if (type == 'experience') {
                    field = `<input type="checkbox" id="${type}_${i}_${end}" name="experiences[]" value="${i}-${end}" class="experience job-style">`;
                } else {
                    field = `<input type="checkbox" id="${type}_${i}_${end}" name="pay_scales[]" value="${i}-${end}" class="pay-scale job-style">`;
                }

                filterOptions += `
                <div class="type-container">
                    ${field}
                    ${label}
                </div>
            `;
            }
            $(`#${id}`).append(`<div class="job-time job-time-card mb-3">
            <div class="job-wrapper">${filterOptions}</div>
        </div>`);
        }

        // Function to populate filters dynamically
        function populateFilters(data) {
            var workModes = new Set();
            var experiences = new Set();
            var locations = new Set();
            var payScales = new Set();

            //data.forEach(job => {
            workModes.add(data.work_modes);
            experiences.add(data.experiences);
            locations.add(data.locations);
            payScales.add(data.pay_scales);
            //});

            console.log(data.locations);
            data.work_modes.forEach((mode, key) => {
                $('#workModeFilters').append(`<div class="type-container">
                <input type="checkbox" id="w-wm_${key}" value="${mode.work_mode}" name="work_modes[]"  class="work-mode job-style">
                <label for="w-wm_${key}">${mode.work_mode}</label>
                <span class="job-number">${mode.count}</span>
              </div>`);
            });

            generateFilters(data.experiences.min_experience, data.experiences.max_experience, 'experience', 3, 'experienceFilters');
            //generateFilters(data.pay_scales.min_pay_scale, data.pay_scales.max_pay_scale, 'salary', 200000, 'payScaleFilters');

            data.locations.forEach((loc, key) => {
                $('#locationFilters').append(`<div class="type-container">
                <input type="checkbox" id="w-loc_${key}" name="locations[]" value="${loc.location}" class="location job-style">
                <label for="w-loc_${key}">${loc.location}</label>
                <span class="job-number">${loc.count}</span>
              </div>`);
            });
        }

        // Function to collect selected filters
        function collectFilters() {
            var filters = {
                work_mode: [],
                experience: [],
                location: [],
                pay_scale: []
            };

            $('.work-mode:checked').each(function() {
                filters.work_mode.push($(this).val());
            });

            $('.experience:checked').each(function() {
                filters.experience.push($(this).val());
            });

            $('.location:checked').each(function() {
                filters.location.push($(this).val());
            });

            $('.pay-scale:checked').each(function() {
                filters.pay_scale.push($(this).val());
            });

            return filters;
        }

        // Function to load job data based on filters
        function loadJobs(filters) {
            let data = {
                work_mode: filters.work_mode.join(','),
                experience: filters.experience.join(','),
                location: filters.location.join(','),
                pay_scale: filters.pay_scale.join(','),
                page: paginationDetails.currentPageNumber,
                limit: paginationDetails.records_per_page
            };
            ajax('jobs/getJobsByUsingFilters', 'POST', data, function(response) {

                if (response.jobs && response.jobs.length > 0) {
                    let jobs_slides = composeJobsSlide(response.jobs);
                    document.getElementById("jobs_slides").innerHTML = "";
                    document.getElementById("jobs_slides").innerHTML = composeJobsSlide(response.jobs);
                    paginationDetails.totalRecordsCount = response.total_count;
                    displayPageNumbers();
                } else {
                    document.getElementById("jobs_slides").innerHTML = '<p>No jobs found</p>';
                }

            }, function(status, statusText) {
                console.error('Error:', status, statusText);
            });
            displayPageNumbers();
        }

        // Load filters and jobs on page load
        ajax('jobs/getFilterData', 'GET', null, function(response) {
            if (response) {
                populateFilters(response);
            }
        }, function(status, statusText) {
            console.error('Error:', status, statusText);
        });

        // Filter button click event
        $('#filterButton').click(function(event) {
            if (event.target.nodeName == "INPUT") {
                var filters = collectFilters();
                paginationDetails.currentPageNumber = 1;
                loadJobs(filters);
            }
        });

        //Handle Prev button
        let prevLink = document.getElementById("job_prev_btn");
        let disablingPrevLink = paginationDetails.currentPageNumber === 1 ? true : false;
        if (disablingPrevLink) {
            if (!prevLink.classList.contains('disabled')) {
                prevLink.classList.add('disabled');
            }
        } else {
            if (prevLink.classList.contains('disabled')) {
                prevLink.classList.remove('disabled');
            }
        }
        prevLink.addEventListener('click', function(e) {
            let currentPage = paginationDetails.currentPageNumber;
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                paginationDetails.currentPageNumber = currentPage;
                var filters = collectFilters();
                loadJobs(filters);
                handleButtonDisabling();
            }
        });

        //Handle next button
        let nextLink = document.getElementById("job_nxt_btn");
        let disablingNextLink = paginationDetails.currentPageNumber === paginationDetails.pageCount ? true : false;
        if (disablingNextLink) {
            if (!nextLink.classList.contains('disabled')) {
                nextLink.classList.add('disabled');
            }
        } else {
            if (nextLink.classList.contains('disabled')) {
                nextLink.classList.remove('disabled');
            }
        }
        nextLink.addEventListener('click', function(e) {
            let currentPage = paginationDetails.currentPageNumber;
            e.preventDefault();
            if (currentPage < paginationDetails.pageCount) {
                currentPage++;
                paginationDetails.currentPageNumber = currentPage;
                var filters = collectFilters();
                loadJobs(filters);
                handleButtonDisabling();
                console.log(paginationDetails)
            }
        });

        //Handle Prev and next buttons disabling
        function handleButtonDisabling() {

            let prevLink = document.getElementById("job_prev_btn");

            let disablingPrevLink = paginationDetails.currentPageNumber === 1 ? true : false;
            if (disablingPrevLink) {
                if (!prevLink.classList.contains('disabled')) {
                    prevLink.classList.add('disabled');
                }
            } else {
                if (prevLink.classList.contains('disabled')) {
                    prevLink.classList.remove('disabled');
                }
            }

            let disablingNextLink = paginationDetails.currentPageNumber === paginationDetails.pageCount ? true : false;
            if (disablingNextLink) {
                if (!nextLink.classList.contains('disabled')) {
                    nextLink.classList.add('disabled');
                }
            } else {
                if (nextLink.classList.contains('disabled')) {
                    nextLink.classList.remove('disabled');
                }
            }
            displayPageNumbers();
        }

        function displayPageNumbers() {
            $('#page_numbers').text(`${paginationDetails.currentPageNumber * paginationDetails.records_per_page > paginationDetails.total_records_count ? paginationDetails.total_records_count : paginationDetails.currentPageNumber * paginationDetails.records_per_page  }  out of  ${paginationDetails.total_records_count} Jobs`);
        }



        //location show more button
        const contentContainer = document.getElementById('locationFilters');
        const showMoreLocBtn = document.getElementById('showMoreLocBtn');

        let maxHeight = 13; // Initial max height

        showMoreLocBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const currentHeight = contentContainer.clientHeight;
            const scrollHeight = contentContainer.scrollHeight;
            if (currentHeight < scrollHeight) {

                console.log(currentHeight);
                console.log(scrollHeight);
                maxHeight += 5 // Increase by 250px on each click
                contentContainer.style.maxHeight = maxHeight + 'em';
            } else {
                // All content is already visible, no further action needed
                showMoreLocBtn.disabled = true;
                showMoreLocBtn.innerText = 'No more content';
            }
        });

        //Pay scale show more button
        const payScaleContentContainer = document.getElementById('payScaleFilters');
        const showMorePayScaleBtn = document.getElementById('showMorePayScaleBtn');

        let payScaleMaxHeight = 13; // Initial max height

        showMorePayScaleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const currentHeight = payScaleContentContainer.clientHeight;
            const scrollHeight = payScaleContentContainer.scrollHeight;
            if (currentHeight < scrollHeight) {

                console.log(currentHeight);
                console.log(scrollHeight);
                payScaleMaxHeight += 3 // Increase by 250px on each click
                payScaleContentContainer.style.maxHeight = payScaleMaxHeight + 'em';
            } else {
                // All content is already visible, no further action needed
                showMorePayScaleBtn.disabled = true;
                showMorePayScaleBtn.innerText = 'No more content';
            }
        });

        var filters = collectFilters();
        loadJobs(filters);
        getJobsCount();

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

    });
</script>