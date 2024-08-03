<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/discount.php";
?>

<?php
    if(!isset($_GET['discountId']) || $_GET['discountId'] == NULL) {
        echo "<script>window.location = 'discountList.php'</script>";
    } else {
        $id = $_GET['discountId'];
    }
    $dis = new discount();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $updatetDiscount = $dis->update_discount($_POST, $id);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard discountAdd">
                            <h3 class="discountAdd-heading">Thêm chương trình ưu đãi</h3>
                            <div class="discountAdd-main">
                                <?php
                                    $getdis = $dis->getDiscountbyId($id);
                                    if($getdis) {
                                        $row = $getdis->fetch_assoc();
                                    }
                                ?>
                                <form action="" method="POST" class="dis-form">
                                    <div class="dis-form-col">
                                        <div class="dis-form-group">
                                            <label for="dis-code">Mã giảm giá</label>
                                            <input type="text" name="dis-code" id="dis-code" value="<?php echo $row['discountName'] ?>">
                                        </div>
                                        <div class="dis-form-group">
                                            <label for="date-of-begin">Ngày bắt đầu</label>
                                            <input type="date" name="date-of-begin" id="date-of-begin" value="<?php echo $row['discountStart'] ?>">
                                        </div>
                                    </div>

                                    <div class="dis-form-col">
                                        <div class="dis-form-group">
                                            <label for="dis-value">Số tiền giảm</label>
                                            <div class="dis-form-control">
                                                <input type="text" name="dis-value" id="dis-value" value="<?php echo $row['discountValue'] ?>">
                                                <span><i>VNĐ</i></span>
                                            </div>
                                        </div>
                                        <div class="dis-form-group">
                                            <label for="date-of-use">Ngày hết hạn</label>
                                            <input type="date" name="date-of-use" id="date-of-use" value="<?php echo $row['discountEnd'] ?>">
                                        </div>
                                    </div>

                                    <button name="submit" class="dis-form-submit">Cập nhật</button>
                                </form>
                            </div>
                        </div>

                        <div id="toasts">
                        </div>

                        <script>
                            const toasts = document.querySelector('#toasts');
                            var data = <?php if(isset($updatetDiscount)) {echo $updatetDiscount;}?>;
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
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>