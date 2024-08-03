<?php
    include "head.php";
    include "header.php";
?>

<?php
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        $proNew = $pro->getProductNew();
    } else {
        if($_GET['catId'] == 0) {
            $proNew = $pro->getProductNew();
        } else {
            $id = $_GET['catId'];
            $proNew = $pro->getNewbyCat($id);
        }
    }
?>
        <div id="container" class="container">
            <div class="grid wide">
                <div class="row app-container">
                    <div class="col l-2 m-0 c-0">
                        <div class="category">
                            <h3 class="category-heading">
                                <i class="fa-solid fa-list"></i>
                                Sản phẩm mới
                            </h3>

                            <ul class="category-list">
                            <li class="category-item"><a 
                                <?php
                                    if(isset($_GET['catId'])) {
                                        if($_GET['catId'] == 0) {
                                            echo "class='selected'";
                                        }
                                    } else {
                                        echo "class='selected'";
                                    }
                                ?>
                                href="?catId=0">All</a></li>
                                <?php
                                    $catList = $cat->show_category();
                                    if($catList) {
                                        while($catRow = $catList->fetch_assoc()) {
                                ?>
                                <li class="category-item"><a 
                                <?php
                                    if(isset($_GET['catId'])) {
                                        if($_GET['catId'] == $catRow['category_id']) {
                                            echo "class='selected'";
                                        }
                                    }
                                ?>
                                href="?catId=<?php echo $catRow['category_id'] ?>"><?php echo $catRow['category_name'] ?></a></li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col l-10 m-12 main-product">
                        <div class="content-product">
                            <!-- SORT -->
                            <div class="row">
                            <?php
                                    if($proNew) {
                                        while($result = $proNew->fetch_assoc()) {
                                ?>

                                <div class="col l-3 m-4 c-12">
                                    <div class="product-item">
                                        <div class="product-thumbnail">
                                            <a href="preview.php?productId=<?php echo $result['productId'] ?>" class="product-detail__link">
                                                <img src="./admin/uploads/<?php echo $result['productImage'] ?>" alt="" class="product-img">
                                            </a>
                                        </div>

                                        <div class="product-info">
                                            <h3 class="product-name">
                                                <a href="preview.php?productId=<?php echo $result['productId'] ?>" class="product-title">
                                                    <?php
                                                    if($result['productStyle'] == 2) {
                                                        echo '<span class="new-product">NEW</span>';
                                                    }
                                                    ?>
                                                    <?php echo $result['productName'] ?>
                                                </a>
                                            </h3>
                                            <div class="price-box">
                                                <div class="price-official"><?php echo number_format($result['productPrice'], 0, ',', ',') ?><u>đ</u></div>
                                                <div class="price-informal"><?php if($result['productPrice'] != $result['productOldPrice']) {
                                                    echo number_format($result['productOldPrice'], 0, ',', ',')."<u>đ</u>";
                                                } ?></div>
                                            </div>
                                            <div class="product-action">
                                                <div class="label-discount">
                                                <?php 
                                                    if(isset($checkProm)) {
                                                        $found = false;
                                                        foreach($checkProm as $key => $value) {
                                                            if($key == 99) {
                                                                $found = true;
                                                ?>
                                                    <p>- <?php echo $value ?>%</p>
                                                <?php
                                                                break;
                                                            }
                                                        }

                                                        if(!$found) {
                                                            foreach($checkProm as $key => $value) {
                                                                if($key == $result['catId']) {
                                                ?>
                                                    <p>- <?php echo $value ?>%</p>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        
                                                    }
                                                    ?>
                                                
                                                </div>
                                                <div class="group-action">
                                                    <a href="preview.php?productId=<?php echo $result['productId'] ?>" class="detail-product">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a href="preview.php?productId=<?php echo $result['productId'] ?>" class="add-to-cart">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
<?php
    include "footer.php";
?>