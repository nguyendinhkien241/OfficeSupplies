<?php
    include_once "./lib/session.php";
    Session::init();
?>

<?php
    include_once "./lib/database.php";
    include_once "./helpers/format.php";

    spl_autoload_register(function($className) {
        include_once "./classes/".$className.".php";
    });

    $db = new Database();
    $fm = new Format();
    $cart = new cart();
    $user = new user();
    $cat = new category();
    $pro = new product();
    $dis = new discount();
    $prom = new promote();
    $cont = new contact();
    $order = new order();
    $bill = new bill();
?>

<?php
    if(Session::get('user_login')) {
        $sesId = session_id();
        $updateCartinSession = $cart->update_cart_session($sesId);
    }
?>

<?php
    if(isset($_GET['cartId']) && !isset($_GET['repair'])) {
        $id = $_GET['cartId'];
        $delCart = $cart->del_item_cart($id);
    }
?>

<?php
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
    }
?>

<?php
    if(isset($_GET['btn-search'])) {
        $text = $_GET['input-search'];
        $search = $pro->searchPro($text);
    }
?>

<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('Y-m-d');
    $checkProm = $prom->check_promote($date);
?>

<body>
    <div class="wrap">
        <div class="header-group">
            <div class="header-top">
                <div class="header">
                    <div class="logo">
                        <a href="index.php">
                            <i class="fa-solid fa-pen-fancy"></i>
                            <div class="logo-name">Office<br>Supplies</div>
                        </a>
                    </div>
        
                    <div class="search-box">
                        <form method="GET" action="index.php" class="form-search">
                            <input type="text" id="input-search" class="input-search" name="input-search" placeholder="Tìm kiếm sản phẩm..." value="<?php if(isset($_GET['input-search'])) echo $_GET['input-search'] ?>">
                            <button type="submit" name="btn-search" class="btn-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <div class="search-suggest">
                            <ul class="suggest-list">
                                
                            </ul>
                        </div>
                    </div>

                    <script>
                        let products = document.querySelector('.suggest-list');
                        let filter = document.getElementById('input-search');
                        const listItems = [];
                        getData()
                        filter.addEventListener('input', function() {
                            if (filter.value.trim() !== '') {
                                products.classList.add('show');
                            } else {
                                products.classList.remove('show');
                            }
                        });
                        filter.addEventListener('input', (e) => filterData(e.target.value));
                        function getData() {
                            fetch('process/getPro.php')
                                .then(response => response.json())
                                .then(data => {
	                                products.innerHTML = ''

                                    data.forEach(product => {
                                        const li = document.createElement('li')
                                        li.setAttribute('class', 'suggest-items')
                                        listItems.push(li);
                                        li.innerHTML = `
                                            <a href="preview.php?productId=${product.productId}" class="suggest-link">
                                                <img src="./admin/uploads/${product.productImage}" alt="" class="suggest-img">
                                                <div class="suggest-info">
                                                    <p class="suggest-name">${product.productName}</p>
                                                    <div class="suggest-price">
                                                        <span class="suggest-current-price">${product.productPrice}<u>đ</u></span>
                                                        <span class="suggest-old-price">${product.productOldPrice == product.productPrice ? '' : product.productOldPrice + '<u>đ</u>'}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        `

                                        products.appendChild(li)
                                    });
                                })
                                .catch(error => console.error('Error:', error));
                        }

                        function filterData(search) {
                            listItems.forEach((item) => {
                                if (item.innerText.toLowerCase().includes(search.toLowerCase())) {
                                    item.classList.remove('hide')
                                } else {
                                    item.classList.add('hide')
                                }
                            })
                        }


                    </script>
        
                    <div class="cus-service">
                        <div class="cus-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
        
                        <div class="cus-phone-service">
                            <p>Hỗ trợ khách hàng</p>
                            <span class="cus-phone_number">0123456789</span>
                        </div>
                    </div>
        
                    <div class="log-in">
                        <div class="log-in-form">
                            <div class="log-in_icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div class="log-in-link">
                                <?php
                                    $logIn_check = Session::get('user_login');
                                    if($logIn_check == true) {
                                        $logIn_name = Session::get('user_name');
                                        echo "<a href='user.php' class='log-in_text'>Hi, " . $logIn_name . "</a>";
                                        echo " <a href='?action=logout' class='log-off_text'>Đăng xuất</a>";
                                    } else {
                                        echo "<a href='login.php' class='log-in_text'>Đăng nhập</a>
                                                <a href='signUp.php' class='log-off_text'>Đăng ký</a>";
                                    }
                                ?>  
                                
                            </div>
                        </div>
                    </div>
        
                    <div class="cart-group">
                        <div class="mini-cart">
                            <a class="link-mc" href="./cart.php">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="cart-text">Giỏ hàng</span>
                                <span class="count-item"><?php 
                                    $row_count = $cart->count_item()->fetch_assoc();
                                    echo $row_count['row_count'];
                                ?></span>
                            </a>
        
                            <div class="show-item-cart">
                                <div class="mini-cart-container">
                                    <ul class="list-item-mc">
                                        <?php
                                            if($row_count['row_count'] == 0) {
                                                echo "<span style='font-size: 18px; font-weight: bold;'>Không có sản phẩm nào trong giỏ hàng</span>";
                                            }
                                            $cartHeaderList = $cart->show_cart();
                                            $totalHeader = $cart->sum_cart()->fetch_assoc();
                                            $totalHeaderValue = $totalHeader['total_value'];
                                            if($cartHeaderList) {
                                                while($resultHeader = $cartHeaderList->fetch_assoc()) {
                                        ?>
                                        <li class="item-mc">
                                            <div class="info-item-mc">
                                                <div class="img-item-mc">
                                                    <img src="./admin/uploads/<?php echo $resultHeader['productImage'] ?>" alt="">
                                                </div>
                                                <div class="detail-item-mc">
                                                    <div class="name-item-mc"><p><?php echo $resultHeader['productName'] ?></p></div>
                                                    <div class="color-item-mc"><?php if($resultHeader['color'] != 0) {echo $resultHeader['color'];} ?></div>
                                                    <div class="others-info-mc">
                                                        <span class="price-mc"><?php echo number_format($resultHeader['price'], 0, ',',',')?><u>đ</u> x </span>
                                                        <span class="quantity-mc"><?php echo $resultHeader['quantity'] ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item-delete-mc">
                                                <a href="?cartId=<?php echo $resultHeader['cartId'] ?>">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                
                                    </ul>

                                    <div class="action-mc">
                                        <div class="temporary-price">Tổng tiền tạm tính
                                            <span><?php echo number_format($totalHeaderValue, 0, ',',',')?><u>đ</u></span>
                                        </div>
                                    </div>

                                    <button class="buy-btn-mc">
                                        <a href="./cart.php">Mua hàng ngay</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="notification">
                        <div class="noti-icon">
                            <i class="fa-solid fa-bell"></i>
                            <div class="noti-count">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-top">
                <div class="menu-group">
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="index.php">
                                <i class="fa-solid fa-house"></i>
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="newProduct.php">
                                <i class="fa-solid fa-book"></i>
                                <span>Sản phẩm mới</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="bestSeller.php">
                                <i class="fa-solid fa-chart-line"></i>
                                <span>Bán chạy</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="cart.php">
                                <i class="fa-solid fa-cart-plus"></i>
                                <span>Giỏ hàng</span>
                            </a>
                        </li>
                        <?php
                            if(Session::get('user_login')) {
                        ?>
                        <li class="menu-item">
                            <a href="delivery.php">
                                <i class="fa-solid fa-truck"></i>
                                <span>Giao hàng</span>
                            </a>
                        </li>

                        <?php
                            }
                        ?>
                        <li class="menu-item">
                            <a href="contact.php">
                                <i class="fa-solid fa-envelope"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mg-top"></div>