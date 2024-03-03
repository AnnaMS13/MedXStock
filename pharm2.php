<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pharmacist Home</title>
</head>
<body>
  <h1>Welcome, Pharmacist!</h1>
  <h2>Medicine Names:</h2>

  <?php
  // Establish connection to MySQL database
  $servername = "localhost";
  $username = "root"; // Change this to your MySQL username
  $password = ""; // Change this to your MySQL password
  $dbname = "shop"; // Change this to your MySQL database name

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {
      // Process accepted request
      $request_id = $_POST['request_id'];
      // Perform database update for accepted request
      $sql_update = "UPDATE medicine_table 
               SET pharm_name = 'Sunrise Medicals', 
                   status1 = 'Accepted' 
               WHERE id = $request_id";

      if ($conn->query($sql_update) === TRUE) {
        echo "Request accepted successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
    } elseif (isset($_POST['reject'])) {
      // Process rejected request
      $request_id = $_POST['request_id'];
      // Perform database update for rejected request
      $sql_update = "UPDATE customer_requests SET status1 = 'Rejected' WHERE request_id = $request_id";
      if ($conn->query($sql_update) === TRUE) {
        echo "Request rejected successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
    }
  }

  // Retrieve medicine names from database
  $sql = "SELECT * FROM medicine_table WHERE status1 = 'Pending'";
  $result = $conn->query($sql);

    // Output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<p>Medicine Name: " . $row["medicine_name"] . " requested by " . $row["status1"] . "</p>";
      echo "<form method='post'>";
      echo "<input type='hidden' name='request_id' value='" . $row['id'] . "'>";
      echo "<button type='submit' name='accept'>Accept</button>";
      echo "<button type='submit' name='reject'>Reject</button>";
      echo "</form>";
    }
    

  // Close connection
  $conn->close();
  ?>

</body>
</html>
