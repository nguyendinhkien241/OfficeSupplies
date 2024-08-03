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
    if(isset($_GET['promoteId'])) {
        $id = $_GET['promoteId'];
        $delPromote = $prom->delete_promote($id);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard promoteList">
                            <h3 class="promote-heading">Danh sách chương trình ưu đãi</h3>
                            <div class="promote-main">
                                <ul class="promote-list">
                                    <?php
                                        $promList = $prom->show_promote();
                                        if($promList) {
                                            while($result = $promList->fetch_assoc()) {
                                    ?>
                                    <li class="promote-row">
                                        <table>
                                            <tr>
                                                <th>Tên chương trình</th>
                                                <th>Áp dụng cho</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>% giảm</th>
                                                <th>Tùy chỉnh</th>
                                            </tr>
                                            <tr>
                                                <td class="promote-name"><?php echo $result['promoteName'] ?></td>
                                                <td><?php 
                                                    $cat = new category();
                                                    if($result['promoteKop'] == 99) {
                                                        echo "Tất cả";
                                                    } else {
                                                        $catItem = $cat->get_category($result['promoteKop']);
                                                        $catName = $catItem->fetch_assoc();
                                                        echo $catName['category_name'];
                                                    }
                                                    
                                                ?></td>
                                                <td><?php echo $result['promoteStart'] ?></td>
                                                <td><?php echo $result['promoteEnd'] ?></td>
                                                <td><?php echo $result['promotePercent'] ?>%</td>
                                                <td>
                                                    <a href="promoteEdit.php?promoteId=<?php echo $result['promoteId'] ?>" class="promote-change-link">
                                                        <i class="fa-solid fa-wrench"></i>
                                                    </a>
                                                    <a data-id="<?php echo $result['promoteId'] ?>" onclick="showModal(this)" class="promote-delete-link">
                                                        <i class="fa-regular fa-circle-xmark"></i>
                                                    </a>
                                                </td>
                                            </tr> 
                                        </table>
                                    </li>
                                    <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal hide">
        <div class="modal__inner">
            <div class="modal__header">
                <p>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Cảnh báo
                </p>
                <i class="fas fa-times"></i>
            </div>
            <div class="modal__body">
                <h2>Chương trình này sẽ bị Xóa</h2>
                <p>Bạn có muốn tiếp tục không?</p>
            </div>
            <div class="modal__footer">
                <a class="submit-action">Xác nhận</a>
                <button>Close</button>
            </div>
        </div>
    </div>

    <script>
        var modal = document.querySelector('.modal');
        var iconClose = document.querySelector('.modal__header>i');
        var btnClose = document.querySelector('.modal__footer button');
        var submitBtn = document.querySelector('.submit-action');
        function toggleModal() {
            modal.classList.toggle('hide');
        }
        btnClose.onclick = toggleModal;
        iconClose.onclick = toggleModal;
        modal.addEventListener('click', function(e) {
            if(e.target == e.currentTarget) {
                toggleModal();
            }
        });
        function showModal(x) {
            toggleModal();
            var id = x.getAttribute('data-id');
            submitBtn.href = `?promoteId=${id}`;
        }
    </script>

    <div id="toasts">
    </div>

    <script>
        const toasts = document.querySelector('#toasts');
        var data = <?php if(isset($delPromote)) {echo $delPromote;} else {echo "undefined";}?>;
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
</body>
</html>