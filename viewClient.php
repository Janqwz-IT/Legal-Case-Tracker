<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Legal Case Tracker</title>
</head>
<body>
    <h1>Client Details</h1>
  <div class="container">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Client Id</th>
                <th scope="col">Address</th>
                <th scope="col">Phone Number</th>
                <th scope="col">caseworker</th>
                <th scope="col">Second Client</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once "db.php";
                //Creating connection
                $conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve data from the clients table
                $sql = "SELECT * FROM clients";
                $result = $conn->query($sql);

                // Check if any rows are returned
                if ($result->num_rows > 0) {
                    // Loop through the result set
                    while ($row = $result->fetch_assoc()) {
                        // Retrieve individual fields of each row
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $email = $row['email'];
                        $client_id = $row['client_id'];
                        $address = $row['address'];
                        $phone_number = $row['phone_number'];
                        $case_worker = $row['case_worker'];
                        $second_client = $row['second_client'];

                        // Generate table rows with retrieved data
                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td>$full_name</td>";
                        echo "<td>$email</td>";
                        echo "<td>$client_id</td>";
                        echo "<td>$address</td>";
                        echo "<td>$phone_number</td>";
                        echo "<td>$case_worker</td>";
                        echo "<td>$second_client</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found in the clients table.</td></tr>";
                }

                // Close the database connection
                $conn->close();
            ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>