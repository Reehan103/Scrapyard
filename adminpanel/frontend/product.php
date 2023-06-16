
<?php include('top.php');
$product_id=mysqli_real_escape_string($conn,$_GET['id']);
$get_product=get_product($conn,'','', '',$product_id);
 ?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat  center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <a class="breadcrumb-item" href="categories.php?id=<?php echo $get_product['0']['categories_id'] ?>">
                                  <?php echo $get_product['0']['categories'] ?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo $get_product['0']['name'] ?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="../media/product/<?php echo $get_product['0']['image'] ?>" alt="full-image">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $get_product['0']['name'] ?></h2>
                                <ul  class="pro__prize">
                                    <li class="old__prize"><?php echo  $get_product['0']['mrp'] ?></li>
                                    <li><?php echo  $get_product['0']['price'] ?></li>
                                </ul>
                                <p class="pro__info"><?php echo  $get_product['0']['short_desc'] ?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <?php
                                     $productSoldQtyByProductId= productSoldQtyByProductId($conn,$get_product['0']['id']);

                                     $pending_qty=$get_product['0']['qity']-$productSoldQtyByProductId;

                                     $cart_show="yes";
                                     if($get_product['0']['qity'] >  $productSoldQtyByProductId){
                                           $stock="In Stock";
                                     }else{
                                        $stock="Not In Stock";
                                        $cart_show='';
                                     }
                                        ?>
                                        <p><span>Availability:</span> <?php echo $stock; ?></p>
                                    </div>
                                    <?php
                                    if($cart_show !=''){
                                        ?>
                                    <div class="sin__desc">
                                        <p><span>Qty:</span> 
                                        <select id="qty">
                                            <?php
                                               for($i=1; $i<=$pending_qty; $i++){
                                               echo" <option> $i</option>";
                                               }
                                           ?> 
                                        </select>
                                        </p>
                                    </div>
                                    <?php } ?>
                                    <?php
                                    if($cart_show !=''){
                                        ?>
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $get_product['0']['categories'] ?></a></li>
                                        </ul>
                                    </div>
                                    <a class="fr__btn " href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>', 'add')">Add to cart </a>
                                    <?php } ?>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <!-- End Product Details Area -->
     
 <?php include('footer.php') ?>   