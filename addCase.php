<?php
// Retrieve the list of clients from the database
function getClients() {
    require_once "db.php";
    //Creating connection
    $conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);


  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement
  $stmt = $conn->prepare("SELECT * FROM clients");

  // Execute the statement
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  // Fetch the clients as an associative array
  $clients = $result->fetch_all(MYSQLI_ASSOC);

  // Close the statement and connection
  $stmt->close();
  $conn->close();

  return $clients;
}

// Example usage:

// Retrieve clients
$clients = getClients();
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
        <header>Add Case</header>
            <form action="insertCase.php" method="post">
                <div class="field input">
                    <label class = "label" for="caseName">Case Name:</label>
                    <select id="caseName" name="caseName" required>
                        <option value="I-130 Standalone">I-130 Standalone</option>
                        <option value="I-130 + CONSULAR">I-130 + CONSULAR</option>
                        <option value="I-130 + Change of Status">I-130 + Change of Status</option>
                    </select>
                </div>
                <div class="field input">
                    <label class = "label" for="clientId">Client:</label>
                    <select id="clientId" name="clientId" required>
                        <?php foreach ($clients as $client) { ?>
                        <?php $val = $client["client_id"]; ?>
                        <option value="<?php echo $val ?>"><?php echo $client["full_name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="field input">
                    <label class="label" for="Description">Description</label> 
                    <input type="text" name="Description" id="Description" > 
                </div>
                <div class="field input">
                    <label class="label" for="Schedules">Schedules</label> 
                    <input type="text" name="Schedules" id="Schedules" > 
                </div>
                <div class="field input">
                    <label class="label" for="Date_sent">Date sent</label> 
                    <input type="text" name="Date_sent" id="Date_sent" > 
                </div>
                <div class="field input">
                    <label class="label" for="Date_received">Date sent</label> 
                    <input type="text" name="Date_received" id="Date_received" > 
                </div>
                <div class="field input">
                    <label class="label" for="Notes">Notes</label> 
                    <input type="text" name="Notes" id="Notes" > 
                </div>
                <div class="field">
                    <button type="submit" name="submit" value="submit" class="btn">Add Case</button>
                </div>
            </form>
      </div>
    </div>  

</body>
</html>
