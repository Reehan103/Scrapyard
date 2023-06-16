<?php
require('connection.inc.php');
require('functions.inc.php');

$name=get_safe_value($conn, $_POST['name']);
$email=get_safe_value($conn, $_POST['email']);
$mobile=get_safe_value($conn, $_POST['mobile']);
$password=get_safe_value($conn, $_POST['password']);
$added_on=date('Y-m-d h:i:s');

$sql="select * from users where email='$email'";
$res=mysqli_query($conn, $sql);
$check_user=mysqli_num_rows($res);
if($check_user>0){
    echo "present";
}else{
    mysqli_query($conn, "INSERT INTO `users` (`name`, `password`, `email`, `mobile`, `added_on`)
     VALUES ('$name', '$password','$email', '$mobile', '$added_on')");
    echo "insert";
}

?>