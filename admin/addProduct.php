<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/category.php";
    include "../classes/product.php";
?>

<?php
    $prod = new product();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $insertProduct = $prod->insert_product($_POST, $_FILES);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard add-product">
                            <h3 class="addProduct-heading">
                                Thêm sản phẩm
                            </h3>

                            <div class="addProduct-main">
                                <form action="addProduct.php" method="POST" enctype="multipart/form-data">
                                    <div class="addProduct-box">
                                        <div class="addProduct-input">
                                            <div class="addProduct-control">
                                                <label for="add-name-product">Tên sản phẩm</label>
                                                <input type="text" name="add_name_product" id="add-name-product">
                                            </div>
    
                                            <div class="addProduct-control">
                                                <label for="add-amount-product">Số lượng</label>
                                                <input type="text" name="add_amount_product" id="add-amount-product">
                                            </div>
    
                                            <div class="addProduct-control">
                                                <label for="add-price-product">Giá sản phẩm</label>
                                                <input type="text" name="add_price_product" id="add-price-product">
                                            </div>

                                            <div class="addProduct-area">
                                                <label for="desc-product">Mô tả sản phẩm</label>
                                                <textarea name="desc_product" id="desc-product" cols="30" rows="6"></textarea>
                                            </div>

                                        </div>
    
                                        <div class="addProduct-choose">
                                            <div class="addProduct-select">
                                                <label for="">Loại sản phẩm</label>
                                                <select name="select_kop" id="select-kop">
                                                    <option>--- Lựa chọn ---</option>
                                                    <?php
                                                        $cat = new category();
                                                        $catlist = $cat->show_category();
                                                        if($catlist) {
                                                            while($result = $catlist->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $result['category_id'] ?>"><?php echo $result['category_name'] ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
    
                                            <div class="addProduct-select">
                                                <label for="select-style">Kiểu sản phẩm</label>
                                                <select name="select_style" id="select-style">
                                                    <option>--- Lựa chọn ---</option>
                                                    <option value="1">Thường</option>
                                                    <option value="2">Mới</option>
                                                </select>
                                            </div>

                                            <div class="addProduct-select">
                                                <label for="select-style">Lựa chọn màu</label>
                                                <select name="select_color" id="select-style">
                                                    <option>--- Lựa chọn ---</option>
                                                    <option value="1">Có</option>
                                                    <option value="0">Không</option>
                                                </select>
                                            </div>

                                            <div class="addProduct-area">
                                                <label for="properties-pro">Đặc tính sản phẩm</label>
                                                <textarea name="properties_pro" onkeydown="addDash(event)" id="properties-pro" cols="30" rows="6"></textarea>
                                            </div>
    
                                            
                                        </div>

                                        <div class="addProduct-others">
                                            <button class="addProduct-submit" name="submit" type="submit">Thêm sản phẩm</button>
                                        </div>

                                        <div class="addProduct-others">
                                        <div class="addProduct-file">
                                                <div class="add-file">
                                                    <label for="my-image" class="preview-image">
                                                        <i class="fa-regular fa-image"></i>
                                                        <span>Chọn ảnh</span>
                                                    </label>
                                                    <input type="file" name="image" onchange="addImage(this)" id="my-image">
                                                </div>
                                            </div>

                                            <script>
                                                function addImage(x) {
                                                    const preview = document.querySelector('.preview-image');
                                                    var imgElement = preview.querySelector('img');
                                                    // const error = document.querySelector('.error');
                                                    const file = x.files[0];
                                                    if(imgElement) {
                                                        imgElement.src = URL.createObjectURL(file);
                                                    } else {
                                                        imgElement = document.createElement('img');
                                                        imgElement.src = URL.createObjectURL(file);
                                                        preview.appendChild(imgElement);
                                                    }
                                                    
                                                    if(!file) {
                                                        return;
                                                    }
                                                    // if(file.size / (1024 * 1024) > 5) {
                                                    //     error.innerText = `Hình ảnh có kích thước quá lớn! (< 5MB)`;
                                                    //     return;
                                                    // } else {
                                                    //     error.innerText = ``;
                                                    // }
                                                    
                                                }
                                            </script>
                                        </div>

                                        <script>
                                            function addDash(event) {
                                              if (event.keyCode === 13) {  // Kiểm tra phím Enter
                                                event.preventDefault();   // Ngăn chặn dòng mới được thêm vào textarea
                                        
                                                var textarea = document.getElementById("properties-pro");
                                                var currentText = textarea.value;
                                                var cursorPosition = textarea.selectionStart;
                                        
                                                // Thêm ký tự gạch ngang vào vị trí con trỏ
                                                var newText = currentText.slice(0, cursorPosition) + "\n-" + currentText.slice(cursorPosition);
                                        
                                                textarea.value = newText;
                                                textarea.setSelectionRange(cursorPosition + 2, cursorPosition + 2); // Di chuyển con trỏ đến sau ký tự gạch ngang
                                        
                                              } else {
                                                // Lấy vị trí con trỏ
                                                var textarea = document.getElementById("properties-pro");
                                                var cursorPosition = textarea.selectionStart;
                                        
                                                // Kiểm tra xem người dùng đã nhập gì đó hay chưa
                                                if (cursorPosition === 0 && textarea.value.length === 0) {
                                                  textarea.value = "-";  // Thêm ký tự gạch ngang ở đầu nếu người dùng chưa nhập gì
                                                  textarea.setSelectionRange(1, 1); // Di chuyển con trỏ đến sau ký tự gạch ngang
                                                }
                                              }
                                            }
                                          </script>
                                    </div>

                                    
                                </form>
                            </div>
                        </div>

                        <div id="toasts">
                        </div>

                        <script>
                            const toasts = document.querySelector('#toasts');
                            var data = <?php if(isset($insertProduct)) {echo $insertProduct;} else {echo "undefined";}?>;
                            let templateInner;
                            if(data) {
                                if (data.status === 'success') {
                                templateInner = `<i class="fa-solid fa-circle-check"></i>
                                <span class="message">${data.message}</span>`
                                } else {
                                    templateInner = `<i class="fa-solid fa-triangle-exclamation"></i>
                                    <span class="message">${data.message}</span>`
                                }
                                var toast = document.createElement('div');
                                toast.classList.add('toast');
                                toast.classList.add(data.status);
                                toast.innerHTML = `
                                ${templateInner}
                                <div class="countdown"></div>
                                `
                                toasts.appendChild(toast);
                                setTimeout(function() {
                                    toast.style.animation = 'slideHide 2s ease-in-out forwards';
                                },3500);
                                setTimeout(function() {
                                    toast.remove();
                                }, 5500);
                                if(data.status === 'success') {
                                    delete data;
                                    setTimeout(() => {
                                        window.location.href = 'productList.php';
                                    }, 5500);
                                }
                                delete data;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>