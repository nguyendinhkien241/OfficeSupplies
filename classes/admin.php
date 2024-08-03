<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class admin {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function update_pw($data) {
            $currentPw = mysqli_real_escape_string($this->db->link, md5($data['old-pw']));
            $newPw = mysqli_real_escape_string($this->db->link, md5($data['new-pw']));
            $id = Session::get('admin_id');
    
            $queryPw = "SELECT * FROM tbl_admin WHERE admin_id = '$id' LIMIT 1";
            $getPw = $this->db->select($queryPw)->fetch_assoc();
    
            if($currentPw != $getPw['admin_pass']) {
                $response['status'] = 'error';
                $response['message'] = 'Mật khẩu không chính xác!';
                return json_encode($response);
            } else if($newPw == $getPw['admin_pass']) {
                $response['status'] = 'error';
                $response['message'] = 'Mật khẩu mới không được giống mật khẩu cũ!';
                return json_encode($response);
            } else {
                $query = "UPDATE tbl_admin SET admin_pass = '$newPw' WHERE admin_id = '$id'";
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
    }

    
?>