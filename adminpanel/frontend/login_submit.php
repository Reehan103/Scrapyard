<?php
require('connection.inc.php');
require('functions.inc.php');

$email=get_safe_value($conn, $_POST['email']);
$password=get_safe_value($conn, $_POST['password']);

$sql="select * from users where email='$email' and password='$password'";
$res=mysqli_query($conn, $sql);
$check_user=mysqli_num_rows($res);
if($check_user>0){
    $row=mysqli_fetch_assoc($res);
    $_SESSION['USER_LOGIN']='yes';
    $_SESSION['USER_ID']=$row['id'];
    $_SESSION['USER_NAME']=$row['name'];

    if(isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID']!=''){
        wishlist_add($conn, $_SESSION['USER_ID'],$_SESSION['WISHLIST_ID']);
        unset($_SESSION['WISHLIST_ID']);
    }
    echo "valid";
}else{
    echo "wrong";
}

?>