<?php
// Insert the form data into the Cases table
function insertCase($caseName, $clientId, $Description, $Schedules, $Date_sent, $Date_received, $Notes) {
    require_once "db.php";
    //Creating connection
    $conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO Cases (case_name, client_id, Description, Schedules, Date_sent, Date_received, Notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $caseName, $clientId, $Description, $Schedules, $Date_sent, $Date_received, $Notes);

  // Execute the statement
  $stmt->execute();

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $caseName = $_POST['caseName'];
  $clientId = $_POST['clientId'];
  $Description = $_POST['Description'];
  $Schedules = $_POST['Schedules'];
  $Date_sent = $_POST['Date_sent'];
  $Date_received = $_POST['Date_received'];
  $Notes = $_POST['Notes'];

  // Call the insertCase function to insert the data into the Cases table
  insertCase($caseName, $clientId, $Description, $Schedules, $Date_sent, $Date_received, $Notes);

  // Redirect to a success page or perform any other necessary actions
  // Display JavaScript alert message
    echo '<script>alert("Case Added successfully!");</script>';

    // Redirect the user to another page after a delay
    echo '<script>
        setTimeout(function() {
            window.location.href = "addCase.php";
        }, 3000); // 3000 milliseconds (3 seconds) delay before redirecting
    </script>';
  exit;
}

