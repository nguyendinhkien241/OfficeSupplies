<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/bill.php";
    $bill = new bill();
?>

<?php
    if(isset($_GET['billId']) && $_GET['billId'] != NULL) {
        $id = $_GET['billId'];
        $submitBill = $bill->submit_bill($id);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard billList">
                            <h3 class="bill-heading">Đơn hàng chờ xác nhận</h3>
                            <div class="bill-main">
                                <ul class="bill-list">
                                    <?php
                                        $billList = $bill->show_confirm_bill();
                                        if($billList) {
                                            $i = 0;
                                            while($row = $billList->fetch_assoc()) {
                                                $i++;
                                    ?>
                                    <li class="bill-row">
                                        <div class="bill-code">
                                            <span class="bill-id"><?php echo $i ?></span>
                                            <a href="submitDetail.php?billId=<?php echo $row['billId'] ?>" class="show-more">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </a>
                                        </div>
                                        <table>
                                            <tr>
                                                <th>Tên khách hàng</th>
                                                <th>Ngày mua</th>
                                                <th>Giờ mua</th>
                                                <th>Thành tiền</th>
                                                <th></th>
                                            </tr>

                                            <tr>
                                                <td class="discount-code"><?php echo $row['cusName'] ?></td>
                                                <td><?php echo $row['date'] ?></td>
                                                <td><?php echo $row['time'] ?></td>
                                                <td><?php echo number_format($row['total'], 0, ',',',') ?><u><b>đ</b></u></td>
                                                <td>
                                                    <a class="submit-bill" href="?billId=<?php echo $row['billId'] ?>">
                                                        Xác nhận
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

                        <div id="toasts">
                        </div>

                        <script>
                            const toasts = document.querySelector('#toasts');
                                var data = <?php if(isset($submitBill)) {echo $submitBill;} else {echo "undefined";}?>;
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
                                            window.location.href = 'submitBill.php';
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
</body>
</html>