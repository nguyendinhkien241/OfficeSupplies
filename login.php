<?php
    include "./head.php";
    include "./header.php";
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $logIn = $user->log_in_user($_POST);
    }
?>

<?php
    if(Session::get('user_login')) {
        echo "<script>window.location = 'index.php'</script>";
    }
?>

        <div class="sign-in-container">
            <div class="wrapper-sign-in">
                <div class="left-side">
                    <h2 class="title">
                        Office Supplies
                    </h2>
                    <p class="description">
                        Chúng ta hãy dịu dàng và tử tế nâng niu những phương tiện của tri thức. Chúng ta hãy dám đọc, nghĩ, nói và viết.
                    </p>
                </div>
    
                <div class="sign-in">
                    <div class="sign-in-form">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input id="user-name" type="text" class="form-control" name="user-name" placeholder="Tên đăng nhập" required>
                                <span class="form-message"></span>
                            </div>
    
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                                <span class="form-message"></span>
                                <div class="show-password">
                                </div>
                            </div>

                            <?php
                                if(isset($logIn)) {
                                    echo $logIn;
                                }
                            ?>
    
                            <button class="btn" name="login" type="submit">Đăng nhập</button>
    
                            <div class="forget-password">
                                <a href="" >
                                    Quên mật khẩu?
                                </a>
                            </div>
                            <div class="line"></div>
                        </form>
    
                        <button type="button" class="btn-sign-in">
                            <a href="signUp.php" class="sign-in-link">
                                Tạo tài khoản mới
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="./js/login.js"></script>
<?php
    include "./footer.php";
?>
    