<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud operations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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
        /* Custom CSS */
        body {
            background-color: #f8f9fa;
        }
        .table-header {
            background-color: black;
            color: white;

        }
        .table-row-odd {
            background-color: #f8f9fa;
        }
        .table-row-even {
            background-color: #e9ecef;
        }
        .container {
            max-width: 100%;
            margin-top: 50px;
        }
        .table-responsive {
            max-height: 80vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>
   <div class="navbar">
  <a href="home.html" style="color: white;padding-bottom:10px; padding-top: 30px;font-family: times new roman">Home</a>
 <h1 style="color: white;text-align: center;padding-right:500px;font-family: times new roman">PRODUCT Details</h1>
</div>
    <div class="container">
        <button class="btn btn-primary my-5">
            <a href="user.php" class="text-light">Add Product</a>
        </button><br><br>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Product_type</th>
                        <th scope="col">Product_name</th>
                        <th scope="col">Validity_from</th>
                        <th scope="col">Validity_to</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Farmer_expected_price</th>
                        <th scope="col">Place</th>
                        <th scope="col">District</th>
                        <th scope="col">Product_description</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connect.php';

                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                        // Use the user_id for further processing or display
                        echo "User ID: " . $user_id;
                    } else {
                        // User ID is not provided
                        echo "User ID not found.";
                    }

                    $sql = "SELECT * FROM agromart WHERE Id = $user_id";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        $row_count = mysqli_num_rows($result);
                        $counter = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Id = $row['Id'];
                            $Product_type = $row['Product_type'];
                            $Product_name = $row['Product_name'];
                            $Validity_from = $row['Validity_from'];
                            $Validity_to = $row['Validity_to'];
                            $Quantity = $row['Quantity'];
                            $Farmer_expected_price = $row['Farmer_expected_price'];
                            $District = $row['District'];
                            $Place = $row['Place'];
                            $Product_description = $row['Product_description'];

                            $row_class = ($counter % 2 == 0) ? 'table-row-even' : 'table-row-odd';

                            echo '<tr class="' . $row_class . '">
                                    <th scope="row">'.$Id.'</th>
                                    <td>'.$Product_type.'</td>
                                    <td>'.$Product_name.'</td>
                                    <td>'.$Validity_from.'</td>
                                    <td>'.$Validity_to.'</td>
                                    <td>'.$Quantity.'</td>
                                    <td>'.$Farmer_expected_price.'</td>
                                    <td>'.$District.'</td>
                                    <td>'.$Place.'</td>
                                    <td>'.$Product_description.'</td>
                                    <td>
                                        <button class="btn btn-primary">
                                            <a href="order_status.php?orderId='.$Id.'" class="text-light">Track ORDER</a>
                                        </button><br><br>
                                        <form action="delete.php" method="post" style="display: inline;">
                                            <input type="hidden" name="Id" value="'.$Id.'">
                                            <input type="hidden" name="Product_type" value="'.$Product_type.'">
                                            <input type="hidden" name="Product_name" value="'.$Product_name.'">
                                            <input type="hidden" name="Validity_from" value="'.$Validity_from.'">
                                            <input type="hidden" name="Validity_to" value="'.$Validity_to.'">
                                            <input type="hidden" name="Quantity" value="'.$Quantity.'">
                                            <input type="hidden" name="Farmer_expected_price" value="'.$Farmer_expected_price.'">
                                            <input type="hidden" name="District" value="'.$District.'">
                                            <input type="hidden" name="Place" value="'.$Place.'">
                                            <input type="hidden" name="Product_description" value="'.$Product_description.'">
                                            <button class="btn btn-danger" type="submit">Remove</button>
                                        </form><br><br>
                                    </td>
                                </tr>';

                            $counter++;
                        }
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }

                    mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

