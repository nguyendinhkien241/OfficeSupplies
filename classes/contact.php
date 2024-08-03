<?php
   $filepath = realpath(dirname(__FILE__));
   include_once ($filepath."/../lib/database.php") ;
   include_once ($filepath."/../helpers/format.php");
?>

<?php
    class contact {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_contact($data, $date, $time) {
            $nameContact = mysqli_real_escape_string($this->db->link, $data['name-contact']);
            $emailContact = mysqli_real_escape_string($this->db->link, $data['email-contact']);
            $phoneContact = mysqli_real_escape_string($this->db->link, $data['phone-contact']);
            $addressContact = mysqli_real_escape_string($this->db->link, $data['address-contact']);
            $textContact = mysqli_real_escape_string($this->db->link, $data['text-contact']);

            $response = [];

            $query = "INSERT INTO tbl_contact(contactName, contactEmail, contactPhone, contactAddress, date, time, content)
            VALUES('$nameContact', '$emailContact', '$phoneContact', '$addressContact', '$date', '$time', '$textContact')";
            $result = $this->db->insert($query);

            if($result) {
                // $alert = "<span class='success'> Thêm sản phẩm thành công</span>";
                // return $alert;
                $response['status'] = 'success';
                $response['message'] = 'Gửi tin nhắn thành công!';
                return json_encode($response);
            } else {
                // $alert = "<span class='error'> Thêm sản phẩm không thành công</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Gửi tin nhắn thất bại!';
                return json_encode($response);
            }
        }

        public function show_contact() {
            $query = "SELECT * FROM tbl_contact ORDER BY contactId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_contact($id) {
            $query = "DELETE FROM tbl_contact WHERE contactId='$id'";
            $result = $this->db->delete($query);
            return $result;
        }   
    }

?>