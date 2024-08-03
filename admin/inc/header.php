<?php
    include ("../lib/session.php");
    Session::checkSession();
?>

<body>
    <div class="wrap">
        <div class="header">
            <div class="header-top">
                <div class="header-main">
                    <div class="header-brand">
                        <div class="header-logo">
                            <i class="fa-solid fa-pen-fancy"></i>
                        </div>
    
                        <div class="header-name-brand">
                            <p class="header-name">
                                Quản lý văn phòng phẩm
                            </p>
                            <p class="header-name-desc">
                                www.vanphongpham.com
                            </p>
                        </div>
                    </div>
    
                    <div class="header-account">
                        <div class="header-account-info">
                            <i class="fa-solid fa-user-tie"></i>
                            <span>Hello <?php echo Session::get('admin_name') ?></span>
                        </div>

                        <?php
                            if(isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            }
                        ?>
    
                        <div class="header-account-logout">
                            <a href="?action=logout" class="logout-link">Logout</a>
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-bottom">
                <ul class="menu-list">
                    <li class="menu-item">
                        <a href="index.php" class="direction-link">Trang chủ</a>
                    </li>
                    <li class="menu-item">
                        <a href="user.php" class="direction-link">Người dùng</a>
                    </li>
                    <li class="menu-item">
                        <a href="changePwad.php" class="direction-link">Đổi mật khẩu</a>
                    </li>
                    <li class="menu-item">
                        <a href="contact.php" class="direction-link">Tin nhắn</a>
                    </li>
                    <li class="menu-item">
                        <a href="../index.php" class="direction-link">Đến Website</a>
                    </li>
                </ul>
            </div>
        </div>