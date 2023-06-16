
<?php include('top.php');
$cat_id=mysqli_real_escape_string($conn,$_GET['id']);
// for sorting products
$sort_order='';
$price_high_selected="";
$price_low_selected="";
$new_selected="";
$old_selected="";

if(isset($_GET['sort'])){
    $sort=mysqli_real_escape_string($conn,$_GET['sort']);
    if($sort=="price_high"){
        $sort_order=" order by product.price desc";
        $price_high_selected="selected";
    }
    if($sort=="price_low"){
        $sort_order=" order by product.price asc";
        $price_low_selected="selected";
    }
    if($sort=="new"){
        $sort_order=" order by product.id desc";
        $new_selected="selected";
    }
    if($sort=="old"){
        $sort_order=" order by product.id asc";
        $old_selected="selected";
    }
}

if($cat_id>0){
$get_product=get_product($conn,'','', $cat_id, '', '',$sort_order );
}else{
  ?>
  <script>
    window.location.href='index.php';
  </script>  
  <?php
}
 ?>

<div class="body__overlay"></div>
       
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Products</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">

                    <?php if(count($get_product)>0){?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id ?>')" id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php $price_low_selected ?>>Sort by price low to high</option>
                                        <option value="price_high" <?php $price_high_selected ?>>Sort by price high to low </option>
                                        <option value="new" <?php $new_selected ?>> Sort by new price</option>
                                        <option value="old" <?php $old_selected ?>>Sort by old price</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                        
                         <?php
                            foreach($get_product as $list){
                            ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="../media/product/<?php echo $list['image'] ?>" alt="product images">
                                        </a>
                                    </div>
  
                                    <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li><a href="javascript:void(0)"  onclick="wishlist_manage('<?php
                                         echo $list['id'] ?>', 'add')"><i class="icon-heart icons"></i></a></li> 1

                                        <li><a href="javascript:void(0)" onclick="manage_cart('<?php
                                         echo $list['id'] ?>', 'add')"><i class="icon-handbag icons"></i></a></li>
                                    </ul>
                                </div>

                                    <div class="fr__product__inner">
                                        <h4><a href="product-details.html"><?php echo $list['name']?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize"><?php echo $list['mrp']?></li>
                                            <li><?php echo $list['price']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                             <!-- End Single Category -->                    
                                    </div>   
                                </div>
                            </div>
                        </div>  
                    </div>
                    <?php }else 
                    {
                        echo "<h2>Data not found </h2>";
                    } ?>
                </div>
            </div>
        </section>
        <!-- End Product Grid -->
        <!-- End Banner Area -->
     
 <?php include('footer.php') ?>   