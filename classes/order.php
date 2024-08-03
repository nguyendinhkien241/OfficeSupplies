<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class order {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_order($id) {
            $queryCart = "SELECT * FROM tbl_cart WHERE sesId = '$id'";
            $resultCart = $this->db->select($queryCart);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('Y-m-d');
            $time = date('H:i:s');
            if($resultCart) {
                while($data = $resultCart->fetch_assoc()) {
                    $productId = $data['productId'];
                    $productName = $data['productName'];
                    $userId = $id;
                    $quantity = $data['quantity'];
                    $color = $data['color'];
                    $price = $data['price'];
                    $image = $data['productImage'];

                    $query = "INSERT INTO tbl_order(productId, productName, userId, quantity, color, price, image, date, time)
                    VALUES('$productId', '$productName', '$userId', '$quantity', '$color', '$price', '$image', '$date', '$time')";
                    $result = $this->db->insert($query);

                    $delCart = "DELETE FROM tbl_cart WHERE sesId = '$id'";
                    $resultDel = $this->db->delete($delCart);
                }
            }
        }

        public function show_delivering($id, $date, $time) {
            $query = "SELECT * FROM tbl_order WHERE userId = '$id' AND date = '$date' AND time = '$time' AND status IN(0, 1)";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_waiting($id, $date, $time) {
            $query = "SELECT * FROM tbl_order WHERE userId = '$id' AND date = '$date' AND time = '$time' AND status = 0";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_delivered($id) {
            $query = "SELECT * FROM tbl_order WHERE billId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>