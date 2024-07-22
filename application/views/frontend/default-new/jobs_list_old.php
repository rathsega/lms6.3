<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <title>Dreams LMS</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.svg">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

  <!-- Slick CSS -->
  <link rel="stylesheet" href="assets/plugins/slick/slick.css">
  <link rel="stylesheet" href="assets/plugins/slick/slick-theme.css">

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

  <!-- Aos CSS -->
  <link rel="stylesheet" href="assets/plugins/aos/aos.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

</head>
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
    padding-top: 20px;
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
</style>

<body>

  <!-- Main Wrapper -->
  <div class="main-wrapper">

    <?php
    $filter_options = json_decode($filter_options);
    ?>

    <!-- Home Banner -->
    <section class="home-slide-3 d-flex align-items-center d-none d-md-block">
      <div class="container">
        <div class="col-md-10 mx-auto search-bar d-flex align-items-center ">
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
          <div class="input-group">
            <button class="btn btn-primary px-3 j-s-btn" type="submit">Search</button>
          </div>
        </div>
      </div>

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
              <option value="">Select Experience</option>
              <?php foreach ($experience_options as $option) : ?>
                <option value="<?= $option['min_experience'] . '-' . $option['max_experience'] ?>"><?= $option['min_experience'] . '-' . $option['max_experience'] ?> Years</option>
              <?php endforeach; ?>
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
                    <div class="job-time-title">Work mode</div>
                    <div class="job-wrapper">
                      <?php foreach ($filter_options->work_modes as $wm) : ?>
                        <div class="type-container">
                          <input type="checkbox" id="wm1" class="job-style" checked="">
                          <label for="wm1">Work from office</label>
                          <span class="job-number">56</span>
                        </div>
                      <?php endforeach; ?>
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
              <?php foreach ($filter_options->work_modes as $key => $wm) : ?>
                <div class="type-container">
                  <input type="checkbox" name="work_mode[]" id="wm_<?php echo $key; ?>" class="job-style filter work-mode">
                  <label for="wm_<?php echo $key; ?>"><?php echo $wm->work_mode ?></label>
                  <span class="job-number"><?php echo $wm->count ?></span>
                </div>
              <?php endforeach; ?>

            </div>
          </div>

          <div class="job-time job-time-card mb-3">
            <div class="job-time-title">Experience - Level</div>
            <div class="job-wrapper">
              <?php $range = 2; // 2 lakh range
              $j = 0;
              for ($i = (int)$filter_options->experiences->min_experience; $i <= (int)$filter_options->experiences->max_experience; $i += $range) : ?>
                <?php $end_range = $i + $range - 1;
                ++$j; ?>
                <div class="type-container">
                  <input type="checkbox" id="w-exp_<?php echo $j; ?>" name="experience_level[]" class="job-style filter experience" value="<?php echo $i . '-' . $end_range; ?>">
                  <label for="w-exp_<?php echo $j; ?>"><?php echo $i . '-' . $end_range . " Years"; ?></label>
                </div>
              <?php endfor; ?>

            </div>
          </div>


          <div class="job-time job-time-card mb-3">
            <div class="job-time-title">Location</div>
            <div class="job-wrapper">
              <?php foreach ($filter_options->locations as $key => $loc) : ?>
                <div class="type-container">
                  <input type="checkbox" name="location_checkboxes[]" id="loc__<?php echo $key; ?>" class="job-style filter location">
                  <label for="loc__<?php echo $key; ?>"><?php echo $loc->location ?></label>
                  <span class="job-number"><?php echo $loc->count ?></span>
                </div>
              <?php endforeach; ?>
            </div>
            <a href="" class="view-m-links"> View More</a>
          </div>


          <div class="job-time job-time-card mb-3">
            <div class="job-time-title">Salary range</div>
            <div class="job-wrapper">
              <?php $range = 200000; // 2 lakh range
              $j = 0;
              for ($i = (int)$filter_options->pay_scales->min_pay_scale; $i <= (int)$filter_options->pay_scales->max_pay_scale; $i += $range) : ?>
                <?php $end_range = $i + $range - 1;
                $j++; ?>
                <div class="type-container">
                  <input type="checkbox" id="w-sal_<?php echo $j; ?>" name="salary_range[]" class="job-style filter pay-scale" value="<?php echo $i . '-' . $end_range; ?>">
                  <label for="w-sal_<?php echo $j; ?>"><?php echo format_currency($i) . '-' . format_currency($end_range); ?></label>
                </div>
              <?php endfor; ?>

            </div>
            <a href="" class="view-m-links"> View More</a>
          </div>

        </div>

        <?php

        $page = 1;
        if (isset($_GET['page'])) {
          $page = $_GET['page'];
        } else {
          $page = 1;
        }
        $records_per_page = 10;
        $total_pages = $total_count == 0 ? 0 : ($total_count <= 10 ? 1 : ($total_count % $records_per_page == 0 ? floor($total_count / $records_per_page) : floor($total_count / $records_per_page) + 1));

        ?>

        <div class="col-md-9">
          <div class="row">
            <div class="col-md-12 d-none d-md-block">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-start">
                  <li class="page-item">
                    <a class="page-link <?php echo $page == 1 ? 'disabled' : ''; ?>" href="/lms/home/jobs_list?page=<?php echo $page > 1 ? $page - 1 : $page; ?>" id="job_prev_btn">Previous</a>
                  </li>
                  <li class="page-item navigation-btn">
                    <a class="page-link navi-bord" href="javascript:void(0);" id="page_numbers"><?php echo $page; ?> out of <?php echo $total_pages; ?></a>
                  </li>
                  <li class="page-item navigation-btn">
                    <a class="page-link <?php echo $page == $total_pages ? 'disabled' : ''; ?>" href="/lms/home/jobs_list?page=<?php echo $page + 1; ?>" id="job_nxt_btn">Next</a>
                  </li>
                </ul>
              </nav>
            </div>

          </div>

          <?php //var_dump($filter_options); 
          ?>
          <!-- <a href="job-description.html"> -->
          <?php foreach ($jobs as $job) : ?>

            <div class="job-listings-section-card">
              <div class="row">
                <div class="col-md-2 logo-w-listing">
                  <svg class="job-logo-listing" viewBox="0 -13 512 512" xmlns="http://www.w3.org/2000/svg" style="background-color:#2e2882">
                    <g fill="#feb0a5">
                      <path d="M256 92.5l127.7 91.6L512 92 383.7 0 256 91.5 128.3 0 0 92l128.3 92zm0 0M256 275.9l-127.7-91.5L0 276.4l128.3 92L256 277l127.7 91.5 128.3-92-128.3-92zm0 0"></path>
                      <path d="M127.7 394.1l128.4 92 128.3-92-128.3-92zm0 0"></path>
                    </g>
                    <path d="M512 92L383.7 0 256 91.5v1l127.7 91.6zm0 0M512 276.4l-128.3-92L256 275.9v1l127.7 91.5zm0 0M256 486.1l128.4-92-128.3-92zm0 0" fill="#feb0a5"></path>
                  </svg>
                </div>
                <div class="col-md-8 mbl-conte">
                  <h1 class="job-card-title "><?php echo $job->title; ?></h1>
                  <img src="assets/frontend/default-new/image/" alt=""> <span class="text-secondary location-para"><?php echo $job->company_name; ?></span>
                  <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para"><?php echo $job->min_experience; ?>-<?php echo $job->max_experience; ?> years</span>
                  <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para"><?php echo $job->location; ?></span>
                  <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                  <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹<?php echo $job->min_pay_scale; ?>-<?php echo $job->max_pay_scale; ?></span>
                  <div class="job-detail-buttons mb-3 ellipsis-line-2">
                    <button class="search-buttons detail-button"><?php echo $job->work_mode; ?> </button>
                    <button class="search-buttons detail-button"><?php echo $job->employment_type; ?></button>
                    <button class="search-buttons detail-button"><?php echo implode(',', json_decode($job->required_skills)); ?></button>
                  </div>
                </div>
                <div class="col-md-2 d-flex justify-content-end">
                  <div class="job-action">
                    <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2">
                      <circle cx="18" cy="5" r="3"></circle>
                      <circle cx="6" cy="12" r="3"></circle>
                      <circle cx="18" cy="19" r="3"></circle>
                      <path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </div>

          <?php endforeach; ?>
          <!-- </a> -->


        </div>
      </div>
    </div>




  </div>
  <!-- /Main Wrapper -->

  <!-- jQuery -->
  <script src="assets/js/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap Core JS -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!-- counterup JS -->
  <script src="assets/js/jquery.waypoints.js"></script>
  <script src="assets/js/jquery.counterup.min.js"></script>

  <!-- Select2 JS -->
  <script src="assets/plugins/select2/js/select2.min.js"></script>

  <!-- Owl Carousel -->
  <script src="assets/js/owl.carousel.min.js"></script>

  <!-- Slick Slider -->
  <script src="assets/plugins/slick/slick.js"></script>

  <!-- Aos -->
  <script src="assets/plugins/aos/aos.js"></script>

  <!-- Custom JS -->
  <script src="assets/js/script.js"></script>

  <script>
    $(document).ready(function() {
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

          if (response && response.length > 0) {
            let jobs_slides = composeJobsSlide(response);
            document.getElementById("jobs_slides").innerHTML = jobs_slides;
          } else {
            document.getElementById("jobs_slides").innerHTML = '<p>No jobs found</p>';
          }

        }, function(status, statusText) {
          console.error('Error:', status, statusText);
        });
      }

      $('#filterButton').click(function() {
        var filters = collectFilters();
        loadJobs(filters);
      });


    });
  </script>

</body>

</html>