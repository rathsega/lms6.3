<?php
/*$n=10;
$f=0;
$s=1;
echo "$f "."";
echo "$s "."";
$t=$f+$s;
echo "$t "."";
for($k=2;$k<=$n;$k++)
{
    $f=$s;
    $s=$t;
    $t=$f+$s;
    echo "$t "."";
}*/

/*$servername = "localhost";
$username = "root";
$password = "";
$database = 'lms';*/
$servername = "localhost";
$username = "techleadslms";
$password = "TechleadsLms@123";
$database = 'techleads_lms';

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    mysqli_select_db($conn, $database);
}



if(isset($_POST["submit_file"]))
{
 $file = $_FILES["file"]["tmp_name"];
 $file_open = fopen($file,"r");
 while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
 {
  $fname = $csv[0];
  $lname = "";
  $email = $csv[1];
  $pwd = "a169e3511ae1ae4a389e21f27b26619c46391221";
  $phone = "";
  $country = "India";
  $slinks = '{"facebook":"","twitter":"","linkedin":""}';
  $role = 2;
  $date_added = '1650695194';
  $date_mod = '1650695194';
  $wlist = '[]';
  $payment_keys = '{"paypal":{"production_client_id":null,"production_secret_key":null},"stripe":{"public_live_key":null,"secret_live_key":null},"razorpay":{"key_id":null,"secret_key":null}}';
  $status = 1;
  $is_inst = 0;

  $query = "INSERT INTO users (`first_name`,`last_name`,`email`,`password`,`country`,`phone`,`social_links`,`role_id`,`date_added`,`last_modified`,`wishlist`,`payment_keys`,`status`,`is_instructor`) 
select '$fname', '$lname', '$email', '$pwd', '$country', '$phone', '$slinks', '$role', '$date_added', '$date_mod', '$wlist','$payment_keys', '$status', '$is_inst' from dual
WHERE NOT EXISTS (
    SELECT email FROM users WHERE email = '$email'
) LIMIT 1";
  
  if ($conn->query($query) === TRUE) {
    echo "New record created successfully=========   " . $email . "<br>";
    $lst_id = $conn->insert_id;
    $enr_qry = "insert into enrol (`user_id`,`course_id`,`date_added`) values ($lst_id, 5,'1650672000'), ($lst_id, 9,'1650672000')";
	if ($conn->query($enr_qry) === TRUE) {
		echo "Enrolled Successfuly === " . 5 ."and". 9 . "<br>";
	}else{
		echo "Enrol failed";
	}
  } else {
    echo $query . "<br>";
  }
 }
}
?>



<html>
<body>
<div id="wrapper">
 <form method="post" action="insert_users.php" enctype="multipart/form-data">
  <input type="file" name="file"/>
  <input type="submit" name="submit_file" value="Submit"/>
 </form>
</div>
</body>
</html>