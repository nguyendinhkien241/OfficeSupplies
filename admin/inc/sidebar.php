<div class="container">
            <div class="grid wide main">
                <div class="row app-container">
                    <div class="col l-2 m-0 c-0">
                        <div class="sidebar">
                            <h3>Lựa chọn</h3>
                            <ul class="section-menu">
                                <li class="section-item">
                                    <a onclick="dropDown(this)">
                                        Sản phẩm
                                        <span class="icon-container">
                                            <i class="fa-solid fa-angle-right dropdown"></i>
                                        </span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <a href="productList.php" class="sub-item">DS sản phẩm</a>
                                        <a href="addProduct.php" class="sub-item">Thêm sản phẩm</a>
                                    </ul>
                                </li>
                                <li class="section-item">
                                    <a onclick="dropDown(this)">
                                        Chương trình ưu đãi
                                        <span class="icon-container">
                                            <i class="fa-solid fa-angle-right dropdown"></i>
                                        </span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <a href="promoteList.php" class="sub-item">DS chương trình</a>
                                        <a href="addPromote.php" class="sub-item">Thêm chương trình</a>
                                    </ul>
                                </li>
                                <li class="section-item">
                                    <a onclick="dropDown(this)">
                                        Mã giảm giá
                                        <span class="icon-container">
                                            <i class="fa-solid fa-angle-right dropdown"></i>
                                        </span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <a href="discountList.php" class="sub-item">DS mã giảm giá</a>
                                        <a href="addDiscount.php" class="sub-item">Thêm mã</a>
                                    </ul>
                                </li>
                                <li class="section-item">
                                    <a onclick="dropDown(this)">
                                        Đơn hàng
                                        <span class="icon-container">
                                            <i class="fa-solid fa-angle-right dropdown"></i>
                                        </span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <a href="bill.php" class="sub-item">DS đơn hàng</a>
                                        <a href="submitBill.php" class="sub-item">Chờ xác nhận</a>
                                    </ul>
                                </li>
                                <li class="section-item">
                                    <a href="statistics.php">
                                        Doanh thu
                                    </a>
                                </li>
                            </ul>

                            <script>
                                function dropDown(x) {
                                    var subMenu = x.parentElement.children[1];
                                    var iconDown = x.querySelector('.icon-container');

                                    if(subMenu.classList.contains("sub-active")) {
                                        subMenu.style.height = '0';
                                        subMenu.addEventListener('transitionend', function() {
                                            subMenu.classList.remove('sub-active');
                                        });
                                        iconDown.classList.remove('rotate');
                                    } else {
                                        subMenu.style.height = subMenu.scrollHeight + 'px';
                                        subMenu.addEventListener('transitionend', function() {
                                            subMenu.classList.add('sub-active');
                                        });
                                        iconDown.classList.add('rotate');
                                    }
                                }
                            </script>
                        </div>
                    </div>