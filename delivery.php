<?php
    include "head.php";
    include "header.php";
?>

<?php
    if(isset($_GET['billId']) && isset($_GET['finish'])) {
        $id = $_GET['billId'];
        $confirm = $bill->confirm_bill($id);
    }
?>

<?php
    if(isset($_GET['billId']) && !isset($_GET['finish'])) {
        $id = $_GET['billId'];
        $cancel = $bill->cancel_bill($id);
    }
?>

<?php
    if(isset($_GET['buyagain'])) {
        $againList = $order->show_delivered($_GET['buyagain']);
        if($againList) {
            while($listPro = $againList->fetch_assoc()) {
                $proId = $listPro['productId'];
                $quantity = $listPro['quantity'];
                $color = $listPro['color'];
                $insertAgain = $cart->add_to_cart($proId, $quantity, $color);
            }
        }
        echo "<script>window.location = 'cart.php'</script>";
    }
?>

        <div class="delivery-container">
            <div class="delivery-main">
                <div class="delivering">
                    <div class="delivering-heading">
                        <h3>Đơn hàng đang giao</h3>
                    </div>

                    <div class="delivering-list">
                        <?php
                            $billList = $bill->show_bill_delivery(Session::get('user_id'));
                            if($billList) {
                                while($row = $billList->fetch_assoc()) {
                        ?>
                        <div class="delivering-item">
                            <?php
                                $orderList = $order->show_delivering($row['userId'], $row['date'], $row['time']);
                                if($orderList) {
                                    while($item = $orderList->fetch_assoc()) {
                            ?>
                            <div class="delivering-item-top">
                                <div class="delivering-item__img">
                                    <img src="./admin/uploads/<?php echo $item['image'] ?>" alt="">
                                </div>
    
                                <div class="delivering-content">
                                    <div class="delivering-info">
                                        <p class="delivering-name"><?php echo $item['productName'] ?></p>
                                        <span class="delivering-classify"><?php 
                                            if($item['color'] != 0) {
                                                echo $item['color'];
                                            }  else {
                                                echo "";
                                            }
                                        ?></span>
                                    </div>

                                    <div class="delivering-pay">
                                        <div class="payment-top">
                                            <span class="payment-price"><?php echo number_format($item['price'], 0, ',',',') ?><u>đ</u></span>x
                                            <span class="payment-amount"><?php echo $item['quantity'] ?></span>
                                        </div>

                                        <div class="payment-bottom">
                                            <p class="payment-total">
                                                Giá:
                                                <span class="payment-total-number"><?php echo number_format($item['price'] * $item['quantity'], 0, ',',',') ?><u>đ</u></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                    }
                                } 
                            ?>
                            
                            <div class="delivering-item-money">
                                <div class="delivering-money-box">
                                    <div class="money-box-left">
                                        <p class="money-box-sub">Tổng cộng:</p>
                                        <p class="money-box-sub">Giảm giá:</p>
                                        <p class="money-box-sub">Thành tiền:</p>
                                    </div>
                                    <div class="money-box-right">
                                        <p class="money-box-price"><?php echo number_format($row['sum'], 0, ',', ',') ?><u>đ</u></p>
                                        <p class="money-box-price"><?php echo number_format($row['discount'], 0, ',', ',') ?><u>đ</u></p>
                                        <p class="money-box-price"><?php echo number_format($row['total'], 0, ',', ',') ?><u>đ</u></p>
                                    </div>
                                </div>
                            </div>

                            <div class="delivering-item-bottom">
                                <div class="delivering-status">
                                    <?php
                                        if($row['status'] == 0) {
                                    ?>
                                        <i class="<?php echo "fa-regular fa-hourglass-half"?>"></i>
                                        <span>Đơn hàng đang được hệ thống xác nhận</span>
                                    <?php
                                        } else {
                                    ?>
                                        <i class="<?php echo "fa-solid fa-truck-fast"?> "></i>
                                        <span>Đang hàng đang trên đường giao tới bạn</span>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="delivering-action">
                                    <?php
                                        if($row['status'] != 0) {
                                    ?>
                                    <button type="button" class="delivering-contact">
                                        <a href="contact.php" class="delivering-contact-link">
                                            Liên hệ
                                        </a>
                                    </button>
    
                                    <button type="button" class="delivering-confirm">
                                        <a href="?billId=<?php echo $row['billId'] ?>&finish=yes" class="delivering-confirm-link">
                                            Đã nhận hàng
                                        </a>
                                    </button>

                                    <?php
                                        } else {
                                    ?>
                                    <button type="button" class="delivering-confirm">
                                    <a  data-id="<?php echo $row['billId'] ?>" onclick="showModal(this)" class="delivering-confirm-link">
                                        Hủy đơn hàng
                                    </a>
                                    </button>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            } else {
                                echo "<span style='font-weight: bold;' >Không có đơn hàng nào đang được giao</span>";
                            }
                        ?>
                    </div>
                </div>

                <div class="delivered">
                    <div class="delivered-heading">
                        <h3>Đơn hàng đã giao</h3>
                    </div>
                        
                    <div class="delivered-list">
                        <?php
                            $billFinish = $bill->show_bill_finish(Session::get('user_id'));
                            if($billFinish) {
                                while($row = $billFinish->fetch_assoc()) {
                        ?>
                        <div class="delivered-item">
                            <div class="delivered-item-date">
                                <p>Ngày mua: <?php echo $row['date'] ?></p>
                            </div>
                            <?php
                                $orderFinish = $order->show_delivered($row['billId']);
                                if($orderFinish) {
                                    while($item = $orderFinish->fetch_assoc()) {
                            ?>
                            <div class="delivered-item-top">
                                <div class="delivered-item__img">
                                    <img src="./admin/uploads/<?php echo $item['image'] ?>" alt="">
                                </div>
    
                                <div class="delivered-content">
                                    <div class="delivered-info">
                                        <p class="delivered-name"><?php echo $item['productName'] ?></p>
                                        <span class="delivered-classify"><?php 
                                            if($item['color'] != 0) {
                                                echo $item['color'];
                                            }  else {
                                                echo "";
                                            }
                                        ?></span>
                                    </div>

                                    <div class="delivered-pay">
                                        <div class="payment-top">
                                            <span class="payment-price"><?php echo number_format($item['price'], 0, ',',',') ?><u>đ</u></span>x
                                            <span class="payment-amount"><?php echo $item['quantity'] ?></span>
                                        </div>

                                        <div class="payment-bottom">
                                            <p class="payment-total">
                                                Giá:
                                                <span class="payment-total-number"><?php echo number_format($item['price'] * $item['quantity'], 0, ',',',') ?><u>đ</u></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                    }
                                }
                            ?>

                            <div class="delivering-item-money">
                                <div class="delivering-money-box">
                                    <div class="money-box-left">
                                        <p class="money-box-sub">Tổng cộng:</p>
                                        <p class="money-box-sub">Giảm giá:</p>
                                        <p class="money-box-sub">Thành tiền:</p>
                                    </div>
                                    <div class="money-box-right">
                                        <p class="money-box-price"><?php echo number_format($row['sum'], 0, ',', ',') ?><u>đ</u></p>
                                        <p class="money-box-price"><?php echo number_format($row['discount'], 0, ',', ',') ?><u>đ</u></p>
                                        <p class="money-box-price"><?php echo number_format($row['total'], 0, ',', ',') ?><u>đ</u></p>
                                    </div>
                                </div>
                            </div>

                            <div class="delivered-item-bottom">
                                <div class="delivered-status">
                                    <i class="fa-solid fa-truck-fast"></i>
                                    <span>Giao hàng thành công</span>
                                </div>
                                <div class="delivered-action">
                                    <button class="buy-again">
                                        <a href="?buyagain=<?php echo $row['billId'] ?>" class="buy-again-link">
                                            Mua lại
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php
                                }
                            }else {
                                echo "<span style='font-weight: bold;' >Không có đơn hàng nào đã được giao</span>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal hide">
            <div class="modal__inner">
                <div class="modal__header">
                    <p>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Cảnh báo
                    </p>
                    <i class="fas fa-times"></i>
                </div>
                <div class="modal__body">
                    <h2>Chương trình này sẽ bị Xóa</h2>
                    <p>Bạn có muốn tiếp tục không?</p>
                </div>
                <div class="modal__footer">
                    <a class="submit-action">Xác nhận</a>
                    <button>Close</button>
                </div>
            </div>
        </div>

        <script>
            var modal = document.querySelector('.modal');
            var iconClose = document.querySelector('.modal__header>i');
            var btnClose = document.querySelector('.modal__footer button');
            var submitBtn = document.querySelector('.submit-action');
            function toggleModal() {
                modal.classList.toggle('hide');
            }
            btnClose.onclick = toggleModal;
            iconClose.onclick = toggleModal;
            modal.addEventListener('click', function(e) {
                if(e.target == e.currentTarget) {
                    toggleModal();
                }
            });
            function showModal(x) {
                toggleModal();
                var id = x.getAttribute('data-id');
                submitBtn.href = `?billId=${id}`;
            }
        </script>

        <div id="toasts">
            </div>

            <script>
                const toasts = document.querySelector('#toasts');
                    var data = <?php if(isset($confirm)) {echo $confirm;} else if(isset($cancel)) {echo $cancel;} else {echo "undefined";}?>;
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
<?php
    include "footer.php";
?>
