<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class user {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function creat_account($data) {
            $userName = $this->fm->validation($data['user-name']);
            $password = $this->fm->validation($data['password']);
            $userName = mysqli_real_escape_string($this->db->link, $userName);
            $fullName = mysqli_real_escape_string($this->db->link, $data['full-name']);
            $userEmail = mysqli_real_escape_string($this->db->link, $data['email']);
            $userPhone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $userAddress = mysqli_real_escape_string($this->db->link, $data['address']);
            $password = mysqli_real_escape_string($this->db->link, md5($password));
            
            $response = [];
            $check_user = "SELECT * FROM tbl_user WHERE userName = '$userName' LIMIT 1";
            $resultCheck = $this->db->select($check_user);
            if($resultCheck) {
                $response['status'] = 'error';
                $response['message'] = 'Tên tài khoản đã tồn tại';
                return json_encode($response);
            } else {
                $query = "INSERT INTO tbl_user(userName, fullName, userEmail, userPhone, userAddress, password)
                VALUES('$userName', '$fullName', '$userEmail', '$userPhone' ,'$userAddress', '$password')";
                $result = $this->db->insert($query);

                if($result) {
                    $response['status'] = 'success';
                    $response['message'] = 'Đăng ký thành công';
                    return json_encode($response);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Đăng ký không thành công';
                    return json_encode($response);
                }
            }
        }

        public function log_in_user($data) {
            $userName = mysqli_real_escape_string($this->db->link, $data['user-name']);
            $userEmail = mysqli_real_escape_string($this->db->link, $data['user-email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if($userName == "" || $password == "") {
                $alert = "<span style='display:block; margin-bottom: 12px; font-size: 15px; color: red; text-align: left;'> Các trường không được để trống!</span>";
                return $alert;
            } else {
                // Thêm userEmail = $userEmail vào trong câu lệnh SQL
                $check_account = "SELECT * FROM tbl_user WHERE userName = '$userName' AND password = '$password' AND disable = 0 LIMIT 1";
                $resultCheck = $this->db->select($check_account);
                if($resultCheck) {
                    $value = $resultCheck->fetch_assoc();
                    Session::set('user_login', true);
                    Session::set('user_id', $value['userId']);
                    Session::set('user_name', $value['fullName']);
                    return "<script>window.location = 'index.php'</script>";
                } else {
                    $alert = "<span style='display:block; font-style: italic; margin-bottom: 12px; font-size: 15px; color: red; text-align: left;'> Tài khoản hoặc mật khẩu không chính xác</span>";
                    // $alert = "<span style='display:block; font-style: italic; margin-bottom: 12px; font-size: 15px; color: red; text-align: left;'> Thông tin đăng nhập không chính xác</span>";
                    return $alert;
                }
            }
        }

        public function disableAccount($id, $action) {
            if($action == 'lock') {
                $query = "UPDATE tbl_user SET disable = 1 WHERE userId = '$id'";
                $result = $this->db->update($query);
            } else {
                $query = "UPDATE tbl_user SET disable = 0 WHERE userId = '$id'";
                $result = $this->db->update($query);
            }
        }

        public function getInfo($id) {
            $query = "SELECT * FROM tbl_user WHERE userId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_account($id, $data) {
            $fullName = mysqli_real_escape_string($this->db->link, $data['full-name']);
            $userEmail = mysqli_real_escape_string($this->db->link, $data['user-email']);
            $userPhone = mysqli_real_escape_string($this->db->link, $data['user-phone']);
            $userAddress = mysqli_real_escape_string($this->db->link, $data['user-address']);

            $query = "UPDATE tbl_user SET fullName = '$fullName', userEmail = '$userEmail', userPhone='$userPhone', userAddress='$userAddress' WHERE userId = '$id'";
            $result = $this->db->update($query);
            $response = [];
            if($result) {
                $response['status'] = 'success';
                $response['message'] = 'Cập nhật thông tin thành công!';
                return json_encode($response);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Cập nhật thông tin không thành công!';
                return json_encode($response);
            }
        }

        public function update_pw($id, $data) {
            $currentPw = mysqli_real_escape_string($this->db->link, md5($data['current-pw']));
            $newPw = mysqli_real_escape_string($this->db->link, md5($data['new-pw']));

            $queryPw = "SELECT * FROM tbl_user WHERE userId = '$id' LIMIT 1";
            $getPw = $this->db->select($queryPw)->fetch_assoc();

            if($currentPw != $getPw['password']) {
                $response['status'] = 'error';
                $response['message'] = 'Mật khẩu không chính xác!';
                return json_encode($response);
            } else if($newPw == $getPw['password']) {
                $response['status'] = 'error';
                $response['message'] = 'Mật khẩu mới không được giống mật khẩu cũ!';
                return json_encode($response);
            } else {
                $query = "UPDATE tbl_user SET password = '$newPw' WHERE userId = '$id'";
                $result = $this->db->update($query);
                $response = [];
                if($result) {
                    $response['status'] = 'success';
                    $response['message'] = 'Thay đổi mật khẩu thành công!';
                    return json_encode($response);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Thay đổi mật khẩu không thành công!';
                    return json_encode($response);
                }
            }
        }

        public function show_user() {
            $query = "SELECT * FROM tbl_user ORDER BY userId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_user($id) {
            $query = "DELETE FROM tbl_user WHERE userId = '$id'";
            $result = $this->db->delete($query);
            $response = [];
            if($result) {
                $response['status'] = 'success';
                $response['message'] = 'Xóa người dùng thành công!';
                return json_encode($response);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Xóa người dùng không thành công!';
                return json_encode($response);
            }
        }
         
    }
?>