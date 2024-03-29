<?php
include('top.inc.php');
$order_id=$_GET['id'];

if(isset($_POST['update_order_status'])){
    $update_order_status=$_POST['update_order_status'];
    mysqli_query($conn, "update `order` set order_status='$update_order_status' where id='$order_id'");

}
?>

<!-- Categories section -->
<div class="content pb-0 ">
           <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Order Detail</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                           <table class="table">
                           <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
                                                <th class="product-thumbnail">Product Image</th>
                                                <th class="product-thumbnail">Qty</th>
                                                <th class="product-thumbnail">Price</th>
                                                <th class="product-thumbnail">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $res=mysqli_query($conn, "select order_detail.*, product.name, product.image,
                                             `order`.address, `order`.city,`order`.pincode from order_detail,product,`order`
                                              where order_detail.order_id='$order_id' and order_detail.product_id=product.id");
                                            $total_price=0;
                                            while($row=mysqli_fetch_assoc($res)){
                                                $address=$row['address'];
                                                $city=$row['city'];
                                                $pincode=$row['pincode'];
                                                $total_price=$total_price+($row['qty']*$row['price']);
                                            ?>
                                            <tr>
                                            
                                                <td class="product-name"><?php echo $row['name'] ?></td>
                                                <td class="product-name"><img src="../media/product/<?php echo $row['image'] ?>" alt="full-image"></td>
                                                <td class="product-name"><?php echo $row['qty'] ?></td>
                                                <td class="product-name"><?php echo $row['price'] ?></td>
                                                <td class="product-name"><?php echo $row['qty']*$row['price'] ?></td>
                                               
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name"><?php echo  $total_price ?></td>
                                               
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                  <div class="address_details">
                                    <strong>Address:  </strong>
                                    <?php echo $address ?>, <?php echo $city ?>, <?php echo $pincode ?><br/><br/>
                                    <strong>Order Status:  </strong>
                                    <?php
                                     $res=mysqli_query($conn,"select  order_status.name from order_status,`order`
                                       where `order`.id='$order_id' and `order`.order_status=order_status.id");
                                     $order_arr=mysqli_fetch_assoc($res);
                                     echo $order_arr['name'];
                                     ?>
                                  </div>  

                                  <div>
                                    <form method="post">
                                    <select class="form-control" name="update_order_status">
                                       <option>Select Status</option>
                                       <?php
                                          $res=mysqli_query($conn, "select * from order_status");
                                          while($row=mysqli_fetch_assoc($res)){
                                             if($row['id']==$categories_id){
                                                echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                             }else{
                                                echo "<option value=".$row['id'].">".$row['name']."</option>"; 
                                             }
                                          }
                                       ?>
                                    </select>
                                    <input type="submit" class="form-control btn btn-primary">;
                                    </form>
                                  </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

<?php
include('footer.inc.php');
?>