<?php
    include_once "../lib/session.php";
    Session::init();
?>

<?php
    include_once "../lib/database.php";
    include_once "../helpers/format.php";

    spl_autoload_register(function($className) {
        include_once "../classes/".$className.".php";
    });

    $pro = new product();

?>

<?php
    $listProForSearch = $pro->show_product();
    $arrProduct = array();
    if($listProForSearch) {
        while($row = $listProForSearch->fetch_assoc()) {
            $product = new stdClass();
            $product->productId = $row['productId'];
            $product->productName = $row['productName'];
            $product->productPrice = $row['productPrice'];
            $product->productOldPrice = $row['productOldPrice'];
            $product->productImage = $row['productImage'];
            $arrProduct[] = $product;
        }
        header('Content-Type: application/json');
        echo json_encode($arrProduct);
    }
?>