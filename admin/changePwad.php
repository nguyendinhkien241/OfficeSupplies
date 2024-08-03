
<?php
    include_once "./inc/head.php";
    include_once "./inc/header.php";
    include_once "./inc/sidebar.php";
?>

<?php
    include_once "../classes/admin.php";
    $admin = new admin();
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updatePw = $admin->update_pw($_POST);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard change-pwad">
                            <h3 class="pwad-heading">Thay đổi mật khẩu</h3>
                            <div class="pwad-form">
                                <form action="" method="POST" id="change-pass-ad">
                                    <div class="pwad-group">
                                        <label for="old-pw">Mật khẩu cũ</label>
                                        <div class="form-setting">
                                            <input type="password" id="old-pw" name="old-pw" class="form-control">
                                            <i class="fa-solid fa-eye-slash sP-su" onclick="showPassword(this)"></i>
                                            <span class="pwad-message"></span>
                                        </div>
                                    </div>
    
                                    <div class="pwad-group">
                                        <label for="old-pw">Mật khẩu mới</label>
                                        <div class="form-setting">
                                            <input type="password" id="new-pw" name="new-pw" class="form-control">
                                            <span class="pwad-message"></span>
                                            <i class="fa-solid fa-eye-slash sP-su" onclick="showPassword(this)"></i>
                                        </div>
                                    </div>
    
                                    <div class="pwad-group">
                                        <label for="old-pw">Nhập lại</label>
                                        <div class="form-setting">
                                            <input type="password" id="conf-pw" name="conf-pw" class="form-control">
                                            <i class="fa-solid fa-eye-slash sP-su" onclick="showPassword(this)"></i>
                                            <span class="pwad-message"></span>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="pwad-submit">Cập nhật</button>
                                </form>

                                <script src="../js/validate1.js"></script>
                                <script>
                                    Validator({
                                        form: '#change-pass-ad',
                                        errorSelector: '.pwad-message',
                                        formGroupSelector: '.form-setting',
                                        rules: [
                                            Validator.minLength('#old-pw', 6, 'Vui lòng nhập mật khẩu'),
                                            Validator.minLength('#new-pw', 6, 'Vui lòng nhập mật khẩu'),
                                            Validator.isConfirmed('#conf-pw', function() {
                                                return document.querySelector('#change-pass-ad #new-pw').value;
                                            }, 'Vui lòng nhập trường này'),
                                        ],
                                        
                                    });
                                </script>
                            </div>
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
                                            window.location.href = 'changePwad.php';
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
</body>
</html>