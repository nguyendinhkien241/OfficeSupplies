<?php
    include "head.php";
    include "header.php";
?>

<?php
    $value = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-discount'])) {
        $text = $_POST['code'];
        $value = $dis->check_code($totalHeaderValue,$text); 
    }
?>  

<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'  && !isset($_POST['submit-discount'])) {
        $insertBill = $bill->insert_bill($_POST, Session::get('user_id'), $totalHeaderValue, Session::get('discount'));
        $insertOrder = $order->insert_order(Session::get('user_id'));
    }
?>

        <div class="payment-container">
            <div class="payment-main">
                <div class="payment-info">
                    <h3 class="payment-info__heading">Thanh toán</h3>
                    <form method="POST" action="" class="payment-form" id="payment-form">
                        <?php
                            if(Session::get('user_login')) {
                                $userInfo = $user->getInfo(Session::get('user_id'));
                                if($userInfo) {
                                    $infoRow = $userInfo->fetch_assoc();
                        ?>
                        <h3 class="payment-form__heading">Thông tin giao hàng</h3>
                        <div class="payment-box">
                            <div class="payment-form-group pm-form-gr">
                                <input type="text" id="full-name" name="full-name-ship" value="<?php echo $infoRow['fullName'] ?>" placeholder="Họ và tên">
                                <span class="user-form-message"></span>
                            </div>
                            <div class="payment-form-double">
                                <div class="pm-form-gr">
                                    <input type="email" id="email" name="email-ship" value="<?php echo $infoRow['userEmail'] ?>" placeholder="Email">
                                    <span class="user-form-message"></span>
                                </div>
                                <div class="pm-form-gr">
                                    <input type="text" id="phone" name="phone-ship" value="<?php echo $infoRow['userPhone'] ?>" placeholder="Số điện thoại">
                                    <span class="user-form-message"></span>
                                </div>
                            </div>
                            <div class="payment-form-group pm-form-gr">
                                <input type="text" id="address" name="address-ship" value="<?php echo $infoRow['userAddress'] ?>" placeholder="Địa chỉ">
                                <span class="user-form-message"></span>
                            </div>
                        </div>

                        <div class="payment-submit">
                            <div class="payment-method">
                                <p class="payment-method-title">Phương thức thanh toán</p>
                                <p class="payment-method-content">Thanh toán khi nhận hàng</p>
                            </div>
                            <button type="submit" name="info-submit" class="payment-btn">
                                <a class="payment-submit-link">Xác nhận thanh toán đơn hàng</a>
                            </button>
                        </div>
                        <?php
                                }
                            } 
                        ?>
                    </form>

                    <script src="./js/validate3.js"></script>
                    <script>
                        Validator({
                            form: '#payment-form',
                            errorSelector: '.user-form-message',
                            formGroupSelector: '.pm-form-gr',
                            rules: [
                                Validator.isRequired('#full-name'),
                                Validator.isRequired('#address'),
                                Validator.isPhone('#phone', 'Vui lòng nhập số điện thoại'),
                                Validator.isEmail('#email', 'Vui lòng nhập email của bạn'),
                            ],
                            
                        });
                    </script>
                </div>

                <div class="payment-package">
                    <div class="package-list">
                        <?php
                            $infoCart = $cart->show_cart();
                            if($infoCart) {
                                while($userCart = $infoCart->fetch_assoc()) {
                        ?>
                        <div class="package-item">
                            <div class="package-img">
                                <img src="./admin/uploads/<?php echo $userCart['productImage'] ?>" alt="">
                                <div class="package-qtt"><?php echo $userCart['quantity'] ?></div>
                            </div>
                            <div class="package-info">
                                <p class="package-name">
                                    <?php echo $userCart['productName'] ?>
                                </p>
                                <p class="package-classify">
                                    <?php if($userCart['color'] != 0) {
                                        echo $userCart['color'];
                                    } else {
                                        echo "";
                                    } ?>
                                </p>
                            </div>
                            <div class="package-price">
                                <span class="package-price-number"><?php echo number_format($userCart['price'], 0, ',', ',') ?><u>đ</u></span>
                            </div>
                        </div>

                        <?php
                                    }
                                }
                            
                        ?>
                    </div>

                    <form action="" method="POST" class="package-discount">
                        <div class="discount-box">
                            <input value="<?php if(!empty($value)) {
                                echo $value['code'];
                            } else {
                                echo "";
                            }?>" class="discount-input" type="text" name="code" placeholder="Mã giảm giá">
                            <button type="submit" name="submit-discount" class="discount-btn">
                                <a class="discount-btn-link">Sử dụng</a>
                            </button>
                        </div>
                        <span   <?php if(!empty($value)) {
                                    if($value['value'] != 0) {
                                        echo "style='color: green';";
                                    }
                                } ?>>
                            <?php if(!empty($value)) {
                                echo $value['message'];
                            } else {
                                echo "";
                            }?>
                        </span>
                    </form>

                    <div class="package-pay">
                        <div class="price-temporary">
                            <span>Tạm tính</span>
                            <p class="price-tem-number"><?php echo number_format($totalHeaderValue, 0, ',', ',') ?><u>đ</u></p>
                        </div>

                        <div class="package-haulage">
                            <span>Giảm giá</span>
                            <p class="haulage-number"><?php if(!empty($value)) {
                                echo number_format($value['value'], 0, ',', ',');
                            } else {
                                echo 0;
                            }?><u>đ</u></p>
                        </div>
                    </div>

                    <div class="total-money">
                        <span>Tổng cộng</span>
                        <div class="total-box">
                            <span class="unit-money">VNĐ</span>
                            <p class="total-number"><?php if(!empty($value)) {
                                    if($value['value'] != 0) {
                                        echo number_format($totalHeaderValue - $value['value'], 0, ',', ',');
                                    } else {
                                        echo number_format($totalHeaderValue, 0, ',', ',');
                                    }
                                } else {
                                    echo number_format($totalHeaderValue, 0, ',', ',');
                                }?><u>đ</u></p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="toasts">
            </div>

            <script>
                const toasts = document.querySelector('#toasts');
                    var data = <?php if(isset($insertBill)) {echo $insertBill;} else {echo "undefined";}?>;
                    let templateInner;
                    if(data) {
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
                                window.location.href = 'delivery.php';
                            }, 5500);
                        }
                        delete data;
                    }
            </script>
        </div>
<?php
    include "footer.php";
?>