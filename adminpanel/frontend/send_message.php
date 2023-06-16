
<?php include('top.php');
require('connection.inc.php');

$name=get_safe_value($conn, $_POST['name']);
$email=get_safe_value($conn, $_POST['email']);
$mobile=get_safe_value($conn, $_POST['mobile']);
$comment=get_safe_value($conn, $_POST['message']);
$added_on=date('Y-m-d h:i:s');
$sql="INSERT INTO `contact_us1` (`name`, `email`, `mobil`, `comment`, `added_on`)
 VALUES ('$name', '$email', '$mobile', '$comment', '$added_on')";
     
 <?php include('footer.php') ?>   