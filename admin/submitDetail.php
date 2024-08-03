<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    if(!isset($_GET['billId']) || $_GET['billId'] == NULL) {
        echo "<script>window.location = 'submitBill.php'</script>";
    } else {
        $id = $_GET['billId'];
    }
    include_once "../classes/bill.php";
    include_once "../classes/order.php";

    $bill = new bill();
    $order = new order();
    $info = $bill->get_bill_by_id($id);
    $result = $info->fetch_assoc();
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard billList">
                            <h3 class="billDetail-heading">Chi tiết hóa đơn</h3>
                            <div class="billDetail-main">
                                <div class="billDetail-info">
                                    <p class="bd-name">Họ và tên: <b><?php echo $result['cusName'] ?></b></p>
                                    <p class="bd-phone">Số điện thoại: <b><?php echo $result['cusPhone'] ?></b></p>
                                    <p class="bd-address">Địa chỉ: <b><?php echo $result['cusAddress'] ?></b></p>
                                    <p class="bd-date">Ngày mua: <b><?php echo $result['date'] ?></b></p>
                                    <p class="bd-status">Tình trạng: <b><?php echo "Chờ xác nhận" ?></b></p>
                                </div>

                                <div class="billDetail-table">
                                    <table>
                                        <tr>
                                            <th>Số thứ tự</th>
                                            <th class="set-width">Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                        <?php
                                            $userId = $result['userId'];
                                            $date = $result['date'];
                                            $time = $result['time'];
                                            $orderList = $order->show_waiting($userId, $date, $time);
                                            if($orderList) {
                                                $i = 0;
                                                while($row = $orderList->fetch_assoc()) {
                                                    $i++;
                                                
                                        ?>
                                        <tr>
                                            <td><?php echo $i?></td>
                                            <td class="set-width"><?php echo $row['productName'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td><b><?php echo number_format($row['price'], 0, ',', ',')  ?><u>đ</u></b></td>
                                            <td><b><?php echo number_format($row['price'] * $row['quantity'], 0, ',', ',')  ?><u>đ</u></b></td>
                                        </tr>

                                        <?php
                                                }
                                            }
                                        ?>

                                        <tr>
                                            <td align="right" colspan="4">Tổng cộng</td>
                                            <td><b><?php echo number_format($result['sum'], 0, ',', ',')  ?><u>đ</u></b></td>
                                        </tr>

                                        <tr>
                                            <td align="right" colspan="4">Giảm giá</td>
                                            <td><b><?php echo number_format($result['discount'], 0, ',', ',')  ?><u>đ</u></b></td>
                                        </tr>

                                        <tr>
                                            <td align="right" colspan="4">Tổng phải trả</td>
                                            <td><b><?php echo number_format($result['total'], 0, ',', ',')  ?><u>đ</u></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>