<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/category.php";
    include "../classes/product.php";
?>

<?php
    $prod = new product();

    if(isset($_GET['productId'])) {
        $id = $_GET['productId'];
        $delProduct = $prod->delete_product($id);
    }
?>

<?php
    if(isset($_GET['btn-search'])) {
        $text = $_GET['search-product'];
        $prodList = $prod->searchProAdmin($text);
    } else {
        $prodList = $prod->show_product();
    }
?>
        

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard productList">
                            <div class="product-header">
                                <h3 class="product-heading">
                                    Danh sách sản phẩm
                                </h3>
                                <div class="product-control">
                                    <form action="" method="GET" class="control-search">
                                        <input type="text" name="search-product" class="control-search-input" placeholder="Tìm kiếm sản phẩm">
                                        <button type="submit" name="btn-search">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="product-box">
                                <ul class="product-list">
                                    <?php
                                        $i = 0;
                                        if($prodList) {
                                            while($result = $prodList->fetch_assoc()) {
                                            $i++;
                                    ?>
                                    <li class="product-row">
                                        <div class="productList-img">
                                            <img src="./uploads/<?php echo $result['productImage'] ?>" alt="">
                                            <div class="product-id"><?php echo $i ?></div>
                                        </div>
                                        <div class="productList-info">
                                            <p class="productList-name">
                                            <?php echo $result['productName'] ?>
                                            </p>
                                            <div class="productList-qtt">
                                                <p class="productList-amount">Số lượng còn: <span><?php echo $result['productAmount'] ?></span></p>
                                                <p class="productList-sold">Đã bán: <span><?php echo $result['productSold'] ?></span></p>
                                            </div>
                                            <p class="productList-classify">
                                                Loại sản phẩm: <span><?php 
                                                    // $cat = new category();
                                                    // $catItem = $cat->get_category($result['catId']);
                                                    // $catName = $catItem->fetch_assoc();
                                                    // echo $catName['category_name'];
                                                    echo $result['category_name'];
                                                ?></span>
                                            </p>
                                            <p class="productList-type">
                                                Kiểu sản phẩm: <span><?php if($result['productStyle'] == 1) {echo "Thường";} else {echo "Mới";} ?></span>
                                            </p>
                                        </div>
                                        <div class="productList-other">
                                            <p class="productList-price"><?php echo number_format($result['productPrice'], 0, ',', ',') ?><u>đ</u></p>
                                            <div class="productList-change">
                                                <a href="productEdit.php?productId=<?php echo $result['productId'] ?>" class="productChange-link">
                                                    Sửa
                                                    <i class="fa-solid fa-wrench"></i>
                                                </a>
                                                <a data-id="<?php echo $result['productId'] ?>" onclick="showModal(this)" class="productDelete-link">
                                                    Xóa
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                            }
                                        }
                                    ?>  
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal hide">
        <div class="modal__inner">
            <div class="modal__header">
                <p>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Cảnh báo
                </p>
                <i class="fas fa-times"></i>
            </div>
            <div class="modal__body">
                <h2>Sản phẩm này sẽ bị Xóa</h2>
                <p>Bạn có muốn tiếp tục không?</p>
            </div>
            <div class="modal__footer">
                <a class="submit-action">Xác nhận</a>
                <button>Close</button>
            </div>
        </div>
    </div>

    <script>
        var modal = document.querySelector('.modal');
        var iconClose = document.querySelector('.modal__header>i');
        var btnClose = document.querySelector('.modal__footer button');
        var submitBtn = document.querySelector('.submit-action');
        function toggleModal() {
            modal.classList.toggle('hide');
        }
        btnClose.onclick = toggleModal;
        iconClose.onclick = toggleModal;
        modal.addEventListener('click', function(e) {
            if(e.target == e.currentTarget) {
                toggleModal();
            }
        });
        function showModal(x) {
            toggleModal();
            var id = x.getAttribute('data-id');
            submitBtn.href = `?productId=${id}`;
        }
    </script>

    <div id="toasts">
    </div>

    <script>
        const toasts = document.querySelector('#toasts');
        var data = <?php if(isset($delProduct)) {echo $delProduct;} else {echo undefined;}?>;
        let templateInner;
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
                window.location.href = 'productList.php';
            }, 5500);
        }
        delete data;
    </script>
</body>
</html>