
<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="UTF-8"> 
	<meta name="viewport"
		content="width=device-width,initial-scale=1.0"> 
	<title>Responsive Form Card</title> 
	<link rel="stylesheet" href= 
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
	<link rel="stylesheet" href="index.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head> 
<style>
    body { 
  
    /* height: 100vh;  */
    /* background-color: #bde5d2;  */
    /* font-family: 'Poppins', sans-serif;  */
  
} 
  
.textup { 
    text-align: center; 
    color:#754ffe; 
    font-weight: 500; 
} 
  
i { 
    margin-right: 3px; 
} 
.form-var-tab {
    padding: 30px;
    max-width: none !important;
}
.form-box { 
    background-color: #fff; 
    /* box-shadow: 0 0 10px rgba(36, 67, 40, 0.8);  */
    padding: 15px; 
    border-radius: 8px; 
    width: 95%; 
    border: 1px solid #423d3d4d;
} 
  
.form-var-tab { 
    max-width: 400px; 
    margin: 31px auto;
} 
  
/* .radio-group { 
    display: flex; 
    margin-bottom: 16px; 
} 
  
input[type="radio"] { 
    margin-right: 8px; 
}  */
  
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
    box-sizing: border-box;
    border-radius: 6px;
    border: 1px solid #6666665e;
}

  
.sbt_btn { 
    background-color:#754ffe; 
    color: #fff; 
    padding: 10px; 
    border: none; 
    border-radius:8px; 
    cursor: pointer; 
    width: 25%; 
    font-size: 15px; 
    transition: .2s linear; 
    float:right;
} 
  
.sbt_btn:hover { 
    background-color: #0a6808; 
    border: none; 
    transform: translateY(-10px); 
    color:white;
} 
  
h1 { 
    color: #754ffe; 
}
.rating-para{
    color: #754ffe;
    font-weight: 500;
    font-size: 19px;
    /* width: 95%; */

}
.comment-stars {
  display: flex;
  flex-direction: row-reverse;
}

.comment-stars-input {
  display: none;
}

.comment-stars-input:checked ~ .comment-stars-view svg {
  fill:#f29300;
}

.comment-stars-input:checked ~ .comment-stars-view:hover svg,
.comment-stars-input:checked
  ~ .comment-stars-view:hover
  ~ .comment-stars-view
  svg {
  fill: #f29300;
}

.comment-stars-view {
  cursor: pointer;
}

.comment-stars-view svg {
  fill: #ededef;
  width: 1.39306640625em;
  height: 1.5em;
}

.comment-stars-view.is-half {
  transform: translateX(100%);
  margin-left: -0.69580078125em;
}

.comment-stars-view.is-half svg {
  width: 0.69580078125em;
}

.comment-stars-view:hover svg,
.comment-stars-view:hover ~ .comment-stars-view svg {
  fill:#f29300;
}
.content-rating{
    display: flex;
    align-items: center;
}
.comment-stars {
    display: flex;
    align-items: center; /* Align items vertically */
    margin-left: auto;
}

.comment-stars-icons {
    margin-left: auto; /* Push icons to the right */
}
@media (max-width: 768px) {
    .rating-para {
    font-size: 15px !important;
}
.comment-stars {
    margin-right: -12px;
    margin-top:8px;
}
    }
