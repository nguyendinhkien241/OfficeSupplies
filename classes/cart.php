<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class cart {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function add_to_cart($id, $quantity, $color) {
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $color = mysqli_real_escape_string($this->db->link, $color);
            $id = mysqli_real_escape_string($this->db->link, $id);
            if(Session::get('user_login')) {
                $sesId = Session::get('user_id');
            } else {
                $sesId = session_id();
            }

            $queryPro = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $resultPro = $this->db->select($queryPro)->fetch_assoc();

            $proName = $resultPro['productName'];
            $proPrice = $resultPro['productPrice'];
            $proImage = $resultPro['productImage'];
            $response = [];

            $checkCart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sesId = '$sesId' AND color = '$color'";
            $resultCheck = $this->db->select($checkCart);
            if($resultCheck) {
                $queryUpdate = "UPDATE tbl_cart SET quantity = quantity + '$quantity' WHERE productId = '$id' AND sesId = '$sesId' AND color = '$color'";
                $resultUpdate = $this->db->update($queryUpdate);
                if($resultUpdate) {
                    $response['status'] = 'success';
                    $response['message'] = 'Đã thêm vào giỏ hàng!';
                    return json_encode($response);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Thêm sản phẩm không thành công!';
                    return json_encode($response);
                }
            } else {
                $query = "INSERT INTO tbl_cart(productId, sesId, productName, price, quantity, color, productImage)
                VALUES('$id', '$sesId', '$proName', '$proPrice' ,'$quantity', '$color','$proImage')";
                $result = $this->db->insert($query);

                if($result) {
                    $response['status'] = 'success';
                    $response['message'] = 'Đã thêm vào giỏ hàng!';
                    return json_encode($response);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Thêm sản phẩm không thành công!';
                    return json_encode($response);
                }
            }

            

        }

        public function update_cart_session($sesId) {
            $querySes = "SELECT * FROM tbl_cart WHERE sesId = '$sesId'";
            $resultSes = $this->db->select($querySes);
            if($resultSes) {
                while($row = $resultSes->fetch_assoc()) {
                    $proId = $row['productId'];
                    $proName = $row['productName'];
                    $price = $row['price'];
                    $image = $row['productImage'];
                    $quantity = $row['quantity'];
                    $proColor = $row['color'];
                    $userId = Session::get('user_id');
                    $checkQuery = "SELECT * FROM tbl_cart WHERE sesId = '$userId' AND productId = '$proId' AND color = '$proColor'";
                    $queryCheck = $this->db->select($checkQuery);
                    if(!$queryCheck) {
                        $query = "INSERT INTO tbl_cart(productId, sesId, productName, price, quantity, color, productImage)
                        VALUES('$proId', '$userId', '$proName', '$price' ,'$quantity', '$proColor','$image')";
                        $result = $this->db->insert($query);

                        $delItem = "DELETE FROM tbl_cart WHERE sesId='$sesId' AND productId = '$proId' AND color = '$proColor'";
                        $queryDel = $this->db->delete($delItem);
                        
                    } else {
                        $updateQuery = "UPDATE tbl_cart SET quantity = quantity + $quantity WHERE sesId = '$userId' AND productId = '$proId' AND color = '$proColor'";
                        $updateSes = $this->db->update($updateQuery);

                        $delItem = "DELETE FROM tbl_cart WHERE sesId='$sesId' AND productId = '$proId' AND color = '$proColor'";
                        $queryDel = $this->db->delete($delItem);
                    }
                }
            }
            return $resultSes;
        }

        public function show_cart() {
            if(Session::get('user_login')) {
                $sesId = Session::get('user_id');
            } else {
                $sesId = session_id();
            }
            $query = "SELECT * FROM tbl_cart WHERE sesId = '$sesId' order by cartId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_item_cart($id) {
            $query = "DELETE FROM tbl_cart WHERE cartId = '$id'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function sum_cart() {
            if(Session::get('user_login')) {
                $sesId = Session::get('user_id');
            } else {
                $sesId = session_id();
            }
            $query = "SELECT SUM(price * quantity) AS total_value FROM tbl_cart WHERE sesId = '$sesId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function count_item() {
            if(Session::get('user_login')) {
                $sesId = Session::get('user_id');
            } else {
                $sesId = session_id();
            }
            $query = "SELECT COUNT(*) AS row_count FROM tbl_cart WHERE sesId = '$sesId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity($id, $action) {
            $query = "SELECT * FROM tbl_cart WHERE cartId = '$id' LIMIT 1";
            $result = $this->db->select($query);
            if($result) {
                $list = $result->fetch_assoc();
                if($action == 'sub') {
                    $qtt = $list['quantity'];
                    if($qtt == 1) {
                        $queryDel = "DELETE FROM tbl_cart WHERE cartId = '$id'";
                        $resultDel = $this->db->delete($queryDel);
                        return $resultDel;
                    } else {
                        $queryUpdate = "UPDATE tbl_cart SET quantity = quantity - 1 WHERE cartId = '$id'";
                        $resultUpdate = $this->db->update($queryUpdate);
                        return $resultUpdate;
                    }
                    
                } else {
                    $queryUpdate = "UPDATE tbl_cart SET quantity = quantity + 1 WHERE cartId = '$id'";
                    $resultUpdate = $this->db->update($queryUpdate);
                    return $resultUpdate;
                }
            }
        }
    }
?>