<?php
include 'connect.php';

$Id=$_POST['Id'];
$Product_type=$_POST['Product_type'];
$Product_name=$_POST['Product_name'];
$Validity_from=$_POST['Validity_from'];
$Validity_to=$_POST['Validity_to'];
$Quantity=$_POST['Quantity'];
$Farmer_expected_price=$_POST['Farmer_expected_price'];
$Place=$_POST['Place'];
$District=$_POST['District'];
$Product_description=$_POST['Product_description'];
   
    $sql = "DELETE FROM agromart WHERE Id = $Id  and Product_type='$Product_type'and Product_name='$Product_name'and Validity_from='$Validity_from'and Validity_to='$Validity_to'and Quantity=$Quantity and Farmer_expected_price='$Farmer_expected_price'and Place='$Place' and District='$District' and Product_description='$Product_description'";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        //echo "Deleted Successfully";
        header('Location: display.php?user_id=' . $Id);
        exit;
    } else {
        die(mysqli_error($con));
    }

?>
