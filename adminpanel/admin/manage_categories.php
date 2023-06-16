<?php
include('top.inc.php');
$categories='';
$msg='';
//for edit
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($conn, $_GET['id']);
    $sql="select * from categories where id='$id'";
    $result=mysqli_query($conn, $sql);
    $check=mysqli_num_rows($result);
    if($check>0){
        $row=mysqli_fetch_assoc($result);
        $categories=$row['categories'];
    }else{
        header('location: categories.php');
        die();
    }
}

if(isset($_POST['submit'])){
    $categories=get_safe_value($conn, $_POST['categories']);

    $sql="select * from categories where categories='$categories'";
    $result=mysqli_query($conn, $sql);
    $check=mysqli_num_rows($result);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($result);
            if($id==$getData['id']){

            }else{
                $msg="Categories already exist";
            }

        }else{
            $msg="Categories already exist"; 
        }
    }
    
    if($msg=='')
    {

    if(isset($_GET['id']) && $_GET['id']!=''){
        $sql="UPDATE `categories` SET `categories`='$categories' WHERE id='$id'";
        $res=mysqli_query($conn, $sql);
    }else{
        $sql="INSERT INTO `categories` (`categories`, `status`) VALUES ('$categories', '1')";
        $res=mysqli_query($conn, $sql);
    }
    header('location: categories.php');
    die();
}
}

?>
<div class="content pb-0">
<div class="animated fadeIn">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header"><strong>Categories</strong><small> Form</small></div>
          <form method="post">  
            <div class="card-body card-block">
               <div class="form-group"><label for="categories" class=" form-control-label">Categories</label>
               <input type="text" name="categories" placeholder="Enter categories name"
                class="form-control" required value="<?php echo $categories ?>"></div>
             
               <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
               <span id="payment-button-amount" name="submit">Submit</span>
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