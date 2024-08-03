<?php
    include "head.php";
    include "header.php";
    include "slider.php";
?>

<?php
    if((isset($_GET['catId']) && isset($_GET['sortby']) && isset($_GET['filter']))) {
        $id = $_GET['catId'];
        $sortby = $_GET['sortby'];
        $filter = $_GET['filter'];
        $proList = $pro->getProductCatSort($id, $sortby, $filter);
        $scroll = true;
    } else if(isset($_GET['catId']) && !isset($_GET['sortby']) && !isset($_GET['filter'])){
        if($_GET['catId'] == 0) {
        $proList = $pro->showProductPage();
        } else {
            $id = $_GET['catId'];
            $proList = $pro->getProductbyCat($id);
        }
        $scroll = true;
    } else if(isset($search)) {
        $proList = $search;
        $scroll = true;
    } else if(isset($_GET['page']) && !isset($_GET['sortby']) && !isset($_GET['filter'])){
        $proList = $pro->showProductPage();
        $scroll = true;
    } else {
        $proList = $pro->showProductPage();
        $scroll = false;
    }
?>

<?php
    if($scroll) {
        echo "<script>
        window.onload = function() {
            var container = document.getElementById('container');

            if (container) {
                var containerPosition = container.getBoundingClientRect().top + window.scrollY;

                window.scrollTo({
                    top: containerPosition,
                    behavior: 'smooth'
                });
            }
        };
        </script>";
    }
