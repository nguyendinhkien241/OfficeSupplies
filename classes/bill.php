<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class bill {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_bill($data, $id, $sum, $value) {
            $fullName = mysqli_real_escape_string($this->db->link, $data['full-name-ship']);
            $cusEmail = mysqli_real_escape_string($this->db->link, $data['email-ship']);
            $cusPhone = mysqli_real_escape_string($this->db->link, $data['phone-ship']);
            $cusAddress = mysqli_real_escape_string($this->db->link, $data['address-ship']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $total = $sum - $value;

            $query = "INSERT INTO tbl_bill(userId, cusName, cusEmail, cusPhone, cusAddress, date, time, sum, discount, total)
            VALUES('$id', '$fullName','$cusEmail', '$cusPhone', '$cusAddress', '$date', '$time' , '$sum', '$value', '$total')";
            $result = $this->db->insert($query);
            unset($_SESSION['discount']);

            if($result) {
                $response['status'] = 'success';
                $response['message'] = 'Đặt hàng thành công';
                return json_encode($response);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Đặt hàng không thành công';
                return json_encode($response);
            }
        }

        public function show_confirm_bill() {
            $query = "SELECT * FROM tbl_bill WHERE status = 0 order by billId";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_bill_by_id($id) {
            $query = "SELECT * FROM tbl_bill WHERE billId = '$id'";
            $result = $this->db->select($query);
            return $result; 
        }

        public function get_bill_by_user($id) {
            $query = "SELECT * FROM tbl_bill WHERE userId = '$id' AND status = 2 order by billId desc";
            $result = $this->db->select($query);
            return $result; 
        }

        public function show_bill_delivery($id) {
            $query = "SELECT * FROM tbl_bill WHERE userId = '$id' AND status IN(0, 1) order by billId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_bill() {
            $query = "SELECT * FROM tbl_bill WHERE status = 1 OR status = 2 order by billId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_bill_finish($id) {
            $query = "SELECT * FROM tbl_bill WHERE userId = '$id' AND status = 2 order by billId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function confirm_bill($id) {
            $queryUpdSold = "UPDATE tbl_product p
            INNER JOIN `tbl_order` o ON p.productId = o.productId
            SET p.productSold = p.productSold + o.quantity,
            p.productAmount = p.productAmount - o.quantity
            WHERE o.billId = '$id'
            AND o.status = 1";
            $resultUpdSold = $this->db->update($queryUpdSold);

            $query = "UPDATE tbl_bill SET status = 2 WHERE billId = '$id'";
            $result = $this->db->update($query);

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('Y-m-d');
            $checkDate = "SELECT * FROM tbl_statistic WHERE sta_date = '$date'";
            $resultCheck = $this->db->select($checkDate);
            if($resultCheck) {
                $querySta = "UPDATE tbl_statistic d
                JOIN tbl_bill b ON b.billId = '$id'
                SET d.sta_revenue = d.sta_revenue + b.total, d.sta_amount = d.sta_amount + 1 WHERE sta_date='$date'";
                $resultSta = $this->db->update($querySta);
            } else {
                $getBill = "SELECT * FROM tbl_bill WHERE billId = '$id'";
                $kq = $this->db->select($getBill);
                if($kq) {
                    $info = $kq->fetch_assoc();
                    $revenue = $info['total'];
                    $querySta = "INSERT INTO tbl_statistic(sta_revenue, sta_amount, sta_date) VALUES('$revenue', '1', '$date')";
                    $resultSta = $this->db->insert($querySta);
                }
            }

            $queryUpdSta = "UPDATE tbl_order SET status = 2 WHERE billId = '$id'";
            $resultUpdSta = $this->db->update($queryUpdSta);
            if($result) {
                $response['status'] = 'success';
                $response['message'] = 'Nhận hàng thành công!';
                return json_encode($response);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Nhận hàng không thành công!';
                return json_encode($response);
            }
        }   

        public function submit_bill($id) {
            $queryBill = "SELECT * FROM tbl_bill WHERE billId = '$id'";
            $resultBill = $this->db->select($queryBill);
            $response = [];
            if($resultBill) {
                $info = $resultBill->fetch_assoc();
                $date = $info['date'];
                $time = $info['time'];
                $userId = $info['userId'];
                $queryOrder = "UPDATE tbl_order SET billId = '$id', status = 1 WHERE date = '$date' AND time = '$time' AND userId = '$userId'";
                $resultOrder = $this->db->update($queryOrder);
            }

            $query = "UPDATE tbl_bill SET status = 1 WHERE billId = '$id'";
            $result = $this->db->update($query);

            if($result) {
                $response['status'] = 'success';
                $response['message'] = 'Xác nhận đơn hàng thành công!';
                return json_encode($response);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Xác nhận đơn hàng thất bại!';
                return json_encode($response);
            }
        }

        public function cancel_bill($id) {
            $queryBill = "SELECT * FROM tbl_bill WHERE billId = '$id'";
            $resultBill = $this->db->select($queryBill);
            if($resultBill) {
                $info = $resultBill->fetch_assoc();
                $date = $info['date'];
                $time = $info['time'];
                $userId = $info['userId'];
                $queryOrder = "DELETE FROM tbl_order WHERE date = '$date' AND time = '$time' AND userId = '$userId' AND status = 0";
                $resultOrder = $this->db->delete($queryOrder);
            }
            $query = "DELETE FROM tbl_bill WHERE billId = '$id'";
            $result = $this->db->update($query);

            if($result) {
                $response['status'] = 'success';
                $response['message'] = 'Hủy đơn hàng thành công!';
                return json_encode($response);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Hủy đơn hàng thất bại!';
                return json_encode($response);
            }
        }
    }
?>