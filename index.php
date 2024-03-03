<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Website</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Pharmacy Website</h1>
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

        // Query the customer_requests table to retrieve the names of pharmacies that have accepted requests
        $sql = "SELECT * FROM medicine_table WHERE status1 = 'Accepted'";
        $result = $conn->query($sql);

        // Display the names of pharmacies that have accepted requests
        if ($result->num_rows) {
            echo "<h2>Pharmacies That Have Accepted Requests:</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row["pharm_name"] ."       " . $row["medicine_name"] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No pharmacies have accepted requests yet.</p>";
        }

        // Close connection
        $conn->close();
        ?>
        <div class="container">
        <h1>Welcome to the Pharmacy Website</h1>
        <form action="table2.php" method="POST">
            <input type="text" name="medicine_name" placeholder="Enter Medicine Name" required>
            <input type="text" name="pin_code" placeholder="Enter Pin Code" required pattern="[0-9]{6}">
            <button type="submit">Submit</button>
        </form>
    </div>
    </div>
</body>
</html>
