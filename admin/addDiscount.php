<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/discount.php";
?>

<?php
    $dis = new discount();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $insertDiscount = $dis->insert_discount($_POST);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard discountAdd">
                            <h3 class="discountAdd-heading">Thêm chương trình ưu đãi</h3>
                            <div class="discountAdd-main">
                                <form action="" method="POST" class="dis-form">
                                    <div class="dis-form-col">
                                        <div class="dis-form-group">
                                            <label for="dis-code">Mã giảm giá</label>
                                            <input type="text" name="dis-code" id="dis-code">
                                        </div>
                                        <div class="dis-form-group">
                                            <label for="date-of-begin">Ngày bắt đầu</label>
                                            <input type="date" name="date-of-begin" id="date-of-begin">
                                        </div>
                                    </div>

                                    <div class="dis-form-col">
                                        <div class="dis-form-group">
                                            <label for="dis-value">Số tiền giảm</label>
                                            <div class="dis-form-control">
                                                <input type="text" name="dis-value" id="dis-value">
                                                <span><i>VNĐ</i></span>
                                            </div>
                                        </div>
                                        <div class="dis-form-group">
                                            <label for="date-of-use">Ngày hết hạn</label>
                                            <input type="date" name="date-of-use" id="date-of-use">
                                        </div>
                                    </div>

                                    <button name="submit" class="dis-form-submit">Thêm mã</button>
                                </form>
                            </div>
                        </div>

                        <div id="toasts">
                        </div>

                        <script>
                            const toasts = document.querySelector('#toasts');
                            var data = <?php if(isset($insertDiscount)) {echo $insertDiscount;} else {echo "undefined";}?>;
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
                                        window.location.href = 'discountList.php';
                                    }, 5500);
                                }
                                delete data;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>