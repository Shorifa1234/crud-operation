<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include('database.php');
// include('update-script.php');
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $full_name = $connection->escape_string($_POST['full_name']);
  $email_address = $connection->escape_string($_POST['email_address']);
  $city = $connection->escape_string($_POST['city']);
  $country = $connection->escape_string($_POST['country']);
  
      //insert into table
      if(isset($_GET['id'])){
        $query="UPDATE user_details SET full_name='$full_name',email_address='$email_address',city= '$city',country='$country' WHERE id=$id" ;
      }
      // else{
      //   $query="UPDATE user_details SET full_name='$full_name',email_address='$email_address',city= '$city',country='$country' WHERE id=$id" ;
      // }
      $connection->query($query);
      if($connection->affected_rows){
          $_SESSION['m'] = "Product Updated Successfully";
      }
      else{
          $_SESSION['m'] = "ERROR!! Updating Product. Contact Admin";
      }    
      $query->close();    
      header("location:user-table.phpp?id=" . $id);
}
if(isset($_GET['id'])){
  
  $id = $_GET['id'];
  // echo "you wabt to edit $id";
  $query="UPDATE user_details SET full_name='$full_name',email_address='$email_address',city= '$city',country='$country' WHERE id=$id" ;

  $result = $connection->query($query);
  if($result->num_rows){
    $editData = $result->fetch_assoc();   
  }
  else{
      die("No results found");
      exit();
  }
}
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP CRUD Operations</title>
<style>
    
body{
    overflow-x: hidden;
}

* {
  box-sizing: border-box;}
.user-detail form {
    height: 100vh;
    border: 2px solid #f1f1f1;
    padding: 16px;
    background-color: white;
    }
    .user-detail{
      width: 30%;
    float: left;
    }

input{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;}
input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;}
button[type=submit] {
    background-color: #434140;
    color: #ffffff;
    padding: 10px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    font-size: 20px;}
label{
  font-size: 18px;;}
button[type=submit]:hover {
  background-color:#3d3c3c;}
  .form-title a, .form-title h2{
   display: inline-block;
   
  }
  .form-title a{
      text-decoration: none;
      font-size: 20px;
      background-color: green;
      color: honeydew;
      padding: 2px 10px;
  }
 
</style>
</head>
<body>
<div class="user-detail">

    <div class="form-title">
    <h2>Create Form</h2>
    
    
    </div>
 
    <p style="color:red">
    
<?php if(!empty($msg)){echo $msg; }?>
</p>
    <form method="post" action="">
          <label>Full Name</label>
        
<input type="text" placeholder="Enter Full Name" name="full_name" required value="<?php echo isset($editData) ? $editData['full_name'] : '' ?>">

          <label>Email Address</label>
        
<input type="email" placeholder="Enter Email Address" name="email_address" required value="<?php echo isset($editData) ? $editData['email_address'] : '' ?>">

          <label>City</label>
<input type="city" placeholder="Enter Full City" name="city" required value="<?php echo isset($editData) ? $editData['city'] : '' ?>">

          <label>Country</label>
        
<input type="text" placeholder="Enter Full Country" name="country" required value="<?php echo isset($editData) ? $editData['country'] : '' ?>">

          <button type="submit" name="update">Submit</button>
    </form>
        </div>
</div>

</body>
</html>