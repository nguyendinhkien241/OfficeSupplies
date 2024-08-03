<?php
    include "./inc/head.php";
?>

<?php
    include "../classes/adminLogin.php";  
?>

<?php
    $adClass = new adminLogin();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $adminUser = $_POST['admin-user'];
        $adminPw = md5($_POST['admin-pw']);
        $login_check = $adClass->login_admin($adminUser, $adminPw);
    }
?>
<body>
    <div class="wrap">
        <div class="log-in-container">
            <div class="form-box">
                <form action="" method="POST">
                    <h2>Admin Login</h2>
    
                    <div class="log-in-control">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" required name="admin-user">
                        <label>Username</label>
                    </div>
    
                    <div class="log-in-control">
                        <i class="show-password fa-regular fa-eye"></i>
                        <input type="password" class="input-password" required name="admin-pw">
                        <label>Password</label>
                    </div>

                    <span style="font-size: 14px; color: #ff835a;"><?php 
                        if(isset($login_check)) {
                            echo $login_check;
                        }
                    ?></span>
    
                    <button type="submit" name="login">Log in</button>
                </form>

                <script>
                    const input = document.querySelector('.input-password');
                    const eye = document.querySelector('.show-password');
                    eye.addEventListener('click', function() {
                        if(input.type === 'password') {
                            input.type = 'text';
                            eye.classList.remove('fa-eye');
                            eye.classList.add('fa-eye-slash')
                        } else {
                            input.type = 'password';
                            eye.classList.remove('fa-eye-slash')
                            eye.classList.add('fa-eye');
                        }
                    }) 
                </script>
            </div>
        </div>
    </div>
</body>
</html>