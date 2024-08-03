<?php
    include "head.php";
    include "header.php";
?>

        <div class="user-container">
            <div class="user-main">
                <div class="user-top">
                    <a href="user.php" class="user-info-heading">Thông tin tài khoản</a>
                    <a href="package.php" class="user-bought-heading user-bought-choose">Đơn hàng đã mua</a>
                    <a href="changePw.php" class="user-cp-heading">Đổi mật khẩu</a>
                </div>

                <div class="user-package">
                    <div class="user-table">
                        <table>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Giá trị đơn hàng</th>
                                <th>Thành tiền</th>
                                <th>Tình trạng</th>
                                <th></th>
                            </tr>
                            <?php
                                $userBillList = $bill->get_bill_by_user(Session::get('user_id'));
                                if($userBillList) {
                                    while($row = $userBillList->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['billId'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['sum'] ?><u>đ</u></td>
                                <td><?php echo $row['total'] ?><u>đ</u></td>
                                <td>
                                    <?php if($row['status'] == 1) {
                                        echo "Đang giao hàng";
                                    } else {
                                        echo "Giao thành công";
                                    }?>
                                </td>
                                <th><a href="packageDetail.php?billId=<?php echo $row['billId'] ?>">Xem chi tiết</a></th>
                            </tr>

                            <?php 
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php
    include "footer.php";
?>