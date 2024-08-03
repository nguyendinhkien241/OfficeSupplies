
<?php
    include "head.php";
    include "header.php";
?>

<?php
    if(isset($_GET['cartId']) && isset($_GET['repair'])) {
        $id = $_GET['cartId'];
        $action = $_GET['repair'];

        $updateQuantity = $cart->update_quantity($id, $action);
        if($updateQuantity) {
            echo "<script>window.location.href = 'cart.php'</script>";

        }
    } 
?>

        <div class="cart-container">
            <div class="cart-main">
                <form action="" class="form-cart">
                    <h2 class="heading-form-cart">
                        Giỏ hàng
                    </h2>

                    <div class="cart-content">
                        <ul class="list-product-cart">
                            <?php
                                $cartList = $cart->show_cart();
                                if($row_count['row_count'] == 0) {
                                    echo "<span style='font-size: 18px; font-weight: bold;'>Không có sản phẩm nào trong giỏ hàng</span>";
                                }
                                $total = $cart->sum_cart()->fetch_assoc();
                                $totalValue = $total['total_value'];
                                if($cartList) {
                                    while($result = $cartList->fetch_assoc()) {
                            ?>
                            <li class="product-cart">
                                <div class="product-cart-img">
                                    <img src="./admin/uploads/<?php echo $result['productImage'] ?>" alt="">
                                </div>

                                <div class="product-cart-info">
                                    <div class="product-cart-name">
                                        <p><?php echo $result['productName'] ?></p>
                                        <p class="kind-of-product"><?php if($result['color'] != 0) {echo $result['color'];} ?></p>
                                    </div>

                                    <div class="product-cart-price">
                                        <span><?php echo number_format($result['price'], 0, ',', ',') ?><u>đ</u></span>
                                    </div>

                                    <div class="product-cart-quantity">
                                        <button type="button" class="sub-btn-product">
                                            <a href="?cartId=<?php echo $result['cartId'] ?>&repair=sub" class="sub-action-link">
                                                <i class="fa-solid fa-minus"></i>
                                            </a>
                                        </button>
                                        <input class="ip-quantity-product" type="text" value="<?php echo $result['quantity'] ?>" readonly name="quantity-product" >
                                        <button type="button" class="add-btn-product">
                                            <a href="?cartId=<?php echo $result['cartId'] ?>&repair=add" class="add-action-link">
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                        </button>
                                    </div>
                                </div>

                                <a class="delete-product-cart" href="?cartId=<?php echo $result['cartId'] ?>">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </li>

                            <?php
                                }
                            }
                            ?>
                        </ul>

                        <div class="box-price-product">
                            <div class="wrap-price-product">
                                <div class="sum-price">
                                    <span class="title-price">Tổng tiền</span>
                                    <span class="value-price"><?php echo number_format($totalValue, 0, ',', ',') ?><u>đ</u></span>
                                </div>
    
                                <div class="confirm-order">
                                    <button class="btn-confirm">
                                        <a <?php
                                            if(Session::get('user_login')) {
                                                if($row_count['row_count'] != 0) {
                                                    echo "href='payment.php'";
                                                }
                                            } else {
                                                echo "href='login.php'";
                                            }
                                        ?>class="process-order-link">
                                            Xác nhận đặt hàng
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="noti-free-ship">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="noti-fs__text">Miễn phí vận chuyển cho đơn hàng từ 200,000<u>đ</u></span>
                    </div>

                    <div class="footer-product-cart">
                        <div class="print-bill">
                            <input type="checkbox" value="yes" name="check-print-bill" class="check-print-bill">
                            <label for="check-print-bill">Xuất hóa đơn đơn hàng</label>
                        </div>

                        <div class="note-product">
                            <label for="note-order">Ghi chú cho đơn hàng</label>
                            <textarea name="note-order" id="note-order" cols="30" rows="8"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
<?php
    include "footer.php";
?>
