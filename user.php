<?php
    include "head.php";
    include "header.php";
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(Session::get('user_login')) {
            $updateAccount = $user->update_account(Session::get('user_id'), $_POST);
        }
    }
?>
        <div class="user-container">
            <div class="user-main">
                <div class="user-top">
                    <a href="user.php" class="user-info-heading user-info-choose">Thông tin tài khoản</a>
                    <a href="package.php" class="user-bought-heading">Đơn hàng đã mua</a>
                    <a href="changePw.php" class="user-cp-heading">Đổi mật khẩu</a>
                </div>

                <?php
                    if(Session::get('user_login')) {
                        $userInfo = $user->getInfo(Session::get('user_id'));
                        if($userInfo) {
                            $info = $userInfo->fetch_assoc();
                ?>

                <form action="" method="POST" class="user-form" id="user-form">
                    <div class="user-box">
                        <div class="user-group">
                            <label for="full-name">Họ và tên <span>*</span>:</label>
                            <input type="text" name="full-name" id="full-name" value="<?php echo $info['fullName'] ?>" >
                            <span class="user-form-message"></span>

                        </div>
                        <div class="user-group">
                            <label for="user-email">Email <span>*</span>:</label>
                            <input type="email" name="user-email" id="user-email" value="<?php echo $info['userEmail'] ?>" >
                            <span class="user-form-message"></span>

                        </div>
                        <div class="user-group">
                            <label for="user-phone">Số điện thoại <span>*</span>:</label>
                            <input type="text" name="user-phone" id="user-phone" value="<?php echo $info['userPhone'] ?>" >
                            <span class="user-form-message"></span>
                        </div>
                        <div class="user-group">
                            <label for="user-address">Địa chỉ <span>*</span>:</label>
                            <input type="text" name="user-address" id="user-address" value="<?php echo $info['userAddress'] ?>" >
                            <span class="user-form-message"></span>
                        </div>
                    </div>

                    <button type="submit" class="user-form-submit">Cập nhật thông tin</button>
                </form>

                <script src="./js/validate3.js"></script>
                <script>
                    Validator({
                        form: '#user-form',
                        errorSelector: '.user-form-message',
                        formGroupSelector: '.user-group',
                        rules: [
                            Validator.isRequired('#full-name'),
                            Validator.isRequired('#user-address'),
                            Validator.isPhone('#user-phone', 'Vui lòng nhập số điện thoại'),
                            Validator.isEmail('#user-email', 'Vui lòng nhập email của bạn'),
                        ],
                        
                    });
                </script>

                <?php
                    }
                }
                ?>
            </div>

            <div id="toasts">
            </div>

            <script>
                const toasts = document.querySelector('#toasts');
                    var data = <?php if(isset($updateAccount)) {echo $updateAccount;} else {echo "undefined";}?>;
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
                                window.location.href = 'user.php';
                            }, 5500);
                        }
                        delete data;
                    }
            </script>
        </div>
<?php
    include "footer.php";
?>