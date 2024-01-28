<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
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
  background: #ddd;
  color: black;
}
  
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        button[type="submit"],
        select {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td:first-child {
            font-weight: bold;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="navbar">
  <a href="home.html" style="color: white;padding-bottom:10px; padding-top: 30px;font-family: times new roman" >Home</a>
 <h1 style="color: white;padding-right:65px;text-align: center;font-family: times new roman;">CHECK ORDER STATUS</h1>
</div>
    
    <?php
    include 'connect.php';

    session_start(); // Start the session

    if (isset($_POST['send_confirmation'])) {
        
        $Id = $_POST['Id'];
        $Product_type = $_POST['Product_type'];
        $Product_name = $_POST['Product_name'];
        $Validity_from = $_POST['Validity_from'];
        $Validity_to = $_POST['Validity_to'];
        $Farmer_expected_price = $_POST['Farmer_expected_price'];
        $District = $_POST['District'];
        $Place = $_POST['Place'];
        $Product_id = $_POST['Product_id'];
        $user_id = $_POST['user_id'];
        $Product_id = $_POST['Product_id'];

        // Establish a database connection
        $conn = mysqli_connect("localhost", "root", "", "project");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Insert the data into the farmer_order table
        $insertSql = "INSERT INTO farmer_order(Id, Product_type, Product_name, Validity_from, Validity_to, Farmer_expected_price, District, Place,Product_id,user_id, confirmation_status) 
                      VALUES ('$Id', '$Product_type', '$Product_name', '$Validity_from', '$Validity_to', '$Farmer_expected_price', '$District', '$Place', '$Product_id','$user_id', '')";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            echo "<h1>Confirmation Sent</h1>";
            echo "<p>Confirmation has been sent for the product with ID: $Id</p>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }

    // Update the confirmation status
    if (isset($_POST['update_confirmation'])) {
        $Product_id = $_POST['Product_id'];
        $confirmationStatus = $_POST['confirmationStatus'];

        // Establish a database connection
        $conn = mysqli_connect("localhost", "root", "", "project");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Update the confirmation status in the database
        $updateSql = "UPDATE farmer_order SET confirmation_status = '$confirmationStatus' WHERE Product_id= '$Product_id'";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            echo "<p>Confirmation status updated successfully.</p>";
        } else {
            echo "<p>Failed to update confirmation status.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>


    <h1  style="padding-top: 100px">Search by ID(mobilenumber)</h1>
    <form action="" method="post">
        <label for="search_user_id">Search User ID:</label>
        <input type="text" name="search_user_id" id="search_user_id">
        <button type="submit" name="search">Search</button>
    </form>

    <?php
    if (isset($_POST['search'])) {
        $search_user_id = $_POST['search_user_id'];

        // Establish a database connection
        $conn = mysqli_connect("localhost", "root", "", "project");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch the data from the farmer_order table based on the search user_id
        $searchSql = "SELECT * FROM farmer_order WHERE Id = '$search_user_id' ";
        $searchResult = mysqli_query($conn, $searchSql);

        if (mysqli_num_rows($searchResult) > 0) {
            // Display the results in a table
            echo "<h2>Search Results</h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Product Type</th>";
            echo "<th>Product Name</th>";
            echo "<th>Validity From</th>";
            echo "<th>Validity To</th>";
            echo "<th>Price</th>";
            echo "<th>District</th>";
            echo "<th>Place</th>";
            echo "<th>Product ID</th>";
            echo "<th>User ID</th>";
            echo "<th>Confirmation Status</th>";
            echo "<th>Update Confirmation</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($searchResult)) {
                echo "<tr>";
                echo "<td>".$row['Id']."</td>";
                echo "<td>".$row['Product_type']."</td>";
                echo "<td>".$row['Product_name']."</td>";
                echo "<td>".$row['Validity_from']."</td>";
                echo "<td>".$row['Validity_to']."</td>";
                echo "<td>".$row['Farmer_expected_price']."</td>";
                echo "<td>".$row['District']."</td>";
                echo "<td>".$row['Place']."</td>";
                echo "<td>".$row['Product_id']."</td>";
                echo "<td>".$row['user_id']."</td>";
                echo "<td>".$row['confirmation_status']."</td>";
                echo "<td>
                        <form method='post'>
                            <input type='hidden' name='Product_id' value='".$row['Product_id']."'>
                            <select name='confirmationStatus' onchange='this.form.submit()'>
                                <option value=''>-- Select --</option>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                            <input type='hidden' name='update_confirmation' value='true'>
                        </form>
                    </td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No results found for user ID: $search_user_id</p>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
</body>
</html>
