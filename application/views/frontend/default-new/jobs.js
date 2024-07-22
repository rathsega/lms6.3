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

$(document).ready(function () {

    function ajax(url, method, data, successCallback, errorCallback) {
        // var apiUrl = "http://localhost/dreams_angular/rest/public/";
        var apiUrl = '/';
        var xhr = new XMLHttpRequest();
        xhr.open(method, apiUrl + url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
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
        ajax('jobs/getPaginatedJobs/' + paginationDetails.currentPageNumber + '/' + paginationDetails.records_per_page, 'GET', null, function (response) {

            let jobs_slides = composeJobsSlide(response);
            document.getElementById("jobs_slides").innerHTML = jobs_slides;
            // configureBlogsSlides();
        }, function (status, statusText) {
            console.error('Error:', status, statusText);
        });
    }

    function composeJobsSlide(jobs) {
        let jobs_slides = '';
        jobs.forEach(slide => {
            let skills = JSON.parse(slide.required_skills);
            let skills_html = "";
            skills.forEach(skill => {
                skills_html += `<span class="badge text-bg-dark">${skill}</span>`
            })
            jobs_slides += `<a href="job-details.php?id=${slide.id}">
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
                  <h1 class="job-card-title ">${slide.title} </h1>
                  <img src="assets/img/office-building.svg" alt=""> <span class="text-secondary location-para">${slide.company_name}</span>
                  <img src="assets/img/yaer_of-work.svg" alt=""> <span class="text-secondary location-para">${slide.min_experience == slide.max_experience ? slide.min_experience : slide.min_experience + " - " + slide.max_experience} Years</span>
                  <img src="assets/img/loaction_pin.svg" alt=""> <span class="text-secondary location-para">${slide.location}</span>
                  <!-- <img src="assets/img/clock_mnth.svg" alt=""> <span class="text-secondary location-para">${convertdateStringToDate(slide.created_at)}</span> -->
                  <img src="assets/img/wallet_job.svg" alt=""> <span class="text-secondary location-para">₹${numberWithCommas(slide.min_pay_scale)} - ₹${numberWithCommas(slide.max_pay_scale)}</span>
                  <div class="job-detail-buttons mb-3 ellipsis-line-2">
                    <button class="search-buttons detail-button">${slide.employment_type} </button>
                    <button class="search-buttons detail-button">${slide.work_mode}</button>
                    <button class="search-buttons detail-button">${(JSON.parse(slide.required_skills)).join(", ")}</button>
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
          </a>`;
        })
        return jobs_slides;
    }

    function getJobsCount() {
        ajax('jobs/getJobsCount', 'GET', null, function (response) {
            let jobs_count = response.count;
            paginationDetails.totalRecordsCount = jobs_count;
            displayPageNumbers()
            //composePaginationButtons();
        }, function (status, statusText) {
            console.error('Error:', status, statusText);
        });
    }




    function generateFilters(min, max, type, interval, id) {
        let filterOptions = '';
        for (let i = parseInt(min); i <= parseInt(max); i += interval) {
            let end = i + interval - 1;
            if (end > max) {
                end = max;
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
            <div class="job-time-title">${type.charAt(0).toUpperCase() + type.slice(1)} Range</div>
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

        generateFilters(data.experiences.min_experience, data.experiences.max_experience, 'experience', 2, 'experienceFilters');
        generateFilters(data.pay_scales.min_pay_scale, data.pay_scales.max_pay_scale, 'salary', 200000, 'payScaleFilters');

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

        $('.work-mode:checked').each(function () {
            filters.work_mode.push($(this).val());
        });

        $('.experience:checked').each(function () {
            filters.experience.push($(this).val());
        });

        $('.location:checked').each(function () {
            filters.location.push($(this).val());
        });

        $('.pay-scale:checked').each(function () {
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
        ajax('jobs/getJobsByUsingFilters', 'POST', data, function (response) {

            if (response && response.length > 0) {
                let jobs_slides = composeJobsSlide(response);
                document.getElementById("jobs_slides").innerHTML = jobs_slides;
            } else {
                document.getElementById("jobs_slides").innerHTML = '<p>No jobs found</p>';
            }

        }, function (status, statusText) {
            console.error('Error:', status, statusText);
        });
    }

    // Load filters and jobs on page load
    ajax('jobs/getFilterData', 'GET', null, function (response) {
        if (response) {
            populateFilters(response);
        }
    }, function (status, statusText) {
        console.error('Error:', status, statusText);
    });

    // Filter button click event
    $('#filterButton').click(function () {
        var filters = collectFilters();
        loadJobs(filters);
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
    prevLink.addEventListener('click', function (e) {
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
    nextLink.addEventListener('click', function (e) {
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
        $('#page_numbers').text(`${paginationDetails.currentPageNumber}  out of  ${paginationDetails.pageCount}`);
    }



    //location show more button
    const contentContainer = document.getElementById('locationFilters');
    const showMoreLocBtn = document.getElementById('showMoreLocBtn');

    let maxHeight = 13; // Initial max height

    showMoreLocBtn.addEventListener('click', function (e) {
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

    showMorePayScaleBtn.addEventListener('click', function (e) {
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
});