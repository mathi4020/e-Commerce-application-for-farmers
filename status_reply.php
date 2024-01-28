<!DOCTYPE html>
<html>
<head>
    <title>Buy products</title>
    
        /* Define your CSS styles here */
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
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 5px;
            width: 200px;
        }

        button[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        p {
            color: #999;
        }
    </style>
    
</head>
<body>
    <div class="navbar">
  <a href="home.html" style="color: white;padding-bottom:10px; padding-top: 30px;font-family: times new roman">Home</a>
 <h1 style="color: white;padding-right:65px;text-align: center;font-family: times new roman">BUY PRODUCTS</h1>
</div>
    <h1  style="padding-top: 100px">Search by User ID</h1>
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
        $searchSql = "SELECT * FROM farmer_order WHERE user_id = '$search_user_id' ";
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
            echo "<th>User ID</th>";
            echo "<th>Confirmation Status</th>";
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
                echo "<td>".$row['user_id']."</td>";
                echo "<td>".$row['confirmation_status']."</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No results found for User ID: $search_user_id</p>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
</body>
</html>
