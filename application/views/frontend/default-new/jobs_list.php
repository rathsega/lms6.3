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
    border: 1px solid #ffffff; /* Light border for selectors */
  }
  
  
  .wider-select {
    width: 200px; /* Adjust width as needed */
    color: #685f78e0;
  }
  .wider-select-2{
     width: 380px; 
     color: #685f78e0;
  }
  .j-s-btn{
    border-radius: 23px;
  }
  .home-slide-3 {
    position: relative;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    margin-top:5vh;
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
.job-time-title{
    color: #2f2f33;
    font-size: 15px;
    font-weight: 500;
}
.job-style:checked + label:before {
    background-color: #0162ff;
    border-color: #0162ff;
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='26' height='26' fill='white' class='bi bi-check-lg' viewBox='0 0 16 16'%3E%3Cpath d='M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z'/%3E%3C/svg%3E"); /* Inline SVG code */
    background-position: 50%;
    background-size: 14px;
    background-repeat: no-repeat;
}
.job-style + label:before {
    content: "";
    margin-right: 10px;
    width: 16px;
    height: 16px;
    border: 1px solid #83838e;
    border-radius: 4px;
    cursor: pointer;
}
.job-style:checked + label + span {
    background-color: #e1ebfb;
    color:#0162ff;
}
.job-number {
    margin-left: auto;
    background-color:#f0f0f0;
    color: #484849;
    font-size: 10px;
    font-weight: 500;
    padding: 5px;
    border-radius: 4px;
}
input:checked ~ label, label:hover, label:hover ~ label {
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
.job-time-card{
    /* box-shadow: rgb(17 17 26 / 7%) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px; */
    box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;
    padding: 18px;
    border-radius: 6px;
}
.view-m-links{
    color: #0162ff;
    font-size: 12px;
    font-weight: 500;
}
.dropdown-item {
    color: #000000;
}
.dropdown-item.active, .dropdown-item:active {
    background-color: #000000;
}
.dropdown-item.active, .dropdown-item:active {
    color: #ffffff;
}
.dropdown-toggle {
    margin-left: auto;
    white-space: nowrap;
    background: #e9ecef !important;
    color: black !important;
    border: none !important;
}
.dropdown-item:focus, .dropdown-item:hover {
  color:#000;
  font-weight: 500;
}
.dropdown-item.active, .dropdown-item:active {
    color: #ffffff;
}
.job-listings-section-card{
  box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
    padding: 18px;
    border-radius: 6px;
    margin-top: 30px;
    padding-top: 30px;
}
.job-logo-listing{
  height: 55px;
    padding: 10px;
    border-radius: 8px;
}
.logo-w-listing{
  width: 9.66666%;
}
.badge-size{
  font-size:8px !important;
  font-weight: 400;
}
.job-action {
    svg {
        width: 32px;
        border: 1px solid #d8d8d8;
        color:#83838e;
        border-radius: 8px;
        padding: 6px;
    }
}
.page-item:last-child:not(.active) .page-link, .page-item:first-child:not(.active) .page-link {
    border-radius: 5px;
    border: none;
    background-color: #e0d7ff;
    color: #754ffe;
    /* border: 1px solid var(--bg-white); */
}
@media (max-width:768px){
  .wider-select-2 {
    width: 345px;
    margin-bottom:18px;
}
.wider-select {
    width: 346px;
   margin-bottom:18px;
}
.j-s-btn {
    border-radius: 23px;
    width: 103px;
}
.home-slide-3 {
  margin-top: 12vh;
}
.filter-btn{
  margin-left: auto !important;
}
}
    </style>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			
			
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
                          <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
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
                <div class="col-md-3 d-none d-md-block">
                    <div class="job-time job-time-card mb-4">
                        <div class="job-time-title">Job title</div>
                        <div class="job-wrapper">
                         <div class="type-container">
                          <input type="checkbox" id="w-job1" class="job-style" checked="">
                          <label for="w-job1">Front-end Developer</label>
                          <span class="job-number">56</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-job2" class="job-style">
                          <label for="w-job2">UI-UX Designer</label>
                          <span class="job-number">43</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-job3" class="job-style">
                          <label for="w-job3">UI - Developer</label>
                          <span class="job-number">24</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-job4" class="job-style">
                          <label for="w-job4">Back-end Developer</label>
                          <span class="job-number">27</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-job5" class="job-style">
                          <label for="w-job5">Graphic-Designer</label>
                          <span class="job-number">76</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-job6" class="job-style">
                          <label for="w-job6">SEO</label>
                          <span class="job-number">28</span>
                         </div>
                         <a href="" class="view-m-links"> View More</a>
                        </div>
                    </div>

                    <div class="job-time job-time-card mb-3">
                        <div class="job-time-title">Work mode</div>
                        <div class="job-wrapper">
                         <div class="type-container">
                          <input type="checkbox" id="w-wm1" class="job-style" checked="">
                          <label for="w-wm1">Work from office</label>
                          <span class="job-number">56</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-wm2" class="job-style">
                          <label for="w-wm2">Remote</label>
                          <span class="job-number">43</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-wm3" class="job-style">
                          <label for="w-wm3">Work from home</label>
                          <span class="job-number">24</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-wm4" class="job-style">
                          <label for="w-wm4">WFH - WFO</label>
                          <span class="job-number">27</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-wm5" class="job-style">
                          <label for="w-wm5">Temp - WFH</label>
                          <span class="job-number">76</span>
                         </div>
                         <div class="type-container">
                                        <input type="checkbox" id="wm7" class="job-style">
                                        <label for="wm7">Freelancing</label>
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
                          <input type="checkbox" id="w-loc1" class="job-style" checked="">
                          <label for="w-loc1">Hyderabad</label>
                          <span class="job-number">56</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-loc2" class="job-style">
                          <label for="w-loc2">Delhi</label>
                          <span class="job-number">43</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-loc3" class="job-style">
                          <label for="w-loc3">Bangaluru</label>
                          <span class="job-number">24</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-loc4" class="job-style">
                          <label for="w-loc4">Mumbai</label>
                          <span class="job-number">27</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-loc5" class="job-style">
                          <label for="w-loc5">Kolkata</label>
                          <span class="job-number">76</span>
                         </div>
                        </div>
                        <a href="" class="view-m-links"> View More</a>
                    </div>


                    <div class="job-time job-time-card mb-3">
                        <div class="job-time-title">Salary range</div>
                        <div class="job-wrapper">
                         <div class="type-container">
                          <input type="checkbox" id="w-sal1" class="job-style" checked="">
                          <label for="w-sal1">0-3 Lakhs</label>
                          <span class="job-number">56</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-sal2" class="job-style">
                          <label for="w-sal2">3-6 Lakhs</label>
                          <span class="job-number">43</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-sal3" class="job-style">
                          <label for="w-sal3">6-10 Lakhs</label>
                          <span class="job-number">24</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-sal4" class="job-style">
                          <label for="w-sal4">10-13 Lakhs</label>
                          <span class="job-number">27</span>
                         </div>
                         <div class="type-container">
                          <input type="checkbox" id="w-sal5" class="job-style">
                          <label for="w-sal5">13-15 Lakhs</label>
                          <span class="job-number">76</span>
                         </div>
                        </div>
                        <a href="" class="view-m-links"> View More</a>
                    </div>

                </div>
                
                <div class="col-md-9">
                <div class="row">
                                <div class="col-md-12 d-none d-md-block">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                    <li class="page-item">
                                        <a class="page-link disabled" href="javascript:void(0);" id="job_prev_btn">Previous</a>
                                    </li>
                                    <li class="page-item navigation-btn">
                                        <a class="page-link navi-bord" href="javascript:void(0);" id="page_numbers">1  out of  7</a>
                                    </li>
                                    <li class="page-item navigation-btn">
                                        <a class="page-link" href="javascript:void(0);" id="job_nxt_btn">Next</a>
                                    </li>
                                    </ul>
                                </nav>
                                </div>
                                
                            </div>
                    
                    <!-- <a href="job-description.html"> -->
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
                            <h1 class="job-card-title ">UI UX Developer  <span class="badge text-bg-success badge-size">Featured</span></h1>
                            <img src="assets/frontend/default-new/image/" alt=""> <span class="text-secondary location-para">Drop Box Pvt.Ltd</span>
                             <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">3-4 years</span> 
                            <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">Hyderabad</span> 
                             <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                            <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹15,000-25,000</span>
                            <div class="job-detail-buttons mb-3 ellipsis-line-2">
                          <button class="search-buttons detail-button">Contractual Full Time </button>
                          <button class="search-buttons detail-button">Freelance</button>
                          <button class="search-buttons detail-button">Adobe XD, Photoshaop, Sketch, Figma</button>	
                        </div>
                         </div>
                          <div class="col-md-2 d-flex justify-content-end">
                            <div class="job-action">
                              <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path></svg>
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path></svg>
                             </div>
                          </div>
                        </div>
                    </div>
                    <!-- </a> -->
                  
                    

                    <div class="job-listings-section-card">
                      <div class="row">
                        <div class="col-md-2 logo-w-listing">
                          <svg class="job-logo-listing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="background-color:#f76754">
                            <path xmlns="http://www.w3.org/2000/svg" d="M0 .5h4.2v23H0z" fill="#042b48" data-original="#212121"></path>
                            <path xmlns="http://www.w3.org/2000/svg" d="M15.4.5a8.6 8.6 0 100 17.2 8.6 8.6 0 000-17.2z" fill="#fefefe" data-original="#f4511e"></path></svg>
                        </div>
                        <div class="col-md-8 mbl-conte">
                          <h1 class="job-card-title ">UI UX Designer  <span class="badge text-bg-danger badge-size">Filled</span></h1>
                          <img src="assets/img/office-building.svg" alt=""> <span class="text-secondary location-para">Drop Box Pvt.Ltd</span>
                           <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">3-4 years</span> 
                          <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">Hyderabad</span> 
                           <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                          <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹15,000-25,000</span>
                          <div class="job-detail-buttons mb-3 ellipsis-line-2">
                        <button class="search-buttons detail-button">Contractual Full Time </button>
                        <button class="search-buttons detail-button">Freelance</button>
                        <button class="search-buttons detail-button">Adobe XD, Photoshaop, Sketch, Figma</button>	
                      </div>
                       </div>
                        <div class="col-md-2 d-flex justify-content-end">
                          <div class="job-action">
                            <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path></svg>
                           </div>
                        </div>
                      </div>
                  </div>
                  <div class="job-listings-section-card">
                    <div class="row">
                      <div class="col-md-2 logo-w-listing">
                        <svg class="job-logo-listing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff" style="background-color:#55acee">
                          <path d="M512 97.2c-19 8.4-39.3 14-60.5 16.6 21.8-13 38.4-33.4 46.2-58a209.8 209.8 0 01-66.6 25.4A105 105 0 00249.5 153c0 8.3.8 16.3 2.5 24A297.1 297.1 0 0135.6 67 105.1 105.1 0 0068 207.4c-16.9-.3-33.4-5.2-47.4-12.9v1.1c0 51 36.4 93.4 84 103.2-8.5 2.3-17.8 3.4-27.4 3.4-6.8 0-13.5-.3-20-1.8a106 106 0 0098.2 73.2A211 211 0 010 416.9 295.5 295.5 0 00161 464c193.2 0 298.8-160 298.8-298.7 0-4.6-.2-9.1-.4-13.6A209.4 209.4 0 00512 97.2z"></path></svg>
                      </div>
                      <div class="col-md-8 mbl-conte">
                        <h1 class="job-card-title ">Front - end Developer  <span class="badge text-bg-success badge-size">Featured</span></h1>
                        <img src="assets/img/office-building.svg" alt=""> <span class="text-secondary location-para">Drop Box Pvt.Ltd</span>
                         <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">3-4 years</span> 
                        <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">Hyderabad</span> 
                         <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                        <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹15,000-25,000</span>
                        <div class="job-detail-buttons mb-3 ellipsis-line-2">
                      <button class="search-buttons detail-button">Contractual Full Time </button>
                      <button class="search-buttons detail-button">Freelance</button>
                      <button class="search-buttons detail-button">Adobe XD, Photoshaop, Sketch, Figma</button>	
                    </div>
                     </div>
                      <div class="col-md-2 d-flex justify-content-end">
                        <div class="job-action">
                          <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path></svg>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path></svg>
                         </div>
                      </div>
                    </div>
                </div>
                <div class="job-listings-section-card">
                  <div class="row">
                    <div class="col-md-2 logo-w-listing">
                      <svg class="job-logo-listing" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="background-color: #fe5b5f">
                        <path d="M12 20.6c-1.4 1.5-3.1 3-5.1 3.3-2 .8-5.9-1.3-5.9-5 0-2.5 3.2-8 6.6-15.1C8.5 1.9 9.4 0 12 0c2.6 0 3.5 1.8 4.6 4C23 17 23 17.7 23 19c0 4.4-5.5 8-11 1.7zm9.5-1.7c0-2-6.4-14.4-6.5-14.5-.9-1.9-1.4-2.9-3-2.9-1.8 0-2.3 1.5-3.2 3.2C2.5 17.2 2.5 18 2.5 19c0 3 3.7 6 8.5.6-2-2.6-3-4.8-3-6.6 0-2.7 2-4.2 4-4.2s4 1.5 4 4.2c0 1.8-1 4-3 6.6 4.6 5.2 8.5 2.5 8.5-.6zM12 10.2c-1.2 0-2.5.9-2.5 2.7 0 1.4.9 3.3 2.5 5.4 1.6-2.1 2.5-4 2.5-5.4 0-1.8-1.3-2.7-2.5-2.7z" fill="#fff"></path></svg>
                    </div>
                    <div class="col-md-8 mbl-conte">
                      <h1 class="job-card-title ">Graphic Designer  <span class="badge text-bg-success badge-size">Featured</span></h1>
                      <img src="assets/img/office-building.svg" alt=""> <span class="text-secondary location-para">Drop Box Pvt.Ltd</span>
                       <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">3-4 years</span> 
                      <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">Hyderabad</span> 
                       <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                      <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹15,000-25,000</span>
                      <div class="job-detail-buttons mb-3 ellipsis-line-2">
                    <button class="search-buttons detail-button">Contractual Full Time </button>
                    <button class="search-buttons detail-button">Freelance</button>
                    <button class="search-buttons detail-button">Adobe XD, Photoshaop, Sketch, Figma</button>	
                  </div>
                   </div>
                    <div class="col-md-2 d-flex justify-content-end">
                      <div class="job-action">
                        <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path></svg>
                       </div>
                    </div>
                  </div>
              </div>
              <div class="job-listings-section-card">
                <div class="row">
                  <div class="col-md-2 logo-w-listing">
                    <svg  class="job-logo-listing" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#fff" style="background-color:#ea4c88">
                      <path d="M16.4 23.2C28.6 18.2 25.2 0 12 0a12 12 0 104.4 23.2zM5.3 20c.8-1.5 3.6-5.5 8.3-7 1 2.6 1.7 5.5 1.7 8.8-3.5 1.2-7.3.4-10-1.8zm11.5 1.2a27 27 0 00-1.7-8.4c2-.4 4.5-.2 7.2 1-.6 3.2-2.6 6-5.5 7.4zm5.7-9c-3-1.1-5.7-1.3-8-.8a28 28 0 00-1.1-2.3 20 20 0 006.5-4c1.7 1.9 2.7 4.3 2.6 7zM18.9 4c-.9.8-2.9 2.4-6.3 3.8A28 28 0 008 2.3C11.6.8 15.8 1.4 19 4zM6.6 3c.8.7 2.7 2.5 4.5 5.3a33 33 0 01-9.4 1.5c.6-3 2.4-5.4 4.9-6.9zm-5 8.3c4.2-.1 7.6-.8 10.3-1.7l1.1 2.1A17.4 17.4 0 004.2 19c-1.8-2-2.8-4.7-2.7-7.6z"></path></svg>
                  </div>
                  <div class="col-md-8 mbl-conte">
                    <h1 class="job-card-title "> Content Writer  <span class="badge text-bg-success badge-size">Featured</span></h1>
                    <img src="assets/img/office-building.svg" alt=""> <span class="text-secondary location-para">Drop Box Pvt.Ltd</span>
                     <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">3-4 years</span> 
                    <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">Hyderabad</span> 
                     <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                    <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹15,000-25,000</span>
                    <div class="job-detail-buttons mb-3 ellipsis-line-2">
                  <button class="search-buttons detail-button">Contractual Full Time </button>
                  <button class="search-buttons detail-button">Freelance</button>
                  <button class="search-buttons detail-button">Adobe XD, Photoshaop, Sketch, Figma</button>	
                </div>
                 </div>
                  <div class="col-md-2 d-flex justify-content-end">
                    <div class="job-action">
                      <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path></svg>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path></svg>
                     </div>
                  </div>
                </div>
            </div>
            <div class="job-listings-section-card">
              <div class="row">
                <div class="col-md-2 logo-w-listing">
                  <svg  class="job-logo-listing" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#fff" style="background-color:#1e1f26">
                    <path d="M24 7.6c0-.3 0-.5-.4-.6C12.2.2 12.4-.3 11.6 0 3 5.5.6 6.7.2 7.1c-.3.3-.2.8-.2 8.3 0 .9 7.7 5.5 11.5 8.4.4.3.8.2 1 0 11.2-8 11.5-7.6 11.5-8.4V7.6zm-1.5 6.5l-3.9-2.4L22.5 9zm-5.3-3.2l-4.5-2.7V2L22 7.6zM12 14.5l-3.9-2.7L12 9.5l3.9 2.3zm-.8-12.4v6L6.8 11 2.1 7.6zm-5.8 9.6l-3.9 2.4V9zm1.3 1l4.5 3.1v6l-9-6.3zm6 9.1v-6l4.6-3.1 4.6 2.8z"></path></svg>
                </div>
                <div class="col-md-8 mbl-conte">
                  <h1 class="job-card-title ">Full stack / Web developer  <span class="badge text-bg-danger badge-size">Filled</span></h1>
                  <img src="assets/img/office-building.svg" alt=""> <span class="text-secondary location-para">Drop Box Pvt.Ltd</span>
                   <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">3-4 years</span> 
                  <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">Hyderabad</span> 
                   <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                  <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹15,000-25,000</span>
                  <div class="job-detail-buttons mb-3 ellipsis-line-2">
                <button class="search-buttons detail-button">Contractual Full Time </button>
                <button class="search-buttons detail-button">Freelance</button>
                <button class="search-buttons detail-button">Adobe XD, Photoshaop, Sketch, Figma</button>	
              </div>
               </div>
                <div class="col-md-2 d-flex justify-content-end">
                  <div class="job-action">
                    <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path></svg>
                   </div>
                </div>
              </div>
          </div>

          <div class="job-listings-section-card">
            <div class="row">
              <div class="col-md-2 logo-w-listing">
                <svg  class="job-logo-listing" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#fff" style="background-color:#ea4c88">
                  <path d="M16.4 23.2C28.6 18.2 25.2 0 12 0a12 12 0 104.4 23.2zM5.3 20c.8-1.5 3.6-5.5 8.3-7 1 2.6 1.7 5.5 1.7 8.8-3.5 1.2-7.3.4-10-1.8zm11.5 1.2a27 27 0 00-1.7-8.4c2-.4 4.5-.2 7.2 1-.6 3.2-2.6 6-5.5 7.4zm5.7-9c-3-1.1-5.7-1.3-8-.8a28 28 0 00-1.1-2.3 20 20 0 006.5-4c1.7 1.9 2.7 4.3 2.6 7zM18.9 4c-.9.8-2.9 2.4-6.3 3.8A28 28 0 008 2.3C11.6.8 15.8 1.4 19 4zM6.6 3c.8.7 2.7 2.5 4.5 5.3a33 33 0 01-9.4 1.5c.6-3 2.4-5.4 4.9-6.9zm-5 8.3c4.2-.1 7.6-.8 10.3-1.7l1.1 2.1A17.4 17.4 0 004.2 19c-1.8-2-2.8-4.7-2.7-7.6z"></path></svg>
              </div>
              <div class="col-md-8 mbl-conte">
                <h1 class="job-card-title "> Content Writer  <span class="badge text-bg-success badge-size">Featured</span></h1>
                <img src="assets/img/office-building.svg" alt=""> <span class="text-secondary location-para">Drop Box Pvt.Ltd</span>
                 <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">3-4 years</span> 
                <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">Hyderabad</span> 
                 <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">June 16, 2021</span> -->
                <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹15,000-25,000</span>
                <div class="job-detail-buttons mb-3 ellipsis-line-2">
              <button class="search-buttons detail-button">Contractual Full Time </button>
              <button class="search-buttons detail-button">Freelance</button>
              <button class="search-buttons detail-button">Adobe XD, Photoshaop, Sketch, Figma</button>	
            </div>
             </div>
              <div class="col-md-2 d-flex justify-content-end">
                <div class="job-action">
                  <svg class="heart-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z"></path></svg>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"></path></svg>
                 </div>
              </div>
            </div>
        </div>

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
		
	</body>
</html>