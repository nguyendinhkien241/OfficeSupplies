<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class category {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function show_category() {
            $query = "SELECT * FROM tbl_category";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_category($category_id) {
            $query = "SELECT * FROM tbl_category WHERE category_id = '$category_id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>