</style>
<body> 
    <div class="d-flex justify-content-center">
	<!-- <h1>Feedback Form</h1>  -->
	<div class="form-box"> 
		 
		<form class="form-var-tab"> 
            <div class="content-rating">
            <div class="col-md-10 mt-2 rating-para">
            <p >Please give ratings us a rating for our lms student portal or for any feedback please drop us a message:</p>
            </div>
            <div class="comment-stars">
            <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                        <symbol id="icon-star" viewBox="0 0 26 28">
                            <path d="M26 10.109c0 0.281-0.203 0.547-0.406 0.75l-5.672 5.531 1.344 7.812c0.016 0.109 0.016 0.203 0.016 0.313 0 0.406-0.187 0.781-0.641 0.781-0.219 0-0.438-0.078-0.625-0.187l-7.016-3.687-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641s0.625 0.344 0.766 0.641l3.516 7.109 7.844 1.141c0.375 0.063 0.875 0.25 0.875 0.719z"></path>
                        </symbol>
                        <symbol id="icon-star-half" viewBox="0 0 13 28">
                            <path d="M13 0.5v20.922l-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641v0z"></path>
                        </symbol>
                        </defs>
                        </svg>
                        <div class="comment-stars">

                        <input class="comment-stars-input" type="radio" name="rating" value="5" id="rating-5">
                        <label class="comment-stars-view" for="rating-5"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4.5" id="rating-4.5" checked="checked"> <label class="comment-stars-view is-half" for="rating-4.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4" id="rating-4"> <label class="comment-stars-view" for="rating-4"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3.5" id="rating-3.5"> <label class="comment-stars-view is-half" for="rating-3.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3" id="rating-3"> <label class="comment-stars-view" for="rating-3"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2.5" id="rating-2.5"> <label class="comment-stars-view is-half" for="rating-2.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2" id="rating-2"> <label class="comment-stars-view" for="rating-2"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1.5" id="rating-1.5"> <label class="comment-stars-view is-half" for="rating-1.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1" id="rating-1"> <label class="comment-stars-view" for="rating-1"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="0.5" id="rating-0.5"> <label class="comment-stars-view is-half" for="rating-0.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        </div>
                                </div>
            
            </div>


            <div class="content-rating">
            <div class="col-md-10 mt-2 rating-para">
            <p>Course Rating:</p>
            </div>
            <div class="comment-stars">
            <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                        <symbol id="icon-star" viewBox="0 0 26 28">
                            <path d="M26 10.109c0 0.281-0.203 0.547-0.406 0.75l-5.672 5.531 1.344 7.812c0.016 0.109 0.016 0.203 0.016 0.313 0 0.406-0.187 0.781-0.641 0.781-0.219 0-0.438-0.078-0.625-0.187l-7.016-3.687-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641s0.625 0.344 0.766 0.641l3.516 7.109 7.844 1.141c0.375 0.063 0.875 0.25 0.875 0.719z"></path>
                        </symbol>
                        <symbol id="icon-star-half" viewBox="0 0 13 28">
                            <path d="M13 0.5v20.922l-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641v0z"></path>
                        </symbol>
                        </defs>
                        </svg>
                        <div class="comment-stars">

                        <input class="comment-stars-input" type="radio" name="rating" value="5" id="rating-5">
                        <label class="comment-stars-view" for="rating-5"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4.5" id="rating-4.5" checked="checked"> <label class="comment-stars-view is-half" for="rating-4.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4" id="rating-4"> <label class="comment-stars-view" for="rating-4"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3.5" id="rating-3.5"> <label class="comment-stars-view is-half" for="rating-3.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3" id="rating-3"> <label class="comment-stars-view" for="rating-3"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2.5" id="rating-2.5"> <label class="comment-stars-view is-half" for="rating-2.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2" id="rating-2"> <label class="comment-stars-view" for="rating-2"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1.5" id="rating-1.5"> <label class="comment-stars-view is-half" for="rating-1.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1" id="rating-1"> <label class="comment-stars-view" for="rating-1"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="0.5" id="rating-0.5"> <label class="comment-stars-view is-half" for="rating-0.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        </div>
                                </div>
            
            </div>



            <div class="content-rating">
            <div class="col-md-10 mt-2 rating-para">
            <p>Video quality Rating:</p>
            </div>
            <div class="comment-stars">
            <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                        <symbol id="icon-star" viewBox="0 0 26 28">
                            <path d="M26 10.109c0 0.281-0.203 0.547-0.406 0.75l-5.672 5.531 1.344 7.812c0.016 0.109 0.016 0.203 0.016 0.313 0 0.406-0.187 0.781-0.641 0.781-0.219 0-0.438-0.078-0.625-0.187l-7.016-3.687-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641s0.625 0.344 0.766 0.641l3.516 7.109 7.844 1.141c0.375 0.063 0.875 0.25 0.875 0.719z"></path>
                        </symbol>
                        <symbol id="icon-star-half" viewBox="0 0 13 28">
                            <path d="M13 0.5v20.922l-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641v0z"></path>
                        </symbol>
                        </defs>
                        </svg>
                        <div class="comment-stars">

                        <input class="comment-stars-input" type="radio" name="rating" value="5" id="rating-5">
                        <label class="comment-stars-view" for="rating-5"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4.5" id="rating-4.5" checked="checked"> <label class="comment-stars-view is-half" for="rating-4.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4" id="rating-4"> <label class="comment-stars-view" for="rating-4"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3.5" id="rating-3.5"> <label class="comment-stars-view is-half" for="rating-3.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3" id="rating-3"> <label class="comment-stars-view" for="rating-3"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2.5" id="rating-2.5"> <label class="comment-stars-view is-half" for="rating-2.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2" id="rating-2"> <label class="comment-stars-view" for="rating-2"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1.5" id="rating-1.5"> <label class="comment-stars-view is-half" for="rating-1.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1" id="rating-1"> <label class="comment-stars-view" for="rating-1"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="0.5" id="rating-0.5"> <label class="comment-stars-view is-half" for="rating-0.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        </div>
                                </div>
            
            </div>
          



            <div class="content-rating">
            <div class="col-md-10 mt-2 rating-para">
            <p >Instructor Rating:</p>
            </div>
            <div class="comment-stars">
            <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                        <symbol id="icon-star" viewBox="0 0 26 28">
                            <path d="M26 10.109c0 0.281-0.203 0.547-0.406 0.75l-5.672 5.531 1.344 7.812c0.016 0.109 0.016 0.203 0.016 0.313 0 0.406-0.187 0.781-0.641 0.781-0.219 0-0.438-0.078-0.625-0.187l-7.016-3.687-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641s0.625 0.344 0.766 0.641l3.516 7.109 7.844 1.141c0.375 0.063 0.875 0.25 0.875 0.719z"></path>
                        </symbol>
                        <symbol id="icon-star-half" viewBox="0 0 13 28">
                            <path d="M13 0.5v20.922l-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641v0z"></path>
                        </symbol>
                        </defs>
                        </svg>
                        <div class="comment-stars">

                        <input class="comment-stars-input" type="radio" name="rating" value="5" id="rating-5">
                        <label class="comment-stars-view" for="rating-5"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4.5" id="rating-4.5" checked="checked"> <label class="comment-stars-view is-half" for="rating-4.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4" id="rating-4"> <label class="comment-stars-view" for="rating-4"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3.5" id="rating-3.5"> <label class="comment-stars-view is-half" for="rating-3.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3" id="rating-3"> <label class="comment-stars-view" for="rating-3"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2.5" id="rating-2.5"> <label class="comment-stars-view is-half" for="rating-2.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2" id="rating-2"> <label class="comment-stars-view" for="rating-2"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1.5" id="rating-1.5"> <label class="comment-stars-view is-half" for="rating-1.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1" id="rating-1"> <label class="comment-stars-view" for="rating-1"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="0.5" id="rating-0.5"> <label class="comment-stars-view is-half" for="rating-0.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        </div>
                                </div>
            
            </div>
               

            <div class="content-rating">
            <div class="col-md-10 mt-2 rating-para">
            <p >Assignment Rating:</p>
            </div>
            <div class="comment-stars">
            <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                        <symbol id="icon-star" viewBox="0 0 26 28">
                            <path d="M26 10.109c0 0.281-0.203 0.547-0.406 0.75l-5.672 5.531 1.344 7.812c0.016 0.109 0.016 0.203 0.016 0.313 0 0.406-0.187 0.781-0.641 0.781-0.219 0-0.438-0.078-0.625-0.187l-7.016-3.687-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641s0.625 0.344 0.766 0.641l3.516 7.109 7.844 1.141c0.375 0.063 0.875 0.25 0.875 0.719z"></path>
                        </symbol>
                        <symbol id="icon-star-half" viewBox="0 0 13 28">
                            <path d="M13 0.5v20.922l-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641v0z"></path>
                        </symbol>
                        </defs>
                        </svg>
                        <div class="comment-stars">

                        <input class="comment-stars-input" type="radio" name="rating" value="5" id="rating-5">
                        <label class="comment-stars-view" for="rating-5"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4.5" id="rating-4.5" checked="checked"> <label class="comment-stars-view is-half" for="rating-4.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="4" id="rating-4"> <label class="comment-stars-view" for="rating-4"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3.5" id="rating-3.5"> <label class="comment-stars-view is-half" for="rating-3.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="3" id="rating-3"> <label class="comment-stars-view" for="rating-3"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2.5" id="rating-2.5"> <label class="comment-stars-view is-half" for="rating-2.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="2" id="rating-2"> <label class="comment-stars-view" for="rating-2"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1.5" id="rating-1.5"> <label class="comment-stars-view is-half" for="rating-1.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="1" id="rating-1"> <label class="comment-stars-view" for="rating-1"><svg class="icon icon-star">
                            <use xlink:href="#icon-star"></use>
                        </svg></label>
                        <input class="comment-stars-input" type="radio" name="rating" value="0.5" id="rating-0.5"> <label class="comment-stars-view is-half" for="rating-0.5"><svg class="icon icon-star-half">
                            <use xlink:href="#icon-star-half"></use>
                        </svg></label>
                        </div>
                                </div>
            
            </div>
            

        
            <div class="mt-4">
            <label for="msg"> 
				<i class="fa-solid fa-comments text-dark"
				style="margin-right: 3px;"></i> 
			  <span class="text-dark">Write your review: </span>
			</label> 
			<textarea class="feed-bk" id="msg" name="msg"
					rows="4" cols="10" required> 
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

