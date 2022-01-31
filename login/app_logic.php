<?php 
session_start();

$data = [];
$errors = [];

$db = new mysqli('mysql.freehostia.com', 'deefgu_test', 'Deepak@24', 'deefgu_test');
if ($db->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$password = $confirm_password = "";
if(isset($_POST['register'])){
  if(empty($_POST['name'])){
    $errors['name'] = "Name is required";
  }else{
    $name = $_POST['name'];    
  }
  if(empty($_POST['username'])){
    $errors['username'] = "Username is required";
  }else{
    $username = $_POST['username'];    
  }
  if(empty($_POST['email'])){
    $errors['email'] = "Email is required";
  }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email address";
  }else{
    $email = $_POST['email'];    
  }
  if(empty($_POST['password'])){
    $errors['password'] = "Password is required";
  }else{
    $password = $_POST['password'];    
  }
  if(empty($_POST['cpassword'])){
    $errors['cpassword'] = "Confirm Password is required";
  }else{
    $confirm_password = $_POST['cpassword'];    
  }
  if($password != $confirm_password){ 
    $errors['passwords'] = "Both Passwords must match!";
  }
  $sql = "SELECT * FROM task WHERE username = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    $errors['unique_username'] = "Username already exists!";
  }
  if(empty($errors)){
  $id = md5(uniqid());
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $sql="INSERT INTO task (`id`,`name`,`email`,`username`,`password`) values (?,?,?,?,?)";
  $stmt= $db->prepare($sql);
  $stmt->bind_param('sssss', $id, $name, $email, $username, $hashed_password);
    if($stmt->execute()){
      //Data insertion in JSON file
      $current_data=file_get_contents('user_data.json');
      $current_data_array=json_decode($current_data,true);
      $new_data=array(
        'id'=> $id,
        'name'=>$name,
        'email'=>$email,
        'username'=>$username
      );
      $current_data_array[]=$new_data;
      $final_data=json_encode($current_data_array);
      file_put_contents('user_data.json',$final_data);
      $data['status'] = "success";
      $data['errors'] = false;
      $data['message'] = 'Registration Successful!';
    }else{
      $data['status'] = "error";
      $data['errors'] = false;
      $data['message'] = 'Something went wrong!';
    }
  }else{
    $data['status'] = "error";
    $data['errors'] = $errors;
    $data['message'] = 'Check all the errors below and try again!';
  }
  echo json_encode($data);
}

if(isset($_POST['login'])){
  if(empty($_POST['username'])){
    $errors['username'] = "Username is required";
  }else{
    $username = $_POST['username'];
  }
  if(empty($_POST['password'])){
    $errors['password'] = "Password is required";
  }else{
    $password = $_POST['password'];
  }
  if (empty($errors)) {
  $sql="SELECT * FROM task WHERE username = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])){
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username']= $row['username'];
    $data['status'] = "success";
    $data['errors'] = false;
    $data['message'] = "Login Successful!";
   }else{
    $data['status'] = "error";
    $data['errors'] = false;
    $data['message'] = "Incorrect Password!";
   }
  }else{
    $data['status'] = "error";
    $data['errors'] = false;
    $data['message'] = "Username does not exist!";
   }
  }else{
  $data['status'] = "error";
  $data['errors'] = $errors;
  $data['message'] = "Check all the errors below and try again!";
  }
  echo json_encode($data);
}

if(isset($_POST['update'])){
  if(empty($_POST['age'])){
    $errors['age'] = "Age is required";
  }
  else{
    $age = $_POST['age'];
  }
  if(empty($_POST['phone'])){
    $errors['phone']= "Phone number is required";
  }
  else{
    $phone = $_POST['phone'];
  }
  $dob = $_POST['dob'];
  if (empty($errors)) {
  $sql="UPDATE task SET age = ?, dob = ?, phone = ? WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param('isii', $age, $dob, $phone, $_SESSION['user_id']);
   if($stmt->execute()){
      //Updating JSON data
      $current_data=file_get_contents('user_data.json');
      $current_data_array=json_decode($current_data,true);
      foreach($current_data_array as $key=>$value){
        if($value['id']==$_SESSION['user_id']){
          $current_data_array[$key]['age']=$age;
          $current_data_array[$key]['dob']=$dob;
          $current_data_array[$key]['phone']=$phone;
        }
      }
      $final_data=json_encode($current_data_array);
      file_put_contents('user_data.json',$final_data);
      $data['status'] = "success";
      $data['errors'] = false;
      $data['message'] = "Profile updated successfully!";
   }else{
      $data['status'] = "error";
      $data['errors'] = false;
      $data['message'] = "Something went wrong!";
   }
  }else{
    $data['status'] = "error";
    $data['errors'] = $errors;
    $data['message'] = "Check all the errors below and try again!";
  }
  echo json_encode($data);
}

if(isset($_POST['fetch']) && isset($_SESSION['user_id'])){
  $sql = "SELECT * FROM task WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param('i', $_SESSION['user_id']);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    $data = array();
    while($row = $result->fetch_assoc()){
      $data['status'] = "success";
      $data['name'] = $row['name'];
      $data['email'] = $row['email'];
      $data['age'] = $row['age'];
      $data['dob'] = $row['dob'];
      $data['phone'] = $row['phone'];
    }
    echo json_encode($data);
  }else{
    $date="error";
    echo json_encode($date);
  }
}
?>