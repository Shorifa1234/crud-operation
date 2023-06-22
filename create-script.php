<?php

include('database.php');

if(isset($_POST['create'])){
   
      $msg=insert_data($connection);
      
}

// insert query
function insert_data($connection){
   
      $full_name= legal_input($_POST['full_name']);
      $email_address= legal_input($_POST['email_address']);
      $city = legal_input($_POST['city']);
      $country = legal_input($_POST['country']);

      $query="INSERT INTO user_details (full_name,email_address,city,country) VALUES ('$full_name','$email_address','$city','$country')";
      $exec= mysqli_query($connection,$query);
      if($exec){

        $msg="Data was created sucessfully";
        return $msg;
      
      }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($connection);
      }
}

// convert illegal input to legal input
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>