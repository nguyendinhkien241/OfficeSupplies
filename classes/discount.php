<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class discount {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_discount($data) {
            $disName = mysqli_real_escape_string($this->db->link, $data['dis-code']);
            $disStart = mysqli_real_escape_string($this->db->link, $data['date-of-begin']);
            $disEnd = mysqli_real_escape_string($this->db->link, $data['date-of-use']);
            $disValue = mysqli_real_escape_string($this->db->link, $data['dis-value']);

            $response = [];

            if($disName == "" || $disStart == "" || $disEnd == "" || $disValue == "") {
                // $alert = "<span class='error'> Các trường không được để trống!</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Các trường không được để trống!';
                return json_encode($response);
            } else {
                $query = "INSERT INTO tbl_discount(discountName, discountStart, discountEnd, discountValue)
                VALUES('$disName', '$disStart', '$disEnd', '$disValue')";
                $result = $this->db->insert($query);

                if($result) {
                    // $alert = "<span class='success'> Thêm sản phẩm thành công</span>";
                    // return $alert;
                    $response['status'] = 'success';
                    $response['message'] = 'Thêm mã thành công!';
                    return json_encode($response);
                } else {
                    // $alert = "<span class='error'> Thêm sản phẩm không thành công</span>";
                    // return $alert;
                    $response['status'] = 'error';
                    $response['message'] = 'Thêm mã thất bại!';
                    return json_encode($response);
                }
                
            }

        }

        public function show_discount() {
            $query = "SELECT * FROM tbl_discount ORDER BY discountId DESC";
            // $query = "SELECT * FROM tbl_product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getDiscountbyId($id) {
            $query = "SELECT * FROM tbl_discount WHERE discountId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_discount($data, $id) {
            $disName = mysqli_real_escape_string($this->db->link, $data['dis-code']);
            $disStart = mysqli_real_escape_string($this->db->link, $data['date-of-begin']);
            $disEnd = mysqli_real_escape_string($this->db->link, $data['date-of-use']);
            $disValue = mysqli_real_escape_string($this->db->link, $data['dis-value']);

            $response = [];

            if($disName == "" || $disStart == "" || $disEnd == "" || $disValue == "") {
                // $alert = "<span class='error'> Các trường không được để trống!</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Các trường không được để trống!';
                return json_encode($response);
            } else {
                $query = "UPDATE tbl_discount SET
                    discountName = '$disName',
                    discountStart = '$disStart',
                    discountEnd = '$disEnd',
                    discountValue = '$disValue'
                    WHERE discountId = '$id'";
                $result = $this->db->insert($query);

                if($result) {
                    // $alert = "<span class='success'> Thêm sản phẩm thành công</span>";
                    // return $alert;
                    $response['status'] = 'success';
                    $response['message'] = 'Cập nhật mã thành công!';
                    return json_encode($response);
                } else {
                    // $alert = "<span class='error'> Thêm sản phẩm không thành công</span>";
                    // return $alert;
                    $response['status'] = 'error';
                    $response['message'] = 'Cập nhật mã thất bại!';
                    return json_encode($response);
                }
                
            }

            
        }   

        public function delete_discount($id) {
            $query = "DELETE FROM tbl_discount where discountId = '$id'";
            $result = $this->db->delete($query);
            $response = [];
            if($result) {
                // $alert = "<span class='success'> Xóa sản phẩm thành công</span>";
                // return $alert;
                $response['status'] = 'success';
                $response['message'] = 'Xóa mã thành công!';
                return json_encode($response);
            } else {
                // $alert = "<span class='error'> Cập nhật sản phẩm thất bại</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Xóa mã thất bại!';
                return json_encode($response);
            }
        }

        
        public function check_code($total,$text) {
            $query = "SELECT * FROM tbl_discount WHERE discountName = '$text' LIMIT 1";
            $result = $this->db->select($query);
            $currentDate = date('Y-m-d');
            $response = [];
            if($result) {
                $row = $result->fetch_assoc();
                if($row['discountStart'] <= $currentDate && $currentDate <= $row['discountEnd']) {
                    if($row['discountValue'] > $total) {
                        $response['code'] = $row['discountName'];
                        $response['message'] = 'Giá trị của mã giảm giá không hợp lệ';
                        $response['value'] = 0;
                        Session::set('discount', 0);
                        return $response;
                    } else {
                        $response['code'] = $row['discountName'];
                        $response['message'] = 'Mã giảm giá chính xác';
                        $response['value'] = $row['discountValue'];
                        Session::set('discount', $row['discountValue']);
                        return $response;
                    }
                    
                } else {
                    $response['code'] = $text;
                    $response['message'] = 'Mã giảm giá không hợp lệ!';
                    $response['value'] = 0;
                    Session::set('discount', 0);
                    return $response;
                }
                
            } else {
                $response['code'] = $text;
                $response['message'] = 'Mã giảm giá không hợp lệ!';
                $response['value'] = 0;
                Session::set('discount', 0);
                return $response;
            }
        }
    }
?>