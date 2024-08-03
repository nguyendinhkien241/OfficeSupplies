<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/discount.php";
?>

<?php
    $dis = new discount();
    if(isset($_GET['discountId'])) {
        $id = $_GET['discountId'];
        $delDiscount = $dis->delete_discount($id);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard discountList">
                            <h3 class="discount-heading">Danh sách chương trình ưu đãi</h3>
                            <div class="discount-main">
                                <ul class="discount-list">
                                    <?php
                                        $disList = $dis->show_discount();
                                        if($disList) {
                                            while($result = $disList->fetch_assoc()) {
                                    ?>
                                    <li class="discount-row">
                                        <div class="discount-value">
                                            <span><?php echo floor(intval($result['discountValue']) / 1000) ?>K</span>
                                        </div>
                                        <table>
                                            <tr>
                                                <th>Mã giảm giá</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Số tiền giảm</th>
                                                <th>Tùy chỉnh</th>
                                            </tr>

                                            <tr>
                                                <td class="discount-code"><?php echo $result['discountName'] ?></td>
                                                <td><?php echo $result['discountStart'] ?></td>
                                                <td><?php echo $result['discountEnd'] ?></td>
                                                <td><?php echo number_format($result['discountValue'], 0, ',', ',') ?><u>đ</u></td>
                                                <td>
                                                    <a href="discountEdit.php?discountId=<?php echo $result['discountId'] ?>" class="discount-change-link">
                                                        <i class="fa-solid fa-wrench"></i>
                                                    </a>
                                                    <a data-id="<?php echo $result['discountId']?>" onclick="showModal(this)" class="discount-delete-link">
                                                        <i class="fa-regular fa-circle-xmark"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
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
                <h2>Mã giảm giá này sẽ bị Xóa</h2>
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
            submitBtn.href = `?discountId=${id}`;
        }
    </script>

    <div id="toasts">
    </div>

    <script>
        const toasts = document.querySelector('#toasts');
        var data = <?php if(isset($delDiscount)) {echo $delDiscount;} else {echo "undefined";}?>;
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
                    window.location.href = 'discountList.php';
                }, 5500);
            }
            delete data;
        }
    </script>
</body>
</html>