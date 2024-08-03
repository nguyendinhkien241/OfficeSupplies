<?php
    include "head.php";
    include "header.php";
?>

<?php
    if(!isset($_GET['billId']) || $_GET['billId'] == NULL) {
        echo "<script>window.location = 'package.php'</script>";
    } else {
        $id = $_GET['billId'];
    }
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
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                            <?php 
                                $getBill = $bill->get_bill_by_id($id);
                                $info = $getBill->fetch_assoc();
                                $userOrderList = $order->show_delivered($id);
                                if($userOrderList) {
                                    $i = 0;
                                    while($row = $userOrderList->fetch_assoc()) {
                                        $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['productName'] ?></td>
                                <td><?php echo $row['quantity'] ?></td>
                                <td><?php echo number_format($row['price'], 0, ',', ',') ?><u>đ</u></td>
                                <td><?php echo number_format($row['price'] * $row['quantity'], 0, ',', ',') ?><u>đ</u></td>
                            </tr>

                            <?php
                                    }
                                }
                            ?>

                            <tr>
                                <td style="font-weight: bold;" align="right" colspan="4">Tổng cộng</td>
                                <td style="font-weight: bold;"><?php echo number_format($info['sum'], 0, ',', ',') ?><u>đ</u></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;" align="right" colspan="4">Giảm giá</td>
                                <td style="font-weight: bold;"><?php echo number_format($info['discount'], 0, ',', ',') ?><u>đ</u></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;" align="right" colspan="4">Tổng phải trả</td>
                                <td style="font-weight: bold;"><?php echo number_format($info['total'], 0, ',', ',') ?><u>đ</u></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php
    include "footer.php";
?>