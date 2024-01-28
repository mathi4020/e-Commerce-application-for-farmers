<!DOCTYPE html>
<html>
<head>
    <title>Proceed to Buy</title>
    <style>
.navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background: grey;
  color: black;
  padding-top: 10px;
}
  
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="navbar">
  <a href="home.html" style="color: white;padding-bottom:10px; padding-top: 30px;" >Home</a>
 <h1 style="color: white;padding-right:65px;text-align: center">Proceed to Buy</h1>
</div>
    <?php
    include 'connect.php';

    session_start(); // Start the session

    if (isset($_GET['Id']) && isset($_GET['user_id'])) {
        $Id = $_GET['Id'];
        $user_id = $_GET['user_id'];

        // Establish a database connection
        $conn = mysqli_connect("localhost", "root", "", "project");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch data from the agromart table for the specified Id
        $sql = "SELECT * FROM agromart WHERE Id = $Id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $prefix = 'PROD';

            // Check if the product ID already exists in the session
            if (!isset($_SESSION['product_id'])) {
                $uniqueId = uniqid(); // Generates a unique identifier based on the current time in microseconds
                $Product_id = $prefix . '_' . $uniqueId;

                // Store the product ID in the session
                $_SESSION['product_id'] = $Product_id;
            } else {
                // Retrieve the product ID from the session
                $Product_id = $_SESSION['product_id'];
            }

            // Display the generated product ID
            echo "<h1>Marketer_page</h1>";
            echo "<p>Welcome, $user_id!</p>";
            echo "<h3>Product ID: $Product_id</h3>";

            // Insert the fetched data into the cart table
            $insertSql = "INSERT INTO cart (Id, Product_type, Product_name, Validity_from, Validity_to, Quantity, Farmer_expected_price, District, Place, Product_description, user_id, Product_id) 
                          VALUES ('".$row['Id']."', '".$row['Product_type']."', '".$row['Product_name']."', '".$row['Validity_from']."', '".$row['Validity_to']."', 
                          '".$row['Quantity']."', '".$row['Farmer_expected_price']."', '".$row['District']."', '".$row['Place']."', '".$row['Product_description']."', '$user_id', '$Product_id')";
            $insertResult = mysqli_query($conn, $insertSql);

            if ($insertResult) {
                // Display the table with the fetched data
                echo "<table>";
                echo "<tr>";
                echo "<th>Id</th>";
                echo "<th>Product_type</th>";
                echo "<th>Product_name</th>";
                echo "<th>Validity_from</th>";
                echo "<th>Validity_to</th>";
                echo "<th>Quantity</th>";
                echo "<th>Price</th>";
                echo "<th>District</th>";
                echo "<th>Place</th>";
                echo "<th>Product_description</th>";
                echo "<th>user_id</th>";
                echo "<th>Product_id</th>";
                echo "<th>Action</th>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>".$row['Id']."</td>";
                echo "<td>".$row['Product_type']."</td>";
                echo "<td>".$row['Product_name']."</td>";
                echo "<td>".$row['Validity_from']."</td>";
                echo "<td>".$row['Validity_to']."</td>";
                echo "<td>".$row['Quantity']."</td>";
                echo "<td>".$row['Farmer_expected_price']."</td>";
                echo "<td>".$row['District']."</td>";
                echo "<td>".$row['Place']."</td>";
                echo "<td>".$row['Product_description']."</td>";
                echo "<td>".$user_id."</td>";
                echo "<td>".$Product_id."</td>";
                echo "<td><button id='submitBtn' type='button'>Send Confirmation</button></td>";
                echo "</tr>";

                echo "</table>";

                // JavaScript code to submit the form using AJAX
                echo "<script>
                        document.getElementById('submitBtn').addEventListener('click', function() {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState === 4 && this.status === 200) {
                                    // Handle the response here if needed
                                    console.log(this.responseText);
                                    window.location.href = 'status_reply.php'; // Redirect to status_reply.php
                                }
                            };
                            xhttp.open('POST', 'order_status.php', true);
                            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xhttp.send('Id=$Id&Product_type=".urlencode($row['Product_type'])."&Product_name=".urlencode($row['Product_name'])."&Validity_from=".urlencode($row['Validity_from'])."&Validity_to=".urlencode($row['Validity_to'])."&Farmer_expected_price=".urlencode($row['Farmer_expected_price'])."&District=".urlencode($row['District'])."&Place=".urlencode($row['Place'])."&user_id=$user_id&Product_id=$Product_id&send_confirmation=true');
                        });
                    </script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "Id or user_id not provided.";
    }
    ?>
</body>
</html>
