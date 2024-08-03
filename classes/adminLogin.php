<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/session.php");
    Session::checkLogin();
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class adminLogin {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($adminUser, $adminPw) {
            $adminUser = $this->fm->validation($adminUser);
            $adminPw = $this->fm->validation($adminPw);
            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPw = mysqli_real_escape_string($this->db->link, $adminPw);

            if(empty($adminUser) || empty($adminPw)) {
                $alert = "Tài khoản và mật khẩu không được để trống!";
                return $alert;
            } else {
                $query = "SELECT * FROM tbl_admin WHERE admin_user = '$adminUser' AND admin_pass = '$adminPw' LIMIT 1";
                $result = $this->db->select($query);

                if($result != false) {
                    $value = $result->fetch_assoc();
                    Session::set('login', true);
                    Session::set('admin_id', $value['admin_id']);
                    Session::set('admin_name', $value['admin_name']);
                    Session::set('admin_user', $value['admin_user']);
                    Session::set('admin_pass', $value['admin_pass']);
                    header('Location:index.php');
                } else {
                    $alert = "Tài khoản hoặc mật khẩu không chính xác!";
                    return $alert;
                }
            }
        }
    }
?>