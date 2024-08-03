<?php
    include "head.php";
    include "header.php";
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(Session::get('user_login')) {
            $updatePw = $user->update_pw(Session::get('user_id'), $_POST);
        }
    }
?>
        <div class="user-container">
            <div class="user-main">
                <div class="user-top">
                    <a href="user.php" class="user-info-heading">Thông tin tài khoản</a>
                    <a href="package.php" class="user-bought-heading">Đơn hàng đã mua</a>
                    <a href="changePw.php" class="user-cp-heading user-cp-choose">Đổi mật khẩu</a>
                </div>

                <form action="" method="POST" class="user-form" id="user-form">
                    <div class="user-box">
                        <div class="user-group">
                            <label for="current-pw">Mật khẩu hiện tại <span>*</span>:</label>
                            <div class="user-control">
                                <input type="password" name="current-pw" id="current-pw" >
                                <div class="user-show-pw"></div>
                            </div>
                            <span class="user-form-message"></span>
                        </div>
                        <div class="user-group">
                            <label for="new-pw">Mật khẩu mới <span>*</span>:</label>
                            <div class="user-control">
                                <input type="password"  name="new-pw" id="new-pw">
                                <div class="user-show-pw"></div>
                            </div>
                            <span class="user-form-message"></span>
                        </div>
                        <div class="user-group">
                            <label for="confirm-pw">Nhập lại mật khẩu <span>*</span>:</label>
                            <div class="user-control">
                                <input type="password"  name="confirm-pw" id="confirm-pw">
                                <div class="user-show-pw"></div>
                            </div>
                            <span class="user-form-message"></span>
                        </div>
                    </div>

                    <button class="user-form-submit">Xác nhận thay đổi</button>
                    
                </form>
                <script>
                    function showPw(x) {
                        console.log("xxx");
                        const showPassword = x.parentElement.querySelector('.user-show-pw');
                        const password = x;
                        showPassword.innerHTML = `
                            <i class="icon-show fa-solid fa-eye-slash"></i>
                        `;
                        if(password.value.length === 0) {
                            showPassword.innerHTML = ``;
                        } else {
                            const iconShow = showPassword.querySelector('.icon-show');
                            if(iconShow) {
                                iconShow.addEventListener('click', function() {
                                    if(password.type === 'password') {
                                        password.type = 'text';
                                        iconShow.classList.remove('fa-eye-slash');
                                        iconShow.classList.add('fa-eye')
                                    } else {
                                        password.type = 'password';
                                        iconShow.classList.remove('fa-eye')
                                        iconShow.classList.add('fa-eye-slash');
                                    }
                                }) 
                            }
                            
                        }
                    }

                    document.querySelectorAll('input[type="password"]').forEach(function (input) {
                        input.addEventListener('input', function () {
                            showPw(input);
                        });
                    });
                </script>
                <script src="./js/validate3.js"></script>
                <script>
                    Validator({
                        form: '#user-form',
                        errorSelector: '.user-form-message',
                        formGroupSelector: '.user-group',
                        rules: [
                            Validator.isRequired('#current-pw'),
                            Validator.isRequired('#new-pw'),
                            Validator.isRequired('#confirm-pw'),
                            Validator.checkSpace('#current-pw'),
                            Validator.checkSpace('#new-pw'),
                            Validator.checkSpace('#confirm-pw'),
                            Validator.minLength('#current-pw', 6, 'Vui lòng nhập mật khẩu'),
                            Validator.minLength('#new-pw', 6, 'Vui lòng nhập mật khẩu'),
                            Validator.isConfirmed('#confirm-pw', function() {
                                return document.querySelector('#user-form #new-pw').value;
                            }, 'Vui lòng nhập trường này'),
                        ],
                        
                    });
                </script>

                
            </div>

            <div id="toasts">
            </div>

            <script>
                const toasts = document.querySelector('#toasts');
                    var data = <?php if(isset($updatePw)) {echo $updatePw;} else {echo "undefined";}?>;
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
                                window.location.href = 'changePw.php';
                            }, 5500);
                        }
                        delete data;
                    }
            </script>
        </div>
        
<?php
    include "footer.php";
?>