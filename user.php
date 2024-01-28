<?php

include'connect.php';
if(isset($_POST['submit']))
{
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



$sql="INSERT INTO agromart(Id,Product_type,Product_name,Validity_from,Validity_to,Quantity,Farmer_expected_price,Place,District,Product_description)VALUES('$Id','$Product_type','$Product_name','$Validity_from','$Validity_to','$Quantity','$Farmer_expected_price','$Place','$District','$Product_description')";
$result=mysqli_query($con,$sql);
if($result)
{   //echo"data insertion is successfull";
    header('Location: display.php?user_id=' . $Id);
}
else
{   die(mysqli_error($con));
}


}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <title>Farmer_page</title>
    <h1>FARMER PRODUCT DETAILS</h1>
  </head>
  <body>
    <div class="container">

    <form method="post" onsubmit="return validateForm()" class="animated zoomIn" id="myForm">

  <div class="form-group">
    <label >Id*</label>
    <input type="int" class="form-control"  placeholder="Enter your Mobile_number as id" name="Id"autocomplete="off" required>
</div>
    
<div class="form-group">
    <label >Product_type*</label>
    <select id="Product_type" name="Product_type" required>
      <option value="">--Please select--</option>
      <option value="fruit">Fruit</option>
      <option value="vegetable">Vegetable</option>
  </select><br>
</div>


<div class="form-group">
    
    <label for="Product_name">Product Name*</label>
    <select id="Product_name" name="Product_name" required>
      <option value="">--Please select--</option>
      <option value="apple">Apple</option>
      <option value="banana">Banana</option>
      <option value="carrot">Carrot</option>
      <option value="potato">Potato</option>
    </select><br>
  
</div>


<div class="form-group">
    <label >Validity_from*</label>
    <input type="date" value="<?php print(date("Y-m-d")); ?>"  class="form-control"  placeholder="product validity starts from.." name="Validity_from"autocomplete="off"required>
</div>


<div class="form-group">
    <label >Validity_to*</label>
    <input type="date" class="form-control"  placeholder="product validity ends with.." name="Validity_to"autocomplete="off" required>
</div>

<div class="form-group">
    <label >Quantity*</label>
    <input type="int" class="form-control"  placeholder="Enter quantity in kgs" name="Quantity"autocomplete="off" required>
</div>

<div class="form-group">
    <label >Farmer_expected_price*</label>
    <input type="int" class="form-control"  placeholder="Enter price in rupees" name="Farmer_expected_price"autocomplete="off" required>
</div>


<div class="form-group">
   <label for="District">District*:</label>
    <select id="District" name="District" required>
      <option value="">--Please select--</option>
      <option value="dist-1">District 1</option>
      <option value="dist-2">District 2</option>
      <option value="dist-3">District 3</option>
    </select><br> 
</div>


<div class="form-group">
    <label for="Place">Place*:</label>
    <select id="Place" name="Place" required>
      <option value="">--Please select--</option>
      <option value="place-1">Place 1</option>
      <option value="place-2">Place 2</option>
      <option value="place-3">Place 3</option>
    </select><br>
</div>

<div class="form-group">
    <label >Product_description</label>
    <input type="text" class="form-control" placeholder="About your product....." name="Product_description"autocomplete="off">
</div>
<div class="d-flex justify-content-between">
<button type="submit" name="submit" class="animated bounce rotateIn" onclick="return validateForm()"style="margin-right: 150px;" animation-name: bounce; animation-duration: 1s; transform-origin: center;>Submit</button>
<button type="button"  class="animated bounce rotateIn" onclick="resetForm()"style="" animation-name: bounce; animation-duration: 1s; transform-origin: center; >Reset</button>
</div>
   </form>

    </div>

<script>

function resetForm() {
        document.getElementById("myForm").reset();
    }
    
function validateForm() {
  // Get all the form inputs
  var Id = document.forms[0]["Id"].value;
        var Product_type = document.forms[0]["Product_type"].value;
        var Product_name = document.forms[0]["Product_name"].value;
        var Validity_from = document.forms[0]["Validity_from"].value;
        var Validity_to = document.forms[0]["Validity_to"].value;
        var Quantity = document.forms[0]["Quantity"].value;
        var Farmer_expected_price = document.forms[0]["Farmer_expected_price"].value;
        var District = document.forms[0]["District"].value;
    var Place = document.forms[0]["Place"].value;

  // Check if all the required fields are filled
  if (Id == "" || Product_type == "" || Product_name == "" || Validity_from == "" || Validity_to == "" || Quantity == "" || Farmer_expected_price == "" || District == "" || Place == "") {
    alert("Please,fill all required fields!!");
    return false;
  }

  // Check if the quantity and farmer price fields are numeric
  if (isNaN(Id) ||isNaN(Quantity) || isNaN(Farmer_expected_price)) {
    alert("Id,Quantity and Farmer_expected_price fields must be positive numeric only.");
    return false;
  }
  
  if (Id <= 0) {
    alert("Id,Quantity,Price must be a non-zero positive value.");
    return false;
  }

  if (Quantity <= 0) {
    alert("Id,Quantity,Price must be a non-zero positive value.");
    return false;
  }

  if (Farmer_expected_price <= 0) {
    alert("Id,Quantity,Price must be a non-zero positive value.");
    return false;
  }
  // Enable the submit button
  
}

</script>



<style>
    h1 {
    font-family: Arial, sans-serif;
    font-size: 36px;
    font-weight: bold;
    margin: 0 auto;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 2px;
    line-height: 1.2;
    text-align: center;
 
}
body {
    
    background-color: #F0F0F0;
  }
  
  form {
    margin: 50px auto;
    max-width: 400px;
    padding: 20px;
    background-color: #FFFFFF;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    color: blue;
    font-family:'Times New Roman' ;
    font-size: larger;
    font-weight: bold;
    
  }
  
  input[type="text"], input[type="int"], input[type="date"], textarea {
    width: 100%;
    font-size:larger;
    border:2px solid black;
    height:35px;
}
select {
    width: 100%;
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6"><path fill="currentColor" d="M0 0h12L6 6z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
    background-size: 12px 6px;
    padding-right: 1.5rem;
    border:2px solid black;
    font-size:larger;
    height:35px;
}
 button[type="button"], button {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    color: #FFFFFF;
    background-color: grey;
    cursor: pointer;
    box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
  }
  button[type="button"]:hover, button:hover {
    background-color: blur;
  }
  

  button[type="submit"], button {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    color: #FFFFFF;
    background-color: blue;
    cursor: pointer;
    box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
  }
  
  button[type="submit"]:hover, button:hover {
    background-color: blur;
  }
  
  .animated {
    animation-duration: 1s;
  }
  
  .zoomIn {
    animation-name: zoomIn;
  }
  
  .bounce {
    animation-name: bounce;
  }
  
  .rotateIn {
    animation-name: rotateIn;
  }
  
  @keyframes zoomIn {
    from {transform: scale(0)}
    to {transform: scale(1)}
  }
  
  @keyframes bounce {
    0%, 100% {transform: translateY(0)}
    50% {transform: translateY(-10px)}
  }
  
  @keyframes rotateIn {
    from {transform: rotate(0deg)}
    to {transform: rotate(360deg)}
  }
  label[for][required]::before {
    content: "*";
    color: red;
    margin-right: 5px;
  }
</style>
    
    
  </body>
</html>