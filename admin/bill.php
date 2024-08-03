<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include_once "../classes/bill.php";
    $bill = new bill();
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard billList">
                            <h3 class="bill-heading">Danh sách đơn hàng</h3>
                            <div class="bill-main">
                                <ul class="bill-list">
                                    <?php
                                        $billList = $bill->show_bill();
                                        if($billList) {
                                            $i = 0;
                                            while($result = $billList->fetch_assoc()) {
                                                $i++;
                                    ?>
                                    <li class="bill-row">
                                        <div class="bill-code">
                                            <span class="bill-id"><?php echo $i ?></span>
                                            <a href="billDetail.php?billId=<?php echo $result['billId'] ?>" class="show-more">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </a>
                                        </div>
                                        <table>
                                            <tr>
                                                <th>Tên khách hàng</th>
                                                <th>Ngày mua</th>
                                                <th>Giá trị đơn hàng</th>
                                                <th>Giảm giá</th>
                                                <th>Thành tiền</th>
                                                <th>Tình trạng</th>
                                            </tr>

                                            <tr>
                                                <td class="discount-code"><?php echo $result['cusName'] ?></td>
                                                <td><?php echo $result['date'] ?></td>
                                                <td><?php echo $result['sum'] ?><u><b>đ</b></u></td>
                                                <td><?php echo $result['discount'] ?><u><b>đ</b></u></td>
                                                <td><?php echo $result['total'] ?><u><b>đ</b></u></td>
                                                <td><?php 
                                                    if($result['status'] == 1) {
                                                        echo "Đang giao hàng";
                                                    } else {
                                                        echo "Đã thanh toán";
                                                    }
                                                ?></td>
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
</body>
</html>