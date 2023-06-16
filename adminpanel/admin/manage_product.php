<?php
include('top.inc.php');

$categories_id='';
$name='';
$mrp='';
$price='';
$qity='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$best_seller='';

$image_required='required';
// for Edit
if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $id=get_safe_value($conn, $_GET['id']);
    $sql="select * from product where id='$id'";
    $result=mysqli_query($conn, $sql);
    $check=mysqli_num_rows($result);
    if($check>0){
       $row=mysqli_fetch_assoc($result);
        $categories_id=$row['categories_id'];
        $name=$row['name'];
        $mrp=$row['mrp'];
        $price=$row['price'];
        $qity=$row['qity'];
        $short_desc=$row['short_desc'];
        $description=$row['description'];
        $meta_title=$row['meta_title'];
        $meta_desc=$row['meta_desc'];
        $meta_keyword=$row['meta_keyword'];
        $best_seller=$row['best_seller'];
    }else{
        header("Location: product.php");
        die();
    }
}

$msg='';
// for add product
if(isset($_POST['submit'])){
    $categories_id=get_safe_value($conn, $_POST['categories_id']);
    $name=get_safe_value($conn, $_POST['name']);
    $mrp=get_safe_value($conn, $_POST['mrp']);
    $price=get_safe_value($conn, $_POST['price']);
    $qty=get_safe_value($conn, $_POST['qity']);
    $short_desc=get_safe_value($conn, $_POST['short_desc']);
    $description=get_safe_value($conn, $_POST['description']);
    $meta_title=get_safe_value($conn, $_POST['meta_title']);
    $meta_desc=get_safe_value($conn, $_POST['meta_desc']);
    $meta_keyword=get_safe_value($conn, $_POST['meta_keyword']);
    $best_seller=get_safe_value($conn, $_POST['best_seller']);

    $sql="select * from product where name='$name'";
    $result=mysqli_query($conn, $sql);
    $check=mysqli_num_rows($result);
    if($check>0){
      if(isset($_GET['id']) && $_GET['id']!=''){
          $getData=mysqli_fetch_assoc($result);
          if($id==$getData['id']){

          }else{
            $msg="Product already exist";
          }
      }else{
        $msg="Product already exist";
      }
    }

    if($_FILES['image']['type'] !='' && ($_FILES['image']['type'] !='image/png' && $_FILES['image']['type'] !='image/jpg' && 
     $_FILES['image']['type'] !='image/jpeg')){
        $msg="Pleas select only png, jpg and jpeg image formate";
     }

    if($msg==''){
    if(isset($_GET['id']) && $_GET['id']!=''){
        if($_FILES['image']['name'] !=''){
            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
             move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/'.$image);
             
             $update_sql="UPDATE `product` SET `categories_id`='$categories_id',`name`='$name',
             `mrp`='$mrp',`price`='$price',`qity`='$qty',
             `short_desc`='$short_desc',`description`='$description',`meta_title`='$meta_title',
             `meta_desc`='$meta_desc',`meta_keyword`='$meta_keyword',`image`='$image', `best_seller`='$best_seller' WHERE id='$id'";
        }else{
            $update_sql="UPDATE `product` SET `categories_id`='$categories_id',`name`='$name',
             `mrp`='$mrp',`price`='$price',`qity`='$qty',
             `short_desc`='$short_des',`description`='$description',`meta_title`='$meta_title',
             `meta_desc`='$meta_desc',`meta_keyword`='$meta_keyword', `best_seller`='$best_seller' WHERE id='$id'";
        }

         $result=mysqli_query($conn, $update_sql);
    }else{
        $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/'.$image);

        mysqli_query($conn,"INSERT INTO `product` (`categories_id`, `name`, `mrp`, `price`, `qity`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`,`image`,`best_seller`)
         VALUES ('$categories_id', '$name', '$mrp', '$price', '$qty', '$short_desc', '$description', '$meta_title', '$meta_desc', '$meta_keyword', 1, '$image', '$best_seller')");
        // $result=mysqli_query($conn, $sql);
    }
    header("Location: product.php");
    die();
  }
}


?>

<!-- form section -->
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">  
                        <div class="card-body card-block">
                           <div class="form-group">
                            <label for="categorie" class=" form-control-label"> Categories</label>
                            <select class="form-control" name="categories_id">
                                <option>Select Category</option>
                                <?php
                                  $res=mysqli_query($conn, "select id,categories from categories
                                   order by categories asc");
                                   while($row=mysqli_fetch_assoc($res)){
                                    if($row['id']==$categories_id){
                                        echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                    }else{
                                        echo "<option value=".$row['id'].">".$row['categories']."</option>"; 
                                    }
                                   }

                                ?>
                            </select>
                            </div>
                            <div class="form-group">
                            <label for="name" class=" form-control-label"> Product Name</label>
                            <input type="text" name="name" placeholder="Enter product name" 
                            class="form-control" required value="<?php echo $name ?>">
                            </div>
                            <div class="form-group">
                            <label for="categorie" class=" form-control-label"> Best Seller</label>
                            <select class="form-control" name="best_seller">
                                <option value="">Select</option>
                                <?php
                                if($best_seller==1){
                                    echo ' <option value="1" selected>Yes</option>
                                    <option value="0">No</option>';
                                }elseif($best_seller==0){
                                    echo ' <option value="1">Yes</option>
                                          <option value="1" selected>No</option>';
                                }else{
                                 echo '<option value="1">Yes</option>
                                    <option value="0">No</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <div class="form-group">
                            <label for="mrp" class=" form-control-label"> MRP</label>
                            <input type="text" name="mrp" placeholder="Enter mrp" 
                            class="form-control" required value="<?php echo $mrp ?>">
                            </div>
                            <div class="form-group">
                            <label for="price" class=" form-control-label"> Product price</label>
                            <input type="text" name="price" placeholder="Enter product price" 
                            class="form-control" required value="<?php echo $price ?>">
                            </div>
                            <div class="form-group">
                            <label for="qty" class=" form-control-label"> QTY</label>
                            <input type="text" name="qity" placeholder="Enter qty" 
                            class="form-control" required value="<?php echo $qity ?>">
                            </div>
                            <div class="form-group">
                            <label for="image" class=" form-control-label"> Image</label>
                            <input type="file" name="image" class="form-control" <?php echo $image_required ?>>
                            </div>
                            <div class="form-group">
                            <label for="short_desc" class=" form-control-label"> Short Description</label>
                            <textarea type="text" name="short_desc" placeholder="Enter product short description" 
                            class="form-control"><?php echo $short_desc ?></textarea>
                            </div>
                            <div class="form-group">
                            <label for="description" class=" form-control-label"> Description</label>
                            <textarea type="text" name="description" placeholder="Enter product description" 
                            class="form-control" required><?php echo $description ?></textarea>
                            </div>
                            <div class="form-group">
                            <label for="meta_title" class=" form-control-label"> Meta Title</label>
                            <textarea type="text" name="meta_title" placeholder="Enter product meta title" 
                            class="form-control" ><?php echo $meta_title ?></textarea>
                            </div>
                            <div class="form-group">
                            <label for="meta_desc" class=" form-control-label"> Meta Description</label>
                            <textarea type="text" name="meta_desc" placeholder="Enter product meta description" 
                            class="form-control" ><?php echo $meta_desc ?></textarea>
                            </div>
                            <div class="form-group">
                            <label for="meta_keyword" class=" form-control-label"> Meta Keyword</label>
                            <textarea type="text" name="meta_keyword" placeholder="Enter produt meta keyword" 
                            class="form-control" ><?php echo $meta_keyword ?></textarea>
                            </div>
                        
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount" >Submit</span>
                           </button>
                           <div class="text-danger"> <?php echo $msg ?> </div>
                        </div>
                    </form> 
                     </div>
                  </div>
               </div>
            </div>
         </div>

<?php
include('footer.inc.php');
?>