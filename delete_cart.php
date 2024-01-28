<?php
include'connect.php';
if(isset($_GET['Delete_id']))
{
     $Product_id=$_GET['Delete_id'];


 $sql="delete from login where Product_id=$Product_id";
 $result=mysqli_query($con,$sql);
 if($result){
    //echo "Deleted Successfully";
    //header('location:display.php');
 }
 else{
    die(mysqli_error($con));
 }  
}





?>