<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}
function get_safe_value($conn,$str){
    if($str !=''){
        $str=trim($str);
    return mysqli_real_escape_string($conn, $str);
}
}
//Product ko database sa fetch karna ka lia
function get_product($conn,$type='', $limit='', $cat_id='', $product_id='', $search_str='', $sort_order='', $is_best_seller=''){
    $sql="select product.*, categories.categories from product,categories where product.status=1 ";
    if($cat_id !=''){
        $sql.=" and product.categories_id=$cat_id";
    }
    if($product_id !=''){
        $sql.=" and product.id=$product_id";
    }
    if($is_best_seller!=''){
        $sql.=" and product.best_seller=1";
    }
    $sql.=" and product.categories_id=categories.id";
    if($search_str!=''){
        $sql.=" and (product.name like '%$search_str%' or product.description like '%$search_str%' ) ";
    }
    if($sort_order!=''){
        $sql.=$sort_order;
    }
    else{
        $sql.=" order by product.id desc";
    }

    if($limit !=''){
        $sql.=" limit $limit";
    }
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;
}

function wishlist_add($conn,$uid,$pid){
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($conn, "INSERT INTO `wishlist` (`user_id`, `product_id`, `added_on`)
         VALUES ('$uid', '$pid', '$added_on')");
}

// for stack
function productSoldQtyByProductId($conn,$pid){
    $sql="select sum(order_detail.qty) as qty from order_detail, `order` where `order`.id=order_detail.order_id
    and order_detail.product_id=$pid and `order`.order_status!=4";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['qty'];
}

// for total qty
function productQty($conn,$pid){
    $sql="select qity from product where id='$pid'";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['qity'];
}

?>