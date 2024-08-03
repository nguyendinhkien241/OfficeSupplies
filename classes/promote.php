<?php
   $filepath = realpath(dirname(__FILE__));
   include_once ($filepath."/../lib/database.php") ;
   include_once ($filepath."/../helpers/format.php");
?>

<?php
    class promote {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_promote($data) {
            $promoteName = mysqli_real_escape_string($this->db->link, $data['name-promote']);
            $dateOfStart = mysqli_real_escape_string($this->db->link, $data['date-of-start']);
            $percent = mysqli_real_escape_string($this->db->link, $data['percent']);
            $proKop = mysqli_real_escape_string($this->db->link, $data['pro-kop']);
            $dateOfEnd = mysqli_real_escape_string($this->db->link, $data['date-of-end']);

            $response = [];

            if($promoteName == "" || $dateOfStart == "" || $percent == "" || $proKop == "" || $dateOfEnd== "" ) {
                // $alert = "<span class='error'> Các trường không được để trống!</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Các trường không được để trống!';
                return json_encode($response);
            } else {
                if($percent > 100 || $percent < 0) {
                    $response['status'] = 'error';
                    $response['message'] = 'Số phần trăm không hợp lệ';
                    return json_encode($response);
                } else {
                    $query = "INSERT INTO tbl_promote(promoteName, promoteStart, promoteEnd, promotePercent, promoteKop)
                    VALUES('$promoteName', '$dateOfStart', '$dateOfEnd', '$percent' ,'$proKop')";
                    $result = $this->db->insert($query);

                    if($result) {
                        // $alert = "<span class='success'> Thêm sản phẩm thành công</span>";
                        // return $alert;
                        $response['status'] = 'success';
                        $response['message'] = 'Thêm chương trình thành công!';
                        return json_encode($response);
                    } else {
                        // $alert = "<span class='error'> Thêm sản phẩm không thành công</span>";
                        // return $alert;
                        $response['status'] = 'error';
                        $response['message'] = 'Thêm chương trình thất bại!';
                        return json_encode($response);
                    }
                }
                
            }

        }

        public function show_promote() {
            $query = "SELECT * FROM tbl_promote ORDER BY promoteId DESC";
            // $query = "SELECT * FROM tbl_product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getPromotebyId($id) {
            $query = "SELECT * FROM tbl_promote WHERE promoteId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_promote($data, $id) {
            $promoteName = mysqli_real_escape_string($this->db->link, $data['name-promote']);
            $dateOfStart = mysqli_real_escape_string($this->db->link, $data['date-of-start']);
            $percent = mysqli_real_escape_string($this->db->link, $data['percent']);
            $proKop = mysqli_real_escape_string($this->db->link, $data['pro-kop']);
            $dateOfEnd = mysqli_real_escape_string($this->db->link, $data['date-of-end']);

            if($promoteName == "" || $dateOfStart == "" || $percent == "" || $proKop == "" || $dateOfEnd== "" ) {
                // $alert = "<span class='error'> Các trường không được để trống!</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Các trường không được để trống!';
                return json_encode($response);
            } else {
                if($percent > 100 || $percent < 0) {
                    $response['status'] = 'error';
                    $response['message'] = 'Số phần trăm không hợp lệ';
                    return json_encode($response);
                } else {
                    $query = "UPDATE tbl_promote SET
                    promoteName = '$promoteName',
                    promoteStart = '$dateOfStart',
                    promoteEnd = '$dateOfEnd',
                    promotePercent = '$percent',
                    promoteKop = '$proKop'
                    WHERE promoteId = '$id'";
                    $result = $this->db->update($query);

                    if($result) {
                        // $alert = "<span class='success'> Thêm sản phẩm thành công</span>";
                        // return $alert;
                        $response['status'] = 'success';
                        $response['message'] = 'Cập nhật chương trình thành công!';
                        return json_encode($response);
                    } else {
                        // $alert = "<span class='error'> Thêm sản phẩm không thành công</span>";
                        // return $alert;
                        $response['status'] = 'error';
                        $response['message'] = 'Cập nhật chương trình thất bại!';
                        return json_encode($response);
                    }
                }
            }

            
        }   

        public function delete_promote($id) {
            $query = "DELETE FROM tbl_promote where promoteId = '$id'";
            $result = $this->db->delete($query);
            $response = [];
            if($result) {
                // $alert = "<span class='success'> Xóa sản phẩm thành công</span>";
                // return $alert;
                $response['status'] = 'success';
                $response['message'] = 'Xóa chương trình thành công!';
                return json_encode($response);
            } else {
                // $alert = "<span class='error'> Cập nhật sản phẩm thất bại</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Xóa chương trình thất bại!';
                return json_encode($response);
            }
        }

        public function update_price($percent, $id) {
            $value = $percent / 100;
            if($id == 99) {
                $queryUpdate = "UPDATE tbl_product SET productPrice = productOldPrice - (productOldPrice * $value)";
                $resultUpdate = $this->db->update($queryUpdate);
            } else {
                $queryUpdate = "UPDATE tbl_product SET productPrice = productOldPrice - (productOldPrice * $value) WHERE catId = '$id'";
                $resultUpdate = $this->db->update($queryUpdate);
            }
            if($resultUpdate) {
                return true;
            } else {
                return false;
            }
        }

        public function clear_product() {
            $query = "UPDATE tbl_product SET productPrice = productOldPrice";
            $result = $this->db->update($query);
            return true;
        }

        public function check_promote($date) {
            $clear = $this->clear_product();
            $response = [];
            if($clear) {
                $queryDate = "SELECT * FROM tbl_promote p
                WHERE (p.promoteKop, p.promotePercent) IN (
                    SELECT p1.promoteKop, MAX(p1.promotePercent)
                    FROM tbl_promote p1
                    WHERE p1.promoteStart <= '$date' AND p1.promoteEnd >= '$date'
                    GROUP BY p1.promoteKop
                )";
                $resultDate = $this->db->select($queryDate);
                if($resultDate) {
                    while($row = $resultDate->fetch_assoc()) {
                        $percent = $row['promotePercent'];
                        $id = $row['promoteKop'];
                        if($id == 99) {
                            $action = $this->update_price($percent, $id);
                            $response = [$row['promoteKop'] => $row['promotePercent']];
                            break;
                        }
                        $action = $this->update_price($percent, $id);
                        $response[$row['promoteKop']] = $row['promotePercent'];
                    }
                }
            }
            return $response;
        }
    }
?>