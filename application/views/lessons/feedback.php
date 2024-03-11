
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
  
.form-box { 
    background-color: #fff; 
    /* box-shadow: 0 0 10px rgba(36, 67, 40, 0.8);  */
    padding: 15px; 
    border-radius: 8px; 
    width: 500px; 
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
    width: 100%; 
    font-size: 15px; 
    transition: .2s linear; 
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
</style>
<body> 
    <div class="d-flex justify-content-center">
	<!-- <h1>Feedback Form</h1>  -->
	<div class="form-box"> 
		 
		<form class="form-var-tab"> 
		<div class="mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffc107" class="bi bi-star-fill" viewBox="0 0 16 16">
		<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffc107" class="bi bi-star-fill" viewBox="0 0 16 16">
		<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffc107" class="bi bi-star-fill" viewBox="0 0 16 16">
		<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffc107" class="bi bi-star-half" viewBox="0 0 16 16">
		<path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffc107" class="bi bi-star" viewBox="0 0 16 16">
		<path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
		</svg>
        </div>	 
        

			<label for="msg"> 
				<i class="fa-solid fa-comments"
				style="margin-right: 3px;"></i> 
				Write your review: 
			</label> 
			<textarea class="feed-bk" id="msg" name="msg"
					rows="4" cols="10" required> 
			</textarea> 
			<button class="sbt_btn" type="submit"> 
				Submit 
			</button> 
		</form> 
	</div> 
    </div>
</body> 

</html>
