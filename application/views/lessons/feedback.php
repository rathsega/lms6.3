
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
    margin: -3px 0 21px; /* Shorthand for margin-top, margin-right, margin-bottom, margin-left */
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
    width: 15%; 
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

}
/* -ratings----------- */
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}

.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
.rating-container{
    display: flex;
    justify-content: flex-end;
}
/* -ratings-end----------- */
@media only screen and (max-width: 768px) {
    .rating-container {
    display: flex;
    justify-content:flex-start !important;
}
.rating-para{
    width:260px;
}

}
</style>
<body> 
    <div class="d-flex justify-content-center">
	<!-- <h1>Feedback Form</h1>  -->
	<div class="form-box"> 
		 
		<form class="form-var-tab"> 
        <div class="row">
  <div class="col-9 col-sm-6">
    <p class="mt-2 rating-para">Please give ratings of our online Classes Ratings training of techleads IT Lms :</p>
  </div>
  <div class="col rating-container">
    <div class="rate">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#deb217" class="bi bi-star-half mt-1" viewBox="0 0 16 16">
       <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
      </svg>
      <input type="radio" id="star4" name="rate" value="4" />
      <label for="star4" title="text">4 stars</label>
      <input type="radio" id="star3" name="rate" value="3" />
      <label for="star3" title="text">3 stars</label>
      <input type="radio" id="star2" name="rate" value="2" />
      <label for="star2" title="text">2 stars</label>
      <input type="radio" id="star2" name="rate" value="2" />
      <input type="radio" id="star1" name="rate" value="1" />
      <label for="star1" title="text">1 star</label>
    </div>
  </div>
</div>    
<div class="row">
  <div class="col-9">
    <p class="mt-2 rating-para">Course Ratings:</p>
  </div>
  <div class="col rating-container">
    <div class="rate">
      <input type="radio" id="star5" name="rate" value="5" />
      <label for="star5" title="text">5 stars</label>
      <input type="radio" id="star4" name="rate" value="4" />
      <label for="star4" title="text">4 stars</label>
      <input type="radio" id="star3" name="rate" value="3" />
      <label for="star3" title="text">3 stars</label>
      <input type="radio" id="star2" name="rate" value="2" />
      <label for="star2" title="text">2 stars</label>
      <input type="radio" id="star1" name="rate" value="1" />
      <label for="star1" title="text">1 star</label>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-9">
    <p class="mt-2 rating-para">Please rate of our online Classes Ratings training of techleads</p>
  </div>
  <div class="col rating-container">
    <div class="rate">
      <input type="radio" id="star5" name="rate" value="5" />
      <label for="star5" title="text">5 stars</label>
      <input type="radio" id="star4" name="rate" value="4" />
      <label for="star4" title="text">4 stars</label>
      <input type="radio" id="star3" name="rate" value="3" />
      <label for="star3" title="text">3 stars</label>
      <input type="radio" id="star2" name="rate" value="2" />
      <label for="star2" title="text">2 stars</label>
      <input type="radio" id="star1" name="rate" value="1" />
      <label for="star1" title="text">1 star</label>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-9">
    <p class="mt-2 rating-para">Projects Ratings:</p>
  </div>
  <div class="col rating-container">
    <div class="rate">
      <input type="radio" id="star5" name="rate" value="5" />
      <label for="star5" title="text">5 stars</label>
      <input type="radio" id="star4" name="rate" value="4" />
      <label for="star4" title="text">4 stars</label>
      <input type="radio" id="star3" name="rate" value="3" />
      <label for="star3" title="text">3 stars</label>
      <input type="radio" id="star2" name="rate" value="2" />
      <label for="star2" title="text">2 stars</label>
      <input type="radio" id="star1" name="rate" value="1" />
      <label for="star1" title="text">1 star</label>
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
