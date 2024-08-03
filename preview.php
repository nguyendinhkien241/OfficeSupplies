<?php
    include "head.php";
    include "header.php";
?>

<?php
    if(!isset($_GET['productId']) || $_GET['productId'] == NULL) {
        echo "<script>window.location = 'index.php'</script>";
    } else {
        $id = $_GET['productId'];
    }
    $proDetail = $pro->getProductbyId($id);
    $result = $proDetail->fetch_assoc();
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cartAdd'])) {
        $quantity = $_POST['quantity'];
        $color = 0;
        if(isset($_POST['option-color'])) {
            $color = $_POST['option-color'];
        }
        $addToCart = $cart->add_to_cart($id, $quantity, $color);
        
    }
?>
        <div class="preview-container">
            <div class="preview-box">
                <div class="preview-main">
                    <div class="preview-form">
                        <div class="preview-left">
                            <img src="./admin/uploads/<?php echo $result['productImage'] ?>" alt="" class="preview-img">
                        </div>
    
                        <form action="" method="POST" class="preview-right">
                            <div class="preview-header">
                                <h3 class="preview-name-product"><?php echo $result['productName'] ?></h3>
    
                                <div class="preview-subtitle">
                                    <div class="subtitle-top">
                                        Mã sản phẩm: 
                                        <span class="subtitle-content id-product"><?php echo $result['productId'] ?></span>
                                    </div>
        
                                    <div class="subtitle-bottom">
                                        <div class="subtitle-child">
                                            Loại sản phẩm:
                                            <span class="subtitle-content ko-product"><?php 
                                            $catItem = $cat->get_category($result['catId']);
                                            $catName = $catItem->fetch_assoc();
                                            echo $catName['category_name'];
                                            ?></span>
                                        </div>
                                        <div class="subtitle-partition"> | </div>
                                        <div class="subtitle-child">
                                            Tình trạng:
                                            <?php
                                                if($result['productAmount'] > 0) {
                                            ?>
                                            <span class="subtitle-content state-product">Còn hàng</span>
                                            <?php
                                                } else {
                                            ?>
                                            <span style="color: red;" class="subtitle-content state-product">Hết hàng</span>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="preview-content">
                                <div class="preview-parameter">
                                    <div class="preview-price">
                                        <span class="preview-price-number"><?php echo number_format($result['productOldPrice'], 0, ',', ',') ?><u>đ</u></span>
                                        <span class="preview-old-price"><?php if($result['productPrice'] != $result['productOldPrice']) {
                                                    echo number_format($result['productOldPrice'], 0, ',', ',')."<u>đ</u>";
                                                } ?></span>
                                    </div>
    
                                    <?php
                                        if($result['productColor'] == 1) {
                                            echo "<div class='preview-classify'>
                                            <h3 class='classify-heading'>Màu sắc: </h3>
                                            <div class='classify-options'>
                                                <div class='classify-item'>
                                                    <input type='radio' value='Xanh' id='option-0' name='option-color'> 
                                                    <label for='option-0' style='background-color: #007fff;'></label>
                                                </div>
        
                                                <div class='classify-item'>
                                                    <input type='radio' value='Đỏ' id='option-1' name='option-color'>
                                                    <label for='option-1' style='background-color: #dd0b0b;'></label>
                                                </div>
        
                                                <div class='classify-item'>
                                                    <input type='radio' value='Đen' id='option-2' name='option-color'>
                                                    <label for='option-2' style='background-color: #000000;'></label>
                                                </div>
                                            </div>
                                        </div>";
                                        }
                                    ?>
    
                                    <div class="preview-quantity">
                                        <h3 class="preview-quantity-heading">Số lượng:</h3>
                                        <div class="preview-quantity-control">
                                            <button type="button" class="preview-sub-qtt">-</button>
                                            <input type="text" value="1" name="quantity" class="preview-quantity-input">
                                            <button type="button" class="preview-add-qtt">+</button>
                                        </div>
                                        <script>
                                            const sub = document.querySelector('.preview-sub-qtt');
                                            const add = document.querySelector('.preview-add-qtt');
                                            const quantity = document.querySelector('.preview-quantity-input');

                                            sub.addEventListener('click', function() {
                                                var value = parseInt(quantity.value);
                                                if(value > 1) {
                                                    quantity.value = value - 1;
                                                }
                                            })

                                            add.addEventListener('click', function() {
                                                var value = parseInt(quantity.value);
                                                quantity.value = value + 1;
                                            })
                                        </script>
                                    </div>
                                </div>
    
                                <div class="preview-benefit">
                                    <div class="benefit-line">
                                        <img src="./images/icons/delivery-truck_2769339.png" alt="">
                                        <p class="benefit-text">Giao hàng toàn quốc</p>
                                    </div>
    
                                    <div class="benefit-line">
                                        <img src="./images/icons/star_1828970.png" alt="">
                                        <p class="benefit-text">Sản phẩm chính hãng</p>
                                    </div>
    
                                    <div class="benefit-line">
                                        <img src="./images/icons/gift_548427.png" alt="">
                                        <p class="benefit-text">Tích điểm đổi quà</p>
                                    </div>
    
                                    <div class="benefit-line">
                                        <img src="./images/icons/coupon.png" alt="">
                                        <p class="benefit-text">Nhiều ưu đãi, khuyễn mãi</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if($result['productAmount'] > 0) {
                            ?>
                            <button type="submit" name="cartAdd" class="preview-action">
                                <a class="preview-action-link">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    Thêm vào giỏ
                                </a>
                            </button>

                            <?php
                                }
                            ?>
                        </form>
                    </div>
                </div>
    
                <div class="preview-bottom">
                    <div class="preview-info">
                        <div class="preview-info-heading">
                            <h3>Mô tả sản phẩm</h3>
                        </div>
    
                        <div class="preview-desc">
                            <p>
                                <?php echo $result['productDesc'] ?>
                            </p>
                        </div>
    
                        <div class="preview-properties">
                            <p class="properties-heading">Đặc tính sản phẩm:</p>
                            <ul class="properties-list">
                                <?php
                                    $properties = explode("- ", trim($result['productPro']));
                                    for($i = 1; $i < count($properties); $i++) {
                                        echo "<li class='properties-text'>".$properties[$i]."</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="toasts">
            </div>

            <script>
                const toasts = document.querySelector('#toasts');
                var data = <?php if(isset($addToCart)) {echo $addToCart;}?>;
                let templateInner;
                if (data.status === 'success') {
                    templateInner = `<i class="fa-solid fa-circle-check"></i>
                    <span class="message">${data.message}</span>`
                } else {
                    templateInner = `<i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="message">${data.message}</span>`
                }
                var toast = document.createElement('div');
                toast.classList.add('toast');
                toast.classList.add(data.status);
                toast.innerHTML = `
                ${templateInner}
                <div class="countdown"></div>
                `
                toasts.appendChild(toast);
                setTimeout(function() {
                    toast.style.animation = 'slideHide 2s ease-in-out forwards';
                },3500);
                setTimeout(function() {
                    toast.remove();
                }, 5500);
                if(data.status === 'success') {
                    delete data;
                    setTimeout(() => {
                        window.location.href = 'index.php?catId=0';
                    }, 5500);
                }
                delete data;
            </script>
        </div>

        

<?php
    include "footer.php";
?>