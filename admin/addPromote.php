<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/category.php";
    include "../classes/promote.php";
?>

<?php
    $prom = new promote();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $insertPromote = $prom->insert_promote($_POST);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard promoteAdd">
                            <h3 class="promoteAdd-heading">Thêm chương trình ưu đãi</h3>
                            <div class="promoteAdd-main">
                                <form action="" method="POST" class="promoteAdd-form">
                                    <div class="pro-form-col">
                                        <div class="pro-form-group">
                                            <label for="name-promote">Tên chương trình</label>
                                            <input type="text" name="name-promote" id="name-promote">
                                        </div>

                                        <div class="pro-form-group">
                                            <label for="date-of-start">Ngày bắt đầu</label>
                                            <input type="date" name="date-of-start" id="date-of-start">
                                        </div>

                                        <div class="pro-form-group">
                                            <label for="name-promote">% giảm</label>
                                            <div class="pro-form-control">
                                                <input type="text" name="percent" id="name-promote">
                                                <span>%</span>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="pro-form-col">
                                        <div class="pro-form-group">
                                            <label for="pro-kop">Áp dụng cho</label>
                                            <select name="pro-kop" id="pro-kop">
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
                                                <option value="99">Tất cả</option>
                                            </select>
                                        </div>

                                        <div class="pro-form-group">
                                            <label for="date-of-end">Ngày kết thúc</label>
                                            <input type="date" name="date-of-end" id="date-of-end">
                                        </div>

                                        <div class="pro-form-group">
                                            <button name="submit" type="submit" class="pro-form-submit">Xác nhận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="toasts">
                        </div>

                        <script>
                            const toasts = document.querySelector('#toasts');
                            var data = <?php if(isset($insertPromote)) {echo $insertPromote;} else {echo "undefined";}?>;
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
                                        window.location.href = 'promoteList.php';
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