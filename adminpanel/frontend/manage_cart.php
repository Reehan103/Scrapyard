<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$pid=get_safe_value($conn, $_POST['pid']);
$qty=get_safe_value($conn, $_POST['qty']);
$type=get_safe_value($conn, $_POST['type']);

 $productSoldQtyByProductId= productSoldQtyByProductId($conn,$pid);

 $productQty= productQty($conn,$pid);
$pending_qty=$productQty-$productSoldQtyByProductId;

if($qty>$pending_qty){
    echo"not_available";
    die();
}

$obj=new add_to_cart();

if($type=='add'){
    $obj->addproduct($pid,$qty);
}
if($type=='remove'){
    $obj->removeproduct($pid);
}
if($type=='update'){
    $obj->updateproduct($pid,$qty);
}
echo $obj->totalProduct();


?>