?>

        <div id="container" class="container">
            <div class="grid wide">
                <div class="row app-container">
                    <div class="col l-2 m-0 c-0">
                        <div class="category">
                            <h3 class="category-heading">
                                <i class="fa-solid fa-list"></i>
                                Danh mục
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
                            <div class="filter-product">
                                <span class="filter-label">Sắp xếp theo</span>
                                <?php
                                    if(!isset($_GET['catId']) || $_GET['catId'] == NULL) {
                                        $cat0 = '0';
                                    } else {
                                        $cat0=$_GET['catId'];
                                    }
                                ?>
                                <button type="button" class="filter-button">
                                    <a href="?catId=<?php echo $cat0 ?>&sortby=productName&filter=asc&page=1" class="filter-link 
                                        <?php
                                        if(isset($_GET['sortby']) && isset($_GET['filter'])) {
                                            if($_GET['sortby'] == 'productName' && $_GET['filter'] == 'asc') {
                                            echo 'sort-selected';
                                            }
                                        } ?>">A -> Z</a>
                                </button>

                                <button type="button" class="filter-button">
                                    <a href="?catId=<?php echo $cat0 ?>&sortby=productName&filter=desc&page=1" class="filter-link 
                                        <?php 
                                        if(isset($_GET['sortby']) && isset($_GET['filter'])) {
                                            if($_GET['sortby'] == 'productName' && $_GET['filter'] == 'desc') {
                                            echo 'sort-selected';
                                            }
                                        } ?>
                                    ">Z -> A</a>
                                </button>

                                <button type="button" class="filter-button">
                                    <a href="?catId=<?php echo $cat0 ?>&sortby=productPrice&filter=asc&page=1" class="filter-link 
                                    <?php 
                                    if(isset($_GET['sortby']) && isset($_GET['filter'])) {
                                        if($_GET['sortby'] == 'productPrice' && $_GET['filter'] == 'asc') {
                                        echo 'sort-selected';
                                        }
                                    } ?>">Giá thấp</a>
                                </button>

                                <button type="button" class="filter-button">
                                    <a href="?catId=<?php echo $cat0 ?>&sortby=productPrice&filter=desc&page=1" class="filter-link 
                                    <?php 
                                    if(isset($_GET['sortby']) && isset($_GET['filter'])) {
                                        if($_GET['sortby'] == 'productPrice' && $_GET['filter'] == 'desc') {
                                        echo 'sort-selected';
                                        }
                                    } ?>">Giá cao</a>
                                </button>

                            </div>
                            <!-- SORT -->
                            <div class="row">
                                <?php
                                    if($proList) {
                                        while($result = $proList->fetch_assoc()) {
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
                                                <a title="<?php echo $result['productName'] ?>" href="preview.php?productId=<?php echo $result['productId'] ?>" class="product-title">
                                                    <?php
                                                    if($result['productStyle'] == 2) {
                                                        echo '<span class="new-product">NEW</span>';
                                                    }
                                                    ?>
                                                    <?php echo $result['productName'] ?>
                                                </a>
                                                <div class="tooltip">
                                                    <div class="tooltip-content"></div>
                                                </div>
                                            </h3>
                                            <div class="price-box">
                                                <div class="price-official"><?php echo number_format($result['productPrice'], 0, ',',',') ?><u>đ</u></div>
                                                <div class="price-informal"><?php if($result['productPrice'] != $result['productOldPrice']) {
                                                    echo number_format($result['productOldPrice'], 0, ',',',')."<u>đ</u>";
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
                                <script>
                                    const tooltips = document.querySelectorAll('.tooltip');

                                    tooltips.forEach(tooltip => {
                                        const tooltipContent = tooltip.querySelector('.tooltip-content');
                                        const trigger = tooltip.previousElementSibling;

                                        trigger.addEventListener('mouseover', () => {
                                        tooltip.classList.add('show');
                                        tooltipContent.textContent = trigger.getAttribute('title');
                                        });

                                        trigger.addEventListener('mouseout', () => {
                                        tooltip.classList.remove('show');
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if(!isset($_GET['catId']) || (isset($_GET['catId']) && $_GET['catId'] == 0)) {
                    if(!isset($_GET['btn-search'])) {
            ?>
            <ul class="pagination home-product__pagination">
                <li class="pagination-item">
                    <a href="<?php 
                        if(isset($_GET['page']) && !isset($_GET['sortby']) && !isset($_GET['filter'])) {
                            if($_GET['page'] != 1) {
                                echo "index.php?page=".($_GET['page'] - 1);
                            } else {
                                echo "";
                            }
                        } else if(isset($_GET['page']) && isset($_GET['sortby']) && isset($_GET['filter'])) {
                            if($_GET['page'] != 1) {
                                echo "index.php?catId=".$cat0."&sortby=".$_GET['sortby']."&filter=".$_GET['filter']."&page=".($_GET['page'] - 1);
                            } else {
                                echo "";
                            }
                        } else {
                            echo "";
                        }
                    ?>" class="pagination-item__link">
                        <i class="pagination-item__icon fas fa-angle-left"></i>
                    </a>
                </li>
                <?php
                    $getAllProd = $pro->show_product();
                    $prod_count = mysqli_num_rows($getAllProd);
                    $prodBtn = ceil($prod_count / 12);
                    for($i = 1; $i <= $prodBtn; $i++) {
                ?>
                <li class="pagination-item <?php 
                    if(isset($_GET['page'])) {
                        if($_GET['page'] == $i) {
                            echo "pagination-item--active";
                        }
                    } else {
                        if($i == 1) {
                            echo "pagination-item--active";
                        }
                    }
                ?>">
                    <a href="<?php
                        if(isset($_GET['sortby']) && isset($_GET['filter'])) {
                            echo "index.php?catId=".$cat0."&sortby=".$_GET['sortby']."&filter=".$_GET['filter']."&page=".$i;
                        } else {
                            echo "index.php?page=".$i ;
                        }
                    ?>" class="pagination-item__link"><?php echo $i ?></a>
                </li>

                <?php
                    }
                ?>

                <li class="pagination-item">
                    <a href="<?php 
                        if(isset($_GET['page']) && !isset($_GET['sortby']) && !isset($_GET['filter'])) {
                            if($_GET['page'] != $prodBtn) {
                                echo "index.php?page=".($_GET['page'] + 1);
                            } else {
                                echo "";
                            }
                        } else if(isset($_GET['page']) && isset($_GET['sortby']) && isset($_GET['filter'])) {
                            if($_GET['page'] != $prodBtn) {
                                echo "index.php?catId=".$cat0."&sortby=".$_GET['sortby']."&filter=".$_GET['filter']."&page=".($_GET['page'] + 1);
                            } else {
                                echo "";
                            }
                        } else {
                            echo "index.php?page=2";
                        }
                    ?>" class="pagination-item__link">
                        <i class="pagination-item__icon fas fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <?php
                    }
                }
            ?>
        </div>
        
        <script src="./js/slider.js"></script>


<?php
    include "footer.php";
?>