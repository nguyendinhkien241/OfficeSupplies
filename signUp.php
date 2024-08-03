<?php
    include "./head.php";
    include "./header.php";
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $creatAccount = $user->creat_account($_POST); 
    }
?>

        <div class="sign-up-container">
            <form action="signUp.php" method="POST" class="form-sign-up" id="form-1">
                <h3 class="heading-sign-up">Thông tin đăng ký</h3>
                <p class="desc"></p>

                <div class="sign-up-top">
                    <div class="form-group">
                        <input id="user-name" type="text" class="form-control" name="user-name" placeholder="Tên đăng nhập">
                        <span class="form-message"></span>
                    </div>
                </div>

                <div class="sign-up-group">
                    <div class="form-group">
                        <input id="full-name" type="text" class="form-control" name="full-name" placeholder="Họ và tên">
                        <span class="form-message"></span>
                    </div>
            
                    <div class="form-group">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                        <span class="form-message"></span>
                    </div>
    
                    <div class="form-group">
                        <input id="address" type="text" class="form-control" name="address" placeholder="Địa chỉ">
                        <span class="form-message"></span>
                    </div>
    
                    <div class="form-group">
                        <input id="phone" type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                        <span class="form-message"></span>
                    </div>
            
                    <div class="form-group">
                        <div class="password-setting">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                            <i class="fa-solid fa-eye-slash sP-su" onclick="showPassword(this)"></i>
                        </div>
                        <span class="form-message"></span>
                    </div>
            
                    <div class="form-group">
                        <div class="password-setting">
                            <input id="password-confirmation" type="password" class="form-control" name="password-confirmation" placeholder="Nhập lại mật khẩu">
                            <i class="fa-solid fa-eye-slash sP-su" onclick="showPassword(this)"></i>
                        </div>
                        <span class="form-message"></span>
                    </div>
                </div>
        
                <button name="btn-submit" class="form-submit" type="submit">Đăng ký</button>

                <div class="direct-sign-in">
                    Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
                </div>
            </form>
            <script src="./js/validate3.js"></script>
            <script>
                Validator({
                    form: '#form-1',
                    errorSelector: '.form-message',
                    formGroupSelector: '.form-group',
                    rules: [
                        Validator.isRequired('#full-name'),
                        Validator.isRequired('#user-name'),
                        Validator.checkSpace('#user-name'),
                        Validator.checkSpace('#password'),
                        Validator.isRequired('#address'),
                        Validator.isPhone('#phone', 'Vui lòng nhập số điện thoại'),
                        Validator.lengthPhone('#phone'),
                        Validator.isEmail('#email', 'Vui lòng nhập email của bạn'),
                        Validator.minLength('#password', 6, 'Vui lòng nhập mật khẩu'),
                        Validator.isConfirmed('#password-confirmation', function() {
                            return document.querySelector('#form-1 #password').value;
                        }, 'Vui lòng nhập trường này'),
                    ],
                    
                });
            </script>

        <script>
            function showPassword(x) {
                const password = x.parentElement.children[0];
                const iconShow = x;
                
                if(password.type === 'password') {
                    password.type = 'text';
                    iconShow.classList.remove('fa-eye-slash');
                    iconShow.classList.add('fa-eye')
                } else {
                    password.type = 'password';
                    iconShow.classList.remove('fa-eye')
                    iconShow.classList.add('fa-eye-slash');
                }
                
            };
        </script>
        </div>
        

        <div id="toasts">
        </div>

        <script>
            const toasts = document.querySelector('#toasts');
            var data = <?php if(isset($creatAccount)) {echo $creatAccount;} else {echo "undefined";}?>;
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
                        window.location.href = 'login.php';
                    }, 5500);
                }
                delete data;
            }
        </script>
<?php
    include "footer.php";
?>