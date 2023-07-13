<?php
  // session_start();
  include "connection.php";
?>

<?php
      //Declaring Variables
  $fullname = $email = $uid = $address = $phone = $case_worker = $password = $password2 = $second_client = "";
  $fullname_error = $email_error = $address_error = $phone_error = $case_worker_error = 
  $password_error = $second_client_error = "";
  $err_status = "off"; 

      //Defining Variables
  if(isset($_POST["submit"])){
    if(empty($_POST["fullname"])){
      $fullname_error = "Full name is required";
      $err_status="on";
    }else{
      $fullname = test_input($_POST["fullname"]);
      //check if name only contains letters and whitespaces
      if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
          $fullname_error = "Only letters and white spaces are allowed";
          $err_status="on";
      }
    }

    if(empty($_POST["email"])){
      $email_error = "Email is required";
      $err_status="on";
    }else{
      $email = test_input($_POST["email"]);
      //check if email is well formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_status="on";
        $email_error = "Invalid email format"; 
      }
      $email_query = "SELECT * FROM clients WHERE email = '$email' ";
      $email_query_result = mysqli_query($con, $email_query);
      $counter = mysqli_num_rows($email_query_result);
      if($counter>0){
        $email_error = "Email already exists!";
        $err_status="on";
      }
    }

    if(isset($_POST["submit"])){
        if(empty($_POST["address"])){
          $address_error = "Address is required";
          $err_status="on";
        }else{
          $address = test_input($_POST["address"]);
      }
    }


    if(isset($_POST["submit"])){
        if(empty($_POST["phone"])){
          $phone_error = "Phone Number is required";
          $err_status="on";
        }else{
          $phone = test_input($_POST["phone"]);
          if(!preg_match("/^[0-9]+$/",$phone)) {
              $phone_error = "Only numbers are allowed";
              $err_status="on";
          }
      }
    }

    if(isset($_POST["submit"])){
        if(empty($_POST["case_worker"])){
          $case_worker_error = "Case Worker's Name is required";
          $err_status="on";
        }else{
          $case_worker = test_input($_POST["case_worker"]);
          if (!preg_match("/^[a-zA-Z ]*$/",$case_worker)) {
              $case_worker_error = "Only letters and white spaces are allowed";
              $err_status="on";
          }
      }
    }

    if(isset($_POST["submit"])){
      $second_client = test_input($_POST["second_client"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$second_client)) {
          $second_client_error = "Only letters and white spaces are allowed";
          $err_status="on";
      }
    }

    if(empty($_POST["password"])){
      $password_error = "Password is required";
      $err_status="on";
    }else{
      $password2 = $_POST["password"];
      $password = $_POST["password"];
      if(!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password )){
        $err_status="on";
        $password_error = "Password should contain at least 1 number, 1 lower case, 1 upper case, 1 special character and must be at least 8 characters";
      }
    }
    $password = md5($password2);
        //For unique id generation
    // $last_id = mysqli_insert_id($con);
    // var_dump($last_id);
    $random_number = rand(0, 99999);
    $uid = "C".$random_number;

    // $last_id = mysqli_insert_id($con); //gets last id in db
    // if($last_id){
    //   $random_number = rand(0, 99999);
    //   $uid = "C".$random_number.$last_id;
    //   $id_query = "Update clients set client_id = '".$uid."' where id = '".$last_id."'";
    //   $output = mysqli_query($con, $id_query);
    //   var_dump($last_id);
    // }
  // var_dump($last_id);

    if($err_status == "off"){
      //removing sql injections
      $fullname = mysqli_real_escape_string($con, $fullname);
      $email = mysqli_real_escape_string($con, $email);
      $address = mysqli_real_escape_string($con, $address);
      $case_worker = mysqli_real_escape_string($con, $case_worker);
      $second_client = mysqli_real_escape_string($con, $second_client);

      $query = "INSERT INTO clients (full_name, email, client_id, address, phone_number, case_worker, password, second_client) VALUES ('$fullname', '$email', '$uid', '$address', '$phone', '$case_worker', '$password', '$second_client')";
      if(!mysqli_query($con, $query)){
        die('Error: ' . mysqli_error($con));
      }else{
        // $last_id = mysqli_insert_id($con); //gets last id in db
        // if($last_id){
        //   $random_number = rand(0, 99999);
        //   $uid = "C".$random_number.$last_id;
        //   $id_query = "UPDATE clients SET client_id = '".$uid."' WHERE id = '".$last_id."'";
        //   $output = mysqli_query($con, $id_query);
        // }
        echo "<script>alert('Registration Successful')</script>";
        // header("Location: tracker.php");
      }
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Legal Case Tracker</title>
</head>
<body>
    <div class="container">
      <div class="box form-box">
        <header>Register Client</header>
        <span class="error_msg"><?php //if($email_status!=""){echo $email_status;} ?></span>  

        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
  		    
          <div class="field input"> 
            <label class = "label" for="fullname">Full Name</label> 
            <span class="error_msg"><?php if($fullname_error!=""){echo $fullname_error;} ?></span>
            <input type="text" name="fullname" id="fullname" value="<?php echo $fullname; ?>">
          </div>

          <div class="field input">
            <label class = "label" for="email">Email</label> 
            <span class="error_msg"><?php if($email_error!=""){echo $email_error;} ?></span>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>"> 
          </div>

          <!-- <div class="field input">
            <label class = "label" for="client_id">Client ID</label>  -->
            <!-- <span class="error_msg"><?php //if($uid_error!=""){echo $uid_error;} ?></span> -->
            <!-- <input type="text" name="client_id" id="client_id" value="<?php //echo $uid; ?>" readonly>  -->
          <!-- </div> -->

          <div class="field input">
            <label class = "label" for="address">Address</label> 
            <span class="error_msg"><?php if($address_error!=""){echo $address_error;} ?></span>
            <input type="text" name="address" id="address" value="<?php echo $address; ?>"> 
          </div>

          <div class="field input">
            <label class = "label" for="phone">Phone Number</label> 
            <span class="error_msg"><?php if($phone_error!=""){echo $phone_error;} ?></span>
            <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>"> 
          </div>

          <div class="field input">
            <label class = "label" for="case_worker">Case Worker</label> 
            <span class="error_msg"><?php if($case_worker_error!=""){echo $case_worker_error;} ?></span>
            <input type="text" name="case_worker" id="case_worker" value="<?php echo $case_worker; ?>"> 
          </div>

    		  <div class="field input">
      			<label class = "label" for="pwd">Password</label> 
            <span class="error_msg"><?php if($password_error!=""){echo $password_error;} ?></span>        
        		<input type="password" class="form-control" name="password" id="password">
    		  </div>

          <div class="field input">
            <label class = "label" for="second_client">Add a Second Client</label> 
            <span class="error_msg"><?php if($second_client_error!=""){echo $second_client_error;} ?></span>
            <input type="text" name="second_client" id="second_client" value="<?php echo $second_client; ?>"> 
          </div>

    		  <div class="field">        
        		<button type="submit" name="submit" value="submit" class="btn">Register</button>
    		  </div>
  		  </form>
	    </div>
				
		</div>
  </body>
</html>