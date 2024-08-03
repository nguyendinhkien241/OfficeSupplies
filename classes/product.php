<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
?>

<?php
    class product {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_product($data, $files) {
            $productName = mysqli_real_escape_string($this->db->link, $data['add_name_product']);
            $productAmount = mysqli_real_escape_string($this->db->link, $data['add_amount_product']);
            $productPrice = mysqli_real_escape_string($this->db->link, $data['add_price_product']);
            $category = mysqli_real_escape_string($this->db->link, $data['select_kop']);
            $productStyle = mysqli_real_escape_string($this->db->link, $data['select_style']);
            $productColor = mysqli_real_escape_string($this->db->link, $data['select_color']);
            $productDesc = mysqli_real_escape_string($this->db->link, $data['desc_product']);
            $productProperties = mysqli_real_escape_string($this->db->link, $data['properties_pro']);
            // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            $response = [];

            if($productName == "" || $productAmount == "" || $productPrice == "" || $category == "" || $productStyle== "" || $productStyle== "" || $productDesc == "" || $productProperties == "" || $file_name == "" ) {
                // $alert = "<span class='error'> Các trường không được để trống!</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Các trường không được để trống!';
                return json_encode($response);
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName, productAmount, productPrice, productOldPrice, catId, productStyle, productColor, productDesc, ProductPro, productImage)
                 VALUES('$productName', '$productAmount', '$productPrice', '$productPrice' ,'$category', '$productStyle', '$productColor' ,'$productDesc', '$productProperties','$unique_image')";
                $result = $this->db->insert($query);

                if($result) {
                    // $alert = "<span class='success'> Thêm sản phẩm thành công</span>";
                    // return $alert;
                    $response['status'] = 'success';
                    $response['message'] = 'Thêm sản phẩm thành công!';
                    return json_encode($response);
                } else {
                    // $alert = "<span class='error'> Thêm sản phẩm không thành công</span>";
                    // return $alert;
                    $response['status'] = 'error';
                    $response['message'] = 'Thêm sản phẩm không thành công!';
                    return json_encode($response);
                }
            }

        }

        public function show_product() {
            $query = "SELECT tbl_product.*, tbl_category.category_name FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.category_id order by tbl_product.productId desc";
            // $query = "SELECT * FROM tbl_product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProductbyId($id) {
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data, $files, $id) {
            $productName = mysqli_real_escape_string($this->db->link, $data['add_name_product']);
            $productAmount = mysqli_real_escape_string($this->db->link, $data['add_amount_product']);
            $productPrice = mysqli_real_escape_string($this->db->link, $data['add_price_product']);
            $category = mysqli_real_escape_string($this->db->link, $data['select_kop']);
            $productStyle = mysqli_real_escape_string($this->db->link, $data['select_style']);
            $productColor = mysqli_real_escape_string($this->db->link, $data['select_color']);
            $productDesc = mysqli_real_escape_string($this->db->link, $data['desc_product']);
            $productProperties = mysqli_real_escape_string($this->db->link, $data['properties_pro']);
            // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            $response = [];

            if($productName == "" || $productAmount == "" || $productPrice == "" || $category == "" || $productStyle== "" || $productColor== "" || $productDesc == "" || $productProperties == "" ) {
                // $alert = "<span class='error'> Các trường không được để trống!</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Các trường không được để trống!';
                return json_encode($response);
            } else {
                if(!empty($file_name)) {
                    if($file_size > 5120) {
                        // $alert = "<span class='error'>Kích thước ảnh không được vượt quá 5MB!</span>";
                        // return $alert;
                        $response['status'] = 'error';
                        $response['message'] = 'Kích thước ảnh không được vượt quá 5MB!';
                        return json_encode($response);
                    } else if(in_array($file_ext, $permited) === false) {
                        // $alert = "<span class='error'> Bạn chỉ có thể tải lên ảnh có định dạng ".implode(', ', $permited)."</span>";
                        // return $alert;
                        $response['status'] = 'error';
                        $response['message'] = "Bạn chỉ có thể tải lên ảnh có định dạng ".implode(', ', $permited);
                        return json_encode($response);
                        
                    } else {
                        $query = "UPDATE tbl_product SET
                        productName = '$productName',
                        productAmount = '$productAmount',
                        productOldPrice = '$productPrice',
                        productPrice = '$productPrice',
                        catId = '$category',
                        productStyle = '$productStyle',
                        productColor = '$productColor',
                        productDesc = '$productDesc',
                        productPro = '$productProperties',
                        productImage = '$file_name'
                        WHERE productId = '$id'";
                    }
                } else {
                    $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    productAmount = '$productAmount',
                    productOldPrice = '$productPrice',
                    productPrice = '$productPrice',
                    catId = '$category',
                    productStyle = '$productStyle',
                    productColor = '$productColor',
                    productDesc = '$productDesc',
                    productPro = '$productProperties'
                    WHERE productId = '$id'";
                }
                $result = $this->db->update($query);
                if($result) {
                    // $alert = "<span class='success'> Cập nhật sản phẩm thành công</span>";
                    // return $alert;
                    $response['status'] = 'success';
                    $response['message'] = 'Cập nhật sản phẩm thành công!';
                    return json_encode($response);
                } else {
                    // $alert = "<span class='error'> Cập nhật sản phẩm thành công</span>";
                    // return $alert;
                    $response['status'] = 'error';
                    $response['message'] = 'Cập nhật sản phẩm thất bại!';
                    return json_encode($response);
                }
            }

            
        }   

        public function delete_product($id) {
            $query = "DELETE FROM tbl_product where productId = '$id'";
            $result = $this->db->delete($query);
            $response = [];
            if($result) {
                // $alert = "<span class='success'> Xóa sản phẩm thành công</span>";
                // return $alert;
                $response['status'] = 'success';
                $response['message'] = 'Xóa sản phẩm thành công!';
                return json_encode($response);
            } else {
                // $alert = "<span class='error'> Cập nhật sản phẩm thất bại</span>";
                // return $alert;
                $response['status'] = 'error';
                $response['message'] = 'Xóa sản phẩm thất bại!';
                return json_encode($response);
            }
        }

        public function getProductNew() {
            $query = "SELECT * FROM tbl_product WHERE productStyle = '2'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getNewbyCat($id) {
            $query = "SELECT * FROM tbl_product WHERE productStyle = '2' AND catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProductBestSeller() {
            $query = "SELECT * FROM tbl_product order by productSold desc LIMIT 20";
            $result = $this->db->select($query);
            return $result;
        }

        public function getBestSellerbyCat($id) {
            $query = "SELECT * FROM tbl_product WHERE catId = '$id' order by productSold desc LIMIT 20";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProductbyCat($id) {
            $query = "SELECT * FROM tbl_product WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function showProductPage() {
            $prodOnEachPage = 12;
            if(!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            $eachPage = ($page - 1) * $prodOnEachPage;
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $eachPage, $prodOnEachPage";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProductCatSort($id, $sortby, $filter) {
            $query = "SELECT * FROM tbl_product ";
            if($id != 0) {
                $query .= "WHERE catId = '$id' ";
            }
            if($sortby == 'productName') {
                $query .= " ORDER BY productName ";
            } else {
                $query .= " ORDER BY productPrice ";
            }

            if($filter == 'asc') {
                $query .= "ASC";
            } else {
                $query .= "DESC";
            }

            $prodOnEachPage = 12;
            if(!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            $eachPage = ($page - 1) * $prodOnEachPage;

            $query .= " LIMIT $eachPage, $prodOnEachPage";

            $result = $this->db->select($query);
            return $result;
        }

        public function searchPro($text) {
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%".$text."%'";
            $result = $this->db->select($query);
            return $result;
        }

        public function searchProAdmin($text) {
            $query = "SELECT tbl_product.*, tbl_category.category_name FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.category_id WHERE productName LIKE '%".$text."%'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>